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
$id = checkInput($_GET['id']);
$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$id'");

$rec_id = checkInput($_GET['rec_id']);

if($rec_id!=""){
	$sql="select * from yp_provider_compare where pro_id='$id' and rec_id='$rec_id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$com_id		= $line['com_id'];
		$rec_desc	= $line['rec_desc'];
	}	
}

if($rec_id==''){
	$com_id		= $_SESSION['com_id'];
	$rec_desc	= $_SESSION['rec_desc'];
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
            </table></td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

		<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR>
              <TD width="85%"><span class="para_heading">Provider List : <?php echo stripslashes($provider_name)?> ->Compare Services </span></TD>
              <TD width="15%" align="right"><a href="provider_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
			<TR>
			  <TD colspan="2" align="right"><a href="provider_manage_frm.php?id=<?php echo $id?>" class="menu">[ EDIT ] &nbsp;</a><a href="provider_overview_frm.php?id=<?php echo $id?>" class="menu">[ OVERVIEW ] &nbsp;</a><a href="provider_faq_list.php?id=<?php echo $id?>" class="menu">[ FAQ ] &nbsp;</a><a href="provider_review_list.php?id=<?php echo $id?>" class="menu">[ REVIEWS ] &nbsp;</a></TD>
			</TR>

            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
		</TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="provider_compare.php" method="post" enctype="multipart/form-data" name="form_frm">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td width="2%" align="left" class="mainBold">&nbsp;</td>
                      <td width="14%" align="left" class="red">(* required) </td>
                      <td width="84%" colspan="2" class="red"></td>
                    </tr>
					<?php 
						$sql_cs="select * from yp_compare_category where status='Active'";
						$res_cs=executeQuery($sql_cs);
					?>
                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="contentBold">Select Option </td>
                      <td colspan="2" class="red">
						<select name="com_id" class="textfield" style="width:200px;">
							<option value="">---Select---</option>
							<?php while($line_rs=mysql_fetch_array($res_cs)){?>
								<option value="<?php echo $line_rs['cat_id']?>" <?php if($line_rs['cat_id']==$com_id){ echo 'selected';}?>><?php echo stripslashes($line_rs['cat_name'])?></option>
							<?php }?>
	                     </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="contentBold">Content</td>
                      <td colspan="2" class="red"><textarea name="rec_desc" id="rec_desc" cols="80" rows="10" class="textfield"><?php echo stripslashes($rec_desc)?></textarea></td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td><input name="rec_id" type="hidden" value="<?php echo $rec_id; ?>"></td>
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
            <br>
            <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
              <tr>
                <td height="20" bgcolor="#FFFFFF">&nbsp;EXISTING VALUES </td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                  <tr>
                    <td width="40%" height="20" class="darkBG">OPTION</td>
                    <td width="41%" class="darkBG">DESCRIPTION</td>
                    <td width="19%" class="darkBG">&nbsp;</td>
                  </tr>
				  <?php
					$start=0;
					if(isset($_GET['start'])){ $start=$_GET['start']; }
					$pagesize=20;
					$pagecounter=0;
					if(isset($_GET['pagesize']))
					{
					$pagesize=$_GET['pagesize'];
					$pagesize=intval($pagesize);
					if(intval($pagesize)==0)
					{	
					header("Location: ".$_SERVER['PHP_SELF']);
					exit;
					}
					}

					if($_SESSION['sess_order_by']==$order_by)
					{
					if($_SESSION['order_by2']=='asc')
					{
					$order_by2='desc';
					}
					else
					{
					$order_by2='asc';
					}
					}

					if($order_by2=='')
					{
					$order_by2='desc';
					}

					if($order_by=='')
					{
					$order_by='rec_id';
					}

					$_SESSION['order_by2']=$order_by2;
					$_SESSION['sess_order_by']=$order_by;

					$columns="select * ";
					$sql=" from yp_provider_compare where pro_id='$id'";

					$sql1="select count(*) ".$sql;
					//$sql.= " order by rec_id desc";

					$sql.= " order by rec_id ";

					$sql.= " limit $start, $pagesize";

					$sql= $columns.$sql;
					$result= executeQuery($sql);

					//echo "<br>".$sql;


					$reccnt= getSingleResult($sql1);	
					$bgcolor="#e4e4e4";
				  ?>

				  <?php while($line=mysql_fetch_array($result)){
							$pagecounter+=1;
							$sql_cname="select cat_name from yp_compare_category where cat_id='".$line['com_id']."'";
							$res_cname=getSingleResult($sql_cname);

				   ?>
                  <tr>
                    <td valign="top"><?php echo stripslashes($res_cname)?></td>
                    <td valign="top"><?php echo stripslashes($line['rec_desc'])?></td>
                    <td align="center" valign="top"><a href="provider_compare_frm.php?id=<?php echo $id?>&rec_id=<?php echo $line['rec_id']?>"><img src="images/edit16.gif" alt="Edit" title="Edit" width="16" height="16"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="provider_compare_delete.php?id=<?php echo $id?>&rec_id=<?php echo $line['rec_id']?>"><img src="images/delete16.gif" alt="Delete" title="Delete" width="16" height="16"></a></td>
                  </tr>
				  <?php }?>
                  <tr>
                    <td valign="top" colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                     <td valign="top" align="center" colspan="3"><?php  include "./includes/paging.inc.php";?> </td>
                 </tr>
					
					
                </table></td>
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
