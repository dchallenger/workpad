<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class manpower_allocation_model extends Record
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
		$this->mod_id = 284;
		$this->mod_code = 'manpower_allocation';
		$this->route = 'appraisal/manpower_allocation';
		$this->url = site_url('appraisal/manpower_allocation');
		$this->primary_key = 'manpower_allocation_id';
		$this->table = 'performance_manpower_allocation_fix_column';
		$this->icon = '';
		$this->short_name = 'Manpower Allocation';
		$this->long_name  = 'Manpower Allocation';
		$this->description = '';
		$this->path = APPPATH . 'modules/manpower_allocation/';

		$this->load->model('sbu_unit_model');

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
		$qry .= " ORDER BY full_name LIMIT $limit OFFSET $start";

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

	function add_manpower_allocation($sbu_unit_info = []) {
		$sbu_unit_master_info = $this->sbu_unit_model->get_sbu_unit(0,$sbu_unit_info['sbu']);
		if ($sbu_unit_master_info && $sbu_unit_master_info->num_rows() > 0) {
			$column_name = $sbu_unit_master_info->row()->manpower_allocation_column_name;
		}

		if (count($sbu_unit_info) > 0 && isset($sbu_unit_info['employee_number'])) {
			$this->db->where('deleted',0);
			$this->db->where('id_number',$sbu_unit_info['employee_number']);
			$partners = $this->db->get('partners');

			$data[$column_name] = $sbu_unit_info['allocation'];

			if ($partners && $partners->num_rows() > 0) {
				$data['full_name'] = $partners->row()->alias;
				$data['user_id'] = $partners->row()->user_id;
			}

			$data['date_processed'] = date('Y-m-d H:i:s');

			$this->db->where('archive',0);
			$this->db->where('id_number',$sbu_unit_info['employee_number']);
			$result = $this->db->get('performance_manpower_allocation_fix_column');

			if ($result && $result->num_rows() > 0) {
				$id_number = $result->row()->id_number;
				$this->db->where('id_number',$id_number);
				$this->db->update('performance_manpower_allocation_fix_column',$data);
			} else {
				$data['id_number'] = $sbu_unit_info['employee_number'];
				$this->db->insert('performance_manpower_allocation_fix_column',$data);
			}
		}
	}

	function get_dynamic_column()
	{
		$column = array();

		$fields = $this->db->list_fields('ww_performance_manpower_allocation_fix_column');

		$not_included = array('manpower_allocation_id',
							  'planning_id',
							  'user_id',
							  'remarks',
							  'created_on',
							  'created_by',
							  'modified_on',
							  'modified_by',
							  'deleted');

		foreach ($fields as $key => $val) {
			if (!in_array($val,$not_included)) {
				$sbu_unit = $this->sbu_unit_model->get_sbu_unit($val);
				if ($sbu_unit && $sbu_unit->num_rows() > 0) {
					$sbu_unit_info = $sbu_unit->row();
					$column[$val] = $sbu_unit_info->sbu_unit;
				}
			}
		}

		$column['total'] = 'Total';

		return $column;
	}
}