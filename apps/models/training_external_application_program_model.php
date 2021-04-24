<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_external_application_program_model extends Record
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
		$this->mod_id = 270;
		$this->mod_code = 'training_external_application_program';
		$this->route = 'training/training_external_application_program';
		$this->url = site_url('training/training_external_application_program');
		$this->primary_key = 'training_application_id';
		$this->table = 'training_application';
		$this->icon = '';
		$this->short_name = 'External Program Application';
		$this->long_name  = 'External Program Application';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_external_application_program/';

		parent::__construct();
	}

	public function get_objective($training_application_id = 0)
	{
		$this->db->where('training_application_id',$training_application_id);
		$this->db->where('deleted',0);
		$result = $this->db->get('training_application_objective');
		return $result;
	}
	public function get_action_plan($training_application_id = 0)
	{
		$this->db->where('training_application_id',$training_application_id);
		$this->db->where('deleted',0);
		$result = $this->db->get('training_application_action_plan');
		return $result;
	}
	public function get_knowledge_transfer($training_application_id = 0)
	{
		$this->db->where('training_application_id',$training_application_id);
		$this->db->where('deleted',0);
		$result = $this->db->get('training_application_knowledge_transfer');
		return $result;
	}
}