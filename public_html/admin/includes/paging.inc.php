<?php

if($reccnt!=0){
	
$pagenum=$reccnt/$pagesize;

$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'];
//echo "<br>$PHP_SELF<br>";


$m=$_GET;
unset($m['start']);

$qry_str=qry_str($m);

//echo "$qry_str : $p<br>";

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
<table width="100%" height="26" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="10"  align="left" class="small red">&nbsp;</td> 
    <td width="60%" height="20"  align="left"><b>
	<?php
		for($i=$j;$i<$k;$i++){
			if($i==$j)echo "Page : ";
			if(($pagesize*($i))!=$start){
				echo "<a href=\"".$PHP_SELF.$qry_str."&start=".$pagesize*($i)."\" style=\"text-decoration:none;\" >";
				echo $i+1;
				echo "</a>&nbsp;";
			}else{
				echo $i+1;
				echo "&nbsp;";
			}
		}
		
	?>
	</b></td>
    <td align="right"><b>
    <?php
		if($start!=0){?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>"  style="text-decoration:none;" > < Previous </a>
      <?php }else{ echo "< Previous"; }
	  ?>
	  &nbsp;|&nbsp;
	  <?php
	  if($start+$pagesize < $reccnt){
	  ?><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start+$pagesize?>"  style="text-decoration:none;" >Next ></a>
	<?php
		}else{ echo "Next >"; }
	?>    </b>&nbsp;&nbsp;</td>
  </tr>
</table>
<?php
		}
?>
