<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Financial_metrics_kpi extends MY_PrivateController
{
	public function __construct()
	{
		$this->load->model('financial_metrics_kpi_model', 'mod');
		parent::__construct();
	}
}