<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recurring_transaction extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('recurring_transaction_model', 'mod');
		parent::__construct();
	}

	function get_add_employee_form()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$post['group'] = $this->input->post('group');
		$post['employee_id'] = "";
		if( $this->input->post('employee_id') )
		{
			$post['employee_id'] = $this->input->post('employee_id');
			$post['employee_id'] = implode(',', $post['employee_id']);	
		}
		$post['group_lists'] = $this->mod->_get_group_lists( $post['group'] );

		$data['title'] = 'Recurring Transaction';
		$data['content'] = $this->load->view('edit/add_employee_form', $post, true);

		$this->response->add_employee_form = $this->load->view('templates/modal', $data, true);	

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function edit($record_id = "", $child_call = false)
	{
		parent::edit( '', true );

		$this->_set_employee_lists();

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
	}

	function detail($record_id, $child_call = false)
	{
		parent::detail( '', true );

		$this->_set_employee_lists('detail');

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
	}

	function add($record_id = '', $child_call = false)
	{
		parent::add( '', true );

		$this->_set_employee_lists();

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
	}

	private function _set_employee_lists($type='edit')
	{
		$data['employee_table'] = "";
		

		if( !empty( $this->record_id ) )
		{
			$qry = "SELECT a.employee_id, AES_DECRYPT(a.quantity, encryption_key()) as quantity, AES_DECRYPT(a.amount, '{$this->config->item('encryption_key')}') as amount, b.full_name, c.id_number
			FROM {$this->db->dbprefix}payroll_entry_recurring_employee a
			LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.employee_id
			LEFT JOIN {$this->db->dbprefix}partners c on c.user_id = a.employee_id
			LEFT JOIN {$this->db->dbprefix}payroll_partners p on p.user_id = a.employee_id
			WHERE a.recurring_id = {$this->record_id}";
			// set sensitivity
			$sensID = $this->config->config['user']['sensitivity'];
			if($sensID && !empty($sensID) ){
				$qry .= " AND p.sensitivity IN ( ".$sensID." ) ";
			}
			$qry .= " ORDER BY b.full_name";
			
			$emps = $this->db->query( $qry );

			foreach( $emps->result() as $emp)
			{
				$emp->amount = (float)trim( $emp->amount );
				$emp->quantity = (float)trim( $emp->quantity );
				$emp->total = (float)$emp->quantity * (float)$emp->amount;
				
				$emp->amount = number_format( $emp->amount, 2, '.', ',');
				$emp->quantity = number_format( $emp->quantity, 2, '.', ',');
				$emp->total = number_format( $emp->total, 2, '.', ',');

				if ($type == 'detail')
					$data['employee_table'] .= $this->load->view('detail/employee-lists', array( 'employee' => $emp), true);
				else
					$data['employee_table'] .= $this->load->view('edit/employee-lists', array( 'employee' => $emp), true);
			}
		}

		$this->load->vars( $data );
	}

	function save($child_call = false)
	{
		$this->_ajax_only();

		if( !$this->_set_record_id() )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'error'
			);
			$this->_ajax_return();	
		}
		
		if( (empty( $this->record_id ) && !$this->permission['add']) || ($this->record_id && !$this->permission['edit']) )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$this->db->trans_begin();
		$this->response = $this->mod->_save( true, false );

		if( $this->response->saved ){
			if( $this->input->post('payroll_entry_recurring_employee') )
			{
				$recurring_employee = $this->input->post('payroll_entry_recurring_employee');
				$employee = $recurring_employee['employee_id'];
				$quantity = $recurring_employee['quantity'];
				$amount = $recurring_employee['amount'];

				//$this->load->library('aes', array('key' => $this->config->item('encryption_key')));
				$this->load->library('my_aes',$this->config->item('encryption_key'));

				$transaction_id = $_POST['payroll_entry_recurring']['transaction_id'];
				$date_from = date('Y-m-d',strtotime($_POST['payroll_entry_recurring']['date_from']));
				$date_to = date('Y-m-d',strtotime($_POST['payroll_entry_recurring']['date_to']));

				foreach( $employee as $index => $employee_id )
				{
					if( empty( $quantity[$index] ) || empty( $amount[$index] ) )
					{
						$this->db->trans_rollback();
						$this->response->saved = false;
						$this->response->message[] = array(
							'message' => 'The amount and quantity fields are required, please enter respected values.',
							'type' => 'warning'
						);
						$this->_ajax_return();
					}

					$qry1 = "SELECT *,a.document_no AS doc_no
					FROM {$this->db->dbprefix}payroll_entry_recurring a
					LEFT JOIN {$this->db->dbprefix}payroll_entry_recurring_employee b on b.recurring_id = a.recurring_id
					LEFT JOIN {$this->db->dbprefix}users c on b.employee_id = c.user_id
					WHERE b.employee_id = {$employee_id}
					AND a.transaction_id = {$transaction_id}
					AND (a.date_from <= '{$date_from}' AND a.date_from <= '{$date_to}')
					AND (a.date_to >= '{$date_from}' AND a.date_to >= '{$date_to}')
					AND a.recurring_id != {$this->response->record_id}					
					AND a.deleted = 0
					AND b.deleted = 0";

					$check_exists_result = $this->db->query( $qry1 );

					if ($check_exists_result && $check_exists_result->num_rows() > 0) {
						$row = $check_exists_result->row();

						$this->db->trans_rollback();
						$this->response->saved = false;
						$this->response->message[] = array(
							'message' => $row->full_name . 'Already added in other transaction for Document No. ' . $row->doc_no,
							'type' => 'error'
						);
						$this->_ajax_return();						
					}

					$qty = $this->my_aes->encrypt( str_replace(',', '', $quantity[$index]) );
					$amt = $this->my_aes->encrypt( str_replace(',', '', $amount[$index]) );
					$insert = array(
						'recurring_id' => $this->response->record_id,
						'employee_id' => $employee_id,
						'amount' => $amt,
						'quantity' => $qty
					);

					$insert_audit_log = array(
						'recurring_id' => $this->response->record_id,
						'employee_id' => $employee_id,
						'amount' => str_replace(',', '', $amount[$index]),
						'quantity' => str_replace(',', '', $quantity[$index])
					);

					$this->db->select('
										*,
										CAST( AES_DECRYPT(ww_payroll_entry_recurring_employee.quantity, encryption_key()) AS CHAR) AS quantity_decrypt,
										CAST( AES_DECRYPT(ww_payroll_entry_recurring_employee.amount, encryption_key()) AS CHAR) AS amount_decrypt
									 ');
					$this->db->where('recurring_id',$this->response->record_id);
					$this->db->where('employee_id',$employee_id);
					$check_existing_recurrin_entry = $this->db->get('payroll_entry_recurring_employee');

					if ($check_existing_recurrin_entry && $check_existing_recurrin_entry->num_rows() > 0){
						$previous_data = $check_existing_recurrin_entry->row_array();

						$previous_data['quantity'] = $previous_data['quantity_decrypt'];
						$previous_data['amount'] = $previous_data['amount_decrypt'];

						$this->db->where('recurring_id',$this->response->record_id);
						$this->db->where('employee_id',$employee_id);						
						$this->db->update('payroll_entry_recurring_employee', $insert);
						
						//create system logs
						$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'payroll_entry_recurring_employee', $previous_data, $insert_audit_log);
					} else {
						$this->db->insert('payroll_entry_recurring_employee', $insert);

						//create system logs
						$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'payroll_entry_recurring_employee', array(), $insert_audit_log);												
					}
				}

				$this->db->trans_commit();
			}
			else{
				$this->db->trans_commit();
			}
		}
		else{
			$this->db->trans_rollback();
		}
		
		$this->response->message[] = array(
			'message' => lang('common.save_success'),
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function get_employees()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$this->response->employees = "";

		$group = $this->input->post('group');
		$group_id = $this->input->post('group_id');
		if( empty( $group_id  ) )
		{
			$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

			$this->_ajax_return();	
		}
		$group_id = implode( ',', $group_id );
		$except = $this->input->post('except');

		$qry = "SELECT a.user_id, a.full_name, b.company, c.department, d.id_number
		FROM {$this->db->dbprefix}users a
		LEFT JOIN {$this->db->dbprefix}users_profile b on b.user_id = a.user_id
		LEFT JOIN {$this->db->dbprefix}users_department c on c.department_id = b.department_id
		LEFT JOIN {$this->db->dbprefix}partners d on d.user_id = a.user_id
		LEFT JOIN {$this->db->dbprefix}payroll_partners p on p.user_id = a.user_id
		WHERE a.deleted = 0 AND a.active = 1 AND ";

		switch( $group )
		{
			case 'company':
				$qry .= "p.company_id IN ({$group_id}) ";
				break;
			case 'division':
				$qry .= "b.division_id IN ({$group_id}) ";
				break;
			case 'department':
				$qry .= "b.department_id IN ({$group_id}) ";
				break;
			case 'position':
				$qry .= "b.position_id IN ({$group_id}) ";
				break;
			case 'employee_type':
				$qry .= "d.employment_type_id IN ({$group_id}) ";
				break;
			case 'location':
				$qry .= "b.location_id IN ({$group_id}) ";
				break;
		}

		if( !empty($except) )
		{
			$qry .= " AND a.user_id NOT IN ({$except}) ";
		}
		// set sensitivity
		$sensID = $this->config->config['user']['sensitivity'];
		if($sensID && !empty($sensID) ){
			$qry .= " AND p.sensitivity IN ( ".$sensID." ) ";
		}

		$qry .= "order by a.full_name asc";
		

		$result = $this->db->query( $qry );
		foreach( $result->result()  as $employee )
		{
			$this->response->employees .= $this->load->view('edit/add_employee', array('employee' => $employee), true);
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function add_employees()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$this->response->employees = "";
		
		$qry = "select a.user_id as employee_id, a.full_name, 1 as  quantity, 0 as amount, b.id_number
		FROM {$this->db->dbprefix}users a
		LEFT JOIN {$this->db->dbprefix}partners b on b.partner_id = a.user_id";

		$employees = $this->input->post('employees');
		$limit = sizeof( $employees );
		$employees = implode(',', $employees);

		$qry .= " WHERE a.user_id in ({$employees}) limit {$limit}";
		$emps = $this->db->query( $qry );
		foreach( $emps->result() as $emp)
		{

			$emp->amount = $this->input->post('rate') ? trim( str_replace(",", "", $this->input->post('rate') ) ) : 0;

			$emp->quantity = trim( $emp->quantity );
			$emp->total = $emp->quantity * $emp->amount;
			
			$emp->amount = number_format( $emp->amount, 2, '.', ',');
			$emp->quantity = number_format( $emp->quantity, 2, '.', ',');
			$emp->total = number_format( $emp->total, 2, '.', ',');

			$this->response->employees .= $this->load->view('edit/employee-lists', array( 'employee' => $emp), true);
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}
}