<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Performance_planning extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('performance_planning_model', 'mod');
		$this->load->model('performance_planning_manage_model', 'mod_manage');
		$this->load->model('appraisal_individual_planning_model', 'mod_individual_planning');
		parent::__construct();
		$this->lang->load('performance_planning');
	}

    public function index()
    {
        $permission = $this->config->item('permission');
        $vars['performance_planning_manage'] = isset($permission['performance_planning_manage']) ? $permission['performance_planning_manage'] : 0;
        $vars['appraisal_individual_planning'] = isset($permission['appraisal_individual_planning']) ? $permission['appraisal_individual_planning'] : 0;

		// $this->db->order_by('performance_status', 'asc');
		$this->db->group_by('year');
		$performance_planning_year = $this->db->get_where('performance_planning', array('deleted' => 0));
		$vars['performance_planning_year'] = $performance_planning_year->result();

        $this->load->vars($vars);
        parent::index();
    }

	function delete()
	{
		$this->_ajax_only();
		
		if( !$this->permission['delete'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		if( !$this->input->post('records') )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'warning'
			);
			$this->_ajax_return();	
		}

		$records = $this->input->post('records');
		$records = explode(',', $records);

		$this->db->where_in($this->mod->primary_key, $records);
		$this->db->where('status_id', 0);
		$record_check = $this->db->get( $this->mod->table );

		if( $record_check->num_rows() > 0 )
		{
			$this->response->message[] = array(
				'message' => 'Delete is not allowed for closed transaction!',
				'type' => 'warning'
			);
			$this->_ajax_return();	
		}

		$this->db->where_in($this->mod->primary_key, $records);
		$record = $this->db->get( $this->mod->table )->result_array();

		foreach($record as $rec){
			if($rec['can_delete'] == 1){
				$data['modified_on'] = date('Y-m-d H:i:s');
				$data['modified_by'] = $this->user->user_id;
				$data['deleted'] = 1;

				$this->db->where($this->mod->primary_key, $rec[$this->mod->primary_key]);
				$this->db->update($this->mod->table, $data);
				
				if( $this->db->_error_message() != "" ){
					$this->response->message[] = array(
						'message' => $this->db->_error_message(),
						'type' => 'error'
					);
				}
				else{
					$this->response->message[] = array(
						'message' => lang('common.delete_record', $this->db->affected_rows()),
						'type' => 'success'
					);
				}
			}else{
				$this->response->message[] = array(
					'message' => 'Record(s) cannot be deleted.',
					'type' => 'warning'
				);
			}
		}

		$this->_ajax_return();
	}

	public function get_list()
	{
		$this->_ajax_only();
		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$this->response->show_import_button = false;
		if( $this->input->post('page') == 1 )
		{
			$this->load->model('upload_utility_model', 'import');
			if( $this->import->get_templates( $this->mod->mod_id ) )
				$this->response->show_import_button = true;
		}

		$trash = $this->input->post('trash') == 'true' ? true : false;

		$records = $this->_get_list( $trash );
		$this->_process_lists( $records, $trash );

		$this->_ajax_return();
	}

	private function _process_lists( $records, $trash )
	{
		$this->response->records_retrieve = sizeof($records);
		$this->response->list = '';
		foreach( $records as $record )
		{
			$rec = array(
				'detail_url' => '#',
				'edit_url' => '#',
				'delete_url' => '#',
				'options' => ''
			);

			if(!$trash)
				$this->_list_options_active( $record, $rec );
			else
				$this->_list_options_trash( $record, $rec );

			$record = array_merge($record, $rec);
			$this->response->list .= $this->load->blade('list_template_custom', $record, true)->with( $this->load->get_cached_vars() );
		}
	}

	private function _get_list( $trash )
	{
		$page = $this->input->post('page');
		$search = $this->input->post('search');
		$filter = "";
		
		$filter_by = $this->input->post('filter_by');
		$filter_value = $this->input->post('filter_value');
		
		if( is_array( $filter_by ) )
		{
			foreach( $filter_by as $filter_by_key => $filter_value )
			{
				if ($filter_by_key == 'status_id'){
					$filter_by_key = 'ww_performance_planning.status_id';
				}

				if( $filter_value != "" ) $filter = 'AND '. $filter_by_key .' = "'.$filter_value.'"';	
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
				if ($filter_by == 'status_id'){
					$filter_by = 'ww_performance_planning.status_id';
				}

				$filter = 'AND '. $filter_by .' = "'.$filter_value.'"';
			}
		}

		if( $page == 1 )
		{
			$searches = $this->session->userdata('search');
			if( $searches ){
				foreach( $searches as $mod_code => $old_search )
				{
					if( $mod_code != $this->mod->mod_code )
					{
						$searches[$this->mod->mod_code] = "";
					}
				}
			}
			$searches[$this->mod->mod_code] = $search;
			$this->session->set_userdata('search', $searches);
		}
		
		$page = ($page-1) * 10;
		$records = $this->mod->_get_list($page, 10, $search, $filter, $trash);
		return $records;
	}

	function add_form() {
		$this->_ajax_only();

		$where = array('deleted'=>0, 'status_id'=>1);
		$data['notifications'] = $this->db->get_where('performance_setup_notification', $where)->result_array();
		$data['form_value'] = $this->input->post('form_value');
		$data['start_date'] = $this->input->post('start_date');

		$this->load->helper('file');
		$this->response->add_form = $this->load->view('edit/forms/'.$this->input->post('add_form'), $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
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
	
	public function add( $record_id = '', $child_call = false )
	{
		if( !$this->permission['add'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call, true );
	}

	private function _edit( $child_call, $new = false )
	{
		$record_check = false;
		$this->record_id = $data['record_id'] = '';
		$data['reminder_ids'] = array();

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
				$record = $result->row_array();
				foreach( $record as $index => $value )
				{
					$record[$index] = trim( $value );	
				}
				$data['record'] = $record;
			}

			//get rating scores
			$reference_ids = $this->db->get_where('performance_planning_applicable', array('planning_id' => $this->record_id))->result_array();
			$references= array();
			foreach ($reference_ids as $index => $value){
				$references[] = $value['user_id'];
			}
			$data['record']['performance_planning_applicable.user_id'] = implode(',', $references);

			$data['reminder_ids'] = $this->db->get_where('performance_planning_reminder', array('planning_id' => $this->record_id, 'deleted' => 0))->result_array();

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

	public function applicable_selection(){
		$this->_ajax_only();
		if($this->input->get('category') > 0){
			$data = array();

			switch($this->input->get('category')){
				case 1: //Employment Type
					$data = $this->mod->getEmpTypeTagList();
				break;
				case 2: //Employment Status
					$data = $this->mod->getEmpStatusTagList();
				break;
				case 3: //Position
					$data = $this->mod->getPositionsTagList();
				break;
				case 4: //Employee
					$data = $this->mod->getUsersTagList();
				break;
				case 5: //Company
					$data = $this->mod->getCompanyTagList();
				break;
			}

			header('Content-type: application/json');
			echo json_encode($data);
			die();
		}else{
			$this->response->message[] = array(
				'message' => 'Please Select Applicable For',
				'type' => 'warning'
				);

			$this->_ajax_return();
		}
	}


	public function save( $child_call = false )
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

		if (!isset($_POST['performance_planning_applicable'])) {
			$this->response->message[] = array(
				'message' => 'Employees is required',
				'type' => 'error'
			);

			$this->_ajax_return();
		}

        $performance_planning_applicable = $_POST['performance_planning_applicable'];
        $appraisal_planning_status_id = $_POST['performance_planning']['status_id'];
		$performance_type_id = $_POST['performance_planning']['performance_type_id'];
		$planning_year = $_POST['performance_planning']['year'];
		$title = $_POST['performance_planning']['title'];

		// checking if there is a template created for the selected employees
		if ($performance_planning_applicable) {
			$error = 0;
			foreach ($performance_planning_applicable as $key => $user_id) {
				foreach ($user_id as $index => $id){
					$user_result = $this->db->get_where('users',array('user_id' => $id));
					$user_info = $user_result->row();

					if ($this->mod->get_template($id)['template_id'] == 0) {
						$error = 1;
						$this->response->message[] = array(
							'message' => $user_info->full_name . 'performance template has not been set',
							'type' => 'error'
						);						
					}
				}
			}

			if ($error) {
				$this->_ajax_return();
			}
		}
		// checking if there is a template created for the selected employees

		unset( $_POST['notification_id'] );
		unset( $_POST['performance_planning_reminder'] );
		unset( $_POST['performance_planning_applicable'] );

		$transactions = true;
		$this->db->trans_begin();
		$this->response = $this->mod->_save( $child_call );
		$error = false;

		if( $this->response->saved && $appraisal_planning_status_id == 1)
		{
			if ($performance_planning_applicable)
			{	
				$performance_type = $this->db->get_where( 'performance_setup_performance' , array( 'performance_id' => $performance_type_id ) )->row_array();

				foreach ($performance_planning_applicable as $key => $user_id) {
		            //delete from applicable if REMOVED
		            $this->db->where_not_in('user_id', $user_id);
		        	$this->db->delete('performance_planning_applicable', array( $this->mod->primary_key => $this->response->record_id ) ); 

		            //delete from approver if REMOVED
		            $this->db->where_not_in('user_id', $user_id);
		        	$this->db->delete('performance_planning_approver', array( $this->mod->primary_key => $this->response->record_id ) ); 

		            foreach ($user_id as $index => $id){

		            	$performance_populate_approvers = $this->db->query("CALL sp_performance_planning_populate_approvers({$this->response->record_id}, ".$id.", ".$id.")");
						
						$applicable_for_insert['planning_id'] = $this->response->record_id;
		            	$applicable_for_insert['user_id'] = $id;
		            	$applicable_for_insert['to_user_id'] = $id;
		            	$applicable_for_insert['template_id'] =  $this->mod->get_template($id)['template_id'];

						$full_name = $this->db->get_where( 'users' , array( 'user_id' => $id ) )->row_array();
						$applicable_for_insert['fullname'] = $full_name['full_name'];

						$this->db->where($this->mod->primary_key,$this->response->record_id);
						$this->db->where('user_id',$id);
						$planning_applicable = $this->db->get('performance_planning_applicable');
						$send_feeds = 0;

						if ($planning_applicable && $planning_applicable->num_rows() > 0)
						{
							$planning_applicable_info = $planning_applicable->row_array();

							$this->db->where($this->mod->primary_key,$this->response->record_id);
							$this->db->where('user_id',$id);							
							$this->db->update('performance_planning_applicable', $applicable_for_insert);

							if (!$planning_applicable_info['notification_sent'])
								$send_feeds = 1;
						}
						else	
						{
		            		$applicable_for_insert['status_id'] = 0;							
							$this->db->insert('performance_planning_applicable', $applicable_for_insert);
							$send_feeds = 1;
						}

						//add feeds if within scope
	                    if( $send_feeds == 1 )
	                    {
							$appraisal_status = ($appraisal_planning_status_id == 1) ? 'is now open' : 'was closed';
/*	                    	if(isset($performance_type['for_probi'])){
	                    		$feed_content = "The performance planning period for your {$performance_type['performance']} $appraisal_status";
	                    	}else{
	                    		$feed_content = "The {$planning_year} performance planning period for {$performance_type['performance']} $appraisal_status";
	                    	}*/

							$feed_content = "The performance planning period for your {$title} $appraisal_status";

	                        $this->load->model('system_feed');
	                        $feed = array(
	                            'status' => 'info',
	                            'message_type' => 'Comment',
	                            'user_id' => $this->user->user_id,
	                            'feed_content' => $feed_content,
	                            'uri' => $this->mod_individual_planning->route . '/edit/'.$this->response->record_id.'/'.$id,
	                            'recipient_id' => $id
	                        );

	                        $recipients = array($id);
	                        $this->system_feed->add( $feed, $recipients );
	                    
	                        $this->response->notify[] = $id;

				            $this->load->library('parser');
				            $this->parser->set_delimiters('{{', '}}');	                

		                    // email to employee
		                    $employee_info = $this->db->get_where( 'users' , array( 'user_id' => $id ) )->row_array();
		                    $sendtargetsettings['appraisee'] = $employee_info['full_name'];


		                    $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-EMPLOYEE') )->row_array();
		                    $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
		                    $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

		                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
		                             VALUES('{$id}', '{$subject}', '".$this->db->escape_str($msg)."') ");					            

							$this->db->where($this->mod->primary_key,$this->response->record_id);
							$this->db->where('user_id',$id);							
							$this->db->update('performance_planning_applicable', array('email_sent' => 1, 'notification_sent' => 1));

	        				//$performance_planning_period_email = $this->db->query("CALL sp_performance_planning_period_email( {$planning_year}, {$id}, '{$performance_type['performance']}', {$appraisal_planning_status_id}, '{$performance_type['for_probi']}' )");
							//mysqli_next_result($this->db->conn_id);						                        
	                    }						
					}
				}
			}

		}
 /*       $planning_status_id = $_POST['performance_planning']['status_id'];
        $performance_type_id = $_POST['performance_planning']['performance_type_id'];
        $planning_year = $_POST['performance_planning']['year'];
	    $performance_type = $this->db->get_where( 'performance_setup_performance' , array( 'performance_id' => $performance_type_id ) )->row_array();

		if( !$this->input->post('record_id') || $this->input->post('record_id') == '' )
		{
            //send to approvers
            $employment_type = array(1,2,3,4,5,9,10,16,17,18);
            $this->db->where_in('employment_type_id',$employment_type);
            $immediate_result = $this->db->get('partners');

	        if($immediate_result && $immediate_result->num_rows() > 0){
				$planning_status = ($planning_status_id == 1) ? 'is now open' : 'was closed';
				$feed_content = "The {$planning_year} performance planning period for {$performance_type['performance']} $planning_status";

				foreach ($immediate_result->result_array() as $immediate){
					
					$planning_info = array(
							'year' => $planning_year,
							'date_from' => date('Y-m-d',strtotime($_POST['performance_planning']['date_from'])),
							'date_to' => date('Y-m-d',strtotime($_POST['performance_planning']['date_to'])),
							'performance_type_id' => $performance_type_id,
							'status_id' => $planning_status_id,
							'notes' => $_POST['performance_planning']['notes'],
							'created_by' => $immediate['user_id']
						);

					$this->db->insert('performance_planning',$planning_info);
					$record_id = $this->db->insert_id();

	                $this->load->model('system_feed');
	                $feed = array(
	                    'status' => 'info',
	                    'message_type' => 'Comment',
	                    'user_id' => $this->user->user_id,
	                    'feed_content' => $feed_content,
	                    'uri' => $this->mod_manage->route . '/edit/'.$record_id,
	                    'recipient_id' => $immediate['user_id']
	                );

	                $recipients = array($immediate['user_id']);
	                $this->system_feed->add( $feed, $recipients );
	            
	                $this->response->notify[] = $immediate['user_id'];

		            $this->load->library('parser');
		            $this->parser->set_delimiters('{{', '}}');	                

                    // email to approver
                    $immediate_target_settings = $immediate['user_id'];
                    $sendtargetsettings['immediate'] = $immediate['alias'];


                    $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-IMMEDIATE') )->row_array();
                    $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                    $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$immediate_target_settings}', '{$subject}', '".$this->db->escape_str($msg)."') ");					            
	        	}
	        }
            
		}*/

        stop:
        if( $transactions )
        {
            if( !$error ){
                $this->db->trans_commit();
            }
            else{
                 $this->db->trans_rollback();
            }
        }

/*		$this->response->message[] = array(
			'message' => 'Successfully Save',
			'type' => 'success'
		);
*/
		$this->_ajax_return();
	}

	function download_file($reminder_id){	
		$reminder_details = $this->db->get_where( 'performance_planning_reminder' , array( 'reminder_id' => $reminder_id ) )->row_array();
		$decoded_url = urldecode($reminder_details['file']);
		$path = base_url() . $reminder_details['file'];

		header('Content-disposition: attachment; filename='.substr( $reminder_details['file'], strrpos( $reminder_details['file'], '/' )+1 ).'');
		header('Content-type: txt/pdf');
		readfile($path);
	}	

	function delete_child()
	{
		$this->_ajax_only();
		
		if( !$this->permission['delete'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		if( !$this->input->post('records') )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'warning'
			);
			$this->_ajax_return();	
		}

		$child_primary_id = 'reminder_id';
		$child_table = 'performance_planning_reminder';
		$records = $this->input->post('child_id');
		$records = explode(',', $records);

		$this->db->where_in($child_primary_id, $records);
		$record = $this->db->get( $child_table )->result_array();

		foreach($record as $rec){
			if($rec['can_delete'] == 1){
				$data['modified_on'] = date('Y-m-d H:i:s');
				$data['modified_by'] = $this->user->user_id;
				$data['deleted'] = 1;

				$this->db->where($child_primary_id, $rec[$child_primary_id]);
				$this->db->update($child_table, $data);
				
				if( $this->db->_error_message() != "" ){
					$this->response->message[] = array(
						'message' => $this->db->_error_message(),
						'type' => 'error'
					);
				}
				else{
					$this->response->message[] = array(
						'message' => lang('common.delete_record', $this->db->affected_rows()),
						'type' => 'success'
					);
				$this->response->record_deleted = 1;
				}
			}else{
				$this->response->message[] = array(
					'message' => 'Record(s) cannot be deleted.',
					'type' => 'warning'
				);
				$this->response->record_deleted = 0;
			}
		}

		$this->_ajax_return();
	}

	function get_appplicable_references() {
		$this->_ajax_only();

		$record_id = $this->input->post('record_id');
		$where = array('planning_id'=>$record_id);
		$applicable_for = $this->db->get_where('performance_planning_applicable', $where)->result_array();
		
		foreach($applicable_for as $index => $value){
			$this->response->applicable_for[] = array(
				'label' => $value['fullname'],
				'value' => $value['user_id']
				);
		}

		$this->_ajax_return();
	}

	public function get_filters(){
		$this->_ajax_only();
		if($this->input->post('record_id') > 0){
			$data = array();

			// $where = array('deleted'=>0);
			switch($this->input->post('record_id')){
				case 1: //company
					$this->db->select('company_id as value,company as label');
					$this->db->order_by('company', '0');
					$this->db->where('deleted', '0');
					$filter_by = $this->db->get('users_company');
				break;
				case 2: //Location
					$this->db->select('location_id as value,location as label');
					$this->db->order_by('location', '0');
					$this->db->where('deleted', '0');
					$filter_by = $this->db->get('users_location');
				break;
				case 3: //Department
					$this->db->select('department_id as value,department as label');
					$this->db->order_by('department', '0');
					$this->db->where('deleted', '0');
					$filter_by = $this->db->get('users_department');
				break;
				case 4: //Division
					$this->db->select('division_id as value,division as label');
					$this->db->order_by('division', '0');
					$this->db->where('deleted', '0');
					$filter_by = $this->db->get('users_division');
				break;
				case 6: //Division
					$this->db->select('job_class_id as value,job_class as label');
					$this->db->order_by('job_class', '0');
					$this->db->where('deleted', '0');
					$filter_by = $this->db->get('users_job_class');
				break;
			}
		}else{
			$this->response->message[] = array(
				'message' => 'Please Select Filter By',
				'type' => 'warning'
				);

		}

		$this->response->filter_id = array();
		if($this->input->post('planning_id') > 0){
			$where = array('deleted'=>0, 'planning_id'=>$this->input->post('planning_id'));
			$planning_data = $this->db->get_where('performance_planning', $where)->row_array();
        	$filter_ids = $planning_data['filter_id'];
        	$this->response->filter_id = explode(',', $filter_ids);
		}

        $this->response->count = $filter_by->num_rows();
        $this->response->selected_filter = 0;
        $this->response->filter_by = "";
        foreach( $filter_by->result() as $filterBy )
        {
        	$selected = '';
        	if(in_array($filterBy->value, $this->response->filter_id) || !($this->input->post('planning_id') > 0) ){
        		$selected = 'selected="selected"';
            	$this->response->selected_filter = 1;
        	}
            $this->response->filter_by .= '<option value="'.$filterBy->value.'" '.$selected.'>'.$filterBy->label.'</option>';
        }

		$this->_ajax_return();
	}

    function get_selection_filters()
    {
        //due to revision 08/01/2021
        $company_id = array();
		$position_classification_id = array();
		$job_grade_id = array();
		$employment_status_id = array();
		$employment_type_id = array();


        $this->_ajax_only();
        $filter_by = $this->input->post('filter_by'); //no use for oclp
        $filter_id = $this->input->post('filter_id'); //no use for oclp
        $employment_status_id = $this->input->post('employment_status_id'); //no use for oclp
        $template_id = $this->input->post('template_id');

        //due to revision 08/01/2021
/*		$template_qry = "SELECT * FROM 
						{$this->db->dbprefix}performance_template
						WHERE template_id = {$template_id}";
		$template = $this->db->query( $template_qry );

		if ($template && $template->num_rows() > 0)
		{
			$company_id = array();
			$position_classification_id = array();
			$job_grade_id = array();
			$employment_status_id = array();
			$employment_type_id = array();

			foreach ($template->result() as $row) {
				$company_id[] = $row->company_id;
				$position_classification_id[] = $row->position_classification_id;
				$job_grade_id[] = $row->job_grade_id;
				$employment_status_id[] = $row->employment_status_id;
				$employment_type_id[] = $row->employment_type_id;
			}

			$company_id = implode(',', $company_id);
			$position_classification_id = implode(',', $position_classification_id);
			$job_grade_id = implode(',', $job_grade_id);
			$employment_status_id = implode(',', $employment_status_id);
			$employment_type_id = implode(',', $employment_type_id);
		}*/

		//due to revision 08/01/2021
		if (!empty($filter_id))
			$company_id = implode(',', $filter_id);

		if (!empty($employment_status_id))
			$employment_status_id = implode(',', $employment_status_id);

		$qry = "SELECT partners.alias, partners.partner_id, partners.user_id
                FROM partners
                INNER JOIN users_profile ON partners.user_id = users_profile.user_id
                INNER JOIN {$this->db->dbprefix}users users ON partners.user_id = users.user_id
                LEFT JOIN {$this->db->dbprefix}partners_personal pp ON partners.partner_id = pp.partner_id AND pp.key = 'job_class'
                LEFT JOIN {$this->db->dbprefix}users_job_class ujc ON pp.key_value = ujc.job_class
                WHERE partners.deleted = 0 AND users.active = 1 
                ";

        if ($filter_by)
        	$qry .= " AND users_profile.company_id IN ({$company_id})";

        if ($position_classification_id)
        	$qry .= " AND partners.position_classification_id IN ({$position_classification_id})";

        if ($employment_type_id)
        	$qry .= " AND partners.employment_type_id IN ({$employment_type_id})";

        if ($job_grade_id)
        	$qry .= " AND partners.job_grade_id IN ({$job_grade_id})";

        if ($employment_status_id)
        	$qry .= " AND partners.status_id IN ({$employment_status_id})";

        $qry .= " ORDER BY partners.alias ASC";

        $employees = $this->db->query( $qry );

		$this->response->filter_id = array();
		if($this->input->post('planning_id') > 0){
			$where = array('planning_id'=>$this->input->post('planning_id'));
			$planning_data = $this->db->get_where('performance_planning_applicable', $where)->result_array();
        	
        	foreach($planning_data as $index => $value){
        		$filter_ids[] = $value['user_id'];
        	}
        	$this->response->filter_id = $filter_ids;
		}

        $this->response->count = $employees->num_rows();
        $this->response->selected_filter = 0;
        $this->response->employees = "";
        foreach( $employees->result() as $employee )
        {   
        	$selected = '';
        	//if(in_array($employee->user_id, $this->response->filter_id) || !($this->input->post('planning_id') > 0) ){
        	if(!empty($filter_ids) && in_array($employee->user_id, $filter_ids)){
        		$selected = 'selected="selected"';
            	$this->response->selected_filter = 1;
        	}
            $data['partner_id_options'][$employee->user_id] = $employee->alias;
            $this->response->employees .= '<option value="'.$employee->user_id.'" '.$selected.'>'.$employee->alias.'</option>';
        }

        // $this->response->filtered_employees = $view['content'];

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

	function _list_options_active( $record, &$rec )
	{
		//add options to close planning
		if(strtolower($record['performance_planning_status_id']) == 'yes'){
			$rec['close_planning'] = $this->mod->url . '/close_planning/' . $record['record_id'];
			$rec['options'] .= '<li><a href="javascript: close_planning('.$record['record_id'].')"><i class="fa fa-lock"></i> '. lang('performance_planning.close_planning') .'</a></li>';
		}else{
			$rec['open_planning'] = $this->mod->url . '/open_planning/' . $record['record_id'];
			$rec['options'] .= '<li><a href="javascript: open_planning('.$record['record_id'].')"><i class="fa fa-unlock"></i> ' . lang('performance_planning.open_planning') . '</a></li>';
		}
		//add options to view users selected in planning
			$this->load->model('performance_planning_admin_model', 'plan_admin');
			$rec['view_users'] = $this->plan_admin->url . '/index/' . $record['record_id'];
			// $rec['options'] .= '<li><a href="javascript: view_users('.$record['record_id'].')"><i class="fa fa-user"></i> View Employees</a></li>';
			$rec['options'] .= '<li><a href="'.$rec['view_users'].'"><i class="fa fa-user"></i> ' . lang('performance_planning.view_emp') . '</a></li>';

		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';

			if ($record['performance_planning_status_id'] == 'No')
				$rec['options'] .= '<li><a href="javascript: copy_record('.$record['record_id'].')"><i class="fa fa-copy"></i> Duplicate</a></li>';
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] )
		{
			$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
			$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
		}
	}

	function count_unapproved_forms()
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

		if( !$this->input->post('planning_id') )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$planning_id = $this->input->post('planning_id');
		$records = explode(',', $planning_id);
		
		//$this->db->where('status_id !=', '4');
		$this->db->where_in('status_id',array(1,2,3,6,11,13));
		$this->db->where_in($this->mod->primary_key, $records);
		$record = $this->db->get( 'performance_planning_applicable' );
		
		$this->response->unapproved_forms_count = $record->num_rows();
		$this->_ajax_return();
	}

