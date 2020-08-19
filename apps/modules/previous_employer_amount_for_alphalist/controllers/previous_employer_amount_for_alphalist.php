<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Previous_employer_amount_for_alphalist extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('previous_employer_amount_for_alphalist_model', 'mod');
		parent::__construct();
		$this->lang->load( 'payroll_previous_employer_alphalist' );
	}
}