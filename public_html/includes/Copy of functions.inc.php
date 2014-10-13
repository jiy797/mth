<?php

	//ob_start('ob_gzhandler');
	// if gzip_compression is enabled, start to buffer the output
	//  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
	//    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
	//      if (PHP_VERSION >= '4.0.4') {
	//        ob_start('ob_gzhandler');
	//      } else {
	//        include('./includes/gzip_compression.php');
	//        ob_start();
	//        ob_implicit_flush();
	//      }
	//    } else {
	//      ini_set('zlib.output_compression_level', GZIP_LEVEL);4/21/2008
	//    }
	//  }
	//session_start();

	global $_SERVER;
	global $DB;
	global $secure_server_path;
	global $non_secure_path ;
	global $SITE_FS_PATH ;

	@extract($_GET);
	@extract($_POST);
	@extract($_FILES);
	@extract($_COOKIE);
	@extract($_SESSION);
	
		if($_SERVER['HTTP_HOST']=="localhost" || $_SERVER['HTTP_HOST']=="youngpetals" || $_SERVER['HTTP_HOST']=="young" || $_SERVER['HTTP_HOST']=="192.168.0.2" || $_SERVER['HTTP_HOST']=="192.168.0.1"){
			$DB["host"]   = "localhost";
			$DB["dbName"] = "senditnow"; 
			$DB["user"]   = "root";
			$DB["pass"]   = "petals";

			$non_secure_path		= "http://".$_SERVER['SERVER_NAME']."/senditnow/site/";
			$non_secure_adminpath	= "http://".$_SERVER['SERVER_NAME']."/senditnow/site/admin/";
			$secure_server_path		= "http://".$_SERVER['SERVER_NAME']."/senditnow/site/";
			$SITE_PATH				= "http://".$_SERVER['SERVER_NAME']."/senditnow/site/";
			$SSL_PATH				= "http://".$_SERVER['SERVER_NAME']."/senditnow/site/";
			$SITE_FS_PATH			= "d:/apache/htdocs/senditnow/site/";
			$local_mode				= true;
		}else{

			
			$DB["host"]				= "localhost";
			$DB["dbName"]			= "trashelp_vw"; 
			$DB["user"]				= "trashelp_vw";
			$DB["pass"]				= "abCDefS13";

			$non_secure_path		= "http://trashelp.visuwire.net/";
			$non_secure_adminpath	= "http://trashelp.visuwire.net/admin/";
			$secure_server_path		= "http://trashelp.visuwire.net/";
			$SITE_PATH				= 'http://trashelp.visuwire.net/';
			$SSL_PATH				= 'http://trashelp.visuwire.net/';
			$SITE_FS_PATH			= '/home/trashelp/public_html/';
			$local_mode				= false;
		}	

		$link = mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
		mysql_select_db($DB["dbName"]);
	
	$sql_ss			= "select * from yp_site_settings "; 
	$result_ss		= executeQuery($sql_ss);

	while($line_ss = mysql_fetch_array($result_ss)){
		$title					=	$line_ss['site_title'];
		$site_title				=	$line_ss['site_title'];
		$site_address			=	$line_ss['site_address'];
		$site_email				=	$line_ss['site_email_to'];
		$site_from				=	$line_ss['site_email_from'];
		$site_meta_title		=	$line_ss['site_meta_title'];
		$site_meta_copyright	=	$line_ss['site_meta_copyright'];
		$site_meta_author		=	$line_ss['site_meta_author'];
		$site_meta_desc			=	$line_ss['site_meta_desc'];
		$site_meta_phrase		=	$line_ss['site_meta_phrase'];
		$site_meta_words		=	$line_ss['site_meta_words'];
		$site_logo				=	$line_ss['site_logo'];

		$site_phone				=	$line_ss['site_phone'];
		$site_copyright			=	$line_ss['site_copyright'];
	}
	// ====================================================================
	// Avoid URL injection code. Easy to improve the security (phising, etc..) 
	// of all your site when if are calling one .php to centralize all your 
	// DB connections.
	// ====================================================================

	$req	= $_SERVER['REQUEST_URI'];
	$cadena = explode("?", $req);
	$mi_url = $cadena[0];
	$resto	= $cadena[1];

	// here you can put your suspicions chains at your will. Just be careful of
	// possible coincidences with your URL's variables and parameters
	$inyecc='/script|http|<|>|%3c|%3e|SELECT|UNION|UPDATE|AND|exe|exec|INSERT|tmp/i'; 

	//  detecting
	if (preg_match($inyecc, $resto)) {
	   // make something, in example send an e-mail alert to administrator
	   $ip				= $_SERVER["HTTP_CLIENT_IP"];
	   $forwarded		= $_SERVER["HTTP_X_FORWARDED_FOR"];
	   $remoteaddress	= $_SERVER["REMOTE_ADDR"];

	   $message = "attack injection in $mi_url nnchain: $resto nn from: (ip-forw-RA):- $ip - $forwarded - $remoteaddressnn  --- end ---";
	   mail($site_email, "Attack injection", $message, "From: host@{$_SERVER['SERVER_NAME']}", "-fwebmaster@{$_SERVER['SERVER_NAME']}");

	   // message and kill execution
	   echo 'illegal url';
	   die();
	}  
	// ====================================================================
	//---------------- End of URL injection -------------------------------
	// ====================================================================	





	
	function executeQuery($sql)
		{
		$result = mysql_query($sql) or die(mysql_error(). " : ".$sql);
		return $result;
		}

	function getSingleResult($sql)
		{
		$response="";	
		$result = mysql_query($sql) or die(mysql_error(). " : ".$sql);
			if($line=mysql_fetch_array($result))
			{
				$response=$line[0];
			}
		return $response;
		}

	function executeUpdate($sql)
		{
		mysql_query($sql) or die(mysql_error(). " : ".$sql);
		}


	function verification_code()
		{
		$rand_num=rand(1,100000000000);
		return $rand_num;
		}
		
	function get_qry_str($over_write_key = array(), $over_write_value= array())
		{
		global $_GET;
		$m = $_GET;
			if(is_array($over_write_key))
				{
				$i=0;
				foreach($over_write_key as $key)
					{
					$m[$key] = $over_write_value[$i];
					$i++;
					}
				}else{
				$m[$over_write_key] = $over_write_value;
				}
		$qry_str = qry_str($m);
		return $qry_str;
		} 


	function qry_str($arr, $skip = '')
		{
			$s = "?";
			$i = 0;
			foreach($arr as $key => $value) {
				if ($key != $skip) {
					if ($i == 0) {
						$s .= "$key=$value";
						$i = 1;
					} else {
						$s .= "&$key=$value";
					} 
				} 
			}
		return $s;
		} 

	function refine_array(&$array)
		{
			$refined_array= array();
				
			for($i=0;$i<count($array);$i++)
			{
				$element= $array[$i];
				
				if($element=="") 
				{
					 continue;
				}
				else
				{
					$refined_array[count($refined_array)]= $element;
				}
			}
			$array = $refined_array;
		}

	function getmicrotime()
		{ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
		} 


	function get_new_file_name($file_name,$prefix=''){
		$rand_num=rand(1,100000000000);
			$ext = strtolower(substr(strrchr($file_name,"."),1));
			if($prefix==""){
				$prefix="pro_";
			}
		$new_image_file_name	=	$prefix.$rand_num.".$ext";
		return $new_image_file_name;
		}


	function get_file_ext($file_name){
		$pos	=strrpos($file_name, ".");
		$len	=strlen($file_name);
		$ext	=substr($file_name ,$pos+1, $len-1);
		$ext	=strtolower($ext);
		return $ext;
	}

	function date_combo($pre, $selected_date = '', $start_date = '', $start_date_unit = '', $start_date_value = '', $end_date = '', $end_date_unit = '', $end_date_value = '')
		{
			$cur_date = date("Y-m-d");
			$cur_date_day = substr($cur_date, 8, 2);
			$cur_date_month = substr($cur_date, 5, 2);
			$cur_date_year = substr($cur_date, 0, 4);

			if ($start_date == '') {
				if ($start_date_unit == '' || $start_date_value == '') {
					$start_date = $cur_date;
				} else if ($start_date_unit == 'y') {
					//echo "<br> ".mktime (0, 0, 0, 8, 25, 2103)." <br>";
					//echo "<br> ".mktime (0,0,0,12,32,1997)." <br>";
					$tmp_year=$cur_date_year + $start_date_value;
					$start_date = date("Y-m-d", mktime (0, 0, 0, $cur_date_month, $cur_date_day, $tmp_year));
					//echo "<br> $start_date <br>";
				} else if ($start_date_unit == 'm') {
					$start_date = date("Y-m-d", mktime (0, 0, 0, $cur_date_month + $start_date_value, $cur_date_day, $cur_date_year));
				} else if ($start_date_unit == 'd') {
					$start_date = date("Y-m-d", mktime (0, 0, 0, $cur_date_month, $cur_date_day + $start_date_value, $cur_date_year));
				} 
			}
			$start_date_day = substr($start_date, 8, 2);
			$start_date_month = substr($start_date, 5, 2);
			$start_date_year = substr($start_date, 0, 4); 
			// echo("$start_date<BR>");
			if ($end_date == '') {
				if ($end_date_unit == '' || $end_date_value == '') {
					// echo("1");
					$end_date = date("Y-m-d", mktime (0, 0, 0, $start_date_month, $start_date_day, $start_date_year + 2));
				} else if ($end_date_unit == 'y') {
					$end_date = date("Y-m-d", mktime (0, 0, 0, $start_date_month, $start_date_day, $start_date_year + $end_date_value));
				} else if ($end_date_unit == 'm') {
					$end_date = date("Y-m-d", mktime (0, 0, 0, $start_date_month + $end_date_value, $start_date_day, $start_date_year));
				} else if ($end_date_unit == 'd') {
					$end_date = date("Y-m-d", mktime (0, 0, 0, $start_date_month, $start_date_day + $end_date_value, $start_date_year));
				} 
			} 
			$end_date_day = substr($end_date, 8, 2);
			$end_date_month = substr($end_date, 5, 2);
			$end_date_year = substr($end_date, 0, 4); 
			// echo("$end_date<BR>");
			if ($selected_date != '') {
				$selected_date_day = substr($selected_date, 8, 2);
				$selected_date_month = substr($selected_date, 5, 2);
				$selected_date_year = substr($selected_date, 0, 4);
			} 
			$arr_month = Array('January' , 'February' , 'March' , 'April' , 'May' , 'June' , 'July' , 'August' , 'September' , 'October' , 'November' , 'December');

			$date_combo .= " <select name='" . $pre . "month'> <option value='0'>Month</option>";
			$i = 0;
			for($i = 0;$i <= 11;$i++) {
				$date_combo .= " <option ";
				if ($i + 1 == $selected_date_month) {
					$date_combo .= "selected";
				} 
				$date_combo .= " value='" . str_pad($i + 1, 2, "0", STR_PAD_LEFT) . "'>$arr_month[$i]</option>";
			} 

			$date_combo .= "</select>";

			$date_combo .= "<select name='" . $pre . "day'>";
			$date_combo .= "<option value='0'>Date</option>";
			for($i = 1;$i <= 31;$i++) {
				$date_combo .= " <option ";
				if ($i + 1 == $selected_date_day) {
					$date_combo .= "selected";
				} 
				$date_combo .= " value='" . str_pad($i, 2, "0", STR_PAD_LEFT) . "'>" . str_pad($i, 2, "0", STR_PAD_LEFT) . "</option>";
			} 
			$date_combo .= "</select>";

			$date_combo .= "<select name='" . $pre . "year'>";
			$date_combo .= "<option value='0'>Year</option>";
			for($i = $start_date_year; $i <= $end_date_year; $i++) {
				$date_combo .= " <option ";
				if ($i + 1 == $selected_date_year) {
					$date_combo .= "selected";
				} 
				$date_combo .= " value='" . str_pad($i, 2, "0", STR_PAD_LEFT) . "'>" . str_pad($i, 2, "0", STR_PAD_LEFT) . "</option>";
			} 
			$date_combo .= "</select>";
			return $date_combo;
		} 

	function cc_encode($s)
		{
		$sql="select encode('$s','youngpetals')";
		return getSingleResult($sql);
		}

	function cc_decode($s)
		{
		$s=addslashes($s);
		$sql="select decode('$s','youngpetals')";
		return getSingleResult($sql);
		}

	function crypt_now($s)
		{
		$new_s=crypt($s,"youngpetals");
		return $new_s;
		}

	function isValid_password($s,$p){
			if(crypt($s,"youngpetals")==$p)
				{
				return true;
				}
		}


	function valid_data($document)
		{
		$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript
                 "'<[\/\!]*?[^<>]*?>'si",           // Strip out html tags
                 "'([\r\n])[\s]+'",                 // Strip out white space
                 "'&(quot|#34);'i",                 // Replace html entities
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // evaluate as php
		$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");
		$text = preg_replace ($search, $replace, $document);
		$text = str_replace("''","'",addslashes($text));
		return $text;
		}

	function checkInput($inputText){
		$outputText=mysql_real_escape_string(trim($inputText));
		return $outputText;
	}

	function mail_attachment ($from , $to, $subject, $message, $attachment)
		{
			$fileatt = $attachment; // Path to the file                  
			$fileatt_type = "application/octet-stream"; // File Type 
			$start=	strrpos($attachment, '/') == -1 ? strrpos($attachment, '//') : strrpos($attachment, '/')+1;
			$fileatt_name = substr($attachment, $start, strlen($attachment)); // Filename that will be used for the file as the 	attachment 

			$email_from = $from; // Who the email is from 
			$email_subject =  $subject; // The Subject of the email 
			$email_txt = $message; // Message that the email has in it 
			
			$email_to = $to; // Who the email is to

			$headers = "From: ".$email_from;

			$file = fopen($fileatt,'rb'); 
			$data = fread($file,filesize($fileatt)); 
			fclose($file); 
			$msg_txt="\n\n";

			$semi_rand = md5(time()); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
			
			$headers .= "\nMIME-Version: 1.0\n" . 
					"Content-Type: multipart/mixed;\n" . 
					" boundary=\"{$mime_boundary}\""; 

			$email_txt .= $msg_txt;
			
			$email_message .= "This is a multi-part message in MIME format.\n\n" . 
						"--{$mime_boundary}\n" . 
						"Content-Type:text/html; charset=\"iso-8859-1\"\n" . 
					   "Content-Transfer-Encoding: 7bit\n\n" . 
			$email_txt . "\n\n"; 

			$data = chunk_split(base64_encode($data)); 

			$email_message .= "--{$mime_boundary}\n" . 
						  "Content-Type: {$fileatt_type};\n" . 
						  " name=\"{$fileatt_name}\"\n" . 
						  //"Content-Disposition: attachment;\n" . 
						  //" filename=\"{$fileatt_name}\"\n" . 
						  "Content-Transfer-Encoding: base64\n\n" . 
						 $data . "\n\n" . 
						  "--{$mime_boundary}--\n"; 


			$ok = @mail($email_to, $email_subject, $email_message, $headers); 

			if($ok) { 
			} else { 
				die("Sorry but the email could not be sent. Please go back and try again!"); 
			} 
		}

	global $breads;
	global $rev_bread;
	function breadCrump($id){
			if($id!=""){
				$pid=getSingleResult("select parent_cat_id from yp_category where category_id='$id'");
				$breads[$pid] =$id."_".getSingleResult("select category_name from yp_category where category_id='$id'");
				if($pid!=0){
					breadCrump($pid);
				}else{
				
				}
				$rev_bread = array_reverse ($breads);
				foreach($breads as $slice => $id_catname ){
					list($cid,$catname) = explode("_",$id_catname);
					$pcid = getSingleResult("select parent_cat_id from yp_category where category_id='$cid'");
					if($pcid=='0'){
						$crumpLink = "cat_overview.php?pcid=$cid";
					}else{
						$crumpLink = "category.php?cid=$cid";
					}
					echo "&nbsp;&nbsp;<img src='images/arrow3.gif' width='3' height='5' alt='' />&nbsp;&nbsp;<a href='".$crumpLink."'><span style='color: #DFDFDF;  font-family: Arial, Helvetica, sans-serif;font-size:11px;'>$catname</span></a>";
				}
			}
		}

	function getWidthHeight($size,$w,$h){
			if($size[1]>$h){
				$imgh=$h;
				$ratio=$size[0]/$size[1];
				$imgw=$imgh*$ratio;
			}else if($size[0]>$w){
				$imgw=$w;
				$ratio=$size[1]/$size[0];
				$imgh=$imgw*$ratio;							
			}else{
				$imgw=$size[0];
				$imgh=$size[1];
			}

			if($imgw>$w){
				$imgw=$w;
				$ratio=$size[1]/$size[0];
				$imgh=$imgw*$ratio;
			}
			if($imgh>$h){
				$imgh=$h;
				$ratio=$size[1]/$size[0];
				$imgw=$imgh*$ratio;
			}
			$width_height = $imgw.":".$imgh;
			return $width_height;
	 }


	function getFullDate($mysql_date,$format='F j, Y, g:i a'){
			$theDate = getdate(strtotime($mysql_date));	 
			$modifiedDate = date ($format, 
				mktime ($theDate['hours'],$theDate['minutes'],$theDate['seconds'],$theDate['mon'],$theDate['mday'],$theDate['year']));
		return $modifiedDate;
	}

	function strip_wordrap($text){
		$newtext = stripslashes(wordwrap($text, 20, "\n", 1));
		return $newtext;
	}

	function starrating($pid){
		$sql="select avg(rate) from yp_comment where pid='".$pid."'";
		$rate=getSingleResult($sql);
		//if($rate!=""){
		$rows=0;
		$cols=$rate;
		echo "<table border='0' cellpadding='0' cellspacing='0'><tr>";
		while($rows<5){
			if($rows<$rate){
				echo "<td><img src='./images/star1.jpg'></td>";
			}else{
				echo "<td><img src='./images/star2.jpg'></td>";
			}
			$rows++;
		}
		echo "</tr></table>";
		//}
	}
	function starrating_user($pid,$user){
		$sql="select avg(rate) from yp_comment where pid='".$pid."' and userid='$user'";
		$rate=getSingleResult($sql);
		//if($rate!=""){
		$rows=0;
		$cols=$rate;
		echo "<table border='0' cellpadding='0' cellspacing='0'><tr>";
		while($rows<5){
			if($rows<$rate){
				echo "<td><img src='./images/star1.jpg'></td>";
			}else{
				echo "<td><img src='./images/star2.jpg'></td>";
			}
			$rows++;
		}
		echo "</tr></table>";
		//}
	}
	function review_count($pid){
		$sql="select count(id) from yp_comment where pid='".$pid."'";
		$review_count=getSingleResult($sql);
		return $review_count;
	}

	function country_combo($selected='United States',$combo_name=''){
		$sql="select * from yp_country";
		$result=executeQuery($sql);
		echo "<select name='"; if($combo_name==''){ echo 'country'; }else{ echo $combo_name; } echo "' class='textfield' style='width:200px'>";
		echo "<option value=''>Choose Country</option>";
		while($line=mysql_fetch_array($result)){
			echo "<option value='".$line['country']."'";
			if($selected==$line['country']){
				echo "selected";
			}
			echo ">".$line['country']."</option>";
		}
		echo "</select>";
	}
	function state_combo($selected='',$combo_name=''){
		$sql="select * from yp_state where status='Active'";
		$result=executeQuery($sql);
		echo "<select name='"; if($combo_name==''){ echo 'state'; }else{ echo $combo_name; } echo "' class='textfield'>";
		echo "<option value=''>Choose State</option>";
		while($line=mysql_fetch_array($result)){
			echo "<option value='".$line['state_name']."'";
			if($selected==$line['state_name']){
				echo "selected";
			}
			echo ">".$line['state_name']."</option>";
		}
		echo "</select>";
	}
	function getViewNums($id){
		$sql="select count(*) from yp_video_viewed where video_id='$id'";
		$view_num=getSingleResult($sql);
		return $view_num;
	}

	function getCommentsNums($id){
		$sql="select count(*) from yp_video_comments where video_id='$id'";
		$comment_num=getSingleResult($sql);
		return $comment_num;
	}
	function getVideoRatingNums($id)
	{
		 //echo "<br>Video Rating >>".$id;			
		$sql= "	select avg(rating) from yp_video_rating where video_id='$id' ";
		$result_feedback_param =getSingleResult($sql);
		//$final_rating= 	getFinalRating($result_feedback_param);
		return number_format($result_feedback_param,2,'.','');	
	}
	function getVideoUserRatingNums($id,$uid){
		$sql= "	select avg(rating) from yp_video_rating where video_id='$id' and userid='$uid'";
		$result_feedback_param =getSingleResult($sql);
		//$final_rating= 	getFinalRating($result_feedback_param);
		return number_format($result_feedback_param,2,'.','');	
	}

	//------- Site Pages ---------------------------

	function getPageContents($id){
		$page_content=array();
		$sql="select * from yp_content_pages where status='Active' and page_id='$id'";
		$result=executeQuery($sql);
		if($line=mysql_fetch_array($result)){
			$page_content[0]=$line['page_title'];
			$page_content[1]=$line['page_desc'];
			$page_content[2]=$line['meta_title'];
			$page_content[3]=$line['meta_keywords'];
			$page_content[4]=$line['meta_desc'];
		}
		return $page_content;
	}
	//-------------------------------------------------

	function getUserState($uid){
		$sql="select state from yp_users where userid='".$uid."'";
		$st=getSingleResult($sql);
		return $st;
	}
	function getUsertype($uid){
		$sql="select user_type from yp_users where userid='$uid'";
		$utype=getSingleResult($sql);
		if($utype==""){
			$utype="Normal";
		}
		return $utype;
	}
	//---------------------------------------------Thumb Class-------------
