<?php
	require "./includes/application_top.php";
	$page_contents = getPageContents("3");

	$arr_ids = $_POST['cids'];
	$ctr_ids = count($arr_ids);

	if($ctr_ids==0){
		$sess_msg="PLEASE SELECT AT LEAST TWO PROVIDERS TO COMPARE SERVICES";
		$_SESSION['sess_msg']=$sess_msg;
		header("Location: compare.php");
		exit();	
	}

	if($ctr_ids>4){
		$sess_msg="YOU CAN ONLY SELECT UPTO FOUR PROVIDERS TO COMPARE SERVICES";
		$_SESSION['sess_msg']=$sess_msg;
		header("Location: compare.php");
		exit();	
	}

	$pro1="";
	$pro2="";
	$pro3="";
	$pro4="";

	if($arr_ids[0]!=''){ $pro1=$arr_ids[0]; }
	if($arr_ids[1]!=''){ $pro2=$arr_ids[1]; }
	if($arr_ids[2]!=''){ $pro3=$arr_ids[2]; }
	if($arr_ids[3]!=''){ $pro4=$arr_ids[3]; }

	$b_page='COMPARE SELECTED';

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

                       <p><?php// echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?></p>

                       <table cellspacing="1" cellpadding="0" border="0">
                         <tr class="orangerow">
                           <td class="cell0 bolded">
                                 <img src="images/blank.gif" width="134" height="1" alt="" /><br/>
