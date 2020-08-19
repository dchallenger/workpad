<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class previous_employer_amount_for_alphalist_model extends Record
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
		$this->mod_id = 262;
		$this->mod_code = 'previous_employer_amount_for_alphalist';
		$this->route = 'payroll/previous_employer_amount_for_alphalist';
		$this->url = site_url('payroll/previous_employer_amount_for_alphalist');
		$this->primary_key = 'payroll_partners_previous_employer_id';
		$this->table = 'payroll_partners_previous_employer';
		$this->icon = 'fa-folder';
		$this->short_name = 'Previous Employer Alphalist';
		$this->long_name  = 'Previous Employer Alphalist';
		$this->description = '';
		$this->path = APPPATH . 'modules/previous_employer_amount_for_alphalist/';

		parent::__construct();
	}
}