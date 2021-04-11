<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_education_degree_obtained.education_degree_obtained'][] = array(
	'field'   => 'users_education_degree_obtained[education_degree_obtained]',
	'label'   => 'Degree',
	'rules'   => 'required'
);
