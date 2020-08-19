<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Audit_log extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('audit_log_model', 'mod');
		parent::__construct();
		$this->lang->load('audit_log');		
	}

}