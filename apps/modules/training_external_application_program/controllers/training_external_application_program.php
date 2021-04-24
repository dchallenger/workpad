<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_external_application_program extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_external_application_program_model', 'mod');
		parent::__construct();
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

			$data['objective_info_object'] = $this->mod->get_objective($this->record_id);
			$data['action_plan_info_object'] = $this->mod->get_action_plan($this->record_id);
			$data['knowledge_transfer_info_object'] = $this->mod->get_knowledge_transfer($this->record_id);

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

	public function save( $child_call = false )
	{
		parent::save(true);

		if( $this->response->saved ) {
			$objective = $_POST['training_application_objective'] ?? [];
			$action_plan = $_POST['training_application_action_pan'] ?? [];
			$knowledge_transfer = $_POST['training_application_knowledge_transfer'] ?? [];

			if (!empty($objective)) {
				$training_rating_scale_ids = $objective['training_rating_scale_id'];
				$training_application_objective_ids = $objective['training_application_objective_id'];
				foreach ($objective['objective'] as $key => $value) {
					$objective_info =	array(
							'training_application_id' => $this->record_id,
							'objective' => $value,
							'training_rating_scale_id' => $training_rating_scale_ids[$key]
						);

					if (isset($training_application_objective_ids[$key])) {
						$this->db->where('training_application_objective_id',$training_application_objective_ids[$key]);
						$this->db->update('training_application_objective',$objective_info);				
					}
					else
						$this->db->insert('training_application_objective',$objective_info);
				}
			}

			if (!empty($action_plan)) {
				$training_application_action_plan_remarks = $action_plan['remarks'];
				$training_application_action_plan_ids = $action_plan['training_application_action_plan_id'] ?? [];
				foreach ($action_plan['action_plan'] as $key => $value) {
					$action_plan_info =	array(
							'training_application_id' => $this->record_id,
							'action_plan' => $value,
							'remarks' => $training_application_action_plan_remarks[$key]
						);

					if (isset($training_application_action_plan_ids[$key])) {
						$this->db->where('training_application_action_plan_id',$training_application_action_plan_ids[$key]);
						$this->db->update('training_application_action_plan',$action_plan_info);				
					}
					else
						$this->db->insert('training_application_action_plan',$action_plan_info);
				}
			}

			if (!empty($knowledge_transfer)) {
				$training_application_knowledge_transfer_remarks = $knowledge_transfer['remarks'];
				$training_application_knowledge_transfer_ids = $knowledge_transfer['training_application_knowledge_transfer_id'] ?? [];
				foreach ($knowledge_transfer['training_knowledge_transfer_id'] as $key => $value) {
					$knowledge_transfer_info =	array(
							'training_application_id' => $this->record_id,
							'training_knowledge_transfer_id' => $value,
							'remarks' => $training_application_knowledge_transfer_remarks[$key]
						);

					if (isset($training_application_knowledge_transfer_ids[$key])) {
						$this->db->where('training_application_knowledge_transfer_id',$training_application_knowledge_transfer_ids[$key]);
						$this->db->update('training_application_knowledge_transfer',$knowledge_transfer_info);				
					}
					else
						$this->db->insert('training_application_knowledge_transfer',$knowledge_transfer_info);
				}
			}			
		}

		$this->response->message[] = array(
			'message' => lang('common.save_success'),
			'type' => 'success'
		);

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

			$data['objective_info_object'] = $this->mod->get_objective($this->record_id);
			$data['action_plan_info_object'] = $this->mod->get_action_plan($this->record_id);
			$data['knowledge_transfer_info_object'] = $this->mod->get_knowledge_transfer($this->record_id);
			
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

	public function get_objective()
	{
		$this->_ajax_only();

        $this->load->helper('form');
        $this->load->helper('file');

		$this->response->objective_content = $this->load->view('edit/custom_fgs/objective', $_POST, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return(); 		
	}

	public function get_action_plan()
	{
		$this->_ajax_only();

        $this->load->helper('form');
        $this->load->helper('file');
        
		$this->response->objective_content = $this->load->view('edit/custom_fgs/action_plan', $_POST, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return(); 		
	}

	public function get_knowledge_transfer()
	{
		$this->_ajax_only();

        $this->load->helper('form');
        $this->load->helper('file');
        
		$this->response->objective_content = $this->load->view('edit/custom_fgs/knowledge_transfer', $_POST, true);

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return(); 		
	}
}