<script defer type="text/javascript" src="<?php echo $ROOT_PATH?>toggle.js"></script>

<script language=javascript>
var url = window.location;
var title = document.title;
var os;
if(document.layers)
 os = "n4";
else if(document.getElementById&&!document.all)
 os = "n6";
else if(document.all)
 os = "ie";

function bookmark(title,url){
	if(window.sidebar) 
          window.sidebar.addPanel(title,url,"");
	else if(window.opera && window.print){
          var elem = document.createElement('a');
          elem.setAttribute('href',url);
          elem.setAttribute('title',title);
          elem.setAttribute('rel','sidebar');
          elem.click();
	}
	else if(os == "ie")
          window.external.AddFavorite(url,title);
}
</script>

<div class="header-bg0">
    <div class="containit">
         <table cellpadding="0" cellspacing="0" width="992" height="100%">
           <tr>
             <td class="shadow-left"><!--  --></td>
             <td class="maincenter">
                <div class="header-bg">
                  <div style="padding-left:20px; padding-top:2px; padding-bottom:0px; padding-right:30px;">
                    <div class="fl" style="padding-top:22px;"><a href="<?php echo $non_secure_path?>index.php"><?php if($site_logo!=''){?><img src="<?php echo $non_secure_path?>uploadedfiles/real/<?php echo $site_logo?>"><?php }else{?><img src="images/est_logo1.png" width="352" height="74"  alt=""/><?php }?></a></div>
                    <div class="fr" align="right">
                        <a href="#" onClick="javascript:window.open('<?php echo $non_secure_path?>send_to_friend.php?pid=<?php echo $pid;?>','','width=520,height=400')">Tell a Friend</a>   &nbsp;|&nbsp;   <a href="javascript:bookmark('Money Transfer Help', '<?php echo $non_secure_path?>index.php')">Bookmark Us!</a>   &nbsp;|&nbsp;  <a href="<?php echo $non_secure_path?>faq.php">Help</a><br/>
                        <img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="5" alt="" /><br/>

                        <?php include("i_ads_top.php");?>
						<br />

                    </div>
                    <div class="clear"></div>

                    <div class="fl search" style="padding-top:25px; padding-left:10px; width:160px;">
                        <h3>Search Site:</h3>
                        <img src="<?php echo $non_secure_path?>images/blank.gif" width="1" height="7" alt="" /><br/>
                        <div class="fl" style="padding-right:10px;"><input name="1" style="width:110px;"/></div>
                        <div class="fr"><a href="#"><img src="<?php echo $non_secure_path?>images/gosearch.gif" width="34" height="22" alt="" /></a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="mainmenu fl">
                        <table cellspacing="0" cellpadding="0">
						  <?php
							
							if($mp==''){ $mp=$_SESSION['mp']; }
							if($mp==''){ $mp=$mp_index; }
							unset($_SESSION['mp']);
							$_SESSION['mp']=$mp;

							if($mp=='HOME'){
								$tdHClass="menuon-right";
								$divHClass="menuon-left";
							}else{
								$tdHClass="menuoff-right";
								$divHClass="menuoff-left";
							}

							if($mp=='LEARNINGCENTER'){
								$tdLClass="menuon-right";
								$divLClass="menuon-left";
							}else{
								$tdLClass="menuoff-right";
								$divLClass="menuoff-left";
							}

							if($mp=='REVIEWS'){
								$tdRClass="menuon-right";
								$divRClass="menuon-left";
							}else{
								$tdRClass="menuoff-right";
								$divRClass="menuoff-left";
							}

							if($mp=='COMPARESERVICES'){
								$tdCSClass="menuon-right";
								$divCSClass="menuon-left";
							}else{
								$tdCSClass="menuoff-right";
								$divCSClass="menuoff-left";
							}

							if($mp=='RESOURCES'){
								$tdRSClass="menuon-right";
								$divRSClass="menuon-left";
							}else{
								$tdRSClass="menuoff-right";
								$divRSClass="menuoff-left";
							}
						  ?>
                          <tr>
                            <td class="<?php echo $tdHClass?>"><div class="<?php echo $divHClass?>"><a href="<?php echo $non_secure_path?>index.php">Home</a></div></td>
                            <td width="1"></td>
                            <td class="<?php echo $tdLClass?>"><div class="<?php echo $divLClass?>"><a href="<?php echo $non_secure_path?>learning-center.php">Learning Center</a></div></td>
                            <td width="1"></td>
                            <td class="<?php echo $tdRClass?>"><div class="<?php echo $divRClass?>"><a href="<?php echo $non_secure_path?>reviews.php">Reviews</a></div></td>
                            <td width="1"></td>
                            <td class="<?php echo $tdCSClass?>"><div class="<?php echo $divCSClass?>"><a href="<?php echo $non_secure_path?>compare.php">Compare Services</a></div></td>
                            <td width="1"></td>
                            <td class="<?php echo $tdRSClass?>"><div class="<?php echo $divRSClass?>"><a href="<?php echo $non_secure_path?>resources.php">Resources & Tools</a></div></td>
                            <td width="1"></td>                            
                            <td class="menuoff-right"><div class="menuoff-left"><a href="#">Forum</a></div></td>
                          </tr>
                        </table>
                        <div class="clear"><!--  --></div>
                        <div class="submenue">

						<?php
							//$mp=$_GET['mp'];

						$sql_np="select * from yp_new_pages where status='Active' and show_status='Active' and mainpage='".$_SESSION['mp']."' order by page_title";
						$res_np=executeQuery($sql_np);

						$i_l = '0';
						while($lin_np=mysql_fetch_array($res_np)){
							if($i_l==0){
								echo "<a href='".$non_secure_path."pages_frm.php?pid=".$lin_np['page_id']."'>".stripslashes($lin_np['page_title'])."</a>";
							}else{
								echo "&nbsp;|&nbsp;<a href='".$non_secure_path."pages_frm.php?pid=".$lin_np['page_id']."'>".stripslashes($lin_np['page_title'])."</a>";
							}
							 $i_l++;
						}
						?>
					</div>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
             </td>
             <td class="shadow-right"><!--  --></td>
           </tr>
         </table>
    </div>
</div>