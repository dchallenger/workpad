<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query_custom"] = 'SELECT `ww_partners_personal_request`.`personal_id` as record_id, 
`ww_partners_personal_request`.`key_id` as partners_personal_request_key_id, 
T1.full_name as "partners_personal_request_employee_id",
T2.id_number as "partners_personal_request_id_number",
T3.status as "partners_personal_request_status", 
T3.status_id as "partners_personal_request_status_id",  
T4.key_code as "partners_personal_request_key_code",
T5.key_class as "partners_personal_request_key_class",
COUNT(`ww_partners_personal_request`.`personal_id`) as "partners_personal_request_changes",
`ww_partners_personal_request`.`user_id` as "partners_personal_request_user_id",
`ww_partners_personal_request`.`created_on` as "partners_personal_request_created_on", 
`ww_partners_personal_request`.`created_by` as "partners_personal_request_created_by", 
`ww_partners_personal_request`.`modified_on` as "partners_personal_request_modified_on", 
`ww_partners_personal_request`.`modified_by` as "partners_personal_request_modified_by",
ppa.user_id AS approver_id
FROM (`ww_partners_personal_request`)
LEFT JOIN `ww_users` T1 ON `T1`.`user_id` = `ww_partners_personal_request`.`user_id`
LEFT JOIN `ww_partners` T2 ON `T2`.`user_id` = `T1`.`user_id`
LEFT JOIN `ww_partners_personal_request_status` T3 on `T3`.`status_id` = `ww_partners_personal_request`.`status`
LEFT JOIN ww_partners_personal_approver ppa ON ww_partners_personal_request.personal_id = ppa.personal_request_id
LEFT JOIN `ww_partners_key` T4 on `T4`.`key_id` = `ww_partners_personal_request`.`key_id`
LEFT JOIN `ww_partners_key_class` T5 on `T5`.`key_class_id` = `T4`.`key_class_id`
WHERE (
	T1.full_name like "%{$search}%" OR 
	T2.id_number like "%{$search}%"
)';