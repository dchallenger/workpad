<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['fields'] = array();
$config['fields'][1]['modules.short_name'] = array(
	'f_id' => 16,
	'fg_id' => 1,
	'label' => 'Module Name',
	'description' => '',
	'table' => 'modules',
	'column' => 'short_name',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['modules.long_name'] = array(
	'f_id' => 2,
	'fg_id' => 1,
	'label' => 'Descriptive Name',
	'description' => '',
	'table' => 'modules',
	'column' => 'long_name',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['modules.description'] = array(
	'f_id' => 3,
	'fg_id' => 1,
	'label' => 'Module Description',
	'description' => '',
	'table' => 'modules',
	'column' => 'description',
	'uitype_id' => 2,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][1]['modules.disabled'] = array(
	'f_id' => 4,
	'fg_id' => 1,
	'label' => 'Disable',
	'description' => '',
	'table' => 'modules',
	'column' => 'disabled',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.mod_code'] = array(
	'f_id' => 5,
	'fg_id' => 2,
	'label' => 'Module Code',
	'description' => '',
	'table' => 'modules',
	'column' => 'mod_code',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.route'] = array(
	'f_id' => 6,
	'fg_id' => 2,
	'label' => 'Route',
	'description' => '',
	'table' => 'modules',
	'column' => 'route',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.table'] = array(
	'f_id' => 7,
	'fg_id' => 2,
	'label' => 'Main Table',
	'description' => '',
	'table' => 'modules',
	'column' => 'table',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 3,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.primary_key'] = array(
	'f_id' => 8,
	'fg_id' => 2,
	'label' => 'Primary Key',
	'description' => '',
	'table' => 'modules',
	'column' => 'primary_key',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 4,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.enable_mass_action'] = array(
	'f_id' => 9,
	'fg_id' => 2,
	'label' => 'Enable Mass Action',
	'description' => '',
	'table' => 'modules',
	'column' => 'enable_mass_action',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 5,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.wizard_on_new'] = array(
	'f_id' => 10,
	'fg_id' => 2,
	'label' => 'Wizard Type',
	'description' => '',
	'table' => 'modules',
	'column' => 'wizard_on_new',
	'uitype_id' => 3,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 6,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.list_template_header'] = array(
	'f_id' => 13,
	'fg_id' => 2,
	'label' => 'List Template Header',
	'description' => '',
	'table' => 'modules',
	'column' => 'list_template_header',
	'uitype_id' => 2,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 7,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.list_template'] = array(
	'f_id' => 11,
	'fg_id' => 2,
	'label' => 'List Template',
	'description' => '',
	'table' => 'modules',
	'column' => 'list_template',
	'uitype_id' => 2,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 8,
	'datatype' => 'required',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][2]['modules.icon'] = array(
	'f_id' => 12,
	'fg_id' => 2,
	'label' => 'Icon',
	'description' => '',
	'table' => 'modules',
	'column' => 'icon',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 9,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['modules.fg_id'] = array(
	'f_id' => 14,
	'fg_id' => 3,
	'label' => 'FG_ID',
	'description' => '',
	'table' => 'modules',
	'column' => 'fg_if',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 1,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
$config['fields'][3]['modules.f_id'] = array(
	'f_id' => 15,
	'fg_id' => 3,
	'label' => 'F_ID',
	'description' => '',
	'table' => 'modules',
	'column' => 'f_id',
	'uitype_id' => 1,
	'display_id' => 3,
	'quick_edit' => 1,
	'sequence' => 2,
	'datatype' => '',
	'active' => '1',
	'encrypt' => 0
);
