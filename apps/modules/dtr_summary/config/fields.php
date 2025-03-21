<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['time_record_summary.day_type'] = array(
	'f_id' => 4,
	'fg_id' => 1,
	'label' => 'Day Type',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'day_type',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'time_day_type',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'day_type',
		'value' => 'day_type_code',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['time_record_summary.ot'] = array(
	'f_id' => 11,
	'fg_id' => 1,
	'label' => 'Overtime',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'ot',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 11,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.undertime'] = array(
	'f_id' => 10,
	'fg_id' => 1,
	'label' => 'Undertime',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'undertime',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 10,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.late'] = array(
	'f_id' => 9,
	'fg_id' => 1,
	'label' => 'Lates',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'late',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 9,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.lwop'] = array(
	'f_id' => 8,
	'fg_id' => 1,
	'label' => 'Unpaid Leaves',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'lwop',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 8,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.lwp'] = array(
	'f_id' => 7,
	'fg_id' => 1,
	'label' => 'Paid Leaves',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'lwp',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.absent'] = array(
	'f_id' => 6,
	'fg_id' => 1,
	'label' => 'Absent',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'absent',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.hrs_actual'] = array(
	'f_id' => 5,
	'fg_id' => 1,
	'label' => 'Hours Worked',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'hrs_actual',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => 'numeric',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.payroll_date'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Payroll Date',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'payroll_date',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.date'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Date',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'date',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['time_record_summary.user_id'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Employee',
	'description' => '',
	'table' => 'time_record_summary',
	'column' => 'user_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
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
