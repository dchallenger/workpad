<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['users_benefit.benefit_type'][] = array(
	'field'   => 'users_benefit[benefit_type]',
	'label'   => 'Benefit Type',
	'rules'   => 'required'
);
$config['field_validations']['users_benefit.company_id'][] = array(
	'field'   => 'users_benefit[company_id]',
	'label'   => 'Company',
	'rules'   => 'required'
);
$config['field_validations']['users_benefit.job_grade_id'][] = array(
	'field'   => 'users_benefit[job_grade_id]',
	'label'   => 'Rank',
	'rules'   => 'required'
);
$config['field_validations']['users_benefit.old_new'][] = array(
	'field'   => 'users_benefit[old_new]',
	'label'   => 'Benefit Package',
	'rules'   => 'required'
);

