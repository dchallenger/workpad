<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_employee extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('payroll_employee_model', 'mod');
		$this->load->model('my201_model', 'profile_mod');
		parent::__construct();
	}

	function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->db->order_by('company_code', 'asc');
		$companies = $this->db->get_where('users_company', array('deleted' => 0));
		$data['companies'] = $companies->result();
		$this->load->vars( $data );
		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}

	public function edit( $record_id = "", $child_call = false )
	{
		if( !$this->permission['edit'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call );
	}

	private function _edit( $child_call, $new = false )
	{
		$record_check = false;
		$this->record_id = $data['record_id'] = '';

		if( !$new ){
			if( !$this->_set_record_id() )
			{
				echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
				die();
			}

			$this->record_id = $data['record_id'] = $_POST['record_id'];
		}

		$record_check = $this->mod->_exists( $this->record_id );
		if( $new || $record_check === true )
		{
	        $taxcode = $this->profile_mod->get_partners_personal($this->record_id, 'taxcode');
	        $taxcode_valu = (count($taxcode) == 0 ? " " : ($taxcode[0]['key_value'] == "" ? "" : $taxcode[0]['key_value']));
			$tin_number = $this->profile_mod->get_partners_personal($this->record_id, 'tin_number');
			$tin_number_val = (count($tin_number) == 0 ? " " : ($tin_number[0]['key_value'] == "" ? "" : $tin_number[0]['key_value']));
			$sss_number = $this->profile_mod->get_partners_personal($this->record_id, 'sss_number');
			$sss_number_val = (count($sss_number) == 0 ? " " : ($sss_number[0]['key_value'] == "" ? "" : $sss_number[0]['key_value']));			
			$pagibig_number = $this->profile_mod->get_partners_personal($this->record_id, 'pagibig_number');
			$pagibig_number_val = (count($pagibig_number) == 0 ? " " : ($pagibig_number[0]['key_value'] == "" ? "" : $pagibig_number[0]['key_value']));
			$philhealth_number = $this->profile_mod->get_partners_personal($this->record_id, 'philhealth_number');
			$philhealth_number_val = (count($philhealth_number) == 0 ? " " : ($philhealth_number[0]['key_value'] == "" ? "" : $philhealth_number[0]['key_value']));

			$users_profile_info_arr = $this->profile_mod->get_user_details($this->record_id);

			$result = $this->mod->_get( 'edit', $this->record_id );
			if( $new )
			{
				$field_lists = $result->list_fields();
				foreach( $field_lists as $field )
				{
					$data['record'][$field] = '';
				}
			}
			else{
				$record = array();
				if ($result && $result->num_rows() > 0){
					$record = $result->row_array();
				}
				foreach( $record as $index => $value )
				{
					$record[$index] = trim( $value );	
				}

				if ($record['payroll_partners.location_id'] == '')
					$record['payroll_partners.location_id'] = $users_profile_info_arr['location_id'];

				if ($record['payroll_partners.sss_no'] == '')
					$record['payroll_partners.sss_no'] = $sss_number_val;

				if ($record['payroll_partners.hdmf_no'] == '')
					$record['payroll_partners.hdmf_no'] = $pagibig_number_val;

				if ($record['payroll_partners.phic_no'] == '')
					$record['payroll_partners.phic_no'] = $philhealth_number_val;

				if ($record['payroll_partners.tin'] == '')
					$record['payroll_partners.tin'] = $tin_number_val;
					
				$data['record'] = $record;
			}

			$this->record = $data['record'];
			$this->load->vars( $data );

			if( !$child_call ){
				$this->load->helper('form');
				$this->load->helper('file');
				echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
			}
		}
		else
		{
			$this->load->vars( $data );
			if( !$child_call ){
				echo $this->load->blade('pages.error', array('error' => $record_check))->with( $this->load->get_cached_vars() );
			}
		}
	}

	function save($child_call = false)
	{
		parent::save( true );
		if( $this->response->saved )
        {
			$current_sequence = 0;
			$partners_personal_table = "partners_personal";
			$partners_personal_key = array(
                                    'taxcode_id'    => 'taxcode',
									'sss_no' 	=> 'sss_number', 
									'hdmf_no' 	=> 'pagibig_number', 
									'phic_no' 	=> 'philhealth_number', 
									'tin' 		=> 'tin_number');

			$payroll_partners = $this->db->query("SELECT * FROM ww_payroll_partners WHERE user_id = {$this->record_id}");
			$payroll_partners_result = $payroll_partners->row_array();

			if($payroll_partners_result['account_type_id'] == 1){

				$partners_personal_key['bank_account'] = 'bank_account_number_current';
			}
			elseif($payroll_partners_result['account_type_id'] == 2){

				$partners_personal_key['bank_account'] = 'bank_account_number_savings';
			}
			
			$partners_personal = $this->input->post('payroll_partners');
			$this->load->model('partners_model', 'part_mod');

			$partner_id = $this->part_mod->get_partner_id($this->response->record_id);
        	foreach( $partners_personal_key as $index => $key )
			{		
				$record = $this->part_mod->get_partners_personal($this->response->record_id , $partners_personal_table, $key, $current_sequence);

				$data_personal = array('key_value' => $partners_personal[$index]);
				switch( true )
				{
					case count($record) == 0:
						$data_personal = $this->part_mod->insert_partners_personal($this->response->record_id, $key, $partners_personal[$key], $sequence, $partner_id);
						$this->db->insert($partners_personal_table, $data_personal);
						// $this->record_id = $this->db->insert_id();
						break;
					case count($record) == 1:
						$where_array = array( 'partner_id' => $partner_id, 'key' => $key );
						$this->db->update( $partners_personal_table, $data_personal, $where_array );
						break;
				}

				if( $this->db->_error_message() != "" ){
					$this->response->message[] = array(
						'message' => $this->db->_error_message(),
						'type' => 'error'
					);
					$error = true;
				}
			}
			$partners = ($this->input->post('partners'));
			if(!empty($partners['resigned_date']) )
				$resigned_date = date('Y-m-d',strtotime($partners['resigned_date']));
			else
				$resigned_date = '0000-00-00';
			
			$this->db->update('partners', array('resigned_date' => $resigned_date), array( 'partner_id' => $partner_id));

/*			if ($recipient != ''){
				$feed = array(
	                'status' => 'info',
	                'message_type' => 'Personnel',
	                'user_id' => $this->user->user_id,
	                'feed_content' => 'Candidate '.$applicant_info->firstname.','.$applicant_info->lastname.' retract the job offer',
	                'uri' => $this->mod->route,
	                'recipient_id' => $recipient
	            );
	            $recipients = array($recipient);
	            $this->system_feed->add( $feed, $recipients );	
			}*/
			
			$this->mod->add_to_holiday_location($payroll_partners_result['user_id'],$payroll_partners_result['location_id']);

			$this->response->message[] = array(
                'message' => lang('common.save_success'),
                'type' => 'success'
            );
        }

        $this->_ajax_return();
	}

	function get_bank_account()
	{
		$this->_ajax_only();
		$this->load->model('my201_model', 'profile_mod');

		$bank_account = '';
		$user_id = $this->input->post('user_id');
		$account_type_id = $this->input->post('account_type_id');

		if(!empty($user_id) && !empty($account_type_id)){

        	if($account_type_id == 1){

	        	$bank_number = $this->profile_mod->get_partners_personal($user_id, 'bank_account_number_current');
	        }
	        elseif($account_type_id == 2){

	        	$bank_number = $this->profile_mod->get_partners_personal($user_id, 'bank_account_number_savings');
	        }

	        if(!empty($bank_number)){

	        	$bank_account = $bank_number[0]['key_value'];
	        }
        }

        $this->response->bank_account = $bank_account;
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

	    $this->_ajax_return();
	}
}