<?php
function duration ($seconds, $suffix=FALSE) {
   $takes_time = array(604800,86400,3600,60,0);
   $suffixes = array("Week","Day","Hour","Minute","Second");
   $delimeter = array(" W ", " D ", ":",":","");
   $output = "";
   foreach ($takes_time as $key=>$val) {
       ${$suffixes[$key]} = ($val == 0) ? $seconds : floor(($seconds/$val));
       $seconds -= ${$suffixes[$key]} * $val;
       if (${$suffixes[$key]} > 0 || (!empty($output) && $suffix == FALSE)) {
           if ($val == 0 && $suffix == FALSE && empty($output)) {
               $output .= "00:";
           }
           $output .= ($key > 1 && strlen(${$suffixes[$key]}) == 1 && $suffix == FALSE) ? "0".${$suffixes[$key]} : ${$suffixes[$key]};
           if ($suffix == "short") {
               $output .= substr($suffixes[$key],0,1)." ";
           }
           elseif ($suffix == "long") {
               $output .= (${$suffixes[$key]} > 1) ? " ".$suffixes[$key]."s " : " ".$suffixes[$key]." ";
           }
           else {
               $output .= $delimeter[$key];
           }
       }
   }
   return $output;
}
function time_left($time){
	$events_time = $time;
	$time_left = $events_time - time();
	$time_left = (floor($time_left/86400))."d ".floor(($time_left-(floor($time_left/86400)*86400))/3600)."h ".floor(($time_left-(floor($time_left/3600)*3600))/60)."m ".floor($time_left-(floor($time_left/60))*60)."s";
}

function calcElapsedTime($time)
{
       // calculate elapsed time (in seconds!)
       $diff = time()-$time;
       $yearsDiff = floor($diff/60/60/24/365);
       $diff -= $yearsDiff*60*60*24*365;
       $monthsDiff = floor($diff/60/60/24/30);
       $diff -= $monthsDiff*60*60*24*30;
       $weeksDiff = floor($diff/60/60/24/7);
       $diff -= $weeksDiff*60*60*24*7;
       $daysDiff = floor($diff/60/60/24);
       $diff -= $daysDiff*60*60*24;
       $hrsDiff = floor($diff/60/60);
       $diff -= $hrsDiff*60*60;
       $minsDiff = floor($diff/60);
       $diff -= $minsDiff*60;
       $secsDiff = $diff;
       return (''.$yearsDiff.' year'.(($yearsDiff <> 1) ? "s" : "").', '.$monthsDiff.' month'.(($monthsDiff <> 1) ? "s" : "").', '.$weeksDiff.' week'.(($weeksDiff <> 1) ? "s" : "").', '.$daysDiff.' day'.(($daysDiff <> 1) ? "s" : "").', '.$hrsDiff.' hour'.(($hrsDiff <> 1) ? "s" : "").', '.$minsDiff.' minute'.(($minsDiff <> 1) ? "s" : "").', '.$secsDiff.' second'.(($secsDiff <> 1) ? "s" : "").'');
}

function delta_time($time){

       $delta = time() - mktime(date("H",$time), date("i",$time), date("s",$time), date("m",$time), date("d",$time), date("y",$time));
       /* Returns seconds since the date used with mktime() */

       echo round($delta/(60*60*24),2);
       /*
               (60*60*24) Returns days passed since the above date.
               If you want your script to return minutes, just devide by
               60, etc.
       */

}
function secsToText($time = 0) {
 $days    = (int)floor($diff/60/60/24);
 $hours    = (int)floor($time/3600);
 $minutes  = (int)floor($time/60)%60;
 $seconds  = (int)$time%60;
 if($hours==1) $txt  = "$hours hour";        
 else if($hours>1) $txt  = "$hours hours";    
 if($txt and $minutes>0 and $seconds>0) $txt .= ", "; 
 else if($txt and $minutes>0 and $seconds==0) $txt .= " and ";
 $s = ($minutes>1)  ? "s" : NULL;
 if($minutes>0) $txt .= "$minutes minute$s";  
 $s = ($seconds>1) ? "s" : NULL;
 if($txt and $seconds>0) $txt .= " and ";    
 if($seconds>0) $txt .= "$seconds second$s";  
 else if(!$txt and $seconds==0) $txt  .= "0 seconds";
 $txt.="days $days";
 return $txt;
}
function duration1($duration) {

   $jours = floor(($duree/86400));
   $duration = $duration % 86400;
   $heures = floor(($duration/3600));
   $duration = $duration % 3600;
   $minutes = floor(($duree/60));
   $duration = $duration % 60;
   
   printf('%dj %02dh %02dmin',$jours,$heures,$minutes);

} 
/*
function getFullDate($mysql_date){
	$theDate = getdate(strtotime($mysql_date));	 
	$modifiedDate = date ("F j, Y, g:i a", 
		mktime ($theDate['hours'],$theDate['minutes'],$theDate['seconds'],$theDate['mon'],$theDate['mday'],$theDate['year']));
return $modifiedDate;
}*/


