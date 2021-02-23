<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_performance_template`.`template_id` as record_id, 
ww_performance_template.template as "performance_template_template", 
ww_performance_template.template_code as "performance_template_template_code", 
ww_performance_template_applicable.applicable_to as "performance_template_applicable_to_id", 
ww_performance_template.applicable_to as "performance_template_applicable_to", 
ww_performance_template.company_id as "performance_template_company_id", 
ww_performance_template.position_classification_id as "performance_template_position_classification_id", 
ww_performance_template.job_grade_id as "performance_template_job_grade_id", 
ww_performance_template.employment_type_id as "performance_template_employment_type_id", 
ww_performance_template.employment_status_id as "performance_template_employment_status_id", 
ww_performance_template.description as "performance_template_description", 
"Undefined Searchable Dropdown" as "performance_template_set_crowdsource_by", 
"Undefined Searchable Dropdown" as "performance_template_max_crowdsource", 
`ww_performance_template`.`created_on` as "performance_template_created_on", 
`ww_performance_template`.`created_by` as "performance_template_created_by", 
`ww_performance_template`.`modified_on` as "performance_template_modified_on", 
`ww_performance_template`.`modified_by` as "performance_template_modified_by"
FROM (`ww_performance_template`)
LEFT JOIN `ww_performance_template_applicable` ON `ww_performance_template_applicable`.`applicable_to_id` = `ww_performance_template`.`applicable_to_id`
LEFT JOIN `ww_users_company` ON `ww_users_company`.`company_id` = `ww_performance_template`.`company_id`
LEFT JOIN `ww_users_position_classification` ON `ww_users_position_classification`.`position_classification_id` = `ww_performance_template`.`position_classification_id`
LEFT JOIN `ww_users_job_grade_level` ON `ww_users_job_grade_level`.`job_grade_id` = `ww_performance_template`.`job_grade_id`
LEFT JOIN `ww_partners_employment_type` ON `ww_partners_employment_type`.`employment_type_id` = `ww_performance_template`.`employment_type_id`
LEFT JOIN `ww_partners_employment_status` ON `ww_partners_employment_status`.`employment_status_id` = `ww_performance_template`.`employment_status_id`
WHERE `ww_performance_template`.`template_id` = "{$record_id}"';