<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_training_application`.`training_application_id` as record_id, 
ww_training_application.attachment as "training_application_attachment", 
ww_training_application.note as "training_application_note", 
ww_training_application.user_id as "training_application_user_id", 
ww_training_application.competency as "training_application_competency",
ww_training_application.areas_development as "training_application_areas_development",
ww_training_application.total_investment_pgsa as "training_application_total_investment_pgsa", 
ww_training_application.total_training_hour as "training_application_total_training_hour", 
ww_training_application.venue as "training_application_venue", 
ww_training_application.training_provider as "training_application_training_provider",
ww_training_application.training_course_id as "training_application_training_course_id",
ww_training_application.training_calendar_id as "training_application_training_calendar_id",
ww_training_application.status_id as "training_application_training_status_id",
ww_training_application.hr_remarks as "training_application_hr_remarks",
ww_users.full_name as "training_application_user",
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application_date_to", 
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application_date_from", 
ww_training_application.training_type as "training_application_training_type", 
`ww_training_application`.`created_on` as "training_application_created_on", 
`ww_training_application`.`created_by` as "training_application_created_by", 
`ww_training_application`.`modified_on` as "training_application_modified_on", 
`ww_training_application`.`modified_by` as "training_application_modified_by"
FROM (`ww_training_application`)
LEFT JOIN `ww_training_category` ON `ww_training_category`.`category_id` = `ww_training_application`.`competency`
LEFT JOIN `ww_performance_appraisal_areas_development` ON `ww_performance_appraisal_areas_development`.`appraisal_areas_development_id` = `ww_training_application`.`areas_development`
LEFT JOIN `ww_training_provider` ON `ww_training_provider`.`provider_id` = `ww_training_application`.`training_provider`
LEFT JOIN `ww_training_course` ON `ww_training_course`.`course_id` = `ww_training_application`.`training_course_id`
LEFT JOIN `ww_training_type` ON `ww_training_type`.`type_id` = `ww_training_application`.`training_type`
LEFT JOIN `ww_users` ON `ww_users`.`user_id` = `ww_training_application`.`user_id`
WHERE `ww_training_application`.`training_application_id` = "{$record_id}"';