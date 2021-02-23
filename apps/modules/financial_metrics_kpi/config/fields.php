<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['performance_setup_financial_metrics_kpi.status_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Is Active',
	'description' => 'Is Active',
	'table' => 'performance_setup_financial_metrics_kpi',
	'column' => 'status_id',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['performance_setup_financial_metrics_kpi.financial_metrics_kpi'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Key Performance Indicators',
	'description' => '',
	'table' => 'performance_setup_financial_metrics_kpi',
	'column' => 'financial_metrics_kpi',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
