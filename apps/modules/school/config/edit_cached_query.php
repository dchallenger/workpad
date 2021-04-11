<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_users_education_school`.`education_school_id` as record_id, 
`ww_users_education_school`.`created_on` as "users_education_school.created_on", 
`ww_users_education_school`.`created_by` as "users_education_school.created_by", 
`ww_users_education_school`.`modified_on` as "users_education_school.modified_on", 
`ww_users_education_school`.`modified_by` as "users_education_school.modified_by", 
ww_users_education_school.status_id as "users_education_school.status_id", 
ww_users_education_school.education_school as "users_education_school.education_school"
FROM (`ww_users_education_school`)
WHERE `ww_users_education_school`.`education_school_id` = "{$record_id}"';