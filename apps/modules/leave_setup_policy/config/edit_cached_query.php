<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT `ww_time_form_balance_setup_policy`.`policy_id` as record_id, 
`ww_time_form_balance_setup_policy`.`created_on` as "time_form_balance_setup_policy.created_on", 
`ww_time_form_balance_setup_policy`.`created_by` as "time_form_balance_setup_policy.created_by", 
`ww_time_form_balance_setup_policy`.`modified_on` as "time_form_balance_setup_policy.modified_on", 
`ww_time_form_balance_setup_policy`.`modified_by` as "time_form_balance_setup_policy.modified_by", 
ww_time_form_balance_setup_policy.company_ids as "time_form_balance_setup_policy.company_ids",
ww_time_form_balance_setup_policy.employment_type_ids as "time_form_balance_setup_policy.employment_type_ids",
ww_time_form_balance_setup_policy.job_grade_ids as "time_form_balance_setup_policy.job_grade_ids",
ww_time_form_balance_setup_policy.employment_status_ids as "time_form_balance_setup_policy.employment_status_ids",
ww_time_form_balance_setup_policy.description as "time_form_balance_setup_policy.description",
ww_time_form_balance_setup_policy.form_id as "time_form_balance_setup_policy.form_id", 
ww_time_form_balance_setup_policy.accumulation_type as "time_form_balance_setup_policy.accumulation_type",
ww_time_form_balance_setup_policy.credit_1_15 as "time_form_balance_setup_policy.credit_1_15",
ww_time_form_balance_setup_policy.credit_16_31 as "time_form_balance_setup_policy.credit_16_31",
ww_time_form_balance_setup_policy.credit as "time_form_balance_setup_policy.credit",
ww_time_form_balance_setup_policy.max_credit as "time_form_balance_setup_policy.max_credit", 
ww_time_form_balance_setup_policy.prorated as "time_form_balance_setup_policy.prorated",
ww_time_form_balance_setup_policy.tenure as "time_form_balance_setup_policy.tenure",
DATE_FORMAT(ww_time_form_balance_setup_policy.leave_reset_date, \'%M %d, %Y\') as "time_form_balance_setup_policy.leave_reset_date"
FROM (`ww_time_form_balance_setup_policy`)
WHERE `ww_time_form_balance_setup_policy`.`policy_id` = "{$record_id}"';