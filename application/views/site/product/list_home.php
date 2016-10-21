<?php 
$this->load->view('site/templates/header',$this->data);
?>

<script type="text/javascript">
var track_load = 1;
var total_groups = <?php echo $totalProducts;?>/20; //total record group(s)
var ajax_load_url = baseURL+'site/searchShop/ajax_load_more_price';
var iniData = {'group_no': track_load,'lid':<?php echo $list_details->row()->id;?>};
</script>
<script type="text/javascript" src="js/site/ajax_load_more.js"></script>
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>	
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>list-page.css" />
<!-- Section_start -->
<div class="lang-en list winOS">
<div id="container-wrapper">
	<div class="container timeline normal">
		


<div id="summary" class="wrapper-content " lid="<?php echo $list_details->row()->id;?>">
	<div class="inner-wrapper">
		<div class="icon-cache"></div>
		<h2 class="hidden">Cover</h2>

		
		<div class="info" style="position:static;">
			<h2 class="hidden">List</h2>
			<dl class="vcard" style="padding: 16px 12px 16px 16px;color: #89919c;">
				<dt>List</dt>
				<dd class="name">
					<strong class="fn" style="color:black;text-shadow:none;"><?php echo $currencySymbol;?><?php echo $list_details->row()->list_value;?></strong>
					
				</dd>
				<dt>Contributors</dt>
				<dd class="note" id="list-author-<?php echo $list_details->row()->id;?>" style="text-shadow:none;color: #89919c;">by <a href="user/giftguide" style="color: #89919c;" class="name">GiftGuide</a>
				
				</dd>
			</dl>
			<!-- / vcard -->
			<div class="interaction">
				<ul class="actions">
					<?php 
					$followClass = 'follow';
			        if ($loginCheck != ''){
				        $followingListArr = explode(',', $userDetails->row()->following_giftguide_lists);
				        if (in_array($list_details->row()->id, $followingListArr)){
				        	$followClass = 'following';
				        }
			        } 
					?>
					<li>
						
						<span lid="<?php echo $list_details->row()->id;?>" aid="<?php echo $list_details->row()->list_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> class="btn-follow <?php echo $followClass;?>">
						<a href="" class="follow btn"><span>Follow</span></a>
						<a href="" class="following btn btn-blue"><span>Following</span></a>
						<a href="" class="unfollow btn btn-dimmed"><span>Unfollow</span></a>
						</span>
						
					</li>
					
					
					<li class="menu-container"><a href="" class="menu-title btn btn-gray"><span>Extra Links</span></a>
						<div class="menu-content">
							
								
<!-- 								
							<ul class="list-option">
								<li><a href="<?php echo base_url();?>giftguide/list/<?php echo $list_details->row()->id;?>" <?php if ($loginCheck==''){echo 'require_login="true"';}?>  class="btn-clone-list" loid="3462155" lid="<?php echo $list_details->row()->id;?>">Clone this list</a></li>
							</ul>
 -->								
							
							<ul class="list-option">
								<li><a href="<?php echo base_url();?>giftguide/list/<?php echo $list_details->row()->id;?>" lid="<?php echo $list_details->row()->id;?>" loid="3462155" list_name="$<?php echo $list_details->row()->list_value;?>" class="btn-list-share">Share</a></li>
							</ul>
						</div>
					</li>
					
				</ul>
			</div>
		</div>
	</div>
	<div class="reposition">
		<div class="guide">
			<span>Drag to Reposition</span>
		</div>
		<span class="btns">
			<a href="" id="repositionSave" class="btn btn-blue">Save Changes</a>
			<a href="" id="repositionCancel" class="btn">Cancel</a>
		</span>
	</div>
</div>



<div id="content" class="wrapper-content content timeline">
	<header>
		<ul class="stats-list tab">
			<li class="active">Things<strong><?php echo $totalProducts;?></strong></li>
			<li><a href="giftguide/list/<?php echo $list_details->row()->id;?>/followers">Followers<strong><?php echo $list_details->row()->followers_count;?></strong></a></li>
			
		</ul>
	</header>
	<div class="content">
		<div class="top-menu">
			<div class="viewer">
				<ul>
					<li class="normal"><a href="#" class="tooltip current"><span style="margin-left: -8.5px;" class="hide">Grid View</span><i class="ic-view2"></i></a></li>
					<li class="vertical"><a href="#" class="tooltip "><span style="margin-left: -8.5px;" class="hide">Compact View</span><i class="ic-view3"></i></a></li>
