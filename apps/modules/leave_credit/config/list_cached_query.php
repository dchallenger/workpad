<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_time_form_balance`.`id` as record_id, ww_time_form_balance.current as "time_form_balance_current", ww_time_form_balance.previous as "time_form_balance_previous", T2.display_name as "time_form_balance_user_id", T3.form as "time_form_balance_form", ww_time_form_balance.year as "time_form_balance_year", ww_time_form_balance.used as "time_form_balance_used", ww_time_form_balance.balance as "time_form_balance_balance", `ww_time_form_balance`.`created_on` as "time_form_balance_created_on", `ww_time_form_balance`.`created_by` as "time_form_balance_created_by", `ww_time_form_balance`.`modified_on` as "time_form_balance_modified_on", `ww_time_form_balance`.`modified_by` as "time_form_balance_modified_by"
, ww_time_form_balance.form_id as time_form_balance_form_id, T4.effectivity_date, T3.form_code,
DATE_FORMAT(ww_time_form_balance.period_from, \'%d %b %Y\') AS "time_form_balance_period_from",
DATE_FORMAT(ww_time_form_balance.period_to, \'%d %b %Y\') AS "time_form_balance_period_to",
DATE_FORMAT(ww_time_form_balance.period_extension, \'%d %b %Y\') as "time_form_balance_period_extension_view"
FROM (`ww_time_form_balance`)
LEFT JOIN `ww_users` T2 ON `T2`.`user_id` = `ww_time_form_balance`.`user_id`
LEFT JOIN `ww_partners` T4 ON `T4`.`user_id` = `ww_time_form_balance`.`user_id`
LEFT JOIN `ww_time_form` T3 ON `T3`.`form_id` = `ww_time_form_balance`.`form_id`
WHERE (
	ww_time_form_balance.current like "%{$search}%" OR 
	ww_time_form_balance.previous like "%{$search}%" OR 
	T2.display_name like "%{$search}%" OR 
	ww_time_form_balance.year like "%{$search}%" OR 
	T3.form like "%{$search}%"
)';