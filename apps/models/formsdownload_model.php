<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class formsdownload_model extends Record
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
		$this->mod_id = 149;
		$this->mod_code = 'formsdownload';
		$this->route = 'partner/formsdownload';
		$this->url = site_url('partner/formsdownload');
		$this->primary_key = 'resource_download_id';
		$this->table = 'resources_downloadable';
		$this->icon = '';
		$this->short_name = 'Downloadable Forms';
		$this->long_name  = 'Downloadable Forms';
		$this->description = '';
		$this->path = APPPATH . 'modules/formsdownload/';

		parent::__construct();
	}

	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
		$data = array();	
		$user = $this->config->item('user');			

		$role_permission = array();//$this->get_role_permission(22);		
		
		$qry = $this->_get_list_cached_query();
		
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}

		$qry .= ' '. $filter;
		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);

		$result = $this->db->query( $qry );

		if($result && $result->num_rows() > 0)
		{	
			$user_company_id = 0;
			$this->db->where('user_id',$this->user->user_id);
			$user_info = $this->db->get('users_profile');
			if ($user_info && $user_info->num_rows() > 0)
				$user_company_id = $user_info->row()->company_id;

			foreach($result->result_array() as $row){
				if ($row['resources_downloadable_company_id'] != '') {
					if ( in_array($user_company_id, explode(',', $row['resources_downloadable_company_id']))) {
						$data[] = $row;
					}
				}
				else 
					$data[] = $row;
			}
		}

		return $data;
	}		
}