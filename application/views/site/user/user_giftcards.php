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
		<h2 class="ptit"><?php if($this->lang->line('giftcard_cards') != '') { echo stripslashes($this->lang->line('giftcard_cards')); } else echo "Gift Cards"; ?></h2>
<?php 
                if($giftcardsList->num_rows()>0){
                ?>	
                 <div class=" section gifts">
            <h3><?php if($this->lang->line('giftcard_urlist') != '') { echo stripslashes($this->lang->line('giftcard_urlist')); } else echo "Your giftcards lis"; ?>t.</h3>
                	<div class="chart-wrap">
            <table class="chart">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('giftcard_code') != '') { echo stripslashes($this->lang->line('giftcard_code')); } else echo "Code"; ?></th>
                        <th><?php if($this->lang->line('giftcard_sendername') != '') { echo stripslashes($this->lang->line('giftcard_sendername')); } else echo "Sender Name"; ?></th>
                        <th><?php if($this->lang->line('giftcard_sender_mail') != '') { echo stripslashes($this->lang->line('giftcard_sender_mail')); } else echo "Sender Mail"; ?></th>
                        <th><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></th>
                        <th><?php if($this->lang->line('giftcard_expireson') != '') { echo stripslashes($this->lang->line('giftcard_expireson')); } else echo "Expires on"; ?></th>
                        <th><?php if($this->lang->line('giftcard_card_stats') != '') { echo stripslashes($this->lang->line('giftcard_card_stats')); } else echo "Card Status"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($giftcardsList->result() as $row){
                    	$status = $row->card_status;
                    	if ($status == 'not used'){
                    		$expDate = strtotime($row->expiry_date);
                    		if ($expDate<time()){
                    			$status = 'expired';
                    		}
                    	}
                    ?>
                    <tr>
                        <td><?php echo $row->code;?></td>
                        <td><?php echo $row->sender_name;?></td>
                        <td><?php echo $row->sender_mail;?></td>
                        <td><?php echo $row->price_value;?></td>
                        <td><?php echo $row->expiry_date;?></td>
                        <td><?php echo ucwords($status);?></td>
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
			</div>
            <p>
				<a href="gift-cards"><?php if($this->lang->line('giftcard_send') != '') { echo stripslashes($this->lang->line('giftcard_send')); } else echo "Send a Gift Card"; ?></a>
			</p>
			</div>
                <?php	
                }else {
                ?>
		<div class="section giftcard no-data">
			
			<span class="icon"><i class="ic-card"></i></span>
			<p>
				<?php if($this->lang->line('giftcard_not_receive') != '') { echo stripslashes($this->lang->line('giftcard_not_receive')); } else echo "You haven't received any gift cards yet"; ?>.
				<br>
				<a href="gift-cards"><?php if($this->lang->line('giftcard_send') != '') { echo stripslashes($this->lang->line('giftcard_send')); } else echo "Send a Gift Card"; ?></a>
		</p>
			
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
