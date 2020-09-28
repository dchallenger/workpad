<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fieldgroups'] = array();
$config['fieldgroups'][1] = array(
	'fg_id' => 1,
	'label' => 'FCC Setup',
	'description' => 'Forfeiture, carry over and conversion setup',
	'display_id' => 3,
	'sequence' => 1,
	'active' => 1,
	'fields' => array(	
		'time_form_balance_fcc_setup.in_excess_to_forfeit',
		'time_form_balance_fcc_setup.in_excess_to_pay',
		'time_form_balance_fcc_setup.max_balance_carry_over',
		'time_form_balance_fcc_setup.form_id',
		'time_form_balance_fcc_setup.description',
		'time_form_balance_fcc_setup.employment_status_ids',
		'time_form_balance_fcc_setup.employment_type_ids',
		'time_form_balance_fcc_setup.company_ids'
	)
);
