<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_sbu_unit.status_id'][] = array(
	'field'   => 'users_sbu_unit[status_id]',
	'label'   => 'Active',
	'rules'   => 'V'
);
$config['field_validations']['users_sbu_unit.sbu_unit'][] = array(
	'field'   => 'users_sbu_unit[sbu_unit]',
	'label'   => 'SBU Unit',
	'rules'   => 'V'
);
