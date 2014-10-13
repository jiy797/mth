<?php
	require "./includes/application_top.php";

	if(isset($_GET['nid'])){
		$nid = checkInput($_GET['nid']);
	}
	if($nid!=""){
		$sql_lrnd="select * from yp_news where rec_id='$nid'";
		$res_lrnd=executeQuery($sql_lrnd);

		if($line_lrnd=mysql_fetch_array($res_lrnd)){
			$rec_cat_id		= $line_lrnd['cat_id'];
			$rec_name		= $line_lrnd['rec_name'];
			$rec_date		= $line_lrnd['rec_date'];
			$rec_desc		= $line_lrnd['rec_desc'];
			$rec_pdf		= $line_lrnd['rec_pdf'];
			$meta_title		= $line_lrnd['meta_title'];
			$meta_keywords	= $line_lrnd['meta_keywords'];
			$meta_desc		= $line_lrnd['meta_desc'];
			$rec_view		= $line_lrnd['rec_view'];
		}	
	}
	$new_mv=$rec_view+1;
	$sql_mv="update yp_news set rec_view='$new_mv' where rec_id='$nid'";
	executeUpdate($sql_mv);

	$sql_cname="select cat_name from yp_news_category where cat_id='$rec_cat_id'";
	$lrcat_name=getSingleResult($sql_cname);
	
	$b_page='NEWS DETAILS';
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
	<link href="<?php echo $non_secure_path?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $non_secure_path?>css/update.css" rel="stylesheet" type="text/css" />
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
                <img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="12" alt="" /><br/>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td valign="top" width="451">
                       <div class="breadcrumbs"><a href="<?php echo $non_secure_path?>index.php">Home</a> > <a href="<?php echo $non_secure_path?>news.php">News</a>  > <a href="<?php echo $non_secure_path?>news-see-all.php?cid=<?php echo $rec_cat_id?>"><?php echo stripslashes($lrcat_name)?></a> > <?php echo stripslashes($rec_name)?></div>
						<?php if($_SESSION['sess_msg']!=''){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('postcomment');ajaxshow('#emailarticle');"
						//-->
						</SCRIPT>
						<?php }?>

						<?php if($_SESSION['sess_msg_comment']=='PLEASE FILL BOTH THE FIELDS.'){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('emailarticle');ajaxshow('#postcomment');"
						//-->
						</SCRIPT>
						<?php }?>
						
						<?php if($_SESSION['sess_msg_comment']=='THANKS FOR YOUR MESSAGE.'){?>
						<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
						<tr>
							<td height="20"  align="center" class="red"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
                              <tr>
                                <td><b>Thanks for your comment. <br />
                                Your comment will show up upon webmaster's approval. <br />
                                Thank you</b></td>
                              </tr>
                            </table></td>
						</tr>
						</table><br/>
						<?php unset($_SESSION['sess_msg_comment']); } ?>

                       <h1 style="margin-bottom:0px; padding:0px;"><?php echo stripslashes($rec_name)?></h1>
                       <div class="date"><?php echo getFullDate($rec_date,'l, M d, Y')?></div>

                       <p><?php echo wordwrap(stripslashes($rec_desc), 50, "\n", 1)?></p>


                       <br/>
					   <script type="text/javascript" src="http://w.sharethis.com/widget/?tabs=web%2Cpost%2Cemail&amp;charset=utf-8&amp;style=default&amp;publisher=06a40076-111c-4243-a7b1-ec65e361a5b3"></script>

                       <br/><br/>

                        <div style="background-color:#e6f2f5; padding:10px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><img src="<?php echo $non_secure_path?>images/emailarticle.jpg" width="19" height="19" alt="" /></td>
                                <td class="smaller1"><a href="javascript:hide('postcomment');ajaxshow('#emailarticle');">Email Article</a></td>
                                <td><img src="<?php echo $non_secure_path?>images/postcomment.jpg" width="19" height="24" alt="" /></td>
                                <td class="smaller1"><a href="javascript:hide('emailarticle');ajaxshow('#postcomment');">Read/Post Comment</a></td>
                                <td><img src="<?php echo $non_secure_path?>images/printerfriendly.jpg" width="19" height="23" alt="" /></td>
                                <td class="smaller1"><a href="#" onClick="window.open('<?php echo $non_secure_path?>news_details_print.php?nid=<?php echo $nid;?>','','scrollbars=yes,width=700,height=600')">Printer Friendly</a></td>
                                <td><?php if($rec_pdf!=''){?><img src="<?php echo $non_secure_path?>images/pdf.jpg" width="16" height="19" alt="" /><?php }?></td>
                                <td class="smaller1"><?php if($rec_pdf!=''){?><a href="<?php echo $non_secure_path?>uploadedfiles/pdf/<?php echo $rec_pdf?>" target="_blank">PDF Version</a><?php }?></td>
                              </tr>
                            </table>
                        </div>
                        <div style="background-color:#e6f2f5; padding:10px; display:none; padding:10px;" id="emailarticle">
                            <div style="background-color:#ffffff; padding:10px; color:#444444;">
                                <div class="fl"><p style="padding-bottom:3px; border-bottom:1px sonid #dbdbdb; font-weight:bold;">Email This Article</p></div>
                                <div class="fr"><a href="javascript:hide('postcomment');hide('emailarticle');"><img src="<?php echo $non_secure_path?>images/close.gif" width="15" height="15" alt="" /></a></div>
                                <div class="clear"></div>
                                 <p>Please enter the following:</p>
                                 <div align="center">
								       <table width="100%" border="0" cellspacing="1" cellpadding="1">
											<form action="<?php echo $non_secure_path?>news_friend_submit.php" method="post" enctype="multipart/form-data" name="send_msg" id="send_msg">
											<?php if($_SESSION['sess_msg']!=''){?>
											<tr>
											<td height="20" colspan="2" align="center" class="red"><?php echo $_SESSION['sess_msg']; unset($_SESSION['sess_msg']);?></td>
											</tr>
											<?php }?>
											<tr>
											  <td width="29%" height="20" align="left">Your Email Address</td>
											  <td width="71%" height="20" align="left"><input name="from_email" type="text" class="textfield" id="from_email" size="40" /></td>
											</tr>
											<tr>
											  <td height="20" align="left">Friend's Email Address</td>
											  <td height="20" align="left"><input name="to_email" type="text" class="textfield" id="to_email" size="40" /></td>
											</tr>
											<tr>
											  <td height="20" align="left" valign="top" class="big">Message</td>
											  <td height="20" align="left"><textarea name="message1" cols="37" rows="5" class="textfield"></textarea></td>
											</tr>
											<tr>
											  <td height="20"  class="main">&nbsp;</td>
											  <td height="20"  class="main"><input name="nid" type="hidden" value="<?php echo $nid;?>" />
												<input name="Submit2" type="submit" class="buttons" value="Send"></td>
											</tr>
											</form>
									</table>
								 </div>
                            </div>
                        </div>
                        <div style="background-color:#e6f2f5; padding:10px; display:none; padding:10px;" id="postcomment">
                            <div style="background-color:#ffffff; padding:10px; color:#444444;">
                                <div class="fl"><p style="padding-bottom:3px; border-bottom:1px sonid #dbdbdb; font-weight:bold;">Post a Comment</p> </div>
                                <div class="fr"><a href="javascript:hide('postcomment');hide('emailarticle');"><img src="<?php echo $non_secure_path?>images/close.gif" width="15" height="15" alt="" /></a></div>
                                <div class="clear"></div>
                                 <p>Please enter the following details:</p>

								 <table width="100%" border="0" cellspacing="1" cellpadding="1">
									<form action="<?php echo $non_secure_path?>news_comment_submit.php" method="post" enctype="multipart/form-data" name="send_comment" id="send_comment">
									<?php if($_SESSION['sess_msg_comment']=='PLEASE FILL BOTH THE FIELDS.'){?>
									<tr>
									<td height="20" colspan="2" align="center" class="red"><?php echo $_SESSION['sess_msg_comment']; unset($_SESSION['sess_msg_comment']);?></td>
									</tr>
									<?php }?>
									<tr>
									  <td width="29%" height="20" align="left">Name</td>
									  <td width="71%" height="20" align="left"><input name="rec_name" type="text" class="textfield" id="rec_name" size="40" /></td>
									</tr>
									<tr>
									  <td height="20" align="left" valign="top" class="big">Comment</td>
									  <td height="20" align="left"><textarea name="rec_desc" id="rec_desc" cols="30" rows="5" class="textfield"></textarea></td>
									</tr>
									<tr>
									  <td height="20"  class="main">&nbsp;</td>
									  <td height="20"  class="main"><input name="nid" type="hidden" value="<?php echo $nid;?>" />
										<input name="Submit2" type="submit" class="buttons" value="Send"></td>
									</tr>
									</form>
								 </table>
								 <?php
										$sql_precomm="select * from yp_news_comment where nid='$nid' and status='Active'";
										$res_precomm=executeQuery($sql_precomm);
								 ?>
                                 <br/>
                                 <p style="padding-bottom:3px; border-bottom:1px sonid #dbdbdb; font-weight:bold;">Read Comments</p>
                                 <div style="height:200px; overflow-y:scroll; overflow-x:hidden;">
								   <?php if(mysql_num_rows($res_precomm)){ ?>
								   <?php while($lin_precomm=mysql_fetch_array($res_precomm)){ ?>
                                   <p style="font-size:11px; line-height:16px;"><?php echo stripslashes($lin_precomm['rec_desc'])?></p><div class="linky">Posted by: <?php echo stripslashes($lin_precomm['rec_name'])?> Post Date: <?php echo getFullDate($lin_precomm['posttime'],'m/d/y')?></div>
                                   <p style="padding-bottom:3px; border-bottom:1px sonid #dbdbdb; font-weight:bold;"><!-- --></p>
								   <?php }?>
                                   <?php }else{?>
								   <span class="red">No Comments Posted Yet.<br/> Be the first one to post a comment.</span>
								   <?php }?>
                                 </div>
                                 <p style="padding-bottom:3px; padding-top:8px; border-bottom:1px sonid #dbdbdb; font-weight:bold;"><!-- --></p>

                            </div>
                        </div>
                       <br/>

                       <?php include('news_related.php'); ?>

                    </td>
                    <td width="15"><img src="<?php echo $non_secure_path?>images/blank.gif" width="15" height="1" alt="" /></td>
                    <td valign="top">
                        <?php include('i_ads.php'); ?>
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