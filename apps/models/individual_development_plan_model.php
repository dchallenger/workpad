<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class individual_development_plan_model extends Record
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
		$this->mod_id = 272;
		$this->mod_code = 'individual_development_plan';
		$this->route = 'appraisal/individual_development_plan';
		$this->url = site_url('appraisal/individual_development_plan');
		$this->primary_key = 'individual_development_plan_id';
		$this->table = 'performance_appraisal_idp';
		$this->icon = '';
		$this->short_name = 'Individual Development Plan';
		$this->long_name  = 'Individual Development Plan';
		$this->description = '';
		$this->path = APPPATH . 'modules/individual_development_plan/';

		parent::__construct();
	}


	public function get_appraisal_areas_development()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('performance_appraisal_areas_development');

		return $result;
	}

	public function get_learning_mode()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('performance_appraisal_learning_mode');
		
		return $result;
	}

	public function get_competencies()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('training_category');
		
		return $result;
	}

	public function get_development_category()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('performance_appraisal_development_category');
		
		return $result;
	}

	public function get_target_completion()
	{
		$this->db->where('deleted',0);
		$result = $this->db->get('performance_appraisal_target_completion');
		
		return $result;
	}		
}