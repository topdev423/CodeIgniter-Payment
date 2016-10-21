<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<!-- Section_start -->
<div id="container-wrapper">
	<div class="container set_area">
		


        <div id="content">
                <h2 class="ptit"><?php if($this->lang->line('referrals_orders') != '') { echo stripslashes($this->lang->line('referrals_orders')); } else echo "Orders"; ?></h2>
                <?php 
                if($ordersList->num_rows()>0){
                ?>	
                 <div class=" section gifts">
            <h3><?php if($this->lang->line('order_history') != '') { echo stripslashes($this->lang->line('order_history')); } else echo "Order history for your products"; ?>.</h3>
                	<div class="chart-wrap">
            <table class="chart" id="orderListTable">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('purchases__invoice') != '') { echo stripslashes($this->lang->line('purchases__invoice')); } else echo "Invoice"; ?></th>
                        <th><?php if($this->lang->line('purchases__paystatus') != '') { echo stripslashes($this->lang->line('purchases__paystatus')); } else echo "Payment Status"; ?></th>
                        <th><?php if($this->lang->line('purchases_shipstatus') != '') { echo stripslashes($this->lang->line('purchases_shipstatus')); } else echo "Shipping Status"; ?></th>
<!--                         <th><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></th> -->
                        <th><?php if($this->lang->line('purchases_orddate') != '') { echo stripslashes($this->lang->line('order_date')); } else echo "Date"; ?></th>
                        <th><?php if($this->lang->line('purchases_option') != '') { echo stripslashes($this->lang->line('purchases_option')); } else echo "Option"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordersList->result() as $row){?>
                    <tr>
                        <td>#<?php echo $row->dealCodeNumber;?></td>
                        <td><?php echo $row->status;?></td>
                        
                        <td>
                        <select onchange="javascript:changeShipStatus(this.value,'<?php echo $row->dealCodeNumber;?>','<?php echo $row->sell_id;?>')">
                        	<option <?php if ($row->shipping_status == 'Pending'){echo 'selected="selected"';}?> value="Pending"><?php if($this->lang->line('order_pending') != '') { echo stripslashes($this->lang->line('order_pending')); } else echo "Pending"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Processed'){echo 'selected="selected"';}?> value="Processed"><?php if($this->lang->line('order_processed') != '') { echo stripslashes($this->lang->line('order_processed')); } else echo "Processed"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Delivered'){echo 'selected="selected"';}?> value="Delivered"><?php if($this->lang->line('order_delivered') != '') { echo stripslashes($this->lang->line('order_delivered')); } else echo "Delivered"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Returned'){echo 'selected="selected"';}?> value="Returned"><?php if($this->lang->line('order_returnred') != '') { echo stripslashes($this->lang->line('order_returnred')); } else echo "Returned"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Re-Shipped'){echo 'selected="selected"';}?> value="Re-Shipped"><?php if($this->lang->line('order_reshipp') != '') { echo stripslashes($this->lang->line('order_reshipp')); } else echo "Re-Shipped"; ?></option>
                        	<option <?php if ($row->shipping_status == 'Cancelled'){echo 'selected="selected"';}?> value="Cancelled"><?php if($this->lang->line('order_cancelled') != '') { echo stripslashes($this->lang->line('order_cancelled')); } else echo "Cancelled"; ?></option>
                        </select>
                        <img alt="Loading" style="display: none;" class="status_loading_<?php echo $row->dealCodeNumber;?>" src="images/site/ajax-loader.gif"/>
                        </td>
<!--                         <td><?php echo $row->TotalPrice;?></td>
      -->                   
                        <td><?php echo $row->created;?></td>
                        <td>
<!--                         <a target="_blank" href="view-order/<?php echo $row->sell_id;?>/<?php echo $row->dealCodeNumber;?>"><?php if($this->lang->line('purchases_view') != '') { echo stripslashes($this->lang->line('purchases_view')); } else echo "View"; ?></a> -->
                        <a style="color:green;" target="_blank" href="view-order/<?php echo $row->sell_id;?>/<?php echo $row->dealCodeNumber;?>"><?php if($this->lang->line('view_invoice') != '') { echo stripslashes($this->lang->line('view_invoice')); } else echo "View Invoice"; ?></a><br/>
                        <a style="color:red;" href="order-review/<?php echo $row->user_id;?>/<?php echo $row->sell_id;?>/<?php echo $row->dealCodeNumber;?>"><?php if($this->lang->line('buyer_discuss') != '') { echo stripslashes($this->lang->line('buyer_discuss')); } else echo "Buyer Discussion"; ?></a>
                        </td>
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
			</div>
			</div>
                 <?php	
                }else {
                ?>
                <div class=" section purchases no-data">
                        <span class="icon"><i class="ic-gifts"></i></span>
                        <p><?php if($this->lang->line('order_no_products') != '') { echo stripslashes($this->lang->line('order_no_products')); } else echo "No orders on your products."; ?></p>
                </div>
                <?php 
                }
                ?>
        </div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
     $this->load->view('site/templates/side_footer_menu');
     ?>
	</div>
	<!-- / container -->
</div>
</div>

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
