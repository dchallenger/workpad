<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_division.company_id'][] = array(
	'field'   => 'users_division[company_id]',
	'label'   => 'Company',
	'rules'   => 'required'
);
$config['field_validations']['users_division.division'][] = array(
	'field'   => 'users_division[division]',
	'label'   => 'Division',
	'rules'   => 'required'
);
$config['field_validations']['users_division.division_code'][] = array(
	'field'   => 'users_division[division_code]',
	'label'   => 'Division Code',
	'rules'   => 'required'
);
$config['field_validations']['users_division.immediate_id'][] = array(
	'field'   => 'users_division[immediate_id]',
	'label'   => 'Division Head',
	'rules'   => 'required'	
);
$config['field_validations']['users_division.position'][] = array(
	'field'   => 'users_division[position]',
	'label'   => 'Immediate Position',
	'rules'   => 'V'
);
$config['field_validations']['users_division.status_id'][] = array(
	'field'   => 'users_division[status_id]',
	'label'   => 'Active',
	'rules'   => 'V'
);
$config['field_validations']['users_division.cost_center_code'][] = array(
	'field'   => 'users_division[cost_center_code]',
	'label'   => 'Cost Center Code',
	'rules'   => 'required'
);