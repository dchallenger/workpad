<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][3] = array(
	'fg_id' => 3,
	'label' => 'Financial Metric Info',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'performance_financial_metric_planning.planning_id',
		'performance_financial_metric_planning.user_ids',
		'performance_financial_metric_planning.financial_metric_kpi_ids',
		'performance_financial_metric_planning.key_in_weight'
	)
);
$config['fieldgroups'][4] = array(
	'fg_id' => 4,
	'label' => 'Financial Metric Details',
	'description' => '',
	'display_id' => 3,
	'sequence' => 2,
	'active' => 1,
	'fields' => array(	)
);
