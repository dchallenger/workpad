<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][4] = array(
	'fg_id' => 4,
	'label' => 'Training Request',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'training_application.training_calendar_id',
		'training_application.training_type',
		'training_application.date_from',
		'training_application.date_to',
		'training_application.training_course_id',
		'training_application.training_provider',
		'training_application.include_idp',
		'training_application.venue',
		'training_application.total_training_hour',
		'training_application.total_investment_pgsa',
		'training_application.areas_development',
		'training_application.competency',
		'training_application.note',
		'training_application.attachment'
	)
);
