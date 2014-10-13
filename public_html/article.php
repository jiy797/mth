<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Money Help</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content=" " />
	<meta name="description" content=" " />
	<meta name="author" content=" " />
	<meta name="copyright" content=" " />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/update.css" rel="stylesheet" type="text/css" />
	<?php include("i_javascripts.php"); ?>

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
                       <div class="breadcrumbs"><a href="#">Home</a> > Article</div>
                       <h1 style="margin-bottom:0px; padding:0px;">What is Lorem Ipsum?</h1>
                       <div class="date">Monday, Jul 15, 2008</div>

                       <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>

                       <p>Sed ut perspiciatis unde omnis iste natus error Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.  sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>

                       <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </p>


                       <br/>

                        <div style="background-color:#e6f2f5; padding:10px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                              <tr>
                                <td><img src="images/emailarticle.jpg" width="19" height="19" alt="" /></td>
                                <td class="smaller1"><a href="javascript:hide('postcomment');ajaxshow('#emailarticle');">Email Article</a></td>
                                <td><img src="images/postcomment.jpg" width="19" height="24" alt="" /></td>
                                <td class="smaller1"><a href="javascript:hide('emailarticle');ajaxshow('#postcomment');">Read/Post Comment</a></td>
                                <td><img src="images/printerfriendly.jpg" width="19" height="23" alt="" /></td>
                                <td class="smaller1"><a href="#">Printer Friendly</a></td>
                                <td><img src="images/pdf.jpg" width="16" height="19" alt="" /></td>
                                <td class="smaller1"><a href="#">PDF Version</a></td>
                              </tr>
                            </table>
                        </div>
                        <div style="background-color:#e6f2f5; padding:10px; display:none; padding:10px;" id="emailarticle">
                            <div style="background-color:#ffffff; padding:10px; color:#444444;">
                                <div class="fl"><p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;">Email This Article</p></div>
                                <div class="fr"><a href="javascript:hide('postcomment');hide('emailarticle');"><img src="images/close.gif" width="15" height="15" alt="" /></a></div>
                                <div class="clear"></div>
                                 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                 <div align="center">Friends Email:&nbsp;&nbsp;<input name="12" />&nbsp;&nbsp;<input type="button" name="" value="Submit" /></div>
                            </div>
                        </div>
                        <div style="background-color:#e6f2f5; padding:10px; display:none; padding:10px;" id="postcomment">
                            <div style="background-color:#ffffff; padding:10px; color:#444444;">
                                <div class="fl"><p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;">Post a Comment</p> </div>
                                <div class="fr"><a href="javascript:hide('postcomment');hide('emailarticle');"><img src="images/close.gif" width="15" height="15" alt="" /></a></div>
                                <div class="clear"></div>
                                 <p>Dolor sit amet, consectetuer adipiscing elit.</p>
                                 <table cellpadding="0" cellspacing="0" align="center">
                                   <tr>
                                     <td>Name:&nbsp;&nbsp;</td>
                                     <td><input name="12" style="width:300px;"/></td>
                                   </tr>
                                   <tr>
                                     <td>Comment:&nbsp;&nbsp;</td>
                                     <td><textarea name="" style="width:300px;"></textarea></td>
                                   </tr>
                                   <tr>
                                     <td>&nbsp;</td>
                                     <td align="right"><input type="button" name="" value="Submit" /></td>
                                   </tr>
                                 </table>
                                 <br/>
                                 <p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;">Read Comments</p>
                                 <div style="height:200px; overflow-y:scroll; overflow-x:hidden;">
                                   <p style="font-size:11px; line-height:16px;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><div class="linky">Posted by: Name Post Date: mm/dd/year</div>
                                   <p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;"><!-- --></p>
                                   <p style="font-size:11px; line-height:16px;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><div class="linky">Posted by: Name Post Date: mm/dd/year</div>
                                   <p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;"><!-- --></p>
                                   <p style="font-size:11px; line-height:16px;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><div class="linky">Posted by: Name Post Date: mm/dd/year</div>
                                   <p style="padding-bottom:3px; border-bottom:1px solid #dbdbdb; font-weight:bold;"><!-- --></p>
                                   <p style="font-size:11px; line-height:16px;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><div class="linky">Posted by: Name Post Date: mm/dd/year</div>
                                 </div>
                                 <p style="padding-bottom:3px; padding-top:8px; border-bottom:1px solid #dbdbdb; font-weight:bold;"><!-- --></p>

                            </div>
                        </div>
                       <br/>

                       <h1 style="margin-bottom:6px; padding:0px;">Related Articles</h1>

                       <table width="100%" cellpadding="0" cellspacing="0">
                         <tr><td colspan="3"><div style="border-bottom:1px solid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div></td></tr>
                         <tr>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                           <td width="10"></td>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                         </tr>
                         <tr><td colspan="3"><div style="border-bottom:1px solid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div></td></tr>
                         <tr>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                           <td width="10"></td>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                         </tr>
                         <tr><td colspan="3"><div style="border-bottom:1px solid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div></td></tr>
                         <tr>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                           <td width="10"></td>
                           <td valign="top">
                              <a href="#"><b>Dorenas Molenas</b></a><br/>
                              <div class="date1">06.15.2008</div>
                              Nullam lacus nunc, sollicitudiesit amet, vestibulum feugiat. suscpit fermentum<br/>
                           </td>
                         </tr>
                         <tr><td colspan="3"><div style="border-bottom:1px solid #dbdbdb; padding-top:10px; margin-bottom:10px;"><!--  --></div></td></tr>
                       </table>

                    </td>
                    <td width="15"><img src="images/blank.gif" width="15" height="1" alt="" /></td>
                    <td valign="top">
                        <?php include('i_ads.php'); ?>
                    </td>
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