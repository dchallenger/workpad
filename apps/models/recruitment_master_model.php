<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class recruitment_master_model extends Record
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
		$this->mod_id = 275;
		$this->mod_code = 'recruitment_master';
		$this->route = 'admin/recruitment_master';
		$this->url = site_url('admin/recruitment_master');
		$this->primary_key = 'interview_location_id';
		$this->table = 'recruitment_interview_location';
		$this->icon = '';
		$this->short_name = 'Recruitment Admin';
		$this->long_name  = 'Recruitment';
		$this->description = 'contents and setup';
		$this->path = APPPATH . 'modules/recruitment_master/';

		parent::__construct();
	}
}