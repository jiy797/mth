<?php
	require "./includes/application_top.php";
	$sql				= "select page_top_desc".$lang." from yp_c_address";
	$contact_contents	= getsingleresult($sql);
	$sql				= "select page_text from yp_c_address";
	$address_text		= getsingleresult($sql);
	$b_page='CONTACT US';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title><?php echo stripslashes($site_title)?> : <?php echo stripslashes($site_meta_title)?></title>
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
	function clearFields(){
		document.getElementById('first_name').value	= '';
		document.getElementById('last_name').value	= '';
		document.getElementById('company').value	= '';
		document.getElementById('phone1').value	= '';
		document.getElementById('phone2').value	= '';
		document.getElementById('phone3').value	= '';
		document.getElementById('email').value	= '';
		document.getElementById('comments').value= '';
	}
//-->
</SCRIPT>

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
                       <div class="breadcrumbs"><a href="index.php">Home</a> > Contact</div>
                       <h1>Contact Us</h1>
                       <p><?php echo wordwrap(stripslashes($contact_contents), 50, "\n", 1)?></p>

                       <table align="center" border="0" cellspacing="6" cellpadding="2">
					   <form name="contact" action="contact_submit.php" method="POST">
					    <?php if($_SESSION['sess_msg']!=''){?>
					    <tr>
						  <td colspan="2" class="red" ><?php echo $_SESSION['sess_msg'] ?> <?php unset($_SESSION['sess_msg']); ?></td>
					    </tr>
					    <?php }?>
						<tr>
							<td align="right">First Name:<span class="red">*</span></td>
							<td><input name="first_name" id="first_name" type="text" style="width:215px;" value="<?php echo stripslashes($_SESSION['first_name'])?>" /></td>
						</tr>
						<tr>
							<td align="right">Last Name:<span class="red">*</span></td>
							<td><input name="last_name" id="last_name" type="text" style="width:215px;" value="<?php echo stripslashes($_SESSION['last_name'])?>" /></td>
						</tr>
						<tr>
							<td align="right">Company Name:</td>
							<td><input name="company" id="company" type="text" style="width:215px;" value="<?php echo stripslashes($_SESSION['company'])?>" /></td>
						</tr>
						<tr>
							<td align="right">Your Phone:</td>
							<td><input name="phone1" type="text" id="phone1" style="width:55px;"  value="<?php echo stripslashes($_SESSION['phone1'])?>" maxlength="3" />&nbsp;&nbsp;<input name="phone2" type="text" id="phone2" style="width:55px;"  value="<?php echo stripslashes($_SESSION['phone2'])?>" maxlength="3" />
							&nbsp;&nbsp;<input name="phone3" type="text" id="phone3" style="width:80px;" value="<?php echo stripslashes($_SESSION['phone3'])?>" maxlength="4" /></td>
						</tr>
						<tr>
							<td align="right">Your Email:<span class="red">*</span></td>
							<td><input name="email_address" id="email_address" type="text" style="width:215px;" value="<?php echo stripslashes($_SESSION['email_address'])?>" /></td>
						</tr>
						<tr>
						  <td align="right" valign="top">Subject:<span class="red">*</span></td>
						  <td><select name="e_subject" id="e_subject" style="width:215px;">
						    <option value="0">Select One</option>
						    <option value="Article Information" <?php if($_SESSION['e_subject']=='Article Information'){ echo 'selected';}?>>Article Information</option>
						    <option value="Advertising Options" <?php if($_SESSION['e_subject']=='Advertising Options'){ echo 'selected';}?>>Advertising Options</option>
						    <option value="Web Site Errors" <?php if($_SESSION['e_subject']=='Web Site Errors'){ echo 'selected';}?>>Web Site Errors</option>
							<option value="Web Site Comments" <?php if($_SESSION['e_subject']=='Web Site Comments'){ echo 'selected';}?>>Web Site Comments </option>
							<option value="Other" <?php if($_SESSION['e_subject']=='Other'){ echo 'selected';}?>>Other</option>
						    </select>
						  </td>
					     </tr>
						<tr>
							<td align="right" valign="top">Comments or questions:<span class="red">*</span></td>
							<td><textarea name="comments" id="comments" rows="5" style="width:215px;"><?php echo stripslashes($_SESSION['comments'])?></textarea></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="#" onclick="javaScript: clearFields();" ><img src="images/clear.gif" /></a>&nbsp;&nbsp;<input type="image" src="images/submit.gif" name="submit" value="Submit" alt="Submit" /></td>
						</tr>
						<tr>
							<td colspan="2"> </td>
						</tr>
						</form>
					</table>

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