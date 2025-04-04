<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["edit_cached_query"] = 'SELECT 
`ww_payroll_sss_table`.`sss_id` as record_id, 
`ww_payroll_sss_table`.`created_on` as "payroll_sss_table.created_on", 
`ww_payroll_sss_table`.`created_by` as "payroll_sss_table.created_by", 
`ww_payroll_sss_table`.`modified_on` as "payroll_sss_table.modified_on", 
`ww_payroll_sss_table`.`modified_by` as "payroll_sss_table.modified_by", 
ww_payroll_sss_table.from as "payroll_sss_table.from", 
ww_payroll_sss_table.to as "payroll_sss_table.to", 
ww_payroll_sss_table.ershare as "payroll_sss_table.ershare", 
ww_payroll_sss_table.eeshare as "payroll_sss_table.eeshare", 
ww_payroll_sss_table.ec as "payroll_sss_table.ec",
ww_payroll_sss_table.ershare_provident_fund as "payroll_sss_table.ershare_provident_fund", 
ww_payroll_sss_table.eeshare_provident_fund as "payroll_sss_table.eeshare_provident_fund"
FROM (`ww_payroll_sss_table`)
WHERE `ww_payroll_sss_table`.`sss_id` = "{$record_id}"';