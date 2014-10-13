<?php
function InsertData($table,$data_array){
	$sql="insert into ".$table."(";
	$ctr=0;
	$fields="";
	$values=" values(";
	while(list($key,$value)=each($data_array)){
		$fields.=$key;
		$values.="'".$value."'";
		$ctr++;
		if(count($data_array)>$ctr){
			$fields.=",";
			$values.=",";
		}
	}
	$fields.=")";
	$values.=")";
	$sql.=$fields.$values;
	//echo "<br>$sql<br>";

	executeQuery($sql);
}

function UpdateData($table,$data_array,$condition_string=''){
	$sql="update ".$table." set ";
	$ctr=0;
	$update_string="";
	while(list($key,$value)=each($data_array)){
		$update_string.=$key." = '".addslashes($value)."'";
		$ctr++;
		if(count($data_array)>$ctr){
			$update_string.=", ";			
		}
	}
	$sql.=$update_string;
	
	if($condition_string!=""){
		$where_exists=strstr($condition_string, " where ");
		if($where_exists==true){
			$sql.=$condition_string;
		}else{
			$sql.=" where ".$condition_string;
		}
	}
	executeQuery($sql);
}

function GetMax($table,$field,$condition_string=''){
	$sql="select max(".$field.") from ".$table;
	if($condition_string!=""){
		$where_exists=strstr($condition_string,"where");
		if($where_exists==true){
			$sql.=$condition_string;
		}else{
			$sql.=" where ".$condition_string;
		}
	}
	return getSingleResult($sql);
}

function GetSingleValue($table,$field,$condition_string=''){
	$sql="select ".$field." from ".$table;
	if($condition_string!=""){
		$where_exists=strstr($condition_string, "where");
		if($where_exists==true){
			$sql.=$condition_string;
		}else{
			$sql.=" where ".$condition_string;
		}
	}
	return getSingleResult($sql);
}

function DisplayCategory($catid='',$sep='',$pcatid=0,$selected=''){
	$sql="select category_id, category_name from yp_category where parent_cat_id='$pcatid' and category_status='Active' order by category_name";
	$result=executeQuery($sql);
	//echo "<br>$sql<br>";
	//exit();
	while($line=mysql_fetch_array($result)){
		$combo="<option value=".$line['category_id'];
		if($line['category_id']==$selected){
			$combo.=" selected";
		}
		$combo.=">$sep".$line['category_name']."</option>";
		//$sql="select count(category_id) from yp_category where parent_cat_id='".$line['category_id']."'";
		//$pcount=getSingleResult($sql);
		//if($pcount>0){
		//	$parent_cat_id=$line['category_id'];
		//	$sep.="&raquo;";
		echo $combo;
			DisplaySubCategory($line['category_id'],$sep,$parent_cat_id,$selected);
		//}
	}
	//echo $combo;
	//exit();
	//return  $combo;
}
function DisplaySubCategory($subid,$sep,$pcid,$subselected=''){
	$sep.="&raquo;";
	$sql="select * from yp_category where parent_cat_id='$subid' and category_status='Active' order by category_name";
	$r1=executeQuery($sql);
	
	while($lr=mysql_fetch_array($r1)){
		$nu= "<option value='".$lr['category_id']."'";
		if($lr['category_id']==$subselected){
			$nu.= " selected ";
		}
		$nu.=">$sep&nbsp;".$lr['category_name']."&nbsp;</option>";
		echo $nu;
		DisplaySubCategory($lr['category_id'],$sep,$pcid,$subselected);
	}
}

