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
  <td width="71%" align="left" class="paging_css">&nbsp;<a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=0&pagesize=<?php echo $reccnt?>&ptyp=<?php echo $ptyp?>" class="cat">View All</a>&nbsp;&nbsp;&nbsp;<span class="paging_css">Page:</span>

      <?php
		if($start!=0){
	  ?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>" class="cat">&lt;</a>&nbsp; 
      <!-- arrow for previous with Link -->
      <?php
		}else{?>
      <a href="#" class="cat">&lt;</a> 
      <!-- arrow for previous without Link -->
      <?php
	  }
	  ?>

	  
	  <?php

if($pagenum>10)
	{
		$min=$pagenum-2;
	}
	else
	{
	$min=$pagenum;
	}
		//	for($i=$j;$i<$k;$i++){
			$length_of_page=10; //page numbers to  print 
			$e=$pagenum;
			$pagenumber=$start/$pagesize;
			if($pagenum>$length_of_page){
			$s=$pagenumber;
			}
			$end_point=$pagenumber+$length_of_page;
			
			if($end_point<$pagenum){
				$e=$end_point;
				}else{
				$e=$pagenum;
				}
			if($pagenum-$s<$length_of_page && $pagenum>$length_of_page){
			$s=$pagenum-$length_of_page;
			}
				
			for($i=$s;$i<$e;$i++){
				
				if($i==$j)echo "";
			    if(($pagesize*($i))!=$start){
					$lastpagenum=$i+1;
					$pnum=$pagesize*($i);
				//	echo "<br>i-- $i<br>";
				//	echo "<br>reccnt-- $reccnt<br>";
				//	echo "<br>start-- $start<br>";
				//	echo "<br>pagesize-- $pagesize<br>";
				//	$min=$reccnt-($pagesize*$start);
				//	echo "<br>min-- $min<br>";

				//	if($i>=$min){
				//		echo "<br>inside I-->$i<br>";

				//		echo "Inside Total--> $pagenum<br>";
				 if($i<$min){ 
	  ?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $pagesize*($i)?>&ptyp=<?php echo $ptyp?>" class="cat"> 
      <?php echo round($i+1)?>
      </a> 
      <?php }?>
      <?php// }?>
      <?php  }else{
		  $lastpagenum=$i+1; $pnum=$pagesize*($i); ?>
      <?php  if($i<$min){ ?>
      <?php echo round($i+1)?>
     
      <?php }//if($min<=1){echo(">");}?>
      <?php }
	//  } //end of for
	  ?>
      <?php if($i>$min){ ?>
      ...<a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo ($lastpagenum*$pagesize)-($pagesize*2)?>&ptyp=<?php echo $ptyp?>" class="cat"> 
      <?php
				$deco=($lastpagenum*$pagesize)-($pagesize*2);
				if($start==$deco){?>
     
      <?php }?>
      <span class="paging_css"><?php echo round($i)?></span>
      <?php if($start==$deco){?>
      
      <?php }?>
      </a><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $pagesize*($i)?>&ptyp=<?php echo $ptyp?>" class="cat"> 
      <?php
				$deco1=$pagesize*($i);
				if($start==$deco1){?>
      
      <?php }?>
      <?php echo round($i+1)?>
      <?php if($start==$deco1){?>
     
      <?php }?>
      </a>
      <?php } ?>
      <?php }?>
      <?php if($start+$pagesize < $reccnt){ ?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start+$pagesize?>&ptyp=<?php echo $ptyp?>" class="cat">&gt;</a>&nbsp; 
      <!-- arrow for next with Link -->
      <?php
		}else{?>
      <a href="#" class="cat">&gt;</a> 
      <!-- arrow for next without Link -->
      <?php }
  ?>      </td>
	 <td width="29%" align="right" height="20"><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>&ptyp=<?php echo $ptyp?>" > 
      </a>
	   <table width="100%" border="0" cellspacing="0" cellpadding="1">
         <tr>
           <td align="right">
	<?php
		if($start!=0){
	?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&amp;start=<?php echo $start-$pagesize?>&amp;ctr=<?php echo $ctr?>&ptyp=<?php echo $ptyp?>" class="cat">< Previous</a>&nbsp;
      <!-- arrow for previous with Link -->
      <?php
		}else{?>
		<a href="#" class="cat">< Previous</a>      
      <!-- arrow for previous without Link -->
      <?php
	  }
	?>&nbsp;<span class="paging_css">|</span>&nbsp;<?php if($start+$pagesize < $reccnt){ ?>
     <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&amp;start=<?php echo $start+$pagesize?>&amp;ctr=<?php echo $ctr?>&ptyp=<?php echo $ptyp?>" class="cat">Next ></a>&nbsp;
      <!-- arrow for next with Link -->
      <?php
		}else{?>
      <a href="#" class="cat">Next ></a>
      <!-- arrow for next without Link -->
      <?php }?>          </td>
         </tr>
       </table>
    </td>
  </tr>
</table>
<?php }?>
