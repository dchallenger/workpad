<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['training_application.training_course_id'][] = array(
	'field'   => 'training_application[training_course_id]',
	'label'   => 'Training Course',
	'rules'   => 'required'
);
$config['field_validations']['training_application.date_to'][] = array(
	'field'   => 'training_application[date_to]',
	'label'   => 'Date of Program (To)',
	'rules'   => 'required'
);
$config['field_validations']['training_application.date_from'][] = array(
	'field'   => 'training_application[date_from]',
	'label'   => 'Date of Program (From)',
	'rules'   => 'required'
);
$config['field_validations']['training_application.training_type'][] = array(
	'field'   => 'training_application[training_type]',
	'label'   => 'Training Type',
	'rules'   => 'required'
);
