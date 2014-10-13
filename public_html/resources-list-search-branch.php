<?php
	require "./includes/application_top.php";

	$b_page='RESOURCE LIST SEARCH';

	$rsid = checkInput($_POST['rsid']);
	$opfr = checkInput($_POST['opfr']);
	$opto = checkInput($_POST['opto']);

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
	$sql_ra=" from yp_banks where bank_id='$opto' and branch_country='$opfr' ";

	$sql1="select count(*) ".$sql_ra;
	$sql_ra.= " order by rec_id";
	$sql_ra.= " limit $start, $pagesize";

	$sql_ra= $columns.$sql_ra;
	$res_ra= executeQuery($sql_ra);

	$reccnt = getSingleResult($sql1);	

	//$sql_ra="select * from yp_banks where bank_id='$opto' and branch_country='$opfr'";
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
						
						<div class="eentry">
						<?php if(mysql_num_rows($res_ra)>0){?>
							
							<table width="100%" border="0" cellspacing="2" cellpadding="2">
								<tr>
								  <td width="15%"><strong>Bank ID</strong> </td>
								  <td width="35%"><strong>Bank Name </strong></td>
								  <td width="50%"><strong>Branch Details</strong> </td>
								</tr>
							</table>
						<?php while($lin_sa=mysql_fetch_array($res_ra)){
								$pagecounter+=l;
								if($divclass=="box2"){
									$divclass="box1";
								}else{
									$divclass="box2";
								}
						?>
							<div class="<?php echo $divclass?>">	
							<table width="100%" border="0" cellspacing="2" cellpadding="2">
                            <tr>
                              <td width="15%" valign="top"><?php echo stripslashes($lin_sa['bank_id'])?></td>
                              <td width="35%" valign="top"><?php echo stripslashes($lin_sa['bank_name'])?></td>
                              <td width="50%" valign="top">
									<?php echo stripslashes($lin_sa['branch_id'])?><br />
									<?php echo stripslashes($lin_sa['branch_address'])?><br />
									<?php echo stripslashes($lin_sa['branch_city'])?><br />
									<?php echo stripslashes($lin_sa['branch_state'])?><br />
									<?php echo stripslashes($lin_sa['branch_country'])?>
							  </td>
                            </tr>
							</table>
							</div>
                          
						<?php }//while ends?>

							<?php if($reccnt>10){?>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" class="main"><?php include "./includes/rev_paging_next.inc.php";?></td>
								</tr>
							</table>
							<?php }?>
							
						<?php }else{?>
							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#e4e4e4">
							<tr>
								<td height="20"  align="center" class="red"><table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
								  <tr>
									<td align="center"><b>NO RESULTS AVAILABLE</b></td>
								  </tr>
								</table></td>
							</tr>
							</table>

						<?php }//if ends?>
						</div>


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