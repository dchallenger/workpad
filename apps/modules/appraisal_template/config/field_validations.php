<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['performance_template.applicable_to_id'][] = array(
	'field'   => 'performance_template[applicable_to_id]',
	'label'   => 'Applicable to',
	'rules'   => ''
);
$config['field_validations']['performance_template.applicable_to'][] = array(
	'field'   => 'performance_template[applicable_to]',
	'label'   => 'Applicable to',
	'rules'   => ''
);
$config['field_validations']['performance_template.template'][] = array(
	'field'   => 'performance_template[template]',
	'label'   => 'Template Title',
	'rules'   => 'required'
);
$config['field_validations']['performance_template.template_code'][] = array(
	'field'   => 'performance_template[template_code]',
	'label'   => 'Template Code',
	'rules'   => 'required'
);
$config['field_validations']['performance_template.max_crowdsource'][] = array(
	'field'   => 'performance_template[max_crowdsource]',
	'label'   => 'Max Crowdsource',
	'rules'   => 'is_natural'
);
$config['field_validations']['performance_template.company_id'][] = array(
	'field'   => 'performance_template[company_id]',
	'label'   => 'Company',
	'rules'   => 'required'
);
$config['field_validations']['performance_template.employment_type_id'][] = array(
	'field'   => 'performance_template[employment_type_id]',
	'label'   => 'Employment Type',
	'rules'   => 'required'
);
/*$config['field_validations']['performance_template.job_grade_id'][] = array(
	'field'   => 'performance_template[job_grade_id]',
	'label'   => 'Rank',
	'rules'   => 'required'
);*/
$config['field_validations']['performance_template.employment_status_id'][] = array(
	'field'   => 'performance_template[employment_status_id]',
	'label'   => 'Employment Status',
	'rules'   => 'required'
);
