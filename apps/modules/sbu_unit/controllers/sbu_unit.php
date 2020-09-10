<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sbu_unit extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('sbu_unit_model', 'mod');
		parent::__construct();
		$this->lang->load('sbu_unit');
	}
}