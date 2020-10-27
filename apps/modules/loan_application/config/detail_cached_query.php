<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_partners_loan_application`.`loan_application_id` as record_id, 
ww_partners_loan_application.loan_application_status_id as partners_loan_application_status_id,
`ww_partners_loan_application`.`created_on` as "partners_loan_application_created_on", 
`ww_partners_loan_application`.`created_by` as "partners_loan_application_created_by", 
`ww_partners_loan_application`.`modified_on` as "partners_loan_application_modified_on", 
`ww_partners_loan_application`.`modified_by` as "partners_loan_application_modified_by", 
ww_partners_loan_application.comment as partners_loan_comment, 
ww_partners_loan_application_car_amortization.loan_application_car_amortization as "partners_loan_application_car_amortization", 
ww_partners_loan_application_car.car_type as "partners_loan_application_car_car_type", 
DATE_FORMAT(ww_partners_loan_application_car.pay_period_to, \'%M %d, %Y\') as "partners_loan_application_car_pay_period_to", 
DATE_FORMAT(ww_partners_loan_application_car.pay_period_from, \'%M %d, %Y\') as "partners_loan_application_car_pay_period_from", 
CAST( AES_DECRYPT( ww_partners_loan_application_car.loan_amount, encryption_key()) AS CHAR) as "partners_loan_application_car_loan_amount", 
CAST( AES_DECRYPT( ww_partners_loan_application_car.amount_amortization, encryption_key()) AS CHAR) as "partners_loan_application_car_amount_amortization", 
ww_partners_loan_application_car.year_model as "partners_loan_application_car_year_model", 
ww_partners_loan_application_car.car_loan_application as "partners_loan_application_car_car_loan_application", 
ww_partners_loan_application_car_entitlement.loan_application_car_entitlement_id as "partners_loan_application_car_loan_application_car_entitlement_id", 
ww_partners_loan_application_car_entitlement.loan_application_car_entitlement as "partners_loan_application_car_loan_application_car_entitlement", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount_to_deduct_per_day, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_amount_to_deduct_per_day", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount_to_deduct, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_amount_to_deduct", 
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_start, \'%M %d, %Y\') as "partners_loan_application_omnibus_loan_deduction_start", 
DATE_FORMAT(ww_partners_loan_application_omnibus.loan_deduction_end, \'%M %d, %Y\') as "partners_loan_application_omnibus_loan_deduction_end", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_start_amortization, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_start_amortization", 
ww_partners_loan_application_omnibus.loan_terms as "partners_loan_application_omnibus_loan_terms", 
ww_partners_loan_application_car.loan_terms as "partners_loan_application_car_loan_terms", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_amount, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_amount", 
IF(ww_partners_loan_application_omnibus.loan_with_outstanding = 1,"Yes","No") as "partners_loan_application_omnibus_loan_with_outstanding",
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_balance_amount, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_balance_amount", 
CAST( AES_DECRYPT( ww_partners_loan_application_omnibus.loan_loanable_amount, encryption_key()) AS CHAR) as "partners_loan_application_omnibus_loan_loanable_amount", 
ww_partners_loan_application_omnibus.loan_purposes as "partners_loan_application_omnibus_loan_purposes", 
ww_partners_loan_application_mobile.loan_application_mobile_special_feature_id as "partners_loan_application_mobile_loan_application_mobile_special_feature_id", 
ww_partners_loan_application_mobile.loan_application_mobile_plan_limit_id as "partners_loan_application_mobile_loan_application_mobile_plan_limit_id", 
ww_partners_loan_application_mobile.loan_application_mobile_enrollment_type_id as "partners_loan_application_mobile_loan_application_mobile_enrollment_type_id",
ww_partners_loan_application_mobile_enrollment_type.loan_application_mobile_enrollment_type as "partners_loan_application_mobile_loan_application_mobile_enrollment_type",
ww_partners_loan_application_mobile_plan_limit.loan_application_mobile_plan_limit as "partners_loan_application_mobile_loan_application_mobile_plan_limit",
ww_partners_loan_application_mobile_special_feature.loan_application_mobile_special_feature as "partners_loan_application_mobile_loan_application_mobile_special_feature"
FROM (`ww_partners_loan_application`)
LEFT JOIN `ww_partners_loan_application_car` ON `ww_partners_loan_application_car`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_omnibus` ON `ww_partners_loan_application_omnibus`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_mobile` ON `ww_partners_loan_application_mobile`.`loan_application_id` = `ww_partners_loan_application`.`loan_application_id`
LEFT JOIN `ww_partners_loan_application_car_amortization` ON `ww_partners_loan_application_car_amortization`.`loan_application_car_amortization` = `ww_partners_loan_application_car`.`amortization`
LEFT JOIN `ww_partners_loan_application_car_entitlement` ON `ww_partners_loan_application_car_entitlement`.`loan_application_car_entitlement_id` = `ww_partners_loan_application_car`.`loan_application_car_entitlement_id`
LEFT JOIN `ww_partners_loan_application_mobile_enrollment_type` ON `ww_partners_loan_application_mobile`.`loan_application_mobile_enrollment_type_id` = `ww_partners_loan_application_mobile_enrollment_type`.`loan_application_mobile_enrollment_type_id`
LEFT JOIN `ww_partners_loan_application_mobile_plan_limit` ON `ww_partners_loan_application_mobile`.`loan_application_mobile_plan_limit_id` = `ww_partners_loan_application_mobile_plan_limit`.`loan_application_mobile_plan_limit_id`
LEFT JOIN `ww_partners_loan_application_mobile_special_feature` ON `ww_partners_loan_application_mobile`.`loan_application_mobile_special_feature_id` = `ww_partners_loan_application_mobile_special_feature`.`loan_application_mobile_special_feature_id`
WHERE `ww_partners_loan_application`.`loan_application_id` = "{$record_id}"';