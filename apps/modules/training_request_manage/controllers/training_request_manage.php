<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_request_manage extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_request_manage_model', 'mod');
        $this->load->model('training_request_model', 'mod_personal');
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
        $data['allow_manage'] = ($permission != 0 ? $permission['list'] : $permission);;
        $permission = parent::_check_permission('training_request_admin');
        $data['allow_admin'] = ($permission != 0 ? $permission['list'] : $permission);;
        $data['status'] = $this->mod_personal->get_status();

        $this->load->vars($data);
        echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
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

            $data['approver_details'] = $this->mod->get_approver_details($this->record_id,$this->user->user_id);

            $data['approvers'] = $this->mod_personal->get_approvers($this->record_id);

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

        $trash = $this->input->post('trash') == 'true' ? true : false;
        $records = $this->_get_list( $trash );
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

    private function _get_list( $trash )
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
                if( $filter_value != "" ) $filter = 'AND ww_training_application.'. $filter_by_key .' = "'.$filter_value.'"';   
            }
        }
        else{
            if( $filter_by && $filter_by != "" )
            {
                $filter = 'AND ww_training_application.'. $filter_by .' = "'.$filter_value.'"';
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
        
        $page = ($page-1) * 10;
        $records = $this->mod->_get_list($page, 10, $search, $filter, $trash);
        return $records;
    }

    public function save( $child_call = false )
    {
        $this->_ajax_only();

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

        $this->record_id = $this->input->post('record_id');

        $status_id = $_POST['training_application']['status_id'];

        $comment = $_POST['training_application']['approver_remarks'];

        $this->response = $this->mod->change_status($this->record_id, $status_id, $comment);

        $this->response->saved = 1;

        $this->response->message[] = array(
            'message' => lang('common.save_success'),
            'type' => 'success'
        );

        if( !$child_call )
        {
            $this->_ajax_return();
        }

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