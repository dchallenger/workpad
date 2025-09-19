<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
	`ww_users_compensation`.`compensation_id` as record_id, 
	IF(ww_users_compensation.status_id = 1, "Yes", "No") as "users_compensation_status_id", 
	ww_users_compensation.description as "users_compensation_description", 
	ww_users_compensation.compensation as "users_compensation_compensation", 
	`ww_users_compensation`.`created_on` as "users_compensation_created_on", 
	`ww_users_compensation`.`created_by` as "users_compensation_created_by", 
	`ww_users_compensation`.`modified_on` as "users_compensation_modified_on", 
	`ww_users_compensation`.`modified_by` as "users_compensation_modified_by", 
	IF(ww_users_compensation.status_id = 1, "Yes", "No") as "users_compensation_status_id", 
	ww_users_compensation.description as "users_compensation_description", 
	ww_users_compensation.compensation as "users_compensation_compensation"
FROM (`ww_users_compensation`)
WHERE `ww_users_compensation`.`compensation_id` = "{$record_id}"';