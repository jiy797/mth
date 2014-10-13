<?php
	require "./includes/application_top.php";	

	$admin_id=$_SESSION['admin_id'];
	if ($admin_id==""){
		$msg="Session Expired. Please Login Again to Proceed.";
		$_SESSION['msg']=$msg;
		header("Location:index.php");
		exit();
	}

	$setting_id = '1';	

	$sql_ss			= "select * from yp_site_settings where setting_id='$setting_id' "; 
	$result_ss		= executeQuery($sql_ss);

	while($line_ss = mysql_fetch_array($result_ss)){
		$ss_site_title			=	$line_ss['site_title'];
		$ss_site_address		=	$line_ss['site_address'];
		$ss_site_email_to		=	$line_ss['site_email_to'];
		$ss_site_email_from		=	$line_ss['site_email_from'];
		$ss_site_meta_title		=	$line_ss['site_meta_title'];
		$ss_site_meta_author	=	$line_ss['site_meta_author'];
		$ss_site_meta_copyright	=	$line_ss['site_meta_copyright'];
		$ss_site_meta_desc		=	$line_ss['site_meta_desc'];
		$ss_site_meta_phrase	=	$line_ss['site_meta_phrase'];
		$ss_site_meta_words		=	$line_ss['site_meta_words'];
		$ss_site_logo			=	$line_ss['site_logo'];
		$ss_site_phone			=	$line_ss['site_phone'];
		$ss_site_copyright		=	$line_ss['site_copyright'];
	}
?>

<html>
<head>
<title><?php echo $site_title;?> Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yp.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><?php include "admin_header.inc.php" ; ?>
        </td>
      </tr>
      <tr>
          <td width="25%" valign="top" class="brown_bar"> 
            <?php  include "admin_left_bar.inc.php" ; ?>          </td>
          <td width="75%" height="400" align="center" valign="top">
		  <TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Manage Site Settings </span></TD>
            <TD width="15%" align="right">&nbsp;</TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
          </TABLE>
            <form method="post" action="site_settings.php" enctype="multipart/form-data">
              <table width="98%" border="0" cellpadding="2" cellspacing="1" class="darkBG">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF">
                      
                      <tr valign="middle">
                        <td width="48%" height="25" align="center" valign="top" bgcolor="#f7f7f7"><table width="98%" border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td><span class="mainBold">PLEASE ENTER SITE DETAILS: </span></td>
                          </tr>
                          <tr>
                            <td>Site Title : </td>
                            </tr>
                          <tr>
                            <td>
							<input name="site_title" type="text" class="textfield" id="site_title" style="width:300;" value="<?php echo stripslashes($ss_site_title)?>"></td>
                            </tr>
                          <tr>
                            <td>Site Address : </td>
                            </tr>
                          <tr>
                            <td><input name="site_address" type="text" class="textfield" id="site_address" style="width:300;" value="<?php echo stripslashes($ss_site_address)?>"></td>
                            </tr>
                          <tr>
                            <td>Email To : </td>
                          </tr>
                          <tr>
                            <td><textarea name="site_email_to" class="textfield" id="site_email_to" style="width:300;" ><?php echo stripslashes($ss_site_email_to)?></textarea></td>
                          </tr>
                          <tr>
                            <td>Email From : </td>
                          </tr>
                          <tr>
                            <td><textarea name="site_email_from" class="textfield" id="site_email_from" style="width:300;"><?php echo stripslashes($ss_site_email_from)?></textarea></td>
                            </tr>
                          <tr>
                            <td>Phone : </td>
                          </tr>
                          <tr>
                            <td><input name="site_phone" type="text" class="textfield" id="site_phone" style="width:300;" value="<?php echo stripslashes($ss_site_phone)?>"></td>
                          </tr>
                          <tr>
                            <td>Copyright : </td>
                          </tr>
                          <tr>
                            <td><textarea name="site_copyright" class="textfield" id="site_copyright" style="width:300;"><?php echo stripslashes($ss_site_copyright)?></textarea></td>
                          </tr>
                          <tr>
                            <td height="75">
							<?php if($ss_site_logo!=''){?>
								<img src="../uploadedfiles/real/<?php echo $ss_site_logo;?>">
							<?php }?>							</td>
                          </tr>
                          <tr>
                            <td><input name="logo_file" id="logo_file" type="file" class="textfield" size="34"></td>
                          </tr>
                          
                        </table></td>
                        <td width="52%" height="25" align="center" valign="top"><table width="98%" border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td colspan="2"><span class="mainBold">PLEASE ENTER META DETAILS: </span></td>
                          </tr>
                          <tr>
                            <td width="25%">Meta Title : </td>
                            <td width="75%"><input name="site_meta_title" type="text" class="textfield" id="site_meta_title" style="width:250;" value="<?php echo stripslashes($ss_site_meta_title)?>"></td>
                          </tr>
                          
                          <tr>
                            <td>Meta Author  : </td>
                            <td><input name="site_meta_author" type="text" class="textfield" id="site_meta_author" style="width:250;" value="<?php echo stripslashes($ss_site_meta_author)?>"></td>
                          </tr>
                          
                          <tr>
                            <td colspan="2">Meta Copyright  : </td>
                          </tr>
                          <tr>
                            <td colspan="2"><textarea name="site_meta_copyright" rows="4" class="textfield" id="site_meta_copyright" style="width:350;"><?php echo stripslashes($ss_site_meta_copyright)?></textarea></td>
                          </tr>
                          
                          <tr>
                            <td colspan="2">Meta Description  : </td>
                          </tr>
                          <tr>
                            <td colspan="2"><textarea name="site_meta_desc" rows="4" class="textfield" id="site_meta_desc" style="width:350;"><?php echo stripslashes($ss_site_meta_desc)?></textarea></td>
                          </tr>
                          <tr>
                            <td colspan="2">Meta Phrase : </td>
                          </tr>
                          <tr>
                            <td colspan="2"><textarea name="site_meta_phrase" rows="4" class="textfield" id="site_meta_phrase" style="width:350;"><?php echo stripslashes($ss_site_meta_phrase)?></textarea></td>
                          </tr>
                          <tr>
                            <td colspan="2">Meta Key Words : </td>
                          </tr>
                          <tr>
                            <td colspan="2"><textarea name="site_meta_words" rows="4" class="textfield" id="site_meta_words" style="width:350;"><?php echo stripslashes($ss_site_meta_words)?></textarea></td>
                          </tr>
                          
                        </table></td>
                      </tr>
                      


                      <tr align="center" valign="middle">
                        <td colspan="2"></td>
                      </tr>
                      <tr>
                        <td class="redbold" align="right">&nbsp;</td>
                        <td align="left">
						  <input type="submit" name="Submit" value="Submit" class="buttons">
                        <input name="site_logo" type="hidden" id="site_logo" value="<?php echo $ss_site_logo; ?>">
                        <input name="setting_id" type="hidden" id="setting_id" value="<?php echo $setting_id; ?>">
						
						</td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
          </form><br>
		  </td>
      </tr>
      <tr>
        <td colspan="3"><?php  include "admin_footer.inc.php" ; ?>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>