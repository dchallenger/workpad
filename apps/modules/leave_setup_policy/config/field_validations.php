<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['time_form_balance_setup_policy.description'][] = array(
	'field'   => 'time_form_balance_setup_policy[description]',
	'label'   => 'Description',
	'rules'   => 'required'
);
$config['field_validations']['time_form_balance_setup_policy.form_id'][] = array(
	'field'   => 'time_form_balance_setup_policy[form_id]',
	'label'   => 'Leave Type',
	'rules'   => 'required'
);
$config['field_validations']['time_form_balance_setup_policy.accumulation_type'][] = array(
	'field'   => 'time_form_balance_setup_policy[accumulation_type]',
	'label'   => 'Accumulation Type',
	'rules'   => 'required'
);
$config['field_validations']['time_form_balance_setup_policy.credit'][] = array(
	'field'   => 'time_form_balance_setup_policy[credit]',
	'label'   => ' Credit',
	'rules'   => 'required'
);