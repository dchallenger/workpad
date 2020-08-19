<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['performance_setup_scorecard.template_section_id'][] = array(
	'field'   => 'performance_setup_scorecard[template_section_id]',
	'label'   => 'Template Section',
	'rules'   => 'required'
);
$config['field_validations']['performance_setup_scorecard.scorecard'][] = array(
	'field'   => 'performance_setup_scorecard[scorecard]',
	'label'   => 'Scorecard',
	'rules'   => 'required'
);