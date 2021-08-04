<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class performance_planning_model extends Record
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
		$this->mod_id = 107;
		$this->mod_code = 'performance_planning';
		$this->route = 'appraisal/planning';
		$this->url = site_url('appraisal/planning');
		$this->primary_key = 'planning_id';
		$this->table = 'performance_planning';
		$this->icon = 'fa-folder';
		$this->short_name = 'Target Setting Periods';
		$this->long_name  = 'Target Setting Periods';
		$this->description = '';
		$this->path = APPPATH . 'modules/performance_planning/';

		parent::__construct();
	}

	
	function getEmpTypeTagList(){

		$data = array();

		$qry = "SELECT employment_type_id AS value, employment_type AS label FROM {$this->db->dbprefix}partners_employment_type WHERE deleted = '0'";
		$result = $this->db->query($qry);
		
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row['label']);
				$data[] = $row;
			}			
		}
			
		$result->free_result();
		return $data;			
	}
	
	function getEmpStatusTagList(){

		$data = array();

		$qry = "SELECT employment_status_id AS value, employment_status AS label FROM {$this->db->dbprefix}partners_employment_status WHERE deleted = '0'";
		$result = $this->db->query($qry);
		
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row['label']);
				$data[] = $row;
			}			
		}
			
		$result->free_result();
		return $data;			
	}

	function getPositionsTagList(){

		$data = array();

		$qry = "SELECT position_id AS value, position AS label FROM {$this->db->dbprefix}users_position WHERE deleted = '0'";
		$result = $this->db->query($qry);
		
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row['label']);
				$data[] = $row;
			}			
		}
			
		$result->free_result();
		return $data;			
	}
	
	function getUsersTagList(){

		$data = array();

		$qry = "SELECT user_id AS value, full_name AS label FROM users WHERE active = '1'";
		$result = $this->db->query($qry);
		
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row['label']);
				$data[] = $row;
			}			
		}
			
		$result->free_result();
		return $data;			
	}

	function getCompanyTagList(){

		$data = array();

		$qry = "SELECT company_id AS value, company AS label FROM {$this->db->dbprefix}users_company WHERE deleted = 0 order by company";
		$result = $this->db->query($qry);
		
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row['label']);
				$data[] = $row;
			}			
		}
			
		$result->free_result();
		return $data;			
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
		$qry .= " GROUP BY {$this->db->dbprefix}{$this->table}.{$this->primary_key}";
		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.{$this->primary_key} DESC";
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

	function save_history_user_info($planning_id = 0) {
		$this->db->where('planning_id',$planning_id);
		$this->db->delete('performance_planning_applicable_user_info');

		$this->db->where('planning_id',$planning_id);
		$planning_applicable = $this->db->get('performance_planning_applicable');
		if ($planning_applicable && $planning_applicable->num_rows() > 0) {
			foreach ($planning_applicable->result() as $row) {
				$this->db->where('users_profile.user_id',$row->user_id);
				$this->db->join('partners','users_profile.user_id = partners.user_id','left');
				$users = $this->db->get('users_profile');
				if ($users && $users->num_rows() > 0) {
					$users_info = $users->row();

					$info_arr = array(
										'planning_id' => $planning_id,
										'user_id' => $row->user_id,
										'position_id' => $users_info->position_id,
										'job_grade_id' => $users_info->job_grade_id,
										'employment_type_id' => $users_info->employment_type_id,
										'company_id' => $users_info->company_id,
										'division_id' => $users_info->division_id,
										'department_id' => $users_info->department_id,
										'reports_to_id' => $users_info->reports_to_id
									 );
					$this->db->insert('performance_planning_applicable_user_info',$info_arr);

				}
			}

		}
	}

	function get_template($user_id) {
		$template['info'] = array();
		$template['template_id'] = 0;

		$this->db->where('users_profile.user_id',$user_id);
		$this->db->join('partners','users_profile.user_id = partners.user_id');
		$user_result = $this->db->get('users_profile');

		if ($user_result && $user_result->num_rows() > 0) {
			$user_info = $user_result->row_array();
			$company_id = $user_info['company_id'];
			$employment_type_id = $user_info['employment_type_id'];
			$employment_status_id = $user_info['status_id'];

	        $qry = "SELECT  *
	                FROM {$this->db->dbprefix}performance_template pt 
	                WHERE FIND_IN_SET({$company_id},company_id)
	                AND FIND_IN_SET({$employment_type_id},employment_type_id)
	                AND FIND_IN_SET({$employment_status_id},employment_status_id)";

	        $performance_template_result = $this->db->query($qry);

	        if ($performance_template_result && $performance_template_result->num_rows > 0) {
				$template['info'] = $performance_template_result->row_array();
				$template['template_id'] = $performance_template_result->row()->template_id;
	        }
		}

		return $template;
	}
}