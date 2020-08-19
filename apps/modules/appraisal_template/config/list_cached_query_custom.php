<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query_custom"] = 'SELECT 
`pt`.`template_id` as record_id, 
pt.template as "performance_template_template", 
pt.template_code as "performance_template_template_code",
pt.applicable_to_id as "applicable_to_id",
T3.applicable_to as "performance_template_applicable_to_id",
pt.applicable_to as "performance_template_applicable_to", 
pt.description as "performance_template_description", 
`pt`.`created_on` as "performance_template_created_on", 
`pt`.`created_by` as "performance_template_created_by", 
`pt`.`modified_on` as "performance_template_modified_on", 
`pt`.`modified_by` as "performance_template_modified_by",
uc.company as "performance_template_company",
upc.position_classification as "performance_template_position_classification",
jg.job_level as "performance_template_job_level",
et.employment_type as "performance_template_employment_type",
es.employment_status as "performance_template_employment_status"
FROM (`ww_performance_template` pt)
LEFT JOIN `ww_performance_template_applicable` T3 ON `T3`.`applicable_to_id` = `pt`.`applicable_to_id`
LEFT JOIN ww_users_company uc ON pt.company_id = uc.company_id
LEFT JOIN ww_users_position_classification upc ON pt.position_classification_id = upc.position_classification_id
LEFT JOIN ww_users_job_grade_level jg ON pt.job_grade_id = jg.job_grade_id
LEFT JOIN ww_partners_employment_type et ON pt.employment_type_id = et.employment_type_id
LEFT JOIN ww_partners_employment_status es ON pt.employment_status_id = es.employment_status_id
WHERE (
	pt.template like "%{$search}%" OR 
	pt.template_code like "%{$search}%" OR 
	T3.applicable_to like "%{$search}%" OR 
	pt.applicable_to like "%{$search}%" OR 
	pt.description like "%{$search}%"
)';