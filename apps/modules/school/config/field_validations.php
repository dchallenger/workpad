<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_education_school.education_school'][] = array(
	'field'   => 'users_education_school[education_school]',
	'label'   => 'School',
	'rules'   => 'required'
);
