<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_request_manage_model extends Record
{
	var $mod_id;
	var $mod_code;
	var $route;
	var $url;
	var $primary_key;
	var $table;
	var $icon;
	var $short_name;
	var $long_name;
	var $description;
	var $path;

	public function __construct()
	{
		$this->mod_id = 278;
		$this->mod_code = 'training_request_manage';
		$this->route = 'training/training_request_manage';
		$this->url = site_url('training/training_request_manage');
		$this->primary_key = 'training_application_id';
		$this->table = 'training_application';
		$this->icon = '';
		$this->short_name = 'Training Request Manage';
		$this->long_name  = 'Training Request Manage';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_request_manage/';

		parent::__construct();
	}

	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
		$data = array();				
		
		$qry = $this->_get_list_cached_query();
		
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}
		
		$qry .= " AND T5.approver_id = {$this->user->user_id} AND T5.training_application_status_id > 2";	

		$qry .= " AND {$this->db->dbprefix}{$this->table}.status_id > 2";

		$qry .= ' '. $filter;
		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);

		$result = $this->db->query( $qry );
		if($result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}

	public function get_approver_details($training_application_id=0,$approver_id=0)
	{
		$this->db->where('training_application_id',$training_application_id);
		$this->db->where('approver_id',$approver_id);
		$result = $this->db->get('training_application_approver');

		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}

	function change_status( $record_id=0, $status_id=0, $comment="" )
	{
		$response = new stdClass();
		$req = $this->db->get_where('training_application', array('training_application_id' => $record_id))->row();
		$req_by = $this->db->get_where('users', array('user_id' => $req->user_id))->row();

		//get approvers
		$where = array(
			'training_application_id' => $record_id
		);
		$this->db->order_by('sequence');
		$approvers = $this->db->get_where('training_application_approver', $where)->result();
		$fstapprover = $approvers[0];
        $no_approvers = sizeof($approvers);
        $condition = $approvers[0]->condition;

        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');
                
        $response->redirect = false;
		$this->load->model('system_feed');
		$modified_on = date('Y-m-d H:i:s');
		switch( $status_id )
        {
            case 5: //approved
                //bring it up
                foreach(  $approvers as $index => $approver )
                {
                    if( $approver->approver_id == $this->user->user_id ){
                        $this->db->update('training_application_approver', array('training_application_status_id' => 5,'remarks'=>$comment,'approved_date'=>$modified_on,'modified_on'=>$modified_on), array('id' => $approver->id));

                        if( isset( $approvers[$index+1] ) && $condition == "By Level" )
                        {
                        	$up = $approvers[$index+1];
                        	$this->db->update('training_application_approver', array('training_application_status_id' => 4), array('id' => $up->id));
                        	$feed = array(
                                'status' => 'info',
                                'message_type' => 'Training Request',
                                'user_id' => $req->user_id,
                                'feed_content' => 'Filed Training Request and is now for your next approval.',
                                'uri' => $this->mod->route . '/detail/'.$record_id,
	                            'recipient_id' => $up->approver_id
                            );
                            $recipients = array($up->approver_id);
                            $this->system_feed->add( $feed, $recipients );

                            $response->notify[] = $up->approver_id;

	                         // start email to approver
			                $approvers_user_info = $this->db->get_where('users', array('user_id' => $up->approver_id));
			                if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
			                	$approvers_details = $approvers_user_info->row();
			                	$approver_fullname = $approvers_details->full_name;
			                }          

					        $logo  = ''; 
					        if ($this->config->item('system')['print_logo'] != ''){
					            if( file_exists( $this->config->item('system')['print_logo'] ) ){
					                $logo = base_url().$this->config->item('system')['print_logo'];
					            }
					        }
					
							$sendtrqdata['system_logo'] = $logo;			                                  
			                $sendtrqdata['requestor'] = $req_by->full_name;
			                $sendtrqdata['approver'] = $approver_fullname;

	                        $trq_send_template = $this->db->get_where( 'system_template', array( 'code' => 'TREQ-SEND-APPROVER') )->row_array();
	                        $msg = $this->parser->parse_string($trq_send_template['body'], $sendtrqdata, TRUE); 
	                        $subject = $this->parser->parse_string($trq_send_template['subject'], $sendtrqdata, TRUE); 

	                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
	                                 VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
	                        //create system logs
	                        $insert_array = array(
	                            'to' => $approvers_details->email, 
	                            'subject' => $subject, 
	                            'body' => $msg
	                            );
	                        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);                             
                        }
                    }
                }

                $response->redirect = true;
                break;               
            case 6: // disapproved
            	$where = array(
            		'training_application_id' => $record_id,
					'user_id' => $req->user_id,
					'approver_id' => $this->user->user_id
            	);
            	
            	$this->db->update('training_application_approver', array('training_application_status_id' => 6,'remarks'=>$comment,'disapproved_date'=>$modified_on,'modified_on'=>$modified_on), $where);

            	if( $this->db->affected_rows() == 1 )
            	{
					$this->db->update('training_application', array('status_id' => $status_id, 'date_disapproved' => date('Y-m-d H:i:s')), array('training_application_id' => $record_id));            		

	                $insert_array = array(
	                    'status_id' => $status_id, 
	                    'remarks' => $comment,
	                    'date_disapproved' => $modified_on
	                    );

					$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);	                

					$feed = array(
	                    'status' => 'info',
	                    'message_type' => 'Training Request',
	                    'user_id' => $req->user_id,
	                    'feed_content' => 'Filed Training Request has been disapproved.',
	                    'uri' => get_mod_route( 'training_request', '', false) . '/detail/'.$record_id,
	                    'recipient_id' => $req->user_id
	                );

	                $recipients = array($req->user_id);
	                $this->system_feed->add( $feed, $recipients );
	                $response->notify[] = $req->user_id;
	                $response->redirect = true;

 					// start email to requestor
	                $approvers_user_info = $this->db->get_where('users', array('user_id' => $this->user->user_id));
	                if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
	                	$approvers_details = $approvers_user_info->row();
	                	$approver_fullname = $approvers_details->full_name;
	                }          

			        $logo  = ''; 
			        if ($this->config->item('system')['print_logo'] != ''){
			            if( file_exists( $this->config->item('system')['print_logo'] ) ){
			                $logo = base_url().$this->config->item('system')['print_logo'];
			            }
			        }
			
					$sendtrqdata['system_logo'] = $logo;	                                  
	                $sendtrqdata['requestor'] = $req_by->full_name;
	                $sendtrqdata['approver'] = $approver_fullname;
					$sendtrqdata['status'] = 'Disapproved';

                    $trq_send_template = $this->db->get_where( 'system_template', array( 'code' => 'TREQ-SEND-REQUESTOR') )->row_array();
                    $msg = $this->parser->parse_string($trq_send_template['body'], $sendtrqdata, TRUE); 
                    $subject = $this->parser->parse_string($trq_send_template['subject'], $sendtrqdata, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$req_by->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                    //create system logs
                    $insert_array = array(
                        'to' => $req_by->email, 
                        'subject' => $subject, 
                        'body' => $msg
                        );
                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);	                
                }
                break;
        }
	
		if( $status_id == 5 )
        {
            $where = array(
				'training_application_id' => $record_id
			);
			$this->db->order_by('sequence');
			$approvers = $this->db->get_where('training_application_approver', $where)->result();

            switch ($condition) {
                case 'ALL':
                case 'By Level':
                    $all_approved = true;
                    foreach( $approvers as $approver )
                    {
                        if($approver->training_application_status_id != 5)
                        {
                            $all_approved = false;
                            break;
                        }
                    }
                    if($all_approved)
                    {
                        $status_id = 3;
                    }
                    else{
                        $status_id = 4;
                    }
                    break;
                case 'Either Of':
                    $one_approved = false;
                    foreach( $approvers as $approver )
                    {
                        if($approver->training_application_status_id == 5)
                        {
                            $one_approved = true;
                            break;
                        }
                    }
                    if($one_approved)
                    {
                        $status_id = 3;
                    }
                    else{
                        $status_id = 4;
                    }
                    break;
            }

            if( $status_id == 3 ) // status id of the main table recruitment request
            {
            	$feed = array(
                    'status' => 'info',
                    'message_type' => 'Training Request',
                    'user_id' => $req->user_id,
                    'feed_content' => 'Filed Training Request has been approved.',
                    'uri' => get_mod_route( 'training_request', '', false) . '/detail/'.$record_id,
                    'recipient_id' => $req->user_id
                );

                $recipients = array($req->user_id);
                $this->system_feed->add( $feed, $recipients );
                $response->notify[] = $req->user_id;

                //email
		        $logo  = ''; 
		        if ($this->config->item('system')['print_logo'] != ''){
		            if( file_exists( $this->config->item('system')['print_logo'] ) ){
		                $logo = base_url().$this->config->item('system')['print_logo'];
		            }
		        }
		
				$sendtrqdata['system_logo'] = $logo;	                
                $sendtrqdata['requestor'] = $req_by->full_name;
                $sendtrqdata['approver'] = 'all approver(s)';
				$sendtrqdata['status'] = 'Approved';

                $trq_send_template = $this->db->get_where( 'system_template', array( 'code' => 'TREQ-SEND-REQUESTOR') )->row_array();
                $msg = $this->parser->parse_string($trq_send_template['body'], $sendtrqdata, TRUE); 
                $subject = $this->parser->parse_string($trq_send_template['subject'], $sendtrqdata, TRUE); 

                $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                         VALUES('{$req_by->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
				
				$this->notify_hr($record_id,$req->user_id);                
            }

            $this->db->update('training_application', array('status_id' => $status_id, 'date_approved' => date('Y-m-d H:i:s')), array('training_application_id' => $record_id));

            $insert_array = array(
                'status_id' => $status_id, 
                'remarks' => $comment,
                'date_approved' => $modified_on
                );

			$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);	

            if( $this->db->_error_message() != "" )
	        {
	        	$response->message[] = array(
					'message' => $this->db->_error_message(),
					'type' => 'error'
				);
	        }
    	}

    	return $response;
	}

	function notify_hr( $training_application_id=0, $requestor_user_id='')
	{	
		$this->load->model('training_request_admin_model', 'admin_mod');

		$qry = "SELECT  *
				FROM {$this->db->dbprefix}roles r 
				WHERE FIND_IN_SET(31,profile_id)";

		$roles_result = $this->db->query($qry);

		if ($roles_result && $roles_result->num_rows() > 0) {
			$role_id = $roles_result->row()->role_id;

			$this->db->where('role_id',$role_id);
			$users = $this->db->get('users');

			if ($users && $users->num_rows() > 0) {
				$notified = array();		

				foreach ($users->result() as $row) {
					//insert notification
					$insert = array(
						'status' => 'info',
						'message_type' => 'Training Request',
						'user_id' => $requestor_user_id,
						'feed_content' => 'Submitted Training Request for Validation',//.'.<br><br>Reason: '.$form['reason'],
						'recipient_id' => $row->user_id,
						'uri' => str_replace(base_url(), '', $this->admin_mod->url).'/detail/'.$training_application_id
					);

					$this->db->insert('system_feeds', $insert);
					$id = $this->db->insert_id();
					$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));
					$notified[] = $row->user_id;
				}
			}
		}

		return $notified;
	}		
}