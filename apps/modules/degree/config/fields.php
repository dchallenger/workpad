<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['users_education_degree_obtained.status_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Active',
	'description' => '',
	'table' => 'users_education_degree_obtained',
	'column' => 'status_id',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['users_education_degree_obtained.education_degree_obtained'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Degree',
	'description' => '',
	'table' => 'users_education_degree_obtained',
	'column' => 'education_degree_obtained',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'V',
	'active' => '1',
	'encrypt' => 0
);
