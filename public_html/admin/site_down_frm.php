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

$sql="select * from yp_site_down";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$id				= $line['id'];
	$page_title		= $line['page_title'];
	$page_desc		= $line['page_desc'];
	$status			= $line['status'];
}

if($id==''){
	$page_title		= $_SESSION['page_title'];
	$page_desc		= $_SESSION['page_desc'];
	$status			= $_SESSION['status'];
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
            <TR><TD width="85%"><span class="para_heading">Manage Site Down  </span></TD>
            <TD width="15%" align="right"></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>

<form method="post" action="site_down.php" enctype="multipart/form-data">
  <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
    <tr>
      <td><table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF">
        <tr valign="middle">
          <td height="25" colspan="3" class="mainBold"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="2%">&nbsp;</td>
              <td width="14%" class="red">(* required)</td>
              <td width="84%">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top" class="red">*</td>
              <td valign="top" class="text10_bold">Page Title </td>
              <td valign="top"><input name="page_title" type="text" class="textfield" id="page_title" value="<?php echo stripslashes($page_title)?>" size="50"></td>
            </tr>
            <tr>
              <td align="right" valign="top" class="red">*</td>
              <td valign="top" class="text10_bold">Description</td>
              <td valign="top"><textarea name="page_desc" id="page_desc"><?php echo stripslashes($page_desc); ?></textarea>
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
          </table></td>
        </tr>
       
        <tr align="center" valign="middle">
          <td colspan="3"></td>
        </tr>
        <tr>
          <td width="16%" align="right" class="orange_text"><strong>Status&nbsp;</strong></td>
          <td width="22%"><select name="status" class="textfield" id="status">
            <option value="Active" <?php if($status=='Active'){ echo "Selected"; }?>>UP</option>
            <option value="Inactive" <?php if($status=='Inactive'){ echo "Selected"; }?>>Down</option>
          </select>          </td>
          <td width="62%" align="left">
            <input type="submit" name="Submit" value="Submit" class="buttons">
              <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">            </td>
        </tr>
        
      </table></td>
    </tr>
  </table>
</form>
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

