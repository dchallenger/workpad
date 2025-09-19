<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_compensation.compensation'][] = array(
	'field'   => 'users_compensation[compensation]',
	'label'   => 'Compensation',
	'rules'   => 'required'
);
