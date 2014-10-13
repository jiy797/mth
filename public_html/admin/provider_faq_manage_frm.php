<?php 
require "./includes/application_top.php";	

$admin_id=$_SESSION['admin_id'];
if ($admin_id=="")
{
	$msg="Session Expired. Please Login Again to Proceed.";
	$_SESSION['msg']=$msg;
	header("Location:index.php");
	exit();
}

$id		= $_GET['id'];
$faq_id = $_GET['faq_id'];

$provider_name=getSingleResult("select rec_name from yp_provider where rec_id='$id'");

if($faq_id!=""){
	$sql="select * from yp_provider_faq where faq_id='$faq_id'";
	$result=executeQuery($sql);

	if($line=mysql_fetch_array($result)){
		$question   = $line['question'];
		$answer     = $line['answer'];
	}
}

if($faq_id==''){
	$question   = $_SESSION['question'];
	$answer	    = $_SESSION['answer'];
}

include("../fckeditor/fckeditor.php") ;

?>

<html>
<head>
<title><?php echo $site_title;?>  Admin Manager</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../fckeditor/fckeditor.js"></script>

<SCRIPT LANGUAGE="JavaScript">
<!--

function validate(formObj)
{
	var error=''

	if(formObj.question.value==""){
		error +="Question.\n";
	}

	if(error !=''){
		alert ("Please input the following:\n\n"+error)
		return false
	}else
	{
			return true
	}
}
//-->
</SCRIPT>
<link href="css/yp.css" rel="stylesheet" type="text/css">
<body>
<table id="maintable" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
           <td colspan="2"  class="topper">
			<table cellspacing="0" border="0" cellpadding="0" width="100%">
			   <tr>
			   	<td> <?php  include "admin_header.inc.php" ; ?></td>
				</tr>
            </table>        </td>
      </tr>

        <tr>
          <td valign="top" class="inaltmax"> 
           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25%" valign="top" class="brown_bar"><?php  include "admin_left_bar.inc.php";?></td>
          <td width="75%" height="300" align="center" valign="top">

<TABLE WIDTH="98%" BORDER="0" CELLSPACING="2" CELLPADDING="2">
            <TR><TD width="85%"><span class="para_heading">Provider List : <?php echo stripslashes($provider_name)?> -> FAQ Add/Edit </span></TD>
            <TD width="15%" align="right"><a href="provider_faq_list.php?id=<?php echo $id?>" class="menu">[ BACK ] &nbsp;</a></TD>
            </TR>
            <TR><TD colspan="2" align="center"><?php echo "<span class='red'>".$_SESSION['sess_msg']."</span>"; unset($_SESSION['sess_msg']);?></TD>
            </TR>
  </TABLE>

            <table width="98%" border="0" cellpadding="1" cellspacing="0" class="darkBG" >
            <tr>
              <form action="provider_faq_manage.php" method="post" enctype="multipart/form-data" name="addNews" onSubmit="return validate(this)">
                <td>
                  <table width="100%" border="0" bgcolor="#FFFFFF" cellspacing="2" cellpadding="2">
                    <tr>
                      <td align="left" class="mainBold">&nbsp;</td>
                      <td align="left" class="red">(*required)</td>
                      <td class="red"></td>
                    </tr>
                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="16%" align="left" valign="top" class="text10_bold">Question</td>
                      <td width="82%"><textarea name="question" cols="80" rows="2" class="textfield" id="question"><?php echo stripslashes($question); ?></textarea></td>
                   </tr>
                    <tr>
                      <td align="right" valign="top" class="red">&nbsp;</td>
                      <td align="left" valign="top" class="mainBold">&nbsp;</td>
                      <td class="red">[PLEASE USE SHIFT+ENTER FOR NEXT LINE] </td>
                    </tr>
                    <tr>
                      <td width="2%" align="right" valign="top" class="red">*</td>
                      <td width="16%" align="left" valign="top" class="text10_bold">Answer</td>
                      <td width="82%"><textarea name="answer" id="answer"><?php echo stripslashes($answer); ?></textarea> 
					  <script type="text/javascript"> 
							window.onload = function() 
							{ 
							var oFCKeditor = new FCKeditor( 'answer' ) ; 
							oFCKeditor.BasePath  = "../fckeditor/" ; 
							oFCKeditor.ToolbarSet= 'Basic' ; 
							oFCKeditor.Height    = '300' ;
							oFCKeditor.ReplaceTextarea() ; 
							} 
					  </script></td>
                    </tr>
                   
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right">
							<input name="id" type="hidden" value="<?php echo $id; ?>">
							<input name="faq_id" type="hidden" value="<?php echo $faq_id; ?>">
					</td>
                    <td width="82%"><input type="submit" name="Submit" value="SUBMIT" class="buttons"></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </form>
            </tr>
          </table>
            <br>     </td>
      </tr>
	  </table>

        <tr>
		<td>
         <?php  include "admin_footer.inc.php" ; ?>		 </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
