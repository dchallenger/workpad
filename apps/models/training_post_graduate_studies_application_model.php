<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_post_graduate_studies_application_model extends Record
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
		$this->mod_id = 271;
		$this->mod_code = 'training_post_graduate_studies_application';
		$this->route = 'training/training_post_graduate_studies_application';
		$this->url = site_url('training/training_post_graduate_studies_application');
		$this->primary_key = 'training_application_id';
		$this->table = 'training_application';
		$this->icon = '';
		$this->short_name = 'Post-Graduate Studies Application';
		$this->long_name  = 'Post-Graduate Studies Application';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_post_graduate_studies_application/';

		parent::__construct();
	}
}