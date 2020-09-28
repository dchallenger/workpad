<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave_fcc_setup extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('leave_fcc_setup_model', 'mod');
		parent::__construct();
		$this->lang->load( 'leave_fcc_setup' );
	}
}