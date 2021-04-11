<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class clearance_manage_model extends Record
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
		$this->mod_id = 164;
		$this->mod_code = 'clearance_manage';
		$this->route = 'partner/clearance_manage';
		$this->url = site_url('partner/clearance_manage');
		$this->primary_key = 'clearance_id';
		$this->table = 'partners_clearance';
		$this->icon = '';
		$this->short_name = 'Clearance';
		$this->long_name  = 'Manage Clearance';
		$this->description = '';
		$this->path = APPPATH . 'modules/clearance_manage/';

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
		
		$qry .= ' '. $filter;
		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.effectivity_date DESC";
		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search, 'user_id' => $this->user->user_id), TRUE);

		$result = $this->db->query( $qry );
		if($result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}

	function get_pending_status($clearance_id,$personal_user_id = 0)
	{
		if ($personal_user_id)
			$this->db->where('partners_clearance_signatories.user_id <>',$personal_user_id);	

		$this->db->where('clearance_id',$clearance_id);
		$this->db->join('partners_clearance_signatories_accountabilities','partners_clearance_signatories.clearance_signatories_id=partners_clearance_signatories_accountabilities.clearance_signatories_id');
		$clearance = $this->db->get('partners_clearance_signatories');
		$pending = 0;
		if($clearance && $clearance->num_rows() > 0){
			$pending = $clearance->num_rows();
		}
		return $pending;
	}

	function notify_hr( $clearance_id=0, $clearance_record='')
	{	
		$this->load->model('clearance_model', 'clearance_mod');

		$qry = "SELECT  *
				FROM {$this->db->dbprefix}roles r 
				WHERE FIND_IN_SET(2,profile_id)";

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
						'message_type' => 'Clearance',
						'user_id' => $clearance_record->user_id,
						'feed_content' => 'Submitted Exit Interview for Validation',//.'.<br><br>Reason: '.$form['reason'],
						'recipient_id' => $row->user_id,
						'uri' => str_replace(base_url(), '', $this->clearance_mod->url).'/view_signatories/'.$clearance_id
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

	function notify_filer( $clearance_id=0, $clearance_record='')
	{	
		$this->load->model('clearance_model', 'clearance_mod');
		
		$notified = array();		

		//insert notification
		$insert = array(
			'status' => 'info',
			'message_type' => 'Clearance',
			'user_id' => $clearance_record->user_id,
			'feed_content' => 'Submitted Exit Interview for Validation',//.'.<br><br>Reason: '.$form['reason'],
			'recipient_id' => $clearance_record->user_id,
			'uri' => str_replace(base_url(), '', $this->clearance_mod->url).'/view_exit_interview/'.$clearance_id
		);

		$this->db->insert('system_feeds', $insert);
		$id = $this->db->insert_id();
		$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $clearance_record->user_id));
		$notified[] = $clearance_record->user_id;

		return $notified;
	}	
}