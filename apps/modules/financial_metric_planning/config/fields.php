<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][3]['performance_financial_metric_planning.key_in_weight'] = array(
	'f_id' => 7,
	'fg_id' => 3,
	'label' => 'Key in Weight',
	'description' => '',
	'table' => 'performance_financial_metric_planning',
	'column' => 'key_in_weight',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['performance_financial_metric_planning.user_ids'] = array(
	'f_id' => 5,
	'fg_id' => 3,
	'label' => 'Employees',
	'description' => '',
	'table' => 'performance_financial_metric_planning',
	'column' => 'user_ids',
	'uitype_id' => 10,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'users',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'full_name',
		'value' => 'user_id',
		'textual_value_column' => ''
	)
);
$config['fields'][3]['performance_financial_metric_planning.financial_metric_kpi_ids'] = array(
	'f_id' => 6,
	'fg_id' => 3,
	'label' => 'Financial Metric KPI',
	'description' => '',
	'table' => 'performance_financial_metric_planning',
	'column' => 'financial_metric_kpi_ids',
	'uitype_id' => 10,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'performance_setup_financial_metrics_kpi',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'financial_metrics_kpi',
		'value' => 'financial_metrics_kpi_id',
		'textual_value_column' => ''
	)
);
$config['fields'][3]['performance_financial_metric_planning.planning_id'] = array(
	'f_id' => 1,
	'fg_id' => 3,
	'label' => 'Performance Planning',
	'description' => '',
	'table' => 'performance_financial_metric_planning',
	'column' => 'planning_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'performance_planning',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'notes',
		'value' => 'planning_id',
		'textual_value_column' => ''
	)
);