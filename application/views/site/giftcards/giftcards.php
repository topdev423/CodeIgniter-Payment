<?php 
$this->load->view('site/templates/header.php');
?>
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css"/>
<style type="text/css" media="screen">
#edit-details { font-size: 11px; color: #f33; }
.option-area select.option {height:22px;margin:5px 0 12px 0;border:1px solid #D1D3D9;box-shadow:1px 1px 1px #EEE;border-radius:3px;}
a.selectBox.option {margin:5px 0 10px 0;padding:3px 0 3px}
a.selectBox.option .selectBox-label {padding-left:10px;font:inherit !important}
</style>

	<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>

<div class="lang-en wider no-subnav thing signed-out winOS">
<div id="container-wrapper">
	<div class="container ">
		
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
        
		<div class="wrapper-content right-sidebar">
			<div id="content">
				<div class="figure-row first">
					<div class="figure-product figure-640 big">
						
						<figure>
							<span class="wrapper-fig-image">
								<span class="fig-image"><img src="images/giftcards/<?php echo $this->config->item('giftcard_image'); ?>" alt="<?php echo $this->config->item('giftcard_title'); ?>" height="640" width="640"></span>
							</span>
                            
                            <figcaption><?php echo $this->config->item('giftcard_title'); ?></figcaption>
						    
                        </figure>
						
						<br class="hidden">
					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->
				<?php 
				if (count($relatedProductsArr)>0){
				?>
				<div class="might-fancy">
					<h3><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also "; ?> <?php echo LIKE_BUTTON;?>...</h3>
					<div style="height: 259px;" class="figure-row fancy-suggestions anim">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr as $relatedRow){
						if ($limitCount<3){
							$limitCount++;
						$img = 'dummyProductImage.jpg';
						$imgArr = explode(',', $relatedRow->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($imgRow != ''){
									$img = $imgRow;
									break;
								}
							}
						}
						$fancyClass = 'fancy';
						$fancyText = LIKE_BUTTON;
						if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
							foreach ($likedProducts->result() as $likeProRow){
								if ($likeProRow->product_id == $relatedRow->seller_product_id){
									$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
								}
							}
						}
					?>
							<div class="figure-product figure-200">
								<a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								<figure>
								<span class="wrapper-fig-image">
									<span class="fig-image">
										<img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
									</span>
								</span>
								<figcaption><?php echo $relatedRow->product_name;?></figcaption>
								</figure>
								</a>
								<br class="hidden">
								<span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span>
								<br class="hidden">
								<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>
							</div>
					<?php 
					}}
					?>
							</div>
				</div>
				<?php }?>
 				
			</div>
            
			<!-- / content -->

			<aside id="sidebar">
				<section class="thing-section gift-section">

                    <h3><?php echo $this->config->item('giftcard_title'); ?></h3>

					<div class="thing-description">
						
						<p><?php echo $this->config->item('giftcard_description'); ?></p>
						
					</div>
                    
                  
                    <div id="GiftErr" style="color:#FF0000;"></div>
                    <div class="gift-option-area">
                        <p class="prices" style="margin-bottom;10px;">
                            <label for="gift-value" style="font-weight:normal;margin-bottom:5px;"><?php if($this->lang->line('giftcard_value') != '') { echo stripslashes($this->lang->line('giftcard_value')); } else echo "Value"; ?></label>
                            <?php $amtVal = explode(',',$this->config->item('giftcard_amounts'));  ?>
                       <select class="select-round select-white selectBox" name="price_value" id="price_value" style="height: 31px; line-height: 21px; padding: 5px 10px; width: 198px; display: none;">
       					<?php foreach($amtVal as $amts){ ?>
	                   	<option value="<?php echo $amts; ?>" <?php if($amts == $this->config->item('giftcard_default_amount')){ echo 'selected="selected"'; }?> ><?php echo $currencySymbol.$amts; ?></option>									
						<?php }	?>
						</select>
                        </p>
						<div class="option-area">
							<label for=""><?php if($this->lang->line('giftcard_reci_name') != '') { echo stripslashes($this->lang->line('giftcard_reci_name')); } else echo "Recipient name"; ?></label>
							<input id="recipient_name" name="recipient_name" class="option required" style="height:28px;" type="text">
						</div>
						<div class="option-area">
							<label for=""><?php if($this->lang->line('giftcard_rec_email') != '') { echo stripslashes($this->lang->line('giftcard_rec_email')); } else echo "Recipient e-mail"; ?></label>
							<input id="recipient_mail" name="recipient_mail" class="option required email" style="height:28px;" type="text">
						</div>
						<div class="option-area">
							<label for=""><?php if($this->lang->line('giftcard_person_msg') != '') { echo stripslashes($this->lang->line('giftcard_person_msg')); } else echo "Personal message"; ?></label>
							<textarea type="text" id="description" name="description" class="option required" style="width:184px;height:80px;margin-top:6px;"></textarea>
						</div>
                        <?php if($loginCheck!=''){ ?>
                        	<input type="hidden" name="sender_name" id="sender_name" value="<?php echo $this->session->userdata('session_user_name'); ?>" />
                            <input type="hidden" name="sender_mail" id="sender_mail" value="<?php echo $this->session->userdata('session_user_email'); ?>" />
                        <?php } ?>
						<input type="submit" name="addtocart" id="addtocart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> class="greencart create-gift-card" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="javascript:ajax_add_gift_card();">
                        <!--<a href="#" class="greencart create-gift-card"><i class="ic-cart"></i><strong>Add to Cart</strong></a>-->
                    </div>

				
                    
					<hr>
					
				</section>
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
		</div>
		<!-- / wrapper-content -->

<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>

<script>
jQuery(function($) {
	var $select = $('select.select-white');
	$select.selectBox();
	$select.each(function(){
		var $this = $(this);
		if($this.css('display') != 'none') $this.css('visibility', 'visible');
	});
});
</script>

</body>
</html>