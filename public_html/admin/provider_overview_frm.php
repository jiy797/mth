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


$id = $_GET['id'];

if($id!=""){
	$sql="select * from yp_provider_overview where pro_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$rec_desc = $line['rec_desc'];
	}	
}

if($id==''){
	$rec_desc = $_SESSION['rec_desc'];
}

$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$id'");

include("../fckeditor/fckeditor.php") ;
?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body>
<table id="maintable" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
           <td colspan="2"  class="topper">
			<table cellspacing="0" border="0" cellpadding="0" width="100%">
			   <tr>
			   	<td> <?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table></td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

		<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Provider List : <?php echo stripslashes($provider_name)?> -> Overview </span></TD>
            <TD width="15%" align="right"><a href="provider_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
			<TR>
			  <TD colspan="2" align="right"><a href="provider_manage_frm.php?id=<?php echo $id?>" class="menu">[ EDIT ] &nbsp;</a><a href="provider_faq_list.php?id=<?php echo $id?>" class="menu">[ FAQ ] &nbsp;</a><a href="provider_review_list.php?id=<?php echo $id?>" class="menu">[ REVIEWS ] &nbsp;</a><a href="provider_compare_frm.php?id=<?php echo $id?>" class="menu">[ COMPARE ] &nbsp;</a></TD>
			</TR>

            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
		</TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="provider_overview.php" method="post" enctype="multipart/form-data" name="form_frm">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td width="2%" align="left" class="mainBold">&nbsp;</td>
                      <td width="11%" align="left" class="red">&nbsp;</td>
                      <td width="87%" colspan="2" class="red"></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="red">&nbsp;</td>
                      <td align="left" valign="top" class="contentBold">Content</td>
                      <td colspan="2" class="red"><textarea name="rec_desc" id="rec_desc" cols="79" rows="10" class="textfield"><?php echo stripslashes($rec_desc)?></textarea>
					  <script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'rec_desc' ) ; 
							oFCKeditor.BasePath     = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet = 'Basic' ; 
							oFCKeditor.Height = '400' ; 
							oFCKeditor.ReplaceTextarea() ; 
							} 
						</script> </td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">
                      <input type="submit" name="Submit" value="SUBMIT" class="buttons"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </table></td>
              </form>
            </tr>
          </table>
            <br>     </td>
      </tr>
	  </table>

        <tr>
		<td>
         <?php  include "admin_footer.inc.php" ; ?>		 </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
