<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class payroll_employee_model extends Record
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
		$this->mod_id = 57;
		$this->mod_code = 'payroll_employee';
		$this->route = 'payroll/employees';
		$this->url = site_url('payroll/employees');
		$this->primary_key = 'user_id';
		$this->table = 'payroll_partners';
		$this->icon = 'fa-user';
		$this->short_name = 'Employee Setup';
		$this->long_name  = 'Employee Setup';
		$this->description = '';
		$this->path = APPPATH . 'modules/payroll_employee/';

		parent::__construct();
	}

		
	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
		$data = array();				
		
		$qry = $this->_get_list_cached_query();

		// GET SENSITIVITY
		// BEGIN //
		$sensID = $this->config->config['user']['sensitivity'];
		if($sensID && !empty($sensID) ){
			$qry .= " AND {$this->db->dbprefix}{$this->table}.sensitivity IN ( ".$sensID." )";
		}
		// END //
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}

		$qry_category = $this->get_role_category();

		if ($qry_category != ''){
			$qry .= ' AND ' . $qry_category;
		}
		
		$qry .= ' '. $filter;

		// FOR COMPANY ASSIGN ONLY
/*		$user = $this->config->item('user');
		$qry .= " AND `{$this->db->dbprefix}{$this->table}`.company_id in ({$user['region_companies']})";*/
		
		$qry .= " ORDER BY full_name ";
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

	function add_to_holiday_location($user_id,$location_id)
	{
		$data = array();

		$this->db->where('deleted',0);
		$holiday = $this->db->get('time_holiday');
		if ($holiday && $holiday->num_rows() > 0) {
			foreach ($holiday->result() as $row) {
				$this->db->where('holiday_id',$row->holiday_id);
				$this->db->where('user_id',$user_id);
				$this->db->where('location_id',$location_id);
				$user_holiday = $this->db->get('time_holiday_location');
				if (!$user_holiday || $user_holiday->num_rows == 0) {
					$qry = "INSERT INTO ww_time_holiday_location
							SELECT th.`holiday_id`, up.`location_id`, ul.`location`, p.`user_id`, up.`display_name`, 0 `deleted`
							FROM `ww_partners` p
							JOIN `users_profile` up ON up.`user_id`=p.`user_id` AND up.`active`=1
							JOIN `ww_time_holiday` th ON th.`holiday_id`={$row->holiday_id} AND FIND_IN_SET(up.`location_id`,th.`locations`) AND th.`deleted`=0
							LEFT JOIN `ww_users_location` ul ON ul.`location_id`=up.`location_id`
							WHERE p.user_id = {$user_id}
							ORDER BY 2,5";
					$result = $this->db->query( $qry );
				}
			}
		}
	}	
}