<?php
require "./includes/application_top.php";

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}
?>

<html>
<head>
<title><?php echo $site_title;?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><?php include "admin_header.inc.php" ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php include "admin_left_bar.inc.php" ?>          </td>
          <td width="75%" height="400" align="center" valign="top"> <br><br>
            <span class="contentBold">
          Welcome to 
          <?php echo $site_title?> 
          Admin Manager </span><br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br></td>
      </tr>
      <tr>
        <td colspan="3"><?php include "admin_footer.inc.php" ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
