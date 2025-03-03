<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class sbu_unit_model extends Record
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
		$this->mod_id = 266;
		$this->mod_code = 'sbu_unit';
		$this->route = 'admin/user/sbu_unit';
		$this->url = site_url('admin/user/sbu_unit');
		$this->primary_key = 'sbu_unit_id';
		$this->table = 'users_sbu_unit';
		$this->icon = 'fa-th-list';
		$this->short_name = 'SBU';
		$this->long_name  = 'SBU';
		$this->description = 'Manage and list sbu.';
		$this->path = APPPATH . 'modules/sbu_unit/';

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

		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.sbu_unit";

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

	function get_sbu_unit($manpower_allocation_column_name = false,$sbu_unit = false)
	{
		if ($manpower_allocation_column_name) {
			$this->db->where('manpower_allocation_column_name',$manpower_allocation_column_name);
		}

		if ($sbu_unit) {
			$this->db->where('sbu_unit',$sbu_unit);
		}

		$sbu_unit = $this->db->get_where('users_sbu_unit');

		return $sbu_unit;
	}

	function gen_sbu_unit_arr()
	{
		$sbu_uni_arr = array();
		$sbu_unit = $this->get_sbu_unit();
		if ($sbu_unit && $sbu_unit->num_rows() > 0) {
			foreach ($sbu_unit->result() as $row) {
				array_push($sbu_uni_arr,$row->sbu_unit);
			}
		}
		return $sbu_uni_arr;
	}
}