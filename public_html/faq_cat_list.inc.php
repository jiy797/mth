<?php

$start=0;
if(isset($_GET['start'])){	$start=$_GET['start'];}
$pagesize=5;
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
$sql=" from  yp_faq_category where faq_cat_status='Active' ";

$sql1="select count(*) ".$sql;
$sql.= " order by faq_cat_position";
$sql.= " limit $start, $pagesize";

$sql= $columns.$sql;
$result_faq_cat= executeQuery($sql);

$reccnt = getSingleResult($sql1);	


?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <?php 
	 $ques_cntr=1;
	if(mysql_num_rows($result_faq_cat)>0){
		while($line_faq_cat=mysql_fetch_array($result_faq_cat)){
		  $pagecounter+=1;
		
			$faq_cat_id	  = $line_faq_cat['faq_cat_id'];
			$faq_cat_name = $line_faq_cat['faq_cat_name'];								
	?>
  <tr>
    <td width="100%" height="10" colspan="3"><table width="100%" cellpadding="2" cellspacing="0">
      <tr>
        <td height="30" align="left"><h2>&nbsp;<?php echo ucwords(stripslashes($faq_cat_name))?></h2></td>
      </tr>
    </table></td>
  </tr>

  <?php // Questions ?>
  <?php
								  
		$sql_faq="select * from  yp_faq where status='Active' and faq_cat_id='$faq_cat_id' order by faq_position";	
		$result_faq=executeQuery($sql_faq);

		if(mysql_num_rows($result_faq)>0){
		while($line_faq=mysql_fetch_array($result_faq)){
			//$pagecounter+=1;
	  
			$faq_id	   = $line_faq['faq_id'];
			$question  = $line_faq['question'];
			$answer    = $line_faq['answer'];	
			
	?>
  <tr>
    <td height="10" colspan="3" >
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="1%" align="center" class="green strong"><?php// echo $ques_cntr?></td>
        <td width="99%" align="left"><a href="faq.php?id=<?php echo $faq_id?>&start=<?php echo $start?>" class="menu1"><span class="green strong" style="margin-bottom:0px;"><?php echo nl2br(stripslashes($question))?></span></a> </td>
      </tr>
	  <tr>
		<td colspan="2"><img src="images/x.gif" width="1" height="1" /></td>
	  </tr>
      <?php if($_GET['id']==$faq_id){?>
      <tr>
        <td width="1%" align="center" valign="top">&nbsp;</td>
        <td width="99%" align="left"><?php echo stripslashes($answer)?></td>
      </tr>
      <?php }?>
    </table></td>
  </tr>
  <?php $ques_cntr++;?>
  <?php }}?>
  <?php //-----end Questions----------------------------?>
  <?php }?>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
 <?php if($reccnt>5){?>
  <tr>
	<td  colspan="3" height="40" align="center" class="main"><?php include "./includes/prev_paging_next.inc.php";?></td>
 </tr> 
 <?php }?>

  <?php }else{?>
  <tr >
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="3" align="center" class="red">Coming Soon....</td>
  </tr>
  <tr >
    <td colspan="3" align="center" class="red">&nbsp;</td>
  </tr>
  <?php }?>
</table>
