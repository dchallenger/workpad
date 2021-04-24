<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_employee_database extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_employee_database_model', 'mod');
		parent::__construct();
	}

 	function ted_export_excel(){

        $filename = $this->mod->export_excel();

        $this->response->message[] = array(
            'message' => 'Download file ready.',
            'type' => 'success'
        );

        $this->response->filename = $filename;
        $this->_ajax_return();
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

            $this->db->select('
                                training_employee_database.training_course,training_provider.provider,training_calendar.venue,
                                training_employee_database.start_date,training_employee_database.end_date,training_calendar.cost_per_pax,
                                training_course.with_bond,training_course.cost,training_course.length_of_service
                              ');
            $this->db->join('training_calendar','training_calendar.training_calendar_id = training_employee_database.training_calendar_id','left');
            $this->db->join('training_course','training_course.course_id = training_calendar.course_id','left');
            $this->db->join('training_provider','training_provider.provider_id = training_course.provider_id','left');
            $this->db->where('training_employee_database.employee_database_id',$this->input->post('record_id'));
            $employee_training = $this->db->get('training_employee_database');

            if ($employee_training && $employee_training->num_rows() > 0)
                $data['employee_training_result'] = $employee_training->row_array();
            else
                $data['employee_training_result'] = array();

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
}