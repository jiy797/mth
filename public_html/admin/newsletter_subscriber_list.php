<?php 
require "./includes/application_top.php";	

$admin_id=$_SESSION['admin_id'];
if ($admin_id==""){
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}

//--Search Options-------

$e_id	= $_GET['e_id'];
$e_status	= $_GET['e_status'];
$status	= $_GET['status'];

//-----------------------

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=50;
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
	$order_by='emailid';
}

$_SESSION['order_by2']=$order_by2;
$_SESSION['sess_order_by']=$order_by;

$columns="select * ";
$sql=" from yp_newsletter_subscriber where 1=1 ";

//--Search Options-------

if($e_id!=""){
	$sql.=" and emailid like '$e_id%'";
}

if($e_status!=""){
	$sql.=" and email_status='$e_status'";
}

if($status!=""){
	$sql.=" and status='$status'";
}

//------------------------

$sql1="select count(*) ".$sql;
$sql.= " order by emailid asc ";
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
		a=confirm("Are you sure you want to delete this record ?");
	//	alert(a);
		if(a==true){
			category.Delete.value="Delete";
			category.submit();
			return true;
		}else{
			return false;
		}

	}

	function want_to_send()
	{
		var a;
		a=confirm("Are you sure? You wish to send Newsletter to the selected Subscribers.");
	//	alert(a);
		if(a==true){
			category.Send.value="Send";
			category.submit();
			return true;
		}else{
			return false;
		}

	}

