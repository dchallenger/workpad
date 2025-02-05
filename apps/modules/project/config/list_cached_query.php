<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_users_project`.`project_id` as record_id, 
ww_users_project.project_code as "users_project_project_code", 
ww_users_project.project as "users_project_project", 
IF(ww_users_project.status_id = 1, "Yes", "No") as "users_project_status_id", 
`ww_users_project`.`created_on` as "users_project_created_on", 
`ww_users_project`.`created_by` as "users_project_created_by", 
`ww_users_project`.`modified_on` as "users_project_modified_on", 
`ww_users_project`.`modified_by` as "users_project_modified_by"
FROM (`ww_users_project`)
WHERE (
	ww_users_project.project_code like "%{$search}%" OR 
	ww_users_project.project like "%{$search}%" OR 
	IF(ww_users_project.status_id = 1, "Yes", "No") like "%{$search}%"
)';