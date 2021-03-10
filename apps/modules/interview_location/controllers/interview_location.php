<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Interview_location extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('interview_location_model', 'mod');
		parent::__construct();
	}
}