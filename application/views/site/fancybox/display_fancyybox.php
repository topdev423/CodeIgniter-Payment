<?php
$this->load->view('site/templates/header');
?>
<style type="text/css" media="screen">


#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;

}

</style>



 <!-- Section_start -->
<div class="lang-en wider no-subnav thing signed-out winOS">

<div id="container-wrapper">
	<div class="container ">
	<?php 
	if ($fancyboxDetail->num_rows()==1){
		$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $fancyboxDetail->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$fancyClass = 'fancy';
		$fancyText = LIKE_BUTTON;
		if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
			foreach ($likedProducts->result() as $likeProRow){
				if ($likeProRow->product_id == $fancyboxDetail->row()->id){
					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
				}
			}
		}
	?>	

				<div class="wrapper-content right-sidebar" style="background:none; box-shadow:none;">
			<div id="content" style="padding:0px; background:none;width: 680px;">
            <div class="detail_leftbar">
				<div class="figure-row first">
					<div class="figure-product figure-640 big" style="text-align: left;">
						
						<figure>
							<span class="wrapper-fig-image">
								<span class="fig-image"><img src="<?php echo base_url();?>images/fancyybox/<?php echo $img;?>" alt="<?php echo $fancyboxDetail->row()->name;?>" height="640" width="640"></span>
							</span>
                            
                            <figcaption><?php echo $fancyboxDetail->row()->name;?></figcaption>
						    
                        </figure>
						
						<br class="hidden">
						
						<p><?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?> <?php echo $siteTitle;?></p>
						

						<br class="hidden">

					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->
	</div>
				<?php 
				if ($relatedProductsArr->num_rows()>0){
				?>
                <div class="detail_leftbar1">
				<div class="might-fancy">
					<h3 class="selstory-head detail_link_list"><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also"; ?> <?php echo LIKE_BUTTON;?>...</h3>
					<div style="height: 259px;" class="figure-row fancy-suggestions anim might_box">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr->result() as $relatedRow){
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
					?>
							<div class="figure-product figure-200 might_box_list">
								<a href="<?php echo base_url();?>fancybox/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->name,'-');?>">
								<figure>
								<span class="wrapper-fig-image">
									<span class="fig-image">
										<img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/fancyybox/<?php echo $img;?>">
									</span>
								</span>
								<figcaption><?php echo $relatedRow->name;?></figcaption>
								</figure>
								</a>
								<br class="hidden">
							</div>
					<?php 
					}}
					?>
							</div>
				</div>
                </div>
				<?php }?>
				
		
            </div>
            
			<!-- / content -->

			<aside id="sidebar" style="padding:0 5px !important;">
          
				<section class="thing-section gift-section">
					<div class="detail_sidebar">
                    <h3><?php echo $fancyboxDetail->row()->name;?></h3>

					<div class="thing-description">
					<?php 
					$short_des = word_limiter($fancyboxDetail->row()->excerpt,25);
					if ($short_des == ''){
						$short_des = word_limiter($fancyboxDetail->row()->description,25);
					}
					?>	
						<p><?php echo $short_des;?> <a href="<?php echo 'fancybox/'.$fancyboxDetail->row()->id.'/'.url_title($fancyboxDetail->row()->name);?>"><?php if($this->lang->line('fancy_more') != '') { echo stripslashes($this->lang->line('fancy_more')); } else echo "more"; ?></a></p>
						
					</div>

					<ul class="figure-list after">
					
						<?php 
						$limitCount = 0;
						$imgArr = explode(',', $fancyboxDetail->row()->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($limitCount>5)break;
								if ($imgRow != '' && $imgRow != $pimg){
									$limitCount++;
						?>
						  <li><a href="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" data-bigger="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>)"></a></li>
						<?php 
								}
							}
						}
						?>
					</ul>
                                        
					<p class="prices">
						<strong class="price"><?php echo $currencySymbol;?><span><?php echo $fancyboxDetail->row()->price;?></span></strong> <?php echo $currencyType;?><br>
						
					</p>
					
					<div class="option-area">
					
					</div>
                    
				<input type="hidden" class="option number" name="name" id="name" value="<?php echo $fancyboxDetail->row()->name;?>"/>		
				<input type="hidden" class="option number" name="price" id="price" value="<?php echo $fancyboxDetail->row()->price;?>"/>	
                <input type="hidden" class="option number" name="fancybox_id" id="fancybox_id" value="<?php echo $fancyboxDetail->row()->id;?>">
                <input type="hidden" class="option number" name="user_id" id="user_id" value="<?php echo $common_user_id;?>">                
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $fancyboxDetail->row()->category_id;?>">
                <input type="hidden" class="option number" name="image" id="image" value="<?php echo $imgArr[0];?>">
                <input type="hidden" class="option number" name="shipping_cost" id="shipping_cost" value="<?php echo $fancyboxDetail->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="tax" id="tax" value="<?php echo $fancyboxDetail->row()->tax;?>">
                <input type="hidden" class="option number" name="seourl" id="seourl" value="<?php echo $fancyboxDetail->row()->seourl;?>">

				<input type="button" class="greencart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="subscribe" id="subscribe" value="<?php if($this->lang->line('fancy_subscirbe') != '') { echo stripslashes($this->lang->line('fancy_subscirbe')); } else echo "Subscribe"; ?>" onclick="javascript:ajax_add_cart_subcribe();" />
                

					
					</div>
					<hr>
                    <div class="detail_sidebar_list">
                    <h3 class="detail_link_list"><?php if($this->lang->line('actions') != '') { echo stripslashes($this->lang->line('actions')); } else echo "Actions"; ?></h3>
					<ul class="thing-info detail_thinginfo">
<?php 
	$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $fancyboxDetail->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$ownClass = '';
		if ($loginCheck != ''){
			$ownArr = explode(',', $userDetails->row()->own_products);
			if (in_array($fancyboxDetail->row()->id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
?>
						<li style="border-bottom: none;"><a href="fancybox/<?php echo $fancyboxDetail->row()->id;?>/<?php echo url_title($fancyboxDetail->row()->name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $fancyboxDetail->row()->id;?>" tname="<?php echo $fancyboxDetail->row()->name;?>" tuser="<?php if ($fancyboxDetail->row()->user_id != '0'){echo $fancyboxDetail->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/fancyybox/<?php echo $img;?>" price="<?php echo $fancyboxDetail->row()->price;?>" reacts="<?php echo $fancyboxDetail->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>

                    </ul>
                    </div>
					
					
					
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
		
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<?php 
	}else {
	?>
	<p><?php if($this->lang->line('fancy_prod_unavail') != '') { echo stripslashes($this->lang->line('fancy_prod_unavail')); } else echo "This product details not available"; ?></p>
	<?php }?>
	<!-- / container -->
</div>

</div>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<?php
$this->load->view('site/templates/footer');
?>