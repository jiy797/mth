<?php
	require "./includes/application_top.php";
	$page_contents = getPageContents("3");
	$mp='COMPARESERVICES';
	$b_page='COMPARE';
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
                    <td valign="top">
                       <div class="breadcrumbs"><a href="index.php">Home</a> > <?php echo stripslashes($page_contents[0])?></div>
                       <h1><?php echo stripslashes($page_contents[0])?></h1>

                       <p><?php echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?></p>

					   <?php if($_SESSION['sess_msg']!=''){?>
						<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
						<tr>
							<td height="20" align="center" class="red"><table width="70%" border="0" align="center" cellpadding="5" cellspacing="5">
                              <tr>
                                <td align="center"><b><?php echo $_SESSION['sess_msg']?><?php unset($_SESSION['sess_msg']);?></b></td>
                              </tr>
                            </table></td>
						</tr>
						</table><br/>
						
					    <?php }?>

                       <?php include('i_compare_providers.php'); ?>                    </td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top"><?php include('i_ads_728.php'); ?></td>
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