&nbsp;                           </td>
						   <?php if($pro1!=''){
									$sql_fpro="select * from yp_provider where rec_id='$pro1'";
									$res_fpro=executeQuery($sql_fpro);

									while($lin_fpro=mysql_fetch_array($res_fpro)){
									
							?>
                           <td class="cell0">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" height="220">
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php if($lin_fpro['rec_img']!=''){?><img src="./uploadedfiles/real/<?php echo $lin_fpro['rec_img']?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a>
	                                <a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/><?php echo stripslashes(substr($lin_fpro['rec_desc'],0,100))?>...
									<br/>
									<img src="images/blank.gif" width="1" height="8" alt="" />									</td>
								</tr>
								<tr>
									<td>
									<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
									<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
									<img src="images/star.png" width="12" height="11" alt="" />
									<?php }?>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=ovew">Overview</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=faq">FAQ</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=rev">Read Reviews</a>									</td>
								</tr>
								</table>                           </td>
									<?php }?>
						   <?php }?>

						   <?php if($pro2!=''){
									$sql_fpro="select * from yp_provider where rec_id='$pro2'";
									$res_fpro=executeQuery($sql_fpro);

									while($lin_fpro=mysql_fetch_array($res_fpro)){
									
							?>
                           <td class="cell0">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" height="220">
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php if($lin_fpro['rec_img']!=''){?><img src="./uploadedfiles/real/<?php echo $lin_fpro['rec_img']?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a>
	                                <a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/><?php echo stripslashes(substr($lin_fpro['rec_desc'],0,100))?>...
									<br/>
									<img src="images/blank.gif" width="1" height="8" alt="" />									</td>
								</tr>
								<tr>
									<td>
									<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
									<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
									<img src="images/star.png" width="12" height="11" alt="" />
									<?php }?>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=ovew">Overview</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=faq">FAQ</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=rev">Read Reviews</a>									</td>
								</tr>
								</table>                           </td>
									<?php }?>
						   <?php }?>


						   <?php if($pro3!=''){
									$sql_fpro="select * from yp_provider where rec_id='$pro3'";
									$res_fpro=executeQuery($sql_fpro);

									while($lin_fpro=mysql_fetch_array($res_fpro)){
									
							?>
                           <td class="cell0">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" height="220">
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php if($lin_fpro['rec_img']!=''){?><img src="./uploadedfiles/real/<?php echo $lin_fpro['rec_img']?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a>
	                                <a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/><?php echo stripslashes(substr($lin_fpro['rec_desc'],0,100))?>...
									<br/>
									<img src="images/blank.gif" width="1" height="8" alt="" />									</td>
								</tr>
								<tr>
									<td>
									<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
									<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
									<img src="images/star.png" width="12" height="11" alt="" />
									<?php }?>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=ovew">Overview</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=faq">FAQ</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=rev">Read Reviews</a>									</td>
								</tr>
								</table>                           </td>
									<?php }?>
						   <?php }?>


						   <?php if($pro4!=''){
									$sql_fpro="select * from yp_provider where rec_id='$pro4'";
									$res_fpro=executeQuery($sql_fpro);

									while($lin_fpro=mysql_fetch_array($res_fpro)){
									
							?>
                           <td class="cell0">
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" height="220">
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php if($lin_fpro['rec_img']!=''){?><img src="./uploadedfiles/real/<?php echo $lin_fpro['rec_img']?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a>
	                                <a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>"><?php echo stripslashes($lin_fpro['rec_name'])?></a><br/><?php echo stripslashes(substr($lin_fpro['rec_desc'],0,100))?>...
									<br/>
									<img src="images/blank.gif" width="1" height="8" alt="" />									</td>
								</tr>
								<tr>
									<td>
									<?php $avg_rating = averageRating($lin_fpro['rec_id']); ?>
									<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
									<img src="images/star.png" width="12" height="11" alt="" />
									<?php }?>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=ovew">Overview</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=faq">FAQ</a>
									<br/>
									<a href="provider-details.php?pid=<?php echo $lin_fpro['rec_id']?>&ptyp=rev">Read Reviews</a>									</td>
								</tr>
								</table>                           </td>
									<?php }?>
						   <?php }?>
                         </tr>

						 <?php
							$sql_cc="select * from yp_compare_category where status='Active'";
							$res_cc=executeQuery($sql_cc);
							
							while($line_cc=mysql_fetch_array($res_cc)){
	  					 ?>

                         <tr>
                            <td class="cell1 bolded">
                                <img src="images/blank.gif" width="134" height="1" alt="" /><br/>
                                 <?php echo stripslashes($line_cc['cat_name'])?>                            </td>
							
							<?php if($pro1!=''){
									$sql_cval="select rec_desc from yp_provider_compare where pro_id='$pro1' and com_id='".$line_cc['cat_id']."'";
									$res_cval=getSingleResult($sql_cval);
							?>
                            <td class="cell1">
                                 <?php if($res_cval!=''){?><?php echo stripslashes($res_cval)?><?php }else{?>Data unavailable<?php }?>                            </td>
							<?php }?>

							<?php if($pro2!=''){
									$sql_cval="select rec_desc from yp_provider_compare where pro_id='$pro2' and com_id='".$line_cc['cat_id']."'";
									$res_cval=getSingleResult($sql_cval);
							?>
                            <td class="cell1">
                                 <?php if($res_cval!=''){?><?php echo stripslashes($res_cval)?><?php }else{?>Data unavailable<?php }?>                            </td>
							<?php }?>

							<?php if($pro3!=''){
									$sql_cval="select rec_desc from yp_provider_compare where pro_id='$pro3' and com_id='".$line_cc['cat_id']."'";
									$res_cval=getSingleResult($sql_cval);
							?>
                            <td class="cell1">
                                 <?php if($res_cval!=''){?><?php echo stripslashes($res_cval)?><?php }else{?>Data unavailable<?php }?>                            </td>
							<?php }?>

							<?php if($pro4!=''){
									$sql_cval="select rec_desc from yp_provider_compare where pro_id='$pro4' and com_id='".$line_cc['cat_id']."'";
									$res_cval=getSingleResult($sql_cval);
							?>
                            <td class="cell1">
                                 <?php if($res_cval!=''){?><?php echo stripslashes($res_cval)?><?php }else{?>Data unavailable<?php }?>                            </td>
							<?php }?>
                         </tr>
						<?php }?>
                       </table>
                        <img src="images/blank.gif" width="1" height="8" alt="" /><br/>                    </td>
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