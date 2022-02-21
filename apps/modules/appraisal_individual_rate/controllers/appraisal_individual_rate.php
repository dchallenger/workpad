<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Appraisal_individual_rate extends MY_PrivateController
{
    private $current_user = array();

	public function __construct()
	{
        $this->load->config('other_settings');
        $this->load->model('appraisal_individual_planning_model','individual_planning_model');
		$this->load->model('appraisal_individual_rate_model', 'mod');
        $this->load->model('performance_appraisal_admin_model', 'mod_admin');
        $this->lang->load('appraisal_individual_planning');

		parent::__construct();
        $this->current_user = $this->config->item('user');
	}


    public function index()
    {
        if( !$this->permission['list'] )
        {
            echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
            die();
        }
        
        $permission = parent::_check_permission('performance_appraisal_manage');
        $data['allow_manage'] = ($permission != 0 ? $permission['list'] : $permission);;
        $permission = parent::_check_permission('performance_appraisal');
        $data['allow_admin'] = ($permission != 0 ? $permission['list'] : $permission);;

        $this->load->vars($data);
        echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
    }

    function get_observations()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
        $vars['user_id'] = $_POST['user_id'];
        $vars['hidden'] = "";
        if($this->user->user_id == $vars['user_id']){
            $vars['hidden'] = "hidden";
        }
        $vars['observations'] = $this->mod->get_observations($_POST['performance_appraisal_year'], $_POST['user_id']);
        $this->load->vars($vars);

        $data['title'] = $_POST['fullname'].
        '<br><span class="text-muted">'.$_POST['performance_appraisal_year'].' Observations and Feedbacks</span>';
        $data['content'] = $this->load->blade('edit.observations')->with( $this->load->get_cached_vars() );

        $this->response->notes = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    public function submitObservation(){

        $this->_ajax_only();
        $data = array();

        $this->load->model('dashboard_model', 'dashboard_mod');

        $data['current_user']   = $this->session->userdata['user']->user_id;
        $data['user_id']        = $this->session->userdata['user']->user_id;                                // THE CURRENT LOGGED IN USER 
        $data['display_name']   = $this->current_user['lastname']. ", ". $this->current_user['firstname'];  // THE CURRENT LOGGED IN USER'S DISPLAY NAME
        $data['feed_content']   = mysqli_real_escape_string($this->db->conn_id, $_POST['observation_message']);     // THE MAIN FEED BODY
        $data['recipient_id']   = '0';                                                                      // TO WHOM THIS POST IS INTENDED TO
        $data['status']         = 'info';                                                                   // DANGER, INFO, SUCCESS & WARNING
        
        $data['recipients'] =  $this->input->post('user_id') === '' ? array() : explode(',', $this->input->post('user_id'));
        $data['to']             = 'user'; // TODO: change this when division is okay!!!

        if( count( $data['recipients'] ) == 0 ){
            $data['recipient_id'] = $data['user_id'];
        }

        if( !in_array( $data['user_id'], $data['recipients']) )
        {
            $data['recipients'][] = $data['user_id'];
        }   

        // NOW SAVE THE POSTED DATA AND GET THE INSERT ID
        $data['message_type'] = $this->input->post('message_type');
        $latest = $this->dashboard_mod->newPostData($data);
        $this->response->target = $latest;

        // SAVE RECIPIENTS
        if(count($data['recipients']) > 0){
            $recipients_result = $this->dashboard_mod->saveRecipients($latest, $data['to'], $data['recipients']);
        }

        // GET LATEST POSTED DATA AND RETURN IT BACK TO THE UI
        $dept_qry = " SELECT ud.department 
                    FROM {$this->db->dbprefix}users_profile up
                    LEFT JOIN {$this->db->dbprefix}users_department ud on ud.department_id = up.department_id 
                    WHERE up.user_id = {$data['user_id']}";
        $dept = $this->db->query($dept_qry)->row_array();

        $data['department']             = $dept['department'];
        $data['observations']           = $this->dashboard_mod->getLatestPostData($latest, $data['user_id'] );
        $this->response->new_feedback   = $this->load->view('customs/observation_display', $data, true);
        
        // NOW TELL THESE RECIPIENTS THEY'VE GOT SOMETHING!
        $this->response->recipients = $data['recipients'];
        $this->response->action         = 'insert';
        // determines to where the action was 
        // performed and used by after_save to
        // know which notification to broadcast
        $this->response->type           = 'feed';

        $this->response->message[] = array(
            'message' => 'Feedback successfully added.',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    // $child_call = $user_id - change to fit with parent class my controller
    public function edit( $record_id = "", $child_call = false )
    {
        parent::edit('', true);
        $this->after_edit_parent( $child_call );
    }

    public function after_edit_parent( $user_id )
    {
        $vars['manager_id'] ='';
        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );
        $this->load->model('performance_appraisal_manage_model', 'pam');
        $vars['self_review'] = $this->pam->get_self_review( $this->record_id, $user_id );
        if( $vars['appraisee']->user_id != $this->user->user_id && $vars['appraisee']->to_user_id != $this->user->user_id )
        {
            echo $this->load->blade('pages.not_under_attention')->with( $this->load->get_cached_vars() );
            die();
        }

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->template_id ); 

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name,ppar.remarks as approver_remarks, 
                        ppl.created_on, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id  
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppl.id ";

        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        //if all approver will then use $this->mod->get_list_approver
        $vars['list_approver'] = $this->mod->get_approver( $this->record_id, $user_id, $this->user->user_id);

        $vars['transaction_type'] = 'edit';
        $vars['appraisal_id'] = $this->record_id;
        $vars['balance_score_card'] = $this->individual_planning_model->get_balance_score_card();
        $vars['template_section_column'] = $this->individual_planning_model->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->individual_planning_model->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['appraisal_applicable_fields'] = $this->mod->get_appraisal_applicable_fields($this->record_id,$appraisee->user_id);
        $vars['template_section'] = $this->individual_planning_model->get_template_section($appraisee->template_id);
        $vars['library_competencies'] = $this->individual_planning_model->get_library_competencies();
        $vars['appraisal_applicable_section_ratings'] = $this->mod->get_appraisal_applicable_section_ratings($this->record_id,$appraisee->user_id);
        $vars['appraisal_applicable_score_library_ratings'] = $this->mod->get_appraisal_applicable_score_library_ratings($this->record_id,$appraisee->user_id);
        $vars['readonly'] = '';
        $vars['login_user_id'] = $this->user->user_id;
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['areas_development'] = $this->individual_planning_model->get_areas_for_development();
        $vars['learning_mode'] = $this->individual_planning_model->get_learning_mode();
        $vars['competencies'] = $this->individual_planning_model->get_competencies();
        $vars['target_completion'] = $this->individual_planning_model->get_target_completion();

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        
        if( $vars['appraisee']->status_id > 1 )
        {
            echo $this->load->blade('pages.review')->with( $this->load->get_cached_vars() );
        }
        else{
            echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
        }
    }

    function get_section_items()
    {
        $this->_ajax_only();
        
        $appraisee = $this->mod->get_appraisee( $this->input->post('appraisal_id'), $this->input->post('user_id') );
        $this->load->model('performance_appraisal_manage_model', 'pam');
        $vars['self_review'] = $this->pam->get_self_review( $this->record_id, $this->input->post('user_id') );
        $this->db->limit(1);
        $section = $this->db->get_where('performance_template_section', array('template_section_id' => $_POST['section_id']))->row();

        switch( $appraisee->status_id )
        {
            case 6:
                $folder = "summary";
                break;
            case 0:
            case 1:
            case 3:
                $folder = 'edit';
                break;    
            default:
                $folder = 'review';
        }

        $this->response->items = "";
        switch($section->section_type_id)
        {
            case 2:
                $this->response->items = $this->load->view($folder.'/items_balancescorecard', $_POST, true);
                break;
            case 4:
                $this->response->items = $this->load->view($folder.'/items_library_crowd', $_POST, true);
                break;
        }

        $this->response->section_id = $_POST['section_id'];
        $this->response->close_modal = true;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }

    function change_status( $return = false )
    {
        $this->load->model('system_feed');        
        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');  

        $this->_ajax_only();
        
        $this->db->trans_begin();
        $error = false;

        $appraisee = $this->mod->get_appraisee( $_POST['appraisal_id'], $_POST['user_id'] );      
        $status_id = $this->input->post('status_id');
        
        //get approvers
        $where = array(
            'appraisal_id' => $this->input->post('appraisal_id'),
            'user_id' => $this->input->post('user_id'),
        );
        $this->db->order_by('sequence');
        $approvers = $this->db->get_where('performance_appraisal_approver', $where)->result();
        $no_approvers = sizeof($approvers);

        $condition = $approvers[0]->condition;
        $fst_approver = $approvers[0];

        $appraisal_other_info = isset($_POST['individual_appraisal']) ? $_POST['individual_appraisal'] : array();

        $this->response->redirect = false;

        $update['status_id'] = $status_id;

        switch( $status_id ) {
            case 1://draft
                $update['self_rating'] = $this->input->post('self_rating');
                $update['appraisee_remarks'] = $this->input->post('appraisee_remarks');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_appraisal_applicable', $where)->row_array();

                $this->db->update('performance_appraisal_applicable', $update, $where);

                $this->response->redirect = get_mod_route('appraisal_individual_rate');                

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_appraisal_applicable', $previous_main_data, $update);
                break;
            case 2://for approval
                $update['self_rating'] = $this->input->post('self_rating');
                $update['appraisee_remarks'] = $this->input->post('appraisee_remarks');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_appraisal_applicable', $where)->row_array();

                $this->db->update('performance_appraisal_applicable', $update, $where);

                foreach(  $approvers  as $index => $approver )
                {
                    if( $index == 0 )
                    {
                        $this->db->update('performance_appraisal_approver', array('performance_status_id' => 2), array('id' => $approver->id));

                        $feed = array(
                            'status' => 'info',
                            'message_type' => 'Comment',
                            'user_id' => $this->user->user_id,
                            'feed_content' => 'Please review '.$appraisee->fullname.'\'s performance appraisal.',
                            'uri' => $this->mod->route . '/review_admin/'.$_POST['appraisal_id'].'/'.$_POST['user_id'],
                            'recipient_id' => $approver->approver_id
                        );

                        $recipients = array($approver->approver_id);
                        $this->system_feed->add( $feed, $recipients );

                        // email to approver for approval
                        $this->db->where('user_id',$approver->approver_id);
                        $approver_result = $this->db->get('users');
                        $approver_info = $approver_result->row();

                        $approver_recepient = $approver->approver_id;
                        $sendtargetsettings['approver'] = $approver_info->full_name;

                        $sendtargetsettings['appraisee'] = $appraisee->fullname;

                        $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-APPRAISAL-SEND-APPROVER') )->row_array();
                        $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                        $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approver_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        // email to approver for approval

                        $this->response->notify[] = $approver->approver_id;
                    }
                }   

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_appraisal_applicable', $previous_main_data, $update);

                $this->response->redirect = get_mod_route('appraisal_individual_rate');                

                break;
            case 4:
                $update['coach_rating'] = $this->input->post('coach_rating');
                //bring it up
                foreach(  $approvers as $index => $approver )
                {
                    if( $approver->approver_id == $this->user->user_id ){
                        $update_data = array('performance_status_id' => 4,'remarks' => $this->input->post('approver_remarks'),'approved_date' => date('Y-m-d H:i:s'));
                        $where_array = array('id' => $approver->id);
                        //get previous data for audit logs
                        $previous_main_data = $this->db->get_where('performance_appraisal_approver', $where_array)->row_array();
                        $this->db->update('performance_appraisal_approver', $update_data, $where_array);

                        if( ($index+1) == $no_approvers ){
                            $update['to_user_id'] = $this->input->post('user_id');

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Your performance appraisal have been approved.',
                                'uri' => $this->mod->route . '/review/'.$_POST['appraisal_id'].'/'.$_POST['user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];

                            // email to appraisee
                            $this->db->where('user_id',$this->input->post('user_id'));
                            $appraisee_result = $this->db->get('users');
                            $appraisee_info = $appraisee_result->row();

                            $appraisee_recepient = $this->input->post('user_id');
                            $sendtargetsettings['recepient'] = $appraisee_info->full_name;

                            $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-APPRAISAL-SEND-APPROVED') )->row_array();
                            $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                            $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                            $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                     VALUES('{$appraisee_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                            // email to approver for approval                            
                        }
                        else{
                            $up = $approvers[$index+1];
                            $update['to_user_id'] = $up->approver_id;

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Please review '.$appraisee->fullname.'\'s performance appraisal.',
                                'uri' => $this->mod->route . '/review_admin/'.$_POST['planning_id'].'/'.$_POST['user_id'].'/'.$update['to_user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];

                            $update_data = array('performance_status_id' => 2);
                            $where_array = array('id' => $up->id);
                            //get previous data for audit logs
                            $previous_main_data = $this->db->get_where('performance_appraisal_approver', $where_array)->row_array();

                            $this->db->update('performance_appraisal_approver', $update_data, $where_array);

                            // email to approver for approval
                            $this->db->where('user_id',$up->approver_id);
                            $approver_result = $this->db->get('users');
                            $approver_info = $approver_result->row();

                            $approver_recepient = $approver->approver_id;
                            $sendtargetsettings['approver'] = $approver_info->full_name;

                            $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-APPRAISAL-SEND-APPROVER') )->row_array();
                            $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                            $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                            $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                     VALUES('{$approver_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                            // email to approver for approval                            
                        }

                        //create system logs
                        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_approver', $previous_main_data, $update_data);                                            
                    }
                }  

                //get approvers
                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'appraisee_id' => $appraisee->user_id
                );
                $this->db->order_by('sequence');

                $approvers = $this->db->get_where('performance_appraisal_approver', $where)->result();

                switch ($condition) {
                    case 'ALL':
                    case 'By Level':
                        $all_approved = true;
                        foreach( $approvers as $approver )
                        {
                            if($approver->performance_status_id != 4)
                            {
                                $all_approved = false;
                                break;
                            }
                        }
                        if($all_approved)
                        { 
                            $status_id = 14;
                        }
                        else{
                            $status_id = 2;
                        }
                        break;
                    
                        # code...
                        break;
                    case 'Either Of':
                        $one_approved = false;
                        foreach( $approvers as $approver )
                        {
                            if($approver->performance_status_id == 4)
                            {
                                $one_approved = true;
                                break;
                            }
                        }
                        if($one_approved)
                        {
                            $status_id = 14;
                        }
                        break;
                }

                $update['status_id'] = $status_id;

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id'),
                );
                
                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_appraisal_applicable', $where)->row_array();

                $this->db->update('performance_appraisal_applicable', $update, $where);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);

                //saving strength and improvement
                $strength = $this->input->post('strength');
                $improvement = $this->input->post('improvement');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                    'created_by' => $this->user->user_id,
                );
                
                $this->db->where($where);
                $this->db->delete('performance_appraisal_applicable_strength_improvement');

                foreach ($strength as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 1);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');                        
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }

                foreach ($improvement as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 2);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }
                //saving strength and improvement

                $this->response->redirect = get_mod_route('performance_appraisal_manage');
                break;
            case 99: // for approver save as draft
                $update['status_id'] = 2; // since status 99 is temporary and fix, it will assign back to the original status for approval which is 2   
                $update['coach_rating'] = $this->input->post('coach_rating');
                
                $this->db->update('performance_appraisal_applicable', $update, $where);

                $update_data = array('remarks' => $this->input->post('approver_remarks'));
                $where_array = array('appraisal_id' => $this->input->post('appraisal_id'),'appraisee_id' => $appraisee->user_id,'approver_id' => $this->user->user_id);
                
                $this->db->update('performance_appraisal_approver', $update_data, $where_array);

                //saving strength and improvement
                $strength = $this->input->post('strength');
                $improvement = $this->input->post('improvement');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                    'created_by' => $this->user->user_id,
                );
                
                $this->db->where($where);
                $this->db->delete('performance_appraisal_applicable_strength_improvement');
                
                foreach ($strength as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 1);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');                     
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }

                foreach ($improvement as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 2);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');                          
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }
                //saving strength and improvement

                $this->response->redirect = get_mod_route('performance_appraisal_manage');
                break;
            case 14:
                $update['status_id'] = 4;
                $update['committee_rating'] = $this->input->post('committee_rating');
                
                $this->db->update('performance_appraisal_applicable', $update, $where);

                $this->response->redirect = get_mod_route('performance_appraisal_manage');
                break;
        }

        if (in_array($this->input->post('status_id'), array(1,2,4,99))) {
            $field = $_POST['field_appraisal'];

            // if the login user is the second approver then use the first approver user id to delete the records.
/*            if ($status_id == 4 || $status_id == 99)
                $this->db->where('rate_user_id',$fst_approver->approver_id); // for rater
            else
                $this->db->where('rate_user_id',$this->user->user_id); // for ratee

            $this->db->where('user_id',$this->input->post('user_id'));
            $this->db->where('appraisal_id',$this->input->post('record_id'));
            $this->db->delete('performance_appraisal_applicable_fields');*/

            foreach ($field as $user_id => $info) {
                foreach ($info as $section_id => $section) {                                       
                    foreach ($section as $scorecard_or_library_id => $criteria) {
                        foreach ($criteria as $section_column_or_library_value_id => $item) {
                            foreach ($item as $key => $value) {
                                $item_info = array(
                                        'appraisal_id' => $this->input->post('record_id'),
                                        'user_id' => $this->input->post('user_id'),
                                        'template_section_id' => $section_id,                                    
                                        'criteria_id' => $scorecard_or_library_id,
                                        'item_id' => $section_column_or_library_value_id,
                                        'value' => $value,
                                        'sequence' => $key + 1
                                    );

                                $where = array(
                                        'appraisal_id' => $this->input->post('record_id'),
                                        'user_id' => $this->input->post('user_id'),
                                        'template_section_id' => $section_id,                                    
                                        'criteria_id' => $scorecard_or_library_id,
                                        'item_id' => $section_column_or_library_value_id,
                                        'sequence' => $key + 1
                                    );

                                if ($status_id == 4 || $status_id == 99)
                                    $item_info['rate_user_id'] = $fst_approver->approver_id; // for rater
                                else
                                    $item_info['rate_user_id'] = $this->user->user_id; // for ratee

                                if ($status_id == 4 || $status_id == 99)
                                    $where['rate_user_id'] = $fst_approver->approver_id; // for rater
                                else
                                    $where['rate_user_id'] = $this->user->user_id; // for ratee

                                $this->db->where($where);
                                $result = $this->db->get('performance_appraisal_applicable_fields');
                                if ($result && $result->num_rows() > 0) {
                                    $previous_main_data = $result->row_array();

                                    if ($previous_main_data['value'] !== $value) {
                                        $this->db->where('appraisal_id',$this->input->post('record_id'));
                                        $this->db->where('user_id',$this->input->post('user_id'));
                                        $this->db->where('approver_id',$this->user->user_id);
                                        $this->db->update('performance_appraisal_approver',array('edited' => 1));

                                        $item_info['edited'] = 1;
                                    }

                                    $this->db->where($where);
                                    $this->db->update('performance_appraisal_applicable_fields',$item_info);

                                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_appraisal_applicable_fields', $previous_main_data, $item_info);                                    
                                } else {
                                    $this->db->insert('performance_appraisal_applicable_fields',$item_info);

                                    $item_id = $this->db->insert_id();

                                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_appraisal_applicable_fields', array(), $item_info);
                                }
                            }
                        }
                    }
                }
            }
        }

        // saving of section ratings
        if ($status_id != 14) { // not committee rating
            $section_key_weight = $_POST['section_key_weight'];
            $section_self_rating = $_POST['section_self_rating'];
            $section_coach_rating = $_POST['section_coach_rating'];
            $section_total_weight_ave = $_POST['section_total_weight_ave'];
            $section_coach_section_rating = $_POST['section_coach_section_rating'];
            $section_weight = $_POST['section_weight'];
            $section_total_weighted_score = $_POST['section_total_weighted_score'];
            $section_coach_total_weighted_score = $_POST['section_coach_total_weighted_score'];

            $this->db->where('user_id',$this->input->post('user_id'));
            $this->db->where('appraisal_id',$this->input->post('record_id'));
            $this->db->delete('performance_appraisal_applicable_section_ratings');

            $section_rating_info = array();
            foreach ($section_weight as $template_section_id => $value) {
                foreach ($value as $key => $val) {
                    $section_rating_info = array(
                                                    'appraisal_id' => $this->input->post('record_id'),
                                                    'template_section_id' => $template_section_id,
                                                    'user_id' => $this->input->post('user_id'),
                                                    'key_weight' => $section_key_weight[$template_section_id][$key],
                                                    'self_rating' => $section_self_rating[$template_section_id][$key],
                                                    'coach_rating' => $section_coach_rating[$template_section_id][$key],
                                                    'total_weight_average' => $section_total_weight_ave[$template_section_id][$key],
                                                    'coach_section_rating' => $section_coach_section_rating[$template_section_id][$key],
                                                    'weight' => $val,
                                                    'total_weighted_score' => $section_total_weighted_score[$template_section_id][$key],
                                                    'coach_total_weighted_score' => $section_coach_total_weighted_score[$template_section_id][$key]
                                                );
                    $this->db->insert('performance_appraisal_applicable_section_ratings',$section_rating_info);
                }
            }
            // saving of section ratings

            // saving of score or library ratings
            $none_core_score_car_library_key_weight = $_POST['none_core_score_car_library_key_weight'];
            $none_core_score_car_library_self_rating = $_POST['none_core_score_car_library_self_rating'];
            $none_core_score_car_library_coach_rating = $_POST['none_core_score_car_library_coach_rating'];
            $none_core_score_car_library_total_weight_ave = $_POST['none_core_score_car_library_total_weight_ave'];
            $none_core_score_car_library_section_rating = $_POST['none_core_score_car_library_section_rating'];
            $none_core_score_car_library_weight = $_POST['none_core_score_car_library_weight'];
            $none_core_score_car_library_total_weighted_score = $_POST['none_core_score_car_library_total_weighted_score'];
            $none_core_score_car_library_coach_total_weighted_score = $_POST['none_core_score_car_library_coach_total_weighted_score'];

            $this->db->where('user_id',$this->input->post('user_id'));
            $this->db->where('appraisal_id',$this->input->post('record_id'));
            $this->db->delete('performance_appraisal_applicable_score_library_ratings');

            $score_library_rating_info = array();
            foreach ($none_core_score_car_library_self_rating as $template_section_id => $template_section) {
                foreach ($template_section as $score_library_value_id => $value) {
                    foreach ($value as $key => $val) {
                        $score_library_rating_info = array(
                                                        'appraisal_id' => $this->input->post('record_id'),
                                                        'template_section_id' => $template_section_id,
                                                        'score_library_id' => $score_library_value_id,
                                                        'user_id' => $this->input->post('user_id'),
                                                        'key_weight' => $none_core_score_car_library_key_weight[$template_section_id][$score_library_value_id][$key],
                                                        'self_rating' => $val,
                                                        'coach_rating' => $none_core_score_car_library_coach_rating[$template_section_id][$score_library_value_id][$key],
                                                        'total_weight_average' => $none_core_score_car_library_total_weight_ave[$template_section_id][$score_library_value_id][$key],
                                                        'coach_section_rating' => $none_core_score_car_library_section_rating[$template_section_id][$score_library_value_id][$key],
                                                        'weight' => $none_core_score_car_library_weight[$template_section_id][$score_library_value_id][$key],
                                                        'total_weighted_score' => $none_core_score_car_library_total_weighted_score[$template_section_id][$score_library_value_id][$key],
                                                        'coach_total_weighted_score' => $none_core_score_car_library_coach_total_weighted_score[$template_section_id][$score_library_value_id][$key]
                                                    );

                        $this->db->insert('performance_appraisal_applicable_score_library_ratings',$score_library_rating_info);
                    }
                }
            }

            $core_score_car_library_key_weight = $_POST['core_score_car_library_key_weight'];
            $core_score_car_library_self_rating = $_POST['core_score_car_library_self_rating'];
            $core_score_car_library_coach_rating = $_POST['core_score_car_library_coach_rating'];
            $core_score_car_library_total_weight_ave = $_POST['core_score_car_library_total_weight_ave'];
            $core_score_car_library_section_rating = $_POST['core_score_car_library_section_rating'];
            $core_score_car_library_weight = $_POST['core_score_car_library_weight'];
            $core_score_car_library_total_weighted_score = $_POST['core_score_car_library_total_weighted_score'];
            $core_score_car_library_coach_total_weighted_score = $_POST['core_score_car_library_coach_total_weighted_score'];        

            $score_library_rating_info = array();
            foreach ($core_score_car_library_self_rating as $template_section_id => $template_section) {
                foreach ($template_section as $score_library_value_id => $value) {
                    foreach ($value as $key => $val) {
                        $score_library_rating_info = array(
                                                        'appraisal_id' => $this->input->post('record_id'),
                                                        'template_section_id' => $template_section_id,
                                                        'score_library_id' => $score_library_value_id,
                                                        'user_id' => $this->input->post('user_id'),
                                                        'key_weight' => $core_score_car_library_key_weight[$template_section_id][$score_library_value_id][$key],
                                                        'self_rating' => $val,
                                                        'coach_rating' => $core_score_car_library_coach_rating[$template_section_id][$score_library_value_id][$key],
                                                        'total_weight_average' => $core_score_car_library_total_weight_ave[$template_section_id][$score_library_value_id][$key],
                                                        'coach_section_rating' => $core_score_car_library_section_rating[$template_section_id][$score_library_value_id][$key],
                                                        'weight' => $core_score_car_library_weight[$template_section_id][$score_library_value_id][$key],
                                                        'total_weighted_score' => $core_score_car_library_total_weighted_score[$template_section_id][$score_library_value_id][$key],
                                                        'coach_total_weighted_score' => $core_score_car_library_coach_total_weighted_score[$template_section_id][$score_library_value_id][$key]
                                                    );

                        $this->db->insert('performance_appraisal_applicable_score_library_ratings',$score_library_rating_info);
                    }
                }
            }    
        }    
        // saving of score or library ratings

        if( $this->db->_error_message() != "" )
        {
            $this->response->message[] = array(
                'message' => $this->db->_error_message(),
                'type' => 'error'
            );
            $error = true;
            goto stop;
        }

        stop:
        if( !$error ){
            $this->db->trans_commit();
        }
        else{
             $this->db->trans_rollback();
             $this->response->redirect = false;
        }

        if( $return )
        {
            return !$error;
        }

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function change_status_admin( $return = false )
    {
        $this->load->model('system_feed');        
        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');  

        $this->_ajax_only();
        
        $this->db->trans_begin();
        $error = false;

        $appraisee = $this->mod->get_appraisee( $_POST['appraisal_id'], $_POST['user_id'] );      
        $status_id = $this->input->post('status_id');
        
        //get approvers
        $where = array(
            'appraisal_id' => $this->input->post('appraisal_id'),
            'user_id' => $this->input->post('user_id'),
        );
        $this->db->order_by('sequence');
        $approvers = $this->db->get_where('performance_appraisal_approver', $where)->result();
        $no_approvers = sizeof($approvers);

        $condition = $approvers[0]->condition;
        $fst_approver = $approvers[0];

        $appraisal_other_info = isset($_POST['individual_appraisal']) ? $_POST['individual_appraisal'] : array();

        $this->response->redirect = false;

        $update['status_id'] = $status_id;

        switch( $status_id ) {
            case 2://for approval
                $update['to_user_id'] = $fst_approver->approver_id;

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_appraisal_applicable', $where)->row_array();

                $this->db->update('performance_appraisal_applicable', $update, $where);

                //reset status of approver to new since back to employee for review
                $this->db->where('appraisal_id',$this->input->post('appraisal_id'));
                $this->db->where('user_id',$this->input->post('user_id'));
                $this->db->update('performance_appraisal_approver',array('performance_status_id' => 0));

                foreach(  $approvers  as $index => $approver )
                {
                    if( $index == 0 )
                    {
                        $this->db->update('performance_appraisal_approver', array('performance_status_id' => 2), array('id' => $approver->id));

                        $feed = array(
                            'status' => 'info',
                            'message_type' => 'Comment',
                            'user_id' => $this->user->user_id,
                            'feed_content' => 'Please review '.$appraisee->fullname.'\'s performance targets.',
                            'uri' => $this->mod->route . '/review_admin/'.$_POST['appraisal_id'].'/'.$_POST['user_id'],
                            'recipient_id' => $approver->approver_id
                        );

                        $recipients = array($approver->approver_id);
                        $this->system_feed->add( $feed, $recipients );

                        // email to approver for approval
                        $this->db->where('user_id',$approver->approver_id);
                        $approver_result = $this->db->get('users');
                        $approver_info = $approver_result->row();

                        $approver_recepient = $approver->approver_id;
                        $sendtargetsettings['approver'] = $approver_info->full_name;

                        $sendtargetsettings['appraisee'] = $appraisee->fullname;

                        $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-APPRAISAL-SEND-APPROVER') )->row_array();
                        $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                        $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approver_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        // email to approver for approval

                        $this->response->notify[] = $approver->approver_id;
                    }
                }   

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_appraisal_applicable', $previous_main_data, $update);

                $this->response->redirect = get_mod_route('performance_appraisal');                

                break;
            case 4:
                $update['committee_rating'] = $this->input->post('committee_rating');

                $feed = array(
                    'status' => 'info',
                    'message_type' => 'Comment',
                    'user_id' => $this->user->user_id,
                    'feed_content' => 'Your performance appraisal have been inputted committee rate.',
                    'uri' => $this->mod->route . '/review/'.$this->input->post('appraisal_id').'/'.$this->input->post('user_id'),
                    'recipient_id' => $this->input->post('user_id')
                );

                $recipients = array($this->input->post('user_id'));
                $this->system_feed->add( $feed, $recipients );

                $this->response->notify[] = $this->input->post('user_id');

                // hr admin info
                $this->db->where('users.user_id',$this->user->user_id);
                $this->db->join('users_profile','users.user_id = users_profile.user_id','left');
                $hr_admin_result = $this->db->get('users');
                $hr_admin_info = $hr_admin_result->row();

                // email to appraisee
                $this->db->where('users.user_id',$this->input->post('user_id'));
                $this->db->join('users_profile','users.user_id = users_profile.user_id','left');
                $appraisee_result = $this->db->get('users');
                $appraisee_info = $appraisee_result->row();

                $appraisee_recepient = $this->input->post('user_id');
                $sendtargetsettings['recepient'] = $appraisee_info->full_name;
                $sendtargetsettings['hradmin'] = $hr_admin_info->full_name;

                $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-APPRAISAL-SEND-COMMITTEE') )->row_array();
                $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                         VALUES('{$appraisee_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                // email to approver for approval    

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id'),
                );
                
                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_appraisal_applicable', $where)->row_array();

                $this->db->update('performance_appraisal_applicable', $update, $where);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);

                //saving strength and improvement
                $strength = $this->input->post('strength');
                $improvement = $this->input->post('improvement');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                );
                
                $this->db->where($where);
                $this->db->delete('performance_appraisal_applicable_strength_improvement');

                foreach ($strength as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 1);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');                        
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }

                foreach ($improvement as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 2);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }
                //saving strength and improvement

                $this->response->redirect = get_mod_route('performance_appraisal');
                break;
            case 14:
                $update['committee_rating'] = $this->input->post('committee_rating');
                
                $this->db->update('performance_appraisal_applicable', $update, $where);

                //saving strength and improvement
                $strength = $this->input->post('strength');
                $improvement = $this->input->post('improvement');

                $where = array(
                    'appraisal_id' => $this->input->post('appraisal_id'),
                    'user_id' => $this->input->post('user_id'),
                );
                
                $this->db->where($where);
                $this->db->delete('performance_appraisal_applicable_strength_improvement');

                foreach ($strength as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 1);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');                        
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }

                foreach ($improvement as $key => $value) {
                    $update_strength = array('comment' => $value,'comment_type' => 2);
                    $update_strength['appraisal_id'] = $this->input->post('appraisal_id');
                    $update_strength['user_id'] = $this->input->post('user_id');
                    $update_strength['created_by'] = $this->user->user_id;
                    $this->db->insert('performance_appraisal_applicable_strength_improvement',$update_strength);
                }
                //saving strength and improvement

                $this->response->redirect = get_mod_route('performance_appraisal');
                break;
        }

        if (in_array($status_id, array(2,4,14))) {
            $field = $_POST['field_appraisal'];

            foreach ($field as $user_id => $info) {
                foreach ($info as $section_id => $section) {                                       
                    foreach ($section as $scorecard_or_library_id => $criteria) {
                        foreach ($criteria as $section_column_or_library_value_id => $item) {
                            foreach ($item as $key => $value) {
                                $item_info = array(
                                        'appraisal_id' => $this->input->post('record_id'),
                                        'user_id' => $this->input->post('user_id'),
                                        'rate_user_id' => $user_id,
                                        'template_section_id' => $section_id,                                    
                                        'criteria_id' => $scorecard_or_library_id,
                                        'item_id' => $section_column_or_library_value_id,
                                        'value' => $value,
                                        'sequence' => $key + 1
                                    );

                                $where = array(
                                        'appraisal_id' => $this->input->post('record_id'),
                                        'user_id' => $this->input->post('user_id'),
                                        'rate_user_id' => $user_id,
                                        'template_section_id' => $section_id,                                    
                                        'criteria_id' => $scorecard_or_library_id,
                                        'item_id' => $section_column_or_library_value_id,
                                        'sequence' => $key + 1
                                    );

                                $this->db->where($where);
                                $result = $this->db->get('performance_appraisal_applicable_fields');
                                if ($result && $result->num_rows() > 0) {
                                    $previous_main_data = $result->row_array();

                                    if ($previous_main_data['value'] !== $value) {
                                        $item_info['edited_hr_admin'] = 1;
                                    }

                                    $this->db->where($where);
                                    $this->db->update('performance_appraisal_applicable_fields',$item_info);

                                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_appraisal_applicable_fields', $previous_main_data, $item_info);                                    
                                } else {
                                    $this->db->insert('performance_appraisal_applicable_fields',$item_info);

                                    $item_id = $this->db->insert_id();

                                    $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_appraisal_applicable_fields', '', $value);
                                }
                            }
                        }
                    }
                }
            }
        }

        // saving of section ratings
        $section_key_weight = $_POST['section_key_weight'];
        $section_self_rating = $_POST['section_self_rating'];
        $section_coach_rating = $_POST['section_coach_rating'];
        $section_total_weight_ave = $_POST['section_total_weight_ave'];
        $section_coach_section_rating = $_POST['section_coach_section_rating'];
        $section_weight = $_POST['section_weight'];
        $section_total_weighted_score = $_POST['section_total_weighted_score'];
        $section_coach_total_weighted_score = $_POST['section_coach_total_weighted_score'];

        $this->db->where('user_id',$this->input->post('user_id'));
        $this->db->where('appraisal_id',$this->input->post('record_id'));
        $this->db->delete('performance_appraisal_applicable_section_ratings');

        $section_rating_info = array();
        foreach ($section_weight as $template_section_id => $value) {
            foreach ($value as $key => $val) {
                $section_rating_info = array(
                                                'appraisal_id' => $this->input->post('record_id'),
                                                'template_section_id' => $template_section_id,
                                                'user_id' => $this->input->post('user_id'),
                                                'key_weight' => $section_key_weight[$template_section_id][$key],
                                                'self_rating' => $section_self_rating[$template_section_id][$key],
                                                'coach_rating' => $section_coach_rating[$template_section_id][$key],
                                                'total_weight_average' => $section_total_weight_ave[$template_section_id][$key],
                                                'coach_section_rating' => $section_coach_section_rating[$template_section_id][$key],
                                                'weight' => $val,
                                                'total_weighted_score' => $section_total_weighted_score[$template_section_id][$key],
                                                'coach_total_weighted_score' => $section_coach_total_weighted_score[$template_section_id][$key]
                                            );
                $this->db->insert('performance_appraisal_applicable_section_ratings',$section_rating_info);
            }
        }
        // saving of section ratings

        // saving of score or library ratings
        $none_core_score_car_library_key_weight = $_POST['none_core_score_car_library_key_weight'];
        $none_core_score_car_library_self_rating = $_POST['none_core_score_car_library_self_rating'];
        $none_core_score_car_library_coach_rating = $_POST['none_core_score_car_library_coach_rating'];
        $none_core_score_car_library_total_weight_ave = $_POST['none_core_score_car_library_total_weight_ave'];
        $none_core_score_car_library_section_rating = $_POST['none_core_score_car_library_section_rating'];
        $none_core_score_car_library_weight = $_POST['none_core_score_car_library_weight'];
        $none_core_score_car_library_total_weighted_score = $_POST['none_core_score_car_library_total_weighted_score'];
        $none_core_score_car_library_coach_total_weighted_score = $_POST['none_core_score_car_library_coach_total_weighted_score'];

        $this->db->where('user_id',$this->input->post('user_id'));
        $this->db->where('appraisal_id',$this->input->post('record_id'));
        $this->db->delete('performance_appraisal_applicable_score_library_ratings');

        $score_library_rating_info = array();
        foreach ($none_core_score_car_library_self_rating as $template_section_id => $template_section) {
            foreach ($template_section as $score_library_value_id => $value) {
                foreach ($value as $key => $val) {
                    $score_library_rating_info = array(
                                                    'appraisal_id' => $this->input->post('record_id'),
                                                    'template_section_id' => $template_section_id,
                                                    'score_library_id' => $score_library_value_id,
                                                    'user_id' => $this->input->post('user_id'),
                                                    'key_weight' => $none_core_score_car_library_key_weight[$template_section_id][$score_library_value_id][$key],
                                                    'self_rating' => $val,
                                                    'coach_rating' => $none_core_score_car_library_coach_rating[$template_section_id][$score_library_value_id][$key],
                                                    'total_weight_average' => $none_core_score_car_library_total_weight_ave[$template_section_id][$score_library_value_id][$key],
                                                    'coach_section_rating' => $none_core_score_car_library_section_rating[$template_section_id][$score_library_value_id][$key],
                                                    'weight' => $none_core_score_car_library_weight[$template_section_id][$score_library_value_id][$key],
                                                    'total_weighted_score' => $none_core_score_car_library_total_weighted_score[$template_section_id][$score_library_value_id][$key],
                                                    'coach_total_weighted_score' => $none_core_score_car_library_coach_total_weighted_score[$template_section_id][$score_library_value_id][$key]
                                                );

                    $this->db->insert('performance_appraisal_applicable_score_library_ratings',$score_library_rating_info);
                }
            }
        }

        $core_score_car_library_key_weight = $_POST['core_score_car_library_key_weight'];
        $core_score_car_library_self_rating = $_POST['core_score_car_library_self_rating'];
        $core_score_car_library_coach_rating = $_POST['core_score_car_library_coach_rating'];
        $core_score_car_library_total_weight_ave = $_POST['core_score_car_library_total_weight_ave'];
        $core_score_car_library_section_rating = $_POST['core_score_car_library_section_rating'];
        $core_score_car_library_weight = $_POST['core_score_car_library_weight'];
        $core_score_car_library_total_weighted_score = $_POST['core_score_car_library_total_weighted_score'];
        $core_score_car_library_coach_total_weighted_score = $_POST['core_score_car_library_coach_total_weighted_score'];        

        $score_library_rating_info = array();
        foreach ($core_score_car_library_self_rating as $template_section_id => $template_section) {
            foreach ($template_section as $score_library_value_id => $value) {
                foreach ($value as $key => $val) {
                    $score_library_rating_info = array(
                                                    'appraisal_id' => $this->input->post('record_id'),
                                                    'template_section_id' => $template_section_id,
                                                    'score_library_id' => $score_library_value_id,
                                                    'user_id' => $this->input->post('user_id'),
                                                    'key_weight' => $core_score_car_library_key_weight[$template_section_id][$score_library_value_id][$key],
                                                    'self_rating' => $val,
                                                    'coach_rating' => $core_score_car_library_coach_rating[$template_section_id][$score_library_value_id][$key],
                                                    'total_weight_average' => $core_score_car_library_total_weight_ave[$template_section_id][$score_library_value_id][$key],
                                                    'coach_section_rating' => $core_score_car_library_section_rating[$template_section_id][$score_library_value_id][$key],
                                                    'weight' => $core_score_car_library_weight[$template_section_id][$score_library_value_id][$key],
                                                    'total_weighted_score' => $core_score_car_library_total_weighted_score[$template_section_id][$score_library_value_id][$key],
                                                    'coach_total_weighted_score' => $core_score_car_library_coach_total_weighted_score[$template_section_id][$score_library_value_id][$key]
                                                );

                    $this->db->insert('performance_appraisal_applicable_score_library_ratings',$score_library_rating_info);
                }
            }
        }    
        // saving of score or library ratings

        if( $this->db->_error_message() != "" )
        {
            $this->response->message[] = array(
                'message' => $this->db->_error_message(),
                'type' => 'error'
            );
            $error = true;
            goto stop;
        }

        stop:
        if( !$error ){
            $this->db->trans_commit();
        }
        else{
             $this->db->trans_rollback();
             $this->response->redirect = false;
        }

        if( $return )
        {
            return !$error;
        }

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function review( $record_id, $user_id )
    {
        parent::edit('', true);

        $vars['manager_id'] ='';
        $this->load->model('performance_appraisal_manage_model', 'pam');
        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $first_approver = $this->mod->get_list_approver( $this->record_id, $user_id, 1);

        $login_user_id = $first_approver->row()->approver_id;

        $vars['list_approver'] = $approver_info = $this->mod->get_approver( $this->record_id, $user_id, $login_user_id);

        $vars['approver_info'] = array();
        if ($approver_info) {
            $approver_info_arr = $approver_info->row_array();
            $vars['approver_info'] = $approver_info_arr;
        }

        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['planning_admin'] = 0;
        $vars['readonly'] = '';
        $vars['committee_rater'] = 0;
        $vars['approver_info'] = array();

        $vars['hr_appraisal_admin'] = 0;

        if( !in_array($appraisee->status_id,array(0,1,6)) ) {
            $vars['readonly'] = "readonly='readonly'";
            $vars['planning_admin'] = 1;
        }

        $vars['self_rating'] = 0;
        if ($appraisee->user_id == $this->user->user_id)
            $vars['self_rating'] = 1;

        $vars['self_review'] = $this->pam->get_self_review( $this->record_id, $user_id );

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template; 
        $vars['templatefile'] = $this->template->get_template( $appraisee->template_id ); 

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name, ppar.remarks as approver_remarks, 
                        ppl.created_on, ppar.approved_date, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id, ppar.edited 
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";
                        
        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $vars['transaction_type'] = '';
        $vars['appraisal_id'] = $this->record_id;
        $vars['balance_score_card'] = $this->individual_planning_model->get_balance_score_card();
        $vars['template_section_column'] = $this->individual_planning_model->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->individual_planning_model->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['appraisal_applicable_fields'] = $this->mod->get_appraisal_applicable_fields($this->record_id,$appraisee->user_id);
        $vars['template_section'] = $this->individual_planning_model->get_template_section($appraisee->template_id);
        $vars['library_competencies'] = $this->individual_planning_model->get_library_competencies();
        $vars['appraisal_applicable_section_ratings'] = $this->mod->get_appraisal_applicable_section_ratings($this->record_id,$appraisee->user_id);
        $vars['appraisal_applicable_score_library_ratings'] = $this->mod->get_appraisal_applicable_score_library_ratings($this->record_id,$appraisee->user_id);
        $vars['readonly'] = '';
        $vars['login_user_id'] = $login_user_id;
        $vars['areas_development'] = $this->individual_planning_model->get_areas_for_development();
        $vars['learning_mode'] = $this->individual_planning_model->get_learning_mode();
        $vars['competencies'] = $this->individual_planning_model->get_competencies();
        $vars['target_completion'] = $this->individual_planning_model->get_target_completion();
        $vars['strength_improvement'] = $this->mod->get_strength_improvement( $this->record_id, $user_id );

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.summary')->with( $this->load->get_cached_vars() );          
    }

    function review_admin( $record_id, $user_id )
    {
        parent::edit('', true);

        $settings_config = $this->config->item('other_settings');

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $first_approver = $this->mod->get_list_approver( $this->record_id, $user_id, 1);

        $login_user_id = $first_approver->row()->approver_id;

        $vars['hr_appraisal_admin'] = 0;
        // for oclp it was specific approver only, if hr appraisal admin then get first approver since it was specific
        if ($this->permission['process']) {
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $this->record_id, $user_id, $login_user_id);
            $vars['hr_appraisal_admin'] = 1;
        } else
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $this->record_id, $user_id, $this->user->user_id);

        $vars['approver_info'] = array();
        if ($approver_info) {
            $approver_info_arr = $approver_info->row_array();
            $vars['approver_info'] = $approver_info_arr;
        }

        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['appraisal_admin'] = 0;
        $vars['readonly'] = '';
        $vars['committee_rater'] = 0;

        if( !$vars['list_approver'] ) {
            $vars['appraisal_admin'] = 1;
            $vars['readonly'] = "readonly='readonly'";
        }
        else {
            $vars['readonly'] = "readonly='readonly'";                                            
            if (isset($settings_config['appraisal_committee_rating']) && $settings_config['appraisal_committee_rating'] == $this->user->user_id) {
                if (in_array($appraisee->performance_status_id,array(14))) {
                    $vars['appraisal_admin'] = 1;
                    $vars['committee_rater'] = 1;
                }
            }
        }

        $vars['self_rating'] = 0;
        if ($appraisee->user_id == $this->user->user_id)
            $vars['self_rating'] = 1;

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template; 
        $vars['templatefile'] = $this->template->get_template( $appraisee->template_id ); 

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name, ppar.remarks as approver_remarks, 
                        ppl.created_on, ppar.approved_date, ppap.user_id, ppar.performance_status_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id, ppar.edited  
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";
                        
        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $vars['approver_approved'] = 0;
        foreach ($vars['approversLog'] as $key => $value) {
            if ($value['approver_id'] == $this->user->user_id && $value['performance_status_id'] == 4)
                $vars['approver_approved'] = 1;
        }

        $vars['transaction_type'] = '';
        $vars['appraisal_id'] = $this->record_id;
        $vars['balance_score_card'] = $this->individual_planning_model->get_balance_score_card();
        $vars['template_section_column'] = $this->individual_planning_model->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->individual_planning_model->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['appraisal_applicable_fields'] = $this->mod->get_appraisal_applicable_fields($this->record_id,$appraisee->user_id);
        $vars['template_section'] = $this->individual_planning_model->get_template_section($appraisee->template_id);
        $vars['library_competencies'] = $this->individual_planning_model->get_library_competencies();
        $vars['appraisal_applicable_section_ratings'] = $this->mod->get_appraisal_applicable_section_ratings($this->record_id,$appraisee->user_id);
        $vars['appraisal_applicable_score_library_ratings'] = $this->mod->get_appraisal_applicable_score_library_ratings($this->record_id,$appraisee->user_id);
        $vars['readonly'] = '';
        $vars['login_user_id'] = $login_user_id;
        $vars['areas_development'] = $this->individual_planning_model->get_areas_for_development();
        $vars['learning_mode'] = $this->individual_planning_model->get_learning_mode();
        $vars['competencies'] = $this->individual_planning_model->get_competencies();
        $vars['target_completion'] = $this->individual_planning_model->get_target_completion();
        $vars['strength_improvement'] = $this->mod->get_strength_improvement( $this->record_id, $user_id );

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.summary')->with( $this->load->get_cached_vars() );          
    }

    function edit_admin( $record_id, $user_id )
    {
        parent::edit('', true);

        $settings_config = $this->config->item('other_settings');

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $first_approver = $this->mod->get_list_approver( $this->record_id, $user_id, 1);

        $login_user_id = $first_approver->row()->approver_id;

        $vars['hr_appraisal_admin'] = 0;
        // for oclp it was specific approver only, if hr appraisal admin then get first approver since it was specific
        if ($this->permission['process']) {
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $this->record_id, $user_id, $login_user_id);
            $vars['hr_appraisal_admin'] = 1;
        } else
            $vars['list_approver'] = $approver_info = $this->mod->get_approver( $this->record_id, $user_id, $this->user->user_id);

        $vars['approver_info'] = array();
        if ($approver_info) {
            $approver_info_arr = $approver_info->row_array();
            $vars['approver_info'] = $approver_info_arr;
        }

        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['appraisal_admin'] = 0;
        $vars['readonly'] = '';
        $vars['committee_rater'] = 0;

        if( !$vars['list_approver'] ) {
            $vars['appraisal_admin'] = 1;
            $vars['readonly'] = "readonly='readonly'";
        }
        else {
            /*$vars['readonly'] = "readonly='readonly'";*/                                            
            if (isset($settings_config['appraisal_committee_rating']) && $settings_config['appraisal_committee_rating'] == $this->user->user_id) {
                if (in_array($appraisee->performance_status_id,array(14))) {
                    $vars['appraisal_admin'] = 1;
                    $vars['committee_rater'] = 1;
                }
            }
        }

        if (($vars['hr_appraisal_admin'] || $vars['appraisal_admin']) && $appraisee->performance_status_id == 2)
            $vars['readonly'] = "readonly='readonly'";

        $vars['self_rating'] = 0;
        if ($appraisee->user_id == $this->user->user_id)
            $vars['self_rating'] = 1;

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template; 
        $vars['templatefile'] = $this->template->get_template( $appraisee->template_id ); 

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name, ppar.remarks as approver_remarks, 
                        ppl.created_on, ppar.approved_date, ppap.user_id, ppar.performance_status_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id, ppar.edited  
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";
                        
        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $vars['approver_approved'] = 0;
        foreach ($vars['approversLog'] as $key => $value) {
            if ($value['approver_id'] == $this->user->user_id && $value['performance_status_id'] == 4)
                $vars['approver_approved'] = 1;
        }

        $vars['transaction_type'] = '';
        $vars['appraisal_id'] = $this->record_id;
        $vars['balance_score_card'] = $this->individual_planning_model->get_balance_score_card();
        $vars['template_section_column'] = $this->individual_planning_model->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->individual_planning_model->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['appraisal_applicable_fields'] = $this->mod->get_appraisal_applicable_fields($this->record_id,$appraisee->user_id);
        $vars['template_section'] = $this->individual_planning_model->get_template_section($appraisee->template_id);
        $vars['library_competencies'] = $this->individual_planning_model->get_library_competencies();
        $vars['appraisal_applicable_section_ratings'] = $this->mod->get_appraisal_applicable_section_ratings($this->record_id,$appraisee->user_id);
        $vars['appraisal_applicable_score_library_ratings'] = $this->mod->get_appraisal_applicable_score_library_ratings($this->record_id,$appraisee->user_id);
        $vars['login_user_id'] = $login_user_id;
        $vars['areas_development'] = $this->individual_planning_model->get_areas_for_development();
        $vars['learning_mode'] = $this->individual_planning_model->get_learning_mode();
        $vars['competencies'] = $this->individual_planning_model->get_competencies();
        $vars['target_completion'] = $this->individual_planning_model->get_target_completion();
        $vars['strength_improvement'] = $this->mod->get_strength_improvement( $this->record_id, $user_id );

        $vars['status'] = $this->db->get_where('performance_status', array('deleted' => 0,'appraisal' => 1))->result();

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.edit_admin')->with( $this->load->get_cached_vars() );          
    }

    function crowdsource( $record_id, $user_id )
    {
        parent::edit('', true);

        $this->load->model('performance_appraisal_manage_model', 'pam');
        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );
        $vars['self_review'] = $this->pam->get_self_review( $this->record_id, $user_id );

        if( $vars['appraisee']->user_id != $this->user->user_id && $vars['appraisee']->status_id != 6 )
        {
            echo $this->load->blade('pages.not_under_attention')->with( $this->load->get_cached_vars() );
            die();
        }

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->template_id ); 

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name, 
                        ppl.created_on, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id  
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppl.id ";
        
        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.crowdsource')->with( $this->load->get_cached_vars() );          
    }

    function get_section_item_summary()
    {
        $this->_ajax_only();
        
        $appraisee = $this->mod->get_appraisee( $this->input->post('appraisal_id'), $this->input->post('user_id') );
        $this->db->limit(1);
        $section = $this->db->get_where('performance_template_section', array('template_section_id' => $_POST['section_id']))->row();
        $this->load->vars( array('section' => $section) );

        $_POST['applicable_status_id'] = $appraisee->status_id;

        switch( $appraisee->status_id )
        {
            case 8:
                $folder = "crowdsource";
                break;
            default:
                $folder = "summary";
        }

        switch($section->section_type_id)
        {
            case 2:
                $this->response->items = $this->load->view($folder . '/section_items', $_POST, true);
                break;
            case 3:
                $this->response->items = $this->load->view($folder . '/items_library', $_POST, true);
                break;
            case 4:
                $this->response->items = $this->load->view($folder . '/items_library_crowd', $_POST, true);
                break;
            case 5:
                $this->response->items = $this->load->view($folder.'/personal_development_plan', $_POST, true);                                          
        }   

        $this->response->section_id = $_POST['section_id'];
        $this->response->section_type = $section->section_type_id;
        $this->response->close_modal = true;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }

    function contributor_form()
    {
        $this->_ajax_only();

        //check for current
        $current = $this->db->get_where('performance_appraisal_contributor', $_POST);
        $contributor = array();
        $approved = array();
        if($current->num_rows() > 0)
        {
            foreach( $current->result() aS $cont )
            {
                $contributor[] = $cont->contributor_id;
                
                if($cont->status_id != 0)
                    $approved[] = $cont->contributor_id;
            }

           
        }
        else{
            //get from draft
            $this->db->limit(1);
            $appraisal = $this->db->get_where('performance_appraisal', array('appraisal_id' => $_POST['appraisal_id']))->row();
            $this->db->limit(1);
            $planning = $this->db->get_where('performance_planning', array('planning_id' => $appraisal->planning_id))->row();
            $this->db->limit(1);
            $planning_user = $this->db->get_where('performance_planning_crowdsource', array('planning_id' => $appraisal->planning_id, 'user_id' => $_POST['user_id'], 'section_id' => $_POST['template_section_id']))->row();

            $contributor = isset( $planning_user->crowdsource_user_id ) && !empty($planning_user->crowdsource_user_id) ? explode(',', $planning_user->crowdsource_user_id) : array();
        }

        $vars = array(
            'post' => $_POST,
            'contributor' => $contributor,
            'approved_con' => $approved
        );
        
        $data['title'] = 'Add/Edit Section';
        $data['content'] = $this->load->view('edit/contributor_form', $vars, true);

        $this->response->contributor_form = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }

    public function tag_user(){

        $this->_ajax_only();

        $data = array();
        $this->load->model('dashboard_model');
        $data = $this->dashboard_model->getUsersTagList();

        header('Content-type: application/json');
        echo json_encode($data);
        die();
    }

    function add_contributors()
    {
        $this->_ajax_only();
        $this->response->close_modal = false;

        $appraisee = $this->mod->get_appraisee(  $_POST['appraisal_id'], $_POST['user_id'] );
        $section = $this->db->get_where('performance_template_section', array('template_section_id' => $_POST['template_section_id']))->row();

        $contributors = $this->input->post('contributors');
        $contributors = explode(',', $contributors);
        
        $delete_contri = array();
        $select_delete = array(
            'appraisal_id' => $_POST['appraisal_id'],
            'user_id' => $_POST['user_id'],
            'template_section_id' => $_POST['template_section_id']
        );
        $delete_crowd = $this->db->get_where('performance_appraisal_contributor', $select_delete);
        if($delete_crowd->num_rows() > 0){
            $delete_crowd = $delete_crowd->result_array();
            foreach( $delete_crowd as $contrib_id )
            {
                if( !in_array($contrib_id['contributor_id'], $contributors) ){

                    $where = array(
                        'appraisal_id' => $_POST['appraisal_id'],
                        'user_id' => $_POST['user_id'],
                        'template_section_id' => $_POST['template_section_id'],
                        'contributor_id' => $contrib_id['contributor_id']
                    );
                    $this->db->delete('performance_appraisal_contributor', $where);
                }
            }

        }

        $users_info = $this->db->get_where('users_profile', array('user_id' => $_POST['user_id']) )->row_array();
        if( in_array($users_info['reports_to_id'], $contributors) ){
            $this->response->message[] = array(
                'message' => 'You cannot choose your immediate superior as your crowdsource.',
                'type' => 'warning'
            );
            $this->_ajax_return();  
        }
        $template_info = $this->db->get_where('performance_template', array('template_id' => $section->template_id))->row();
        if($template_info->max_crowdsource > 0){
            foreach ($contributors as $key => $value) {
                $crowdsource_count = "SELECT * FROM {$this->db->dbprefix}performance_appraisal_contributor
                                    WHERE appraisal_id = {$appraisee->appraisal_id} AND template_section_id = {$this->input->post('template_section_id')} 
                                    AND contributor_id = $value
                                    GROUP BY user_id";
                $crowd_count = $this->db->query($crowdsource_count);
                if($crowd_count->num_rows() >= $template_info->max_crowdsource){
                    $crowd_info = $this->db->get_where('users', array('user_id' => $value) )->row_array();
                    $this->response->message[] = array(
                        'message' => $crowd_info['full_name']." has already reached {$template_info->max_crowdsource} crowdourced feedback requests. 
                                            Kindly choose another employee as your crowdsource.",
                        'type' => 'warning'
                    );
                    $this->_ajax_return();  
                }
            }
        }
        //check for current contributors 
        $where = array(
            'appraisal_id' => $this->input->post('appraisal_id'),
            'user_id' => $this->input->post('user_id'),
            'template_section_id' => $this->input->post('template_section_id'),
        );
        $current = $this->db->get_where('performance_appraisal_contributor', $where);
        foreach($current->result() as $cs)
        {
            if( !in_array($cs->contributor_id, $contributors) )
                $contributors[] = $cs->contributor_id;
        }

        if( !empty($section->min_crowdsource) && sizeof($contributors) < $section->min_crowdsource )
        {
            $this->response->message[] = array(
                'message' => 'A minimum of '. $section->min_crowdsource .' crowdsource is needed for this section.',
                'type' => 'warning'
            );
            $this->_ajax_return();
        }

        if( sizeof($contributors) > 5 )
        {
            $this->response->message[] = array(
                'message' => 'Number of contributors exceeded allowed.',
                'type' => 'warning'
            );
            $this->_ajax_return();
        }

        foreach( $contributors as $contributor_id )
        {
            $insert = array(
                'appraisal_id' => $_POST['appraisal_id'],
                'user_id' => $_POST['user_id'],
                'template_section_id' => $_POST['template_section_id'],
                'contributor_id' => $contributor_id
            );

            $this->db->limit(1);
            $check = $this->db->get_where('performance_appraisal_contributor', $insert);
            if( $check->num_rows() == 0 )
            {
                $this->db->insert('performance_appraisal_contributor', $insert); 
            }
        }

        $this->response->close_modal = true;
        $this->response->section_id = $_POST['template_section_id'];

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function remove_contributor()
    {
        $this->_ajax_only();

        $this->db->delete('performance_appraisal_contributor', $_POST);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();   
    }

    function cs_discussion()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
        $vars['discussions'] = $this->mod->get_cs_discussion($_POST['appraisal_id'],$_POST['section_id'], $_POST['user_id'], $_POST['contributor_id']);
        $contributor = array();

        $contributor = $this->db->get_where('users', array('user_id' => $_POST['user_id']))->row_array();

        $appraisal_get_approvers = $this->db->query("CALL sp_performance_appraisal_get_approvers(".$_POST['appraisal_id'].", ".$_POST['user_id'].")")->result_array();
        mysqli_next_result($this->db->conn_id);

        $back_to = 0;
        $vars['sent_to'] = '';
        foreach ($appraisal_get_approvers as $approver){
            if($_POST['user_id'] == $this->user->user_id){
                if($approver['sequence'] == 1){
                    $user_details = $this->db->get_where('users_profile', array('user_id' => $approver['approver_id']))->row_array();
                    $vars['sent_to'] = $user_details['firstname'].' '.$user_details['lastname'];
                    $vars['approver_id'] = $approver['approver_id'];
                }
            }else{
                if($approver['approver_id'] == $this->user->user_id){
                    if($approver['sequence'] >= 1 ){ // change == 1 to >= 1 for oclp
                        $user_details = $this->db->get_where('users_profile', array('user_id' => $_POST['user_id']))->row_array();
                        
                        $vars['sent_to'] = $user_details['firstname'].' '.$user_details['lastname'];
                    }else{
                        $back_to = --$approver['sequence'];
                    }
                    $vars['approver_id'] = $approver['approver_id'];
                }   
            }
        }

        if($back_to > 0){
            foreach ($appraisal_get_approvers as $approver){
                if($approver['sequence'] == $back_to){
                    $user_details = $this->db->get_where('users_profile', array('user_id' => $approver['approver_id']))->row_array();
                    $vars['sent_to'] = $user_details['firstname'].' '.$user_details['lastname'];
                    $vars['approver_id'] = $approver['approver_id'];
                }
            }
        }

        if ($this->user->user_id == $this->input->post('user_id'))
            $vars['approver_id'] = 0;

        $data['title'] = $contributor['full_name'] . '<br><span class="text-muted">Discussion Logs</span>';
        $vars['contributor'] = $contributor;       
        $this->load->vars($vars);
        $data['content'] = $this->load->blade('crowdsource.discussion_form')->with( $this->load->get_cached_vars() );

        $this->response->notes = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function sendback_cs()
    {
        $this->_ajax_only();

        $appraisee = $this->mod->get_appraisee( $this->input->post('appraisal_id'), $this->input->post('user_id') );
        
        $insert = $_POST;
        if(trim($insert['note'])){
        $this->db->insert('performance_appraisal_contributor_notes', $insert);
        }
        
        if( $this->input->post('note_to') != '' )
        {
            $where = array(
                'appraisal_id' => $this->input->post('appraisal_id'),
                'user_id' => $this->input->post('user_id')
            );
            $this->db->update('performance_appraisal_applicable', array('cs_status' => 2), $where);

            $where = array(
                'appraisal_id' => $this->input->post('appraisal_id'),
                'user_id' => $this->input->post('user_id'),
                'contributor_id' => $this->input->post('note_to')
            );
            $this->db->update('performance_appraisal_contributor', array('status_id' => 3), $where);

            //notify contributor
            $this->load->model('system_feed');
            $feed = array(
                'status' => 'info',
                'message_type' => 'Comment',
                'user_id' => $this->user->user_id,
                'feed_content' => 'There was a remark regarding your crowdsource feedback for '.$appraisee->fullname.'\'s, kindly check.',
                'uri' => get_mod_route('performance_appraisal_contributor', '', false) . '/edit/'.$_POST['appraisal_id'].'/'.$_POST['user_id'].'/'.$_POST['note_to'],
                'recipient_id' => $_POST['note_to']
            );

            $recipients = array($_POST['note_to']);
            $this->system_feed->add( $feed, $recipients );

            $this->response->notify[] = $_POST['note_to'];  
            $this->response->redirect = true;
        }
        else{
            $this->response->redirect = false;
        }

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        

        $this->_ajax_return();     
    }

    function save_crowd_message()
    {
        $this->_ajax_only();

        $appraisee = $this->mod->get_appraisee( $this->input->post('appraisal_id'), $this->input->post('user_id') );
        
        $insert = $_POST;
        $insert['created_by'] = $this->user->user_id;
        $insert['created_on'] = date('Y-m-d H:i:s');
        $this->db->insert('performance_appraisal_contributor_notes', $insert);
        
        // $this->db->insert('performance_planning_notes', $insert);
          // GET LATEST POSTED DATA AND RETURN IT BACK TO THE UI
        $new_notes_qry = " SELECT ud.department, CONCAT(up.lastname, ', ', up.firstname) as full_name, 
                    gettimeline('{$insert['created_on']}') as timeline, {$insert['created_by']} as created_by,
                    '{$insert['note']}' as notes, {$insert['user_id']} as user_id, IF(up.photo != '',up.photo,'uploads/users/avatar.png') as photo
                    FROM {$this->db->dbprefix}users_profile up
                    LEFT JOIN {$this->db->dbprefix}users_department ud on ud.department_id = up.department_id 
                    WHERE up.user_id = {$this->user->user_id}";
                    
        $data['note'] = $this->db->query($new_notes_qry)->row_array();

        $this->response->new_discussion   = $this->load->view('customs/new_comment', $data, true);
        $this->response->redirect = false;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        

        $this->_ajax_return();     
    }

    function view_discussion()
    {
        $this->_ajax_only();
        
        $this->load->model('appraisal_individual_planning_model', 'ig_mod');
        $vars = $_POST;
        $vars['notes'] = $this->ig_mod->get_notes($_POST['planning_id'], $_POST['user_id']);

        $this->load->vars($vars);

        $data['title'] = 'Discussion Logs';
        $data['content'] = $this->load->blade('edit.discussion_logs')->with( $this->load->get_cached_vars() );

        $this->response->notes = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    public function submitDiscussion(){

        $this->_ajax_only();
        $data = array();

        $insert = array(
            'planning_id' => $this->input->post('planning_id'),
            'user_id' => $this->input->post('user_id'),
            'notes' => $this->input->post('discussion_notes'),
            'created_by' => $this->user->user_id,
            'created_on' => date('Y-m-d H:i:s')
        );

        $this->db->insert('performance_planning_notes', $insert);
          // GET LATEST POSTED DATA AND RETURN IT BACK TO THE UI
        $new_notes_qry = " SELECT ud.department, CONCAT(up.lastname, ', ', up.firstname) as full_name, 
                    gettimeline('{$insert['created_on']}') as timeline, {$insert['created_by']} as created_by,
                    '{$insert['notes']}' as notes, {$insert['user_id']} as user_id, up.photo
                    FROM {$this->db->dbprefix}users_profile up
                    LEFT JOIN {$this->db->dbprefix}users_department ud on ud.department_id = up.department_id 
                    WHERE up.user_id = {$this->user->user_id}";
                    
        $data['note'] = $this->db->query($new_notes_qry)->row_array();

        $this->response->new_discussion   = $this->load->view('customs/new_discussion', $data, true);

        $this->response->message[] = array(
            'message' => 'Discussion successfully added.',
            'type' => 'success'
        );


        $this->_ajax_return();  
    }

    function view_transaction_logs()
    {
        $this->_ajax_only();

        $approvers_list = array();
        $approvers = "SELECT IF(ppa.display_name='', CONCAT(up.lastname,', ',up.firstname), ppa.display_name) as display_name, upos.position FROM {$this->db->dbprefix}performance_appraisal_approver  ppa 
                        INNER JOIN {$this->db->dbprefix}users_profile up 
                        ON ppa.approver_id = up.user_id 
                        INNER JOIN {$this->db->dbprefix}users_position upos 
                        ON up.position_id = upos.position_id
                        INNER JOIN {$this->db->dbprefix}users u
                        ON u.user_id = up.user_id  
                        WHERE ppa.appraisal_id = {$_POST['appraisal_id']} AND u.active = 1 AND ppa.user_id = {$_POST['user_id']}
                    ";
        $app_sql = $this->db->query($approvers);
        if($app_sql->num_rows() > 0){
            $approvers_list = $app_sql->result_array();
        }

        $logs_list = array();
        $logs = "SELECT CONCAT(up.firstname,' ',up.lastname) as partner_name, upos.position, 
                        ppa.created_on, performance_status, pstat.class 
                        FROM {$this->db->dbprefix}performance_appraisal_logs  ppa 
                        INNER JOIN {$this->db->dbprefix}users_profile up 
                        ON ppa.to_user_id = up.user_id
                        INNER JOIN {$this->db->dbprefix}users_position upos 
                        ON up.position_id = upos.position_id 
                        INNER JOIN ww_performance_status pstat 
                        ON ppa.status_id = pstat.performance_status_id 
                        WHERE ppa.appraisal_id = {$_POST['appraisal_id']} AND ppa.user_id = {$_POST['user_id']}
                    ";
        $log_sql = $this->db->query($logs);
        if($log_sql->num_rows() > 0){
            $logs_list = $log_sql->result_array();
        }

        $vars['approvers_list'] = $approvers_list;
        $vars['logs_list'] = $logs_list;

        // $this->load->vars( $vars );
        $this->load->helper('form');
        $this->load->helper('file');
        // // $data['title'] = 'Add/Edit Column Item';
        // $data['content'] = $this->load->blade('edit.view_logs')->with( $this->load->get_cached_vars() );

        // $this->response->redeem_form = $this->load->view('form/redeem', $data, true);

        $this->response->trans_logs = $this->load->view('edit/view_logs', $vars, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function print_appraisal()
    {
        parent::edit('', true);

        $record_id = $this->input->post('record_id');
        $user_id = $this->input->post('user_id');

        $this->_ajax_only();
        $user = $this->config->item('user');

        $this->load->library('PDFm');
        $mpdf = new PDFm();

        //$mpdf = new PDFm(['debug' => true]);

        //$mpdf->showImageErrors = true
        
        $mpdf->SetTitle( 'Performance Appraisal' );
        $mpdf->SetAutoPageBreak(true, 5);
        $mpdf->SetAuthor( $user['lastname'] .', '. $user['firstname'] . ' ' .$user['middlename'] );  
        $mpdf->SetDisplayMode('real', 'default');
        $mpdf->AddPage();

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $record_id, $user_id );

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
        $vars['strength_improvement'] = $this->mod->get_strength_improvement( $this->record_id, $user_id );

        $vars['approversLog'] = array();
        $approvers_log = "SELECT IF(ppar.display_name='', CONCAT(usp.lastname,' ',usp.firstname), ppar.display_name) AS display_name, ppar.remarks as approver_remarks, 
                        ppl.created_on, ppar.approved_date, ppap.user_id, ppar.performance_status_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id, ppar.edited  
                        FROM {$this->db->dbprefix}performance_appraisal_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_appraisal_approver ppar ON ppap.appraisal_id = ppar.appraisal_id 
                        AND ppap.user_id = ppar.user_id
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        LEFT JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_appraisal_logs ppl ON ppap.appraisal_id = ppl.appraisal_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.appraisal_id = {$appraisee->appraisal_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";
                        
        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }
        
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