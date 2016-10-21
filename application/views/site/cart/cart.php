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
	<div class="container ">
		
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
        
	<div class="wrapper-content order" >
	  <div id="content" style="padding:0px 20px 20px 20px;">
	    <ol class="cart-order-depth">
	      <li class="depth1 current"><span>1</span><?php if($this->lang->line('cart_shop_cart') != '') { echo stripslashes($this->lang->line('cart_shop_cart')); } else echo "Shopping Cart"; ?></li>
	      <li class="depth2"><span>2</span><?php if($this->lang->line('cart_pay_mthd') != '') { echo stripslashes($this->lang->line('cart_pay_mthd')); } else echo "Payment Method"; ?></li>
	      <li class="depth3"><span>3</span><?php if($this->lang->line('cart_ord_confirm') != '') { echo stripslashes($this->lang->line('cart_ord_confirm')); } else echo "Order Confirmation"; ?></li>
	    </ol>

	<div class="cart-list">
        
          <?php echo $cartViewResults; ?>
	      
	    </div>
	  </div>
	  <!-- / content -->
	</div>
	<!-- / wrapper-content -->
 
<?php 
     $this->load->view('site/templates/footer_menu');
     ?>

<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>

<script>
	$("#shippingAddForm").validate();
	
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
    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
            
            
        });
    });
</script>

</body>
</html>