<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_audit_log_trail`.`audit_log_trail_id` as record_id,
`ww_audit_log_trail`.`date_time` as "date_time",
`ww_audit_log_trail`.`modules` as "modules",
`ww_audit_log_trail`.`item_name` as "item_name",
`ww_audit_log_trail`.`original_value` as "original_value",
`ww_audit_log_trail`.`new_value` as "new_value",
`ww_audit_log_trail`.`transaction` as "transaction",
`ww_audit_log_trail`.`user` as "user_encoded"
FROM (`ww_audit_log_trail`)
WHERE (	`ww_audit_log_trail`.`date_time` like "%{$search}%" OR 
			ww_audit_log_trail.modules like "%{$search}%" OR 
			ww_audit_log_trail.item_name like "%{$search}%" OR 
			ww_audit_log_trail.original_value like "%{$search}%" OR 
			ww_audit_log_trail.new_value like "%{$search}%" OR 
			ww_audit_log_trail.transaction like "%{$search}%" OR 
			ww_audit_log_trail.user like "%{$search}%"
			 )';