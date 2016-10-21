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

		
		<div class="info" style="position:static;">
			<dl class="vcard" style="padding: 16px 12px 16px 16px;color: #89919c;">
				<dd class="name">
					<strong class="fn" style="color:black;text-shadow:none;"><?php echo $list_details->row()->name;?></strong>
					
				</dd>
				<dd class="note" id="list-author-<?php echo $list_details->row()->id;?>" style="text-shadow:none;color: #89919c;"><?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?> <a href="user/<?php echo $user_profile_details->row()->user_name?>" style="color: #89919c;" class="name"><?php echo $user_profile_details->row()->full_name?></a>
				
				</dd>
			</dl>
			<!-- / vcard -->
			<div class="interaction">
				<ul class="actions">
					<?php 
					$followClass = 'follow';
			        if ($loginCheck != ''){
				        $followingListArr = explode(',', $userDetails->row()->following_user_lists);
				        if (in_array($list_details->row()->id, $followingListArr)){
				        	$followClass = 'following';
				        }
			        } 
					?>
					<li>
						
						<span lid="<?php echo $list_details->row()->id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> class="btn-follow <?php echo $followClass;?>">
						<a href="" class="follow btn"><span><?php if($this->lang->line('onboarding_follow') != '') { echo stripslashes($this->lang->line('onboarding_follow')); } else echo "Follow"; ?></span></a>
						<a href="" class="following btn btn-blue"><span><?php if($this->lang->line('display_following') != '') { echo stripslashes($this->lang->line('display_following')); } else echo "Following"; ?></span></a>
						<a href="" class="unfollow btn btn-dimmed"><span><?php if($this->lang->line('product_unfollow') != '') { echo stripslashes($this->lang->line('product_unfollow')); } else echo "Unfollow"; ?></span></a>
						</span>
						
					</li>
					
					
					<li class="menu-container"><a href="" class="menu-title btn btn-gray"><span></span></a>
						<div class="menu-content">
							
								
							
							<ul class="list-option">
								<li><a href="<?php echo base_url();?>user/<?php echo $user_profile_details->row()->user_name;?>/lists/<?php echo $list_details->row()->id;?>" lid="<?php echo $list_details->row()->id;?>" loid="3462155" list_name="<?php echo $list_details->row()->name;?>" class="btn-list-share"><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
							</ul>
							<?php 
							if ($loginCheck != '' && $user_profile_details->row()->user_name == $userDetails->row()->user_name){
							?>
 							<ul class="list-option">
								<li><a href="<?php echo base_url();?>user/<?php echo $user_profile_details->row()->user_name;?>/lists/<?php echo $list_details->row()->id;?>/settings" lid="<?php echo $list_details->row()->id;?>" loid="3462155" list_name="<?php echo $list_details->row()->name;?>"><?php if($this->lang->line('user_edit_list') != '') { echo stripslashes($this->lang->line('user_edit_list')); } else echo "Edit this list"; ?></a></li>
							</ul>
	 						<?php 
							}
							?>
						</div>
					</li>
					
				</ul>
			</div>
		</div>
	</div>
</div>



<div id="content" class="wrapper-content content timeline">
	<header>
		<ul class="stats-list tab">
			<li><a href="user/<?php echo $user_profile_details->row()->user_name;?>/lists/<?php echo $list_details->row()->id;?>"><?php if($this->lang->line('user_things') != '') { echo stripslashes($this->lang->line('user_things')); } else echo "Things"; ?><strong><?php echo $totalProducts;?></strong></a></li>
			<li class="active"><?php if($this->lang->line('display_followers') != '') { echo stripslashes($this->lang->line('display_followers')); } else echo "Followers"; ?><strong><?php echo $list_details->row()->followers_count;?></strong></li>
			
		</ul>
	</header>
	<div class="content">
		<div class="top-menu">
<!-- 			<div class="viewer">
				<ul>
					<li class="normal"><a href="#" class="tooltip current"><span style="margin-left: -8.5px;" class="hide"><?php if($this->lang->line('user_grid_view') != '') { echo stripslashes($this->lang->line('user_grid_view')); } else echo "Grid View"; ?></span><i class="ic-view2"></i></a></li>
					<li class="vertical"><a href="#" class="tooltip "><span style="margin-left: -8.5px;" class="hide"><?php if($this->lang->line('user_compact_view') != '') { echo stripslashes($this->lang->line('user_compact_view')); } else echo "Compact View"; ?></span><i class="ic-view3"></i></a></li>
 				</ul>
			</div>
 -->		</div>
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

				<a class="follow btn" href=""><span><?php if($this->lang->line('onboarding_follow') != '') { echo stripslashes($this->lang->line('onboarding_follow')); } else echo "Follow"; ?></span></a>
				<a class="following btn btn-blue" href=""><span><?php if($this->lang->line('display_following') != '') { echo stripslashes($this->lang->line('display_following')); } else echo "Following"; ?></span></a>
				<a class="unfollow btn btn-dimmed" href=""><span><?php if($this->lang->line('product_unfollow') != '') { echo stripslashes($this->lang->line('product_unfollow')); } else echo "Unfollow"; ?></span></a>
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
						
				<li><a href="things/<?php echo $prodRow->PID;?>/<?php echo url_title($prodRow->product_name,'-');?>"><img alt="" style="background-image:url(images/product/<?php echo $img;?>);" src="images/site/blank.gif"></a></li>
						
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
}else {
?>		
<div style="float: left;width: 80%;padding: 10%;text-align: center;">
<?php if ($list_details->row()->followers_count>0){?>
<b><?php if($this->lang->line('user_det_not_avail') != '') { echo stripslashes($this->lang->line('user_det_not_avail')); } else echo "User details not available"; ?></b>
<?php }else {?>
<b><?php if($this->lang->line('no_followers') != '') { echo stripslashes($this->lang->line('no_followers')); } else echo "No followers"; ?></b>
<?php }?>
</div>
<?php }?>
				<div id="infscr-loading" style="display: none;">
					<span class="loading">...</span>
				</div>

		
		<div class="pagination">
			
			<a style="display:none;" href="" class="btn-more sv-content" ts="" loc=""><span></span></a>
			<a style="display:none;" href="#" class="btn-next"><span></span></a>
		</div>
		
	</div>
	<!-- / content -->

</div>
<!-- / wrapper-content -->


<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a style="display: none;" href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

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
<style>
#footer{
	position: relative !important;
	bottom: 0 !important;
}
</style>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>
