<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class compensation_model extends Record
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
		$this->mod_id = 287;
		$this->mod_code = 'compensation';
		$this->route = 'admin/partner/compensation';
		$this->url = site_url('admin/partner/compensation');
		$this->primary_key = 'compensation_id';
		$this->table = 'users_compensation';
		$this->icon = '';
		$this->short_name = 'Compensation';
		$this->long_name  = 'Compensation';
		$this->description = '';
		$this->path = APPPATH . 'modules/compensation/';

		parent::__construct();
	}
}