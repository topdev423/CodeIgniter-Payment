<?php 
$this->load->view('site/templates/header.php');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<style type="text/css">
ol.stream {position: relative;}
ol.stream.use-css3 li.anim {transition:all .25s;-webkit-transition:all .25s;-moz-transition:all .25s;-ms-transition:all .25s;visibility:visible;opacity:1;}
ol.stream.use-css3 li {visibility:hidden;}
ol.stream.use-css3 li.anim.fadeout {opacity:0;}
ol.stream.use-css3.fadein li {opacity:0;}
ol.stream.use-css3.fadein li.anim.fadein {opacity:1;}
</style>

<script type="text/javascript">
		var can_show_signin_overlay = false;
		if (navigator.platform.indexOf('Win') != -1) {document.write("<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>");}
	</script>

<div class="lang-en no-subnav wider winOS">
        
	<div id="container-wrapper">
  <div class="container">
		
        		
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
	<div class="wrapper-content order" >
	  <div id="content" style="padding:0px 20px 20px 20px;">
	    <ol class="cart-order-depth">
	      <li class="depth1"><span>1</span><?php if($this->lang->line('cart_shop_cart') != '') { echo stripslashes($this->lang->line('cart_shop_cart')); } else echo "Shopping Cart"; ?></li>
	      <li class="depth2 current"><span>2</span><?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?></li>
	      <li class="depth3"><span>3</span><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></li>
	    </ol>
            <div class="cart-list chept2">
		<h2><?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?></h2>
        <?php if($this->uri->segment(2)=='cart' || $this->uri->segment(2)=='gift'){ ?>            
        <ol class="cart-order-depth" style="position:relative;">
        <?php 
        $payMethodCount = 1;
        ?>
        <?php if ($paypal_ipn_settings['status'] == 'Enable'){?>
	      <li class="depth1 current" id="dep1" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:paypal();" class="current"><?php if($this->lang->line('checkout_paypal') != '') { echo stripslashes($this->lang->line('checkout_paypal')); } else echo "Paypal"; ?></a></li>
        <?php 
        $payMethodCount++;
        }
        if ($authorize_net_settings['status'] == 'Enable'){
        ?>
	      <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();"><?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?></a></li>
	    <?php 
        }else if ($paypal_credit_card_settings['status'] == 'Enable'){
        ?>
	      <li class="depth2" id="dep2" style="background:none;"><span><?php echo $payMethodCount;?></span><a onclick="javascript:creditcard();"><?php if($this->lang->line('checkout_credit_card') != '') { echo stripslashes($this->lang->line('checkout_credit_card')); } else echo "Credit Card"; ?></a></li>
	    <?php 
        }
	    ?>  
<!-- 	      <li class="depth3" id="dep3" style="width:150px;"><span>3</span><a onclick="javascript:othermethods();">Other Methods</a></li>
 -->	    </ol>
        <?php } ?>
		<div class="clear"></div>
		<?php $paypalProcess = unserialize($paypal_ipn_settings['settings']); 
		 
			if($this->uri->segment(2)=='cart'){
				
			$checkAmt = @explode('|',$checkoutViewResults);
			
			 if($checkAmt[3] > 0){
		 ?>

			<div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" style="display:<?php if ($paypal_ipn_settings['status'] == 'Enable'){echo 'block';}else {echo 'none';}?>;">
                      <script>
                      $(document).ready(function(){	$("#PaymentPaypalForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });
					   </script> 
					<form name="PaymentPaypalForm" id="PaymentPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentProcess"  autocomplete="off">
					<input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
                    <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />                        
						
						<div id="complete-payment">
						
	
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                    <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_enter_bill') != '') { echo stripslashes($this->lang->line('checkout_enter_bill')); } else echo "Enter your billing address"; ?></small></dt>
                                   
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										<dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                        <dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										
									</dl>
									<dl class="payment-card">
                                        <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
										
										<dd>
                                        <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b>*</b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                    <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                    <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>

		
							<div class="cart-payment">
								<!--dl class="cart-payment-ship">
	
									<dt>Ship to</dt>
									<dd>
										<p><br /><br />  </p>
									</dd>
								</dl-->
								<dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
									<dd>
										<ul>
											<li class="first">
												<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[0],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[1],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?> </span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[2],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
                                            <?php if($checkAmt[5] > 0){ ?>
                                            <li>
												<span class="order-payment-type"><?php if($this->lang->line('checkout_discount') != '') { echo stripslashes($this->lang->line('checkout_discount')); } else echo "Discount"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[5],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
                                            <?php }else{  } ?>
                                            

											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[3],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                              <input id="total_price" name="total_price" value="<?php echo number_format($checkAmt[3],2,'.',''); ?>" type="hidden">
                              <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                              
							<input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         
                        </form> 
					</div>

            <div class="cart-payment-wrap card-payment new-card-payment" id="CreditCardPay" style="display:<?php if (($paypal_ipn_settings['status'] == 'Disable' && $authorize_net_settings['status'] == 'Enable') || ($paypal_ipn_settings['status'] == 'Disable' && $paypal_credit_card_settings['status'] == 'Enable')){echo 'block';}else {echo 'none';}?>;"> 
                    
					 <script>$(document).ready(function(){	$("#PaymentCreditForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });</script> 
					<form name="PaymentCreditForm" id="PaymentCreditForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentCredit" autocomplete="off">
						<div id="complete-payment">

	
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                    <dt><b><?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?></b> <small><?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?></small></dt>
                                    <dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										
										<dd>
                                        <label for="payment-card-number"><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?> <b>*</b></label>
											<input id="cardNumber" name="cardNumber" class="required" maxlength="16" size="16" type="text">
                                            <p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p>
		
										</dd>
                                         <dd>
                                         <label for="payment-card-number"><?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?> <b>*</b></label>
   											<select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                                            <option value="Amex"><?php if($this->lang->line('american_express') != '') { echo stripslashes($this->lang->line('american_express')); } else echo "American Express"; ?></option>
                                            <option value="Visa"><?php if($this->lang->line('visa') != '') { echo stripslashes($this->lang->line('visa')); } else echo "Visa"; ?></option>
                                            <option value="MasterCard"><?php if($this->lang->line('master_card') != '') { echo stripslashes($this->lang->line('master_card')); } else echo "Master Card"; ?></option>
                                            <option value="Discover"><?php if($this->lang->line('discover') != '') { echo stripslashes($this->lang->line('discover')); } else echo "Discover"; ?></option>
                                            </select>
                                           <p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p>
										</dd>
		
										<dd>
                                        <label for="payment-card-expiration"><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?> <b>*</b></label>
                                        <?php $Sel ='selected="selected"';  ?>
											<select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
												
												<option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
												<option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
												<option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
												<option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
												<option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
												<option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
												<option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
												<option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
												<option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
												<option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
												<option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
												<option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
											</select>
                                            
                                            
											<select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
											<?php for($i=date('Y');$i< (date('Y') + 25);$i++){ ?>	
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>    
											</select>
                                            
										</dd>
										<dd>
                                        <label for="payment-card-security"><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
		
											<input style="width:63px;" id="payment-card-security" name="creditCardIdentifier" class="input-code required number" type="password">
											<a href="#" class="tooltip" onClick="$('.card-back').show();return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>
                                            <p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p>
											<dl class="card-back">
                                                <dt><?php if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)"; ?></dt>
												<dd>
													<img src="images/card-back.gif" alt="">
                                                    <?php if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front"; ?>.
													<a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a>
												</dd>
											</dl>
										</dd>
									</dl>
									<dl class="payment-card">
                                        <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_billing_enter') != '') { echo stripslashes($this->lang->line('checkout_billing_enter')); } else echo "Enter your billing and shipping address"; ?></small></dt>
		
										<dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                         <dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										<dd>
                                        <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b>*</b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                    <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                    <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
								
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>






							
							<div class="cart-payment">
                                
                                <dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
									<dd>
										<ul>
											<li class="first">
												<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[0],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[1],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[2],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
                                            <?php if($checkAmt[5] > 0){ ?>
                                            <li>
												<span class="order-payment-type"><?php if($this->lang->line('checkout_discount') != '') { echo stripslashes($this->lang->line('checkout_discount')); } else echo "Discount"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[5],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
                                            <?php }else{ } ?>
                                            

											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkAmt[3],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                              <input id="total_price" name="total_price" value="<?php echo number_format($checkAmt[3],2,'.',''); ?>" type="hidden">
                              <input type="hidden" name="shipping_id" id="shipping_id" value="<?php echo $checkAmt[6]; ?>" />
                              <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                             <?php if ($authorize_net_settings['status'] == 'Enable'){ ?>
                              <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                              
                              <?php }elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
                               <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" />
                              <?php } ?>
							<input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                                
								

							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         </form>
                         
					</div>
            
            <div class="cart-payment-wrap card-payment new-card-payment" id="otherPay" style="display:none;">
	            <div id="complete-payment">
	            	<div class="hotel-booking-left" style="width:100%;text-align:center;padding-top:50px;min-height: 100px;">
	            		<img src="images/site/payment.jpg"/>
	            		<p style="font-size:17px;margin-top:25px;">" <?php if($this->lang->line('checkout_req_merchang') != '') { echo stripslashes($this->lang->line('checkout_req_merchang')); } else echo "Will be configured on request during setup of the script . Requires merchant account creation and customization"; ?> "</p>
	            	</div>
	            </div>
            </div>        
         <?php  }else{ ?>
        
	        <div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" style="display:block;">
                      <script>$(document).ready(function(){	$("#PaymentPaypalForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });</script> 
			<form name="PaymentPaypalForm" id="PaymentPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentGiftFree" autocomplete="off">
						<div id="complete-payment">
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                    <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_enter_bill') != '') { echo stripslashes($this->lang->line('checkout_enter_bill')); } else echo "Enter your billing address"; ?></small></dt>
                                   
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										<dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                         <dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										
									</dl>
									<dl class="payment-card">
                                        <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
										
										<dd>
                                        <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b></b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state">Country <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                    <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                    <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>

		
							<div class="cart-payment">
								
								<dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_ur_used_gc') != '') { echo stripslashes($this->lang->line('checkout_ur_used_gc')); } else echo "You are used Gift Cart"; ?> </dt>
									<dd>
										<ul>
											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $$currencySymbol;?><?php echo number_format($checkAmt[3],2,'.',''); ?></b> <?php echo $$currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                              <input id="total_price" name="total_price" value="<?php echo number_format($checkAmt[3],2,'.',''); ?>" type="hidden">
                              <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                              
							<input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_purchas') != '') { echo stripslashes($this->lang->line('checkout_comp_purchas')); } else echo "Complete Purchase"; ?>" style="cursor:pointer;"  />
							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         
                        </form> 
					</div>
            
        <?php }
		 
		 	}elseif($this->uri->segment(2)=='gift'){
				 ?>       
             
         	<div class="cart-payment-wrap card-payment new-card-payment" id="PaypalPay" style="display:<?php if ($paypal_ipn_settings['status'] == 'Enable'){echo 'block';}else {echo 'none';}?>;">
                      <script>$(document).ready(function(){	$("#PaymentGiftPaypalForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });</script> 
						<form name="PaymentGiftPaypalForm" id="PaymentGiftPaypalForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentProcessGift"  autocomplete="off">
						<input type="hidden" name="paypalmode" id="paypalmode" value="<?php echo $paypalProcess['mode']; ?>"  />
                        <input type="hidden" name="paypalEmail" id="paypalEmail" value="<?php echo $paypalProcess['merchant_email']; ?>"  />                        
						
						<div id="complete-payment">
						
	
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                    <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_enter_bill') != '') { echo stripslashes($this->lang->line('checkout_enter_bill')); } else echo "Enter your billing address"; ?></small></dt>
                                   
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										<dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                         <dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										
									</dl>
									<dl class="payment-card">
                                        <dt><b>&nbsp;</b> <small>&nbsp;</small></dt>
										
										<dd>
                                        <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b>*</b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                    <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                    <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>

		
							<div class="cart-payment">
								<dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
									<dd>
										<ul>
											<li class="first">
												<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal,2,'.',''); ?></b> <?php echo $$currencyType;?></span>
											</li>

											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal,2,'.',''); ?></b> <?php echo $$currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                              <input id="total_price" name="total_price" value="<?php echo number_format($GiftViewTotal,2,'.',''); ?>" type="hidden">
                              <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                              
							<input name="PaypalSubmit" id="PaypalSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         
                        </form> 
					</div>
            <div class="cart-payment-wrap card-payment new-card-payment" id="CreditCardPay" style="display:<?php if (($paypal_ipn_settings['status'] == 'Disable' && $authorize_net_settings['status'] == 'Enable') || ($paypal_ipn_settings['status'] == 'Disable' && $paypal_credit_card_settings['status'] == 'Enable')){echo 'block';}else {echo 'none';}?>;"> 
                    
					 <script>$(document).ready(function(){	$("#PaymentGiftCreditForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });</script> 
						<form name="PaymentGiftCreditForm" id="PaymentGiftCreditForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentCreditGift" autocomplete="off">
						<div id="complete-payment">

	
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                    <dt><b><?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?></b> <small><?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?></small></dt>
                                    <dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										
										<dd>
                                        <label for="payment-card-number"><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?> <b>*</b></label>
											<input id="cardNumber" name="cardNumber" class="required" maxlength="16" size="16" type="text">
                                            <p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p>
		
										</dd>
                                        <dd>
                                         <label for="payment-card-number"><?php if($this->lang->line('checkout_card_type') != '') { echo stripslashes($this->lang->line('checkout_card_type')); } else echo "Card Type"; ?> <b>*</b></label>
   											<select id="cardType" name="cardType" class="select-round select-white select-country selectBox required">
                                            <option value="Amex"><?php if($this->lang->line('american_express') != '') { echo stripslashes($this->lang->line('american_express')); } else echo "American Express"; ?></option>
                                            <option value="Visa"><?php if($this->lang->line('visa') != '') { echo stripslashes($this->lang->line('visa')); } else echo "Visa"; ?></option>
                                            <option value="MasterCard"><?php if($this->lang->line('master_card') != '') { echo stripslashes($this->lang->line('master_card')); } else echo "Master Card"; ?></option>
                                            <option value="Discover"><?php if($this->lang->line('discover') != '') { echo stripslashes($this->lang->line('discover')); } else echo "Discover"; ?></option>
                                            </select>
                                           <p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p>
										</dd>
										<dd>
                                        <label for="payment-card-expiration"><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?> <b>*</b></label>
                                        <?php $Sel ='selected="selected"';  ?>
											<select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
												
												<option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
												<option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
												<option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
												<option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
												<option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
												<option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
												<option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
												<option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
												<option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
												<option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
												<option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
												<option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
											</select>
                                            
                                            
											<select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
											<?php for($i=date('Y');$i< (date('Y') + 25);$i++){ ?>	
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>    
											</select>
                                            
										</dd>
										<dd>
                                        <label for="payment-card-security"><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
		
											<input style="width:63px;" id="payment-card-security" name="creditCardIdentifier" class="input-code required number" type="password">
											<a href="#" class="tooltip" onClick="$('.card-back').show();return false;"><?php if($this->lang->line('checkout_what_this') != '') { echo stripslashes($this->lang->line('checkout_what_this')); } else echo "What is this?"; ?></a>
                                            <p class="error"><?php if($this->lang->line('checkout_enter_sc') != '') { echo stripslashes($this->lang->line('checkout_enter_sc')); } else echo "Please enter security code"; ?>.</p>
											<dl class="card-back">
                                                <dt><?php if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)"; ?></dt>
												<dd>
													<img src="images/card-back.gif" alt="">
                                                     <?php if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front"; ?>.
													<a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a>
												</dd>
											</dl>
										</dd>
									</dl>
									<dl class="payment-card">
                                        <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_billing_enter') != '') { echo stripslashes($this->lang->line('checkout_billing_enter')); } else echo "Enter your billing and shipping address"; ?></small></dt>
		
										<dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                         <dd>
                                        <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										<dd>
                                        <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b>*</b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                    <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                    <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
								
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>






							
							<div class="cart-payment">
                                <dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
									<dd>
										<ul>
											<li class="first">
												<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal,2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($GiftViewTotal,2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                             <input id="total_price" name="total_price" value="<?php echo number_format($GiftViewTotal,2,'.',''); ?>" type="hidden">
                              <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                             <?php if ($authorize_net_settings['status'] == 'Enable'){ ?>
                              <input type="hidden" name="creditvalue" id="creditvalue" value="authorize" />
                              
                              <?php }elseif($paypal_credit_card_settings['status'] == 'Enable'){ ?>
                               <input type="hidden" name="creditvalue" id="creditvalue" value="paypaldodirect" />
                              <?php } ?>
							<input name="CreditSubmit" id="CreditSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                                
								

							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         </form>
                         
					</div>
		
        <?php 
			}elseif($this->uri->segment(2)=='subscribe'){
				$checkSub = @explode('|',$SubCribViewTotal);
		?>       
             
            
            <div class="cart-payment-wrap card-payment new-card-payment" id="CreditCardPay" style="display:<?php if ($paypal_credit_card_settings['status'] == 'Enable'){echo 'block';}else {echo 'none';}?>;"> 
                    
					 <script>$(document).ready(function(){	$("#PaymentSubscribeForm").validate();
					  
					  $.validator.addMethod("ValidZipCode", function( value, element ) {
								var result = this.optional(element) || value.length >= 3;
												if (!result) {
													return false;
												}
												else{
												return true;
												}
							}, "Please Enter the Correct ZipCode");
					  
					   });</script> 
						<form name="PaymentSubscribeForm" id="PaymentSubscribeForm" method="post" enctype="multipart/form-data" action="site/checkout/PaymentCreditSubscribe">
						<div id="complete-payment">

	
							<div class="hotel-booking-left">
								<dl class="payment-personal">
                                   <dt><b><?php if($this->lang->line('checkout_cc_info') != '') { echo stripslashes($this->lang->line('checkout_cc_info')); } else echo "Credit Card Information"; ?></b> <small><?php if($this->lang->line('checkout_visa_mster') != '') { echo stripslashes($this->lang->line('checkout_visa_mster')); } else echo "Visa, MasterCard, Discover or American Express"; ?></small></dt>
                                    <dd class="comment"><b>*</b>  = <?php if($this->lang->line('checkout_mand_fields') != '') { echo stripslashes($this->lang->line('checkout_mand_fields')); } else echo "Mandatory fields"; ?></dd>
									<dd>
                                    <label for="payment-personal-name-fst"><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?> <b>*</b></label>
											<input name="full_name" id="full_name" type="text" class="required" value="<?php echo $userDetails->row()->full_name; ?>" />
										</dd>
										
										<dd>
                                         <label for="payment-card-number"><?php if($this->lang->line('checkout_card_no') != '') { echo stripslashes($this->lang->line('checkout_card_no')); } else echo "Card Number"; ?> <b>*</b></label>
											<input id="cardNumber" name="cardNumber" class="required" maxlength="16" size="16" type="text">
                                           <p class="error"><?php if($this->lang->line('checkout_enter_cardno') != '') { echo stripslashes($this->lang->line('checkout_enter_cardno')); } else echo "Please enter valid card number"; ?>.</p>
		
										</dd>
                                        <dd class="select-card">
                                            <label for="payment-card-type1" class="payment-card-type1"></label> 
											<label for="payment-card-type2" class="payment-card-type2"></label>
											<label for="payment-card-type3" class="payment-card-type3"></label>
											<label for="payment-card-type4" class="payment-card-type4"></label>
                                           <p class="error"><?php if($this->lang->line('checkout_select_card') != '') { echo stripslashes($this->lang->line('checkout_select_card')); } else echo "Please select card"; ?>.</p>
										</dd>
		
										<dd>
                                       <label for="payment-card-expiration"><?php if($this->lang->line('checkout_exp_date') != '') { echo stripslashes($this->lang->line('checkout_exp_date')); } else echo "Expiration Date"; ?> <b>*</b></label>
                                        <?php $Sel ='selected="selected"';  ?>
											<select id="CCExpDay" name="CCExpDay" class="select-round select-white select-date selectBox required">
												
												<option value="01" <?php if(date('m')=='01'){ echo $Sel;} ?>>01</option>
												<option value="02" <?php if(date('m')=='02'){ echo $Sel;} ?>>02</option>
												<option value="03" <?php if(date('m')=='03'){ echo $Sel;} ?>>03</option>
												<option value="04" <?php if(date('m')=='04'){ echo $Sel;} ?>>04</option>
												<option value="05" <?php if(date('m')=='05'){ echo $Sel;} ?>>05</option>
												<option value="06" <?php if(date('m')=='06'){ echo $Sel;} ?>>06</option>
												<option value="07" <?php if(date('m')=='07'){ echo $Sel;} ?>>07</option>
												<option value="08" <?php if(date('m')=='08'){ echo $Sel;} ?>>08</option>
												<option value="09" <?php if(date('m')=='09'){ echo $Sel;} ?>>09</option>
												<option value="10" <?php if(date('m')=='10'){ echo $Sel;} ?>>10</option>
												<option value="11" <?php if(date('m')=='11'){ echo $Sel;} ?>>11</option>
												<option value="12" <?php if(date('m')=='12'){ echo $Sel;} ?>>12</option>
											</select>
                                            
                                            
											<select id="CCExpMnth" name="CCExpMnth" class="select-round select-white select-date selectBox required">
											<?php for($i=date('Y');$i< (date('Y') + 25);$i++){ ?>	
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>    
											</select>
                                            
										</dd>
										<dd>
                                        <label for="payment-card-security"><?php if($this->lang->line('checkout_security_code') != '') { echo stripslashes($this->lang->line('checkout_security_code')); } else echo "Security Code"; ?></label>
		
											<input style="width:63px;" id="payment-card-security" name="creditCardIdentifier" class="input-code required number" type="password">
											<a href="#" class="tooltip" onClick="$('.card-back').show();return false;">What is this?</a>
                                            <p class="error">Please enter security code.</p>
											<dl class="card-back">
                                               <dt><?php if($this->lang->line('checkout_cvc_cvs') != '') { echo stripslashes($this->lang->line('checkout_cvc_cvs')); } else echo "Security Code (CVC or CVS)"; ?></dt>
												<dd>
													<img src="images/card-back.gif" alt="">
                                                    <?php if($this->lang->line('checkout_last_three') != '') { echo stripslashes($this->lang->line('checkout_last_three')); } else echo "Last three digits on the back of your card is the CVC or CVV number"; ?>.<br>&nbsp;<br><?php if($this->lang->line('checkout_for_ameri') != '') { echo stripslashes($this->lang->line('checkout_for_ameri')); } else echo "For American Express there is a four digit code on the front"; ?>.
													<a href="#" onClick="$('.card-back').hide();return false;" title="Close"></a>
												</dd>
											</dl>
										</dd>
									</dl>
									<dl class="payment-card">
                                      <dt><b><?php if($this->lang->line('checkout_billing_addr') != '') { echo stripslashes($this->lang->line('checkout_billing_addr')); } else echo "Billing Address"; ?></b> <small><?php if($this->lang->line('checkout_billing_enter') != '') { echo stripslashes($this->lang->line('checkout_billing_enter')); } else echo "Enter your billing and shipping address"; ?></small></dt>
		
										<dd>
                                       <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> <b>*</b></label>
		
											<input id="address" name="address" type="text" class="required" value="<?php echo $userDetails->row()->address; ?>">

										</dd>
                                         <dd>
                                       <label for="payment-adds-1"><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?> 2</label>
		
											<input id="address2" name="address2" type="text" class="" value="<?php echo $userDetails->row()->address2; ?>">

										</dd>
										<dd>
                                        <label for="payment-city"><?php if($this->lang->line('header_city') != '') { echo stripslashes($this->lang->line('header_city')); } else echo "City"; ?> <b>*</b></label>
											<input id="city" name="city" type="text" class="required" value="<?php echo $userDetails->row()->city; ?>">
										</dd>
										<dd>
                                         <label for="payment-state"><?php if($this->lang->line('checkout_state') != '') { echo stripslashes($this->lang->line('checkout_state')); } else echo "State"; ?> <b>*</b></label>
											<input id="state" name="state" type="text" class="required" value="<?php echo $userDetails->row()->state; ?>">
										</dd>
                                        <dd>
                                        <label for="payment-state"><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo "Country"; ?> <b>*</b></label>
											<select id="country" name="country" class="select-round select-white select-country selectBox required">
												<option value="">-------------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "SELECT"; ?> --------------------</option>											
                                            <?php foreach($countryList->result() as $cntyRow){ ?>	
												<option value="<?php echo $cntyRow->country_code; ?>" <?php if($cntyRow->country_code == $userDetails->row()->country){ echo 'selected="selected"';} ?> ><?php echo $cntyRow->name; ?></option>
                                            <?php } ?>    
											</select>
										</dd>
										<dd>
                                     <label for="payment-zipcode"><?php if($this->lang->line('checkout_zip_code') != '') { echo stripslashes($this->lang->line('checkout_zip_code')); } else echo "Zip Code"; ?> <b>*</b></label> 
									<input id="postal_code" name="postal_code" type="text" class="required ValidZipCode" value="<?php echo $userDetails->row()->postal_code; ?>">
								</dd>
                                <dd>
                                   <label for="payment-phone"><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?> <b>*</b></label> 
									<input id="phone_no" name="phone_no" type="text" class="required number" value="<?php echo $userDetails->row()->phone_no; ?>">
								</dd>
								</dl>
                                <div class="hotel-booking-noti"><big><?php if($this->lang->line('checkout_secure_trans') != '') { echo stripslashes($this->lang->line('checkout_secure_trans')); } else echo "Secure Transaction"; ?></big><?php if($this->lang->line('checkout_ssl') != '') { echo stripslashes($this->lang->line('checkout_ssl')); } else echo "SSL Encrypted transaction powered by"; ?> <?php echo $siteTitle;?></div>
							</div>

							
							<div class="cart-payment">
                                <dl class="cart-payment-order">
									<dt><?php if($this->lang->line('checkout_order') != '') { echo stripslashes($this->lang->line('checkout_order')); } else echo "Order"; ?></dt>
									<dd>
										<ul>
											<li class="first">
												<span class="order-payment-type"><?php if($this->lang->line('checkout_item_total') != '') { echo stripslashes($this->lang->line('checkout_item_total')); } else echo "Item total"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkSub[0],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('referrals_shipping') != '') { echo stripslashes($this->lang->line('referrals_shipping')); } else echo "Shipping"; ?></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkSub[1],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
											<li>
												<span class="order-payment-type"><?php if($this->lang->line('checkout_tax') != '') { echo stripslashes($this->lang->line('checkout_tax')); } else echo "Tax"; ?> </span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkSub[2],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>

											<li class="total">
												<span class="order-payment-type"><b><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></b></span>
												<span class="order-payment-usd"><b><?php echo $currencySymbol;?><?php echo number_format($checkSub[3],2,'.',''); ?></b> <?php echo $currencyType;?></span>
											</li>
										</ul>
									</dd>
								</dl>
							</div>

                              <input id="total_price" name="total_price" value="<?php echo number_format($SubCribViewTotal[3],2,'.',''); ?>" type="hidden">
                               <input id="email" name="email" value="<?php echo $userDetails->row()->email; ?>" type="hidden">
                               <input id="invoiceNumber" name="invoiceNumber" value="<?php echo $this->session->userdata('InvoiceNo'); ?>" type="hidden">
							<input name="CreditSubscribeSubmit" id="CreditSubscribeSubmit" class="button-complete" type="submit" value="<?php if($this->lang->line('checkout_comp_pay') != '') { echo stripslashes($this->lang->line('checkout_comp_pay')); } else echo "Complete Payment"; ?>" style="cursor:pointer;"  />
                                
								

							<div class="waiting"><?php if($this->lang->line('checkout_processing') != '') { echo stripslashes($this->lang->line('checkout_processing')); } else echo "Processing"; ?>...</div>
							<div class="card-payment-foot"><?php if($this->lang->line('checkout_by_place') != '') { echo stripslashes($this->lang->line('checkout_by_place')); } else echo "By placing your order, you agree to the Terms"; ?> &amp; <?php if($this->lang->line('checkout_codtn_privacy') != '') { echo stripslashes($this->lang->line('checkout_codtn_privacy')); } else echo "Conditions and Privacy Policy"; ?>.</div>


						</div>
                         </form>
                         
					</div> 
 
		
        <?php }
        ?>
			</div> 
	  </div> 
	  <!-- / content -->

  <!-- / container -->
</div> 
	<!-- / wrapper-content -->
 

<?php 
     $this->load->view('site/templates/footer_menu');
     ?>

<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>


</body>
</html>