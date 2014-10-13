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

$page_id=$_GET['page_id'];

$sql="select * from yp_content_pages where page_id='$page_id'";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$page_id		= $line['page_id'];
	$meta_title		= $line['meta_title'];
	$meta_keywords	= $line['meta_keywords'];
	$meta_desc		= $line['meta_desc'];
	$page_title		= $line['page_title'];
	$page_desc		= $line['page_desc'];
}

if($page_id==''){
	$meta_title		= $_SESSION['meta_title'];
	$meta_keywords	= $_SESSION['meta_keywords'];
	$meta_desc		= $_SESSION['meta_desc'];
	$page_title		= $_SESSION['page_title'];
	$page_desc		= $_SESSION['page_desc'];
}

include("../fckeditor/fckeditor.php") ;

?>

<html>
<head>
<title><?php echo $site_title;?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><?php include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php include "admin_left_bar.inc.php" ; ?>          </td>
          <td width="75%" height="300" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR>
              <TD width="85%"><span class="para_heading">Content Page List : Manage Page Text</span></TD>
              <TD width="15%" align="right"><a href="content_page_list.php">[ BACK ]</a> </TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>


  <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
  <form method="post" action="content_page.php" enctype="multipart/form-data">
    <tr>
      <td><table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF">
        <tr valign="top">
          <td width="2%" class="mainBold">&nbsp;</td>
          <td width="21%" height="0" class="red">(*required)</td>
          <td width="77%" class="mainBold">&nbsp;</td>
        </tr>
        <tr valign="top">
          <td class="red">*</td>
          <td class="contentBold">Page Title </td>
          <td><input name="page_title" type="text" class="textfield" id="page_title" value="<?php echo stripslashes($page_title)?>" size="30"></td>
        </tr>
        <tr valign="top">
          <td class="red">&nbsp;</td>
          <td height="0">Meta Title </td>
          <td><textarea name="meta_title" id="meta_title" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_title)?></textarea></td>
        </tr>
        <tr valign="top">
          <td align="center" class="red">&nbsp;</td>
          <td align="left" class="main">Meta Keywords </td>
          <td align="left"><textarea name="meta_keywords" id="meta_keywords" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_keywords)?></textarea></td>
        </tr>
        <tr valign="top">
          <td align="center" class="red">&nbsp;</td>
          <td align="left" class="main">Meta Description </td>
          <td align="left"><textarea name="meta_desc" id="meta_desc" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_desc)?></textarea></td>
        </tr>
        <tr valign="top">
          <td align="center" class="red">*</td>
          <td align="left" class="contentBold">Page Description </td>
          <td align="left"><textarea name="page_desc" id="page_desc" class="textfield"><?php echo stripslashes($page_desc)?></textarea>
			<script type="text/javascript"> 
				window.onload = function() 
				{ 
				var oFCKeditor = new FCKeditor( 'page_desc' ) ; 
				oFCKeditor.BasePath     = "../fckeditor/" ; 
				oFCKeditor.ToolbarSet = 'Basic' ; 
				oFCKeditor.ReplaceTextarea() ; 
				} 
			</script>
		  </td>
        </tr>
        <tr valign="top">
          <td align="center">&nbsp;</td>
          <td align="left" class="main">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="right"><input name="page_id" type="hidden" id="page_id" value="<?php echo $page_id; ?>"></td>
          <td align="left"><input type="submit" name="Submit" value="Submit" class="buttons"></td>
        </tr>
        
      </table></td>
    </tr>
	</form>
  </table>

		<br>  </td>
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

