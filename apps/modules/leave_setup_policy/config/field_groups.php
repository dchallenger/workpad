<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][2] = array(
	'fg_id' => 2,
	'label' => 'Policy Setup',
	'description' => '',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(
		'time_form_balance_setup_policy.company_ids',
		'time_form_balance_setup_policy.employment_type_ids',
		'time_form_balance_setup_policy.employment_status_ids',
		'time_form_balance_setup_policy.description',		
		'time_form_balance_setup_policy.form_id',
		'time_form_balance_setup_policy.accumulation_type',
		'time_form_balance_setup_policy.credit_1_15',
		'time_form_balance_setup_policy.credit_16_31',
		'time_form_balance_setup_policy.credit',
		'time_form_balance_setup_policy.max_credit'
		'time_form_balance_setup_policy.prorated'
		'time_form_balance_setup_policy.leave_reset_date'
	)
);
