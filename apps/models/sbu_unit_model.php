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
		$this->short_name = 'SBU Unit';
		$this->long_name  = 'SBU Unit';
		$this->description = 'Manage and list sbu unit.';
		$this->path = APPPATH . 'modules/sbu_unit/';

		parent::__construct();
	}
}