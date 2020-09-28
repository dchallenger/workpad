<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT `ww_time_form_balance_fcc_setup`.`fcc_setup_id` as record_id,
ww_time_form_balance_fcc_setup.company as "time_form_balance_fcc_setup.company",
ww_time_form_balance_fcc_setup.employment_status as "time_form_balance_fcc_setup.employment_status",
ww_time_form_balance_fcc_setup.employment_type as "time_form_balance_fcc_setup.employment_type",
ww_time_form_balance_fcc_setup.description as "time_form_balance_fcc_setup.description", 
ww_time_form.form as "time_form_balance_fcc_setup.form",
ww_time_form_balance_fcc_setup.in_excess_to_forfeit as "time_form_balance_fcc_setup.in_excess_to_forfeit", 
ww_time_form_balance_fcc_setup.in_excess_to_pay as "time_form_balance_fcc_setup.in_excess_to_pay", 
ww_time_form_balance_fcc_setup.max_balance_carry_over as "time_form_balance_fcc_setup.max_balance_carry_over", 
`ww_time_form_balance_fcc_setup`.`created_on` as "time_form_balance_fcc_setup.created_on", 
`ww_time_form_balance_fcc_setup`.`created_by` as "time_form_balance_fcc_setup.created_by", 
`ww_time_form_balance_fcc_setup`.`modified_on` as "time_form_balance_fcc_setup.modified_on", 
`ww_time_form_balance_fcc_setup`.`modified_by` as "time_form_balance_fcc_setup.modified_by"
FROM (`ww_time_form_balance_fcc_setup`)
LEFT JOIN `ww_time_form` ON `ww_time_form`.`form_id` = `ww_time_form_balance_fcc_setup`.`form_id`
WHERE `ww_time_form_balance_fcc_setup`.`fcc_setup_id` = "{$record_id}"';