//-->
</script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
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
          <td width="75%" height="350" align="center" valign="top"> 
		  
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Newsletter Subscriber List </span></TD>
            <TD width="15%" align="right"><a href="page_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>

            <table width="98%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="darkBG">
                      <form name="form2" method="get" action="newsletter_subscriber_list.php?start=<?php echo $start; ?>">
                        
                        <tr>
                          <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                              <tr>
                                <td width="11%" align="right">Email ID </td>
                                <td width="20%" align="left"><input type="text" name="e_id" value="<?php echo $e_id; ?>" class="textfield"></td>
                                <td width="12%" align="right">Email Status</td>
                                <td width="15%" align="left"><select name="e_status" class="textfield" id="select">
                                  <option value="" selected>---Select----</option>
                                  <option value="Confirmed" <?php if($e_status=='Confirmed'){ echo "Selected";}?> >Confirmed</option>
                                  <option value="Pending" <?php if($e_status=='Pending'){ echo "Selected";}?> >Pending</option>
                                </select></td>
                                <td width="6%" align="right">Status</td>
                                <td width="15%" align="left"><select name="status" class="textfield" id="status">
                                  <option value="" selected>---Select----</option>
                                  <option value="Active"  <?php if($status=='Active'){ echo "Selected";}?> >Active</option>
                                  <option value="Inactive" <?php if($status=='Inactive'){ echo "Selected";}?> >Inactive</option>
                                  <option value="Unsubscribed" <?php if($status=='Unsubscribed'){ echo "Selected";}?> >Unsubscribed</option>
                                </select></td>
                                <td width="21%" align="center"><input name="Submit2" type="submit" class="buttons" value="Search"></td>
                              </tr>
                              
                              
                          </table></td>
                        </tr>
                      </form>
                  </table>
                    <br></td></tr>
            
              <tr>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="darkBG">
                    <form name="category" method="post" action="newsletter_subscriber_del.php">
                      <tr>
                        <td><table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                            <tr class="brown_bar" >
                              <td width="4%" height="22" align="center" class="darkBG">
                              <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                              <td width="46%" height="22" align="left" class="darkBG">Email ID</td>
                              <td width="3%" align="left" class="darkBG">&nbsp;</td>
                              <td width="18%" align="center" class="darkBG">Email Status </td>
                              <td width="13%" align="center" class="darkBG">Status</td>
                              <td width="16%" height="22" align="center" class="darkBG">Post Date </td>
                            </tr>
                            <?php  if(mysql_num_rows($result)>0){?>
                            <?php  while($line=mysql_fetch_array($result)){$pagecounter+=1;?>
                            <?php  
								if($bgcolor=="#e4e4e4"){
									$bgcolor="#f5f5f5";
								}else{
									$bgcolor="#e4e4e4";
								}
							?>
                            <tr bgcolor="<?php echo $bgcolor; ?>">
                              <td width="4%" height="20" align="center"><input type="checkbox" name="ids[]" value="<?php echo $line['id']; ?>">                              </td>
                              <td width="46%" height="20" class="text_11"><?php echo stripslashes($line['emailid']); ?></td>
                              <td width="3%" align="left" class="text_11"><?php// echo stripslashes($line['subs_name']); ?></td>
                              <td width="18%" align="center" class="text_11"><?php echo stripslashes($line['email_status']); ?></td>
                              <td width="13%" align="center" class="text_11"><?php echo $line['status']; ?></td>
                              <td width="16%" height="20" align="center" class="text10"><?php echo getFullDate($line['tdate'],'m-d-Y'); ?></td>
                            </tr>
                            <?php }?>
                            <tr align="center">
                              <td colspan="6"><?php  include "./includes/paging.inc.php";?>                              </td>
                            </tr>
                            <tr align="center">
                              <td colspan="6" align="left"> <br>
                                  <span class="titlepage">&nbsp;&nbsp;</span><span class="contentBold">NEWSLETTERS</span>
                                  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="darkBG">
                                    <tr>
                                      <td><table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="1" cellspacing="0">
                                          <tr class="outerbar" >
                                            <td height="22" colspan="2" align="center" class="darkBG">Select Newsletter to Send Subject</td>
                                            <td width="34%" height="22" align="center" class="darkBG">Postdate </td>
                                          </tr>
                                          <?php  
											$sql_nl=" select *  from yp_newsletter where newsletter_status='Active' ";
											$result_nl= executeQuery($sql_nl);

										if(mysql_num_rows($result_nl)>0){?>
                                          <?php  while($line_nl=mysql_fetch_array($result_nl)){
											$pagecounter+=1;?>
                                          <?php  
											if($bgcolor=="#e4e4e4"){$bgcolor="#f5f5f5";}else{$bgcolor="#e4e4e4";}
										  ?>
                                          <tr bgcolor="<?php echo $bgcolor; ?>">
                                            <td width="12%" height="20" align="center"><input type="radio" name="newsletter_id" value="<?php echo $line_nl['newsletter_id']; ?>">                                            </td>
                                            <td width="54%" align="left" class="text_11"><?php echo $line_nl['newsletter_subject']; ?></td>
                                            <td width="34%" height="20" align="center" class="text10">
											<?php echo getFullDate($line_nl['newsletter_postdate'],'m-d-Y'); ?>                                            </td>
                                          </tr>
                                          <?php }?>
										  <!--
                                          <tr align="center">
                                            <td colspan="3"><?php//  include "../includes/paging.inc.php";?>
                                            </td>
                                          </tr>
										  -->
                                          <?php }else{?>
                                          <tr align="center">
                                            <td colspan="3" height="20" class="red">No Newsletter Available.</td>
                                          </tr>
                                          <?php }?>
                                      </table></td>
                                    </tr>
                                  </table>
                                  <br>                              </td>
                            </tr>
                            <?php }else{?>
                            <tr align="center">
                              <td colspan="6" height="20" class="red">No Newsletter Subscriber Found</td>
                            </tr>
                            <?php }?>
                            <tr align="right" >
                              <td align="left">&nbsp;</td>
                              <td colspan="5" ><input type="hidden" name="start" value="<?php echo $start; ?>">
                                  <input type="hidden" name="Delete">
                                  <input type="hidden" name="Send">
                                  <input name="Submit" type="submit" class="buttons" value="Send Newsletter" onClick="return want_to_send()">
                                  <input type="submit" name="Active" value="Active" class="buttons">
                                  <input type="submit" name="Inactive" value="Inactive" class="buttons">
                                  <input type="submit" name="Unsubscribe" value="Unsubscribe" class="buttons">
                                  <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()"></td>
                            </tr>
                        </table></td>
                      </tr>
                    </form>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <br>          </td>
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