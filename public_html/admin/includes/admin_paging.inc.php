<?php

if($reccnt!=0){
	
$pagenum=$reccnt/$pagesize;

$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];

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
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr> 
    <td width="30%" align="center" class="menupaging">	
	  <font face="Tahoma, Arial, Helvetica, sans-serif" size="1"><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>" class="menupaging"> 
      <?php if($start!=0){?>
      &laquo; Previous </a>&nbsp; 
      <?php }?>
      </font>
    </td>
    <td width="40%" align="center" class="menupaging"><?php for($i=$j;$i<$k;$i++){
			if($i==$j)echo "Page:";
			   if(($pagesize*($i))!=$start)
				  {
	  ?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $pagesize*($i)?>" style="text-decoration:none;" ><b><font size="1" color="#0000FF"><?php echo $i+1?></font></b></a> 
      <?php }else{
	  ?>
      <span class="mainBold"><b><font size="1" color="#FF0000"> 
      <?php echo $i+1?>
      </font></b></span> 
      <?php
	  }
 }?>
      </font>
	  <table cellspacing="0" cellpadding="0">
			<tr> 
			<td class="text10" width="100%" align="center" height="20"> <span class="text10"> 
			   Showing Result
			  <?php echo $start+1?>
			  - 
			  <?php echo $start+$pagecounter?>
			  Out Of
			  <?php echo $reccnt?>
			  </span> 
		  </tr>
		</table>
</td>
    <td width="30%" align="center" class="white">
	   <font color="#FFFFFF" face="Tahoma, Arial, Helvetica, sans-serif" size="1"> 
      <?php 
	if($start+$pagesize < $reccnt){
		?>
      &nbsp;&nbsp; </font><font face="Tahoma,Arial, Helvetica, sans-serif" size="2"><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start+$pagesize?>" class="menupaging">Next 
      &raquo;</a>&nbsp; 
      <?php
		}
  ?>
      </font>    	
    </td>
  </tr>
</table>
<?php }?>
