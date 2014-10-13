<?php
	require "./includes/application_top.php";

	$mid = $_GET['mid'];

	if($mid!=""){
		$sql_mtbd="select * from yp_mtb where rec_id='$mid'";
		$res_mtbd=executeQuery($sql_mtbd);

		if($line_mtbd=mysql_fetch_array($res_mtbd)){
			$rec_name		= $line_mtbd['rec_name'];
			$rec_date		= $line_mtbd['rec_date'];
			$rec_desc		= $line_mtbd['rec_desc'];
			$rec_pdf		= $line_mtbd['rec_pdf'];
			$meta_title		= $line_mtbd['meta_title'];
			$meta_keywords	= $line_mtbd['meta_keywords'];
			$meta_desc		= $line_mtbd['meta_desc'];
		}	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?php echo stripslashes($site_title)?> : <?php echo stripslashes($meta_title)?></title>
	<meta name="description" content="<?php echo stripslashes($meta_desc)?>" />
	<meta name="keywords" content="<?php echo stripslashes($meta_keywords)?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<meta name="author" content="<?php echo stripslashes($site_meta_author)?>" />
	<meta name="copyright" content="<?php echo stripslashes($site_meta_copyright)?>"/>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/update.css" rel="stylesheet" type="text/css" />
	<?php include("i_javascripts.php"); ?>

</head>
<body>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="94%" align="left" valign="middle"><img src="images/logo.png" width="256" height="79" /></td>
    <td width="6%" align="right" valign="middle"><input name="print" type="button" class="buttons" onclick="javaScript: this.style.visibility='hidden'; return printWindow();" value="Print" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000000"><img src="images/x.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><h1 style="margin-bottom:0px; padding:0px;"><?php echo stripslashes($rec_name)?></h1></td>
  </tr>
  <tr>
    <td colspan="2"><div class="date"><?php echo getFullDate($rec_date,'l, M d, Y')?></div></td>
  </tr>
  <tr>
    <td colspan="2"><p><?php echo wordwrap(stripslashes($rec_desc), 50, "\n", 1)?></p></td>
  </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#000000"><img src="images/x.gif" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" height="25"><b>Article URL : </b><?php echo $non_secure_path?>mtb_details.php?mid=<?php echo $mid?></td>
  </tr>
  <tr>
    <td colspan="2" height="25"><b>Site URL : </b><?php echo $non_secure_path?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>

</table>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function printWindow(){
	window.print();
	}
//-->
</SCRIPT>

</body>
</html>