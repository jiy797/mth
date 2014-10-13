<?php 
require "./includes/application_top.php";
$admin_id = $_SESSION['admin_id'];
if ($admin_id==""){
$_SESSION['msg'] = "Session Expired. Please Login Again to Proceed.";
header("Location:index.php");
exit();
}

	if(isset($_GET['currency_id']) && !empty($_GET['currency_id'])){
		$currency_id = $_GET['currency_id'];
		$sql_cs		= "select * from yp_currency where currency_id = '".$_GET['currency_id']."' ";
		$result_cs  = executeQuery($sql_cs);
		while($line_cs = mysql_fetch_array($result_cs)){
			$currency_title		= $line_cs['currency_title'];
			$currency_sign		= $line_cs['currency_sign'];
			$conversion_value		= $line_cs['conversion_value'];
			$currency_status	= $line_cs['currency_status'];
		}
	}

	$start=0;
	if(isset($_GET['start'])){	$start=$_GET['start'];}
	$pagesize=15;
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

	if($order_by==''){
		$order_by='currency_title';
	}

	$_SESSION['order_by2']=$order_by2;
	$_SESSION['sess_order_by']=$order_by;

	$title		=	trim($_GET['title']);
	$status		=	$_GET['status'];

	$columns="select * ";
	$sql=" from yp_currency where 1=1 ";
	if($title!=""){
		$sql.=" and currency_title like '%$title%'";
	}

	if($status!=""){
		$sql.=" and currency_status='$status'";
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
<title><?php echo $site_title; ?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript">
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
		a=confirm("Are you sure?. You want to delete these records.");
	//	alert(a);
		if(a==true){
			formCurrency.Delete.value="Delete";
			formCurrency.submit();
			return true;
		}else{
			return false;
		}

	}

function validate(formObj)
{
	var error=''
	if(formObj.currency_title.value==""){
		error +="\n Currency Title";
	}
	if(formObj.currency_sign.value==""){
		error +="\n Currency Sign";
	}
	if(formObj.conversion_value.value==""){
		error +="\n Conversion Value";
	}
	if(formObj.conversion_value.value<=0){
		error +="\n Invalid Conversion Value";
		
	}
	if (isNaN(formObj.conversion_value.value)){
		error +="\n Conversion Value must be Numeric";
		
	}
	if(error !=''){
		alert ('Please Enter the following \n' + error)
		return false
	}else
	{
			return true
	}

}
function want_change_currency(formCurrency)
	{
		var a;
		a=confirm("Are you sure?. You want to change default currency.");
		if(a==true){
			formCurrency.submit();
			return true;
		}else{
			return false;
		}

	}
//-->
</SCRIPT>

<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" leftmargin="0">
<table id="maintable" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><?php  include "admin_header.inc.php";?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";	?>        </td>
        <td width="75%" height="300" align="center" valign="top">
		
		<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
		<TR><TD width="85%"><span class="para_heading">Manage Currency</span></TD>
		<TD width="15%" align="right"> </TD>
		</TR>
		<TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
		</TR>
		</TABLE>
		
