<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_resources_request`.`request_id` as record_id, 
`ww_resources_request`.`created_on` as "resources_request.created_on", 
`ww_resources_request`.`created_by` as "resources_request.created_by", 
`ww_resources_request`.`modified_on` as "resources_request.modified_on", 
`ww_resources_request`.`modified_by` as "resources_request.modified_by", 
ww_resources_request.user_id as "resources_request.user_id", 
ww_resources_request_upload.upload_id as "resources_request_upload.upload_id", 
ww_resources_request_upload_hr.upload_id as "resources_request_upload_hr.upload_id",
ww_resources_request.reason as "resources_request.reason", 
ww_resources_request.remarks as "resources_request.remarks", 
DATE_FORMAT(ww_resources_request.date_needed, \'%M %d, %Y\') as "resources_request.date_needed", 
ww_resources_request.request as "resources_request.request",
ww_partners_online_request_type.online_request_type as "resources_request.online_request_type",
`ww_resources_request`.`request_status_id` as request_status_id, 
`ww_resources_request`.`status` as status
FROM (`ww_resources_request`)
LEFT JOIN `ww_resources_request_upload` ON `ww_resources_request_upload`.`request_id` = `ww_resources_request`.`request_id`
LEFT JOIN `ww_resources_request_upload_hr` ON `ww_resources_request_upload_hr`.`request_id` = `ww_resources_request`.`request_id`
LEFT JOIN `ww_partners_online_request_type` ON `ww_partners_online_request_type`.`online_request_type_id` = `ww_resources_request`.`request`
WHERE `ww_resources_request`.`request_id` = "{$record_id}"';