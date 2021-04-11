<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class training_feedback_participants_model extends Record
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
		$this->mod_id = 249;
		$this->mod_code = 'training_feedback_participants';
		$this->route = 'training/training_feedback_participants';
		$this->url = site_url('training/training_feedback_participants');
		$this->mod_url = site_url('training/training_evaluation');
		$this->primary_key = 'calendar_participant_id';
		$this->table = 'training_calendar_participant';
		$this->icon = '';
		$this->short_name = 'Training Feedback Participants';
		$this->long_name  = 'Training Feedback Participants';
		$this->description = '';
		$this->path = APPPATH . 'modules/training_feedback_participants/';

		parent::__construct();
	}

	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
		$permission = $this->config->item('permission');

		$modify_search = explode('||', $search);
		$data = array();				
		
		$search = $modify_search[0];
		$calendar_id = $modify_search[1];

		$qry = $this->_get_list_cached_query();

		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}

		$qry .= " AND {$this->db->dbprefix}{$this->table}.training_calendar_id = {$calendar_id}";	
		
		if (!isset($permission[$this->mod_code]['process']) || !$permission[$this->mod_code]['process']) {
			$qry .= " AND {$this->db->dbprefix}{$this->table}.user_id = {$this->user->user_id}";
        }

		$qry .= ' '. $filter;
		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);
		//debug($qry); die;
		$result = $this->db->query( $qry );
		if($result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}

	function get_calendar_participant_info($calendar_participant_id = 0)
	{
		$this->db->where('calendar_participant_id',$calendar_participant_id);
		$result = $this->db->get('training_calendar_participant');

		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}

	function get_training_feedback_info($training_calendar_id = 0, $user_id = 0)
	{
		$this->db->where('training_calendar_id',$training_calendar_id);
		$this->db->where('user_id',$user_id);
		$result = $this->db->get('training_feedback');

		if ($result && $result->num_rows() > 0)
			return $result->row_array();
		else
			return array();
	}

	function update_insert_feedback($info = array())
	{
		$feedback_id = 0;
		if (!empty($info)) {
			$this->db->where('training_calendar_id',$info['training_calendar_id']);
			$this->db->where('user_id',$info['user_id']);
			$result = $this->db->get('training_feedback');

			if ($result && $result->num_rows() > 0) {
				$feedback_id = $result->row()->feedback_id;

				$this->db->where('feedback_id', $feedback_id);
				$this->db->update('training_feedback', $info['training_feedback_data']);				

                //get previous data for audit logs
                $previous_main_data = $result->row_array();

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_feedback', $previous_main_data, $info['training_feedback_data']);				
			} else {
				$this->db->insert('training_feedback', $info['training_feedback_data']);

				$feedback_id = $this->db->insert_id();
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_feedback', array(), $info['training_feedback_data']);								
			}
		}

		return $feedback_id;
	}

	function update_insert_feedback_score($info = array())
	{
		if (!empty($info)) {
			foreach ($info['template_section'] as $template_section_id => $score) {
				if ($score!= '') {
					$this->db->where('template_section_id',$template_section_id);
					$template_section = $this->db->get('training_evaluation_template_section');

					$score_data = array();

					if ($template_section && $template_section->num_rows() > 0) {
						$template_section_info = $template_section->row_array();
						if ($template_section_info['section_type_id'] == 1)
							$score_data = array('feedback_id' => $info['feedback_id'], 'template_section_id' => $template_section_id,'score' => $score);
						else
							$score_data = array('feedback_id' => $info['feedback_id'], 'template_section_id' => $template_section_id, 'remarks' => $score);

					}

					$this->db->where('feedback_id',$info['feedback_id']);
					$this->db->where('template_section_id',$template_section_id);
					$result = $this->db->get('training_feedback_score');

					if ($result && $result->num_rows() > 0) {
						$feedback_score_id = $result->row()->feedback_score_id;

						$this->db->where('feedback_score_id', $feedback_score_id);
						$this->db->update('training_feedback_score', $score_data);

		                //get previous data for audit logs
		                $previous_main_data = $result->row_array();

		                //create system logs
		                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_feedback_score', $previous_main_data, $score_data);									
					} else {
						$this->db->insert('training_feedback_score', $score_data);

		                //create system logs
		                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_feedback_score', array(), $score_data);
					}
				}
			}
		}
	}	
}