class Thumbnail
	{
	/**
	 * Thumbnail::Thumbnail()
	 * 
	 * @param $resource_file - root or relative path + filename of image to be thumbnailed
	 * @param $max_width - maximum width of thumbnail in pixels
	 * @param $max_height - maximum height of thumbnail in pixels
	 * @param $destination_file - root or relative path + filename(+extension) of saved thumbnail
	 * @param $compression - % quality of output file - 85 is normally considered good
	 * @param $transform - see above
	 * @return 
	 */
	function Thumbnail($resource_file, $max_width, $max_height, $destination_file="", $compression=80, $transform="")
		{
		$this->a = $resource_file;		// image to be thumbnailed
		$this->c = $transform;
		$this->d = $destination_file;	// thumbnail saved to
		$this->e = $compression;		// compression ration for jpeg thumbnails
		$this->m = $max_width;
		$this->n = $max_height;

		$this->compile();
		if($this->c !== "")
			{
			$this->manipulate();
			$this->create();
			}
		}
	function compile()
		{	
		$this->h = getimagesize($this->a);
		if(is_array($this->h))
			{
			$this->i = $this->h[0];
			$this->j = $this->h[1];
			$this->k = $this->h[2];
		
			$this->o = ($this->i / $this->m);
			$this->p = ($this->j / $this->n);
			$this->q = ($this->o > $this->p) ? $this->m : round($this->i / $this->p); // width
			$this->r = ($this->o > $this->p) ? round($this->j / $this->o) : $this->n; // height
			}
		$this->s = ($this->k < 4) ? ($this->k < 3) ? ($this->k < 2) ? ($this->k < 1) ? Null : imagecreatefromgif($this->a) : imagecreatefromjpeg($this->a) : imagecreatefrompng($this->a) : Null;
		if($this->s !== Null)
			{
			$this->t = imagecreatetruecolor($this->q, $this->r); // created thumbnail reference
			$this->u = imagecopyresampled($this->t, $this->s, 0, 0, 0, 0, $this->q, $this->r, $this->i, $this->j);
			}

		}

	function create()
		{
		if($this->s !== Null)
			{
			if($this->d !== "")
				{
				ob_start();
				imagejpeg($this->t, $this->d, $this->e);
				ob_end_clean();
				}
			imagedestroy($this->s);
			imagedestroy($this->t);
			}
		}
	}
