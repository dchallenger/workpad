<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['users_sbu_unit.status_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Active',
	'description' => '',
	'table' => 'users_sbu_unit',
	'column' => 'status_id',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 0,
	'datatype' => 'V',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['users_sbu_unit.sbu_unit'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'SBU Unit',
	'description' => '',
	'table' => 'users_sbu_unit',
	'column' => 'sbu_unit',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'V',
	'active' => '1',
	'encrypt' => 0
);
