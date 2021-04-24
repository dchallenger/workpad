<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_training_employee_database`.`employee_database_id` as record_id,
`ww_training_employee_database`.`training_course` as "training_employee_database_training_course",
`ww_training_employee_database`.`user_id` as "training_employee_database_user_id",
`ww_training_employee_database`.`start_date` as "training_employee_database_start_date",
`ww_training_employee_database`.`end_date` as "training_employee_database_end_date",
`T2`.`alias` as "training_employee_database_employee",
`T1`.`v_position` as "training_employee_database_position",
`T1`.`v_department` as "training_employee_database_department",
`ww_training_employee_database`.`created_on` as "training_employee_database_created_on", 
`ww_training_employee_database`.`created_by` as "training_employee_database_created_by", 
`ww_training_employee_database`.`modified_on` as "training_employee_database_modified_on", 
`ww_training_employee_database`.`modified_by` as "training_employee_database_modified_by"

FROM (`ww_training_employee_database`)
LEFT JOIN `ww_users_profile` T1 ON `T1`.`user_id` = `ww_training_employee_database`.`user_id`
LEFT JOIN `ww_partners` T2 ON `T2`.`user_id` = `T1`.`user_id`
WHERE (
	T2.alias like "%{$search}%" OR 
	T1.v_position like "%{$search}%" OR 
	T1.v_department like "%{$search}%"
)';