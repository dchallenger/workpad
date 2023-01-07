<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sbu_unit extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('sbu_unit_model', 'mod');
		$this->load->dbforge();
		parent::__construct();
		$this->lang->load('sbu_unit');
	}

	function save($child_call = false) {
		parent::save( true );
		
		if( $this->response->saved ) {
			$sbu = $_POST['users_sbu_unit']['sbu_unit'];
			$column_name = str_replace(' ', '_', strtolower($sbu));
			if (!$this->db->field_exists($column_name, 'performance_manpower_allocation_fix_column')) {
				$qry = "ALTER TABLE {$this->db->dbprefix}performance_manpower_allocation_fix_column
				ADD COLUMN $column_name varchar(100) NOT NULL AFTER `user_id`";

				$result = $this->db->query($qry);
			}

			$this->response->message[] = array(
				'message' => lang('common.save_success'),
				'type' => 'success'
			);	
		}

		$this->_ajax_return();
	}
}