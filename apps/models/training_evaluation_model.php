<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_evaluation_model extends Record
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
		$this->mod_id = 244;
		$this->mod_code = 'training_evaluation';
		$this->route = 'training/training_evaluation';
		$this->url = site_url('training/training_evaluation');
		$this->primary_key = 'training_calendar_id';
		$this->table = 'training_calendar';
		$this->icon = '';
		$this->short_name = 'Training Evaluation';
		$this->long_name  = 'Training Evaluation';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_evaluation/';

		parent::__construct();
	}

	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
        $permission = $this->config->item('permission');

		$data = array();				
		
		$qry = $this->_get_list_cached_query();
		
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";
		}
		
        if (!isset($permission[$this->mod_code]['process']) || !$permission[$this->mod_code]['process']) {
			$qry .= " AND T4.user_id = {$this->user->user_id}";
        }

		$qry .= ' '. $filter;

		$qry .= " GROUP BY {$this->db->dbprefix}{$this->table}.training_calendar_id";

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