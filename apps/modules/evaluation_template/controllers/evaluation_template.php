<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation_template extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('evaluation_template_model', 'mod');
		parent::__construct();
	}


	function get_section_form()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}
		
		$section_id = $this->input->post('section_id');
		$evaluation_template_id = $this->input->post('template_id');
		$vars['template_section_id'] = $section_id;
		$vars['evaluation_template_id'] = $evaluation_template_id;
		$vars['template_section'] = '';
		$vars['parent_id'] = '';
		$vars['weight'] = '';
		$vars['section_type_id'] = '';
		$vars['sequence'] = '';
		$vars['header'] = '';
		$vars['footer'] = '';

		if( !empty( $section_id ) )
		{
			$data['title'] = 'Edit Section';
			$vars = $this->db->get_where('training_evaluation_template_section', array('template_section_id' => $section_id))->row_array();
		}else{
			$data['title'] = 'Add Section';
		}
		
		$this->load->vars( $vars );

		$this->load->helper('form');
		$data['content'] = $this->load->blade('edit.section_form')->with( $this->load->get_cached_vars() );

		$this->response->section_form = $this->load->view('templates/modal', $data, true);
		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();	
	}

	function save_section()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}	
		
		$this->load->library('form_validation');

		$config = array(
			array(
				'field'   => 'template_section',
				'label'   => 'Section Title',
				'rules'   => 'required'
			),
			array(
				'field'   => 'sequence',
				'label'   => 'Sequence',
				'rules'   => 'required'
			),
			array(
				'field'   => 'section_type_id',
				'label'   => 'Section Type',
				'rules'   => 'required'
			),
		);


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

		$template_section_id = $this->input->post('template_section_id');

		unset( $_POST['template_section_id'] );

		$previous_main_data = array();
		if( empty( $template_section_id )  )
		{
			$this->db->insert('training_evaluation_template_section', $_POST);
			$action = 'insert';
		}
		else{
		//get previous data for audit logs
			$where_array = array('template_section_id' => $template_section_id);
			$previous_main_data = $this->db->get_where('training_evaluation_template_section', $where_array)->row_array();
			$this->db->update('training_evaluation_template_section', $_POST, $where_array);
			$action = 'update';
		}
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'performance_template_section', $previous_main_data, $_POST);

		$this->response->close_modal = true;

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}	

	function get_sections()
	{
		$this->_ajax_only();

		if( !$this->permission['edit'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$sections = $this->mod->get_sections( $this->input->post('evaluation_template_id') );

		$type = $this->input->post('type');

		$this->response->sections = $this->load->view('edit/sections', array('sections' => $sections, 'type' => $type ), true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function delete_section()
	{
		$this->_ajax_only();

		if( !$this->permission['delete'] )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_permission'),
				'type' => 'warning'
			);
			$this->_ajax_return();
		}

		$template_section_id = $this->input->post('template_section_id');
		$this->db->update('training_evaluation_template_section', array('deleted' => 1), array('template_section_id' => $template_section_id));
		//create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', 'training_evaluation_template_section - template_section_id', array(), array('template_section_id' => $template_section_id));

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}	
}