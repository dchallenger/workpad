<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['performance_setup_financial_metrics_kpi.financial_metrics_kpi'][] = array(
	'field'   => 'performance_setup_financial_metrics_kpi[financial_metrics_kpi]',
	'label'   => 'Key Performance Indicators',
	'rules'   => 'required'
);