function make_thumb($file_path, $width='', $height='', $prefix='', $target_dir=''){
	if($width=='' && $height==''){
		$width  = 100;
		$height = 100;
	}
	if($width==''){
		$width  = $height;
	}
	if($height==''){
		$height = $width;
	}
	$path_parts = pathinfo($file_path);
	if($target_dir==''){
		$target_dir = $path_parts["dirname"];
	} 
	$thumb_path="$target_dir/".$prefix.$path_parts["basename"];
	$th_path=$prefix.$path_parts["basename"];

	$variable1 = new Thumbnail($file_path, $width, $height, $thumb_path,85,'');
	$variable1->create(); 

	return $th_path;
}
//---------------------------------------------Thumb Class-------------
	function createthumb($name,$filename,$new_w='',$new_h='',$path='',$target='')
	{
		$system=explode(".",$name);
		if (preg_match("/jpg|jpeg/",$system[1])){$src_img=imagecreatefromjpeg($path.$name);}
		if (preg_match("/png/",$system[1])){$src_img=imagecreatefrompng($path.$name);}
		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);

		if($new_w=='' && $new_h==''){
			$new_w=100;		
		}
		$size = @getimagesize ($path.$name);
		if($size==''){
			return false;
		}
		if($new_w!=''){
			$ratio	= $size[0]/$new_w;
			$new_h	= $size[1]/$ratio;
		}
		if($new_h!=''){
			$ratio = $size[1]/$new_h;
			$new_w	= $size[0]/$ratio;
		}
		$new_w=intval($new_w);
		$new_h=intval($new_h);
		//echo "<br>old_x -- $old_x<br>";
		//echo "<br>old_y -- $old_y<br>";


		if ($old_x > $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$old_y*($new_h/$old_x);
		}
		if ($old_x < $old_y) 
		{
			$thumb_w=$old_x*($new_w/$old_y);
			$thumb_h=$new_h;
		}
		if ($old_x == $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$new_h;
		}
		$path_parts = pathinfo($name);
		$th_path=$path_parts["basename"];
	//echo "<br>thumb_w -- $thumb_w<br>";
	//echo "<br>thumb_h -- $thumb_h<br>";

	//exit();
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		if (preg_match("/png/",$system[1]))
		{
			imagepng($dst_img,$target."th_".$filename); 
		} else {
			imagejpeg($dst_img,$target."th_".$filename); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
		return "th_".$filename;
	}
	function site_maintenance(){
		/********* Check the page for any maintenance work and wants the site to be temporarily down ************/
		/********* If page is active that means the site for temporarily down for maintenance *******************/
		$path_parts = pathinfo($_SERVER['PHP_SELF']);

		//echo $path_parts["dirname"] . "\n";
		//echo $path_parts["basename"] . "\n";
		//exit();
		if($path_parts["basename"]!="site_down.php"){
			$sql="select status from yp_site_down";
			$page_status=getSingleResult($sql);
			if($page_status=='Inactive'){
				header("Location: site_down.php");
				exit();
			}
		}
		/********* End ***********/
	}
	function display_file_names($selected=''){
		echo "<option value=''>choose file</option>";
		$file_list= array('bc_contactform.php','bc_contactform_thanks.php','category.php','change_password_frm.php','checkout_login.php','contact.php','contact_thanks.php','contest_detail.php','events.php','index.php','login.php','modify_cart_frm.php','myorderlist.php','myprofile.php','myvideos.php','newsletter_thanks.php','order_thanks.php','order_view.php','pages.php','product_detail.php','product_print.php','rating_frm.php','register_contestantp.php','register_intro.php','register_judge.php','register_thanks.php','register_trial.php','register_trial_thanks.php','review_order_frm.php','shipping_billing_frm.php','tshirt_contactform.php','tshirt_contactform_thanks.php','uploadvideos.php','uploadvideos_cat.php','uploadvideos_thanks.php','verify_form.php','verify_thanks.php','video.php','video_category.php','video_search.php','video_users.php','videodetails.php');
		foreach($file_list as $file_name){
			echo "<option value='".$file_name."' ";
			if($selected==$file_name) echo "selected";
			echo ">".$file_name."</option>";
		}
	}
	function showConvertedPrice ($price, $lang="_en" ){
		
		if(isset($_SESSION['my_currency_id']) && !empty($_SESSION['my_currency_id'])){
			$sql_cs		= "select * from yp_currency where currency_id = '".$_SESSION['my_currency_id']."' ";
			$result_cs  = executeQuery($sql_cs);
			while($line_cs = mysql_fetch_array($result_cs)){
				$currency_title		= $line_cs['currency_title'];
				$currency_sign		= $line_cs['currency_sign'];
				$conversion_value	= $line_cs['conversion_value'];
			}
			$converted_price = number_format($price*$conversion_value,2,".",",").' '.$currency_sign;
		}else{
			$sql_cs		= "select * from yp_currency where currency_default = 'Yes' ";
			$result_cs  = executeQuery($sql_cs);
			while($line_cs = mysql_fetch_array($result_cs)){
				$currency_title		= $line_cs['currency_title'];
				$currency_sign		= $line_cs['currency_sign'];
				$conversion_value	= $line_cs['conversion_value'];
			}
			$converted_price = number_format($price*$conversion_value,2,".",",").' '.$currency_sign;
		}
		return  $converted_price;
	}

	function showConvertedOrderPrice ($price, $order_id){
		if($order_id!=''){
			$sql_ocs		= "select order_currency_title, order_currency_sign, order_currency_conversion_value from yp_order where order_id = '".$order_id."' ";
			$result_ocs  = executeQuery($sql_ocs);
			while($line_ocs = mysql_fetch_array($result_ocs)){
				$currency_title		= $line_ocs['order_currency_title'];
				$currency_sign		= $line_ocs['order_currency_sign'];
				$conversion_value	= $line_ocs['order_currency_conversion_value'];
			}
		$converted_price = number_format($price*$conversion_value,2,".",",").' '.$currency_sign;
		return  $converted_price;
	}
	}
	function setIFramesPath(){
		$path_parts		= pathinfo($_SERVER['SCRIPT_FILENAME']);
		$basename		= $path_parts["basename"];
		$query_string	= $_SERVER['QUERY_STRING'];
		$full_path		= ($query_string!='')?($basename.'?'.$query_string):$basename;
		return $full_path;
	}
	function getCurrentPageURL(){
			$path_parts		= pathinfo($_SERVER['SCRIPT_FILENAME']);
			$basename		= $path_parts["basename"];
			$query_string	= $_SERVER['QUERY_STRING'];
			$full_path		= ($query_string!='')?($basename.'?'.$query_string):$basename;
			return $full_path;
		}
	function getMetaTags(){
		$meta_tags=array();
		$sqlm="select * from yp_metatags";
		$resm=executeQuery($sqlm);

		while($linem=mysql_fetch_array($resm)){
			$meta_tags[0] = $linem['m_title'];
			$meta_tags[1] = $linem['m_desc'];
			$meta_tags[2] = $linem['m_phrase'];
			$meta_tags[3] = $linem['m_words'];
		}

		return $meta_tags;
	}
	
	function getRating($pid, $userid=''){
		$sql	 = " select avg(rate) from yp_comment where pid='".$pid."'";
		if($userid!=''){
		$sql	.= " and userid='".$userid."'";
		}
		$ratings = getSingleResult($sql);
		return number_format($ratings,2,".",",");
	}
	function getRatingStars($pid, $userid=''){
		$sql	 = " select avg(rate) from yp_comment where pid='".$pid."'";
		if($userid!=''){
		$sql	.= " and userid='".$userid."'";
		}
		$total_stars  = 5;
		$filled_stars = getSingleResult($sql);
		$empty_stars  = $total_stars-$filled_stars;
		
		for($s=1;$s<=$filled_stars;$s++){
		echo "<img src='./images/filled_star.jpg'>";
		}
		for($s=1;$s<=$empty_stars;$s++){
		echo "<img src='./images/empty_star.jpg'>";
		}
	}
	function getRatingCount($pid, $userid=''){
		$sql	 = " select count(id) from yp_comment where pid='".$pid."'";
		if($userid!=''){
		$sql	.= " and userid='".$userid."'";
		}
		$ratings = getSingleResult($sql);
		return $ratings;
	}
	function showAttributes($arr_atts,$product_id){
		if(count($arr_atts)>0){
			echo "<table border='0' cellspacing='0' cellpadding='0'>";
			foreach($arr_atts as $att_id => $att_vid){
			
			$attribute_code  = getSingleResult("select attribute_code from yp_product_attribute where attribute_id='".$att_id."' and attribute_value_id='".$att_vid."' and product_id='".$product_id."'");

			$attribute_name	 = getSingleResult("select attribute_name from yp_attribute where attribute_id='".$att_id."' ");
			$attribute_value = getSingleResult("select attribute_value from yp_attribute_value where attribute_value_id='".$att_vid."' ");
			echo "<tr><td class='red'>".$attribute_name." : </td><td class='red'>&nbsp;".$attribute_value;
			if($attribute_code!=''){
				echo " [".$attribute_code."]";
			}
			echo "</td></tr>";
			}
			echo "</table>";
		}
	}

	function getFileSize($file_path){	
		$px		= "bytes";
		$size	= filesize($file_path);
		if($size>1024){
		$size = $size/1024;
		$px	  = "kb";
		}
		if($size>1024){
		$size =  $size/1024;
		$px	  = "mb";
		}
		if($size>1024){
		$size =  $size/1024;
		$px	  = "gb";
		}
	return number_format($size,2).$px;
	}

	function mem_hear_about($selected=''){
        //echo "<option value=''>---Select---</option>";
        $file_list= array('None','Word of Mouth','Email','Career Fair','Search Engine','Television','Newspaper','Direct Mail','Radio','Blog/Article','Other');
        foreach($file_list as $file_name){
                echo "<option value='".$file_name."' ";
                if($selected==$file_name) echo "selected";
                echo ">".$file_name."</option>";
        }
	}

	function averageRating($pid){

		$total_ctr=0;
		$total_rating=0;

		$sql_calc="select rev_rating from yp_provider_review where pro_id='$pid' and status='Active'";
		$res_calc=executeQuery($sql_calc);
		while($lin_calc=mysql_fetch_array($res_calc)){
			$rev_rate	 = $lin_calc['rev_rating'];
			$total_rating= $total_rating+$rev_rate;
			$total_ctr	 = $total_ctr+1;
		}
		$avg_rating=0;
		if($total_ctr>0&&$total_rating>0){
			$avg_rating = round($total_rating/$total_ctr);
		}
		return $avg_rating;
	}

?>