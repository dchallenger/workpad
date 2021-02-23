<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Financial_metric_planning extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('financial_metric_planning_model', 'mod');
		$this->lang->load('financial_metric');
		parent::__construct();
	}

    public function index()
    {
        $permission = $this->config->item('permission');
        $vars['financial_metric_planning'] = isset($permission['financial_metric_planning']) ? $permission['financial_metric_planning'] : 0;        
        $vars['financial_metric_self_rating'] = isset($permission['financial_metric_self_rating']) ? $permission['financial_metric_self_rating'] : 0;
        $vars['financial_metric_coach_rating'] = isset($permission['financial_metric_coach_rating']) ? $permission['financial_metric_coach_rating'] : 0;
        $this->load->vars($vars);
        parent::index();
    }

	function save($child_call = false)
	{
		if (!isset($_POST['performance_financial_metric_planning']['user_ids']))
			$_POST['performance_financial_metric_planning']['user_ids'] = '';

		if (!isset($_POST['performance_financial_metric_planning']['financial_metric_kpi_ids']))
			$_POST['performance_financial_metric_planning']['financial_metric_kpi_ids'] = '';

		$w_error = 0;
		if (isset($_POST['performance_financial_metric_planning']['weight'])) {
			foreach ($_POST['performance_financial_metric_planning']['weight'] as $key => $value) {
				if ($value == '') {
		            $this->response->message[] = array(
		                'message' => 'The weight field is required',
		                'type' => 'error'
		            );
		            $w_error = 1;
				}
			}
		}

		if (isset($_POST['performance_financial_metric_planning']['target'])) {
			foreach ($_POST['performance_financial_metric_planning']['target'] as $key => $value) {
				if ($value == '') {
		            $this->response->message[] = array(
		                'message' => 'The target field is required',
		                'type' => 'error'
		            );
		            $w_error = 1;		            
				}
			}
		}

		if ($w_error)
			$this->_ajax_return();

		parent::save( true );
		
		if( $this->response->saved )
		{
			$financial_metric_planning_id = $this->record_id;

			$kpi_arr = $_POST['performance_financial_metric_planning']['kpi'];
			$weight_arr = $_POST['performance_financial_metric_planning']['weight'];
			$target_arr = $_POST['performance_financial_metric_planning']['target'];
			$financial_metric_planning_details_id_arr = (isset($_POST['performance_financial_metric_planning']['financial_metric_planning_details_id']) ? $_POST['performance_financial_metric_planning']['financial_metric_planning_details_id'] : []);

			if ($kpi_arr) {
				foreach( $kpi_arr as $index => $kpi )
				{
					$insert = array(
						'financial_metric_planning_id' => $financial_metric_planning_id,
						'financial_metric_kpi_id' => $kpi_arr[$index],
						'weight' => $weight_arr[$index],
						'value' => $target_arr[$index],
						'created_by' => $this->user->user_id
					);

					if (isset($financial_metric_planning_details_id_arr[$index])) {
						$this->db->where('deleted',0);
						$this->db->where('financial_metric_planning_details_id',$financial_metric_planning_details_id_arr[$index]);
						$details_result = $this->db->get('performance_financial_metric_planning_details');
						if ($details_result && $details_result->num_rows() > 0) {
							$details_kpi = $details_result->row();
							$this->db->where('financial_metric_planning_details_id',$details_kpi->financial_metric_planning_details_id);
							$this->db->update('performance_financial_metric_planning_details', $insert);

							$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'update', 'performance_financial_metric_planning_details', array(), $insert);
						}
					} else {
						$this->db->insert('performance_financial_metric_planning_details', $insert);
						$this->mod->audit_logs($this->user->user_id, $this->mod->mod_code, 'insert', 'performance_financial_metric_planning_details', array(), $insert);
					}

				}
			}

			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);			
		}

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

			$this->record = $data['record'];

			$data['financial_metric_planning_details'] = $this->mod->get_financial_metric_planning_details($this->record_id);

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

	public function add( $record_id = '', $child_call = false )
	{
		if( !$this->permission['add'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$this->_edit( $child_call, true );
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

			$data['financial_metric_planning_details'] = $this->mod->get_financial_metric_planning_details($this->record_id);

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
}