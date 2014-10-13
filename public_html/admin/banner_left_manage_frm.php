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
	$sql="select * from yp_banner_left where b_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$b_code = $line['b_code'];
	}	
}

if($id==''){
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

	if(formObj.b_code.value==""){
		error +="Banner Script/Code\n";
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
           <td colspan="2"  class="leftper">
			<table cellspacing="0" border="0" cellpadding="0" width="100%">
			   <tr>
			   	<td> <?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>        </td>
      </tr>

        <tr>
          <td valign="left" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR>
              <TD width="85%"><span class="para_heading">Left Google Ad List : Add/Edit </span></TD>
              <TD width="15%" align="left"><a href="banner_left_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="banner_left_manage.php" method="post" enctype="multipart/form-data" name="form_frm" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                      <td class="red"></td>
                    </tr>

					<tr>
                      <td valign="top" class="red">*</td>
                      <td valign="top" class="contentBold">Banner Script/Code</td>
					  <td>&nbsp;</td>
					  <td width="83%" valign="left"><textarea name="b_code" id="b_code" cols="70" rows="15" class="textfield"><?php echo stripslashes($b_code)?></textarea></td>
					</tr>

                    <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td width="5%">&nbsp;</td>
						<td width="83%">
						<input name="id" type="hidden" value="<?php echo $id; ?>"></td>
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
