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
	$sql="select * from yp_resource_main where rec_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$rec_name		= $line['rec_name'];
		$rec_desc		= $line['rec_desc'];
		$rec_img		= $line['rec_img'];
		$meta_title		= $line['meta_title'];
		$meta_keywords	= $line['meta_keywords'];
		$meta_desc		= $line['meta_desc'];
	}	
}

if($id==''){
	$rec_name		= $_SESSION['rec_name'];
	$rec_desc		= $_SESSION['rec_desc'];
	$meta_title		= $_SESSION['meta_title'];
	$meta_keywords	= $_SESSION['meta_keywords'];
	$meta_desc		= $_SESSION['meta_desc'];
}

include("../fckeditor/fckeditor.php") ;
?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>

<SCRIPT LANGUAGE="JavaScript">
<!--

function validate(formObj)
{
	var error=''

	if(formObj.rec_name.value==""){
		error +="Input Title\n";
	}

	if(error !=''){
		alert ("Following fields are required :\n\n"+error)
		return false
	}else
	{
			return true
	}

}
//-->
</SCRIPT>
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
            </table>        </td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Resource List : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="resource_main_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="resource_main_manage.php" method="post" enctype="multipart/form-data" name="form_frm" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                    </tr>

                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="13%" align="left" valign="top" class="contentBold">Title </td>
                      <td width="85%"><input name="rec_name" id="rec_name" type="text" class="textfield" size="73" value="<?php echo stripslashes($rec_name)?>"></td>
                    </tr>
					<tr valign="top">
					  <td class="red">&nbsp;</td>
					  <td>Meta Title </td>
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


                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="contentBold">Description</td>
                      <td class="red"><textarea name="rec_desc" id="rec_desc" cols="79" rows="10" class="textfield"><?php echo stripslashes($rec_desc)?></textarea>
					  <script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'rec_desc' ) ; 
							oFCKeditor.BasePath     = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet = 'Basic' ; 
							oFCKeditor.Height = '400' ; 
							oFCKeditor.ReplaceTextarea() ; 
							} 
						</script>
					  </td>
                    </tr>
					<?php if($rec_img!=''){?>
					<tr>
                      <td>&nbsp;</td>
                      <td class="contentBold">Existing Image</td>
                      <td class="red"><img src="../uploadedfiles/real/<?php echo $rec_img?>"></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="contentBold">Upload Image</td>
                      <td><input name="image1" type="file" class="textfield" id="image1">
                        <br>
                        [PLEASE UPLOAD IMAGE OF APPROPRIATE SIZE. IMAGE WILL BE SHOWN AS IT IS ON SITE] </td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="85%">
						<input name="id" type="hidden" value="<?php echo $id; ?>">
						<input name="rec_file" type="hidden" id="rec_file" value="<?php echo $rec_img;?>">
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="85%">
                      <input type="submit" name="Submit" value="SUBMIT" class="buttons"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