<!--					<li class="slideshow"><a href="#" class="btn-slideshow tooltip"><span style="margin-left: -8.5px;" class="hide">Slideshow</span><i class="ic-slideshow"></i></a></li>
-->  				</ul>
			</div>
		</div>

		<?php 
		if ($product_details != '' && count($product_details)>0 && $product_details->num_rows()>0){
		?>
		
		<ol class="stream" id="list-thumbnails-<?php echo $list_details->row()->id;?>">
			
			<?php 
			foreach ($product_details->result() as $productRow){
				$imgArr = explode(',', $productRow->image);
          		$img = 'dummyProductImage.jpg';
          		foreach ($imgArr as $imgVal){
          			if ($imgVal != ''){
						$img = $imgVal;
						break;
          			}
          		}
          		$fancyClass = 'fancy';
          		$fancyText = LIKE_BUTTON;
          		if (count($likedProducts)>0 && $likedProducts->num_rows()>0){
          			foreach ($likedProducts->result() as $likeProRow){
          				if ($likeProRow->product_id == $productRow->seller_product_id){
          					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
          				}
          			}
          		}
			?>
			
			
			<li id="stream-first-item_" tid="<?php echo $productRow->id;?>">
				<div class="figure-item">
					<a href="things/<?php echo $productRow->id;?>/<?php echo url_title($productRow->product_name,'-');?>" class="figure-img" rel="thing-371468102820434791">
						<span class="figure grid" style="background-size: cover; background-image:url(images/product/<?php echo $img;?>)" data-ori-url="images/product/<?php echo $img;?>" data-310-url="images/product/<?php echo $img;?>"><em class="back"></em></span>
							<span class="figure vertical">
								<em class="back"></em>
								
								<img src="images/product/<?php echo $img;?>" data-width="310" data-height="310">
								
							</span>
						<span class="figcaption"><?php echo $productRow->product_name;?></span>
					</a>
					<em class="figure-detail">
						
						<span class="price"><?php echo $currencySymbol;?><?php echo $productRow->sale_price;?> <small><?php echo $currencyType;?></small></span>
						
						
						<span class="username"><em><i>.</i><a href="<?php if ($productRow->user_id != '0'){echo base_url().'user/'.$productRow->user_name;}else {echo base_url().'user/administrator';}?>"><?php if ($productRow->user_id != '0'){echo $productRow->full_name;}else {echo 'administrator';}?></a>  + <?php echo $productRow->likes;?></em></span>
						
					</em>
					<ul class="function">
						<li class="list"><a href="#">Add to List</a></li>
						<li class="cmt"><a href="#">Comment</a></li>
						<li class="share"><button type="button" <?php if ($loginCheck==''){?>require_login="true"<?php }?> data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" class="btn-share" uid="<?php echo $loginCheck;?>" tid="<?php echo $productRow->id;?>" tname="<?php echo $productRow->product_name;?>" username="<?php if ($productArr[$i]['user_id'] != '0'){echo $productArr[$i]['full_name'];}else {echo 'administrator';}?>" action="buy"><i class="ic-share"></i></button></li>
						<li class="view-cmt"><a href="#">5 comments</a></li>
					</ul>

					
					<a href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span> <?php echo $fancyText;?></a> 
					


					
				</div>
			</li>
         <?php 
			}
         ?>   

		</ol>
		<?php 
		}
		?>
		
				<div id="infscr-loading" style="display: none;">
					<!--img alt='Loading...' src="/_ui/images/site/common/ajax-loader.gif"-->
					<span class="loading">Loading...</span>
				</div>

		
		<div class="pagination">
			
			<a style="display:none;" href="" class="btn-more sv-content" ts="" loc="/giftguide/list/22675769-l"><span>Show more...</span></a>
			<a style="display:none;" href="#" class="btn-next"><span>Next</span></a>
		</div>
		
	</div>
	<!-- / content -->

</div>
<!-- / wrapper-content -->


<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a style="display: none;" href="#header" id="scroll-to-top"><span>Jump to top</span></a>

	</div>
	<!-- / container -->
</div>
</div>



<!-- Section_start -->








<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>page-helper.js"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>list.js"></script>
<script src="js/site/profile_things.js"></script>


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
<?php 
$this->load->view('site/templates/footer',$this->data);
?>
