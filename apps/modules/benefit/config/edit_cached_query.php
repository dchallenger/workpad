<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
	`ww_users_benefit`.`benefit_id` as record_id, 
	`ww_users_benefit`.`created_on` as "users_benefit.created_on", 
	`ww_users_benefit`.`created_by` as "users_benefit.created_by", 
	`ww_users_benefit`.`modified_on` as "users_benefit.modified_on", 
	`ww_users_benefit`.`modified_by` as "users_benefit.modified_by", 
	ww_users_benefit.description as "users_benefit.description", 
	ww_users_benefit.benefit_type as "users_benefit.benefit_type", 
	ww_users_benefit.status_id as "users_benefit.status_id",
	ww_users_benefit.company_id as "users_benefit.company_id",
	ww_users_benefit.job_grade_id as "users_benefit.job_grade_id",
	ww_users_benefit.old_new as "users_benefit.old_new"
FROM (`ww_users_benefit`)
WHERE `ww_users_benefit`.`benefit_id` = "{$record_id}"';