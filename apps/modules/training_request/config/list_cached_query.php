<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_training_application`.`training_application_id` as record_id, 
ww_training_application.attachment as "training_application_attachment", 
ww_training_application.note as "training_application_note", 
T12.category as "training_application_competency", 
T11.appraisal_areas_development as "training_application_areas_development", 
ww_training_application.total_investment_pgsa as "training_application_total_investment_pgsa", 
ww_training_application.total_training_hour as "training_application_total_training_hour", 
ww_training_application.venue as "training_application_venue", 
T7.provider as "training_application_training_provider", 
T6.course as "training_application_training_course", 
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application_date_to", 
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application_date_from", 
T3.calendar_type as "training_application_training_type", 
`ww_training_application`.`created_on` as "training_application_created_on", 
T4.training_application_status as "training_application_training_application_status",
T4.training_application_status_id as "training_application_training_application_status_id",
`ww_training_application`.`created_by` as "training_application_created_by", `ww_training_application`.`modified_on` as "training_application_modified_on", 
`ww_training_application`.`modified_by` as "training_application_modified_by"
FROM (`ww_training_application`)
LEFT JOIN `ww_training_category` T12 ON `T12`.`category_id` = `ww_training_application`.`competency`
LEFT JOIN `ww_performance_appraisal_areas_development` T11 ON `T11`.`appraisal_areas_development_id` = `ww_training_application`.`areas_development`
LEFT JOIN `ww_training_provider` T7 ON `T7`.`provider_id` = `ww_training_application`.`training_provider`
LEFT JOIN `ww_training_course` T6 ON `T6`.`course_id` = `ww_training_application`.`training_course_id`
LEFT JOIN `ww_training_calendar_type` T3 ON `T3`.`calendar_type_id` = `ww_training_application`.`training_type`
LEFT JOIN `ww_training_application_status` T4 ON `T4`.`training_application_status_id` = `ww_training_application`.`status_id`
WHERE (
	ww_training_application.attachment like "%{$search}%" OR 
	ww_training_application.note like "%{$search}%" OR 
	T12.category like "%{$search}%" OR 
	T11.appraisal_areas_development like "%{$search}%" OR 
	ww_training_application.total_investment_pgsa like "%{$search}%" OR 
	ww_training_application.total_training_hour like "%{$search}%" OR 
	ww_training_application.venue like "%{$search}%" OR 
	T7.provider like "%{$search}%" OR 
	T6.course like "%{$search}%" OR 
	DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') like "%{$search}%" OR 
	DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') like "%{$search}%" OR 
	T3.calendar_type like "%{$search}%"
)';