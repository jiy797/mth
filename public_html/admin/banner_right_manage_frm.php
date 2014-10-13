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
	$sql="select * from yp_banner_right where b_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$b_type = $line['b_type'];
		$b_page = $line['b_page'];
		$b_img  = $line['b_img'];
		$b_link = $line['b_link'];
		$b_code = $line['b_code'];
	}	
}

if($id==''){
	$b_type = $_SESSION['b_type'];
	$b_page = $_SESSION['b_page'];
	$b_link = $_SESSION['b_link'];
	$b_code = $_SESSION['b_code'];
}

?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<SCRIPT LANGUAGE="JavaScript">
<!--

function validate(formObj)
{
	var error=''

	if(formObj.b_page.value==""){
		error +="Select Page\n";
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
            <TR><TD width="85%"><span class="para_heading">Right Banner List : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="banner_right_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="banner_right_manage.php" method="post" enctype="multipart/form-data" name="form_frm" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                      <td class="red"></td>
                    </tr>
                    <tr>
                      <td width="1%" align="right" valign="top" class="red">*</td>
                      <td width="11%" align="left" valign="top" class="contentBold">Banner Type</td>
                      <td width="5%">&nbsp;</td>
                      <td width="83%">
					  <select name="b_type" id="b_type" class="textfield">
						<option value="Image" <?php if($b_type=='Image'){ echo 'selected';}?>>Image</option>
						<option value="Code" <?php if($b_type=='Code'){ echo 'selected';}?>>Code</option>
					  </select></td>
                    </tr>  
					<?php
						$sql_bo="select * from yp_ban_right order by boption";
						$res_bo=executeQuery($sql_bo);		   
					?>
                    <tr>
                      <td width="1%" align="right" valign="top" class="red">*</td>
                      <td width="11%" align="left" valign="top" class="contentBold">Select Page </td>
                      <td width="5%">&nbsp;</td>
                      <td width="83%"><select name="b_page" id="b_page" class="textfield">
				  <option value="">---Select---</option>
				  <?php
						while($lin_bo=mysql_fetch_array($res_bo)){
				  ?>
						<option value="<?php echo $lin_bo['boption']?>" <?php if($lin_bo['boption']==$b_page){ echo 'selected';}?>><?php echo $lin_bo['boption']?></option>
				  <?php }?>
				  </select></td>
                    </tr>
					<?php if($b_img!=''){?>
					<tr>
                      <td>&nbsp;</td>
                      <td class="contentBold">Existing Image</td>
                      <td class="red">&nbsp;</td>
                      <td class="red"><img src="../uploadedfiles/banner/<?php echo $b_img?>"></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td align="right" class="red">&nbsp;</td>
                      <td class="contentBold">Upload Image</td>
                      <td>&nbsp;</td>
                      <td><input name="image1" type="file" class="textfield" id="image1">
                        <br>
                        [PLEASE UPLOAD IMAGE OF 300px * 250px. IMAGE WILL BE SHOWN AS IT IS ON SITE] </td>
                    </tr>
					<tr>
                      <td>&nbsp;</td>
                      <td valign="top" class="contentBold">Link URL</td>
					  <td width="5%" valign="top">http://</td>
					  <td width="83%" valign="top"><textarea name="b_link" id="b_link" cols="70" rows="2" class="textfield"><?php echo stripslashes($b_link)?></textarea><br>[PLEASE INPUT ONLY URL FOR EX. WWW.YAHOO.COM]</td>
					</tr>
					<tr>
                      <td>&nbsp;</td>
                      <td valign="top" class="contentBold">Or, Banner Script/Code</td>
					  <td>&nbsp;</td>
					  <td width="83%" valign="top"><textarea name="b_code" id="b_code" cols="70" rows="15" class="textfield"><?php echo stripslashes($b_code)?></textarea></td>
					</tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="83%">
						<input name="id" type="hidden" value="<?php echo $id; ?>">
						<input name="rec_img" type="hidden" id="rec_img" value="<?php echo $b_img;?>"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="83%">
                      <input type="submit" name="Submit" value="SUBMIT" class="buttons"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
