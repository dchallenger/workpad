<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Appraisal_individual_planning extends MY_PrivateController
{
	public function __construct()
	{
        $this->load->model('my_calendar_model', 'my_calendar');        
		$this->load->model('appraisal_individual_planning_model', 'mod');
		parent::__construct();
        $this->lang->load('appraisal_individual_planning');

        $this->config_permission = $this->config->item('permission');        
	}

    public function index()
    {
        $vars['performance_planning_manage'] = isset($this->config_permission['performance_planning_manage']) ? $this->config_permission['performance_planning_manage'] : 0;
        $vars['performance_planning'] = isset($this->config_permission['performance_planning']) ? $this->config_permission['performance_planning'] : 0;
        $this->load->vars($vars);
        parent::index();
    }
    
    // $child_call = $user_id - change to fit with parent class my controller
	public function edit( $record_id = "", $child_call = false )
    {
        parent::edit('', true);
        $this->after_edit_parent( $child_call );
    }

    public function review( $record_id, $user_id, $manager_id = '' )
    {
        parent::edit('', true);

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $vars['planning_admin'] = 0;
        $vars['readonly'] = '';
        $vars['disabled'] = '';

        if( !in_array($appraisee->status_id,array(0,1,6)) ) {
            $vars['readonly'] = "readonly='readonly'";
            $vars['planning_admin'] = 1;
            $vars['disabled'] = 'disabled';
        }

        if ($appraisee->planning_status_id == 0) {
            $vars['readonly'] = "readonly='readonly'";
            $vars['disabled'] = 'disabled';            
        }

        $vars['manager_id'] = $manager_id; 

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->applicable_template_id );

        $vars['approversLog'] = array();
        $approvers_log = "SELECT ppar.display_name, ppl.created_on, ppar.approved_date, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id, ppar.edited
                        FROM {$this->db->dbprefix}performance_planning_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_planning_approver ppar ON ppap.planning_id = ppar.planning_id 
                        AND ppap.user_id = ppar.appraisee_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_planning_logs ppl ON ppap.planning_id = ppl.planning_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id
                        WHERE ppap.planning_id = {$appraisee->planning_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";

        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $this->db->where('approver_id',$this->user->user_id);
        $this->db->where('performance_status_id',2);
        $this->db->order_by('sequence');
        $this->db->limit(1);
        $approver = $this->db->get('performance_planning_approver');
        if ($approver && $approver->num_rows() > 0){
            $approver_info = $approver->row();
            $vars['approver'] = $approver_info;
        }

        $vars['planning_id'] = $appraisee->planning_id;
        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['template_section'] = $this->mod->get_template_section($appraisee->applicable_template_id);
        $vars['library_competencies'] = $this->mod->get_library_competencies();
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['areas_development'] = $this->mod->get_areas_for_development();
        $vars['learning_mode'] = $this->mod->get_learning_mode();
        $vars['competencies'] = $this->mod->get_competencies();
        $vars['target_completion'] = $this->mod->get_target_completion();
        $vars['template_id'] = $appraisee->applicable_template_id;

        $this->load->vars( $vars );
        
        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.review')->with( $this->load->get_cached_vars() );  
    }

    public function after_edit_parent( $user_id )
    {
    	$appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );
    	
        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;
        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->applicable_template_id ); 
        
        $vars['approversLog'] = array();
        $approvers_log = "SELECT ppar.display_name, ppl.created_on, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id  
                        FROM {$this->db->dbprefix}performance_planning_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_planning_approver ppar ON ppap.planning_id = ppar.planning_id 
                        AND ppap.user_id = ppar.appraisee_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_planning_logs ppl ON ppap.planning_id = ppl.planning_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.planning_id = {$appraisee->planning_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppl.id ";

        $approversLog = $this->db->query($approvers_log);
        if( $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $vars['transaction_type'] = 'edit';
        $vars['planning_id'] = $this->record_id;
        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['employee_appraisal_planning'] = $this->mod->get_employee_appraisal_planning($user_id,$this->record_id);
        $vars['template_section'] = $this->mod->get_template_section($appraisee->applicable_template_id);
        $vars['library_competencies'] = $this->mod->get_library_competencies();
        $vars['readonly'] = '';
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['financial_metric_title'] = $this->mod->get_financial_metric_title();
        $vars['areas_development'] = $this->mod->get_areas_for_development();
        $vars['learning_mode'] = $this->mod->get_learning_mode();
        $vars['competencies'] = $this->mod->get_competencies();
        $vars['target_completion'] = $this->mod->get_target_completion();
        $vars['template_id'] = $appraisee->applicable_template_id;

        $this->load->vars( $vars );

    	$this->load->helper('form');
		$this->load->helper('file');
		
        if( $vars['appraisee']->status_id == 4 || $vars['appraisee']->user_id != $this->user->user_id )
        {
            echo $this->load->blade('pages.review')->with( $this->load->get_cached_vars() );
        }
        else{
            echo $this->load->blade('pages.edit')->with( $this->load->get_cached_vars() );
        }
    }

    public function populate_appraisal_planning()
    {
        $planning_id = $this->input->post('planning_id');
        $user_id = $this->input->post('appraisee_user_id');

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $planning_id, $user_id );
        
        if ($appraisee->performance_status_id <> 4) {
            $this->response->message[] = array(
                'message' => 'Performance Planning does not exists.',
                'type' => 'warning'
            );            

            $this->_ajax_return();  
        }

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['section_id'] = $this->input->post('section_id');

        $this->response->items = $this->load->view('edit/sections/populate_balance_scorecard', $vars, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  

    }

    public function populate_financial_metric()
    {
        $financial_metric_ids = $this->input->post('financial_metric_ids');

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $vars['balance_score_card'] = $this->mod->get_balance_score_card(1)->row_array();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['financial_metric_details'] = $this->mod->get_financial_metric_details($financial_metric_ids);
        $vars['section_id'] = $this->input->post('section_id');

        $this->response->items = $this->load->view('edit/sections/populate_financial_metrics', $vars, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  

    }

    function get_item_form()
    {
        $this->_ajax_only();

        $this->db->limit(1);
        $column = $this->db->get_where('performance_template_section_column', array('section_column_id' => $_POST['section_column_id']))->row();
        $where = array(
            'planning_id' => $_POST['planning_id'],
            'user_id' => $_POST['user_id'],
        );

        if( !empty( $_POST['parent_id'] ) )
        {
            $where['parent_id'] = $_POST['parent_id'];
        }
        else{
            $where['section_column_id'] = $_POST['section_column_id'];
        }
        
        $items = $this->db->get_where('performance_planning_applicable_items', $where)->num_rows();
        if( !empty($column->max_items) && $items >= $column->max_items )
        {
            $this->response->message[] = array(
                'message' => lang('appraisal_individual_planning.max_items_reached'),
                'type' => 'warning'
            );
            $this->_ajax_return();   
        }

        $vars = $_POST;
        $vars['sequence'] = '';
        $vars['item'] = '';

        if( !empty( $vars['item_id'] ) )
        {
            $this->db->limit(1);
            $vars = $this->db->get_where('performance_planning_applicable_items', array('item_id' => $vars['item_id']))->row_array();
        }

        $this->load->vars( $vars );

        $this->load->helper('form');
        $data['title'] = 'Add/Edit Column Item';
        $data['content'] = $this->load->blade('edit.item_form')->with( $this->load->get_cached_vars() );

        $this->response->item_form = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function save_item()
    {
        $this->_ajax_only();

        $this->load->library('form_validation');

        $this->db->limit(1);
        $column = $this->db->get_where('performance_template_section_column', array('section_column_id' => $_POST['section_column_id']))->row();
        $where = array(
            'planning_id' => $_POST['planning_id'],
            'user_id' => $_POST['user_id'],
        );
        
        if( !empty( $_POST['parent_id'] ) )
        {
            $where['parent_id'] = $_POST['parent_id'];
        }
        else{
            $where['section_column_id'] = $_POST['section_column_id'];
        }

        $items = $this->db->get_where('performance_planning_applicable_items', $where)->num_rows();
        if( !empty($column->max_items) && $items >= $column->max_items )
        {
            $this->response->message[] = array(
                'message' => lang('appraisal_individual_planning.max_items_reached'),
                'type' => 'warning'
            );
            $this->_ajax_return();   
        }

        $config = array(
            array(
                'field'   => 'item',
                'label'   => 'Item',
                'rules'   => 'required'
            )
        );

        $this->response->show_add_row = ($items+1) == $column->max_items ? false : true;
        $this->response->section_column_id = $_POST['section_column_id'];

        $this->form_validation->set_rules($config); 

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

        $item_id = $this->input->post('item_id');
        unset( $_POST['item_id'] );
        $previous_main_data = array();
        if( empty( $item_id )  )
        {
            $this->db->insert('performance_planning_applicable_items', $_POST);
            $action = 'insert';
        }
        else{
        //get previous data for audit logs
            $previous_main_data = $this->db->get_where('performance_planning_applicable_items', array('item_id' => $item_id))->row_array();
            $this->db->update('performance_planning_applicable_items', $_POST, array('item_id' => $item_id));
            $action = 'update';
        }
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'performance_planning_applicable_items', $previous_main_data, $_POST);

        $this->response->close_modal = true;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();   
    }

    function get_items()
    {
        $this->_ajax_only();

        $column_id = $this->input->post('column_id');
        $column = $this->db->get_where('performance_template_section_column', array('section_column_id' => $column_id))->row();
        $_POST['section_id'] = $column->template_section_id;
        $this->get_section_items();
        $this->_ajax_return();   
    }

    function get_section_items()
    {
        $this->_ajax_only();
        
        $appraisee = $this->mod->get_appraisee( $this->input->post('planning_id'), $this->input->post('user_id') );
        $section = $this->db->get_where('performance_template_section', array('template_section_id' => $_POST['section_id']))->row();

        $_POST['status_id'] = $appraisee->status_id; 
        $_POST['to_user_id'] = $appraisee->to_user_id;
        switch($section->section_type_id)
        {
            case 2:
                if ($this->input->post('item_id') == 1){
                    $items_form = 'section_items_new';
                }
                else{
                    $items_form = 'section_items';
                }
                break;
            case 4:
                $items_form = 'items_library_crowd';
                break;
            case 5:
                $items_form = 'personal_development_plan';
                break;                
        }

        switch(true)
        {
            case $appraisee->user_id != $this->user->user_id && $appraisee->status_id == 1:
                $this->response->items = $this->load->view('edit/'.$items_form, $_POST, true);
            break;
            case $appraisee->user_id == $this->user->user_id && $appraisee->status_id == 4:
            case $appraisee->user_id == $this->user->user_id && ($appraisee->status_id == 6 || $appraisee->status_id == 1):
            case $appraisee->user_id != $this->user->user_id && ($appraisee->status_id == 11 || $appraisee->status_id == 2 || $appraisee->status_id == 4):
                $this->response->items = $this->load->view('review/'.$items_form, $_POST, true);
                break;
            default:
                $this->response->items = $this->load->view('edit/'.$items_form, $_POST, true);
        }
        
        $this->response->section_id = $_POST['section_id'];
        $this->response->close_modal = true;

        $vars = $this->load->get_cached_vars();
        if(isset( $vars['show_add_row'] ))
        {
            $this->response->show_add_row = true; 
            $this->response->section_column_id = $vars['show_add_row']['section_column_id'];  
        }
        else{
            $this->response->show_add_row = false;
        }

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }

    function get_section_items_new()
    {
        $this->_ajax_only();
        
        $this->response->items = $this->load->view('edit/section_items_new', $_POST, true);

        $this->response->section_id = $_POST['section_id'];
        $this->response->close_modal = true;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }

    function delete_item()
    {
        $this->_ajax_only();
        
        $this->db->delete('performance_planning_applicable_items', array('item_id' => $this->input->post('item_id')));
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', 'performance_planning_applicable_items - item_id', array(), array('item_id' => $this->input->post('item_id')));
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    private function _change_status_partner()
    {
        // check approver
        $approver_list = $this->my_calendar->call_sp_approvers('PPA', $this->user->user_id);
        if (empty($approver_list) && $this->user->user_id != 374) {
            $this->response->message[] = array(
                'message' => 'Please contact HR Admin. Approver has not been set.',
                'type' => 'error'
            );
            $this->_ajax_return();            
        }
                            
        $this->load->model('system_feed');        

        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');      

        $appraisee = $this->mod->get_appraisee(  $_POST['planning_id'], $_POST['user_id'] );

        $this->response->redirect = $this->mod->url;

        $planning_other_info = isset($_POST['individual_planning']) ? $_POST['individual_planning'] : array();
        
        //get approvers
        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'appraisee_id' => $appraisee->user_id
        );
        $this->db->order_by('sequence');

        $approvers = $this->db->get_where('performance_planning_approver', $where)->result();
        $no_approvers = sizeof($approvers);

        $condition = $approvers[0]->condition;
        $fst_approver = $approvers[0];

        $this->db->trans_begin();
        $status_id = $this->input->post('status_id');

        $update['status_id'] = $status_id;        

        switch( $status_id ) {
            case 1://draft
                $where = array(
                    'planning_id' => $this->input->post('planning_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id'),
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();

                $this->db->update('performance_planning_applicable', $update, $where);

                $this->response->redirect = get_mod_route('appraisal_individual_planning');                

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);
                break;
            case 2: //for immediate supervisors review.
                $where = array(
                    'planning_id' => $this->input->post('planning_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id')
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();

                $this->db->update('performance_planning_applicable', $update, $where);                

                foreach(  $approvers  as $index => $approver )
                {
                    if( $index == 0 )
                    {
                        $this->db->update('performance_planning_approver', array('performance_status_id' => 2), array('id' => $approver->id));                        

                        $feed = array(
                            'status' => 'info',
                            'message_type' => 'Comment',
                            'user_id' => $this->user->user_id,
                            'feed_content' => 'Please review '.$appraisee->fullname.'\'s performance planning.',
                            'uri' => $this->mod->route . '/review_admin/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                            'recipient_id' => $approver->approver_id
                        );

                        $recipients = array($approver->approver_id);
                        $this->system_feed->add( $feed, $recipients );

                        // email to approver for approval
                        $this->db->where('user_id',$approver->approver_id);
                        $approver_result = $this->db->get('users');
                        $approver_info = $approver_result->row();

                        $approver_recepient = $approver_info->email;
                        $sendtargetsettings['approver'] = $approver_info->full_name;

                        $sendtargetsettings['appraisee'] = $appraisee->fullname;

                        $logo  = ''; 
                        if ($this->config->item('system')['print_logo'] != ''){
                            if( file_exists( $this->config->item('system')['print_logo'] ) ){
                                $logo = base_url().$this->config->item('system')['print_logo'];
                            }
                        } else {
                            if ($appraisee->print_logo != ''){
                                if( file_exists( $appraisee->print_logo ) ){
                                    $logo = base_url().$appraisee->print_logo;
                                }
                            }
                        }

                        $sendtargetsettings['system_logo'] = $logo;                           

                        $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-APPROVER') )->row_array();
                        $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                        $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approver_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        // email to approver for approval

                        $this->response->notify[] = $approver->approver_id;
                    }
                }      

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);

                $this->response->redirect = get_mod_route('appraisal_individual_planning'); 
                break;    
            case 4:
                //bring it up
                foreach(  $approvers as $index => $approver )
                {
                    if( $approver->approver_id == $this->user->user_id ){
                        $update_data = array('performance_status_id' => 4,'approved_date' => date('Y-m-d H:i:s'));
                        $where_array = array('id' => $approver->id);
                        //get previous data for audit logs
                        $previous_main_data = $this->db->get_where('performance_planning_approver', $where_array)->row_array();
                        $this->db->update('performance_planning_approver', $update_data, $where_array);

                        if( ($index+1) == $no_approvers ){
                            $update['to_user_id'] = $this->input->post('user_id');

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Your performance planning have been approved.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];

                            // email to appraisee
                            $this->db->where('user_id',$this->input->post('user_id'));
                            $appraisee_result = $this->db->get('users');
                            $appraisee_info = $appraisee_result->row();

                            $appraisee_recepient = $appraisee_info->email;
                            $sendtargetsettings['recepient'] = $appraisee_info->full_name;

                            $logo  = ''; 
                            if ($this->config->item('system')['print_logo'] != ''){
                                if( file_exists( $this->config->item('system')['print_logo'] ) ){
                                    $logo = base_url().$this->config->item('system')['print_logo'];
                                }
                            } else {
                                if ($appraisee->print_logo != ''){
                                    if( file_exists( $appraisee->print_logo ) ){
                                        $logo = base_url().$appraisee->print_logo;
                                    }
                                }
                            }
                    
                            $sendtargetsettings['system_logo'] = $logo; 

                            $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-APPROVED') )->row_array();
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
                                'feed_content' => 'Please review performance planning.',
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

                            $this->db->update('performance_planning_approver', $update_data, $where_array);

                            // email to approver for approval
                            $this->db->where('user_id',$up->approver_id);
                            $approver_result = $this->db->get('users');
                            $approver_info = $approver_result->row();

                            $approver_recepient = $approver_info->email;
                            $sendtargetsettings['approver'] = $approver_info->full_name;
                            
                            $sendtargetsettings['appraisee'] = $appraisee->full_name;

                            $logo  = ''; 
                            if ($this->config->item('system')['print_logo'] != ''){
                                if( file_exists( $this->config->item('system')['print_logo'] ) ){
                                    $logo = base_url().$this->config->item('system')['print_logo'];
                                }
                            } else {
                                if ($appraisee->print_logo != ''){
                                    if( file_exists( $appraisee->print_logo ) ){
                                        $logo = base_url().$appraisee->print_logo;
                                    }
                                }
                            }
                    
                            $sendtargetsettings['system_logo'] = $logo; 

                            $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-APPROVER') )->row_array();
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
                    'planning_id' => $this->input->post('planning_id'),
                    'appraisee_id' => $appraisee->user_id
                );
                $this->db->order_by('sequence');

                $approvers = $this->db->get_where('performance_planning_approver', $where)->result();

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
                            $status_id = 4;
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
                            $status_id = 4;
                        }
                        break;
                }

                $update['status_id'] = $status_id;    

                $where = array(
                    'planning_id' => $this->input->post('planning_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id'),
                );
                
                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();

                $this->db->update('performance_planning_applicable', $update, $where);

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);

                $this->response->redirect = get_mod_route('performance_planning_manage');
                break;                             
            case 6: //for employees review and acceptance
                $where = array(
                    'planning_id' => $this->input->post('planning_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id')
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();

                // set to_user_id to first approver
                $update['to_user_id'] = $appraisee->user_id;//$fst_approver->approver_id;
                $this->db->update('performance_planning_applicable', $update, $where);                

                //reset status of approver to new since back to employee for review
                $this->db->where('planning_id',$this->input->post('planning_id'));
                $this->db->where('user_id',$this->input->post('user_id'));
                $this->db->update('performance_planning_approver',array('performance_status_id' => 0));

                if ($appraisee->user_id != $this->user->user_id){
                    $feed = array(
                        'status' => 'info',
                        'message_type' => 'Comment',
                        'user_id' => $this->user->user_id,
                        'feed_content' => 'Please review performance planning.',
                        'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                        'recipient_id' => $this->input->post('user_id')
                    );

                    $recipients = array($this->input->post('user_id'));
                    $this->system_feed->add( $feed, $recipients );
                
                    $this->response->notify[] = $this->input->post('user_id');    

                    // email to employee or appraisee            
                    $employee = $appraisee->email;
                    $sendtargetsettings['appraisee'] = $appraisee->alias;
                    
                    $logo  = ''; 

                    if ($this->config->item('system')['print_logo'] != ''){
                        if( file_exists( $this->config->item('system')['print_logo'] ) ){
                            $logo = base_url().$this->config->item('system')['print_logo'];
                        }
                    } else {
                        if ($appraisee->print_logo != ''){
                            if( file_exists( $appraisee->print_logo ) ){
                                $logo = base_url().$appraisee->print_logo;
                            }
                        }
                    }
            
                    $sendtargetsettings['system_logo'] = $logo; 

                    $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-EMPLOYEE') )->row_array();
                    $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                    $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                    $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                             VALUES('{$employee}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                    // email to employee or appraisee

                    $this->response->redirect = get_mod_route('performance_planning_manage');                
                }            
                break; 
            case 99: // for approver save as draft
                $this->response->redirect = get_mod_route('performance_planning_manage');
                break;                                       
        }

        //99 status is for save as draft after approver back to employee. it was fix to 99
        if (in_array($status_id, array(1,2,4,6,99))) {
            $field = $_POST['field'];

/*            $this->db->where('user_id',$this->input->post('user_id'));
            $this->db->where('planning_id',$this->input->post('record_id'));
            $this->db->delete('performance_planning_applicable_fields');*/

            $this->db->where('user_id',$this->input->post('user_id'));
            $this->db->where('planning_id',$this->input->post('record_id'));
            $this->db->update('performance_planning_applicable_fields',array('deleted' => 1));

            foreach ($field as $scorecard_id => $section_column) {
                foreach ($section_column as $section_column_id => $section_column_val) {
                    foreach ($section_column_val as $key => $value) {
                        $item_info = array(
                                'planning_id' => $this->input->post('record_id'),
                                'user_id' => $this->input->post('user_id'),
                                'scorecard_id' => $scorecard_id,
                                'section_column_id' => $section_column_id,
                                'value' => $value,
                                'deleted' => 0,
                                'sequence' => $key + 1
                            );

                        $where = array(
                                'planning_id' => $this->input->post('record_id'),
                                'user_id' => $this->input->post('user_id'),
                                'scorecard_id' => $scorecard_id,
                                'section_column_id' => $section_column_id,
                                'deleted' => 1,
                                'sequence' => $key + 1
                            );

                        
                        $this->db->where($where);
                        $result = $this->db->get('performance_planning_applicable_fields');
                        if ($result && $result->num_rows() > 0) {
                            $previous_main_data = $result->row_array();

                            if ($previous_main_data['value'] !== $value) {
                                $this->db->where('planning_id',$this->input->post('record_id'));
                                $this->db->where('user_id',$this->input->post('user_id'));
                                $this->db->where('approver_id',$this->user->user_id);
                                $this->db->update('performance_planning_approver',array('edited' => 1));

                                $item_info['edited'] = 1;
                            }

                            $this->db->where($where);
                            $this->db->update('performance_planning_applicable_fields',$item_info);

                            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable_fields', $previous_main_data, $item_info);
                        } else {
                            $this->db->insert('performance_planning_applicable_fields',$item_info);
                            $item_id = $this->db->insert_id();

                            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_planning_applicable_fields', '', $value);                            
                        }
                    }
                }
            }   
        }

        $this->db->trans_commit();

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        $this->_ajax_return();           
    }

    private function _change_status_hr_appraisal_admin()
    {        
        $this->load->model('system_feed');        

        $this->load->library('parser');
        $this->parser->set_delimiters('{{', '}}');      

        $appraisee = $this->mod->get_appraisee(  $_POST['planning_id'], $_POST['user_id'] );

        $this->response->redirect = get_mod_route('performance_planning_admin');

        $planning_other_info = isset($_POST['individual_planning']) ? $_POST['individual_planning'] : array();
        
        //get approvers
        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'appraisee_id' => $appraisee->user_id
        );
        $this->db->order_by('sequence');

        $approvers = $this->db->get_where('performance_planning_approver', $where)->result();
        $no_approvers = sizeof($approvers);

        $condition = $approvers[0]->condition;
        $fst_approver = $approvers[0];

        $this->db->trans_begin();
        $status_id = $this->input->post('status_id');

        $update['status_id'] = $status_id;        

        switch( $status_id ) {
            case 2: //for immediate supervisors review.
                $where = array(
                    'planning_id' => $this->input->post('planning_id'),
                    'template_id' => $this->input->post('template_id'),
                    'user_id' => $this->input->post('user_id')
                );

                //get previous data for audit logs
                $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();

                $this->db->update('performance_planning_applicable', $update, $where);                

                // set to_user_id to first approver
                $update['to_user_id'] = $fst_approver->approver_id;
                $this->db->update('performance_planning_applicable', $update, $where);                

                //reset status of approver to new since back to employee for review
                $this->db->where('planning_id',$this->input->post('planning_id'));
                $this->db->where('user_id',$this->input->post('user_id'));
                $this->db->update('performance_planning_approver',array('performance_status_id' => 0));

                foreach(  $approvers  as $index => $approver )
                {
                    if( $index == 0 )
                    {
                        $this->db->update('performance_planning_approver', array('performance_status_id' => 2), array('id' => $approver->id));                        

                        $feed = array(
                            'status' => 'info',
                            'message_type' => 'Comment',
                            'user_id' => $this->user->user_id,
                            'feed_content' => 'Please review performance planning.',
                            'uri' => $this->mod->route . '/review_admin/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                            'recipient_id' => $approver->approver_id
                        );

                        $recipients = array($approver->approver_id);
                        $this->system_feed->add( $feed, $recipients );

                        // email to approver for approval
                        $this->db->where('user_id',$approver->approver_id);
                        $approver_result = $this->db->get('users');
                        $approver_info = $approver_result->row();

                        $approver_recepient = $approver_info->email;
                        $sendtargetsettings['approver'] = $approver_info->full_name;

                        $sendtargetsettings['appraisee'] = $appraisee->fullname;

                        $logo  = ''; 

                        if ($this->config->item('system')['print_logo'] != ''){
                            if( file_exists( $this->config->item('system')['print_logo'] ) ){
                                $logo = base_url().$this->config->item('system')['print_logo'];
                            }
                        } else {
                            if ($appraisee->print_logo != ''){
                                if( file_exists( $appraisee->print_logo ) ){
                                    $logo = base_url().$appraisee->print_logo;
                                }
                            }
                        }
                
                        $sendtargetsettings['system_logo'] = $logo;                         

                        $target_settings_send_template = $this->db->get_where( 'system_template', array( 'code' => 'PERFORMANCE-TARGET-SETTINGS-SEND-APPROVER') )->row_array();
                        $msg = $this->parser->parse_string($target_settings_send_template['body'], $sendtargetsettings, TRUE); 
                        $subject = $this->parser->parse_string($target_settings_send_template['subject'], $sendtargetsettings, TRUE); 

                        $this->db->query("INSERT INTO {$this->db->dbprefix}system_email_queue (`to`, `subject`, body)
                                 VALUES('{$approver_recepient}', '{$subject}', '".$this->db->escape_str($msg)."') ");
                        // email to approver for approval

                        $this->response->notify[] = $approver->approver_id;
                    }
                }      

                //create system logs
                $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);

                $this->response->redirect = get_mod_route('performance_planning_admin'); 
                break;                                                                 
        }

        if (in_array($status_id, array(2,4))) {
            $field = $_POST['field'];
                                                                        
            foreach ($field as $scorecard_id => $section_column) {
                foreach ($section_column as $section_column_id => $section_column_val) {
                    foreach ($section_column_val as $key => $value) {
                        $item_info = array(
                                'planning_id' => $this->input->post('record_id'),
                                'user_id' => $this->input->post('user_id'),
                                'scorecard_id' => $scorecard_id,
                                'section_column_id' => $section_column_id,
                                'value' => $value,
                                'sequence' => $key + 1
                            );

                        $where = array(
                                'planning_id' => $this->input->post('record_id'),
                                'user_id' => $this->input->post('user_id'),
                                'scorecard_id' => $scorecard_id,
                                'section_column_id' => $section_column_id,
                                'sequence' => $key + 1
                            );

                        
                        $this->db->where($where);
                        $result = $this->db->get('performance_planning_applicable_fields');
                        if ($result && $result->num_rows() > 0) {
                            $previous_main_data = $result->row_array();

                            if ($previous_main_data['value'] !== $value) {
                                $item_info['edited_hr_admin'] = 1;
                            }

                            $this->db->where($where);
                            $this->db->update('performance_planning_applicable_fields',$item_info);

                            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable_fields', $previous_main_data, $item_info);
                        } else {
                            $this->db->insert('performance_planning_applicable_fields',$item_info);
                            $item_id = $this->db->insert_id();

                            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_planning_applicable_fields', '', $value);                            
                        }
                    }
                }
            }   
        }

        $this->db->trans_commit();

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        $this->_ajax_return();           
    }

    //no use in oclp
    private function _change_status_approver()
    {
        $appraisee = $this->mod->get_appraisee(  $_POST['planning_id'], $_POST['user_id'] );
        $approver = $this->mod->get_approver(  $_POST['planning_id'], $_POST['user_id'], $_POST['manager_id'] );
        if( !$approver )
        {
            $this->response->message[] = array(
                'message' => 'Record is not under your attention.',
                'type' => 'warning'
            );

            $this->_ajax_return();
        }

        $status_id = $this->input->post('status_id');
        
        //get approvers
        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'user_id' => $this->input->post('user_id'),
        );
        $this->db->order_by('sequence');
        $approvers = $this->db->get_where('performance_planning_approver', $where)->result();
        $no_approvers = sizeof($approvers);

        $condition = $approvers[0]->condition;
        $fst_approver = $approvers[0];

        $this->response->redirect = false;
        $this->load->model('system_feed');
        switch( $status_id )
        {
            case 3: //pending
                //bring it down
                foreach(  $approvers as $index => $approver )
                {
                    if( $approver->approver_id == $this->user->user_id ){
                        if( $index != 0 ){
                            $down = $approvers[$index-1];
                            $update_data = array('performance_status_id' => 3);
                            $where_array = array('id' => $down->id);
                        //get previous data for audit logs
                            $previous_main_data = $this->db->get_where('performance_planning_approver', $where_array)->row_array();
                            $this->db->update('performance_planning_approver', $update_data, $where_array);
                            $update['to_user_id'] = $down->approver_id;

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Please review performance planning.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'].'/'.$down->approver_id,
                                'recipient_id' => $down->approver_id
                            );

                            $recipients = array($down->approver_id);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $down->approver_id;
                        }
                        else{
                            $update['to_user_id'] = $this->input->post('user_id');
                            $update_data = $update;
                            $where_array = array(
                                'planning_id' => $this->input->post('planning_id'),
                                'user_id' => $this->input->post('user_id'),
                            );
                            $previous_main_data = $this->db->get_where('performance_planning_applicable', $where_array)->row_array();

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Please review your performance targets.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];
                        }
                    }
                }
                
                break;
            case 4: //approved
                //bring it up
                foreach(  $approvers as $index => $approver )
                {
                    if( $approver->approver_id == $this->user->user_id ){
                        $update_data = array('performance_status_id' => 4);
                        $where_array = array('id' => $approver->id);
                        //get previous data for audit logs
                        $previous_main_data = $this->db->get_where('performance_planning_approver', $where_array)->row_array();
                        $this->db->update('performance_planning_approver', $update_data, $where_array);

                        if( ($index+1) == $no_approvers ){
                            $update['to_user_id'] = $this->input->post('user_id');

                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Your performance planning have been approved.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];
                        

                            if( $fst_approver->approver_id != $approver->approver_id )
                            {
                                $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'The performance targets of '.$appraisee->fullname.' has been approved.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'],
                                'recipient_id' => $fst_approver->approver_id
                            );

                            $recipients = array($fst_approver->approver_id);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $fst_approver->approver_id;    
                            }

                        }
                        else{
                            $up = $approvers[$index+1];
                            $update['to_user_id'] = $up->approver_id;
                            $feed = array(
                                'status' => 'info',
                                'message_type' => 'Comment',
                                'user_id' => $this->user->user_id,
                                'feed_content' => 'Please review '.$appraisee->fullname.'\'s performance targets.',
                                'uri' => $this->mod->route . '/review/'.$_POST['planning_id'].'/'.$_POST['user_id'].'/'.$update['to_user_id'],
                                'recipient_id' => $update['to_user_id']
                            );

                            $recipients = array($update['to_user_id']);
                            $this->system_feed->add( $feed, $recipients );

                            $this->response->notify[] = $update['to_user_id'];
                        }
                    }
                }

                break;
            default: //draft
        }    
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_approver', $previous_main_data, $update_data);
        $this->response->notify[] = $approver->approver_id;

        if( $status_id == 4 )
        {
            //get approvers
            $where = array(
                'planning_id' => $this->input->post('planning_id'),
                'user_id' => $this->input->post('user_id'),
            );
            $this->db->order_by('sequence');
            $approvers = $this->db->get_where('performance_planning_approver', $where)->result();
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
                        $status_id = 4;
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
                        $status_id = 4;
                    }
                    break;
            }
        }
        
        $update['status_id'] = $status_id;
        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'template_id' => $this->input->post('template_id'),
            'user_id' => $this->input->post('user_id'),
        );
    //get previous data for audit logs
        $previous_main_data = $this->db->get_where('performance_planning_applicable', $where)->row_array();
        $this->db->update('performance_planning_applicable', $update, $where);
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_planning_applicable', $previous_main_data, $update);
    
        $this->response->redirect = get_mod_route('performance_planning_manage');
    }


    function change_status( $return = false )
    {
        $this->_ajax_only();
        
        if( $this->input->post('manager_id') )
            $this->_change_status_approver(); // no use for oclp
        else {
            if (isset($this->config_permission['appraisal_individual_planning']['process']))
                $this->_change_status_hr_appraisal_admin();
            else
                $this->_change_status_partner();
        }

        if( $return )
        {
            return true;
        }

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    function get_notes()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
        $vars['notes'] = $this->mod->get_notes($_POST['planning_id'], $_POST['user_id']);
        $this->load->vars($vars);

        $data['title'] = 'For Discussion';
        $data['content'] = $this->load->blade('edit.notes')->with( $this->load->get_cached_vars() );

        $this->response->notes = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function save_note()
    {
        $this->_ajax_only();

        //$this->change_status( true );

        if(trim($this->input->post('notes')) != ''){
            $insert = array(
                'planning_id' => $this->input->post('planning_id'),
                'user_id' => $this->input->post('user_id'),
                'notes' => $this->input->post('notes'),
                'created_by' => $this->user->user_id
            );

            $this->db->insert('performance_planning_notes', $insert);
            //create system logs
            $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_planning_notes', array(), $insert);
        }
        
        if( isset($_POST['approver_id']) && $_POST['approver_id'] > 1 )
            $this->response->redirect = get_mod_route('performance_planning_manage');
        else if( isset($_POST['approver_id']) )
            $this->response->redirect = get_mod_route('appraisal_individual_planning');
        else
            $this->response->redirect = base_url();
        
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    public function review_admin( $record_id, $user_id, $manager = '' )
    {
        parent::edit('', true);

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $vars['approver'] = $this->mod->get_approver( $this->record_id, $user_id, $this->user->user_id );

        $vars['planning_admin'] = 0;
        $vars['readonly'] = '';
        $vars['disabled'] = '';

        if( !$vars['approver'] ) {
            $vars['planning_admin'] = 1;
            $vars['readonly'] = "readonly='readonly'";
            $vars['disabled'] = 'disabled';
        }
        else {
            if (in_array($appraisee->performance_status_id,array(0,1,4,6))) {
                $vars['planning_admin'] = 1;
                $vars['readonly'] = "readonly='readonly'";
                $vars['disabled'] = 'disabled';
            }
        }

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $vars['back_url_admin'] = get_mod_route('performance_planning_admin').'/index/'.$this->record_id;
        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->applicable_template_id );

        $vars['approversLog'] = array();
        $approvers_log = "SELECT ppar.display_name, ppl.created_on, ppar.approved_date, ppap.user_id, ppar.performance_status_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id,ppar.edited  
                        FROM {$this->db->dbprefix}performance_planning_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_planning_approver ppar ON ppap.planning_id = ppar.planning_id AND ppap.user_id = ppar.appraisee_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_planning_logs ppl ON ppap.planning_id = ppl.planning_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.planning_id = {$appraisee->planning_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";

        $approversLog = $this->db->query($approvers_log);

        if( $approversLog && $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        foreach ($vars['approversLog'] as $key => $value) {
            if ($value['approver_id'] == $this->user->user_id && $value['performance_status_id'] == 4) {
                $vars['readonly'] = "readonly='readonly'";
                $vars['disabled'] = 'disabled';
            }
        }

        $vars['transaction_type'] = 'view';

        $vars['planning_id'] = $appraisee->planning_id;
        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['template_section'] = $this->mod->get_template_section($appraisee->applicable_template_id);
        $vars['library_competencies'] = $this->mod->get_library_competencies();
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['areas_development'] = $this->mod->get_areas_for_development();
        $vars['learning_mode'] = $this->mod->get_learning_mode();
        $vars['competencies'] = $this->mod->get_competencies();
        $vars['target_completion'] = $this->mod->get_target_completion();
        $vars['template_id'] = $appraisee->applicable_template_id;

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.review')->with( $this->load->get_cached_vars() );  
    }

    public function edit_admin( $record_id, $user_id, $manager = '' )
    {
        parent::edit('', true);

        $appraisee = $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        $vars['approver'] = $this->mod->get_approver( $this->record_id, $user_id, $this->user->user_id );

        $vars['planning_admin'] = 0;
        $vars['readonly'] = '';

        if( !$vars['approver'] ) {
            $vars['planning_admin'] = 1;
            $vars['readonly'] = "readonly='readonly'";
        }
        else {
            if (in_array($appraisee->performance_status_id,array(0,1,4,6))) {
                $vars['planning_admin'] = 1;
                $vars['readonly'] = "readonly='readonly'";                
            }
        }

        $vars['hr_appraisal_admin'] = 0;
        if (isset($this->config_permission['appraisal_individual_planning']['process'])) {
            $vars['hr_appraisal_admin'] = 1;
            $vars['readonly'] = ""; 
        }

        $vars['manager_id'] = '';
        $vars['current_user_id'] = $this->user->user_id;

        $vars['back_url_admin'] = get_mod_route('performance_planning_admin').'/index/'.$this->record_id;
        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template;
        $vars['templatefile'] = $this->template->get_template( $appraisee->applicable_template_id );

        $vars['approversLog'] = array();
        $approvers_log = "SELECT ppar.display_name, ppl.created_on, ppar.approved_date, ppap.user_id, pstat.performance_status, REPLACE(pstat.class, 'btn', 'badge') as class, pos.position, ppap.to_user_id, ppar.approver_id,ppar.edited  
                        FROM {$this->db->dbprefix}performance_planning_applicable ppap 
                        INNER JOIN {$this->db->dbprefix}performance_planning_approver ppar ON ppap.planning_id = ppar.planning_id AND ppap.user_id = ppar.appraisee_id 
                        INNER JOIN {$this->db->dbprefix}users_profile usp ON ppar.approver_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users u ON u.user_id = usp.user_id
                        INNER JOIN {$this->db->dbprefix}users_position pos ON usp.position_id = pos.position_id
                        INNER JOIN {$this->db->dbprefix}performance_status pstat ON ppar.performance_status_id = pstat.performance_status_id 
                        LEFT JOIN {$this->db->dbprefix}performance_planning_logs ppl ON ppap.planning_id = ppl.planning_id 
                        AND ppap.user_id = ppl.user_id AND ppar.approver_id = ppl.to_user_id 
                        WHERE ppap.planning_id = {$appraisee->planning_id} AND u.active = 1 AND ppap.user_id = {$appraisee->user_id} GROUP BY ppar.approver_id ORDER BY ppar.sequence ";

        $approversLog = $this->db->query($approvers_log);

        if( $approversLog && $approversLog->num_rows() > 0 ){
            $vars['approversLog'] = $approversLog->result_array();
        }

        $vars['transaction_type'] = 'view';

        $vars['planning_id'] = $appraisee->planning_id;
        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['template_section'] = $this->mod->get_template_section($appraisee->applicable_template_id);
        $vars['library_competencies'] = $this->mod->get_library_competencies();
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['template_id'] = $appraisee->applicable_template_id;
        
        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.edit_admin')->with( $this->load->get_cached_vars() );  
    }

    function view_discussion()
    {
        $this->_ajax_only();
        
        $vars = $_POST;
        $this->db->limit(1);
        $vars['planning'] = $this->db->get_where('performance_planning_applicable', array('planning_id' => $_POST['planning_id'], 'user_id' => $_POST['user_id']))->row();
        $vars['notes'] = $this->mod->get_notes($_POST['planning_id'], $_POST['user_id']);
        $vars['approver_id'] = 0;
        $planning_get_approvers = $this->db->query("CALL sp_performance_planning_get_approvers(".$_POST['planning_id'].", ".$_POST['user_id'].")")->result_array();
        mysqli_next_result($this->db->conn_id);

        $back_to = 0;
        $vars['sent_to'] = '';
        foreach ($planning_get_approvers as $approver){
            if($_POST['user_id'] == $this->user->user_id){
                if($approver['sequence'] == 1){
                    $user_details = $this->db->get_where('users_profile', array('user_id' => $approver['approver_id']))->row_array();
                    $vars['sent_to'] = $user_details['firstname'].' '.$user_details['lastname'];
                    $vars['approver_id'] = $approver['approver_id'];
                }
            }else{
                if($approver['approver_id'] == $this->user->user_id){
                    if($approver['sequence'] == 1){
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
            foreach ($planning_get_approvers as $approver){
                if($approver['sequence'] == $back_to){
                    $user_details = $this->db->get_where('users_profile', array('user_id' => $approver['approver_id']))->row_array();
                    $vars['sent_to'] = $user_details['firstname'].' '.$user_details['lastname'];
                    $vars['approver_id'] = $approver['approver_id'];
                }
            }
        }

        if ($this->user->user_id == $this->input->post('user_id'))
            $vars['approver_id'] = 0;

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
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_planning_notes', array(), $insert);
        
        // GET LATEST POSTED DATA AND RETURN IT BACK TO THE UI
        $new_notes_qry = " SELECT ud.department, CONCAT(up.lastname, ', ', up.firstname) as full_name, 
                    gettimeline('{$insert['created_on']}') as timeline, {$insert['created_by']} as created_by,
                    {$insert['user_id']} as user_id, IF(up.photo != '',up.photo,'uploads/users/avatar.png') as photo
                    FROM {$this->db->dbprefix}users_profile up
                    LEFT JOIN {$this->db->dbprefix}users_department ud on ud.department_id = up.department_id 
                    WHERE up.user_id = {$this->user->user_id}";
                    
        $data['note'] = $this->db->query($new_notes_qry)->row_array();
        $data['note']['notes'] = $insert['notes'];
        $this->response->new_discussion   = $this->load->view('customs/new_discussion', $data, true);

        $this->response->message[] = array(
            'message' => 'Discussion successfully added.',
            'type' => 'success'
        );


        $this->_ajax_return();  
    }

    function get_crowdsource_draft()
    {
        $this->_ajax_only();  

        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'user_id' => $this->input->post('user_id'),
            'section_id' => $this->input->post('section_id')
        );
        $vars['planning'] = $this->db->get_where('performance_planning_applicable', array('planning_id' => $_POST['planning_id'], 'user_id' => $_POST['user_id']))->row();
        $vars['section'] = $this->db->get_where('performance_template_section', array('template_section_id' => $this->input->post('section_id')))->row();

        $this->db->limit(1);
        $crowdsource = $this->db->get_where('performance_planning_crowdsource', $where);
        if( $crowdsource->num_rows() )
        {
            $crowdsource = $crowdsource->row();
            $_POST['crowdsource_user_id'] = $crowdsource->crowdsource_user_id;
        }
        else
            $_POST['crowdsource_user_id'] = "";

        $this->load->vars($_POST);
        $this->load->vars($vars);
        
        $data['title'] = 'Crowdsource Draft';
        $data['description'] = 'Input crowdsource draft list on each section for future guide on appraisal.';
        $data['content'] = $this->load->view('edit/crowdsource_draft', '', true);
        $this->response->form = $this->load->view('templates/modal', $data, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();
    }

    public function tag_user(){
        $this->_ajax_only();
        $data = array();
        $this->load->model('dashboard_model', 'dashboard');
        $data = $this->dashboard->getUsersTagList();
        header('Content-type: application/json');
        echo json_encode($data);
        die();
    }

    function save_crowdsource_draft()
    {
        $this->_ajax_only();
        $this->response->success = false;
        $crowdsource = $this->input->post('crowdsource_user_id');
        $section = $this->db->get_where('performance_template_section', array('template_section_id' => $this->input->post('section_id')))->row();
        
        if(empty( $crowdsource )){
            $this->response->message[] = array(
                'message' => 'Mininum number of crowdsource should be at least '. $section->min_crowdsource .'.',
                'type' => 'warning'
            );

            $this->_ajax_return();  
        }
        if( !empty( $section->min_crowdsource ) && !empty( $crowdsource ) )
        {
            $crowdsource = explode( ',', $crowdsource );
            if( sizeof( $crowdsource ) < $section->min_crowdsource )
            {
                $this->response->message[] = array(
                    'message' => 'Mininum number of crowdsource should be at least '. $section->min_crowdsource .'.',
                    'type' => 'warning'
                );

                $this->_ajax_return();   
            }
        }

        $users_info = $this->db->get_where('users_profile', array('user_id' => $this->input->post('user_id')) )->row_array();
        if( in_array($users_info['reports_to_id'], $crowdsource) ){
            $this->response->message[] = array(
                'message' => 'You cannot choose your immediate superior as your crowdsource.',
                'type' => 'warning'
            );
            $this->_ajax_return();  
        }

        $template_info = $this->db->get_where('performance_template', array('template_id' => $section->template_id))->row();
        if($template_info->max_crowdsource > 0){
            foreach ($crowdsource as $key => $value) {
                $crowdsource_count = "SELECT * FROM {$this->db->dbprefix}performance_planning_crowdsource
                                    WHERE planning_id = {$this->input->post('planning_id')} 
                                    AND FIND_IN_SET($value, crowdsource_user_id) AND section_id = {$this->input->post('section_id')} 
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

        $where = array(
            'planning_id' => $this->input->post('planning_id'),
            'user_id' => $this->input->post('user_id'),
            'section_id' => $this->input->post('section_id')
        );
        $this->db->limit(1);
        $check = $this->db->get_where('performance_planning_crowdsource', $where);
        if( $check->num_rows() )
            $this->db->update('performance_planning_crowdsource', array('crowdsource_user_id' => $this->input->post('crowdsource_user_id')), $where);
        else
            $this->db->insert('performance_planning_crowdsource', $_POST);

        $contributors = array();
        $this->response->list_of_contributors = '';
        $crowdsource_draft = array();
        $crowdsource_draft = $this->db->get_where('performance_planning_crowdsource', $where);
        if($crowdsource_draft->num_rows() > 0){
            $crowdsource_draft = $crowdsource_draft->row_array();   
            // $contributors = explode( ',', $crowdsource_draft['crowdsource_user_id'] );
            $contributors = $this->db->query("SELECT full_name FROM users WHERE user_id IN ({$crowdsource_draft['crowdsource_user_id']})")->result_array();
        // print_r($crowdsource_draft);
        }
        if(count($contributors) > 0){   
            $this->response->list_of_contributors .= '<label class="control-label ">List of Crowdsource</label><br>';
            foreach($contributors as $contributor){    
                $this->response->list_of_contributors .=  '<a class="btn default btn-sm">'. $contributor['full_name'].'</a>&nbsp;';
            }
        }

        $this->response->success = true;
        $this->response->tsection_id = $this->input->post('section_id');
        $this->response->message[] = array(
            'message' => 'Crowdsource successfully drafted.',
            'type' => 'success'
        );

        $this->_ajax_return();
    }
    

    function view_transaction_logs()
    {
        $this->_ajax_only();

        $approvers_list = array();
        $approvers = "SELECT ppa.display_name, upos.position FROM {$this->db->dbprefix}performance_planning_approver  ppa 
                        INNER JOIN {$this->db->dbprefix}users_profile up 
                        ON ppa.approver_id = up.user_id 
                        INNER JOIN {$this->db->dbprefix}users_position upos 
                        ON up.position_id = upos.position_id
                        INNER JOIN {$this->db->dbprefix}users u
                        ON u.user_id = up.user_id 
                        WHERE ppa.planning_id = {$_POST['planning_id']} AND u.active = 1 AND ppa.user_id = {$_POST['user_id']}
                    "; 
        $app_sql = $this->db->query($approvers);
        if($app_sql->num_rows() > 0){
            $approvers_list = $app_sql->result_array();
        }

        $logs_list = array();
        $logs = "SELECT CONCAT(up.firstname,' ',up.lastname) as partner_name, upos.position, 
                        ppa.created_on, performance_status, pstat.class 
                        FROM {$this->db->dbprefix}performance_planning_logs  ppa 
                        INNER JOIN {$this->db->dbprefix}users_profile up 
                        ON ppa.to_user_id = up.user_id
                        INNER JOIN {$this->db->dbprefix}users_position upos 
                        ON up.position_id = upos.position_id 
                        INNER JOIN {$this->db->dbprefix}performance_status pstat 
                        ON ppa.status_id = pstat.performance_status_id 
                        WHERE ppa.planning_id = {$_POST['planning_id']} AND ppa.user_id = {$_POST['user_id']}
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

    //for oclp
    function add_row()
    {
        $this->_ajax_only();

        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['score_card'] = $this->mod->get_balance_score_card($this->input->post('scorecard_id'))->row()->scorecard;

        $this->load->vars( $vars );

        $this->response->items = $this->load->view('edit/add_row_score_card', $_POST, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();            
    }

    function add_idp()
    {
        $this->_ajax_only();

        $vars['template_section_column'] = $this->mod->get_template_section_column();

        $vars['areas_development'] = $this->mod->get_areas_for_development();
        $vars['learning_mode'] = $this->mod->get_learning_mode();
        $vars['competencies'] = $this->mod->get_competencies();
        $vars['target_completion'] = $this->mod->get_target_completion();

        $this->load->vars( $vars );

        $this->response->items = $this->load->view('edit/add_idp', $_POST, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();            
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

        $rec['review_url'] = $this->mod->url . '/review/' . $record['record_id'];        
    }


    function print_appraisal_planning()
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

        $vars['tenure'] = get_tenure($appraisee->effectivity_date);

        $this->load->model('appraisal_template_model', 'template');
        $vars['template'] = $this->template; 

        $vars['planning_id'] = $appraisee->planning_id;
        $vars['balance_score_card'] = $this->mod->get_balance_score_card();
        $vars['template_section_column'] = $this->mod->get_template_section_column();
        $vars['planning_applicable_fields'] = $this->mod->get_planning_applicable_fields($appraisee->planning_id,$appraisee->user_id);
        $vars['template_section'] = $this->mod->get_template_section($appraisee->applicable_template_id);
        $vars['library_competencies'] = $this->mod->get_library_competencies();
        $vars['tenure'] = get_tenure($appraisee->effectivity_date);
        $vars['areas_development'] = $this->mod->get_areas_for_development();
        $vars['learning_mode'] = $this->mod->get_learning_mode();
        $vars['competencies'] = $this->mod->get_competencies();
        $vars['target_completion'] = $this->mod->get_target_completion();

        $record = $this->load->get_cached_vars();
        $vars['record'] = $record['record'];

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        $html = $this->load->view('pages/appraisal_planning_print_template.blade.php',$vars,true); 

        $this->load->helper('file');
        $path = 'uploads/templates/performance/';
        $this->check_path( $path );
        $filename = $path .$appraisee->fullname. "-".'Performance Appraisal Planning Form' .".pdf";

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