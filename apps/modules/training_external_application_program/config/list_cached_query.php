<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_training_application`.`training_application_id` as record_id, 
ww_training_application.approver_remarks as "training_application_approver_remarks", 
ww_training_application.remarks as "training_application_remarks", 
ww_training_application.remaining_allocated as "training_application_remaining_allocated", 
ww_training_application.remaining_stb as "training_application_remaining_stb", 
ww_training_application.idp_completion as "training_application_idp_completion", 
ww_training_application.excess_ctb as "training_application_excess_ctb", 
ww_training_application.remaining_ctb as "training_application_remaining_ctb", 
ww_training_application.ctb as "training_application_ctb", 
IF(ww_training_application.budgeted = 1, "Yes", "No") as "training_application_budgeted", 
ww_training_application.excess_stb as "training_application_excess_stb", 
ww_training_application.itb as "training_application_itb", 
ww_training_application.investment as "training_application_investment", 
IF(ww_training_application.service_bond = 1, "Yes", "No") as "training_application_service_bond", 
ww_training_application.stb as "training_application_stb", 
T23.training_type as "training_application_allocated", 
ww_training_application.excess_itb as "training_application_excess_itb", 
ww_training_application.remaining_itb as "training_application_remaining_itb", 
ww_training_application.note as "training_application_note", 
T12.category as "training_application_competency", 
ww_training_application.areas_development as "training_application_areas_development", 
ww_training_application.total_investment_pgsa as "training_application_total_investment_pgsa", 
ww_training_application.total_training_hour as "training_application_total_training_hour", 
ww_training_application.venue as "training_application_venue", 
T7.provider as "training_application_training_provider", 
T6.course as "training_application_training_course", 
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application_date_to", 
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application_date_from", 
T3.training_type as "training_application_training_type", 
T2.full_name as "training_application_user", 
t4.training_application_status as "training_application_training_application_status",
`ww_training_application`.`created_on` as "training_application_created_on", 
`ww_training_application`.`created_by` as "training_application_created_by", 
`ww_training_application`.`modified_on` as "training_application_modified_on", 
`ww_training_application`.`modified_by` as "training_application_modified_by"
FROM (`ww_training_application`)
LEFT JOIN `ww_training_type` T23 ON `T23`.`type_id` = `ww_training_application`.`allocated`
LEFT JOIN `ww_training_category` T12 ON `T12`.`category_id` = `ww_training_application`.`competency`
LEFT JOIN `ww_training_provider` T7 ON `T7`.`provider_id` = `ww_training_application`.`training_provider`
LEFT JOIN `ww_training_course` T6 ON `T6`.`course_id` = `ww_training_application`.`training_course_id`
LEFT JOIN `ww_training_type` T3 ON `T3`.`type_id` = `ww_training_application`.`training_type`
LEFT JOIN `ww_users` T2 ON `T2`.`user_id` = `ww_training_application`.`user_id`
LEFT JOIN `ww_training_application_status` T4 ON `T4`.`training_application_status_id` = `ww_training_application`.`status`
WHERE (
	ww_training_application.approver_remarks like "%{$search}%" OR 
	ww_training_application.remarks like "%{$search}%" OR 
	ww_training_application.remaining_allocated like "%{$search}%" OR 
	ww_training_application.remaining_stb like "%{$search}%" OR 
	ww_training_application.idp_completion like "%{$search}%" OR 
	ww_training_application.excess_ctb like "%{$search}%" OR 
	ww_training_application.remaining_ctb like "%{$search}%" OR 
	ww_training_application.ctb like "%{$search}%" OR 
	IF(ww_training_application.budgeted = 1, "Yes", "No") like "%{$search}%" OR 
	ww_training_application.excess_stb like "%{$search}%" OR 
	ww_training_application.itb like "%{$search}%" OR 
	ww_training_application.investment like "%{$search}%" OR 
	IF(ww_training_application.service_bond = 1, "Yes", "No") like "%{$search}%" OR 
	ww_training_application.stb like "%{$search}%" OR 
	T23.training_type like "%{$search}%" OR 
	ww_training_application.excess_itb like "%{$search}%" OR 
	ww_training_application.remaining_itb like "%{$search}%" OR 
	ww_training_application.note like "%{$search}%" OR 
	T12.category like "%{$search}%" OR 
	ww_training_application.areas_development like "%{$search}%" OR 
	ww_training_application.total_investment_pgsa like "%{$search}%" OR 
	ww_training_application.total_training_hour like "%{$search}%" OR 
	ww_training_application.venue like "%{$search}%" OR 
	T7.provider like "%{$search}%" OR 
	T6.course like "%{$search}%" OR 
	DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') like "%{$search}%" OR 
	DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') like "%{$search}%" OR 
	T3.training_type like "%{$search}%" OR 
	T2.full_name like "%{$search}%"
)';