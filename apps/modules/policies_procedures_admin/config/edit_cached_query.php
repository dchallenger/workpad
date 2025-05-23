<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_resources_policies`.`resource_policy_id` as record_id, 
`ww_resources_policies`.`created_on` as "resources_policies.created_on", 
`ww_resources_policies`.`created_by` as "resources_policies.created_by", 
`ww_resources_policies`.`modified_on` as "resources_policies.modified_on", 
`ww_resources_policies`.`modified_by` as "resources_policies.modified_by", 
ww_resources_policies.attachments as "resources_policies.attachments", 
ww_resources_policies.description as "resources_policies.description", 
ww_resources_policies.category as "resources_policies.category", 
ww_resources_policies.title as "resources_policies.title",
ww_resources_policies.company_id as "resources_policies.company_id"
FROM (`ww_resources_policies`)
WHERE `ww_resources_policies`.`resource_policy_id` = "{$record_id}"';