function DisplayParentCategory($id,$pcatid=0,$selected=''){
	global $arr_category;
	global $c;
	$c=0;
	$sql="select category_id from yp_category where category_id='$id' ";
	$fid=getSingleResult($sql);

	$sql="select category_name from yp_category where category_id='$id' ";
	$fname=getSingleResult($sql);

	$arr_category[$fid]=$fname;

	$sql="select category_id, category_name from yp_category where parent_cat_id='$pcatid' ";
	$result=executeQuery($sql);
	$c++;
	while($line=mysql_fetch_array($result)){
		$arr_category[$line['category_id']]=$line['category_name'];
		$c++;

		DisplaySubPCategory($line['category_id'],$c);			
	}

	return  $arr_category;
}
function DisplaySubPCategory($subid,$counter){
	global $arr_category;

	$sep.="&raquo;";
	$sql="select * from yp_category where parent_cat_id='$subid' ";
	$r1=executeQuery($sql);
	
	while($lr=mysql_fetch_array($r1)){
		$arr_category[$lr['category_id']]=$lr['category_name'];
		$counter++;
		DisplaySubPCategory($lr['category_id'],$counter);
	}
}

function DisplayResCategory($catid='',$sep='',$pcatid=0,$selected=''){
	$sql="select category_id, category_name from yp_resource_category where parent_cat_id='$pcatid' and category_status='Active' order by category_name";
	$result=executeQuery($sql);
	//echo "<br>$sql<br>";
	//exit();
	while($line=mysql_fetch_array($result)){
		$combo="<option value=".$line['category_id'];
		if($line['category_id']==$selected){
			$combo.=" selected";
		}
		$combo.=">$sep".$line['category_name']."</option>";
		//$sql="select count(category_id) from yp_category where parent_cat_id='".$line['category_id']."'";
		//$pcount=getSingleResult($sql);
		//if($pcount>0){
		//	$parent_cat_id=$line['category_id'];
		//	$sep.="&raquo;";
		echo $combo;
			DisplaySubResCategory($line['category_id'],$sep,$parent_cat_id,$selected);
		//}
	}
	//echo $combo;
	//exit();
	//return  $combo;
}
function DisplaySubResCategory($subid,$sep,$pcid,$subselected=''){
	$sep.="&raquo;";
	$sql="select * from yp_resource_category where parent_cat_id='$subid' and category_status='Active' order by category_name";
	$r1=executeQuery($sql);
	
	while($lr=mysql_fetch_array($r1)){
		$nu= "<option value='".$lr['category_id']."'";
		if($lr['category_id']==$subselected){
			$nu.= " selected ";
		}
		$nu.=">$sep&nbsp;".$lr['category_name']."&nbsp;</option>";
		echo $nu;
		DisplaySubResCategory($lr['category_id'],$sep,$pcid,$subselected);
	}
}

function DisplayCategoryLang($catid='',$sep='',$pcatid=0,$selected='', $lang=''){
	$sql="select category_id, category_name, category_name_fr from yp_category where parent_cat_id='$pcatid' and category_status='Active' order by category_name";
	$result=executeQuery($sql);
	//echo "<br>$sql<br>";
	//exit();
	while($line=mysql_fetch_array($result)){
		$combo="<option value=".$line['category_id'];
		if($line['category_id']==$selected){
			$combo.=" selected";
		}
		$combo.=">$sep".$line['category_name'.$lang]."</option>";
		//$sql="select count(category_id) from yp_category where parent_cat_id='".$line['category_id']."'";
		//$pcount=getSingleResult($sql);
		//if($pcount>0){
		//	$parent_cat_id=$line['category_id'];
		//	$sep.="&raquo;";
		echo $combo;
			DisplaySubCategoryLang($line['category_id'],$sep,$parent_cat_id,$selected, $lang);
		//}
	}
	//echo $combo;
	//exit();
	//return  $combo;
}
function DisplaySubCategoryLang($subid,$sep,$pcid,$subselected='', $lang=''){
	$sep.="&raquo;";
	$sql="select * from yp_category where parent_cat_id='$subid' and category_status='Active' order by category_name";
	$r1=executeQuery($sql);
	
	while($lr=mysql_fetch_array($r1)){
		$nu= "<option value='".$lr['category_id']."'";
		if($lr['category_id']==$subselected){
			$nu.= " selected ";
		}
		$nu.=">$sep&nbsp;".$lr['category_name'.$lang]."&nbsp;</option>";
		echo $nu;
		DisplaySubCategoryLang($lr['category_id'],$sep,$pcid,$subselected, $lang);
	}
}

