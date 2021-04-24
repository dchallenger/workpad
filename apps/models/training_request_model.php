<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_request_model extends Record
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
		$this->mod_id = 277;
		$this->mod_code = 'training_request';
		$this->route = 'training/training_request';
		$this->url = site_url('training/training_request');
		$this->primary_key = 'training_application_id';
		$this->table = 'training_application';
		$this->icon = '';
		$this->short_name = 'Training Request';
		$this->long_name  = 'Training Request';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_request/';

		parent::__construct();
	}

	function get_idp_details($user_id = 0)
	{
		$qry = "SELECT GROUP_CONCAT(areas_for_development) AS 'areas_development',GROUP_CONCAT(competencies) AS 'competencies'
				FROM performance_planning_idp idp
				WHERE idp.user_id = {$user_id}
				GROUP BY year
				ORDER BY year DESC";

		$idp_result = $this->db->query($qry);

		if ($idp_result && $idp_result->num_rows() > 0)
			return $idp_result->row_array();
		else
			return array();
	}

	function get_status()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('training_application_status');

		return $result;
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
		
		$qry .= " AND {$this->db->dbprefix}{$this->table}.user_id = {$this->user->user_id}";	

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

	function get_approvers($training_application_id=0,$user_id=0)
	{
		$this->db->where('training_application_id',$training_application_id);

		if ($user_id)
			$this->db->where('user_id',$user_id);
		
		$this->db->order_by('sequence', 'asc');				
		$result = $this->db->get('training_application_approver');
		return $result;
	}

	function notify_approvers( $training_application_id=0,$user_id=0)
	{
        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');

		$notified = array();

		$this->db->order_by('sequence', 'asc');
		$approvers = $this->db->get_where('training_application_approver', array('training_application_id' => $training_application_id, 'deleted' => 0));
	
		$first = true;
		foreach( $approvers->result() as $approver )
		{
			switch( $approver->condition )
			{
				case 'All':
				case 'Either Of';
					break;
				case 'By Level':
					if( !$first )
					break;
			}

			$this->load->model('training_request_manage_model', 'mod_manage');

			//insert notification
			
			$insert = array(
				'status' => 'info',
				'message_type' => 'Training Request',
				'user_id' => $user_id,
				//'display_name' => $this->get_display_name($loan_application['user_id']),
				'feed_content' => 'Training Request for Approval',
				'recipient_id' => $approver->approver_id,
				'uri' => str_replace(base_url(), '', $this->mod_manage->url).'/detail/'.$training_application_id
			);
			$this->db->insert('system_feeds', $insert);
			$id = $this->db->insert_id();
			$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $approver->approver_id));
			
			$notified[] = $approver->approver_id;

			$first = false;

            // email to approver
            $req_by = $this->db->get_where('users', array('user_id' => $user_id))->row();

            $approvers_user_info = $this->db->get_where('users', array('user_id' => $approver->approver_id));
            if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
            	$approvers_details = $approvers_user_info->row();
            	$approver_fullname = $approvers_details->full_name;
            }

            $data['requestor'] = $req_by->full_name;
            $data['approver'] = $approver_fullname;            

            $training_request_template = $this->db->get_where( 'system_template', array( 'code' => 'TREQ-SEND-APPROVER') )->row_array();
            $msg = $this->parser->parse_string($training_request_template['body'], $data, TRUE); 

            $subject = $this->parser->parse_string($training_request_template['subject'], $data, TRUE); 

            $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                     VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");			

            $this->db->update('training_application_approver', array('training_application_status_id' => 4), array('id' => $approver->id));
		}

		return $notified;
	}

	function notify_filer( $training_application_id=0,$user_id=0)
	{
		$notified = array();

		//insert notification
		$insert = array(
			'status' => 'info',
			'message_type' => 'Training Request',
			'user_id' => $user_id,
			'feed_content' => 'Training Request for Approval',
			'recipient_id' => $user_id,
			'uri' => str_replace(base_url(), '', $this->url).'/detail/'.$training_application_id
		);

		$this->db->insert('system_feeds', $insert);
		$id = $this->db->insert_id();
		$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $user_id));
		$notified[] = $user_id;

		return $notified;
	}

	function notify_hr( $training_application_id=0,$user_id=0)
	{	
		$this->load->model('training_request_admin_model', 'mod_admin');

		$qry = "SELECT  *
				FROM {$this->db->dbprefix}roles r 
				WHERE FIND_IN_SET(44,profile_id)";

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
						'user_id' => $loan_application['user_id'],
						'feed_content' => 'Training Request for Validation',//.'.<br><br>Reason: '.$form['reason'],
						'recipient_id' => $row->user_id,
						'uri' => str_replace(base_url(), '', $this->mod_admin->url).'/edit/'.$training_application_id
					);

					$this->db->insert('system_feeds', $insert);
					$id = $this->db->insert_id();
					$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));
					$notified[] = $row->user_id;

					// email to hr
		            $req_by = $this->db->get_where('users', array('user_id' => $user_id))->row();

		            $hr_user_info = $this->db->get_where('users', array('user_id' => $row->user_id));
		            if ($hr_user_info && $hr_user_info->num_rows() > 0){
		            	$hr_details = $hr_user_info->row();
		            	$hr_fullname = $hr_details->full_name;
		            }

		            $data['requestor'] = $req_by->full_name;
		            $data['approver'] = $hr_fullname;            

		            $training_request_template = $this->db->get_where( 'system_template', array( 'code' => 'TREQ-SEND-HR') )->row_array();
		            $msg = $this->parser->parse_string($mrf_send_template['body'], $data, TRUE); 
		            $subject = $this->parser->parse_string($mrf_send_template['subject'], $data, TRUE); 

		            $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
		                     VALUES('{$hr_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");							
				}
			}
		}

		return $notified;
	}	
}