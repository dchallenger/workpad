<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class evaluation_template_model extends Record
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
		$this->mod_id = 205;
		$this->mod_code = 'evaluation_template';
		$this->route = 'admin/evaluation_template';
		$this->url = site_url('admin/evaluation_template');
		$this->primary_key = 'evaluation_template_id';
		$this->table = 'training_evaluation_template';
		$this->icon = '';
		$this->short_name = 'Training Evaluation Template';
		$this->long_name  = 'Evaluation Template';
		$this->description = '';
		$this->path = APPPATH . 'modules/evaluation_template/';

		parent::__construct();
	}

	public function get_sections($evaluation_template_id = 0)
	{
		$this->db->where('training_evaluation_template_section.evaluation_template_id',$evaluation_template_id);
		$this->db->where('training_evaluation_template_section.deleted',0);
		$this->db->join('training_evaluation_template_section_type','training_evaluation_template_section.section_type_id = training_evaluation_template_section_type.section_type_id','LEFT');
		$result = $this->db->get('training_evaluation_template_section');

		return $result;
	}
}