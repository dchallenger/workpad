<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My201 extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('my201_model', 'mod');
		$this->load->model('partners_model', 'partner');
		parent::__construct();
        $this->lang->load( 'my201' );
        $this->lang->load( 'partners' );
	}

	public function index(){
		
		if( !$this->permission['list'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$current_date = date('Y-m-d');

		$result = $this->db->query('SELECT GROUP_CONCAT(`value`) AS config FROM ww_config WHERE `key` IN ("date_from","date_to","enable_open_season")');

		if ($result && $result->num_rows() > 0){
			$config = $result->row();
			$config_array = explode(',', $config->config);
		}

		if( $config_array[2] && ($config_array[0] != "0000-00-00") && ($config_array[1] != "0000-00-00") ){
			if( $current_date >= $config_array[0] && $current_date <= $config_array[1]){
				$this->edit();
				return;
			}
		}

		$profile_header_details = $this->mod->get_profile_header_details($this->user->user_id);
		$middle_initial = empty($profile_header_details['middlename']) ? " " : " ".ucfirst(substr($profile_header_details['middlename'],0,1)).". ";
		$data['profile_name'] = $profile_header_details['firstname'].$middle_initial.$profile_header_details['lastname'].'&nbsp;'.$profile_header_details['suffix'];

		//employee benefit
		$employee_benefit = $this->partner->get_employee_benefit($this->user->user_id);
		$data['benefit_type'] = (count($employee_benefit) == 0 ? "n/a" :  $employee_benefit['benefit_type']);
		$data['benefit'] = (count($employee_benefit) == 0 ? "n/a" :  $employee_benefit['benefit']);

		// $department = empty($profile_header_details['department']) ? "" : " on ".ucwords(strtolower($profile_header_details['department']));
		// $data['profile_position'] = ucwords(strtolower($profile_header_details['position']));
		$department = empty($profile_header_details['department']) ? "" : " on ".$profile_header_details['department'];
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
		$probationary_date = $this->mod->get_partners_personal($this->user->user_id, 'probationary_date');
			$data['probationary_date'] = (count($probationary_date) == 0 ? "n/a" : ($probationary_date[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($probationary_date[0]['key_value']))));
		$original_date_hired = $this->mod->get_partners_personal($this->user->user_id, 'original_date_hired');
			$data['original_date_hired'] = (count($original_date_hired) == 0 ? "n/a" : ($original_date_hired[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($original_date_hired[0]['key_value']))));
		$last_probationary = $this->mod->get_partners_personal($this->user->user_id, 'last_probationary');
			$data['last_probationary'] = (count($last_probationary) == 0 ? "n/a" : ($last_probationary[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_probationary[0]['key_value']))));
		$last_salary_adjustment = $this->mod->get_partners_personal($this->user->user_id, 'last_salary_adjustment');
			$data['last_salary_adjustment'] = (count($last_salary_adjustment) == 0 ? "n/a" : ($last_salary_adjustment[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_salary_adjustment[0]['key_value']))));
		$data['last_promotion_date'] = valid_date($profile_header_details['last_promotion_date']);
		$data['old_new'] = ($profile_header_details['old_new'] == 0 ? "Old" : "New");
		//Work Assignment
		$reports_to = $profile_header_details['immediate'] == "" ? "n/a" : $this->mod->get_user_details($profile_header_details['immediate']);
		if($reports_to == "n/a"){
			$data['reports_to'] = $reports_to;
		}
		else{
			if(!empty($reports_to) && $reports_to['active'] == 1) {
				$reports_to_MI = empty($reports_to['middlename']) ? " " : " ".ucfirst(substr($reports_to['middlename'],0,1)).". ";
				$data['reports_to'] = $reports_to['firstname'].$reports_to_MI.$reports_to['lastname'];
			}else{
				$data['reports_to'] = 'n/a';
			}
		}
		$organization = $this->mod->get_partners_personal($this->user->user_id, 'organization');
		$data['organization'] = (count($organization) == 0 ? "n/a" : ($organization[0]['key_value'] == "" ? "n/a" : $organization[0]['key_value']));
		$agency_assignment = $this->mod->get_partners_personal($this->user->user_id, 'agency_assignment');
        $data['agency_assignment'] = (count($agency_assignment) == 0 ? "n/a" : ($agency_assignment[0]['key_value'] == "" ? "n/a" : $agency_assignment[0]['key_value']));
        // debug($data); die;
        $data['project'] = ($profile_header_details['project'] == "" ? "n/a" : $profile_header_details['project']);
        $data['project_id'] = ($profile_header_details['project_id'] == "" ? "n/a" : $profile_header_details['project_id']);
        $data['project_hr'] = ($profile_header_details['project_hr'] == "" ? "n/a" : $profile_header_details['project_hr']);
        $data['coordinator'] = ($profile_header_details['coordinator'] == "" ? "n/a" : $profile_header_details['coordinator']);
        $data['credit_setup'] = ($profile_header_details['credit_setup'] == "" ? "n/a" : $profile_header_details['credit_setup']);
        $data['start_date'] = valid_date($profile_header_details['start_date']);
        $data['end_date'] = valid_date($profile_header_details['end_date']);        
        $data['division'] = $profile_header_details['division'] == "" ? "n/a" : $profile_header_details['division']. ' ('.get_division_code($profile_header_details['division_code'],'-').')';
		$data['department'] = $profile_header_details['department'] == "" ? "n/a" : $profile_header_details['department'];
		$data['branch'] = $profile_header_details['branch'] == "" ? "n/a" : $profile_header_details['branch'];
		$data['group'] = $profile_header_details['group'] == "" ? "n/a" : $profile_header_details['group'];
        $data['cost_center_code'] = ($profile_header_details['cost_center_code'] == "" ? "n/a" : $profile_header_details['cost_center_code']);
        $data['sbu_unit_id'] = ($profile_header_details['sbu_unit_id'] == "" ? "n/a" : $profile_header_details['sbu_unit_id']);
        $data['sbu_unit'] = ($profile_header_details['sbu_unit'] == "" ? "n/a" : $profile_header_details['sbu_unit']);
        $data['sbu_unit_details'] = ($profile_header_details['sbu_unit_details'] == "" ? "n/a" : $profile_header_details['sbu_unit_details']);
		/***** CONTACTS TAB *****/
		//Personal Contact
		$address_1 = $this->mod->get_partners_personal($this->user->user_id, 'address_1');
			$address_1 = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
		$address_2 = $this->mod->get_partners_personal($this->user->user_id, 'address_2');
			$address_2 = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
		$city_town = $this->mod->get_partners_personal($this->user->user_id, 'city_town');
			$city_town = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $this->mod->get_city($city_town[0]['key_value'])));
		$data['complete_address'] = $address_1." ".$address_2;		
		$zip_code = $this->mod->get_partners_personal($this->user->user_id, 'zip_code');
			$data['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
			
		$country = $this->mod->get_partners_personal($this->user->user_id, 'country');
		$data['country'] = (count($country) > 0 ? $this->mod->get_country($country[0]['key_value']) : " ");		
		$permanent_address = $this->mod->get_partners_personal($this->user->user_id, 'permanent_address');
		$data['permanent_address'] = $permanent_address = (count($permanent_address) == 0 ? " " : ($permanent_address[0]['key_value'] == "" ? "" : $permanent_address[0]['key_value']));
		$permanent_city_town = $this->mod->get_partners_personal($this->user->user_id, 'permanent_city_town');
		$data['permanent_city_town'] = $permanent_city_town = (count($permanent_city_town) == 0 ? " " : ($permanent_city_town[0]['key_value'] == "" ? "" : $this->mod->get_city($permanent_city_town[0]['key_value'])));
		$permanent_country = $this->mod->get_partners_personal($this->user->user_id, 'permanent_country');
		$data['permanent_country'] = $permanent_country = (count($permanent_country) == 0 ? " " : ($permanent_country[0]['key_value'] == "" ? "" : $this->mod->get_country($permanent_country[0]['key_value'])));			
		$permanent_zipcode = $this->mod->get_partners_personal($this->user->user_id, 'permanent_zipcode');
		$data['permanent_zipcode'] = $permanent_zipcode = (count($permanent_zipcode) == 0 ? " " : ($permanent_zipcode[0]['key_value'] == "" ? "" : $permanent_zipcode[0]['key_value']));						
		$phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'phone');
		$data['office_telephones'] = $phone_numbers = (count($phone_numbers) == 0 ? " " : ($phone_numbers[0]['key_value'] == "" ? "" : $phone_numbers[0]['key_value']));
		$mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'mobile');
		$data['office_mobiles'] = $mobile_numbers = (count($mobile_numbers) == 0 ? " " : ($mobile_numbers[0]['key_value'] == "" ? "" : $mobile_numbers[0]['key_value']));
		$personal_phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'personal_phone');
		$data['personal_telephone'] = $personal_phone_numbers = (count($personal_phone_numbers) == 0 ? " " : ($personal_phone_numbers[0]['key_value'] == "" ? "" : $personal_phone_numbers[0]['key_value']));
		$personal_mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'personal_mobile');
		$data['personal_mobile'] = $personal_mobile_numbers = (count($personal_mobile_numbers) == 0 ? " " : ($personal_mobile_numbers[0]['key_value'] == "" ? "" : $personal_mobile_numbers[0]['key_value']));
		$personal_email = $this->mod->get_partners_personal($this->user->user_id, 'personal_email');
		$data['personal_email'] = $personal_email = (count($personal_email) == 0 ? " " : ($personal_email[0]['key_value'] == "" ? "" : $personal_email[0]['key_value']));
		//Emergency Contact
		$emergency_name = $this->mod->get_partners_personal($this->user->user_id, 'emergency_name');
			$data['emergency_name'] = (count($emergency_name) == 0 ? " " : ($emergency_name[0]['key_value'] == "" ? "" : $emergency_name[0]['key_value']));
		$emergency_relationship = $this->mod->get_partners_personal($this->user->user_id, 'emergency_relationship');
			$data['emergency_relationship'] = (count($emergency_relationship) == 0 ? " " : ($emergency_relationship[0]['key_value'] == "" ? "" : $emergency_relationship[0]['key_value']));
		$emergency_phone = $this->mod->get_partners_personal($this->user->user_id, 'emergency_phone');
			$data['emergency_phone'] = (count($emergency_phone) == 0 ? "n/a" : ($emergency_phone[0]['key_value'] == "" ? "n/a" : $emergency_phone[0]['key_value']));
		$emergency_mobile = $this->mod->get_partners_personal($this->user->user_id, 'emergency_mobile');
			$data['emergency_mobile'] = (count($emergency_mobile) == 0 ? "n/a" : ($emergency_mobile[0]['key_value'] == "" ? "n/a" : $emergency_mobile[0]['key_value']));
		$emergency_address = $this->mod->get_partners_personal($this->user->user_id, 'emergency_address');
			$data['emergency_address'] = (count($emergency_address) == 0 ? " " : ($emergency_address[0]['key_value'] == "" ? "" : $emergency_address[0]['key_value']));
		$emergency_city = $this->mod->get_partners_personal($this->user->user_id, 'emergency_city');
			$data['emergency_city'] = (count($emergency_city) > 0 ? $this->mod->get_city($emergency_city[0]['key_value']) : " ");
		$emergency_country = $this->mod->get_partners_personal($this->user->user_id, 'emergency_country');
			$data['emergency_country'] = (count($emergency_country) > 0 ? $this->mod->get_country($emergency_country[0]['key_value']) : " ");
		$emergency_zip_code = $this->mod->get_partners_personal($this->user->user_id, 'emergency_zip_code');
			$data['emergency_zip_code'] = (count($emergency_zip_code) == 0 ? " " : ($emergency_zip_code[0]['key_value'] == "" ? "" : $emergency_zip_code[0]['key_value']));

		$drivers_license_no = $this->mod->get_partners_personal($this->user->user_id, 'drivers_license_no');
		$data['record']['drivers_license_no'] = get_valid_key_value($drivers_license_no);
		$passport_no = $this->mod->get_partners_personal($this->user->user_id, 'passport_no');
		$data['record']['passport_no'] = get_valid_key_value($passport_no);
        $taxcode = $this->mod->get_partners_personal($this->user->user_id, 'taxcode');
        $taxcode_result =  $this->mod->get_taxcode($taxcode);
        $data['record']['taxcode'] = ($taxcode_result == "" ? " " : ($taxcode_result['taxcode'] == "" ? "" : $taxcode_result['taxcode']));
		$tin_number = $this->mod->get_partners_personal($this->user->user_id, 'tin_number');
		$data['record']['tin_number'] = (count($tin_number) == 0 ? " " : ($tin_number[0]['key_value'] == "" ? "" : $tin_number[0]['key_value']));
		$sss_number = $this->mod->get_partners_personal($this->user->user_id, 'sss_number');
		$data['record']['sss_number'] = (count($sss_number) == 0 ? " " : ($sss_number[0]['key_value'] == "" ? "" : $sss_number[0]['key_value']));			
		$pagibig_number = $this->mod->get_partners_personal($this->user->user_id, 'pagibig_number');
		$data['record']['pagibig_number'] = (count($pagibig_number) == 0 ? " " : ($pagibig_number[0]['key_value'] == "" ? "" : $pagibig_number[0]['key_value']));
		$philhealth_number = $this->mod->get_partners_personal($this->user->user_id, 'philhealth_number');
		$data['record']['philhealth_number'] = (count($philhealth_number) == 0 ? " " : ($philhealth_number[0]['key_value'] == "" ? "" : $philhealth_number[0]['key_value']));
		$bank_number = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number');
		$data['record']['bank_number'] = (count($bank_number) == 0 ? " " : ($bank_number[0]['key_value'] == "" ? "" : $bank_number[0]['key_value']));
		$bank_account_name = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_name');
		$data['record']['bank_account_name'] = (count($bank_account_name) == 0 ? " " : ($bank_account_name[0]['key_value'] == "" ? "" : $bank_account_name[0]['key_value']));		

		$bank_account_number_savings = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_savings');
		$data['record']['bank_account_number_savings'] = (count($bank_account_number_savings) == 0 ? " " : ($bank_account_number_savings[0]['key_value'] == "" ? "" : $bank_account_number_savings[0]['key_value']));		
		$bank_account_number_current = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_current');
		$data['record']['bank_account_number_current'] = (count($bank_account_number_current) == 0 ? " " : ($bank_account_number_current[0]['key_value'] == "" ? "" : $bank_account_number_current[0]['key_value']));		
		$bank_number_savings = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_savings');
		$data['record']['bank_number_savings'] = (count($bank_number_savings) == 0 ? " " : ($bank_number_savings[0]['key_value'] == "" ? "" : $bank_number_savings[0]['key_value']));
		$bank_number_current = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_current');
		$data['record']['bank_number_current'] = (count($bank_number_current) == 0 ? " " : ($bank_number_current[0]['key_value'] == "" ? "" : $bank_number_current[0]['key_value']));		
		$payroll_bank_account_number = $this->mod->get_partners_personal($this->user->user_id, 'payroll_bank_account_number');
		$data['record']['payroll_bank_account_number'] = (count($payroll_bank_account_number) == 0 ? " " : ($payroll_bank_account_number[0]['key_value'] == "" ? "" : $payroll_bank_account_number[0]['key_value']));
		$payroll_bank_name = $this->mod->get_partners_personal($this->user->user_id, 'payroll_bank_name');
		$data['record']['payroll_bank_name'] = (count($payroll_bank_name) == 0 ? " " : ($payroll_bank_name[0]['key_value'] == "" ? "" : $payroll_bank_name[0]['key_value']));															
		$health_care = $this->mod->get_partners_personal($this->user->user_id, 'health_care');
		$data['record']['health_care'] = (count($health_care) == 0 ? " " : ($health_care[0]['key_value'] == "" ? "" : $health_care[0]['key_value']));
		$job_class = $this->mod->get_partners_personal($this->user->user_id, 'job_class');
		$data['record']['job_class'] = (count($job_class) == 0 ? " " : ($job_class[0]['key_value'] == "" ? "" : $job_class[0]['key_value']));
        $job_rank_level = $this->mod->get_partners_personal($this->user->user_id, 'job_rank_level');
        $data['record']['job_rank_level'] = (count($job_rank_level) == 0 ? " " : ($job_rank_level[0]['key_value'] == "" ? "" : $job_rank_level[0]['key_value']));
        $job_level = $this->mod->get_partners_personal($this->user->user_id, 'job_level');
        $data['record']['job_level'] = (count($job_level) == 0 ? " " : ($job_level[0]['key_value'] == "" ? "" : $job_level[0]['key_value']));
        $pay_level = $this->mod->get_partners_personal($this->user->user_id, 'pay_level');
        $data['record']['pay_level'] = (count($pay_level) == 0 ? " " : ($pay_level[0]['key_value'] == "" ? "" : $pay_level[0]['key_value']));
        $pay_set_rates = $this->mod->get_partners_personal($this->user->user_id, 'pay_set_rates');
        $data['record']['pay_set_rates'] = (count($pay_set_rates) == 0 ? " " : ($pay_set_rates[0]['key_value'] == "" ? "" : $pay_set_rates[0]['key_value']));
        $competency_level = $this->mod->get_partners_personal($this->user->user_id, 'competency_level');
        $data['record']['competency_level'] = (count($competency_level) == 0 ? " " : ($competency_level[0]['key_value'] == "" ? "" : $competency_level[0]['key_value']));



        $employee_grade = $this->mod->get_partners_personal($this->user->user_id, 'employee_grade');
		$data['record']['employee_grade'] = (count($employee_grade) == 0 ? " " : ($employee_grade[0]['key_value'] == "" ? "" : $employee_grade[0]['key_value']));
		
		$section = $this->mod->get_partners_personal($this->user->user_id, 'section');
		$data['record']['section'] = (count($section) == 0 ? " " : ($section[0]['key_value'] == "" ? "" : $section[0]['key_value']));

		/***** PERSONAL TAB *****/
		//Personal
		$gender = $this->mod->get_partners_personal($this->user->user_id, 'gender');
			$data['gender'] = (count($gender) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $gender[0]['key_value']));
		$birth_place = $this->mod->get_partners_personal($this->user->user_id, 'birth_place');
			$data['birth_place'] = (count($birth_place) == 0 ? " " : ($birth_place[0]['key_value'] == "" ? "" : $birth_place[0]['key_value']));
		$religion = $this->mod->get_partners_personal($this->user->user_id, 'religion');
			$data['religion'] = (count($religion) == 0 ? " " : ($religion[0]['key_value'] == "" ? "" : $this->mod->get_religion($religion[0]['key_value'])));
		$nationality = $this->mod->get_partners_personal($this->user->user_id, 'nationality');
			$data['nationality'] = (count($nationality) == 0 ? " " : ($nationality[0]['key_value'] == "" ? "" : $nationality[0]['key_value']));
		$marriage_date = $this->mod->get_partners_personal($this->user->user_id, 'marriage_date');
		$data['marriage_date'] = (count($marriage_date) > 0 ? $marriage_date[0]['key_value'] : " ");			
		//Other Information
		$height = $this->mod->get_partners_personal($this->user->user_id, 'height');
			$data['height'] = (count($height) == 0 ? " " : ($height[0]['key_value'] == "" ? "" : $height[0]['key_value']));
		$weight = $this->mod->get_partners_personal($this->user->user_id, 'weight');
			$data['weight'] = (count($weight) == 0 ? " " : ($weight[0]['key_value'] == "" ? "" : $weight[0]['key_value']));
		$interests_hobbies = $this->mod->get_partners_personal($this->user->user_id, 'interests_hobbies');
		$blood_type = $this->mod->get_partners_personal($this->user->user_id, 'blood_type');
		$data['blood_type'] = (count($blood_type) > 0 ? $blood_type[0]['key_value'] : " ");			
			$data['interests_hobbies'] = (count($interests_hobbies) == 0 ? " " : ($interests_hobbies[0]['key_value'] == "" ? "" : $interests_hobbies[0]['key_value']));
		$language = $this->mod->get_partners_personal($this->user->user_id, 'language');
			$data['language'] = (count($language) == 0 ? " " : ($language[0]['key_value'] == "" ? "" : $language[0]['key_value']));
		$dialect = $this->mod->get_partners_personal($this->user->user_id, 'dialect');
			$data['dialect'] = (count($dialect) == 0 ? " " : ($dialect[0]['key_value'] == "" ? "" : $dialect[0]['key_value']));

		$dependents_result = $this->mod->get_partners_personal_history($this->user->user_id, 'family');

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

		/***** Header Details *****/
		$data['profile_live_in'] = $city_town;
		$countries = $this->mod->get_partners_personal($this->user->user_id, 'country');
		$data['profile_country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $this->mod->get_country($countries[0]['key_value'])));
		$telephones = array();
		$phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'phone');
			foreach($phone_numbers as $phone){
				$telephones[] = $phone['key_value'];
			}
			$data['profile_telephones'] = $telephones;
		$fax = array();
		$fax_numbers = $this->mod->get_partners_personal($this->user->user_id, 'fax');
			foreach($fax_numbers as $fax_no){
				$fax[] = $fax_no['key_value'];
			}
			$data['profile_fax'] = $fax;
		$mobiles = array();
		$mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'mobile');
			foreach($mobile_numbers as $mobile){
				$mobiles[] = $mobile['key_value'];
			}
			$data['profile_mobiles'] = $mobiles;
		$civil_status = $this->mod->get_partners_personal($this->user->user_id, 'civil_status');
			$data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));

		$family_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'family');
		
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

		$solo_parent = $this->mod->get_partners_personal($this->user->user_id, 'solo_parent');
		$data['personal_solo_parent'] = (count($solo_parent) == 0 ? " " : ($solo_parent[0]['key_value'] == 0 ? "No" : "Yes"));
		/***** HISTORY TAB *****/
		//Education
		$education_tab = array();
		$educational_tab = array();
		$education_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'education');
			foreach($education_tab as $educ){
				if ($educ['key'] == 'education-school') {
					$educational_tab[$educ['sequence']][$educ['key']] = $this->mod->get_school($educ['key_value']);
				} elseif ($educ['key'] == 'education-degree') {
					$educational_tab[$educ['sequence']][$educ['key']] = $this->mod->get_degree_obtained($educ['key_value']);
				} else
					$educational_tab[$educ['sequence']][$educ['key']] = $educ['key_value'];				
			}
			$data['education_tab'] = $educational_tab;
		//Employment
		$employment_tab = array();
		$employments_tab = array();
		$employment_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'employment');
			foreach($employment_tab as $emp){
				$employments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['employment_tab'] = $employments_tab;
		//Character Reference
		$reference_tab = array();
		$references_tab = array();
		$reference_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'reference');
			foreach($reference_tab as $emp){
				if ($emp['key'] == 'reference-city') {
					$references_tab[$emp['sequence']][$emp['key']] = $this->mod->get_city($emp['key_value']);
				}
				elseif ($emp['key'] == 'reference-country') {
					$references_tab[$emp['sequence']][$emp['key']] = $this->mod->get_country($emp['key_value']);
				}
				else
					$references_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];

			}
			$data['reference_tab'] = $references_tab;
		//Licensure
		$licensure_tab = array();
		$licensures_tab = array();
		$details_data_id = array();
		$licensure_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'licensure');
			foreach($licensure_tab as $emp){
				$licensures_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
				$details_data_id[$emp['sequence']][$emp['key']] = $emp['personal_id'];
			}
			$data['licensure_tab'] = $licensures_tab;
			$data['details_data_id'] = $details_data_id;
		//Trainings and Seminars
		$training_tab = array();
		$trainings_tab = array();
		$training_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'training');
			foreach($training_tab as $emp){
				$trainings_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['training_tab'] = $trainings_tab;
		//Test Profile
		$test_profile_tab = array();
		$test_profiles_tab = array();
		$test_profile_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'test');
		foreach($test_profile_tab as $emp){
			$test_profiles_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['test_profile_tab'] = $test_profiles_tab;			
		//Cost Center
		$cost_center_tab = array();
		$cost_centers_tab = array();
		$cost_center_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'cost_center');

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
		$skill_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'skill');
			foreach($skill_tab as $emp){
				$skills_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['skill_tab'] = $skills_tab;
		//medical records
		$medical_tab = array();
		$medicals_tab = array();
		$medical_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'medical');
		foreach($medical_tab as $emp){
			if ($emp['key'] == 'medical-exam-type') {
				$medicals_tab[$emp['sequence']][$emp['key']] = $this->mod->get_medical_exam_type($emp['key_value']);
			} else
				$medicals_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['medical_tab'] = $medicals_tab;				
		//Affiliation
		$affiliation_tab = array();
		$affiliations_tab = array();
		$affiliation_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'affiliation');
			foreach($affiliation_tab as $emp){
				$affiliations_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['affiliation_tab'] = $affiliations_tab;
		//Accountabilities
		$accountabilities_tab = array();
		$accountable_tab = array();
		$accountabilities_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'accountabilities');
			foreach($accountabilities_tab as $emp){
				$accountable_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['accountabilities_tab'] = $accountable_tab;
		//Attachments
		$attachment_tab = array();
		$attachments_tab = array();
		$attachment_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'attachment');
			foreach($attachment_tab as $emp){
				$attachments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['attachment_tab'] = $attachments_tab;
		//Family
		$family_tab = array();
		$families_tab = array();
		$family_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'family');
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

		$old_id_number = $this->mod->get_partners_personal($this->user->user_id, 'old_id_number');
		$data['old_id_number'] = (count($old_id_number) == 0 ? " " : ($old_id_number[0]['key_value'] == "" ? "" : $old_id_number[0]['key_value']));
		
		$with_parking = $this->mod->get_partners_personal($this->user->user_id, 'with_parking');
		$data['with_parking'] = (count($with_parking) == 0 ? " " : ($with_parking[0]['key_value'] == 0 ? "No" : "Yes"));

		//Movements
		$movements_tab = array();
		$movement_qry = " SELECT  pma.action_id, pma.movement_id, pma.type_id,
							pma.effectivity_date, pma.type, pmc.cause, pma.created_on, pm.remarks
						FROM {$this->db->dbprefix}partners_movement_action pma
						INNER JOIN {$this->db->dbprefix}partners_movement pm 
							ON pma.movement_id = pm.movement_id
						INNER JOIN {$this->db->dbprefix}partners_movement_cause pmc 
							ON pm.due_to_id = pmc.cause_id 
						WHERE pma.status_id = 8 
						AND pma.user_id = {$this->user->user_id}";
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
						WHERE pi.involved_partners IN ({$this->user->user_id})";
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
						WHERE ppr.user_id = {$this->user->user_id}";
		$cr_sql = $this->db->query($cr_qry);

		if($cr_sql && $cr_sql->num_rows() > 0){
			$cr_tab = $cr_sql->result_array();
		}
		$data['cr_tab'] = $cr_tab;

		$key_sql = "SELECT * FROM {$this->db->dbprefix}partners_key pk 
					LEFT JOIN {$this->db->dbprefix}partners_key_class pkc 
					ON pk.key_class_id = pkc.key_class_id 
					WHERE pk.deleted = 0 AND pkc.user_view = 1 ";
		$key_qry = $this->db->query($key_sql);

		if ($key_qry->num_rows() > 0) {
			$partners_keys = $key_qry->result_array();
			foreach($partners_keys as $keys){
				$data['partners_keys'][] = $keys['key_code'];
				$data['partners_labels'][$keys['key_code']] = $keys['key_label'];
			}
		}

		//specific indo requirement
		if ($this->db->database == 'workwise.indo') {
			$this->mod->long_name = lang('my201.my201_indo');
			// $data['partners_labels'][$keys['employment_type_id']] = 'Grade';
		}
			
        $this->load->helper('file');
		$this->load->vars($data);

		if( $this->input->post('mobileapp') )
		{
			ob_start();
            echo $this->load->blade('201_mobile')->with( $this->load->get_cached_vars() );
            $this->response->my201 = ob_get_clean();
            $this->response->message[] = array(
                'message' => '',
                'type' => 'success'
            );
            $this->_ajax_return();
		}
		else
			echo $this->load->blade('record_listing_custom')->with( $this->load->get_cached_vars() );
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

	function format_phone($phone){
	    $phone = preg_replace("/[^0-9]/", "", $phone);

	    if(strlen($phone) == 7)
	        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
	    elseif(strlen($phone) == 11)
	        return preg_replace("/([0-9]{4})([0-9]{4})([0-9]{3})/", "$1-$2-$3", $phone);
	    else
	        return $phone;
	}

	function view_personal_details(){
        $this->_ajax_only();

		//Attachments
		$details = array();
		$details_data = array();
		$details_data_id = array();
		$details = $this->mod->get_partners_personal_list_details($this->user->user_id, $this->input->post('key_class'), $this->input->post('sequence'));
			foreach($details as $detail){
				$details_data[$detail['key']] = $detail['key_value'];
				$details_data_id[$detail['key']] = $detail['personal_id'];
			}
			$data['details'] = $details_data;
			$data['details_data_id'] = $details_data_id;

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
		$image_details = $this->mod->get_partners_personal_image_details($this->user->user_id, $personal_id);
		$path = base_url() . $image_details['key_value'];
		header('Content-disposition: attachment; filename='.substr( $image_details['key_value'], strrpos( $image_details['key_value'], '/' )+1 ).'');
		header('Content-type: txt/pdf');
		readfile($path);
	}

	function cr_form()
	{
		$this->_ajax_only();

		$this->load->helper('form');
		
		$key_classes = $this->mod->get_user_editable_key_classes();
		$partner_id = get_partner_id( $this->user->user_id );
		$data['key_classes'] = array();
		foreach( $key_classes as $row )
		{
			//check wether key_class has active request
			if( !$this->mod->has_active_request( $row->key_class_id, $this->user->user_id ) ) {
				switch ($row->key_class_code) {
					case 'email':
						$row->key_class = 'Office Email';
						break;
					case 'phone':
						$row->key_class = 'Office Phone';
						break;
					case 'mobile':
						$row->key_class = 'Office Mobile';
						break;
					case 'personal_email':
						$row->key_class = 'Personal Email';
						break;						
					case 'personal_phone':
						$row->key_class = 'Personal Phone';
						break;
					case 'personal_mobile':
						$row->key_class = 'Personal Mobile';
						break;						
				}
				$data['key_classes'][$row->key_class_id] = $row->key_class;
			}
		}

		asort($data['key_classes']);

		$drafts = $this->mod->get_user_editable_keys_draft( $this->user->user_id );
		$draft = array();
		foreach( $drafts as $row )
		{
			$draft[$row->key_class_id][$row->key_id] = $row; 
		}

		$data['draft'] = '';
		foreach( $draft as $key_class_id => $keys )
		{
			$temp = array();
			foreach ($keys as $key_id => $key) {
				$temp[] = $this->mod->create_key_draft( $key, $key->key_value );
			}
			$temp = implode('', $temp);

			$data['draft'] .= $this->load->view('draft', array('key_class_id' => $key_class_id,'keys' => $temp), true);
		}

		$this->load->vars($data);

		$data = array();
		$data['title'] = 'Change Request';
		$data['content'] = $this->load->blade('cr_form')->with( $this->load->get_cached_vars() );
		$this->response->cr_form = $this->load->view('templates/modal', $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	function add_class_draft()
	{
		$this->_ajax_only();

		$key_class_id = $this->input->post('key_class_id');

		$keys = $this->mod->get_user_editable_keys( $key_class_id );
		$temp = array();
		foreach( $keys as $key )
		{
			$temp[] = $this->mod->create_key_draft( $key, '' );	
		}
		$temp = implode('', $temp);

		$this->response->class_draft = $this->load->view('draft', array('key_class_id' => $key_class_id, 'keys' => $temp), true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);
		$this->_ajax_return();
	}

	function save_request()
	{
		$this->_ajax_only();

		$status = $this->input->post('status');
		$classes = $this->input->post('key');
		$remarks = $this->input->post('remarks');
		$partner_id = get_partner_id( $this->user->user_id );

		foreach( $classes as $class_id => $keys )
		{
			$ctr = 1;

			$personal_request_header_info = array(
													'user_id' => $this->user->user_id,
													'key_class_id' => $class_id,
													'sequence' => $ctr,
													'status' => $status,
													'remarks' => $remarks[$class_id]
												);

			$this->db->insert('partners_personal_request_header', $personal_request_header_info);
			$personal_request_header_id = $this->db->insert_id();

			$populate_personal_qry = "CALL sp_partners_personal_populate_approvers({$personal_request_header_id}, {$this->user->user_id})";
			$result_insert_update = $this->db->query( $populate_personal_qry );
			mysqli_next_result($this->db->conn_id);

			$active = $this->mod->has_active_request( $class_id, $this->user->user_id );

			foreach($keys as $key_id => $value)
			{
				$where = $data = array(
					'user_id' => $this->user->user_id,
					'key_id' => $key_id,
				);

				$data['personal_request_header_id'] = $personal_request_header_id;
				$data['sequence'] = $ctr;
				$data['key_value'] = $value;
				$data['status'] = $status;
				$data['created_by'] = $this->user->user_id;
				$data['remarks'] = $remarks[$class_id];

				$check_on_personal = $this->db->get_where('partners_personal', array('partner_id' => $partner_id, 'key_id' => $key_id));

				if ($check_on_personal && $check_on_personal->num_rows() > 0) {
					$personal_data = $check_on_personal->row_array();
					$data['from_key_value'] = $personal_data['key_value'];
				}					

				$previous_main_data = array();
				
				if($active)
				{
					$this->db->update('partners_personal_request', $data, $where);
					$action = 'update';

					$previous_main_data = $this->db->get_where('partners_personal_request', $where)->row_array();					

					$personal_id = $previous_main_data['personal_id'];
				}
				else{
					$this->db->insert('partners_personal_request', $data);

					$personal_id =  $this->db->insert_id();

					$action = 'insert';

					//$personal_request_approver = $this->db->query("CALL sp_partners_personal_populate_approvers({$this->db->insert_id()}, ".$this->user->user_id.")");					
				}

				$ctr++;

		        //create system logs
		        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'partners_personal_request', $previous_main_data, $data);								
			}
			// INSERT NOTIFICATIONS FOR APPROVERS
			$this->response->notified = $this->mod->notify_approvers( $personal_request_header_id, $personal_request_header_info);
			//$this->response->notified = $this->mod->notify_filer( $this->user->user_id, $data, $personal_id );		        			
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}		

	function get_public_data() {
		$this->_ajax_only();

		$result = array();
		$value = trim(strtolower($_GET['term']));
		$column = $_GET['column'];

		switch($column){
			case 'countries';
			$field = 'short_name';
				$this->db->select($field)
			    ->from('countries')
			    ->where("LOWER({$field}) LIKE '%{$value}%'");
			    $result = $this->db->get('');	
		    break;
			case 'cities';
			$field = 'city';
				$this->db->select($field)
			    ->from('cities')
			    ->where("LOWER({$field}) LIKE '%{$value}%'");
			    $result = $this->db->get('');	
		    break;
		}
		
		$data = array();
		if($result->num_rows() > 0){
				
			foreach($result->result_array() as $row){
				$row['label'] = trim($row[$field]);
				$data[] = $row;
			}			
		}			
		$result->free_result();

		header('Content-type: application/json');
		echo json_encode($data);
		die();
	}	

    function check_mobile($phoneNum=0, $user_id=0){ 	
		$mobileNumber = trim(str_replace(' ', '', $phoneNum));
		$mobileNumber =  str_replace('-', '', $mobileNumber);

		if(!empty($mobileNumber)){
			$country_qry = "SELECT cs.* FROM {$this->db->dbprefix}users_profile up
							INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id 
							INNER JOIN {$this->db->dbprefix}countries cs ON uc.country_id = cs.country_id
							WHERE up.user_id = {$user_id}";
			$country_sql = $this->db->query($country_qry)->row_array();
			$countries = $country_sql;

			if ((substr($mobileNumber,0,1) != 0) && strlen($mobileNumber) < 11){
				$mobileNumber = '0'.$mobileNumber;
			}
			$pregs = '/(0|\+?\d{2})(\d{';
			$pregs .= ($countries['mobile_count']-1).',';
			$pregs .= $countries['mobile_count'].'})/';

			$output = preg_replace( $pregs, '0$2', $mobileNumber);

			preg_match( $pregs, $mobileNumber, $matches);

			if(isset($matches[1]) && isset($matches[2])){
				$mobile_prefix = substr($matches[2], 0, 2);
				if($matches[2] != $output || $mobile_prefix == 00){
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}

		return '+'.$countries['calling_code'].$matches[2];
    }

    function check_phone($phoneNum=0, $user_id=0){
		$mobileNumber = trim(str_replace(' ', '', $phoneNum));
		$mobileNumber =  str_replace('-', '', $mobileNumber);

		if(!empty($mobileNumber)){
			$country_qry = "SELECT cs.* FROM {$this->db->dbprefix}users_profile up
							INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id 
							INNER JOIN {$this->db->dbprefix}countries cs ON uc.country_id = cs.country_id
							WHERE up.user_id = {$user_id}";
			$country_sql = $this->db->query($country_qry)->row_array();
			$countries = $country_sql;

			if ((substr($mobileNumber,0,1) != 0) && strlen($mobileNumber) < 9){
				$mobileNumber = '0'.$mobileNumber;
			}
			$pregs = '/(0|\+?\d{2})(\d{';
			$pregs .= ($countries['phone_count']-1).',';
			$pregs .= $countries['phone_count'].'})/';

			$output = preg_replace( $pregs, '0$2', $mobileNumber);
			preg_match( $pregs, $mobileNumber, $matches);

			if(isset($matches[1]) && isset($matches[2])){
				$mobile_prefix = substr($matches[2], 0, 2);
				if('0'.$matches[2] != $output || $mobile_prefix == 00){
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}

		return '+'.$countries['calling_code'].$matches[2];
    }

    function get_partnerskey($key_code=''){    	
		$partners_key = $this->db->get_where('partners_key', array('deleted' => 0, 'key_code' => $key_code));
    	if($partners_key->num_rows() > 0){
    		return $partners_key->row_array();
    	}
    	return array();
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

	function edit( $record_id = "", $child_call = false )
	{

		$record_id = $data['record_id'] = $this->user->user_id;
		$profile_header_details = $this->mod->get_profile_header_details($this->user->user_id);
		$middle_initial = empty($profile_header_details['middlename']) ? " " : " ".ucfirst(substr($profile_header_details['middlename'],0,1)).". ";
		$data['profile_name'] = $profile_header_details['firstname'].$middle_initial.$profile_header_details['lastname'].'&nbsp;'.$profile_header_details['suffix'];

		// $department = empty($profile_header_details['department']) ? "" : " on ".ucwords(strtolower($profile_header_details['department']));
		// $data['profile_position'] = ucwords(strtolower($profile_header_details['position']));
		$department = empty($profile_header_details['department']) ? "" : " on ".$profile_header_details['department'];
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
		$data['role_id'] = $profile_header_details['role_id'] == "" ? "n/a" : $profile_header_details['role_id'];
		$data['job_grade'] = $profile_header_details['job_grade'] == "" ? "n/a" : $profile_header_details['job_grade'];
		$data['sbu_unit_id'] = $profile_header_details['sbu_unit_id'] == "" ? "n/a" : $profile_header_details['sbu_unit_id'];
		$data['sbu_unit'] = $profile_header_details['sbu_unit'] == "" ? "n/a" : $profile_header_details['sbu_unit'];
		$data['sbu_unit_details'] = $profile_header_details['sbu_unit_details'] == "" ? "n/a" : $profile_header_details['sbu_unit_details'];

		$data['project_id'] = $profile_header_details['project_id'] == "" ? "n/a" : $profile_header_details['project_id'];
		$data['start_date'] = $profile_header_details['start_date'] == "" ? "" : $profile_header_details['start_date'];
		$data['end_date'] = $profile_header_details['end_date'] == "" ? "" : $profile_header_details['end_date'];
		$data['coordinator_id'] = $profile_header_details['coordinator_id'] == "" ? "" : $profile_header_details['coordinator_id'];
		$data['old_new'] = $profile_header_details['old_new'] == "" ? "n/a" : $profile_header_details['old_new'];
		$data['biometric'] = $profile_header_details['biometric'] == "" ? "n/a" : $profile_header_details['biometric'];
		$data['shift'] = $profile_header_details['shift'] == "" ? "n/a" : $profile_header_details['shift'];
		$data['regularization_date'] = $profile_header_details['regularization_date'] == "" ? "" : date("F d, Y", strtotime($profile_header_details['regularization_date']));
		//Employment Information
		$data['status'] = $profile_header_details['employment_status'] == "" ? "n/a" : $profile_header_details['employment_status'];
		$data['type'] = $profile_header_details['employment_type'] == "" ? "n/a" : $profile_header_details['employment_type'];
		
		$job_class = $this->mod->get_partners_personal($this->user->user_id, 'job_class');
			$data['job_class'] = (count($job_class) == 0 ? "n/a" : ($job_class[0]['key_value'] == "" ? "n/a" : $job_class[0]['key_value']));
		
		$employee_grade = $this->mod->get_partners_personal($this->user->user_id, 'employee_grade');
		$data['record']['employee_grade'] = (count($employee_grade) == 0 ? " " : ($employee_grade[0]['key_value'] == "" ? "" : $employee_grade[0]['key_value']));
		$job_rank_level = $this->mod->get_partners_personal($this->user->user_id, 'job_rank_level');
        $data['record']['job_rank_level'] = (count($job_rank_level) == 0 ? " " : ($job_rank_level[0]['key_value'] == "" ? "" : $job_rank_level[0]['key_value']));	
        $job_level = $this->mod->get_partners_personal($this->user->user_id, 'job_level');
        $data['record']['job_level'] = (count($job_level) == 0 ? " " : ($job_level[0]['key_value'] == "" ? "" : $job_level[0]['key_value']));   
		$pay_level = $this->mod->get_partners_personal($this->user->user_id, 'pay_level');
        $data['record']['pay_level'] = (count($pay_level) == 0 ? " " : ($pay_level[0]['key_value'] == "" ? "" : $pay_level[0]['key_value']));
        $pay_set_rates = $this->mod->get_partners_personal($this->user->user_id, 'pay_set_rates');
        $data['record']['pay_set_rates'] = (count($pay_set_rates) == 0 ? " " : ($pay_set_rates[0]['key_value'] == "" ? "" : $pay_set_rates[0]['key_value']));   
        $competency_level = $this->mod->get_partners_personal($this->user->user_id, 'competency_level');
        $data['record']['competency_level'] = (count($competency_level) == 0 ? " " : ($competency_level[0]['key_value'] == "" ? "" : $competency_level[0]['key_value']));  

		$data['date_hired'] = ($profile_header_details['effectivity_date'] == "" ? "" : (date("F d, Y", strtotime($profile_header_details['effectivity_date']))));
		$probationary_date = $this->mod->get_partners_personal($this->user->user_id, 'probationary_date');
			$data['probationary_date'] = (count($probationary_date) == 0 ? "" : ($probationary_date[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($probationary_date[0]['key_value']))));
		$original_date_hired = $this->mod->get_partners_personal($this->user->user_id, 'original_date_hired');
			$data['original_date_hired'] = (count($original_date_hired) == 0 ? "" : ($original_date_hired[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($original_date_hired[0]['key_value']))));
		$last_probationary = $this->mod->get_partners_personal($this->user->user_id, 'last_probationary');
			$data['last_probationary'] = (count($last_probationary) == 0 ? "" : ($last_probationary[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_probationary[0]['key_value']))));
		$last_salary_adjustment = $this->mod->get_partners_personal($this->user->user_id, 'last_salary_adjustment');
			$data['last_salary_adjustment'] = (count($last_salary_adjustment) == 0 ? "n/a" : ($last_salary_adjustment[0]['key_value'] == "" ? "n/a" : date("F d, Y", strtotime($last_salary_adjustment[0]['key_value']))));
		//Work Assignment
		$reports_to = ($profile_header_details['immediate'] == "" ? "n/a" : ($this->mod->get_user_details($profile_header_details['immediate'])));
		if($reports_to == "n/a"){
			$data['reports_to'] = $reports_to;
		}
		else{
			if(!empty($reports_to)) {
				$reports_to_MI = (empty($reports_to['middlename']) ? " " : " ".ucfirst(substr($reports_to['middlename'],0,1)).". ");
				$data['reports_to'] = $reports_to['firstname'].$reports_to_MI.$reports_to['lastname'];
			}else{
				$data['reports_to'] = '';
			}
		}
		$organization = $this->mod->get_partners_personal($this->user->user_id, 'organization');
		$data['organization'] = (count($organization) == 0 ? "n/a" : ($organization[0]['key_value'] == "" ? "n/a" : $organization[0]['key_value']));
		$agency_assignment = $this->mod->get_partners_personal($this->user->user_id, 'agency_assignment');
        $data['agency_assignment'] = (count($agency_assignment) == 0 ? "n/a" : ($agency_assignment[0]['key_value'] == "" ? "n/a" : $agency_assignment[0]['key_value']));

        $data['division'] = ($profile_header_details['division'] == "" ? "n/a" : $profile_header_details['division']);
		$data['department'] = ($profile_header_details['department'] == "" ? "n/a" : $profile_header_details['department']);
		$data['group'] = ($profile_header_details['group'] == "" ? "n/a" : $profile_header_details['group']);

		/***** CONTACTS TAB *****/
		//Personal Contact
		$city_town = $this->mod->get_partners_personal($this->user->user_id, 'city_town');
		$data['city'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
		$data['profile_live_in'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $this->mod->get_city($city_town[0]['key_value'])));;

		$country = $this->mod->get_partners_personal($this->user->user_id, 'country');
		$data['country'] = (count($country) > 0 ? $this->mod->get_country($country[0]['key_value']) : " ");		
		$data['profile_country'] = (count($country) == 0 ? " " : ($country[0]['key_value'] == "" ? "" : $this->mod->get_country($country[0]['key_value'])));

		$permanent_address = $this->mod->get_partners_personal($this->user->user_id, 'permanent_address');
		$data['permanent_address'] = $permanent_address = (count($permanent_address) == 0 ? " " : ($permanent_address[0]['key_value'] == "" ? "" : $permanent_address[0]['key_value']));
		$permanent_city_town = $this->mod->get_partners_personal($this->user->user_id, 'permanent_city_town');
		$data['permanent_city_town'] = $permanent_city_town = (count($permanent_city_town) == 0 ? " " : ($permanent_city_town[0]['key_value'] == "" ? "" : $this->mod->get_city($permanent_city_town[0]['key_value'])));
		$permanent_country = $this->mod->get_partners_personal($this->user->user_id, 'permanent_country');
		$data['permanent_country'] = $permanent_country = (count($permanent_country) == 0 ? " " : ($permanent_country[0]['key_value'] == "" ? "" : $this->mod->get_country($permanent_country[0]['key_value'])));			
		$permanent_zipcode = $this->mod->get_partners_personal($this->user->user_id, 'permanent_zipcode');
		$data['permanent_zipcode'] = $permanent_zipcode = (count($permanent_zipcode) == 0 ? " " : ($permanent_zipcode[0]['key_value'] == "" ? "" : $permanent_zipcode[0]['key_value']));						
		$phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'phone');
		$data['office_telephones'] = $phone_numbers = (count($phone_numbers) == 0 ? " " : ($phone_numbers[0]['key_value'] == "" ? "" : $phone_numbers[0]['key_value']));
		$mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'mobile');
		$data['office_mobiles'] = $mobile_numbers = (count($mobile_numbers) == 0 ? " " : ($mobile_numbers[0]['key_value'] == "" ? "" : $mobile_numbers[0]['key_value']));
		$personal_phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'personal_phone');
		$data['personal_telephone'] = $personal_phone_numbers = (count($personal_phone_numbers) == 0 ? " " : ($personal_phone_numbers[0]['key_value'] == "" ? "" : $personal_phone_numbers[0]['key_value']));
		$personal_mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'personal_mobile');
		$data['personal_mobile'] = $personal_mobile_numbers = (count($personal_mobile_numbers) == 0 ? " " : ($personal_mobile_numbers[0]['key_value'] == "" ? "" : $personal_mobile_numbers[0]['key_value']));
		$personal_email = $this->mod->get_partners_personal($this->user->user_id, 'personal_email');
		$data['personal_email'] = $personal_email = (count($personal_email) == 0 ? " " : ($personal_email[0]['key_value'] == "" ? "" : $personal_email[0]['key_value']));

		$address_1 = $this->mod->get_partners_personal($this->user->user_id, 'address_1');
		$address_1 = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
		$address_2 = $this->mod->get_partners_personal($this->user->user_id, 'address_2');
		$address_2 = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));

		$data['complete_address'] = $address_1." ".$address_2;		
		$data['address_1'] = $address_1;	
		$data['address_2'] = $address_2;			
		$zip_code = $this->mod->get_partners_personal($this->user->user_id, 'zip_code');
		$data['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));

		$permanent_address = $this->mod->get_partners_personal($this->user->user_id, 'permanent_address');
		$data['permanent_address'] = $permanent_address = (count($permanent_address) == 0 ? " " : ($permanent_address[0]['key_value'] == "" ? "" : $permanent_address[0]['key_value']));
		$permanent_city_town = $this->mod->get_partners_personal($this->user->user_id, 'permanent_city_town');
		$data['permanent_city_town'] = $permanent_city_town = (count($permanent_city_town) == 0 ? " " : ($permanent_city_town[0]['key_value'] == "" ? "" : $permanent_city_town[0]['key_value']));
		$permanent_country = $this->mod->get_partners_personal($this->user->user_id, 'permanent_country');
		$data['permanent_country'] = $permanent_country = (count($permanent_country) == 0 ? " " : ($permanent_country[0]['key_value'] == "" ? "" : $permanent_country[0]['key_value']));			
		$permanent_zipcode = $this->mod->get_partners_personal($this->user->user_id, 'permanent_zipcode');
		$data['permanent_zipcode'] = $permanent_zipcode = (count($permanent_zipcode) == 0 ? " " : ($permanent_zipcode[0]['key_value'] == "" ? "" : $permanent_zipcode[0]['key_value']));						

		//Emergency Contact
		$emergency_name = $this->mod->get_partners_personal($this->user->user_id, 'emergency_name');
			$data['emergency_name'] = (count($emergency_name) == 0 ? " " : ($emergency_name[0]['key_value'] == "" ? "" : $emergency_name[0]['key_value']));
		$emergency_relationship = $this->mod->get_partners_personal($this->user->user_id, 'emergency_relationship');
			$data['emergency_relationship'] = (count($emergency_relationship) == 0 ? " " : ($emergency_relationship[0]['key_value'] == "" ? "" : $emergency_relationship[0]['key_value']));
		$emergency_phone = $this->mod->get_partners_personal($this->user->user_id, 'emergency_phone');
			$data['emergency_phone'] = (count($emergency_phone) == 0 ? "" : ($emergency_phone[0]['key_value'] == "" ? "n/a" : $emergency_phone[0]['key_value']));
		$emergency_mobile = $this->mod->get_partners_personal($this->user->user_id, 'emergency_mobile');
			$data['emergency_mobile'] = (count($emergency_mobile) == 0 ? "n/a" : ($emergency_mobile[0]['key_value'] == "" ? "n/a" : $emergency_mobile[0]['key_value']));
		$emergency_address = $this->mod->get_partners_personal($this->user->user_id, 'emergency_address');
			$data['emergency_address'] = (count($emergency_address) == 0 ? " " : ($emergency_address[0]['key_value'] == "" ? "" : $emergency_address[0]['key_value']));
		$emergency_city = $this->mod->get_partners_personal($this->user->user_id, 'emergency_city');
			$data['emergency_city'] = (count($emergency_city) == 0 ? " " : ($emergency_city[0]['key_value'] == "" ? "" : $emergency_city[0]['key_value']));
		$emergency_country = $this->mod->get_partners_personal($this->user->user_id, 'emergency_country');
			$data['emergency_country'] = (count($emergency_country) == 0 ? " " : ($emergency_country[0]['key_value'] == "" ? "" : $emergency_country[0]['key_value']));
		$emergency_zip_code = $this->mod->get_partners_personal($this->user->user_id, 'emergency_zip_code');
			$data['emergency_zip_code'] = (count($emergency_zip_code) == 0 ? " " : ($emergency_zip_code[0]['key_value'] == "" ? "" : $emergency_zip_code[0]['key_value']));

        $taxcode = $this->mod->get_partners_personal($this->user->user_id, 'taxcode');
         $data['record']['taxcode_id'] = (count($taxcode) == 0 ? " " : ($taxcode[0]['key_value'] == "" ? "" : $taxcode[0]['key_value']));
        $taxcode_result =  $this->mod->get_taxcode($taxcode);
        $data['record']['taxcode'] = ($taxcode_result == "" ? " " : ($taxcode_result['taxcode'] == "" ? "" : $taxcode_result['taxcode']));

		$drivers_license_no = $this->mod->get_partners_personal($this->user->user_id, 'drivers_license_no');
		$data['record']['drivers_license_no'] = get_valid_key_value($drivers_license_no);
		$passport_no = $this->mod->get_partners_personal($this->user->user_id, 'passport_no');
		$data['record']['passport_no'] = get_valid_key_value($passport_no);			
        $taxcode = $this->mod->get_partners_personal($this->user->user_id, 'taxcode');
        $data['record']['taxcode'] = (count($taxcode) == 0 ? " " : ($taxcode[0]['key_value'] == "" ? "" : $taxcode[0]['key_value']));                        
		$tin_number = $this->mod->get_partners_personal($this->user->user_id, 'tin_number');
		$data['record']['tin_number'] = (count($tin_number) == 0 ? " " : ($tin_number[0]['key_value'] == "" ? "" : $tin_number[0]['key_value']));
		$sss_number = $this->mod->get_partners_personal($this->user->user_id, 'sss_number');
		$data['record']['sss_number'] = (count($sss_number) == 0 ? " " : ($sss_number[0]['key_value'] == "" ? "" : $sss_number[0]['key_value']));			
		$pagibig_number = $this->mod->get_partners_personal($this->user->user_id, 'pagibig_number');
		$data['record']['pagibig_number'] = (count($pagibig_number) == 0 ? " " : ($pagibig_number[0]['key_value'] == "" ? "" : $pagibig_number[0]['key_value']));
		$philhealth_number = $this->mod->get_partners_personal($this->user->user_id, 'philhealth_number');
		$data['record']['philhealth_number'] = (count($philhealth_number) == 0 ? " " : ($philhealth_number[0]['key_value'] == "" ? "" : $philhealth_number[0]['key_value']));
		$bank_number = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number');
		$bank_number_savings = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_savings');
		$data['record']['bank_number_savings'] = (count($bank_number_savings) == 0 ? " " : ($bank_number_savings[0]['key_value'] == "" ? "" : $bank_number_savings[0]['key_value']));
		$bank_number_current = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_number_current');
		$data['record']['bank_number_current'] = (count($bank_number_current) == 0 ? " " : ($bank_number_current[0]['key_value'] == "" ? "" : $bank_number_current[0]['key_value']));
		$payroll_bank_account_number = $this->mod->get_partners_personal($this->user->user_id, 'payroll_bank_account_number');
		$data['record']['payroll_bank_account_number'] = (count($payroll_bank_account_number) == 0 ? " " : ($payroll_bank_account_number[0]['key_value'] == "" ? "" : $payroll_bank_account_number[0]['key_value']));
		$payroll_bank_name = $this->mod->get_partners_personal($this->user->user_id, 'payroll_bank_name');
		$data['record']['payroll_bank_name'] = (count($payroll_bank_name) == 0 ? " " : ($payroll_bank_name[0]['key_value'] == "" ? "" : $payroll_bank_name[0]['key_value']));							
		$bank_account_name = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_name');
		$data['record']['bank_account_name'] = (count($bank_account_name) == 0 ? " " : ($bank_account_name[0]['key_value'] == "" ? "" : $bank_account_name[0]['key_value']));
		$data['record']['bank_number'] = (count($bank_number) == 0 ? " " : ($bank_number[0]['key_value'] == "" ? "" : $bank_number[0]['key_value']));
		$bank_account_name = $this->mod->get_partners_personal($this->user->user_id, 'bank_account_name');
		$data['record']['bank_account_name'] = (count($bank_account_name) == 0 ? " " : ($bank_account_name[0]['key_value'] == "" ? "" : $bank_account_name[0]['key_value']));		
		$health_care = $this->mod->get_partners_personal($this->user->user_id, 'health_care');
		$data['record']['health_care'] = (count($health_care) == 0 ? " " : ($health_care[0]['key_value'] == "" ? "" : $health_care[0]['key_value']));
		$job_class = $this->mod->get_partners_personal($this->user->user_id, 'job_class');
		$data['record']['job_class'] = (count($job_class) == 0 ? " " : ($job_class[0]['key_value'] == "" ? "" : $job_class[0]['key_value']));
        $job_rank_level = $this->mod->get_partners_personal($this->user->user_id, 'job_rank_level');
        $data['record']['job_rank_level'] = (count($job_rank_level) == 0 ? " " : ($job_rank_level[0]['key_value'] == "" ? "" : $job_rank_level[0]['key_value']));
        $job_level = $this->mod->get_partners_personal($this->user->user_id, 'job_level');
        $data['record']['job_level'] = (count($job_level) == 0 ? " " : ($job_level[0]['key_value'] == "" ? "" : $job_level[0]['key_value']));
        $pay_level = $this->mod->get_partners_personal($this->user->user_id, 'pay_level');
        $data['record']['pay_level'] = (count($pay_level) == 0 ? " " : ($pay_level[0]['key_value'] == "" ? "" : $pay_level[0]['key_value']));
        $pay_set_rates = $this->mod->get_partners_personal($this->user->user_id, 'pay_set_rates');
        $data['record']['pay_set_rates'] = (count($pay_set_rates) == 0 ? " " : ($pay_set_rates[0]['key_value'] == "" ? "" : $pay_set_rates[0]['key_value']));
        $competency_level = $this->mod->get_partners_personal($this->user->user_id, 'competency_level');
        $data['record']['competency_level'] = (count($competency_level) == 0 ? " " : ($competency_level[0]['key_value'] == "" ? "" : $competency_level[0]['key_value']));



        $employee_grade = $this->mod->get_partners_personal($this->user->user_id, 'employee_grade');
		$data['record']['employee_grade'] = (count($employee_grade) == 0 ? " " : ($employee_grade[0]['key_value'] == "" ? "" : $employee_grade[0]['key_value']));
		
		$section = $this->mod->get_partners_personal($this->user->user_id, 'section');
		$data['record']['section'] = (count($section) == 0 ? " " : ($section[0]['key_value'] == "" ? "" : $section[0]['key_value']));

		/***** PERSONAL TAB *****/
		//Personal
		$gender = $this->mod->get_partners_personal($this->user->user_id, 'gender');
			$data['gender'] = (count($gender) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $gender[0]['key_value']));
		$birth_place = $this->mod->get_partners_personal($this->user->user_id, 'birth_place');
			$data['birth_place'] = (count($birth_place) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $birth_place[0]['key_value']));
		$religion = $this->mod->get_partners_personal($this->user->user_id, 'religion');
			$data['religion'] = (count($religion) == 0 ? " " : ($religion[0]['key_value'] == "" ? "" : $religion[0]['key_value']));
		$nationality = $this->mod->get_partners_personal($this->user->user_id, 'nationality');
			$data['nationality'] = (count($nationality) == 0 ? " " : ($nationality[0]['key_value'] == "" ? "" : $nationality[0]['key_value']));
		//Other Information
		$height = $this->mod->get_partners_personal($this->user->user_id, 'height');
			$data['height'] = (count($height) == 0 ? " " : ($height[0]['key_value'] == "" ? "" : $height[0]['key_value']));
		$weight = $this->mod->get_partners_personal($this->user->user_id, 'weight');
			$data['weight'] = (count($weight) == 0 ? " " : ($weight[0]['key_value'] == "" ? "" : $weight[0]['key_value']));
		$blood_type = $this->mod->get_partners_personal($this->user->user_id, 'blood_type');
		$data['blood_type'] =(count($blood_type) == 0 ? " " : ($blood_type[0]['key_value'] == "" ? "" : $blood_type[0]['key_value']));						
		$interests_hobbies = $this->mod->get_partners_personal($this->user->user_id, 'interests_hobbies');
			$data['interests_hobbies'] = (count($interests_hobbies) == 0 ? " " : ($interests_hobbies[0]['key_value'] == "" ? "" : $interests_hobbies[0]['key_value']));
		$language = $this->mod->get_partners_personal($this->user->user_id, 'language');
			$data['language'] = (count($language) == 0 ? " " : ($language[0]['key_value'] == "" ? "" : $language[0]['key_value']));
		$dialect = $this->mod->get_partners_personal($this->user->user_id, 'dialect');
			$data['dialect'] = (count($dialect) == 0 ? " " : ($dialect[0]['key_value'] == "" ? "" : $dialect[0]['key_value']));
		$dependents_count = $this->mod->get_partners_personal($this->user->user_id, 'dependents_count');
			$data['dependents_count'] = (count($dependents_count) == 0 ? " " : ($dependents_count[0]['key_value'] == "" ? "" : $dependents_count[0]['key_value']));
		$marriage_date = $this->mod->get_partners_personal($this->user->user_id, 'marriage_date');
		$data['marriage_date'] = (count($marriage_date) == 0 ? " " : ($marriage_date[0]['key_value'] == "" ? "" : $marriage_date[0]['key_value']));			

		/***** Header Details *****/
		$telephones = array();
		$phone_numbers = $this->mod->get_partners_personal($this->user->user_id, 'phone');
			foreach($phone_numbers as $phone){
				if(!empty($phone['key_value'])){
					$telephones[] = $phone['key_value'];
				}
			}
			$data['profile_telephones'] = $telephones;
		$fax = array();
		$fax_numbers = $this->mod->get_partners_personal($this->user->user_id, 'fax');
			foreach($fax_numbers as $fax_no){
				$fax[] = $fax_no['key_value'];
			}
			$data['profile_fax'] = $fax;
		$mobiles = array();
		$mobile_numbers = $this->mod->get_partners_personal($this->user->user_id, 'mobile');
			foreach($mobile_numbers as $mobile){
				$mobiles[] = $mobile['key_value'];
			}
			$data['profile_mobiles'] = $mobiles;
		$civil_status = $this->mod->get_partners_personal($this->user->user_id, 'civil_status');
			$data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));
		$spouse = $this->mod->get_partners_personal($this->user->user_id, 'spouse');
			$data['profile_spouse'] = (count($spouse) == 0 ? " " : ($spouse[0]['key_value'] == "" ? "" : $spouse[0]['key_value']));

		$solo_parent = $this->mod->get_partners_personal($this->user->user_id, 'solo_parent');
		$data['personal_solo_parent'] = (count($solo_parent) == 0 ? " " : ($solo_parent[0]['key_value'] == 0 ? "No" : "Yes"));
		/***** HISTORY TAB *****/
		//Education
		$education_tab = array();
		$educational_tab = array();
		$education_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'education');
			foreach($education_tab as $educ){
				$educational_tab[$educ['sequence']][$educ['key']] = $educ['key_value'];
			}
			$data['education_tab'] = $educational_tab;
		//Employment
		$employment_tab = array();
		$employments_tab = array();
		$employment_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'employment');
			foreach($employment_tab as $emp){
				$employments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['employment_tab'] = $employments_tab;
		//Character Reference
		$reference_tab = array();
		$references_tab = array();
		$reference_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'reference');
			foreach($reference_tab as $emp){
				$references_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['reference_tab'] = $references_tab;
		//Licensure
		$licensure_tab = array();
		$licensures_tab = array();
		$details_data_id = array();
		$licensure_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'licensure');
			foreach($licensure_tab as $emp){
				$licensures_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
				$details_data_id[$emp['sequence']][$emp['key']] = $emp['personal_id'];
			}
			$data['licensure_tab'] = $licensures_tab;
			$data['details_data_id'] = $details_data_id;
		//Trainings and Seminars
		$training_tab = array();
		$trainings_tab = array();
		$training_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'training');
			foreach($training_tab as $emp){
				$trainings_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['training_tab'] = $trainings_tab;
		//Skills
		$skill_tab = array();
		$skills_tab = array();
		$skill_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'skill');
			foreach($skill_tab as $emp){
				$skills_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['skill_tab'] = $skills_tab;
		//medical
			$medical_tab = array();
			$medicals_tab = array();
			$medical_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'medical');
			foreach($medical_tab as $emp){
				$medicals_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['medical_tab'] = $medicals_tab;			
		//Affiliation
		$affiliation_tab = array();
		$affiliations_tab = array();
		$affiliation_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'affiliation');
			foreach($affiliation_tab as $emp){
				$affiliations_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['affiliation_tab'] = $affiliations_tab;
		//Accountabilities
		$accountabilities_tab = array();
		$accountable_tab = array();
		$accountabilities_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'accountabilities');
			foreach($accountabilities_tab as $emp){
				$accountable_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['accountabilities_tab'] = $accountable_tab;
		//Attachments
		$attachment_tab = array();
		$attachments_tab = array();
		$attachment_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'attachment');
			foreach($attachment_tab as $emp){
				$attachments_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
			}
			$data['attachment_tab'] = $attachments_tab;
		//Family
		$family_tab = array();
		$families_tab = array();
		$family_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'family');
		foreach($family_tab as $emp){
			$families_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['family_tab'] = $families_tab;
		//test profile
		$test_tab = array();
		$tests_tab = array();
		$test_tab = $this->mod->get_partners_personal_history($this->user->user_id, 'test');
		foreach($test_tab as $emp){
			$tests_tab[$emp['sequence']][$emp['key']] = $emp['key_value'];
		}
		$data['test_tab'] = $tests_tab;

		$old_id_number = $this->mod->get_partners_personal($this->user->user_id, 'old_id_number');
		$data['old_id_number'] = (count($old_id_number) == 0 ? " " : ($old_id_number[0]['key_value'] == "" ? "" : $old_id_number[0]['key_value']));

		$with_parking = $this->mod->get_partners_personal($this->user->user_id, 'with_parking');
		$data['with_parking'] = (count($with_parking) == 0 ? " " : ($with_parking[0]['key_value'] == "" ? "" : $with_parking[0]['key_value']));

		$old_id_number = $this->mod->get_partners_personal($this->user->user_id, 'old_id_number');
		$data['old_id_number'] = (count($old_id_number) == 0 ? " " : ($old_id_number[0]['key_value'] == "" ? "" : $old_id_number[0]['key_value']));
		
		$with_parking = $this->mod->get_partners_personal($this->user->user_id, 'with_parking');
		$data['with_parking'] = (count($with_parking) == 0 ? " " : ($with_parking[0]['key_value'] == 0 ? "No" : "Yes"));

		//Movements
		$movements_tab = array();
		$movement_qry = " SELECT  pma.action_id, pma.movement_id, pma.type_id,
							pma.effectivity_date, pma.type, pmc.cause, pma.created_on, pm.remarks
						FROM {$this->db->dbprefix}partners_movement_action pma
						INNER JOIN {$this->db->dbprefix}partners_movement pm 
							ON pma.movement_id = pm.movement_id
						INNER JOIN {$this->db->dbprefix}partners_movement_cause pmc 
							ON pm.due_to_id = pmc.cause_id 
						WHERE pma.status_id = 8 
						AND pma.user_id = {$this->user->user_id}";
		$movement_sql = $this->db->query($movement_qry);

		if($movement_sql->num_rows() > 0){
			$movements_tab = $movement_sql->result_array();
		}
		$data['movement_tab'] = $movements_tab;

		$key_sql = "SELECT * FROM {$this->db->dbprefix}partners_key pk 
					LEFT JOIN {$this->db->dbprefix}partners_key_class pkc 
					ON pk.key_class_id = pkc.key_class_id 
					WHERE pk.deleted = 0 AND pkc.user_view = 1 ";
		$key_qry = $this->db->query($key_sql);

		$partners_keys = $key_qry->result_array();
		foreach($partners_keys as $keys){
			$data['partners_keys'][] = $keys['key_code'];
			$data['partners_labels'][$keys['key_code']] = $keys['key_label'];
			$data['is_editable'][$keys['key_code']] = ($keys['for_approval'] == 0 && $keys['user_edit'] == 1) ? 1 : 0;
		}

		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->vars($data);
		echo $this->load->blade('edit.edit_my201')->with( $this->load->get_cached_vars() );
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
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();
	}

	function save($child_call = false)
	{
		$this->_ajax_only();

        //SAVING START   
        $transactions = true;
		$error = false;
		$post = $_POST;

		$this->partner_id = $this->partner->get_partner_id($this->user->user_id);
		$this->response->record_id = $this->record_id = $post['record_id'];
		unset( $post['record_id'] );

		$other_tables = array();
		$partners_personal = array();
		$validation_rules = array();
		$partners_personal_key = array();

		switch($post['fgs_number']){
			case 3:
			//Contacts Tab
				$validation_rules[] = 
				array(
					'field' => 'users[email]',
					'label' => 'Ofice Email Address',
					'rules' => 'valid_email'
					);
				$validation_rules[] = 
				array(
					'field' => 'partners_personal[personal_email]',
					'label' => 'Personal Email Address',
					'rules' => 'valid_email'
					);	

				$partners_personal_table = "partners_personal";
				$partners_personal_key = array('phone', 'mobile', 'address_1', 'city_town', 'country', 'zip_code', 'emergency_name', 'emergency_relationship', 'emergency_phone', 'emergency_mobile', 'emergency_address', 'emergency_city', 'emergency_country', 'emergency_zip_code', 'permanent_address', 'permanent_city_town', 'permanent_country', 'permanent_zipcode', 'personal_phone', 'personal_mobile', 'personal_email');
				$partners_personal = $post['partners_personal'];

				$emergency_phone = $_POST['partners_personal']['emergency_phone'];
				$emergency_mobile = $_POST['partners_personal']['emergency_mobile'];
				
				if(!empty($partners_personal['profile_mobiles'])){
					$mobile = $this->check_mobile($_POST['partners_personal']['profile_mobiles'], $this->record_id);
					if(!($mobile)){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid ofice mobile number';
						$this->response->message[] = array(
					    	'message' => 'Invalid ofice mobile number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}
	        	}

	        	if(!empty($partners_personal['profile_telephones'])){
		        	$phone = $this->check_phone($_POST['partners_personal']['profile_telephones'], $this->record_id);
					if(!($phone)){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid ofice phone number';
						$this->response->message[] = array(
					    	'message' => 'Invalid phone number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}
	        	}	

				if(!empty($partners_personal['personal_mobile'])){
					$personal_mobile = $this->check_mobile($_POST['partners_personal']['personal_mobile'], $this->record_id);
					if(!($personal_mobile)){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid personal mobile number';
						$this->response->message[] = array(
					    	'message' => 'Invalid personal mobile number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}
		        }
	        	
	        	if(!empty($partners_personal['personal_phone'])){
		        	$personal_phone = $this->check_phone($_POST['partners_personal']['personal_phone'], $this->record_id);
					if(!($personal_phone)){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid personal phone number';
						$this->response->message[] = array(
					    	'message' => 'Invalid personal phone number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}
		        }

				if(!empty($partners_personal['emergency_mobile'])){
					$mobile = $this->check_mobile($partners_personal['emergency_mobile'], $this->record_id);
					if(!$mobile){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid Emergency contact mobile number';
						$this->response->message[] = array(
					    	'message' => 'Invalid Emergency contact mobile number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}else{
		        		$partners_personal['emergency_mobile'] = $mobile;
		        	}
				}

				if(!empty($partners_personal['emergency_phone'])){
					$mobile = $this->check_phone($partners_personal['emergency_phone'], $this->record_id);
					if(!$mobile){
						$this->response->invalid=true;
						$this->response->invalid_message='Invalid Emergency contact phone number';
						$this->response->message[] = array(
					    	'message' => 'Invalid Emergency contact phone number',
					    	'type' => 'warning'
						);
		        		$this->_ajax_return();
		        	}else{
		        		$partners_personal['emergency_phone'] = $mobile;
		        	}
				}							
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
				$partners_personal_key = array('gender', 'birth_place', 'religion', 'nationality', 'civil_status', 'height', 'weight', 'interests_hobbies', 'language', 'dialect', 'dependents_count', 'solo_parent', 'with_parking', 'marriage_date', 'blood_type');
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
				$partners_personal_key = array('education-type', 'education-school', 'education-year-from', 'education-year-to', 'education-degree', 'education-honors_awards', 'education-status');
				$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
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
				$partners_personal_key = array('employment-company', 'employment-position-title', 'employment-location', 'employment-duties', 'employment-month-hired', 'employment-month-end', 'employment-year-hired', 'employment-year-end', 'employment-reason-for-leaving', 'employment-latest-salary', 'employment-supervisor');
				$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
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
				$partners_personal_key = array('licensure-title', 'licensure-number', 'licensure-remarks', 'licensure-month-taken', 'licensure-year-taken', 'licensure-month-validity-until', 'licensure-year-validity-until', 'licensure-attach');
				$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
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
				$partners_personal_key = array('training-category', 'training-title', 'training-venue', 'training-start-month', 'training-start-year', 'training-end-month', 'training-end-year', 'training-remarks', 'training-provider', 'training-cost', 'training-budgeted');
				$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
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
			case 14:
			//Family tab
				if($post['family_count'] > 0){
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
				}
				$partners_personal_table = "partners_personal_history";
				$partners_personal_key = array('family-relationship', 'family-name', 'family-birthdate', 'family-dependent', 'family-dependent-hmo', 'family-dependent-insurance');
				$partners_personal = $post['partners_personal_history'];
			break;
			case 15:
			//ID numbers
				$partners_personal_table = "partners_personal";
				$partners_personal = $post['partners_personal'];
				$partners_personal_key = array(
			                            'taxcode_id'    => $partners_personal['taxcode'], 
										'sss_no' 	=> $partners_personal['sss_number'], 
										'hdmf_no' 	=> $partners_personal['pagibig_number'], 
										'phic_no' 	=> $partners_personal['philhealth_number'], 
										'tin' 		=> $partners_personal['tin_number']);

				$payroll_partners = $this->db->query("SELECT * FROM ww_payroll_partners WHERE user_id = {$this->record_id}");
				$payroll_partners_result = $payroll_partners->row_array();

				if($payroll_partners_result['account_type_id'] == 1){

					$partners_personal_key['bank_account'] = $partners_personal['bank_account_number_current'];
				}
				elseif($payroll_partners_result['account_type_id'] == 2){

					$partners_personal_key['bank_account'] = $partners_personal['bank_account_number_savings'] ?? '';
				}

				$other_tables['payroll_partners'] = $partners_personal_key;
				$partners_personal_key = array('taxcode', 'sss_number', 'pagibig_number', 'philhealth_number', 'tin_number', 'bank_account_number_savings', 'bank_account_number_current', 'payroll_bank_account_number', 'payroll_bank_name', 'bank_account_name', 'health_care', 'drivers_license_no', 'passport_no');
			break;
			case 16:
			//Test Profile tab
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[test-title]',
				'label' => 'Title',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[test-date-taken]',
				'label' => 'Date Taken',
				'rules' => 'required'
				);
/*			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[test-location]',
				'label' => 'Location',
				'rules' => 'required'
				);
			$validation_rules[] = 
			array(
				'field' => 'partners_personal_history[test-score]',
				'label' => 'Score/Rating',
				'rules' => 'required'
				);*/
			$partners_personal_table = "partners_personal_history";
			$partners_personal_key = array('test-category', 'test-date-taken', 'test-location', 'test-score', 'test-result', 'test-remarks', 'test-attachments', 'test-title');
			$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
			break;
			//medical records
			case 18:
				$partners_personal_table = "partners_personal_history";
				$partners_personal_key = array('medical-exam-type', 'medical-date-exam', 'medical-clinic-hospital', 'medical-pre-existing', 'medical-findings', 'medical-status', 'medical-cost');
				$partners_personal = (isset($post['partners_personal_history']) ? $post['partners_personal_history'] : array());
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

		if( $transactions )
		{
			$this->db->trans_begin();
		}

		foreach( $other_tables as $table => $data )
		{
			$record = $this->db->get_where( $table, array( $this->partner->primary_key => $this->user->user_id ) );
			switch( true )
			{
				case $record->num_rows() == 0:
					$data[$this->partner->primary_key] = $this->user->user_id;
					$this->db->insert($table, $data);
					$this->record_id = $this->db->insert_id();
					break;
				case $record->num_rows() == 1:
					$this->db->update( $table, $data, array( $this->partner->primary_key => $this->user->user_id  ) );
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
			// $this->load->model('my201_model', 'profile_mod');
			$sequence = 1;
			$post['fgs_number'];
			$accountabilities_attachments = array(12,13);
			$current_sequence = (isset($post['sequence']) ? $post['sequence'] : 0);

			if(count($partners_personal_key) > 0){
				foreach( $partners_personal_key as $table => $key )
				{
					if(isset($partners_personal[$key]) && !is_array($partners_personal[$key])){
						if (isset($partners_personal[$key])) {
							$record = $this->partner->get_partners_personal($this->user->user_id , $partners_personal_table, $key, $current_sequence);
							if(in_array($post['fgs_number'], $accountabilities_attachments) && $current_sequence == 0) //insert to personal history
							{
								$sequence = count($record) + 1;
								$record = array();
							}
							$data_personal = array('key_value' => $partners_personal[$key]);
							switch( true )
							{
								case count($record) == 0:
									$data_personal = $this->partner->insert_partners_personal($this->user->user_id, $key, $partners_personal[$key], $sequence, $this->partner_id);
									$this->db->insert($partners_personal_table, $data_personal);
									// $this->record_id = $this->db->insert_id();
									break;
								case count($record) == 1:
									$partner_id = $this->partner_id;
									$where_array = in_array($post['fgs_number'], $accountabilities_attachments) ? array( 'partner_id' => $partner_id, 'key' => $key, 'sequence' => $current_sequence ) : array( 'partner_id' => $partner_id, 'key' => $key );
									$this->db->update( $partners_personal_table, $data_personal, $where_array );
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
					}else{
						$sequence = 1;
						$partner_id = $this->partner_id;
						$this->db->delete($partners_personal_table, array( 'partner_id' => $partner_id, 'key' => $key ));
						if( isset($partners_personal[$key] ) && is_array($partners_personal[$key]) )
						{
							foreach( $partners_personal[$key] as $table => $data_personal )
							{	
								$data_personal = $this->partner->insert_partners_personal($this->user->user_id, $key, $data_personal, $sequence, $this->partner_id);
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
			$this->response->record_id = $this->record_id;
			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
		}

		$this->response->saved = !$error;
		$this->_ajax_return();
	}

	public function single_upload()
	{
		$this->_ajax_only();
		define('UPLOAD_DIR', 'uploads/change_request/');
		$this->load->library("UploadHandler");
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
}

