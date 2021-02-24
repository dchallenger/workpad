<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class appraisal_individual_rate_model extends Record
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
		$this->mod_id = 116;
		$this->mod_code = 'appraisal_individual_rate';
		$this->route = 'appraisal/individual_rate';
		$this->url = site_url('appraisal/individual_rate');
		$this->primary_key = 'appraisal_id';
		$this->table = 'performance_appraisal';
		$this->icon = 'fa-folder';
		$this->short_name = 'Individual Performance Appraisals';
		$this->long_name  = 'Individual Performance Appraisals';
		$this->description = '';
		$this->path = APPPATH . 'modules/appraisal_individual_rate/';

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
		
		$qry .= " AND {$this->db->dbprefix}{$this->table}_applicable.user_id = {$this->user->user_id}";	
		$qry .= ' '. $filter;
		
		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.{$this->primary_key} DESC ";
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

	function get_observations( $year, $user_id )
	{
		$qry = "SELECT sf.*, sf.display_name AS full_name, up.photo, gettimeline(sf.createdon) as timeline, ud.department
				FROM {$this->db->dbprefix}system_feeds sf 
				LEFT JOIN {$this->db->dbprefix}system_feeds_recipient sfr ON sf.id = sfr.id 
				LEFT JOIN {$this->db->dbprefix}users_profile up ON up.user_id = sf.user_id 
				LEFT JOIN {$this->db->dbprefix}users_department ud on ud.department_id = up.department_id 
				WHERE sf.message_type = 'Feedback' 
				AND sfr.user_id = {$user_id} AND sf.user_id != {$user_id} 
				AND YEAR(sf.createdon) BETWEEN '{$year}' AND '{$year}' 
				ORDER BY sf.createdon DESC";

		// echo "<pre>"; echo $qry;
		return $this->db->query( $qry )->result();
	}

	function get_appraisee( $appraisal_id, $user_id )
	{
		$qry = "select a.*, a.status_id as period_status, b.*, b.status_id as performance_status_id, IFNULL(paah.employment_type,c.employment_type) AS employment_type,IFNULL(paah.job_level,c.v_job_grade) as v_job_grade, c.effectivity_date, IFNULL(paah.company,d.company) AS company, IFNULL(paah.position,d.v_position) as position, i.full_name as immediate, h.position as immediate_position,
		IFNULL(paah.reports_to,d.v_reports_to) as v_reports_to, IFNULL(paah.department,d.v_department) as v_department, IFNULL(paah.dept_head,j.immediate) as dept_head, IFNULL(paah.division,d.v_division) as v_division, IFNULL(paah.div_head,k.immediate) as div_head, c.position_classification, a.created_on as appraisal_created_on
		FROM {$this->db->dbprefix}performance_appraisal a
		LEFT JOIN {$this->db->dbprefix}performance_appraisal_applicable b ON b.appraisal_id = a.appraisal_id
		LEFT JOIN partners c ON c.user_id = b.user_id
		LEFT JOIN {$this->db->dbprefix}users_profile d ON d.user_id = b.user_id
		LEFT JOIN performance_appraisal_applicable_history paah ON d.user_id = paah.user_id AND paah.appraisal_id = {$appraisal_id}
		LEFT JOIN {$this->db->dbprefix}users_profile g ON g.user_id = d.reports_to_id
		LEFT JOIN {$this->db->dbprefix}users_position h ON h.position_id = g.position_id
		LEFT JOIN {$this->db->dbprefix}users i ON i.user_id = d.reports_to_id
		LEFT JOIN {$this->db->dbprefix}users_department j ON j.department_id = d.department_id
		LEFT JOIN {$this->db->dbprefix}users_division k ON k.division_id = d.division_id		
		WHERE a.appraisal_id = {$appraisal_id} AND b.user_id = {$user_id}";

		$appraisee = $this->db->query( $qry );
		return $appraisee->row();
	}

