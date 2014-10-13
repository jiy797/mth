<?php
	require "./includes/application_top.php";
	$page_contents = getPageContents("9");
	$mp_index='HOME';
	$mp='HOME';
	$b_page='INDEX';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<!Google Adsense tracking >
<script type="text/javascript">
window.google_analytics_uacct = "UA-539505-2";
</script>

<title><?php echo stripslashes($site_title)?> : <?php echo stripslashes($page_contents[2])?></title>
<meta name="description" content="<?php echo stripslashes($page_contents[4])?>" />
<meta name="keywords" content="<?php echo stripslashes($page_contents[3])?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="<?php echo stripslashes($site_meta_author)?>" />
<meta name="copyright" content="<?php echo stripslashes($site_meta_copyright)?>"/>

<link rel="shortcut icon" href="/favicon.ico" >
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
           <?php $leftside="home"; include('i_leftside.php'); ?>
          </div>
          <div class="rightside fl">
                <img src="images/blank.gif" width="1" height="12" alt="" /><br/>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td valign="top" width="451">
                        <div><img src="images/box2_01.jpg" width="451" height="6" alt="" /></div>
                        <div class="box2body" style="padding-top:3px;">
                            <div class="title">
                              <div style="padding-left:10px; padding-right:10px;">
                                <img src="images/blank.gif" width="1" height="120" alt="" /><br/>
                                <?php echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?>                              </div>
                            </div>
                        </div>
                        <div style="padding-bottom:10px;"><img src="images/box2_03.jpg" width="451" height="5" alt="" /></div>

						<?php include('i_featured_providers.php'); ?>

                        <br style="line-height:6px;"/>
						
						<?php include('i_popular_articles.php'); ?>                    </td>
                    <td width="15"><img src="images/blank.gif" width="15" height="1" alt="" /></td>
                    <td valign="top">
                         <?php include('i_ads_index1.php'); ?>
						
						  <br style="line-height:10px;" />
						
						  <?php include('i_news.php'); ?>

						  <br style="line-height:10px;" />

                          <?php include('i_ads_index2.php'); ?>
						  
						  </td>
                  </tr>
				  <tr>
                    <td colspan="3" valign="top">&nbsp;</td>
                  </tr>
				  <tr>
                    <td colspan="3" valign="top"> <?php include('i_ads_728.php'); ?></td>
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