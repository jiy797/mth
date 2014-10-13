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
	$sql="select * from yp_banks where rec_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$bank_id		= $line['bank_id'];
		$bank_name		= $line['bank_name'];
		$branch_id		= $line['branch_id'];
		$branch_address	= $line['branch_address'];
		$branch_city	= $line['branch_city'];
		$branch_state	= $line['branch_state'];
		$branch_country	= $line['branch_country'];
	}	
}

if($id==''){
	$bank_id		= $_SESSION['bank_id'];
	$bank_name		= $_SESSION['bank_name'];
	$branch_id		= $_SESSION['branch_id'];
	$branch_address	= $_SESSION['branch_address'];
	$branch_city	= $_SESSION['branch_city'];
	$branch_state	= $_SESSION['branch_state'];
	$branch_country	= $_SESSION['branch_country'];
}

if($branch_country==''){
	$branch_country='United States';
}

?>
<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
            <TR><TD width="85%"><span class="para_heading">Banks List : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="banks_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="banks_manage.php" method="post" enctype="multipart/form-data" name="form_frm">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                    </tr>

                    <tr>
                      <td width="2%" align="center" valign="middle" class="red">*</td>
                      <td width="14%" align="left" valign="top" class="contentBold">Bank ID </td>
                      <td width="84%"><input name="bank_id" id="bank_id" type="text" class="textfield" size="50" value="<?php echo stripslashes($bank_id)?>"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Bank Name </td>
                      <td><input name="bank_name" id="bank_name" type="text" class="textfield" size="50" value="<?php echo stripslashes($bank_name)?>"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Branch ID </td>
                      <td><input name="branch_id" id="branch_id" type="text" class="textfield" size="50" value="<?php echo stripslashes($branch_id)?>"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Branch Address </td>
                      <td><input name="branch_address" id="branch_address" type="text" class="textfield" size="50" value="<?php echo stripslashes($branch_address)?>"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Branch City </td>
                      <td><input name="branch_city" id="branch_city" type="text" class="textfield" size="50" value="<?php echo stripslashes($branch_city)?>"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Branch State </td>
                      <td><input name="branch_state" id="branch_state" type="text" class="textfield" size="50" value="<?php echo stripslashes($branch_state)?>"></td>
                    </tr>
					<?php
						$sql_c="select * from yp_country order by country";
						$res_c=executeQuery($sql_c);
					?>
                    <tr>
                      <td align="center" valign="middle" class="red">*</td>
                      <td class="contentBold">Branch Country </td>
                      <td><select name="branch_country" class="textfield" id="branch_country" style="width:160px;">
							<?php
								while($lin_c=mysql_fetch_array($res_c)){						
							?>
								<option value="<?php echo $lin_c['country']?>" <?php if($lin_c['country']==$branch_country){echo 'selected';}?>><?php echo stripslashes($lin_c['country'])?></option>
							<?php }?>
                        </select> </td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="84%"><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="84%">
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
