<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clearance extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('clearance_model', 'mod');
		parent::__construct();
	}

	function view_signatories($record_id=0){

		$data['record_id'] = $record_id;
		$clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
		$clearance_record = $clearance_record->row_array();

		$partner_record = "SELECT up.*, ud.department as dept, uc.company as comp FROM {$this->db->dbprefix}users_profile up
						INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
						LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
						WHERE partner_id = {$clearance_record['partner_id']} ";
		$partner_record = $this->db->query($partner_record)->row_array();

		$layout_qry = "SELECT * FROM {$this->db->dbprefix}partners_clearance_layout 
						WHERE deleted = 0  
						AND `clearance_layout_id` = {$clearance_record['clearance_layout_id']} 
					   ";
		$layout_sql = $this->db->query($layout_qry);

		$layout_record = array();
		if ($layout_sql && $layout_sql->num_rows() > 0){
			$layout_record = $layout_sql->row_array();
		}

		$record_other_arr = array();
		$record_head_office_arr = array();
		$signatories_arr = array();
		$accountabilities_arr = array();		
		$attachments_arr = array();	
		if($layout_sql && $layout_sql->num_rows() > 0){
			$record_other = $this->db->get_where('partners_clearance_layout_sign', array( 'clearance_layout_id' => $layout_record['clearance_layout_id'], 'deleted' => 0, 'properties_tagging' => 0) );
			$record_head_office = $this->db->get_where('partners_clearance_layout_sign', array( 'clearance_layout_id' => $layout_record['clearance_layout_id'], 'deleted' => 0, 'properties_tagging' => 1) );

			$signatories = $this->db->get_where('partners_clearance_signatories', array( 'clearance_id' => $record_id) );
			if ($signatories && $signatories->num_rows() > 0){
				foreach ($signatories->result() as $row) {
					$signatories_arr[$row->clearance_layout_sign_id] = array(
																				'clearance_signatories_id' => $row->clearance_signatories_id,
																				'user_id' => $row->user_id,
																				'remarks' => $row->remarks,
																				'attachments' => $row->attachments,
																				'date_cleared' => $row->date_cleared,
																				'status_id' => $row->status_id,
																			);

					$accountabilities = $this->db->get_where('partners_clearance_signatories_accountabilities', array( 'clearance_signatories_id' => $row->clearance_signatories_id ) ); 
					if ($accountabilities && $accountabilities->num_rows() > 0){
						$accountabilities_arr[$row->clearance_layout_sign_id][$row->clearance_signatories_id] = $accountabilities->result_array();
					}

					$attachments = $this->db->get_where('partners_clearance_signatories_attachment', array( 'clearance_signatories_id' => $row->clearance_signatories_id, 'type' => 0 ) ); 
					if ($attachments && $attachments->num_rows() > 0){
						$attachments_arr[$row->clearance_layout_sign_id][$row->clearance_signatories_id] = $attachments->result_array();
					}					
				}
			}
			$record_other_arr = $record_other->result_array();
			$record_head_office_arr = $record_head_office->result_array();
		}
		
		$this->load->helper('form');
		$this->load->helper('file');

		$data['clearance_record'] = $clearance_record;
		if( !strtotime($data['clearance_record']['turn_around_time']) ){
			$data['clearance_record']['turn_around_time'] = '';
		}

		$data['partner_record'] = $partner_record;
		$data['layout_record'] = $layout_record;
		$data['records'] = $record_other_arr;
		$data['records_head_office'] = $record_head_office_arr;
		$data['signatories'] = $signatories_arr;
		$data['accountabilities'] = $accountabilities_arr;
		$data['attachments_arr'] = $attachments_arr;
/*
		debug($data);
		die();
		*/
		$this->load->vars( $data );

		echo $this->load->blade('pages.edit_sign')->with( $this->load->get_cached_vars() );
	
	}
	
    function get_signatories(){

		$this->load->helper('form');
		$this->load->helper('file');
		$sign_record['records'] = array();
		$record_id = $_POST['clearance_id'];

		$sign_table = 'partners_clearance_layout_sign';
		$sign_key = 'clearance_layout_id';
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->input->post('clearance_layout_id'), 'deleted' => 0) );

		$clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
		$clearance_record = $clearance_record->row_array();

		$partner_record = $this->db->get_where( 'users_profile', array( 'partner_id' => $clearance_record['partner_id']) );
		$partner_record = $partner_record->row_array();

		if( $record->num_rows() > 0 && $this->input->post('change_layout') == 1 ){
			$this->db->delete('partners_clearance_signatories', array($this->mod->primary_key => $record_id)); 
			$sign_record['records'] = $record->result_array();
			foreach($sign_record['records'] as $val){
				$insert_signatories[$this->mod->primary_key] = $record_id;
				$insert_signatories['panel_title'] = $val['panel_title'];
				if($val['is_immediate'] == 1){
					$insert_signatories['user_id'] = $partner_record['reports_to_id'];
				}else{
					$insert_signatories['user_id'] = $val['user_id'];
				}
				$insert_signatories['status_id'] = 1;
				$this->db->insert('partners_clearance_signatories', $insert_signatories);
			}
			$this->db->update( $this->mod->table, array('clearance_layout_id' => $this->input->post('clearance_layout_id')), array( $this->mod->primary_key => $record_id ) );
		}
		$sign_table = 'partners_clearance_signatories';
		$sign_key = $this->mod->primary_key;
		$record = $this->db->get_where( $sign_table, array( $sign_key => $record_id, 'deleted' => 0) );
		$sign_record['records'] = $record->result_array();

        $this->response->signatory = $this->load->view('edit/signatory', $sign_record, true);
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }
   	
   	function get_clearance_template(){
		$record_id = $_POST['clearance_id'];   		
		$sign_table = 'partners_clearance_layout_sign';
		$sign_key = 'clearance_layout_id';
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->input->post('clearance_layout_id'), 'deleted' => 0, 'properties_tagging' => 0) );

		$this->load->helper('form');
		$this->load->helper('file');
		$sign_record['records'] = $record->result_array();

		$clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
		$clearance_record = $clearance_record->row_array();
		$sign_record['clearance_record'] = $clearance_record;

  //       $this->load->vars($sign_record);
		// $content = $this->load->blade('edit.signatory')->with( $this->load->get_cached_vars() );

		$record_head_office = $this->db->get_where( $sign_table, array( $sign_key => $this->input->post('clearance_layout_id'), 'deleted' => 0, 'properties_tagging' => 1) );
		$sign_record['records_head_office'] = $record_head_office->result_array();

        $this->response->signatory = $this->load->view('edit/signatory_base_template', $sign_record, true);
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
   	}

    function add_sign()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
		// $record['user_id']
		if($vars['sign_id']){
			$record = $this->db->get_where( 'partners_clearance_signatories', array( 'clearance_signatories_id' => $vars['sign_id'] ) )->row_array();
		}else{
			$record['user_id'] = 0;
			$record['panel_title'] = '';
			$record['clearance_id'] = $vars['record_id'];
			$record['clearance_signatories_id'] = '';
		}

        $this->load->vars($record);
		$this->load->helper('form');
		$this->load->helper('file');

        $data['title'] = 'Clearance Signatories';
        $data['content'] = $this->load->blade('edit.sign')->with( $this->load->get_cached_vars() );

        $this->response->sign = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function save_signatory()
    {
        $validation_rules[] = 
        array(
            'field' => 'partners_clearance_signatories[panel_title]',
            'label' => 'Panel Title',
            'rules' => 'required'
            );

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

		$sign_table = 'partners_clearance_signatories';
		$sign_key = 'clearance_signatories_id';
        $transactions = true;
		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post[$sign_table]['clearance_signatories_id'];
		$this->response->clearance_id = $this->clearance_id = $post[$sign_table]['clearance_id'];
		// unset( $post['record_id'] );

		if( $transactions )
		{
			$this->db->trans_begin();
		}

		//start saving with main table
		$main_record = $post[$sign_table];
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->record_id ) );
		switch( true )
		{
			case $record->num_rows() == 0:
				//add mandatory fields
				// $main_record['created_by'] = $this->user->user_id;
				$this->db->insert($sign_table, $main_record);
				if( $this->db->_error_message() == "" )
				{
					$this->response->record_id = $this->record_id = $this->db->insert_id();
				}
				$this->response->action = 'insert';

				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, array(), $main_record, $movement_action['user_id']);

				break;
			case $record->num_rows() == 1:
				// $main_record['modified_by'] = $this->user->user_id;
				// $main_record['modified_on'] = date('Y-m-d H:i:s');
				$this->db->update( $sign_table, $main_record, array( $sign_key => $this->record_id ) );
				$this->response->action = 'update';

				$previous_main_data = $record->row_array();
				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, $previous_main_data, $main_record, $movement_action['user_id']);
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

		if( !$error )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }

    function save_sign()
    {
    	$transactions = true;
		$error = false;
		$post = $_POST;

		$validation_rules =  array();
/*		if(isset($post['partners_clearance_signatories']['remarks'])){
	    	foreach ($post['partners_clearance_signatories']['remarks'] as $value) {
	    		if( $value == ""){
		    		$validation_rules[] = 
			        array(
			            'field' => 'partners_clearance_signatories[remarks]',
			            'label' => 'Remarks',
			            'rules' => 'required'
			            );
		    	}
	    	}
	    }
	    if(isset($post['partners_clearance_signatories']['status_id'])){
	    	foreach ($post['partners_clearance_signatories']['status_id'] as $value) {
	    		if( $value == ""){
		    		$validation_rules[] = 
			        array(
			            'field' => 'partners_clearance_signatories[status]',
			            'label' => 'Status',
			            'rules' => 'required'
			            );
		    	}
	    	}

    	}*/
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

        $this->response->clearance_id = $this->clearance_id =  $this->record_id = $post['record_id'] ;

		//start saving with clearance table
		$main_record['status_id'] = $post['status_id'];
		$main_record['clearance_layout_id'] = $post['partners_clearance']['clearance_layout_id'];
		$main_record['turn_around_time'] = date('Y-m-d',strtotime($post['partners_clearance']['turn_around_time']));
		$record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $this->record_id ) );

		switch( true )
		{
			case $record->num_rows() == 1:
				$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $this->record_id ) );
				$this->response->action = 'update';

				$previous_main_data = $record->row_array();
				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $this->mod->table, $previous_main_data, $main_record, $previous_main_data['user_id']);

				break;
			default:
				$this->response->message[] = array(
					'message' => lang('common.inconsistent_data'),
					'type' => 'error'
				);
				$error = true;
				goto stop;
		}

		$sign_table = 'partners_clearance_signatories';
		$sign_key = 'clearance_signatories_id';

		//$this->response->record_id = $this->record_id = $post[$sign_table]['clearance_signatories_id'];
		// unset( $post['record_id'] );

		if( $transactions )
		{
			$this->db->trans_begin();
		}

		$signatories_arr = (isset($post[$sign_table]['clearance_signatories_id']) ? $post[$sign_table]['clearance_signatories_id'] : array());
		$panel_title_arr = (isset($post[$sign_table]['panel_title']) ? $post[$sign_table]['panel_title'] : array());
		$clearance_layout_sign_id_arr = (isset($post[$sign_table]['clearance_layout_sign_id']) ? $post[$sign_table]['clearance_layout_sign_id'] : array());
		$remarks_arr = (isset($post[$sign_table]['remarks']) ? $post[$sign_table]['remarks'] : array());
		$attachments_arr = (isset($post[$sign_table]['attachments']) ? $post[$sign_table]['attachments'] : array());
		$status_id_arr = (isset($post[$sign_table]['status_id']) ? $post[$sign_table]['status_id'] : array());

		foreach ($signatories_arr as $key => $value) {
			if ($value != 0){
				$record = $this->db->get_where( $sign_table, array( 'user_id' => $value, 'clearance_id' => $this->record_id ) );

				if ($record && $record->num_rows() > 0) {
					$clearance_signatories_record = $record->row();

					$this->db->where_in('clearance_signatories_id',$clearance_signatories_record->clearance_signatories_id);
					$this->db->delete('partners_clearance_signatories_accountabilities');

					$this->db->where_in('clearance_signatories_id',$clearance_signatories_record->clearance_signatories_id);
					$this->db->delete('partners_clearance_signatories_attachment');
				}

				switch( true )
				{
					case $record->num_rows() == 0:
						$signatories_info = array(
													'clearance_id' => $this->record_id,
													'user_id' => $value,
													'panel_title' => $panel_title_arr[$key],
													'clearance_layout_sign_id' => $clearance_layout_sign_id_arr[$key],
													'remarks' => $remarks_arr[$key],
													'status_id' => 1
												 );					
						//add mandatory fields
						// $main_record['created_by'] = $this->user->user_id;
						$this->db->insert($sign_table, $signatories_info);
						if( $this->db->_error_message() == "" )
						{
							$this->response->record_id = $this->clearance_signatories_id = $this->db->insert_id();
						}
						$this->response->action = 'insert';

						$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, array(), $signatories_info, '');						
						break;
					case $record->num_rows() == 1:
						$signatories_info = array(
													'user_id' => $value
												 );					
						// $main_record['modified_by'] = $this->user->user_id;
						// $main_record['modified_on'] = date('Y-m-d H:i:s');
						$this->db->update( $sign_table, $signatories_info, array( $sign_key => $clearance_signatories_record->clearance_signatories_id ) );
						$this->clearance_signatories_id = $clearance_signatories_record->clearance_signatories_id;
						$this->response->action = 'update';

						$previous_main_data = $record->row_array();
						$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, $previous_main_data, $signatories_info, '');												
						break;
					default:
						$this->response->message[] = array(
							'message' => lang('common.inconsistent_data'),
							'type' => 'error'
						);
						$error = true;
						goto stop;
				}

				if (isset($attachments_arr[$clearance_layout_sign_id_arr[$key]]) && $attachments_arr[$clearance_layout_sign_id_arr[$key]] != ''){
					foreach ($attachments_arr[$clearance_layout_sign_id_arr[$key]] as $key_attach => $value_attach) {
						$attachment_info = array(
													'clearance_signatories_id' => $this->clearance_signatories_id,
													'attachments' => $value_attach,
												 );

						$this->db->insert('partners_clearance_signatories_attachment', $attachment_info);
					}
				}

				if (isset($post['partners_clearance_signatories_accountabilities'][$clearance_layout_sign_id_arr[$key]])){
					$account_record = array();
					$accountabilities = $post['partners_clearance_signatories_accountabilities'][$clearance_layout_sign_id_arr[$key]]['accountability'];
					$this->db->delete('partners_clearance_signatories_accountabilities', array('clearance_signatories_id' => $this->clearance_signatories_id )); 
					if(count($accountabilities) > 0){
						foreach( $accountabilities as $val ){
							if(strlen(trim($val)) > 0){
								$account_record['clearance_signatories_id'] = $this->clearance_signatories_id;
								$account_record['accountability'] = $val;
								$this->db->insert('partners_clearance_signatories_accountabilities', $account_record);
								$this->response->action = 'insert';

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
					}
				}					
			}
		}

		if ($post['status_id'] == 2){
			$this->load->model('clearance_manage_model', 'clearance_manage');
			$pending = $this->clearance_manage->get_pending_status($this->clearance_id);

			$this->db->where('clearance_id', $this->clearance_id);
			$this->db->update('partners_clearance', array('status_id' => 2));

			if($pending == 0){
				$this->db->where('clearance_id', $this->clearance_id);
				$this->db->update('partners_clearance', array('status_id' => 3, 'date_cleared' => date('Y-m-d')));

				if( $this->db->_error_message() != "" ){
					$error = true;
					goto stop;
				}
			}

			$user_for_clearance = '';			
			$user_clearance_qry = "SELECT * FROM {$this->db->dbprefix}partners_clearance pc
						   LEFT JOIN {$this->db->dbprefix}partners p ON pc.partner_id = p.partner_id
						   LEFT JOIN {$this->db->dbprefix}users u ON p.user_id = u.user_id
						   WHERE pc.deleted = 0
						   AND pc.clearance_id = {$this->clearance_id}
						  ";
			$user_clearance = $this->db->query($user_clearance_qry);
			if ($user_clearance && $user_clearance->num_rows() > 0){
				$user_for_clearance = $user_clearance->row()->full_name;
			}

			// change inner join to left join to receive signatories even without accountabilities.
			$signatories_qry = "SELECT * FROM {$this->db->dbprefix}partners_clearance_signatories pcs
						   -- INNER JOIN ww_partners_clearance_signatories_accountabilities pcsa ON pcs.clearance_signatories_id = pcsa.clearance_signatories_id
						   LEFT JOIN ww_partners_clearance_signatories_accountabilities pcsa ON pcs.clearance_signatories_id = pcsa.clearance_signatories_id
						   LEFT JOIN {$this->db->dbprefix}users u ON pcs.user_id = u.user_id
						   WHERE pcs.deleted = 0
						   AND clearance_id = {$this->clearance_id}
						  ";
			$signatories = $this->db->query($signatories_qry);

			$this->load->model('clearance_manage_model', 'manage_mod');
            $this->load->library('parser');
            $this->parser->set_delimiters('{{', '}}');

			if ($signatories && $signatories->num_rows() > 0){
				foreach ($signatories->result() as $signatories_user) {
					//insert notification
					$insert = array(
						'status' => 'info',
						'message_type' => 'Clearance',
						'user_id' => $this->user->user_id,
						'feed_content' => $user_for_clearance . ' clearance already for your verification',
						'recipient_id' => $signatories_user->user_id,
						'uri' => str_replace(base_url(), '', $this->manage_mod->url).'/edit/'.$this->clearance_id
					);

					$this->db->insert('system_feeds', $insert);
					$id = $this->db->insert_id();
					$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $signatories_user->user_id));					

                    // email to approver
                    $sendclearancedata['resign_employee'] = $user_for_clearance;
                    $sendclearancedata['approver'] = $signatories_user->full_name;


                    $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'CLEARANCE-SEND-APPROVER') )->row_array();
                    $msg = $this->parser->parse_string($mrf_send_template['body'], $sendclearancedata, TRUE); 
                    $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendclearancedata, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$signatories_user->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");			
				}
			}

			$this->db->query("CALL sp_partners_clearance_action_email( {$this->clearance_id} )");
			mysqli_next_result($this->db->conn_id);

			if( $this->db->_error_message() != "" ){
				$error = true;
				goto stop;
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

		if( !$error )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }

	function delete_signatories( )
	{
		// $data['modified_on'] = date('Y-m-d H:i:s');
		// $data['modified_by'] = $this->user->user_id;

		$sign_table = 'partners_clearance_signatories';
		$sign_key = 'clearance_signatories_id';
		$data['deleted'] = 1;

		$this->db->where_in($sign_key, $_POST['records']);
		$this->db->update($sign_table, $data);
		
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

    function send_sign()
    {
        $transactions = true;
		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post['record_id'];
		unset( $post['record_id'] );

		$layout_qry = "SELECT * FROM {$this->db->dbprefix}partners_clearance_signatories 
						WHERE deleted = 0  AND `user_id` = 0 
						AND {$this->mod->primary_key} = $this->record_id
						 ";
		$layout_sql = $this->db->query($layout_qry);

		if($layout_sql && $layout_sql->num_rows > 0){					
            $this->response->message[] = array(
                'message' => "Please assign signatory to ALL departments(signatory panel).",
                'type' => 'warning'
                );  
        	$this->_ajax_return();
		}

		$validation_rules = array();
		if(isset($post['alternate_email'])){
			$validation_rules[] = 
		        array(
		            'field' => 'alternate_email',
		            'label' => 'Alternate Email',
		            'rules' => 'valid_email'
		            );
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

		if( $transactions )
		{
			$this->db->trans_begin();
		}

		//start saving with main table
		$main_record['status_id'] = $post['status_id'];

		$record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $this->record_id ) );
		switch( true )
		{
			case $record->num_rows() == 1:
				// $main_record['modified_by'] = $this->user->user_id;
				// $main_record['modified_on'] = date('Y-m-d H:i:s');
				if(isset($post['alternate_email']) && $main_record['status_id'] != 4){
					$main_record['alternate_email'] = $post['alternate_email'];
				}

				if($main_record['status_id'] == 4){
					$main_record['turn_around_time'] = date('Y-m-d');
				}
				$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $this->record_id ) );
				$this->response->action = 'update';

