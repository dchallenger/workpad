<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
	`ww_users_benefit`.`benefit_id` as record_id, 
	IF(ww_users_benefit.status_id = 1, "Yes", "No") as "users_benefit_status_id", 
	ww_users_benefit.description as "users_benefit_description", 
	ww_users_benefit.benefit_type as "users_benefit_benefit_type", 
	uc.company as "users_benefit_company", 
	jgl.job_level as "users_benefit_job_level", 
	IF(ww_users_benefit.old_new = 1, "New", "Old") as "users_benefit_benefit_package", 
	`ww_users_benefit`.`created_on` as "users_benefit_created_on", 
	`ww_users_benefit`.`created_by` as "users_benefit_created_by", 
	`ww_users_benefit`.`modified_on` as "users_benefit_modified_on", 
	`ww_users_benefit`.`modified_by` as "users_benefit_modified_by"
FROM (`ww_users_benefit`)
left join ww_users_company uc on ww_users_benefit.company_id = uc.company_id
left join ww_users_job_grade_level jgl on ww_users_benefit.job_grade_id = jgl.job_grade_id
WHERE (
	ww_users_benefit.description like "%{$search}%" OR 
	ww_users_benefit.benefit_type like "%{$search}%"
)';