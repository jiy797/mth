<?php

require "./includes/application_top.php";

$admin_id=$_SESSION['admin_id'];

?>

<html>
<head>
<title><?php echo $site_title?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function validate(formObj)
{
var error=''
if (formObj.admin_id.value=='')
	{
	error ='Please fill admin username '
	}

if (formObj.password.value=='')
	{
	error +='\nPlease fill admin password '
	}

	if (error != '')
	{
	alert ('following error(s) had occured \n' +error)
	return false
	}
	else 
	{ return true
	}

}
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><?php  require "admin_header.inc.php" ?>
        </td>
      </tr>
      <tr>
        <td height="350" colspan="3" align="center" valign="top"><span class="red">
          <br>
          <?php echo $_SESSION['msg']?>
          <?php  unset($_SESSION['msg']); ?>
&nbsp;</span><br>
<br>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34"><img src="images/corner_left.jpg" width="34" height="29"></td>
    <td background="images/top_line.jpg">&nbsp;</td>
    <td width="29"><img src="images/conrner_right.jpg" width="29" height="29"></td>
  </tr>
  <tr>
    <td background="images/left_line.jpg">&nbsp;</td>
    <td class="brown_bar">
 <span class="heading">Member Area</span><BR>
  <P>
 
	<table width="100%" border="0" cellpadding="5" bgcolor="#F5F5F5">
      <form name="adminFrm" action="validate_admin.php" method="post" onSubmit="return validate(this)">
        
        <tr>
          <td width="41%" align="right" class="text_11">User Name</td>
          <td width="59%"><input name="admin_id" type="text" class="textfield" id="admin_id" value=""></td>
        </tr>
        <tr>
          <td align="right" class="text_11">Password</td>
          <td><input name="password" type="password" class="textfield" id="password" value=""></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="IMAGE" src="images/login.jpg" value="Submit"></td>
        </tr>
      </form>
    </table>
	 </P>

<br>
	</td>
    <td background="images/right_line.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="images/corner_bottom_left.jpg" width="34" height="24"></td>
    <td background="images/bottom_line.jpg">&nbsp;</td>
    <td><img src="images/corner_bottom_right.jpg" width="28" height="24"></td>
  </tr>
</table>
        </td>
      </tr>
      <tr>
        <td colspan="3"><?php  require "admin_footer.inc.php" ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
