<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class benefit_model extends Record
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
		$this->mod_id = 286;
		$this->mod_code = 'benefit';
		$this->route = 'admin/benefit';
		$this->url = site_url('admin/benefit');
		$this->primary_key = 'benefit_id';
		$this->table = 'users_benefit';
		$this->icon = 'fa-sitemap';
		$this->short_name = 'Employee Benefit';
		$this->long_name  = 'Employee Benefit';
		$this->description = 'Manage and list employee benefit.';
		$this->path = APPPATH . 'modules/benefit/';

		parent::__construct();
	}
}