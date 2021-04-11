<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class school_model extends Record
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
		$this->mod_id = 280;
		$this->mod_code = 'school';
		$this->route = 'admin/partner/school';
		$this->url = site_url('admin/partner/school');
		$this->primary_key = 'education_school_id';
		$this->table = 'users_education_school';
		$this->icon = '';
		$this->short_name = 'School';
		$this->long_name  = 'School';
		$this->description = '';
		$this->path = APPPATH . 'modules/school/';

		parent::__construct();
	}
}