function DeleteParentCategory($id,$pcatid=0,$selected=''){
	global $arr_category;
	global $c;
	$c=0;
	$sql="select category_id from yp_category where category_id='$id' ";
	$fid=getSingleResult($sql);

	$sql="select category_name from yp_category where category_id='$id' ";
	$fname=getSingleResult($sql);

	$arr_category[$fid]=$fname;

	$sql="select category_id, category_name from yp_category where parent_cat_id='$pcatid' ";
	$result=executeQuery($sql);
	$c++;
	while($line=mysql_fetch_array($result)){
		$arr_category[$line['category_id']]=$line['category_name'];
		$c++;

		DeleteSubCategory($line['category_id'],$c);			
	}

	return  $arr_category;
}
function DeleteSubCategory($subid,$counter){
	global $arr_category;

	$sep.="&raquo;";
	$sql="select * from yp_category where parent_cat_id='$subid' ";
	$r1=executeQuery($sql);
	
	while($lr=mysql_fetch_array($r1)){
		$arr_category[$lr['category_id']]=$lr['category_name'];
		$counter++;
		DeleteSubCategory($lr['category_id'],$counter);
	}
}


function deleteCategory($fid, $remove_images='No'){
	$category_id = $fid;
	if($category_id!=""){
		$sql_f			=   "select * from yp_category where parent_cat_id='$category_id'"; 	
		$res_f			=   executeQuery($sql_f);

		if($line_f  = mysql_fetch_array($res_f)){
			$f_id	= $line_f['category_id'];
	
			$arr_fo=DeleteParentCategory($category_id,$category_id);

			$arr_f=array_reverse($arr_fo,TRUE);

			foreach($arr_f as $fol_id => $fol_name){
				//$sql_products		=   "select * from yp_products where category_id='$fol_id'";  
				$sql_products		=   "select * from yp_product_cat where category_id='$fol_id'";  
				$res_products		=   executeQuery($sql_products);
				while($line_products=mysql_fetch_array($res_products)){
					//---------------------------Remove Images----------------------
					if($remove_images=='Yes'){
						$image_real =  getSingleResult("select image_real from yp_products product_id = '".$line_products['product_id']."' ");
						$image_thumb =  getSingleResult("select image_thumb from yp_products product_id = '".$line_products['product_id']."' ");
						@unlink($SITE_FS_PATH."uploadedfiles/real/".$image_real);
						@unlink($SITE_FS_PATH."uploadedfiles/thumb/".$image_thumb);
					}
					//---------------------------Remove Images----------------------
					$sql="delete from yp_products where product_id = '".$line_products['product_id']."'";
					executeQuery($sql);
				}
				$sql="delete from yp_product_cat where category_id = '".$fol_id."'";
				executeQuery($sql);
				$sql="delete from yp_category where category_id = '".$fol_id."'";
				executeQuery($sql);
			}
		}else{
				$sql_products		=   "select * from yp_product_cat where category_id='$category_id'";  
				$res_products		=   executeQuery($sql_products);
				while($line_products=mysql_fetch_array($res_products)){
					//---------------------------Remove Images----------------------
					if($remove_images=='Yes'){
						$image_real =  getSingleResult("select image_real from yp_products product_id = '".$line_products['product_id']."' ");
						$image_thumb =  getSingleResult("select image_thumb from yp_products product_id = '".$line_products['product_id']."' ");
						@unlink($SITE_FS_PATH."uploadedfiles/real/".$image_real);
						@unlink($SITE_FS_PATH."uploadedfiles/thumb/".$image_thumb);
					}
					//---------------------------Remove Images----------------------
					$sql="delete from yp_products where product_id = '".$line_products['product_id']."'";
					executeQuery($sql);
				}
				$sql="delete from yp_product_cat where category_id = '".$category_id."'";
				executeQuery($sql);

				$sql="delete from yp_category where category_id = '".$category_id."'";
				executeQuery($sql);
		}
	} //end if
}

?>