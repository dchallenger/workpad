<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class audit_log_model extends Record
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
		$this->mod_id = 263;
		$this->mod_code = 'audit_log';
		$this->route = 'audit_log';
		$this->url = site_url('audit_log');
		$this->primary_key = 'audit_log_trail_id';
		$this->table = 'audit_log_trail';
		$this->icon = '';
		$this->short_name = 'Audit Log';
		$this->long_name  = 'Audit Log';
		$this->description = 'Audit Log Trail';
		$this->path = APPPATH . 'modules/audit_log/';

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
		
		$qry .= " AND {$this->db->dbprefix}{$this->table}.item_name NOT IN ('key','key_id','sequence')";

		$qry .= ' '. $filter;
		$qry .= " GROUP BY modules,item_name,original_value,new_value,date_time";
		$qry .= " ORDER BY {$this->db->dbprefix}{$this->table}.date_time DESC";
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
}