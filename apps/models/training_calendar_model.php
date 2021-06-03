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

	function get_training_calendar_info($record_id)
	{
		$qry = "SELECT 
			tc.training_title,
			tco.course,
			tct.calendar_type as training_type,
			tp.provider as training_provider,
			tcat.category as category,
			tc.training_capacity as min_capacity,
			tc.min_training_capacity as max_capacity,
			tc.venue as venue,
			tc.topic as description,
			IF(tc.tba = 1,'Yes','No') as to_be_announced,
			tc.equipment,
			tc.registration_date,
			tc.cost_per_pax,
			DATE_FORMAT(tc.last_registration_date, '%M %d, %Y') as last_registration_date,
			DATE_FORMAT(tc.publish_date, '%M %d, %Y') as publish_date,
			IF(tc.with_certification = 1,'Yes','No') as with_certification,
			DATE_FORMAT(tc.revalida_date, '%M %d, %Y') as revalida_date,
			IF(tc.planned = 1,'Yes','No') as with_certification
			FROM ww_training_calendar tc
			LEFT JOIN ww_training_category tcat ON tcat.category_id = tc.training_category_id
			LEFT JOIN ww_training_provider tp ON tp.provider_id = tc.training_provider_id
			LEFT JOIN ww_training_course tco ON tco.course_id = tc.course_id
			LEFT JOIN ww_training_calendar_type tct ON tct.calendar_type_id = tc.calendar_type_id
			WHERE tc.training_calendar_id = {$record_id}
		";

		$result = $this->db->query($qry);

		$info = array();
		if ($result && $result->num_rows() > 0) {
			$info = $result->row_array();
		}

		return $info;
	}	
}