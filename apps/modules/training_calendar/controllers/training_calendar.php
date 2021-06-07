<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_calendar extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_calendar_model', 'mod');
		$this->load->model('training_calendar_manage_model', 'tcmm');
		$this->load->model('training_calendar_admin_model', 'tcam');
		parent::__construct();
	}

	function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

        $user_setting = APPPATH . 'config/users/'. $this->user->user_id .'.php';
        $user_id = $this->user->user_id;
        $this->load->config( "users/{$user_id}.php", false, true );
        $user = $this->config->item('user');

        $this->load->config( 'roles/'. $user['role_id'] .'/permission.php', false, true );
        $permission = $this->config->item('permission');

/*		$this->db->order_by('type', 'asc');
		$partners_movement_type = $this->db->get_where('partners_movement_type', array('deleted' => 0));
		$data['partners_movement_type'] = $partners_movement_type->result();

		$this->db->order_by('cause', 'asc');
		$partners_movement_cause = $this->db->get_where('partners_movement_cause', array('deleted' => 0));
		$data['partners_movement_cause'] = $partners_movement_cause->result();
*/
        $data['training_calendar'] = isset($this->permission['list']) ? $this->permission['list'] : 0;
        $data['training_calendar_manage'] = isset($permission[$this->tcmm->mod_code]['list']) ? $permission[$this->tcmm->mod_code]['list'] : 0;
        $data['training_calendar_admin'] = isset($permission[$this->tcam->mod_code]['list']) ? $permission[$this->tcam->mod_code]['list'] : 0;

		$this->load->vars( $data );
		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}	

	function edit($record_id = "", $child_call = false){
		
		parent::edit( '', true );

		//get sections if there are any
		$training_cost_tab = array();

		$this->db->order_by('calendar_budget_id');
		$training_costs = $this->db->get_where('training_calendar_budget', array('training_calendar_id' => $this->record_id));

		if($training_costs->num_rows() > 0){
			$training_cost_tab = $training_costs->result_array();
		}

		$data['training_cost_tab'] = $training_cost_tab;
		$data['calendar_id'] = $this->record_id;
		$data['cost_count'] = $this->input->post('cost_count');

		$session_tab = array();

		$this->db->order_by('calendar_session_id');
		$sessions = $this->db->get_where('training_calendar_session', array('training_calendar_id' => $this->record_id));

		if($sessions->num_rows() > 0){
			$session_tab = $sessions->result_array();
		}

		$data['session_tab'] = $session_tab;
		$data['training_calendar_id'] = $this->record_id;
		$data['session_count'] = $this->input->post('session_count');

		$this->load->vars($data);
		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
	}

	function detail($record_id, $child_call = false){
		parent::detail( '', true );

		//get sections if there are any
		$training_cost_tab = array();

		$this->db->order_by('calendar_budget_id');
		$training_costs = $this->db->get_where('training_calendar_budget', array('training_calendar_id' => $this->record_id));

		if($training_costs->num_rows() > 0){
			$training_cost_tab = $training_costs->result_array();
		}

		$data['training_cost_tab'] = $training_cost_tab;
		$data['calendar_id'] = $this->record_id;

		$session_tab = array();

		$this->db->order_by('calendar_session_id');
		$sessions = $this->db->get_where('training_calendar_session', array('training_calendar_id' => $this->record_id));

		if($sessions->num_rows() > 0){
			$session_tab = $sessions->result_array();
		}

		$data['session_tab'] = $session_tab;
		$data['training_calendar_id'] = $this->record_id;
		$data['session_count'] = $this->input->post('session_count');

		$this->load->vars($data);
		$this->load->helper('form');
		$this->load->helper('file');
		echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
	}

	function _rebuild_array($array, $fkey = null, $key_field = '' )
	{
		if (!is_array($array)) {
			return array();
		}

		$new_array = array();

		$count = count(end($array));
		$index = 0;

		while ($count >= $index) {
			foreach ($array as $key => $value) {

				if( isset( $array[$key][$index] ) ){

					$new_array[$index][$key] = $array[$key][$index];
					if (!is_null($fkey) && !empty($key_field)) {
						$new_array[$index][$key_field] = $fkey;
					}

				}
				else{

					continue;

				}
			}

			$index++;
		}

		return $new_array;
	}

	public function get_training_course_info(){
		//debug($this->input->post('training_calendar-course_id'));die();
		$this->_ajax_only();
			if( $this->input->post('course') ){

				$course_id = $this->input->post('course');

				$training_course_info = "SELECT * FROM ww_training_course c 
					LEFT JOIN ww_training_provider p ON p.`provider_id` = c.`provider_id`
					LEFT JOIN ww_training_category cat ON cat.`category_id` = c.`category_id`
	                    			WHERE c.course_id  = '" . $course_id . "' ";

	                    $training_course_info = $this->db->query($training_course_info);

				if($training_course_info->num_rows() > 0){
					//$training_course_info->row();

				$this->response->training_provider = $training_course_info->row('provider');
				$this->response->training_provider_id = $training_course_info->row('provider_id');
				$this->response->training_category = $training_course_info->row('category');
				$this->response->training_category_id = $training_course_info->row('category_id');
					$this->response->message[] = array(
	                'message' => 'Succesfully called!',
	                'type' => 'success'
	                );
				}
				

			}
			/*else{

				$training_calendar_id = $this->input->post('record_id');

				$this->db->join('training_course','training_course.course_id = training_calendar.course_id','left');
				$this->db->join('training_category','training_category.training_category_id = training_course.training_category_id','left');
				$this->db->join('training_provider','training_provider.provider_id = training_course.provider_id','left');
				$this->db->where('training_calendar.training_calendar_id',$training_calendar_id);
				$training_calendar_info = $this->db->get('training_calendar');

				if($training_calendar_info > 0){
					$training_calendar_info->row(); 
					$response->training_provider = $training_calendar_info->training_provider;
					$response->training_category = $training_calendar_info->training_category;
				}

				

			}*/

		

		//$this->load->view('template/ajax', array('json' => $response));
		$this->_ajax_return();

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

	function get_training_cost_form() {
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}
	
		$data['cost_count'] = $this->input->post('cost_count');
		$data['training_calendar_id'] = $this->input->post('training_calendar_id');

		$this->load->helper('form');

		$this->load->view('edit/forms/training_cost', $data);
	}

	function calculate_total_cost_pax(){

        $subtotal_budget_cost = $this->input->post('sub_total');
        $subtotal_budget_pax  = $this->input->post('sub_pax');

		$this->response->total_cost = ($subtotal_budget_cost) ? number_format($subtotal_budget_cost,2,'.',',') : 0;
		$this->response->total_pax = $subtotal_budget_pax;
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();

    }

	function get_employees()
	{
        $this->_ajax_only();
        $record_id = $this->input->post('record_id');
		$location_id = $this->input->post('location_id');
		$company_id = $this->input->post('company_id');
		$division_id = $this->input->post('division_id');
		$department_id = $this->input->post('department_id');

		$training_calendar_details = $this->mod->get_training_calendar_details($record_id);

		$selected_employees = array();
		if ($training_calendar_details)
			$selected_employees = explode(',', $training_calendar_details['employees']);

        $qry = "SELECT partners.alias, partners.partner_id, partners.user_id 
                FROM partners
                INNER JOIN users_profile u ON partners.user_id = u.user_id
                WHERE partners.deleted = 0 
                ";
        if ($location_id && $location_id != 'null'){
            $qry .= " AND location_id IN ({$location_id}) ";
        }
        if ($company_id && $company_id != 'null'){
            $qry .= " AND u.company_id IN ({$company_id}) ";
        }        
        if ($division_id && $division_id != 'null'){
            $qry .= " AND u.division_id IN ({$division_id}) ";
        }
        if ($department_id && $department_id != 'null'){
            $qry .= " AND u.department_id IN ({$department_id})  ";
        }      
        $qry .= " ORDER BY partners.alias ASC";

        $employees = $this->db->query( $qry );

        $this->response->count = 0;
        $this->response->employees = '';
        if ($employees && $employees->num_rows() > 0){
	        $this->response->count = $employees->num_rows();
	        foreach( $employees->result() as $employee )
	        {   
	        	$selected = '';
	        	if (in_array($employee->user_id, $selected_employees))
	        		$selected = 'selected="selected"';
	            $data['partner_id_options'][$employee->user_id] = $employee->alias;
	            $this->response->employees .= '<option value="'.$employee->user_id.'" '.$selected.'>'.$employee->alias.'</option>';
	        }
        }

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
	}

	function add_participants(){

		$user_id = $this->input->post('user_id');
		$calendar_id = $this->input->post('calendar_id');

		$training_calendar_details = $this->mod->get_training_calendar_details($calendar_id);
		$training_calendar_participant = $this->mod->get_training_calendar_participant_user_id($calendar_id);

		$selected_employees = array();
		if ($training_calendar_details)
			$selected_employees = explode(',', $training_calendar_details['employees']);

		$training_calendar_participant_ids = array();
		if ($training_calendar_participant)
			$training_calendar_participant_ids = explode(',', $training_calendar_participant['user_ids']);

		$html = "";

        $qry = "SELECT partners.alias, partners.partner_id, partners.user_id 
                FROM partners
                INNER JOIN users_profile u ON partners.user_id = u.user_id
                WHERE partners.deleted = 0 AND partners.user_id IN ({$user_id})
                ";

        $qry .= " ORDER BY partners.alias ASC";

        $employee_list = $this->db->query( $qry );

		$participant_status_list = $this->db->get('training_calendar_participant_status')->result();

		foreach( $employee_list->result() as $employee_info ){

			if (!in_array($employee_info->user_id, $selected_employees) || (in_array($employee_info->user_id, $selected_employees) && !in_array($employee_info->user_id, $training_calendar_participant_ids))) {
				$rand = rand(1,10000);

				$html .= '<tr>
		    		<td style="text-align:center;">'.$employee_info->alias.'</td>';
		    		
		    	$html .= '<td style="text-align:center;">
						<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
					    	<input type="checkbox" value="1" name="participants['.$rand.'][temp]" id="participants-nominate" class="toggle participants-nominate"/>
					    	<input type="hidden" name="participants['.$rand.'][nominate]" class="participants-nominate-val" value="0"/>
						</div>
		    		</td>
		    		<td style="text-align:center;">
		    			<select name="participants['.$rand.'][status]" class="form-control participant_status select2me">';
		    			foreach( $participant_status_list as $participant_status ){
		    				$html .= '<option value="'.$participant_status->participant_status_id.'">'.$participant_status->participant_status.'</option>';
		    			}
		    	$html .= '</select>
		    		</td>
		    		<td style="text-align:center;">
						<div class="make-switch" data-on-label="&nbsp;Yes&nbsp;" data-off-label="&nbsp;No&nbsp;">
					    	<input type="checkbox" value="1" name="participants['.$rand.'][temp]" id="participants-no_show" class="toggle participants-no_show"/>
					    	<input type="hidden" name="participants['.$rand.'][no_show]" class="participants-no_show-val" value="0"/>
						</div> 
		    		</td>
		    		<td style="text-align:center;">
		    			<a class="btn btn-xs text-muted delete-participant" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
		    			<input type="hidden" class="participants" name="participants['.$rand.'][id]" value="'.$employee_info->user_id.'" />
		    		</td>
		    	</tr>';
		    }
		}

		$this->response->content_list = $html;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
	}

	function get_employee_filter(){

		$this->db->join('users_profile','users_profile.user_id = partners.user_id','left');

		if( $this->input->post('nid') ){
			$nid = substr_replace($this->input->post('nid'), "", -1);
			$id = explode(',', $nid);

			$this->db->where_not_in('partners.user_id',$id,true);
		}

		$employees = $this->db->get('partners');	

		$this->response->employees = '';
        foreach( $employees->result() as $employee ){
        	$this->response->employees .= '<option value="'.$employee->user_id.'" selected="selected">'.$employee->alias.'</option>';
        }

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
	}	

   	function save($child_call = false){
    	$this->_ajax_only();

		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[planned]',
			'label' => 'Planned',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[with_certification]',
			'label' => 'Certification',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[evaluation_template_id][]',
			'label' => 'Evaluation Form',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[tba]',
			'label' => 'To Be Announce',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[min_training_capacity]',
			'label' => 'Maximum Trainee Capacity',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[training_capacity]',
			'label' => 'Minimum Trainee Capacity',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[calendar_type_id]',
			'label' => 'Training Type',
			'rules' => 'required'
			);
		$validation_rules[] = 		
		array(
			'field' => 'training_calendar[course_id]',
			'label' => 'Course',
			'rules' => 'required'
			);	
		$validation_rules[] = 
		array(
			'field' => 'training_calendar[training_title]',
			'label' => 'Training Title',
			'rules' => 'required'
			);

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
								
    	$post = $_POST;

    	if (empty($post['session'])) {

			$this->response->message[] = array(
				'message' => 'Training session should not be empty.',
				'type' => 'error'
			);

			$this->_ajax_return();			    		
    	}

		$training_calendar = $post['training_calendar'];

		$record_id = $post['record_id'];

		if (isset($training_calendar['company_id']))
			$training_calendar['company_id'] = implode(',', $training_calendar['company_id']);
		if (isset($training_calendar['division_id']))
			$training_calendar['division_id'] = implode(',', $training_calendar['division_id']);
		if (isset($training_calendar['department_id']))
			$training_calendar['department_id'] = implode(',', $training_calendar['department_id']);
		if (isset($training_calendar['location_id']))
			$training_calendar['location_id'] = implode(',', $training_calendar['location_id']);
		if (isset($training_calendar['employees']))
			$training_calendar['employees'] = implode(',', $training_calendar['employees']);

		$training_calendar['registration_date'] = ($training_calendar['registration_date'] != '' ? date('Y-m-d',strtotime($training_calendar['registration_date'])) : '');
		$training_calendar['last_registration_date'] = ($training_calendar['last_registration_date'] != '' ? date('Y-m-d',strtotime($training_calendar['last_registration_date'])) : '');
		$training_calendar['publish_date'] = ($training_calendar['publish_date'] != '' ? date('Y-m-d',strtotime($training_calendar['publish_date'])) : '');
		$training_calendar['revalida_date'] = ($training_calendar['revalida_date'] != '' ? date('Y-m-d',strtotime($training_calendar['revalida_date'])) : '');
		$training_calendar['confirmed'] = ($post['total_confirmed'] != '' ? $post['total_confirmed'] : '' );
		$training_calendar['evaluation_template_id'] = $commaList = (isset($training_calendar['evaluation_template_id']) && $training_calendar['evaluation_template_id'] != '' ? implode(',', $training_calendar['evaluation_template_id']) : '');

		//unset($training_calendar['provider']);
		
		if(empty($record_id)){
			$this->db->insert('training_calendar', $training_calendar);	
			$record_id = $this->db->insert_id();
			$this->save_sessions($record_id);
			$this->save_training_cost($record_id);

			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);

            //create system logs
            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_calendar', array(), $training_calendar);			
		}
		else{
			$this->db->update('training_calendar', $training_calendar, array( 'training_calendar_id' => $record_id ) );

            //get previous data for audit logs
            $previous_main_data = $this->db->get_where('training_calendar', array( 'training_calendar_id' => $record_id ))->row_array();

            //create system logs
            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_calendar', $previous_main_data, $training_calendar);	

			/*debug($this->db->last_query());die();*/
			//$this->db->delete('training_calendar_session', array( 'training_calendar_id' => $record_id ) );
			$this->save_sessions($record_id);

			//$this->db->delete('training_calendar_budget', array('training_calendar_id' => $record_id));
			$this->save_training_cost($record_id);
		}

    	$this->save_participants($post,$record_id);

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

    	$this->_ajax_return();
    }

    function save_participants($post,$record_id){

		$participant_list = (isset($post['participants']) ? $post['participants'] : array());

		if ($record_id != ''){

			$this->db->where('training_calendar_participant.training_calendar_id',$record_id);
			$calendar_participant_list = $this->db->get('training_calendar_participant');

			if( $calendar_participant_list->num_rows() > 0 ){

				$participant_count = 0;
				$calendar_participant_list = $calendar_participant_list->result();

				foreach( $calendar_participant_list as $calendar_participant_info ){

					$participant_count = 0;

					foreach( $participant_list as $participant_info ){
						if( $participant_info['id'] == $calendar_participant_info->user_id ){
							$participant_count++;
						}
					}

					if( $participant_count == 0 ){
						$this->db->where('training_calendar_id',$record_id);
						$this->db->where('user_id',$calendar_participant_info->user_id);
						$this->db->update('training_calendar_participant',array('deleted' => 1));
						//$this->db->delete('training_calendar_participant',array('training_calendar_id' => $record_id, 'user_id'=>$calendar_participant_info->user_id));

		                //create system logs
		                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', $this->mod->primary_key, array(), array('record_id' => $record_id));						
					}

				}

			}
		}

		foreach( $participant_list as $participant_info ){
			$this->db->join('users_profile','users_profile.user_id = training_calendar_participant.user_id','left');
			$this->db->where('training_calendar_participant.training_calendar_id',$record_id);
			$this->db->where('training_calendar_participant.user_id',$participant_info['id']);
			$this->db->where('training_calendar_participant.deleted',0);
			$calendar_participant_info = $this->db->get('training_calendar_participant');

			if( $calendar_participant_info && $calendar_participant_info->num_rows() > 0 ){

				$calendar_participant_info_result = $calendar_participant_info->row();

				$participant_status = $participant_info['status'];

				if( $participant_status == "" ){
					$participant_status = $calendar_participant_info_result->participant_status_id;
				}

				$previous_participant_status = $calendar_participant_info_result->participant_status_id;
/*				$no_show = "";

				if( $participant_info['nominate'] == 1 ){
					if( $calendar_participant_info_result->participant_status_id == 1 ){
						$participant_status = '5';
					}
				}
				else{
					if( $calendar_participant_info_result->participant_status_id == 5 ){
						$participant_status = '1';
					}
				}


				if( $participant_info['no_show'] != 1 && $participant_info['no_show'] != 0  ){

					if( $calendar_participant_info_result->no_show == 1 ){
						$no_show = $calendar_participant_info_result->no_show;
					}
					else{
						$no_show = 0;
					}

				}
				else{

					$no_show = $participant_info['no_show'];

				}*/

				$no_show = $participant_info['no_show'];
				$participant_status = $participant_info['status'];

				$data = array(
					'participant_status_id' => $participant_status,
					'no_show' => $no_show,
					'nominate' => $participant_info['nominate'],
					'previous_participant_status_id' => $previous_participant_status
				);

				if( $no_show == 1 && $calendar_participant_info_result->send_no_show_notification == 0 ){
		            $data['send_no_show_notification'] = 1;
				}

				if (isset($participant_info['calendar_participant_id'])) {
					$this->db->update('training_calendar_participant',$data,array('calendar_participant_id' => $participant_info['calendar_participant_id']));

                	//create system logs
                	$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_calendar_participant', $calendar_participant_info->row_array(), $data);
                }

			}
			else{

				$data = array(
					'training_calendar_id'=>$record_id,
					'participant_status_id' => $participant_info['status'],
					'user_id' => $participant_info['id'],
					'no_show' => $participant_info['no_show'],
					'nominate' => $participant_info['nominate'],
					'previous_participant_status_id' => $participant_info['status']
				);

				$this->db->insert('training_calendar_participant',$data);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_calendar_participant', array(), $data);
			}

			//send notification if status is enrolled
			$this->load->model('training_request_confirmation_model', 'mod_conf');			

			if ($participant_info['status'] == 1) {
				//insert notification
				$insert = array(
					'status' => 'info',
					'message_type' => 'Training Request',
					'user_id' => $participant_info['id'],
					'feed_content' => 'Training Request for Confirmation',
					'recipient_id' => $participant_info['id'],
					'uri' => str_replace(base_url(), '', $this->mod_conf->url).'/detail/'.$record_id
				);

				$this->db->insert('system_feeds', $insert);
				$id = $this->db->insert_id();
				$this->db->insert('system_feeds_recipient', array('id' => $id, 'user_id' => $participant_info['id']));
			}
		}
    }

	function save_training_cost($record_id){
		$post = $this->input->post('training_cost');
		$data = $this->_rebuild_array($post, $record_id, 'training_calendar_id');

		foreach( $data as $cost ){
			$this->db->where('training_calendar_id',$cost['training_calendar_id']);
			$this->db->where('calendar_budget_id',$cost['calendar_budget_id']);
			$result = $this->db->get('training_calendar_budget');

			if ($result && $result->num_rows() > 0) {
				$this->db->where('training_calendar_id',$cost['training_calendar_id']);
				$this->db->where('calendar_budget_id',$cost['calendar_budget_id']);
				$this->db->update('training_calendar_budget',$cost);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_calendar_budget', $result->row_array(), $cost);				
			} else {
				$this->db->insert('training_calendar_budget',$cost);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_calendar_budget', array(), $cost);								
			}
		}
	}    

	public function save_sessions($record_id)
	{
		$post = $this->input->post('session');

		$data = $this->_rebuild_array($post, $record_id, 'training_calendar_id');

		foreach( $data as $session ){
			$session['session_date'] = ($session['session_date'] != '' ? date('Y-m-d',strtotime($session['session_date'])) : '');
			$session['sessiontime_from'] = ($session['sessiontime_from'] != '' ? date('H:i:s',strtotime($session['sessiontime_from'])) : '');
			$session['sessiontime_to'] = ($session['sessiontime_to'] != '' ? date('H:i:s',strtotime($session['sessiontime_to'])) : '');

			$this->db->where('training_calendar_id',$session['training_calendar_id']);
			$this->db->where('calendar_session_id',$session['calendar_session_id']);
			$result = $this->db->get('training_calendar_session');

			if ($result && $result->num_rows() > 0) {
				$this->db->where('training_calendar_id',$session['training_calendar_id']);
				$this->db->where('calendar_session_id',$session['calendar_session_id']);
				$this->db->update('training_calendar_session',$session);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'training_calendar_budget', $result->row_array(), $session);								
			} else {
				$this->db->insert('training_calendar_session',$session);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'training_calendar_session', array(), $session);												
			}

		}
	}

	public function get_session_form()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}
		
		$data['session_count'] = $this->input->post('session_count');
		$data['training_calendar_id'] = $this->input->post('training_calendar_id');

		$this->load->helper('form');

		$this->load->view('edit/training_session', $data);
	}

	function _list_options_active( $record, &$rec )
	{
		//temp remove until view functionality added
		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';
			$rec['options'] .= '<li><a href="javascript:void(0)" onclick="print_calendar('.$record['record_id'].')"><i class="fa fa-print"></i> Print</a></li>';
		}

		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';

			if ($record['training_calendar_status'] == 0)
				$rec['options'] .= '<li><a href="javascript:void(0)" data-status="1" data-record_id="'.$record['record_id'].'" class="close_training"><i class="fa fa-lock"></i> Close</a></li>';
			//$rec['options'] .= '<li><a href="javascript:void(0)" data-status="1" data-record_id="'.$record['record_id'].'" class="cancel_training"><i class="fa fa-ban"></i> Cancel</a></li>';	
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] )
		{	
			if(isset($record['can_delete']) && $record['can_delete'] == 1){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}elseif(isset($record['can_delete']) && $record['can_delete'] == 0){
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a disabled="disabled" style="color:#B6B6B4" onclick="return false" href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}else{
				$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
				$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
			}
		}
	}

	public function cancel_calendar(){

		$training_calendar_id = $this->input->post('training_calendar_id');

		$this->db->where('training_calendar_id',$training_calendar_id);
		$result = $this->db->update('training_calendar',array('closed'=>3,'cancelled_date'=>date('Y-m-d')));

		if( $result ){

			$this->db->join('training_subject','training_subject.training_subject_id = training_calendar.training_subject_id','left');
	    	$this->db->join('training_provider','training_provider.training_provider_id = training_subject.training_provider_id','left');
	    	$this->db->join('training_calendar_type','training_calendar_type.calendar_type_id = training_calendar.calendar_type_id','left');
			$this->db->join('training_calendar_participant','training_calendar_participant.training_calendar_id = training_calendar.training_calendar_id','left');
			$this->db->join('user','user.employee_id = training_calendar_participant.employee_id','left');
			$this->db->where('training_calendar.training_calendar_id',$training_calendar_id);
			$training_calendar_participant_result = $this->db->get('training_calendar');

			if( $training_calendar_participant_result->num_rows() > 0 ){

				foreach( $training_calendar_participant_result->result() as  $participant_info ){

					$data = array();

					$data['course_title'] = $participant_info->training_subject;
					$data['training_topic'] = $participant_info->topic;
					$data['participant_name'] = $participant_info->firstname.' '.$participant_info->lastname;

					$this->load->model('template');
					$template = $this->template->get_module_template($this->module_id, 'send_training_cancelled_notification');

					$data['firstname'] = $participant_info->firstname;
					$data['lastname'] = $participant_info->lastname;

		            $message = $this->template->prep_message($template['body'], $data);
		            $this->template->queue($participant_info->email, '', $template['subject'], $message);

				}

			}

			$response->msg_type = 'success';
			$response->msg = 'Training Calendar was successfully cancelled';

		}
		else{

			$response->msg_type = 'error';
			$response->msg = 'Training Calendar was unsuccessfully cancelled';

		}


		$this->load->view('template/ajax', array('json' => $response));

	}

	public function close_calendar(){

		$training_calendar_id = $this->input->post('training_calendar_id');

		//check if there are existing participants in the training calendar
		$this->db->where('training_calendar_id',$training_calendar_id);
		$this->db->where('deleted',0);
		$training_calendar_participant = $this->db->get('training_calendar_participant');

		if( $training_calendar_participant->num_rows() > 0 ){

			//check if there are still existing participants that are still in enrolled status
			$this->db->join('training_calendar_participant','training_calendar_participant.training_calendar_id = training_calendar.training_calendar_id','left');
			$this->db->where('training_calendar.training_calendar_id',$training_calendar_id);
			$this->db->where('training_calendar_participant.participant_status_id',1);
			$this->db->where('training_calendar_participant.deleted',0);
			$enrolled_participant = $this->db->get('training_calendar');

			if( $enrolled_participant->num_rows() == 0 ){

				$this->db->select('users_profile.user_id, training_calendar_participant.user_id, training_calendar.course_id, training_calendar.training_provider_id, training_calendar.training_calendar_id, training_calendar.cost_per_pax, training_calendar.venue');
				$this->db->join('training_calendar_participant','training_calendar_participant.training_calendar_id = training_calendar.training_calendar_id','left');
				$this->db->join('users_profile','users_profile.user_id = training_calendar_participant.user_id','left');
				$this->db->where('training_calendar_participant.participant_status_id',2);
				$this->db->where('training_calendar_participant.deleted',0);
				$this->db->where('training_calendar.training_calendar_id',$training_calendar_id);
				$training_calendar_participant_result = $this->db->get('training_calendar');

				$total_employee = 0;

				if( $training_calendar_participant_result && $training_calendar_participant_result->num_rows() > 0 ){
					foreach( $training_calendar_participant_result->result() as $training_participant_info ){
						$this->db->where('training_application.training_course_id',$training_participant_info->course_id);
						$this->db->where('training_application.training_provider',$training_participant_info->training_provider_id);
						$this->db->where('training_application.status_id',7);
						$this->db->where('training_application.user_id',$training_participant_info->user_id);
						$training_application_result = $this->db->get('training_application');

						$investment = 0;
						$remarks = '';
						if ($training_application_result && $training_application_result->num_rows() > 0) {
							$training_application_info = $training_application_result->row();

							$investment = (isset($training_application_info->investment) ? $training_application_info->investment : 0);
							$remarks = $training_application_info->remarks;
						}

						$course = $this->db->get_where('training_course', array('course_id' => $training_participant_info->course_id));
						$subject = ($course && $course->num_rows() > 0) ? $course->row()->course : '' ;

						//get start date
						$this->db->where('training_calendar_id',$training_participant_info->training_calendar_id);
						$this->db->order_by('session_date','asc');
						$training_calendar_session_info = $this->db->get('training_calendar_session')->row();

						$start_date = date('Y-m-d',strtotime($training_calendar_session_info->session_date));

						//get end date
						$this->db->where('training_calendar_id',$training_participant_info->training_calendar_id);
						$this->db->order_by('session_date','desc');
						$training_calendar_session_info = $this->db->get('training_calendar_session')->row();

						$end_date = date('Y-m-d',strtotime($training_calendar_session_info->session_date));

						$total_training_hours = 0;

						//get total training hours
						$this->db->where('training_calendar_id',$training_participant_info->training_calendar_id);
						$this->db->order_by('session_date','asc');
						$training_calendar_session_result = $this->db->get('training_calendar_session');

						if( $training_calendar_session_result->num_rows() > 0 ){

							foreach( $training_calendar_session_result->result() as $session_info ){

								$session_start = strtotime($session_info->session_date.' '.$session_info->sessiontime_from);
								$session_end = strtotime($session_info->session_date.' '.$session_info->sessiontime_to);

								$total_training_hours += ( $session_end - $session_start ) / 60 / 60;
							}

						}

						$data = array(
							'training_calendar_id' => $training_participant_info->training_calendar_id,
							'training_course_id' => $training_participant_info->course_id,
							'training_course' => $subject,
							'user_id' => $training_participant_info->user_id,
							'start_date' => $start_date,
							'end_date' => $end_date,
							'investment' => $investment
						);

						$insert_training_employee_database = $this->db->insert('training_employee_database',$data);

						if( $insert_training_employee_database ){
							$total_employee++;
						}
					}
				}

				if( $total_employee == $training_calendar_participant_result->num_rows() ){
					$this->db->where('training_calendar_id',$training_calendar_id);
					$result = $this->db->update('training_calendar',array('closed'=>1,'closed_date'=>date('Y-m-d')));

					if( $result ){
			            $this->response->message[] = array(
			                'message' => 'Training Calendar was successfully closed',
			                'type' => 'success'
			            );
					}
					else{
			            $this->response->message[] = array(
			                'message' => 'Error closing training calendar',
			                'type' => 'error'
			            );
					}					
				}
			}
			else{
	            $this->response->message[] = array(
	                'message' => 'There are still enrolled participants in the chosen training calendar. Please finish all pending participants.',
	                'type' => 'error'
	            );

			}

		}
		else{
            $this->response->message[] = array(
                'message' => 'Please ensured that there are participants in the chosen training calendar.',
                'type' => 'error'
            );
		}

        $this->_ajax_return(); 

	}

    function print_calendar()
    {
        $this->_ajax_only();

        $user = $this->config->item('user');

        $record_id = $this->input->post('record_id');

        $record = $this->mod->get_training_calendar_info( $record_id );

        $vars['record'] = $record;

		$training_cost_tab = array();

		$this->db->order_by('calendar_budget_id');
		$training_costs = $this->db->get_where('training_calendar_budget', array('training_calendar_id' => $record_id));

		if($training_costs->num_rows() > 0){
			$training_cost_tab = $training_costs->result_array();
		}

		$vars['training_cost_tab'] = $training_cost_tab;

		$session_tab = array();

		$this->db->order_by('calendar_session_id');
		$sessions = $this->db->get_where('training_calendar_session', array('training_calendar_id' => $record_id));

		if($sessions->num_rows() > 0){
			$session_tab = $sessions->result_array();
		}

		$vars['session_tab'] = $session_tab;

		$participant_tab = array();

		$this->db->where('training_calendar_participant.deleted',0);
		$this->db->where('training_calendar_id',$record_id);
		$this->db->join('partners','training_calendar_participant.user_id = partners.user_id','left');
		$this->db->join('training_calendar_participant_status','training_calendar_participant.participant_status_id = training_calendar_participant_status.participant_status_id','left');
		$list_participants = $this->db->get('training_calendar_participant');

		if($list_participants->num_rows() > 0){
			$participant_tab = $list_participants->result_array();
		}

		$vars['participant_tab'] = $participant_tab;

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        //$mpdf = new PDFm(['debug' => true]);

        //$mpdf->showImageErrors = true
        
        $mpdf->SetTitle( 'Training Calendar' );
        $mpdf->SetAutoPageBreak(true, 5);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();


        $logo  = base_url().'uploads/company/print/ortigas_land_corporation (3).jpg';; 
/*        if ($record['print_logo'] != ''){
            if( file_exists( $record['print_logo'] ) ){
                $logo = base_url().$record['print_logo'];
            }
        }*/

        $vars['logo'] = $logo;

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        $html = $this->load->view('pages/training_calendar.blade.php',$vars,true); 

        $this->load->helper('file');
        $path = 'uploads/templates/training/';
        $this->check_path( $path );
        $filename = $path .$record['course']. "-".'Training Calendar Form' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
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