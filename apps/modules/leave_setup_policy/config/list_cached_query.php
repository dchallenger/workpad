<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_time_form_balance_setup_policy`.`policy_id` as record_id, 
ww_time_form_balance_setup_policy.company as "time_form_balance_setup_policy_company",
ww_time_form_balance_setup_policy.employment_type as "time_form_balance_setup_policy_employment_type",
ww_time_form_balance_setup_policy.employment_status as "time_form_balance_setup_policy_employment_status",
ww_time_form_balance_setup_policy.description as "time_form_balance_setup_policy_description", 
T2.form as "time_form_balance_setup_policy_form", 
ww_time_form_balance_setup_policy.accumulation_type as "time_form_balance_setup_policy_accumulation_type", 
ww_time_form_balance_setup_policy.credit_1_15 as "time_form_balance_setup_policy_credit_1_15", 
ww_time_form_balance_setup_policy.credit_16_31 as "time_form_balance_setup_policy_credit_16_31", 
ww_time_form_balance_setup_policy.credit as "time_form_balance_setup_policy_credit", 
ww_time_form_balance_setup_policy.max_credit as "time_form_balance_setup_policy_max_credit", 
ww_time_form_balance_setup_policy.prorated as "time_form_balance_setup_policy_prorated", 
ww_time_form_balance_setup_policy.leave_reset_date as "time_form_balance_setup_policy_leave_reset_date", 
`ww_time_form_balance_setup_policy`.`created_on` as "time_form_balance_setup_policy_created_on", 
`ww_time_form_balance_setup_policy`.`created_by` as "time_form_balance_setup_policy_created_by", 
`ww_time_form_balance_setup_policy`.`modified_on` as "time_form_balance_setup_policy_modified_on", 
`ww_time_form_balance_setup_policy`.`modified_by` as "time_form_balance_setup_policy_modified_by" 
FROM (`ww_time_form_balance_setup_policy`) 
LEFT JOIN `ww_time_form` T2 ON `T2`.`form_id` = `ww_time_form_balance_setup_policy`.`form_id` 
WHERE ww_time_form_balance_setup_policy.deleted = 0 AND (
ww_time_form_balance_setup_policy.company like "%{$search}%" OR 
ww_time_form_balance_setup_policy.employment_type like "%{$search}%" OR 
ww_time_form_balance_setup_policy.employment_status like "%{$search}%" OR
ww_time_form_balance_setup_policy.description like "%{$search}%" OR
T2.form like "%{$search}%" OR
ww_time_form_balance_setup_policy.accumulation_type like "%{$search}%" OR
ww_time_form_balance_setup_policy.credit_1_15 like "%{$search}%" OR
ww_time_form_balance_setup_policy.credit_16_31 like "%{$search}%" OR
ww_time_form_balance_setup_policy.credit like "%{$search}%" OR
ww_time_form_balance_setup_policy.max_credit like "%{$search}%" OR
ww_time_form_balance_setup_policy.prorated like "%{$search}%" OR
ww_time_form_balance_setup_policy.leave_reset_date like "%{$search}%"
)';