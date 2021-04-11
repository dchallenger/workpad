<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class School extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('school_model', 'mod');
		parent::__construct();
	}
}