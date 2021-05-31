<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class my_change_request_model extends Record
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
		$this->mod_id = 75;
		$this->mod_code = 'my_change_request';
		$this->route = 'account/201_update';
		$this->url = site_url('account/201_update');
		$this->primary_key = 'personal_request_header_id';
		$this->table = 'partners_personal_request_header';
		$this->icon = 'fa-folder';
		$this->short_name = 'Change Request';
		$this->long_name  = 'Change Request';
		$this->description = '';
		$this->path = APPPATH . 'modules/my_change_request/';

		parent::__construct();
	}

	public function get_change_request_info($personal_request_header_id = 0)
	{
		$this->db->select(
							'personal_request_header_id,partners_personal_request_header.user_id,full_name as employee_name,
							company,v_department as department,status,partners_personal_request_header.remarks,partners_personal_request_header.created_on
						');
		$this->db->where('personal_request_header_id',$personal_request_header_id);
		$this->db->join('users_profile','partners_personal_request_header.user_id = users_profile.user_id');
		$this->db->join('users','users.user_id = users_profile.user_id');
		$result = $this->db->get('partners_personal_request_header');

		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}

	public function get_change_request_details($personal_request_header_id = 0)
	{
		$this->db->where('personal_request_header_id',$personal_request_header_id);
		$this->db->join('partners_key','partners_key.key_id = partners_personal_request.key_id');
		$result = $this->db->get('partners_personal_request');
		if ($result && $result->num_rows() > 0)
			return $result->result_array();
		else
			return array();
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
		
		// $qry .= " AND {$this->db->dbprefix}{$this->table}.status != 1";
		$qry .= ' '. $filter;
		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.created_on desc";
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

	function notify_approvers( $personal_request_header_id=0, $form=array())
	{
		$notified = array();

		$personal_request_key = 'personal_request_header_id';
		$this->db->order_by('sequence', 'asc');
		$approvers = $this->db->get_where('partners_personal_approver', array($personal_request_key => $personal_request_header_id, 'deleted' => 0));

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

			$form_status = "Filed";
			
			$this->db->join('partners_key_class','partners_personal_request_header.key_class_id=partners_key_class.key_class_id');
			$requests = $this->db->get_where('partners_personal_request_header', array($this->primary_key => $personal_request_header_id))->row_array();
			
			$this->load->model('change_request_model', 'update201');
			//insert notification
			$insert = array(
				'status' => 'info',
				'message_type' => 'Partners',
				'user_id' => $form['user_id'],
				'display_name' => $this->get_display_name($form['user_id']),
				'feed_content' => $form_status.' change request for '.$requests['key_class'],
				'recipient_id' => $approver->user_id,
				'uri' => str_replace(base_url(), '', $this->update201->url).'/detail/'.$personal_request_header_id
			);
			$this->db->insert('system_feeds', $insert);
			$id = $this->db->insert_id();
			$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $approver->user_id));
			$notified[] = $approver->user_id;

			$first = false;

		}

		return $notified;
	}

	function notify_filer( $personal_request_header_id=0, $form=array())
	{
		$notified = array();

			$form_status =  "Filed a new" ;

			//insert notification
			$insert = array(
				'status' => 'info',
				'message_type' => 'Partners',
				'user_id' => $form['user_id'],
				'feed_content' => $form_status.' change request',
				'recipient_id' => $form['user_id'],
				'uri' => str_replace(base_url(), '', $this->url)
			);

			$this->db->insert('system_feeds', $insert);
			$id = $this->db->insert_id();
			$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $form['user_id']));
			$notified[] = $form['user_id'];

		return $notified;
	}

	public function get_display_name($user_id=0){		
		$sql_display_name = $this->db->get_where('users', array('user_id' => $user_id));
		$display_name = $sql_display_name->row_array();
		return $display_name['display_name'];
	}
}