<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_certificate_of_employment`.`coe_id` as record_id, 
ww_certificate_of_employment.display_name as "certificate_of_employment_display_name",
ww_certificate_of_employment.coe_type as "certificate_of_employment_coe_type",
`ww_certificate_of_employment`.`created_on` as "certificate_of_employment_created_on", 
`ww_certificate_of_employment`.`created_by` as "certificate_of_employment_created_by", 
`ww_certificate_of_employment`.`modified_on` as "certificate_of_employment_modified_on", 
`ww_certificate_of_employment`.`modified_by` as "certificate_of_employment_modified_by"
FROM (`ww_certificate_of_employment`)
WHERE (
	ww_certificate_of_employment.display_name like "%{$search}%"
)';