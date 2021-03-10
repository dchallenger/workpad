<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_recruitment_interview_location`.`interview_location_id` as record_id, 
ww_recruitment_interview_location.interview_location as "recruitment_interview_location_interview_location", 
`ww_recruitment_interview_location`.`created_on` as "recruitment_interview_location_created_on", 
`ww_recruitment_interview_location`.`created_by` as "recruitment_interview_location_created_by", 
`ww_recruitment_interview_location`.`modified_on` as "recruitment_interview_location_modified_on", 
`ww_recruitment_interview_location`.`modified_by` as "recruitment_interview_location_modified_by"
FROM (`ww_recruitment_interview_location`)
WHERE (
	ww_recruitment_interview_location.interview_location like "%{$search}%"
)';