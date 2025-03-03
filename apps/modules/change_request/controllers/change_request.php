<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Change_request extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('change_request_model', 'mod');
		parent::__construct();
		$this->lang->load('my_change_request');
	}

	function _list_options_active( $record, &$rec )
	{
		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/'.$record['record_id'];
			$rec['view_url'] = '<a href="'.$rec['detail_url'].'" class="btn btn-xs text-muted"><i class="fa fa-search"></i> '. lang('common.view') .'</a>';
			// $rec['view_url'] = '<a href="javascript: see_detail('.$record['partners_personal_request_header_user_id'].', \''.$record['partners_personal_request_key_id'].'\', '.$record['partners_personal_request_status_id'].')" class="btn btn-xs text-muted"><i class="fa fa-search"></i> View</a>';
		}

		if( $this->permission['approve'] && $record['partners_personal_request_header_status_id'] == 2 )
		{
			$rec['options'] .= '<li><a href="javascript: change_status('.$record['record_id'].', 3)"><i class="fa fa-check text-success"></i> '. lang('my_change_request.approved') .'</a></li>';
		}

		if(  $this->permission['decline'] && $record['partners_personal_request_header_status_id'] == 2 )
		{
			$rec['options'] .= '<li><a href="javascript: change_status('.$record['record_id'].', 4)"><i class="fa fa-times text-danger"></i> '. lang('my_change_request.decline') .'</a></li>';
		}
	}

	function change_status()
	{
		$this->_ajax_only();

		$status = $this->input->post('status');
		$personal_request_header_id = $this->input->post('record_id');

		switch( true )
		{
			case $status == 3:
				if( !$this->permission['approve'] )
				{
					$this->response->message[] = array(
						'message' => lang('common.insufficient_permission'),
						'type' => 'warning'
					);
					$this->_ajax_return();
				}
				break;
			case $status == 4:
				if( !$this->permission['decline'] )
				{
					$this->response->message[] = array(
						'message' => lang('common.insufficient_permission'),
						'type' => 'warning'
					);
					$this->_ajax_return();
				}
				break;
			default:
				$this->response->message[] = array(
					'message' => 'Unsupported type of status, please notify the System Administrator.',
					'type' => 'warning'
				);
				$this->_ajax_return();
		}


        //SAVING START   
        $error = false;
		$transactions = true;
		if( $transactions )
		{
			$this->db->trans_begin();
		}

		$this->mod->change_status($personal_request_header_id, $status);

		$action = 'update';
		$previous_main_data = array();

        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'partners_personal_request_header', $previous_main_data, array('status' => $status));								

		$this->db->join('partners_key','partners_personal_request.key_id = partners_key.key_id','left');
		$partners_personal_request = $this->db->get_where('partners_personal_request', array('personal_request_header_id' => $personal_request_header_id))->result_array();

		$this->db->join('partners_key_class','partners_personal_request_header.key_class_id = partners_key_class.key_class_id','left');
		$partners_personal_request_header = $this->db->get_where('partners_personal_request_header', array('personal_request_header_id' => $personal_request_header_id))->row_array();

		$user_id = $partners_personal_request_header['user_id'];

		$users_profile = $this->db->get_where('users_profile', array('user_id' => $user_id))->row_array();

		$this->load->model('partners_model', 'partners_mod');		

		if (!empty($partners_personal_request) && $status == 3) {
			foreach($partners_personal_request as $key => $personal_request_info){
				if ($partners_personal_request_header['key_class_id'] != 58) {
					$sequence = 1;
					$partners_personal = $this->partners_mod->get_partners_personal($users_profile['user_id'], 'partners_personal', $personal_request_info['key_code'], 1);
					$check_on_personal = $this->db->get_where('partners_personal', array('partner_id' => $users_profile['partner_id'], 'key_id' => $personal_request_info['key_id']))->result_array();

					$main_record = array();
					if (!in_array($personal_request_info['key_id'],array(212,243))) {			
						switch( true )
						{
							case count($check_on_personal) == 0:
								$data_personal = $this->partners_mod->insert_partners_personal($users_profile['user_id'], $personal_request_info['key_code'], $personal_request_info['key_value'], 1, $users_profile['partner_id']);
								$this->db->insert('partners_personal', $data_personal);
								$this->response->action = 'insert';

						        //create system logs
						        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, 'partners_personal', array(), $data_personal);
								break;
							case count($check_on_personal) > 0:
								$partners_personal = $partners_personal[0];
								$main_record['modified_by'] = $this->user->user_id;
								$main_record['modified_on'] = date('Y-m-d H:i:s');
								$main_record['key_value'] = $personal_request_info['key_value'];
								$this->db->update( 'partners_personal', $main_record, array( 'personal_id' => $partners_personal['personal_id'] ) );
								$this->response->action = 'update';

						        //create system logs
						        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, 'partners_personal', $partners_personal, $main_record);

								break;
							default:
								$this->response->message[] = array(
									'message' => lang('common.inconsistent_data'),
									'type' => 'error'
								);
								$error = true;
								goto stop;
						}
					} else {
						if (in_array($personal_request_info['key_id'],array(212))) {
							$main_record['birth_date'] = ($personal_request_info['key_value'] && $personal_request_info['key_value'] != '' ? date('Y-m-d',strtotime($personal_request_info['key_value'])) : $users_profile->birth_date);
							$this->db->update( 'users_profile', $main_record, array( 'user_id' => $user_id));

					        //create system logs
					        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'users_profile', array(), $main_record);							
						}
						if (in_array($personal_request_info['key_id'],array(243))) {
							if ($personal_request_info['key_value'] != '') {
								$main_record['email'] = $personal_request_info['key_value'];
								$this->db->update( 'users', $main_record, array( 'user_id' => $user_id));

						        //create system logs
						        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'users', array(), $main_record);							
					        }
						}					
					}
				} else {
					$personal_history = $this->partners_mod->get_partners_personal_history($personal_request_info['user_id'],$personal_request_info['key_code']);

					if (!empty($personal_history))
						$sequence = $personal_history[0]['sequence'] + 1;
					else
						$sequence = 1;

					$data_personal = $this->partners_mod->insert_partners_personal($users_profile['user_id'], $personal_request_info['key_code'], $personal_request_info['key_value'], $sequence, $users_profile['partner_id']);
					$this->db->insert('partners_personal_history', $data_personal);

					$this->response->action = 'insert';

			        //create system logs
			        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, 'partners_personal_history', array(), $data_personal);
				}

				$this->response->notified = $this->mod->notify_filer( $user_id, $status);		        

				if( $this->db->_error_message() != "" ){
					$this->response->message[] = array(
						'message' => $this->db->_error_message(),
						'type' => 'error'
					);
					$error = true;
					goto stop;
				}
			}
		}

		stop:
		if( true )
		{
			if( !$error ){
				$this->db->trans_commit();
			}
			else{
				 $this->db->trans_rollback();
			}
		}

		if( !$error  )
		{
			$this->response->message[] = array(
				'message' => 'Record successfully updated.',
				'type' => 'success'
			);
		}
		
		$this->_ajax_return();
	
	}

	function save_request_detail()
	{
		$this->_ajax_only();
		$status = $this->input->post('status');
		$user_id = $this->input->post('user_id');

		$error = false;
		$this->db->trans_begin();
		$users_profile = $this->db->get_where('users_profile', array('user_id' => $user_id))->row_array();
		$this->load->model('partners_model', 'partners_mod');
		$details = $this->input->post('personal_id');
		foreach ($details as $personal_id => $status) {
			$this->mod->change_status_detail($personal_id, $status);
			$this->db->limit(1);
			$request = $this->db->get_where($this->mod->table, array('personal_id' => $personal_id, 'status' => 3))->row_array();

			if (!empty($request)) {
				$partners_key = $this->db->get_where('partners_key', array('deleted' => 0, 'key_id' => $request['key_id']))->row_array();
		
				$partners_personal = $this->partners_mod->get_partners_personal($users_profile['user_id'], 'partners_personal', $partners_key['key_code'], 1);
				$check_on_personal = $this->db->get_where('partners_personal', array('partner_id' => $users_profile['partner_id'], 'key_id' => $request['key_id']))->result_array();
				$main_record = array();

				if (!in_array($request['key_id'],array(212))) {			
					switch( true )
					{
						case count($check_on_personal) == 0:
							$data_personal = $this->partners_mod->insert_partners_personal($users_profile['user_id'], $partners_key['key_code'], $request['key_value'], 1, $users_profile['partner_id']);
							$this->db->insert('partners_personal', $data_personal);
							$this->response->action = 'insert';
							break;
						case count($check_on_personal) > 0:
							$partners_personal = $partners_personal[0];
							$main_record['modified_by'] = $this->user->user_id;
							$main_record['modified_on'] = date('Y-m-d H:i:s');
							$main_record['key_value'] = $request['key_value'];
							$this->db->update( 'partners_personal', $main_record, array( 'personal_id' => $partners_personal['personal_id'] ) );
							$this->response->action = 'update';
							break;
						default:
							$this->response->message[] = array(
								'message' => lang('common.inconsistent_data'),
								'type' => 'error'
							);
							$error = true;
							goto stop;
					}
				} else {
					if (in_array($request['key_id'],array(212))) {
						$main_record['birth_date'] = ($request['key_value'] && $request['key_value'] != '' ? date('Y-m-d',strtotime($request['key_value'])) : $users_profile->birth_date);
						$this->db->update( 'users_profile', $main_record, array( 'user_id' => $user_id));

				        //create system logs
				        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'users_profile', array(), $main_record);							
					}
				}
			}

			if( $this->db->_error_message() != "" ){
				$this->response->message[] = array(
					'message' => $this->db->_error_message(),
					'type' => 'error'
				);
				$error = true;
				goto stop;
			}
		}

		stop:
		if( !$error ){
			$this->db->trans_commit();
			$this->response->message[] = array(
				'message' => 'Record successfully updated.',
				'type' => 'success'
			);
		}
		else{
			 $this->db->trans_rollback();
		}

		$this->_ajax_return();	
	}

	function cr_form()
	{
		$this->_ajax_only();

		$this->load->helper('form');
		$this->load->model('profile_model', 'profile');
		
		$key_classes = $this->profile->get_user_editable_key_classes();
		$data['key_classes'] = array();
		foreach( $key_classes as $row )
		{
			//check wether key_class has active request
			if( !$this->profile->has_active_request( $row->key_class_id, 0 ) )
				$data['key_classes'][$row->key_class_id] = $row->key_class; 
		}

		$drafts = $this->profile->get_user_editable_keys_draft( 0 );
		$draft = array();
		foreach( $drafts as $row )
		{
			$draft[$row->key_class_id][$row->key_id] = $row; 
		}

		$data['draft'] = '';
		foreach( $draft as $key_class_id => $keys )
		{
			$temp = array();
			foreach ($keys as $key_id => $key) {
				$temp[] = $this->profile->create_key_draft( $key, $key->key_value );
			}
			$temp = implode('', $temp);

			$data['draft'] .= $this->load->view('draft', array('key_class_id' => $key_class_id,'keys' => $temp), true);
		}

		$this->load->vars($data);

		$data = array();
		$data['title'] = 'Change Request';
		$data['content'] = $this->load->blade('cr_form')->with( $this->load->get_cached_vars() );
		$this->response->cr_form = $this->load->view('templates/modal', $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	function add_class_draft()
	{
		$this->_ajax_only();

		$key_class_id = $this->input->post('key_class_id');

		$this->load->model('profile_model', 'profile');

		$keys = $this->profile->get_user_editable_keys( $key_class_id );
		$temp = array();
		foreach( $keys as $key )
		{
			$temp[] = $this->profile->create_key_draft( $key, '' );	
		}
		$temp = implode('', $temp);

		$this->response->class_draft = $this->load->view('draft', array('key_class_id' => $key_class_id, 'keys' => $temp), true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	function save_request()
	{
		$this->_ajax_only();

		$status = $this->input->post('status');
		$classes = $this->input->post('key');
		$user_id = $this->input->post('user_id');

		if( empty($classes))
		{
			$this->response->message[] = array(
				'message' => 'Please add atleast one item.',
				'type' => 'warning'
			);
			$this->_ajax_return();
		}	

		$this->load->model('profile_model', 'profile');


		foreach( $classes as $class_id => $keys )
		{
			$active = $this->profile->has_active_request( $class_id, $user_id );
			$ctr = 1;
			foreach($keys as $key_id => $value)
			{
				$where = $data = array(
					'user_id' => $user_id,
					'key_id' => $key_id,
				);

				$data['sequence'] = $ctr;
				$data['key_value'] = $value;
				$data['status'] = $status;
				$data['created_by'] = $this->user->user_id;
				
				$previous_main_data = array();

				if($active)
				{
					$this->db->update('partners_personal_request', $data, $where);
					$action = 'update';

					$previous_main_data = $this->db->get_where('partners_personal_request', $where)->row_array();
				}
				else{
					$this->db->insert('partners_personal_request', $data);
					$action = 'insert';

					$personal_request_approver = $this->db->query("CALL sp_partners_personal_populate_approvers({$this->db->insert_id()}, ".$user_id.")");
				}

				$ctr++;

		        //create system logs
		        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'partners_personal_request', $previous_main_data, $data);				
			}
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	public function detail( $record_id, $child_call = false )
	{

		if( !$this->permission['detail'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_detail( $record_id );
	}

	private function _detail( $record_id, $new = false)
	{
		$change_request_info_arr = $this->mod->get_change_request_info($record_id);

		if(!empty($change_request_info_arr)){
			$data['record'] = $change_request_info_arr;
			$data['request_details'] = $this->mod->get_change_request_details($record_id);
			$data['can_approve'] = $this->permission['approve'];
			$this->load->vars( $data );
			
			if( !$new ){
				$this->load->helper('file');
				if( !IS_AJAX )
				{
					echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
				}
				else{
					$data['title'] = $this->mod->short_name .' - Detail';
					$data['content'] = $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );

					// $this->response->html = $this->load->view('templates/modal', $data, true);

					$this->response->message[] = array(
						'message' => '',
						'type' => 'success'
					);
					$this->_ajax_return();
				}
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

	function get_public_data() {
		$this->_ajax_only();

		$result = array();
		$value = trim(strtolower($_GET['term']));
		$column = $_GET['column'];

		switch($column){
			case 'countries';
			$field = 'short_name';
				$this->db->select($field)
			    ->from('countries')
			    ->where("LOWER({$field}) LIKE '%{$value}%'");
			    $result = $this->db->get('');	
		    break;
			case 'cities';
			$field = 'city';
				$this->db->select($field)
			    ->from('cities')
			    ->where("LOWER({$field}) LIKE '%{$value}%'");
			    $result = $this->db->get('');	
		    break;
		}
		
		$data = array();
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row[$field]);
				$data[] = $row;
			}			
		}			
		$result->free_result();

		header('Content-type: application/json');
		echo json_encode($data);
		die();
	}
}