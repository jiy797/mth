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

$id    = $_GET['id'];
$rec_id= $_GET['rec_id'];
$start = $_GET['start'];

$lname=getSingleResult("select rec_name from yp_news where rec_id='$id'");

$sql="select * from yp_news_comment where rec_id='$rec_id'";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$rec_name = $line['rec_name'];
	$rec_desc = $line['rec_desc'];
}

?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body>
<table id="maintable" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
           <td colspan="2"  class="topper">
			<table cellspacing="0" border="0" cellpadding="0" width="100%">
			    <tr>
					<td><?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>        </td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="400" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
             <TR>
				<TD width="85%"><span class="para_heading">Manage News : <?php echo stripslashes($lname)?> -> Comment Details</span></TD>
	            <TD width="15%" align="right"><a href="news_comment_list.php?id=<?php echo $id?>" class="menu">[ BACK ] &nbsp;</a></TD>
             </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
		
            <table width="98%" border="0" cellpadding="0" cellspacing="1" class="darkBG" >
            <tr>
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
				  <form action="news_comment_submit.php" method="post" enctype="multipart/form-data" name="comment_submit" id="comment_submit">
                    <tr>
                      <td align="right" class="red">&nbsp;</td>
                      <td align="left" valign="top" class="red">(* required) </td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="4%" align="right" class="red">*</td>
                      <td width="14%" align="left" valign="top" class="contentBold">Name</td>
                      <td width="82%" valign="top"><input name="rec_name" id="rec_name" value="<?php echo stripslashes($rec_name)?>" class="textfield" type="text" size="50" /></td>
                    </tr>
                    <tr>
                      <td width="4%" align="right" valign="top" class="red">*</td>
                      <td width="14%" align="left" valign="top" class="contentBold">Comment</td>
                      <td width="82%" valign="top"><textarea name="rec_desc" id="rec_desc" cols="47" rows="10" class="textfield"><?php echo stripslashes($rec_desc)?></textarea></td>
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
            <br></td>
      </tr>
	  </table>
      <tr>
		<td><?php  include "admin_footer.inc.php" ; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
