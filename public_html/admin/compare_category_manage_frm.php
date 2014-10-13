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

$id    = $_GET['id'];
$start = $_GET['start'];

$sql="select * from yp_compare_category where cat_id='$id'";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$cat_name = $line['cat_name'];
}

if($id==''){
	$cat_name = $_SESSION['cat_name'];
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
	if(formObj.cat_name.value=='')
	{
		error='Please Input Category Name.'
	}


	if(error !='')
	{
		alert (error)
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
					<td><?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>        </td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="400" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Compare Category : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="compare_category_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
		
            <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG" >
            <tr>
              <form action ="compare_category_manage.php" method="post" enctype="multipart/form-data" name="addForm" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                      </tr>
                    <tr>
                      <td width="4%" align="right" class="red">*</td>
                      <td width="18%" align="left" class="mainBold">Category Name</td>
                      <td width="78%"><input name="cat_name" type="text" class="textfield" id="cat_name" value="<?php echo stripslashes($cat_name); ?>" size="100"></td>
                      </tr>

                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>
					    <input name="id" type="hidden" id="id" value="<?php echo $id;?>">
                        <input name="start" type="hidden" id="start" value="<?php echo $start;?>">
                        <input type="submit" name="Submit" value="Submit" class="buttons"></td>
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
            <br></td>
      </tr>
	  </table>
      <tr>
		<td><?php  include "admin_footer.inc.php" ; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
