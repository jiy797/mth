<?php
	require "./includes/application_top.php";
	$page_contents = getPageContents("7");
	$b_page='LINKS';


	if(isset($_GET['link_cat_id'])){
		$link_cat_id = checkInput($_GET['link_cat_id']);
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
		$order_by='linkto';
	}

	$_SESSION['order_by2']=$order_by2;
	$_SESSION['sess_order_by']=$order_by;

	$columns=" select *, TRIM(LEADING 'www.' FROM link_ref) as linkto";

	$sql= " from yp_links where 1=1 and link_status='Active' ";

	if($link_cat_id!=''){
		$sql.= " and link_cat_id='".$link_cat_id."' ";
	}

	$sql1= "select count(*) ".$sql;
	$sql.= " order by link_position asc ";
	$sql.= " limit $start, $pagesize";

	$sql= $columns.$sql;
	$result= executeQuery($sql);
	//echo "<br>".$sql;

	$reccnt= getSingleResult($sql1);	

	$mainclass="box2";

	//------------CAT INFO---------------------

	$sql_cat="select * from yp_links_category where category_id='".$_GET['link_cat_id']."' ";
	$res_cat=executeQuery($sql_cat);

	while($lin_cat=mysql_fetch_array($res_cat)){
		$lcat_name = $lin_cat['category_name'];
		$lcat_desc = $lin_cat['category_desc'];	
	
	}

	//-----------------------------------------

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

<!-- Google Ad Manager TAG for the head SECTION -->
<script type="text/javascript" src="http://partner.googleadservices.com/gampad/google_service.js">
</script>
<script type="text/javascript">
  GS_googleAddAdSenseService("ca-pub-1908081881590351");
  GS_googleEnableAllServices();
</script>
<script type="text/javascript">
  GA_googleAddSlot("ca-pub-1908081881590351", "MTH_Links_top_right_300x250");
</script>
<script type="text/javascript">
  GA_googleFetchAds();
</script>
<!-- END OF TAG FOR head SECTION -->

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

<SCRIPT>
	function sendnext()
	{
		document.ch_linkcat.submit();
	}
</SCRIPT>

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
                       <div class="fl">
                         <div class="breadcrumbs"><a href="index.php">Home</a> > <?php echo stripslashes($page_contents[0])?></div>
                         <h1><?php if($lcat_name!=''){?><?php echo stripslashes($lcat_name)?><?php }else{?><?php echo stripslashes($page_contents[0])?><?php }?></h1>
                       </div>
					   <?php
							$sql_lc="select * from yp_links_category where category_status='Active' order by position";
							$res_lc=executeQuery($sql_lc);
					    ?>
					   <div class="fr" style="padding-top:5px; padding-right:8px;">
					   <form action="links.php" name="ch_linkcat" method="GET">
					   <select name="link_cat_id" id="link_cat_id" onChange="JavaScript:sendnext()">
					   <option value="">Choose Category</option>
					   <?php while($lin_lc=mysql_fetch_array($res_lc)){?>
							<option value="<?php echo $lin_lc['category_id']?>" <?php if($_GET['link_cat_id']==$lin_lc['category_id']){ echo 'selected';}?>><?php echo stripslashes($lin_lc['category_name'])?></option>
					   <?php }?>
					   </select></form></div>
                       <div class="clear"></div>

                       <p>
					   <?php if($lcat_desc!=''){?>
						   <?php echo wordwrap(stripslashes($lcat_desc), 50, "\n", 1)?>
					   <?php }else{?>
						   <?php echo wordwrap(stripslashes($page_contents[1]), 50, "\n", 1)?>
					   <?php }?>
					   </p>
						
					 <!-- Link Start -->

					 <?php if(mysql_num_rows($result)>0){ ?>

					 <?php
							while($line_ln=mysql_fetch_array($result)){ $pagecounter++;
								$link_name	= $line_ln['link_name'];
								$link_desc	= $line_ln['link_desc'];									
								$link_ref	= $line_ln['link_ref'];									
								$link_show  = $line_ln['link_show'];

								if($mainclass=="box2"){
									$mainclass="box1";
								}else{
									$mainclass="box2";
								}
					  ?>

						<div class="<?php echo $mainclass?>">
                        <a href="http://<?php echo $link_ref;?>" target="_blank"><?php echo nl2br(stripslashes($link_name));?></a>
                        <p style="margin-bottom:0px;"><?php echo nl2br(stripslashes($link_desc));?></p>

						<?php if($link_show=='Yes'){?><div class="linky"><a href="http://<?php echo $link_ref;?>" target="_blank"><?php echo wordwrap( $link_ref, 65, "\n", 1);?></a></div><?php }?>
                        
						</div>

						<?php } // while ends ?>
						
						<div align="center"><?php include "./includes/prev_paging_next.inc.php";?></div>

						<?php }else{?>

						<span class="red">COMING SOON...</span>

						<?php } // if ends ?>
					 <!-- Link Ends  -->


                     
                    </td>
                    <td width="15"><img src="images/blank.gif" width="15" height="1" alt="" /></td>
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