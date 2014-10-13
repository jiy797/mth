<?php 
require "./includes/application_top.php";	

$admin_id=$_SESSION['admin_id'];
if ($admin_id==""){
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}

$newsletter_id = $_GET['id'];
$newsletter_subject = getsingleresult("select newsletter_subject from yp_newsletter where newsletter_status='Active' and newsletter_id='$newsletter_id'");
?>
<html>
<head>
<title><?php echo $site_title;?> Admin Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="3"><?php  include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php" ; ?>
        </td>
        <td width="75%" align="center" valign="top" height="350" class="redbold">
		<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Newsletter : Acknowledgement </span></TD>
            <TD width="15%" align="right"><a href="newsletter_subscriber_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
          
          <table width="98%"  border="0" cellpadding="1" cellspacing="0" class="darkBG">
            <tr>
                <td valign="top"><table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="0" cellpadding="3">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
					The Newsletter Subject <span class="redbold">' <?php echo stripslashes($newsletter_subject); ?> ' </span>has been sent to the selected user(s). </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table>          
          <br></td>
      </tr>
      <tr>
        <td colspan="3"><?php  include "admin_footer.inc.php" ; ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
