<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_request_confirmation_model extends Record
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
		$this->mod_id = 282;
		$this->mod_code = 'training_request_confirmation';
		$this->route = 'training/training_request_confirmation';
		$this->url = site_url('training/training_request_confirmation');
		$this->primary_key = 'training_calendar_id';
		$this->table = 'training_calendar';
		$this->icon = '';
		$this->short_name = 'Training Request Confirmation';
		$this->long_name  = 'Training Request Confirmation';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_request_confirmation/';

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
		
		$qry .= " AND T5.user_id = {$this->user->user_id} AND {$this->db->dbprefix}{$this->table}.closed = 0";	

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

	function notify_hr( $training_calendar_id=0,$user_id=0,$status='')
	{	
		$this->load->model('training_calendar_model', 'mod_calendar');

		$qry = "SELECT  *
				FROM {$this->db->dbprefix}roles r 
				WHERE FIND_IN_SET(44,profile_id)";

		$roles_result = $this->db->query($qry);

		if ($roles_result && $roles_result->num_rows() > 0) {
			$role_id = $roles_result->row()->role_id;

			$this->db->where('role_id',$role_id);
			$users = $this->db->get('users');

			if ($users && $users->num_rows() > 0) {

				foreach ($users->result() as $row) {
					//insert notification
					$insert = array(
						'status' => 'info',
						'message_type' => 'Training Request',
						'user_id' => $user_id,
						'feed_content' => 'Training Request '. $status .'',//.'.<br><br>Reason: '.$form['reason'],
						'recipient_id' => $row->user_id,
						'uri' => str_replace(base_url(), '', $this->mod_calendar->url).'/detail/'.$training_calendar_id
					);

					$this->db->insert('system_feeds', $insert);
					$id = $this->db->insert_id();
					$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));

					// email to hr
/*		            $req_by = $this->db->get_where('users', array('user_id' => $user_id))->row();

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
		                     VALUES('{$hr_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");*/							
				}
			}
		}
	}		
}