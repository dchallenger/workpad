<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query_custom"] = 'SELECT `ww_partners_personal_request_header`.`personal_request_header_id` AS record_id,
T1.full_name AS "partners_personal_request_header_employee_id",
T2.id_number AS "partners_personal_request_header_id_number",
T3.status AS "partners_personal_request_header_status", 
T3.status_id AS "partners_personal_request_header_status_id", 
ww_partners_personal_request_header.remarks,
T6.key_class,
T6.key_class_id,
`ww_partners_personal_request_header`.`user_id` AS "partners_personal_request_header_user_id",
`ww_partners_personal_request_header`.`created_on` AS "partners_personal_request_header_created_on", 
`ww_partners_personal_request_header`.`created_by` AS "partners_personal_request_header_created_by", 
`ww_partners_personal_request_header`.`modified_on` AS "partners_personal_request_header_modified_on", 
`ww_partners_personal_request_header`.`modified_by` AS "partners_personal_request_header_modified_by"
FROM (`ww_partners_personal_request_header`)
LEFT JOIN `ww_users_profile` T4 ON `T4`.`user_id` = `ww_partners_personal_request_header`.`user_id`
LEFT JOIN `ww_users` T1 ON `T1`.`user_id` = `T4`.`user_id`
LEFT JOIN `ww_partners` T2 ON `T2`.`partner_id` = `T4`.`partner_id`
LEFT JOIN `ww_partners_personal_request_status` T3 ON `T3`.`status_id` = `ww_partners_personal_request_header`.`status`
LEFT JOIN `ww_partners_key_class` T6 ON `ww_partners_personal_request_header`.`key_class_id` = `T6`.`key_class_id`
WHERE ( 
	T1.full_name LIKE "%{$search}%" OR 
	T2.id_number LIKE "%{$search}%"OR 
	T6.key_class LIKE "%{$search}%" OR 
	T6.key_class_code LIKE "%{$search}%"
)';