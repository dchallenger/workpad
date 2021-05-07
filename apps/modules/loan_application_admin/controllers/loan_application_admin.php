<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loan_application_admin extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('loan_application_admin_model', 'mod');
		$this->load->model('loan_application_model', 'app_personal');
		$this->load->model('loan_application_manage_model', 'app_manage');
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
        $data['permission_app_manage'] = isset($permission[$this->app_manage->mod_code]['list']);

        $data['permission_app_admin'] = isset($this->permission['list']) ? $this->permission['list'] : 0;
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

            $rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> '.lang('loan_application.view').'</a></li>';
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

    function save_form()
    {
        $this->_ajax_only();
        $this->response->saved = false; 
        $error = false;

        if( !$this->permission['add'] && !$this->permission['edit'] )
        {
            $this->response->message[] = array(
                'message' => lang('loan_application.perm_listfg'),
                'type' => 'warning'
            );
            $this->_ajax_return();
        }
        $this->response->loan_application_id = $loan_application_id = $this->input->post('record_id');
        $loan_type_id = $this->input->post('loan_type_id');
        $loan_type_code = $this->input->post('loan_type_code');

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/field_groups.php' );
        $fieldgroups = $config['fieldgroups'];
        $fg_fields_array = $fieldgroups[$loan_type_id]['fields'];

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/fields.php' );
        $fields = $config['fields'];
        
        // if( $this->input->post('loan_application') ){
            foreach($this->input->post('loan_application') as $key => $val ){
                $_POST[$key] = $val;
            }
        // }

        if( $this->input->post('loan_application_upload') ){
            foreach($this->input->post('loan_application_upload') as $key => $val ){
                $_POST[$key] = $val;
            }
        }


        /*******START Filed FORM validation********/

        //check if loan application is for cancellation
        if($this->input->post('loan_application_status_id') == 8){
            if(trim($this->input->post('comment')) == ""){
                $this->response->message[] = array(
                    'message' => lang('loan_application.remarks_required'),
                    'type' => 'warning'
                );  
                $this->_ajax_return();            
            }
        }

        //validation of fields on module manager
        $main_record = array();
        foreach($fg_fields_array as $index => $field )
        {            
            $validation_rules[] = 
                array(
                    'field' => $fields[$loan_type_id][$field]['column'],
                    'label' => $fields[$loan_type_id][$field]['label'],
                    'rules' => $fields[$loan_type_id][$field]['datatype']
            );
            //getting fields from module manager and assign its values
            switch($fields[$loan_type_id][$field]['uitype_id']){
                case 6: //DATE Picker
                    if( $this->input->post('res_type') == 2 ){
                        $date = substr($this->input->post($fields[$loan_type_id][$field]['column']), 0, -11);
                        $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $date != "" ? date('Y-m-d', strtotime($date)) : "";
                    }else{
                        $date = $this->input->post($fields[$loan_type_id][$field]['column']);
                        $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $date != "" ? date('Y-m-d', strtotime($date)) : "";
                    }
                break;
                case 16: //DATETIME Picker
                    if( $this->input->post('addl_type') == 'Use' ){
                        $date = $this->input->post($fields[$loan_type_id][$field]['column']);
                        $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $date != "" ? date('Y-m-d', strtotime($date)) : "";
                    }else{
                        $date = substr($this->input->post($fields[$loan_type_id][$field]['column']), 0, -11);
                        $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $date != "" ? date('Y-m-d', strtotime($date)) : "";
                    }
                break;
                default:
                    $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $this->input->post($fields[$loan_type_id][$field]['column']);
                break;
            }

            if( $fields[$loan_type_id][$field]['encrypt'] && $this->input->post($fields[$loan_type_id][$field]['column'] ) )
            {                               
                //$this->load->library('aes', array('key' => $this->config->item('encryption_key')));         
                $this->load->library('my_aes',$this->config->item('encryption_key'));

                $main_record[$fields[$loan_type_id][$field]['table']][$fields[$loan_type_id][$field]['column']] = $this->my_aes->encrypt( $this->input->post($fields[$loan_type_id][$field]['column']) );
            }            
        }

        if($this->input->post('loan_application_status_id') != 8){
            //fields not on module manager
            //none of this moment

            //START Form Validation
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
            //END Form Validation        

            //Validate form based on policies    
            $forms_validation = array(); //$this->time_form_policies->validate_form_filing($loan_application_id, strtoupper($this->input->post('loan_type_code')), $this->user->user_id);

            if (isset($forms_validation['error'])) { 
                if(count($forms_validation['error']) > 0 ){             
                    foreach( $forms_validation['error'] as $f => $f_error )
                    {
                        $this->response->message[] = array(
                            'message' => $f_error,
                            'type' => 'error'
                            );  
                    }     
                        $this->_ajax_return();
                }
            }
            if (isset($forms_validation['warning'])) { 
                if(count($forms_validation['warning']) > 0 ){  
                    foreach( $forms_validation['warning'] as $f => $f_error )
                    {
                        $this->response->message[] = array(
                            'message' => $f_error,
                            'type' => 'warning'
                            );  
                    }
                }
            }
        }else{
            //Validate form based on policies    
            $forms_validation = array();//$this->time_form_policies->validate_form_change_status($loan_application_id,$this->input->post('loan_application_status_id'));

            if (isset($forms_validation['error'])) {
                if(count($forms_validation['error']) > 0 ){         
                    foreach( $forms_validation['error'] as $f => $f_error )
                    {
                        $this->response->message[] = array(
                            'message' => $f_error,
                            'type' => 'error'
                            );  
                    }     
                        $this->_ajax_return();
                }
            }

            if (isset($forms_validation['warning'])) {
                if(count($forms_validation['warning']) > 0 ){   
                    foreach( $forms_validation['warning'] as $f => $f_error )
                    {
                        $this->response->message[] = array(
                            'message' => $f_error,
                            'type' => 'warning'
                            );  
                    }
                }
            }
        }
        /*******END Filed FORM validation********/

        //fields not setup on module manager - value assignment
        $main_record[$this->mod->table]['loan_application_status_id'] = $this->input->post('loan_application_status_id');
        $main_record[$this->mod->table]['loan_type_id'] = $this->input->post('loan_type_id');
        $main_record[$this->mod->table]['loan_type_code'] = strtoupper($this->input->post('loan_type_code'));
        $main_record[$this->mod->table]['user_id'] = $this->input->post('user_id');
        $main_record[$this->mod->table]['display_name'] = $this->app_personal->get_display_name($this->input->post('user_id'));
        $main_record[$this->mod->table]['comment'] = $this->input->post('comment');

        if($this->input->post('loan_application_status_id') == 8){ //add cancelled date
            $main_record[$this->mod->table]['date_cancelled'] = date('Y-m-d H:i:s');
        }

        //SAVING START
        $transactions = true;
        if( $transactions )
        {
            $this->db->trans_begin();
        }

        //start saving with main table
        $record = $this->db->get_where( $this->mod->table, array( $this->mod->primary_key => $loan_application_id ) );
        // $record = $this->db->get_where( 'loan_application', array( 'loan_application_id' => $loan_application_id ) );
        switch( true )
        {
            case $record->num_rows() == 0:
                //add mandatory fields
                $main_record[$this->mod->table]['created_on'] = date('Y-m-d H:i:s');

                if( in_array($main_record[$this->mod->table]['loan_application_status_id'],array(2,4)) ){
                    $main_record[$this->mod->table]['date_sent'] = date('Y-m-d H:i:s');
                }

                $this->db->insert($this->mod->table, $main_record[$this->mod->table]);
                if( $this->db->_error_message() == "" )
                {
                    $loan_application_id = $this->record_id = $this->db->insert_id();

                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', $this->mod->table, array(), $main_record[$this->mod->table],$main_record[$this->mod->table]['user_id']);
                }
                break;
            case $record->num_rows() == 1:
                // $main_record['modified_by'] = $this->user->user_id;
                $main_record[$this->mod->table]['modified_on'] = date('Y-m-d H:i:s');

                if( in_array($main_record[$this->mod->table]['loan_application_status_id'],array(2,4)) ){
                    $main_record[$this->mod->table]['date_sent'] = date('Y-m-d H:i:s');
                }


                $this->db->update( $this->mod->table, $main_record[$this->mod->table], array( $this->mod->primary_key => $loan_application_id) );

                $previous_main_data = $record->row_array();

                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', $this->mod->table, array(), $main_record[$this->mod->table],$main_record[$this->mod->table]['user_id']);                                
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
        
        // remove main table since it was updated already above.
        
        unset($main_record[$this->mod->table]);

        //start saving with sub table
        foreach( $main_record as $table => $data )
        {
            $record = $this->db->get_where( $table, array( $this->mod->primary_key => $loan_application_id ) );
            switch( true )
            {
                case $record->num_rows() == 0:
                    $data[$this->mod->primary_key] = $loan_application_id;
                    $this->db->insert($table, $data);
                    $this->record_id = $this->db->insert_id();
                    break;
                case $record->num_rows() == 1:
                    $this->db->update( $table, $data, array( $this->mod->primary_key => $loan_application_id) );
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

        if(!empty($loan_application_id)){
            $loan_application_details = $this->mod->get_loan_application_details($loan_application_id);

            //if($loan_application_details['loan_application_status_id'] == 2 || $loan_application_details['loan_application_status_id'] == 8){
            if($loan_application_details['loan_application_status_id'] == 2){

                //INSERT NOTIFICATIONS FOR APPROVERS
                $this->response->notified = $this->app_personal->notify_approvers( $loan_application_id, $loan_application_details );
                $this->response->notified = $this->mod->notify_filer( $loan_application_id, $loan_application_details );
            }
        }

        if( !$error )
        {
            $this->response->loan_application_id = $loan_application_id;
            $this->response->saved = true; 
            $this->response->message[] = array(
                'message' => $this->input->post('loan_type').' '.lang('loan_application.success_save'),
                'type' => 'success'
            );
        }

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

        $loan_application_attachment = array();
        if( $record_id ){
             $loan_application_data = $this->app_personal->edit_cached_query( $record_id );
             $loan_application_attachment = $this->app_personal->get_loan_application_attachment($record_id);
        }

        $data['attachement'] = $loan_application_attachment;   
        
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

    function edit( $record_id = "", $child_call = false ){
        $this->_set_record_id();
        parent::edit($this->record_id,true);
        $record_id = $this->record_id;
        $loan_application_info = $this->mod->get_loan_application_details($this->record_id);
        $loan_type_info = $this->app_personal->get_loan_type($loan_application_info['loan_type_code']);

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/field_groups.php' );
        $fieldgroups = $config['fieldgroups'];
        $fg_fields_array = $fieldgroups[$loan_type_info['loan_type_id']]['fields'];

        require( APPPATH . 'modules/'. $this->mod->mod_code .'/config/fields.php' );
        $fields = $config['fields'];

        $data = array();

        $data['url'] = $this->mod->url;
        $data['loan_application_status_id']["val"] = $loan_application_info['loan_application_status_id'];
        $data['user_id'] = $loan_application_info['user_id'];
        $data['loan_type_id'] = $loan_type_info['loan_type_id'];
        $data['loan_type_code'] = $loan_type_info['loan_type_code'];
        $data['loan_type'] = $loan_type_info['loan_type'];
        $data['upload_id']["val"] = array();
        $data['back_url'] = get_mod_route('loan_application_admin');

        $data['entitlement'] = $this->app_personal->get_entitlement();
        $data['enrollment_type'] = $this->app_personal->get_enroll_ment_type();
        $data['plan_limit'] = $this->app_personal->get_plan_limit();
        $data['special_features'] = $this->app_personal->get_special_features();

        $loan_application_attachment = array();
        if( $record_id ){
             $loan_application_data = $this->app_personal->edit_cached_query( $record_id );
             $loan_application_attachment = $this->app_personal->get_loan_application_attachment($record_id);
        }

        $data['attachement'] = $loan_application_attachment;  

        foreach($fg_fields_array as $index => $field )
        {

            $data[$fields[$data['loan_type_id']][$field]['column']]["label"] = $fields[$data['loan_type_id']][$field]['label'];
            if( $record_id )
            {    
                switch($fields[$data['loan_type_id']][$field]['uitype_id']){
                    case 8: //Single Upload
                    case 9: //Multiple Upload
                        $upload_forms = $this->mod->get_forms_upload($record_id);
                        $all_uploaded = array();
                        foreach( $upload_forms as $upload_form )
                        {
                            $all_uploaded[] = $upload_form['upload_id'];
                        }
                        $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $all_uploaded;
                    break;
                    case 6: //DATE Picker
                        if( in_array($data['loan_type_id'], array(10, 15, 28)) && $fields[$data['loan_type_id']][$field]['column'] != 'focus_date'){ //undertime form/ excused tardiness
                            if($fields[$data['loan_type_id']][$field]['column'] == "date_from"){
                                $date_time = $this->mod->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_from', $data['loan_type_id'], $data['bt_type']);
                                $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y", strtotime($date_time));
                            }else{
                                $date_time = $this->mod->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_to', $data['loan_type_id'], $data['bt_type']);
                                $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y", strtotime($date_time));
                            }
                        }else{
                            $date = date("F d, Y", strtotime($loan_application_data[$field]));
                            $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $date;
                        }
                        break;
                    case 16: //DATETIME Picker
                        if($fields[$data['loan_type_id']][$field]['column'] == "date_from"){
                            $date_time = $this->mod->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_from', $data['loan_type_id'], $data['bt_type']);
                            $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y - h:i a", strtotime($date_time));
                        }else{
                            $date_time = $this->mod->get_time_from_to_dates($record_id, date("Y-m-d", strtotime($loan_application_data[$field])), 'time_to', $data['loan_type_id'], $data['bt_type']);
                            $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = (empty($date_time)) ? "" : date("F d, Y - h:i a", strtotime($date_time));
                        }
                    break;
                    default:
                        $data[$fields[$data['loan_type_id']][$field]['column']]["val"] = $loan_application_data[$field];
                    break;
                }
            }
        }

        if($data['loan_application_status_id']['val'] > 1){
            $data['approver_list'] = $this->app_personal->get_time_forms_approvers($record_id);
            $data['approver_title'] = lang('laon_application.approval_status');
        }else{
            $data['approver_list'] = $this->app_personal->call_sp_approvers(strtoupper($data['loan_type_code']), $this->user->user_id);
            $data['approver_title'] = lang('laon_application.approvers');
        }

        $this->load->vars($data);

        $this->load->helper('form');
        $this->load->helper('file');
        if( $this->input->post('mobileapp') )
        {
            ob_start();
            echo $this->load->blade('edit_mobile.edit_'.strtolower($loan_application_info['loan_type_code']))->with( $this->load->get_cached_vars() );
            $this->response->form = ob_get_clean();
            $this->response->message[] = array(
                'message' => '',
                'type' => 'success'
            );
            $this->_ajax_return();
        }
        else
            echo $this->load->blade('edit.edit_'.strtolower($loan_application_info['loan_type_code']))->with( $this->load->get_cached_vars() );
        
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