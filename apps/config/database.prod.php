<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|	
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'local';
$active_record = TRUE;

//live
$db['live']['hostname'] = 'livehost';
$db['live']['username'] = 'emplopad';
$db['live']['password'] = 'emplopad20200819';
$db['live']['database'] = 'ortigas.prod';
$db['live']['dbdriver'] = 'mysqli';
$db['live']['dbprefix'] = 'ww_';
$db['live']['pconnect'] = FALSE;
$db['live']['db_debug'] = FALSE;
$db['live']['cache_on'] = FALSE;
$db['live']['cachedir'] = '';
$db['live']['char_set'] = 'utf8';
$db['live']['dbcollat'] = 'utf8_general_ci';
$db['live']['swap_pre'] = '';
$db['live']['autoinit'] = FALSE;
$db['live']['stricton'] = FALSE;

$db['ms_sql']['hostname'] = "192.168.0.54\SQLEXPRESS";
$db['ms_sql']['username'] = "HDIUser";
$db['ms_sql']['password'] = "Pr0@ctiv3";
$db['ms_sql']['database'] = "NitgenAccessManager";
$db['ms_sql']['dbdriver'] = 'mssql';
$db['ms_sql']['dbprefix'] = FALSE;
$db['ms_sql']['pconnect'] = TRUE;
$db['ms_sql']['db_debug'] = TRUE;
$db['ms_sql']['cache_on'] = FALSE;
$db['ms_sql']['cachedir'] = '';
$db['ms_sql']['char_set'] = 'utf8';
$db['ms_sql']['dbcollat'] = 'utf8_general_ci';

// for php version 7.0 and up
$db['ms_sql_portal']['dsn'] = "";
$db['ms_sql_portal']['hostname'] = "10.0.0.92";
$db['ms_sql_portal']['username'] = "HRIS";
$db['ms_sql_portal']['password'] = "SFJJUy1DUk9OX0pPQg==";
$db['ms_sql_portal']['database'] = "ORT_WEB_OTP";
$db['ms_sql_portal']['dbdriver'] = "sqlsrv";
$db['ms_sql_portal']['dbprefix'] = FALSE;
$db['ms_sql_portal']['pconnect'] = FALSE;
$db['ms_sql_portal']['db_debug'] = TRUE;
$db['ms_sql_portal']['cache_on'] = FALSE;
$db['ms_sql_portal']['cachedir'] = "";
$db['ms_sql_portal']['char_set'] = "utf8";
$db['ms_sql_portal']['dbcollat'] = "utf8_general_ci";
$db['ms_sql_portal']['swap_pre'] = '';
$db['ms_sql_portal']['encrypt'] = FALSE;
$db['ms_sql_portal']['compress'] = FALSE;
$db['ms_sql_portal']['stricton'] = FALSE;
$db['ms_sql_portal']['failover'] = array();
$db['ms_sql_portal']['save_queries'] =FALSE;

// for php version 7.0 and up
$db['ms_sql_portal_new']['dsn'] = "";
$db['ms_sql_portal_new']['hostname'] = "10.0.1.196";
$db['ms_sql_portal_new']['username'] = "hris";
$db['ms_sql_portal_new']['password'] = "];G:£]X0ope57t}";
$db['ms_sql_portal_new']['database'] = "one_team_passport";
$db['ms_sql_portal_new']['dbdriver'] = "sqlsrv";
$db['ms_sql_portal_new']['dbprefix'] = FALSE;
$db['ms_sql_portal_new']['pconnect'] = FALSE;
$db['ms_sql_portal_new']['db_debug'] = TRUE;
$db['ms_sql_portal_new']['cache_on'] = FALSE;
$db['ms_sql_portal_new']['cachedir'] = "";
$db['ms_sql_portal_new']['char_set'] = "utf8";
$db['ms_sql_portal_new']['dbcollat'] = "utf8_general_ci";
$db['ms_sql_portal_new']['swap_pre'] = '';
$db['ms_sql_portal_new']['encrypt'] = FALSE;
$db['ms_sql_portal_new']['compress'] = FALSE;
$db['ms_sql_portal_new']['stricton'] = FALSE;
$db['ms_sql_portal_new']['failover'] = array();
$db['ms_sql_portal_new']['save_queries'] =FALSE;

// for php old version
/*$db['ms_sql_portal']['hostname'] = "13.228.34.85";
$db['ms_sql_portal']['username'] = "HRIS";
$db['ms_sql_portal']['password'] = "SFJJUy1DUk9OX0pPQg==";
$db['ms_sql_portal']['database'] = "ORT_WEB_OTP";
$db['ms_sql_portal']['dbdriver'] = "sqlsrv";
$db['ms_sql_portal']['dbprefix'] = FALSE;
$db['ms_sql_portal']['pconnect'] = TRUE;
$db['ms_sql_portal']['db_debug'] = TRUE;
$db['ms_sql_portal']['cache_on'] = FALSE;
$db['ms_sql_portal']['cachedir'] = "";
$db['ms_sql_portal']['char_set'] = "utf8";
$db['ms_sql_portal']['dbcollat'] = "utf8_general_ci";*/

/* End of file database.php */
/* Location: ./application/config/database.php */