/*				if(isset($post['interview'])){
					foreach ($post['interview'] as $exit_interview_id => $value) {
						$this->db->update('partners_clearance_exit_interview_answers', array('remarks' => $value), array('exit_interview_answers_id' => $exit_interview_id));
						if( $this->db->_error_message() != "" ){
							$error = true;
							goto stop;
						}
					}
				}*/

				

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

		if( !$error )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }

    /*
    *Exit interview
    */

	function view_exit_interview($record_id=0){

		$data['record_id'] = $record_id;
		$clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
		$clearance_record = $clearance_record->row_array();

		$partner_record = "SELECT up.*, ud.department as dept, uc.company as comp FROM {$this->db->dbprefix}users_profile up
						INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
						LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
						WHERE partner_id = {$clearance_record['partner_id']} ";
		$partner_record = $this->db->query($partner_record)->row_array();

		$layout_qry = "SELECT * FROM {$this->db->dbprefix}partners_clearance_exit_interview_layout 
						WHERE deleted = 0  AND `default` = 0 
						AND exit_interview_layout_id = {$clearance_record['exit_interview_layout_id']}";
		$layout_sql = $this->db->query($layout_qry);

		$layout_record = array();
		if ($layout_sql && $layout_sql->num_rows() > 0){
			$layout_record = $layout_sql->row_array();
		}

		$clearance_signatories = $this->db->get_where( 'partners_clearance_exit_interview_answers', array( $this->mod->primary_key => $record_id) );
		if($layout_sql && $layout_sql->num_rows() > 0){		
			if($clearance_signatories->num_rows() == 0){
				$sign_table = 'partners_clearance_exit_interview_layout_item';
				$sign_key = 'exit_interview_layout_id';
				$record = $this->db->get_where( $sign_table, array( $sign_key => $layout_record['exit_interview_layout_id'], 'deleted' => 0) );
				$sign_records = $record->result_array();
				foreach($sign_records as $val){
					$insert_signatories[$this->mod->primary_key] = $record_id;
					$insert_signatories['exit_interview_layout_item_id'] = $val['exit_interview_layout_item_id'];
					$insert_signatories['item'] = $val['item'];
					$insert_signatories['status_id'] = 1;
					$insert_signatories['yes_no'] = $val['wiht_yes_no'];
					$this->db->insert('partners_clearance_exit_interview_answers', $insert_signatories);
				}
			}
		}
		$sign_table = 'partners_clearance_exit_interview_answers';
		$sign_key = $this->mod->primary_key;
		$this->db->select('partners_clearance_exit_interview_answers.exit_interview_answers_id,partners_clearance_exit_interview_answers.exit_interview_layout_item_id,partners_clearance_exit_interview_answers.item,partners_clearance_exit_interview_answers.remarks,partners_clearance_exit_interview_answers.yes_no,partners_clearance_exit_interview_layout_item.wiht_yes_no,partners_clearance_exit_interview_answers.answer,partners_clearance_exit_interview_answers.answer_radio');
		$this->db->join('partners_clearance_exit_interview_layout_item','partners_clearance_exit_interview_answers.exit_interview_layout_item_id = partners_clearance_exit_interview_layout_item.exit_interview_layout_item_id','left');
		$record = $this->db->get_where( $sign_table, array( $sign_key => $record_id, 'partners_clearance_exit_interview_answers.deleted' => 0) );

		$sign_records = $record->result_array();

		$this->load->helper('form');
		$this->load->helper('file');
		$data['clearance_record'] = $clearance_record;
		if( !strtotime($data['clearance_record']['turn_around_time']) ){
			$data['clearance_record']['turn_around_time'] = '';
		}
		$data['partner_record'] = $partner_record;
		$data['layout_record'] = $layout_record;
		$data['sign_records'] = $sign_records;
		$this->load->vars( $data );

		echo $this->load->blade('pages.edit_exit_interview')->with( $this->load->get_cached_vars() );
	
	}

	// new function : tirso garcia
    function get_exit_interview_base_template(){

		$this->load->helper('form');
		$this->load->helper('file');
		$sign_record['records'] = array();
		$record_id = $_POST['clearance_id'];

		$user_info = $this->mod->get_user_info($record_id);

		$sign_table = 'partners_clearance_exit_interview_layout_item';
		$sign_key = 'exit_interview_layout_id';
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->input->post('exit_interview_layout_id'), 'deleted' => 0) );

		$sign_record['records'] = $record->result_array();
		$sign_record['from_template'] = 1;
		$sign_record['company_name'] = '';

		if ($user_info)
			$sign_record['company_name'] = $user_info['company'];

		if ($this->input->post('template_only') && $this->input->post('template_only') == 1){
			$sign_record['count'] = $this->input->post('count');
			$sign_record['records'] = array();
			$sign_record['records'][] = array('item' => $this->input->post('item'),'exit_interview_layout_item_id' => $this->input->post('exit_interview_layout_item_id'),'wiht_yes_no' => 0);
			$sign_record['from_template'] = 0;
		}

        $this->response->signatory = $this->load->view('edit/questions', $sign_record, true);
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function get_exit_interview(){

		$this->load->helper('form');
		$this->load->helper('file');
		$sign_record['records'] = array();
		$record_id = $_POST['clearance_id'];

		$sign_table = 'partners_clearance_exit_interview_layout_item';
		$sign_key = 'exit_interview_layout_id';
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->input->post('exit_interview_layout_id'), 'deleted' => 0) );

		$clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
		$clearance_record = $clearance_record->row_array();

		$partner_record = $this->db->get_where( 'users_profile', array( 'partner_id' => $clearance_record['partner_id']) );
		$partner_record = $partner_record->row_array();

		if( $record->num_rows() > 0 && $this->input->post('change_layout') == 1 ){
			$this->db->delete('partners_clearance_exit_interview_answers', array($this->mod->primary_key => $record_id)); 
			$sign_record['records'] = $record->result_array();
			foreach($sign_record['records'] as $val){
				$insert_signatories[$this->mod->primary_key] = $record_id;
				$insert_signatories['item'] = $val['item'];
				$insert_signatories['status_id'] = 1;
				$this->db->insert('partners_clearance_exit_interview_answers', $insert_signatories);
			}
			$this->db->update( $this->mod->table, array('exit_interview_layout_id' => $this->input->post('exit_interview_layout_id')), array( $this->mod->primary_key => $record_id ) );
		}
		$sign_table = 'partners_clearance_exit_interview_answers';
		$sign_key = $this->mod->primary_key;
		$record = $this->db->get_where( $sign_table, array( $sign_key => $record_id, 'deleted' => 0) );
		$sign_record['records'] = $record->result_array();

        $this->response->signatory = $this->load->view('edit/questions', $sign_record, true);
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }
   
    function add_item()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
		// $record['user_id']
		if($vars['exit_interview_answers_id']){
			$record = $this->db->get_where( 'partners_clearance_exit_interview_answers', array( 'exit_interview_answers_id' => $vars['exit_interview_answers_id'] ) )->row_array();
		}else{
			$record['user_id'] = 0;
			$record['item'] = '';
			$record['exit_interview_layout_item_id'] = '';
			$record['clearance_id'] = $vars['record_id'];
			$record['exit_interview_answers_id'] = '';
		}

        $this->load->vars($record);
		$this->load->helper('form');
		$this->load->helper('file');

        $data['title'] = 'Exit Interview';
        $data['content'] = $this->load->blade('edit.question')->with( $this->load->get_cached_vars() );

        $this->response->sign = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function save_item()
    {
        $validation_rules[] = 
        array(
            'field' => 'partners_clearance_exit_interview_answers[item]',
            'label' => 'Panel Title',
            'rules' => 'required'
            );

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

		$sign_table = 'partners_clearance_exit_interview_answers';
		$sign_key = 'exit_interview_answers_id';
        $transactions = true;
		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post[$sign_table]['exit_interview_answers_id'];
		$this->response->clearance_id = $this->clearance_id = $post[$sign_table]['clearance_id'];
		// unset( $post['record_id'] );

		if( $transactions )
		{
			$this->db->trans_begin();
		}

		//start saving with main table
		$main_record = $post[$sign_table];
		$record = $this->db->get_where( $sign_table, array( $sign_key => $this->record_id ) );
	
		switch( true )
		{
			case $record->num_rows() == 0:
				//add mandatory fields
				// $main_record['created_by'] = $this->user->user_id;
				$this->db->insert($sign_table, $main_record);
				if( $this->db->_error_message() == "" )
				{
					$this->response->record_id = $this->record_id = $this->db->insert_id();
				}
				$this->response->action = 'insert';

				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, array(), $main_record, '');
				break;
			case $record->num_rows() == 1:
				// $main_record['modified_by'] = $this->user->user_id;
				// $main_record['modified_on'] = date('Y-m-d H:i:s');
				$this->db->update( $sign_table, $main_record, array( $sign_key => $this->record_id ) );
				$this->response->action = 'update';

				$previous_main_data = $record->row_array();
				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $sign_table, $previous_main_data, $main_record, '');
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

		if( !$error )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }

	function delete_item( )
	{
		// $data['modified_on'] = date('Y-m-d H:i:s');
		// $data['modified_by'] = $this->user->user_id;

		$sign_table = 'partners_clearance_exit_interview_answers';
		$sign_key = 'exit_interview_answers_id';
		$data['deleted'] = 1;

		$this->db->where_in($sign_key, $_POST['records']);
		$this->db->update($sign_table, $data);
		
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

    function save_exit_interview()
    {
        $transactions = true;
		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post['record_id'];
		unset( $post['record_id'] );

		//start saving with main table
		$main_record['status_id'] = $post['status_id'];
		$main_record['exit_interviewed'] = $post['exit_interviewed'];

		if (isset($post['partners_clearance']['exit_interview_layout_id']))
			$main_record['exit_interview_layout_id'] = $post['partners_clearance']['exit_interview_layout_id'];
		if (isset($post['partners_clearance']['turn_around_time']))
			$main_record['turn_around_time'] = date('Y-m-d',strtotime($post['partners_clearance']['turn_around_time']));

		$record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $this->record_id ) );

		$to_delete_existing_exit_interview_answer = 0;
		if ($record && $record->num_rows() > 0) {
			$clearance_record = $record->row();
			$previous_main_data = $record->row_array();

			if (isset($post['partners_clearance']) && $post['partners_clearance']['exit_interview_layout_id'] != $clearance_record->exit_interview_layout_id)
				$to_delete_existing_exit_interview_answer = 1;
		}

		switch( true )
		{
			case $record->num_rows() == 1:
				// $main_record['modified_by'] = $this->user->user_id;
				// $main_record['modified_on'] = date('Y-m-d H:i:s');
				$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $this->record_id ) );
				$this->response->action = 'update';

				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $this->response->action, $this->mod->table, $previous_main_data, $main_record, $previous_main_data['user_id']);				
				break;
			default:
				$this->response->message[] = array(
					'message' => lang('common.inconsistent_data'),
					'type' => 'error'
				);
				$error = true;
				goto stop;
		}

		$item = (isset($post['item']) ? $post['item'] : array());
		$exit_interview_answers_id = (isset($post['exit_interview_answers_id']) ? $post['exit_interview_answers_id'] : array());
		$exit_interview_layout_item_id = (isset($post['exit_interview_layout_item_id']) ? $post['exit_interview_layout_item_id'] : array());
		$interview = (isset($post['interview']) ? $post['interview'] : array());
		$yes_no = (isset($post['yes_no']) ? $post['yes_no'] : array());
		$answer_radio = (isset($post['answer']) ? $post['answer'] : array());
		$answer_text = (isset($post['answer_text']) ? $post['answer_text'] : array());
		$sub_answer = (isset($post['sub_answer']) ? $post['sub_answer'] : array());

		if ($to_delete_existing_exit_interview_answer) {
			$this->db->where('clearance_id',$this->record_id);
			$this->db->delete('partners_clearance_exit_interview_answers');


			foreach ($item as $key => $value) {
				$interview_info = array('clearance_id' => $this->record_id,
										 'exit_interview_layout_item_id' => $exit_interview_layout_item_id[$key],
										 'item' => $value,
										 'remarks' => (isset($interview[$key]) ? $interview[$key] : ''),
										 'yes_no' => (isset($yes_no[$exit_interview_layout_item_id[$key]]) ? $yes_no[$exit_interview_layout_item_id[$key]] : 0),
										 'answer_radio' => (isset($answer_radio[$exit_interview_layout_item_id[$key]]) ? $answer_radio[$exit_interview_layout_item_id[$key]] : 0),
										 'answer' => (isset($answer_text[$exit_interview_layout_item_id[$key]]) ? $answer_text[$exit_interview_layout_item_id[$key]] : ''),
										);

				$this->db->insert('partners_clearance_exit_interview_answers',$interview_info);

				$this->db->where('exit_interview_layout_item_id',$exit_interview_layout_item_id[$key]);
				$this->db->delete('partners_clearance_exit_interview_layout_item_sub_answer');

				if (isset($sub_answer[$exit_interview_layout_item_id[$key]])){
					foreach ($sub_answer[$exit_interview_layout_item_id[$key]] as $exit_interview_layout_item_sub_id => $answer1) {
						foreach ($answer1 as $key1 => $value1) {
							$answer_array = array(
													'exit_interview_layout_item_id' => $exit_interview_layout_item_id[$key],
													'exit_interview_layout_item_sub_id' => $exit_interview_layout_item_sub_id,
													'answer' => $value1
												  );
							$this->db->insert('partners_clearance_exit_interview_layout_item_sub_answer',$answer_array);
						}
					}
				}

			}
		}
		else {
			if (!$this->permission['process']) {
				foreach ($item as $key => $value) {
					$interview_info = array('clearance_id' => $this->record_id,
											 'exit_interview_layout_item_id' => $exit_interview_layout_item_id[$key],
											 'item' => $value,
											 'remarks' => (isset($interview[$key]) ? $interview[$key] : ''),
											 'yes_no' => (isset($yes_no[$exit_interview_layout_item_id[$key]]) ? $yes_no[$exit_interview_layout_item_id[$key]] : 0),
											 'answer_radio' => (isset($answer_radio[$exit_interview_layout_item_id[$key]]) ? $answer_radio[$exit_interview_layout_item_id[$key]] : 0),
											 'answer' => (isset($answer_text[$exit_interview_layout_item_id[$key]]) ? $answer_text[$exit_interview_layout_item_id[$key]] : ''),
											);

					$this->db->where('exit_interview_answers_id',$exit_interview_answers_id[$key]);
					$this->db->update('partners_clearance_exit_interview_answers',$interview_info);
				}
			}
		}

		if ($main_record['exit_interviewed'] == 1)
			$this->mod->notify_hr($this->record_id,$clearance_record);

		if( $this->db->_error_message() != "" ){
			$this->response->message[] = array(
				'message' => $this->db->_error_message(),
				'type' => 'error'
			);
			$error = true;
			goto stop;
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

		if( !$error )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;

        $this->_ajax_return();
    }
   
	public function add_account(){
		$sign_record = $_POST;
        $this->response->accountability = $this->load->view('edit/accountability', $sign_record, true);
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
	}

	public function cancel_clearance()
	{
		$this->_ajax_only();
		$user_id = $this->input->post('user_id');
		$action_id = $this->input->post('action_id');
		$clearance_id = $this->input->post('clearance_id');

		$main_record = array('status_id' => 5);

		$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $clearance_id ) );
		$clearance_update = true;

		if($clearance_update == true){
			$this->response->message[] = array(
	            'message' => lang('common.save_success'),
	            'type' => 'success'
	        );
		}else{
			$this->response->message[] = array(
				'message' => 'Something went wrong.',
				'type' => 'error'
			);
		}

		$this->response->saved = $clearance_update;
		
 		$this->_ajax_return();  
		
	}

	// print clearnce form
