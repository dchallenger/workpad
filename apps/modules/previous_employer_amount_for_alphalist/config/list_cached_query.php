<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$config["list_cached_query"] = 'SELECT `ww_payroll_partners_previous_employer`.`payroll_partners_previous_employer_id` as record_id, ww_payroll_partners_previous_employer.prev_total_taxable as "payroll_partners_previous_employer_prev_total_taxable",ww_payroll_partners_previous_employer.prev_tax_w_held as "payroll_partners_previous_employer_prev_tax_w_held", ww_payroll_partners_previous_employer.prev_taxable_salaries as "payroll_partners_previous_employer_prev_taxable_salaries", ww_payroll_partners_previous_employer.prev_taxable_thirten_month as "payroll_partners_previous_employer_prev_taxable_thirten_month", ww_payroll_partners_previous_employer.prev_taxable_basic_salary as "payroll_partners_previous_employer_prev_taxable_basic_salary", ww_payroll_partners_previous_employer.prev_nontax_comp_income as "payroll_partners_previous_employer_prev_nontax_comp_income", ww_payroll_partners_previous_employer.prev_nontax_salaries as "payroll_partners_previous_employer_prev_nontax_salaries", ww_payroll_partners_previous_employer.prev_nontax_sss_etc as "payroll_partners_previous_employer_prev_nontax_sss_etc", ww_payroll_partners_previous_employer.prev_nontax_deminimis as "payroll_partners_previous_employer_prev_nontax_deminimis", ww_payroll_partners_previous_employer.prev_nontax_thirten_month as "payroll_partners_previous_employer_prev_nontax_thirten_month", ww_payroll_partners_previous_employer.address as "payroll_partners_previous_employer_address", ww_payroll_partners_previous_employer.company_name as "payroll_partners_previous_employer_company_name", T1.full_name as "payroll_partners_previous_employer_user_id", `ww_payroll_partners_previous_employer`.`created_on` as "payroll_partners_previous_employer_created_on", `ww_payroll_partners_previous_employer`.`created_by` as "payroll_partners_previous_employer_created_by", `ww_payroll_partners_previous_employer`.`modified_on` as "payroll_partners_previous_employer_modified_on", `ww_payroll_partners_previous_employer`.`modified_by` as "payroll_partners_previous_employer_modified_by"
FROM (`ww_payroll_partners_previous_employer`)
LEFT JOIN `ww_users` T1 ON `T1`.`user_id` = `ww_payroll_partners_previous_employer`.`user_id`
WHERE (
	ww_payroll_partners_previous_employer.prev_tax_w_held like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_total_taxable like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_taxable_salaries like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_taxable_thirten_month like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_taxable_basic_salary like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_nontax_comp_income like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_nontax_salaries like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_nontax_sss_etc like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_nontax_deminimis like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.prev_nontax_thirten_month like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.address like "%{$search}%" OR 
	ww_payroll_partners_previous_employer.company_name like "%{$search}%" OR 
	T1.full_name like "%{$search}%"
)';