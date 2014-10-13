<?php
	require "./includes/application_top.php";
	$page_contents = getPageContents("13");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title><?php echo stripslashes($site_title)?> : <?php echo stripslashes($page_contents[2])?></title>
<meta name="description" content="<?php echo stripslashes($page_contents[4])?>" />
<meta name="keywords" content="<?php echo stripslashes($page_contents[3])?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="<?php echo stripslashes($site_meta_author)?>" />
<meta name="copyright" content="<?php echo stripslashes($site_meta_copyright)?>"/>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/update.css" rel="stylesheet" type="text/css" />
<?php include("i_javascripts.php"); ?>

<!Google Analytics Tracking Code>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-539505-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<?php include('i_top.php'); ?>


<div class="containit">
    <div class="all-bg">
        <div class="pad">
          <div class="leftside fl">
            <?php $leftside="inside"; include('i_leftside.php'); ?>
          </div>
          <div class="rightside fl">
                <img src="images/blank.gif" width="1" height="12" alt="" /><br/>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td valign="top" width="451">
                       <div class="breadcrumbs"><a href="index.php">Home</a> > <?php echo stripslashes($page_contents[0])?></div>
                       <h1><?php echo stripslashes($page_contents[0])?></h1>
                       <p> <?php echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?> </p>

						<br />
						<table width="98%" border="0" cellpadding="2" cellspacing="2">
						  <form name="verify_frm" method="post" action="newsletter_verify.php">
							<?php if($_SESSION['sess_msg']!=''){?>
							<tr>
							  <td height="20" colspan="3" align="center" class="red"><?php echo $_SESSION['sess_msg']?><?php unset($_SESSION['sess_msg']); ?></td>
							</tr>
							<?php }?>
							
							<tr>
							  <td align="right">&nbsp;</td>
							  <td class="red">(* required)</td>
							  <td>&nbsp;</td>
							</tr>
							<tr>
							  <td width="4%" align="right" valign="top" class="red">*</td>
							  <td width="32%" align="left" valign="top" class="mainBold">Enter Your Email Address&nbsp; </td>
							  <td width="64%" valign="top"><input name="email" type="text" id="email" size="40" class="textfield" value="<?php echo $_SESSION['email']?>" /></td>
							</tr>
							
							<tr>
							  <td width="4%" align="right" valign="top" class="red">*</td>
							  <td width="32%" align="left" valign="top" class="mainBold">Verification Code&nbsp; </td>
							  <td width="64%" valign="top"><input name="veri_code" type="text" id="veri_code" size="40" class="textfield" value="<?php echo $_SESSION['veri_code']?>"/><br>Please input the Verfication Code received in Email from us</td>
							</tr>
							
							<tr align="center">
							  <td>&nbsp;</td>
							  <td height="7">&nbsp;</td>
							  <td height="7" align="left">&nbsp;</td>
							</tr>
							<tr align="center">
							  <td>&nbsp;</td>
							  <td height="7">&nbsp;</td>
							  <td height="7" align="left">&nbsp;<input type="image" name="imageField" src="images/submit.gif" /></td>
							</tr>
							<tr>
							  <td height="7" colspan="3" align="right"></td>
							</tr>
						  </form>
						</table>	
						<br />
				

                    </td>
                    <td width="15"><img src="images/blank.gif" width="15" height="1" alt="" /></td>
                    <td valign="top">
                        <?php include('i_ads.php'); ?>
                    </td>
                  </tr>
                </table>
          </div>
          <div class="clear"></div>

        <br/>
        <img src="images/blank.gif" width="1" height="18" alt="" /><br/>
        </div>
    </div>
</div>

<?php include('i_footer.php'); ?>

</body>
</html>