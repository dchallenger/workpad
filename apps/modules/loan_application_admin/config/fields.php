<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][3]['partners_loan_application_car.car_loan_application'] = array(
	'f_id' => 16,
	'fg_id' => 3,
	'label' => 'Car Loan Application',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'car_loan_application',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_car_amortization',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'loan_application_car_amortization',
		'value' => 'loan_application_car_amortization',
		'textual_value_column' => ''
	)
);
$config['fields'][3]['partners_loan_application_car.amortization'] = array(
	'f_id' => 16,
	'fg_id' => 3,
	'label' => 'Amortization',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'amortization',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_car_amortization',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'loan_application_car_amortization',
		'value' => 'loan_application_car_amortization',
		'textual_value_column' => ''
	)
);
$config['fields'][3]['partners_loan_application_car.car_type'] = array(
	'f_id' => 15,
	'fg_id' => 3,
	'label' => 'Car Type',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'car_type',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['partners_loan_application_car.pay_period_to'] = array(
	'f_id' => 14,
	'fg_id' => 3,
	'label' => 'End of Deduction',
	'description' => 'End of monthly deduction',
	'table' => 'partners_loan_application_car',
	'column' => 'pay_period_to',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['partners_loan_application_car.pay_period_from'] = array(
	'f_id' => 13,
	'fg_id' => 3,
	'label' => 'Start of Deduction',
	'description' => 'Start date of deduction',
	'table' => 'partners_loan_application_car',
	'column' => 'pay_period_from',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['partners_loan_application_car.amount_amortization'] = array(
	'f_id' => 12,
	'fg_id' => 3,
	'label' => 'Amount of Amortization',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'amount_amortization',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][3]['partners_loan_application_car.loan_amount'] = array(
	'f_id' => 12,
	'fg_id' => 3,
	'label' => 'Amount of Loan',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'loan_amount',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][3]['partners_loan_application_car.year_model'] = array(
	'f_id' => 11,
	'fg_id' => 3,
	'label' => 'Year Model',
	'description' => '',
	'table' => 'partners_loan_application_car',
	'column' => 'year_model',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['partners_loan_application_car.loan_application_car_entitlement_id'] = array(
	'f_id' => 10,
	'fg_id' => 3,
	'label' => 'Entitlement',
	'description' => 'Entitlement',
	'table' => 'partners_loan_application_car',
	'column' => 'loan_application_car_entitlement_id',
	'uitype_id' => 4,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_car_entitlement',
		'multiple' => 0,
		'group_by' => '',
		'label' => 'loan_application_car_entitlement',
		'value' => 'loan_application_car_entitlement_id',
		'textual_value_column' => ''
	)
);
$config['fields'][2]['partners_loan_application_omnibus.loan_loanable_amount'] = array(
	'f_id' => 21,
	'fg_id' => 2,
	'label' => 'Amount Loanable',
	'description' => 'Amount Loanable',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_loanable_amount',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][2]['partners_loan_application_omnibus.loan_balance_amount'] = array(
	'f_id' => 20,
	'fg_id' => 2,
	'label' => 'Amount Balance',
	'description' => 'Amount Balance',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_balance_amount',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][2]['partners_loan_application_omnibus.loan_with_outstanding'] = array(
	'f_id' => 19,
	'fg_id' => 2,
	'label' => 'With Outstanding Balance',
	'description' => 'With Outstanding Balance',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_with_outstanding',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['partners_loan_application_omnibus.loan_deduction_start'] = array(
	'f_id' => 7,
	'fg_id' => 2,
	'label' => 'Start of Deduction',
	'description' => 'Start of Deduction',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_deduction_start',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['partners_loan_application_omnibus.loan_deduction_end'] = array(
	'f_id' => 8,
	'fg_id' => 2,
	'label' => 'End of Deduction',
	'description' => 'End of Deduction',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_deduction_end',
	'uitype_id' => 6,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['partners_loan_application_omnibus.loan_start_amortization'] = array(
	'f_id' => 6,
	'fg_id' => 2,
	'label' => 'Amount of Amortization',
	'description' => 'Amount of Amortization',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_start_amortization',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][2]['partners_loan_application_omnibus.loan_terms'] = array(
	'f_id' => 5,
	'fg_id' => 2,
	'label' => 'Terms',
	'description' => 'Terms of payment',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_terms',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['partners_loan_application_omnibus.loan_purposes'] = array(
	'f_id' => 17,
	'fg_id' => 2,
	'label' => 'Loan Purpose(s)',
	'description' => 'Loan Purpose(s)',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_purposes',
	'uitype_id' => 2,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['partners_loan_application_omnibus.loan_amount'] = array(
	'f_id' => 4,
	'fg_id' => 2,
	'label' => 'Loan Amount',
	'description' => 'Loan Amount',
	'table' => 'partners_loan_application_omnibus',
	'column' => 'loan_amount',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 1
);
$config['fields'][1]['partners_loan_application_mobile.loan_application_mobile_special_feature_id'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Special Features Needed',
	'description' => 'Special Features Needed',
	'table' => 'partners_loan_application_mobile',
	'column' => 'loan_application_mobile_special_feature_id',
	'uitype_id' => 10,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_mobile_special_feature',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'loan_application_mobile_special_feature',
		'value' => 'loan_application_mobile_special_feature_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['partners_loan_application_mobile.loan_application_mobile_plan_limit_id'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Plan Limit (Based on company policy)',
	'description' => 'Plan Limit (Based on company policy)',
	'table' => 'partners_loan_application_mobile',
	'column' => 'loan_application_mobile_plan_limit_id',
	'uitype_id' => 10,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_mobile_plan_limit',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'loan_application_mobile_plan_limit',
		'value' => 'loan_application_mobile_plan_limit_id',
		'textual_value_column' => ''
	)
);
$config['fields'][1]['partners_loan_application_mobile.loan_application_mobile_enrollment_type_id'] = array(
	'f_id' => 1,
	'fg_id' => 1,
	'label' => 'Type of Enrollment',
	'description' => 'Options for type of enrollment',
	'table' => 'partners_loan_application_mobile',
	'column' => 'loan_application_mobile_enrollment_type_id',
	'uitype_id' => 10,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0,
	'searchable' => array(
		'type_id' => '1',
		'table' => 'partners_loan_application_mobile_enrollment_type',
		'multiple' => 1,
		'group_by' => '',
		'label' => 'loan_application_mobile_enrollment_type',
		'value' => 'loan_application_mobile_enrollment_type_id',
		'textual_value_column' => ''
	)
);