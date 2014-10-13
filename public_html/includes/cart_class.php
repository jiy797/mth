<?php

	class order
	{
		var $order_id;
		var $tax;
		var $shipping_cost;
		var $order_placed_status;
		var  $cart;

		function order($cart , $order_id  , $tax , $shipping_cost )
		{
			$this->cart = $cart					  ;
			$this->order_id = $order_id			  ;
			$this->tax = $tax					  ;
			$this->shipping_cost= $shipping_cost  ;
		}

		function  setOrderPlaceStatus($order_placed_status)
		{
			$this->order_placed_status=$order_placed_status;
		}
		function  getPlacedOrderStatus()
		{
			return	$this->order_placed_status;
		}
		function  setTax($tax)
		{
			$this->tax=$tax;
		}
		function  getTax($tax)
		{
			return	$this->tax;
		}
		
		function setOrderID($order_id)
		{
			$this->order_id = $order_id;
		}
		function getOrderID($order_id)
		{
			return $this->order_id;
		}
		function setShippingCost($shipping_cost)
		{
			$this->shipping_cost =$shipping_cost;
		}
		function getShippingCost()
		{
			return $this->shipping_cost;
		}
	}	

	class cart
	{
		var $cart ;
		function  cart()
		{
			$this->cart = array();
		}

		
	
		function get_item_total()
		{
			$cart_total_price_sum=0.00;
			foreach($this->cart as $key => $item)
			{
				$cart_total_price_sum+= ($item->price)* ($item->quantity);	
			}
		    $cart_total_price_sum = $cart_total_price_sum ;
			return $cart_total_price_sum; 
		}

		function get_total_items_in_cart()
		{
			foreach($this->cart as $key => $item)
			{
				$cart_total_quantity+= ($item->quantity);
			}
			return $cart_total_quantity; 
		}


		function calculate_tax($userid )
		{
			$sql="select state from ebook_user_register where userid='$userid and country='United States'  and state='texas'";
			$res = 	getSingleResult($sql);
			if($res!='')
			{
				$total_amount = $this->getTotalAmount();
				$tax = 	$total_amount*(.0825);

				$total_amount = $total_amount + $tax ;
			}
			else
			{
				$tax=0;
			}
		}

		function addItemInCart($item_object){
			$this->cart[$this->getTotalItemInCart()]=$item_object;
		}


		function removeItemInCart($product_id)
		{
			unset($this->cart["$product_id"]);
			return $msg;
		}
		function updateItem($product_id, $quantity ,  $price)
		{
		////	echo "<br> in updateItemQuantity";
			$is_updated = "false";

			foreach($this->cart as $key => $item)
			{
				$item=$this->cart[$product_id];
				////echo  "<br> >>>>>>>>>>>>>>##############################product_id ".$product_id . " , key ".$key;
				if($key==$product_id)
				{
			////		echo	"<br> Item Found  in updateItem  ".$quantity;
					if(intval($quantity)!=0)
					{
						$item->setQuantity(intval($quantity));
						////echo "<br> new  Quantity Updated method =>>>>>>> ".$quantity." , item_object   ".$item_object . 	"   ,, key = ".$key;
						$res="true";
					}
					
					if(doubleval($price)!="")
					{
						$item->setColor($price);
						$res="true";
					}
				}
			}
		}
		
		function getTotalAmount()
		{
			$cart_total_price_sum=0.00;
			foreach($this->cart as $key => $item)
			{
				$cart_total_price_sum+= ($item->price)* ($item->quantity);	
			}
			$cart_total_price_sum  = $cart_total_price_sum ;
			return $cart_total_price_sum; 
		}

		function getTotalWeight()
		{
			$cart_total_weight=0.00;
			
			foreach($this->cart as $key => $item_object)
			{
				$cart_total_weight+=   $item_object->getWeight() * $item_object->getQuantity();	
			}
			return $cart_total_weight; 
		}
				
		function getTotalItemInCart()
		{
			return count($this->cart); 	
		}
		
		function checkItemExistsInCart($product_id,$attribute){
			$is_exists="false";
			foreach($this->cart as $item_object)
			{
				if($item_object->getProductCode()==$product_id){
					//echo "<br>product_id ---$product_id<br>";

					if(in_array($item_object->getAttributes(),$attribute)){
						//echo "inside cart true<br>";
					//	exit();
						$is_exists ="true";
						break;
					}
				}	
			}
			//echo "<br>$is_exists";
			//exit();
			return  $is_exists; 
		}
		function addToCart($item_object_to_add,$attribute){
			$counter =0;
			$is_exists="false";
			foreach($this->cart as  $item_object){
				if($item_object->product_id==$item_object_to_add->product_id){
					if(count($attribute)>0){
						if(!array_diff($item_object_to_add->getAttributes(),$item_object->getAttributes())){
							$is_exists ="true";
							$item_object->quantity +=$item_object_to_add->quantity;
							$this->cart[$counter]=$item_object;
							break;
						}
					}else{
						$is_exists ="true";
						$item_object->quantity +=$item_object_to_add->quantity;
						$this->cart[$counter]=$item_object;
						break;
					}
				}	
				$counter++;

			}
			if ($is_exists == "false"){
				$this->addItemInCart($item_object_to_add);
			}
			//session_unregister("cart");
			unset($_SESSION['cart']);
			if(!isset($_SESSION['cart'])){
			$_SESSION['cart']=$this;
			}
			//session_register("cart");

		}

///	get_shipping($userid , $shipping_id);

	function get_total_items()
	{
		$total_quantity = 0;
		foreach($this->cart as $key=>$value)
		{
			$total_quantity += $value->quantity;	
		}
		return $total_quantity;
	}

/*
   session_register('shipping_id');
   session_register('usa_priority_sub');
   session_register('usa_express_sub');

   shipping_id VALUE="usa_priority" 	   
	   usa_priority_sub" value="usa_priority_mail_insurance"
	   usa_priority_sub" value="usa_insurance_optional"
   
   shipping_id" VALUE="usa_express_mail"
		   usa_express_sub" value="usa_express_mail_insurance" 

   shipping_id other

*/

	function get_shipping($userid,$shipping_id,$user_shipping_id,$usa_priority_sub, $usa_express_sub)
	{
		$shipping			=	0.00;
		$total_items		=	$this->get_total_items();
		$total_purchase		=	$this->get_item_total();
/*
		echo "<br> total_items----		$total_items <br>";		
		echo "<br> user_shipping_id----	$user_shipping_id <br>";
		echo "<br> usa_priority_sub---- $usa_priority_sub <br>";
		echo "<br> usa_express_sub----	$usa_express_sub <br>";
		echo "<br> userid----			$userid <br>";
*/
		
		$sql="select country from ebook_order_shipping where shipping_id='$user_shipping_id'";		
		$shipping_country  =  getSingleResult($sql);

		$item_shipping_cost=0;
		$total_shipping=0;

		if($shipping_country=="United States")
		{
	///		echo "<br> country is usa <br>";
			
			if($shipping_id=="usa_priority")
			{
				if($total_items==1)
				{
		////			 echo "<br> general total items 1 <br>";
					 $item_shipping_cost =4;
				}
				else if($total_items==2)
				{
			/////			echo "<br> @@@@@@@ general total items 2 <br>";
					 $item_shipping_cost =5;
				}
				else if($total_items>2 && $total_items<5)
				{
				////		echo "<br> general total 2-5 items   <br>";
				   $item_shipping_cost =	10;	
				}
				else if($total_items>=5)
				{
			///		 echo "<br> general total items >5 <br>";
					 $item_shipping_cost =15;
				}
				if($usa_priority_sub=="usa_insurance_optional")
				{
					if($total_purchase>=0.1 &&  $total_purchase<=49.99 )
					{
				////			echo "<br> usa_insurance_optional >1 and < than 49.99 <br>";
						  $shipping_cost=1.50;
						  $total_shipping = $shipping_cost +  $item_shipping_cost ;
						  return $total_shipping;	
					}
					else if( $total_purchase >=50) // && $total_purchase <= 100  )
					{
					///	 echo "<br> usa_insurance_optional >50  && < than 100  <br>";
						  $shipping_cost= 2.50 ;
						  $total_shipping = $shipping_cost +  $item_shipping_cost ;
						  return $total_shipping;
					}
				 }
				 else if($usa_priority_sub=="usa_priority_mail_insurance")
				 {
					if( $total_purchase >=50 )//&& $total_purchase >=100  )
					{
///						echo "<br> usa_insurance_optional >50  && <100  <br>";
						  $shipping_cost= 2.50 ;
						  $total_shipping = $shipping_cost +  $item_shipping_cost ;
						  return $total_shipping;	
					}
				 }
				 return $item_shipping_cost;
			}
			if($usa_express_mail=="usa_express_mail")
			{
				$total_shipping =20;
				if($usa_express_sub=="usa_express_mail_insurance")
				{
					  $total_shipping = $total_shipping  +  1  ;
					  return $total_shipping;
				}
			  return $total_shipping;
			}
		}
		else if($shipping_country=="Canada")
		{
	////				echo "<br>total_items--- canada  $total_items <br>";
				if($total_items==1)
				{
////					echo "<br>total_items---  $total_items <br>";
					return $shipping_cost =4;
				}
				else if($total_items==2)
				{
////						echo "<br>total_items---  $total_items <br>";
					return $shipping_cost =5;
				}
				else if($total_items>2 && $total_items<5)
				{
////						echo "<br> total_items---  $total_items <br>";
					return $shipping_cost =	14;
				}
				else if($total_items>=5)
				{
				/////		echo "<br> total_items--->5  $total_items <br>";
					return $shipping_cost =20;
				}
		}
		else 
		{
			$sql="select country from ebook_shipping where country='$shipping_country'";

///			echo "<br> $sql <br>";
			$res = getSingleResult($sql);
			if($res!='')
			{
	/////			echo "<br>  found in selected country  <br>";
				return $shipping_cost = 10;
			}
			else
			{
				return $shipping_cost = 20;
			}	
		}
		return $shipping_cost; 	
	}
}

