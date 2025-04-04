<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class profile_model extends Record
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
		$this->mod_id = 99;
		$this->mod_code = 'profile';
		$this->route = 'account/public';
		$this->url = site_url('account/public');
		$this->primary_key = 'user_id';
		$this->table = 'users_profile_public';
		$this->icon = '';
		$this->short_name = 'My Profile';
		$this->long_name  = 'My Profile';
		$this->description = 'My Profile';
		$this->path = APPPATH . 'modules/profile/';

		parent::__construct();
	}


	function get_profile_header_details($user_id=0){
		$this->db->select('title, lastname, firstname, middlename, suffix, users_position.position, users_profile.project_id as project_id, users_profile.v_project as project,
			department, v_project_hr as project_hr, sbu_unit_id, sbu_unit, sbu_unit_details, v_coordinator as coordinator, v_credit_setup as credit_setup, branch, ww_users_company.company, email, birth_date, photo, job_level, 
			location, id_number, biometric, shift, calendar, employment_status, effectivity_date, regularization_date,old_new,
			original_hired_date,employment_end_date,last_promotion_date,users_division.division, users_division.division_code, users_division.cost_center_code, users_profile.reports_to_id as immediate, group, role,
			maidenname, nickname, partners_employment_type.employment_type, partners_classification.classification, resigned_date, start_date, end_date')		
	    ->from('users')
	    ->join('users_profile', 'users.user_id = users_profile.user_id', 'left')
	    ->join('users_position', 'users_profile.position_id = users_position.position_id', 'left')
	    ->join('users_department', 'users_profile.department_id = users_department.department_id', 'left')
	    ->join('users_branch', 'users_profile.branch_id = users_branch.branch_id', 'left')
	    ->join('users_project', 'users_profile.project_id = users_project.project_id', 'left')
	    ->join('users_company', 'users_profile.company_id = users_company.company_id', 'left')
	    ->join('users_location', 'users_profile.location_id = users_location.location_id', 'left')
	    ->join('partners', 'users_profile.user_id = partners.user_id', 'left')
	    ->join('partners_employment_status', 'partners.status_id = partners_employment_status.employment_status_id', 'left')
	    ->join('partners_employment_type', 'partners.employment_type_id = partners_employment_type.employment_type_id', 'left')
	    ->join('partners_classification', 'partners.classification_id = partners_classification.classification_id', 'left')
	    ->join('users_division', 'users_profile.division_id = users_division.division_id', 'left')
	    ->join('users_job_grade_level', 'partners.job_grade_id = users_job_grade_level.job_grade_id', 'left')
	    ->join('users_group', 'users_profile.group_id = users_group.group_id', 'left')
	    ->join('roles', 'users.role_id = roles.role_id', 'left')
	    ->where("users.user_id = $user_id");
	    
	    $profile_header_details = $this->db->get('');	

	    return $profile_header_details->row_array();
	}

	function get_partners_personal($user_id=0, $key=''){

		$this->db->select('key_value')
	    ->from('partners_personal ')
	    ->join('partners', 'partners_personal.partner_id = partners.partner_id', 'left')
	    ->where("partners.user_id = $user_id")
	    ->where("partners_personal.key = '$key'")
	    ->where("partners_personal.deleted = 0");

	    $partners_personal = $this->db->get('');	
		if( $partners_personal->num_rows() > 0 )
	    	return $partners_personal->result_array();
	    else
	    	return array();
	}

	function get_partners_personal_history($user_id=0, $key_class_code=''){

		$this->db->select('key, sequence, key_value, personal_id')
	    ->from('partners_personal_history')
	    ->join('partners', 'partners_personal_history.partner_id = partners.partner_id', 'left')
	    ->join('partners_key', 'partners_personal_history.key_id = partners_key.key_id', 'left')
	    ->join('partners_key_class', 'partners_key.key_class_id = partners_key_class.key_class_id', 'left')
	    ->where("partners.user_id = $user_id")
	    ->where("partners_key_class.key_class_code = '$key_class_code'");

	    $partners_personal_history = $this->db->get();	
	    if( $partners_personal_history->num_rows() > 0 )
	    	return $partners_personal_history->result_array();
	    else
	    	return array();
	}

	public function get_partner_id($user_id=0){
		$partner_details = array();

		$sql_partner = $this->db->get_where('partners', array('user_id' => $user_id));
		$partner_details = $sql_partner->row_array();
		if(!empty($partner_details)){
			return $partner_details['partner_id'];
		}
		return null;
	}
	
	function get_partners_personal_list_details($user_id=0, $key_class_code='', $sequence=0){

		$partner_id = $this->get_partner_id($user_id);
		$this->db->select('key, sequence, key_value, personal_id')
	    ->from('partners_personal_history')
	    ->join('partners', 'partners_personal_history.partner_id = partners.partner_id', 'left')
	    ->join('partners_key', 'partners_personal_history.key_id = partners_key.key_id', 'left')
	    ->join('partners_key_class', 'partners_key.key_class_id = partners_key_class.key_class_id', 'left')
	    ->where("partners.partner_id = $partner_id")
	    ->where("partners_key_class.key_class_code = '$key_class_code'")
	    ->where("partners_personal_history.sequence = '$sequence'");

	    $partners_personal_list_details = $this->db->get('');	
	    // echo $this->db->last_query();exit();
		return $partners_personal_list_details->result_array();
	}

	function get_partners_personal_image_details($user_id=0, $personal_id=''){

		$this->db->select('key_value')
	    ->from('partners_personal_history ')
	    ->join('partners', 'partners_personal_history.partner_id = partners.partner_id', 'left')
	    ->where("partners_personal_history.personal_id = '$personal_id'");

	    $partners_personal_image_detail = $this->db->get('');	
		return $partners_personal_image_detail->row_array();
	}

	function get_user_editable_keys( $key_class_id = '' )
	{
		$this->db->select('partners_key.*');
		$this->db->select('partners_key_class.*');
		$this->db->join('partners_key_class', 'partners_key_class.key_class_id = partners_key.key_class_id');
		if( !empty($key_class_id) )
		{
			$this->db->where('partners_key_class.key_class_id', $key_class_id);
		}

		$keys = $this->db->get_where('partners_key', array('partners_key.deleted' => 0, 'partners_key_class.user_edit' => 1));
		if( $keys->num_rows() > 0 )
			return $keys->result();
		else
			return array();
	}

	function get_user_editable_key_classes()
	{

		$this->db->order_by('key_class_code', 'asc');
		$classes = $this->db->get_where('partners_key_class', array('deleted' => 0, 'user_edit_change_request' => 1));
		if( $classes->num_rows() > 0 )
			return $classes->result();
		else
			return array();
	}

	function get_user_editable_keys_draft( $user_id )
	{
		$this->db->join('partners_key', 'partners_personal_request.key_id = partners_key.key_id', 'left');
		$this->db->join('partners_key_class', 'partners_key_class.key_class_id = partners_key.key_class_id', 'left');
		$this->db->order_by('key_class', 'asc');
		$this->db->order_by('key_label', 'asc');
		$keys = $this->db->get_where('partners_personal_request', array('partners_personal_request.user_id' => $user_id, 'partners_personal_request.deleted' => 0, 'partners_personal_request.status' => 1));
		if( $keys->num_rows() > 0 )
			return $keys->result();
		else
			return array();
	}

	function create_key_draft( $key, $value )
	{
		switch( $key->key_code )
		{
			case 'city_town':
			case 'permanent_city_town':
				$this->load->helper('form');
				return $this->load->view('key_templates/city_ddlb', array('key' => $key, 'value' => $value), true);
				break;
			case 'country':
			case 'permanent_country':
				$this->load->helper('form');
				return $this->load->view('key_templates/country_ddlb', array('key' => $key, 'value' => $value), true);
				break;
			case 'civil_status':
				$this->load->helper('form');
				return $this->load->view('key_templates/civil_status', array('key' => $key, 'value' => $value), true);
				break;
			case 'address_1':
			case 'address_2':
				return $this->load->view('key_templates/address', array('key' => $key, 'value' => $value), true);
				break;
			case 'dialect':
			case 'interests_hobbies':
			case 'language':
				return $this->load->view('key_templates/textarea', array('key' => $key, 'value' => $value), true);
				break;
			case 'gender':
				$this->load->helper('form');
				return $this->load->view('key_templates/gender', array('key' => $key, 'value' => $value), true);
				break;
			case 'bday':
			case 'family-birthdate':
				$this->load->helper('form');
				return $this->load->view('key_templates/date_picker', array('key' => $key, 'value' => $value), true);
				break;
			case 'family-dependent-insurance':
			case 'family-dependent-hmo':
				$this->load->helper('form');
				return $this->load->view('key_templates/yes_no', array('key' => $key, 'value' => $value), true);
				break;
			case 'family-attachment':
				$this->load->helper('form');
				return $this->load->view('key_templates/attachment', array('key' => $key, 'value' => $value), true);
				break;				
			case 'family-relationship':
				$this->load->helper('form');
				return $this->load->view('key_templates/family_relationship', array('key' => $key, 'value' => $value), true);
				break;
			case 'religion':
				$this->load->helper('form');
				return $this->load->view('key_templates/religion', array('key' => $key, 'value' => $value), true);
				break;				
			default:
				return $this->load->view('key_templates/textfield', array('key' => $key, 'value' => $value), true);
				break;
		}
	}

	function has_active_request( $key_class_id, $user_id )
	{
		$this->db->join('partners_key', 'partners_key.key_id = partners_personal_request.key_id', 'left');
		$this->db->join('partners_key_class', 'partners_key_class.key_class_id = partners_key.key_class_id', 'left');
		$this->db->where('('.$this->db->dbprefix.'partners_personal_request.status = 1 OR '.$this->db->dbprefix.'partners_personal_request.status = 2)');
		$keys = $this->db->get_where('partners_personal_request', array('partners_personal_request.deleted' => 0, 'partners_key_class.key_class_id' => $key_class_id, 'user_id' => $user_id));
		if( $keys->num_rows() > 0 )
			return true;
		else
			return false;
	}

	function get_request_data( $key_class_id, $user_id )
	{
		$keys = array();
		$this->db->join('partners_key', 'partners_key.key_id = partners_personal_request.key_id', 'left');
		$this->db->join('partners_key_class', 'partners_key_class.key_class_id = partners_key.key_class_id', 'left');
		$this->db->where('('.$this->db->dbprefix.'partners_personal_request.status = 1 OR '.$this->db->dbprefix.'partners_personal_request.status = 2)');
		$keys = $this->db->get_where('partners_personal_request', array('partners_personal_request.deleted' => 0, 'partners_key_class.key_class_id' => $key_class_id, 'user_id' => $user_id))->row_array();
	
		return $keys;
	}

	function get_change_request_data( $key_class_id, $user_id )
	{
		$keys = array();
		$this->db->join('partners_key', 'partners_key.key_id = partners_personal_request.key_id', 'left');
		$this->db->join('partners_key_class', 'partners_key_class.key_class_id = partners_key.key_class_id', 'left');
		$this->db->where('('.$this->db->dbprefix.'partners_personal_request.status = 1 OR '.$this->db->dbprefix.'partners_personal_request.status = 2)');
		$keys = $this->db->get_where('partners_personal_request', array('partners_personal_request.deleted' => 0, 'partners_key_class.key_class_id' => $key_class_id, 'user_id' => $user_id))->result_array();
	
		return $keys;
	}

	function get_user_details($user_id=0){

		$this->db->select('*')
		->join('users','users.user_id = users_profile.user_id')
	    ->from('users_profile ')
	    ->where('users_profile.user_id', $user_id);

	    $user_details = $this->db->get('');	
		return $user_details->row_array();
	}

	function get_public_profile($user_id=0){

		$this->db->select('*')
	    ->from('users_profile_public')
	    ->where('user_id', $user_id);

	    $user_details = $this->db->get('');	
		return $user_details->row_array();
	}

    function get_taxcode($taxcode)
    {   
	   	if(empty($taxcode)){
	   		return false;
	   	}
        $this->db->select('taxcode_id, taxcode');
        $this->db->where('taxcode_id', $taxcode[0]['key_value']);
        $taxcode_result = $this->db->get('taxcode');

        if( $taxcode_result->num_rows() > 0 ) {
            return $taxcode_result->row_array();
        } else {
            return false;
        }

    }


}