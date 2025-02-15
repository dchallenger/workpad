<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['payroll_period.posting_date'] = array(
	'f_id' => 9,
	'fg_id' => 1,
	'label' => 'Posting Date',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'posting_date',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.annualization'] = array(
	'f_id' => 11,
	'fg_id' => 1,
	'label' => 'Annualization',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'annualization',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.include_basic_and_allowances'] = array(
	'f_id' => 10,
	'fg_id' => 1,
	'label' => 'Include Basic',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'include_basic_and_allowances',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.include_13th_month_pay'] = array(
	'f_id' => 10,
	'fg_id' => 1,
	'label' => 'Include Basic',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'include_13th_month_pay',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.week'] = array(
	'f_id' => 6,
	'fg_id' => 1,
	'label' => 'Week',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'week',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_week',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'week',
		'value' => 'week_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_period.payroll_schedule_id'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Payroll Schedule',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'payroll_schedule_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_schedule',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'payroll_schedule',
		'value' => 'payroll_schedule_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_period.period_processing_type_id'] = array(
	'f_id' => 4,
	'fg_id' => 1,
	'label' => 'Processing',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'period_processing_type_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_period_processing_type',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'period_processing_type',
		'value' => 'period_processing_type_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_period.apply_to_id'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Apply To',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'apply_to_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_apply_to',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'apply_to',
		'value' => 'apply_to_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_period.period_status_id'] = array(
	'f_id' => 7,
	'fg_id' => 1,
	'label' => 'Status',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'period_status_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 9,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'payroll_period_status',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'period_status',
		'value' => 'period_status_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['payroll_period.date'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Period',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'date',
	'uitype_id' => 12,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.payroll_date'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Payroll Date',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'payroll_date',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['payroll_period.remarks'] = array(
	'f_id' => 8,
	'fg_id' => 1,
	'label' => 'Remarks',
	'description' => '',
	'table' => 'payroll_period',
	'column' => 'remarks',
	'uitype_id' => 2,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 8,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
