<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class financial_metrics_kpi_model extends Record
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
		$this->mod_id = 273;
		$this->mod_code = 'financial_metrics_kpi';
		$this->route = 'admin/financial_metrics_kpi';
		$this->url = site_url('admin/financial_metrics_kpi');
		$this->primary_key = 'financial_metrics_kpi_id';
		$this->table = 'performance_setup_financial_metrics_kpi';
		$this->icon = '';
		$this->short_name = 'Financial Metrics KPI';
		$this->long_name  = 'Financial Metrics KPI';
		$this->description = '';
		$this->path = APPPATH . 'modules/financial_metrics_kpi/';

		parent::__construct();
	}
}