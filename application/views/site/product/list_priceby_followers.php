<?php 
$this->load->view('site/templates/header',$this->data);
?>
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
							
								
								
								
							
							<ul class="list-option">
								<li><a href="<?php echo base_url();?>giftguide/list/<?php echo $list_details->row()->id;?>/followers" lid="<?php echo $list_details->row()->id;?>" loid="3462155" list_name="$<?php echo $list_details->row()->list_value;?>" class="btn-list-share">Share</a></li>
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
			<li><a href="giftguide/list/<?php echo $list_details->row()->id;?>">Things<strong><?php echo $list_details->row()->product_count;?></strong></a></li>
			<li class="active">Followers<strong><?php echo $list_details->row()->followers_count;?></strong></li>
			
		</ul>
	</header>
	<div class="content">
		<div class="top-menu">
			<div class="viewer">
				<ul>
					<li class="normal"><a href="#" class="tooltip current"><span style="margin-left: -8.5px;" class="hide">Grid View</span><i class="ic-view2"></i></a></li>
					<li class="vertical"><a href="#" class="tooltip "><span style="margin-left: -8.5px;" class="hide">Compact View</span><i class="ic-view3"></i></a></li>
<!--  					<li class="slideshow"><a href="#" class="btn-slideshow tooltip"><span style="margin-left: -8.5px;" class="hide">Slideshow</span><i class="ic-slideshow"></i></a></li>
-->				</ul>
			</div>
		</div>
<?php 
if ($user_details->num_rows()>0){
?>
		<ul class="userlist followable-list">
		
		<?php 
		foreach ($user_details->result() as $userRow){
			$userImg = 'user-thumb1.png';
			if ($userRow->thumbnail != ''){
				$userImg = $userRow->thumbnail;
			}
			$followClass = 'follow';
	        if ($loginCheck != ''){
		        $followingListArr = explode(',', $userDetails->row()->following);
		        if (in_array($userRow->id, $followingListArr)){
		        	$followClass = 'following';
		        }
	        } 
		?>
		<li class="vcard">
			<p>
				<a class="url" href="user/<?php echo $userRow->user_name;?>">
					<img style="background-image:url(images/users/<?php echo $userImg;?>)" alt="<?php echo $userRow->full_name;?>" class="photo" src="images/site/blank.gif">
					<span class="name"><strong class="fn"><?php echo $userRow->full_name;?></strong><em class="username"><?php echo $userRow->user_name;?></em></span>
				</a>
				
				
				<span uid="<?php echo $userRow->id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> class="btn-follow <?php echo $followClass;?>">

				<a class="follow btn" href=""><span>Follow</span></a>
				<a class="following btn btn-blue" href=""><span>Following</span></a>
				<a class="unfollow btn btn-dimmed" href=""><span>Unfollow</span></a>
				</span>
				
			</p>
			<?php 
			if ($product_details[$userRow->id]->num_rows()>0){
			?>
			
			<ul class="thing-list">
				

					<?php 
					foreach ($product_details[$userRow->id]->result() as $prodRow){
						$imgArr = explode(',', $prodRow->image);
		          		$img = 'dummyProductImage.jpg';
		          		foreach ($imgArr as $imgVal){
		          			if ($imgVal != ''){
								$img = $imgVal;
								break;
		          			}
		          		}
					?>
						
				<li><a href="things/<?php echo $prodRow->product_id;?>/<?php echo url_title($prodRow->product_name,'-');?>"><img alt="" style="background-image:url(images/product/<?php echo $img;?>);" src="images/site/blank.gif"></a></li>
						
					<?php 
					}
					?>	

				
			</ul>
			<?php 
			}
			?>
		</li>
		
		
		<?php 
		}
		?>
		
		
		
	</ul>
		
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
