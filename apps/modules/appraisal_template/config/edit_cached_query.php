<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_performance_template`.`template_id` as record_id, 
`ww_performance_template`.`created_on` as "performance_template.created_on", 
`ww_performance_template`.`created_by` as "performance_template.created_by", 
`ww_performance_template`.`modified_on` as "performance_template.modified_on", 
`ww_performance_template`.`modified_by` as "performance_template.modified_by",
ww_performance_template.template as "performance_template.template",
ww_performance_template.template_code as "performance_template.template_code",
ww_performance_template.applicable_to_id as "performance_template.applicable_to_id",
ww_performance_template.applicable_to as "performance_template.applicable_to",
ww_performance_template.company_id as "performance_template.company_id",
ww_performance_template.position_classification_id as "performance_template.position_classification_id",
ww_performance_template.employment_type_id as "performance_template.employment_type_id",
ww_performance_template.job_grade_id as "performance_template.job_grade_id",
ww_performance_template.employment_type_id as "performance_template.employment_type_id",
ww_performance_template.employment_status_id as "performance_template.employment_status_id",
ww_performance_template.description as "performance_template.description",
ww_performance_template.set_crowdsource_by as "performance_template.set_crowdsource_by",
ww_performance_template.max_crowdsource as "performance_template.max_crowdsource"
FROM (`ww_performance_template`)
WHERE `ww_performance_template`.`template_id` = "{$record_id}"';