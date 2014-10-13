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

$sql="select * from yp_c_address";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$page_id			=	$line['page_id'];
	$page_text			=	$line['page_text'];
	$page_top_desc		=	$line['page_top_desc'];
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
            <?php  include "admin_left_bar.inc.php" ; ?>          </td>
          <td width="75%" height="400" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Contact </span></TD>
            <TD width="15%" align="right">&nbsp;</TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
            <form method="post" action="c_address.php" enctype="multipart/form-data">
              <table width="98%" border="0" cellpadding="2" cellspacing="1" class="darkBG">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF">
                      <tr valign="middle">
                        <td width="59%" height="25" class="mainBold">PLEASE ENTER CONTACT PAGE TOP DETAILS <span class="red"></span> (Optional) </td>
                        <td width="41%" height="25"><span class="mainBold">PLEASE ENTER THE INFORMATION BELOW:</span></td>
                      </tr>
                      <tr valign="middle">
                        <td height="25" valign="top">
							<textarea name="page_top_desc" id="page_top_desc"><?php echo $page_top_desc; ?></textarea>
							<script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'page_top_desc' ) ; 
							oFCKeditor.BasePath     = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet = 'Basic' ; 
							oFCKeditor.ReplaceTextarea() ;
							}
						</script>						</td>
                        <td height="25" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td width="61%" valign="top"><textarea name="text_area" cols="50" rows="8" class="textfield" id="text_area"><?php echo $page_text; ?></textarea></td>
                            </tr>
                          <tr>
                            <td valign="top"><span class="text10">For example: <br>
                                <br>
ABC Limited <br>
123 Main Street <br>
New York <br>
United States <br>
90002 <br>
T : (888)-111-2222 <br>
F : (888)-111-2222 <br>
E : webmaster@abc.com </span></td>
                            </tr>
                        </table></td>
                      </tr>


                      <tr align="center" valign="middle">
                        <td colspan="2"></td>
                      </tr>
                      <tr>
                        <td class="redbold" align="right">&nbsp;</td>
                        <td align="right"><input type="submit" name="Submit" value="Submit" class="buttons">
                        <input name="page_id" type="hidden" id="page_id" value="<?php echo $page_id; ?>"></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
          </form><br>
		  </td>
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
