<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Movement_admin extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('movement_admin_model', 'mod');
		parent::__construct();
        $this->load->model('movement_manage_model', 'mvm');
        $this->load->model('movement_admin_model', 'mva');		
        $this->load->model('movement_model', 'mv');	
	}

	function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

        $user_setting = APPPATH . 'config/users/'. $this->user->user_id .'.php';
        $user_id = $this->user->user_id;
        $this->load->config( "users/{$user_id}.php", false, true );
        $user = $this->config->item('user');

        $this->load->config( 'roles/'. $user['role_id'] .'/permission.php', false, true );
        $permission = $this->config->item('permission');
		        
		$this->db->order_by('type', 'asc');
		$partners_movement_type = $this->db->get_where('partners_movement_type', array('deleted' => 0));
		$data['partners_movement_type'] = $partners_movement_type->result();

		$this->db->order_by('status', 'asc');
		$this->db->where_in('status_id',array(1,8,9,10,11,12));
		$partners_movement_status = $this->db->get('partners_movement_status');
		$data['partners_movement_status'] = $partners_movement_status->result();

		$this->db->order_by('cause', 'asc');
		$partners_movement_cause = $this->db->get_where('partners_movement_cause', array('deleted' => 0));
		$data['partners_movement_cause'] = $partners_movement_cause->result();

        $data['movement'] = 0; //isset($this->permission['list']) ? $this->permission['list'] : 0;
        $data['movement_manage'] = 0; //isset($permission[$this->mvm->mod_code]['list']) ? $permission[$this->mvm->mod_code]['list'] : 0;
        $data['movement_admin'] = isset($permission[$this->mva->mod_code]['list']) ? $permission[$this->mva->mod_code]['list'] : 0;

		$this->load->vars( $data );
		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}	

	public function single_upload()
	{
		$this->_ajax_only();
		define('UPLOAD_DIR', 'uploads/movement/');
		$this->load->library("UploadHandler");
		$files = $this->uploadhandler->post();
		$file = $files[0];
	    $file->clas = date('hhmmss');		
		if( isset($file->error) && $file->error != "" )
		{
			$this->response->message[] = array(
				'message' => $file->error,
				'type' => 'error'
			);	
		}

	    $html = '<tr class="template-download">
	    	<input type="hidden" name="partners_movement_action[photo][]" value="'.$file->url.'"/>
	    	<input type="hidden" name="partners_movement_action[type][]" value="'.(isset($file->thumbnailUrl) ? 'img' : 'file').'"/>
	    	<input type="hidden" name="partners_movement_action[filename][]" value="'.$file->name.'"/>
	    	<input type="hidden" name="partners_movement_action[size][]" value="'.$file->size.'"/>
	        <td>
	            <p class="name">
					<span>'.$file->name.'</span>';
	            $html .= '</p>';
	            if (isset($file->error)) {
	                $html .= '<div><span class="label label-danger">Error</span>'.$file->error.'</div>';
	            }
	        $html .= '</td>
	        <td>
	            <span class="size">'.$file->size.'</span>
	        </td>
	        <td>
	        	<a data-dismiss="fileupload" class="btn red delete_attachment">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
	        	</a>
	        </td>
	    </tr>';

		$this->response->file = $file;
		$this->response->html = $html;
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
			$this->response->list .= $this->load->blade('list_template', $record, true)->with( $this->load->get_cached_vars() );
		}
	}

	function _list_options_active( $record, &$rec )
	{
		//temp remove until view functionality added
		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';

			if($record['partners_movement_status_id'] > 3){
				$rec['options'] .= '<li><a href="javascript: ajax_export('.$record['record_id'].')"><i class="fa fa-print"></i> Print</a></li>';
			}			
		}

		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] && $record['partners_movement_status_id'] != 3)
		{	
			if(isset($record['can_delete']) && $record['can_delete'] == 1){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}elseif(isset($record['can_delete']) && $record['can_delete'] == 0){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a disabled="disabled" style="color:#B6B6B4" onclick="return false" href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}else{
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}
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
				if( $filter_value != "" ) {
					if($filter_by_key == "type_id"){
						$filter_by_key = 'ww_partners_movement_action.type_id';
						$filter .= " AND FIND_IN_SET( {$filter_value}, {$filter_by_key} ) ";
					}elseif ($filter_by_key == "status_id") {
						$filter_by_key = 'ww_partners_movement.status_id';
						$filter .= " AND FIND_IN_SET( {$filter_value}, {$filter_by_key} ) ";						
					}else{
						$filter .= ' AND '. $filter_by_key .' = "'.$filter_value.'"';
					}	
				}
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
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

	public function add( $record_id = '', $child_call = false )
	{
		if( !$this->permission['add'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call, true );
	}

	public function edit( $record_id = '', $child_call = false )
	{
		if( !$this->permission['add'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call );
	}

	function _edit( $child_call, $new = false )
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
			$result = $this->mod->_get( 'edit', $this->record_id );
			if( $new )
			{
				$field_lists = $result->list_fields();
				foreach( $field_lists as $field )
				{
					$data['record'][$field] = '';
				}
					$data['record']['movement_count'] = 0;
					$data['movement_details'] = array();
			}
			else{
				$record = $result->row_array();
				foreach( $record as $index => $value )
				{
					$record[$index] = trim( $value );	
				}
				$data['record'] = $record;
				$data['movement_details'] = $this->mod->get_movement_details($this->record_id);
				$data['movement_approver_hr'] = $this->mod->get_approver_hr($this->record_id);
				$data['record']['movement_count'] = count($data['movement_details']);
			}

			$data['user_id'] = $this->user->user_id;

			$data['approver_list'] = $this->mvm->get_approver_list($this->record_id);

			$data['hr_approver_list'] = $this->mvm->get_hr_approver_list($this->record_id);

			$hr_approver_remarks = '';
			if (!empty($data['hr_approver_list'])) {
				foreach ($data['hr_approver_list'] as $key => $value) {
					if ($value['approver_id'] == $this->user->user_id)
						$hr_approver_remarks = $value['comment'];
				}
			}

			$data['hr_approver_remarks'] = $hr_approver_remarks;

			$data['qry_category'] = $this->mod->get_role_category();

			$action_movement_attachment = array();
			if (isset($record['partners_movement_action.action_id']))
				$action_movement_attachment = $this->mod->get_action_movement_attachment($record['partners_movement_action.action_id']);

			$data['record']['attachement'] = $action_movement_attachment;

			$hr_movement = $this->mod->get_role_permission(22);

			if (count($hr_movement) > 0){
				$this->db->where_in('role_id',$hr_movement);
				$this->db->where('active',1);
				$this->db->where('deleted',0);  			
				$hr_admin_result = $this->db->get('users');
			}

			$data['hr_admin_movement_profile'] = $hr_admin_result;

			$movement_from = 0;
			if (isset($record['partners_movement.movement_from']))
				$movement_from = $record['partners_movement.movement_from'];
			else
				$movement_from = 3;

			$data['movement_from'] = $movement_from;
			
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

	public function detail( $record_id, $child_call = false )
	{
		if( !$this->permission['detail'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_detail( $child_call );
	}

	private function _detail( $child_call, $new = false )
	{
		$record_check = false;
		$this->record_id = $data['record_id'] = '';	

		if( !$new )
		{
			if( !$this->_set_record_id() )
			{
				echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
				die();
			}

			$this->record_id = $data['record_id'] = $_POST['record_id'];
		}

		$this->record_id = $data['record_id'] = $_POST['record_id'];
		
		$record_check = $this->mod->_exists( $this->record_id );
		if( $new || $record_check === true )
		{
			$result = $this->mod->_get( 'detail', $this->record_id );
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

			$this->record = $data['record'];

			$data['movement_details'] = $this->mod->get_movement_details($this->record_id);

			$data['movement_approver_remarks'] = $this->mvm->get_approver_remarks($this->record_id);

			$data['user_id'] = $this->user->user_id;

			$data['approver_list'] = $this->mvm->get_approver_list($this->record_id);

			$data['hr_approver_list'] = $this->mvm->get_hr_approver_list($this->record_id);

			$action_movement_attachment = array();
			if (isset($record['partners_movement_action.action_id']))
				$action_movement_attachment = $this->mod->get_action_movement_attachment($record['partners_movement_action.action_id']);

			$data['record']['attachement'] = $action_movement_attachment;

			$this->load->vars( $data );

			if( !$child_call ){
				$this->load->helper('form');
				$this->load->helper('file');
				echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
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


	function save_movement(){

		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post['record_id'];
		unset( $post['record_id'] );

		$validation_rules = array();

		$validation_rules[] = 
		array(
			'field' => 'partners_movement[due_to_id]',
			'label' => 'Due To',
			'rules' => 'required'
			);

		$validation_rules[] = 
		array(
			'field' => 'partners_movement_action[type_id]',
			'label' => 'Type',
			'rules' => 'required'
			);

		$validation_rules[] = 
		array(
			'field' => 'partners_movement_action[effectivity_date]',
			'label' => 'Effective',
			'rules' => 'required'
			);
		$validation_rules[] = 
		array(
			'field' => 'partners_movement_action[user_id]',
			'label' => 'Partner',
			'rules' => 'required'
			);
		switch ($post['partners_movement_action']['type_id']){
			case 1://Regularization
			case 3://Promotion
			case 8://Transfer
			case 9://Employment Status
			case 12://Temporary Assignment
			$error_val = false;
			$count_values = array_count_values($post['partners_movement_action_transfer']['to_name']);
			if(!(count($count_values)>1)){
				$error_val = true;
	            $this->response->message[] = array(
	                'message' => 'Please change at least one field.',
	                'type' => 'warning'
	                );
	            $this->_ajax_return();
			}
			if($post['partners_movement_action']['type_id'] == 12){
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_transfer[end_date]',
					'label' => 'End Date of Temporary Assignment',
					'rules' => 'required'
					);
				$transfer_end_date = $post['partners_movement_action_transfer']['end_date'];
				unset($post['partners_movement_action_transfer']['end_date']);
			}
			break;
			case 2://Salary Increase
			case 18://Salary Alignment
			case 4://Wage Order
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_compensation[to_salary]',
					'label' => 'New Salary',
					'rules' => 'required'
					);
			break;
			case 6://Resignation
			case 7://Termination
			break;
			case 10://End Contract
			case 11://Retirement
/*				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_moving[end_date]',
					'label' => 'End Date',
					'rules' => 'required'
					);*/
			break;
			case 15://extension
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_extension[no_of_months]',
					'label' => 'Months',
					'rules' => 'numeric'
					);
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_extension[end_date]',
					'label' => 'End Date',
					'rules' => 'required'
					);
				//end date
			break;
			case 17://Developmental Assignment
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_extension[no_of_months]',
					'label' => 'Months',
					'rules' => 'numeric'
					);
				$validation_rules[] = 
				array(
					'field' => 'partners_movement_action_extension[end_date]',
					'label' => 'End Date',
					'rules' => 'required'
					);
				//end date
			break;
		}

		if( sizeof( $validation_rules ) > 0 )
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules( $validation_rules );
			if ($this->form_validation->run() == false)
			{
				foreach( $this->form_validation->get_error_array() as $f => $f_error )
				{
					$this->response->message[] = array(
						'message' => $f_error,
						'type' => 'warning'
						);  
				}

				$this->_ajax_return();
			}
		}

        /***** END Form Validation (hard coded) *****/
        //SAVING START 
		$now = date('Y-m-d h:i:s');  
		$transactions = true;
		$this->partner_id = 0;
		if( $transactions )
		{
			$this->db->trans_begin();
		}

		//start saving with main table
		$to_insert_hr_approver = false;
		if (isset($post[$this->mod->table])) {
			$main_record = $post[$this->mod->table];	
			if($post['save_from'] == 3){ //status_id	
				$to_insert_hr_approver = true;
				if (count($post['hr_approver']) < 1){				
					$main_record['status_id'] = 3;
				}
				else{
					$main_record['status_id'] = 9;
					$post['save_from'] = 9;  // if there is assign final approver for hr	
				}
			}	

			$record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $this->record_id ) );

			$previous_main_data = array();

			switch( true )
			{				
				case $record->num_rows() == 0:
					$main_record['created_on'] = date('Y-m-d H:i:s');
					$main_record['created_by'] = $this->user->user_id;
					$this->db->insert($this->mod->table, $main_record);
					if( $this->db->_error_message() == "" )
					{
						$this->response->record_id = $this->record_id = $this->db->insert_id();
					}
					$this->response->action = 'insert';
					break;
				case $record->num_rows() == 1:
					$previous_main_data = $this->db->get_where($this->mod->table, array($this->mod->primary_key => $this->record_id))->row_array();

					$main_record['modified_on'] = date('Y-m-d H:i:s');
					$main_record['modified_by'] = $this->user->user_id;
					$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $this->record_id ) );
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

			// save as draft save approver for hr
			if ($post['save_from'] == '' || $to_insert_hr_approver){
				if (isset($post['hr_approver']) && count($post['hr_approver']) > 0){
					$ctr = 1;
					foreach ($post['hr_approver'] as $key => $value) {			
						if ($value != 0 && $value != ''){
							$this->db->where('movement_id',$this->record_id);
							$this->db->where('user_id',$value);
							$result = $this->db->get('partners_movement_approver_hr');
							$hr_approver_info = array(
															'movement_id' => $this->record_id,
															'user_id' => $value,
															'sequence' => $ctr,
															'movement_status_id' => 1,
														);
							if ($result && $result->num_rows() > 0) {
								$this->db->where('movement_id',$this->record_id);
								$this->db->where('user_id',$value);								
								$this->db->update('partners_movement_approver_hr',$hr_approver_info);
							} else {
								$this->db->insert('partners_movement_approver_hr',$hr_approver_info);
							}
							$ctr++;							
						}
					}
				}
								
				$hr_approver_comment = (isset($_POST['partners_movement_approver_hr']['remarks']) ? $_POST['partners_movement_approver_hr']['remarks'] : '');
				$this->db->where('movement_id',$this->record_id);
				$this->db->where('user_id',$this->user->user_id);								
				$this->db->update('partners_movement_approver_hr',array('comment' => $hr_approver_comment));				
			}
			// save as draft save approver for hr

			if( $this->db->_error_message() != "" ){
				$this->response->message[] = array(
					'message' => $this->db->_error_message(),
					'type' => 'error'
				);
				$error = true;
				goto stop;
			}

			if (isset($post['type_category_id'])){
				$this->db->update('partners_movement_action', array('type_category_id' => $post['type_category_id']), array( 'movement_id' => $this->record_id ) );
			}


			//partners_movement_action
			$movement_action = $post['partners_movement_action'];	

			$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $this->mod->table, $previous_main_data, $main_record, $movement_action['user_id']);

			$attachement = (isset($movement_action['photo']) ? $movement_action['photo'] : array());
			$filename = (isset($movement_action['filename']) ? $movement_action['filename'] : array());
			$type = (isset($movement_action['type']) ? $movement_action['type'] : array());
			$size = (isset($movement_action['size']) ? $movement_action['size'] : array());
			unset($movement_action['photo']);
			unset($movement_action['filename']);
			unset($movement_action['type']);
			unset($movement_action['size']);		
			$movement_action['movement_id'] =  $this->response->record_id;
			$movement_action['effectivity_date'] = date('Y-m-d', strtotime($movement_action['effectivity_date']));	
			$record = $this->db->get_where('partners_movement_action', array( 'action_id' => $movement_action['action_id'] ) );
			$this->response->action_id = $this->action_id = $movement_action['action_id'];	

			$previous_main_data = array();

			switch( true )
			{				
				case $record->num_rows() == 0:
					$movement_action['created_on'] = date('Y-m-d H:i:s');
					$movement_action['created_by'] = $this->user->user_id;
					//status_id
					$this->db->insert('partners_movement_action', $movement_action);
					if( $this->db->_error_message() == "" )
					{
						$this->response->action_id = $this->action_id = $this->db->insert_id();	
					}
					$this->response->action = 'insert';
					break;
				case $record->num_rows() == 1:
					$previous_main_data = $this->db->get_where('partners_movement_action', array('action_id' => $movement_action['action_id']))->row_array();

					$movement_action['modified_on'] = date('Y-m-d H:i:s');
					$movement_action['modified_by'] = $this->user->user_id;
					$this->db->update( 'partners_movement_action', $movement_action, array( 'action_id' => $movement_action['action_id'] ) );
					$this->response->action = 'update';
					$this->response->action_id = $movement_action['action_id'];
					break;
				default:
					$this->response->message[] = array(
						'message' => lang('common.inconsistent_data'),
						'type' => 'error'
					);
					$error = true;
					goto stop;
			}

			$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, 'partners_movement_action', $previous_main_data, $movement_action, $movement_action['user_id']);

			// save movement attachement multiple
			if (!empty($attachement)){
				$this->db->where('movement_id',$this->response->record_id);
				$this->db->where('action_id',$this->action_id);
				$this->db->delete('partners_movement_action_attachment');

				foreach ($attachement as $key => $value) {
					$info = array(
								'action_id' => $this->action_id,
								'movement_id' => $this->response->record_id,
								'photo' => $value,
								'type' => $type[$key],
								'filename' => $filename[$key],
								'size' => $size[$key]
							);

					$this->db->insert('partners_movement_action_attachment',$info);
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

			$movement_details = array();
			$not_transfer = true;
			switch ($movement_action['type_id']){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignment
					$movement_details = $post['partners_movement_action_transfer'];
					$transfer_record['action_id'] = $this->action_id;
					$transfer_record['movement_id'] = $this->response->record_id;
					//delete transfer details
					$this->db->where('action_id', $this->action_id);
					$this->db->delete('partners_movement_action_transfer'); 
					foreach ($movement_details['to_name'] as $to_index => $to_name){
						if($to_name != ''){
							$transfer_record['field_id'] = $movement_details['field_id'][$to_index];
							$transfer_record['field_name'] = $movement_details['field_name'][$to_index];
							$transfer_record['from_id'] = $movement_details['from_id'][$to_index];
							$transfer_record['from_name'] = $movement_details['from_name'][$to_index];
							$transfer_record['to_id'] = $movement_details['to_id'][$to_index];
							$transfer_record['to_name'] = $movement_details['to_name'][$to_index];
							$this->db->insert('partners_movement_action_transfer', $transfer_record);
						}
					}
					if($movement_action['type_id'] == 12){ //temporary assignment
						$transfer_record['field_id'] = 11;
						$transfer_record['field_name'] = 'end_date';
						$transfer_record['to_name'] = $transfer_end_date;
						$this->db->insert('partners_movement_action_transfer', $transfer_record);
					}
					$not_transfer = false;	
					break;
				case 2://Salary Increase
				case 18://Salary Alignmenta
				case 4://Wage Order
					$movement_details = array();
					if (isset($post['partners_movement_action_compensation']))
						$movement_details = $post['partners_movement_action_compensation'];

					if (isset($movement_details['current_salary']) && $movement_details['current_salary'] != ''){
						$movement_details['current_salary'] = str_replace(',','',$movement_details['current_salary']);
					}
					if (isset($movement_details['to_salary']) && $movement_details['to_salary'] != ''){
						$movement_details['to_salary'] = str_replace(',','',$movement_details['to_salary']);
					}						
					$movement_details['action_id'] = $this->action_id;
					$movement_details['movement_id'] = $this->response->record_id;
					$movement_details_table = 'partners_movement_action_compensation';
					break;
				case 6://Resignation
				case 7://Termination
				case 10://End Contract
				case 11://Retirement
					if (isset($post['partners_movement_action_moving'])) {
						$movement_details = $post['partners_movement_action_moving'];
						$movement_details['action_id'] = $this->action_id;
						$movement_details['movement_id'] = $this->response->record_id;
						$movement_details['end_date'] = date('Y-m-d', strtotime($movement_action['effectivity_date']));
						$movement_details['blacklisted'] = (isset($movement_details['blacklisted']) ? $movement_details['blacklisted'] : '');
						$movement_details['eligible_for_rehire'] = (isset($movement_details['eligible_for_rehire']) ? $movement_details['eligible_for_rehire'] : '');
					} else {
						$movement_details['id'] = 0;
						$movement_details['action_id'] = $this->action_id;
						$movement_details['movement_id'] = $this->response->record_id;
						$movement_details['end_date'] = date('Y-m-d', strtotime($movement_action['effectivity_date']));						
					}
					$movement_details_table = 'partners_movement_action_moving';					
					break;
				case 15://extension
					if (isset($post['partners_movement_action_extension'])) {
						$movement_details = $post['partners_movement_action_extension'];
						$movement_details['action_id'] = $this->action_id;
						$movement_details['movement_id'] = $this->response->record_id;
						$movement_details['end_date'] = date('Y-m-d', strtotime($movement_details['end_date']));
						$movement_details_table = 'partners_movement_action_extension';
					}
					break;
				case 17://Developmental Assignment
					if (isset($post['partners_movement_action_extension'])) {
						$movement_details = $post['partners_movement_action_extension'];
						$movement_details['action_id'] = $this->action_id;
						$movement_details['movement_id'] = $this->response->record_id;
						$movement_details['end_date'] = date('Y-m-d', strtotime($movement_details['end_date']));
						$movement_details_table = 'partners_movement_action_extension';
					}
					break;
				case 19://Temporary Assignment
					$movement_details = $post['partners_movement_action_additional_allowance'];

					$transfer_record['action_id'] = $this->action_id;
					$transfer_record['movement_id'] = $this->response->record_id;
					//delete transfer details
					$this->db->where('action_id', $this->action_id);
					$this->db->delete('partners_movement_action_additional_allowance'); 

					$previous_main_data = array();

					foreach ($movement_details['to_allowance'] as $to_index => $to_allowance){
						if($to_allowance != ''){
							$this->db->where('transaction_id',$movement_details['transaction_id'][$to_index]);
							$payroll_transaction = $this->db->get('payroll_entry_recurring');
							if (!$payroll_transaction || $payroll_transaction->num_rows() == 0){
					            $this->response->message[] = array(
					                'message' => 'Please create "'.$movement_details['transaction_label'][$to_index].'" for payroll recurring.',
					                'type' => 'warning'
					                );
					            $this->_ajax_return();
								$error = true;
								goto stop;
							}

							$transfer_record['transaction_id'] = $movement_details['transaction_id'][$to_index];
							$transfer_record['transaction_label'] = $movement_details['transaction_label'][$to_index];
							if (isset($movement_details['from_allowance'][$to_index]) && $movement_details['from_allowance'][$to_index] != ''){
								$transfer_record['from_allowance'] = str_replace(',','',$movement_details['from_allowance'][$to_index]);
							}
							if (isset($movement_details['to_allowance'][$to_index]) && $movement_details['to_allowance'][$to_index] != ''){
								$transfer_record['to_allowance'] = str_replace(',','',$movement_details['to_allowance'][$to_index]);
							}
							$this->db->insert('partners_movement_action_additional_allowance', $transfer_record);

							$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'partners_movement_action_additional_allowance', $previous_main_data, $transfer_record);
						}
					}
					$not_transfer = false;	
					break;						
			}

			//partners_movement details	
			if($not_transfer == true){
				if (isset($movement_details['id'])) {
					$record = $this->db->get_where($movement_details_table, array( 'id' => $movement_details['id'] ) );
					switch( true )
					{				
						case $record->num_rows() == 0:
							//status_id
							$this->db->insert($movement_details_table, $movement_details);
							if( $this->db->_error_message() == "" )
							{
								$this->response->id = $this->id = $this->db->insert_id();
							}
							$this->response->action = 'insert';
							break;
						case $record->num_rows() == 1:
							$this->db->update( $movement_details_table, $movement_details, array( 'id' => $movement_details['id'] ) );
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

			if($post['save_from'] == 3){
	            //Get current user fullname
	            $current_user = array();
	            $current_user = $this->db->get_where('users',array('user_id' => $this->session->userdata['user']->user_id))->row();

	            $movement_creator = $this->db->get_where('partners_movement_action',array('movement_id' => $this->record_id));
	            if ($movement_creator){
	            	$movement_creator_row = $movement_creator->row();
		            $this->db->where('deleted',0);
		            $this->db->where('user_id',$movement_creator_row->created_by);
		            $users_creator = $this->db->get('users');

		            if ($users_creator && $users_creator->num_rows() > 0){
		            	$users_creator_row = $users_creator->row_array();

			            $notif_message  = 'Filed movement has been approved by HR';
			            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
			            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
			            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
			            $data['recipient_id']   = $users_creator_row['user_id'];                                                               // TO WHOM THIS POST IS INTENDED TO
			            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
			            $data['message_type']   = 'Movement';    
			            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING
			            $latest = $this->mvm->newPostData($data,$this->mv->url);		            	
		            }	            	
	            }

	            $this->db->where('partners_movement_approver.movement_id',$this->record_id);
	            $this->db->join('users','partners_movement_approver.user_id = users.user_id');
	            $movement_approver = $this->db->get('partners_movement_approver');
	            if ($movement_approver && $movement_approver->num_rows() > 0){
	            	foreach ($movement_approver->result() as $row_involved) {
			            $notif_message  = 'Filed movement has been approved by HR';
			            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
			            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
			            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
			            $data['recipient_id']   = $row_involved->user_id;                                                               // TO WHOM THIS POST IS INTENDED TO
			            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
			            $data['message_type']   = 'Movement';    
			            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING

			            // ADD NEW DATA FEED ENTRY
			            $latest = $this->mvm->newPostData($data,$this->mvm->url);
	            	}
	            }

	            //email approver
				$sp_partners_movements = $this->db->query('Call `sp_partners_movement_email_hr_approved`('.$this->record_id.',"approved")');	            
				mysqli_next_result($this->db->conn_id);
				
	            //applied movement changes	
				$sp_partners_movements = $this->db->query('Call `sp_partners_movements`()');
				mysqli_next_result($this->db->conn_id);
				if( $this->db->_error_message() != "" )
				{
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
		if( $transactions )
		{
			if( !$error ){
				$this->db->trans_commit();
			}
			else{
				 $this->db->trans_rollback();
			}
		}

		if (isset($post[$this->mod->table])) {
			if($post['save_from'] == 9){
	            //Get current user fullname
	            $current_user = array();
	            $current_user = $this->db->get_where('users',array('user_id' => $this->session->userdata['user']->user_id))->row();

	            $this->db->update('partners_movement', array('hr_reviewed_by' => $this->session->userdata['user']->user_id), array( 'movement_id' => $this->record_id ) );

				$this->db->update('partners_movement_approver_hr', array('movement_status_id' => 9), array( 'movement_id' => $this->record_id, 'sequence' => 1 ) );

	            $movement_first_hr_approver = $this->db->get_where('partners_movement_approver_hr',array('movement_id' => $this->record_id, 'sequence' => 1));
	            if ($movement_first_hr_approver){
	            	$movement_first_hr_approver_row = $movement_first_hr_approver->row();
		            $this->db->where('deleted',0);
		            $this->db->where('user_id',$movement_first_hr_approver_row->user_id);
		            $users_creator = $this->db->get('users');

		            if ($users_creator && $users_creator->num_rows() > 0){
		            	$users_creator_row = $users_creator->row_array();

			            $notif_message  = 'Filed movement has been validated by HR and for your approval';
			            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
			            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
			            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
			            $data['recipient_id']   = $users_creator_row['user_id'];                                                               // TO WHOM THIS POST IS INTENDED TO
			            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
			            $data['message_type']   = 'Movement';    
			            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING
			            $latest = $this->mod->newPostData($data,$this->mod->url);		

						$sp_time_forms_email_hr_validation = $this->db->query("CALL sp_partners_movement_email_hr_approval({$this->record_id}, {$users_creator_row['user_id']},'validated')");
						mysqli_next_result($this->db->conn_id);			                        	
		            }	            	
	            }
			}

			if($post['save_from'] == 11){
				$to_change_movement_status_id = false;
				$approver_hr_remarks = (isset($_POST['partners_movement_approver_hr']['remarks']) ? $_POST['partners_movement_approver_hr']['remarks'] : '');

				$this->db->where('movement_id',$this->record_id);
				$this->db->where('user_id',$this->user->user_id);
				$this->db->where('movement_status_id',9);
				$result_check = $this->db->get('partners_movement_approver_hr');

				if ($result_check && $result_check->num_rows() > 0){				
					$this->db->update('partners_movement_approver_hr', array('movement_status_id' => 11, 'comment' => $approver_hr_remarks,'comment_date' => $now), array( 'movement_id' => $this->record_id, 'user_id' => $this->user->user_id, 'movement_status_id' => 9 ) );
					$to_change_movement_status_id = true;
				}

				$this->db->where('movement_id',$this->record_id);
				$this->db->where('movement_status_id',1);
				$this->db->order_by('sequence');
				$check_hr_approver = $this->db->get('partners_movement_approver_hr');

				if ($check_hr_approver && $check_hr_approver->num_rows() > 0){
					$rec = $check_hr_approver->row();

					$this->db->update('partners_movement_approver_hr', array('movement_status_id' => 9), array( 'approver_hr_id' => $rec->approver_hr_id ) );

		            //Get current user fullname
		            $current_user = array();
		            $current_user = $this->db->get_where('users',array('user_id' => $this->session->userdata['user']->user_id))->row();

		            $this->db->where('deleted',0);
		            $this->db->where('user_id',$rec->user_id);
		            $users_creator = $this->db->get('users');

		            if ($users_creator && $users_creator->num_rows() > 0){
		            	$users_creator_row = $users_creator->row_array();

			            $notif_message  = 'Filed movement has been approved by HR and for your next approval';
			            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
			            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
			            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
			            $data['recipient_id']   = $users_creator_row['user_id'];                                                               // TO WHOM THIS POST IS INTENDED TO
			            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
			            $data['message_type']   = 'Movement';    
			            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING
			            $latest = $this->mod->newPostData($data,$this->mod->url);	

						$sp_time_forms_email_hr_validation = $this->db->query("CALL sp_partners_movement_email_hr_approval({$this->record_id}, {$users_creator_row['user_id']},'approved')");
						mysqli_next_result($this->db->conn_id);			            	            	
		            }	

					$movement_status_id = 10;

					$this->db->update('partners_movement', array('status_id' => $movement_status_id), array( 'movement_id' => $this->record_id ) );
				}
				else{
					if ($to_change_movement_status_id){
						$this->db->update('partners_movement_approver_hr', array('movement_status_id' => 11, 'comment' => $approver_hr_remarks, 'comment_date' => $now), array( 'movement_id' => $this->record_id, 'user_id' => $this->user->user_id ) );
						$this->db->update('partners_movement_action', array('status_id' => 11), array( 'action_id' => $this->response->action_id) );

						$current_user = $this->db->get_where('users',array('user_id' => $this->session->userdata['user']->user_id))->row();

			            $movement_creator = $this->db->get_where('partners_movement_action',array('movement_id' => $this->record_id));
			            if ($movement_creator){
			            	$movement_creator_row = $movement_creator->row();
				            $this->db->where('deleted',0);
				            $this->db->where('user_id',$movement_creator_row->user_id);
				            $users_creator = $this->db->get('users');

				            if ($users_creator && $users_creator->num_rows() > 0){
				            	$users_creator_row = $users_creator->row_array();

					            $notif_message  = 'Filed movement has been final approved by HR';
					            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
					            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
					            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
					            $data['recipient_id']   = $users_creator_row['user_id'];                                                               // TO WHOM THIS POST IS INTENDED TO
					            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
					            $data['message_type']   = 'Movement';    
					            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING
					            $latest = $this->mvm->newPostData($data,$this->mv->url);		            	
				            }	            	
			            }

			            $this->db->where('partners_movement_approver.movement_id',$this->record_id);
			            $this->db->join('users','partners_movement_approver.user_id = users.user_id');
			            $movement_approver = $this->db->get('partners_movement_approver');
			            if ($movement_approver && $movement_approver->num_rows() > 0){
			            	foreach ($movement_approver->result() as $row_involved) {
					            $notif_message  = 'Filed movement has been final approved by HR';
					            $data['user_id']        = $current_user->user_id;                                					// THE CURRENT LOGGED IN USER 
					            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
					            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
					            $data['recipient_id']   = $row_involved->user_id;                                                               // TO WHOM THIS POST IS INTENDED TO
					            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
					            $data['message_type']   = 'Movement';    
					            $data['movement_id'] 	= $this->record_id;                                                               // DANGER, INFO, SUCCESS & WARNING

					            // ADD NEW DATA FEED ENTRY
					            $latest = $this->mvm->newPostData($data,$this->mvm->url);
			            	}
			            }	

						// insert into clearance
						$movement_action_id = 0;
						$movement_action_info = array();
						$this->db->where('partners_movement.movement_id',$this->record_id);
						$this->db->where('partners_movement.deleted',0);
						$this->db->join('partners_movement','partners_movement_action.movement_id = partners_movement.movement_id');
						$movement_action = $this->db->get_where('partners_movement_action');
						if ($movement_action && $movement_action->num_rows() > 0){
							$movement_action_info = $movement_action->row_array();
							$movement_action_id = $movement_action_info['action_id'];
						}

						if( in_array( $movement_action_info['type_id'], array(6,7,10,11) ) ) {
							$clearance_table = 'partners_clearance';
							$clearance_record = $this->db->get_where( $clearance_table, array( 'action_id' =>$movement_action_id ) );
							$clearance_data = array();
							switch( true )
							{				
								case $clearance_record->num_rows() == 0:
									$user_records = $this->db->get_where( 'users_profile', array( 'user_id' => $movement_action_info['user_id'] ) )->row_array();
									$clearance_data['partner_id'] = $user_records['partner_id'];
									$clearance_data['action_id'] = $movement_action_id;
									$clearance_data['created_by'] = $this->user->user_id;
									$clearance_data['effectivity_date'] = date('Y-m-d', strtotime($movement_action_info['effectivity_date']));	
									$this->db->insert($clearance_table, $clearance_data);
									if( $this->db->_error_message() == "" )
									{
										$this->response->clearance_id = $this->db->insert_id();
									}else{
										$error = true;
										goto stop;
									}
									// $this->response->action = 'insert';
									break;
								case $record->num_rows() == 1:
									$this->db->update( $clearance_table, $clearance_data, array( 'action_id' => $movement_action_id ) );
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
						}	

						$this->db->where('movement_id',$this->record_id);
						$this->db->where('user_id',$this->user->user_id);
						$this->db->where('movement_status_id <',11);
						$result_check = $this->db->get('partners_movement_approver_hr');
						if (!$result_check || $result_check->num_rows() == 0){
							$this->db->update('partners_movement', array('status_id' => 11), array( 'movement_id' => $this->record_id ) );						
						}

			            //email approver
						$sp_partners_movements = $this->db->query('Call `sp_partners_movement_email_hr_approved`('.$this->record_id.',"approved")');	            
						mysqli_next_result($this->db->conn_id);
						
			            //applied movement changes	
						$sp_partners_movements = $this->db->query('Call `sp_partners_movements`()');
						mysqli_next_result($this->db->conn_id);
						
						if( $this->db->_error_message() != "" )
						{
							$this->response->message[] = array(
								'message' => $this->db->_error_message(),
								'type' => 'error'
							);
							
							$error = true;
							goto stop;
						}							
					}
				}
			}
			else if($post['save_from'] == 12){
				$this->db->update('partners_movement_approver_hr', array('movement_status_id' => 12, 'comment_date' => $now), array( 'movement_id' => $this->record_id, 'user_id' => $this->user->user_id, 'movement_status_id' => 9 ) );

					$data = array( 'status_id' => 12 ); // set status to 'For HR Declined'
					$this->db->update( 'partners_movement', $data, array('movement_id' => $this->record_id) );

				//$movement_info  = $this->mod->get_movement_header($this->input->post('record_id'));
				//$this->mod->transfer_to_validation($movement_info);

	            //email approver
/*				$sp_partners_movements = $this->db->query('Call `sp_partners_movement_email_hr_approved`('.$this->record_id.',"disapproved")');	            
				mysqli_next_result($this->db->conn_id);	*/			
			}
		}

		if( !$error  )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }

	function get_employee_details(){
		$this->_ajax_only();

		$user_id = $this->input->post('user_id');
		$this->response->partner_info = $this->mod->get_employee_details($user_id);
		$this->response->retrieved_partners = true;

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

        $this->_ajax_return();
	}

	function get_employee_allowance_details(){
		$this->_ajax_only();

		$user_id = $this->input->post('user_id');
		$this->response->allowance_info = $this->mod->get_employee_allowance_details($user_id);
		$this->response->allowance_info_count = count($this->mod->get_employee_allowance_details($user_id));

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

        $this->_ajax_return();
	}

	function get_action_movement_details(){
		$this->_ajax_only();

		$this->response->action_id = $action_id = $this->input->post("action_id");
		$this->response->type_id = $type_id = $this->input->post("type_id");

		$action_details = $this->mod->get_action_movement($action_id);
		$action_movement_attachment = $this->mod->get_action_movement_attachment($action_id);
		$data['count'] = 0;
		
		// it will use to get the user id of the movement being created to populate with the partner.
		if ($this->input->post("movement_id") && $this->input->post("movement_id") > 0){
			$movement_action_details = $this->mod->get_action_movement($this->input->post("movement_id"));
			$action_details['user_id'] = $movement_action_detailsd['user_id'];
		}

		$data['movement_file'] = '';
		if($action_id > 0){
			$data['type'] = $action_details['type'];
			$data['type_id'] = $action_details['type_id'];
			$data['record']['attachement'] = $action_movement_attachment;
			$data['record']['partners_movement_action.photo'] = $action_details['photo'];//user
			$data['record']['partners_movement_action.action_id'] = $action_details['action_id'];//user
			$data['record']['partners_movement_action.type_id'] = $action_details['type_id'];//user
			$data['record']['partners_movement_action.user_id'] = $action_details['user_id'];//user
			$data['record']['partners_movement_action.effectivity_date'] = date("F d, Y", strtotime($action_details['effectivity_date']));//effectivity_date
			$data['record']['partners_movement_action.remarks_print_report'] = $action_details['remarks_print_report'];//action_remarks
			$data['record']['partners_movement_action.remarks_print_report_id'] = $action_details['remarks_print_report_id'];//action_remarks
			switch($type_id){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignment
					$end_date = $this->mod->get_transfer_movement($action_id, 11);
					$data['end_date'] = (count($end_date) > 0) ? $end_date[0]['to_name'] : '' ;

					$data['transfer_fields'] = $this->mod->getTransferFields();
					$data['partner_info'] = $this->mod->get_employee_details($action_details['user_id']);
					foreach($data['transfer_fields'] as $index => $field){
						$movement_type_details = $this->mod->get_transfer_movement($action_id, $field['field_id']);
						if(count($movement_type_details) > 0){
							$data['transfer_fields'][$index]['from_id'] = $movement_type_details[0]['from_id'];
							$data['transfer_fields'][$index]['to_id'] = $movement_type_details[0]['to_id'];
							$data['transfer_fields'][$index]['from_name'] = $movement_type_details[0]['from_name'];
							$data['transfer_fields'][$index]['to_name'] = $movement_type_details[0]['to_name'];
						}else{
							if ($field['field_id'] == 13) {
								$data['transfer_fields'][$index]['from_id'] = (isset($data['partner_info'][0]['job_grade_id']) ? $data['partner_info'][0]['job_grade_id'] : '');
							}
							else {
								$data['transfer_fields'][$index]['from_id'] = (isset($data['partner_info'][0][$field['field_name'].'_id']) ? $data['partner_info'][0][$field['field_name'].'_id'] : '');
							}
							$data['transfer_fields'][$index]['from_name'] = (isset($data['partner_info'][0][$field['field_name']]) ? $data['partner_info'][0][$field['field_name']] : '');
							$data['transfer_fields'][$index]['to_id'] = '';
							$data['transfer_fields'][$index]['to_name'] = '';
						}
					}
					$data['movement_file'] = 'transfer.blade.php';
				break;
				case 2://Salary Increase
				case 18://Salary Alignment
					$movement_type_details = $this->mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = ($movement_type_details['current_salary'] != '' && $movement_type_details['current_salary'] > 0 ? number_format($movement_type_details['current_salary'], 2, '.', ',') : '');//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = ($movement_type_details['to_salary'] != '' && $movement_type_details['to_salary'] > 0 ? number_format($movement_type_details['to_salary'], 2, '.', ',') : '');//to_salary
					$data['movement_file'] = 'compensation.blade.php';
				break;
				case 4://Wage Order
					$movement_type_details = $this->mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = $movement_type_details['current_salary'];//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = $movement_type_details['to_salary'];//to_salary
					$data['movement_file'] = 'wage.blade.php';
				break;
				case 6://Resignation
				case 7://Termination
					$movement_type_details = $this->mod->get_moving_movement($action_id);
					if (!empty($movement_type_details)) {
						$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
						$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
						$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
						$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
						$data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
						$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					}
					$data['movement_file'] = 'endservice.blade.php';
				break;
				case 10://End Contract
				case 11://Retirement
					$movement_type_details = $this->mod->get_moving_movement($action_id);
					$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
					$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
					$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					// $data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
					$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					$data['movement_file'] = 'retire_endo.blade.php';
				break;
				case 15://Extension
					$movement_type_details = $this->mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['movement_file'] = 'extension.blade.php';
				break;
				case 17://develpment assign
					$movement_type_details = $this->mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['record']['partners_movement_action.grade'] = $action_details['grade'];
					$data['movement_file'] = 'extension.blade.php';
				break;
				case 19://additional allowance
					$data['additional_allowance'] = $this->mod->getPayrollAllowanceTransaction();
					foreach($data['additional_allowance'] as $index => $field){
						$movement_type_details = $this->mod->get_additional_allowance_movement($action_id, $field['transaction_id']);
						if(!empty($movement_type_details)){
							$data['additional_allowance'][$index]['from_allowance'] = ($movement_type_details[0]['from_allowance'] != '' && $movement_type_details[0]['from_allowance'] > 0 ? number_format($movement_type_details[0]['from_allowance'], 2, '.', ',') : '');
							$data['additional_allowance'][$index]['to_allowance'] = ($movement_type_details[0]['to_allowance'] != '' && $movement_type_details[0]['to_allowance'] > 0 ? number_format($movement_type_details[0]['to_allowance'], 2, '.', ',') : '');
						}
						else{
							$data['additional_allowance'][$index]['from_allowance'] = '';
							$data['additional_allowance'][$index]['to_allowance'] = '';							
						}
					}
					$data['movement_file'] = 'additional_allowance.blade.php';
				break;				
			}
		}else{	
			$data['count'] = $this->input->post('count');
			$type_id = $data['type_id'] = $this->input->post('type_id');
			$type = $data['type'] = $this->input->post('type_name');	
			$data['record']['partners_movement_action.action_id'] = '';	
			$data['record']['partners_movement_action.remarks_print_report_id'] = '';
			switch($type_id){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignment
					$data['end_date'] = '' ;

					$data['movement_file'] = 'transfer.blade.php';
					$data['transfer_fields'] = $this->mod->getTransferFields();

					foreach($data['transfer_fields'] as $index => $field){				
						$data['transfer_fields'][$index]['from_id'] = '';
						$data['transfer_fields'][$index]['to_id'] = '';
						$data['transfer_fields'][$index]['from_name'] = '';
						$data['transfer_fields'][$index]['to_name'] = '';
					}
				break;
				case 2://Salary Increase
				case 18://Salary Alignment
					$data['movement_file'] = 'compensation.blade.php';
					$data['record']['partners_movement_action_compensation.id'] = '';//id
				break;
				case 4://Wage Order
					$data['movement_file'] = 'wage.blade.php';
					$data['record']['partners_movement_action_compensation.id'] = '';//id
				break;
				case 6://Resignation
				case 7://Termination
					$data['movement_file'] = 'endservice.blade.php';
					$data['record']['partners_movement_action_moving.id'] = '';//id
				break;
				case 10://End Contract
				case 11://Retirement
					$data['movement_file'] = 'retire_endo.blade.php';
					$data['record']['partners_movement_action_moving.id'] = '';//id
				break;
				case 15://Extension
					$data['movement_file'] = 'extension.blade.php';
					$data['record']['partners_movement_action_extension.id'] = '';//id
				break;
				case 17://Extension
					$data['movement_file'] = 'extension.blade.php';
					$data['record']['partners_movement_action_extension.id'] = '';//id
					$data['record']['partners_movement_action.grade'] = '';
				break;
				case 19://Temporary Assignment
					$data['movement_file'] = 'additional_allowance.blade.php';
					$data['additional_allowance'] = $this->mod->getPayrollAllowanceTransaction();

					foreach($data['additional_allowance'] as $index => $field){				
						$data['additional_allowance'][$index]['from_allowance'] = '';
						$data['additional_allowance'][$index]['to_allowance'] = '';
					}
				break;				
			}

			$result = $this->mod->_get( 'edit', 0 );
			$field_lists = $result->list_fields();
			foreach( $field_lists as $field )
			{
				$data['record'][$field] = '';
			}
		}

		$this->response->count = ++$data['count'];
		$this->load->helper('file');
		$this->load->helper('form');
		
		$data['user_id'] = $this->user->user_id;

		if ($this->input->post("action_id") && $this->input->post("action_id") > 0){
			$movement_action_details = $this->mod->get_action_movement($this->input->post("action_id"));
			$action_details['user_id'] = $movement_action_details['user_id'];
			$data['record']['partners_movement_action.user_id'] = $action_details['user_id'];//user				
		}
		else{
			if ($this->input->post("movement_id") && $this->input->post("movement_id") > 0){
				$this->db->where('movement_id',$this->input->post("movement_id"));
				$this->db->limit(1);
				$action_details = $this->db->get('partners_movement_action');
				if ($action_details && $action_details->num_rows() > 0){
					$action_details_info = $action_details->row();

					$data['record']['partners_movement_action.user_id'] = $action_details_info->user_id; 						
				}
			}
		}

		$this->response->add_movement = $this->load->view('edit/custom_fgs/nature.blade.php', $data, true);
		$this->response->type_of_movement = $this->load->view('edit/custom_fgs/'.$data['movement_file'], $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

	function display_action_movement_details(){
		$this->_ajax_only();

		$this->response->action_id = $action_id = $this->input->post("action_id");
		$this->response->type_id = $type_id = $this->input->post("type_id");

		$action_details = $this->mod->get_action_movement($action_id);
		$action_movement_attachment = $this->mod->get_action_movement_attachment($action_id);
		$data['count'] = 0;
		
		$data['movement_file'] = '';
		if($action_id > 0){
			$data['type'] = $action_details['type'];
			$data['type_id'] = $action_details['type_id'];
			$data['record']['attachement'] = $action_movement_attachment;
			$data['record']['partners_movement_action.photo'] = $action_details['photo'];//user
			$data['record']['partners_movement_action.movement_id'] = $action_details['movement_id'];//user
			$data['record']['partners_movement_action.action_id'] = $action_details['action_id'];//user
			$data['record']['partners_movement_action.type_id'] = $action_details['type_id'];//user
			$data['record']['partners_movement_action.user_id'] = $action_details['user_id'];//user
			$data['record']['partners_movement_action.display_name'] = $action_details['full_name'];//user
			$data['record']['partners_movement_action.effectivity_date'] = date("F d, Y", strtotime($action_details['effectivity_date']));//effectivity_date
			$data['record']['partners_movement_action.remarks_print_report'] = $action_details['remarks_print_report'];//action_remarks
			switch($type_id){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignmentsav
					$end_date = $this->mod->get_transfer_movement($action_id, 11);
					$data['end_date'] = (count($end_date) > 0) ? $end_date[0]['to_name'] : '' ;

					$data['transfer_fields'] = $this->mod->getTransferFields();
					$data['partner_info'] = $this->mod->get_employee_details($action_details['user_id']);
					foreach($data['transfer_fields'] as $index => $field){
						$movement_type_details = $this->mod->get_transfer_movement($action_id, $field['field_id']);
						if(count($movement_type_details) > 0){
							$data['transfer_fields'][$index]['from_id'] = $movement_type_details[0]['from_id'];
							$data['transfer_fields'][$index]['to_id'] = $movement_type_details[0]['to_id'];
							$data['transfer_fields'][$index]['from_name'] = $movement_type_details[0]['from_name'];
							$data['transfer_fields'][$index]['to_name'] = $movement_type_details[0]['to_name'];
						}else{
							$data['transfer_fields'][$index]['from_id'] = (isset($data['partner_info'][0][$field['field_name'].'_id']) ? $data['partner_info'][0][$field['field_name'].'_id'] : '');
							$data['transfer_fields'][$index]['from_name'] = (isset($data['partner_info'][0][$field['field_name']]) ? $data['partner_info'][0][$field['field_name']] : '');
							$data['transfer_fields'][$index]['to_id'] = '';
							$data['transfer_fields'][$index]['to_name'] = '';
						}
					}
					$data['movement_file'] = 'transfer.blade.php';
				break;
				case 2://Salary Increase
				case 18://Salary Alignment
					$movement_type_details = $this->mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = ($movement_type_details['current_salary'] != '' && $movement_type_details['current_salary'] > 0 ? number_format($movement_type_details['current_salary'], 2, '.', ',') : '');//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = ($movement_type_details['to_salary'] != '' && $movement_type_details['to_salary'] > 0 ? number_format($movement_type_details['to_salary'], 2, '.', ',') : '');//to_salary
					$data['movement_file'] = 'compensation.blade.php';
				break;
				case 4://Wage Order
					$movement_type_details = $this->mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = ($movement_type_details['current_salary'] != '' && $movement_type_details['current_salary'] > 0 ? number_format($movement_type_details['current_salary'], 2, '.', ',') : '');//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = ($movement_type_details['to_salary'] != '' && $movement_type_details['to_salary'] > 0 ? number_format($movement_type_details['to_salary'], 2, '.', ',') : '');//to_salary
					$data['movement_file'] = 'wage.blade.php';
				break;
				case 6://Resignation
				case 7://Termination
					$movement_type_details = $this->mod->get_moving_movement($action_id);
					if (!empty($movement_type_details)) {
						$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
						$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
						$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
						$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
						$data['record']['partners_movement_action_moving.reason'] = $movement_type_details['reason'];//reason_id
						$data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
						$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					}
					$data['movement_file'] = 'endservice.blade.php';
				break;
				case 10://End Contract
				case 11://Retirement
					$movement_type_details = $this->mod->get_moving_movement($action_id);
					$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
					$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
					$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					// $data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
					$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					$data['movement_file'] = 'retire_endo.blade.php';
				break;
				case 15://Extension
					$movement_type_details = $this->mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['movement_file'] = 'extension.blade.php';
				break;
				case 17://Extension
					$movement_type_details = $this->mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['record']['partners_movement_action.grade'] = $action_details['grade'];
					$data['movement_file'] = 'extension.blade.php';
				break;
				case 19://Extension
					$data['additional_allowance'] = $this->mod->getPayrollAllowanceTransaction();
					foreach($data['additional_allowance'] as $index => $field){
						$movement_type_details = $this->mod->get_additional_allowance_movement($action_id, $field['transaction_id']);
						if (!empty($movement_type_details)) {
							$data['additional_allowance'][$index]['from_allowance'] = ($movement_type_details[0]['from_allowance'] != '' && $movement_type_details[0]['from_allowance'] > 0 ? number_format($movement_type_details[0]['from_allowance'], 2, '.', ',') : '');
							$data['additional_allowance'][$index]['to_allowance'] = ($movement_type_details[0]['to_allowance'] != '' &&  $movement_type_details[0]['to_allowance'] > 0 ? number_format($movement_type_details[0]['to_allowance'], 2, '.', ',') : '');
						}
						else {
							$data['additional_allowance'][$index]['from_allowance'] = '';
							$data['additional_allowance'][$index]['to_allowance'] = '';
						}
					}
					$data['movement_file'] = 'additional_allowance.blade.php';
				break;				
			}
		}else{	
			$data['count'] = $this->input->post('count');
			$type_id = $data['type_id'] = $this->input->post('type_id');
			$type = $data['type'] = $this->input->post('type_name');	
			$data['record']['partners_movement_action.action_id'] = '';	
			switch($type_id){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignment
					$data['end_date'] = '' ;

					$data['movement_file'] = 'transfer.blade.php';
					$data['transfer_fields'] = $this->mod->getTransferFields();

					foreach($data['transfer_fields'] as $index => $field){				
						$data['transfer_fields'][$index]['from_id'] = '';
						$data['transfer_fields'][$index]['to_id'] = '';
						$data['transfer_fields'][$index]['from_name'] = '';
						$data['transfer_fields'][$index]['to_name'] = '';
					}
				break;
				case 2://Salary Increase
				case 18://Salary Alignment
					$data['movement_file'] = 'compensation.blade.php';
					$data['record']['partners_movement_action_compensation.id'] = '';//id
				break;
				case 4://Wage Order
					$data['movement_file'] = 'wage.blade.php';
					$data['record']['partners_movement_action_compensation.id'] = '';//id
				break;
				case 6://Resignation
				case 7://Termination
					$data['movement_file'] = 'endservice.blade.php';
					$data['record']['partners_movement_action_moving.id'] = '';//id
				break;
				case 10://End Contract
				case 11://Retirement
					$data['movement_file'] = 'retire_endo.blade.php';
					$data['record']['partners_movement_action_moving.id'] = '';//id
				break;
				case 15://Extension
					$data['movement_file'] = 'extension.blade.php';
					$data['record']['partners_movement_action_extension.id'] = '';//id
				break;
				case 17://Extension
					$data['movement_file'] = 'extension.blade.php';
					$data['record']['partners_movement_action_extension.id'] = '';//id
					$data['record']['partners_movement_action.grade'] = '';
				break;
				case 19://Extension
					$data['additional_allowance'][$index]['from_allowance'] = '';
					$data['additional_allowance'][$index]['to_allowance'] = '';
					$data['movement_file'] = 'additional_allowance.blade.php';
				break;					
			}

			$result = $this->mod->_get( 'edit', 0 );
			$field_lists = $result->list_fields();
			foreach( $field_lists as $field )
			{
				$data['record'][$field] = '';
			}
		}

			$this->response->count = ++$data['count'];
			$this->load->helper('file');
			$this->load->helper('form');
			
			$data['user_id'] = $this->user->user_id;

			$this->response->add_movement = $this->load->view('detail/custom_fgs/nature.blade.php', $data, true);
			$this->response->type_of_movement = $this->load->view('detail/custom_fgs/'.$data['movement_file'], $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

	function delete_movement_type()
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

		$data['deleted'] = 1;
		//other tables
		$this->db->where_in('action_id', $records);
		$this->db->update('partners_movement_action_extension', $data);
		$this->db->where_in('action_id', $records);
		$this->db->update('partners_movement_action_compensation', $data);
		$this->db->where_in('action_id', $records);
		$this->db->update('partners_movement_action_moving', $data);
		$this->db->where_in('action_id', $records);
		$this->db->update('partners_movement_action_transfer', $data);

		$data['modified_on'] = date('Y-m-d H:i:s');
		$data['modified_by'] = $this->user->user_id;
		//action table
		$this->db->where_in('action_id', $records);
		$this->db->update('partners_movement_action', $data);

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

		$this->_ajax_return();
	}

    function movement_details_list(){  
    	
    	$this->_ajax_only();  	
    	$record_id = $this->input->post('record_id');

		$data['movement_details'] = $this->mod->get_movement_details($record_id);
    	$view['content'] = $this->load->view('edit/custom_fgs/movement_type_list.php', $data, true);
	
	    $this->response->count = count($data['movement_details']);
	    $this->response->lists = $view['content'];

	    $this->response->message[] = array(
	        'message' => '',
	        'type' => 'success'
	        );

	    $this->_ajax_return();
    }

	function get_current_salary(){
		$this->_ajax_only();

		$user_id = $this->input->post('user_id');
		$qry = "SELECT ROUND(AES_DECRYPT(salary, encryption_key()),2) AS current_salary 
				FROM {$this->db->dbprefix}payroll_partners 
				WHERE user_id = $user_id ";
		$record = $this->db->query( $qry );
		// echo $qry;
		if($record->num_rows() > 0){
			$salary = $record->row_array();
			$this->response->current_salary = ($salary['current_salary'] > 0 ? number_format($salary['current_salary'], 2, '.', ',') : 0);
			$this->response->retrieved_salary = true;
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

        $this->_ajax_return();
	}

	function get_end_date_org(){
		$this->_ajax_only();

		$user_id = $this->input->post('user_id');
		$months = $this->input->post('months');
		$effective = $this->input->post('effective_date');
		$partners_personal = $this->mod->get_partners_personal($user_id, 'partners_personal', 'last_probationary', 0);

		if( !empty($partners_personal['key_value']) ){
			$end_date = $partners_personal['key_value'];
		}else{
			$this->db->select('effectivity_date, resigned_date')
		    ->from('partners')
	    	->where("user_id = $user_id");

	    	$partners_info = $this->db->get('')->row_array();
	    	if(strtotime($partners_info['resigned_date'])){
	    		$end_date = $partners_info['resigned_date'];
	    	}else{
	    		//$end_date = date( 'Y-m-d', strtotime('+6 months', strtotime($partners_info['effectivity_date'])) );
	    		//$end_date = date( 'Y-m-d', strtotime($effective));
	    		$end_date =  date('Y-m-d', strtotime($effective));
	    		// debug($end_date);
	    	}
		} 

		if(strtotime($end_date) && $months > 0){
			$this->response->end_date = date( 'F d, Y', strtotime("+".$months." month", strtotime($end_date)));
			//$date= date_create($end_date);
			//$final = date_add($date, date_interval_create_from_date_string(" ".$months." months"));
			//debug($final);
			//$this->response->end_date = date_format($final,"F g, Y");
			//$this->response->end_date = date_format($final,"F g, Y");
			$this->response->retrieved_enddate = true;
		}


		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

        $this->_ajax_return();
	}

	function get_end_date(){
		$this->_ajax_only();

		$user_id = $this->input->post('user_id');
		$months = $this->input->post('months');
		$effective = $this->input->post('effective_date');
		
		$this->db->where('user_id',$user_id);
		$partners = $this->db->get('partners');

		if ($partners && $partners->num_rows() > 0) {
			$partner_info = $partners->row();
			$employment_end_date = $partner_info->employment_end_date;
			$employment_end_date = date('Y-m-d', strtotime($employment_end_date));
		} else {
			$employment_end_date = date('Y-m-d', strtotime($effective));
		}

		if(strtotime($employment_end_date) && $months > 0){
			$this->response->end_date = date( 'F d, Y', strtotime("+".$months." month", strtotime($employment_end_date)));
			//$date= date_create($end_date);
			//$final = date_add($date, date_interval_create_from_date_string(" ".$months." months"));
			//debug($final);
			//$this->response->end_date = date_format($final,"F g, Y");
			//$this->response->end_date = date_format($final,"F g, Y");
			$this->response->retrieved_enddate = true;
		}


		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

        $this->_ajax_return();
	}

    // print movement information
    function export_pdf_application_info_sheet(){
        $movement_id = $this->input->post('record_id');

        $filename = $this->mod->export_pdf($movement_id);

        $this->response->message[] = array(
            'message' => 'Download file ready.',
            'type' => 'success'
        );

        $this->response->filename = $filename;
        $this->_ajax_return();
    }

    function download_file($upload_id){   
        $this->db->select("photo")
        ->from("partners_movement_action_attachment")
        ->where("movement_attachment_id = {$upload_id}");

        $image_details = $this->db->get()->row_array();   
        $path = base_url() . $image_details['photo'];
        
        header('Content-disposition: attachment; filename='.substr( $image_details['photo'], strrpos( $image_details['photo'], '/' )+1 ).'');
        header('Content-type: txt/pdf');
        readfile($path);
    }       	
}