<?php if($currency_id!=''){echo "<div align='right'><a href='currency_frm.php'>ADD NEW</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>";}?>
            <table width="98%"  border="0" cellpadding="0" cellspacing="1" class="blue_bar">
              <tr>
                <td><table width="100%"  border="0" cellpadding="6" cellspacing="1" bgcolor="#FFFFFF">
					  
					
					  <form action="currency.php" method="post" enctype="multipart/form-data" name="formCurrency" onSubmit="return validate(this)">
					  <tr valign="top" bgcolor="#f7f7f7">
					    <td  class="mainBold">Currency Title <span class="red">*</span> </td>
					    <td valign="bottom"><input name="currency_title" type="text" class="textfield" id="chart_title" size="40" value="<?php echo stripslashes($currency_title);?>"></td>
					    </tr>
					  <tr valign="top" bgcolor="#f7f7f7">
					    <td class="mainBold">Currency Sign <span class="red">*</span></td>
					    <td valign="bottom"><input name="currency_sign" type="text" class="textfield" id="currency_sign" size="40" value="<?php echo htmlentities($currency_sign);?>"></td>
					    </tr>
					  <tr valign="top" bgcolor="#f7f7f7">
					    <td class="mainBold">Conversion Value <span class="red">*</span> </td>
					    <td valign="bottom"><input name="conversion_value" type="text" class="textfield" id="conversion_value" size="20" value="<?php echo stripslashes($conversion_value);?>"> </td>
					    </tr>
					  <tr valign="top" bgcolor="#f7f7f7">
					    <td class="mainBold">Currency status </td>
					    <td valign="bottom"><table width="30%" border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td width="6%"><input name="currency_status" id="currency_status" type="radio" value="Active" 
							  <?php if($currency_status=='Active' || $currency_status==''){ echo "Checked"; }?>>                            </td>
                            <td width="33%" >Active</td>
                            <td width="7%"><input name="currency_status" id="currency_status" type="radio" value="Inactive" <?php if($currency_status=='Inactive'){ echo "Checked"; }?>></td>
                            <td width="31%">Inactive</td>
                            </tr>
                        </table></td>
					    </tr>
					  <tr valign="top" bgcolor="#f7f7f7">
						<td width="17%" class="mainBold">&nbsp;</td>
					    <td width="38%" valign="bottom"><span class="text10">
					      <input name="currency_id" type="hidden" id="currency_id" value="<?php echo $currency_id?>">
                          <?php if($currency_id!=''){ $btn_title="EDIT";}else{ $btn_title= "ADD";}?>
                          <input name="Submit" type="submit" class="buttons" value="<?php echo $btn_title?>">
					    </span></td>
				        </tr>
	                  </form>

                </table>
				</td>
              </tr>
            </table>
			<br>
          	<!--  Chart List  -->
			
	<table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
              
              <form name="product" method="post" action="currency_del.php">
               
                <tr>
                  <td><table width="100%" border="0" bgcolor="#FFFFFF" cellpadding="2" cellspacing="1">
                      <tr height="22">
                        <td width="5%" height="30" align="center" class="darkBG">
                        <input type="checkbox" name="cb1" value="1" onClick="isValid(this.form)"></td>
                        <td width="31%" align="left" class="darkBG">&nbsp;Currency Title</td>
                        <td width="14%" align="center" class="darkBG">&nbsp;Currency Sign </td>
                        <td width="14%" align="center" valign="middle" class="darkBG">Currency Status</td>
                        <td width="9%" align="center" valign="middle" class="darkBG">Default</td>
                        <td width="15%" align="center" valign="middle" class="darkBG">Conversion Value </td>
                        <td width="12%" align="center" class="darkBG">&nbsp;</td>
                      </tr>
                      <?php  if(mysql_num_rows($result)>0){ $ctr=1;?>
                      <?php  while($line=mysql_fetch_array($result)){$pagecounter+=1;?>
                      <?php 
						if($bgcolor=="#e4e4e4"){$bgcolor="#f5f5f5";
						}else{ $bgcolor="#e4e4e4";}
						
						$ctr++;
					?>
                      <tr bgcolor="<?php echo $bgcolor; ?>">
                        <td width="5%" height="20" align="center" valign="top" bgcolor="<?php echo $bgcolor; ?>"><input type="checkbox" name="ids[]" value="<?php echo $line['currency_id']; ?>">                        </td>
                        <td width="31%" align="left" valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="text10"><span class="text10_bold">&nbsp;<?php echo stripslashes($line['currency_title']); ?></span></td>
                        <td width="14%" align="center" valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="text10"><span class="para_heading"><?php echo stripslashes($line['currency_sign']); ?></span></td>
                        <td width="14%" align="center" valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="text10"><?php echo stripslashes($line['currency_status']);?></td>
                        <td width="9%" align="center" valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="text10">
						<input name="currency_default" type="radio" id="currency_default"  value="<?php echo $line['currency_id']; ?>" <?php if($line['currency_default']=='Yes'){ echo "Checked";}?>  onClick="return want_change_currency(this.form)" ></td>
                        <td width="15%" align="center" valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="text10">
						<?php echo number_format($line['conversion_value'],2,'.',','); ?></td>
                        <td width="12%" align="center" valign="middle" bgcolor="<?php echo $bgcolor; ?>"><table width="100%"  border="0" cellspacing="2" cellpadding="2">
                            <tr>
                              <td align="center"><a href="currency_frm.php?currency_id=<?php echo $line['currency_id']; ?>&start=<?php echo $start; ?>" class="small"><img src="images/edit16.gif" alt="EDIT" width="16" height="16" border="0"></a></td>
                            </tr>
                        </table></td>
                      </tr>
                      <?php }?>
                      <tr align="center">
                        <td colspan="7"><?php  include "./includes/paging.inc.php";?>                        </td>
                      </tr>
                      <?php }else{?>
                      <tr align="center">
                        <td colspan="7" height="20" class="redbold">No Records Available.</td>
                      </tr>
                      <?php }?>
                      <tr align="right" height="22">
                        <td colspan="7" class="brown_bar">
                            <input type="hidden" name="start" value="<?php echo $start; ?>">
                            <input type="hidden" name="Delete">
                            <input type="submit" name="delete" value="Delete" class="buttons" onClick="return want_to_Delete()">							</td>
                      </tr>
                  </table></td>
                </tr>
              </form>
            </table>
        <br>
        <br></td>
      </tr>
    </table>
	<!--  End Chart List  -->
	</td>
      </tr>
    </table>
	

	
		</td>
  </tr>
  <tr>
    <td><?php  include "admin_footer.inc.php";?></td>
  </tr>
</table>
</body>
</html>
