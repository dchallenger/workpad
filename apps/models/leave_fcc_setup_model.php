<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class leave_fcc_setup_model extends Record
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
		$this->mod_id = 267;
		$this->mod_code = 'leave_fcc_setup';
		$this->route = 'admin/leave_fcc_setup';
		$this->url = site_url('admin/leave_fcc_setup');
		$this->primary_key = 'fcc_setup_id';
		$this->table = 'time_form_balance_fcc_setup';
		$this->icon = 'fa-th-list';
		$this->short_name = 'Leave FCC Setup';
		$this->long_name  = 'Leave FCC Setup';
		$this->description = 'Leave (Forfeiture, Conversion and Carry over setup)';
		$this->path = APPPATH . 'modules/leave_fcc_setup/';

		parent::__construct();
	}
}