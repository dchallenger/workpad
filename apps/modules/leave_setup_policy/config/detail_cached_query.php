<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_time_form_balance_setup_policy`.`policy_id` as record_id, 
ww_time_form_balance_setup_policy.company as "time_form_balance_setup_policy.company",
ww_time_form_balance_setup_policy.employment_status as "time_form_balance_setup_policy.employment_status",
ww_time_form_balance_setup_policy.job_level as "time_form_balance_setup_policy.job_level",
ww_time_form_balance_setup_policy.employment_type as "time_form_balance_setup_policy.employment_type",
ww_time_form_balance_setup_policy.description as "time_form_balance_setup_policy.description",
ww_time_form.form as "time_form_balance_setup_policy.form",
IF(ww_time_form_balance_setup_policy.accumulation_type = 1,"Monthly","Yearly") as "time_form_balance_setup_policy.accumulation_type",
ww_time_form_balance_setup_policy.credit_1_15 as "time_form_balance_setup_policy.credit_1_15",
ww_time_form_balance_setup_policy.credit_16_31 as "time_form_balance_setup_policy.credit_16_31",
ww_time_form_balance_setup_policy.credit as "time_form_balance_setup_policy.credit",
ww_time_form_balance_setup_policy.max_credit as "time_form_balance_setup_policy.max_credit",
IF(ww_time_form_balance_setup_policy.prorated = 1, "Yes","No") as "time_form_balance_setup_policy.prorated",
ww_time_form_balance_setup_policy.leave_reset_date as "time_form_balance_setup_policy.leave_reset_date",
`ww_time_form_balance_setup_policy`.`created_on` as "time_form_balance_setup_policy_created_on",
`ww_time_form_balance_setup_policy`.`created_by` as "time_form_balance_setup_policy_created_by",
`ww_time_form_balance_setup_policy`.`modified_on` as "time_form_balance_setup_policy_modified_on",
`ww_time_form_balance_setup_policy`.`modified_by` as "time_form_balance_setup_policy_modified_by"
FROM (`ww_time_form_balance_setup_policy`)
LEFT JOIN `ww_time_form` ON `ww_time_form`.`form_id` = `ww_time_form_balance_setup_policy`.`form_id`
WHERE `ww_time_form_balance_setup_policy`.`policy_id` = "{$record_id}"';