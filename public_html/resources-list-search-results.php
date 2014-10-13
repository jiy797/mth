<?php
require "./includes/application_top.php";

$b_page='RESOURCE LIST SEARCH';

$rsid = checkInput($_GET['rsid']);
$opfr = checkInput($_GET['opfr']);
$opto = checkInput($_GET['opto']);

$page_contents = getPageContents("16");

if($opfr==''||$opto==''){
	$_SESSION['sess_msg']="PLEASE SELECT BOTH THE OPTIONS";
	header("Location: resources-list1.php?rsid=$rsid");
	exit();	
}

	$start=0;
	if(isset($_GET['start'])){	$start=$_GET['start'];}
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
	$sql_ra=" from yp_tablea inner join yp_tableb on yp_tablea.pid=yp_tableb.pid where yp_tablea.country='$opfr' and yp_tableb.country='$opto' ";

	$sql1="select count(*) ".$sql_ra;
	$sql_ra.= " order by yp_tablea.rec_id";
	$sql_ra.= " limit $start, $pagesize";

	$sql_ra= $columns.$sql_ra;
	$res_ra= executeQuery($sql_ra);

	$reccnt = getSingleResult($sql1);	

	//echo"<br>sql_ra : $sql_ra<br>";

	//$sql_ra="select * from yp_tabled where bid='$opto'";
	//$res_ra=executeQuery($sql_ra);

	$divclass=="box2";
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
                       <div class="breadcrumbs"><a href="index.php">Home</a> > <a href="resources-list1.php?rsid=<?php echo $rsid?>">Resources</a> > <?php echo stripslashes($page_contents[0])?></div>
                       <h1><?php echo stripslashes($page_contents[0])?></h1>

                        <p><?php echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?></p>

                        <?php include('i_ads_728.php'); ?>
                        <br/>


                        <div style="border-top:1px solid #dbdbdb; padding-top:10px; margin-top:10px;"><!--  --></div>
						
						<?php if(mysql_num_rows($res_ra)){?>
						
						<?php while($line_ra=mysql_fetch_array($res_ra)){
								$pagecounter+=l;
								if($divclass=="box2"){
									$divclass="box1";
								}else{
									$divclass="box2";
								}

								$pid = $line_ra['pid'];

								$sql_pd="select * from yp_provider where rec_id='$pid'";
								$res_pd=executeQuery($sql_pd);

								if($line_pd=mysql_fetch_array($res_pd)){
									$pr_rec_name	= $line_pd['rec_name'];
									$pr_rec_desc	= $line_pd['rec_desc'];
									$pr_rec_img		= $line_pd['rec_img'];
									$pr_rec_url		= $line_pd['rec_url'];
									$pr_rec_ori_url	= $line_pd['rec_ori_url'];
								}	

						?>

						<div class="<?php echo $divclass?>">
							<table cellpadding="0" cellspacing="0" class="entry" width="100%">
							  <tr>
								<td width="144"><a href="provider-details.php?pid=<?php echo $pid?>"><?php if($pr_rec_img!=''){?><img src="./uploadedfiles/real/<?php echo $pr_rec_img?>" alt="" border="0" /><?php }else{?><img src="images/proNoImage.jpg" border="0" /><?php }?></a></td>
								<td>
									<div class="fl"><a href="provider-details.php?pid=<?php echo $pid?>"><?php echo stripslashes($pr_rec_name)?></a><br/>
									<?php echo stripslashes(substr($pr_rec_desc,0,95))?>...<br/>

									<?php if($pr_rec_url!=''&&$pr_rec_ori_url!=''){?>
									<div class="linky"><a href="http://<?php echo $pr_rec_ori_url?>" target="_blank"><?php echo $pr_rec_url?></a></div>
									<?php }?>
									</div>
									<div class="fr" align="right">
									<?php $avg_rating = averageRating($pid); ?>
									<?php for($ictr=0;$ictr<$avg_rating;$ictr++){?>
									<img src="images/star.png" width="12" height="11" alt="" />
									<?php }?>
									<br/><div class="smaller"><a href="provider-details.php?pid=<?php echo $pid?>&ptyp=ovew">Overview</a><br/><a href="provider-details.php?pid=<?php echo $pid?>&ptyp=faq">FAQ</a><br/><a href="provider-details.php?pid=<?php echo $pid?>&ptyp=rev">Read Reviews</a></div></div>
									<div class="clear"></div>
								</td>
							  </tr>
							</table>
						</div>
						<?php } //while ends?>

							<?php if($reccnt>10){?>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" class="main"><?php include "./includes/rev_paging_next.inc.php";?></td>
								</tr>
							</table>
							<?php }?>

						<?php }else{ ?>

							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
							<tr>
								<td height="20"  align="center" class="red"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
								  <tr>
									<td align="center"><b>NO RESULTS AVAILABLE</b></td>
								  </tr>
								</table></td>
							</tr>
							</table>


						<?php } //if ends?>


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