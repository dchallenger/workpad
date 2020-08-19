<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_partners_loan_application`.`loan_application_id` as record_id,
`ww_partners_loan_application`.`loan_application_status_id` as loan_application_status_id,
ww_partners_loan_application_status.loan_application_status as loan_application_status,
ww_partners_loan_type.loan_type as "partners_loan_type",
T16.loan_application_car_amortization as "partners_loan_application_car_amortization",
ww_partners_loan_application_car.car_type as "partners_loan_application_car_car_type",
DATE_FORMAT(ww_partners_loan_application_car.pay_period_to, \'%M %d, %Y\') as "partners_loan_application_car_pay_period_to",
DATE_FORMAT(ww_partners_loan_application_car.pay_period_from, \'%M %d, %Y\') as "partners_loan_application_car_pay_period_from",
ww_partners_loan_application_car.loan_amount as "partners_loan_application_car_loan_amount",
ww_partners_loan_application_car.year_model as "partners_loan_application_car_year_model",
T10.loan_application_car_entitlement as "partners_loan_application_car_loan_application_car_entitlement_id",
ww_partners_loan_application_omnibus.loan_amount_to_deduct as "partners_loan_application_omnibus_loan_amount_to_deduct",
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_start, \'%M %d, %Y\') as "partners_loan_application_omnibus_loan_deduction_start",
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_end, \'%M %d, %Y\') as "partners_loan_application_omnibus_loan_deduction_end",
ww_partners_loan_application_mobile.loan_application_mobile_special_feature_id as "partners_loan_application_mobile_loan_application_mobile_special_feature_id",
ww_partners_loan_application_mobile.loan_application_mobile_plan_limit_id as "partners_loan_application_mobile_loan_application_mobile_plan_limit_id",
ww_partners_loan_application_mobile.loan_application_mobile_enrollment_type_id as "partners_loan_application_mobile_enrollment_type_id",
ww_partners_loan_application_omnibus.loan_start_amortization as "partners_loan_application_omnibus_loan_start_amortization",
ww_partners_loan_application_omnibus.loan_terms as "partners_loan_application_omnibus_loan_terms",
ww_partners_loan_application_omnibus.loan_amount as "partners_loan_application_omnibus_loan_amount",
`ww_partners_loan_application`.`created_on` as "partners_loan_application_created_on",
`ww_partners_loan_application`.`created_by` as "partners_loan_application_created_by",
`ww_partners_loan_application`.`modified_on` as "partners_loan_application_modified_on",
`ww_partners_loan_application`.`modified_by` as "partners_loan_application_modified_by"
FROM (`ww_partners_loan_application`)
LEFT JOIN `ww_partners_loan_type` ON `ww_partners_loan_application`.`loan_type_id` = `ww_partners_loan_type`.`loan_type_id`
LEFT JOIN `ww_partners_loan_application_car` ON `ww_partners_loan_application_car`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_omnibus` ON `ww_partners_loan_application_omnibus`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_mobile` ON `ww_partners_loan_application_mobile`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_car_amortization` T16 ON `T16`.`loan_application_car_amortization` = `ww_partners_loan_application_car`.`amortization`
LEFT JOIN `ww_partners_loan_application_car_entitlement` T10 ON `T10`.`loan_application_car_entitlement_id` = `ww_partners_loan_application_car`.`loan_application_car_entitlement_id`
LEFT JOIN `ww_partners_loan_application_status` ON `ww_partners_loan_application`.`loan_application_status_id` = `ww_partners_loan_application_status`.`loan_application_status_id`
WHERE (
	T16.loan_application_car_amortization like "%{$search}%" OR 
	ww_partners_loan_application_car.car_type like "%{$search}%" OR 
	DATE_FORMAT(ww_partners_loan_application_car.pay_period_to, \'%M %d, %Y\') like "%{$search}%" OR 
	DATE_FORMAT(ww_partners_loan_application_car.pay_period_from, \'%M %d, %Y\') like "%{$search}%" OR 
	ww_partners_loan_application_car.loan_amount like "%{$search}%" OR 
	ww_partners_loan_application_car.year_model like "%{$search}%" OR 
	T10.loan_application_car_entitlement like "%{$search}%" OR 
	ww_partners_loan_application_omnibus.loan_amount_to_deduct like "%{$search}%" OR 
	DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_start, \'%M %d, %Y\') like "%{$search}%" OR 
	DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_end, \'%M %d, %Y\') like "%{$search}%" OR 
	ww_partners_loan_application_mobile.loan_application_mobile_special_feature_id like "%{$search}%" OR 
	ww_partners_loan_application_mobile.loan_application_mobile_plan_limit_id like "%{$search}%" OR 
	ww_partners_loan_application_mobile.loan_application_mobile_enrollment_type_id like "%{$search}%" OR 
	ww_partners_loan_application_omnibus.loan_start_amortization like "%{$search}%" OR 
	ww_partners_loan_application_omnibus.loan_terms like "%{$search}%" OR 
	ww_partners_loan_application_omnibus.loan_amount like "%{$search}%"
)';