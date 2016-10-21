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
                <h2 class="ptit"><?php if($this->lang->line('referrals_subscribe') != '') { echo stripslashes($this->lang->line('referrals_subscribe')); } else echo "Subscriptions"; ?></h2>
                <?php 
                if($subscribeList->num_rows()>0){
                ?>	
                 <div class=" section gifts">
            <h3><?php if($this->lang->line('manage_subsc_list') != '') { echo stripslashes($this->lang->line('manage_subsc_list')); } else echo "Your subscriptions list."; ?></h3>
                	<div class="chart-wrap">
            <table class="chart">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('purchases__invoice') != '') { echo stripslashes($this->lang->line('purchases__invoice')); } else echo "Invoice"; ?></th>
                        <th><?php if($this->lang->line('manage_subsname') != '') { echo stripslashes($this->lang->line('manage_subsname')); } else echo "Subscription Name"; ?></th>
                        <th><?php if($this->lang->line('purchases_total') != '') { echo stripslashes($this->lang->line('purchases_total')); } else echo "Total"; ?></th>
                        <th><?php if($this->lang->line('order_date') != '') { echo stripslashes($this->lang->line('order_date')); } else echo "Date"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscribeList->result() as $row){?>
                    <tr>
                        <td>#<?php echo $row->invoice_no;?></td>
                        <td><?php echo $row->name;?></td>
                        <td><?php echo $row->total;?></td>
                        
                        <td><?php echo $row->created;?></td>
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
			</div>
			</div>
                <?php	
                }else {
                ?>
                <div class=" section subscription no-data">
		            <span class="icon"><i class="ic-sub"></i></span>
 		            <p><?php if($this->lang->line('manage_not_subs') != '') { echo stripslashes($this->lang->line('manage_not_subs')); } else echo "You haven't subscribed to anything yet."; ?></p> 
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


<!-- Section_start -->

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
