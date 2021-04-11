<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_users_education_school`.`education_school_id` as record_id, 
IF(ww_users_education_school.status_id = 1, "Active", "Inactive") as "users_education_school_status_id", 
ww_users_education_school.education_school as "users_education_school_education_school", 
ww_users_education_school.can_delete as "can_delete",
`ww_users_education_school`.`created_on` as "users_education_school_created_on", 
`ww_users_education_school`.`created_by` as "users_education_school_created_by", 
`ww_users_education_school`.`modified_on` as "users_education_school_modified_on", 
`ww_users_education_school`.`modified_by` as "users_education_school_modified_by"
FROM (`ww_users_education_school`)
WHERE (
	IF(ww_users_education_school.status_id = 1, "Yes", "No") like "%{$search}%" OR 
	ww_users_education_school.education_school like "%{$search}%"
)';