<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manpower_allocation extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('manpower_allocation_model', 'mod');
		$this->load->model('sbu_unit_model', 'sbu_unit_mod');
		parent::__construct();
	}

	public function index()
	{
		if( !$this->permission['list'] )
		{
			echo $this->load->blade('pages.insufficient_permission')->with( $this->load->get_cached_vars() );
			die();
		}

		$data['columns'] = $this->mod->get_dynamic_column();
		$column_count = count($data['columns']);
		$data['column_width'] = number_format(85 / $column_count, 2, '.', '');;

		$this->load->vars( $data );

		echo $this->load->blade('pages.listing')->with( $this->load->get_cached_vars() );
	}

	function save($child_call = false) {
		$arr_allocation =  json_decode($this->input->post('allocation'),true);
		$sbu_unit_arr = $this->sbu_unit_mod->gen_sbu_unit_arr();

		$this->response->message[] = array(
            'message' => 'Records was successfully saved.',
            'type' => 'success'
        );

		// to reset values of all sbu to 0 to update if no value from API
        $column_list = $this->mod->get_dynamic_column();
		$column_list = array_fill_keys(array_keys($column_list), '');
		$this->db->where('archive',0);
		$this->db->update('performance_manpower_allocation_fix_column',$column_list);
		// to reset values of all sbu to 0 to update if no value from API

		if (count($arr_allocation) > 0 ) {
			$arr_checking = [];
			foreach ($arr_allocation as $key => $arr_val) {
				if (!in_array($arr_val['sbu'],$sbu_unit_arr)) {
					if (!in_array($arr_val['sbu'],$arr_checking)) {
						array_push($arr_checking,$arr_val['sbu']);
						$this->response->message[] = array(
				            'message' => 'There SBU unit ('.$arr_val['sbu'].') not yet added on master file',
				            'type' => 'warning'
				        );
					}
				} else {
					$resul = $this->mod->add_manpower_allocation($arr_val);
				}
			}
		}

		$this->response->date_processed = '';

		$this->db->where('archive',0);
		$result = $this->db->get('performance_manpower_allocation_fix_column');
		if ($result && $result->num_rows() > 0) {
			$date = $result->row()->date_processed;
			$this->response->date_processed = 'As of ' . date('M d, Y - g:i a',strtotime($date));
		}

		$this->_ajax_return();
	}

	public function get_list() {
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

	private function _process_lists( $records, $trash ) {
		$column = $this->mod->get_dynamic_column();

		$this->response->records_retrieve = sizeof($records);
		$this->response->list = '';

		foreach( $records as $record )
		{
			$total = 0;
			$this->response->list .= '<tr class="record">';
			$this->response->list .= '<td class="hidden-xs">'.$record['full_name'].'</td>';
			foreach($column as $key => $val) {
				if ($key != 'total' && $record[$key] != '')
					$total += $record[$key];

				if ($key != 'total')
					$this->response->list .= '<td class="hidden-xs">'.$record[$key].'</td>';
			}
			$this->response->list .= '<td class="hidden-xs">'.$total.'</td>';
			$this->response->list .= '</tr>';
		}
	}

	private function _get_list( $trash ) {
		$page = $this->input->post('page');
		$search = $this->input->post('search');
		$filter = "";
		
		$filter_by = $this->input->post('filter_by');
		$filter_value = $this->input->post('filter_value');
		
		if( is_array( $filter_by ) )
		{
			foreach( $filter_by as $filter_by_key => $filter_value )
			{
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

	function get_date_processed() {
		$this->response->date_processed = '';

		$this->db->where('archive',0);
		$result = $this->db->get('performance_manpower_allocation_fix_column');
		if ($result && $result->num_rows() > 0) {
			$date = $result->row()->date_processed;
			$this->response->date_processed = 'As of ' . date('M d, Y - g:i a',strtotime($date));
		}

		$this->_ajax_return();
	}
}