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
		$order_by='page_title';
	}

	$_SESSION['order_by2']=$order_by2;
	$_SESSION['sess_order_by']=$order_by;

	$columns="select * ";
	$sql=" from yp_new_pages where 1=1";
	$sql1="select count(*) ".$sql;
	$sql.= " order by trim($order_by) asc";
	$sql.= " limit $start, $pagesize";

	$sql= $columns.$sql;
	$result= executeQuery($sql);
	//echo "<br>".$sql;

	$reccnt= getSingleResult($sql1);	
	$bgcolor="#e4e4e4";

?>
<title><?php echo $site_title;?> Admin Manager</title>
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
	function want_to_Delete(id,start)
	{
		var a;
		a=confirm("Are you sure? You want to delete this record?");
		if(a==true){
			return true;
		}else{
			return false;
		}

	}

	function add_rec(){
		location.href="new_page_frm.php";
	}
//-->
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><?php include "admin_header.inc.php"; ?>
          </td>
        </tr>
        <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php include "admin_left_bar.inc.php"; ?>          </td>
          <td width="75%" height="400" align="center" valign="top">
		  
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD><span class="para_heading">New Page List </span></TD></TR>
            <TR><TD align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
		  
            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG">
			<form name="form_frm" method="post" action="new_page_del.php">
              <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                      <tr>
                        <td class="darkBG" ><input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td> 
                        <td class="darkBG" >Main Page </td>
                        <td height="22" class="darkBG" >&nbsp;Page Title </td>
                        <td align="center" class="darkBG">Page ID </td>
                        <td align="center" class="darkBG">Status</td>
                        <td width="95" align="center" class="darkBG">Display In List </td>
                        <td height="22" align="right" class="darkBG">&nbsp;</td>
                      </tr>
                      <?php 
					  
					  if(mysql_num_rows($result)>0){
						  while($line=mysql_fetch_array($result)){
							  $pagecounter+=1;
							if($bgcolor=="#e4e4e4"){$bgcolor="#f1f1f1";}else{$bgcolor="#e4e4e4";}
					?>
                      <tr bgcolor="<?php echo $bgcolor; ?>">
                        <td width="21" bgcolor="<?php echo $bgcolor; ?>" class="main"><input type="checkbox" name="ids[]" value="<?php echo $line['page_id'];?>"></td> 
                        <td width="136" bgcolor="<?php echo $bgcolor; ?>" class="mainBold"><?php echo stripslashes($line['mainpage']); ?></td>
                        <td width="242" height="20" bgcolor="<?php echo $bgcolor; ?>" class="mainBold"> 
                          &nbsp;<?php echo stripslashes($line['page_title']); ?></td>
                        <td width="78" align="center" bgcolor="<?php echo $bgcolor; ?>" class="main"><?php echo stripslashes($line['page_id']); ?></td>
                        <td width="95" align="center" bgcolor="<?php echo $bgcolor; ?>" class="main"><?php if($line['status']=="Active"){ ?>
                          <img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                          <?php }?>
                          <?php if($line['status']=="Inactive"){?>
                          <img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                        <?php }?></td>
                        <td align="center"><?php if($line['show_status']=="Active"){ ?>
                          <img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                          <?php }?>
                          <?php if($line['show_status']=="Inactive"){?>
                          <img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                        <?php }?></td>
                        <td width="34" height="20" align="center"><a href="new_page_frm.php?page_id=<?php echo $line['page_id']; ?>&start=<?php echo $start; ?>" class="menu"><img src="images/edit16.gif" alt="Edit Content" width="16" height="16" border="0"></a></td>
                      </tr>
                      <?php }?>
                      <tr align="center"> 
                        <td colspan="7"> 
                          <?php  include "./includes/paging.inc.php";?></td>
                      </tr>
                      <?php }else{?>
                      <tr align="center"> 
                        <td colspan="7" height="20" class="red">NO RECORD AVAILABLE.</td>
                      </tr>
                      <?php }?>
                      <tr align="right"> 
                        <td colspan="7" class="brown_bar"> 
                          <input type="hidden" name="start" value="<?php echo $start; ?>">
						    <input type="button" name="AddPage" value="Add Page" class="buttons" onClick="add_rec()">
						    <input type="submit" name="Active" value="Active" class="buttons">
                            <input type="submit" name="Inactive" value="Inactive" class="buttons">
							<input type="submit" value="Display in List : Yes" name="Display_yes" class="buttons">
                            <input type="submit" value="Display in List : No" name="Display_no" class="buttons">
						    <input type="submit" name="Delete" value="Delete" class="buttons" onClick="return want_to_Delete()">						             </td>
                      </tr>
                    </table>                </td>
              </tr>
			  </form>
          </table>          </td>
        </tr>
        <tr>
          <td colspan="3"><?php  include "admin_footer.inc.php" ; ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>