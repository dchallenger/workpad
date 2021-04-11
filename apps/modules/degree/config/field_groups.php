<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][1] = array(
	'fg_id' => 1,
	'label' => 'Degree Information',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'users_education_degree_obtained.education_degree_obtained',
		'users_education_degree_obtained.status_id'
	)
);
