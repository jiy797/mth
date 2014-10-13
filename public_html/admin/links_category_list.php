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

if($_SESSION['sess_order_by']==$order_by)
{
	if($_SESSION['order_by2']=='desc')
	{
		$order_by2='asc';
	}
	else
	{
		$order_by2='desc';
	}
}

if($order_by2=='')
{
	$order_by2='asc';
}

if($order_by=='')
{
	$order_by='category_name';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_links_category where 1=1";

if(isset($_GET['parent_cat_id']) && $_GET['parent_cat_id']!=''){
	$sql.=" and parent_cat_id='".$_GET['parent_cat_id']."'";
}

$sql1="select count(*) ".$sql;
$sql.= " order by position ";
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
	function want_to_Delete()
	{
		var a;
		a=confirm("Are you sure you want to delete the selected User(s)?")
		if(a==true){
			category.Delete.value="Delete";
			category.submit();
		}
	}

	function addcategory(){
		location.href="links_category_frm.php";
	}

	
	function make_up(id,postion,start){
		location.href="links_category_position.php?id="+id+"&pos="+postion+"&start="+start+"&type=up";
	}
	function make_down(id,postion,start){
		location.href="links_category_position.php?id="+id+"&pos="+postion+"&start="+start+"&type=down";
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
            <TR>
              <TD><span class="para_heading">Manage Links Category  </span></TD>
            </TR>
            <TR><TD align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
		  
            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG">
			<form name="category" method="post" action="links_category_del.php">
              <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                      <tr>
                        <td width="27" class="darkBG" ><input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td> 
                        <td width="408" height="22" class="darkBG" >
						<table width="100%" border="0" cellspacing="0" cellpadding="2">
									<tr>
									<td class="darkBG" >Category Name</td>
									<td align="right"><?php if($_GET['order_by2']=='asc'){?>
									<a href="<?php echo $_SERVER['PHP_SELF']; ?><?php echo get_qry_str(array('order_by','order_by2'),array('category_name','desc')); ?>" >
									<img src="images/desc16.gif" alt="Descending" border="0"></a>
									<?php }else{?>
									<a href="<?php echo $_SERVER['PHP_SELF']; ?><?php echo get_qry_str(array('order_by','order_by2'),array('category_name','asc')); ?>" >
									<img src="images/asc16.gif" alt="Descending" border="0"></a>
									<?php }?>&nbsp;&nbsp;</td>
									</tr>
					    </table>						</td>
                        <td width="228" class="darkBG" >Position</td>
                        <td width="135" height="22" align="center" class="darkBG">Status</td>
               <!--          <td width="124" align="center" class="darkBG">Position </td> -->
                        <td width="81" height="22" align="right" class="darkBG">&nbsp;</td>
                      </tr>
                      <?php 
					  
					  if(mysql_num_rows($result)>0){
						  while($line=mysql_fetch_array($result)){
							  $pagecounter+=1;
							if($bgcolor=="#e4e4e4"){$bgcolor="#f5f5f5";}else{$bgcolor="#e4e4e4";}
					?>
                      <tr bgcolor="<?php echo $bgcolor; ?>">
                        <td width="27" bgcolor="<?php echo $bgcolor; ?>" class="main"><input type="checkbox" name="ids[]" value="<?php echo $line['category_id'];?>"></td> 
                        <td width="408" height="20" bgcolor="<?php echo $bgcolor; ?>" class="mainBold"> 
                          &nbsp;<?php echo stripslashes($line['category_name']); ?></td>
                        <td width="228" bgcolor="<?php echo $bgcolor; ?>"><span class="text_11"><?php echo '[ '.$line['position'].' ]'?>&nbsp; <a href="#" onClick="javascript:make_up('<?php echo $line['category_id']?>','<?php echo $line['position']?>','<?php echo $start?>')"><u>UP</u></a> | <a href="#" onClick="javascript:make_down('<?php echo $line['category_id']?>','<?php echo $line['position']?>','<?php echo $start?>')"><u>DOWN</u></a></span></td>
                        <td  height="20" align="center" bgcolor="<?php echo $bgcolor; ?>" class="main"> 
                         <?php if($line['category_status']=="Active"){ ?><img src="images/icon_status_green.gif" alt="Active" width="10" height="10"><?php }?>
                         <?php if($line['category_status']=="Inactive"){?><img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10"><?php }?>                        </td>
                        <td width="81" height="20" align="center"><a href="links_category_frm.php?cid=<?php echo $line['category_id']; ?>&start=<?php echo $start; ?>" class="menu"><img src="images/edit16.gif" alt="Edit Content" width="16" height="16" border="0"></a></td>
                      </tr>
                      <?php }?>
                      <tr align="center"> 
                        <td colspan="6"> 
                          <?php  include "./includes/paging.inc.php";?></td>
                      </tr>
                      <?php }else{?>
                      <tr align="center"> 
                        <td colspan="6" height="20" class="red">NO RECORD AVAILABLE.</td>
                      </tr>
                      <?php }?>
                      <tr align="right"> 
                        <td colspan="6" class="brown_bar"> 
						<input type="hidden" name="start" value="<?php echo $start; ?>">
						<input type="hidden" name="Delete" value="">
						<input type="button" name="AddCategory" value="Add Category" class="buttons" onClick="addcategory()">
						<input type="submit" name="Active" value="Active" class="buttons">
						<input type="submit" name="Inactive" value="Inactive" class="buttons">
						<input type="button" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()">
												</td>
                      </tr>
                    </table>                </td>
              </tr>
			  </form>
          </table>   
		  <br>
		  </td>
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