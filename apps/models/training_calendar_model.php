<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_calendar_model extends Record
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
		$this->mod_id = 242;
		$this->mod_code = 'training_calendar';
		$this->route = 'training/training_calendar';
		$this->url = site_url('training/training_calendar');
		$this->primary_key = 'training_calendar_id';
		$this->table = 'training_calendar';
		$this->icon = '';
		$this->short_name = 'Training Calendar';
		$this->long_name  = 'Training Calendar';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_calendar/';

		parent::__construct();
	}

	function get_training_calendar_details($training_calendar_id)
	{
		$this->db->where('training_calendar_id',$training_calendar_id);
		$this->db->where('deleted',0);
		$result = $this->db->get('training_calendar');
		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}

	// return user id in training calendar participant in comma delimited format
	function get_training_calendar_participant_user_id($training_calendar_id)
	{
		$this->db->select('GROUP_CONCAT(user_id) AS user_ids',true);
		$this->db->where('training_calendar_id',$training_calendar_id);
		$this->db->where('deleted',0);
		$result = $this->db->get('training_calendar_participant');
		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}	
}