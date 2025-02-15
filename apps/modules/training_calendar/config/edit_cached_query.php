<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_training_calendar`.`training_calendar_id` as record_id, 
`ww_training_calendar`.`created_on` as "training_calendar.created_on", 
`ww_training_calendar`.`created_by` as "training_calendar.created_by", 
`ww_training_calendar`.`modified_on` as "training_calendar.modified_on", 
`ww_training_calendar`.`modified_by` as "training_calendar.modified_by",  
DATE_FORMAT(ww_training_calendar.revalida_date, \'%M %d, %Y\') as "training_calendar.revalida_date", 
ww_training_calendar.planned as "training_calendar.planned", 
ww_training_calendar.with_certification as "training_calendar.with_certification", 
ww_training_calendar.training_revalida_master_id as "training_calendar.training_revalida_master_id",
DATE_FORMAT(ww_training_calendar.publish_date, \'%M %d, %Y\') as "training_calendar.publish_date", 
DATE_FORMAT(ww_training_calendar.last_registration_date, \'%M %d, %Y\') as "training_calendar.last_registration_date", 
ww_training_calendar.cost_per_pax as "training_calendar.cost_per_pax", 
DATE_FORMAT(ww_training_calendar.registration_date, \'%M %d, %Y\') as "training_calendar.registration_date", 
ww_training_calendar.topic as "training_calendar.topic", 
ww_training_calendar.training_title as "training_calendar.training_title",
ww_training_calendar.venue as "training_calendar.venue", 
ww_training_calendar.equipment as "training_calendar.equipment", 
ww_training_calendar.tba as "training_calendar.tba", 
ww_training_calendar.training_capacity as "training_calendar.training_capacity", 
ww_training_calendar.min_training_capacity as "training_calendar.min_training_capacity", 
tp.provider as "training_calendar.training_provider",
tc.category as "training_calendar.training_category",
ww_training_calendar.evaluation_template_id as "training_calendar.evaluation_template_id",
ww_training_calendar.training_category_id as "training_calendar.training_category_id", 
ww_training_calendar.training_provider_id as "training_calendar.training_provider_id", 
ww_training_calendar.training_calendar_id as "training_calendar.training_calendar_id", 
ww_training_calendar.calendar_type_id as "training_calendar.calendar_type_id", 
ww_training_calendar.course_id as "training_calendar.course_id", 
ww_training_calendar.location_id as "training_calendar.location_id", 
ww_training_calendar.company_id as "training_calendar.company_id",
ww_training_calendar.division_id as "training_calendar.division_id", 
ww_training_calendar.department_id as "training_calendar.department_id", 
ww_training_calendar.employees as "training_calendar.employees", 
ww_training_calendar.total_cost as "training_calendar.total_cost",
ww_training_calendar.total_pax as "training_calendar.total_pax"
FROM (`ww_training_calendar`)
LEFT JOIN ww_training_provider tp on ww_training_calendar.training_provider_id = tp.provider_id
LEFT JOIN ww_training_category tc on ww_training_calendar.training_category_id = tc.category_id
WHERE `ww_training_calendar`.`training_calendar_id` = "{$record_id}"';