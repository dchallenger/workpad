<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class appraisal_individual_planning_model extends Record
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
		$this->mod_id = 109;
		$this->mod_code = 'appraisal_individual_planning';
		$this->route = 'appraisal/individual_planning';
		$this->url = site_url('appraisal/individual_planning');
		$this->primary_key = 'planning_id';
		$this->table = 'performance_planning';
		$this->icon = 'fa-folder';
		$this->short_name = 'Individual Target Setting';
		$this->long_name  = 'Individual Target Setting';
		$this->description = '';
		$this->path = APPPATH . 'modules/appraisal_individual_planning/';

		parent::__construct();
	}

	function get_employee_appraisal_planning($user_id,$current_planning_id)
	{
		$this->db->where('performance_planning.planning_id <>',$current_planning_id);
		$this->db->where('performance_planning.deleted',0);
		$this->db->where('user_id',$user_id);
		$this->db->join('performance_planning_applicable ppa','ppa.planning_id = performance_planning.planning_id','left');
		$this->db->join('performance_setup_performance sp','sp.performance_id = performance_planning.performance_type_id','left');
		$result = $this->db->get('performance_planning');
		return $result;
	}

	function get_appraisee( $planning_id, $user_id )
	{
		$qry = "select a.*, a.created_on as planning_created_on, b.*, b.status_id as performance_status_id,IFNULL(ppah.employment_type,c.employment_type) AS employment_type,IFNULL(ppah.job_level,c.v_job_grade) as v_job_grade, c.alias, c.effectivity_date, IFNULL(ppah.company,d.company) AS company, IFNULL(ppah.position,d.v_position) as position, i.full_name as immediate, h.position as immediate_position,
		IFNULL(ppah.reports_to,d.v_reports_to) as v_reports_to, IFNULL(ppah.department,d.v_department) as v_department, IFNULL(ppah.dept_head,j.immediate) as dept_head, IFNULL(ppah.division,d.v_division) as v_division, IFNULL(ppah.div_head,k.immediate) as div_head, c.position_classification
		FROM {$this->db->dbprefix}performance_planning a
		LEFT JOIN {$this->db->dbprefix}performance_planning_applicable b ON b.planning_id = a.planning_id
		LEFT JOIN partners c ON c.user_id = b.user_id
		LEFT JOIN {$this->db->dbprefix}users_profile d ON d.user_id = b.user_id
		LEFT JOIN performance_planning_applicable_history ppah ON d.user_id = ppah.user_id AND ppah.planning_id = {$planning_id}
		LEFT JOIN {$this->db->dbprefix}users_profile g ON g.user_id = d.reports_to_id
		LEFT JOIN {$this->db->dbprefix}users_position h ON h.position_id = g.position_id
		LEFT JOIN {$this->db->dbprefix}users i ON i.user_id = d.reports_to_id
		LEFT JOIN {$this->db->dbprefix}users_department j ON j.department_id = d.department_id
		LEFT JOIN {$this->db->dbprefix}users_division k ON k.division_id = d.division_id
		LEFT JOIN {$this->db->dbprefix}users_position_classification l ON c.position_classification_id = l.position_classification_id
		WHERE b.planning_id = {$planning_id} AND b.user_id = {$user_id}";

		$appraisee = $this->db->query( $qry );
		return $appraisee->row();
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
		
		//$qry .= " AND {$this->db->dbprefix}{$this->table}_applicable.status_id IN (6,4,11)";	
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

	function get_notes( $planning_id, $user_id )
	{
		$qry = "select a.*, b.full_name, IF(c.photo != '',c.photo,'uploads/users/avatar.png') as photo, gettimeline(a.created_on) as timeline, d.department
		FROM {$this->db->dbprefix}performance_planning_notes a
		LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.created_by
		LEFT JOIN {$this->db->dbprefix}users_profile c on c.user_id = a.created_by
		LEFT JOIN {$this->db->dbprefix}users_department d on d.department_id = c.department_id
		WHERE a.planning_id = {$planning_id} AND a.user_id = {$user_id}
		ORDER BY a.created_on DESC";

		return $this->db->query( $qry )->result();
	}

	function get_approver( $planning_id, $user_id, $approver_id )
	{
		$where = array(
			'planning_id' => $planning_id,
			'user_id' => $user_id,
			'approver_id' => $approver_id
		);

		$this->db->limit(1);
		$approver = $this->db->get_where('performance_planning_approver', $where);
		if($approver->num_rows() == 1)
			return $approver->row();
		else
			return false;
	}

	function get_balance_score_card()
	{
		$this->db->where('deleted',0);
		$this->db->where('status_id',1);
		$result = $this->db->get('performance_setup_scorecard');
		return $result;
	}

	function get_library_competencies()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('performance_setup_library_value');

		$library_value_array = array();
		if ($result && $result->num_rows() > 0) {
			foreach ($result->result() as $row) {
				$library_value_array[$row->library_id][] = $row;
			}
		}
		return $library_value_array;
	}

	function get_template_section_column($section_id = 0)
	{
		$this->db->where('deleted',0);

		if ($section_id)
			$this->db->where('section_id',$section_id);			

		$this->db->order_by('template_section_id');
		$this->db->order_by('sequence');
		$result = $this->db->get('performance_template_section_column');

		$template_section_column_array = array();
		if ($result && $result->num_rows() > 0) {
			foreach ($result->result() as $row) {
				$template_section_column_array[$row->template_section_id][] = $row;
			}
		}

		return $template_section_column_array;
	}


	function get_planning_applicable_fields($planning_id = 0,$appraisee_id = 0)
	{
		$this->db->select('
							ppaf.planning_id,ppaf.user_id,ppaf.scorecard_id,ppaf.section_column_id,ppaf.value,ppaf.sequence,
							ptsc.uitype_id,ptsc.class,ptsc.required,ptsc.data_type,ptsc.can_add_row,ptsc.sequence AS column_sequence
						');

		$this->db->from('performance_planning_applicable_fields ppaf');
		$this->db->join('performance_template_section_column ptsc','ppaf.section_column_id = ptsc.section_column_id');
		$this->db->where('ppaf.planning_id',$planning_id);
		$this->db->where('ppaf.user_id',$appraisee_id);
		$this->db->where('ppaf.deleted',0);
		$this->db->order_by('ppaf.scorecard_id,ppaf.sequence');
		$result = $this->db->get();

		$planning_applicable_array = array();
		if ($result && $result->num_rows() > 0)
		{
			foreach ($result->result() as $row) {
				$info_arr = array(
									'value' => $row->value,
									'uitype_id' => $row->uitype_id,
									'class' => $row->class,
									'required' => $row->required,
									'data_type' => $row->data_type,
									'can_add_row' => $row->can_add_row,
									'column_sequence' => $row->column_sequence
								 );

				$planning_applicable_array[$row->scorecard_id][$row->sequence][$row->section_column_id] = $info_arr;
			}
		}

		return $planning_applicable_array;
	}

	function get_template_section($template_id = 0)
	{
		$this->db->where('deleted',0);
		$this->db->where('template_id',$template_id);
		$this->db->order_by('sequence');
		$result = $this->db->get('performance_template_section');
		return $result;
	}	
}