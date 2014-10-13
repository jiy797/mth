<?php
	require "./includes/application_top.php";

	if(isset($_GET['pid'])){
		$pid = checkInput($_GET['pid']);
	}

	if($pid!=""){
		$sql="select * from yp_provider where rec_id='$pid'";
		$result=executeQuery($sql);

		if($line=mysql_fetch_array($result)){
			$rec_name		= $line['rec_name'];
			$rec_desc		= $line['rec_desc'];
			$rec_img		= $line['rec_img'];
			$rec_url		= $line['rec_url'];
			$meta_title		= $line['meta_title'];
			$meta_keywords	= $line['meta_keywords'];
			$meta_desc		= $line['meta_desc'];
		}	
	}

	$b_page='PROVIDER DETAILS';
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


<SCRIPT LANGUAGE="JavaScript">
<!--
	function clearFields(){
		document.getElementById('rev_name').value	= '';
		document.getElementById('rev_email').value	= '';
		document.getElementById('rev_rating').value	= '0';
		document.getElementById('rev_details').value= '';
	}
//-->
</SCRIPT>

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
                    <td valign="top">
                       <div class="breadcrumbs"><a href="<?php echo $non_secure_path?>index.php">Home</a> > Provider Details</div>
                       <h1><?php echo stripslashes($rec_name)?></h1>

                       <div class="box1">
                                  <table cellpadding="0" cellspacing="0" class="entry" width="100%">
                                    <tr>
                                      <td width="144"><?php if($rec_img!=''){?><img src="<?php echo $non_secure_path?>uploadedfiles/real/<?php echo $rec_img?>" alt="" border="0" /><?php }else{?><img src="<?php echo $non_secure_path?>images/proNoImage.jpg" border="0" /><?php }?></td>
                                      <td>
                                          <div class="fl"><a href='#'><?php echo stripslashes($rec_name)?></a><br/><?php echo stripslashes($rec_desc)?><br/></div>
                                          <div class="fr" align="right">
										  
											<?php $avg_rating = averageRating($pid); ?>
											<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
												<img src="<?php echo $non_secure_path?>images/star.png" width="12" height="11" alt="" />
											<?php }?>
										  
										  <br/><div class="smaller">&nbsp;</div></div>
                                          <div class="clear"></div>
                                          <img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="8" alt="" /><br/>
                                          <div class="linky"><a href="http://<?php echo $rec_url?>" target="_blank"><?php echo stripslashes($rec_url)?></a></div>
                                      </td>
                                    </tr>
                                  </table>
                       </div>

                       <?php include('i_ads_728.php'); ?>

					   <?php if($_GET['ptyp']=='faq'){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('overview');show('faqs');hide('user-reviews');"
						//-->
						</SCRIPT>
						<?php }?>

						<?php if($_GET['ptyp']=='rev'){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('overview');hide('faqs');show('user-reviews');"
						//-->
						</SCRIPT>
						<?php }?>

						<?php if($_GET['ptyp']=='ovew'){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:show('overview');hide('faqs');hide('user-reviews');"
						//-->
						</SCRIPT>
						<?php }?>

						<?php if($_SESSION['sess_msg_review']=='PLEASE FILL ALL THE FIELDS.'){?>

						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('overview');hide('faqs');show('user-reviews');"
						//-->
						</SCRIPT>
						<?php }?>
						
						<?php if($_SESSION['sess_msg_review']=='THANKS FOR YOUR MESSAGE.'){?>
						<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
						<tr>
							<td height="20"  align="center" class="red"><table width="50%" border="0" align="center" cellpadding="5" cellspacing="5">
                              <tr>
                                <td><b>Thanks for your review. <br />
                                Your review will show up upon webmaster's approval. <br />
                                Thank you</b></td>
                              </tr>
                            </table></td>
						</tr>
						</table><br/>
						<?php unset($_SESSION['sess_msg_review']); ?>
						<SCRIPT LANGUAGE="JavaScript">
						<!--
							location.href="javascript:hide('overview');hide('faqs');show('user-reviews');"
						//-->
						</SCRIPT>
						<?php } ?>

                       <div id="overview" style="display:">
                             <table cellpadding="0" cellspacing="0" width="100%">
                               <tr>
                                 <td class="tabon"  width="110"><a href="javascript:show('overview');hide('faqs');hide('user-reviews');">Overview</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="taboff" width="110"><a href="javascript:hide('overview');show('faqs');hide('user-reviews');">Faqs</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="taboff" width="110"><a href="javascript:hide('overview');hide('faqs');show('user-reviews');">User Reviews</a></td>
                                 <td class="tabdiv"></td>
                               </tr>
                             </table>
							    <?php
									$sql_proview="select rec_desc from yp_provider_overview where pro_id='$pid'";
									$prov_view=getSingleResult($sql_proview);
								?>
                             <div class="tabbox">
								
								<?php if($prov_view!=''){?>
									<?php echo stripslashes($prov_view)?>
								<?php }else{?>
									<span class="red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coming Soon..... </span>
								<?php }?>
								
                             <br />
                             <br />
							
								<?php
									$sql_com="select * from yp_provider_compare where pro_id='$pid'";
									$res_com=executeQuery($sql_com);
								?>
							 <table cellspacing="1" cellpadding="0" border="0" width="100%">
								<?php while($lin_com=mysql_fetch_array($res_com)){
										$pagecounter+=1;
										$sql_cname="select cat_name from yp_compare_category where cat_id='".$lin_com['com_id']."'";
										$res_cname=getSingleResult($sql_cname);

								?>
                               <tr class="orangerow">
                                 <td class="cell11 bolded" width="120">
                                       <img src="<?php echo $non_secure_path?>images/blank.gif" width="134" height="1" alt="" /><br/>
                                       <?php echo stripslashes($res_cname)?>
                                 </td>
                                 <td class="cell11">
                                     <?php echo stripslashes($lin_com['rec_desc'])?>
                                 </td>
                               </tr>
								<?php }?>
							</table>
							 </div>
                         </div>
                         <div id="faqs" style="display:none;">
                             <table cellpadding="0" cellspacing="0" width="100%">
                               <tr>
                                 <td class="taboff"  width="110"><a href="javascript:show('overview');hide('faqs');hide('user-reviews');">Overview</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="tabon" width="110"><a href="javascript:hide('overview');show('faqs');hide('user-reviews');">Faqs</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="taboff" width="110"><a href="javascript:hide('overview');hide('faqs');show('user-reviews');">User Reviews</a></td>
                                 <td class="tabdiv"></td>
                               </tr>
                             </table>

							 <?php	
									$ptyp="";
									$start=0;
									if($_GET['ptyp']=='faq'){
										if(isset($_GET['start'])){	$start=$_GET['start'];}
									}
									$pagesize=10;
									$pagecounter=0;
									if(isset($_GET['pagesize']))
									{
										$pagesize=$_GET['pagesize'];
										$pagesize=intval($pagesize);
										if(intval($pagesize)==0)
										{	
											header("Location: ".$_SERVER['PHP_SELF']);
											exit;
										}
									}

									if($_SESSION['sess_order_by']==$order_by)
									{
										if($_SESSION['order_by2']=='asc')
										{
											$order_by2='desc';
										}
										else
										{
											$order_by2='asc';
										}
									}

									if($order_by2=='')
									{
										$order_by2='desc';
									}

									if($order_by=='')
									{
										$order_by='faq_cat_position';
									}

									$_SESSION['order_by2']=$order_by2;
									$_SESSION['sess_order_by']=$order_by;

									$columns="select * ";
									$sql_profaq=" from yp_provider_faq where pro_id='$pid' and status='Active'";

									$sql1="select count(*) ".$sql_profaq;
									$sql_profaq.= " order by faq_position";
									$sql_profaq.= " limit $start, $pagesize";

									$sql_profaq= $columns.$sql_profaq;
									$res_profaq= executeQuery($sql_profaq);

									$reccnt = getSingleResult($sql1);
									
									$ptyp="faq";

									//$sql_profaq="select * from yp_provider_faq where pro_id='$pid' and status='Active'";
									//$res_profaq=executeQuery($sql_profaq);
							 ?>
                             <div class="tabbox">
							   
							   <?php if(mysql_num_rows($res_profaq)){ $pagecounter+=1; ?>

								   <?php while($lin_profaq=mysql_fetch_array($res_profaq)){?>
									
								   <h4><?php echo stripslashes($lin_profaq['question']); ?></h4>
								   <p><?php echo stripslashes($lin_profaq['answer']); ?></p>

								   <div class="dividero"><!--  --></div>
					
								   <?php } //while ends?>

								   <?php include "./includes/prev_paging_next.inc.php";?>

							    <?php }else{ ?>
									<span class="red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coming Soon..... </span>
							    <?php } // if ends?>

                             </div>
                         </div>
                         <div id="user-reviews" style="display:none;">
                             <table cellpadding="0" cellspacing="0" width="100%">
                               <tr>
                                 <td class="taboff"  width="110"><a href="javascript:show('overview');hide('faqs');hide('user-reviews');">Overview</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="taboff" width="110"><a href="javascript:hide('overview');show('faqs');hide('user-reviews');">Faqs</a></td>
                                 <td class="tabdiv" width="1"></td>
                                 <td class="tabon" width="110"><a href="javascript:hide('overview');hide('faqs');show('user-reviews');">User Reviews</a></td>
                                 <td class="tabdiv"></td>
                               </tr>
                             </table>
							 <?php $pro_page_review = getPageContents("19");?>
                             <div class="tabbox">
                                 <p><?php echo wordwrap(stripslashes($pro_page_review[1]), 50, "\n", 1)?></p>

                                 <div class="box3">
											<form action="<?php echo $non_secure_path?>provider_review_submit.php" method="post" enctype="multipart/form-data" name="review_submit" id="review_submit">
                            				<table cellspacing="1" cellpadding="2" border="0">
											<?php if($_SESSION['sess_msg_review']=='PLEASE FILL ALL THE FIELDS.'){?>
											<tr>
												<td height="20" colspan="6" align="center" class="red"><?php echo $_SESSION['sess_msg_review']; unset($_SESSION['sess_msg_review']);?></td>
											</tr>
											<?php }?>
                            				<tr>
                            					<td align="left">Your Name:<span class="required">*</span>&nbsp;</td>
                            					<td align="left"><input name="rev_name" id="rev_name" value="<?php echo $_SESSION['rev_name']?>" class="input" type="text" style="width:120px;" /></td>
                            					<td align="right">Your E-Mail:<span class="required">*</span>&nbsp;</td>
                            					<td align="left"><input name="rev_email" id="rev_email" value="<?php echo $_SESSION['rev_email']?>" class="input" type="text" style="width:130px;" /></td>
                                                <td align="right">Product Rating:<span class="required">*</span>&nbsp;</td>
                            					<td align="left">
                            						<select name="rev_rating" id="rev_rating" class="input" style="width:160px;">
                            							<option value="0">Choose...</option>
                            							<option value="5" <?php if($_SESSION['rev_rating']=='5'){ echo 'selected';}?>>5 - Excellent</option>
                            							<option value="4" <?php if($_SESSION['rev_rating']=='4'){ echo 'selected';}?>>4 - Good</option>
                            							<option value="3" <?php if($_SESSION['rev_rating']=='3'){ echo 'selected';}?>>3 - Fair</option>
                            							<option value="2" <?php if($_SESSION['rev_rating']=='2'){ echo 'selected';}?>>2 - Poor</option>
                            							<option value="1" <?php if($_SESSION['rev_rating']=='1'){ echo 'selected';}?>>1 - Awful</option>
                            						</select>
                            					</td>
                            				</tr>
                            				</table>
                                            <br/>
                            				Enter your review below:<span class="required">*</span><br />
                            				<textarea name="rev_details" id="rev_details" cols="5" rows="5" class="input" style="width:682px;"><?php echo stripslashes($_SESSION['rev_details'])?></textarea><br />
											<input name="pid" id="pid" value="<?php echo $pid?>" type="hidden">
                            		<div class="form_buttons" align="right"><a href="#" onclick="javaScript: clearFields();" ><img src="<?php echo $non_secure_path?>images/clear.gif" /></a>&nbsp;&nbsp;<input type="image" src="<?php echo $non_secure_path?>images/submit.gif" name="submit" value="Submit" alt="Submit" /></div>
											</form>
                                  </div>
                                  <br/>


								 <?php	
										$ptyp="";
										$start=0;
										if($_GET['ptyp']=='rev'){
											if(isset($_GET['start'])){	$start=$_GET['start'];}
										}
										
										$pagesize=10;
										$pagecounter=0;
										if(isset($_GET['pagesize']))
										{
											$pagesize=$_GET['pagesize'];
											$pagesize=intval($pagesize);
											if(intval($pagesize)==0)
											{	
												header("Location: ".$_SERVER['PHP_SELF']);
												exit;
											}
										}

										if($_SESSION['sess_order_by']==$order_by)
										{
											if($_SESSION['order_by2']=='asc')
											{
												$order_by2='desc';
											}
											else
											{
												$order_by2='asc';
											}
										}

										if($order_by2=='')
										{
											$order_by2='desc';
										}

										if($order_by=='')
										{
											$order_by='rec_id';
										}

										$_SESSION['order_by2']=$order_by2;
										$_SESSION['sess_order_by']=$order_by;

										$columns="select * ";
										$sql_proRev=" from  yp_provider_review where pro_id='$pid' and status='Active'";

										$sql1="select count(*) ".$sql_proRev;
										$sql_proRev.= " order by rec_id";
										$sql_proRev.= " limit $start, $pagesize";

										$sql_proRev= $columns.$sql_proRev;
										$res_proRev= executeQuery($sql_proRev);

										$reccnt = getSingleResult($sql1);
										
										$ptyp="rev";

								 ?>

                                  <table cellspacing="1" cellpadding="0" border="0" width="100%">

								  <?php while($line_proRev=mysql_fetch_array($res_proRev)){ $pagecounter+=1; ?>

                                   <tr class="orangerow">
                                     <td class="cell11">
										<?php echo stripslashes($line_proRev['rev_details'])?>
										<br/>
                                        <div class="linky" align="right" style="padding-top:6px;">
                                        <div class="fl"><b>Posted by: <?php echo stripslashes($line_proRev['rev_name'])?> Post Date: <?php echo getFullDate($line_proRev['posttime'], 'm/d/y')?></b></div>
                                        <div class="fr">
										
										<?php for($ictr=0;$ictr<$line_proRev['rev_rating'];$ictr++){?>
											<img src="<?php echo $non_secure_path?>images/star.png" width="12" height="11" alt="" />
										<?php }?>
										
										</div>
                                        <div class="clear"></div>
                                        </div>
                                     </td>
                                   </tr>
                                  
								  <?php }?>

								   <tr>
                                     <td align="center">&nbsp;</td>
                                   </tr>
								   <tr>
                                     <td align="center"><?php include "./includes/prev_paging_next.inc.php";?></td>
                                   </tr>

                                   </table>

								   
                             </div>
                         </div>

                    </td>
                  </tr>
                </table>
          </div>
          <div class="clear"></div>

        <br/>
        <img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="18" alt="" /><br/>
        </div>
    </div>
</div>

<?php include('i_footer.php'); ?>

</body>
</html>