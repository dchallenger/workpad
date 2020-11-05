<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT `ww_time_form_class_policy`.`id` as record_id, 
ww_time_form_class_policy.severity as "time_form_class_policy_severity", 
ww_time_form_class_policy.role_id as "time_form_class_policy_role_id", 
ww_time_form_class_policy.employment_type_id as "time_form_class_policy_employment_type_id",
 ww_time_form_class_policy.employment_status_id as "time_form_class_policy_employment_status_id", 
 ww_time_form_class_policy.group_id as "time_form_class_policy_group_id", 
 ww_time_form_class_policy.department_id as "time_form_class_policy_department_id", 
 ww_time_form_class_policy.division_id as "time_form_class_policy_division_id", 
 ww_time_form_class_policy.company_id as "time_form_class_policy_company_id", 
 ww_time_form_class_policy.job_grade_id as "time_form_class_policy_job_grade_id", 
 ww_time_form_class_policy.description as "time_form_class_policy_description", 
 ww_time_form_class_policy.class_value as "time_form_class_policy_class_value", 
 ww_time_form_class.class_id as "time_form_class_policy_class_id", 
 `ww_time_form_class_policy`.`created_on` as "time_form_class_policy_created_on", 
 `ww_time_form_class_policy`.`created_by` as "time_form_class_policy_created_by", 
 `ww_time_form_class_policy`.`modified_on` as "time_form_class_policy_modified_on", 
 `ww_time_form_class_policy`.`modified_by` as "time_form_class_policy_modified_by"
FROM (`ww_time_form_class_policy`)
LEFT JOIN `ww_time_form_class` ON `ww_time_form_class`.`class_id` = `ww_time_form_class_policy`.`class_id`
WHERE `ww_time_form_class_policy`.`id` = "{$record_id}"';