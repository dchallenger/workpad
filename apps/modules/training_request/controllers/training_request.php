<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_request extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_request_model', 'mod');
        $this->load->model('training_request_manage_model', 'mod_manage');
		parent::__construct();
	}

    public function index()
    {
        if( !$this->permission['list'] )
        {
            echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
            die();
        }
        
        $permission = parent::_check_permission('training_request_manage');
        $data['allow_manage'] = ($permission != 0 ? $permission['list'] : $permission);
        $permission = parent::_check_permission('training_request_admin');
        $data['allow_admin'] = ($permission != 0 ? $permission['list'] : $permission);
        $permission = parent::_check_permission('training_request_confirmation');
        $data['allow_training_confirmation'] = ($permission != 0 ? $permission['list'] : $permission);

        $this->load->vars($data);
        echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
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

        if( !$new ){
            if( !$this->_set_record_id() )
            {
                echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
                die();
            }

            $this->record_id = $data['record_id'] = $_POST['record_id'];
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

                $idp = $this->mod->get_idp_details($this->user->user_id);
                if (!empty($idp)) {
                    //comment this since oclp want to view the list of idp and select
                    //$data['record']['training_application.areas_development'] = $idp['areas_development'];
                    //$data['record']['training_application.competency'] = $idp['competencies'];
                    $data['record']['training_application.areas_development'] = '';
                    $data['record']['training_application.competency'] = '';                    
                }
            }
            else{
                $record = array();
                if ($result && $result->num_rows() > 0){
                    $record = $result->row_array();
                }
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
        }

        $this->record_id = $data['record_id'] = $_POST['record_id'];
        
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

            $data['approvers'] = $this->mod->get_approvers($this->record_id);
            
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

    function _list_options_active( $record, &$rec )
    {
        //temp remove until view functionality added
        if( $this->permission['detail'] )
        {
            $rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
            $rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';
        }

        if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
        {
            $rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
            $rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
        }   
        
        if( isset($this->permission['delete']) && $this->permission['delete'] )
        {   
            if ($record['training_application_training_application_status_id'] < 3) {
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
    }

    public function save( $child_call = false )
    {
        $this->_ajax_only();

        $calendar_id = $_POST['training_application']['training_calendar_id'];

        if ($this->input->post('training_course_others') != '') {
            $this->db->where('course',$this->input->post('training_course_others'));
            $course = $this->db->get('training_course');

            if ($course && $course->num_rows > 0) {
                $this->response->message[] = array(
                    'message' => 'Training course already exists!',
                    'type' => 'warning'
                ); 

                $this->_ajax_return(); 
            } else {
                $this->db->insert('training_course',array('course' => $this->input->post('training_course_others')));
                $course_id = $this->db->insert_id();

                $_POST['training_application']['training_course_id'] = $course_id;
            }
        }

        if ($this->input->post('training_provider_others') != '') {
            $this->db->where('provider',$this->input->post('training_provider_others'));
            $provider = $this->db->get('training_provider');
            if ($provider && $provider->num_rows > 0) {
                $this->response->message[] = array(
                    'message' => 'Training provider already exists!',
                    'type' => 'warning'
                );   

                $this->_ajax_return();                   
            } else {
                $this->db->insert('training_provider',array('provider' => $this->input->post('training_provider_others')));
                $provider_id = $this->db->insert_id();

                $_POST['training_application']['training_provider'] = $provider_id;
            }
        }   

        //get total confirm on training calendar to validate
        if ($calendar_id != '') {
            $query = "SELECT COUNT(*) total_confirm FROM ww_training_calendar_participant c 
                WHERE c.training_calendar_id  = " . $calendar_id . " AND participant_status_id = 2";

            $total_confirm_result = $this->db->query($query);

            if ($total_confirm_result && $total_confirm_result->num_rows() > 0) {
                $total_confirm = $total_confirm_result->row();

                if ((int)$total_confirm->total_confirm >= (int)$_POST['training_application']['max_training_capacity']){
                    $this->response->message[] = array(
                        'message' => 'Maximum training capacity has been filled already.',
                        'type' => 'error'
                    );
                    $this->_ajax_return();  
                }
            }
        }

        if( !$this->_set_record_id() )
        {
            $this->response->message[] = array(
                'message' => lang('common.insufficient_data'),
                'type' => 'error'
            );
            $this->_ajax_return();  
        }
        
        if( (empty( $this->record_id ) && !$this->permission['add']) || ($this->record_id && !$this->permission['edit']) )
        {
            $this->response->message[] = array(
                'message' => lang('common.insufficient_permission'),
                'type' => 'warning'
            );
            $this->_ajax_return();
        }

        $this->response = $this->mod->_save( $child_call );
        $this->record_id = $this->response->record_id;

        if( $this->response->saved ) {
            $status_id = $_POST['training_application']['status_id'];

            if( $status_id == 1)
                $this->db->update('training_application', array('status_id' => $status_id,'user_id' => $this->user->user_id), array('training_application_id' => $this->record_id));            

            if ($status_id == 4) {
                $training_request_approvers = $this->db->query("CALL sp_training_request_populate_approvers({$this->response->record_id}, ".$this->user->user_id.")");

                $approvers = $this->mod->get_approvers($this->record_id,$this->user->user_id);

                if ($approvers && $approvers->num_rows() > 0) {
                    $this->db->update('training_application', array('status_id' => $status_id,'user_id' => $this->user->user_id), array('training_application_id' => $this->record_id));            
                }                

                $this->response->notified = $this->mod->notify_approvers( $this->record_id,$this->user->user_id);
            }

/*            if ($this->input->post('training_course_others') != '') {
                $this->db->where('course',$this->input->post('training_course_others'));
                $course = $this->db->get('training_course');
                if ($course && $course->num_rows > 0) {
                    $this->response->message[] = array(
                        'message' => 'Training course already exists!',
                        'type' => 'warning'
                    ); 
                } else {
                    $this->db->insert('training_course',array('course' => $this->input->post('training_course_others')));
                    $course_id = $this->db->insert_id();

                    $this->db->update('training_application', array('training_course_id' => $course_id), array('training_application_id' => $this->record_id));
                }
            }

            if ($this->input->post('training_provider_others') != '') {
                $this->db->where('provider',$this->input->post('training_provider_others'));
                $provider = $this->db->get('training_provider');
                if ($provider && $provider->num_rows > 0) {
                    $this->response->message[] = array(
                        'message' => 'Training provider already exists!',
                        'type' => 'warning'
                    );                     
                } else {
                    $this->db->insert('training_provider',array('provider' => $this->input->post('training_provider_others')));
                    $provider_id = $this->db->insert_id();

                    $this->db->update('training_application', array('training_provider' => $provider_id), array('training_application_id' => $this->record_id));
                }
            }  */          
        }

        
        if( !$child_call )
        {
            $this->_ajax_return();
        }

    }

    function get_idp()
    {
        $this->_ajax_only();

        $this->load->model('appraisal_individual_planning_model','appraisal_planning_model');

        $qry = "SELECT * FROM performance_planning_idp WHERE user_id = {$this->user->user_id}";
        $result = $this->db->query($qry);

        if($result && $result->num_rows() > 0) {
            $data['list_idp'] = $result;
            $data['areas_development'] = $this->appraisal_planning_model->get_areas_for_development();
            $data['learning_mode'] = $this->appraisal_planning_model->get_learning_mode();
            $data['competencies'] = $this->appraisal_planning_model->get_competencies();
            $data['target_completion'] = $this->appraisal_planning_model->get_target_completion();

            $this->response->quick_edit_form = $this->load->view('edit/idp.blade.php', $data, true);
            $this->response->user_id = $this->user->user_id;

            $this->response->message[] = array(
                'message' => '',
                'type' => 'success'
            );            
        } else {
            $this->response->quick_edit_form = '';
            $this->response->user_id = $this->user->user_id;

            $this->response->message[] = array(
                'message' => 'No record for IDP found!',
                'type' => 'warning'
            );                        
        }

        $this->_ajax_return();
    }

    public function get_training_course_info(){
        $this->_ajax_only();

        if( $this->input->post('course_id') ){

            $course_id = $this->input->post('course_id');

            $training_course_info = "SELECT * FROM ww_training_course c 
                LEFT JOIN ww_training_provider p ON p.`provider_id` = c.`provider_id`
                LEFT JOIN ww_training_category cat ON cat.`category_id` = c.`category_id`
                WHERE c.course_id  = '" . $course_id . "' ";

            $training_course_info = $this->db->query($training_course_info);

            if($training_course_info->num_rows() > 0){

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

        $this->_ajax_return();

    }

    public function get_training_calendar_info(){
        $this->_ajax_only();

        if( $this->input->post('training_calendar_id') ){

            $training_calendar_id = $this->input->post('training_calendar_id');

            $query = "SELECT * FROM ww_training_calendar c 
                WHERE c.training_calendar_id  = " . $training_calendar_id . " ";

            $training_calendar_info = $this->db->query($query);

            if($training_calendar_info->num_rows() > 0){

                $this->response->calendar_info = $training_calendar_info->row_array();
            }

            $query = "SELECT MIN(session_date) date_from,MAX(session_date) date_to,SUM(TIMESTAMPDIFF(HOUR, sessiontime_from, sessiontime_to)) total_training_hours FROM ww_training_calendar_session c 
                WHERE c.training_calendar_id  = " . $training_calendar_id . " ";

            $training_calendar_session_info = $this->db->query($query);            

            if($training_calendar_session_info->num_rows() > 0){
                $session = $training_calendar_session_info->row_array();

                $this->response->calendar_info['date_from'] = $session['date_from'];
                $this->response->calendar_info['date_to'] = $session['date_to'];
                $this->response->calendar_info['total_training_hours'] = $session['total_training_hours'];
            }

            $this->response->message[] = array(
                'message' => 'Succesfully called!',
                'type' => 'success'
            );            
        }

        $this->_ajax_return();

    }

    function download_file($training_application_id){   
        $this->db->select("attachment")
        ->from("training_application")
        ->where("training_application_id = {$training_application_id}");

        $image_details = $this->db->get()->row_array();   
        $path = base_url() . $image_details['attachment'];

        header('Content-disposition: attachment; filename='.substr( $image_details['attachment'], strrpos( $image_details['attachment'], '/' )+1 ).'');
        header('Content-type: txt/pdf');
        readfile($path);
    }    
}