function getTimesAgo($time,$op='')
{
       // calculate elapsed time (in seconds!)
		$get_stamp ="Select ( UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP('$time') )";
		$s1=mysql_query($get_stamp) or die(mysql_error());
		$sr = mysql_fetch_row($s1);
		$diff = $sr[0];
		$yearsDiff = floor($diff/60/60/24/365);
		$diff -= $yearsDiff*60*60*24*365;
		$monthsDiff = floor($diff/60/60/24/30);
		$diff -= $monthsDiff*60*60*24*30;
		$weeksDiff = floor($diff/60/60/24/7);
		$diff -= $weeksDiff*60*60*24*7;
		$daysDiff = floor($diff/60/60/24);
		$diff -= $daysDiff*60*60*24;
		$hrsDiff = floor($diff/60/60);
		$diff -= $hrsDiff*60*60;
		$minsDiff = floor($diff/60);
		$diff -= $minsDiff*60;
		$secsDiff = $diff;
		if($op=='SINGLE'){
			if($yearsDiff>0){
				$year = ($yearsDiff > 0) ? (''.$yearsDiff.' year'.(($yearsDiff <> 1) ? "s" : "")): "";
			}else if($monthsDiff>0){
				$month = ($monthsDiff > 0) ? (''.$monthsDiff.' month'.(($monthsDiff <> 1) ? "s" : "")): "";
			}else if($weeksDiff>0){
				$week = ($weeksDiff > 0) ? (''.$weeksDiff.' week'.(($weeksDiff <> 1) ? "s" : "")) : "";
			}else if($daysDiff>0){
				$day = ($daysDiff > 0) ? (''.$daysDiff.' day'.(($daysDiff <> 1) ? "s" : "")) : "";
			}else if($hrsDiff>0){
				$hour = ($hrsDiff > 0) ? (''.$hrsDiff.' hour'.(($hrsDiff <> 1) ? "s" : "")) : "";
			}else if($minsDiff>0){
				$minute = ($minsDiff > 0) ? (''.$minsDiff.' minute'.(($minsDiff <> 1) ? "s" : "")) : "";
			}else if($secsDiff>0){
				$second = ($secsDiff > 0) ? (''.$secsDiff.' second'.(($secsDiff <> 1) ? "s" : "")) : "";
			}
		}else{
			$year = ($yearsDiff > 0) ? (''.$yearsDiff.' year'.(($yearsDiff <> 1) ? "s" : "")).", ": "";
			$month = ($monthsDiff > 0) ? (''.$monthsDiff.' month'.(($monthsDiff <> 1) ? "s" : "")).", " : "";
			$week = ($weeksDiff > 0) ? (''.$weeksDiff.' week'.(($weeksDiff <> 1) ? "s" : "")).", " : "";
			$day = ($daysDiff > 0) ? (''.$daysDiff.' day'.(($daysDiff <> 1) ? "s" : "")).", " : "";
			$hour = ($hrsDiff > 0) ? (''.$hrsDiff.' hour'.(($hrsDiff <> 1) ? "s" : "")).", " : "";
			$minute = ($minsDiff > 0) ? (''.$minsDiff.' minute'.(($minsDiff <> 1) ? "s" : "")).", " : "";
			$second = ($secsDiff > 0) ? (''.$secsDiff.' second'.(($secsDiff <> 1) ? "s" : ""))." " : "";
		}
	

		return $year.$month.$week.$day.$hour.$minute.$second."  ago";
}
function secondsToTime($time=0)
{
        $diff = $time;
		$yearsDiff = floor($diff/60/60/24/365);
		$diff -= $yearsDiff*60*60*24*365;
		$monthsDiff = floor($diff/60/60/24/30);
		$diff -= $monthsDiff*60*60*24*30;
		$weeksDiff = floor($diff/60/60/24/7);
		$diff -= $weeksDiff*60*60*24*7;
		$daysDiff = floor($diff/60/60/24);
		$diff -= $daysDiff*60*60*24;
		$hrsDiff = floor($diff/60/60);
		$diff -= $hrsDiff*60*60;
		$minsDiff = floor($diff/60);
		$diff -= $minsDiff*60;
		$secsDiff = round($diff);
	
		$year = ($yearsDiff > 0) ? (''.$yearsDiff.'y,'.(($yearsDiff <> 1) ? "s" : ""))."": "";
		$month = ($monthsDiff > 0) ? (''.$monthsDiff.'m,'.(($monthsDiff <> 1) ? "s" : ""))."" : "";
		$week = ($weeksDiff > 0) ? (''.$weeksDiff.'w,'.(($weeksDiff <> 1) ? "s" : ""))."" : "";
		$day = ($daysDiff > 0) ? (''.$daysDiff.'d,'.(($daysDiff <> 1) ? "s" : ""))."" : "";
		$hour = ($hrsDiff > 0) ? (''.two_digit($hrsDiff).':'.(($hrsDiff <> 1) ? "" : ""))."" : "";
		$minute = ($minsDiff > 0) ? (''.two_digit($minsDiff).':'.(($minsDiff <> 1) ? "" : ""))."" : "00:";
		$second = ($secsDiff > 0) ? (''.two_digit($secsDiff).''.(($secsDiff <> 1) ? "" : ""))."" : "00";
	
	

		return $year.$month.$week.$day.$hour.$minute.$second;
}
function two_digit($val=0){
	if($val>=0 && $val<=9){
		$new_val="0".$val;
	}else{
		$new_val=$val;
	}
	return $new_val;
}
?>