<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Appraisal_template extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('appraisal_template_model', 'mod');
		parent::__construct();
	}

	public function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$company = array();
		$company_result = $this->db->get_where('users_company',array('deleted' => 0));
		if ($company_result && $company_result->result() > 0){
			$company = $company_result->result();
		}

		$data['companys'] = $company;		
		$this->load->vars( $data );

		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
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
				if ($filter_by_key == 'company_id')
					$filter_by_key = 'pt.company_id';

				if( $filter_value != "" ) $filter = 'AND '. $filter_by_key .' = "'.$filter_value.'"';	
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
				$filter = 'AND '. $filter_by .' = "'.$filter_value.'"';
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
	
	public function save($child_call = false)
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

		$this->db->trans_begin();

		$this->response = $this->mod->_save( true, false );
		
		if( $this->response->saved )
		{
			if( isset($_POST['field']) )
	        {
	            $fields = $_POST['field'];
	            $columns_with_items = array();
	            foreach( $fields as $column_id => $items )
	            {
	                $columns_with_items[] = $column_id;
	            }

	            $columns_with_items = array_unique( $columns_with_items );
	            $qry = "SELECT *
	            FROM {$this->db->dbprefix}performance_template_section_column
	            WHERE section_column_id IN (".implode( ',', $columns_with_items ).")
	            AND deleted = 0 AND uitype_id = 7";
	            $weights = $this->db->query($qry);
	            if( $weights->num_rows() > 0 )
	            {
	            	//get sections
	            	foreach($weights->result() as $weight)
	            	{
	            		$section = $this->db->get_where('performance_template_section', array('template_section_id' => $weight->template_section_id))->row();
	            		$col_fields = $fields[$weight->section_column_id];
	            		$col_total = 0;
	            		foreach( $col_fields as $item_id => $value )
	               		{
	            			$col_total += empty( $value ) ? 0 : $value;
	            		}
	            		$section_weight = empty( $section->weight ) ? 0 : $section->weight;
						
	            	
	            		if( $section_weight != $col_total )
	            		{
	            			$this->response->message[] = array(
								'message' => $section->template_section . ' weight does not add up correctly.',
								'type' => 'warning'
							);
							$this->db->trans_rollback();
							$this->_ajax_return();		
	            		}
	            	}
	            }

	            foreach( $fields as $column_id => $items )
	            {
	                foreach( $items as $item_id => $value )
	                {
	                    $insert = array(
	                        'item_id' => $item_id,
	                        'section_column_id' => $column_id, 
	                        'value' => $value
	                    );

	                    $where = array(
	                        'item_id' => $item_id,
	                        'section_column_id' => $column_id 
	                    );

	                    $check = $this->db->get_where('performance_template_section_column_fields', $where);
	                    $previous_main_data = array();
	                    if($check->num_rows() > 0)
	                    {
	                    	$previous_main_data = $check->row_array();
	                        $this->db->update('performance_template_section_column_fields', $insert, $where);
	                    	$action = 'update';
	                    }   
	                    else{
	                        $this->db->insert('performance_template_section_column_fields', $insert);
	                        $action = 'insert';
	                    } 
				        //create system logs
				        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'performance_template_section_column_fields', $previous_main_data, $insert);
	                }
	            }
	        }

	        if( isset($_POST['item']) )
	        {
	            $items = $_POST['item'];
	            foreach( $items as $item_id => $item )
	            {
				//get previous data for audit logs
					$previous_main_data = $this->db->get_where('performance_template_section_column_item', array('item_id' => $item_id))->row_array();
	                $this->db->update('performance_template_section_column_item', array('item' => $item), array('item_id' => $item_id));
			        //create system logs
			        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_template_section_column_item', $previous_main_data, array('item' => $item));
	            }
	        }

	        $this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);
			$this->db->trans_commit();	
		}
		else{
			$this->db->trans_rollback();	
		}

		$this->_ajax_return();
	}

	function update_applicable()
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
		
		$options = $this->mod->_get_applicable_options( $this->input->post('applicable_to_id') ); 

		$this->response->options = "";
		foreach( $options as $value => $label )
		{
			$this->response->options .= '<option value="'.$value.'">'.$label.'</option>';
		}

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
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
		$template_id = $this->input->post('template_id');
		$vars['template_section_id'] = $section_id;
		$vars['template_id'] = $template_id;
		$vars['template_section'] = '';
		$vars['parent_id'] = '';
		$vars['weight'] = '';
		$vars['library_id'] = '';
		$vars['is_core'] = 0;
		$vars['section_type_id'] = '';
		$vars['min_crowdsource'] = '';
		$vars['sequence'] = '';
		$vars['header'] = '';
		$vars['footer'] = '';

		if( !empty( $section_id ) )
		{
			$vars = $this->db->get_where('performance_template_section', array('template_section_id' => $section_id))->row_array();
		}
		
		$this->load->vars( $vars );

		$this->load->helper('form');
		$data['title'] = 'Add/Edit Section';
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
				'field'   => 'template_id',
				'label'   => 'Template',
				'rules'   => 'required'
			),
			array(
				'field'   => 'template_section',
				'label'   => 'Template Title',
				'rules'   => 'required'
			),
			array(
				'field'   => 'section_type_id',
				'label'   => 'Section Type',
				'rules'   => 'required'
			),
			array(
				'field'   => 'weight',
				'label'   => 'Weight',
				'rules'   => 'numeric'
			),
			array(
				'field'   => 'sequence',
				'label'   => 'Sequence',
				'rules'   => 'required|numeric'
			)
		);

		if ($this->input->post('section_type_id') == 3) {
			$config[] = array(
							'field'   => 'library_id',
							'label'   => 'Library of Competencies',
							'rules'   => 'required'
						);
		}

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
		unset($_POST['is_core-tmp']);
		
		$previous_main_data = array();
		if( empty( $template_section_id )  )
		{
			$this->db->insert('performance_template_section', $_POST);
			$action = 'insert';
		}
		else{
		//get previous data for audit logs
			$where_array = array('template_section_id' => $template_section_id);
			$previous_main_data = $this->db->get_where('performance_template_section', $where_array)->row_array();
			$this->db->update('performance_template_section', $_POST, $where_array);
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

		$sections = $this->mod->build_sections( $this->input->post('template_id') );

		$this->response->sections = $this->load->view('edit/sections', array('sections' => $sections ), true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	

	function get_column_form()
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

		$column_id = $this->input->post('column_id');
		$section_id = $this->input->post('section_id');

		$vars['section_column_id'] = $column_id;
		$vars['template_section_id'] = $section_id;
		$vars['title'] = '';
		$vars['uitype_id'] = '';
		$vars['sequence'] = '';
		$vars['width'] = '';
		$vars['rating_group_id'] = '';
		$vars['min_items'] = '';
		$vars['max_items'] = '';
		$vars['min_weight'] = '';

		if( !empty( $column_id ) )
		{
			$vars = $this->db->get_where('performance_template_section_column', array('section_column_id' => $column_id))->row_array();
		}
		
		$this->load->vars( $vars );

		$this->load->helper('form');
		$data['title'] = 'Add/Edit Column';
		$data['content'] = $this->load->blade('edit.sections.column_form')->with( $this->load->get_cached_vars() );

		$this->response->column_form = $this->load->view('templates/modal', $data, true);

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();	
	}

	function save_column()
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
				'field'   => 'title',
				'label'   => 'Title',
				'rules'   => 'required'
			),
			array(
				'field'   => 'sequence',
				'label'   => 'Sequence',
				'rules'   => 'required|numeric'
			),
			array(
				'field'   => 'width',
				'label'   => 'Width',
				'rules'   => 'required|numeric'
			),
			array(
				'field'   => 'uitype_id',
				'label'   => 'UIType',
				'rules'   => 'required'
			)
		);

		if( $this->input->post('uitype_id') == 5 )
		{
			$config[] = array(
			'field'   => 'rating_group_id',
			'label'   => 'Rating',
			'rules'   => 'required'
			);	
		}

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

		$section_column_id = $this->input->post('section_column_id');
		unset( $_POST['section_column_id'] );
		$previous_main_data = array();
		if( empty( $section_column_id )  )
		{
			$this->db->insert('performance_template_section_column', $_POST);
			$action = 'insert';
		}
		else{
		//get previous data for audit logs
			$where_array = array('section_column_id' => $section_column_id);
			$previous_main_data = $this->db->get_where('performance_template_section_column', $where_array)->row_array();
			$this->db->update('performance_template_section_column', $_POST, $where_array);
			$action = 'update';
		}
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'performance_template_section_column', $previous_main_data, $_POST);

		$this->response->close_modal = true;		
		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function delete_column()
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

		$column_id = $this->input->post('column_id');
		$this->db->update('performance_template_section_column', array('deleted' => 1), array('section_column_id' => $column_id));
		//create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', 'performance_template_section_column - section_column_id', array(), array('section_column_id' => $column_id));
		
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

		$template_section_id = $this->input->post('section_id');
		$this->db->update('performance_template_section', array('deleted' => 1), array('template_section_id' => $template_section_id));
		//create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', 'performance_template_section - template_section_id', array(), array('template_section_id' => $template_section_id));

		$this->response->message[] = array(
			'message' => '',
			'type' => 'success'
		);

		$this->_ajax_return();
	}

	function get_item_form()
    {
        $this->_ajax_only();

        $vars = $_POST;
        $vars['sequence'] = '';
        $vars['item'] = '';
        $vars['tripart'] = '';

        if( !empty( $vars['item_id'] ) )
        {
            $this->db->limit(1);
            $vars = $this->db->get_where('performance_template_section_column_item', array('item_id' => $vars['item_id']))->row_array();
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

        $config = array(
            array(
                'field'   => 'item',
                'label'   => 'Item',
                'rules'   => 'required'
            )
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

        $item_id = $this->input->post('item_id');
        unset( $_POST['item_id'] );
		$previous_main_data = array();
		if( empty( $item_id )  )
		{
			$this->db->insert('performance_template_section_column_item', $_POST);
			$action = 'insert';
		}
		else{
		//get previous data for audit logs
			$where_array = array('item_id' => $item_id);
			$previous_main_data = $this->db->get_where('performance_template_section_column_item', $where_array)->row_array();
			$this->db->update('performance_template_section_column_item', $_POST, $where_array);
			$action = 'update';
		}
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, $action, 'performance_template_section_column_item', $previous_main_data, $_POST);

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
    }

    function get_section_items()
    {
        $this->_ajax_only();
        
        $this->response->items = $this->load->view('edit/section_items', $_POST, true);

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
        
        $this->db->delete('performance_template_section_column_item', array('item_id' => $this->input->post('item_id')));
		//create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'delete', 'performance_template_section_column_item - item_id', array(), array('item_id' => $this->input->post('item_id')));
        
        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();  
    }

    function _list_options_active( $record, &$rec )
	{

		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			$rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-search"></i>' .lang('common.view').'</a></li>';
		}
				
		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
			$rec['options'] .= '<li><a href="javascript: copy_record('.$record['record_id'].')"><i class="fa fa-copy"></i> Duplicate</a></li>';
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] )
		{
			$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
			$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
		}
	}

	function duplicate()
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

		$to_copy = $this->input->post('record_id');

		$this->db->limit(1);
		$template = $this->db->get_where('performance_template', array('template_id' => $to_copy))->row_array();
		$template['template'] = $this->input->post('title');
		$template['created_by'] == $this->user->user_id;
		unset($template['template_id']);
		unset($template['template_code']);
		unset($template['created_on']);
		unset($template['modified_by']);
		unset($template['modified_on']);

		$this->db->insert('performance_template', $template);
		$this->response->record_id = $template_id = $this->db->insert_id();
        //create system logs
        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_template', array(), $template);

		//get parent sections
		$sections = $this->db->get_where('performance_template_section', array('template_id' => $to_copy, 'deleted' => 0) );
		$parent_section_id = 0;
		foreach( $sections->result() as $section )
		{
			$copy_section_id = $section->template_section_id;
			$section->template_id = $template_id;

			unset( $section->template_section_id );
			unset( $section->created_on );

			if ($section->parent_id == 0) {
				$this->db->insert('performance_template_section', $section);
				$section_id = $this->db->insert_id();
				$parent_section_id = $section_id;				
			} else {
				$section->parent_id = $parent_section_id;
				$this->db->insert('performance_template_section', $section);
				$section_id = $this->db->insert_id();						
			}

	        //create system logs
	        $this->mod->audit_logs( $this->user->user_id, $this->mod->mod_code, 'insert', 'performance_template_section', array(), (array)$section );

			//get columns
			$this->db->order_by('sequence');
			$columns = $this->db->get_where('performance_template_section_column', array('template_section_id' => $copy_section_id, 'deleted' => 0));
			$old_items = array();
			foreach($columns->result() as $column)
			{
				$copy_column_id = $column->section_column_id;
				$column->template_section_id = $section_id;
				unset($column->section_column_id);
				$this->db->insert('performance_template_section_column', $column);
				$column_id = $this->db->insert_id();
				//create system logs
		        $this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_template_section_column', array(), (array)$column);
			}
		}

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return(); 
	}

    function preview_template($template_id)
    {
        // parent::edit('', true);
        $vars['record_id'] = $template_id;
        $vars['template'] = $this->mod; 
        // $vars[]
        // $vars['appraisee'] = $this->mod->get_appraisee( $this->record_id, $user_id );

        // $vars['manager_id'] = $manager_id; 

        // $this->load->model('appraisal_template_model', 'template');
        // $vars['template'] = $this->template; 

        $this->load->vars( $vars );

        $this->load->helper('form');
        $this->load->helper('file');
        echo $this->load->blade('pages.preview')->with( $this->load->get_cached_vars() );  
    }

    function get_section_items_preview()
    {
        $this->_ajax_only();
        
        $this->response->items = $this->load->view('preview/section_items', $_POST, true);

        $this->response->section_id = $_POST['section_id'];
        $this->response->close_modal = true;

        $this->response->message[] = array(
            'message' => '',
            'type' => 'success'
        );

        $this->_ajax_return();      
    }
}