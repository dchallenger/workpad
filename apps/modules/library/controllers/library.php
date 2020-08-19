<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Library extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('library_model', 'mod');
		parent::__construct();
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

        $data['allow_library'] = isset($this->permission['list']) ? $this->permission['list'] : 0;
        $this->load->model('performance_notification_model', 'notif');
        $data['allow_notification'] = isset($permission[$this->notif->mod_code]['list']) ? $permission[$this->notif->mod_code]['list'] : 0;
        $this->load->model('performance_model', 'perform');
        $data['allow_performance'] = isset($permission[$this->perform->mod_code]['list']) ? $permission[$this->perform->mod_code]['list'] : 0;
        $this->load->model('rating_group_model', 'rate');
        $data['allow_rating_scale'] = isset($permission[$this->rate->mod_code]['list']) ? $permission[$this->rate->mod_code]['list'] : 0;
        $this->load->model('scorecard_model', 'score');
        $data['allow_scorecard'] = isset($permission[$this->score->mod_code]['list']) ? $permission[$this->score->mod_code]['list'] : 0;

        $this->load->vars($data);        
        echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
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

        $library_value = $_POST['library_value'];
        $library_value_description = $_POST['library_value_description'];

		unset( $_POST['library_value'] );
		unset( $_POST['library_value_description'] );

		$transactions = true;
		$this->db->trans_begin();
		$this->response = $this->mod->_save( $child_call );
		$error = false;

		if( $this->response->saved )
		{
			if ($library_value)
			{	
				foreach ($library_value as $key => $value) {
	            	$library_value_for_insert['library_id'] = $this->response->record_id;
	            	$library_value_for_insert['library_value'] = $value;
	            	$library_value_for_insert['library_value_description'] = $library_value_description[$key];

					$this->db->where($this->mod->primary_key,$this->response->record_id);
					$this->db->where('library_value_id',$key);
					$library_value_result = $this->db->get('performance_setup_library_value');

					if ($library_value_result && $library_value_result->num_rows() > 0) {
						$this->db->where($this->mod->primary_key,$this->response->record_id);
						$this->db->where('library_value_id',$key);
						$this->db->update('performance_setup_library_value', $library_value_for_insert);
					}
					else {
						$this->db->insert('performance_setup_library_value', $library_value_for_insert);
					}
				}
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

		$this->response->message[] = array(
			'message' => 'Successfully Save',
			'type' => 'success'
		);

		$this->_ajax_return();
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

			$this->record = $data['record'];

			$data['library_value'] = $this->mod->get_library_value($this->record_id);
			
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

	function delete()
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

		if( !$this->input->post('records') )
		{
			$this->response->message[] = array(
				'message' => lang('common.insufficient_data'),
				'type' => 'warning'
			);
			$this->_ajax_return();	
		}

		$records = $this->input->post('records');
		$records = explode(',', $records);

		$this->db->where_in($this->mod->primary_key, $records);
		$record = $this->db->get( $this->mod->table )->result_array();

		foreach($record as $rec){
			if($rec['can_delete'] == 1){
				$data['modified_on'] = date('Y-m-d H:i:s');
				$data['modified_by'] = $this->user->user_id;
				$data['deleted'] = 1;

				$this->db->where($this->mod->primary_key, $rec[$this->mod->primary_key]);
				$this->db->update($this->mod->table, $data);
				
				if( $this->db->_error_message() != "" ){
					$this->response->message[] = array(
						'message' => $this->db->_error_message(),
						'type' => 'error'
					);
				}
				else{
					$this->response->message[] = array(
						'message' => lang('common.delete_record', $this->db->affected_rows()),
						'type' => 'success'
					);
				}
			}else{
				$this->response->message[] = array(
					'message' => 'Record(s) cannot be deleted.',
					'type' => 'warning'
				);
			}
		}

		$this->_ajax_return();
	}
}