<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Cart_model extends My_Model
{

	public function add_cart($dataArr=''){
		$this->db->insert(PRODUCT,$dataArr);
	}

	public function edit_cart($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(PRODUCT,$dataArr);
	}


	public function view_cart($condition=''){
		return $this->db->get_where(PRODUCT,$condition);
			
	}


	public function mani_cart_view($userid=''){

		$MainShipCost = 0;
		$MainTaxCost = 0; $cartQty = 0;


		$shipVal = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid));

		if($shipVal -> num_rows() >0 ){

			$shipValID = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid, 'primary' => 'Yes'));
			$dataArr = array('shipping_id' => $shipValID->row()->id);
			$condition = array('user_id' => $userid);
			$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition);
			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $shipValID->row()->country));

			$MainShipCost = $ShipCostVal->row()->shipping_cost;
			$MainTaxCost = $ShipCostVal->row()->shipping_tax;
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $MainTaxCost);
			$this->cart_model->update_details(SHOPPING_CART,$dataArr2,$condition);
		}

		$GiftValue = ''; $CartValue = ''; $SubscribValue = '';

		$giftSet = $this->cart_model->get_all_details(GIFTCARDS_SETTINGS,array( 'id' => '1'));
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));

		$SubcribRes = $this->minicart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));

		$this->db->select('a.*,b.product_name,b.quantity as mqty,b.seourl,b.image,b.id as prdid,b.price as orgprice,b.ship_immediate,c.attr_name as attr_type,d.attr_name');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(PRODUCT.' as b' , 'b.id = a.product_id');
		$this->db->join(SUBPRODUCT.' as d' , 'd.pid = a.attribute_values','left');		
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = d.attr_id','left');		
		$this->db->where('a.user_id = '.$userid);
		$cartVal = $this->db->get();
		
		$this->db->select('discountAmount,couponID,couponCode,coupontype');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$discountQuery = $this->db->get();
		
		$disAmt = $discountQuery->row()->discountAmount;

		/**Lanuage Transalation**/
			
		if($this->lang->line('cart_product') != '')
		$cart_product =  stripslashes($this->lang->line('cart_product'));
		else
		$cart_product =  "Product";

		if($this->lang->line('giftcard_price') != '')
		$giftcard_price =  stripslashes($this->lang->line('giftcard_price'));
		else
		$giftcard_price =  "Price";
			
		if($this->lang->line('product_quantity') != '')
		$product_quantity =  stripslashes($this->lang->line('product_quantity'));
		else
		$product_quantity =  "Quantity";


		if($this->lang->line('purchases_total') != '')
		$purchases_total =  stripslashes($this->lang->line('purchases_total'));
		else
		$purchases_total =  "Total";
			
		if($this->lang->line('product_remove') != '')
		$product_remove =  stripslashes($this->lang->line('product_remove'));
		else
		$product_remove =  "Remove";
			
		if($this->lang->line('giftcard_reci_name') != '')
		$giftcard_reci_name =  stripslashes($this->lang->line('giftcard_reci_name'));
		else
		$giftcard_reci_name =  "Recipient name";
			
		if($this->lang->line('giftcard_rec_email') != '')
		$giftcard_rec_email =  stripslashes($this->lang->line('giftcard_rec_email'));
		else
		$giftcard_rec_email =  "Recipient e-mail";
			
		if($this->lang->line('giftcard_message') != '')
		$giftcard_message =  stripslashes($this->lang->line('giftcard_message'));
		else
		$giftcard_message =  "Message";
			
		if($this->lang->line('choose_shipping_address') != '')
		$choose_shipping_address =  stripslashes($this->lang->line('choose_shipping_address'));
		else
		$choose_shipping_address =  "Choose Your Shipping Address";

		if($this->lang->line('delete_this_address') != '')
		$delete_this_address =  stripslashes($this->lang->line('delete_this_address'));
		else
		$delete_this_address =  "Delete this address";

		if($this->lang->line('addnew_shipping_address') != '')
		$addnew_shipping_address =  stripslashes($this->lang->line('addnew_shipping_address'));
		else
		$addnew_shipping_address =  "Add new shipping address";
			
		if($this->lang->line('continue_payment') != '')
		$continue_payment =  stripslashes($this->lang->line('continue_payment'));
		else
		$continue_payment =  "Continue to Payment";
			
		if($this->lang->line('checkout_item_total') != '')
		$checkout_item_total =  stripslashes($this->lang->line('checkout_item_total'));
		else
		$checkout_item_total =  "Item total";
			
		if($this->lang->line('update') != '')
		$update =  stripslashes($this->lang->line('update'));
		else
		$update =  "Update";
			
		if($this->lang->line('referrals_shipping') != '')
		$referrals_shipping =  stripslashes($this->lang->line('referrals_shipping'));
		else
		$referrals_shipping =  "Shipping";

		if($this->lang->line('shipping_speed') != '')
		$shipping_speed =  stripslashes($this->lang->line('shipping_speed'));
		else
		$shipping_speed =  "Shipping Speed";
			
		if($this->lang->line('items_in_shopping') != '')
		$items_in_shopping =  stripslashes($this->lang->line('items_in_shopping'));
		else
		$items_in_shopping =  "items in shopping cart";
			
		if($this->lang->line('order_from') != '')
		$order_from =  stripslashes($this->lang->line('order_from'));
		else
		$order_from =  "Order from";
			
		if($this->lang->line('merchant') != '')
		$merchant =  stripslashes($this->lang->line('merchant'));
		else
		$merchant =  "Merchant";
			
		if($this->lang->line('header_ship_within') != '')
		$header_ship_within =  stripslashes($this->lang->line('header_ship_within'));
		else
		$header_ship_within =  "Ships within 1-3 business days";

		if($this->lang->line('shopping_cart_empty') != '')
		$shopping_cart_empty =  stripslashes($this->lang->line('shopping_cart_empty'));
		else
		$shopping_cart_empty =  "Your Shopping Cart is Empty";

		if($this->lang->line('dont_miss') != '')
		$dont_miss =  stripslashes($this->lang->line('dont_miss'));
		else
		$dont_miss =  "Don`t miss out on awesome sales right here on";

		if($this->lang->line('shall_we') != '')
		$shall_we =  stripslashes($this->lang->line('shall_we'));
		else
		$shall_we =  "Let`s fill that cart, shall we?";

		if($this->lang->line('checkout_tax') != '')
		$checkout_tax =  stripslashes($this->lang->line('checkout_tax'));
		else
		$checkout_tax =  "Tax";

		if($this->lang->line('gift') != '')
		$gift =  stripslashes($this->lang->line('gift'));
		else
		$gift =  "Gift";
			
			
		if($this->lang->line('order_is_gift') != '')
		$order_is_gift =  stripslashes($this->lang->line('order_is_gift'));
		else
		$order_is_gift =  "This order is a gift";

		if($this->lang->line('coupon_codes') != '')
		$coupon_codes =  stripslashes($this->lang->line('coupon_codes'));
		else
		$coupon_codes =  "Coupon Codes";

		if($this->lang->line('checkout_order') != '')
		$checkout_order =  stripslashes($this->lang->line('checkout_order'));
		else
		$checkout_order =  "Order";

		if($this->lang->line('ship_to') != '')
		$ship_to =  stripslashes($this->lang->line('ship_to'));
		else
		$ship_to =  "Ship to";

		if($this->lang->line('note_to') != '')
		$note_to =  stripslashes($this->lang->line('note_to'));
		else
		$note_to =  "Note to";

		if($this->lang->line('apply') != '')
		$apply =  stripslashes($this->lang->line('apply'));
		else
		$apply =  "Apply";
			
		if($this->lang->line('optional') != '')
		$optional =  stripslashes($this->lang->line('optional'));
		else
		$optional =  "Optional";
			
		if($this->lang->line('note_here') != '')
		$note_here =  stripslashes($this->lang->line('note_here'));
		else
		$note_here =  "You can leave a personalized note here";

		if($this->lang->line('have_coupon_code') != '')
		$have_coupon_code =  stripslashes($this->lang->line('have_coupon_code'));
		else
		$have_coupon_code =  "Have a coupon code?";
			
		if($this->lang->line('retail_price') != '')
		$retail_price =  stripslashes($this->lang->line('retail_price'));
		else
		$retail_price =  "Retail price";

		/**Lanuage Transalation**/


		//$resultCart = $cartVal->result_array();
		/****************************** Gift Card Displays **************************************/

		if($giftRes -> num_rows() > 0 ){

			$GiftValue.= '<div id="GiftCartTable" style="display:block;">
			<form method="post" name="giftSubmit" id="giftSubmit" class="continue_payment" enctype="multipart/form-data" action="checkout/gift">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
				<thead><tr><th width="51%" colspan="2" class="product">'.$cart_product.'</th><th width="18%">'.$giftcard_price.'</th><th width="15%">'.$product_quantity.'</th><th width="21%">'.$purchases_total.'</th></tr></thead></table>';	
			$giftAmt = 0; $g=0;

			foreach ($giftRes->result() as $giftRow){
				$GiftValue.= '<div id="giftId_'.$g.'" style="display:block;"><table class="table-cart"><tbody><tr class="first">
					<td rowspan="2" class="thumnail"><img src="'.GIFTPATH.$giftSet->row()->image.'" alt="'.$giftSet->row()->title.'"><a href="javascript:delete_gift('.$giftRow->id.','.$g.')" class="remove_gift_card" cid="66577">'.$product_remove.'</a></td>
					<td class="title"><a href=""><b>'.$giftSet->row()->title.'</b></a><br></td>
					<td class="price">'.$this->data['currencySymbol'].number_format($giftRow->price_value,2,'.','').'</td>
					<td class="price">1</td>
					<td class="total">'.$this->data['currencySymbol'].number_format($giftRow->price_value,2,'.','').'</td>
				</tr>
                <tr>
            		<td class="optional" colspan="4"><div class="relative"><span></span>
						<ul class="optional-list">
							<li><span class="option-tit">'.$giftcard_reci_name.':</span><span class="option-txt">'.$giftRow->recipient_name.'</span></li>
							<li><span class="option-tit">'.$giftcard_rec_email.':</span><span class="option-txt">'.$giftRow->recipient_mail.'</span></li>
    	                    <li><span class="option-tit">'.$giftcard_message.':</span><span class="option-txt">'.$giftRow->description.'</span></li>
						</ul>
						</div>
					</td>
				</tr></tbody></table></div>';
				$giftAmt = $giftAmt + $giftRow->price_value;
				$g++;
			}

			$GiftValue.= '</div>
			<input name="gift_cards_amount" id-"gift_cards_amount" value="'.number_format($giftAmt,2,'.','').'" type="hidden">
			<input name="checkout_type" id-"checkout_type" value="giftpurchase" type="hidden">
			<div class="cart-payment" id="giftcard-cart-payment"><input type="hidden"><span class="bg-cart-payment"></span>
		    <dl class="cart-payment-order">
			   	<dt>'.$checkout_order.'</dt><dd><ul>
				<li class="first"><span class="order-payment-type">'.$checkout_item_total.'</span><span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="item_total">'.number_format($giftAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span></li>
				<li class="total"><span class="order-payment-type"><b>Total</b></span><span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="total_item">'.number_format($giftAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span></li>
				</ul>
		      	</dd>
			</dl>
		    <button type="submit" class="btn" id="button-submit-giftcard">'.$continue_payment.'</button>
		  	</div></div></form></div>';
		}

		/****************************** Subscribe Card Displays **************************************/
		if($SubcribRes -> num_rows() > 0 ){

			$SubscribValue.= '<div id="SubscribeCartTable" style="display:block;">
			<form method="post" name="SubscribeSubmit" id="SubscribeSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/Subscribecheckout">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
			<thead><tr><th width="51%" colspan="2" class="product">'.$cart_product.'</th><th width="18%">'.$giftcard_price.'</th><th width="15%">'.$product_quantity.'</th><th width="21%">'.$purchases_total.'</th></tr></thead></table>
				';	
			$SubscribAmt = 0; $subcribSAmt = 0; $subcribTAmt = 0; $SubgrantAmt = 0; $s=0;

			foreach ($SubcribRes->result() as $SubcribRow){
				$SubscribValue.= '<div id="SubscribId_'.$s.'" style="display:block;"><table class="table-cart"><tbody><tr class="first">
					<td rowspan="2" class="thumnail"><img src="'.FANCYBOXPATH.$SubcribRow->image.'" alt="'.$SubcribRow->name.'"><a href="javascript:delete_subscribe('.$SubcribRow->id.','.$s.')" class="remove_gift_card" cid="66577">'.$product_remove.'</a></td>
					<td class="title"><a href=""><b>'.$SubcribRow->name.'</b></a><br></td>
					<td class="price">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
					<td class="price">1</td>
					<td class="total">'.$this->data['currencySymbol'].number_format($SubcribRow->price,2,'.','').'</td>
				</tr>
				</tbody></table></div>';
				$SubscribAmt = $SubscribAmt + $SubcribRow->price;
				$s++;
			}

			$subcribSAmt = $MainShipCost;
			$subcribTAmt = ($SubscribAmt * 0.01 * $MainTaxCost);
			$SubgrantAmt = $SubscribAmt + $subcribSAmt + $subcribTAmt ;


			$SubscribValue.= '</div>
			 <div class="cart-payment" id="merchant-cart-payment">
		    <input type="hidden">
		    <span class="bg-cart-payment"></span>
		    <dl class="cart-payment-ship">
		      <dt>'.$ship_to.'</dt>
		      <dd>
			<select id="address-cart" class="select-round select-shipping-addr" onchange="SubscribeChangeAddress(this.value);">
				  <option value="" id="address-select">'.$choose_shipping_address.'</option>
			';

			foreach ($shipVal->result() as $Shiprow){
				if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"';
				$ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
				$SubscribValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}


			$SubscribValue.='</select>
			<input type="hidden" name="SubShip_address_val" id="SubShip_address_val" value="'.$ship_id.'" />
			
			<p class="default_addr"><span id="SubChg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_Sub_err"></span>
			<a href="javascript:void(0);" class="delete_addr" onclick="shipping_cart_address_delete();">'.$delete_this_address.'</a>
			
			<a href="javascript:void(0);" class="add_addr add_" onclick="shipping_address_cart();">'.$addnew_shipping_address.'</a>

		      </dd>
			</dl>

			   <dl class="cart-payment-order">
		      <dt>'.$checkout_order.'</dt>
		      <dd>
			<ul>
			  <li class="first">
			    <span class="order-payment-type">'.$checkout_item_total.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartAmt">'.number_format($SubscribAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$referrals_shipping.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartSAmt">'.number_format($subcribSAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$checkout_tax.' (<span id="SubTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].$SubscribAmt.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartTAmt">'.number_format($subcribTAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li></ul>';

			$SubscribValue.='
			  <ul>
			 <li class="total">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="SubCartGAmt">'.number_format($SubgrantAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			</ul>
		      </dd>
	              
		    </dl>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="subcrib_amount" id="subcrib_amount" value="'.number_format($SubscribAmt,2,'.','').'" type="hidden">
			<input name="subcrib_ship_amount" id="subcrib_ship_amount" value="'.number_format($subcribSAmt,2,'.','').'" type="hidden">
			<input name="subcrib_tax_amount" id="subcrib_tax_amount" value="'.number_format($subcribTAmt,2,'.','').'" type="hidden">
			<input name="subcrib_total_amount" id="subcrib_total_amount" value="'.number_format($SubgrantAmt,2,'.','').'" type="hidden">
		    <input type="submit" class="btn" name="SubscribePayment" id="button-submit-merchant" value="'.$continue_payment.'" />
		    
		  </div>
		</div>
	</form></div>';
		}


		/****************************** Cart Displays **************************************/

		if($cartVal -> num_rows() > 0 ){
			$CartValue.='<div id="CartTable" style="display:block;"><p class="cart-list-from">'.$order_from.' <b>'.$this->config->item('email_title').' '.$merchant.'</b></p>
				<form method="post" name="cartSubmit" id="cartSubmit" class="continue_payment" enctype="multipart/form-data" action="site/cart/cartcheckout">
				<div class="cart-payment-wrap cart-note"><span class="cart-payment-top"><b></b></span><div class="table-cart-wrap"><table class="table-cart">
		<thead><tr><th style="width:340px;line-height:30px;float:left;" colspan="2" class="product">'.$cart_product.'</th><th style="float:left;width:80px;line-height:30px;">'.$giftcard_price.'</th><th style="float:left;width:70px;line-height:30px;">'.$product_quantity.'</th><th style="float:left;width:70px;line-height:30px;">'.$purchases_total.'</th></tr></thead></table>
       ';
			$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0;
			$s=0;
			foreach ($cartVal->result() as $CartRow){
				//echo '<pre>';print_r($CartRow);
				$curdate = date('Y-m-d');
				$newImg = @explode(',',$CartRow->image);
				$CartValue.='<div id="cartdivId_'.$s.'"> <table class="table-cart"><tbody><tr class="first">
			<td style="width:70px;" rowspan="2" class="thumnail"><a style="width:70px;" href="things/'.$CartRow->prdid.'/'.$CartRow->seourl.'"><img style="width:70px;" src="'.PRODUCTPATH.$newImg[0].'" alt="'.$CartRow->product_name.'"></a><a style="width:70px;" href="javascript:void(0);" onclick="javascript:delete_cart('.$CartRow->id.','.$s.')" class="remove_item">'.$product_remove.'</a></td>
			<td style="float:left;width:260px;" class="title"><a href="things/'.$CartRow->prdid.'/'.$CartRow->seourl.'"><b>'.$CartRow->product_name.'</b></a>';
			if($CartRow->attr_name!='' || $CartRow->attr_type!=''){
			$CartValue.='<br>'.$CartRow->attr_type.' / '.$CartRow->attr_name.'';
			}
			$CartValue.='<br> </td>
			<td style="float:left;width:80px;" class="price">'.$this->data['currencySymbol'].$CartRow->price.'</td>
			<td style="float:left;width:70px;" class="quantity"><input class="text" value="'.$CartRow->quantity.'" name="quantity'.$s.'" data-mqty="'.$CartRow->mqty.'" id="quantity'.$s.'" type="text"><br><a href="javascript:void(0);" onclick="javascript:update_cart('.$CartRow->id.','.$s.','.$CartRow->product_id.')" class="update_quantity">'.$update.'</a></td>
			<td style="float:left;width:70px;" class="total">'.$this->data['currencySymbol'].'<span id="IndTotalVal'.$s.'">'.$CartRow->indtotal.'</span></td>
		</tr>
		<tr>
         	<td class="optional" colspan="4"><div class="relative"><span></span>
			<ul class="optional-list"><li><span class="option-tit">'.$referrals_shipping.':</span><span class="option-txt">';
				if($CartRow->ship_immediate == 'true'){
					$CartValue.='Immediate';
				}else{
					$CartValue.=date('d/m', strtotime($curdate)).' - '.date('d/m', strtotime($curdate. ' + 10 day'));
				}
					
				$CartValue.='</span></li></ul>
			<div class="show_detail">
				<span class="tooltip shipping" style="display:none"><i class="ic-truck"></i><small>'.$header_ship_within.'<b></b></small></span>
				<span class="tooltip delivery" style="display:none"><i class="ic-delivery"></i><small>Order before 11 AM and get it today!<br>Available in New York, NY<b></b></small></span>
			</div>
			</div>
			</td>
		</tr></tbody></table></div>';
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost + $CartRow->price + ($CartRow->price * 0.01 * $CartRow->product_tax_cost))  * $CartRow->quantity);
				$cartShippingAmt = $cartShippingAmt + ($CartRow->product_shipping_cost * $CartRow->quantity);
				$cartTaxAmt = $cartTaxAmt + ($CartRow->product_tax_cost * $CartRow->quantity);
				$cartQty = $cartQty + $CartRow->quantity;
				$s++;
			}
			$cartSAmt = $MainShipCost;
			$cartTAmt = ($cartAmt * 0.01 * $MainTaxCost);
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;

			$CartValue.='<dl class="note">
		      <dt>'.$note_to.' '.$this->config->item('email_title').' '.$merchant.' <small>'.$optional.'</small></dt>
		      <dd><textarea class="note-to-seller" name="note" data-id="cart-note-1192557-616001" placeholder="'.$note_here.'"></textarea></dd>
		    </dl>

		  </div>
		  <div class="cart-payment" id="merchant-cart-payment">
		    <input type="hidden">
		    <span class="bg-cart-payment"></span>
		    <dl class="cart-payment-ship">
		      <dt>'.$ship_to.'</dt>
		      <dd>
			<select id="address-cart" class="select-round select-shipping-addr" onchange="CartChangeAddress(this.value);">
				  <option value="" id="address-select">'.$choose_shipping_address.'</option>
			';

			foreach ($shipVal->result() as $Shiprow){
				if($Shiprow->primary == 'Yes'){ $optionsValues = 'selected="selected"'; $ChooseVal = $Shiprow->full_name.'<br>'.$Shiprow->address1.'<br>'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'<br>'.$Shiprow->country.'<br>'.$Shiprow->phone; $ship_id =$Shiprow->id;  }else{ $optionsValues ='';}
				$CartValue.='<option '.$optionsValues.' value="'.$Shiprow->id.'" l1="'.$Shiprow->full_name.'" l2="'.$Shiprow->address1.'" l3="'.$Shiprow->city.' '.$Shiprow->state.' '.$Shiprow->postal_code.'" l4="'.$Shiprow->country.'" l5="'.$Shiprow->phone.'">'.$Shiprow->full_name.'</option>';
			}


			$CartValue.='</select>
			<input type="hidden" name="Ship_address_val" id="Ship_address_val" value="'.$ship_id.'" />
			
			<p class="default_addr"><span id="Chg_Add_Val">'.$ChooseVal.'</span></p>
			<span style="color:#FF0000;" id="Ship_err"></span>
			<a href="javascript:void(0);" class="delete_addr" onclick="shipping_cart_address_delete();">'.$delete_this_address.'</a>
			
			<a href="javascript:void(0);" class="add_addr add_" onclick="shipping_address_cart();">'.$addnew_shipping_address.'</a>

		      </dd>
			</dl>

			<dl class="ship-speed" style="display:none;border-bottom:1px solid #D4D6DF;">
			    <dt>'.$shipping_speed.'</dt>
			    <dd>
				    <input id="speed2-val1" name="shipping_speed" value="0" type="radio"> <label for="speed2-val1">Standard</label><br>
					<input id="speed2-val3" name="shipping_speed" value="3" type="radio"> <label for="speed2-val3">Same-day Delivery</label>
				</dd>
			</dl>';

			if($disAmt>0){
				$CartValue.='<dl class="cart-coupon">
				<dt>'.$cart_coupon_code.'</dt>
                <dd><input id="is_coupon" name="is_coupon" class="text coupon-code" readonly="readonly" placeholder="'.$have_coupon_code.'" data-sid="616001" type="text" value="'.$discountQuery->row()->couponCode.'">
				<input id="CheckCodeButton" type="button" class="btn-blue-apply apply-coupon" onclick="javascript:checkRemove();" value="Remove" style="cursor:pointer;" /></dd>
				<dd><span id="CouponErr" style="color:#FF0000;"></span></dd>
                
			</dl>';
			}else{
				$CartValue.='<dl class="cart-coupon">
				<dt>'.$coupon_codes.'</dt>
                <dd><input id="is_coupon" name="is_coupon" class="text coupon-code" placeholder="'.$have_coupon_code.'" data-sid="616001" type="text">
				<input id="CheckCodeButton" type="button" class="btn-blue-apply apply-coupon" onclick="javascript:checkCode();" value="'.$apply.'" style="cursor:pointer;" /></dd>
				<dd><span id="CouponErr" style="color:#FF0000;"></span></dd>
                
			</dl>';
			}

			$CartValue.='<dl class="cart-payment-order">
		      <dt>'.$checkout_order.'</dt>
		      <dd>
			<ul>
			  <li class="first">
			    <span class="order-payment-type">'.$checkout_item_total.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartAmt">'.number_format($cartAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$referrals_shipping.'</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartSAmt">'.number_format($cartSAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  <li>
			    <span class="order-payment-type">'.$checkout_tax.' (<span id="carTamt">'.$MainTaxCost.'</span>%) of '.$this->data['currencySymbol'].'<span id="CartAmtDup">'.$cartAmt.'</span></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartTAmt">'.number_format($cartTAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li></ul>';
			if($disAmt >0){
				$grantAmt = $grantAmt - $disAmt;
				$CartValue.='<div id="disAmtValDiv"><ul><li>
			    <span class="order-payment-type">Discount</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li><ul></div>';
			}else{
			 $CartValue.='<div id="disAmtValDiv" style="display:none;"><ul>
			 <li>
			    <span class="order-payment-type">Discount</span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="disAmtVal">'.number_format($disAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			  </ul></div>';
			}
			$CartValue.='<ul>
			 <li class="total">
			    <span class="order-payment-type"><b>Total</b></span>
			    <span class="order-payment-usd"><b>'.$this->data['currencySymbol'].'<span id="CartGAmt">'.number_format($grantAmt,2,'.','').'</span></b> '.$this->data['currencyType'].'</span>
			  </li>
			</ul>
		      </dd>
	              
		    </dl>
			
		    <input name="user_id" value="'.$userid.'" type="hidden">
			<input name="cart_amount" id="cart_amount" value="'.number_format($cartAmt,2,'.','').'" type="hidden">
			<input name="cart_ship_amount" id="cart_ship_amount" value="'.number_format($cartSAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_amount" id="cart_tax_amount" value="'.number_format($cartTAmt,2,'.','').'" type="hidden">
			<input name="cart_tax_Value" id="cart_tax_Value" value="'.number_format($MainTaxCost,2,'.','').'" type="hidden">
			<input name="cart_total_amount" id="cart_total_amount" value="'.number_format($grantAmt,2,'.','').'" type="hidden">
			<input name="discount_Amt" id="discount_Amt" value="'.number_format($disAmt,2,'.','').'" type="hidden">';

			if($disAmt>0){
				$CartValue.='<input name="CouponCode" id="CouponCode" value="'.$discountQuery->row()->couponCode.'" type="hidden">
			<input name="Coupon_id" id="Coupon_id" value="'.$discountQuery->row()->couponID.'" type="hidden">
			<input name="couponType" id="couponType" value="'.$discountQuery->row()->coupontype.'" type="hidden">';
			}else{
				$CartValue.='<input name="CouponCode" id="CouponCode" value="" type="hidden">
			<input name="Coupon_id" id="Coupon_id" value="0" type="hidden">
			<input name="couponType" id="couponType" value="" type="hidden">';
			}
			$CartValue.='<input type="submit" class="btn" name="cartPayment" id="button-submit-merchant" value="'.$continue_payment.'" />
		    
		  </div>
		</div>
	</form></div>';
		}

		$countVal = $giftRes -> num_rows() + $cartQty + $SubcribRes -> num_rows();



		if($countVal >0 ){
			$CartDisp = '<h2><span id="Shop_id_count">'.$countVal.'</span> '.$items_in_shopping.'</h2>'.$GiftValue.$SubscribValue.$CartValue.'<div id="EmptyCart" style="border-bottom: none; display:none;" class="empty-alert" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="Shopping Cart Empty"></p>
					<p style="text-align:center;"><b>'.$shopping_cart_empty.'</b></p>
					<p style="text-align:center;">'.$dont_miss.' '.ucwords($this->config->item('email_title')).'. '.$shall_we.'</p>
				</div>';
		}else{

			$CartDisp = '<h2>Shopping Cart</h2>
					<div style="border-bottom: none;" class="empty-alert" >
					<p style="text-align:center;"><img src="images/site/shopping_empty.jpg" alt="Shopping Cart Empty"></p>
					<p style="text-align:center;"><b>'.$shopping_cart_empty.'</b></p>
					<p style="text-align:center;">'.$dont_miss.' '.ucwords($this->config->item('email_title')).'. '.$shall_we.'</p>
				</div>';
		}

		return $CartDisp;

	}



	public function mani_gift_total($userid=''){

		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$giftAmt = 0;
		if($giftRes -> num_rows() > 0 ){

			foreach ($giftRes->result() as $giftRow){
				$giftAmt = $giftAmt + $giftRow->price_value;
			}

		}
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartVal -> num_rows() ;

		return number_format($giftAmt,2,'.','').'|'.$countVal;

	}

	public function mani_subcribe_total($userid=''){

		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$SubcribAmt = 0; $SubcribSAmt = 0; $SubcribTAmt = 0; $SubcribTotalAmt = 0;
		if($SubcribRes -> num_rows() > 0 ){

			foreach ($SubcribRes->result() as $SubscribRow){
				$SubcribAmt = $SubcribAmt + $SubscribRow->price;
			}
			$SubcribSAmt = $SubcribRes->row()->shipping_cost;
			$SubcribTAmt = $SubcribRes->row()->tax;
			$SubcribTotalAmt = $SubcribAmt + $SubcribSAmt + $SubcribTAmt ;

		}
		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$countVal = $SubcribRes -> num_rows() + $giftRes -> num_rows() + $cartVal -> num_rows() ;

		return number_format($SubcribAmt,2,'.','').'|'.number_format($SubcribSAmt,2,'.','').'|'.number_format($SubcribTAmt,2,'.','').'|'.number_format($SubcribTotalAmt,2,'.','').'|'.$countVal;

	}
	public function mani_cart_total($userid=''){

		$giftRes = $this->cart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$SubcribRes = $this->cart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0; $cartMiniMainCount = 0;

		if($cartVal -> num_rows() > 0 ){
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);

				$cartMiniMainCount = $cartMiniMainCount + $CartRow->quantity;

			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;

		}

		$countVal = $giftRes -> num_rows() + $SubcribRes -> num_rows() + $cartMiniMainCount;

		$this->db->select('discountAmount');
		$this->db->where('user_id',$userid);
		$query = $this->db->get(SHOPPING_CART);

		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}

		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.$countVal.'|'.number_format($query->row()->discountAmount,2,'.','');

	}



	public function mani_cart_coupon_sucess($userid=''){

		$cartVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0;

		if($cartVal -> num_rows() > 0 ){
			$k=0;
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				$newCartInd[] = $CartRow->indtotal;
				$k = $k + 1;
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;

		}

		$this->db->select('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		$newAmtsValues = @implode('|',$newCartInd);

			
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}

		return number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.number_format($query->row()->discountAmount,2,'.','').'|'.$k.'|'.$newAmtsValues;

	}




	public function view_cart_details($condition = ''){
		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$cartList = $this->ExecuteQuery($select_qry);
		return $cartList;
			
	}

	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function Check_Code_Val($Code = '',$amount = '',$shipamount = '', $userid = ''){

		$code = $Code;
		$amount = $amount;
		$amountOrg = $amount;
		$ship_amount = $shipamount;

		$CoupRes = $this->cart_model->get_all_details(COUPONCARDS,array( 'code' => $code, 'card_status' => 'not used'));
		$GiftRes = $this->cart_model->get_all_details(GIFTCARDS,array( 'code' => $code));
		$ShopArr = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$excludeArr = array('code','amount','shipamount');


		if($CoupRes->num_rows() > 0){

			$PayVal = $this->cart_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'coupon_id' => $CoupRes->row()->id, 'status'=>'Paid' ));

			if($PayVal->num_rows() == 0){
					
				if($ShopArr->row()->couponID == 0){

					if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){

						$today = getdate();
						$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
						$currDate = date("Y-d-m", $tomorrow);
						$couponExpDate = $CoupRes->row()->dateto;

						$curVal = (strtotime($couponExpDate) < time());
						if($curVal != '') {
							echo '5';
							exit();
						}


						if($CoupRes->row()->coupon_type == "shipping") {
							$totalamt = number_format($amount - $ship_amount,2,'.','');
							$discount ='0';

							$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Free Shipping',
											'is_coupon_used' => 'Yes',
											'shipping_cost' => 0,
											'total' => $totalamt);
							$condition =array('user_id' => $userid);
							$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
							echo 'Success|'.$CoupRes->row()->id.'|Shipping';
							exit();


						} elseif($CoupRes->row()->coupon_type == "category") {
							$newAmt = $amount;
							$catAry = @explode(',',$CoupRes->row()->category_id);
							foreach($ShopArr->result() as $shopRow){
								$shopCatArr = '';

								$shopCatArr = @explode(',',$shopRow->cate_id);
									
								$combArr = array_merge($catAry, $shopCatArr);
								$combArr1 = array_unique($combArr);
								if(count($combArr) != count($combArr1)){

									if($CoupRes->row()->price_type == 2){
										$percentage = $CoupRes->row()->price_value;
										$amountOrg = $shopRow->indtotal;
										$discount = ($percentage * 0.01) * $amountOrg;
										$IndAmt = number_format($amountOrg-$discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
											
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1);

											
									}elseif($CoupRes->row()->price_type == 1){

										$discount = $CoupRes->row()->price_value;
										$amountOrg = $shopRow->indtotal;
										if($amountOrg > $discount){
											$amountOrg = number_format($amountOrg-$discount,2,'.','');
											$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
											$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Category',
											'is_coupon_used' => 'Yes',
											'indtotal' => $amountOrg);
											$condition =array('id' => $shopRow->id);
											$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
											$dataArr1 = array('total' => $TotalAmt);
											$condition1 =array('user_id' => $userid);
											$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1);
										}else{
											echo '7';
											exit();
										}
									}
								}
							}
							echo 'Success|'.$CoupRes->row()->id.'|Category';
							exit();

						} elseif($CoupRes->row()->coupon_type== "product") {
							$PrdArr = @explode(',',$CoupRes->row()->product_id);
							$newAmt = $amount;
							foreach($ShopArr->result() as $shopRow){

								$shopPrd = $shopRow->product_id;
									
								if(in_array($shopPrd,$PrdArr)==1){

									if($CoupRes->row()->price_type == 2){
											
										$percentage = $CoupRes->row()->price_value;
										$amountOrg = $shopRow->indtotal;
										$discount = ($percentage * 0.01) * $amountOrg;
										$IndAmt = number_format($amountOrg - $discount,2,'.','');
										$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
										$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
											
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
										$dataArr1 = array('total' => $TotalAmt);
										$condition1 =array('user_id' => $userid);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1);

									}elseif($CoupRes->row()->price_type == 1){

										$discount = $CoupRes->row()->price_value;
										$amountOrg = $shopRow->indtotal;
										if($amountOrg > $discount){
											$newDisAmt = number_format($amountOrg - $discount,2,'.','');
											$TotalAmt = $newAmt = number_format($newAmt - $discount,2,'.','');
											$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Product',
											'is_coupon_used' => 'Yes',
											'indtotal' => $newDisAmt);

											$condition =array('id' => $shopRow->id);
											$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
											$dataArr1 = array('total' => $TotalAmt);
											$condition1 =array('user_id' => $userid);
											$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr1,$condition1);

										}else{
											echo '7';
											exit();
										}
									}
								}
							}
							echo 'Success|'.$CoupRes->row()->id.'|Product';
							exit();

						}else{

							if($CoupRes->row()->price_type == 2){

								$percentage = $CoupRes->row()->price_value;
								$discount = ($percentage * 0.01) * $amount;
								$totalAmt = number_format($amount-$discount,2,'.','');
									
								$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $totalAmt);
								$condition =array('user_id' => $userid);

								$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
									
								/*foreach($ShopArr->result() as $shopRow){

								$amountOrg = $shopRow->indtotal;
								$discount = ($percentage * 0.01) * $amountOrg;
								$IndAmt = number_format($amountOrg - $discount,2,'.','');

								$dataArr = array('indtotal' => $IndAmt);
								$condition =array('id' => $shopRow->id);
								$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
								}*/
									
								echo 'Success|'.$CoupRes->row()->id;
								exit();

							}elseif($CoupRes->row()->price_type == 1){

								$discount = $CoupRes->row()->price_value;
								if($amount > $discount){
									$amountOrg = number_format($amount-$discount,2,'.','');
									$dataArr = array('discountAmount' => $discount,
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
									$condition =array('user_id' => $userid);
									$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
									/*$newDisAmt = ($discount / $ShopArr->num_rows());
									 foreach($ShopArr->result() as $shopRow){
										$amountOrg = $shopRow->indtotal;
										$IndAmt = number_format($amountOrg - $newDisAmt,2,'.','');
										$dataArr = array('indtotal' => $IndAmt);
										$condition =array('id' => $shopRow->id);
										$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
										}*/


									echo 'Success|'.$CoupRes->row()->id;
									exit();

								}else{
									echo '7';
									exit();
								}
							}

						}
					} else {
						echo '6';
						exit();
					}
				}else{
					echo '2';
					exit();
				}

					
			}else{
				echo '2';
				exit();
			}


		}elseif($GiftRes->num_rows() > 0){

			$curGiftVal = (strtotime($GiftRes->row()->expiry_date) < time());
			if($curGiftVal != '') {
				echo '8';
				exit();
			}

			if($GiftRes->row()->price_value > $GiftRes->row()->used_amount){

				$NewGiftAmt = $GiftRes->row()->price_value - $GiftRes->row()->used_amount;
				if($amount > $NewGiftAmt){
					$amountOrg = $amountOrg - $NewGiftAmt;

					$dataArr = array('discountAmount' => $NewGiftAmt,
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
					$condition =array('user_id' => $userid);
					$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition);



					/*$newDisAmt = ($NewGiftAmt / $ShopArr->num_rows());
						//echo '<pre>'; print_r($ShopArr->result_array());
						foreach($ShopArr->result() as $shopRow){
						$IndAmt = number_format($shopRow->indtotal - $newDisAmt,2,'.','');
						$dataArr = array('indtotal' => $IndAmt);
						$condition =array('id' => $shopRow->id);
						$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition);
						//echo '<pre>'.$this->db->last_query();
						}*/

				}else{
					$dataArr = array('discountAmount' => $amountOrg,
											'couponID' => $GiftRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Gift',
											'is_coupon_used' => 'Yes',
											'total' => '0');
					$condition =array('user_id' => $userid);
					$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition);

					/*$newDisAmt = ($amountOrg / $ShopArr->num_rows());

					foreach($ShopArr->result() as $shopRow){
					$amountOrg = $shopRow->indtotal;
					$IndAmt = number_format($amountOrg - $newDisAmt,2,'.','');
					$dataArr = array('indtotal' => '0');
					$condition =array('id' => $shopRow->id);
					$this->cart_model->update_details(SHOPPING_CART,$dataArr,$condition);
					}*/
				}

				echo 'Success|'.$GiftRes->row()->id.'|Gift';
				exit();
					
			}else{
				echo '2';
				exit();
			}

		}else{
			echo '1';
			exit();
		}

	}
	public function Check_Code_Val_Remove($userid = ''){

		$excludeArr = array('code');

		$dataArr = array('discountAmount' => 0,
											'couponID' => 0,
											'couponCode' => '',
											'coupontype' => '',
											'is_coupon_used' => 'No');
		$condition =array('user_id' => $userid);
		$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
		return;



	}

	public function addPaymentCart($userid = ''){


		$this->db->select('a.*,b.city,b.state,b.country,b.postal_code');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(SHIPPING_ADDRESS.' as b' , 'a.user_id = b.user_id and a.user_id = "'.$userid.'" and b.id="'.$this->input->post('Ship_address_val').'"');
		$AddPayt = $this->db->get();


		if($this->session->userdata('randomNo') != '') {
			$delete = 'delete from '.PAYMENT.' where dealCodeNumber = "'.$this->session->userdata('randomNo').'" and user_id = "'.$userid.'" ';
			$this->ExecuteQuery($delete, 'delete');
			$dealCodeNumber = $this->session->userdata('randomNo');
		} else {
			$dealCodeNumber = mt_rand();
		}

		$insertIds = array();
		foreach ($AddPayt->result() as $result) {

			if($this->input->post('is_gift')==''){
				$ordergift = 0;
			}else{
				$ordergift = 1;
			}

			$sumTotal = number_format((($result->price + $result->product_shipping_cost + ($result->product_tax_cost * 0.01 * $result->price)) * $result->quantity ),2,'.','');

			$insert = ' insert into '.PAYMENT.' set
								product_id = "'.$result->product_id.'",
								sell_id = "'.$result->sell_id.'",								
								price = "'.$result->price.'",
								quantity = "'.$result->quantity.'",
								indtotal = "'.$result->indtotal.'",
								shippingcountry = "'.$result->country.'",
								shippingid = "'.$this->input->post('Ship_address_val').'",
								shippingstate = "'.$result->state.'",
								shippingcity = "'.$result->city.'",
								shippingcost = "'.$this->input->post('cart_ship_amount').'",
								tax = "'.$this->input->post('cart_tax_amount').'",
								product_shipping_cost = "'.$result->product_shipping_cost.'",
								product_tax_cost = "'.$result->product_tax_cost.'",																												
								coupon_id  = "'.$result->couponID.'",
								discountAmount = "'.$this->input->post('discount_Amt').'",
								couponCode  = "'.$result->couponCode.'",
								coupontype = "'.$result->coupontype.'",
								sumtotal = "'.$sumTotal.'",
								user_id = "'.$result->user_id.'",
								created = now(),
								dealCodeNumber = "'.$dealCodeNumber.'",
								status = "Pending",
								payment_type = "",
								attribute_values = "'.$result->attribute_values.'",
								shipping_status = "Pending",
								total  = "'.$this->input->post('cart_total_amount').'", 
								note = "'.$this->input->post('note').'", 
								order_gift = "'.$ordergift.'", 
								inserttime = "'.time().'"';

			$insertIds[] = $this->cart_model->ExecuteQuery($insert, 'insert');
		}
			
		$paymtdata = array(
								'randomNo' => $dealCodeNumber,
								'randomIds' => $insertIds,
		);
		$this->session->set_userdata($paymtdata);

		return $insertIds;
	}


	public function addPaymentSubscribe($userid = ''){

		if($this->session->userdata('InvoiceNo') != '') {
			$InvoiceNo = $this->session->userdata('InvoiceNo');
		} else {
			$InvoiceNo = mt_rand();
		}

		$paymtdata = array(	'InvoiceNo' => $InvoiceNo);
		$this->session->set_userdata($paymtdata);

		$dataArr = array('invoice_no' => $InvoiceNo,
						'shipping_id' => $this->input->post('SubShip_address_val'),
						'shipping_cost' => $this->input->post('subcrib_ship_amount'),
						'tax' => $this->input->post('subcrib_tax_amount'),
						'total' => $this->input->post('subcrib_total_amount'),																		
		);
		$condition =array('user_id' => $userid);
		$this->cart_model->update_details(FANCYYBOX_TEMP,$dataArr,$condition);


		return;

	}


}

?>