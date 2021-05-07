<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_training_application`.`training_application_id` as record_id,
ww_training_application.note as "training_application_note",
ww_training_application.competency as "training_application_competency",
ww_training_application.areas_development as "training_application_areas_development",
ww_training_application.total_investment_pgsa as "training_application_total_investment_pgsa",
ww_training_application.total_training_hour as "training_application_total_training_hour",
ww_training_application.venue as "training_application_venue",
ww_training_application.training_provider as "training_application_training_provider",
ww_training_application.training_course_id as "training_application_training_course_id",
ww_training_application.training_calendar_id as "training_application_training_calendar_id",
ww_training_application.include_idp as "training_application_include_idp",
ww_training_application.hr_remarks as "training_application_hr_remarks", 
ww_training_application.status_id as "training_application_status_id", 
ww_training_application_status.training_application_status as "training_application_training_application_status",
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application_date_to",
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application_date_from",
ww_training_application.training_type as "training_application_training_type",
ww_training_application.attachment as "training_application_attachment",
`ww_training_application`.`created_on` as "training_application_created_on",
`ww_training_application`.`created_by` as "training_application_created_by",
`ww_training_application`.`modified_on` as "training_application_modified_on",
`ww_training_application`.`modified_by` as "training_application_modified_by"
FROM (`ww_training_application`)
LEFT JOIN `ww_training_category` ON `ww_training_category`.`category_id` = `ww_training_application`.`competency`
LEFT JOIN `ww_training_provider` ON `ww_training_provider`.`provider_id` = `ww_training_application`.`training_provider`
LEFT JOIN `ww_training_course` ON `ww_training_course`.`course_id` = `ww_training_application`.`training_course_id`
LEFT JOIN `ww_training_calendar_type` ON `ww_training_calendar_type`.`calendar_type_id` = `ww_training_application`.`training_type`
LEFT JOIN `ww_training_application_status` ON `ww_training_application_status`.`training_application_status_id` = `ww_training_application`.`status`
WHERE `ww_training_application`.`training_application_id` = "{$record_id}"';