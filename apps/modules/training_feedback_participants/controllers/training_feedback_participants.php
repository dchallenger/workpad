<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_feedback_participants extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_feedback_participants_model', 'mod');
		parent::__construct();
	}

	public function feedback_list($calendar_id)
	{
		$calendar = array('calendar_id' => $calendar_id);
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}
		echo $this->load->blade('pages.listing', $calendar)->with( $this->load->get_cached_vars() );
	}

	public function get_list()
	{
		$last = $this->uri->total_segments();
		$calendar_id = $this->uri->segment($last);		

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

		$trash = $this->input->post('trash') == 'true' ? true : false;
		$records = $this->_get_list( $trash , $calendar_id );
		$this->_process_lists( $records, $trash );
		
		$this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

		$this->_ajax_return();
	}

	private function _process_lists( $records, $trash )
	{
		$this->response->records_retrieve = sizeof($records);
		$this->response->list = '';
		foreach( $records as $record )
		{
			$rec = array(
				'detail_url' => '#',
				'edit_url' => '#',
				'delete_url' => '#',
				'options' => ''
			);
			if(!$trash){
				$this->_list_options_active( $record, $rec );
			}else{
				$this->_list_options_trash( $record, $rec );
			}

			$record = array_merge($record, $rec);
			$this->response->list .= $this->load->blade('list_template', $record, true)->with( $this->load->get_cached_vars() );
		}
	}

	private function _get_list( $trash, $calendar_id )
	{
		$page = $this->input->post('page');
		$search = $this->input->post('search');
		$filter = "";
		
		$filter_by = $this->input->post('filter_by');
		$filter_value = $this->input->post('filter_value');
		
		if( is_array( $filter_by ) )
		{
			foreach( $filter_by as $filter_by_key => $filter_value )
			{
				if( $filter_value != "" ) $filter = 'AND '. $filter_by_key .' = "'.$filter_value.'"';	
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
				$filter = 'AND '. $filter_by .' = "'.$filter_value.'"';
			}
		}

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
		
		$search = $search ."||". $calendar_id;

		$page = ($page-1) * 10;
		$records = $this->mod->_get_list($page, 10, $search, $filter, $trash, $calendar_id);
		return $records;
	}

	public function add( $record_id = '', $child_call = false )
	{
		if( !$this->permission['add'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call, true );
	}

	public function edit( $record_id = "", $child_call = false )
	{
		if( !$this->permission['edit'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call );
	}

	private function _edit( $child_call, $new = false )
	{
		$record_check = false;
		$this->record_id = $data['record_id'] = '';
		$feedback_id = 0;

		if( !$new ){
			if( !$this->_set_record_id() )
			{
				echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
				die();
			}

			$this->record_id = $data['record_id'] = $_POST['record_id'];

			$calendar_participant_info = $this->mod->get_calendar_participant_info($this->record_id);

			$training_feedback_info = $this->mod->get_training_feedback_info($calendar_participant_info['training_calendar_id'],$calendar_participant_info['user_id']);

			$feedback_id = (isset($training_feedback_info['feedback_id']) ? $training_feedback_info['feedback_id'] : 0);
		}

		//Get Participant and Calendar Details

		if ($this->record_id != '')
			$this->db->where('training_calendar_participant.calendar_participant_id',$this->record_id);

		$this->db->select('training_calendar.evaluation_template_id');
		$this->db->join('training_calendar','training_calendar.training_calendar_id = training_calendar_participant.training_calendar_id','left');		
		$this->db->join('training_feedback','training_calendar.training_calendar_id = training_feedback.training_calendar_id','left');
		$result = $this->db->get('training_calendar_participant');

		if ($result && $result->num_rows() > 0) {
			$participant_details = $result->row();

			$this->db->select('training_evaluation_template.evaluation_template_id, training_evaluation_template.title, training_evaluation_template_section.*');
			$this->db->join('training_evaluation_template_section','training_evaluation_template_section.evaluation_template_id = training_evaluation_template.evaluation_template_id','left');
			$this->db->where_in('training_evaluation_template.evaluation_template_id',explode(',',$participant_details->evaluation_template_id));
			$this->db->where('training_evaluation_template_section.deleted = 0');
			$this->db->order_by('training_evaluation_template_section.evaluation_template_id');
			$this->db->order_by('training_evaluation_template_section.sequence','ASC');
			$questionnaire_details = $this->db->get('training_evaluation_template');
		}

		$data['feedback_questionnaire_item_count'] = $questionnaire_details->num_rows();
		$data['feedback_questionnaire_items'] = $questionnaire_details->result_array();

		if( $questionnaire_details->num_rows() > 0 && $feedback_id){
			foreach( $data['feedback_questionnaire_items'] as $key => $val ){
				$feedback_questionnaire_score = $this->db->get_where('training_feedback_score',array('feedback_id'=>$feedback_id, 'template_section_id'=> $data['feedback_questionnaire_items'][$key]['template_section_id'] ));				

				if( $feedback_questionnaire_score->num_rows() > 0 ){
					$feedback_questionnaire_score_info = $feedback_questionnaire_score->row();

					$data['feedback_questionnaire_items'][$key]['score'] = $feedback_questionnaire_score_info->score;
					$data['feedback_questionnaire_items'][$key]['remarks'] = $feedback_questionnaire_score_info->remarks;
				}
			}
		}

		$record_check = $this->mod->_exists( $this->record_id );
		if( $new || $record_check === true )
		{
			$result = $this->mod->_get( 'edit', $this->record_id );
			if( $new )
			{
				$field_lists = $result->list_fields();
				foreach( $field_lists as $field )
				{
					$data['record'][$field] = '';
				}
			}
			else{
				$record = $result->row_array();
				foreach( $record as $index => $value )
				{
					$record[$index] = trim( $value );	
				}
				$data['record'] = $record;
			}

			$this->record = $data['record'];
			$this->load->vars( $data );

			if( !$child_call ){
				$this->load->helper('form');
				$this->load->helper('file');
				echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
			}
		}
		else
		{
			$this->load->vars( $data );
			if( !$child_call ){
				echo $this->load->blade('pages.error', array('error' => $record_check))->with( $this->load->get_cached_vars() );
			}
		}
	}

	public function detail( $record_id, $child_call = false )
	{
		if( !$this->permission['detail'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_detail( $child_call );
	}

	private function _detail( $child_call, $new = false )
	{
		$record_check = false;
		$this->record_id = $data['record_id'] = '';	

		if( !$new )
		{
			if( !$this->_set_record_id() )
			{
				echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
				die();
			}

			$this->record_id = $data['record_id'] = $_POST['record_id'];

			$calendar_participant_info = $this->mod->get_calendar_participant_info($this->record_id);

			$training_feedback_info = $this->mod->get_training_feedback_info($calendar_participant_info['training_calendar_id'],$calendar_participant_info['user_id']);

			$feedback_id = $training_feedback_info['feedback_id'];			
		}

		$this->record_id = $data['record_id'] = $_POST['record_id'];

		//Get Participant and Calendar Details

		if ($this->record_id != '')
			$this->db->where('training_calendar_participant.calendar_participant_id',$this->record_id);

		$this->db->select('training_calendar.evaluation_template_id');
		$this->db->join('training_calendar','training_calendar.training_calendar_id = training_calendar_participant.training_calendar_id','left');		
		$this->db->join('training_feedback','training_calendar.training_calendar_id = training_feedback.training_calendar_id','left');
		$result = $this->db->get('training_calendar_participant');

		if ($result && $result->num_rows() > 0) {
			$participant_details = $result->row();

			$this->db->select('training_evaluation_template.evaluation_template_id, training_evaluation_template.title, training_evaluation_template_section.*');
			$this->db->join('training_evaluation_template_section','training_evaluation_template_section.evaluation_template_id = training_evaluation_template.evaluation_template_id','left');
			$this->db->where_in('training_evaluation_template.evaluation_template_id',explode(',',$participant_details->evaluation_template_id));
			$this->db->where('training_evaluation_template_section.deleted = 0');
			$this->db->order_by('training_evaluation_template_section.evaluation_template_id');
			$this->db->order_by('training_evaluation_template_section.sequence','ASC');
			$questionnaire_details = $this->db->get('training_evaluation_template');			
		}

		$data['feedback_questionnaire_item_count'] = $questionnaire_details->num_rows();

		if( $questionnaire_details->num_rows() > 0 && $feedback_id){
			$data['feedback_questionnaire_items'] = $questionnaire_details->result_array();
			foreach( $data['feedback_questionnaire_items'] as $key => $val ){
				$feedback_questionnaire_score = $this->db->get_where('training_feedback_score',array('feedback_id'=>$feedback_id, 'template_section_id'=> $data['feedback_questionnaire_items'][$key]['template_section_id'] ));				

				if( $feedback_questionnaire_score->num_rows() > 0 ){
					$feedback_questionnaire_score_info = $feedback_questionnaire_score->row();

					$data['feedback_questionnaire_items'][$key]['score'] = $feedback_questionnaire_score_info->score;
					$data['feedback_questionnaire_items'][$key]['remarks'] = $feedback_questionnaire_score_info->remarks;
				}
			}
		}
				
		$record_check = $this->mod->_exists( $this->record_id );
		if( $new || $record_check === true )
		{
			$result = $this->mod->_get( 'detail', $this->record_id );
			if( $new )
			{
				$field_lists = $result->list_fields();
				foreach( $field_lists as $field )
				{
					$data['record'][$field] = '';
				}
			}
			else{
				$record = $result->row_array();
				foreach( $record as $index => $value )
				{
					$record[$index] = trim( $value );	
				}
				$data['record'] = $record;
			}

			$this->record = $data['record'];
			$this->load->vars( $data );

			if( !$child_call ){
				$this->load->helper('form');
				$this->load->helper('file');
				echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
			}
		}
		else
		{
			$this->load->vars( $data );
			if( !$child_call ){
				echo $this->load->blade('pages.error', array('error' => $record_check))->with( $this->load->get_cached_vars() );
			}
		}
	}

	function get_total_average(){

		$feedback_item = $this->input->post('feedback_item');

		$this->db->select('users.full_name, training_calendar.feedback_category_id');
		$this->db->join('training_calendar','training_calendar.training_calendar_id = training_feedback.training_calendar_id','left');
		$this->db->join('users','users.user_id = training_feedback.employee_id','left');
		$this->db->where('training_feedback.feedback_id',$this->input->post('record_id'));
		$participant_details = $this->db->get('training_feedback')->row();

		$this->db->select('training_feedback_category.feedback_category_id, training_feedback_category.feedback_category, training_feedback_item.*');
		$this->db->join('training_feedback_item','training_feedback_item.feedback_category_id = training_feedback_category.feedback_category_id','left');
		$this->db->where_in('training_feedback_category.feedback_category_id',explode(',',$participant_details->feedback_category_id));
		$this->db->where_in('training_feedback_item.score_type',array(1,2,4,5));
		$this->db->order_by('training_feedback_category.feedback_category_id','ASC');
		$this->db->order_by('training_feedback_item.feedback_item_no','ASC');
		$questionnaire_list = $this->db->get('training_feedback_category');
		$questionnaire_details_count = $questionnaire_list->num_rows();
		$questionnaire_details = $questionnaire_list->result();
		$sub_total = 0;
		$sub_total_score = 0;
		$sub_total_average = 0;
		$current_category_id = 0;
		$total_no_items = 0;  
		$feedback_item[] = 0;
		foreach( $questionnaire_details as $questionnaire_detail_info ){
		 	$sub_total += isset($feedback_item[$questionnaire_detail_info->feedback_item_id]) ? $feedback_item[$questionnaire_detail_info->feedback_item_id] : null;
		}

		$average_score = ( $sub_total / ( $questionnaire_details_count * 5 ) ) * 100;

		$this->response->total_score = $sub_total;
		$this->response->average_score = number_format($average_score,2,'.','');
		
		$this->_ajax_return();

	}

	public function save($child_call = false)
	{
		$this->_ajax_only();
		$calendar_participant_id = $this->input->post('record_id');
		$calendar_participant_info = $this->mod->get_calendar_participant_info($calendar_participant_id);
		$training_feedback_data = array();
		$feedback_id = 0;

		if (!empty($calendar_participant_info)) {
			$training_calendar_id = $calendar_participant_info['training_calendar_id'];
			$user_id = $calendar_participant_info['user_id'];

			$scores = $this->input->post('training_feedback');
			$training_feedback_data = array(
				'training_calendar_id' => $training_calendar_id,
				'user_id' => $user_id,
				'feedback_status_id' => $this->input->post('status_id'),
				'total_score' => $scores['total_score'],
				'average_score' => $scores['average_score']
			);

			$info = array(
					'training_calendar_id' => $training_calendar_id,
					'user_id' => $user_id,
					'training_feedback_data' => $training_feedback_data
				);

			$feedback_id = $this->mod->update_insert_feedback($info);
		}

		if ($feedback_id) {
			$template_section = $this->input->post('template_section');

			$info = array(
					'feedback_id' => $feedback_id,
					'template_section' => $template_section
				);

			$this->mod->update_insert_feedback_score($info);

			if ($user_id == $this->user->user_id) {
				$this->mod->notify_hr($calendar_participant_id, $user_id);
			}
		}

		$this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

    	$this->_ajax_return();
	}

    function print_evaluation()
    {
        parent::edit('', true);

        $record_id = $this->input->post('record_id');

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        //$mpdf = new PDFm(['debug' => true]);

        //$mpdf->showImageErrors = true
        
        $mpdf->SetTitle( 'Training Evaluation' );
        $mpdf->SetAutoPageBreak(true, 5);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $appraisee = $this->mod->get_appraisee( $record_id, $user_id );

        $logo  = ''; 
        if ($appraisee->print_logo != ''){
            if( file_exists( $appraisee->print_logo ) ){
                $logo = base_url().$appraisee->print_logo;
            }
        }

        $vars['logo'] = $logo;

        $first_approver = $this->mod->get_list_approver( $this->record_id, $user_id, 1);

        $login_user_id = $first_approver->row()->approver_id;

        // for oclp it was specific approver only, if hr appraisal admin then get first approver since it was specific
        if ($this->permission['process']) {
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $record_id, $user_id, $login_user_id);
            $vars['hr_appraisal_admin'] = 1;
        } else
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $record_id, $user_id, $this->user->user_id);

        $vars['approver_info'] = array();
        if ($approver_info) {
            $approver_info_arr = $approver_info->row_array();
            $vars['approver_info'] = $approver_info_arr;
        }

        $vars['tenure'] = get_tenure($appraisee->effectivity_date);

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template; 

        $vars['transaction_type'] = '';
        $vars['appraisal_id'] = $record_id;
        $vars['balance_score_card'] = $this->individual_planning_model->get_balance_score_card();
        $vars['template_section_column'] = $this->individual_planning_model->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->individual_planning_model->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['appraisal_applicable_fields'] = $this->mod->get_appraisal_applicable_fields($record_id,$appraisee->user_id);
        $vars['template_section'] = $this->individual_planning_model->get_template_section($appraisee->template_id);
        $vars['library_competencies'] = $this->individual_planning_model->get_library_competencies();
        $vars['appraisal_applicable_section_ratings'] = $this->mod->get_appraisal_applicable_section_ratings($record_id,$appraisee->user_id);
        $vars['appraisal_applicable_score_library_ratings'] = $this->mod->get_appraisal_applicable_score_library_ratings($this->record_id,$appraisee->user_id);
        $vars['readonly'] = '';
        $vars['login_user_id'] = $login_user_id;
        $vars['areas_development'] = $this->individual_planning_model->get_areas_for_development();
        $vars['learning_mode'] = $this->individual_planning_model->get_learning_mode();
        $vars['competencies'] = $this->individual_planning_model->get_competencies();
        $vars['target_completion'] = $this->individual_planning_model->get_target_completion();

        $record = $this->load->get_cached_vars();
        $vars['record'] = $record['record'];

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        $html = $this->load->view('pages/appraisal_print_template.blade.php',$vars,true); 

        $this->load->helper('file');
        $path = 'uploads/templates/performance/';
        $this->check_path( $path );
        $filename = $path .$appraisee->fullname. "-".'Performance Appraisal Form' .".pdf";

        $mpdf->WriteHTML($html, 0, true, false);
        $mpdf->Output($filename, 'F');

        $this->response->filename = $filename;
        $this->response->message[] = array(
            'message' => 'File successfully loaded.',
            'type' => 'success'
        );
        $this->_ajax_return();
    }    
}