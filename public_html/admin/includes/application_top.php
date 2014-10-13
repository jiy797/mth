<?php

// start the timer for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

// set the level of error reporting
error_reporting(E_ALL & ~E_NOTICE);

// check if register_globals is enabled.
// since this is a temporary measure this message is hardcoded. The requirement will be removed before 2.2 is finalized.
if(function_exists('ini_get')) {
//ini_get('register_globals') or exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory.');
}

//require("./includes/cart_class.php");
require("./includes/functions.inc.php");
require("./includes/sql.inc.php");
require("./includes/sessions.php");

/* Create new object of class */
$ses_class = new session();

$ses_class->db_host = $DB["host"];
$ses_class->db_user = $DB["user"] ;
$ses_class->db_pass = $DB["pass"];
$ses_class->db_dbase = $DB["dbName"];

$ses_class->life_time = get_cfg_var("session.gc_maxlifetime");

/* Change the save_handler to use the class functions */
session_set_save_handler (array(&$ses_class, '_open'),
					  array(&$ses_class, '_close'),
					  array(&$ses_class, '_read'),
					  array(&$ses_class, '_write'),
					  array(&$ses_class, '_destroy'),
					  array(&$ses_class, '_gc'));

/* Start the session */
session_start();

//session_start();
//site_maintenance();
?>