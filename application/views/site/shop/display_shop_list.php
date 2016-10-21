<?php
$this->load->view('site/templates/header');
?>

<script type="text/javascript" src="js/site/jquery.mSimpleSlidebox.js"></script>
<!-- slidebox function call -->
<script type="text/javascript">
$(document).ready(function(){
	$(".mSlidebox").mSlidebox({
		autoPlayTime:4000,
		controlsPosition:{
			buttonsPosition:"outside"
		}
	});
	$("#mSlidebox_3").mSlidebox({
		easeType:"easeInOutCirc",
		numberedThumbnails:true,
		pauseOnHover:false
	});
});
</script>

 <!-- Section_start -->
<div class="lang-en wider no-subnav thing signed-out winOS">
<div id="container-wrapper">
	<div class="container shoppage">
	
		<div class="shop_text">
        <?php 
        if($bannerList->num_rows()>0){
        ?>
        	<div class="shop_slider">
            
            	<div class="mSlidebox slidebox">
                    <ul>
                    <?php 
                    foreach ($bannerList->result() as $bannerListRow){
                    	$link = $bannerListRow->link;
                    	if ($link != ''){
                    		if (substr($link,0,4) != 'http'){
								$link = 'http://'.$link;
                    		}
                    	}
                    ?>
                        <li>
                            <div><?php if ($link!=''){?><a href="<?php echo $link;?>"><?php }?><img src="<?php echo base_url();?>images/category/banner/<?php echo $bannerListRow->image;?>" alt="<?php echo $bannerListRow->name;?>" /><?php if ($link!=''){?></a><?php }?></div>
                        </li>
                    <?php 
                    }
                    ?>    
                    </ul>
                </div>
            	
            
            </div>
        <?php 
        }
        if ($mainCategories->num_rows()>0){
        ?>   
            <div class="shop_browse">
            
            	<span><?php if($this->lang->line('browse') != '') { echo stripslashes($this->lang->line('browse')); } else echo "Browse"; ?></span>
                
                <ul class="shop_browse">
                <?php 
                foreach ($mainCategories->result() as $mainCategoriesRow){
//                	$cat_img = base_url().'images/no_image.gif';
                	$cat_img = '';
                	if ($mainCategoriesRow->image != ''){
                		if (file_exists('images/category/'.$mainCategoriesRow->image)){
	                		$cat_img = base_url().'images/category/'.$mainCategoriesRow->image;
                		}	
                	}
                ?>
                    <li>
                    
                    	<a href="shopby/<?php echo $mainCategoriesRow->seourl;?>" style="float:left;width:100%;height:100%;">
                        <?php 
                        if ($cat_img != ''){
                        ?>
                        	<img src="<?php echo $cat_img;?>" alt="<?php echo $mainCategoriesRow->cat_name;?>" title="<?php echo $mainCategoriesRow->cat_name;?>" />
                        <?php 
                        }
                        ?>    
                            <b><?php echo $mainCategoriesRow->cat_name;?></b>
                        </a>    
                    
                    </li>
                <?php 
                }
                ?>    
                
                </ul>
            
            </div>
       <?php 
        }
       ?> 
 <?php 
				if ($recentProducts->num_rows()>0){
				?>
				<div class="might-fancy">
					<span style="font-size:18px;"><?php if($this->lang->line('whats_new') != '') { echo stripslashes($this->lang->line('whats_new')); } else echo "What's New"; ?> <a style="margin-left: 10px;font-size:12px;" href="shopby/all"><?php if($this->lang->line('see_more') != '') { echo stripslashes($this->lang->line('see_more')); } else echo "See more"; ?></a></span>
					<div style="height: 259px;" class="figure-row fancy-suggestions anim">
					<?php 
					foreach ($recentProducts->result() as $relatedRow){
						$img = 'dummyProductImage.jpg';
						$imgArr = array_filter(explode(',', $relatedRow->image));
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
					}
					?>
							</div>
				</div>
				<?php }?>
	    </div>

		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	
	<!-- / container -->
</div>

</div>
<?php
$this->load->view('site/templates/footer');
?>