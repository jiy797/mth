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

$start=0;
$order_by='';

if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=50;
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

if(isset($_GET['order_by'])){	$order_by=$_GET['order_by'];}

if(isset($_SESSION['sess_order_by'])==$order_by)
{
	if(isset($_SESSION['order_by2'])=='asc')
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
	$order_by='newsletter_id';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_newsletter where 1=1 ";
$sql1="select count(*) ".$sql;
$sql.= " order by $order_by $order_by2 ";
$sql.= " limit $start, $pagesize";

$sql= $columns.$sql;
$result= executeQuery($sql);
//echo "<br>".$sql;

$reccnt= getSingleResult($sql1);	
$bgcolor="#e4e4e4";

?>
<title><?php echo $site_title?> Admin Manager</title>
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
		a=confirm("Are you sure you want to delete this Record.?");
	//	alert(a);
		if(a==true){
			newsletter.Delete.value="Delete";
			newsletter.submit();
			return true;
		}else{
			return false;
		}

	}

	function addnewsletter(){
		location.href="newsletter_manage_frm.php";
	}
-->
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
          <td colspan="3"><?php require "admin_header.inc.php" ?>
          </td>
        </tr>
        <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php require "admin_left_bar.inc.php" ?>
          </td>
          <td width="75%" height="350" align="center" valign="top"> <span class="redbold">
            </span>
            <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
              <TR>
                <TD width="82%"><span class="para_heading">Manage Newsletter </span></TD>
                <TD width="18%" align="left" class="red_big">TOTAL RECORDS : <?php echo $reccnt?></TD>
              </TR>
              <TR>
                <TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
              </TR>
            </TABLE>
            <span class="redbold"><br>
            </span> 
            <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
              <form name="newsletter" method="post" action="newsletter_del.php">
                <tr>
                  <td><table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="1" cellspacing="0">
                      <tr class="brown_bar" >
                        <td width="6%" height="22" align="center" class="darkBG"><input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                        <td width="52%" class="darkBG">Subject</td>
                        <td width="16%" height="22" align="center" class="darkBG">Status</td>
                        <td width="16%" height="22" align="center" class="darkBG">Postdate </td>
                        <td width="10%" align="center" class="darkBG">&nbsp;</td>
                      </tr>
                      <?php if(mysql_num_rows($result)>0){?>
                      <?php while($line=mysql_fetch_array($result)){$pagecounter+=1;?>
                      <?php 
						if($bgcolor=="#e4e4e4"){
							$bgcolor="#f5f5f5";
						}else{
							$bgcolor="#e4e4e4";
						}
					?>
                      <tr bgcolor="<?php echo $bgcolor?>">
                        <td width="6%" height="20" align="center"><input type="checkbox" name="ids[]" value="<?php echo $line['newsletter_id']?>">
                        </td>
                        <td width="52%" class="text_11"><?php echo $line['newsletter_subject']?></td>
                        <td width="16%" height="20" align="center" class="text_11">
						<?php if($line['newsletter_status']=="Active"){ ?>
						<img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
						<?php }?>
						<?php if($line['newsletter_status']=="Inactive"){?>
						<img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
						<?php }?>
						</td>
                        <td width="16%" height="20" align="center" class="text10"><?php echo getFullDate($line['newsletter_postdate'], 'm-d-Y')?>
                        </td>
                        <td width="10%" align="center" bgcolor="<?php echo $bgcolor?>"><a href="newsletter_manage_frm.php?id=<?php echo $line['newsletter_id']?>" class="menu"><img src="images/edit16.gif" alt="Edit" width="16" height="16" border="0"></a></td>
                      </tr>
                      <?php }?>
                      <tr align="center">
                        <td colspan="5"><?php include "./includes/paging.inc.php"?></td>
                      </tr>
                      <?php }else{?>
                      <tr align="center">
                        <td colspan="5" height="20" class="red">NO NEWSLETTER AVAILABLE.</td>
                      </tr>
                      <?php }?>
                      <tr align="right">
                        <td colspan="5"><input type="hidden" name="start" value="<?php echo $start?>">
                            <input type="hidden" name="Delete">
                            <input type="button" name="Add" value="Add Newsletter" class="buttons" onClick="addnewsletter()">
                            <input type="submit" name="Active" value="Active" class="buttons">
                            <input type="submit" name="Inactive" value="Inactive" class="buttons">
                            <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()">
                        </td>
                      </tr>
                  </table></td>
                </tr>
              </form>
            </table>
          <br>          </td>
        </tr>
        <tr>
          <td colspan="3"><?php require "admin_footer.inc.php" ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>