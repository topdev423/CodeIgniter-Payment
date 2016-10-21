<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<!-- Section_start -->
<div id="container-wrapper">
	<div class="container set_area">
		 <?php 
	   		$credits_mine = str_replace("{SITENAME}",$siteTitle,$this->lang->line('credit_mine'));
			$credit_earn_credit = str_replace("{SITENAME}",$siteTitle,$this->lang->line('credit_earn_credit'));
	   ?>
<div id="content">

		<h2 class="ptit"><?php if($this->lang->line('my_earnings') != '') { echo $this->lang->line('my_earnings'); } else echo "My Earnings"; ?></h2>
		<div class="section credit">
			<p class="status"><?php if($this->lang->line('credit_totearn') != '') { echo stripslashes($this->lang->line('credit_totearn')); } else echo "Total Earned"; ?><br>
			<b><?php echo $currencySymbol;?><?php echo number_format($except_refunded,2);?> <?php echo $currencyType;?></b><br>
			</p>
			<ul class="credit-step">
				<li><b><?php echo $total_orders;?></b> <?php if($this->lang->line('total_orders') != '') { echo stripslashes($this->lang->line('total_orders')); } else echo "Total Orders"; ?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($total_amount,2);?></b> <?php if($this->lang->line('total_amt') != '') { echo stripslashes($this->lang->line('total_amt')); } else echo "Total Amount"; ?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($userDetails->row()->refund_amount,2);?></b> <?php if($this->lang->line('refu_amt') != '') { echo stripslashes($this->lang->line('refu_amt')); } else echo "Refunded Amount"; ?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($except_refunded,2);?></b> <?php if($this->lang->line('except_refunded') != '') { echo stripslashes($this->lang->line('except_refunded')); } else echo "Except Refunded"; ?></li>
			</ul>
			<ul class="credit-step">
				<li><b><?php echo $currencySymbol;?><?php echo number_format($commission_to_admin,2);?></b> <?php if($this->lang->line('commission_to') != '') { echo stripslashes($this->lang->line('commission_to')); } else echo "Commission to"; ?> <?php echo $siteTitle;?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($amount_to_vendor,2);?></b> <?php if($this->lang->line('except_commission') != '') { echo stripslashes($this->lang->line('except_commission')); } else echo "Except Commission"; ?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($paid_to,2);?></b> <?php if($this->lang->line('received_amount') != '') { echo stripslashes($this->lang->line('received_amount')); } else echo "Received Amount"; ?></li>
				<li><b><?php echo $currencySymbol;?><?php echo number_format($paid_to_balance,2);?></b> <?php if($this->lang->line('pend_amount') != '') { echo stripslashes($this->lang->line('pend_amount')); } else echo "Pending Amount"; ?></li>
			</ul>
			<h4><?php if($this->lang->line('rece_history') != '') { echo stripslashes($this->lang->line('rece_history')); } else echo "Received History"; ?></h4>
			<table class="simple">
				<colgroup>
					<col width="110">
					<col width="300">
					<col>
					<col width="90">
				</colgroup>
				<thead>
					<tr>
						<th><?php if($this->lang->line('trans_id') != '') { echo stripslashes($this->lang->line('trans_id')); } else echo "Transaction Id"; ?></th>
						<th><?php if($this->lang->line('pay_type') != '') { echo stripslashes($this->lang->line('pay_type')); } else echo "Payment Type"; ?></th>
						<th><?php if($this->lang->line('order_date') != '') { echo stripslashes($this->lang->line('order_date')); } else echo "Date"; ?></th>
						<th><?php if($this->lang->line('credit_amount') != '') { echo stripslashes($this->lang->line('credit_amount')); } else echo "Amount"; ?></th>
					</tr>
				</thead>
				<tbody>
<?php 
if ($paidDetailsList->num_rows()>0){
	foreach ($paidDetailsList->result() as $paidDetailsListRow){
?>
					<tr>
						<td>#<?php echo $paidDetailsListRow->transaction_id;?></td>
						<td><?php echo $paidDetailsListRow->payment_type;?></td>
						<td><?php echo $paidDetailsListRow->date;?></td>
						<td><?php echo $paidDetailsListRow->amount;?></td>
					</tr>				
<?php 
	}
}else {
?>                    
                    <tr>
                        <td colspan="4" class="no-data"><?php if($this->lang->line('credit_no_history') != '') { echo stripslashes($this->lang->line('credit_no_history')); } else echo "No history found."; ?></td>
                    </tr>
<?php 
}
?>                    
				</tbody>
			</table>
		</div>
	</div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
     $this->load->view('site/templates/side_footer_menu');
     ?>

	</div>
	<!-- / container -->
</div>
</div>

<!-- Section_start -->
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>
<script>
	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<script>
<?php 
$this->load->view('site/templates/footer');
?>
