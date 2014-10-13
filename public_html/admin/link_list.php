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
	$order_by='link_id';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns=" select * ";

$sql= " from yp_links where 1=1";

$sql1= "select count(*) ".$sql;
$sql.= " order by link_position asc";
$sql.= " limit $start, $pagesize";

$sql= $columns.$sql;
$result= executeQuery($sql);
//echo "<br>".$sql;



$reccnt= getSingleResult($sql1);	
$no= mysql_num_rows($result);

$bgcolor="#e4e4e4";
?>

<html>
<head>
<title><?php echo $title; ?> Admin Manager</title>
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
		a=confirm("Are you sure?. You want to delete the selected record(s).")
		if(a==true){
			links_frm.Delete.value="Delete";
			links_frm.submit();
		}
	}
	function add_link(){
		location.href="link_add_frm.php";
	}

	function make_up(id,postion,start){
		location.href="link_position.php?id="+id+"&pos="+postion+"&start="+start+"&type=up";
	}
	function make_down(id,postion,start){
		location.href="link_position.php?id="+id+"&pos="+postion+"&start="+start+"&type=down";
	}

//-->
</script> 
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td colspan="3"><?php  include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php  include "admin_left_bar.inc.php" ; ?>
          </td>
          <td width="75%" height="400" align="center" valign="top">
		  
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Links </span></TD>
            <TD width="15%" align="right">&nbsp;</TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>
              
            <TABLE WIDTH="98%" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0" class="darkBG">
              <TR>
                <TD VALIGN="top" ROWSPAN="2" ALIGN="center">
                  <TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="1" >
                    <form method="post" action="link_del.php" name="links_frm">
                      
                      <TR>
                        <TD>
                          <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                          
                            <tr class="darkBG" >
                              <td width="3%" align="center" >
                              <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)">                              </td>
                              <td class="darkBG">Name</td>
                              <td class="darkBG">Link URL </td>
                              <td class="darkBG">Position</td>
                              <td class="darkBG">Category</td>
                              <td align="center" class="darkBG">Status</td>
                              <td>&nbsp;</td>
                            </tr>
							<?php if($no>0){?>
                            <?php 
								  while($line=mysql_fetch_array($result)){$pagecounter+=1;
				
									if($bgcolor=="#e4e4e4"){
										$bgcolor="#f5f5f5";
									}else{
										$bgcolor="#e4e4e4";
										}
										
							  ?>
                            <tr bgcolor="<?php echo $bgcolor; ?>">
                              <td width="3%" align="center" valign="top" class="text_10">
                              <input type="checkbox" name="u_ids[]" value="<?php echo $line['link_id']; ?>">                              </td>
                              <td width="17%" valign="top" bgcolor="<?php echo $bgcolor; ?>" class="text_11"><?php echo stripslashes($line['link_name']); ?></td>
                              <td width="39%" valign="top" bgcolor="<?php echo $bgcolor; ?>" class="text_11">
							  <?php echo wordwrap( $line['link_ref'], 40, "\n", 1);?>							  </td>
                              <td width="13%" valign="top" bgcolor="<?php echo $bgcolor; ?>" class="text_11">
								<?php echo '[ '.$line['link_position'].' ]'?>&nbsp; 
								<a href="#" onClick="javascript:make_up('<?php echo $line['link_id']?>','<?php echo $line['link_position']?>','<?php echo $start?>')"><u>UP</u></a> | <a href="#" onClick="javascript:make_down('<?php echo $line['link_id']?>','<?php echo $line['link_position']?>','<?php echo $start?>')"><u>DOWN</u></a>							  </td>
                              <td width="17%" valign="top" bgcolor="<?php echo $bgcolor; ?>" class="text_11">
							  <?php 
								  echo stripslashes(getSingleResult("select category_name from yp_links_category where category_id ='".$line['link_cat_id']."' ")); 
							   ?>							  </td>
                              <td width="6%" align="center" valign="top" class="text_10">
                                <?php if($line['link_status']=="Active"){ ?>
                                <img src="images/icon_status_green.gif" alt="Active" width="10" height="10">
                                <?php }?>
                                <?php if($line['link_status']=="Inactive"){?>
                                <img src="images/icon_status_red.gif" alt="Inactive" width="10" height="10">
                                <?php }?>                              </td>
                              <td width="5%" align="center" valign="top" class="text_10"><a href="link_edit_frm.php?link_id=<?php echo $line['link_id']; ?>&start=<?php echo  $start; ?>" class="text_11"><img src="images/edit16.gif" alt="Edit Content" width="16" height="16" border="0"> </a></td>
                            </tr>
                            <?php  }?>
                            <tr>
                              <td colspan="7" height="1" bgcolor="#FFFFFF"></td>
                            </tr>
                            <tr >
                              <td colspan="7" class="main">
                                <?php  include "./includes/paging.inc.php"; ?>                              </td>
                            </tr>
                            <?php  } else {?>
                            <tr >
                              <td colspan="7" class="main"><table width="100%" border="0" align="center" bgcolor="#FFFFFF">
                                  <tr>
                                    <td>
                                      <table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="4" cellspacing="0" align="center">
                                        <tr>
                                          <td class="red" height="20" align="center"> NO RECORD AVAILABLE.</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <?php }?>
                            <tr align="right">
                              <td colspan="8" class="text_10">
                                <input type="hidden" name="start" value="<?php echo $start; ?>">
                                <input type="hidden" name="Delete">
                                <input name="ADD" type="button" class="buttons" value="Add Link" onClick="add_link()">
								<input type="submit" name="Active" value="Active" class="buttons">
								<input type="submit" name="Inactive" value="Inactive" class="buttons">
								<input type="button" name="delete" value="Delete" class="buttons" onClick="want_to_Delete()"></td>
                            </tr>
                        </table></TD>
                      </TR>
                    </form>
                </TABLE></TD>
              </TR>
            </TABLE>
          <br></td>
      </tr>
      <tr>
        <td colspan="3"><?php  include "admin_footer.inc.php" ; ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
