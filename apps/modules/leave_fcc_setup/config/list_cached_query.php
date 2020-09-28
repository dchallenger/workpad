<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_time_form_balance_fcc_setup`.`fcc_setup_id` as record_id, 
ww_time_form_balance_fcc_setup.company as "time_form_balance_fcc_setup_company",
ww_time_form_balance_fcc_setup.employment_type as "time_form_balance_fcc_setup_employment_type",
ww_time_form_balance_fcc_setup.employment_status as "time_form_balance_fcc_setup_employment_status",
ww_time_form_balance_fcc_setup.description as "time_form_balance_fcc_setup_description", 
T2.form as "time_form_balance_fcc_setup_form", 
ww_time_form_balance_fcc_setup.max_balance_carry_over as "time_form_balance_fcc_setup_max_balance_carry_over", 
ww_time_form_balance_fcc_setup.in_excess_to_pay as "time_form_balance_fcc_setup_in_excess_to_pay", 
ww_time_form_balance_fcc_setup.in_excess_to_forfeit as "time_form_balance_fcc_setup_in_excess_to_forfeit",
`ww_time_form_balance_fcc_setup`.`created_on` as "time_form_balance_fcc_setup_created_on", 
`ww_time_form_balance_fcc_setup`.`created_by` as "time_form_balance_fcc_setup_created_by", 
`ww_time_form_balance_fcc_setup`.`modified_on` as "time_form_balance_fcc_setup_modified_on", 
`ww_time_form_balance_fcc_setup`.`modified_by` as "time_form_balance_fcc_setup_modified_by" 
FROM (`ww_time_form_balance_fcc_setup`) 
LEFT JOIN `ww_time_form` T2 ON `T2`.`form_id` = `ww_time_form_balance_fcc_setup`.`form_id` 
WHERE ww_time_form_balance_fcc_setup.deleted = 0 AND (
ww_time_form_balance_fcc_setup.company like "%{$search}%" OR 
ww_time_form_balance_fcc_setup.employment_type like "%{$search}%" OR 
ww_time_form_balance_fcc_setup.employment_status like "%{$search}%" OR
ww_time_form_balance_fcc_setup.description like "%{$search}%" OR
T2.form like "%{$search}%" OR
ww_time_form_balance_fcc_setup.max_balance_carry_over like "%{$search}%" OR
ww_time_form_balance_fcc_setup.in_excess_to_pay like "%{$search}%" OR
ww_time_form_balance_fcc_setup.in_excess_to_forfeit like "%{$search}%"
)';