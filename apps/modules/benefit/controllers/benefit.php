<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Benefit extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('benefit_model', 'mod');
		parent::__construct();
		$this->lang->load('employee_benefit');
	}
}