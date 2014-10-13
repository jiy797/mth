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
if(isset($_GET['start'])){ $start=$_GET['start']; }
$pagesize=15;
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
	$order_by='b_id';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_banner_left where 1=1";

$se_name = checkInput($_GET['se_name']);

if($se_name!=''){
	$sql.=" and b_page like '%$se_name%' ";
}

$sql1="select count(*) ".$sql;
//$sql.= " order by b_id desc";

$sql.= " order by b_id ";

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
			form_frm.Delete.value="Delete";
			form_frm.submit();
			return true;
		}else{
			return false;
		}

	}

	function add_rec(){
		location.href="banner_left_manage_frm.php";
	}

//-->
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body>
<table id="maintable" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="2"  class="leftper">
			<table cellspacing="0" border="0" cellpadding="0" width="100%">
			    <tr>
				<td><?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>        </td>
      </tr>

        <tr>
          <td valign="left" > 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="400" align="center" valign="top"> 
  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
	<TR>
	  <TD width="82%"><span class="para_heading">Left Google Ad List </span></TD>
	  <TD width="18%" align="left" class="red_big">TOTAL RECORDS : <?php echo $reccnt?></TD>
	</TR>
	
	<TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
	</TR>
  </TABLE>

          <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">

            <form name="form_frm" method="post" action="banner_left_del.php">
              <tr>
                <td height="40" align="right" class="brown_bar">
                        <input type="hidden" name="start" value="<?php echo $start; ?>">
                        <input type="hidden" name="Delete">
                        <input type="button" name="Add" value="Add Record" class="buttons" onClick="add_rec()">
                        <input type="submit" name="Active" value="Active" class="buttons">
                        <input type="submit" name="Inactive" value="Inactive" class="buttons">
                        <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()"></td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                    <tr height="22" >
                      <td width="3%" height="22" align="center" class="darkBG">
                        <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                      <td class="darkBG">Banner Details </td>
                      <td width="10%" align="center" class="darkBG">Status</td>
                      <td width="10%" align="center" class="darkBG">&nbsp;</td>
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
                      <td width="3%" height="20" align="center" valign="left">
                        <input type="checkbox" name="ids[]" value="<?php echo $line['b_id']; ?>"></td>
                      <td align="left" valign="left" class="text10">
						  <table width="100%" border="0" cellspacing="1" cellpadding="1">
							<tr>
							  <td class="contentBold"><?php echo $line['b_page']; ?></td>
							</tr>
							<tr>
							  <td><?php echo stripslashes($line['b_code']); ?></td>
							</tr>
						  </table>			  
					  </td>
                      <td width="10%" align="center" valign="left" class="text10"><?php if($line['status']=="Active"){ ?>
									<img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                                <?php }?>
								<?php if($line['status']=="Inactive"){?>
									<img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                                <?php }?></td>
                      <td width="10%" align="center" valign="left" bgcolor="<?php echo $bgcolor; ?>"><a href="banner_left_manage_frm.php?id=<?php echo $line['b_id'] ; ?>"><img src="images/edit16.gif" alt="EDIT" title="EDIT" width="16" height="16" border="0"></a></td>
                    </tr>
                    <?php }?>
                    <tr align="center">
                      <td colspan="4">
                        <?php  include "./includes/paging.inc.php";?>                      </td>
                    </tr>
                    <?php }else{?>
                    <tr align="center">
                      <td colspan="4" height="20" class="red">NO RECORD AVAILABLE.</td>
                    </tr>
                    <?php }?>
                    <tr align="left" height="22">
                      <td colspan="4" align="right" class="brown_bar">
                        <input type="hidden" name="start" value="<?php echo $start; ?>">
                        <input type="hidden" name="Delete">
                        <input type="button" name="Add" value="Add Record" class="buttons" onClick="add_rec()">
                        <input type="submit" name="Active" value="Active" class="buttons">
                        <input type="submit" name="Inactive" value="Inactive" class="buttons">
                        <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()"></td>
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
