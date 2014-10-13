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
$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$id'");

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
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
	$order_by='faq_id';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_provider_faq where pro_id='$id'";
$sql1="select count(*) ".$sql;
$sql.= " order by faq_position asc ";
$sql.= " limit $start, $pagesize";

$sql= $columns.$sql;
$result= executeQuery($sql);

//echo "<br>".$sql;

$reccnt= getSingleResult($sql1);	
$bgcolor="#e4e4e4";

?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--

	function isValid(formRef)
	{

		for(var i=0;i<formRef.elements.length;i++)
		{
			if(formRef.elements[i].type == "checkbox")
			{
				formRef.elements[i].checked = formRef.cb1.checked
			}
		}//end of loop
	}
	function want_to_Delete()
	{
		var a;
		a=confirm("Are you sure?. You want to delete the selected record(s).");
	//	alert(a);
		if(a==true){
			faq.Delete.value="Delete";
			faq.submit();
			return true;
		}else{
			return false;
		}

	}

	function make_up(pid,id,postion,start){
		location.href="provider_faq_position.php?pid="+pid+"&id="+id+"&pos="+postion+"&start="+start+"&type=up";
	}
	function make_down(pid,id,postion,start){
		location.href="provider_faq_position.php?pid="+pid+"&id="+id+"&pos="+postion+"&start="+start+"&type=down";
	}

//-->
</script>
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
          <td valign="top" > 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top"> 
  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
	<TR><TD width="82%"><span class="para_heading">Provider List : <?php echo stripslashes($provider_name)?> -> FAQ List </span></TD>
	<TD width="18%" align="right"><a href="provider_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
	</TR>
	<TR>
	  <TD colspan="2" align="right"><a href="provider_manage_frm.php?id=<?php echo $id?>" class="menu">[ EDIT ] &nbsp;</a><a href="provider_overview_frm.php?id=<?php echo $id?>" class="menu">[ OVERVIEW ] &nbsp;</a><a href="provider_review_list.php?id=<?php echo $id?>" class="menu">[ REVIEWS ] &nbsp;</a><a href="provider_compare_frm.php?id=<?php echo $id?>" class="menu">[ COMPARE ] &nbsp;</a></TD>
	</TR>
	<TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
	</TR>
  </TABLE>

          <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">

            <form name="faq" method="post" action="provider_faq_del.php">
              <tr>
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                    <tr height="22" >
                      <td width="3%" height="22" align="center" class="darkBG">
                        <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                      <td width="30%" class="darkBG">Question</td>
                      <td width="33%" class="darkBG">Answer</td>
                      <td width="14%" align="center" class="darkBG">Position  </td>
                      <td width="12%" height="22" align="center" class="darkBG">Status</td>
                      <td width="8%" align="center" class="darkBG">&nbsp;</td>
                    </tr>
                    <?php  
						if(mysql_num_rows($result)>0){
						while($line=mysql_fetch_array($result)){$pagecounter+=1;
                    
							if($bgcolor=="#e4e4e4"){
								$bgcolor="#f5f5f5";
							}else{
								$bgcolor="#e4e4e4";
							}

					?>
                    <tr bgcolor="<?php echo $bgcolor; ?>">
                      <td width="3%" height="20" align="center" valign="top">
                        <input type="checkbox" name="faq_ids[]" value="<?php echo $line['faq_id']; ?>"> </td>
                      <td width="30%" align="left" valign="top" class="text10"><?php echo stripslashes(substr($line['question'], 0, 50)); ?></td>
                      <td width="33%" align="left" valign="top" class="text10"><?php echo stripslashes(substr($line['answer'], 0, 50)); ?></td>
                      <td width="14%" align="center" valign="top" class="text10"><?php echo '[ '.$line['faq_position'].' ]'?>&nbsp; 
								<a href="#" onClick="javascript:make_up('<?php echo $line['pro_id']?>','<?php echo $line['faq_id']?>','<?php echo $line['faq_position']?>','<?php echo $start?>')"><u>UP</u></a> | <a href="#" onClick="javascript:make_down('<?php echo $line['pro_id']?>','<?php echo $line['faq_id']?>','<?php echo $line['faq_position']?>','<?php echo $start?>')"><u>DOWN</u></a></td>
                      <td width="12%" height="20" align="center" valign="top" class="text10">
								<?php if($line['status']=="Active"){ ?>
									<img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                                <?php }?>
								<?php if($line['status']=="Inactive"){?>
									<img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                                <?php }?></td>
                      <td width="8%" align="center" valign="top" bgcolor="<?php echo $bgcolor; ?>"><a href="provider_faq_manage_frm.php?id=<?php echo $id?>&faq_id=<?php echo $line['faq_id'];?>"><img src="images/edit16.gif" alt="Edit Content" width="16" height="16" border="0"></a></td>
                    </tr>
                    <?php }?>
                    <tr align="center">
                      <td colspan="6">
                        <?php  include "./includes/paging.inc.php";?>                      </td>
                    </tr>
                    <?php }else{?>
                    <tr align="center">
                      <td colspan="6" height="20" class="red">NO RECORD AVAILABLE.</td>
                    </tr>
                    <?php }?>
                    <tr align="right" height="22">
                      <td colspan="6" class="brown_bar">
                        <input type="hidden" name="start" value="<?php echo $start;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="Delete">
                        <input type="submit" name="Add" value="Add FAQ" class="buttons">
                        <input type="submit" name="Active" value="Active" class="buttons">
                        <input type="submit" name="Inactive" value="Inactive" class="buttons">
                        <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()">                      </td>
                    </tr>
                </table></td>
              </tr>
            </form>
          </table>
          <br>
          <br>          </td>
      </tr>
	  </table>
     
        <tr>
        <td> <?php include "admin_footer.inc.php" ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
