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

$fc_id=$_GET['fc_id'];
$start=$_GET['start'];

$sql="select * from yp_faq_category where faq_cat_id='$fc_id'";
$res=executeQuery($sql);

while($line=mysql_fetch_array($res)){
	$faq_cat_name	 = $line['faq_cat_name'];
}

if($fc_id==''){
	$faq_cat_name	 = $_SESSION['faq_cat_name'];
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
	if(formObj.faq_cat_name.value==''){
		error='Category Name\n'
	}
	if(error !=''){
		alert ('Please input:\n\n'+error)
		return false
	}else{
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
					<td><?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>
			</td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="400" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage FAQ Categories : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="faq_category_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
		
            <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG" >
            <tr>
              <form action ="faq_category_manage.php" method="post" enctype="multipart/form-data" name="addFaq" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td width="76%" class="red"></td>
                      </tr>
                    <tr>
                      <td width="2%" align="center" class="red">*</td>
                      <td width="22%" align="left" class="text10_bold">FAQ Category Name</td>
                      <td><input name="faq_cat_name" type="text" class="textfield" id="faq_cat_name" value="<?php echo stripslashes($faq_cat_name); ?>" size="40"></td>
                      </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input name="fc_id" type="hidden" id="fc_id" value="<?php echo $fc_id;?>">
                      <input name="start" type="hidden" id="start" value="<?php echo $start;?>">
                      <input type="submit" name="Submit" value="Submit" class="buttons"></td>
                    </tr>
                </table></td>
              </form>
            </tr>
          </table>
            <br></td>
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
