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


$link_id = $_GET['link_id'];

$sql="select * from yp_links where link_id='$link_id'";
$result=executeQuery($sql);


if($line=mysql_fetch_array($result)){
	$link_cat_id= $line['link_cat_id'];
	$link_name	= $line['link_name'];
	$link_desc	= $line['link_desc'];
	$link_ref	= $line['link_ref'];
	$link_show	= $line['link_show'];

}

?>

<html>
<head>
<title><?php echo $title; ?> Admin Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript">
<!--
	
function validate(formObj)
{
	var error='Please Input\n'
	if(formObj.link_cat_id.value==""){
		error +="\nLink category";
	}

	if(formObj.link_name.value==""){
		error +="\nName";
	}
	
	/*
	if(formObj.link_desc.value==""){
		error +="\nDescription";
	}
	*/

	if(formObj.link_ref.value==""){
		error +="\nLink URL";
	}

	if(error !='Please Input\n'){
		alert (error)
		return false
	}else{
		return true
	}
		
}

function limitText(limitField, limitCount, limitNum) {

	if (limitField.value.length > limitNum) {

		limitField.value = limitField.value.substring(0, limitNum);

	} else {

		limitCount.value = limitNum - limitField.value.length;

	}

}

//-->
</script>

<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="3"><?php  include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php  include "admin_left_bar.inc.php" ; ?>
          </td>
          <td width="78%" height="300" align="center" valign="top"> 
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Links : Edit </span></TD>
            <TD width="15%" align="right"><a href="link_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>
  <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
  <form method="post" action="link_edit.php"  name="spec_sheet_submit" enctype="multipart/form-data" onSubmit="return validate(this)">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                    <tr valign="top">
                      <td colspan="2"><table width="100%" cellpadding="2" cellspacing="2">
                        
						<tr>
						  <td align="right" class="mainBold">&nbsp;</td>
						  <td align="left" class="mainBold"><span class="red">(* required) </span></td>
						  <td>&nbsp;</td>
						  </tr>
						  <tr>
						    <td align="right" valign="top" class="red">*</td>
                          <td align="left" valign="top" class="mainBold"> Category</td>
                          <td><select name="link_cat_id" class="textfield" id="select">
							<option value=""> -- Choose Category -- </option>
							<?php
							$sql_ln 	= "Select * from yp_links_category";
							$result_ln 	= executeQuery($sql_ln); 
							while($line_ln = mysql_fetch_array($result_ln)){
							?>
							<option value="<?php echo $line_ln['category_id']?>" <?php if($line_ln['category_id']==$link_cat_id){echo "Selected";}?> ><?php echo stripslashes($line_ln['category_name'])?></option>
							<?php }?>
							</select>						  </td>
                        </tr>
						<tr>
						  <td width="10%" align="right" class="red">*</td>
                          <td width="14%" align="left" class="mainBold">Name</td>
                          <td width="76%"><input name="link_name" type="text" class="textfield" size="60" id="link_name" value="<?php echo stripslashes($link_name); ?>"></td>
                        </tr>
                        
						<tr>
						  <td align="right" valign="top" class="red">&nbsp;</td>
                          <td align="left" valign="top" class="mainBold"> Description</td>
                          <td valign="top"><textarea name="link_desc" cols="59" rows="10" class="textfield" id="link_desc" onKeyDown="limitText(this.form.link_desc,this.form.rec1,300);" onKeyUp="limitText(this.form.link_desc,this.form.rec1,300);"><?php echo stripslashes($link_desc); ?></textarea></td>
                        </tr>

                        <tr>
                          <td align="right" valign="top" class="red">&nbsp;</td>
                          <td align="left" valign="top" class="mainBold">&nbsp;</td>
                          <td class="mainBold">Chars left:&nbsp;<input name="rec1" type="text" class="textfield" value="300" size="3" readonly></td>
                        </tr>

						<tr>
						  <td align="right" class="red">*</td>
                          <td align="left" class="mainBold">Link URL</td>
                          <td><span class="text_11">http://</span>
                            <input name="link_ref" type="text" class="textfield" size="53" id="link_ref" value="<?php echo $link_ref; ?>"></td>
                        </tr>
						 <tr>
						   <td align="right" class="mainBold">&nbsp;</td>
                          <td align="left" class="mainBold">Show Link </td>
                          <td><table width="30%" border="0" cellspacing="1" cellpadding="1">
                            <tr>
                              <td width="10%"><input name="link_show" type="radio" value="Yes" <?php if($link_show=='Yes' || $link_show=='' ){echo "Checked"; }?>></td>
                              <td width="40%" class="mainBold">Yes</td>
                              <td width="10%"><input name="link_show" type="radio" value="No" <?php if($link_show=='No'){echo "Checked"; }?>></td>
                              <td width="40%" class="mainBold">No</td>
                            </tr>
                          </table></td>
                        </tr>
                         <tr>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                         </tr>
                         <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;<input type="hidden" name="link_id" value="<?php echo $link_id; ?>">
                            <input type="submit" name="Submit" value="Submit" class="buttons"></td>
                        </tr>
                         <tr>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                         </tr>
                      </table>                        </td>
                    </tr>
                </table></td>
              </tr> </form>
            </table>
		 

            <br>
          <br>          </td>
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
