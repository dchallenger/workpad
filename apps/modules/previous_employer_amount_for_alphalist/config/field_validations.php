<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['field_validations'] = array();
$config['field_validations']['payroll_partners_previous_employer.prev_tax_w_held'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_tax_w_held]',
	'label'   => 'Previous Total Taxable',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_total_taxable'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_total_taxable]',
	'label'   => 'Previous Total Taxable',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_taxable_salaries'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_taxable_salaries]',
	'label'   => 'Previous Taxable Salaries',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_taxable_thirten_month'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_taxable_thirten_month]',
	'label'   => 'Previous Taxable Thirteenth Month',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_taxable_basic_salary'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_taxable_basic_salary]',
	'label'   => 'Previoius Taxable Basic Salary',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_nontax_comp_income'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_nontax_comp_income]',
	'label'   => 'Previous Nontax Comp Income',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_nontax_salaries'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_nontax_salaries]',
	'label'   => 'Previous Nontax Salaries',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_nontax_sss_etc'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_nontax_sss_etc]',
	'label'   => 'Previous Nontax SSS Etc',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_nontax_deminimis'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_nontax_deminimis]',
	'label'   => 'Previous Nontax Deminimis',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.prev_nontax_thirten_month'][] = array(
	'field'   => 'payroll_partners_previous_employer[prev_nontax_thirten_month]',
	'label'   => 'Previous Nontax Thirteenth Month',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.address'][] = array(
	'field'   => 'payroll_partners_previous_employer[address]',
	'label'   => 'Previous Company Address',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.company_name'][] = array(
	'field'   => 'payroll_partners_previous_employer[company_name]',
	'label'   => 'Previous Company Name',
	'rules'   => 'required'
);
$config['field_validations']['payroll_partners_previous_employer.user_id'][] = array(
	'field'   => 'payroll_partners_previous_employer[user_id]',
	'label'   => 'Employee Name',
	'rules'   => 'required'
);
