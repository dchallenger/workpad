<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_resources_downloadable`.`resource_download_id` as record_id, 
`ww_resources_downloadable`.`created_on` as "resources_downloadable.created_on", 
`ww_resources_downloadable`.`created_by` as "resources_downloadable.created_by", 
`ww_resources_downloadable`.`modified_on` as "resources_downloadable.modified_on", 
`ww_resources_downloadable`.`modified_by` as "resources_downloadable.modified_by", 
ww_resources_downloadable.attachments as "resources_downloadable.attachments", 
ww_resources_downloadable.description as "resources_downloadable.description", 
ww_resources_downloadable.category as "resources_downloadable.category", 
ww_resources_downloadable.title as "resources_downloadable.title",
ww_resources_downloadable.company_id as "resources_downloadable.company_id"
FROM (`ww_resources_downloadable`)
WHERE `ww_resources_downloadable`.`resource_download_id` = "{$record_id}"';