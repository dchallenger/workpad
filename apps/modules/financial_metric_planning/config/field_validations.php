<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['performance_financial_metric_planning.key_in_weight'][] = array(
	'field'   => 'performance_financial_metric_planning[key_in_weight]',
	'label'   => 'Key in Weight',
	'rules'   => 'required'
);
/*$config['field_validations']['performance_financial_metric_planning.user_ids'][] = array(
	'field'   => 'performance_financial_metric_planning[user_ids]',
	'label'   => 'Employees',
	'rules'   => 'required'
);*/
$config['field_validations']['performance_financial_metric_planning.sbu_unit_id'][] = array(
	'field'   => 'performance_financial_metric_planning[sbu_unit_id]',
	'label'   => 'Financial Metrics Title',
	'rules'   => 'required'
);
$config['field_validations']['performance_financial_metric_planning.title'][] = array(
	'field'   => 'performance_financial_metric_planning[title]',
	'label'   => 'Financial Metrics Title',
	'rules'   => 'required'
);
