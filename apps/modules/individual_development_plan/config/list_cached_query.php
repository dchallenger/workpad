<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_performance_appraisal_idp`.`individual_development_plan_id` as record_id, ww_performance_appraisal_idp.idp_completed_planned as "performance_appraisal_idp_idp_completed_planned", ww_performance_appraisal_idp.idp_committed as "performance_appraisal_idp_idp_committed", ww_performance_appraisal_idp.total_budget as "performance_appraisal_idp_total_budget", T1.full_name as "performance_appraisal_idp_user_id", ww_performance_appraisal_idp.stb as "performance_appraisal_idp_stb", ww_performance_appraisal_idp.ctb as "performance_appraisal_idp_ctb", ww_performance_appraisal_idp.itb as "performance_appraisal_idp_itb", `ww_performance_appraisal_idp`.`created_on` as "performance_appraisal_idp_created_on", `ww_performance_appraisal_idp`.`created_by` as "performance_appraisal_idp_created_by", `ww_performance_appraisal_idp`.`modified_on` as "performance_appraisal_idp_modified_on", `ww_performance_appraisal_idp`.`modified_by` as "performance_appraisal_idp_modified_by"
FROM (`ww_performance_appraisal_idp`)
LEFT JOIN `ww_users` T1 ON `T1`.`user_id` = `ww_performance_appraisal_idp`.`user_id`
WHERE (
	ww_performance_appraisal_idp.idp_completed_planned like "%{$search}%" OR 
	ww_performance_appraisal_idp.idp_committed like "%{$search}%" OR 
	ww_performance_appraisal_idp.total_budget like "%{$search}%" OR 
	T1.full_name like "%{$search}%" OR 
	ww_performance_appraisal_idp.stb like "%{$search}%" OR 
	ww_performance_appraisal_idp.ctb like "%{$search}%" OR 
	ww_performance_appraisal_idp.itb like "%{$search}%"
)';