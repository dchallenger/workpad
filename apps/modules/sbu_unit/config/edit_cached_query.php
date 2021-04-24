<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT `ww_users_sbu_unit`.`sbu_unit_id` as record_id, 
`ww_users_sbu_unit`.`created_on` as "users_sbu_unit.created_on", 
`ww_users_sbu_unit`.`created_by` as "users_sbu_unit.created_by", 
`ww_users_sbu_unit`.`modified_on` as "users_sbu_unit.modified_on", 
`ww_users_sbu_unit`.`modified_by` as "users_sbu_unit.modified_by", 
ww_users_sbu_unit.status_id as "users_sbu_unit.status_id", 
ww_users_sbu_unit.sbu_unit as "users_sbu_unit.sbu_unit",
ww_users_sbu_unit.percentage as "users_sbu_unit.percentage"
FROM (`ww_users_sbu_unit`)
WHERE `ww_users_sbu_unit`.`sbu_unit_id` = "{$record_id}"';