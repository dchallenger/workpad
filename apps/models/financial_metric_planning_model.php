<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class financial_metric_planning_model extends Record
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
		$this->mod_id = 274;
		$this->mod_code = 'financial_metric_planning';
		$this->route = 'appraisal/financial_metric_planning';
		$this->url = site_url('appraisal/financial_metric_planning');
		$this->primary_key = 'financial_metric_planning_id';
		$this->table = 'performance_financial_metric_planning';
		$this->icon = 'fa-folder';
		$this->short_name = 'Financial Metric Planning';
		$this->long_name  = 'Financial Metric Planning';
		$this->description = '';
		$this->path = APPPATH . 'modules/financial_metric_planning/';

		parent::__construct();
	}

	public function get_financial_metric_planning_details($financial_metric_planning_details_id)
	{
		$this->db->where('financial_metric_planning_id',$financial_metric_planning_details_id);
		$this->db->join('ww_performance_setup_financial_metrics_kpi','performance_financial_metric_planning_details.financial_metric_kpi_id=ww_performance_setup_financial_metrics_kpi.financial_metrics_kpi_id','left');
		$result = $this->db->get('performance_financial_metric_planning_details');
		return $result;
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

		$qry .= " GROUP BY {$this->db->dbprefix}performance_financial_metric_planning.financial_metric_planning_id";

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