<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['time_form_balance_fcc_setup.in_excess_to_forfeit'] = array(
	'f_id' => 8,
	'fg_id' => 1,
	'label' => 'Inexcess To Forfeit',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'in_excess_to_forfeit',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_form_balance_fcc_setup.in_excess_to_pay'] = array(
	'f_id' => 7,
	'fg_id' => 1,
	'label' => 'Inexcess To Pay',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'in_excess_to_pay',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_form_balance_fcc_setup.max_balance_carry_over'] = array(
	'f_id' => 6,
	'fg_id' => 1,
	'label' => 'Maximum Balance to Carry Over',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'max_balance_carry_over',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_form_balance_fcc_setup.form_id'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Leave Type',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'form_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'time_form',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'form',
		'value' => 'form_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['time_form_balance_fcc_setup.description'] = array(
	'f_id' => 4,
	'fg_id' => 1,
	'label' => 'Description',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'description',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'Required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_form_balance_fcc_setup.employment_status_ids'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Employment Status',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'employment_status_ids',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_employment_status',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'employment_status',
		'value' => 'employment_status_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['time_form_balance_fcc_setup.employment_type_ids'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Employee Type',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'employment_type_ids',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_employment_type',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'employment_type',
		'value' => 'employment_type_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['time_form_balance_fcc_setup.company_ids'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Company',
	'description' => '',
	'table' => 'time_form_balance_fcc_setup',
	'column' => 'company_ids',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'users_company',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'company',
		'value' => 'company_id',
		'textual_value_column' => ''
	)
);