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
<script language="javascript">
function validate_form(registration)
{
	msg="Please enter the following\n";
	if(registration.password.value=="")
	{
		msg+=" Old Password\n";
	}
		if(registration.new_pass.value=="")
	{
		msg+=" New Password\n";
	}

	if(registration.confirm_new_pass.value=="")
	{
		msg+=" Confirm Password\n";
	}

	if(registration.new_pass.value!="" && registration.confirm_new_pass.value!="")
	{
		if(registration.new_pass.value!=registration.confirm_new_pass.value)
		{
			msg+=" Password should be same as Confirm Password\n";
		}
	}

	
if(msg!="Please enter the following\n")
{
	alert(msg)
	return false;
}
else
{
	return true;
}

}
</script>    
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
            <?php include "admin_left_bar.inc.php"; ?>          </td>
          <td width="75%" height="400" align="center" valign="top">
		  
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Admin Password : Edit </span></TD>
            <TD width="15%" align="right"><a href="welcome.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center">
			<?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?>
			<?php echo "<br><span class='red'>".$_SESSION['error_message']."</span>"; unset($_SESSION['error_message']);?>
			</TD>
            </TR>
			 </TABLE>
		 
            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG">
              <tr>
                <td align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                    <form name="form1" method="post" action="edit_adminpassword.php" onSubmit="return validate_form(this)">
                      
                      <tr>
                        <td height="5" colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="41%" align="right" class="main"> Old Password </td>
                        <td width="58%">&nbsp;<input type="password" name="password" class="textfield" >
                        </td>
                      </tr>
                      <tr>
                        <td height="5" colspan="2"></td>
                      </tr>
                      <tr>
                        <td width="41%" align="right" class="main"> New Password </td>
                        <td width="58%">&nbsp;<input name="new_pass" type="password" class="textfield">
                        </td>
                      </tr>
                      <tr>
                        <td height="5" colspan="2"></td>
                      </tr>
                      <tr>
                        <td width="41%" align="right" class="main"> Confirm New Password </td>
                        <td width="58%">&nbsp;<input name="confirm_new_pass" type="password" class="textfield">
                        </td>
                      </tr>
                      <tr>
                        <td height="5" colspan="2"></td>
                      </tr>
                      <tr>
                        <td align="right" class="main">&nbsp;</td>
                        <td>&nbsp;<input type="submit" name="Submit" value="Edit Password" class="buttons"></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="2"></td>
                      </tr>
                    </form>
                  </table></td>
              </tr>
            </table>
			  
        </td></tr>
      <tr>
        <td colspan="3"><?php include "admin_footer.inc.php"; ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
