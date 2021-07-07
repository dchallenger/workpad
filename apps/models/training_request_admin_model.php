<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_request_admin_model extends Record
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
		$this->mod_id = 279;
		$this->mod_code = 'training_request_admin';
		$this->route = 'training/training_request_admin';
		$this->url = site_url('training/training_request_admin');
		$this->primary_key = 'training_application_id';
		$this->table = 'training_application';
		$this->icon = '';
		$this->short_name = 'Training Request Admin';
		$this->long_name  = 'Training Request Admin';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_request_admin/';

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
		
		$qry .= " AND {$this->db->dbprefix}{$this->table}.status_id IN (3,7,8)";	

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
            case 7: // Hr approved
				$this->db->update('training_application', array('status_id' => $status_id, 'date_approved' => date('Y-m-d H:i:s'), 'hr_remarks' => $comment), array('training_application_id' => $record_id));

                $insert_array = array(
                    'status_id' => $status_id, 
                    'hr_remarks' => $comment,
                    'date_approved' => $modified_on
                    );

				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);	                

				$feed = array(
                    'status' => 'info',
                    'message_type' => 'Training Request',
                    'user_id' => $req->user_id,
                    'feed_content' => 'Filed Training Request has been approved by HR.',
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
				$sendtrqdata['status'] = 'Approved';

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
                break;
            case 8: // Hr disapproved
				$this->db->update('training_application', array('status_id' => $status_id, 'date_disapproved' => date('Y-m-d H:i:s'), 'hr_remarks' => $comment), array('training_application_id' => $record_id));            		

                $insert_array = array(
                    'status_id' => $status_id, 
                    'hr_remarks' => $comment,
                    'date_disapproved' => $modified_on
                    );

				$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);	

				$feed = array(
                    'status' => 'info',
                    'message_type' => 'Training Request',
                    'user_id' => $req->user_id,
                    'feed_content' => 'Filed Training Request has been disapproved by HR.',
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
                break;
    	}

    	return $response;
	}

	function get_training_request_info($record_id)
	{
		$qry = 'SELECT 
		`ww_training_application`.`training_application_id` as record_id, 
		ww_users.full_name as "requested_by",
		ww_training_calendar_type.calendar_type as "training_type", 
		DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "date_from", 		
		DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "date_to", 
		ww_training_course.course as "training_course",
		ww_training_provider.provider as "training_provider",
		ww_training_application.venue as "venue",		
		ww_training_application.total_training_hour as "total_training_hour", 
		ww_training_application.total_investment_pgsa as "subject_revision", 
		GROUP_CONCAT(`paad`.`appraisal_areas_development` SEPARATOR ", ") AS "areas_development",
		GROUP_CONCAT(`tc`.`category` SEPARATOR ", ") AS "competency",
		ww_training_application.note as "training_application_note",
		ww_training_application.hr_remarks as "remarks",
		ww_users_company.print_logo as "print_logo"
		FROM (`ww_training_application`)
		LEFT JOIN `ww_training_category` ON `ww_training_category`.`category_id` = `ww_training_application`.`competency`
		LEFT JOIN `ww_performance_appraisal_areas_development` ON `ww_performance_appraisal_areas_development`.`appraisal_areas_development_id` = `ww_training_application`.`areas_development`
		LEFT JOIN `ww_training_provider` ON `ww_training_provider`.`provider_id` = `ww_training_application`.`training_provider`
		LEFT JOIN `ww_training_course` ON `ww_training_course`.`course_id` = `ww_training_application`.`training_course_id`
		LEFT JOIN `ww_training_calendar_type` ON `ww_training_calendar_type`.`calendar_type_id` = `ww_training_application`.`training_type`
		LEFT JOIN `ww_users` ON `ww_users`.`user_id` = `ww_training_application`.`user_id`
		LEFT JOIN `ww_users_company` ON `ww_users`.`company_id` = `ww_users_company`.`company_id`
		LEFT JOIN `ww_performance_appraisal_areas_development` `paad` ON FIND_IN_SET(paad.`appraisal_areas_development_id`, ww_training_application.`areas_development`)
		LEFT JOIN `ww_training_category` `tc` ON FIND_IN_SET(tc.`category_id`, ww_training_application.`competency`)
		WHERE `ww_training_application`.`training_application_id` = '.$record_id.'';

		$result = $this->db->query($qry);

		$info = array();
		if ($result && $result->num_rows() > 0) {
			$info = $result->row_array();
		}

		return $info;
	}
}