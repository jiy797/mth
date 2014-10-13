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

$id		= $_GET['id'];
$rec_id = $_GET['rec_id'];

$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$id'");

if($rec_id!=""){
	$sql="select * from yp_provider_review where rec_id='$rec_id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$rev_name   = $line['rev_name'];
		$rev_email  = $line['rev_email'];
		$rev_rating = $line['rev_rating'];
		$rev_details= $line['rev_details'];
		$posttime	= $line['posttime'];
	}
}

?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>
<link href="css/yp.css" rel="stylesheet" type="text/css">
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
            </table></td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Provider List : <?php echo stripslashes($provider_name)?> -> Review Details </span></TD>
            <TD width="15%" align="right"><a href="provider_review_list.php?id=<?php echo $id?>" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
				  <form action="provider_review_manage.php" method="post" enctype="multipart/form-data" name="review_submit" id="review_submit">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(* required) </td>
                      <td class="red"></td>
                    </tr>
                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="14%" align="left" valign="top" class="text10_bold">Name</td>
                      <td width="84%" class="main"><input name="rev_name" id="rev_name" value="<?php echo stripslashes($rev_name)?>" class="textfield" type="text" size="50" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="text10_bold">Email Address </td>
                      <td class="main"><input name="rev_email" id="rev_email" value="<?php echo stripslashes($rev_email)?>" class="textfield" type="text" size="50" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="text10_bold">Rating</td>
                      <td class="main"><select name="rev_rating" id="rev_rating" class="textfield" style="width:160px;">
                            							<option value="0">Choose...</option>
                            							<option value="5" <?php if($rev_rating=='5'){ echo 'selected';}?>>5 - Excellent</option>
                            							<option value="4" <?php if($rev_rating=='4'){ echo 'selected';}?>>4 - Good</option>
                            							<option value="3" <?php if($rev_rating=='3'){ echo 'selected';}?>>3 - Fair</option>
                            							<option value="2" <?php if($rev_rating=='2'){ echo 'selected';}?>>2 - Poor</option>
                            							<option value="1" <?php if($rev_rating=='1'){ echo 'selected';}?>>1 - Awful</option>
                            						</select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" class="red">*</td>
                      <td align="left" valign="top" class="text10_bold">Details</td>
                      <td class="main"><textarea name="rev_details" id="rev_details" cols="47" rows="10" class="textfield"><?php echo stripslashes($rev_details)?></textarea></td>
                    </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="hidden" name="id" id="id" value="<?php echo $id?>">
                      <input type="hidden" name="rec_id" id="rec_id" value="<?php echo $rec_id?>"></td>
                    <td><input name="Submit" type="submit" class="buttons" value="Modify"></td>
                  </tr>
				  </form>
                </table></td>
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