class product
{
		var $price;
		var $product_id;
		var $quantity;
		var $product_name;
		var $attributes;
		var $weight;

	/*	function product()
		{
			$this->weight=0.00;
			$this->color="";
			$this->price=0.00;
		}
		*/

		function Product($product_id , $product_name , $price, $attributes, $quantity, $weight )
		{
			$this->product_id=$product_id;
			
			$this->price=$price;
			$this->attributes=$attributes;
			$this->quantity=$quantity;
			$this->weight=$weight;
			$this->product_name=$product_name;
		}
	     function setQuantity($qty)                  /*   Quantity */ 
		{
			 $this->quantity = $qty;
		}
		function getQuantity()
		{
			return $this->quantity;
		}
		function setProductCode()                  /*   product Code */ 
		{
			 $this->product_id = $product_id;
		}
		function getProductCode()
		{
			return $this->product_id;
		}
		
		function setPrice($price)            /*    price  */
		{
			 $this->price = $price;
		}
		function getPrice()
		{
			return $this->price;
		}
		
		function setAttributes($attributes)            /*   Attributes  */
		{
			 $this->attributes = $attributes;
		}
		function getAttributes()
		{
			return $this->attributes;
		}
		function getWeight()				/*   Weight  */
		{
			return $this->weight;
		}
		function setWeight()
		{
			$this->weight = $weight;
		}
		function getProductTotal()
		{
			return $this->price*quantity;
		}
		
}
?>
