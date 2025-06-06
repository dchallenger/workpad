<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_performance_setup_financial_metrics_kpi`.`financial_metrics_kpi_id` as record_id, IF(ww_performance_setup_financial_metrics_kpi.status_id = 1, "Yes", "No") as "performance_setup_financial_metrics_kpi_status_id", ww_performance_setup_financial_metrics_kpi.financial_metrics_kpi as "performance_setup_financial_metrics_kpi_financial_metrics_kpi", `ww_performance_setup_financial_metrics_kpi`.`created_on` as "performance_setup_financial_metrics_kpi_created_on", `ww_performance_setup_financial_metrics_kpi`.`created_by` as "performance_setup_financial_metrics_kpi_created_by", `ww_performance_setup_financial_metrics_kpi`.`modified_on` as "performance_setup_financial_metrics_kpi_modified_on", `ww_performance_setup_financial_metrics_kpi`.`modified_by` as "performance_setup_financial_metrics_kpi_modified_by"
FROM (`ww_performance_setup_financial_metrics_kpi`)
WHERE (
	IF(ww_performance_setup_financial_metrics_kpi.status_id = 1, "Yes", "No") like "%{$search}%" OR 
	ww_performance_setup_financial_metrics_kpi.financial_metrics_kpi like "%{$search}%"
)';