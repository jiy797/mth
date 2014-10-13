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

if($id!=""){
	$sql="select * from yp_news where rec_id='$id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$cat_id   = $line['cat_id'];
		$rec_name = $line['rec_name'];
		$rec_date = $line['rec_date'];
		$rec_desc = $line['rec_desc'];
		$rec_pdf  = $line['rec_pdf'];
		$meta_title		= $line['meta_title'];
		$meta_keywords	= $line['meta_keywords'];
		$meta_desc		= $line['meta_desc'];
	}	
}
$rec_date = substr($rec_date,5,2)."-".substr($rec_date,8,2)."-".substr($rec_date,0,4); 

if($id==''){
	$cat_id  = $_SESSION['cat_id'];
	$rec_name= $_SESSION['rec_name'];
	$rec_date= $_SESSION['rec_date'];
	$rec_desc= $_SESSION['rec_desc'];
	$meta_title		= $_SESSION['meta_title'];
	$meta_keywords	= $_SESSION['meta_keywords'];
	$meta_desc		= $_SESSION['meta_desc'];
}

include("../fckeditor/fckeditor.php") ;
?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>

<SCRIPT LANGUAGE="JavaScript">
<!--

function validate(formObj)
{
	var error=''

	if(formObj.cat_id.value=="0"){
		error +="Select Category\n";
	}

	if(formObj.rec_name.value==""){
		error +="Input Title\n";
	}

	if(formObj.rec_date.value==""){
		error +="Input Date\n";
	}

	if(error !=''){
		alert ("Following fields are required :\n\n"+error)
		return false
	}else
	{
			return true
	}

}
//-->
</SCRIPT>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../cal2/calendar.js"></script>
<script type="text/javascript" src="../cal2/lang/calendar-en.js"></script>
<script type="text/javascript" src="../cal2/calendar-setup.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../cal2/calendar-blue.css" title="blue" />

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
            </table>        </td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage News : Article Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="news_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="news_manage.php" method="post" enctype="multipart/form-data" name="form_frm" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                    </tr>
					<?php 
						$sql_cat="select * from yp_news_category where status='Active'";
						$res_cat=executeQuery($sql_cat);
					?>
                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="13%" align="left" valign="top" class="contentBold">Related Category</td>
                      <td width="85%">
					  <select name="cat_id" class="textfield">
					  <option value="0" selected>--Select--</option>
                          <?php  while($line_cat=mysql_fetch_array($res_cat)){ ?>
                          <option value="<?php echo $line_cat['cat_id']; ?>" <?php if($cat_id==$line_cat['cat_id']){ echo 'selected';}?>>
                          <?php echo $line_cat['cat_name']; ?>						  </option>
                          <?php }?>
                        </select></td>
                    </tr>

                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="13%" align="left" valign="top" class="contentBold">Title </td>
                      <td width="85%"><input name="rec_name" id="rec_name" type="text" class="textfield" size="80" value="<?php echo stripslashes($rec_name)?>"></td>
                    </tr>

                   <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="13%" align="left" valign="top" class="contentBold">Date </td>
                      <td width="85%"><input name="rec_date" id="rec_date" type="text" class="textfield" size="15" value="<?php echo stripslashes($rec_date)?>">
                          <img src="../cal2/img.gif" name="f_trigger_A" id="f_trigger_A" style="cursor: pointer; border: 1px solid blue;" title="Date selector" onMouseOver="this.style.background='blue';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
						Calendar.setup({
						inputField     :    "rec_date",     // id of the input field
						ifFormat       :    "%m-%d-%Y",      // format of the input field
						button         :    "f_trigger_A",  // trigger for the calendar (button ID)
						align          :    "Tl",           // alignment (defaults to "Bl")
						singleClick    :    true
						});
					</script></td>
                    </tr>

					<tr valign="top">
					  <td class="red">&nbsp;</td>
					  <td>Meta Title </td>
					  <td><textarea name="meta_title" id="meta_title" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_title)?></textarea></td>
					</tr>
					<tr valign="top">
					  <td align="center" class="red">&nbsp;</td>
					  <td align="left" class="main">Meta Keywords </td>
					  <td align="left"><textarea name="meta_keywords" id="meta_keywords" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_keywords)?></textarea></td>
					</tr>
					<tr valign="top">
					  <td align="center" class="red">&nbsp;</td>
					  <td align="left" class="main">Meta Description </td>
					  <td align="left"><textarea name="meta_desc" id="meta_desc" cols="70" rows="3" class="textfield"><?php echo stripslashes($meta_desc)?></textarea></td>
					</tr>


                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="contentBold">Description</td>
                      <td class="red"><textarea name="rec_desc" id="rec_desc" cols="79" rows="10" class="textfield"><?php echo stripslashes($rec_desc)?></textarea>
					  <script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'rec_desc' ) ; 
							oFCKeditor.BasePath     = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet = 'Basic' ; 
							oFCKeditor.Height = '400' ; 
							oFCKeditor.ReplaceTextarea() ; 
							} 
						</script>
					  </td>
                    </tr>
					<?php if($rec_pdf!=''){?>
					<tr>
                      <td>&nbsp;</td>
                      <td class="contentBold">Existing Pdf File</td>
                      <td class="red"><a href="../uploadedfiles/pdf/<?php echo $rec_pdf?>" target="_blank">VIEW</a></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="contentBold">Pdf File</td>
                      <td><input name="image1" type="file" class="textfield" id="image1"></td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="85%">
						<input name="id" type="hidden" value="<?php echo $id; ?>">
						<input name="rec_file" type="hidden" id="rec_file" value="<?php echo $rec_pdf;?>">
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="85%">
                      <input type="submit" name="Submit" value="SUBMIT" class="buttons"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </form>
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
