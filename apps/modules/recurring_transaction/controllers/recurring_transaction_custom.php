<?php //delete me
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

	function edit()
	{
		parent::edit( '', true );

		$this->_set_employee_lists();

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
	}

	function add()
	{
		parent::add( '', true );

		$this->_set_employee_lists();

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
	}

	private function _set_employee_lists()
	{
		$data['employee_table'] = "";
		
		if( !empty( $this->record_id ) )
		{
			$qry = "SELECT a.employee_id, AES_DECRYPT(a.quantity, encryption_key()) as quantity, AES_DECRYPT(a.amount, '{$this->config->item('encryption_key')}') as amount, b.full_name, c.id_number
			FROM {$this->db->dbprefix}payroll_entry_recurring_employee a
			LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.employee_id
			LEFT JOIN {$this->db->dbprefix}partners c on c.partner_id = a.employee_id
			WHERE a.recurring_id = {$this->record_id}
			ORDER BY b.full_name";
			$emps = $this->db->query( $qry );

			foreach( $emps->result() as $emp)
			{
				$emp->amount = trim( $emp->amount );
				$emp->quantity = trim( $emp->quantity );
				$emp->total = $emp->quantity * $emp->amount;
				
				$emp->amount = number_format( $emp->amount, 2, '.', ',');
				$emp->quantity = number_format( $emp->quantity, 2, '.', ',');
				$emp->total = number_format( $emp->total, 2, '.', ',');

				$data['employee_table'] .= $this->load->view('edit/employee-lists', array( 'employee' => $emp), true);
			}
		}

		$this->load->vars( $data );
	}

	function save()
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

				$this->db->delete('payroll_entry_recurring_employee', array('recurring_id' => $this->response->record_id));

				//$this->load->library('aes', array('key' => $this->config->item('encryption_key')));
				$this->load->library('my_aes',$this->config->item('encryption_key'));

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

					$qty = $this->my_aes->encrypt( str_replace(',', '', $quantity[$index]) );
					$amt = $this->my_aes->encrypt( str_replace(',', '', $amount[$index]) );
					$insert = array(
						'recurring_id' => $this->response->record_id,
						'employee_id' => $employee_id,
						'amount' => $amt,
						'quantity' => $qty
					);
					$this->db->insert('payroll_entry_recurring_employee', $insert);
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
		WHERE a.deleted = 0 AND a.active = 1 AND ";

		switch( $group )
		{
			case 'company':
				$qry .= "b.company_id IN ({$group_id}) ";
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
				$qry .= "b.division_id IN ({$group_id}) ";
				break;
			case 'location':
				$qry .= "b.location_id IN ({$group_id}) ";
				break;
		}

		if( !empty($except) )
		{
			$qry .= " AND a.user_id NOT IN ({$except}) ";
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
		
		$qry = "select a.user_id as employee_id, a.full_name, 0 as  quantity, 0 as amount, b.id_number
		FROM {$this->db->dbprefix}users a
		LEFT JOIN {$this->db->dbprefix}partners b on b.partner_id = a.user_id";

		$employees = $this->input->post('employees');
		$limit = sizeof( $employees );
		$employees = implode(',', $employees);

		$qry .= " WHERE a.user_id in ({$employees}) limit {$limit}";
		$emps = $this->db->query( $qry );
		foreach( $emps->result() as $emp)
		{
			$emp->amount = trim( $emp->amount );
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