<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT `ww_users_compensation`.`compensation_id` as record_id, 
	`ww_users_compensation`.`created_on` as "users_compensation.created_on", 
	`ww_users_compensation`.`created_by` as "users_compensation.created_by", 
	`ww_users_compensation`.`modified_on` as "users_compensation.modified_on",
	`ww_users_compensation`.`modified_by` as "users_compensation.modified_by", 
	ww_users_compensation.status_id as "users_compensation.status_id", 
	ww_users_compensation.description as "users_compensation.description", 
	ww_users_compensation.compensation as "users_compensation.compensation"
FROM (`ww_users_compensation`)
WHERE `ww_users_compensation`.`compensation_id` = "{$record_id}"';