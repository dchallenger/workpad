<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][4] = array(
	'fg_id' => 4,
	'label' => 'External Program Application Form',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'training_application.user_id',
		'training_application.training_type',
		'training_application.date_from',
		'training_application.date_to',
		'training_application.training_course_id',
		'training_application.training_provider',
		'training_application.venue',
		'training_application.total_training_hour',
		'training_application.total_investment_pgsa',
		'training_application.areas_development',
		'training_application.competency',
		'training_application.note',
		'training_application.remaining_itb',
		'training_application.excess_itb',
		'training_application.allocated'
	)
);
$config['fieldgroups'][5] = array(
	'fg_id' => 5,
	'label' => 'Training Objectives',
	'description' => '',
	'display_id' => 3,
	'sequence' => 2,
	'active' => 1,
	'fields' => array(	)
);
$config['fieldgroups'][6] = array(
	'fg_id' => 6,
	'label' => 'Available Training Budget (HRA Use Only)',
	'description' => '',
	'display_id' => 3,
	'sequence' => 3,
	'active' => 1,
	'fields' => array(
		'training_application.service_bond',
		'training_application.stb',
		'training_application.investment',
		'training_application.remaining_stb',
		'training_application.itb',
		'training_application.excess_stb',
		'training_application.budgeted',
		'training_application.ctb',
		'training_application.remaining_ctb',
		'training_application.idp_completion',
		'training_application.excess_ctb',
		'training_application.approver_remarks',
		'training_application.remarks'
	)
);
