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
	$sql="select * from yp_tabled where rec_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$pid = $line['pid'];
		$bid = $line['bid'];
	}	
}

if($id==''){
	$pid = $_SESSION['pid'];
	$bid = $_SESSION['bid'];
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
            <TR><TD width="85%"><span class="para_heading">Table D List : Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="tabled_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="tabled_manage.php" method="post" enctype="multipart/form-data" name="form_frm">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                    </tr>
					<?php
						$sql_c="select * from yp_provider where status='Active' order by rec_name";
						$res_c=executeQuery($sql_c);
					?>
                    <tr>
                      <td width="2%" align="center" valign="middle" class="red">*</td>
                      <td width="23%" align="left" valign="top" class="contentBold">Provider Name</td>
                      <td width="75%">
						<select name="pid" class="textfield" id="pid" style="width:160px;">
						<option value="0">---Select---</option>
							<?php
								while($lin_c=mysql_fetch_array($res_c)){						
							?>
								<option value="<?php echo $lin_c['rec_id']?>" <?php if($lin_c['rec_id']==$pid){echo 'selected';}?>><?php echo stripslashes($lin_c['rec_name'])?></option>
							<?php }?>
                        </select> 
						[Provider ID will automatically be inserted for the selected Provider]					</td>
                    </tr>
                    <?php
						$sql_c="select * from yp_banks where status='Active' order by bank_name";
						$res_c=executeQuery($sql_c);
					?>
                    <tr>
                      <td width="2%" align="center" valign="middle" class="red">*</td>
                      <td width="23%" align="left" valign="top" class="contentBold">Accepted Receiving Bank Name</td>
                      <td width="75%">
						<select name="bid" class="textfield" id="bid" style="width:160px;">
						<option value="0">---Select---</option>
							<?php
								while($lin_c=mysql_fetch_array($res_c)){						
							?>
								<option value="<?php echo $lin_c['rec_id']?>" <?php if($lin_c['rec_id']==$bid){echo 'selected';}?>><?php echo stripslashes($lin_c['bank_name'])?></option>
							<?php }?>
                        </select>
[Bank ID will automatically be inserted for the selected Bank]					</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="75%"><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="75%">
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
