<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partners_immediate extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('partners_immediate_model', 'mod');
		$this->load->model('partners_model', 'partner');
		parent::__construct();
		$this->lang->load( 'partners' );
	}


	public function get_list()
	{
		$this->_ajax_only();
		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
				);
			$this->_ajax_return();
		}

		$this->response->show_import_button = false;
		if( $this->input->post('page') == 1 )
		{
			$this->load->model('upload_utility_model', 'import');
			if( $this->import->get_templates( $this->mod->mod_id ) )
				$this->response->show_import_button = true;
		}

		$page = $this->input->post('page');
		$search = $this->input->post('search');
		$filter = "";
		$filter_by = $this->input->post('filter_by');
		$filter_value = $this->input->post('filter_value');

		if( is_array( $filter_by ) )
		{
			foreach( $filter_by as $filter_by_key => $filter_value )
			{
				if( $filter_value != "" ) {
					if($filter_by_key == "active"){
						$filter_by_key = "{$this->db->dbprefix}users.".$filter_by_key;
					}
					$filter = 'AND '. $filter_by_key .' = "'.$filter_value.'"';	
				}
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
				$filter = 'AND '. $filter_by .' = "'.$filter_value.'"';
			}
		}

		$trash = $this->input->post('trash') == 'true' ? true : false;

		if( $page == 1 )
		{
			$searches = $this->session->userdata('search');
			if( $searches ){
				foreach( $searches as $mod_code => $old_search )
				{
					if( $mod_code != $this->mod->mod_code )
					{
						$searches[$this->mod->mod_code] = "";
					}
				}
			}
			$searches[$this->mod->mod_code] = $search;
			$this->session->set_userdata('search', $searches);
		}
		
		$page = ($page-1) * 10; //echo $page;
		$records = $this->mod->_get_list($page, 10, $search, $filter, $trash);
		$this->response->records_retrieve = sizeof($records);
		$this->response->list = '';

        if( count($records) > 0 ){

			foreach( $records as $record )
			{
				$rec = array(
					'detail_url' => '#',
					'edit_url' => '#',
					'delete_url' => '#',
					'options' => ''
					);

				$this->_list_options( $record, $rec );
				$record = array_merge($record, $rec);

				$permission_list['permission'] = $this->permission;
				$record = array_merge($record, $permission_list);
				
				$record['users_profile_photo'] = file_exists(urldecode($record['users_profile_photo'])) ? $record['users_profile_photo'] : "assets/img/avatar.png";
	            $parts = pathinfo($record['users_profile_photo']);
	            $record['users_profile_photo'] = str_replace($parts['filename'], 'thumbnail/'.$parts['filename'], $record['users_profile_photo']);
				
				$this->response->list .= $this->load->blade('list_template_custom', $record, true);
			}
        }
        else{

            $this->response->list = "";

        }

		$this->_ajax_return();
	}
	

	function _list_options( $record, &$rec )
	{
		if ( $this->permission['detail'] ) {
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-search"></i> View</a></li>';
		}

		if (isset($this->permission['edit'])) {
			if( $this->permission['edit'] ) {
				$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
				$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
			}	
		}
		
		if (isset($this->permission['delete'])) {
			if( $this->permission['delete'] ) {
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['delete_url_javascript'] = "javascript: delete_record(".$record['record_id'].")";
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}
		}
	}

	function format_phone($phone){
		if(is_numeric($phone)){
			$phone = preg_replace("/[^0-9]/", "", $phone);

			if(strlen($phone) == 7)
				return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			elseif(strlen($phone) == 11)
				return preg_replace("/([0-9]{4})([0-9]{4})([0-9]{3})/", "$1-$2-$3", $phone);
			else
				return $phone;
		}else{
			return $phone;
		}
	}

	public function detail($record_id, $child_call = false){
		$user_id = $record_id; // change into this to fix with upgrade version. should the same with the parent class
		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
				);
			$this->_ajax_return();
		}

		$data['record']['record_id'] = $user_id;
		$this->load->model('profile_model', 'profile_mod');
		$profile_header_details = $this->profile_mod->get_profile_header_details($user_id);
		$middle_initial = empty($profile_header_details['middlename']) ? " " : " ".ucfirst(substr($profile_header_details['middlename'],0,1)).". ";
		$data['profile_name'] = $profile_header_details['firstname'].$middle_initial.$profile_header_details['lastname'].'&nbsp;'.$profile_header_details['suffix'];
		
		//employee benefit
		$employee_benefit = $this->partner->get_employee_benefit($user_id);
		$data['benefit_type'] = (count($employee_benefit) == 0 ? "n/a" :  $employee_benefit['benefit_type']);
		$data['benefit'] = (count($employee_benefit) == 0 ? "n/a" :  $employee_benefit['benefit']);

		// $department = empty($profile_header_details['department']) ? "" : " on ".ucwords(strtolower($profile_header_details['department']));
		$department = empty($profile_header_details['department']) ? "" : " on ".$profile_header_details['department'];
		// $data['profile_position'] = ucwords(strtolower($profile_header_details['position']));
		$data['profile_position'] = $profile_header_details['position'];
		$data['profile_company'] = $profile_header_details['company'];
		$data['profile_email'] = $profile_header_details['email'];
		$data['profile_birthdate'] = date("F d, Y", strtotime($profile_header_details['birth_date']));
		$birthday = new DateTime($profile_header_details['birth_date']);
		$data['profile_age'] = $birthday->diff(new DateTime)->y;
		$data['profile_photo'] = $profile_header_details['photo'] == "" ? "assets/img/avatar.png" : $profile_header_details['photo'];
		// $data['profile_photo'] = file_exists($profile_photo) ? $profile_header_details['photo'] : "assets/img/avatar.png";
		/***** EMPLOYMENT TAB *****/
		//Company Information
		$data['location'] = $profile_header_details['location'] == "" ? "n/a" : $profile_header_details['location'];
		$data['position'] = $profile_header_details['position'] == "" ? "n/a" : $profile_header_details['position'];
		$data['permission'] = $profile_header_details['role'] == "" ? "n/a" : $profile_header_details['role'];
		$data['id_number'] = $profile_header_details['id_number'] == "" ? "n/a" : $profile_header_details['id_number'];
		$data['biometric'] = $profile_header_details['biometric'] == "" ? "n/a" : $profile_header_details['biometric'];
		$data['shift'] = $profile_header_details['shift'] == "" ? "n/a" : $profile_header_details['shift'];
		$data['calendar'] = $profile_header_details['calendar'] == "" ? "n/a" : $profile_header_details['calendar'];
		//Employment Information
		$data['status'] = $profile_header_details['employment_status'] == "" ? "n/a" : $profile_header_details['employment_status'];
		$data['type'] = $profile_header_details['employment_type'] == "" ? "n/a" : $profile_header_details['employment_type'];
		$data['job_level'] = $profile_header_details['job_level'] == "" ? "n/a" : $profile_header_details['job_level'];
		$data['classification'] = $profile_header_details['classification'] == "" ? "n/a" : $profile_header_details['classification'];		
		$data['date_hired'] = valid_date($profile_header_details['effectivity_date']);
		$data['regularization_date'] = valid_date($profile_header_details['regularization_date']);
		$probationary_date = $this->profile_mod->get_partners_personal($user_id, 'probationary_date');
		$data['probationary_date'] = (count($probationary_date) == 0 ? "n/a" : ($probationary_date[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($probationary_date[0]['key_value']))));
		$original_date_hired = $this->profile_mod->get_partners_personal($user_id, 'original_date_hired');
		$data['original_date_hired'] = (count($original_date_hired) == 0 ? "n/a" : ($original_date_hired[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($original_date_hired[0]['key_value']))));
		$last_probationary = $this->profile_mod->get_partners_personal($user_id, 'last_probationary');
		$data['last_probationary'] = (count($last_probationary) == 0 ? "n/a" : ($last_probationary[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_probationary[0]['key_value']))));
		$last_salary_adjustment = $this->profile_mod->get_partners_personal($user_id, 'last_salary_adjustment');
		$data['last_salary_adjustment'] = (count($last_salary_adjustment) == 0 ? "n/a" : ($last_salary_adjustment[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_salary_adjustment[0]['key_value']))));
		$data['last_promotion_date'] = valid_date($profile_header_details['last_promotion_date']);
		$data['old_new'] = ($profile_header_details['old_new'] == 0 ? "Old" : "New");
		//Work Assignment
		$reports_to = $profile_header_details['immediate'] == "" ? "n/a" : $this->profile_mod->get_user_details($profile_header_details['immediate']);
		if($reports_to == "n/a"){
			$data['reports_to'] = $reports_to;
		}
		else{
			if(count($reports_to) > 0 && $reports_to['active'] == 1){
				$reports_to_MI = empty($reports_to['middlename']) ? " " : " ".ucfirst(substr($reports_to['middlename'],0,1)).". ";
				$data['reports_to'] = $reports_to['firstname'].$reports_to_MI.$reports_to['lastname'];
			}else{
				$data['reports_to'] = "n/a";
			}
		}
		$organization = $this->profile_mod->get_partners_personal($user_id, 'organization');
		$data['organization'] = (count($organization) == 0 ? "n/a" : ($organization[0]['key_value'] == "" ? "n/a" : $organization[0]['key_value']));
        $agency_assignment = $this->profile_mod->get_partners_personal($user_id, 'agency_assignment');
        $data['agency_assignment'] = (count($agency_assignment) == 0 ? "n/a" : ($agency_assignment[0]['key_value'] == "" ? "n/a" : $agency_assignment[0]['key_value']));
        $section = $this->profile_mod->get_partners_personal($user_id, 'section');
        $data['section'] = (count($section) == 0 ? "n/a" : ($section[0]['key_value'] == "" ? "n/a" : $section[0]['key_value']));
        $data['project'] = ($profile_header_details['project'] == "" ? "n/a" : $profile_header_details['project']);
        $data['project_id'] = ($profile_header_details['project_id'] == "" ? "n/a" : $profile_header_details['project_id']);
        $data['project_hr'] = ($profile_header_details['project_hr'] == "" ? "n/a" : $profile_header_details['project_hr']);
        $data['coordinator'] = ($profile_header_details['coordinator'] == "" ? "n/a" : $profile_header_details['coordinator']);
        $data['credit_setup'] = ($profile_header_details['credit_setup'] == "" ? "n/a" : $profile_header_details['credit_setup']);
        $data['start_date'] = valid_date($profile_header_details['start_date']);
        $data['end_date'] = valid_date($profile_header_details['end_date']);           
		$data['division'] = $profile_header_details['division'] == "" ? "n/a" : $profile_header_details['division']. ' ('.get_division_code($profile_header_details['division_code'],'-').')';
		$data['department'] = $profile_header_details['department'] == "" ? "n/a" : $profile_header_details['department'];
		$data['group'] = $profile_header_details['group'] == "" ? "n/a" : $profile_header_details['group'];
        $data['cost_center_code'] = ($profile_header_details['cost_center_code'] == "" ? "n/a" : $profile_header_details['cost_center_code']);
        $data['sbu_unit'] = ($profile_header_details['sbu_unit'] == "" ? "n/a" : $profile_header_details['sbu_unit']);
        $data['sbu_unit_id'] = ($profile_header_details['sbu_unit_id'] == "" ? "n/a" : $profile_header_details['sbu_unit_id']);
        $data['sbu_unit_details'] = ($profile_header_details['sbu_unit_details'] == "" ? "n/a" : $profile_header_details['sbu_unit_details']);
		/***** CONTACTS TAB *****/
		//Personal Contact
		$address_1 = $this->profile_mod->get_partners_personal($user_id, 'address_1');
		$address_1 = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
		
		$address_2 = $this->profile_mod->get_partners_personal($user_id, 'address_2');
		$address_2 = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
		$city_town = $this->profile_mod->get_partners_personal($user_id, 'city_town');
		$city_town = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $this->profile_mod->get_city($city_town[0]['key_value'])));
		$data['complete_address'] = $address_1." ".$address_2;		
		$zip_code = $this->profile_mod->get_partners_personal($user_id, 'zip_code');
		$data['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));

		$country = $this->profile_mod->get_partners_personal($user_id, 'country');
		$data['country'] = (count($country) > 0 ? $this->profile_mod->get_country($country[0]['key_value']) : " ");		
		$permanent_address = $this->profile_mod->get_partners_personal($user_id, 'permanent_address');
		$data['permanent_address'] = $permanent_address = (count($permanent_address) == 0 ? " " : ($permanent_address[0]['key_value'] == "" ? "" : $permanent_address[0]['key_value']));
		$permanent_city_town = $this->profile_mod->get_partners_personal($user_id, 'permanent_city_town');
		$data['permanent_city_town'] = $permanent_city_town = (count($permanent_city_town) == 0 ? " " : ($permanent_city_town[0]['key_value'] == "" ? "" : $this->profile_mod->get_city($permanent_city_town[0]['key_value'])));
		$permanent_country = $this->profile_mod->get_partners_personal($user_id, 'permanent_country');
		$data['permanent_country'] = $permanent_country = (count($permanent_country) == 0 ? " " : ($permanent_country[0]['key_value'] == "" ? "" : $this->profile_mod->get_country($permanent_country[0]['key_value'])));			
		$permanent_zipcode = $this->profile_mod->get_partners_personal($user_id, 'permanent_zipcode');
		$data['permanent_zipcode'] = $permanent_zipcode = (count($permanent_zipcode) == 0 ? " " : ($permanent_zipcode[0]['key_value'] == "" ? "" : $permanent_zipcode[0]['key_value']));						
		$phone_numbers = $this->profile_mod->get_partners_personal($user_id, 'phone');
		$data['office_telephones'] = $phone_numbers = (count($phone_numbers) == 0 ? " " : ($phone_numbers[0]['key_value'] == "" ? "" : $phone_numbers[0]['key_value']));
		$mobile_numbers = $this->profile_mod->get_partners_personal($user_id, 'mobile');
		$data['office_mobiles'] = $mobile_numbers = (count($mobile_numbers) == 0 ? " " : ($mobile_numbers[0]['key_value'] == "" ? "" : $mobile_numbers[0]['key_value']));
		$personal_phone_numbers = $this->profile_mod->get_partners_personal($user_id, 'personal_phone');
		$data['personal_telephone'] = $personal_phone_numbers = (count($personal_phone_numbers) == 0 ? " " : ($personal_phone_numbers[0]['key_value'] == "" ? "" : $personal_phone_numbers[0]['key_value']));
		$personal_mobile_numbers = $this->profile_mod->get_partners_personal($user_id, 'personal_mobile');
		$data['personal_mobile'] = $personal_mobile_numbers = (count($personal_mobile_numbers) == 0 ? " " : ($personal_mobile_numbers[0]['key_value'] == "" ? "" : $personal_mobile_numbers[0]['key_value']));
		$personal_email = $this->profile_mod->get_partners_personal($user_id, 'personal_email');
		$data['personal_email'] = $personal_email = (count($personal_email) == 0 ? " " : ($personal_email[0]['key_value'] == "" ? "" : $personal_email[0]['key_value']));		

		//Emergency Contact
		$emergency_name = $this->profile_mod->get_partners_personal($user_id, 'emergency_name');
		$data['emergency_name'] = (count($emergency_name) == 0 ? " " : ($emergency_name[0]['key_value'] == "" ? "" : $emergency_name[0]['key_value']));
		$emergency_relationship = $this->profile_mod->get_partners_personal($user_id, 'emergency_relationship');
		$data['emergency_relationship'] = (count($emergency_relationship) == 0 ? " " : ($emergency_relationship[0]['key_value'] == "" ? "" : $emergency_relationship[0]['key_value']));
		$emergency_phone = $this->profile_mod->get_partners_personal($user_id, 'emergency_phone');
		$data['emergency_phone'] = (count($emergency_phone) == 0 ? "n/a" : ($emergency_phone[0]['key_value'] == "" ? "n/a" : $this->format_phone($emergency_phone[0]['key_value'])));
		$emergency_mobile = $this->profile_mod->get_partners_personal($user_id, 'emergency_mobile');
		$data['emergency_mobile'] = (count($emergency_mobile) == 0 ? "n/a" : ($emergency_mobile[0]['key_value'] == "" ? "n/a" : $this->format_phone($emergency_mobile[0]['key_value'])));
		$emergency_address = $this->profile_mod->get_partners_personal($user_id, 'emergency_address');
		$data['emergency_address'] = (count($emergency_address) == 0 ? " " : ($emergency_address[0]['key_value'] == "" ? "" : $emergency_address[0]['key_value']));
		$emergency_city = $this->profile_mod->get_partners_personal($user_id, 'emergency_city');
		$data['emergency_city'] = (count($emergency_city) > 0 ? $this->profile_mod->get_city($emergency_city[0]['key_value']) : " ");
		$emergency_country = $this->profile_mod->get_partners_personal($user_id, 'emergency_country');
		$data['emergency_country'] = (count($emergency_country) > 0 ? $this->profile_mod->get_country($emergency_country[0]['key_value']) : " ");
		$emergency_zip_code = $this->profile_mod->get_partners_personal($user_id, 'emergency_zip_code');
		$data['emergency_zip_code'] = (count($emergency_zip_code) == 0 ? " " : ($emergency_zip_code[0]['key_value'] == "" ? "" : $emergency_zip_code[0]['key_value']));

		/***** PERSONAL TAB *****/
		//Personal
		$gender = $this->profile_mod->get_partners_personal($user_id, 'gender');
		$data['gender'] = (count($gender) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $gender[0]['key_value']));
		$birth_place = $this->profile_mod->get_partners_personal($user_id, 'birth_place');
		$data['birth_place'] = (count($birth_place) == 0 ? " " : ($birth_place[0]['key_value'] == "" ? "" : $birth_place[0]['key_value']));
		$religion = $this->profile_mod->get_partners_personal($user_id, 'religion');
		$data['religion'] = (count($religion) == 0 ? " " : ($religion[0]['key_value'] == "" ? "" : $this->profile_mod->get_religion($religion[0]['key_value'])));
		$nationality = $this->profile_mod->get_partners_personal($user_id, 'nationality');
		$data['nationality'] = (count($nationality) == 0 ? " " : ($nationality[0]['key_value'] == "" ? "" : $nationality[0]['key_value']));
		$marriage_date = $this->profile_mod->get_partners_personal($user_id, 'marriage_date');
		$data['marriage_date'] = (count($marriage_date) > 0 ? $marriage_date[0]['key_value'] : " ");		
		//Other Information
		$height = $this->profile_mod->get_partners_personal($user_id, 'height');
		$data['height'] = (count($height) == 0 ? " " : ($height[0]['key_value'] == "" ? "" : $height[0]['key_value']));
		$weight = $this->profile_mod->get_partners_personal($user_id, 'weight');
		$data['weight'] = (count($weight) == 0 ? " " : ($weight[0]['key_value'] == "" ? "" : $weight[0]['key_value']));
		$blood_type = $this->profile_mod->get_partners_personal($user_id, 'blood_type');
		$data['blood_type'] = (count($blood_type) > 0 ? $blood_type[0]['key_value'] : " ");			
		$interests_hobbies = $this->profile_mod->get_partners_personal($user_id, 'interests_hobbies');
		$data['interests_hobbies'] = (count($interests_hobbies) == 0 ? " " : ($interests_hobbies[0]['key_value'] == "" ? "" : $interests_hobbies[0]['key_value']));
		$language = $this->profile_mod->get_partners_personal($user_id, 'language');
		$data['language'] = (count($language) == 0 ? " " : ($language[0]['key_value'] == "" ? "" : $language[0]['key_value']));
		$dialect = $this->profile_mod->get_partners_personal($user_id, 'dialect');
		$data['dialect'] = (count($dialect) == 0 ? " " : ($dialect[0]['key_value'] == "" ? "" : $dialect[0]['key_value']));

		$dependents_result = $this->profile_mod->get_partners_personal_history($user_id, 'family');

		$number_children = 0;
		$dependents_count = 0;
		foreach ($dependents_result as $key => $value) {
			if ($value['key'] == 'family-relationship') {
				$dependents_count++;

				if ($value['key_value'] == 'Son' || $value['key_value'] == 'Daughter')
					$number_children++;
			}
		}

		$data['dependents_count'] = ($dependents_count == 0 ? '' : $dependents_count);
		$data['number_children'] = ($number_children == 0 ? '' : $number_children);

        // Employment Information
		$drivers_license_no = $this->profile_mod->get_partners_personal($user_id, 'drivers_license_no');
		$data['record']['drivers_license_no'] = get_valid_key_value($drivers_license_no);
		$passport_no = $this->profile_mod->get_partners_personal($user_id, 'passport_no');
		$data['record']['passport_no'] = get_valid_key_value($passport_no);        
        $taxcode = $this->profile_mod->get_partners_personal($user_id, 'taxcode');
        $taxcode_result =  $this->profile_mod->get_taxcode($taxcode);
        $data['record']['taxcode'] = ($taxcode_result == "" ? " " : ($taxcode_result['taxcode'] == "" ? "" : $taxcode_result['taxcode']));
		$tin_number = $this->profile_mod->get_partners_personal($user_id, 'tin_number');
		$data['record']['tin_number'] = (count($tin_number) > 0 ? $tin_number[0]['key_value'] : " ");
		$sss_number = $this->profile_mod->get_partners_personal($user_id, 'sss_number');
		$data['record']['sss_number'] = (count($sss_number) > 0 ? $sss_number[0]['key_value'] : " ");
		$pagibig_number = $this->profile_mod->get_partners_personal($user_id, 'pagibig_number');
		$data['record']['pagibig_number'] = (count($pagibig_number) > 0 ? $pagibig_number[0]['key_value'] : " ");
		$philhealth_number = $this->profile_mod->get_partners_personal($user_id, 'philhealth_number');
		$data['record']['philhealth_number'] = (count($philhealth_number) > 0 ? $philhealth_number[0]['key_value'] : " ");
		$bank_number_savings = $this->profile_mod->get_partners_personal($user_id, 'bank_account_number_savings');
		$data['record']['bank_number_savings'] = (count($bank_number_savings) > 0 ? $bank_number_savings[0]['key_value'] : " ");
		$bank_number_current = $this->profile_mod->get_partners_personal($user_id, 'bank_account_number_current');
		$data['record']['bank_number_current'] = (count($bank_number_current) > 0 ? $bank_number_current[0]['key_value'] : " ");
		$payroll_bank_account_number = $this->profile_mod->get_partners_personal($user_id, 'payroll_bank_account_number');
		$data['record']['payroll_bank_account_number'] = (count($payroll_bank_account_number) == 0 ? " " : ($payroll_bank_account_number[0]['key_value'] == "" ? "" : $payroll_bank_account_number[0]['key_value']));
		$payroll_bank_name = $this->profile_mod->get_partners_personal($user_id, 'payroll_bank_name');
		$data['record']['payroll_bank_name'] = (count($payroll_bank_name) == 0 ? " " : ($payroll_bank_name[0]['key_value'] == "" ? "" : $payroll_bank_name[0]['key_value']));									
		$bank_account_name = $this->profile_mod->get_partners_personal($user_id, 'bank_account_name');
		$data['record']['bank_account_name'] = (count($bank_account_name) > 0 ? $bank_account_name[0]['key_value'] : " ");
		$health_care = $this->profile_mod->get_partners_personal($user_id, 'health_care');
		$data['record']['health_care'] = (count($health_care) > 0 ? $health_care[0]['key_value'] : " ");        
        $job_class = $this->profile_mod->get_partners_personal($user_id, 'job_class');
        $data['record']['job_class'] = (count($job_class) == 0 ? " " : ($job_class[0]['key_value'] == "" ? "" : $job_class[0]['key_value']));
        $job_rank_level = $this->profile_mod->get_partners_personal($user_id, 'job_rank_level');
        $data['record']['job_rank_level'] = (count($job_rank_level) == 0 ? " " : ($job_rank_level[0]['key_value'] == "" ? "" : $job_rank_level[0]['key_value']));
        $job_level = $this->profile_mod->get_partners_personal($user_id, 'job_level');
        $data['record']['job_level'] = (count($job_level) == 0 ? " " : ($job_level[0]['key_value'] == "" ? "" : $job_level[0]['key_value']));
        $pay_level = $this->profile_mod->get_partners_personal($user_id, 'pay_level');
        $data['record']['pay_level'] = (count($pay_level) == 0 ? " " : ($pay_level[0]['key_value'] == "" ? "" : $pay_level[0]['key_value']));
        $pay_set_rates = $this->profile_mod->get_partners_personal($user_id, 'pay_set_rates');
        $data['record']['pay_set_rates'] = (count($pay_set_rates) == 0 ? " " : ($pay_set_rates[0]['key_value'] == "" ? "" : $pay_set_rates[0]['key_value']));
        $competency_level = $this->profile_mod->get_partners_personal($user_id, 'competency_level');
        $data['record']['competency_level'] = (count($competency_level) == 0 ? " " : ($competency_level[0]['key_value'] == "" ? "" : $competency_level[0]['key_value']));
        // debug($data); die;
		/***** Header Details *****/
		$data['profile_live_in'] = $city_town;
		$countries = $this->profile_mod->get_partners_personal($user_id, 'country');
		$data['profile_country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $this->profile_mod->get_country($countries[0]['key_value'])));
		$telephones = array();
		$phone_numbers = $this->profile_mod->get_partners_personal($user_id, 'phone');
		foreach($phone_numbers as $phone){
			$telephones[] = $this->format_phone($phone['key_value']);
		}
		$data['profile_telephones'] = $telephones;
		$fax = array();
		$fax_numbers = $this->profile_mod->get_partners_personal($user_id, 'fax');
		foreach($fax_numbers as $fax_no){
			$fax[] = $this->format_phone($fax_no['key_value']);
		}
		$data['profile_fax'] = $fax;
		$mobiles = array();
		$mobile_numbers = $this->profile_mod->get_partners_personal($user_id, 'mobile');
		foreach($mobile_numbers as $mobile){
			$mobiles[] = $this->format_phone($mobile['key_value']);
		}
		$data['profile_mobiles'] = $mobiles;
		$civil_status = $this->profile_mod->get_partners_personal($user_id, 'civil_status');
		$data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));

		$family_tab = $this->profile_mod->get_partners_personal_history($user_id, 'family');
		
		$spouse_name = '';
		if (!empty($family_tab)) {
			foreach($family_tab as $emp){
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}

			foreach ($families_tab as $key => $value) {
				if ($value['family-relationship'] == 'Spouse')
					$spouse_name = $value['family-name'];
			}
		}

		$data['profile_spouse'] = $spouse_name;

		$solo_parent = $this->profile_mod->get_partners_personal($user_id, 'solo_parent');
		$data['personal_solo_parent'] = (count($solo_parent) == 0 ? " " : ($solo_parent[0]['key_value'] == 0 ? "No" : "Yes"));
		/***** HISTORY TAB *****/
		//Education
		$education_tab = array();
		$educational_tab = array();
		$education_tab = $this->profile_mod->get_partners_personal_history($user_id, 'education');
		foreach($education_tab as $educ){
			if ($educ['key'] == 'education-school') {
				$educational_tab[$educ['sequence']][$educ['key']] = $this->profile_mod->get_school($educ['key_value']);
			} elseif ($educ['key'] == 'education-degree') {
				$educational_tab[$educ['sequence']][$educ['key']] = $this->profile_mod->get_degree_obtained($educ['key_value']);
			} else
				$educational_tab[$educ['sequence']][$educ['key']] = $educ['key_value'];
		}		
		$data['education_tab'] = $educational_tab;
		//Employment
		$employment_tab = array();
		$employments_tab = array();
		$employment_tab = $this->profile_mod->get_partners_personal_history($user_id, 'employment');
		foreach($employment_tab as $emp){
			$employments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['employment_tab'] = $employments_tab;
		//Character Reference
		$reference_tab = array();
		$references_tab = array();
		$reference_tab = $this->profile_mod->get_partners_personal_history($user_id, 'reference');
		foreach($reference_tab as $emp){
			if ($emp['key'] == 'reference-city') {
				$references_tab[$emp['sequence']][$emp['key']] = $this->profile_mod->get_city($emp['key_value']);
			}
			elseif ($emp['key'] == 'reference-country') {
				$references_tab[$emp['sequence']][$emp['key']] = $this->profile_mod->get_country($emp['key_value']);
			}
			else
				$references_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['reference_tab'] = $references_tab;
		//Licensure
		$licensure_tab = array();
		$licensures_tab = array();
		$details_data_id = array();
		$licensure_tab = $this->profile_mod->get_partners_personal_history($user_id, 'licensure');
		foreach($licensure_tab as $emp){
			$licensures_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			$details_data_id[$emp['sequence']][$emp['key']] = $emp['personal_id'];
		}
		$data['licensure_tab'] = $licensures_tab;
		$data['details_data_id'] = $details_data_id;
		//Trainings and Seminars
		$training_tab = array();
		$trainings_tab = array();
		$training_tab = $this->profile_mod->get_partners_personal_history($user_id, 'training');
		foreach($training_tab as $emp){
			$trainings_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['training_tab'] = $trainings_tab;
		//Test Profile
		$test_profile_tab = array();
		$test_profiles_tab = array();
		$test_profile_tab = $this->profile_mod->get_partners_personal_history($user_id, 'test');
		foreach($test_profile_tab as $emp){
			$test_profiles_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['test_profile_tab'] = $test_profiles_tab;			
		//Cost Center
		$cost_center_tab = array();
		$cost_centers_tab = array();
		$cost_center_tab = $this->profile_mod->get_partners_personal_history($user_id, 'cost_center');

		if(!empty($cost_center_tab)){

			foreach($cost_center_tab as $emp){
				
				$cost_centers_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
		}
		else{

			$this->db->select('project_id,project_code');
            $this->db->where('project_id', $data['project_id']);
            $this->db->where('deleted', '0');
            $project = $this->db->get('users_project')->result_array();

			if(!empty($project)){

				$cost_centers_tab[1]['cost_center-cost_center'] = $project[0]['project_id'];
				$cost_centers_tab[1]['cost_center-code'] = $project[0]['project_code'];
			}
			else{

				$cost_centers_tab[1]['cost_center-cost_center'] = '';
				$cost_centers_tab[1]['cost_center-code'] = '';
			}

			$cost_centers_tab[1]['cost_center-percentage'] = '';
		}

		$data['cost_center_tab'] = $cost_centers_tab;			
		//Skills
		$skill_tab = array();
		$skills_tab = array();
		$skill_tab = $this->profile_mod->get_partners_personal_history($user_id, 'skill');
		foreach($skill_tab as $emp){
			$skills_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['skill_tab'] = $skills_tab;
		//medical records
		$medical_tab = array();
		$medicals_tab = array();
		$medical_tab = $this->profile_mod->get_partners_personal_history($user_id, 'medical');
		foreach($medical_tab as $emp){
			if ($emp['key'] == 'medical-exam-type') {
				$medicals_tab[$emp['sequence']][$emp['key']] = $this->profile_mod->get_medical_exam_type($emp['key_value']);
			} else
				$medicals_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['medical_tab'] = $medicals_tab;			
		//Affiliation
		$affiliation_tab = array();
		$affiliations_tab = array();
		$affiliation_tab = $this->profile_mod->get_partners_personal_history($user_id, 'affiliation');
		foreach($affiliation_tab as $emp){
			$affiliations_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['affiliation_tab'] = $affiliations_tab;
		//Accountabilities
		$accountabilities_tab = array();
		$accountable_tab = array();
		$accountabilities_tab = $this->profile_mod->get_partners_personal_history($user_id, 'accountabilities');
		foreach($accountabilities_tab as $emp){
			$accountable_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['accountabilities_tab'] = $accountable_tab;
		//Attachments
		$attachment_tab = array();
		$attachments_tab = array();
		$attachment_tab = $this->profile_mod->get_partners_personal_history($user_id, 'attachment');
		foreach($attachment_tab as $emp){
			$attachments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['attachment_tab'] = $attachments_tab;
		//Family
		$family_tab = array();
		$families_tab = array();
		$family_tab = $this->profile_mod->get_partners_personal_history($user_id, 'family');

		foreach($family_tab as $emp){
			if($emp['key'] == 'family-dependent'){
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'] == 0 ? "No" : "Yes";
			}elseif($emp['key'] == 'family-dependent-hmo'){
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'] == 0 ? "No" : "Yes";
			}elseif($emp['key'] == 'family-dependent-insurance'){
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'] == 0 ? "No" : "Yes";				
			}else{
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}			
		}

		$data['family_tab'] = $families_tab;

		//Movements
		$movements_tab = array();
		$movement_qry = " SELECT  pma.action_id, pma.movement_id, pma.type_id,
							pma.effectivity_date, pma.type, pmc.cause, pma.created_on, pm.remarks
						FROM {$this->db->dbprefix}partners_movement_action pma
						INNER JOIN {$this->db->dbprefix}partners_movement pm 
							ON pma.movement_id = pm.movement_id
						INNER JOIN {$this->db->dbprefix}partners_movement_cause pmc 
							ON pm.due_to_id = pmc.cause_id 
						WHERE pm.status_id = 8 
						AND pma.user_id = {$user_id}";
		$movement_sql = $this->db->query($movement_qry);

		if($movement_sql->num_rows() > 0){
			$movements_tab = $movement_sql->result_array();
		}
		$data['movement_tab'] = $movements_tab;

		$da_tab = array();
		$da_qry = " SELECT  offense,offense_level,sanction,pda.created_on
						FROM {$this->db->dbprefix}partners_disciplinary_action pda
						LEFT JOIN {$this->db->dbprefix}partners_incident pi 
							ON pda.incident_id = pi.incident_id	
						LEFT JOIN {$this->db->dbprefix}partners_offense po 
							ON pi.offense_id = po.offense_id													
						LEFT JOIN {$this->db->dbprefix}partners_offense_sanction pos 
							ON pda.sanction_id = pos.sanction_id
						LEFT JOIN {$this->db->dbprefix}partners_offense_level pol 
							ON pos.offense_level_id = pol.offense_level_id 
						WHERE pi.involved_partners IN ({$user_id})";
		$da_sql = $this->db->query($da_qry);

		if($da_sql->num_rows() > 0){
			$da_tab = $da_sql->result_array();
		}
		$data['da_tab'] = $da_tab;

		$cr_tab = array();
		$cr_qry = " SELECT  key_class,ppr.from_key_value,ppr.key_value,ppr.created_on
						FROM {$this->db->dbprefix}partners_personal_request ppr
						LEFT JOIN {$this->db->dbprefix}partners_key pk 
							ON ppr.key_id = pk.key_id	
						LEFT JOIN {$this->db->dbprefix}partners_key_class pkc 
							ON pk.key_class_id = pkc.key_class_id
						WHERE ppr.user_id = {$user_id}";
		$cr_sql = $this->db->query($cr_qry);

		if($cr_sql->num_rows() > 0){
			$cr_tab = $cr_sql->result_array();
		}
		$data['cr_tab'] = $cr_tab;
		
        $key_sql = "SELECT * FROM {$this->db->dbprefix}partners_key pk 
                    LEFT JOIN {$this->db->dbprefix}partners_key_class pkc 
                    ON pk.key_class_id = pkc.key_class_id 
                    WHERE pk.deleted = 0 AND pkc.user_view = 1 ";
        $key_qry = $this->db->query($key_sql);

        $partners_keys = $key_qry->result_array();
        foreach($partners_keys as $keys){
            $data['partners_keys'][] = $keys['key_code'];
            $data['partners_labels'][$keys['key_code']] = $keys['key_label'];
        }

		$this->load->helper('file');
		$this->load->vars($data);
		echo $this->load->blade('edit.detail_custom')->with( $this->load->get_cached_vars() );
	}

	function get_sbu_unit_percentage()
	{
		$this->_ajax_only();
        $sbu_unit_ids = $this->input->post('sbu_unit_ids');
        $total_percentage = $this->partner->get_sum_sbu_percentage($sbu_unit_ids);

        $this->response->total_perentage = $total_percentage .'%';
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

	    $this->_ajax_return();
	}

	function view_personal_details(){
		$this->_ajax_only();

		//Attachments
		$details = array();
		$details_data = array();
		$details_data_id = array();
		
		$this->load->model('profile_model', 'profile_mod');
		$details = $this->profile_mod->get_partners_personal_list_details($this->input->post('record_id'), $this->input->post('key_class'), $this->input->post('sequence'));
		foreach($details as $detail){
			$details_data[$detail['key']] = $detail['key_value'];
			$details_data_id[$detail['key']] = $detail['personal_id'];
		}
		$data['details'] = $details_data;
		$data['details_data_id'] = $details_data_id;
		$data['sequence'] = $this->input->post('sequence');

		$this->load->helper('file');
        // $view['title'] = $data['forms_title'];
        // $view['content'] = $this->load->view('edit/edit_'.$this->input->post('form_code').'_form', $data, true);
		$this->response->view_details = $this->load->view('edit/'.$this->input->post('modal_form'), $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

	function get_action_movement_details(){
		$this->_ajax_only();

		$this->load->model('movement_manage_model', 'mvm');
		$this->load->model('movement_model', 'move_mod');
		$this->load->model('movement_admin_model', 'mod_admin');

		$movement_id = $this->input->post("movement_id");
		$this->response->action_id = $action_id = $this->input->post("action_id");
		$this->response->type_id = $type_id = $this->input->post("type_id");
		$data['cause'] = $this->input->post("cause");

		$action_details = $this->move_mod->get_action_movement($action_id);
		$data['count'] = 0;
		
		$action_movement_attachment = $this->mod_admin->get_action_movement_attachment($action_id);

		$data['movement_approver_remarks'] = $this->mvm->get_approver_remarks($movement_id);
		$data['movement_info'] = $this->move_mod->get_movement_details($movement_id);

		/*debug($data['movement_info']);die();*/

		$data['movement_file'] = '';
		if($action_id > 0){
			$data['record']['attachement'] = $action_movement_attachment;
			$data['type'] = $action_details['type'];
			$data['type_id'] = $action_details['type_id'];
			$data['photo'] = $action_details['photo'];
			$data['record']['partners_movement_action.action_id'] = $action_details['action_id'];//user
			$data['record']['partners_movement_action.type_id'] = $action_details['type_id'];//user
			$data['record']['partners_movement_action.user_id'] = $action_details['user_id'];//user
			$data['record']['partners_movement_action.effectivity_date'] = date("F d, Y", strtotime($action_details['effectivity_date']));//effectivity_date
			$data['record']['partners_movement_action.remarks'] = $action_details['remarks'];//action_remarks
			switch($type_id){
				case 1://Regularization
				case 3://Promotion
				case 8://Transfer
				case 9://Employment Status
				case 12://Temporary Assignment
				$end_date = $this->move_mod->get_transfer_movement($action_id, 11);
				$data['end_date'] = (count($end_date) > 0) ? $end_date[0]['to_name'] : '' ;

				$data['transfer_fields'] = $this->move_mod->getTransferFields();
				$data['partner_info'] = $this->move_mod->get_employee_details($action_details['user_id']);
				foreach($data['transfer_fields'] as $index => $field){
					$movement_type_details = $this->move_mod->get_transfer_movement($action_id, $field['field_id']);
					if(count($movement_type_details) > 0){
						$data['transfer_fields'][$index]['from_id'] = $movement_type_details[0]['from_id'];
						$data['transfer_fields'][$index]['to_id'] = $movement_type_details[0]['to_id'];
						$data['transfer_fields'][$index]['from_name'] = $movement_type_details[0]['from_name'];
						$data['transfer_fields'][$index]['to_name'] = $movement_type_details[0]['to_name'];
					}else{
						if ($field['field_id'] == 13) {
							$data['transfer_fields'][$index]['from_id'] = (isset($data['partner_info'][0]['job_grade_id']) ? $data['partner_info'][0]['job_grade_id'] : '');
						}
						else {
							$data['transfer_fields'][$index]['from_id'] = (isset($data['partner_info'][0][$field['field_name'].'_id']) ? $data['partner_info'][0][$field['field_name'].'_id'] : '');
						}
						$data['transfer_fields'][$index]['from_name'] = (isset($data['partner_info'][0][$field['field_name']]) ? $data['partner_info'][0][$field['field_name']] : '');
						$data['transfer_fields'][$index]['to_id'] = '';
						$data['transfer_fields'][$index]['to_name'] = '';
					}
				}
					$data['movement_file'] = 'transfer.blade.php';
				break;
				case 2://Salary Increase
				case 18://Salary Increase
				$movement_type_details = $this->move_mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = $movement_type_details['current_salary'];//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = $movement_type_details['to_salary'];//to_salary
					$data['movement_file'] = 'compensation.blade.php';
				break;
				case 4://Wage Order
				$movement_type_details = $this->move_mod->get_compensation_movement($action_id);
					$data['record']['partners_movement_action_compensation.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_compensation.current_salary'] = $movement_type_details['current_salary'];//current_salary
					$data['record']['partners_movement_action_compensation.to_salary'] = $movement_type_details['to_salary'];//to_salary
					$data['movement_file'] = 'wage.blade.php';
				break;
				case 6://Resignation
				case 7://Termination
				$movement_type_details = $this->move_mod->get_moving_movement($action_id);
					$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
					$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
					$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
					$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					$data['movement_file'] = 'endservice.blade.php';
				break;
				case 10://End Contract
				case 11://Retirement
				$movement_type_details = $this->move_mod->get_moving_movement($action_id);
					$data['record']['partners_movement_action_moving.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_moving.blacklisted'] = $movement_type_details['blacklisted'];//blacklisted
					$data['record']['partners_movement_action_moving.eligible_for_rehire'] = $movement_type_details['eligible_for_rehire'];//blacklisted
					$data['record']['partners_movement_action_moving.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					// $data['record']['partners_movement_action_moving.reason_id'] = $movement_type_details['reason_id'];//reason_id
					$data['record']['partners_movement_action_moving.further_reason'] = $movement_type_details['further_reason'];//further_reason
					$data['movement_file'] = 'retire_endo.blade.php';
				break;
				case 15://Extension
				$movement_type_details = $this->move_mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['movement_file'] = 'extension.blade.php';
				break;
				case 17://Develop
				$movement_type_details = $this->move_mod->get_extension_movement($action_id);
					$data['record']['partners_movement_action_extension.id'] = $movement_type_details['id'];//id
					$data['record']['partners_movement_action_extension.no_of_months'] = $movement_type_details['no_of_months'];//no_of_months
					$data['record']['partners_movement_action_extension.end_date'] = date("F d, Y", strtotime($movement_type_details['end_date']));//end_date
					$data['record']['partners_movement_action.grade'] = $action_details['grade'];
					$data['movement_file'] = 'extension.blade.php';
				break;
			}
		}
		
		$data['user_id'] = $this->user->user_id;

		$this->response->count = ++$data['count'];
		$this->load->helper('file');
		$this->load->helper('form');
		
		$this->response->add_movement = $this->load->view('edit/forms/movement/nature.blade.php', $data, true);
		$this->response->type_of_movement = $this->load->view('edit/forms/movement/'.$data['movement_file'], $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

    function download_movement_file($upload_id){   
        $this->db->select("photo")
        ->from("partners_movement_action_attachment")
        ->where("movement_attachment_id = {$upload_id}");

        $image_details = $this->db->get()->row_array();   
        $path = base_url() . $image_details['photo'];
        
        header('Content-disposition: attachment; filename='.substr( $image_details['photo'], strrpos( $image_details['photo'], '/' )+1 ).'');
        header('Content-type: txt/pdf');
        readfile($path);
    } 
    	
	function download_file($personal_id){	
		$this->load->model('profile_model', 'profile_mod');	
		$image_details = $this->profile_mod->get_partners_personal_image_details($this->user->user_id, $personal_id);
		$path = base_url() . $image_details['key_value'];
		
		header('Content-disposition: attachment; filename='.substr( $image_details['key_value'], strrpos( $image_details['key_value'], '/' )+1 ).'');
		header('Content-type: txt/pdf');
		readfile($path);
	}	


	public function edit( $record_id = "", $child_call = false )
	{
		$user_id = $record_id; // change into this to fix with upgrade version. should the same with the parent class
		$record_check = false;
		$this->record_id = $user_id;

		$result = $this->mod->_get_edit_cached_query_custom( $this->record_id );
		$result_personal = $this->mod->_get_edit_cached_query_personal_custom( $this->record_id );

		if( empty($user_id) )
		{
			$field_lists = $result->list_fields();
			foreach( $field_lists as $field )
			{
				$data['record'][$field] = '';
			}
		}
		else{
			$this->load->model('profile_model', 'profile_mod');
			$data['record'] = $result;
			$data['record']['users_profile.photo'] = $data['record']['users_profile.photo'] == "" ? "assets/img/avatar.png" : $data['record']['users_profile.photo'];
			// $data['record']['users_profile.photo'] = file_exists($data['record']['users_profile.photo'] ) ? $data['record']['users_profile.photo'] :"assets/img/avatar.png";
			
			$middle_initial = empty($result['users_profile.middlename']) ? " " : " ".ucfirst(substr($result['users_profile.middlename'],0,1)).". ";
			$data['profile_name'] = $result['users_profile.firstname'].$middle_initial.$result['users_profile.lastname'];
			$birthday = new DateTime($result['users_profile.birth_date']);
			$data['profile_age'] = $birthday->diff(new DateTime)->y;

			$telephones = array();
			$phone_numbers = $this->profile_mod->get_partners_personal($user_id, 'phone');
			foreach($phone_numbers as $phone){
				// $telephones[] = $this->format_phone($phone['key_value']);
				$telephones[] = $phone['key_value'];
			}
			$data['profile_telephones'] = $telephones;	
			$fax = array();
			$fax_numbers = $this->profile_mod->get_partners_personal($user_id, 'fax');
			foreach($fax_numbers as $fax_no){
				// $fax[] = $this->format_phone($fax_no['key_value']);
				$fax[] = $fax_no['key_value'];
			}
			$data['profile_fax'] = $fax;		
			$mobiles = array();
			$mobile_numbers = $this->profile_mod->get_partners_personal($user_id, 'mobile');
			foreach($mobile_numbers as $mobile){
				// $mobiles[] = $this->format_phone($mobile['key_value']);
				$mobiles[] = $mobile['key_value'];
			}
			$data['profile_mobiles'] = $mobiles;
			$city_town = $this->profile_mod->get_partners_personal($user_id, 'city_town');
			$city_town = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
			$data['profile_live_in'] = $city_town;
			$countries = $this->profile_mod->get_partners_personal($user_id, 'country');
			$data['profile_country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
			$civil_status = $this->profile_mod->get_partners_personal($user_id, 'civil_status');
			$data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));
			$spouse = $this->profile_mod->get_partners_personal($user_id, 'spouse');
			$data['profile_spouse'] = (count($spouse) == 0 ? " " : ($spouse[0]['key_value'] == "" ? "" : $spouse[0]['key_value']));

			$solo_parent = $this->profile_mod->get_partners_personal($user_id, 'solo_parent');
			$data['personal_solo_parent'] = (count($solo_parent) == 0 ? " " : ($solo_parent[0]['key_value'] == "" ? "" : $solo_parent[0]['key_value']));
				//Personal Contact
			$address_1 = $this->profile_mod->get_partners_personal($user_id, 'address_1');
			$address_1 = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
			$address_2 = $this->profile_mod->get_partners_personal($user_id, 'address_2');
			$address_2 = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
			$data['complete_address'] = $address_1." ".$address_2;	
			$data['address_1'] = $address_1;	
			$data['address_2'] = $address_2;	

			$zip_code = $this->profile_mod->get_partners_personal($user_id, 'zip_code');
			$data['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
		
			//employment info
			$probationary_date = $this->profile_mod->get_partners_personal($user_id, 'probationary_date');
			$data['record_personal'][1]['partners_personal.probationary_date'] = (count($probationary_date) == 0 ? " " : ($probationary_date[0]['key_value'] == "" ? "" : date("F d, Y", strtotime($probationary_date[0]['key_value']))));
			$original_date_hired = $this->profile_mod->get_partners_personal($user_id, 'original_date_hired');
			$data['record_personal'][1]['partners_personal.original_date_hired'] = (count($original_date_hired) == 0 ? " " : ($original_date_hired[0]['key_value'] == "" ? "" : date("F d, Y", strtotime($original_date_hired[0]['key_value']))));
			$last_probationary = $this->profile_mod->get_partners_personal($user_id, 'last_probationary');
			$data['record_personal'][1]['partners_personal.last_probationary'] = (count($last_probationary) == 0 ? " " : ($last_probationary[0]['key_value'] == "" ? "" : date("F d, Y", strtotime($last_probationary[0]['key_value']))));
			$last_salary_adjustment = $this->profile_mod->get_partners_personal($user_id, 'last_salary_adjustment');
			$data['record_personal'][1]['partners_personal.last_salary_adjustment'] = (count($last_salary_adjustment) == 0 ? " " : ($last_salary_adjustment[0]['key_value'] == "" ? "" : date("F d, Y", strtotime($last_salary_adjustment[0]['key_value']))));
			$organization = $this->profile_mod->get_partners_personal($user_id, 'organization');
			$data['record_personal'][1]['partners_personal.organization'] = (count($organization) == 0 ? " " : ($organization[0]['key_value'] == "" ? "" : $organization[0]['key_value']));
            $agency_assignment = $this->profile_mod->get_partners_personal($user_id, 'agency_assignment');
            $data['record_personal'][1]['partners_personal.agency_assignment'] = (count($agency_assignment) == 0 ? " " : ($agency_assignment[0]['key_value'] == "" ? "" : $agency_assignment[0]['key_value']));
            $section = $this->profile_mod->get_partners_personal($user_id, 'section');
            $data['record_personal'][1]['partners_personal.section'] = (count($section) == 0 ? " " : ($section[0]['key_value'] == "" ? "" : $section[0]['key_value']));
		
			// if(count($result_personal) > 0){
				// foreach($result_personal as $personal){
				// 	switch($personal['key']){
				// 		case 'probationary_date': 
				// 		case 'original_date_hired': 
				// 		case 'last_probationary': 
				// 		case 'last_salary_adjustment': 
				// 		$data['record_personal'][$personal['sequence']]['partners_personal.'.$personal['key']] = ($personal['key_value'] != "" ? date('F d, Y', strtotime($personal['key_value'])) : "");
				// 		break;
				// 		default:
				// 		$data['record_personal'][$personal['sequence']]['partners_personal.'.$personal['key']] = $personal['key_value'];
				// 		break;
				// 	}
				// }
			// }else{
			// 	$data['record_personal'][1]['partners_personal.probationary_date'] = '';
			// }
			
			//Emergency Contact
			$emergency_name = $this->profile_mod->get_partners_personal($user_id, 'emergency_name');
			$data['emergency_name'] = (count($emergency_name) == 0 ? " " : ($emergency_name[0]['key_value'] == "" ? "" : $emergency_name[0]['key_value']));
			$emergency_relationship = $this->profile_mod->get_partners_personal($user_id, 'emergency_relationship');
			$data['emergency_relationship'] = (count($emergency_relationship) == 0 ? " " : ($emergency_relationship[0]['key_value'] == "" ? "" : $emergency_relationship[0]['key_value']));
			$emergency_phone = $this->profile_mod->get_partners_personal($user_id, 'emergency_phone');
			$data['emergency_phone'] = (count($emergency_phone) == 0 ? " " : ($emergency_phone[0]['key_value'] == "" ? "" : $this->format_phone($emergency_phone[0]['key_value'])));
			$emergency_mobile = $this->profile_mod->get_partners_personal($user_id, 'emergency_mobile');
			$data['emergency_mobile'] = (count($emergency_mobile) == 0 ? " " : ($emergency_mobile[0]['key_value'] == "" ? "" : $this->format_phone($emergency_mobile[0]['key_value'])));
			$emergency_address = $this->profile_mod->get_partners_personal($user_id, 'emergency_address');
			$data['emergency_address'] = (count($emergency_address) == 0 ? " " : ($emergency_address[0]['key_value'] == "" ? "" : $emergency_address[0]['key_value']));
			$emergency_city = $this->profile_mod->get_partners_personal($user_id, 'emergency_city');
			$data['emergency_city'] = (count($emergency_city) == 0 ? " " : ($emergency_city[0]['key_value'] == "" ? "" : $emergency_city[0]['key_value']));
			$emergency_country = $this->profile_mod->get_partners_personal($user_id, 'emergency_country');
			$data['emergency_country'] = (count($emergency_country) == 0 ? " " : ($emergency_country[0]['key_value'] == "" ? "" : $emergency_country[0]['key_value']));
			$emergency_zip_code = $this->profile_mod->get_partners_personal($user_id, 'emergency_zip_code');
			$data['emergency_zip_code'] = (count($emergency_zip_code) == 0 ? " " : ($emergency_zip_code[0]['key_value'] == "" ? "" : $emergency_zip_code[0]['key_value']));

			/***** PERSONAL TAB *****/
				//Personal
			$gender = $this->profile_mod->get_partners_personal($user_id, 'gender');
			$data['gender'] = (count($gender) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $gender[0]['key_value']));
			$birth_place = $this->profile_mod->get_partners_personal($user_id, 'birth_place');
			$data['birth_place'] = (count($birth_place) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $birth_place[0]['key_value']));
			$religion = $this->profile_mod->get_partners_personal($user_id, 'religion');
			$data['religion'] = (count($religion) == 0 ? " " : ($religion[0]['key_value'] == "" ? "" : $religion[0]['key_value']));
			$nationality = $this->profile_mod->get_partners_personal($user_id, 'nationality');
			$data['nationality'] = (count($nationality) == 0 ? " " : ($nationality[0]['key_value'] == "" ? "" : $nationality[0]['key_value']));
				//Other Information
			$height = $this->profile_mod->get_partners_personal($user_id, 'height');
			$data['height'] = (count($height) == 0 ? " " : ($height[0]['key_value'] == "" ? "" : $height[0]['key_value']));
			$weight = $this->profile_mod->get_partners_personal($user_id, 'weight');
			$data['weight'] = (count($weight) == 0 ? " " : ($weight[0]['key_value'] == "" ? "" : $weight[0]['key_value']));
			$interests_hobbies = $this->profile_mod->get_partners_personal($user_id, 'interests_hobbies');
			$data['interests_hobbies'] = (count($interests_hobbies) == 0 ? " " : ($interests_hobbies[0]['key_value'] == "" ? "" : $interests_hobbies[0]['key_value']));
			$language = $this->profile_mod->get_partners_personal($user_id, 'language');
			$data['language'] = (count($language) == 0 ? " " : ($language[0]['key_value'] == "" ? "" : $language[0]['key_value']));
			$dialect = $this->profile_mod->get_partners_personal($user_id, 'dialect');
			$data['dialect'] = (count($dialect) == 0 ? " " : ($dialect[0]['key_value'] == "" ? "" : $dialect[0]['key_value']));
			$dependents_count = $this->profile_mod->get_partners_personal($user_id, 'dependents_count');
			$data['dependents_count'] = (count($dependents_count) == 0 ? " " : ($dependents_count[0]['key_value'] == "" ? "" : $dependents_count[0]['key_value']));

			/***** HISTORY TAB *****/
				//Education
			$education_tab = array();
			$educational_tab = array();
			$education_tab = $this->profile_mod->get_partners_personal_history($user_id, 'education');
			foreach($education_tab as $educ){
				$educational_tab[$educ['sequence']][$educ['key']] = $educ['key_value'];
			}
			$data['education_tab'] = $educational_tab;
		//Employment
			$employment_tab = array();
			$employments_tab = array();
			$employment_tab = $this->profile_mod->get_partners_personal_history($user_id, 'employment');
			foreach($employment_tab as $emp){
				$employments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['employment_tab'] = $employments_tab;
		//Character Reference
			$reference_tab = array();
			$references_tab = array();
			$reference_tab = $this->profile_mod->get_partners_personal_history($user_id, 'reference');
			foreach($reference_tab as $emp){
				$references_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['reference_tab'] = $references_tab;
		//Licensure
			$licensure_tab = array();
			$licensures_tab = array();
			$details_data_id = array();
			$licensure_tab = $this->profile_mod->get_partners_personal_history($user_id, 'licensure');
			foreach($licensure_tab as $emp){
				$licensures_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
				$details_data_id[$emp['sequence']][$emp['key']] = $emp['personal_id'];
			}
			$data['licensure_tab'] = $licensures_tab;
			$data['details_data_id'] = $details_data_id;
		//Trainings and Seminars
			$training_tab = array();
			$trainings_tab = array();
			$training_tab = $this->profile_mod->get_partners_personal_history($user_id, 'training');
			foreach($training_tab as $emp){
				$trainings_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['training_tab'] = $trainings_tab;
		//Skills
			$skill_tab = array();
			$skills_tab = array();
			$skill_tab = $this->profile_mod->get_partners_personal_history($user_id, 'skill');
			foreach($skill_tab as $emp){
				$skills_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['skill_tab'] = $skills_tab;
		//Affiliation
			$affiliation_tab = array();
			$affiliations_tab = array();
			$affiliation_tab = $this->profile_mod->get_partners_personal_history($user_id, 'affiliation');
			foreach($affiliation_tab as $emp){
				$affiliations_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['affiliation_tab'] = $affiliations_tab;
		//Accountabilities
			$accountabilities_tab = array();
			$accountable_tab = array();
			$accountabilities_tab = $this->profile_mod->get_partners_personal_history($user_id, 'accountabilities');
			foreach($accountabilities_tab as $emp){
				$accountable_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['accountabilities_tab'] = $accountable_tab;
		//Attachments
			$attachment_tab = array();
			$attachments_tab = array();
			$attachment_tab = $this->profile_mod->get_partners_personal_history($user_id, 'attachment');
			foreach($attachment_tab as $emp){
				$attachments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['attachment_tab'] = $attachments_tab;
		//Family
			$family_tab = array();
			$families_tab = array();
			$family_tab = $this->profile_mod->get_partners_personal_history($user_id, 'family');
			foreach($family_tab as $emp){
				$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['family_tab'] = $families_tab;
		}

		$this->load->vars( $data );

		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('edit.edit_custom')->with( $this->load->get_cached_vars() );
	}

	function add_form() {
		$this->_ajax_only();

		$data['count'] = $this->input->post('count');
		$data['counting'] = $this->input->post('counting');
		$data['category'] = $this->input->post('category');

		$this->response->count = ++$data['count'];
		$this->response->counting = ++$data['counting'];

		$this->load->helper('file');
		$this->response->add_form = $this->load->view('edit/forms/'.$this->input->post('add_form'), $data, true);
		
		// $this->response->add_form = '';
		// $this->response->add_form .= $this->load->blade('edit.forms.'.$this->input->post('add_form'), $data, true);
		// $data['add_content'] = $this->load->blade('edit.forms.'.$this->input->post('add_form'))->with( $this->load->get_cached_vars() );
		// $this->response->add_form = $this->load->view('edit/forms/added_form_portlet', $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

	public function single_upload()
	{
		$this->_ajax_only();
		define('UPLOAD_DIR', 'uploads/users/');
		$this->load->library("uploadhandler");
		$files = $this->uploadhandler->post();
		$file = $files[0];
		if( isset($file->error) && $file->error != "" )
		{
			$this->response->message[] = array(
				'message' => $file->error,
				'type' => 'error'
			);	
		}
		$this->response->file = $file;
		$this->_ajax_return();
	}
	
	function save($child_call = false){

		$error = false;
		$post = $_POST;
		$this->response->record_id = $this->record_id = $post['record_id'];
		unset( $post['record_id'] );

		//validate if there are existing pending forms
		$record_id_check = $this->input->post('record_id');
		$user_profile_data = $this->input->post('users_profile');
		$new_company_id = $user_profile_data['company_id'];
		$new_department_id = $user_profile_data['department_id'];
		$new_position_id = $user_profile_data['position_id'];
		if($record_id_check > 0){			
			$user_record = $this->db->get_where( 'users_profile', array( $this->mod->primary_key => $record_id_check ) )->row_array();
			if( ($new_company_id != $user_record['company_id']) || ($new_department_id != $user_record['department_id']) || ($new_position_id != $user_record['position_id']) ){
				$select_pending_forms_qry = "SELECT  tr.forms_id, tr.user_id 
									FROM time_forms tr WHERE deleted=0
       								AND user_id = {$user_record['user_id']}
       								AND form_status_id IN (2,3,4,5) 
       								";
				$result_update = $this->db->query( $select_pending_forms_qry );
				$pending_forms_count = $result_update->num_rows();
				
				if($pending_forms_count > 0){
					$is_are = ($pending_forms_count == 1) ? "is" : "are";
					$form_s = ($pending_forms_count == 1) ? "form" : "forms";
					$this->response->message[] = array(
						'message' => "There {$is_are} {$pending_forms_count} pending {$form_s} affected.<br>Please dis/approve {$form_s} before changing the user's company.",
						'type' => 'warning'
					);
        		$this->_ajax_return();
				}
			}
		}
		
        /***** START Form Validation (hard coded) *****/
		//table assignment (manual saving)
		$other_tables = array();
		$partners_personal = array();
		$validation_rules = array();
		$partners_personal_key = array();
		switch($post['fgs_number']){
			case 0:
			$validation_rules[] = 
			array(
				'field' => 'users_profile[lastname]',
				'label' => 'Last Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[firstname]',
				'label' => 'First Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[company_id]',
				'label' => 'Company',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[division_id]',
				'label' => 'Division',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[position_id]',
				'label' => 'Position',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users[role_id]',
				'label' => 'Role',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[gender]',
				'label' => 'Gender',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[birth_date]',
				'label' => 'Birthday',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal";
			$other_tables['users_profile'] = $post['users_profile'];
			$other_tables['users_profile']['birth_date'] = date('Y-m-d', strtotime($post['users_profile']['birth_date']));
			$partners_personal_key = array('gender', 'civil_status');
			$partners_personal = $post['partners_personal'];
			//check if id/biometric number is unique
			$idnumber = trim($post['partners']['id_number']);
			if(strlen($idnumber) > 0){
				$id_number_qry = "SELECT  partner_id, id_number
											FROM {$this->db->dbprefix}partners 
											WHERE id_number = '{$post['partners']['id_number']}' 
											AND deleted = 0;

		       								";
				$idnum_sql = $this->db->query( $id_number_qry );
				$idnum_count = $idnum_sql->num_rows();
				
				if($idnum_count > 0){
					$this->response->message[] = array(
						'message' => "Partner ID number already exist.",
						'type' => 'warning'
					);
	    		$this->_ajax_return();
				}
			}
			$biometric = trim($post['partners']['biometric']);
			if(strlen($biometric) > 0){
				$id_number_qry = "SELECT  partner_id, biometric
											FROM {$this->db->dbprefix}partners 
											WHERE id_number = '{$post['partners']['biometric']}' 
											AND deleted = 0;

		       								";
				$idnum_sql = $this->db->query( $id_number_qry );
				$idnum_count = $idnum_sql->num_rows();
				
				if($idnum_count > 0){
					$this->response->message[] = array(
						'message' => "Partner Biometric number already exist.",
						'type' => 'warning'
					);
	    		$this->_ajax_return();
				}
			}
			break;
			case 1:
			//General Tab
			$validation_rules[] = 
			array(
				'field' => 'users_profile[lastname]',
				'label' => 'Last Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[firstname]',
				'label' => 'First Name',
				'rules' => 'required'
				);
			$other_tables['users_profile'] = $post['users_profile'];
			break;
			case 2:
			//Employment Tab
			$validation_rules[] = 
			array(
				'field' => 'users_profile[company_id]',
				'label' => 'Company',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[location_id]',
				'label' => 'Location',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[position_id]',
				'label' => 'Position Title',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users[role_id]',
				'label' => 'Role',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners[id_number]',
				'label' => 'ID Number',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners[biometric]',
				'label' => 'Biometric Number',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners[status_id]',
				'label' => 'Status',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners[employment_type_id]',
				'label' => 'Type',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners[effectivity_date]',
				'label' => 'Date Hired',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal";
			$other_tables['users_profile'] = $post['users_profile'];
			$other_tables['partners'] = $post['partners'];
			$other_tables['partners']['effectivity_date'] = date('Y-m-d', strtotime($post['partners']['effectivity_date']));
			$partners_personal_key = array('probationary_date', 'original_date_hired', 'last_probationary', 'last_salary_adjustment', 'organization', 'agency_assignment', 'section');
			$partners_personal = $post['partners_personal'];
			//check if id/biometric number is unique
			$idnumber = trim($post['partners']['id_number']);
			if(strlen($idnumber) > 0){
				$id_number_qry = "SELECT  partner_id, id_number
											FROM {$this->db->dbprefix}partners 
											WHERE id_number = '{$post['partners']['id_number']}' 
											AND deleted = 0
											AND user_id != {$this->record_id}
		       								;";
				$idnum_sql = $this->db->query( $id_number_qry );
				$idnum_count = $idnum_sql->num_rows();
				
				if($idnum_count > 0){
					$this->response->message[] = array(
						'message' => "Partner ID number already exist.",
						'type' => 'warning'
					);
	    		$this->_ajax_return();
				}
			}
			$biometric = trim($post['partners']['biometric']);
			if(strlen($biometric) > 0){
				$id_number_qry = "SELECT  partner_id, biometric
											FROM {$this->db->dbprefix}partners 
											WHERE biometric = '{$post['partners']['biometric']}' 
											AND deleted = 0 
											AND user_id != {$this->record_id}
											;";
				$idnum_sql = $this->db->query( $id_number_qry );
				$idnum_count = $idnum_sql->num_rows();
				
				if($idnum_count > 0){
					$this->response->message[] = array(
						'message' => "Partner Biometric number already exist.",
						'type' => 'warning'
					);
	    		$this->_ajax_return();
				}
			}
			break;
			case 3:
			//Contacts Tab
			$validation_rules[] = 
			array(
				'field' => 'users[email]',
				'label' => 'Email Address',
				'rules' => 'required|valid_email'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[phone]',
				'label' => 'Phone',
				'rules' => 'numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[mobile]',
				'label' => 'Mobile',
				'rules' => 'numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[emergency_phone]',
				'label' => 'Emergency Contact Phone',
				'rules' => 'numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[emergency_mobile]',
				'label' => 'Emergency Contact Mobile',
				'rules' => 'numeric'
				);
			$partners_personal_table = "partners_personal";
			$partners_personal_key = array('phone', 'mobile', 'address_1', 'city_town', 'country', 'zip_code', 'emergency_name', 'emergency_relationship', 'emergency_phone', 'emergency_mobile', 'emergency_address', 'emergency_city', 'emergency_country', 'emergency_zip_code');
			$partners_personal = $post['partners_personal'];
			break;
			case 4:
			//Personal Tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[gender]',
				'label' => 'Gender',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'users_profile[birth_date]',
				'label' => 'Birthday',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal[dependents_count]',
				'label' => 'No. of Dependents',
				'rules' => 'numeric'
				);
			$partners_personal_table = "partners_personal";
			$other_tables['users_profile'] = $post['users_profile'];
			$other_tables['users_profile']['birth_date'] = date('Y-m-d', strtotime($post['users_profile']['birth_date']));
			$partners_personal_key = array('gender', 'birth_place', 'religion', 'nationality', 'civil_status', 'height', 'weight', 'interests_hobbies', 'language', 'dialect', 'dependents_count');
			$partners_personal = $post['partners_personal'];
			break;
			case 5:
			//Education Tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[education-school]',
				'label' => 'School',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[education-year-from]',
				'label' => 'Start Year',
				'rules' => 'required|numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[education-year-to]',
				'label' => 'End Year',
				'rules' => 'required|numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[education-status]',
				'label' => 'School',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('education-type', 'education-school', 'education-year-from', 'education-year-to', 'education-degree', 'education-status');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 6:
			//Employment History Tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[employment-company]',
				'label' => 'Company Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[employment-position-title]',
				'label' => 'Position Title',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[employment-year-hired]',
				'label' => 'Year Hired',
				'rules' => 'required|numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[employment-year-end]',
				'label' => 'Year End',
				'rules' => 'required|numeric'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('employment-company', 'employment-position-title', 'employment-location', 'employment-duties', 'employment-month-hired', 'employment-month-end', 'employment-year-hired', 'employment-year-end');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 7:
			//Character Reference tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[reference-name]',
				'label' => 'Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[reference-years-known]',
				'label' => 'Years Known',
				'rules' => 'required|numeric'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('reference-name', 'reference-occupation', 'reference-years-known', 'reference-phone', 'reference-mobile', 'reference-address', 'reference-city', 'reference-country', 'reference-zipcode');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 8:
			//Licensure tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[licensure-title]',
				'label' => 'Title',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[licensure-year-taken]',
				'label' => 'Year Taken',
				'rules' => 'required|numeric'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('licensure-title', 'licensure-number', 'licensure-remarks', 'licensure-month-taken', 'licensure-year-taken');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 9:
			//Trainings and Seminars tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[training-title]',
				'label' => 'Title',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[training-venue]',
				'label' => 'Venue',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[training-start-year]',
				'label' => 'Year Start',
				'rules' => 'required|numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[training-end-year]',
				'label' => 'Year End',
				'rules' => 'required|numeric'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('training-category', 'training-title', 'training-venue', 'training-start-month', 'training-start-year', 'training-end-month', 'training-end-year');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 10:
			//Skills tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[skill-type]',
				'label' => 'Skill Type',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[skill-name]',
				'label' => 'Skill Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[skill-level]',
				'label' => 'Proficiency Level',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('skill-type', 'skill-name', 'skill-level', 'skill-remarks');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 11:
			//Affiliation tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[affiliation-name]',
				'label' => 'Affiliation Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[affiliation-position]',
				'label' => 'Position',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[affiliation-year-start]',
				'label' => 'Year Start',
				'rules' => 'required|numeric'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[affiliation-year-end]',
				'label' => 'Year End',
				'rules' => 'required|numeric'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('affiliation-name', 'affiliation-position', 'affiliation-month-start', 'affiliation-month-end', 'affiliation-year-start', 'affiliation-year-end');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 12:
			//Accountabilities tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[accountabilities-name]',
				'label' => 'Item Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[accountabilities-code]',
				'label' => 'Item Code',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('accountabilities-name', 'accountabilities-code', 'accountabilities-quantity', 'accountabilities-date-issued', 'accountabilities-date-returned', 'accountabilities-remarks');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 13:
			//Accountabilities tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[attachment-name]',
				'label' => 'Filename',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[attachment-file]',
				'label' => 'Upload File',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('attachment-name', 'attachment-file');
			$partners_personal = $post['partners_personal_history'];
			break;
			case 14:
			//Family tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[family-name]',
				'label' => 'Name',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[family-birthdate]',
				'label' => 'Birthday',
				'rules' => 'required'
				);
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('family-relationship', 'family-name', 'family-birthdate');
			$partners_personal = $post['partners_personal_history'];
			break;
		}

		if( sizeof( $validation_rules ) > 0 )
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules( $validation_rules );
			if ($this->form_validation->run() == false)
			{
				foreach( $this->form_validation->get_error_array() as $f => $f_error )
				{
					$this->response->message[] = array(
						'message' => $f_error,
						'type' => 'warning'
						);  
				}

				$this->_ajax_return();
			}
		}
        /***** END Form Validation (hard coded) *****/

        //SAVING START   
		$transactions = true;
		$this->partner_id = 0;
		if( $transactions )
		{
			$this->db->trans_begin();
		}

		//start saving with main table
		if(isset($post[$this->mod->table])) {
			$main_record = $post[$this->mod->table];
			$record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $this->record_id ) );
			switch( true )
			{
				case $record->num_rows() == 0:
					//add mandatory fields
					$main_record['created_by'] = $this->user->user_id;
					$this->db->insert($this->mod->table, $main_record);
					if( $this->db->_error_message() == "" )
					{
						$this->response->record_id = $this->record_id = $this->db->insert_id();
						$this->db->insert('partners', array('user_id' => $this->record_id ));
						$this->partner_id = $this->db->insert_id();
					}
					$this->response->action = 'insert';
					break;
				case $record->num_rows() == 1:
					$main_record['modified_by'] = $this->user->user_id;
					$main_record['modified_on'] = date('Y-m-d H:i:s');
					$this->db->update( $this->mod->table, $main_record, array( $this->mod->primary_key => $this->record_id ) );
					$this->response->action = 'update';
					break;
				default:
					$this->response->message[] = array(
						'message' => lang('common.inconsistent_data'),
						'type' => 'error'
					);
					$error = true;
					goto stop;
			}

			if( $this->db->_error_message() != "" ){
				$this->response->message[] = array(
					'message' => $this->db->_error_message(),
					'type' => 'error'
				);
				$error = true;
				goto stop;
			}
		}

		foreach( $other_tables as $table => $data )
		{
			$record = $this->db->get_where( $table, array( $this->mod->primary_key => $this->record_id ) );
			switch( true )
			{
				case $record->num_rows() == 0:
					$data[$this->mod->primary_key] = $this->record_id;
					$this->db->insert($table, $data);
					$this->record_id = $this->db->insert_id();
					break;
				case $record->num_rows() == 1:
					$this->db->update( $table, $data, array( $this->mod->primary_key => $this->record_id ) );
					break;
				default:
					$this->response->message[] = array(
						'message' => lang('common.inconsistent_data'),
						'type' => 'error'
					);
					$error = true;
					goto stop;
			}

			if( $this->db->_error_message() != "" ){
				$this->response->message[] = array(
					'message' => $this->db->_error_message(),
					'type' => 'error'
				);
				$error = true;
			}
		}

		//personal profile
		if(count($partners_personal_key) > 0){
			$this->load->model('profile_model', 'profile_mod');
			$sequence = 1;
			foreach( $partners_personal_key as $table => $key )
			{		
				if(!is_array($partners_personal[$key])){

					$record = $this->profile_mod->get_partners_personal($this->record_id , $key);
					$data_personal = array('key_value' => $partners_personal[$key]);
					switch( true )
					{
						case count($record) == 0:
							$data_personal = $this->mod->insert_partners_personal($this->record_id, $key, $partners_personal[$key], $sequence, $this->partner_id);
							$this->db->insert($partners_personal_table, $data_personal);
							// $this->record_id = $this->db->insert_id();
							break;
						case count($record) == 1:
							$partner_id = ($this->partner_id == 0) ? $this->mod->get_partner_id($this->record_id) : $this->partner_id;
							$this->db->update( $partners_personal_table, $data_personal, array( 'partner_id' => $partner_id, 'key' => $key ) );
							break;
						default:
							$this->response->message[] = array(
								'message' => lang('common.inconsistent_data'),
								'type' => 'error'
							);
							$error = true;
							goto stop;
					}

					if( $this->db->_error_message() != "" ){
						$this->response->message[] = array(
							'message' => $this->db->_error_message(),
							'type' => 'error'
						);
						$error = true;
					}
				}else{

					$sequence = 1;
					$partner_id = ($this->partner_id == 0) ? $this->mod->get_partner_id($this->record_id) : $this->partner_id;
					$this->db->delete($partners_personal_table, array( 'partner_id' => $partner_id, 'key' => $key ));
					foreach( $partners_personal[$key] as $table => $data_personal )
					{	
						$data_personal = $this->mod->insert_partners_personal($this->record_id, $key, $data_personal, $sequence, $this->partner_id);
						$this->db->insert($partners_personal_table, $data_personal);

						if( $this->db->_error_message() != "" ){
							$this->response->message[] = array(
								'message' => $this->db->_error_message(),
								'type' => 'error'
							);
							$error = true;
						}	
						$sequence++;
					}

				}
			}
		}

		stop:
		if( $transactions )
		{
			if( !$error ){
				$this->db->trans_commit();
			}
			else{
				 $this->db->trans_rollback();
			}
		}

		if( !$error  )
		{
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;
        $this->_ajax_return();

	}

	function add($record_id = '', $child_call = false){
		echo "Sorry. No add facility yet";
	}

    function add_partner()
    {
        $this->_ajax_only();

        if( !$this->permission['add'] && !$this->permission['edit'] )
        {
            $this->response->message[] = array(
                'message' => 'You dont have sufficient permission to get the list of field groups for this module, please notify the System Administrator.',
                'type' => 'warning'
            );
            $this->_ajax_return();
        }
        $data = array();
        $this->load->helper('form');
        $view['title'] = 'Partner';
        $view['content'] = $this->load->view('edit/add_partner_form', $data, true);
        
        $this->response->add_partner_form = $this->load->view('templates/partner_custom_modal', $view, true);
        
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function account_attach_list(){  
    	
    	$this->_ajax_only();  	
    	$user_id = $this->input->post('record_id');
    	$partner_id = $this->input->post('partner_id');

		$this->load->model('profile_model', 'profile_mod');

		if($partner_id == 12){
			//Accountabilities
			$accountabilities_tab = array();
			$accountable_tab = array();
			$accountabilities_tab = $this->profile_mod->get_partners_personal_history($user_id, 'accountabilities');
			foreach($accountabilities_tab as $emp){
				$accountable_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['accountabilities_tab'] = $accountable_tab;
	    	$view['content'] = $this->load->view('edit/forms/accountabilities_list', $data, true);
		}else{ //partner_id == 13
		//Attachments
			$attachment_tab = array();
			$attachments_tab = array();
			$attachment_tab = $this->profile_mod->get_partners_personal_history($user_id, 'attachment');
			foreach($attachment_tab as $emp){
				$attachments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['attachment_tab'] = $attachments_tab;
	    	$view['content'] = $this->load->view('edit/forms/attachments_list', $data, true);
		}

	    $this->response->lists = $view['content'];

	    $this->response->message[] = array(
	        'message' => '',
	        'type' => 'success'
	        );

	    $this->_ajax_return();
    }

    function get_overview_details(){
    	
    	$this->_ajax_only();  	

		$this->record_id = $user_id = $this->input->post('record_id');

		$result = $this->mod->_get_edit_cached_query_custom( $this->record_id );
		$result_personal = $this->mod->_get_edit_cached_query_personal_custom( $this->record_id );

			$this->load->model('profile_model', 'profile_mod');
			$data['record'] = $result;
			$data['record']['users_profile.photo'] = $data['record']['users_profile.photo'] == "" ? "assets/img/avatar.png" : $data['record']['users_profile.photo'];
			// $data['record']['users_profile.photo'] = file_exists($data['record']['users_profile.photo'] ) ? $data['record']['users_profile.photo'] :"assets/img/avatar.png";
			
			$middle_initial = empty($result['users_profile.middlename']) ? " " : " ".ucfirst(substr($result['users_profile.middlename'],0,1)).". ";
			$data['profile_name'] = $result['users_profile.firstname'].$middle_initial.$result['users_profile.lastname'];
			$birthday = new DateTime($result['users_profile.birth_date']);
			$data['profile_age'] = $birthday->diff(new DateTime)->y;

			$telephones = array();
			$phone_numbers = $this->profile_mod->get_partners_personal($user_id, 'phone');
			foreach($phone_numbers as $phone){
				$telephones[] = $this->format_phone($phone['key_value']);
			}
			$data['profile_telephones'] = $telephones;	
			$fax = array();
			$fax_numbers = $this->profile_mod->get_partners_personal($user_id, 'fax');
			foreach($fax_numbers as $fax_no){
				$fax[] = $this->format_phone($fax_no['key_value']);
			}
			$data['profile_fax'] = $fax;		
			$mobiles = array();
			$mobile_numbers = $this->profile_mod->get_partners_personal($user_id, 'mobile');
			foreach($mobile_numbers as $mobile){
				$mobiles[] = $this->format_phone($mobile['key_value']);
			}
			$data['profile_mobiles'] = $mobiles;
			$city_town = $this->profile_mod->get_partners_personal($user_id, 'city_town');
			$city_town = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $this->profile_mod->get_city($city_town[0]['key_value'])));
			$data['profile_live_in'] = $city_town;
			$countries = $this->profile_mod->get_partners_personal($user_id, 'country');
			$data['profile_country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $this->profile_mod->get_country($countries[0]['key_value'])));
			$civil_status = $this->profile_mod->get_partners_personal($user_id, 'civil_status');
			$data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));
			$spouse = $this->profile_mod->get_partners_personal($user_id, 'spouse');
			$data['profile_spouse'] = (count($spouse) == 0 ? " " : ($spouse[0]['key_value'] == "" ? "" : $spouse[0]['key_value']));

		// $data['attachment_tab'] = $attachments_tab;
	    $view['content'] = $this->load->view('edit/forms/profile_header_overview', $data, true);
		
	    $this->response->lists = $view['content'];

	    $this->response->message[] = array(
	        'message' => '',
	        'type' => 'success'
	        );

	    $this->_ajax_return();
    }

}