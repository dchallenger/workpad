<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][2] = array(
	'fg_id' => 2,
	'label' => 'Roles Information',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'roles.role',
		'roles.profile_id',
		'roles.description',
		'roles.company_id',
		'roles.branch_id'
	)
);
