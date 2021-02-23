<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Individual_development_plan extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('individual_development_plan_model', 'mod');
		parent::__construct();
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

	public function _edit( $child_call, $new = false )
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

			$data['areas_development'] = $this->mod->get_appraisal_areas_development();
			$data['learning_mode'] = $this->mod->get_learning_mode();
			$data['competencies'] = $this->mod->get_competencies();
			$data['development_category'] = $this->mod->get_development_category();
			$data['target_completion'] = $this->mod->get_target_completion();

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

	public function add_idp_item()
	{
		$this->_ajax_only();

		$data['count'] = $this->input->post('count');
		$data['counting'] = $this->input->post('counting');
		$data['category'] = $this->input->post('category');

		$this->response->count = ++$data['count'];
		$this->response->counting = ++$data['counting'];

		$this->load->helper('file');
		$this->response->add_form = $this->load->view('edit/idp_item', $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
			);

		$this->_ajax_return();		
	}
}