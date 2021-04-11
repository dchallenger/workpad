<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_users_education_degree_obtained`.`education_degree_obtained_id` as record_id, 
IF(ww_users_education_degree_obtained.status_id = 1, "Yes", "No") as "users_education_degree_obtained_status_id", 
ww_users_education_degree_obtained.education_degree_obtained as "users_education_degree_obtained_education_degree_obtained", 
`ww_users_education_degree_obtained`.`created_on` as "users_education_degree_obtained_created_on", 
`ww_users_education_degree_obtained`.`created_by` as "users_education_degree_obtained_created_by", 
`ww_users_education_degree_obtained`.`modified_on` as "users_education_degree_obtained_modified_on", 
`ww_users_education_degree_obtained`.`modified_by` as "users_education_degree_obtained_modified_by",
ww_users_education_degree_obtained.status_id as "users_education_degree_obtained_status_id", 
ww_users_education_degree_obtained.education_degree_obtained as "users_education_degree_obtained_education_degree_obtained"
FROM (`ww_users_education_degree_obtained`)
WHERE `ww_users_education_degree_obtained`.`education_degree_obtained_id` = "{$record_id}"';