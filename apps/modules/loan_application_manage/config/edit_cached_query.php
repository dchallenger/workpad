<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_partners_loan_application`.`loan_application_id` as record_id, 
`ww_partners_loan_application`.`created_on` as "partners_loan_application.created_on", 
`ww_partners_loan_application`.`created_by` as "partners_loan_application.created_by", 
`ww_partners_loan_application`.`modified_on` as "partners_loan_application.modified_on", 
`ww_partners_loan_application`.`modified_by` as "partners_loan_application.modified_by", 
ww_partners_loan_application_car.amortization as "partners_loan_application_car.amortization", 
ww_partners_loan_application_car.car_type as "partners_loan_application_car.car_type", 
DATE_FORMAT(ww_partners_loan_application_car.pay_period_to, \'%M %d, %Y\') as "partners_loan_application_car.pay_period_to", 
DATE_FORMAT(ww_partners_loan_application_car.pay_period_from, \'%M %d, %Y\') as "partners_loan_application_car.pay_period_from", 
CAST( AES_DECRYPT( ww_partners_loan_application_car.loan_amount, encryption_key()) AS CHAR) as "partners_loan_application_car.loan_amount", 
ww_partners_loan_application_car.year_model as "partners_loan_application_car.year_model", 
ww_partners_loan_application_car.loan_application_car_entitlement_id as "partners_loan_application_car.loan_application_car_entitlement_id", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount_to_deduct_per_day, encryption_key()) AS CHAR) as "partners_loan_application_omnibus.loan_amount_to_deduct_per_day", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount_to_deduct, encryption_key()) AS CHAR) as "partners_loan_application_omnibus.loan_amount_to_deduct", 
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_start, \'%M %d, %Y\') as "partners_loan_application_omnibus.loan_deduction_start", 
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_end, \'%M %d, %Y\') as "partners_loan_application_omnibus.loan_deduction_end", 
ww_partners_loan_application_mobile.loan_application_mobile_special_feature_id as "partners_loan_application_mobile.loan_application_mobile_special_feature_id", 
ww_partners_loan_application_mobile.loan_application_mobile_plan_limit_id as "partners_loan_application_mobile.loan_application_mobile_plan_limit_id", 
ww_partners_loan_application_mobile.loan_application_mobile_enrollment_type_id as "partners_loan_application_mobile.loan_application_mobile_enrollment_type_id", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_start_amortization, encryption_key()) AS CHAR) as "partners_loan_application_omnibus.loan_start_amortization", 
ww_partners_loan_application_omnibus.loan_terms as "partners_loan_application_omnibus.loan_terms", 
ww_partners_loan_application_omnibus.loan_purposes as "partners_loan_application_omnibus.loan_purposes",
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount, encryption_key()) AS CHAR) as "partners_loan_application_omnibus.loan_amount"
FROM (`ww_partners_loan_application`)
LEFT JOIN `ww_partners_loan_application_car` ON `ww_partners_loan_application_car`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_omnibus` ON `ww_partners_loan_application_omnibus`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_mobile` ON `ww_partners_loan_application_mobile`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
WHERE `ww_partners_loan_application`.`loan_application_id` = "{$record_id}"';