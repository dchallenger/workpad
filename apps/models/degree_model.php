<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class degree_model extends Record
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
		$this->mod_id = 281;
		$this->mod_code = 'degree';
		$this->route = 'admin/partner/degree';
		$this->url = site_url('admin/partner/degree');
		$this->primary_key = 'education_degree_obtained_id';
		$this->table = 'users_education_degree_obtained';
		$this->icon = '';
		$this->short_name = 'Degree';
		$this->long_name  = 'Degree';
		$this->description = '';
		$this->path = APPPATH . 'modules/degree/';

		parent::__construct();
	}
}