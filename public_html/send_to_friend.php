<?php
	require "./includes/application_top.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title><?php echo stripslashes($site_title)?> : Tell A Friend</title>
<meta name="description" content="<?php echo stripslashes($site_meta_desc)?>" />
<meta name="keywords" content="<?php echo stripslashes($site_meta_words)?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="author" content="<?php echo stripslashes($site_meta_author)?>" />
<meta name="copyright" content="<?php echo stripslashes($site_meta_copyright)?>"/>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/update.css" rel="stylesheet" type="text/css" />

<?php include("i_javascripts.php"); ?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function isEMail(s){
		if(((s.indexOf("@"))==-1) || ((s.indexOf("."))==-1)){
			return true ;  
		}else{
			return false;		
		}
	}

function validate(formObj){
	var error=''

	if(formObj.from_email.value==""){
		error +="\nYour Name";
	}

	/*
	if(formObj.from_email.value!=""){
		myArr=isEMail(formObj.to_email.value)
		if(myArr)
		{
			error+="\nInvalid Email";  
		}
	}
	*/

	if(formObj.to_email.value==""){
		error +="\nEmail Address of Friend";
	}

	if(formObj.to_email.value!=""){
		myArr=isEMail(formObj.to_email.value)
		if(myArr)
		{
			error+="\nValid Email Address of Friend";  
		}
	}

	if(error !='')
	{
		alert ('Following Fields are Required \n' + error)
		return false
	}else
	{
		return true
	}

}

//-->
</script> 
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
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="10">
			  <tr>
				<td width="15%"><img src="images/logo.png" width="256" height="79" /></td>
			    <td width="85%">&nbsp;</td>
			  </tr>
			  <tr>
			    <td colspan="2"><h1>&nbsp;Tell a Friend</h1></td>
		      </tr>
			</table>
		</td></tr>
		<tr><td>
        <table width="100%" border="0" cellspacing="3" cellpadding="3">
		<form action="send_to_friend_submit.php" method="post" enctype="multipart/form-data" name="send_msg" id="send_msg" onSubmit="return validate(this)" >
		<?php if($_SESSION['sess_msg']!=''){?>
		<tr>	
			<td height="20" colspan="2" align="center" class="red"><?php echo $_SESSION['sess_msg']; unset($_SESSION['sess_msg']);?></td>
		</tr>
		<?php }?>
		<tr>
          <td width="29%" height="20" align="left">Your Name</td>
          <td width="71%" height="20" align="left">
		  <input name="from_email" type="text" class="textfield" id="from_email" size="40" /></td>
        </tr>
        <tr>
          <td height="20" align="left">Friend's Email Address</td>
          <td height="20" align="left"><input name="to_email" type="text" class="textfield" id="to_email" size="40" /></td>
        </tr>
        <tr >
          <td height="20" align="left" valign="top" class="big">Message</td>
          <td height="20" align="left"><textarea name="message1" cols="37" rows="5" class="textfield"></textarea></td>
        </tr>
        
        <tr >
          <td height="20"  class="main"><span class="text10">
          </span></td>
          <td height="20"  class="main"><span class="text10">
            <input name="pid" type="hidden" value="<?php echo $pid;?>" />
            <input name="Submit2" type="submit" class="buttons" value="Send">
            <input name="Close" type="button" class="buttons" value="Close" onClick="window.close()" />
          </span></td>
        </tr>
		</form>
</table>
</td></tr></table>

</body>
</html>