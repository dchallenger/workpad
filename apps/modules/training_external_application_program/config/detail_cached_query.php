<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
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
ww_training_type.training_type as "training_application_allocated", 
ww_training_application.excess_itb as "training_application_excess_itb", 
ww_training_application.remaining_itb as "training_application_remaining_itb", 
ww_training_application.note as "training_application_note", 
ww_training_category.category as "training_application_competency", 
ww_training_application.areas_development as "training_application_areas_development", 
ww_training_application.total_investment_pgsa as "training_application_total_investment_pgsa", 
ww_training_application.total_training_hour as "training_application_total_training_hour", 
ww_training_application.venue as "training_application_venue", 
ww_training_provider.provider as "training_application_training_provider", 
ww_training_course.course as "training_application_training_course_id", 
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application_date_to", 
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application_date_from", 
ww_training_type.training_type as "training_application_training_type", 
ww_users.full_name as "training_application_user_id", 
`ww_training_application`.`created_on` as "training_application_created_on", 
`ww_training_application`.`created_by` as "training_application_created_by", 
`ww_training_application`.`modified_on` as "training_application_modified_on", 
`ww_training_application`.`modified_by` as "training_application_modified_by"
FROM (`ww_training_application`)
LEFT JOIN `ww_training_type` ON `ww_training_type`.`type_id` = `ww_training_application`.`allocated`
LEFT JOIN `ww_training_category` ON `ww_training_category`.`category_id` = `ww_training_application`.`competency`
LEFT JOIN `ww_training_provider` ON `ww_training_provider`.`provider_id` = `ww_training_application`.`training_provider`
LEFT JOIN `ww_training_course` ON `ww_training_course`.`course_id` = `ww_training_application`.`training_course_id`
LEFT JOIN `ww_training_type` ON `ww_training_type`.`type_id` = `ww_training_application`.`training_type`
LEFT JOIN `ww_users` ON `ww_users`.`user_id` = `ww_training_application`.`user_id`
WHERE `ww_training_application`.`training_application_id` = "{$record_id}"';