<?php 
				$productionMode = '1';
				$actionURL = 'https://www.paypal.com/cgi-bin/webscr';
	//			$actionURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
				
				
				
				$return_url = base_url().'payment-success?msg=success&trans='.$code.'&modeVal='.$admin_id.'&sellId='.$seller_id;
				$cancel_url = base_url().'payment-failed';
				$notify_url = base_url().'payment-failed';
				$item_amount = $amount;
				$errorLog = 'ipn_errorlog.txt';
?>
<h2>Please Wait...</h2>
<!-- 
<img src="<?php echo base_url();?>images/ajax-loader.gif" style="padding:100px 0 0 419px;"/> -->
<form name="_xclick" action="<?php echo $actionURL; ?>" method="post" >
 <input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
<input type="hidden" name="receiver_email" value="<?php echo $paypal_email; ?>" />
<input type='hidden' name='rm' value='2' />
<input type='hidden' name='charset' value='ISO-8859-1' />
<input type='hidden' name='no_note' value='1' />
<input type="hidden" name="item_id" value="<?php echo $randNumber; ?>" />
<input type="hidden" name="item_name" value="Vendor Commission Payment"/>
<!-- <input type="hidden" name="custom" value="<?php echo $randNumber.'|1'; ?>" /> -->
<input type="hidden" name="currency_code" value="<?php echo $currencyType;?>"> 
<input type="hidden" name="c_price" value="<?php echo $item_amount; ?>">
<input type="hidden" name="amount" id="amount"  value="<?php echo $item_amount; ?>"   />
<input type="hidden" name="return" value="<?php echo $return_url; ?>" />
<input type="hidden" name="cancel_return" value="<?php echo $cancel_url; ?>" />
</form>
             
<script type="text/javascript">
document.forms["_xclick"].submit();	
</script> 