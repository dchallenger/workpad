<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_performance_financial_metric_planning`.`financial_metric_planning_id` as record_id, 
`ww_performance_financial_metric_planning`.`created_on` as "performance_financial_metric_planning.created_on", 
`ww_performance_financial_metric_planning`.`created_by` as "performance_financial_metric_planning.created_by", 
`ww_performance_financial_metric_planning`.`modified_on` as "performance_financial_metric_planning.modified_on", 
`ww_performance_financial_metric_planning`.`modified_by` as "performance_financial_metric_planning.modified_by",
ww_performance_financial_metric_planning.key_in_weight as "performance_financial_metric_planning.key_in_weight",
ww_performance_financial_metric_planning.user_ids as "performance_financial_metric_planning.user_ids",
ww_performance_financial_metric_planning.financial_metric_kpi_ids as "performance_financial_metric_planning.financial_metric_kpi_ids",
ww_performance_financial_metric_planning.planning_id as "performance_financial_metric_planning.planning_id"
FROM (`ww_performance_financial_metric_planning`)
WHERE `ww_performance_financial_metric_planning`.`financial_metric_planning_id` = "{$record_id}"';