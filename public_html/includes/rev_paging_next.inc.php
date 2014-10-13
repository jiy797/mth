<style type="text/css">
	<!--
	.paging_css {
	  font-size:11px;
	}
	.cat:link { color: #EF3D01; text-decoration:none; }
	.cat:visited { color: #EF3D0; text-decoration:none; }
	.cat:active { color: #EF3D0; text-decoration:none; }
	.cat:hover { color: #EF3D0; text-decoration:none; }
	//-->
</style>
<?php

if($reccnt!=0){
	
$pagenum=$reccnt/$pagesize;

$PHP_SELF = $_SERVER['PHP_SELF'];
$qry_str  = $_SERVER['argv'][0];

$m=$_GET;
unset($m['start']);


$qry_str=qry_str($m);

	if($pagenum>40)
	{
		$j=$start/$pagesize;		
		$k=$j+40;
		if($k>$pagenum)
		{
			$k=$pagenum;
		}
	}
	else
	{
		$j=0;
		$k=$pagenum;
	}

?>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
  <td width="71%" align="left" class="paging_css">&nbsp;</td>
	 <td width="29%" align="right" height="20"><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>&ptyp=<?php echo $ptyp?>" > 
      </a>
	   <table width="100%" border="0" cellspacing="0" cellpadding="1">
         <tr>
           <td align="right">
	<?php
		if($start!=0){
	?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&amp;start=<?php echo $start-$pagesize?>&amp;ctr=<?php echo $ctr?>&ptyp=<?php echo $ptyp?>" class="cat"><img src="./images/but-previouse.jpg" width="86" height="29" border="0" /></a>&nbsp;
      <!-- arrow for previous with Link -->
      <?php
		}else{ ?>
		<a href="#" class="cat"><img src="./images/but-previouse.jpg" width="86" height="29" border="0" /></a>      
      <!-- arrow for previous without Link -->
      <?php
	  }
	?>&nbsp;<span class="paging_css"></span>&nbsp;<?php if($start+$pagesize < $reccnt){ ?>
     <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&amp;start=<?php echo $start+$pagesize?>&amp;ctr=<?php echo $ctr?>&ptyp=<?php echo $ptyp?>" class="cat"><img src="./images/but-next.jpg" width="67" height="29" border="0" /></a>&nbsp;
      <!-- arrow for next with Link -->
      <?php
		}else{ ?>
      <a href="#" class="cat"><img src="./images/but-next.jpg" width="67" height="29" border="0" /></a>
      <!-- arrow for next without Link -->
      <?php } ?>          </td>
         </tr>
       </table>
    </td>
  </tr>
</table>
<?php } ?>
