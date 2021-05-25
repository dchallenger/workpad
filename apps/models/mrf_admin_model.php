<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class mrf_admin_model extends Record
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
		$this->mod_id = 123;
		$this->mod_code = 'mrf_admin';
		$this->route = 'recruitment/mrf_admin';
		$this->url = site_url('recruitment/mrf_admin');
		$this->primary_key = 'request_id';
		$this->table = 'recruitment_request';
		$this->icon = 'fa-folder';
		$this->short_name = 'Manpower Requisition - Admin';
		$this->long_name  = 'Manpower Requisition - Admin';
		$this->description = '';
		$this->path = APPPATH . 'modules/mrf_admin/';

		parent::__construct();
	}

	function _get_list($start, $limit, $search, $filter, $trash = false, $dt_filter = '')
	{
		
        $data = array();				
		$user_id = $this->config->config['user']['user_id'];
        $permission = $this->config->item('permission');
        
		$qry = $this->_get_list_cached_query();
		
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}
		
		if(is_array($filter)) {
			foreach ($filter as $filter_key => $filter_value) {
				$qry .= ' AND '.$this->db->dbprefix.'recruitment_request.'. $filter_value;
			}
		}	
		
/*		if($this->hr_assigned()){
			 $qry .= " AND {$this->db->dbprefix}{$this->table}.hr_assigned = ".$user_id;
		}*/

		if( $this->user->user_id != 1 )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.status_id <> 1";
		}

		if($dt_filter != "")
			$qry .= ' AND '.$this->db->dbprefix.'recruitment_request.created_on LIKE "%'. $dt_filter . '%"';

		$qry .= " ORDER BY " .$this->db->dbprefix. "recruitment_request.created_on DESC";
		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);
		//echo "<pre>";print_r($qry);exit;
		$result = $this->db->query( $qry );
		if($result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}

	function get_recruitment_request_key_value($request_id=0, $key=''){

		$this->db->select('key_value')
	    ->from('recruitment_request_details ')
	    ->join('recruitment_request', 'recruitment_request_details.request_id = recruitment_request.request_id', 'left')
	    ->join('recruitment_request_key', 'recruitment_request_details.key_id = recruitment_request_key.key_id', 'left')
	    ->where("recruitment_request.request_id = $request_id")
	    ->where("recruitment_request_key.key_code = '$key'");
	    // ->where("recruitment_request_details.deleted = 0");

	    $recruitment_request = $this->db->get('');	

		if( $recruitment_request->num_rows() > 0 )
	    	return $recruitment_request->result_array();
	    else
	    	return array();
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
	
    // mrf
    function export_pdf_mrf($request_id){
    	$user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf=new PDFm();

        $mpdf->SetTitle( 'Personnel Requisition Form' );
        $mpdf->SetAutoPageBreak(true, 1);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();
        // $mpdf->SetMargins(5, 5, 5);

        // $this->load->library('Pdf');
        // $pdf = new Pdf();
        // $pdf->SetTitle( 'Application Info Sheet' );
        // $pdf->SetFontSize(10,true);
        // $pdf->SetAutoPageBreak(true, 1);
        // $pdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        // $pdf->SetDisplayMode('real', 'default');

        // $pdf->SetPrintHeader(false);
        // $pdf->SetPrintFooter(false);
        // $pdf->AddPage();
        // $pdf->setPageOrientation('P');

        $query = "SELECT rreq.document_no, rreq.nature_id, rreq.due_to_id,DATE_FORMAT(rreq.hr_remarks_on, '%M %d, %Y') as hr_remarks_on,rreq.replacement_transfer_leave_date_from as leave_date_from,rreq.replacement_transfer_leave_date_to as leave_date_to, uc.company, ud.department, DATE_FORMAT(rreq.date_approved, '%M %d, %Y') as date_approved,
        		rreq.created_on as created_on,rreq.age_range_from as age_from,rreq.age_range_to as age_to,rreq.gender as gender,pcs.civil_status as civil_status,rreq.educational_attainment as educational_attainment,rreq.max_no_personel as max_personel,rreq.total_no_incumbent as total_no_incumbent,
        		rreq.salary_from, rreq.salary_to, DATE_FORMAT(rreq.date_needed, '%M %d, %Y') as date_needed, up.position, DATE_FORMAT(rreq.closed_on, '%M %d, %Y') as closed_on, rreq.quantity,
        		rreq.replacement_of, uprofile.firstname, uprofile.middlename, uprofile.lastname, uprofile.reports_to_id, pes.employment_status
				FROM {$this->db->dbprefix}recruitment_request rreq
				LEFT JOIN {$this->db->dbprefix}partners_civil_status pcs ON pcs.civil_status_id = rreq.civil_status_id
				LEFT JOIN {$this->db->dbprefix}users_company uc ON uc.company_id = rreq.company_id
				LEFT JOIN {$this->db->dbprefix}users_department ud ON ud.department_id = rreq.department_id
				LEFT JOIN {$this->db->dbprefix}users_position up ON up.position_id = rreq.position_id
				LEFT JOIN {$this->db->dbprefix}users_profile uprofile ON uprofile.user_id = rreq.user_id
                LEFT JOIN {$this->db->dbprefix}partners_employment_status pes ON pes.employment_status_id = rreq.employment_status_id
                WHERE rreq.request_id = {$request_id}";

        $mrfData = $this->db->query($query)->row();

        $replace = '';
        if ($mrfData->replacement_of > 0) {
            $this->db->where('user_id', $mrfData->replacement_of);
            $this->db->from('users_profile');
            $this->db->limit(1);
            $replacement_of = $this->db->get('');
            if( $replacement_of->num_rows() > 0 ){
                $replacement = $replacement_of->row();
                $replace = $replacement->lastname.', '.$replacement->firstname;
            }
        }

        $vars['company'] = $mrfData->company;
        $vars['department'] = ucwords($mrfData->department);
        $vars['section'] = 'RECRUITMENT';
        $vars['date_approved'] = $mrfData->date_approved;
        $vars['date_needed'] = $mrfData->date_needed;
        $vars['position'] = $mrfData->position;
        $vars['document_no'] = $mrfData->document_no;
        $vars['hr_remarks_on'] = $mrfData->hr_remarks_on;
        $vars['employment_status'] = $mrfData->employment_status;
        $vars['salaryrange'] = $mrfData->salary_from.' - '.$mrfData->salary_to;
        $vars['closed_on'] = $mrfData->closed_on;
        $vars['quantity'] = $mrfData->quantity;
        $vars['replacement_employee'] = $replace;
        $vars['leave_date_from'] = ($mrfData->leave_date_from != '1970-01-01') ? date('Y m d',strtotime($mrfData->leave_date_from)): '';
        $vars['leave_date_to'] = ($mrfData->leave_date_to != '1970-01-01') ? date('Y m d',strtotime($mrfData->leave_date_to)): '';;
        $vars['age_range'] = $mrfData->age_from .' to '. $mrfData->age_to;
        $vars['gender'] = $mrfData->gender;
        $vars['civil_status'] = $mrfData->civil_status;
        $vars['educ_attainment'] = $mrfData->educational_attainment;
        $vars['max_personel'] = $mrfData->max_personel;
        $vars['total_no_incumbent'] = $mrfData->total_no_incumbent;
        $vars['requested_date'] = date('M d Y',strtotime($mrfData->created_on));
        $budgeted = $this->get_recruitment_request_key_value($request_id, 'budgeted');
		$vars['budget'] = (count($budgeted) == 0 ? " " : ($budgeted[0]['key_value'] == "" ? "" : $budgeted[0]['key_value']));
        $vars['budgeted']  = $vars['budget'] != 1 ? "checked=checked" : "";
        $vars['unbudgeted']  = $vars['budget'] == 1 ? "checked=checked" : "";
        $vars['date'] = 'MARCH 01, 2013';
        $vars['new_position'] = $mrfData->nature_id == 1 ? 'X' : "";
        $vars['replacement'] = $mrfData->nature_id == 5 ? 'X' : "";
        $vars['additional'] = $mrfData->nature_id == 4 ? 'X' : "";
        $prob = '';
        $reg = '';
        $proj = '';
        $cas = '';

        switch ($mrfData->employment_status) {
        	case 'PROBATIONARY':
        		$prob = 'X';
        		break;
        	case 'PERMANENT':
        		$reg = 'X';
        		break;
        	case 'CONTRACTUAL':
        		$proj = 'X';
        		break;
        	case 'CASUAL':
        		$cas = 'X';
        		break;
        }

        $vars['prob'] = $prob;
        $vars['reg'] = $reg;
        $vars['proj'] = $proj;
        $vars['cas'] = $cas;

        $due_to_resignation = '';
        $due_to_retirement = '';
        $due_to_termination = '';
        $due_to_transfer = '';
        $due_to_leave = '';

        switch ($mrfData->due_to_id) {
        	case 1:
        		$due_to_resignation = 'X';
        		break;
        	case 2:
        		$due_to_retirement = 'X';
        		break;
        	case 3:
        		$due_to_termination = 'X';
        		break;
        	case 4:
        		$due_to_transfer = 'X';
        		break;
        	case 5:
        		$due_to_leave = 'X';
        		break;        		
        }

        $vars['due_to_resignation'] = $due_to_resignation;
        $vars['due_to_retirement'] = $due_to_retirement;
        $vars['due_to_termination'] = $due_to_termination;
        $vars['due_to_transfer'] = $due_to_transfer;
        $vars['due_to_leave'] = $due_to_leave;

        $key_requirements = $this->get_recruitment_request_key_value($request_id, 'key_requirements');
        $key_requirements = (count($key_requirements) == 0 ? " " : ($key_requirements[0]['key_value'] == "" ? "" : $key_requirements[0]['key_value']));
        $key_requirements = unserialize($key_requirements);
        $vars['key_requirements1'] = $key_requirements[0];
        $vars['key_requirements2'] = $key_requirements[1];
        $vars['key_requirements3'] = $key_requirements[2];

        $key_requirement = '';
        if ($key_requirements[0] != ''){
        	$key_requirement .= '<tr><td style="" colspan="4">'.$key_requirements[0].'</td></tr>';
        }
        if ($key_requirements[1] != ''){
        	$key_requirement .= '<tr><td style="" colspan="4">'.$key_requirements[1].'</td></tr>';
        }
        if ($key_requirements[2] != ''){
        	$key_requirement .= '<tr><td style="" colspan="4">'.$key_requirements[2].'</td></tr>';
        }                

        $vars['key_requirement'] = $key_requirement;

        $optional_requirements = $this->get_recruitment_request_key_value($request_id, 'optional_requirements');
        $optional_requirements = (count($optional_requirements) == 0 ? " " : ($optional_requirements[0]['key_value'] == "" ? "" : $optional_requirements[0]['key_value']));
        $optional_requirements = unserialize($optional_requirements);
        $vars['optional_requirements1'] = $optional_requirements[0];
        $vars['optional_requirements2'] = $optional_requirements[1];
        $vars['optional_requirements3'] = $optional_requirements[2];

        $specification = '';
        if ($optional_requirements[0] != ''){
        	$specification .= '<tr><td style="" colspan="4">'.$optional_requirements[0].'</td></tr>';
        }
        if ($optional_requirements[1] != ''){
        	$specification .= '<tr><td style="" colspan="4">'.$optional_requirements[1].'</td></tr>';
        }
        if ($optional_requirements[2] != ''){
        	$specification .= '<tr><td style="" colspan="4">'.$optional_requirements[2].'</td></tr>';
        }                

        $vars['specification'] = $specification;

        // $sourcing_tools = $this->get_recruitment_request_key_value($request_id, 'sourcing_tools');
        // $sourcing_tools = count($sourcing_tools) == 0 ? " " : $sourcing_tools[0]['key_value'] == "" ? "" : $sourcing_tools[0]['key_value'];
        // $sourcing_tools = unserialize($sourcing_tools);

        // foreach($sourcing_tools as $sourcing_tool):
        //     $this->db->where('sourcing_tool_id', $sourcing_tool);
        //     $this->db->from('recruitment_sourcing_tools', $sourcing_tool);
        //     $sourcing_tools = $this->db->get('');
        // endforeach; 

        $job_description = $this->get_recruitment_request_key_value($request_id, 'job_description');
		$vars['job_description'] = (count($job_description) == 0 ? " " : ($job_description[0]['key_value'] == "" ? "" : $job_description[0]['key_value']));
        $middlename = $mrfData->middlename;
        $vars['requested_by'] = $mrfData->firstname." ".$middlename[0].". ".$mrfData->lastname;
		
	 	$hr_qry = "SELECT up.* FROM {$this->db->dbprefix}users_profile up
						LEFT JOIN {$this->db->dbprefix}users_position pos ON up.position_id = pos.position_id
                        LEFT JOIN {$this->db->dbprefix}users u ON u.user_id = up.user_id
						WHERE pos.position_code = 'HRM-RES' AND u.active = 1";
	 	$hr = $this->db->query($hr_qry)->row_array();
		$vars['HRmanager'] = $hr['firstname'].' '.$hr['lastname'];

       	$immediate = $this->db->get_where( 'users_profile', array( 'user_id' => $mrfData->reports_to_id) )->row_array();
		$vars['subHead'] = $immediate['firstname'].' '.$immediate['lastname'];

		$approver1 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$approver2 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$approver3 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$approver1_date = '';
		$approver2_date = '';
		$approver3_date = '';

		$this->db->select('*,recruitment_request_approver.modified_on AS approver_modified_on',false);
		$this->db->where('request_id',$request_id);
		$this->db->where('recruitment_request_approver.deleted',0);
		$this->db->where('users.deleted',0);
		$this->db->order_by('sequence');
		$this->db->join('users','recruitment_request_approver.approver_id = users.user_id','left');
		$approver_result = $this->db->get('recruitment_request_approver');
		if ($approver_result && $approver_result->num_rows() > 0){
			foreach ($approver_result->result() as $row) {
				switch ($row->sequence) {
					case 1:
						$approver1 = $row->full_name;
						$approver1_date = ($row->approver_modified_on != '' && $row->approver_modified_on != '1970-01-01') ? date('M d Y',strtotime($row->approver_modified_on)): '';
						break;
					case 2:
						$approver2 = $row->full_name;
						$approver2_date = ($row->approver_modified_on != '' && $row->approver_modified_on != '1970-01-01') ? date('M d Y',strtotime($row->approver_modified_on)): '';
						break;
					case 3:
						$approver3 = $row->full_name;
						$approver3_date = ($row->approver_modified_on != '' && $row->approver_modified_on != '1970-01-01') ? date('M d Y',strtotime($row->approver_modified_on)): '';
						break;
				}
			}
		}

		$this->db->where('recruitment_process.request_id',$request_id);
		$this->db->where('recruitment_process.deleted',0);
		$this->db->where('recruitment.deleted',0);
		$this->db->join('recruitment','recruitment_process.recruit_id = recruitment.recruit_id','left');
		$applicant_result = $this->db->get('recruitment_process');

		$applicants = '';
		if ($applicant_result && $applicant_result->num_rows() > 0){
			foreach ($applicant_result->result() as $row) {
				$applicants .= '<tr>
		                <td style="border-right: 1px solid #e4e4e4;border-top: 1px solid #e4e4e4;width:50%">'.$row->lastname.' '.$row->firstname.'</td>
		                <td style="border-right: 1px solid #e4e4e4;border-top: 1px solid #e4e4e4;width:25%">'.($row->hired_when != '0000-00-00 00:00:00' ? date('Y m d',strtotime($row->hired_when)) : '').'</td>
		                <td style="border-top: 1px solid #e4e4e4;width:25%"></td>
		            </tr>';
			}
		}

		$vars['approver1'] = $approver1;
		$vars['approver2'] = $approver2;
		$vars['approver3'] = $approver3;
		$vars['approver1_date'] = $approver1_date;
		$vars['approver2_date'] = $approver2_date;
		$vars['approver3_date'] = $approver3_date;
		$vars['classification'] = '';
		$vars['reportingto'] = '';
		$vars['supervises'] = '';
		$vars['applicants'] = $applicants;

        // $pdata['query'] = $this->db->query($query);
        $this->load->helper('file');
		$this->load->library('parser');
        // $html = read_file(APPPATH.'templates/mrf/en/mrf.txt');
       	$mrf_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-FORM') )->row_array();
		$this->parser->set_delimiters('{{', '}}');
		$html = $this->parser->parse_string($mrf_template['body'], $vars, TRUE);
		// $msg = $this->parser->parse_string($interviewer_template['body'], $joData, TRUE);
		
        $this->load->helper('file');
        $path = 'uploads/templates/mrf/pdf/';
        $this->check_path( $path );
        $filename = $path .$request_id."-".$vars['position']. "-".'mrf' .".pdf";
        // $pdf->writeHTML($html, true, false, false, false, '');
        // $pdf->Output($filename, 'F');  

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        return $filename;
    }

    function hr_assigned()
    {
    	$this->load->model('applicant_monitoring_model', 'applicant_monitoring');

    	$user_id = $this->config->config['user']['user_id'];
        $permission = $this->config->item('permission');
        $is_assigned = isset($permission[$this->applicant_monitoring->mod_code]['process']) ? $permission[$this->applicant_monitoring->mod_code]['process'] : 0;

        return $is_assigned;
    }

    function get_recruitment_config($key)
    {
    	$this->db->where('key', $key);
    	$this->db->limit('1');
    	$config = $this->db->get('config');

    	if($config && $config->num_rows() > 0){
    		$config = $config->row();
    		return $config->value;
    	}
    	
    	return false;
    }

    function change_status( $record_id=0, $status_id=0, $comment="", $hr_admin = 0)
    {
        $response = new stdClass();
        $req = $this->db->get_where('recruitment_request', array('request_id' => $record_id))->row();
        $req_by = $this->db->get_where('users', array('user_id' => $req->user_id))->row();

        //get approvers
        $where = array(
            'request_id' => $record_id
        );
        $this->db->order_by('sequence');
        $approvers = $this->db->get_where('recruitment_request_approver', $where)->result();
        $fstapprover = $approvers[0];
        $no_approvers = sizeof($approvers);
        $condition = $approvers[0]->condition;

        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');
                
        $response->redirect = false;
        $this->load->model('system_feed');
        $modified_on = date('Y-m-d H:i:s');
        switch( $status_id )
        {
            case 3: //approved
                //bring it up
                foreach(  $approvers as $index => $approver )
                {
                    $this->db->update('recruitment_request_approver', array('status_id' => 3,'comment'=>$comment,'modified_on'=>$modified_on,'status'=>"Approved"), array('id' => $approver->id));

                    $feed = array(
                        'status' => 'info',
                        'message_type' => 'Recruitment',
                        'user_id' => $req->user_id,
                        'feed_content' => 'Filed recruitment request has been approved by HR.',
                        'uri' => $this->mod->route . '/view/'.$record_id,
                        'recipient_id' => $approver->approver_id
                    );
                    $recipients = array($approver->approver_id);
                    $this->system_feed->add( $feed, $recipients );

                    $response->notify[] = $approver->approver_id;

                     // start email to approver
                    $approvers_user_info = $this->db->get_where('users', array('user_id' => $approver->approver_id));
                    if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
                        $approvers_details = $approvers_user_info->row();
                        $approver_fullname = $approvers_details->full_name;
                    }          
                                      
                    $sendmrfdata['requestor'] = $req_by->full_name;
                    $sendmrfdata['approver'] = $approver_fullname;
                    $sendmrfdata['status'] = 'Approved';

                    $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-HR-SEND-APPROVED') )->row_array();
                    $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                    $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                    //create system logs
                    $insert_array = array(
                        'to' => $approvers_details->email, 
                        'subject' => $subject, 
                        'body' => $msg
                        );
                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);
                }

                $response->redirect = true;
                break;
            case 6: //cancel
                $feed = array(
                    'status' => 'info',
                    'message_type' => 'Recruitment',
                    'user_id' => $req->user_id,
                    'feed_content' => 'The Personnel Requisition Form you requested has been cancelled by HR.',
                    'uri' => get_mod_route( 'mrf', '', false) . '/edit/'.$record_id,
                    'recipient_id' => $req->user_id
                );

                $recipients = array($req->user_id);
                $this->system_feed->add( $feed, $recipients );
                $response->notify[] = $req->user_id;
                $response->redirect = true;

                 // start email to requestor
                $sendmrfdata['requestor'] = $req_by->full_name;
                $sendmrfdata['approver'] = 'HR';
                $sendmrfdata['status'] = 'Disapproved';

                $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-SEND-CANCEL-APPROVED') )->row_array();
                $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                         VALUES('{$req_by->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                //create system logs
                $insert_array = array(
                    'to' => $req_by->email, 
                    'subject' => $subject, 
                    'body' => $msg
                    );
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);            

                foreach(  $approvers as $index => $approver ) {
                    $where = array(
                        'request_id' => $record_id,
                        'user_id' => $req->user_id,
                        'approver_id' => $approver->approver_id
                    );
                    $this->db->update('recruitment_request_approver', array('status_id' => 6,'modified_on'=>$modified_on,'status'=>"Cancel"), $where);
                    if( $this->db->affected_rows() == 1 )
                    {
                         // start email to approver
                        $approvers_user_info = $this->db->get_where('users', array('user_id' => $approver->approver_id));
                        if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
                            $approvers_details = $approvers_user_info->row();
                            $approver_fullname = $approvers_details->full_name;
                        }          
                                          
                        $sendmrfdata['requestor'] = $req_by->full_name;
                        $sendmrfdata['approver'] = 'HR';

                        $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-SEND-CANCEL') )->row_array();
                        $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                        $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        //create system logs
                        $insert_array = array(
                            'to' => $approvers_details->email, 
                            'subject' => $subject, 
                            'body' => $msg
                            );
                        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);
                    }
                }
                break;
           case 7: // validated
                $where = array(
                    'request_id' => $record_id,
                    'user_id' => $req->user_id,
                    'approver_id' => $this->user->user_id
                );
                $this->db->update('recruitment_request_approver', array('status_id' => 7,'comment'=>$comment,'modified_on'=>$modified_on,'status'=>"Validated"), $where);
                if( $this->db->affected_rows() == 1 )
                {
                    $feed = array(
                        'status' => 'info',
                        'message_type' => 'Recruitment',
                        'user_id' => $req->user_id,
                        'feed_content' => 'The Personnel Requisition Form you requested has been validated.',
                        'uri' => get_mod_route( 'mrf', '', false) . '/edit/'.$record_id,
                        'recipient_id' => $req->user_id
                    );

                    $recipients = array($req->user_id);
                    $this->system_feed->add( $feed, $recipients );
                    $response->notify[] = $req->user_id;
                    $response->redirect = true;

                    // start email to requestor
                    $approvers_user_info = $this->db->get_where('users', array('user_id' => $this->user->user_id));
                    if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
                        $approvers_details = $approvers_user_info->row();
                        $approver_fullname = $approvers_details->full_name;
                    }          
                                      
                    $sendmrfdata['requestor'] = $req_by->full_name;
                    $sendmrfdata['approver'] = $approver_fullname;

                    $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-SEND-APPROVER') )->row_array();
                    $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                    $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                    //create system logs
                    $insert_array = array(
                        'to' => $approvers_details->email, 
                        'subject' => $subject, 
                        'body' => $msg
                        );
                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);                 
                }                
            case 8: // disapproved
                $feed = array(
                    'status' => 'info',
                    'message_type' => 'Recruitment',
                    'user_id' => $req->user_id,
                    'feed_content' => 'The Personnel Requisition Form you requested has been disapproved by HR.',
                    'uri' => get_mod_route( 'mrf', '', false) . '/edit/'.$record_id,
                    'recipient_id' => $req->user_id
                );

                $recipients = array($req->user_id);
                $this->system_feed->add( $feed, $recipients );
                $response->notify[] = $req->user_id;
                $response->redirect = true;

                 // start email to requestor
                $sendmrfdata['requestor'] = $req_by->full_name;
                $sendmrfdata['approver'] = 'HR';
                $sendmrfdata['status'] = 'Disapproved';

                $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-HR-SEND-APPROVED') )->row_array();
                $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                         VALUES('{$req_by->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");

                foreach(  $approvers as $index => $approver ) {
                    $where = array(
                        'request_id' => $record_id,
                        'user_id' => $req->user_id,
                        'approver_id' => $approver->approver_id
                    );
                    $this->db->update('recruitment_request_approver', array('status_id' => 8,'comment'=>$comment,'modified_on'=>$modified_on,'status'=>"Disapproved"), $where);
                    if( $this->db->affected_rows() == 1 )
                    {
                        $this->db->update('recruitment_request', array('status_id' => $status_id, 'hr_approved' => $this->user->user_id, 'date_disapproved' => date('Y-m-d H:i:s')), array('request_id' => $record_id));                   
                        // start email to requestor
                        $approvers_user_info = $this->db->get_where('users', array('user_id' => $approver->approver_id));
                        if ($approvers_user_info && $approvers_user_info->num_rows() > 0){
                            $approvers_details = $approvers_user_info->row();
                            $approver_fullname = $approvers_details->full_name;
                        }          
                                          
                        $sendmrfdata['requestor'] = $req_by->full_name;
                        $sendmrfdata['approver'] = $approver_fullname;
                        $sendmrfdata['status'] = 'Disapproved';

                        $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-HR-SEND-APPROVED') )->row_array();
                        $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
                        $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approvers_details->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        //create system logs
                        $insert_array = array(
                            'to' => $approvers_details->email, 
                            'subject' => $subject, 
                            'body' => $msg
                            );
                        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'system_email_queue', array(), $insert_array);                 
                    }
                }
        }
    
        if( $status_id == 3 )
        {
            $feed = array(
                'status' => 'info',
                'message_type' => 'Recruitment',
                'user_id' => $req->user_id,
                'feed_content' => 'The Personnel Requisition Form you requested has been approved by HR.',
                'uri' => get_mod_route( 'mrf', '', false) . '/edit/'.$record_id,
                'recipient_id' => $req->user_id
            );

            $recipients = array($req->user_id);
            $this->system_feed->add( $feed, $recipients );
            $response->notify[] = $req->user_id;

             // start email to requestor
            $sendmrfdata['requestor'] = $req_by->full_name;
            $sendmrfdata['approver'] = 'HR';
            $sendmrfdata['status'] = 'Approved';

            $mrf_send_template = $this->db->get_where( 'system_template', array( 'code' => 'MRF-SEND-CANCEL-APPROVED') )->row_array();
            $msg = $this->parser->parse_string($mrf_send_template['body'], $sendmrfdata, TRUE); 
            $subject = $this->parser->parse_string($mrf_send_template['subject'], $sendmrfdata, TRUE); 

            $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                     VALUES('{$req_by->email}', '{$subject}', '".$this->db->escape_str($msg)."') ");

            $this->db->update('recruitment_request', array('status_id' => $status_id, 'hr_approved' => $this->user->user_id, 'date_approved' => date('Y-m-d H:i:s')), array('request_id' => $record_id));

            if( $this->db->_error_message() != "" )
            {
                $response->message[] = array(
                    'message' => $this->db->_error_message(),
                    'type' => 'error'
                );
            }
        }

        return $response;
    }    
}