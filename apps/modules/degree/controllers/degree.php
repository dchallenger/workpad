<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Degree extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('degree_model', 'mod');
		parent::__construct();
	}
}