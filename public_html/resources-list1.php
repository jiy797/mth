<?php
	require "./includes/application_top.php";

	$rsid = checkInput($_GET['rsid']);

	if($rsid!=""){
		$sql="select * from yp_resource_main where rec_id='$rsid'";
		$result=executeQuery($sql);

		if($line=mysql_fetch_array($result)){
			$rec_name		= $line['rec_name'];
			$rec_desc		= $line['rec_desc'];
			$rec_img		= $line['rec_img'];
			$meta_title		= $line['meta_title'];
			$meta_keywords	= $line['meta_keywords'];
			$meta_desc		= $line['meta_desc'];
		}	
	}
	
	$b_page='RESOURCE LIST';
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
                       <div class="breadcrumbs"><a href="index.php">Home</a> > <a href="resources.php">Resources</a> > <?php echo stripslashes($rec_name)?></div>
                       <h1>Resources</h1>
                        <div class="fl" style="width:150px; padding-right:15px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center"><img src="./uploadedfiles/real/<?php echo $rec_img?>" border="0"></td>
                          </tr>
                          <tr>
                            <td align="center"><?php echo stripslashes($rec_name)?></a></td>
                          </tr>
                        </table>
                        </div>
                        <div class="fl" style="width:550px;">
                       <p><?php echo wordwrap(stripslashes($rec_desc), 50, "\n", 1)?></p>
                        </div>
                        <div class="clear"></div>
                        <br/>
						
						<?php if($_SESSION['sess_msg']!=''){?>
						<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
						<tr>
							<td height="20"  align="center" class="red"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
                              <tr>
                                <td align="center"><b><?php echo $_SESSION['sess_msg']?><?php unset($_SESSION['sess_msg']);?></b></td>
                              </tr>
                            </table></td>
						</tr>
						</table><br/>
						<?php }?>

						<?php if($rsid==2){?>

                        <div style="border-top:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb; padding-bottom:10px; padding-top:10px;">
                        <table cellpadding="0" cellspacing="5" align="center">
						<form name="se_form" action="resources-list-search-results.php" method="get">
						<?php
							$sql_opfr="select * from yp_country order by country";
							$res_opfr=executeQuery($sql_opfr);
						?>
                          <tr>
                            <td><img src="images/tfr.jpg" width="22" height="26" alt="" /></td>
                            <td class="green"><strong>Transfer From: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opfr" id="opfr" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opfr=mysql_fetch_array($res_opfr)){
							 ?>
							<option value="<?php echo $lin_opfr['country']?>"><?php echo stripslashes($lin_opfr['country'])?></option>
							 <?php }?>
							</select></td>
                          </tr>

						  <?php
							$sql_opto="select * from yp_country order by country";
							$res_opto=executeQuery($sql_opto);
						 ?>
                          <tr>
                            <td><img src="images/tft.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Transfer To: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opto" id="opto" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['country']?>"><?php echo stripslashes($lin_opto['country'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">
								<input name="rsid" id="rsid" type="hidden" value="<?php echo $rsid?>">
								<input type="image" name="imageField" src="images/submit.gif" />
							</td>
                          </tr>
						  </form>
                        </table>
                        </div>

						<?php }?>

						<?php if($rsid==3){?>

                        <div style="border-top:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb; padding-bottom:10px; padding-top:10px;">
                        <table cellpadding="0" cellspacing="5" align="center">
						<form name="se_form" action="resources-list-search-sendbank.php" method="get">
						  <?php
							$sql_opto="select * from yp_banks where status='Active' group by bank_name";
							$res_opto=executeQuery($sql_opto);
						  ?>
                          <tr>
                            <td><img src="images/tft.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Sender's Bank: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opto" id="opto" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['rec_id']?>"><?php echo stripslashes($lin_opto['bank_name'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">
								<input name="rsid" id="rsid" type="hidden" value="<?php echo $rsid?>">
								<input type="image" name="imageField" src="images/submit.gif" />
							</td>
                          </tr>
						  </form>
                        </table>
                        </div>

						<?php }?>

						<?php if($rsid==4){?>

                        <div style="border-top:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb; padding-bottom:10px; padding-top:10px;">
                        <table cellpadding="0" cellspacing="5" align="center">
						<form name="se_form" action="resources-list-search-recibank.php" method="get">
						  <?php
							$sql_opto="select * from yp_banks where status='Active' group by bank_name";
							$res_opto=executeQuery($sql_opto);
						  ?>
                          <tr>
                            <td><img src="images/tfr.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Receiver's Bank: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opto" id="opto" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['rec_id']?>"><?php echo stripslashes($lin_opto['bank_name'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">
								<input name="rsid" id="rsid" type="hidden" value="<?php echo $rsid?>">
								<input type="image" name="imageField" src="images/submit.gif" />
							</td>
                          </tr>
						  </form>
                        </table>
                        </div>

						<?php }?>


						<?php if($rsid==5){?>

                        <div style="border-top:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb; padding-bottom:10px; padding-top:10px;">
                        <table cellpadding="0" cellspacing="5" align="center">
						<form name="se_form" action="resources-list-search-branch.php" method="post">
						<?php
							$sql_opfr="select * from yp_country order by country";
							$res_opfr=executeQuery($sql_opfr);
						?>
                          <tr>
                            <td><img src="images/tfr.jpg" width="22" height="26" alt="" /></td>
                            <td class="green"><strong>Country: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opfr" id="opfr" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opfr=mysql_fetch_array($res_opfr)){
							 ?>
							<option value="<?php echo $lin_opfr['country']?>"><?php echo stripslashes($lin_opfr['country'])?></option>
							 <?php }?>
							</select></td>
                          </tr>

						  <?php
							$sql_opto="select * from yp_banks where status='Active' group by bank_name";
							$res_opto=executeQuery($sql_opto);
						 ?>
                          <tr>
                            <td><img src="images/tft.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Bank Name: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opto" id="opto" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['bank_id']?>"><?php echo stripslashes($lin_opto['bank_name'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">
								<input name="rsid" id="rsid" type="hidden" value="<?php echo $rsid?>">
								<input type="image" name="imageField" src="images/submit.gif" />
							</td>
                          </tr>
						  </form>
                        </table>
                        </div>

						<?php }?>


						<?php if($rsid==6){?>

                         <div style="border-top:1px solid #dbdbdb; border-bottom:1px solid #dbdbdb; padding-bottom:10px; padding-top:10px;">
                        <table cellpadding="0" cellspacing="5" align="center">
						<form name="se_form" action="resources-list-search-bothbank.php" method="get">
						  <?php
							$sql_opto="select * from yp_banks where status='Active' group by bank_name";
							$res_opto=executeQuery($sql_opto);
						  ?>
                          <tr>
                            <td><img src="images/tft.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Sender's Bank: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opfr" id="opfr" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['rec_id']?>"><?php echo stripslashes($lin_opto['bank_name'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
						  <?php
							$sql_opto="select * from yp_banks where status='Active' group by bank_name";
							$res_opto=executeQuery($sql_opto);
						  ?>
                          <tr>
                            <td><img src="images/tfr.jpg" width="23" height="26" alt="" /></td>
                            <td class="green"><strong>Receiver's Bank: </strong></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
							<select name="opto" id="opto" style="width:200px;">
							<option value="">Choose...</option>
							 <?php 
								while($lin_opto=mysql_fetch_array($res_opto)){
							 ?>
							<option value="<?php echo $lin_opto['rec_id']?>"><?php echo stripslashes($lin_opto['bank_name'])?></option>
							 <?php }?>
							</select>
							</td>
                          </tr>
                          <tr>
                            <td colspan="4" align="right">
								<input name="rsid" id="rsid" type="hidden" value="<?php echo $rsid?>">
								<input type="image" name="imageField" src="images/submit.gif" />
							</td>
                          </tr>
						  </form>
                        </table>
                        </div>
						<?php }?>

                        <br/>
                        <?php include('i_ads_728.php'); ?>
                        <br/>


                       <br/>



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