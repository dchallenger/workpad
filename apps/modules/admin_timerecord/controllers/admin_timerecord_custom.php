
	public function index(){   
		
		$data = array();

		$data['year'] = date('Y');
        $data['prev_year']['key'] 	= date('Y') - 1;
        $data['prev_year']['value'] = date('Y') - 1;
        $data['next_year']['key'] 	= date('Y') + 1;
        $data['next_year']['value']	= date('Y') + 1;

        // filters
        $data['current_date'] 	= date("Y-m-d");
        $data['prev_month'] 	= date("Y-m-d", strtotime($data['current_date'] . ' - 1 months'));
        $data['next_month'] 	= date("Y-m-d", strtotime($data['current_date'] . ' + 1 months'));

		for ($m=1; $m<=12; $m++) {

			$month_key = date('Y-m-d', mktime(0,0,0,$m, 1, date('Y')));
    		$month_value = date('F', mktime(0,0,0,$m, 1, date('Y')));
     		$data['month_list'][$month_key] = $month_value;
     	}

        $this->load->vars( $data );

        echo $this->load->blade('record_listing_custom')->with( $this->load->get_cached_vars() );
	}

	function get_list(){

		$this->_ajax_only();

		if( !$this->permission['list'] ){
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$range = '';
		$data = array();
		$data['pn'] = '';
		$data['sf'] = '';

		// determine list request
		$type 	= $this->input->post('type');
		$value 	= $this->input->post('value');

		// get currently selected year
		$csy_value 	= $this->input->post('selected_year');
		$currently_selected_year = $csy_value == '' ? $csy_value : date("Y");
	

		if($type === 'month' || $type === 'current'){

			$value = $type === 'current' ? date("Y-m-d") : $value;

			// if month, move to selected month
			// and setup pagination and month list
			$date = $value;

			// pn - previous/next 
			$data['pn']['prev'] = date("Y-m-d", strtotime($value . ' - 1 months'));
			$data['pn']['current'] = date("Y-m-d", strtotime($value)); // remove this line
			$data['pn']['nxt'] 	= date("Y-m-d", strtotime($value . ' + 1 months'));

			// side filter
			$selected_year = date('Y', strtotime($value));
			$prev_year = date('Y', strtotime($value)) - 1;
			$next_year = date('Y', strtotime($value)) + 1;


			$sf = '<span id="yr-fltr-prev" data-year-value="' . $prev_year . '" class="event-block label label-info year-filter">' . $prev_year . '</span> ';

			for($m=1; $m<=12; $m++) {

				$month_key = date('Y-m-d', mktime(0,0,0,$m, 1, date('Y', strtotime($value))));
    			$month_value = date('F', mktime(0,0,0,$m, 1, date('Y', strtotime($value))));

    			$label_class = date("F", strtotime($value)) === $month_value ? 'label-success' : 'label-default';

				$sf .= '<span id="ml-'.$month_key.'" data-month-value="'.$month_key.'" class="event-block label ' . $label_class .' month-list">'.$month_value.'</span> ';
	     	}

	     	$sf .= '<span id="yr-fltr-next" data-year-value="' . $next_year . '" class="event-block label label-info year-filter">
	                	' . $next_year . '
	                </span>';

			$data['sf'] = $sf;
			$range = "month";

			$this->response->current_title = date("F-Y", strtotime($value));
		}
		else if($type === 'year'){ 

			$range = "year";

			// if year, on previous year load the last month
			// otherwise move to first month of future year
			if($value < date('Y')){

				// now we're talking about previous year
				$data['pn']['prev'] = date("Y-m-d", strtotime($value . '-11-01'));
				$data['pn']['current'] = date("Y-m-d", strtotime($value . '-12-01'));
				$data['pn']['nxt'] 	= date("Y-m-d", strtotime($value + 1 . '-01-01'));

				// side filter
				$selected_year = date('Y', strtotime($value . '-01-01'));
				$prev_year = date('Y', strtotime($value . '-01-01')) - 1;
				$next_year = date('Y', strtotime($value . '-01-01')) + 1;
			}
			else{

				// future year
				$data['pn']['prev'] = date("Y-m-d", strtotime($value - 1 . '-12-01'));
				$data['pn']['current'] = date("Y-m-d", strtotime($value . '-01-01'));
				$data['pn']['nxt'] 	= date("Y-m-d", strtotime($value . '-02-01'));

				// side filter
				$selected_year = date('Y', strtotime($value . '-01-01'));
				$prev_year = date('Y', strtotime($value . '-01-01')) - 1;
				$next_year = date('Y', strtotime($value . '-01-01')) + 1;
			}

			$date = $data['pn']['current'];

			$sf = '';
			$sf = '<span 
						id="yr-fltr-prev" 
						data-year-value="' . $prev_year . '" 
						data-year-selected="' . $currently_selected_year . '" 
						class="event-block label label-info year-filter">' . $prev_year . '</span> ';

			for($m = 1; $m <= 12; $m++) {

				$month_key = date('Y-m-d', mktime(0,0,0,$m, 1, $value));
    			$month_value = date('F', mktime(0,0,0,$m, 1, $value));

    			$label_class = date("F", strtotime($date)) === $month_value ? 'label-success' : 'label-default';

				$sf .= '<span id="ml-'.$month_key.'" data-month-value="'.$month_key.'" class="event-block label ' . $label_class .' month-list">'.$month_value.'</span> ';
	     	}

	     	$sf .= '<span 
	     				id="yr-fltr-next" 
	     				data-year-value="' . $next_year . '" 
	     				data-year-selected="' . $currently_selected_year . '" 
	     				class="event-block label label-info year-filter">
	                	' . $next_year . '
	                </span> ';

			$data['sf'] = $sf;

			$this->response->current_title = date("F-Y", strtotime($date));
		}


		// Pay period filter
		// limited to 5 paydates
		$ppfs = $this->mod->get_period_list( $this->input->post('user_id') );

		$records = $this->mod->_get_list($this->input->post('user_id'), $range, $date);
		$this->response->records_retrieve = sizeof($records);
		$this->response->list = '';

		$this->response->pn = $data['pn'];
		$this->response->sf = $data['sf'];
		$this->response->ppf = '';

		foreach( $ppfs as $ppf ){
			$this->response->ppf .= '<span 
										id="ppf-'.$ppf['record_id'].'" 
										data-ppf-value-from="'.$ppf['from'].'" 
										data-ppf-value-to="'.$ppf['to'].'"  
										class="event-block label label-default period-filter">'
										.$ppf['payroll_date'].
									'</span> ';
		}

		foreach( $records as $record ){
			$record['forms'] = array();
			$record['forms'] = $this->mod->time_record_list_forms($record['date'], $record['user_id']);
			$this->response->list .= $this->load->blade('list_template_custom', $record, true);
		}

		$this->_ajax_return();
	}

	function get_period_list(){

		if( !$this->permission['list'] ){
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$from 	= $this->input->post('from');
		$to 	= $this->input->post('to');
		$user_id = $this->input->post('user_id');

		$ppfs = $this->mod->get_period_list($user_id);
		$records = $this->mod->_get_list_by_period($user_id, $from, $to);

		$this->response->list = '';

		foreach( $records as $record ){
			$record['forms'] = array();
			$record['forms'] = $this->mod->time_record_list_forms($record['date'], $record['user_id']);
			$this->response->list .= $this->load->blade('list_template_custom', $record, true);
		}

		$this->_ajax_return();
	}

	function update_department()
	{
		$this->_ajax_only();
		$departments = $this->db->query('SELECT * FROM approver_class_department WHERE company_id='.$this->input->post('company_id'));
		$this->response->departments = '<option value="" selected="selected">Select...</option>';
		foreach( $departments->result() as $department )
		{
			$this->response->departments .= '<option value="'.$department->department_id.'">'.$department->department.'</option>';
		}
		$this->_ajax_return();	
	}

	function update_employees()
	{
		$this->_ajax_only();
		$this->db->order_by('alias');
		$this->db->where('partners.deleted', 0);
		$this->db->where('company_id', $this->input->post('company_id'));
		$this->db->where('department_id', $this->input->post('department_id'));
		$this->db->where('partners.status_id', $this->input->post('status_id'));
		$this->db->join('partners', 'partners.user_id = users_profile.user_id', 'left');
		$employees = $this->db->get('users_profile');
		$this->response->last_db = $this->db->last_query();
		// $employees = $this->db->get_where('users', array('deleted' => 0, 'company_id' => $this->input->post('company_id'), 'department_id' => $this->input->post('department_id')));
		$this->response->employees = '<option value="">Select...</option>';
		foreach( $employees->result() as $employee )
		{
			$this->response->employees .= '<option value="'.$employee->user_id.'">'.$employee->alias.'</option>';
		}
		$this->_ajax_return();	
	}

    function get_form_details(){
        $this->_ajax_only();
        $form_id = $this->input->post('form_id');
        $forms_id = $this->input->post('forms_id');

		$this->load->model('timerecord_model', 'time_model');
		$this->load->model('form_application_manage_model', 'form_manage');
        $this->response->form_details = '';

        $form_details = $this->time_model->time_record_list_forms_details($forms_id, $this->user->user_id);
        $remarks['remarks'] = array();
        $comments = $this->form_manage->get_approver_remarks($forms_id);
        foreach ($comments as $comment){
            $remarks['remarks'][] = $comment;
        }
        $form_details = array_merge($form_details, $remarks);
        
        switch($form_id){
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 13:
            case 14:
                $this->response->form_details .= $this->load->blade('edit/dialog/leave_details', $form_details, true);
            break;
            case 8://obt
                $this->response->form_details .= $this->load->blade('edit/dialog/obt_details', $form_details, true);            
            break;
            case 9://ot
                $this->response->form_details .= $this->load->blade('edit/dialog/ot_details', $form_details, true);            
            break;
            case 10://ut
                $this->response->form_details .= $this->load->blade('edit/dialog/ut_details', $form_details, true);            
            break;
            case 11://dtrp
                $this->response->form_details .= $this->load->blade('edit/dialog/dtrp_details', $form_details, true);            
            break;
            case 12://cws
                $this->response->form_details .= $this->load->blade('edit/dialog/cws_details', $form_details, true);            
            break;
        }

        $this->_ajax_return();
    }

