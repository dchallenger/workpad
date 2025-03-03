<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][4]['performance_appraisal_idp.idp_completed_planned'] = array(
	'f_id' => 7,
	'fg_id' => 4,
	'label' => '% of IDP Completed vs. Planned',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'idp_completed_planned',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][4]['performance_appraisal_idp.idp_committed'] = array(
	'f_id' => 6,
	'fg_id' => 4,
	'label' => '% of individual Development Initiatives Commited for the Year',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'idp_committed',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['performance_appraisal_idp.total_budget'] = array(
	'f_id' => 5,
	'fg_id' => 3,
	'label' => 'Total Development Budget for the Year',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'total_budget',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['performance_appraisal_idp.user_id'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Employee',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'user_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'users',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'full_name',
		'value' => 'user_id',
		'textual_value_column' => ''
	)
);
$config['fields'][3]['performance_appraisal_idp.stb'] = array(
	'f_id' => 4,
	'fg_id' => 3,
	'label' => 'Supplemental Training Budget',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'stb',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['performance_appraisal_idp.ctb'] = array(
	'f_id' => 3,
	'fg_id' => 3,
	'label' => 'Common Training Budget',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'ctb',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['performance_appraisal_idp.itb'] = array(
	'f_id' => 2,
	'fg_id' => 3,
	'label' => 'Individual Training Budget',
	'description' => '',
	'table' => 'performance_appraisal_idp',
	'column' => 'itb',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
