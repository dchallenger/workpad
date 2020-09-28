<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['time_form_balance_fcc_setup.form_id'][] = array(
	'field'   => 'time_form_balance_fcc_setup[form_id]',
	'label'   => 'Leave Type',
	'rules'   => 'required'
);
$config['field_validations']['time_form_balance_fcc_setup.description'][] = array(
	'field'   => 'time_form_balance_fcc_setup[description]',
	'label'   => 'Description',
	'rules'   => 'required'
);
