<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( !class_exists('Record') )
{
	require __DIR__ . '/record.php';
}

class financial_metric_planning_model extends Record
{
	var $mod_id;
	var $mod_code;
	var $route;
	var $url;
	var $primary_key;
	var $table;
	var $icon;
	var $short_name;
	var $long_name;
	var $description;
	var $path;

	public function __construct()
	{
		$this->mod_id = 274;
		$this->mod_code = 'financial_metric_planning';
		$this->route = 'appraisal/financial_metric_planning';
		$this->url = site_url('appraisal/financial_metric_planning');
		$this->primary_key = 'financial_metric_planning_id';
		$this->table = 'performance_financial_metric_planning';
		$this->icon = 'fa-folder';
		$this->short_name = 'Financial Metric Planning';
		$this->long_name  = 'Financial Metric Planning';
		$this->description = '';
		$this->path = APPPATH . 'modules/financial_metric_planning/';
		$this->load->model('manpower_allocation_model');
		parent::__construct();
	}

	public function get_financial_metric_planning_details($financial_metric_planning_details_id)
	{
		$this->db->where('financial_metric_planning_id',$financial_metric_planning_details_id);
		$result = $this->db->get('performance_financial_metric_planning_details');
		return $result;
	}

	function _get_list($start, $limit, $search, $filter, $trash = false)
	{
		$data = array();				
		
		$qry = $this->_get_list_cached_query();
		
		if( $trash )
		{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 1";
		}
		else{
			$qry .= " AND {$this->db->dbprefix}{$this->table}.deleted = 0";	
		}
		
		$qry .= ' '. $filter;

		$qry .= " GROUP BY {$this->db->dbprefix}performance_financial_metric_planning.financial_metric_planning_id";

		$qry .= " LIMIT $limit OFFSET $start";

		$this->load->library('parser');
		$this->parser->set_delimiters('{$', '}');
		$qry = $this->parser->parse_string($qry, array('search' => $search), TRUE);

		$result = $this->db->query( $qry );
		if($result->num_rows() > 0)
		{			
			foreach($result->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}

	public function get_financial_metric_planning($financial_metric_planning_id = 0)
	{
		$qry = "select *
		FROM {$this->db->dbprefix}performance_financial_metric_planning a
		LEFT JOIN {$this->db->dbprefix}users_sbu_unit b on b.sbu_unit_id = a.sbu_unit_id";
		$qry .= " WHERE a.deleted = 0 AND b.deleted = 0";

		if ($financial_metric_planning_id)
			$qry .= " AND financial_metric_planning_id = {$financial_metric_planning_id}";
				
		$qry .= " ORDER BY b.order_by";

		$fmp = $this->db->query( $qry );

		return $fmp;
	}

	public function get_allocation($user_id) {
		$allocation_qry = "select *
		FROM {$this->db->dbprefix}performance_manpower_allocation_fix_column maf
		where maf.deleted = 0
		AND archive = 0
		AND user_id = {$user_id}";

		$allocation_result = $this->db->query( $allocation_qry );
		$valid_column = $this->manpower_allocation_model->get_dynamic_column();

		$allocation_column_w_val = array();
		$allocation_column = array();
		$allocation_columns = '';
		if ($allocation_result && $allocation_result->num_rows() > 0) {
			$allocation = $allocation_result->row_array();

			foreach($valid_column as $col => $col_val) {
				if ($allocation[$col] != '') {
					$allocation_column_w_val[$col] = $allocation[$col];
					array_push($allocation_column,$col);
					$allocation_columns = "('" . implode("','", $allocation_column) . "')";
				}
			}
		}		

		return $allocation_columns;
	}

	// get sbu to be use as column from the allocation from api
	public function get_allocation_arr($user_id) {
		$allocation_qry = "select *
		FROM {$this->db->dbprefix}performance_manpower_allocation_fix_column maf
		where maf.deleted = 0
		AND archive = 0
		AND user_id = {$user_id}";

		$allocation_result = $this->db->query( $allocation_qry );
		$valid_column = $this->manpower_allocation_model->get_dynamic_column();

		$allocation_column_w_val = array();
		$allocation_column = array();
		if ($allocation_result && $allocation_result->num_rows() > 0) {
			$allocation = $allocation_result->row_array();

			foreach($valid_column as $col => $col_val) {
				if ($allocation[$col] != '') {
					$allocation_column_w_val[$col] = $allocation[$col];
					array_push($allocation_column,$col);
				}
			}
		}		

		return $allocation_column;
	}


	public function get_financial_metric_planning_finance_array($user_id)
	{
		$allocation_columns = $this->get_allocation($user_id);

		$qry = "select *
		FROM {$this->db->dbprefix}performance_financial_metric_planning a
		LEFT JOIN {$this->db->dbprefix}users_sbu_unit b on b.sbu_unit_id = a.sbu_unit_id
		WHERE a.deleted = 0 AND b.deleted = 0
		AND b.manpower_allocation_column_name IN {$allocation_columns}
		ORDER BY b.order_by";

		$fmp = $this->db->query( $qry );

		$fmp_arr = array();
		$fmpi_arr = array();
		if ($fmp && $fmp->num_rows() > 0) {
			foreach($fmp->result() as $row) {
				$fmp_details = $this->get_financial_metric_planning_details($row->financial_metric_planning_id);
				if ($fmp_details && $fmp_details->num_rows() > 0) {
					$fmp_arr[$row->sbu_unit] = $fmp_details->result_array();
					$fmpi_arr[$row->sbu_unit] = $row->key_in_weight;
				}
			}
		}

		$details_fmp = ['fmpi_details_arr' => $fmp_arr, 'fmpd_details_arr' => $fmpi_arr];

		return $details_fmp;
	}

	public function get_financial_metric_planning_array($user_id)
	{
		$allocation_columns = $this->get_allocation_arr($user_id);

		$qry = "select *
		FROM {$this->db->dbprefix}performance_financial_metric_planning_details a
		WHERE a.deleted = 0";

		$fmpd_details = $this->db->query( $qry );

		$fmp_details_arr = array();
		$column = array();
		$fmpi_arr = array();
		if ($fmpd_details && $fmpd_details->num_rows() > 0) {
			foreach($fmpd_details->result() as $row) {
				$fmp_details = $this->get_financial_metric_planning($row->financial_metric_planning_id);
				if ($fmp_details && $fmp_details->num_rows() > 0) {
					$details = $fmp_details->row();
					if (in_array($details->manpower_allocation_column_name,$allocation_columns)) {
						$fmp_details_arr[$row->financial_metric_kpi][$details->sbu_unit] = $row;
						$fmpi_arr[$details->sbu_unit] = $details->key_in_weight;

						if (!in_array($details->sbu_unit,$column))
							$column[$details->manpower_allocation_column_name] = $details->sbu_unit;
					}
				}
			}
		}
		
		$details_and_columns = ['fmp_details_arr' => $fmp_details_arr, 'columns_arr' => $column, 'fmpi_arr' => $fmpi_arr];

		return $details_and_columns;
	}

	public function get_all_financial_metric_planning_array()
	{
		$qry = "select *
		FROM {$this->db->dbprefix}performance_financial_metric_planning_details a
		WHERE a.deleted = 0";

		$fmpd_details = $this->db->query( $qry );

		$fmp_details_arr = array();
		$column = array();
		$fmpi_arr = array();
		if ($fmpd_details && $fmpd_details->num_rows() > 0) {
			foreach($fmpd_details->result() as $row) {
				$fmp_details = $this->get_financial_metric_planning($row->financial_metric_planning_id);
				if ($fmp_details && $fmp_details->num_rows() > 0) {
					$details = $fmp_details->row();
					$fmp_details_arr[$row->financial_metric_kpi][$details->sbu_unit] = $row;
					$fmpi_arr[$details->sbu_unit] = $details->key_in_weight;

					if (!in_array($details->sbu_unit,$column))
						$column[$details->manpower_allocation_column_name] = $details->sbu_unit;
				}
			}
		}
		
		$details_and_columns = ['fmp_details_arr' => $fmp_details_arr, 'columns_arr' => $column, 'fmpi_arr' => $fmpi_arr];

		return $details_and_columns;
	}

	public function get_financial_metric_planning_finance_applicable_array($planning_id,$user_id)
	{
		$qry = "select *
		FROM {$this->db->dbprefix}performance_planning_applicable_financial_finance a
		WHERE a.deleted = 0
		AND a.planning_id = {$planning_id}
		AND a.user_id = {$user_id}";

		$fmp = $this->db->query( $qry );

		$fmp_arr = array();
		if ($fmp && $fmp->num_rows() > 0) {
			foreach($fmp->result_array() as $row) {
				$fmp_arr[$row['sbu']][] = $row;
			}
		}

		return $fmp_arr;
	}

	public function get_financial_metric_planning_w_allocation($appraisal_id, $user_id)
	{
		$fmp_details_arr = [];
		$user_appraisal_status = 0;

		$this->db->where('user_id',$user_id);
		$this->db->where('appraisal_id',$appraisal_id);
		$result_user_appraisal_info = $this->db->get('performance_appraisal_applicable');

		if ($result_user_appraisal_info && $result_user_appraisal_info->num_rows() > 0) {
			$user_appraisal_status = $result_user_appraisal_info->row()->status_id;
		}

		if ($user_appraisal_status > 3) {
			$this->db->select('*,target as value');
			$this->db->where('user_id',$user_id);
			$this->db->where('appraisal_id',$appraisal_id);
			$result_user_financial_target = $this->db->get('performance_appraisal_applicable_financial');
			if ($result_user_financial_target && $result_user_financial_target->num_rows() > 0) {
				foreach($result_user_financial_target->result() as $row) {
					$fmp_details_arr[] = $row;
				}
			}
		} else {
			$allocation_columns = $this->get_allocation_arr($user_id);
			$allocation = $this->get_financial_metric_allocation($user_id);

			$qry = "SELECT 
						usu.sbu_unit,
						manpower_allocation_column_name,
						financial_metric_kpi,weight,
						value,
						rating_comp,
						actual,
						rating,
						weighted_rating
					FROM `ww_performance_financial_metric_planning` pfmp
					LEFT JOIN `ww_performance_financial_metric_planning_details` pfmpd 
						ON pfmp.`financial_metric_planning_id` = pfmpd.`financial_metric_planning_id`
					LEFT JOIN `ww_users_sbu_unit` usu 
						ON pfmp.sbu_unit_id = usu.sbu_unit_id
					WHERE pfmp.deleted = 0
					ORDER BY usu.order_by";

			$fmpd_details = $this->db->query( $qry );

			if ($fmpd_details && $fmpd_details->num_rows() > 0) {
				foreach($fmpd_details->result() as $row) {
					if (in_array($row->manpower_allocation_column_name,$allocation_columns)) {
						$row->allocation = $allocation[$row->manpower_allocation_column_name];
						$fmp_details_arr[] = $row;
					}
				}
			}
		}

		return $fmp_details_arr;
	}

	public function get_financial_metric_allocation($user_id) {
		$allocation_qry = "select *
		FROM {$this->db->dbprefix}performance_manpower_allocation_fix_column maf
		where maf.deleted = 0
		AND archive = 0
		AND user_id = {$user_id}";

		$allocation = [];
		$allocation_result = $this->db->query( $allocation_qry );
		if ($allocation_result && $allocation_result->num_rows() > 0) {
			$allocation = $allocation_result->row_array();
		}		

		return $allocation;
	}
}