<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['payroll_overtime_rates_amount.overtime_amount'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Amount',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'overtime_amount',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_overtime_rates_amount.overtime_id'] = array(
	'f_id' => 4,
	'fg_id' => 1,
	'label' => 'Overtime',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'overtime_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_overtime',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'overtime',
		'value' => 'overtime_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_overtime_rates_amount.overtime_location_id'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Location',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'overtime_location_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'users_location',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'location',
		'value' => 'location_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_overtime_rates_amount.company_id'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Company',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'company_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'users_company',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'company',
		'value' => 'company_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_overtime_rates_amount.employment_type_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Employment Type',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'employment_type_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_employment_type',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'employment_type',
		'value' => 'employment_type_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_overtime_rates_amount.overtime_code'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Overtime Code',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'overtime_code',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_overtime_rates_amount.overtime'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Overtime',
	'description' => '',
	'table' => 'payroll_overtime_rates_amount',
	'column' => 'overtime',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
