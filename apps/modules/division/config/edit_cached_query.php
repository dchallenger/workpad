<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_users_division`.`division_id` as record_id, 
`ww_users_division`.`created_on` as "users_division.created_on", 
`ww_users_division`.`created_by` as "users_division.created_by", 
`ww_users_division`.`modified_on` as "users_division.modified_on", 
`ww_users_division`.`modified_by` as "users_division.modified_by", 
ww_users_division.company_id as "users_division.company_id", 
ww_users_division.division as "users_division.division", 
ww_users_division.division_code as "users_division.division_code", 
ww_users_division.cost_center_code as "users_division.cost_center_code", 
ww_users_division.immediate_id as "users_division.immediate_id", 
ww_users_division.position as "users_division.position", 
ww_users_division.status_id as "users_division.status_id"
FROM (`ww_users_division`)
WHERE `ww_users_division`.`division_id` = "{$record_id}"';