// original 2019-08-12
/*	function get_appraisee( $appraisal_id, $user_id )
	{
		$qry = "select a.*, a.status_id as period_status, j.*, b.*, c.effectivity_date, d.company, f.position, i.full_name as immediate, h.position as immediate_position
		FROM {$this->db->dbprefix}performance_appraisal a
		LEFT JOIN {$this->db->dbprefix}performance_appraisal_applicable j ON j.appraisal_id = a.appraisal_id
		LEFT JOIN {$this->db->dbprefix}performance_appraisal_applicable_user b ON b.appraisal_id = a.appraisal_id and j.user_id = b.user_id
		LEFT JOIN partners c ON c.user_id = b.user_id
		LEFT JOIN {$this->db->dbprefix}users_profile d ON d.user_id = b.user_id
		LEFT JOIN {$this->db->dbprefix}users_company e ON e.company_id = d.company_id
		LEFT JOIN {$this->db->dbprefix}users_position f ON f.position_id = d.position_id
		LEFT JOIN {$this->db->dbprefix}users_profile g ON g.user_id = d.reports_to_id
		LEFT JOIN {$this->db->dbprefix}users_position h ON h.position_id = g.position_id
		LEFT JOIN {$this->db->dbprefix}users i ON i.user_id = d.reports_to_id
		WHERE a.appraisal_id = {$appraisal_id} AND j.user_id = {$user_id}";

		$appraisee = $this->db->query( $qry );
		return $appraisee->row();
	}*/


	function get_cs_discussion( $appraisal_id, $section_id, $user_id, $contributor_id )
	{
		if( empty($contributor_id) )
		{
			//get hr
			$contributors = $this->db->get_where('performance_appraisal_contributor', array('user_id' => $user_id));
			$cs_list = array();
			foreach( $contributors->result() as $cs)
			{
				$cs_list[$cs->contributor_id] = $cs->contributor_id;
			}
			$cs_list = implode(',', $cs_list);
			$contributor_id = " not in ({$cs_list})";
		}
		else{
			$contributor_id = " = {$contributor_id}";
		}

		if( !empty($section_id) )
		{
			$section_id = "AND (a.section_id = {$section_id} OR a.section_id IS NULL)";
		}

		$qry = "select a.*, gettimeline(a.created_on) as created_on, b.full_name, IF(c.photo != '',c.photo,'uploads/users/avatar.png') as photo, d.department
		FROM {$this->db->dbprefix}performance_appraisal_contributor_notes a 
		LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.created_by
		LEFT JOIN {$this->db->dbprefix}users_profile c ON c.user_id = a.created_by
		LEFT JOIN {$this->db->dbprefix}users_department d on d.department_id = c.department_id
		WHERE a.appraisal_id = {$appraisal_id} AND a.user_id = {$user_id} 
		{$section_id}
		ORDER BY a.created_on DESC";

		$res = $this->db->query($qry);
		if( $res->num_rows() > 0 )
			return $res->result();
		else
			return false;
	}

	//specific approver
	function get_approver( $appraisal_id, $user_id, $approver_id )
	{
		$where = array(
			'appraisal_id' => $appraisal_id,
			'user_id' => $user_id,
			'approver_id' => $approver_id
		);

		$this->db->limit(1);
		$approver = $this->db->get_where('performance_appraisal_approver', $where);

		return $approver;

/*		if($approver && $approver->num_rows() == 1)
			return $approver->row();
		else
			return false;*/
	}	

	//all approvers
	function get_list_approver( $appraisal_id, $user_id, $sequence = 0 )
	{
		$where = array(
			'appraisal_id' => $appraisal_id,
			'user_id' => $user_id
		);

		if ($sequence) 
			$where['sequence'] = $sequence;

		$this->db->order_by('sequence');
		$approver = $this->db->get_where('performance_appraisal_approver', $where);

		return $approver;
	}

	function get_appraisal_applicable_fields($appraisal_id = 0,$appraisee_id = 0)
	{
		$this->db->select('*');
		$this->db->from('performance_appraisal_applicable_fields paaf');
		$this->db->where('paaf.appraisal_id',$appraisal_id);
		$this->db->where('paaf.user_id',$appraisee_id);
		$this->db->order_by('paaf.template_section_id,paaf.criteria_id,paaf.sequence');
		$result = $this->db->get();

		$appraisal_applicable_array = array();
		if ($result && $result->num_rows() > 0)
		{
			foreach ($result->result() as $row) {
				$appraisal_applicable_array[$row->rate_user_id][$row->template_section_id][$row->criteria_id][$row->item_id][$row->sequence] = $row->value;
			}
		}

		return $appraisal_applicable_array;
	}

	function get_appraisal_applicable_section_ratings($appraisal_id = 0,$appraisee_id = 0)
	{
		$this->db->select('*');
		$this->db->from('performance_appraisal_applicable_section_ratings paasr');
		$this->db->where('paasr.appraisal_id',$appraisal_id);
		$this->db->where('paasr.user_id',$appraisee_id);
		$result = $this->db->get();

		$appraisal_applicable_section_ratings_array = array();
		if ($result && $result->num_rows() > 0)
		{
			foreach ($result->result_array() as $row) {
				$appraisal_applicable_section_ratings_array[$row['template_section_id']] = $row;
			}
		}

		return $appraisal_applicable_section_ratings_array;
	}

	function get_appraisal_applicable_score_library_ratings($appraisal_id = 0,$appraisee_id = 0)
	{
		$this->db->select('*');
		$this->db->from('performance_appraisal_applicable_score_library_ratings paaslr');
		$this->db->where('paaslr.appraisal_id',$appraisal_id);
		$this->db->where('paaslr.user_id',$appraisee_id);
		$result = $this->db->get();

		$appraisal_applicable_score_library_ratings_array = array();
		if ($result && $result->num_rows() > 0)
		{
			foreach ($result->result_array() as $row) {
				$appraisal_applicable_score_library_ratings_array[$row['template_section_id']][$row['score_library_id']] = $row;
			}
		}

		return $appraisal_applicable_score_library_ratings_array;
	}
}