<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['partners_loan_application_car.amortization'][] = array(
	'field'   => 'partners_loan_application_car[amortization]',
	'label'   => 'Amortization',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.car_type'][] = array(
	'field'   => 'partners_loan_application_car[car_type]',
	'label'   => 'Car Type',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.pay_period_to'][] = array(
	'field'   => 'partners_loan_application_car[pay_period_to]',
	'label'   => 'Pay Period To',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.pay_period_from'][] = array(
	'field'   => 'partners_loan_application_car[pay_period_from]',
	'label'   => 'Pay Period From',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.loan_amount'][] = array(
	'field'   => 'partners_loan_application_car[loan_amount]',
	'label'   => 'Amount of Loan',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.year_model'][] = array(
	'field'   => 'partners_loan_application_car[year_model]',
	'label'   => 'Year Model',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_car.loan_application_car_entitlement_id'][] = array(
	'field'   => 'partners_loan_application_car[loan_application_car_entitlement_id]',
	'label'   => 'Entitlement',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_omnibus.loan_deduction_start'][] = array(
	'field'   => 'partners_loan_application_omnibus[loan_deduction_start]',
	'label'   => 'Start of Deduction',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_omnibus.loan_deduction_end'][] = array(
	'field'   => 'partners_loan_application_omnibus[loan_deduction_end]',
	'label'   => 'End of Deduction',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_mobile.loan_application_mobile_special_feature_id'][] = array(
	'field'   => 'partners_loan_application_mobile[loan_application_mobile_special_feature_id]',
	'label'   => 'Special Features Needed',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_mobile.loan_application_mobile_plan_limit_id'][] = array(
	'field'   => 'partners_loan_application_mobile[loan_application_mobile_plan_limit_id]',
	'label'   => 'Plan Limit (Based on company policy)',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_mobile.enrollment_type_id'][] = array(
	'field'   => 'partners_loan_application_mobile[enrollment_type_id]',
	'label'   => 'Type of Enrollment',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_omnibus.loan_start_amortization'][] = array(
	'field'   => 'partners_loan_application_omnibus[loan_start_amortization]',
	'label'   => 'Amount of Amortization',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_omnibus.loan_terms'][] = array(
	'field'   => 'partners_loan_application_omnibus[loan_terms]',
	'label'   => 'Terms',
	'rules'   => 'required'
);
$config['field_validations']['partners_loan_application_omnibus.loan_amount'][] = array(
	'field'   => 'partners_loan_application_omnibus[loan_amount]',
	'label'   => 'Loan Amount',
	'rules'   => 'required'
);
