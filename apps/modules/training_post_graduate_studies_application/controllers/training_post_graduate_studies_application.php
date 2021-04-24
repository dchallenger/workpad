<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Training_post_graduate_studies_application extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('training_post_graduate_studies_application_model', 'mod');
		parent::__construct();
	}
}