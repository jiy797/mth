<?php
	require "./includes/application_top.php";

	$lid = $_GET['lid'];

	if($lid!=""){
		$sql_lrnd="select * from yp_learning where rec_id='$lid'";
		$res_lrnd=executeQuery($sql_lrnd);

		if($line_lrnd=mysql_fetch_array($res_lrnd)){
			$rec_name		= $line_lrnd['rec_name'];
			$rec_date		= $line_lrnd['rec_date'];
			$rec_desc		= $line_lrnd['rec_desc'];
			$rec_pdf		= $line_lrnd['rec_pdf'];
			$meta_title		= $line_lrnd['meta_title'];
			$meta_keywords	= $line_lrnd['meta_keywords'];
			$meta_desc		= $line_lrnd['meta_desc'];
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
    <td width="94%" align="left" valign="liddle"><img src="images/logo.png" width="256" height="79" /></td>
    <td width="6%" align="right" valign="liddle"><input name="print" type="button" class="buttons" onclick="javaScript: this.style.visibility='hidden'; return printWindow();" value="Print" /></td>
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
    <td colspan="2" height="25"><b>Article URL : </b><?php echo $non_secure_path?>learning_details.php?lid=<?php echo $lid?></td>
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