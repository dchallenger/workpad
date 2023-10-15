<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][1] = array(
	'fg_id' => 1,
	'label' => 'Mobile Application Plan',
	'description' => 'Application for mobile postpaid plan/prepaid cell card',
	'display_id' => 4,
	'sequence' => 1,
	'active' => 1,
	'fields' => array( 
		'partners_loan_application_mobile.loan_application_mobile_special_feature_id',
		'partners_loan_application_mobile.loan_application_mobile_plan_limit_id',
		'partners_loan_application_mobile.loan_application_mobile_enrollment_type_id',
		'partners_loan_application_mobile.remarks'
	)
);
$config['fieldgroups'][2] = array(
	'fg_id' => 2,
	'label' => 'Omnibus Loan Application',
	'description' => 'Omnibus loan application',
	'display_id' => 4,
	'sequence' => 2,
	'active' => 1,
	'fields' => array(
		'partners_loan_application_omnibus.loan_loanable_amount',
		'partners_loan_application_omnibus.loan_balance_amount',
		'partners_loan_application_omnibus.loan_with_outstanding',
		'partners_loan_application_omnibus.loan_amount_to_deduct_per_day',
		'partners_loan_application_omnibus.loan_amount_to_deduct',
		'partners_loan_application_omnibus.loan_deduction_start',
		'partners_loan_application_omnibus.loan_deduction_end',
		'partners_loan_application_omnibus.loan_start_amortization',
		'partners_loan_application_omnibus.loan_terms',
		'partners_loan_application_omnibus.loan_purposes',
		'partners_loan_application_omnibus.loan_amount'
	)
);
$config['fieldgroups'][3] = array(
	'fg_id' => 3,
	'label' => 'Car Plan Loan Application',
	'description' => 'Request for car plan / loan',
	'display_id' => 4,
	'sequence' => 3,
	'active' => 1,
	'fields' => array(
		'partners_loan_application_car.loan_terms',
		'partners_loan_application_car.amortization',
		'partners_loan_application_car.amount_amortization',
		'partners_loan_application_car.car_loan_application',
		'partners_loan_application_car.car_type',
		'partners_loan_application_car.pay_period_to',
		'partners_loan_application_car.pay_period_from',
		'partners_loan_application_car.loan_amount',
		'partners_loan_application_car.year_model',
		'partners_loan_application_car.loan_application_car_entitlement_id'
	)
);
