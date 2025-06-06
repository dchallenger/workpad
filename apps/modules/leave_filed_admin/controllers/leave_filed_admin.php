<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave_filed_admin extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('leave_filed_admin_model', 'mod');
		parent::__construct();
	}

	public function index($form_id=0, $year='0000', $user_id='0')
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}
		
		$data['form_id'] = $form_id;
		$data['year'] = $year;
		$data['user_id'] = $user_id;
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
		$this->response->q = $this->db->last_query();
		$this->_process_lists( $records, $trash );

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

			if(!$trash)
				$this->_list_options_active( $record, $rec );
			else
				$this->_list_options_trash( $record, $rec );

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
			foreach( $filter_by as $filter_by_key => $filter_by_value )
			{
				if( $filter_value != "" ) $filter .= 'AND '. $filter_by_value .' = "'.$filter_value[$filter_by_key].'" ';	
			}
		}
		else{
			if( $filter_by && $filter_by != "" )
			{
				$filter = 'AND '. $filter_by .' = "'.$filter_value.'"';
			}
		}

		// echo "<pre>";
		// print_r($filter);

		// echo "<pre>";
		// print_r($filter_by);
		// print_r($filter_value);
		// print_r($filter_value);
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

	function _list_options_active( $record, &$rec )
	{
		//temp remove until view functionality added
		if( $this->permission['detail'] )
		{
			$rec['detail_url'] = $this->mod->url . '/detail/' . $record['record_id'];
			// $rec['options'] .= '<li><a href="'.$rec['detail_url'].'"><i class="fa fa-info"></i> View</a></li>';
		}

		if( isset( $this->permission['edit'] ) && $this->permission['edit'] )
		{
			$rec['edit_url'] = $this->mod->url . '/edit/' . $record['record_id'];
			$rec['quickedit_url'] = 'javascript:quick_edit( '. $record['record_id'] .' )';
		}	
		
		if( isset($this->permission['delete']) && $this->permission['delete'] )
		{
			$rec['delete_url'] = $this->mod->url . '/delete/' . $record['record_id'];
			$rec['options'] .= '<li><a href="javascript: delete_record('.$record['record_id'].')"><i class="fa fa-trash-o"></i> '.lang('common.delete').'</a></li>';
		}
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

	private function _detail( $child_call )
	{
		if( !$this->_set_record_id() )
		{
			echo $this->load->blade('pages.insufficient_data')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->record_id = $data['record_id'] = $_POST['record_id'];

		$this->load->model('form_application_model', 'formapp');
		$data['leave_balance'] = $this->formapp->get_leave_balance($this->user->user_id, date('Y'), 0);
 		
 		$upload_forms = $this->formapp->get_forms_upload($this->record_id);
        $all_uploaded = array();
        foreach( $upload_forms as $upload_form )
        {
            $all_uploaded[] = $upload_form['upload_id'];
        }
        $data['uploads'] = $all_uploaded;
        $data['approvers'] = $this->mod->getApprovers( $this->record_id );
        $data['selected_dates'] = $this->mod->getSelectedDates( $this->record_id );
		// echo "<pre>";print_r($data['approvers']);
		$record_check = $this->mod->_exists( $this->record_id );
		if( $record_check === true )
		{
			$result = $this->mod->_get( 'detail', $this->record_id );
			$data['record'] = $result->row_array();

	        $this->load->model('my_calendar_model', 'my_calendar');
	        if($data['record']['form_status_id'] > 2){
	            $data['approver_list'] = $this->my_calendar->get_time_forms_approvers($data['record_id']);
	            $data['approver_title'] = "Approval Status";
	        }else{
	            $data['approver_list'] = $this->my_calendar->call_sp_approvers(strtoupper($data['record']['form_code']), $this->user->user_id);
	            $data['approver_title'] = "Approver/s";
	        }
	        $data['approver_title'] = "Approver/s";
			$this->load->vars( $data );

			if( !$child_call ){
				if( !IS_AJAX )
				{
					echo $this->load->blade('pages.detail')->with( $this->load->get_cached_vars() );
				}
				else{
					$data['title'] = $this->mod->short_name .' - Detail';
					$data['content'] = $this->load->blade('pages.quick_detail')->with( $this->load->get_cached_vars() );

					$this->response->html = $this->load->view('templates/modal', $data, true);

					$this->response->message[] = array(
						'message' => '',
						'type' => 'success'
					);
					$this->_ajax_return();
				}
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