/*    function print_clearance_form(){
        $clearance_id = $this->input->post('record_id');

        $filename = $this->mod->export_excel($clearance_id);

        $this->response->message[] = array(
            'message' => 'Download file ready.',
            'type' => 'success'
        );

        $this->response->filename = $filename;
        $this->_ajax_return();
    }
*/

    function print_exit_interview()
    {

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        $mpdf->SetTitle( 'Clearance Form' );
        $mpdf->SetAutoPageBreak(true, 5);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        // template data
        $record_id = $this->input->post('record_id');
        $clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
        $clearance_record = $clearance_record->row_array();

        $partner_record = "SELECT up.*, ud.department as dept, u.login, upos.position, p.effectivity_date as date_hired, p.resigned_date, pmr.reason, uc.company as comp, uc.print_logo FROM {$this->db->dbprefix}users_profile up
                        INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
                        LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
                        LEFT JOIN {$this->db->dbprefix}users u ON up.user_id = u.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position upos ON up.position_id = upos.position_id
                        LEFT JOIN {$this->db->dbprefix}partners p ON up.partner_id = p.partner_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action pma ON up.user_id = pma.user_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action_moving pmam ON pma.movement_id = pmam.movement_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_reason pmr ON pmam.reason_id = pmr.reason_id
                        WHERE up.partner_id = {$clearance_record['partner_id']} ";
        $partner_record = $this->db->query($partner_record)->row_array();
        // debug($partner_record); die;

        $template_data['company_name'] = $partner_record['company'];
        $template_data['title'] = $partner_record['firstname']." ".$partner_record['middlename']." ".$partner_record['lastname'];
        $template_data['employee_no'] = $partner_record['login'];
        $template_data['employee_name'] = $partner_record['firstname']." ".substr($partner_record['middlename'],0, 1).". ".$partner_record['lastname'];
        $template_data['position'] = $partner_record['position'];
        $template_data['department'] = $partner_record['dept'];
        $template_data['date_hired'] =  ($partner_record['date_hired'] && $partner_record['date_hired'] != '0000-00-00' && $partner_record['date_hired'] != 'January 01, 1970' && $partner_record['date_hired'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['date_hired'])) : '';
        $template_data['resigned_date'] = ($partner_record['resigned_date'] && $partner_record['resigned_date'] != '0000-00-00' && $partner_record['resigned_date'] != 'January 01, 1970' && $partner_record['resigned_date'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['resigned_date'])) : '';
        $template_data['filled_date'] = date('F d, Y');
        $template_data['reason'] = $partner_record['reason'];
		$template_data['logo'] = base_url().$partner_record['print_logo'];
		$template_data['hr_head'] = 'Marybeth G. Monis';

        //$this->db->where('clearance_id',$record_id);
        //$exit_interview_answer_result = $this->db->get('partners_clearance_exit_interview_answers');

		$this->db->select('partners_clearance_exit_interview_answers.exit_interview_layout_item_id,partners_clearance_exit_interview_answers.item,partners_clearance_exit_interview_answers.remarks,partners_clearance_exit_interview_answers.yes_no,partners_clearance_exit_interview_answers.answer_radio,partners_clearance_exit_interview_layout_item.wiht_yes_no');
		$this->db->where('partners_clearance_exit_interview_answers.clearance_id',$record_id);
		$this->db->where('partners_clearance_exit_interview_answers.yes_no',0);
		$this->db->join('partners_clearance_exit_interview_layout_item','partners_clearance_exit_interview_answers.exit_interview_layout_item_id = partners_clearance_exit_interview_layout_item.exit_interview_layout_item_id','left');
		$exit_interview_answer_result = $this->db->get('partners_clearance_exit_interview_answers');


        if ($exit_interview_answer_result && $exit_interview_answer_result->num_rows() > 0){
        	$ctr = 1;
        	$html = '<table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;border-spacing: 0; font-size: 10px;">
        				<thead>
        					<tr>
        						<th></th>
        						<th>Not at All</th>
        						<th>Small Degree</th>
        						<th>Moderate Degree</th>
        						<th>High Degree</th>
        					</tr>
        				</thead>
        				<tbody>';

        	foreach ($exit_interview_answer_result->result() as $row) {
			    $html .= '
			     	<tr>
			     		<td width="60%">'.$row->item.'</td>
			     		<td width="10%" align="center">'.($row->answer_radio == 1 ? 'X' : '').'</td>
			     		<td width="10%" align="center">'.($row->answer_radio == 2 ? 'X' : '').'</td>
			     		<td width="10%" align="center">'.($row->answer_radio == 3 ? 'X' : '').'</td>
			     		<td width="10%" align="center">'.($row->answer_radio == 4 ? 'X' : '').'</td>
			     	</tr>
			    ';
        	}			

        	$html .= '</tbody></table>';
        }

		$this->db->select('partners_clearance_exit_interview_answers.exit_interview_layout_item_id,partners_clearance_exit_interview_answers.item,partners_clearance_exit_interview_answers.remarks,partners_clearance_exit_interview_answers.yes_no,partners_clearance_exit_interview_answers.answer_radio,partners_clearance_exit_interview_answers.answer,partners_clearance_exit_interview_layout_item.wiht_yes_no');
		$this->db->where('partners_clearance_exit_interview_answers.clearance_id',$record_id);
		$this->db->where('partners_clearance_exit_interview_answers.yes_no',1);
		$this->db->join('partners_clearance_exit_interview_layout_item','partners_clearance_exit_interview_answers.exit_interview_layout_item_id = partners_clearance_exit_interview_layout_item.exit_interview_layout_item_id','left');
		$exit_interview_answer_result_text = $this->db->get('partners_clearance_exit_interview_answers');

		if ($exit_interview_answer_result_text && $exit_interview_answer_result_text->num_rows() > 0) {
			foreach ($exit_interview_answer_result_text->result() as $row_text) {
				$html .= '<p>'.$row_text->item.'</p>';
				$html .= '<p>'.$row_text->answer.'</p>';
			}
		}

        $template_data['exit_interview_body'] = $html;

        $this->load->helper('file');
        $this->load->library('parser');

        $template = $this->db->get_where( 'system_template', array( 'code' => 'CLEARANCE-FORM-EXIT', 'deleted' => 0) )->row_array();
        $this->parser->set_delimiters('{{', '}}');
        $html = $this->parser->parse_string($template['body'], $template_data, TRUE);

        $this->load->helper('file');
        $path = 'uploads/templates/clearance_form/';
        $this->check_path( $path );
        $filename = $path .$partner_record['lastname'].", ".$partner_record['firstname']. "-".'Clearance Form' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
    } 

    function print_clearance_form()
    {

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        $mpdf->SetTitle( 'Clearance Form' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        // template data
        $record_id = $this->input->post('record_id');
        $clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
        $clearance_record = $clearance_record->row_array();

        $partner_record = "SELECT up.*, ud.department as dept, u.login, upos.position, p.effectivity_date as date_hired, p.resigned_date, pmr.reason, uc.company as comp,uc.print_logo FROM {$this->db->dbprefix}users_profile up
                        INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
                        LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
                        LEFT JOIN {$this->db->dbprefix}users u ON up.user_id = u.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position upos ON up.position_id = upos.position_id
                        LEFT JOIN {$this->db->dbprefix}partners p ON up.partner_id = p.partner_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action pma ON up.user_id = pma.user_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action_moving pmam ON pma.movement_id = pmam.movement_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_reason pmr ON pmam.reason_id = pmr.reason_id
                        WHERE up.partner_id = {$clearance_record['partner_id']} ";
        $partner_record = $this->db->query($partner_record)->row_array();
        // debug($partner_record); die;

        $template_data['title'] = $partner_record['firstname']." ".$partner_record['middlename']." ".$partner_record['lastname'];
        $template_data['employee_no'] = $partner_record['login'];
        $template_data['employee_name'] = $partner_record['firstname']." ".substr($partner_record['middlename'],0, 1).". ".$partner_record['lastname'];
        $template_data['position'] = $partner_record['position'];
        $template_data['department'] = $partner_record['dept'];
        $template_data['date_hired'] =  ($partner_record['date_hired'] && $partner_record['date_hired'] != '0000-00-00' && $partner_record['date_hired'] != 'January 01, 1970' && $partner_record['date_hired'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['date_hired'])) : '';
        $template_data['resigned_date'] = ($partner_record['resigned_date'] && $partner_record['resigned_date'] != '0000-00-00' && $partner_record['resigned_date'] != 'January 01, 1970' && $partner_record['resigned_date'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['resigned_date'])) : '';
        $template_data['filled_date'] = date('F d, Y');
        $template_data['reason'] = $partner_record['reason'];
		$template_data['logo'] = base_url().$partner_record['print_logo'];

        $this->db->select('partners_clearance_layout_sign.clearance_layout_id,partners_clearance_signatories.panel_title,partners_clearance_signatories.remarks,users.full_name,partners_clearance_status.status,GROUP_CONCAT(accountability SEPARATOR "<br> ") AS accountabilities');
        $this->db->where('partners_clearance_layout_sign.clearance_layout_id',$clearance_record['clearance_layout_id']);
        $this->db->where('properties_tagging',0);
        $this->db->where('partners_clearance_signatories.clearance_id',$record_id);
        $this->db->join('partners_clearance_signatories','partners_clearance_layout_sign.clearance_layout_sign_id = partners_clearance_signatories.clearance_layout_sign_id');
        $this->db->join('partners_clearance_signatories_accountabilities','ww_partners_clearance_signatories.clearance_signatories_id = partners_clearance_signatories_accountabilities.clearance_signatories_id','left');
        $this->db->join('users','partners_clearance_signatories.user_id = users.user_id');
        $this->db->join('partners_clearance_status','partners_clearance_status.status_id = partners_clearance_signatories.status_id');
        $this->db->group_by('partners_clearance_signatories.user_id,ww_partners_clearance_signatories.clearance_signatories_id');
        $this->db->order_by('partners_clearance_layout_sign.clearance_layout_sign_id');
        $result_op = $this->db->get('partners_clearance_layout_sign');

        $this->db->select('partners_clearance_layout_sign.clearance_layout_id,partners_clearance_signatories.panel_title,partners_clearance_signatories.remarks,users.full_name,partners_clearance_status.status,GROUP_CONCAT(accountability SEPARATOR "<br> ") AS accountabilities');
        $this->db->where('partners_clearance_layout_sign.clearance_layout_id',$clearance_record['clearance_layout_id']);
        $this->db->where('properties_tagging',1);
        $this->db->where('partners_clearance_signatories.clearance_id',$record_id);
        $this->db->join('partners_clearance_signatories','partners_clearance_layout_sign.clearance_layout_sign_id = partners_clearance_signatories.clearance_layout_sign_id');
        $this->db->join('partners_clearance_signatories_accountabilities','ww_partners_clearance_signatories.clearance_signatories_id = partners_clearance_signatories_accountabilities.clearance_signatories_id','left');
        $this->db->join('users','partners_clearance_signatories.user_id = users.user_id');
        $this->db->join('partners_clearance_status','partners_clearance_status.status_id = partners_clearance_signatories.status_id');
        $this->db->group_by('partners_clearance_signatories.user_id,ww_partners_clearance_signatories.clearance_signatories_id');
        $this->db->order_by('partners_clearance_layout_sign.clearance_layout_sign_id');
        $result_p = $this->db->get('partners_clearance_layout_sign');

        $both = false;
        if (($result_op->num_rows() && $result_op->num_rows() > 0) && ($result_op->num_rows() && $result_op->num_rows() > 0)){
        	$both = true;
        }

        $html = '';

        if ($result_op && $result_op->num_rows() > 0){
        	if ($both){
		        $this->db->where('clearance_layout_id',$result_op->row()->clearance_layout_id);
		        $result_lo = $this->db->get('ww_partners_clearance_layout');
		        $title_p = '';
		        if ($result_lo && $result_lo->num_rows() > 0){
		        	$title_p = $result_lo->row()->layout_name;
		        }	
        		$html .= '<p>1st PART (Property Based)</p>';
        	}

			$html .= '<table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;border-spacing: 0; font-size: 10px;">
				<thead>
					<tr>
						<td width="20%"><center>OFFICE</center></td>
						<td width="20%"><center>ACCOUNTABILITY</center></td>
						<td width="30%"><center>REMARKS</center></td>
						<td width="10%"><center>STATUS</center></td>
						<td width="20%"><center>NAME & SIGNATURE</center></td>
					</tr>			
				</thead>';

        	foreach ($result_op->result() as $row) {
				$html .= '<tr>
							<td width="20%"><center>'.$row->panel_title.'</center></td>
							<td width="20%"><center>'.$row->accountabilities.'</center></td>
							<td width="30%"><center>'.$row->remarks.'</center></td>
							<td width="10%"><center>'.($row->status == 'Open' ? " " : $row->status).'</center></td>
							<td width="20%"><center>'.ucwords($row->full_name).'</center></td>
						</tr>';
			}

			$html .= '	
			</table>';			
        }

        if ($result_p && $result_p->num_rows() > 0){
        	if ($both){
		        $this->db->where('clearance_layout_id',$result_p->row()->clearance_layout_id);
		        $result_lo = $this->db->get('ww_partners_clearance_layout');
		        $title_p = '';
		        if ($result_lo && $result_lo->num_rows() > 0){
		        	$title_p = $result_lo->row()->layout_name;
		        }	
        		$html .= '<p>2nd PART (Head Office)</p>';
        	}

			$html .= '<table width="100%" border="1" cellspacing="0" style="border-collapse: collapse;border-spacing: 0; font-size: 10px;">
				<thead>
					<tr>
						<td width="20%"><center>DEPARTMENT</center></td>
						<td width="20%"><center>ACCOUNTABILITY</center></td>
						<td width="30%"><center>REMARKS</center></td>
						<td width="10%"><center>STATUS</center></td>
						<td width="20%"><center>NAME/SIGNATURE</center></td>
					</tr>			
				</thead>';

        	foreach ($result_p->result() as $row) {
				$html .= '<tr>
							<td width="20%" style="padding-top:10px"><center>'.$row->panel_title.'</center></td>
							<td width="20%" style="padding-top:10px"><center>'.$row->accountabilities.'</center></td>
							<td width="30%" style="padding-top:10px"><center>'.$row->remarks.'</center></td>
							<td width="10%" style="padding-top:10px"><center>'.($row->status == 'Open' ? " " : $row->status).'</center></td>
							<td width="20%" style="padding-top:10px"><center>'.ucwords($row->full_name).'</center></td>
						</tr>';
			}

			$html .= '	
			</table>';			
        }

        $template_data['clearance_body'] = $html;

        $this->load->helper('file');
        $this->load->library('parser');

        $template = $this->db->get_where( 'system_template', array( 'code' => 'CLEARANCE-FORM', 'deleted' => 0) )->row_array();
        $this->parser->set_delimiters('{{', '}}');
        $html = $this->parser->parse_string($template['body'], $template_data, TRUE);

        $this->load->helper('file');
        $path = 'uploads/templates/clearance_form/';
        $this->check_path( $path );
        $filename = $path .$partner_record['lastname'].", ".$partner_record['firstname']. "-".'Clearance Form' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
    } 

    function print_release_quitclaim()
    {

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        $mpdf->SetTitle( 'Clearance Form' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        // template data
        $record_id = $this->input->post('record_id');
        $clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
        $clearance_record = $clearance_record->row_array();

        $partner_record = "SELECT up.*, ud.department as dept, u.login, upos.position, p.effectivity_date as date_hired, p.resigned_date, pmr.reason, uc.company as comp, uc.print_logo FROM {$this->db->dbprefix}users_profile up
                        INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
                        LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
                        LEFT JOIN {$this->db->dbprefix}users u ON up.user_id = u.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position upos ON up.position_id = upos.position_id
                        LEFT JOIN {$this->db->dbprefix}partners p ON up.partner_id = p.partner_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action pma ON up.user_id = pma.user_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_action_moving pmam ON pma.movement_id = pmam.movement_id
                        LEFT JOIN {$this->db->dbprefix}partners_movement_reason pmr ON pmam.reason_id = pmr.reason_id
                        WHERE up.partner_id = {$clearance_record['partner_id']} ";
        $partner_record = $this->db->query($partner_record)->row_array();

        $address = '';
        $this->load->model('partners_model', 'partners_mod');       
        $partners_personal = $this->partners_mod->get_partners_personal($partner_record['user_id'], 'partners_personal', 'address_1', 1);
        if(!empty($partners_personal)){
        	$address = '____________________________________________';
            //$address = $partners_personal[0]['key_value'];
        } else {
            $address = '____________________________________________';
        }

        $nationality = $this->partners_mod->get_partners_personal($partner_record['user_id'], 'partners_personal', 'nationality', 1);

        //$template_data['title'] = $partner_record['firstname']." ".$partner_record['middlename']." ".$partner_record['lastname'];
        $template_data['employee_no'] = $partner_record['login'];
        $template_data['employee_name'] = $partner_record['firstname']." ".substr($partner_record['middlename'],0, 1).". ".$partner_record['lastname'];
        $template_data['position'] = $partner_record['position'];
        $template_data['department'] = $partner_record['dept'];
        $template_data['date_hired'] =  ($partner_record['date_hired'] && $partner_record['date_hired'] != '0000-00-00' && $partner_record['date_hired'] != 'January 01, 1970' && $partner_record['date_hired'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['date_hired'])) : '';
        $template_data['resigned_date'] = ($partner_record['resigned_date'] && $partner_record['resigned_date'] != '0000-00-00' && $partner_record['resigned_date'] != 'January 01, 1970' && $partner_record['resigned_date'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['resigned_date'])) : '';
        $template_data['reason'] = $partner_record['reason'];
        $template_data['day_month'] = date('jS');
        $template_data['date_month'] = date('F');
        $template_data['year'] = date('Y');
        $template_data['address'] = $address;
        $template_data['title'] = $partner_record['title'];
        $template_data['day'] = date('j\<\s\u\p\>S\<\/\s\u\p\>');
		$template_data['company'] = $partner_record['company'];
		$template_data['logo'] = base_url().$partner_record['print_logo'];
		$template_data['nationality'] = ($nationality[0]['key_value'] != '' ? $nationality[0]['key_value'] : 'Filipino');

		$template_data['amount_words'] = '______________________________________________';
		$template_data['amount'] = 'Php __________';
		$template_data['hrd'] = 'MARYBETH G. MONIS';

        $this->load->helper('file');
        $this->load->library('parser');

        $template = $this->db->get_where( 'system_template', array( 'code' => 'RELEASE-QUITCLAIM', 'deleted' => 0) )->row_array();
        $this->parser->set_delimiters('{{', '}}');
        $html = $this->parser->parse_string($template['body'], $template_data, TRUE);

        $this->load->helper('file');
        $path = 'uploads/templates/clearance_form/';
        $this->check_path( $path );
        $filename = $path .$partner_record['lastname'].", ".$partner_record['firstname']. "-".'Release Waiver and Quitclaim' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
    }

    function print_coe()
    {

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        $mpdf->SetTitle( 'Clearance Form' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        // template data
        $record_id = $this->input->post('record_id');
        $clearance_record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $record_id) );
        $clearance_record = $clearance_record->row_array();

        $partner_record = "SELECT up.*, ud.department as dept, u.login, upos.position, p.effectivity_date as date_hired, p.resigned_date, uc.company as comp, uc.print_logo FROM {$this->db->dbprefix}users_profile up
                        INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
                        LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
                        LEFT JOIN {$this->db->dbprefix}users u ON up.user_id = u.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position upos ON up.position_id = upos.position_id
                        LEFT JOIN {$this->db->dbprefix}partners p ON up.partner_id = p.partner_id
                        WHERE up.partner_id = {$clearance_record['partner_id']} ";
        $partner_record = $this->db->query($partner_record)->row_array();
        // debug($partner_record);
        // get hr supervisor
        $hr_supervisor = "SELECT full_name as hr_supervisor FROM {$this->db->dbprefix}users WHERE role_id = 2 LIMIT 1";
        $hr_supervisor = $this->db->query($hr_supervisor)->row_array();

		$hrd = get_hr_head();

        $template_data['title'] = $partner_record['firstname']." ".$partner_record['middlename']." ".$partner_record['lastname'];
        $template_data['employee_name'] = $partner_record['firstname']." ".substr($partner_record['middlename'],0, 1).". ".$partner_record['lastname'];
        $template_data['position'] = ucwords($partner_record['position']);
        $template_data['division'] = $partner_record['v_division'] ?? '';
        $template_data['date_hired'] =  ($partner_record['date_hired'] && $partner_record['date_hired'] != '0000-00-00' && $partner_record['date_hired'] != 'January 01, 1970' && $partner_record['date_hired'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['date_hired'])) : '';
        $template_data['resigned_date'] = ($partner_record['resigned_date'] && $partner_record['resigned_date'] != '0000-00-00' && $partner_record['resigned_date'] != 'January 01, 1970' && $partner_record['resigned_date'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['resigned_date'])) : '';
        $template_data['gender'] = $partner_record['title'];
        $template_data['company'] = $partner_record['company'];
        $template_data['hr_supervisor'] = ucwords($hr_supervisor['hr_supervisor']);
        $template_data['basic'] = $partner_record['basic'];
        $template_data['logo'] = base_url().$partner_record['print_logo'];
        $template_data['basic_in_words'] = strtoupper(convert_number_to_words($partner_record['basic']));
        $template_data['filled_date'] = date('F d, Y');
        $template_data['day'] = date('j\<\s\u\p\>S\<\/\s\u\p\>');
        $template_data['month_year'] = date('M Y');
        $template_data['her_his_caps'] = ($partner_record['title'] == 'Mr.') ? 'His' : 'Her';
        $template_data['she_he'] = ($partner_record['title'] == 'Mr.') ? 'he' : 'she';
        $template_data['his_her'] = ($partner_record['title'] == 'Mr.') ? 'his' : 'her';
        $template_data['she_he_caps'] = ($partner_record['title'] == 'Mr.') ? 'He' : 'She';
        $template_data['title_lastname'] = $partner_record['title'] ." ". $partner_record['lastname'] ?? '';
        $template_data['firstname'] = $partner_record['title'] ." ". $partner_record['lastname'];
        $template_data['hrd'] = $hrd['full_name'];
        $template_data['hrd_position'] = $hrd['position'];
        // debug($template_data);

        $this->load->helper('file');
        $this->load->library('parser');

        $template = $this->db->get_where( 'system_template', array( 'code' => 'CERTIFICATE-OF-EMPLOYMENT', 'deleted' => 0) )->row_array();
        $this->parser->set_delimiters('{{', '}}');
        $html = $this->parser->parse_string($template['body'], $template_data, TRUE);

        $this->load->helper('file');
        $path = 'uploads/templates/clearance_form/';
        $this->check_path( $path );
        $filename = $path .$partner_record['lastname'].", ".$partner_record['firstname']. "-".'Certificate of Employment' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
    }

    private function check_path( $path, $create = true )
    {
        if( !is_dir( FCPATH . $path ) ){
            if( $create )
            {
                $folders = explode('/', $path);
                $cur_path = FCPATH;
                foreach( $folders as $folder )
                {
                    $cur_path .= $folder;

                    if( !is_dir( $cur_path ) )
                    {
                        mkdir( $cur_path, 0777, TRUE);
                        $indexhtml = read_file( APPPATH .'index.html');
                        write_file( $cur_path .'/index.html', $indexhtml);
                    }

                    $cur_path .= '/';
                }
            }
            return false;
        }
        return true;
    }

	public function multiple_upload()
	{
		$this->_ajax_only();
		define('UPLOAD_DIR', 'uploads/'.$this->mod->mod_code . '/');
		
		$this->load->library("UploadHandler");

		$this->response->message[] = array();	

		$files = $this->uploadhandler->post();
		$file = $files[0];
		if( isset($file->error) && $file->error != "" )
		{
			$this->response->message[] = array(
				'message' => $file->error,
				'type' => 'error'
			);	
		}
		$this->response->file = $file;
		$this->_ajax_return();
	}

	public function delete_bg_image()
	{
		$this->_ajax_only();
		if(isset($_POST['bg_image']))
		{
		    $bgm = $_POST['bg_image'];
		    //$this->db->delete('config', array( 'config_id' => $bgm ) );
		    
            $this->db->update( 'config', array( 'deleted' => 1 ) , array( 'config_id' => $bgm ) );
		    $this->response->message = array(
				'message' => 'Successful.',
				'type' => 'success'
			);

		}
		
		else{
			$this->response->message = array(
				'message' => 'Failed.',
				'type' => 'error'
			);	
		} 
		
		$this->_ajax_return();	
	}	
}

