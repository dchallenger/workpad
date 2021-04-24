<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resources extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('resources_model', 'mod');
		parent::__construct();
		$this->lang->load('resources');
	}

	public function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$permission = $this->config->item('permission');

		$data['all_permission'] = $permission;

		$this->load->vars($data); 

		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}

	function get_param_form()
	{
		$this->_ajax_only();

		$this->db->where('deleted',0);
		$this->db->where('active',1);
		$this->db->where('user_id !=',1);
		$this->db->order_by('full_name');
		$users = $this->db->get('users');

		$data['list_employee'] = $users;

		$this->db->where('users.deleted',0);
		$this->db->where('users.active',0);
		$this->db->where('users.user_id !=',1);
		$this->db->where('partners.status_id',8);
		$this->db->order_by('users.full_name');
		$this->db->join('partners','users.user_id = partners.user_id');
		$users = $this->db->get('users');

		$data['list_employee_resigned'] = $users;

		$this->response->quick_edit_form = $this->load->view('pages/param_form.blade.php', $data, true);
        $this->response->user_id = $this->user->user_id;

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

    function export()
    {
        $this->_ajax_only();

        ini_set('memory_limit', '1024M');   
        ini_set('max_execution_time', 1800);
        $this->load->library('Pdf');
        $user = $this->config->item('user');
        
        $pdf = new Pdf();
        $pdf->SetTitle('Certificate of employment');
        $pdf->SetFontSize(12,true);
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $pdf->SetDisplayMode('real', 'default');
		$pdf->SetMargins(38.1, 30, 25.4, true);

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
		
		$user_id = $this->input->post('user_id');
		$coe_type = $this->input->post('coe') ?? '';
		$reason_for_leaving = $this->input->post('reason_for_leaving') ?? '';
		$coe_type_description = $this->input->post('coe_description') ?? '';
		$unit = $this->input->post('unit') ?? '';
		$sticker_no = $this->input->post('sticker_no') ?? '';
		$coe_purpose = $this->input->post('purpose') ?? '';
		$display_name = $this->input->post('display_name') ?? '';

		if ($coe_type == '') {
	        $this->response->message[] = array(
	            'message' => 'Please select Type of Certificate',
	            'type' => 'error'
	        );			

	        $this->_ajax_return();
		}

		if ($user_id == '') {
	        $this->response->message[] = array(
	            'message' => 'Please select Employee.',
	            'type' => 'error'
	        );			
	        $this->_ajax_return();
		}

        $partner_record = "SELECT up.*, ud.department as dept, u.login, upos.position, p.effectivity_date as date_hired, 
        				p.employment_type,ppp.present_address,ppp.present_city_town,uc.address as company_address,
        				p.resigned_date, uc.company as comp, (aes_decrypt(`pp`.`salary`, encryption_key()) * 1) as 'basic', 
        				IF(`ub`.`company_coe` IS NOT NULL,`ub`.`company_coe`,`uc`.`company`) AS company_coe, uc.print_logo 
        				FROM {$this->db->dbprefix}users_profile up
                        INNER JOIN {$this->db->dbprefix}users_company uc ON up.company_id = uc.company_id
                        LEFT JOIN {$this->db->dbprefix}users_department ud ON up.department_id = ud.department_id
                        LEFT JOIN {$this->db->dbprefix}users u ON up.user_id = u.user_id
                        LEFT JOIN {$this->db->dbprefix}users_branch ub ON up.branch_id = ub.branch_id
                        LEFT JOIN {$this->db->dbprefix}users_position upos ON up.position_id = upos.position_id
                        LEFT JOIN {$this->db->dbprefix}partners p ON up.partner_id = p.partner_id
                        LEFT JOIN {$this->db->dbprefix}payroll_partners pp ON u.user_id = pp.user_id
                        LEFT JOIN partners_personal ppp on up.user_id = ppp.user_id
                        WHERE up.partner_id = {$user_id} ";
        $partner_record_result = $this->db->query($partner_record);

        if ($partner_record_result && $partner_record_result->num_rows() > 0){
        	$partner_record = $partner_record_result->row_array();

        	$logo  = ''; 
			if ($partner_record['print_logo'] != ''){
				if( file_exists( $partner_record['print_logo'] ) ){
					$logo = base_url().$partner_record['print_logo'];
				}
			}

			$hrd = get_hr_head();

	        $pdata['title'] = $partner_record['title'];
	        $pdata['employee_name'] = $partner_record['firstname']." ".substr($partner_record['middlename'],0, 1).". ".$partner_record['lastname'];
	        $pdata['position'] = $partner_record['position'] ?? '';
	        $pdata['division'] = $partner_record['v_division'] ?? '';
	        $pdata['location'] = $partner_record['v_location'] ?? '';
	        $pdata['employment_type'] = $partner_record['employment_type'] ?? '';
	        $pdata['date_hired'] =  ($partner_record['date_hired'] && $partner_record['date_hired'] != '0000-00-00' && $partner_record['date_hired'] != 'January 01, 1970' && $partner_record['date_hired'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['date_hired'])) : '';
	        $pdata['resigned_date'] = ($partner_record['resigned_date'] && $partner_record['resigned_date'] != '0000-00-00' && $partner_record['resigned_date'] != 'January 01, 1970' && $partner_record['resigned_date'] != '1970-01-01') ? date('F d, Y', strtotime($partner_record['resigned_date'])) : '';
	        $pdata['gender'] = $partner_record['title'];
	        $pdata['company'] = $partner_record['company_coe'] ?? '';
	        $pdata['company_address'] = $partner_record['company_address'] ?? '';
	        $pdata['basic'] = $partner_record['basic'];
	        $pdata['logo'] = $logo;
	        $pdata['basic_in_words'] = strtoupper(convert_number_to_words($partner_record['basic']));
	        $pdata['filled_date'] = date('F d, Y');
	        $pdata['day'] = date('j\<\s\u\p\>S\<\/\s\u\p\>');
	        $pdata['month_year'] = date('F Y');
	        $pdata['her_his_caps'] = ($partner_record['title'] == 'Mr.') ? 'His' : 'Her';
	        $pdata['she_he_caps'] = ($partner_record['title'] == 'Mr.') ? 'He' : 'She';
	        $pdata['she_he'] = ($partner_record['title'] == 'Mr.') ? 'he' : 'she';
	        $pdata['his_her'] = ($partner_record['title'] == 'Mr.') ? 'his' : 'her';
	        $pdata['title_lastname'] = $partner_record['title'] ." ". $partner_record['lastname'] ?? '';
	        $pdata['purpose'] = $coe_purpose;
	        $pdata['reason_for_leaving'] = $reason_for_leaving;
	        $pdata['benefits'] = ''; // for clarrification
	        $pdata['annual_gross'] = convert_number_to_words(256120); // after payroll done, should remove comma and period
	        $pdata['annual_gross_amount'] = currency_format(256120); // after payroll done, should remove comma and period
	        $pdata['hrd'] = $hrd['full_name'];
	        $pdata['hrd_position'] = $hrd['position'];
	        $pdata['unit'] = $unit;
	        $pdata['stikcer_number'] = $sticker_no;
	        $pdata['address'] = $partner_record['present_address'];
	        $pdata['city'] = $partner_record['present_city_town'];

	        $allowances = "SELECT SUM(aes_decrypt(`pere`.`amount`, encryption_key()) * 1) AS total_alowance FROM {$this->db->dbprefix}payroll_entry_recurring per
	        			   LEFT JOIN {$this->db->dbprefix}payroll_entry_recurring_employee pere ON per.recurring_id = pere.recurring_id
	        			   WHERE pere.employee_id = {$user_id} AND per.transaction_id IN (231,232,249,250,251)";

	        $alowances = $this->db->query($allowances);

	        $total_alowance = 0.00;
	        if ($alowances && $alowances->num_rows() > 0){
	        	$alowance_row = $alowances->row();
	        	$total_alowance = $alowance_row->total_alowance;
	        }

	        $pdata['total_alowance'] = $total_alowance;
	        $pdata['gross'] = $partner_record['basic'] + $total_alowance;

	        switch ($coe_type) {
	        	case 'coe_w_compensation':
	        		$html = $this->load->view("templates/coe_w_compensation", $pdata, true);
	        		break;
	        	case 'coe_wo_compensation':
	        		$html = $this->load->view("templates/coe_wo_compensation", $pdata, true);
	        		break;
	        	case 'cov':
	        		$html = $this->load->view("templates/co_vehicle_assignment", $pdata, true);
	        		break;
	        	case 'cfr':
	        		$html = $this->load->view("templates/co_resigned", $pdata, true);
	        		break;
	        	case 'cmb':
	        		$html = $this->load->view("templates/coe_maternity_benefit", $pdata, true);
	        		break;
	        	case 'cea':
	        		$html = $this->load->view("templates/coe_employee_address", $pdata, true);
	        		break;
	        	default:
	        		$html = '';
	        		break;        		
	        }

	        $pdf->AddPage('P','A4',true);
	        $this->load->helper('file');
	        
	        $path = 'uploads/reports/coe/pdf/';

	        $main_path = PPATH . 'uploads/reports/coe/pdf/';
	        
	        $this->check_path( $path );

	        $filename = $path . strtotime(date('Y-m-d H:i:s')) . '-' . "coe.pdf";
	        $main_filename = $main_path . strtotime(date('Y-m-d H:i:s')) . '-' . "coe.pdf";

	        $pdf->writeHTML($html, true, false, true, false, '');

	        
	        $pdf->Output($main_filename, 'F');

	        $this->response->message[] = array(
	            'message' => 'Download file ready.',
	            'type' => 'success'
	        );


            $insert = array(
            	'user_id' => $user_id,
            	'display_name' => $display_name,
            	'coe_type_code' => $coe_type,
            	'coe_type' => $coe_type_description,
            	'purpose' => $coe_purpose,
            	'unit' => $unit,
            	'sticker_no' => $sticker_no,
                'filename' => $filename,
                'created_by' => $this->user->user_id
            );

            $this->db->insert('certificate_of_employment', $insert);
            $insert_id = $this->db->insert_id();

	        $this->response->filename = $filename;

	        $this->_ajax_return();
    	}
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
}