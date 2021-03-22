<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["detail_cached_query"] = 'SELECT 
`ww_performance_financial_metric_planning`.`financial_metric_planning_id` as record_id, 
ww_performance_financial_metric_planning.key_in_weight as "performance_financial_metric_planning_key_in_weight",
ww_performance_financial_metric_planning.user_ids as "performance_financial_metric_planning_user_ids",
ww_performance_financial_metric_planning.financial_metric_kpi_ids as "performance_financial_metric_planning_financial_metric_kpi_ids",
ww_performance_financial_metric_planning.planning_id as "performance_financial_metric_planning_planning_id",
ww_performance_financial_metric_planning.title as "performance_financial_metric_planning_title",
ww_performance_financial_metric_planning.remarks as "performance_financial_metric_planning_remarks",
`ww_performance_financial_metric_planning`.`created_on` as "performance_financial_metric_planning_created_on", 
`ww_performance_financial_metric_planning`.`created_by` as "performance_financial_metric_planning_created_by", 
`ww_performance_financial_metric_planning`.`modified_on` as "performance_financial_metric_planning_modified_on", 
`ww_performance_financial_metric_planning`.`modified_by` as "performance_financial_metric_planning_modified_by"
FROM (`ww_performance_financial_metric_planning`)
LEFT JOIN `ww_performance_planning` ON `ww_performance_planning`.`planning_id` = `ww_performance_financial_metric_planning`.`planning_id`
WHERE `ww_performance_financial_metric_planning`.`financial_metric_planning_id` = "{$record_id}"';