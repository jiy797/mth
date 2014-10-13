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

$id=$_GET['id'];

$sql="select * from yp_newsletter where newsletter_id='$id'";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$subject  = $line['newsletter_subject'];
	$graphics = $line['newsletter_graphics'];
	$text	  = $line['newsletter_text'];
}

include("../fckeditor/fckeditor.php") ;

?>

<html>
<head>
<title><?php echo $site_title?> Admin Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script> 

<link href="css/yp.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function validate(formObj)
{
var error='';

if(formObj.subject.value=='')
{
	error='\nNewsletter Subject.'
}
if(error != '')
	{
		alert ('Please Input\n'+error)
		return false;
	}else
	{
		return true;
	}
}
//-->
</SCRIPT>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="3"><?php require "admin_header.inc.php" ?>
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="brown_bar"><?php require "admin_left_bar.inc.php" ?>
        </td>
        <td width="75%" align="center" valign="top" class="redbold">
          <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR>
              <TD width="82%"><span class="para_heading">Manage Newsletter : Add/Edit </span></TD>
              <TD width="18%" align="right"><a href="newsletter_list.php">[ BACK ]</a></TD>
            </TR>
            <TR>
              <TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
          <br>
          <table width="98%"  border="0" cellpadding="1" cellspacing="0" class="darkBG">
            
            <tr>
                <td valign="top">
				<table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
				 <form action ="newsletter_manage.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)">
                  <tr>
                    <td align="left" class="mainBold">&nbsp;</td>
                    <td align="left" class="mainBold"><span class="red">(* required)</span></td>
                    <td class="red">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="14" align="right" valign="top" class="red">*</td>
                    <td width="93" align="left" class="mainBold">Subject</td>
                    <td width="588"><input name="subject" type="text" id="subject" class="textfield" size="51" value="<?php if(isset($subject)) echo $subject; ?>"></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="mainBold">&nbsp;</td>
                    <td align="left" valign="top" class="mainBold">Content</td>
                    <td><textarea name="graphics" cols="50" rows="10" class="textfield" id="graphics"><?php if(isset($graphics)) echo stripslashes($graphics); ?></textarea>
						<script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'graphics' ) ; 
							oFCKeditor.BasePath     = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet = 'Basic' ; 
							oFCKeditor.Height = '400' ; 
							oFCKeditor.ReplaceTextarea() ; 
							} 
						</script>					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="588">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="id" type="hidden" value="<?php echo $id?>"></td>
                    <td width="588"><input type="submit" name="Submit" value="Submit" class="buttons">                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  </form>
                </table></td>
            </tr>
          </table>          
          <br></td>
      </tr>
      <tr>
        <td colspan="3"><?php require "admin_footer.inc.php" ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
