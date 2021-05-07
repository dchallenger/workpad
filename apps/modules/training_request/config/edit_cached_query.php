<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_training_application`.`training_application_id` as record_id,
`ww_training_application`.`created_on` as "training_application.created_on",
`ww_training_application`.`created_by` as "training_application.created_by",
`ww_training_application`.`modified_on` as "training_application.modified_on",
`ww_training_application`.`modified_by` as "training_application.modified_by",
ww_training_application.attachment as "training_application.attachment",
ww_training_application.note as "training_application.note",
ww_training_application.training_calendar_id as "training_application.training_calendar_id",
ww_training_application.status_id as "training_application.status_id",
ww_training_application.competency as "training_application.competency",
ww_training_application.areas_development as "training_application.areas_development",
ww_training_application.total_investment_pgsa as "training_application.total_investment_pgsa",
ww_training_application.total_training_hour as "training_application.total_training_hour",
ww_training_application.venue as "training_application.venue",
ww_training_application.training_provider as "training_application.training_provider",
ww_training_application.training_course_id as "training_application.training_course_id",
ww_training_application.include_idp as "training_application.include_idp",
DATE_FORMAT(ww_training_application.date_to, \'%M %d, %Y\') as "training_application.date_to",
DATE_FORMAT(ww_training_application.date_from, \'%M %d, %Y\') as "training_application.date_from",
ww_training_application.training_type as "training_application.training_type"
FROM (`ww_training_application`)
WHERE `ww_training_application`.`training_application_id` = "{$record_id}"';