<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['users_education_school.status_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Active',
	'description' => '',
	'table' => 'users_education_school',
	'column' => 'status_id',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['users_education_school.education_school'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'School',
	'description' => '',
	'table' => 'users_education_school',
	'column' => 'education_school',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
