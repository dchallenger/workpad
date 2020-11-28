<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT `ww_time_form_balance_fcc_setup`.`fcc_setup_id` as record_id, 
`ww_time_form_balance_fcc_setup`.`created_on` as "time_form_balance_fcc_setup.created_on", 
`ww_time_form_balance_fcc_setup`.`created_by` as "time_form_balance_fcc_setup.created_by", 
`ww_time_form_balance_fcc_setup`.`modified_on` as "time_form_balance_fcc_setup.modified_on", 
`ww_time_form_balance_fcc_setup`.`modified_by` as "time_form_balance_fcc_setup.modified_by", 
ww_time_form_balance_fcc_setup.in_excess_to_forfeit as "time_form_balance_fcc_setup.in_excess_to_forfeit", 
ww_time_form_balance_fcc_setup.in_excess_to_pay as "time_form_balance_fcc_setup.in_excess_to_pay", 
ww_time_form_balance_fcc_setup.max_balance_carry_over as "time_form_balance_fcc_setup.max_balance_carry_over", 
ww_time_form_balance_fcc_setup.form_id as "time_form_balance_fcc_setup.form_id", 
ww_time_form_balance_fcc_setup.description as "time_form_balance_fcc_setup.description", 
ww_time_form_balance_fcc_setup.employment_status_ids as "time_form_balance_fcc_setup.employment_status_ids", 
ww_time_form_balance_fcc_setup.job_grade_ids as "time_form_balance_fcc_setup.job_grade_ids",
ww_time_form_balance_fcc_setup.employment_type_ids as "time_form_balance_fcc_setup.employment_type_ids", 
ww_time_form_balance_fcc_setup.company_ids as "time_form_balance_fcc_setup.company_ids",
ww_time_form_balance_fcc_setup.old_new as "time_form_balance_fcc_setup.old_new"
FROM (`ww_time_form_balance_fcc_setup`)
WHERE `ww_time_form_balance_fcc_setup`.`fcc_setup_id` = "{$record_id}"';