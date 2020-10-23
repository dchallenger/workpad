<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class table_organization_model extends Record
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
		$this->mod_id = 269;
		$this->mod_code = 'table_organization';
		$this->route = 'partner/table_organization';
		$this->url = site_url('partner/table_organization');
		$this->primary_key = 'user_id';
		$this->table = 'users';
		$this->icon = '';
		$this->short_name = 'Table of Organization';
		$this->long_name  = 'Table of Organization';
		$this->description = 'Generation of table of organization';
		$this->path = APPPATH . 'modules/table_organization/';

		parent::__construct();
	}

	public function get_user_by_position($position = '') {
		if ($position != '')
			$this->db->where('v_position',$position);

		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users');

		$user_info = array();
		if ($result && $result->num_rows() > 0) {
			$user_info = $result->result_array();
		}

		return $user_info;
	}

	public function get_user_by_division($division_id = '') {
		if ($division_id != '') {
			$division_ids = explode(',', $division_id);
			$this->db->where_in('users_division.division_id',$division_ids);
		}

		$this->db->join('users','users.user_id = users_division.immediate_id');
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users_division');

		$user_info = array();
		if ($result && $result->num_rows() > 0) {
			$user_info = $result->result_array();
		}

		return $user_info;
	}

	public function get_user_by_department($department_id = '') {
		if ($department_id != '')
			$this->db->where('users_department.department_id',$department_id);
		
		$this->db->join('users','users.user_id = users_department.immediate_id');
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users_department');

		$user_info = array();
		if ($result && $result->num_rows() > 0) {
			$user_info = $result->result_array();
		}

		return $user_info;
	}

	public function get_reports_to($user_info = [],$rank = 0) {
		$content = '';
		foreach ($user_info as $key => $value) {
			$content .= '<ul class="tree">';					
			$content .= '<li> <span>'.$value['display_name'].' <br> '. $value['v_position'] .'</span>';

			$user_id = $value['user_id'];
			$this->db->select("{$user_id} as parent_id,users.display_name,users.user_id",false);
			$this->db->where('reports_to_id',$user_id);
			$this->db->where_in('v_job_grade',$rank);
			$this->db->join('partners','users.user_id = partners.user_id');
			$this->db->join('users_profile','users.user_id = users_profile.user_id');
			$result = $this->db->get('users');

			if ($result && $result->num_rows() > 0) {
				$content .= '<ul>';			
				foreach ($result->result() as $row) {
					$content .= '<li><span>'.$row->display_name.'</span>';
					$content .= $this->get_reports_to_1st($row->user_id,$rank);
					$content .= '</li>';
				}
				$content .= '</ul>';			
			}

			$content .= '</li><br clear="all">';
			$content .= '</ul>';			
		}

		return $content;
	}

	public function get_reports_to_1st($user_id = 0,$rank = 0) {
		$content = '';

		$this->db->select("{$user_id} as parent_id,users.display_name,users.user_id",false);
		$this->db->where('users.user_id <>',222);
		$this->db->where('reports_to_id',$user_id);
		$this->db->where_in('v_job_grade',$rank);
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users');

		if ($result && $result->num_rows() > 0) {
			$content .= '<ul>';			
			foreach ($result->result() as $row) {
				$content .= '<li><span>'.$row->display_name.'</span>';
				$content .= $this->get_reports_to_2nd($row->user_id,$rank,$content);
				$content .= '</li>';
			}
			$content .= '</ul>';			
		}
		
		return $content;
	}

	public function get_reports_to_2nd($user_id = 0,$rank = 0) {
		$content = '';
		$this->db->select("{$user_id} as parent_id,users.display_name,users.user_id",false);
		$this->db->where('users.user_id <>',222);
		$this->db->where('reports_to_id',$user_id);
		$this->db->where_in('v_job_grade',$rank);
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users');

		if ($result && $result->num_rows() > 0) {
			$content .= '<ul>';			
			foreach ($result->result() as $row) {
				$content .= '<li><span>'.$row->display_name.'</span>';
				$content .= $this->get_reports_to_3rd($row->user_id,$rank,$content);
				$content .= '</li>';
			}
			$content .= '</ul>';			
		}
		
		return $content;
	}	

	public function get_reports_to_3rd($user_id = 0,$rank = 0) {
		$content = '';
		$this->db->select("{$user_id} as parent_id,users.display_name,users.user_id",false);
		$this->db->where('users.user_id <>',222);
		$this->db->where('reports_to_id',$user_id);
		$this->db->where_in('v_job_grade',$rank);
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users');

		if ($result && $result->num_rows() > 0) {
			$content .= '<ul>';			
			foreach ($result->result() as $row) {
				$content .= '<li><span>'.$row->display_name.'</span>';
				$content .= $this->get_reports_to_4th($row->user_id,$rank,$content);
				$content .= '</li>';
			}
			$content .= '</ul>';			
		}
		
		return $content;
	}

	public function get_reports_to_4th($user_id = 0,$rank = 0) {
		$content = '';
		$this->db->select("{$user_id} as parent_id,users.display_name,users.user_id",false);
		$this->db->where('users.user_id <>',222);
		$this->db->where('reports_to_id',$user_id);
		$this->db->where_in('v_job_grade',$rank);
		$this->db->join('partners','users.user_id = partners.user_id');
		$this->db->join('users_profile','users.user_id = users_profile.user_id');
		$result = $this->db->get('users');

		if ($result && $result->num_rows() > 0) {
			$content .= '<ul>';			
			foreach ($result->result() as $row) {
				$content .= '<li><span>'.$row->display_name.'</span>';
				//$content .= $this->get_reports_to_4th($row->user_id,$rank,$content);
				$content .= '</li>';
			}
			$content .= '</ul>';			
		}
		
		return $content;
	}
}