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
	      <li class="depth2"><span>2</span><?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?></li>
	      <li class="depth3 current"><span>3</span><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></li>
	    </ol>
            <div class="cart-list chept2">
					<h2><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></h2>
					
			<?php if($Confirmation =='Success'){ ?>                    
					<div class="cart-payment-wrap card-payment new-card-payment">
						<strong><?php if($this->lang->line('order_tran_sucss') != '') { echo stripslashes($this->lang->line('order_tran_sucss')); } else echo "Your Transaction Success"; ?></strong>
                        <div class="payment_success"><img src="images/site/success_payment.png" /></div>
					</div>
                    
            <?php
			 $this->output->set_header('refresh:5;url='.base_url().'purchases'); 
			 }elseif($Confirmation =='Failure'){ ?>        
            
            					<div class="cart-payment-wrap card-payment new-card-payment">
				<strong><?php if($this->lang->line('order_tran_failure') != '') { echo stripslashes($this->lang->line('order_tran_failure')); } else echo "Your Transaction Failure"; ?></strong>
                <div class="payment_success"><b><?php echo urldecode($errors); ?></b></div>
                        <div class="payment_success"><img src="images/site/failure_payment.png" /></div>
					</div>

            
            <?php
			 $this->output->set_header('refresh:5;url='.base_url().'cart'); 
			 } 
			 
			 if($this->uri->segment(3) == 'subscribe'){
			 	$this->output->set_header('refresh:5;url='.base_url().'fancyybox/manage'); 
			 }elseif($this->uri->segment(3) == 'gift'){
			 	$this->output->set_header('refresh:5;url='.base_url().'settings/giftcards'); 
			 }elseif($this->uri->segment(3) == 'cart'){
			 	$this->output->set_header('refresh:5;url='.base_url().'purchases'); 
			 }
			  ?>
            



				</div>
	  </div>
	  <!-- / content -->
	</div>
        
	
	
 

<?php 
     $this->load->view('site/templates/footer_menu');
     ?>

<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>


</body>
</html>