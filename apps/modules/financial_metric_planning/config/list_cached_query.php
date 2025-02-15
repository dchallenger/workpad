<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT 
`ww_performance_financial_metric_planning`.`financial_metric_planning_id` as record_id, 
T1.year as "performance_financial_metric_year", 
T2.performance as "performance_financial_performance_for", 
T4.sbu_unit as "performance_financial_metric_planning_sbu_unit", 
ww_performance_financial_metric_planning.title as "performance_financial_metric_planning_title", 
ww_performance_financial_metric_planning.key_in_weight as "performance_financial_metric_planning_key_in_weight", 
ww_performance_financial_metric_planning.user_ids as "performance_financial_metric_planning_user_ids", 
ww_performance_financial_metric_planning.financial_metric_kpi_ids as "performance_financial_metric_planning_financial_metric_kpi_ids", 
ww_performance_financial_metric_planning.remarks as "performance_financial_metric_remarks", 
T1.notes as "performance_financial_metric_planning_planning_id", 
GROUP_CONCAT(DISTINCT T3.full_name SEPARATOR "<br> ") as "performance_financial_metric_planning_employee",
GROUP_CONCAT(DISTINCT T5.financial_metric_kpi SEPARATOR "<br> ") as "performance_financial_metric_planning_kpi",
`ww_performance_financial_metric_planning`.`created_on` as "performance_financial_metric_planning_created_on", 
`ww_performance_financial_metric_planning`.`created_by` as "performance_financial_metric_planning_created_by", 
`ww_performance_financial_metric_planning`.`modified_on` as "performance_financial_metric_planning_modified_on", 
`ww_performance_financial_metric_planning`.`modified_by` as "performance_financial_metric_planning_modified_by"
FROM (`ww_performance_financial_metric_planning`)
LEFT JOIN `ww_performance_planning` T1 ON `T1`.`planning_id` = `ww_performance_financial_metric_planning`.`planning_id`
LEFT JOIN `ww_performance_setup_performance` T2 ON `T1`.`performance_type_id` = `T2`.`performance_id`
LEFT JOIN `ww_users` T3 ON FIND_IN_SET(T3.user_id,ww_performance_financial_metric_planning.user_ids)
LEFT JOIN `ww_users_sbu_unit` T4 ON `ww_performance_financial_metric_planning`.`sbu_unit_id` = `T4`.`sbu_unit_id`
LEFT JOIN `ww_performance_financial_metric_planning_details` T5 ON `ww_performance_financial_metric_planning`.`financial_metric_planning_id` = `T5`.`financial_metric_planning_id`
WHERE (
	ww_performance_financial_metric_planning.key_in_weight like "%{$search}%" OR 
	ww_performance_financial_metric_planning.user_ids like "%{$search}%" OR 
	ww_performance_financial_metric_planning.financial_metric_kpi_ids like "%{$search}%" OR 
	T1.notes like "%{$search}%"
)';