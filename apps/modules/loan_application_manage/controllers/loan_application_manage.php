<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loan_application_manage extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('loan_application_manage_model', 'mod');
		$this->load->model('loan_application_model', 'app_personal');
		$this->lang->load( 'loan_application' );
		parent::__construct();

		$this->loan_type = $this->app_personal->get_loan_type();
	}

    public function index()
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
        $data['permission_app_manage'] = isset($this->permission['list']) ? $this->permission['list'] : 0;

        $data['permission_app_admin'] = 0;
        $data['permission_app_personal'] = isset($permission[$this->app_personal->mod_code]['list']);

        $data['loan_status'] = $this->app_personal->get_loan_statuses();

        $this->load->model('my201_model', 'profile_mod');

        $data['loan_type'] = $this->loan_type;

        $this->load->vars($data);        
        echo $this->load->blade('listing_custom')->with( $this->load->get_cached_vars() );                        
    }	

    function _list_options( $record, &$rec )
    {

        if( $this->permission['edit'] )
        {
            $rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
            $rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
        }   

        if( $this->permission['detail'] )
        {
            if( $record['partners_loan_type'] == 'Daily Time Record Updating') {
                $rec['detail_url'] = get_mod_route('loan_application', 'updating'. '/');
            } else {
                $rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
            }

            if( $record['loan_application_status_id'] == 1 || $record['loan_application_status_id'] == 2 ){
                $rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> '.lang('loan_application.view').'</a></li>';
            }
        }

        if( $this->permission['delete'] )
        {
            $rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];

            if( $record['loan_application_status_id'] == 1 ){
                $rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
            }
        }
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
        $trash = $this->input->post('trash') == 'true' ? true : false;
        $filter = $this->input->post('filter');
        
        /** start - for status filter **/ 
        $pos = strpos($filter,"/");
        $filters = "";
        if($pos)
        { 
            $fil_arr = explode("/", $filter);
            foreach ($fil_arr as $val) {
                $pos_val = strpos($val, "undefined");
                if(!$pos_val)
                {
                    $filters = $val;
                }
            }
        }

        $filter = "";
        $filter_by = $this->input->post('filter_by');
        $filter_value = $this->input->post('filter_value');
        
        if( is_array( $filter_by ) )
        {
            foreach( $filter_by as $filter_by_key => $filter_value )
            {
                if( $filter_value != "" && $filter_value != 0 ) {
                    $filter .= " AND {$this->db->dbprefix}{$this->mod->table}.". $filter_by_key .' = "'.$filter_value.'"';      
                }
            }
        }
        /** end - for status filter **/ 

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
        $page = ($page < 0 ? 0 : $page);
        $records = $this->mod->_get_list($page, 10, $search, $filter, $trash); // for status filter

        $this->response->records_retrieve = sizeof($records);
        $this->response->list = '';
        $this->response->total_record = count($records);

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
                $forms_validation = array(); //$this->time_form_policies->validate_form_cancel_status($record['record_id']);
                $record = array_merge($record, $forms_validation);

                if( $this->input->post('mobileapp') )
                    $this->response->list .= $this->load->blade('list_template_mobile', $record, true);
                else
                    $this->response->list .= $this->load->blade('list_template', $record, true);
                
            }

            $this->response->no_record = '';

        }
        else{

            $this->response->list = "";
        }
    
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );
    
        $this->_ajax_return();
    }

    public function detail( $record_id, $child_call = false )
    {   
        $this->_set_record_id();
        parent::detail($this->record_id,true);
        $record_id = $this->record_id;
        $loan_application_info = $this->app_personal->get_loan_application_details($this->record_id);
        $loan_type_info = $this->app_personal->get_loan_type($loan_application_info['loan_type_code']);

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/field_groups.php' );
        $fieldgroups = $config['fieldgroups'];
        $fg_fields_array = $fieldgroups[$loan_application_info['loan_type_id']]['fields'];

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/fields.php' );
        $fields = $config['fields'];

        $data = array();

        $data['loan_application_id'] = $this->record_id;
        $data['url'] = $this->mod->url;
        $data['loan_application_status_id']["val"] = $loan_application_info['loan_application_status_id'];
        $data['loan_type_id'] = $loan_type_info['loan_type_id'];
        $data['loan_type_code'] = $loan_type_info['loan_type_code'];
        $data['loan_type'] = $loan_type_info['loan_type'];
        $data['loan_application_approver_details'] = $this->mod->get_loan_application_approver_info($this->record_id,$this->user->user_id);
        $data['upload_id']["val"] = array();

        if( $record_id ){
             $loan_application_data = $this->app_personal->edit_cached_query( $record_id );
        }

        foreach($fg_fields_array as $index => $field )
        {
            $data[$fields[$data['loan_type_id']][$field]['column']]["label"] = $fields[$data['loan_type_id']][$field]['label'];
            if( $record_id )
            {    
                switch($fields[$data['loan_type_id']][$field]['uitype_id']){
                    case 8: //Single Upload
                    case 9: //Multiple Upload
                        $upload_forms = $this->app_personal->get_forms_upload($record_id);
                        $all_uploaded = array();
                        foreach( $upload_forms as $upload_form )
                        {
                            $all_uploaded[] = $upload_form['upload_id'];
                        }
                        $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $all_uploaded;
                    break;
                    case 6: //DATE Picker
                        if($data['loan_type_id'] == 15){ //undertime form/ excused tardiness
                            if($fields[$data['loan_type_id']][$field]['column'] == "date_from"){
                                $date_time = $this->app_personal->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_from', $data['loan_type_id'], $data['bt_type']);
                                $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y", strtotime($date_time));
                            }else{
                                $date_time = $this->app_personal->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_to', $data['loan_type_id'], $data['bt_type']);
                                $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y", strtotime($date_time));
                            }

                        }else{
                        $date = date("F d, Y", strtotime($loan_application_data[$field]));
                        $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $date;
                        }
                        break;
                    case 16: //DATETIME Picker
                        if($fields[$data['loan_type_id']][$field]['column'] == "date_from"){
                            $date_time = $this->app_personal->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_from', $data['loan_type_id'], $data['bt_type']);
                            $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y - h:i a", strtotime($date_time));
                        }else{
                            $date_time = $this->app_personal->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_to', $data['loan_type_id'], $data['bt_type']);
                            $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y - h:i a", strtotime($date_time));
                        }
                    break;
                    default:
                        $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $loan_application_data[$field];
                    break;
                }
            }
        }

        $data['remarks'] = $this->mod->get_approver_remarks($record_id);

        if($data['loan_application_status_id']['val'] == 7 || $data['loan_application_status_id']['val'] == 8){ //disapproved, display remarks
            $data['disapproved_cancelled_remarks'] = $this->mod->get_disapproved_cancelled_remarks($record_id);
        }

        if($data['loan_application_status_id']['val'] > 1){
            $data['approver_list'] = $this->app_personal->get_time_forms_approvers($record_id);
            $data['approver_title'] = lang('loan_application.approval_status');
        }else{
            $data['approver_list'] = $this->app_personal->call_sp_approvers(strtoupper($data['loan_type_code']), $this->user->user_id);
            $data['approver_title'] = lang('loan_application.approvers');
        }
        
        $date_adc = '';
        $label = '';
        switch ($data['loan_application_status_id']['val']) {
            case 6:
                $label = 'Date Approved';
                $date_adc = $loan_application_info['date_approved'];
                break;
            case 7:
                $label = 'Date Disapproved';
                $date_adc = $loan_application_info['date_declined'];
                break;
            case 8:
                $label = 'Date Cancelled';
                $date_adc = $loan_application_info['date_cancelled'];
                break;                            
            default:
                $label = '';
                break;
        }
        
        $data['label_adc'] = $label;
        $data['date_adc'] = $date_adc;

        $this->load->vars($data);

        $this->load->helper('form');
        $this->load->helper('file');

        if( $this->input->post('mobileapp') )
        {
            ob_start();
            echo $this->load->blade('detail_mobile.detail_'.strtolower($loan_application_info['loan_type_code']))->with( $this->load->get_cached_vars() );
            $this->response->form = ob_get_clean();
            $this->response->message[] = array(
                'message' => '',
                'type' => 'success'
            );
            $this->_ajax_return();
        }
        else
            echo $this->load->blade('detail.detail_'.strtolower($loan_application_info['loan_type_code']))->with( $this->load->get_cached_vars() );

    }

    public function loan_application_decission(){

        $this->current_user = $this->session->userdata['user']->user_id;

        $this->_ajax_only();
        $data = array();
        
        // temporary remove forms validation
        $forms_validation = array();
        //$forms_validation = $this->time_form_policies->validate_form_change_status($this->input->post('formid'),$this->input->post('decission'));

/*        if(array_key_exists('error', $forms_validation) ){
            if(count($forms_validation['error']) > 0 ){            
                foreach( $forms_validation['error'] as $f => $f_error )
                {
                    $this->response->message[] = array(
                        'message' => $f_error,
                        'type' => 'error'
                        );  
                }  
            }
        }
        if (array_key_exists('warning', $forms_validation)){
            if(count($forms_validation['warning']) > 0 ){   
                foreach( $forms_validation['warning'] as $f => $f_error )
                {
                    $this->response->message[] = array(
                        'message' => $f_error,
                        'type' => 'warning'
                        );  
                }
            }
        }*/

        if(isset($forms_validation['error']) && count($forms_validation['error']) > 0 ){    
            $this->_ajax_return();          
        }else{
            // 1. set forms approver decision
            $result = $this->mod->setDecission($this->input->post());

            // 2. build a notification message
            //    designed to determine the type of form
            //    the recipient has submitted.
            $this->load->model('form_application_manage_model', 'dash_mod');

            $approver       = $this->input->post('username');
            $action         = $this->input->post('decission') == '1' ? ' approved ' : ' disapproved '; 
            $loan_application_info      = $this->mod->get_loan_application_details($this->input->post('loan_application_id')); 
            // $loan_application_info       = $this->input->post('formname'); 
            $recipient      = $this->input->post('loan_application_owner_id');
            $notif_message  = 'Filed ' . $loan_application_info['loan_type'] . ' for ' . date('F j, Y', strtotime($loan_application_info['created_on'])) . ' has been '.$action.'.';
            if(trim($this->input->post('comment')) != ""){
                $notif_message  .= '<br><br>Remarks: '.$this->input->post('comment');
            }

            //Get current user fullname
            $current_user = array();
            $current_user = $this->db->get_where('users',array('user_id' => $this->session->userdata['user']->user_id))->row();

            $data['user_id']        = $this->session->userdata['user']->user_id;                                // THE CURRENT LOGGED IN USER 
            $data['display_name']   = $current_user->full_name;                                                 // THE CURRENT LOGGED IN USER'S DISPLAY NAME
            $data['feed_content']   = $notif_message;                                                           // THE MAIN FEED BODY
            $data['recipient_id']   = $recipient;                                                               // TO WHOM THIS POST IS INTENDED TO
            $data['status']         = 'info';                                                                   // TO WHOM THIS POST IS INTENDED TO
            $data['message_type']   = 'Loan Application';    
            $data['loan_application_id'] = $this->input->post('loan_application_id');                                                               // DANGER, INFO, SUCCESS & WARNING

            // ADD NEW DATA FEED ENTRY
            $latest = $this->mod->newPostData($data, 'appforms');
            $this->response->target = $latest;

            // determines to where the action was 
            // performed and used by after_save to
            // know which notification to broadcast
            $this->response->type       = 'todo';
            $this->response->action     = 'insert';

            $this->response->message[]  = array(
                'message'   => lang('common.save_successful'),
                'type'      => 'success'
            );
            
            $this->_ajax_return();
        }
    } 

    function get_loan_application_details(){
        $this->_ajax_only();
        $loan_type_code = $this->input->post('loan_type_code');
        $loan_application_id = $this->input->post('loan_application_id');

        $this->response->loan_application_details = '';
        switch($loan_type_code){
            case ('CPLA')://Car Plan Loan Application
                $loan_application_details = $this->mod->get_cpla_details($loan_application_id, $this->user->user_id);
                $remarks['remarks'] = array();
                $comments = $this->mod->get_approver_remarks($loan_application_id);
                foreach ($comments as $comment){
                    $remarks['remarks'][] = $comment;
                }
                $loan_application_details = array_merge($loan_application_details, $remarks);
                $this->response->loan_application_details .= $this->load->blade('edit/'.$loan_type_code.'_details', $loan_application_details, true);  
            break;
            case ('OLA')://Omnibus Loan Application
                $loan_application_details = $this->mod->get_ola_details($loan_application_id, $this->user->user_id);
                $remarks['remarks'] = array();
                $comments = $this->mod->get_approver_remarks($loan_application_id);
                foreach ($comments as $comment){
                    $remarks['remarks'][] = $comment;
                }
                $loan_application_details = array_merge($loan_application_details, $remarks);
                $this->response->loan_application_details .= $this->load->blade('edit/'.$loan_type_code.'_details', $loan_application_details, true);              
            break;
            case ('MAP')://Mobile Application Plan
                $loan_application_details = $this->mod->get_map_details($loan_application_id, $this->user->user_id);
                $remarks['remarks'] = array();
                $comments = $this->mod->get_approver_remarks($loan_application_id);
                foreach ($comments as $comment){
                    $remarks['remarks'][] = $comment;
                }
                $loan_application_details = array_merge($loan_application_details, $remarks);
                $this->response->loan_application_details .= $this->load->blade('edit/'.$loan_type_code.'_details', $loan_application_details, true);             
            break;
        }

        $this->_ajax_return();
    }       
}