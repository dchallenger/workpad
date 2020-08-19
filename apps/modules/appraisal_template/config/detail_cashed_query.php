<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`pt`.`template_id` as record_id, 
`pt`.`created_on` as "performance_template.created_on", 
`pt`.`created_by` as "performance_template.created_by", 
`pt`.`modified_on` as "performance_template.modified_on", 
`pt`.`modified_by` as "performance_template.modified_by", 
pt.template as "performance_template.template", 
pt.template_code as "performance_template.template_code",
pt.applicable_to_id as "performance_template.applicable_to_id",
pt.applicable_to as "performance_template.applicable_to",
pt.company_id as "performance_template.company_id",
pt.position_classification_id as "performance_template.position_classification_id",
pt.job_grade_id as "performance_template.job_grade_id",
pt.employment_type_id as "performance_template.employment_type_id",
pt.description as "performance_template.description",
pt.set_crowdsource_by as "performance_template.set_crowdsource_by",
pt.max_crowdsource as "performance_template.max_crowdsource",
uc.company as "performance_template.company",
upc.position_classification as "performance_template.position_classification",
jg.job_level as "performance_template.job_level",
et.employment_type as "performance_template.employment_type",
es.employment_status as "performance_template.employment_status"
FROM (`ww_performance_template pt`)
LEFT JOIN ww_users_company uc ON pt.company_id = uc.company_id
LEFT JOIN ww_users_position_classification upc ON pt.position_classification_id = upc.position_classification_id
LEFT JOIN ww_users_job_grade_level jg ON pt.job_grade_id = jg.job_grade_id
LEFT JOIN ww_partners_employment_type et ON pt.employment_type_id = et.employment_type_id
LEFT JOIN ww_partners_employment_status es ON pt.employment_status_id = es.employment_status_id
WHERE `pt`.`template_id` = "{$record_id}"';s