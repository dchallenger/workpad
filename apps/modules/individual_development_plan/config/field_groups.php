<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][1] = array(
	'fg_id' => 1,
	'label' => 'Employee Details',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'performance_appraisal_idp.user_id'
	)
);
$config['fieldgroups'][2] = array(
	'fg_id' => 2,
	'label' => 'Individual Development Plan',
	'description' => '',
	'display_id' => 3,
	'sequence' => 2,
	'active' => 1,
	'fields' => array(	)
);
$config['fieldgroups'][3] = array(
	'fg_id' => 3,
	'label' => 'Development Budget for the Year (HRA Use Only)',
	'description' => '',
	'display_id' => 3,
	'sequence' => 3,
	'active' => 1,
	'fields' => array(
		'performance_appraisal_idp.itb',
		'performance_appraisal_idp.ctb',
		'performance_appraisal_idp.stb',
		'performance_appraisal_idp.total_budget'		
	)
);
$config['fieldgroups'][4] = array(
	'fg_id' => 4,
	'label' => 'IDP Commitment for the Year (HRA Use Only)',
	'description' => '',
	'display_id' => 3,
	'sequence' => 4,
	'active' => 1,
	'fields' => array(
		'performance_appraisal_idp.idp_completed_planned',
		'performance_appraisal_idp.idp_committed'
	)
);
