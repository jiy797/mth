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


$category_id = $_GET['cid'];

$sql="select * from yp_links_category where category_id='$category_id'";
$result=executeQuery($sql);

if($line=mysql_fetch_array($result)){
	$cat_name			= $line['category_name'];
	$cat_desc			= $line['category_desc'];
}

?>

<html>
<head>
<title><?php echo $site_title;?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><?php  include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php  include "admin_left_bar.inc.php" ; ?>          </td>
          <td width="75%" height="400" align="center" valign="top">
<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Links Category : <?php if($_GET['cid']!=''){echo "Edit";}else{echo "Add";}?> </span></TD>
            <TD width="15%" align="right"><a href="links_category_list.php" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <form method="post" action="links_category.php" enctype="multipart/form-data">
              <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG">
                
                <tr>
                  <td><table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                      <td width="8%" class="mainBold">&nbsp;</td>
                      <td width="25%" class="red">(* required)</td>
                      <td class="red">&nbsp;</td>
                      </tr>
                    <tr>
                      <td align="right" class="red">*</td>
                      <td align="left" class="mainBold">Category Name</td>
                      <td width="67%"><input name="cat_name" type="text" class="textfield" id="cat_name" value="<?php echo stripslashes($cat_name)?>" size="30">                      </td>
                      </tr>
                    <tr>
                      <td align="right" class="mainBold">&nbsp;</td>
                      <td align="left" class="mainBold">Category Description</td>
                      <td><textarea name="cat_desc" cols="60" class="textfield" id="cat_desc"><?php echo stripslashes($cat_desc); ?></textarea></td>
                      </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td align="right">
                        <input name="start"	 type="hidden" id="start"  value="<?php echo $start?>">
                        <input name="cat_id" type="hidden" id="cat_id" value="<?php echo $category_id?>">						</td>
                      <td height="40"><input type="submit" name="Submit" value="Submit" class="buttons"></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
          </form><br>
		  </td>
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
