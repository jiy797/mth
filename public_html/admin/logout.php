<?php
//session_start();
//session_destroy();
require "./includes/application_top.php";	
//$ses_class->_close();
//$ses_class->_destroy($ses_id);
session_destroy();

header("Location: index.php");
exit;
?>
