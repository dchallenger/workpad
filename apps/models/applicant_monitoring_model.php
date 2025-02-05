<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class applicant_monitoring_model extends Record
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
		$this->mod_id = 125;
		$this->mod_code = 'applicant_monitoring';
		$this->route = 'recruitment/applicant_monitoring';
		$this->url = site_url('recruitment/applicant_monitoring');
		$this->primary_key = '1';
		$this->table = '1';
		$this->icon = 'fa-folder';
		$this->short_name = 'Applicant Monitoring';
		$this->long_name  = 'Applicant Monitoring';
		$this->description = '';
		$this->path = APPPATH . 'modules/applicant_monitoring/';

		parent::__construct();
	}

    function notify_hr( $applicant_info='', $new_user_id = '' )
    {   
        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');

        $this->load->model('partners_model', 'partners_model');

/*        $qry = "SELECT  *
                FROM {$this->db->dbprefix}roles r 
                WHERE FIND_IN_SET(2,profile_id)";*/

        $qry = "SELECT  *
                FROM {$this->db->dbprefix}roles r 
                WHERE role_id = 2";

        $roles_result = $this->db->query($qry);

        $notified = array();        
        if ($roles_result && $roles_result->num_rows() > 0) {
            $role_id = $roles_result->row()->role_id;

            $this->db->where('role_id',$role_id);
            $users = $this->db->get('users');

            if ($users && $users->num_rows() > 0) {
                foreach ($users->result() as $row) {
                    //insert notification
                    $insert = array(
                        'status' => 'info',
                        'message_type' => 'Recruitment',
                        'user_id' => $this->user->user_id,
                        'feed_content' => $applicant_info->firstname.' '.$applicant_info->lastname.' now has a 201 record.',
                        'recipient_id' => $row->user_id,
                        'uri' => str_replace(base_url(), '', $this->partners_model->url).'/detail/'.$new_user_id
                    );

                    $this->db->insert('system_feeds', $insert);
                    $id = $this->db->insert_id();
                    $this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));
                    $notified[] = $row->user_id;

                    //email hr
                    $data['new_employee'] = $applicant_info->lastname.', '.$applicant_info->firstname;
                    $data['hr'] = $row->full_name;            

                    $create_201_template = $this->db->get_where( 'system_template', array( 'code' => 'CREATED-201-HR') )->row_array();

                    $msg = $this->parser->parse_string($create_201_template['body'], $data, TRUE); 

                    $subject = $this->parser->parse_string($create_201_template['subject'], $data, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$row->email}', '{$subject}', '".$this->db->escape_str($msg)."') "); 
                }
            }
        }

        return $notified;
    }

    function notify_hr_recruitment( $applicant_info='', $new_user_id = '' )
    {   
        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');

        $this->load->model('mrf_admin_model', 'mrf_admin_model');

/*        $qry = "SELECT  *
                FROM {$this->db->dbprefix}roles r 
                WHERE FIND_IN_SET(4,profile_id)";*/

        $qry = "SELECT  *
                FROM {$this->db->dbprefix}roles r 
                WHERE role_id = 42";

        $roles_result = $this->db->query($qry);
        
        $notified = array();        

        if ($roles_result && $roles_result->num_rows() > 0) {
            $role_id = $roles_result->row()->role_id;

            $this->db->where('role_id',$role_id);
            $users = $this->db->get('users');

            if ($users && $users->num_rows() > 0) {
                foreach ($users->result() as $row) {
                    //insert notification
                    $insert = array(
                        'status' => 'info',
                        'message_type' => 'Recruitment',
                        'user_id' => $this->user->user_id,
                        'feed_content' => $applicant_info->firstname.' '.$applicant_info->lastname.' now has a 201 record.',
                        'recipient_id' => $row->user_id,
                        'uri' => str_replace(base_url(), '', $this->mrf_admin_model->url)
                    );

                    $this->db->insert('system_feeds', $insert);
                    $id = $this->db->insert_id();
                    $this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $row->user_id));
                    $notified[] = $row->user_id;

                    //email hr
                    $data['new_employee'] = $applicant_info->lastname.', '.$applicant_info->firstname;
                    $data['hr'] = $row->full_name;            

                    $create_201_template = $this->db->get_where( 'system_template', array( 'code' => 'CREATED-201-HR-RECRUITMENT') )->row_array();

                    $msg = $this->parser->parse_string($create_201_template['body'], $data, TRUE); 

                    $subject = $this->parser->parse_string($create_201_template['subject'], $data, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$row->email}', '{$subject}', '".$this->db->escape_str($msg)."') "); 
                }
            }
        }

        return $notified;
    }

    function get_partners_personal($user_id=0, $partners_personal_table='', $key='', $sequence=0){
        $this->db->select('personal_id, key_value')
        ->from($partners_personal_table)
        ->join('partners', $partners_personal_table.'.partner_id = partners.partner_id', 'left')
        ->where("partners.user_id = $user_id")
        ->where("partners.deleted = 0")
        ->where($partners_personal_table.".key = '$key'");
        if($sequence != 0)
            $this->db->where($partners_personal_table.".sequence = '$sequence'");

        if($partners_personal_table == 'partners_personal'){
            $this->db->where("partners_personal.deleted = 0");
        }

        $partners_personal = $this->db->get('');    
        
        if( $partners_personal->num_rows() > 0 )
            return $partners_personal->result_array();
        else
            return array();
    }

    public function insert_partners_personal($user_id=0, $key_code='', $key_value='', $sequence=0, $partner_id=0)
    {
        $sql_partner = $this->db->get_where('partners', array('user_id' => $user_id));
        $partner_details = $sql_partner->row_array();

        if(!count($partner_details) > 0){
            $this->db->insert('partners', array('user_id' => $user_id));
            $partner_id = $this->db->insert_id();
        }
        
        $sql_partner_key = $this->db->get_where('partners_key', array('key_code' => $key_code));
        $key_details = $sql_partner_key->row_array();

        $data = array();
        
        if ($key_details && !empty($key_details)) {
            $data = array(
                'partner_id' => ($partner_id == 0) ? $partner_details['partner_id'] : $partner_id,
                'key_id' => $key_details['key_id'],     
                'key' => $key_details['key_code'],
                'sequence' => $sequence,
                'key_name' => $key_details['key_label'],
                'key_value' => $key_value,
                'created_on' => date('Y-m-d H:i:s'),
                'created_by' => $this->user->user_id
                );
        }

        return $data;
    }

    function get_recruitment_personal($recruit_id)
    {
        $this->db->select('key,key_value')
        ->from('recruitment_personal ')
        ->where("recruitment_personal.recruit_id = $recruit_id");

        $recruitment_personal = $this->db->get(''); 

        $recruitment_info = array();
        if( $recruitment_personal && $recruitment_personal->num_rows() > 0 ) {
            foreach ($recruitment_personal->result() as $row) {
                $recruitment_info[$row->key] = $row->key_value;
            }
            return $recruitment_info;
        } else
            return array();
    }

    function get_recruitment_personal_history($recruit_id)
    {
        $this->db->select('key,key_value')
        ->from('recruitment_personal_history ')
        ->where("recruitment_personal_history.recruit_id = $recruit_id");

        $recruitment_personal_history = $this->db->get(''); 

        $recruitment_history_info = array();
        if( $recruitment_personal_history && $recruitment_personal_history->num_rows() > 0 ){
            foreach ($recruitment_personal_history->result() as $row) {
                $recruitment_history_info[$row->key][] = $row->key_value;
            }
            return $recruitment_history_info;
        } else
            return array();
    }

    function get_scheds( $process_id )
    {
        $rps_status_id = '';
        $rps = $this->db->get_where('recruitment_process',array('process_id' => $process_id));
        if ($rps && $rps->num_rows() > 0){
            $rps_status_id = $rps->row()->status_id;
            $type = 1;
            if ($rps_status_id <= 5) {
                if ($rps_status_id != 5)
                    $type = 'a.type != 2';
                else
                    $type = 'a.type = 2';
            }

        }

        $qry = "select a.user_id as interviewer, a.*, b.full_name, d.position, f.*, h.*
        FROM {$this->db->dbprefix}recruitment_process_schedule a
        LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.user_id
        LEFT JOIN {$this->db->dbprefix}users_profile c on c.user_id = a.user_id
        LEFT JOIN {$this->db->dbprefix}users_position d on d.position_id = c.position_id
        LEFT JOIN {$this->db->dbprefix}recruitment_process_interview e on e.schedule_id = a.schedule_id
        LEFT JOIN {$this->db->dbprefix}recruitment_process_interview_result f on f.result_id = e.result_id
        LEFT JOIN {$this->db->dbprefix}recruitment_interview_location h on a.location_id = h.interview_location_id
        WHERE a.deleted = 0 and a.process_id = {$process_id} and ".$type." ";

        $scheds = $this->db->query( $qry );
        if( $scheds &&  $scheds->num_rows() > 0)
            return $scheds->result();
        else
            return false;               
    }

    function get_exams( $process_id )
    {
        $qry = "select *
        FROM {$this->db->dbprefix}recruitment_process_exam
        WHERE deleted = 0 and process_id = {$process_id}";

        $exams = $this->db->query( $qry );
        if( $exams->num_rows() > 0)
            return $exams->result_array();
        else
            return false;               
    }

    function get_interview( $process_id, $result_id = 0 )
    {
        $qry = "select *
        FROM {$this->db->dbprefix}recruitment_process_interview
        WHERE deleted = 0 and process_id = {$process_id}";

        if ($result_id)
            $qry .= " AND result_id = {$result_id}";

        $interview = $this->db->query( $qry );
        if( $interview->num_rows() > 0)
            return $interview->result_array();
        else
            return false;               
    }

    function get_benefit( $process_id )
    {
        $qry = "select *
        FROM {$this->db->dbprefix}recruitment_process_offer_compben
        WHERE deleted = 0 and process_id = {$process_id}";

        $benefit = $this->db->query( $qry );
        if( $benefit->num_rows() > 0)
            return $benefit->result_array();
        else
            return false;               
    }

    function get_backgrounds( $process_id )
    {
        $qry = "SELECT *
        FROM {$this->db->dbprefix}recruitment_process_background rpb
        WHERE rpb.deleted = 0 AND rpb.process_id = {$process_id}";
// echo $qry;
        $bis = $this->db->query( $qry );
        
        if( $bis && $bis->num_rows() > 0)
            return $bis->result_array();
        else{
            return array();  
        }            
    }

    function get_bi( $process_id )
    {
        $qry = "SELECT *
        FROM {$this->db->dbprefix}recruitment_process_background_items rpbi
        LEFT JOIN {$this->db->dbprefix}recruitment_process_background rpb ON rpbi.rpb_id = rpb.rpb_id
        WHERE rpb.deleted = 0 AND rpb.process_id = {$process_id}";

        $bis = $this->db->query( $qry );
        if( $bis && $bis->num_rows() > 0)
            return $bis;
        else{
            return false;  
        }            
    }

    function get_request( $request_id )
    {
        $qry = "SELECT uc.company,ud.department 
        FROM {$this->db->dbprefix}recruitment_request rr
        LEFT JOIN {$this->db->dbprefix}users_company uc on rr.company_id = uc.company_id
        LEFT JOIN {$this->db->dbprefix}users_department ud on rr.department_id = ud.department_id
        WHERE rr.deleted = 0 and rr.request_id = {$request_id}";

        $request = $this->db->query( $qry );
        if( $request && $request->num_rows() > 0)
            return $request->row_array();
        else{
            return array();  
        }            
    }

	function get_sched( $schedule_id )
	{
		$qry = "select a.*, b.full_name, d.position, f.*
		FROM {$this->db->dbprefix}recruitment_process_schedule a
		LEFT JOIN {$this->db->dbprefix}users b on b.user_id = a.user_id
		LEFT JOIN {$this->db->dbprefix}users_profile c on c.user_id = a.user_id
		LEFT JOIN {$this->db->dbprefix}users_position d on d.position_id = c.position_id
		LEFT JOIN {$this->db->dbprefix}recruitment_process_interview e on e.schedule_id = a.schedule_id
		LEFT JOIN {$this->db->dbprefix}recruitment_process_interview_result f on f.result_id = e.result_id
		WHERE a.deleted = 0 and a.schedule_id = {$schedule_id}";

		$sched = $this->db->query( $qry );
		if( $sched->num_rows() == 1)
			return $sched->row();
		else
			return false;				
	}

	private function check_path( $path, $create = true )
	{
		if( !is_dir( FCPATH . $path ) ){
			if( $create )
			{
				$folders = explode('/', $path);
				$cur_path = FCPATH;
				foreach( $folders as $folder )
				{
					$cur_path .= $folder;

					if( !is_dir( $cur_path ) )
					{
						mkdir( $cur_path, 0777, TRUE);
						$indexhtml = read_file( APPPATH .'index.html');
		                write_file( $cur_path .'/index.html', $indexhtml);
					}

					$cur_path .= '/';
				}
			}
			return false;
		}
		return true;
	}
	
    // job_offer
    function export_pdf_job_offer($process_id){
    	$user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Job Offer' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
        		FROM {$this->db->dbprefix}recruitment_process recpro
        		LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
        		ON rpo.process_id = recpro.process_id
        		WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
        		DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
        		uprofile.firstname, uprofile.middlename, uprofile.lastname
				FROM {$this->db->dbprefix}recruitment_request rreq
				LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
				LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
				LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
				LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
				WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
		
		$this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
		$vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
		$countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
		$vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
		$address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
		$vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
		$address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
		$vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
		$zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
		$vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
		$province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
		$vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
		$presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
		$vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
		$presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
		$vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
		$town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
		$vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
		
		$vars['address1'] = "";
		if(!empty($vars['presentadd_no']))
			$vars['address1'] .= $vars['presentadd_no']. " ";
		if(!empty($vars['address_1']))
			$vars['address1'] .= $vars['address_1']. " ";
		if(!empty($vars['presentadd_village']))
			$vars['address1'] .= $vars['presentadd_village']. " ";
		if(!empty($vars['address_2']))
			$vars['address1'] .= $vars['address_2']. " ";
		if(!empty($vars['town']))
			$vars['address1'] .= $vars['town']. " ";

		$vars['address2'] = "";
		if(!empty($vars['city_town']))
			$vars['address2'] .= $vars['city_town']. " ";
		if(!empty($vars['province']))
			$vars['address2'] .= $vars['province']. " ";
		if(!empty($vars['zip_code']))
			$vars['address2'] .= ",".$vars['zip_code'];

        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['company_code'] = $mrfData->company_code;
        $vars['position'] = $mrfData->position;

        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
	        $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
	        $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $query = "SELECT rb.benefit, rpob.amount, prt.payroll_rate_type
        		FROM {$this->db->dbprefix}recruitment_process_offer_compben rpob
        		LEFT JOIN {$this->db->dbprefix}recruitment_benefit rb
        		ON rb.benefit_id = rpob.benefit_id
        		LEFT JOIN {$this->db->dbprefix}payroll_rate_type prt
        		ON prt.payroll_rate_type_id = rpob.rate_id
        		WHERE rpob.process_id = {$process_id}";
        $benefits = $this->db->query($query)->result_array();
        $vars['benefits'] =  '';
        foreach($benefits as $benefit){
        	$vars['benefits'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        }
        $vars['basicsalary'] = '';
        $vars['daysofwork'] = '';
        $vars['timeshift'] = '';
        $vars['breaks'] = '';
        $vars['breaktime'] = '';
        $vars['immediateposition'] = '';
        $vars['HRmanager'] = '';
		        // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/job_offer_form.txt');
       
		$this->load->library('parser');
		// $this->parser->set_delimiters('{$', '}');
		$html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/job_offer/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'jo' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // interview_assessment_form
    function export_pdf_interview_assessment_form($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Interview Assessment Form' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
        
        $this->load->model('applicants_model');
  //       $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        // $vars['city_town'] = count($city_town) == 0 ? " " : $city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value'];

        $desired_salary = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'desired_salary');
        $vars['desired_salary'] = (count($desired_salary) == 0 ? " " : ($desired_salary[0]['key_value'] == "" ? "" : $desired_salary[0]['key_value']));
        $vars['position'] = $mrfData->position;

        $query = "SELECT * FROM ww_recruitment_process_interview rpi 
                LEFT JOIN ww_recruitment_process_schedule rps 
                ON rpi.schedule_id = rps.schedule_id
                WHERE rpi.process_id = {$process_id}";
        $interviewer = $this->db->query($query)->result_array();
        $vars['interviewer'] =  '';
        // foreach($interviewer as $benefit){
        //  $vars['interviewer'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        // }
        // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/interview_assessment_form.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/interview_assessment/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'interview_assessment' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // employment_agreement
    function export_pdf_employment_agreement($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Employment Agreement' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
                
        $this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        $vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
        $countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
        $vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
        $address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
        $vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
        $address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
        $vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
        $zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
        $vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
        $province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
        $vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
        $presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
        $vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
        $presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
        $vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
        $town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
        $vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
        
        $vars['address1'] = "";
        if(!empty($vars['presentadd_no']))
            $vars['address1'] .= $vars['presentadd_no']. " ";
        if(!empty($vars['address_1']))
            $vars['address1'] .= $vars['address_1']. " ";
        if(!empty($vars['presentadd_village']))
            $vars['address1'] .= $vars['presentadd_village']. " ";
        if(!empty($vars['address_2']))
            $vars['address1'] .= $vars['address_2']. " ";
        if(!empty($vars['town']))
            $vars['address1'] .= $vars['town']. " ";

        $vars['address2'] = "";
        if(!empty($vars['city_town']))
            $vars['address2'] .= $vars['city_town']. " ";
        if(!empty($vars['province']))
            $vars['address2'] .= $vars['province']. " ";
        if(!empty($vars['zip_code']))
            $vars['address2'] .= ",".$vars['zip_code'];

        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['position'] = $mrfData->position;
        $vars['company_code'] = $mrfData->company_code;
        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $query = "SELECT * FROM ww_recruitment_process_interview rpi 
                LEFT JOIN ww_recruitment_process_schedule rps 
                ON rpi.schedule_id = rps.schedule_id
                WHERE rpi.process_id = {$process_id}";
        $interviewer = $this->db->query($query)->result_array();
        $vars['interviewer'] =  '';
        // foreach($interviewer as $benefit){
        //  $vars['interviewer'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        // }

        $vars['basicsalary'] = '';
        $vars['daysofwork'] = '';
        $vars['timeshift'] = '';
        $vars['breaks'] = '';
        $vars['breaktime'] = '';
        $vars['immediateposition'] = '';
        $vars['HRmanager'] = '';
        $vars['idnumber'] = '';
        // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/employment_agreement.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/employment_agreement/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'employment_agreement' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // background_investigation_report
    function export_pdf_background_investigation_report($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Background Investigation' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
                
        $this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        $vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
        $countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
        $vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
        $address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
        $vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
        $address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
        $vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
        $zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
        $vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
        $province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
        $vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
        $presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
        $vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
        $presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
        $vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
        $town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
        $vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
        
        $vars['address1'] = "";
        if(!empty($vars['presentadd_no']))
            $vars['address1'] .= $vars['presentadd_no']. " ";
        if(!empty($vars['address_1']))
            $vars['address1'] .= $vars['address_1']. " ";
        if(!empty($vars['presentadd_village']))
            $vars['address1'] .= $vars['presentadd_village']. " ";
        if(!empty($vars['address_2']))
            $vars['address1'] .= $vars['address_2']. " ";
        if(!empty($vars['town']))
            $vars['address1'] .= $vars['town']. " ";

        $vars['address2'] = "";
        if(!empty($vars['city_town']))
            $vars['address2'] .= $vars['city_town']. " ";
        if(!empty($vars['province']))
            $vars['address2'] .= $vars['province']. " ";
        if(!empty($vars['zip_code']))
            $vars['address2'] .= ",".$vars['zip_code'];

        $gender = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'gender');
        $vars['gender'] = (count($gender) == 0 ? " " : ($gender[0]['key_value'] == "" ? "" : $gender[0]['key_value']));
        if(strtolower($vars['gender']) == 'male'){
            $vars['male'] = 'checked=checked';
            $vars['female'] = '';
        }else{
            $vars['female'] = 'checked=checked';
            $vars['male'] = '';
        }

        $civil_status = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'civil_status');
        $data['profile_civil_status'] = (count($civil_status) == 0 ? " " : ($civil_status[0]['key_value'] == "" ? "" : $civil_status[0]['key_value']));
        $vars['single'] = '';
        $vars['married'] = '';
        $vars['divorced'] = '';
        $vars['widow'] = '';
        switch(strtolower($data['profile_civil_status'])){
            case 'single':
                $vars['single'] = 'checked=checked';
            break;
            case 'married':
                $vars['married'] = 'checked=checked';
            break;
            case 'divorced':
                $vars['divorced'] = 'checked=checked';
            break;
            case 'widow':
                $vars['widow'] = 'checked=checked';
            break;
        }

        $photo = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'photo');
        $profilepic = base_url($photo[0]['key_value']);
        $picture = "<img src=\"{$profilepic}\" />";
        $vars['profilePic'] = (count($photo) == 0 ? " " : ($photo[0]['key_value'] == "" ? "" : $picture));


        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['position'] = $mrfData->position;
        $vars['company_code'] = $mrfData->company_code;
        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $query = "SELECT * FROM ww_recruitment_process_interview rpi 
                LEFT JOIN ww_recruitment_process_schedule rps 
                ON rpi.schedule_id = rps.schedule_id
                WHERE rpi.process_id = {$process_id}";
        $interviewer = $this->db->query($query)->result_array();
        $vars['interviewer'] =  '';
        // foreach($interviewer as $benefit){
        //  $vars['interviewer'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        // }
        $vars['recommend_no'] = '';
        $vars['recommend_yes'] = '';
        $vars['remarks_here'] = '';
        $vars['employment_history'] = '';
        $vars['education_check'] = '';
        $vars['socialmedia_check'] = '';
        $vars['residence_check'] = '';
        $vars['criminal_record'] = '';
        $vars['credit_record'] = '';
        $tin_number = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'tin_number');
        $vars['tin_number'] = (count($tin_number) == 0 ? " " : ($tin_number[0]['key_value'] == "" ? "" : $tin_number[0]['key_value']));
        $sss_number = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'sss_number');
        $vars['sss_number'] = (count($sss_number) == 0 ? " " : ($sss_number[0]['key_value'] == "" ? "" : $sss_number[0]['key_value']));

        $vars['employment_status'] = '';
        $employment_tab = array();
        $employments_tab = array();
        $employment_tab = $this->applicants_model->get_recruitment_personal_value_history($recruit_id, 'employment');
        $monthend = array();
        $yearend = array();
        foreach($employment_tab as $emp){
            if($emp['key'] == 'employment-month-end'){
                $monthend[$emp['sequence']] = $emp['key_value'];
            }
            if($emp['key'] == 'employment-year-end'){
                $yearend[$emp['sequence']] = $emp['key_value'];
            }
        }

        $sequence = null;
        foreach($monthend as $index => $value){
            if(empty($sequence)){
                $sequence = $index;
            }else{
                $previous_index = --$index;
                if(strtotime($value." 1, ".$yearend[$index]) > strtotime($monthend[$previous_index]." 1, ".$yearend[$previous_index])){
                    $sequence = $index;
                }
            }
        }

        foreach($employment_tab as $emp){
            if($emp['sequence'] == $sequence){
                $vars[$emp['key']] = $emp['key_value'];
            }
        }

        $vars['employment_remarks'] = '';
        $vars['education_status'] = '';
        $education_tab = array();
        $educations_tab = array();
        $education_tab = $this->applicants_model->get_recruitment_personal_value_history($recruit_id, 'education');
        $yearend = array();
        foreach($education_tab as $emp){
            if($emp['key'] == 'education-year-to'){
                $yearend[$emp['sequence']] = $emp['key_value'];
            }
        }

        $sequence = null;
        foreach($yearend as $index => $value){
            if(empty($sequence)){
                $sequence = $index;
            }else{
                $previous_index = --$index;
                if($yearend[$index] > $yearend[$previous_index]){
                    $sequence = $index;
                }
            }
        }

        foreach($education_tab as $emp){
            if($emp['sequence'] == $sequence){
                $vars[$emp['key']] = $emp['key_value'];
            }
        }

        $vars['education_remarks'] = '';
        $vars['residents_status'] = '';
        $vars['education_remarks'] = '';
        $vars['residents_photo'] = '';
        $vars['socialmedia_remarks'] = '';
        $vars['socialmedia_status'] = '';
        $vars['sss_status'] = '';
        $vars['sss_remarks'] = '';
        $vars['tin_status'] = '';
        $vars['tin_remarks'] = '';
        $vars['credit_status'] = '';
        $vars['credit_remarks'] = '';
        $vars['criminal_status'] = '';
        $vars['criminal_remarks'] = '';
        $vars['conducted_by'] = '';
        $vars['noted_by'] = '';
        // $vars['HRmanager'] = '';
        // $vars['department'] = '';
        // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/employment_agreement.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/employment_agreement/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'employment_agreement' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // job_description
    function export_pdf_job_description($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Job Description' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
        
        $this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        $vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
        $countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
        $vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
        $address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
        $vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
        $address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
        $vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
        $zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
        $vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
        $province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
        $vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
        $presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
        $vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
        $presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
        $vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
        $town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
        $vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
        
        $vars['address1'] = "";
        if(!empty($vars['presentadd_no']))
            $vars['address1'] .= $vars['presentadd_no']. " ";
        if(!empty($vars['address_1']))
            $vars['address1'] .= $vars['address_1']. " ";
        if(!empty($vars['presentadd_village']))
            $vars['address1'] .= $vars['presentadd_village']. " ";
        if(!empty($vars['address_2']))
            $vars['address1'] .= $vars['address_2']. " ";
        if(!empty($vars['town']))
            $vars['address1'] .= $vars['town']. " ";

        $vars['address2'] = "";
        if(!empty($vars['city_town']))
            $vars['address2'] .= $vars['city_town']. " ";
        if(!empty($vars['province']))
            $vars['address2'] .= $vars['province']. " ";
        if(!empty($vars['zip_code']))
            $vars['address2'] .= ",".$vars['zip_code'];

        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['company_code'] = $mrfData->company_code;
        $vars['position'] = $mrfData->position;

        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        // $query = "SELECT rb.benefit, rpob.amount, prt.payroll_rate_type
        //         FROM {$this->db->dbprefix}recruitment_process_offer_compben rpob
        //         LEFT JOIN {$this->db->dbprefix}recruitment_benefit rb
        //         ON rb.benefit_id = rpob.benefit_id
        //         LEFT JOIN {$this->db->dbprefix}payroll_rate_type prt
        //         ON prt.payroll_rate_type_id = rpob.rate_id
        //         WHERE rpob.process_id = {$process_id}";
        // $benefits = $this->db->query($query)->result_array();
        // $vars['benefits'] =  '';
        // foreach($benefits as $benefit){
        //     $vars['benefits'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        // }
        $vars['department'] = '';
        $vars['reportsto'] = '';
        $vars['nextlevelsuperior'] = '';
        $vars['supervises'] = '';
        $vars['coordinates'] = '';
        $vars['jobmissions_purpose'] = '';
        $vars['kras'] = '';
        $vars['live'] = '';
        $vars['love'] = '';
        $vars['learn'] = '';
        $vars['knowledge'] = '';
        $vars['skills'] = '';
        $vars['abilities_behavior'] = '';
        $vars['academic_professional'] = '';
        $vars['requirements'] = '';
        $vars['licensure'] = '';
        $vars['certificates'] = '';
        $vars['immediateposition'] = '';
        $vars['HRmanager'] = '';
                // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/job_description_form.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/job_offer/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'jd' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // non_compete_agreement
    function export_pdf_non_compete_agreement($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Non-Compete Agreement' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname, uc.address
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
        
        $this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        $vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
        $countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
        $vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
        $address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
        $vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
        $address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
        $vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
        $zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
        $vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
        $province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
        $vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
        $presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
        $vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
        $presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
        $vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
        $town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
        $vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
        
        $vars['address1'] = "";
        if(!empty($vars['presentadd_no']))
            $vars['address1'] .= $vars['presentadd_no']. " ";
        if(!empty($vars['address_1']))
            $vars['address1'] .= $vars['address_1']. " ";
        if(!empty($vars['presentadd_village']))
            $vars['address1'] .= $vars['presentadd_village']. " ";
        if(!empty($vars['address_2']))
            $vars['address1'] .= $vars['address_2']. " ";
        if(!empty($vars['town']))
            $vars['address1'] .= $vars['town']. " ";

        $vars['address2'] = "";
        if(!empty($vars['city_town']))
            $vars['address2'] .= $vars['city_town']. " ";
        if(!empty($vars['province']))
            $vars['address2'] .= $vars['province']. " ";
        if(!empty($vars['zip_code']))
            $vars['address2'] .= ",".$vars['zip_code'];

        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['company_code'] = $mrfData->company_code;
        $vars['company_address'] = $mrfData->address;
        $vars['position'] = $mrfData->position;

        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $query = "SELECT rb.benefit, rpob.amount, prt.payroll_rate_type
                FROM {$this->db->dbprefix}recruitment_process_offer_compben rpob
                LEFT JOIN {$this->db->dbprefix}recruitment_benefit rb
                ON rb.benefit_id = rpob.benefit_id
                LEFT JOIN {$this->db->dbprefix}payroll_rate_type prt
                ON prt.payroll_rate_type_id = rpob.rate_id
                WHERE rpob.process_id = {$process_id}";
        $benefits = $this->db->query($query)->result_array();
        $vars['benefits'] =  '';
        foreach($benefits as $benefit){
            $vars['benefits'] .= "<li> Php {$benefit['amount']} {$benefit['benefit']} {$benefit['payroll_rate_type']} </li>";
        }
        $vars['basicsalary'] = '';
        $vars['daysofwork'] = '';
        $vars['timeshift'] = '';
        $vars['breaks'] = '';
        $vars['breaktime'] = '';
        $vars['immediateposition'] = '';
        $vars['HRmanager'] = '';
                // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/non-compete_agreement.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/non_compete_agreement/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'non_compete_agreement' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // non_disclosure_agreement
    function export_pdf_non_disclosure_agreement($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Non-Disclosure Agreement' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname, uc.address
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
        
        $this->load->model('applicants_model');
        $city_town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'city_town');
        $vars['city_town'] = (count($city_town) == 0 ? " " : ($city_town[0]['key_value'] == "" ? "" : $city_town[0]['key_value']));
        $countries = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'country');
        $vars['country'] = (count($countries) == 0 ? " " : ($countries[0]['key_value'] == "" ? "" : $countries[0]['key_value']));
        $address_1 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_1');
        $vars['address_1'] = (count($address_1) == 0 ? " " : ($address_1[0]['key_value'] == "" ? "" : $address_1[0]['key_value']));
        $address_2 = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'address_2');
        $vars['address_2'] = (count($address_2) == 0 ? " " : ($address_2[0]['key_value'] == "" ? "" : $address_2[0]['key_value']));
        $zip_code = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'zip_code');
        $vars['zip_code'] = (count($zip_code) == 0 ? " " : ($zip_code[0]['key_value'] == "" ? "" : $zip_code[0]['key_value']));
        $province = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'province');
        $vars['province'] = (count($province) == 0 ? " " : ($province[0]['key_value'] == "" ? "" : $province[0]['key_value']));
        $presentadd_no = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_no');
        $vars['presentadd_no'] = (count($presentadd_no) == 0 ? " " : ($presentadd_no[0]['key_value'] == "" ? "" : $presentadd_no[0]['key_value']));
        $presentadd_village = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'presentadd_village');
        $vars['presentadd_village'] = (count($presentadd_village) == 0 ? " " : ($presentadd_village[0]['key_value'] == "" ? "" : $presentadd_village[0]['key_value']));
        $town = $this->applicants_model->get_recruitment_personal_value($recruit_id, 'town');
        $vars['town'] = (count($town) == 0 ? " " : ($town[0]['key_value'] == "" ? "" : $town[0]['key_value']));
        
        $vars['address1'] = "";
        if(!empty($vars['presentadd_no']))
            $vars['address1'] .= $vars['presentadd_no']. " ";
        if(!empty($vars['address_1']))
            $vars['address1'] .= $vars['address_1']. " ";
        if(!empty($vars['presentadd_village']))
            $vars['address1'] .= $vars['presentadd_village']. " ";
        if(!empty($vars['address_2']))
            $vars['address1'] .= $vars['address_2']. " ";
        if(!empty($vars['town']))
            $vars['address1'] .= $vars['town']. " ";

        $vars['address2'] = "";
        if(!empty($vars['city_town']))
            $vars['address2'] .= $vars['city_town']. " ";
        if(!empty($vars['province']))
            $vars['address2'] .= $vars['province']. " ";
        if(!empty($vars['zip_code']))
            $vars['address2'] .= ",".$vars['zip_code'];

        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['company_code'] = $mrfData->company_code;
        $vars['company_address'] = $mrfData->address;
        $vars['position'] = $mrfData->position;

        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $vars['basicsalary'] = '';
        $vars['daysofwork'] = '';
        $vars['timeshift'] = '';
        $vars['breaks'] = '';
        $vars['breaktime'] = '';
        $vars['immediateposition'] = '';
        $vars['HRmanager'] = '';
                // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/non-disclosure_agreement.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/job_offer/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'non_disclosure_agreement' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }
    
    // pre_employment_checklist
    function export_pdf_pre_employment_checklist($process_id){
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Pre Employment Checklist' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $query = "SELECT recpro.request_id, recpro.recruit_id, rpo.start_date 
                FROM {$this->db->dbprefix}recruitment_process recpro
                LEFT JOIN {$this->db->dbprefix}recruitment_process_offer rpo
                ON rpo.process_id = recpro.process_id
                WHERE recpro.process_id = {$process_id}";
        $processData = $this->db->query($query)->row();
        $recruit_id = $processData->recruit_id;
        $request_id = $processData->request_id;

        $query = "SELECT uc.company, uc.company_code, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
                DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, 
                uprofile.firstname, uprofile.middlename, uprofile.lastname, uc.address
                FROM {$this->db->dbprefix}recruitment_request rreq
                LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
                LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
                LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
                LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();
        
        $appquery = "SELECT * FROM {$this->db->dbprefix}recruitment WHERE recruit_id = {$recruit_id} ";
        $appData = $this->db->query($appquery)->row();
    
        $vars['date'] = date('F d, Y');    
        $vars['firstname'] = $appData->firstname;
        $vars['lastname'] = $appData->lastname;
        $vars['middlename'] = $appData->middlename;    
        $middlename = $appData->middlename;
        $vars['recipients'] = $vars['firstname']." ".$vars['middlename'][0].". ".$vars['lastname'];
        
        $this->load->model('applicants_model');
   
        $vars['dear'] = $vars['firstname']." ".$vars['lastname'];
        $vars['company_code'] = $mrfData->company_code;
        $vars['company_address'] = $mrfData->address;
        $vars['position'] = $mrfData->position;

        $vars['start_date'] = '';
        $vars['end_probi_date'] = '';
        if(!empty($processData->start_date)){
            $vars['start_date'] = date('F d, Y', strtotime($processData->start_date));
            $vars['end_probi_date'] = date('F d, Y', strtotime('+6 months', $processData->start_date));
        }

        $vars['department'] = '';        
                // print_r($vars);

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
        $html = read_file(APPPATH.'templates/applicant_monitoring/en/pre-employment_checklist.txt');
       
        $this->load->library('parser');
        // $this->parser->set_delimiters('{$', '}');
        $html = $this->parser->parse_string($html, $vars, TRUE);

        // $html = $this->load->view("templates/applicant_monitoring/en/application_info_sheet", $pdata, true);
        
        $this->load->helper('file');
        $path = 'uploads/templates/job_offer/pdf/';
        $this->check_path( $path );
        $filename = $path .$process_id."-".$vars['position']. "-".'pre_employment_checklist' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }

    function get_active_mrf_by_year()
    {
        $user_id = $this->config->config['user']['user_id'];
        $permission = $this->config->item('permission');
        
        $is_assigned = isset($permission[$this->mod_code]['process']) ? $permission[$this->mod_code]['process'] : 0;
        $is_interviewer = $this->is_interviewer();

        $mrf = array();
       
        $qry = "SELECT a.*, b.position,b.position AS position_sought -- , rra.approver_id
        FROM {$this->db->dbprefix}recruitment_request a
        LEFT JOIN {$this->db->dbprefix}recruitment_process rp on a.request_id = rp.request_id
        -- LEFT JOIN {$this->db->dbprefix}recruitment_request_approver rra on rra.request_id = a.request_id
        LEFT JOIN {$this->db->dbprefix}users_position b on b.position_id = a.position_id";
        if($is_interviewer){
            $qry .= " JOIN {$this->db->dbprefix}recruitment_process_schedule ps on rp.process_id = ps.process_id AND ps.user_id = ".$this->user->user_id."";
            //$qry .= " LEFT JOIN {$this->db->dbprefix}recruitment_request_approver rra on rra.request_id = a.request_id ";
        }
        
        $qry .= " WHERE a.deleted=0 AND a.status_id IN (3,7) ";

/*        if($is_assigned){
             $qry .= " AND a.hr_assigned={$user_id}";
        }*/
        
        //if($is_interviewer){ $qry .= " AND (rra.approver_id = ".$this->user->user_id. " OR a.created_by = ".$this->user->user_id." OR ) GROUP BY a.request_id"; }

        $qry .= " GROUP BY a.request_id ORDER BY YEAR(a.created_on) DESC, a.created_on ASC";

        $mrfs = $this->db->query( $qry );
        
        foreach( $mrfs->result() as $_mrf )
        {
            $mrf[date('Y', strtotime($_mrf->created_on))][] = $_mrf;
        }
        
        return $mrf;
    }

    function get_applicants($request_id = false)
    {

/*        $query = "SELECT * FROM ww_recruitment
                    LEFT JOIN `ww_recruitment_personal` ON `ww_recruitment_personal`.`recruit_id` = `ww_recruitment`.`recruit_id` 
                    WHERE ww_recruitment.deleted = 0
                        AND (status_id = 11
                              OR ww_recruitment.recruit_id = (SELECT
                                                 r.recruit_id
                                               FROM ww_recruitment r
                                                 INNER JOIN ww_recruitment_request rr
                                                   ON r.request_id = rr.request_id
                                               WHERE r.status_id = 1
                                                   AND rr.status_id = 5))";*/

        $query = "SELECT * FROM ww_recruitment
                    LEFT JOIN `ww_recruitment_personal` ON `ww_recruitment_personal`.`recruit_id` = `ww_recruitment`.`recruit_id` 
                    WHERE ww_recruitment.deleted = 0
                        AND status_id IN (11)";

        if($request_id != false){
            $query .= " AND `ww_recruitment`.`request_id` = '{$request_id}'";
        }

        $query .= " GROUP BY ww_recruitment.recruit_id";
        
        $applicants = $this->db->query($query);

        if($applicants && $applicants->num_rows() > 0){
            $applicants = $applicants->result_array();
        }else{
            $applicants = array();
        }
        return $applicants;
    }

    function get_applicants_oth_position()
    {
        $query = "SELECT * FROM ww_recruitment
                    LEFT JOIN `ww_recruitment_personal` ON `ww_recruitment_personal`.`recruit_id` = `ww_recruitment`.`recruit_id` 
                    WHERE ww_recruitment.deleted = 0
                        AND (oth_position IS NOT NULL AND oth_position != '')
                        AND status_id = 11 GROUP BY ww_recruitment.recruit_id";
        $applicants = $this->db->query($query);

        if($applicants && $applicants->num_rows() > 0){
            $applicants = $applicants->result_array();
        }else{
            $applicants = array();
        }
        return $applicants;
    }

    function is_interviewer()
    {
        $user_id = $this->config->config['user']['user_id'];
        $permission = $this->config->item('permission');
        $is_interviewer = false;
        if(isset($permission[$this->mod_code]['approve'])){
            $is_interviewer = $permission[$this->mod_code]['approve'];

            if(isset($permission[$this->mod_code]['add']) && isset($permission[$this->mod_code]['edit'])){
                $is_interviewer = false;

            }

        }

        return $is_interviewer;

    }

    function get_recruitment_interview_details($id=0, $key_class_code=''){
        $this->db->select('interview_id, key_value')
        ->from('recruitment_interview_details')
        ->where("interview_id = '$id'")
        ->where("key = '$key_class_code'")
        ->where("deleted = 0");

        $get_recruitment_interview_details = $this->db->get('');    
        
        if( $get_recruitment_interview_details->num_rows() > 0 )
            return $get_recruitment_interview_details->row_array();
        else
            return array();
    }
}