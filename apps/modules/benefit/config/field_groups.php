<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][3] = array(
	'fg_id' => 3,
	'label' => 'Basic Information',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'users_benefit.benefit_type',
		'users_benefit.company_id',
		'users_benefit.job_grade_id',
		'users_benefit.old_new',
		'users_benefit.description',
		'users_benefit.status_id'
	)
);
