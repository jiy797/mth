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
	$order_by='cat_id';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_news_category where 1=1";

$se_name = checkInput($_GET['se_name']);
if($se_name!=''){
	$sql.=" and cat_name like '$se_name%' ";
}

$sql1="select count(*) ".$sql;
$sql.= " order by $order_by asc ";
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
		a=confirm("If you delete a category, all the information related to this category will also be deleted. Are you sure ?. You want to delete the selected category?");
	//	alert(a);
		if(a==true){
			form_ref.Delete.value="Delete";
			form_ref.submit();
			return true;
		}else{
			return false;
		}

	}

	function add_rec(){
		location.href="news_category_manage_frm.php";
	}

//-->
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><?php include "admin_header.inc.php";?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" valign="top" class="brown_bar"><?php include "admin_left_bar.inc.php";?></td>
        <td width="75%" height="300" align="center" valign="top">
		
		<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="82%"><span class="para_heading">Manage News : Category List</span></TD>
            <TD width="18%" align="left" class="red_big">TOTAL RECORDS : <?php echo $reccnt?></TD>
            </TR>
            <TR>
              <TD colspan="2" align="center"><table width="50%" border="0" align="center" cellpadding="1" cellspacing="0" class="darkBG">
                <form name="form2" method="get" action="news_category_list.php?start=<?php echo $start; ?>">
                  <tr>
                    <td height="20" align="center">Search</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="4" cellpadding="4" align="center" bgcolor="#FFFFFF">
                        <tr>
                          <td width="33%" class="contentBold" align="right">Category Name</td>
                          <td width="46%" align="center"><input type="text" name="se_name" class="textfield"></td>
                          <td width="21%"><input type="submit" name="Submit2" value="Search" class="buttons"></td>
                        </tr>
                    </table></td>
                  </tr>
                </form>
              </table></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>

          <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
            <form name="form_ref" method="post" action="news_category_del.php">
              <tr>
                <td><table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="1" cellspacing="1">
                    <tr height="22" >
                      <td width="3%" height="22" align="center" class="darkBG">
                        <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                      <td width="58%" align="left" class="darkBG">&nbsp;Category Name  </td>
                      <td width="12%" height="22" align="center" class="darkBG">Status</td>
                      <td width="9%" align="center" class="darkBG">&nbsp;</td>
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
                      <td width="3%" height="20" align="center" valign="top"><input type="checkbox" name="ids[]" value="<?php echo $line['cat_id']; ?>"></td>
                      <td width="58%" align="left" valign="top" class="text10">&nbsp;<?php echo stripslashes($line['cat_name']); ?></td>
                      <td width="12%" height="20" align="center" valign="top" class="text10">
								<?php if($line['status']=="Active"){ ?>
									<img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                                <?php }?>
								<?php if($line['status']=="Inactive"){?>
									<img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                                <?php }?></td>
                      <td width="9%" align="center" valign="top" bgcolor="<?php echo $bgcolor; ?>"><a href="news_category_manage_frm.php?id=<?php echo  $line['cat_id'] ; ?>&start=<?php echo $start; ?>"><img src="images/edit16.gif" alt="EDIT" width="16" height="16" border="0"></a></td>
                    </tr>
                    <?php }?>
                    <tr align="center">
                      <td colspan="4"><?php include "./includes/paging.inc.php";?>                      </td>
                    </tr>
                    <?php }else{?>
                    <tr align="center">
                      <td colspan="4" height="20" class="red">NO RECORD AVAILABLE.</td>
                    </tr>
                    <?php }?>
                    <tr align="right" height="22">
                      <td colspan="4" class="brown_bar"><input type="hidden" name="start" value="<?php echo $start; ?>">
                          <input type="hidden" name="Delete">
                          <input type="button" name="Add" value="Add Category" class="buttons" onClick="add_rec()">
                          <input type="submit" name="Active" value="Active" class="buttons">
                          <input type="submit" name="Inactive" value="Inactive" class="buttons">
                          <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()">                      </td>
                    </tr>
                </table></td>
              </tr>
            </form>
          </table>
          <br>
          <br>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include "admin_footer.inc.php";?></td>
  </tr>
</table>
</body>
</html>