/*	status_id = 0 closed
	status_id =  1 open*/
	function save_planning_status()
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

		if( !$this->input->post('planning_id') )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$planning_id = $this->input->post('planning_id');
		$status_id = $this->input->post('status_id');
		// $records = explode(',', $planning_id);

		//if closed planning then save the user info as history due to movement
		if ($status_id == 0)
			$this->mod->save_history_user_info($planning_id);
		//if closed planning then save the user info as history due to movement
		
		$data['status_id'] = $status_id;
		$this->db->where($this->mod->primary_key, $planning_id);
		$this->db->update($this->mod->table, $data);

		$performance_planning_data = $this->db->get_where('performance_planning', array('planning_id' => $planning_id))->row_array();
		$performance_type = $this->db->get_where( 'performance_setup_performance' , array( 'performance_id' => $performance_planning_data['performance_type_id'] ) )->row_array();

		$planning_get_applicable = $this->db->query("SELECT * 
									FROM {$this->db->dbprefix}performance_planning_applicable 
									WHERE planning_id = {$planning_id} 
									AND status_id != 4")->result_array();
        $this->load->model('system_feed');
        if(count($planning_get_applicable) > 0){
			foreach ($planning_get_applicable as $applicable){
				$appraisal_status = ($status_id == 1) ? 'was re-opened' : 'was closed';
	            $feed = array(
	                'status' => 'info',
	                'message_type' => 'Comment',
	                'user_id' => $this->user->user_id,
	                'feed_content' => "{$performance_planning_data['year']} performance planning period for {$performance_planning_data['title']} $appraisal_status.",
	                // 'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'].'/'.$approver->approver_id,
	                'recipient_id' => $applicable['user_id']
	            );

	            $recipients = array($applicable['user_id']);
	            $this->system_feed->add( $feed, $recipients );
	        
	            $this->response->notify[] = $applicable['user_id'];
	        }
        }

        //send to approvers
		$planning_get_approvers = $this->db->query("SELECT * 
									FROM {$this->db->dbprefix}performance_planning_approver 
									WHERE planning_id = {$planning_id} 
									GROUP BY approver_id")->result_array();
		// mysqli_next_result($this->db->conn_id);

        if(count($planning_get_approvers) > 0){
			$appraisal_status = ($status_id == 1) ? 'was re-opened' : 'was closed';
			foreach ($planning_get_approvers as $approver){
	            $feed = array(
	                'status' => 'info',
	                'message_type' => 'Comment',
	                'user_id' => $this->user->user_id,
	                'feed_content' => "{$performance_planning_data['year']} performance planning period for {$performance_planning_data['title']} $appraisal_status.",
	                // 'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'].'/'.$approver->approver_id,
	                'recipient_id' => $approver['approver_id']
	            );

	            $recipients = array($approver['approver_id']);
	            $this->system_feed->add( $feed, $recipients );
	        
	            $this->response->notify[] = $approver['approver_id'];
	    	}
	    }

		if($status_id == 0){
			$status = 'Closed';
		}else{
			$status = 'Opened';
		}

		$this->response->message[] = array(
			'message' => "Planning Successfully $status.",
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	function duplicate()
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

		$to_copy = $this->input->post('record_id');

		$this->db->limit(1);
		$orig_planning = $this->db->get_where('performance_planning', array('planning_id' => $to_copy))->row_array();
		$orig_planning['notes'] = $this->input->post('title');
		$orig_planning['status_id'] = 1;
		$orig_planning['created_by'] == $this->user->user_id;
		unset($orig_planning['planning_id']);


		$this->db->insert('performance_planning', $orig_planning);
		$this->response->record_id = $planning_id = $this->db->insert_id();
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_planning', array(), $orig_planning);

        $this->db->where('deleted',0);
        $this->db->where('planning_id',$to_copy);
        $performance_planning_applicable = $this->db->get('performance_planning_applicable');

		if ($performance_planning_applicable)
		{	
			$performance_type = $this->db->get_where( 'performance_setup_performance' , array( 'performance_id' => $orig_planning['performance_type_id'] ) )->row_array();

			foreach ($performance_planning_applicable->result() as $row) {
				$id = $row->user_id;

            	$performance_populate_approvers = $this->db->query("CALL sp_performance_planning_populate_approvers({$this->response->record_id}, ".$id.", ".$id.")");

            	$applicable_for_insert['planning_id'] = $this->response->record_id;
            	$applicable_for_insert['user_id'] = $id;
            	$applicable_for_insert['to_user_id'] = $id;
            	$applicable_for_insert['template_id'] =  $row->template_id;

				$full_name = $this->db->get_where( 'users' , array( 'user_id' => $id ) )->row_array();
				$applicable_for_insert['fullname'] = $full_name['full_name'];

				$this->db->where($this->mod->primary_key,$this->response->record_id);
				$this->db->where('user_id',$id);
				$planning_applicable = $this->db->get('performance_planning_applicable');
				$send_feeds = 0;

				if ($planning_applicable && $planning_applicable->num_rows() > 0)
				{
					$planning_applicable_info = $planning_applicable->row_array();

					$this->db->where($this->mod->primary_key,$this->response->record_id);
					$this->db->where('user_id',$id);							
					$this->db->update('performance_planning_applicable', $applicable_for_insert);

					if (!$planning_applicable_info['notification_sent'])
						$send_feeds = 1;
				}
				else	
				{
            		$applicable_for_insert['status_id'] = 0;							
					$this->db->insert('performance_planning_applicable', $applicable_for_insert);
					$send_feeds = 1;
				}

				//add feeds if within scope
                if( $send_feeds == 1 )
                {
					$appraisal_status = 'is now open';
                	if(isset($performance_type['for_probi'])){
                		$feed_content = "The performance planning period for your {$orig_planning['title']} $appraisal_status";
                	}else{
                		$feed_content = "The {$orig_planning['year']} performance planning period for {{$orig_planning['title']}} $appraisal_status";
                	}
                    $this->load->model('system_feed');
                    $feed = array(
                        'status' => 'info',
                        'message_type' => 'Comment',
                        'user_id' => $this->user->user_id,
                        'feed_content' => $feed_content,
                        'uri' => $this->mod_individual_planning->route . '/edit/'.$this->response->record_id.'/'.$id,
                        'recipient_id' => $id
                    );

                    $recipients = array($id);
                    $this->system_feed->add( $feed, $recipients );
                
                    $this->response->notify[] = $id;

		            $this->load->library('parser');
		            $this->parser->set_delimiters('{{', '}}');	                

                    // email to employee
                    $employee_info = $this->db->get_where( 'users' , array( 'user_id' => $id ) )->row_array();
                    $sendtargetsettings['appraisee'] = $employee_info['full_name'];


                    $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-EMPLOYEE') )->row_array();
                    $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                    $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$id}', '{$subject}', '".$this->db->escape_str($msg)."') ");					            

					$this->db->where($this->mod->primary_key,$this->response->record_id);
					$this->db->where('user_id',$id);							
					$this->db->update('performance_planning_applicable', array('email_sent' => 1, 'notification_sent' => 1));

    				//$performance_planning_period_email = $this->db->query("CALL sp_performance_planning_period_email( {$planning_year}, {$id}, '{$performance_type['performance']}', {$appraisal_planning_status_id}, '{$performance_type['for_probi']}' )");
					//mysqli_next_result($this->db->conn_id);						                        
                }						
			}
		}


        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return(); 
	}
}