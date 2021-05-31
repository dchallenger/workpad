<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query_custom"] = 'SELECT `ww_partners_personal_request_header`.`personal_request_header_id` as record_id, 
T1.full_name as "partners_personal_request_header_employee_id",
T2.id_number as "partners_personal_request_header_id_number",
T3.status as "partners_personal_request_header_status", 
T3.status_id as "partners_personal_request_header_status_id",  
ww_partners_personal_request_header.remarks as "partners_personal_request_header_remarks",
T5.key_class as "partners_personal_request_header_key_class",
T5.key_class as "partners_personal_request_header_key_class_id",
`ww_partners_personal_request_header`.`user_id` as "partners_personal_request_header_user_id",
`ww_partners_personal_request_header`.`created_on` as "partners_personal_request_header_created_on", 
`ww_partners_personal_request_header`.`created_by` as "partners_personal_request_header_created_by", 
`ww_partners_personal_request_header`.`modified_on` as "partners_personal_request_header_modified_on", 
`ww_partners_personal_request_header`.`modified_by` as "partners_personal_request_header_modified_by",
ppa.user_id AS approver_id
FROM (`ww_partners_personal_request_header`)
LEFT JOIN `ww_users` T1 ON `T1`.`user_id` = `ww_partners_personal_request_header`.`user_id`
LEFT JOIN `ww_partners` T2 ON `T2`.`user_id` = `T1`.`user_id`
LEFT JOIN `ww_partners_personal_request_status` T3 on `T3`.`status_id` = `ww_partners_personal_request_header`.`status`
LEFT JOIN ww_partners_personal_approver ppa ON ww_partners_personal_request_header.personal_request_header_id = ppa.personal_request_header_id
LEFT JOIN `ww_partners_key_class` T5 on `T5`.`key_class_id` = `ww_partners_personal_request_header`.`key_class_id`
WHERE (
	T1.full_name like "%{$search}%" OR 
	T2.id_number like "%{$search}%"
)';