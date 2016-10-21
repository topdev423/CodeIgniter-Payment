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
	if ($productDetails->num_rows()==1){
		$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
        
		// checking if the product has already been rated by the user.
        $fancyClass = 'fancyr';
        $fancyText = LIKE_BUTTON;
        if($ratedProducts && count($ratedProducts)>0){
            if(array_key_exists($productDetails->row()->seller_product_id, $ratedProducts)){
                $fancyClass = 'fancyrd';
                $fancyText = LIKED_BUTTON;
            }
        }
	?>	
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
				<div class="wrapper-content right-sidebar" style="background:none; box-shadow:none;">
			<div id="content" style="padding:0px; background:none;width: 680px;">
            
            <div class="detail_leftbar">
            
				<div class="figure-row first">
					<div class="figure-product figure-640 big">
						
						<figure>
							<span class="wrapper-fig-image">
								<span class="fig-image" style="background:#FFFFFF;"><img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>"></span>
							</span>
						    
                        </figure>
                        
                        <div class="product_title">
						
                        <figcaption style="text-align:left;"><?php echo $productDetails->row()->product_name;?></figcaption>
                        
						
						<br class="hidden">
						
						<p style="text-align:left;">
						<?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?> <a class="username" href="user/<?php echo $productUserDetails->row()->user_name.'/added';?>"><?php echo $productUserDetails->row()->full_name;?></a>
						</p>
						

						<br class="hidden">
						
						<a id="prod_popup_<?php echo $productDetails->row()->seller_product_id; ?>" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> rating="true"><span><i></i></span><?php echo $fancyText;?></a>
                        
                        <a style="display: none" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button fancy <?php //echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>
                        
                        </div>
                        
                        <?php if($rating_summary){ ?>
                            <div class="single-star-rating">
                                <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating" class="imdbRating">
                                    <div class="ratingValue">
                                        <strong title="<?php echo round($rating_summary->product_avg_rating, 2); ?> based on <?php echo $rating_summary->rating_total_users; ?> user ratings">
                                            <span itemprop="ratingValue"><?php echo round($rating_summary->product_avg_rating, 2); ?></span>
                                        </strong>
                                    </div>
                                    <span itemprop="ratingCount" class="small"><?php echo $rating_summary->rating_total_users; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        
                         <ul class="detail_thing_info1" style="border-bottom: 0;padding-bottom: 0;">
                            <li><a href="user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
                            <li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="want_icon"></i>Add to list</a></li>
                            <li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="feature_icon"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        <?php if ($loginCheck != ''  && ($userDetails->row()->user_name == $productUserDetails->row()->user_name)){?>
                             <li><a id="edit-details" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?><i class="won_icon"></i></a></li>
                             <li><a style="font-size: 11px; color: #f33;" uid="<?php echo $productUserDetails->row()->id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?><i class="color_icon"></i></a></li>
                        <?php }?>   
                        </ul>           
						

					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->

				<?php 
				if ($relatedProductsArr->num_rows()>0){
				?>
                </div>
                <div class="detail_leftbar1">
				<div class="might-fancy">
					<h3 class="selstory-head detail_link_list"><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also"; ?> <?php echo LIKE_BUTTON;?>...</h3>
					<div style="height: 259px;" class="figure-row fancy-suggestions anim might_box">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr->result() as $relatedRow){
                        if($relatedRow->seller_product_id){
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
                            
                            
                            // checking if the product has already been rated by the user.
                            $fancyClass = 'fancyr';
                            $fancyText = LIKE_BUTTON;
                            if($ratedProducts && count($ratedProducts)>0){
                                if(array_key_exists($relatedRow->seller_product_id, $ratedProducts)){
                                    $fancyClass = 'fancyrd';
                                    $fancyText = LIKED_BUTTON;
                                }
                            }
					    ?>
							    <div class="figure-product figure-200 might_box_list">
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
								    <a id="prod_popup_<?php echo $relatedRow->seller_product_id; ?>" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> rating="true"><span><i></i></span><?php echo $fancyText;?></a>
							    </div>
					    <?php 
					    }
                        }
                    }
					?>
							</div>
				</div>
				<?php }?>
			</div>
            </div>
            
			<!-- / content -->
            

			<aside id="sidebar" style="padding:0px; width: 255px;">
          
				<section class="thing-section gift-section">
                
                <div class="detail_sidebar_list">
                        
							<h3 class="detail_link_list"><?php if($this->lang->line('actions') != '') { echo stripslashes($this->lang->line('actions')); } else echo "Actions"; ?></h3>
                    
					<ul class="thing-info">
<?php 
	$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
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
			if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
		if ($productDetails->row()->web_link != ''){
			$web_link = $productDetails->row()->web_link;
			if (substr($web_link, 0,4) != 'http'){
				$web_link = 'http://'.$web_link;	
			}
?>
						<li><a target="_blank" class="where" href="<?php echo $web_link;?>"><i class="buy_icon"></i><?php if($this->lang->line('buy_it') != '') { echo stripslashes($this->lang->line('buy_it')); } else echo "Buy it"; ?></a></li>
						<?php 
		}
						if ($productDetails->row()->user_id == $loginCheck){
						?>
						<li><a ntoid="15301425" ntid="<?php echo $productDetails->row()->seller_product_id;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="sell" href="#"><i class="add_icon"></i><?php if($this->lang->line('product_want_sell') != '') { echo stripslashes($this->lang->line('product_want_sell')); } else echo "I want to sell it"; ?></a></li>
						<?php 
						}
						?>
						<li><a href="user/<?php echo $productUserDetails->row()->user_name;?>/things/<?php echo $productDetails->row()->seller_product_id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="want_icon"></i>Add to list</a></li>
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="feature_icon"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
						<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $productDetails->row()->seller_product_id;?>"><i class="won_icon"></i><?php if($this->lang->line('product_i_ownit') != '') { echo stripslashes($this->lang->line('product_i_ownit')); } else echo "I own it"; ?></a></li>
                        <li style="height: 24px;padding-top: 5px;"><a class="color" onclick="javascript:$(this).find('input').select()" id="short_url_link"><i></i><input type="text" readonly value="<?php echo base_url().'t/'.$productDetails->row()->short_url; ?>"/></a></li>

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
<style>
.feature-selected i.feature_icon{
	background-position: -45px -80px !important;
}
.own-selected i.won_icon{
	background-position: -77px -58px !important;
}
</style>
<?php
$this->load->view('site/templates/footer');
?>