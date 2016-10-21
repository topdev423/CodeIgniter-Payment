<?php $this->load->view('site/templates/header.php');?>
<!-- Section_start -->

  
<div id="popup_container" style="display: block; opacity: 1;" class="onboarding">
<img width="32" height="22" src="images/site/loading.gif" class="loader" style="display: none;">

<div class="popup ly-title reply-popup">
</div>


<div class="popup onboarding animated" style="margin:139px auto 7px; display: block; opacity: 1;">

	<div style="padding: 47.5px 0px;" class="index">
		<p><b><?php if($this->lang->line('onboarding_welcome') != '') { echo stripslashes($this->lang->line('onboarding_welcome')); } else echo "Welcome"; ?>, <?php echo $userDetails->row()->full_name;?>.</b>
		<?php if($this->lang->line('onboarding_get_started') != '') { echo stripslashes($this->lang->line('onboarding_get_started')); } else echo "Get started with "; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('onboarding_few_seco') != '') { echo stripslashes($this->lang->line('onboarding_few_seco')); } else echo "within a few seconds"; ?>.</p>
		<p><span class="bg"></span>
		<button class="btns-blue-embo btn-start"><?php if($this->lang->line('onboarding_get_stat') != '') { echo stripslashes($this->lang->line('onboarding_get_stat')); } else echo "Get Started"; ?></button></p>
	</div>
    
	<div class="step step1" style="display:none">
		<p class="tit"><b><?php echo $userDetails->row()->full_name;?>, <?php if($this->lang->line('onboarding_what_love') != '') { echo stripslashes($this->lang->line('onboarding_what_love')); } else echo "tell us what you love"; ?></b><br>
		<?php if($this->lang->line('onboarding_select_one') != '') { echo stripslashes($this->lang->line('onboarding_select_one')); } else echo "Select at least one category to get started"; ?>.</p>
		<div class="txt"><div class="scroll">
			<div class="intxt">
			<?php if ($mainCategories->num_rows()>0){?>
				<ul class="category-list">
                    <?php 
                    $left = $top = $count = 0;
                    $width = 340;
                    $height = 136;
                      foreach ($mainCategories->result() as $row){
                      	if ($row->cat_name != ''){
                      		$leftPos = $count%2;
                      		$leftVal = $leftPos*$width;
                      		$topPos = floor($count/2);
                      		$topVal = $topPos*$height;
                      		$count++;
                      ?>
                    <li style="left: <?php echo $leftVal;?>px; width: 340px; top: <?php echo $topVal;?>px; position: absolute;">
                    <a value="<?php echo $row->id;?>" href="#"><b><?php echo $row->cat_name;?></b>
                        <span class="category-thum">
                        <?php 
                        if ($productDetails[$row->cat_name]->num_rows()>0){
                        	$imgCount = 0;
	                        foreach ($productDetails[$row->cat_name]->result() as $product_row){
	                        	if ($imgCount>3) break;
	                        	$imgArr = explode(',', $product_row->image);
	                        	$imgName = '';
	                        	if (count($imgArr)>0){
	                        		foreach ($imgArr as $img){
	                        			if ($img != ''){
	                        				$imgName = $img;
	                        				break;
	                        			}
	                        		}
	                        	}
	                        	if ($imgName != ''){
		                        	echo '<img style="background-image:url('.base_url().'images/product/'.$imgName.')" src="images/site/blank.gif">';
									$imgCount++;
	                        	}
        	                }
                        }
                        ?>
                        
						<em class="back"><?php if($this->lang->line('onboarding_selected') != '') { echo stripslashes($this->lang->line('onboarding_selected')); } else echo "Selected"; ?></em></span>
                    </a></li>
                   <?php 
                      	}
                      }
                   ?> 
				</ul>
			<?php }else {?>
			<p class="tit"><?php if($this->lang->line('onboarding_no_cate') != '') { echo stripslashes($this->lang->line('onboarding_no_cate')); } else echo "No categories available"; ?></p>
			<?php }?>
			</div>
		</div></div>
		<div class="btn-area">
			<button disabled="" class="btns-blue-embo btn-next"><?php if($this->lang->line('onboarding_next') != '') { echo stripslashes($this->lang->line('onboarding_next')); } else echo "Next"; ?></button>
		</div>
	</div>
    
	
    <div style="display:none" class="step step2">
		<p class="tit" style="box-shadow: none; border-color: rgb(235, 236, 239);"><b><?php echo LIKE_BUTTON;?> <?php if($this->lang->line('onboarding_thinks_like') != '') { echo stripslashes($this->lang->line('onboarding_thinks_like')); } else echo "the things you like"; ?></b><br>
		<?php echo LIKE_BUTTON;?> <?php if($this->lang->line('onboarding_person_catalog') != '') { echo stripslashes($this->lang->line('onboarding_person_catalog')); } else echo "a few things to save them to your personal catalog"; ?>.</p>
		<div class="txt" style="height: 432px;">
		<div class="scroll">
			<div class="intxt timeline vertical">
                <div class="loading" style="display: block;"><img alt="" src="images/site/spinner.gif"></div>
			</div>
		</div></div>
		<div class="btn-area" style="box-shadow: 0px -2px 0px rgba(0, 0, 0, 0.07); border-color: rgb(205, 206, 207);">
			<span class="tooltip">
				<i class="ic-q"></i> <?php if($this->lang->line('onboarding_how_it') != '') { echo stripslashes($this->lang->line('onboarding_how_it')); } else echo "How it works"; ?>
				<small><b></b>
					<strong><?php echo LIKE_BUTTON;?> <?php if($this->lang->line('onboarding_things') != '') { echo stripslashes($this->lang->line('onboarding_things')); } else echo "things"; ?></strong><br>
					<?php if($this->lang->line('onboarding_to') != '') { echo stripslashes($this->lang->line('onboarding_to')); } else echo "To"; ?> <?php echo LIKE_BUTTON;?> <?php if($this->lang->line('onboarding_img_clk') != '') { echo stripslashes($this->lang->line('onboarding_img_clk')); } else echo "things; hover any image and click"; ?> "<?php echo LIKE_BUTTON;?>".<br><br>
					<?php if($this->lang->line('onboarding_thngsu') != '') { echo stripslashes($this->lang->line('onboarding_thngsu')); } else echo "The things you"; ?> <?php echo LIKED_BUTTON;?> <?php if($this->lang->line('onboarding_person_catlog') != '') { echo stripslashes($this->lang->line('onboarding_person_catlog')); } else echo "are placed in your personal catalog. There you can organize them into lists"; ?>.
				</small>
			</span>
			<button class="btns-blue-embo btn-next"><?php if($this->lang->line('onboarding_next') != '') { echo stripslashes($this->lang->line('onboarding_next')); } else echo "Next"; ?></button>
		</div>
	</div>
    
	<div style="display:none;" class="step step3">
		<p class="tit"><b><?php if($this->lang->line('onboarding_follow') != '') { echo stripslashes($this->lang->line('onboarding_follow')); } else echo "Follow"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('onboarding_people') != '') { echo stripslashes($this->lang->line('onboarding_people')); } else echo "people"; ?></b><br>
		<?php if($this->lang->line('onboarding_discover') != '') { echo stripslashes($this->lang->line('onboarding_discover')); } else echo "Follow a few top contributors to discover great things"; ?>.</p>
		<div class="txt">
			<div class="follow-cate">
				<ul>
                    <li>
                        <a cname="suggested" class="selected category" href="javascript:void(0)"><?php if($this->lang->line('onboarding_suggested') != '') { echo stripslashes($this->lang->line('onboarding_suggested')); } else echo "Suggested for you"; ?></a>
                    </li>
                    <li>
                    <?php if ($mainCategories->num_rows()>0){?>
                        <span><?php if($this->lang->line('onboarding_category') != '') { echo stripslashes($this->lang->line('onboarding_category')); } else echo "Find by category"; ?></span>
                    </li>    
                            <?php 
                            foreach ($mainCategories->result() as $catRow){
                            	if ($catRow->cat_name != ''){
                            ?>
                                
                            <li><a href="javascript:void(0)" cname="<?php echo url_title($catRow->cat_name,'_',TRUE);?>" class="category"><?php echo $catRow->cat_name;?></a></li>
                                
                            <?php 
                            	}
                            }
                            ?>
                                
                            
                       <?php }?>
                    </li>
                </ul>
			</div>
			<div class="scroll">
			<div class="intxt suggested">
				<p class="stit"><span><?php if($this->lang->line('onboarding_suggested') != '') { echo stripslashes($this->lang->line('onboarding_suggested')); } else echo "Suggested for you"; ?></span>
				<button class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_follow_all') != '') { echo stripslashes($this->lang->line('onboarding_follow_all')); } else echo "Follow All"; ?></button></p>
			</div>
            
            

		</div></div>
		<div class="btn-area">
 			<button class="btns-blue-embo btn-next">Next</button>
<!--	 		<button class="btns-blue-embo btn-close"><?php if($this->lang->line('onboarding_finish') != '') { echo stripslashes($this->lang->line('onboarding_finish')); } else echo "Finish"; ?></button>
	-->	</div>
	</div>
	<div style="display:none" class="step step4">
    
		<p class="tit"><b> <?php if($this->lang->line('onboarding_invite_friends') != '') { echo $this->lang->line('onboarding_invite_friends'); } else echo "Invite friends to ";
		echo  " ".$siteTitle." </b><br>";
		if($this->lang->line('invite_friends_tag') != '') { echo $this->lang->line('invite_friends_tag'); } else echo "Search services you use to invite friends to"; ?> <?php echo " ".$siteTitle;?>.</p>
		<div class="txt"><div class="scroll">
			<div class="intxt">
				<dl class="sns-people">
					<dt><i class="ic-fb"></i> <span><b><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></b></span>
					<button class="close"><span class="tooltip"><small><b></b><?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?></small></span></button>
					<button class="btns-gray-embo facebook"><?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?></button></dt>
                    <dd class="follow">
						<p class="stit"><b><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></b> . <a href="javascript:void(0)" class="invite facebook"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></a><button class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_follow_all') != '') { echo stripslashes($this->lang->line('onboarding_follow_all')); } else echo "Follow All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
                    <dd style="display:none;" class="invite">
						<p class="stit"><a href="javascript:void(0)" class="follow"><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></a> . <b><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></b><button id="fb-invite-all" class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_invite_all') != '') { echo stripslashes($this->lang->line('onboarding_invite_all')); } else echo "Invite All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
				</dl>
				<dl class="sns-people">
					<dt><i class="ic-tw"></i> <span><b><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></b></span>
					<button class="close"><span class="tooltip"><small><b></b><?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?></small></span></button>
<!-- 					<button class="btns-gray-embo"><?php if($this->lang->line('onboarding_find_frds') != '') { echo stripslashes($this->lang->line('onboarding_find_frds')); } else echo "Find friends"; ?></button></dt> -->
 					<button class="btns-gray-embo twitter"><?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?></button></dt> 
					<dd class="follow">
						<p class="stit"><b><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></b> . <a href="javascript:void(0)" class="invite twitter"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></a><button class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_follow_all') != '') { echo stripslashes($this->lang->line('onboarding_follow_all')); } else echo "Follow All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
                    <dd style="display:none;" class="invite">
						<p class="stit"><a href="javascript:void(0)" class="follow"><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></a> . <b><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></b></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
				</dl>
<!--				<dl class="sns-people">
					<dt><i class="ic-gg"></i> <span><b><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?>+</b></span>
					<button class="close"><span class="tooltip"><small><b></b><?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?></small></span></button>
					<button id="fancy-gplus-link" class="btns-gray-embo" data-gapiattached="true"><?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?></button></dt>
					<dd class="follow">
						<p class="stit"><b><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></b> . <a href="javascript:void(0)" class="invite gplus"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></a><button class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_follow_all') != '') { echo stripslashes($this->lang->line('onboarding_follow_all')); } else echo "Follow All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
                    <dd style="display:none;" class="invite">
						<p class="stit"><a href="javascript:void(0)" class="follow"><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></a> . <b><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></b></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
				</dl>
 --> 				<dl class="sns-people">
					<dt><b><i class="ic-gm"></i> <span><b><?php if($this->lang->line('onboarding_gmail') != '') { echo stripslashes($this->lang->line('onboarding_gmail')); } else echo "Gmail"; ?></b></span></b>
					<button class="close"><span class="tooltip"><small><b></b><?php if($this->lang->line('onboarding_close') != '') { echo stripslashes($this->lang->line('onboarding_close')); } else echo "Close"; ?></small></span></button>
					<button class="btns-gray-embo gmail"><?php if($this->lang->line('invite_frds') != '') { echo stripslashes($this->lang->line('invite_frds')); } else echo "Invite friends"; ?></button></dt>
                    <dd class="follow">
						<p class="stit"><b><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></b> . <a href="javascript:void(0)" class="invite gmail"><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></a><button class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_follow_all') != '') { echo stripslashes($this->lang->line('onboarding_follow_all')); } else echo "Follow All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
                    <dd style="display:none;" class="invite">
						<p class="stit"><a href="javascript:void(0)" class="follow"><?php if($this->lang->line('onboarding_ur_frdson') != '') { echo stripslashes($this->lang->line('onboarding_ur_frdson')); } else echo "Your friends on"; ?> <?php echo $siteTitle;?></a> . <b><?php if($this->lang->line('onboarding_invite_frd') != '') { echo stripslashes($this->lang->line('onboarding_invite_frd')); } else echo "Invite Friends"; ?></b><button id="email-invite-all" class="btns-blue-embo btn-followall"><?php if($this->lang->line('onboarding_invite_all') != '') { echo stripslashes($this->lang->line('onboarding_invite_all')); } else echo "Invite All"; ?></button></p>
						<div class="container"></div>
                        <div class="loader" style="display: none;"></div>
					</dd>
				</dl>
                <p class="sns-notify">
                <?php if($this->lang->line('onboarding_choose_srvce') != '') { echo stripslashes($this->lang->line('onboarding_choose_srvce')); } else echo "Choosing a service will open a window for you to log in securely and invite your contacts to"; ?>
						<?php echo " ".$siteTitle;?>.</p>
			</div>
		</div></div>
		<div class="btn-area">
			<button class="btns-blue-embo btn-close"><?php if($this->lang->line('onboarding_finish') != '') { echo stripslashes($this->lang->line('onboarding_finish')); } else echo "Finish"; ?></button>
		</div>
	</div>
</div>



</div>

<!-- Section_start -->
<script src="js/site/<?php echo SITE_COMMON_DEFINE;?>filescatalog.js" type="text/javascript"></script>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE;?>filesjquery-ui-1.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE;?>filesjquery_002.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE;?>filesjquery.js" type="text/javascript"></script>
<script src="js/site/main4.js" type="text/javascript"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
/*	if (top.location!= self.location)
	{
		top.location = self.location
	}
*/	FB.init({
	    appId:'<?php echo $this->config->item('facebook_app_id');?>',
	    cookie:true,
	    status:true,
	    xfbml:true
    });
     $('.category-list li a').each(function(){
		$(this).click(function(){
			$(this).toggleClass('selected');
            var categorySelected = false;
            $('.category-list li a').each(function(){
                if ($(this).hasClass('selected')) {
                    categorySelected = true;
                    return false;
                }
            });
            if (categorySelected) {
                $(this).parents('.step').find('.btn-next').removeAttr('disabled');
            } else {
                $(this).parents('.step').find('.btn-next').attr('disabled','disabled');
            }
			return false;
		});
	});
	
	$('.popup.onboarding .btn-start').click(function(){
		$('.popup.onboarding .index').hide();
		$('.popup.onboarding .step1').show();
		$('.category-list').find('li:even').css('left','0').end().find('li:odd').css('left','340px').end();
		$('.category-list li').each(function(){$(this).width(340).css('top',( Math.floor($(this).index()/2)*136)+'px').css('position','absolute');});
		if ($('.popup.onboarding .step1 .intxt').height()>565) {$('.popup.onboarding .step1 .btn-area').css('box-shadow','0 -2px 0 rgba(235,236,239,0.3)')}
		
		var click_id = $.cookie.get('ck_secco_clickid');
		if (click_id != null) {
			var tag = $("<img/>")
			.css("display", "none")
			.attr("src", "//www.srv2trking.com/pixel.track?ClickID=" + click_id + "&MerchantReferenceID=");
			var now = new Date()
			now.setDate(now.getDate());
			document.cookie = 'ck_secco_clickid' + '='+ click_id +'; path=/; expires='+now.toUTCString();
			$('body').append(tag);
		}
		click_id = $.cookie.get('ck_da_clickid');
		if (click_id != null) {
			var tag = $("<img/>")
				.css("display", "none")
				.attr("src", "//smarttrk.com/p.ashx?o=30289&f=pb&r=" + click_id);
			$('body').append(tag);
		}
	});

	$('.onboarding .step .btn-next').click(function(){
		$(this).parents('.step').hide();
		if ($(this).parents('.step').hasClass('step1')==true) {var nextStep = '.popup.onboarding .step2';}
		if ($(this).parents('.step').hasClass('step2')==true) {var nextStep = '.popup.onboarding .step3';}
		if ($(this).parents('.step').hasClass('step3')==true) {var nextStep = '.popup.onboarding .step4';}
		$(nextStep).show();
		if ($(this).parents('.step').hasClass('step1')==true) {
            var selectedCategories = new Array();
            $('.category-list li a').each(function(){
                if ($(this).hasClass('selected')) {
                    selectedCategories.push($(this).attr('value'));
                }
            });
            $.ajax({
                url: baseURL+"site/product/onboarding_get_products_categories",
                data: { categories: selectedCategories.join() },
                cache: false
            }).done(function( html ) {
//                alert(html);
                $('.popup.onboarding .step2 .intxt.timeline').html(html);
                $('.popup.onboarding .step2 .loading').hide();
/*                $.infiniteshow({
                    itemSelector:'#onboarding-category-items > ol.stream > li',
                    post_callback: function($items){ $('#onboarding-category-items > ol.stream').trigger('itemloaded')}
                });
*/               
                var $stream = $('#onboarding-category-items > ol.stream'), $wrapper = $('.intxt.timeline'), latest_id = 'stream-latest-item';
                
                // show images as each image is loaded
                $stream.on('itemloaded', function(){
                    var $latest = $stream.find('#'+latest_id), $target, viewMode;
                    
                    $target = $latest.length ? $latest.nextAll('li') : $stream.find('>li');
                    if($target.length) {
                        $latest.removeAttr('id');
                        $target.eq(-1).attr('id', latest_id);
                    }
                    
                    viewMode = $wrapper.hasClass('vertical') ? 'vertical' : 'grid';

                    $target.each(function(i,v,a){
                        var $li = $(this), src, img;
                        
                        if(viewMode == 'vertical'){
                            src = $li.find('.figure > img').attr('src');
                        } else {
                            if(src = $li.find('.figure').css('background-image').match(/http:\/\/.+\.(?:jpe?g|png|gif)/i)) src = src[0];
                        }
                        
                        if(src) {
                            img = new Image();
                            img.onload = function(){ $li.find('>.pre').addClass('hide') };
                            img.src = src;
                        }
                    });

      //              if(viewMode == 'vertical') arrange();
                });
                $stream.trigger('itemloaded');
                setView('vertical');
                
                function setView(mode){
                    if($wrapper.hasClass(mode)) return;
                    if(!window.Modernizr || !Modernizr.csstransitions) return switchTo(mode);

                    $wrapper.addClass('anim');
                    
                    var $items = $stream.find('>li'), item,
                        $visibles, visibles = [], prevVisibles, thefirst, 
                        offsetTop = $stream.offset().top,
                        hh = $('#header-new').height(),
                        sc = $(window).scrollTop(),
                        wh = $(window).innerHeight(),
                        f_right, f_bottom, v_right, v_bottom,
                        i, c, v, d, animated = 0;

                    // get visible elements
                    for(i=0,c=$items.length; i < c; i++){
                        item = $items[i];
                        if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
                            //item.style.visibility = 'hidden';
                        } else if (offsetTop + item.offsetTop > sc + wh) {
                            //item.style.visibility = 'hidden';
                        } else {
                            visibles[visibles.length] = item;
                        }
                    }
                    prevVisibles = visibles;

                    // get the first animated element
                    for(i=0,c=Math.min(visibles.length,10),thefirst=null; i < c; i++){
                        v = visibles[i];
                        
                        if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
                            thefirst = v;
                        }
                    }

                    // fade out elements using delay based on the distance between each element and the first element.
                    for(i=0,c=visibles.length; i < c; i++){
                        v = visibles[i];

                        d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
                        delayOpacity(v, 0, d/5);

                        if(i == c -1) setTimeout(fadeIn, 300+d/5);
                    }
                    
                    function fadeIn(){
                        var i, c, v, thefirst, COL_COUNT, visibles = [], item;
                        
                        $stream.height($stream.parent().height());

                        switchTo(mode);
                        $wrapper.removeClass('anim');

                        // get visible elements
                        for(i=0,c=$items.length; i < c; i++){
                            item = $items[i];
                            if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
                                //item.style.visibility = 'hidden';
                            } else if (offsetTop + item.offsetTop > sc + wh) {
                                //item.style.visibility = 'hidden';
                            } else {
                                visibles[visibles.length] = item;
                                item.style.opacity = 0;
                            }
                        }
                        
                        $wrapper.addClass('anim');

                        $(visibles).css({opacity:0,visibility:''});
                        COL_COUNT = Math.floor($stream.width()/$(visibles[0]).width());

                        // get the first animated element
                        for(i=0,c=Math.min(visibles.length,COL_COUNT),thefirst=null; i < c; i++){
                            v = visibles[i];
                            
                            if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
                                thefirst = v;
                            }
                        }

                        // fade in elements using delay based on the distance between each element and the first element.
                        for(i=0,c=visibles.length; i < c; i++){
                            v = visibles[i];

                            d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
                            delayOpacity(v, 1, d/5);

                            if(i == c -1) setTimeout(done, 300+d/5);
                        }
                    };

                    function done(){
                        $wrapper.removeClass('anim');
                        if(prevVisibles && prevVisibles.length) {
                            for(var i=0,c=visibles.length; i < c; i++){
                                if(visibles[i].style.opacity == '0') visibles[i].style.opacity = 1;
                            }
                        }
                    };
                    
                    function delayOpacity(element, opacity, interval){
                        setTimeout(function(){ element.style.opacity = opacity }, Math.floor(interval));
                    };
                    
                    function switchTo(mode){
                        $wrapper.removeClass('vertical normal').addClass(mode);
                        if(mode == 'vertical') {
   //                         arrange();
                        } else {
                            $stream.css('height','');
                        }
                    };
                };
                
                var bottoms = [0,0,0];
                function arrange(force_refresh){
                    var i, c, x, w, h, nh, min, $target, $marker, $first, $img, COL_COUNT, ITEM_WIDTH, LEFT_MARGIN, TOP_MARGIN;

                    $first = $stream.find('>li:first-child');
                    if(!$first.hasClass('start_marker_')) {
                        $first.addClass('start_marker_');
                        force_refresh = true;
                    }

                    if(!force_refresh) {
                        $marker = $stream.find('>li.page_marker_').eq(-1);
                        $target = $marker.length ? $marker.nextAll('li') : $stream.find('>li');
                    } else {
                        bottoms = [0,0,0];
                        $stream.find('>li.page_marker_').removeClass('page_marker_');
                        $target = $stream.find('>li');
                    }

                    if(!$target.length) return;

                    $first = $target.eq(0);
                    $target.eq(-1).addClass('page_marker_');
                        
                    COL_COUNT   = Math.floor($stream.width()/$first.width());
                    ITEM_WIDTH  = parseInt($first.width());
                    TOP_MARGIN  = parseInt($first.css('margin-top'));
                    LEFT_MARGIN = parseInt($first.css('margin-left'));

                    for(i=0,c=$target.length; i < c; i++){
                        min = Math.min.apply(Math, bottoms);

                        for(x=0; x < COL_COUNT; x++) if(bottoms[x] == min) break;

                        $img = $target.eq(i).find('.figure > img');
                        if(!$img.data('calcHeight')){
                            w = +$img.data('width');
                            h = +$img.data('height');

                            if(w && h) {
                                nh = $img.width()/w * h;
                                $img.attr('height', nh).data('calcHeight', nh);
                            }
                        }

                        $target.eq(i).css({top:bottoms[x]+TOP_MARGIN,left:x*(ITEM_WIDTH + LEFT_MARGIN)});
                        bottoms[x] = $target[i].offsetTop + $target[i].offsetHeight;
                    }

                    $stream.height(Math.max.apply(Math, bottoms)+TOP_MARGIN);
                };
            });
        }
		if ($(this).parents('.step').hasClass('step2')==true) {
            var selectedCategories = new Array();
            $('.category-list li a').each(function(){
                if ($(this).hasClass('selected')) {
                    selectedCategories.push($(this).attr('value'));
                }
            });
            $.ajax({
                url: baseURL+"site/product/onboarding_get_users_follow",
                data: { categories: selectedCategories.join() },
                cache: false,
                dataType: 'json'
            }).done(function( html ) {
                $('.popup.onboarding .step3 .intxt.suggested').append(html.suggested);
                $('.popup.onboarding .step3 .scroll').append(html.categories);
            });
		}
		if ($(nextStep).find('.intxt').height()>$(nextStep).find('scroll').height()) {$(nextStep).find('.btn-area').css('box-shadow','0 -2px 0px 0px rgba(0,0,0,0.07);').css('border-color','#cdcecf');}
	});
    $('.onboarding .step3 .category').click(function() {
        $('.onboarding .step3 .category').each(function() {
            $(this).removeClass("selected");
        });
        $(this).addClass("selected");
        var cname = $(this).attr('cname');
        $('.step3 .intxt').hide();
        $('.step3 .intxt.'+cname).show();
    });
    $('.onboarding .step3').delegate('a.follow-user-link', 'click', function() {
        var uid = $(this).attr('uid');
        var param = {};
        param['user_id']=uid;
        var btn = $(this);
        if (btn.hasClass('following')) {
            $.post(baseURL+"site/user/delete_follow",param,
                function(json){
                    if (json.status_code==1) {
                       btn.text(gettext('Follow'));
                       btn.removeClass('following');
                    }
                }, "json");
        } else {
            $.post(baseURL+"site/user/add_follow",param,
                function(json){
                    if (json.status_code==1) {
                       btn.text(gettext('Following'));
                       btn.addClass('following');
                    }
                }, "json");
        }
    });
    $('.onboarding .step3').delegate('button.btn-followall', 'click', function() {
        var user_ids = new Array();
        var $followBtns = $(this).closest('div.intxt').find('ul.suggest-list a.follow-user-link');
        $followBtns.each(function(){
            user_ids.push($(this).attr('uid'));
        });
        var param = {};
        param['user_ids'] = user_ids.join(',');
        $.post(baseURL+"site/user/add_follows",param,
                function(json){
                    if (json.status_code==1) {
                        $followBtns.each(function(){
                            $(this).text(gettext('Following'));
                            $(this).addClass('following');
                        });
                    }
                }, "json");
    });
	$('.popup .scroll').scroll(function(){
		if ($(this).scrollTop()>$(this).find('.intxt').height()-$(this).height()-1) {$(this).parents('.step').find('.btn-area').css('box-shadow','none').css('border-color','#ebecef');
		}else{$(this).parents('.step').find('.btn-area').css('box-shadow','0 -2px 0 rgba(0,0,0,0.07)').css('border-color','#cdcecf');;}
		if ($(this).scrollTop()==0) { $(this).parents('.step').find('.tit').css('box-shadow','none').css('border-color','#ebecef');
		}else{$(this).parents('.step').find('.tit').css('box-shadow','0 2px 0px 0px rgba(0,0,0,0.07)').css('border-color','#cdcecf');}
	});
	$('.popup.onboarding .step4 .btn-close').click(function(){
	    location.href = baseURL;
	});
/*	$('.popup.onboarding .step3 .btn-close').click(function(){
	    location.href = baseURL;
	});
*/	$('.popup.onboarding').delegate('.button.fancy', 'click', function(event){
		var $this = $(this);
		var tid  = $this.attr('tid') || null;

        if (tid != null) {
            event.preventDefault();
            $this.addClass('loading');
            $this.disable();
            $.ajax({
                type : 'post',
                url  : baseURL+'site/product/add_reaction_tag',
                data : {thing_id:tid},
                dataType : 'json',
                success : function(json){
                    $this.removeClass('loading');

                    if(json.status_code != 1) return;

                    $this
                        .toggleClass('fancy fancyd')
                        .html('<span><i></i></span>'+gettext(likedTXT));

                    $this.trigger('fancy');
                },
                complete : function() {
                    $this.disable(false);
                }
            });
        }
	});
    $('.popup.onboarding').delegate('.button.fancyd', 'click', function(event){
		var $this = $(this);
		var tid  = $this.attr('tid') || null;

        if (tid != null) {
            event.preventDefault();

            $this.addClass('loading');
			$this.disable();
			$.ajax({
				type : 'post',
				url  : baseURL+'site/product/delete_reaction_tag',
				data : {thing_id:tid},
				dataType : 'json',
				success  : function(json){
		            $this.removeClass('loading');
					if(json.status_code != 1) return;
					$this.removeClass('fancyd').addClass('fancy').html('<span><i></i></span>'+gettext(likeTXT));
				},
				complete : function(){
					$this.disable(false);
				}
			});
        }
	});
    $('.popup.onboarding .sns-people').each(function(){
		$(this).find('dt .close').click(function(){
			$(this).hide().parents('dt').removeClass('none').find('.btns-gray-embo').show().end().end().parents('.sns-people').find('dd').hide();
		});
	});
    $('.popup.onboarding button.twitter').click(function() {
//        var loc = location.protocol+"//"+location.host;
		var loc = baseURL;
		var param = {'location':loc};
		var popup = window.open(null, '_blank', 'height=400,width=800,left=250,top=100,resizable=yes', true);			
        var $btn = $(this);
//        $btn.hide().parents('dt').addClass('none').find('.close').show().end().end().parents('.sns-people').find('dd.follow').show();
 //       $btn.parents('dl.sns-people').find('dd.follow .loader').show();
        $.post(
			baseURL+'site/user/find_friends_twitter',
			param, 
			function(json){
				if (json.status_code==1) {
					popup.location.href = json.url;						
/*					twitterConnected0(popup,json.url,
						function(json){
							if(json.status_code==1){
                                $.post(
                                    baseURL+'site/user/onboarding_get_twitter_friends_on_fancy',
                                    null,
                                    function(html) {
                                        var $followPanel = $btn.parents('dl.sns-people').find('dd.follow');
                                        $btn.parents('dl.sns-people').find('dd.follow .container').html(html);
                                        FancyFriendsScroll.infiniteScroll($followPanel, '#more-twitter-on-fancy');

                                        $btn.parents('dl.sns-people').find('dd.follow .loader').hide();
                                    },
                                    'html'
                                );
                            } else {
							}
						},
						function(json){
						})
*/				}
				else if (json.status_code==0) {
					alert(json.message);
				}  
			},
			'json'
		);
    });
   
    $('.popup.onboarding button.facebook').click(function() {
    	FB.ui({
    	    method: 'apprequests',
    	    message: 'Invites you to join on <?php echo $siteTitle;?> (<?php echo base_url();?>?ref=<?php echo $userDetails->row()->user_name;?>)'
    	});
/*        var $btn = $(this);
//        $btn.hide().parents('dt').addClass('none').find('.close').show().end().end().parents('.sns-people').find('dd.follow').show();
//       $btn.parents('dl.sns-people').find('dd.follow .loader').show();
        FB.login(function(response2) {
            if (response2.authResponse) {
                var param = {'perms':''};
                $.post(
                    '/link_or_update_fb_user.xml',
                    param,
                    function(xml){
                        var $xml = $(xml);
                        if ($xml.find("status_code").length>0 && $xml.find("status_code").text()==1) {
                            $.post(
                                '/onboarding_get_facebook_friends_on_fancy',
                                null,
                                function(html) {
                                    var $followPanel = $btn.parents('dl.sns-people').find('dd.follow');
                                    $btn.parents('dl.sns-people').find('dd.follow .container').html(html);
                                    FancyFriendsScroll.infiniteScroll($followPanel, '#more-facebook-on-fancy');
                                    $btn.parents('dl.sns-people').find('dd.follow .loader').hide();
                                },
                                'html'
                            );
                        } else if ($xml.find("status_code").length>0 && $xml.find("status_code").text()==0) {
                            alert($xml.find("message").text());
                        } else {
                        }
                    },
                    'xml'
                );
            } else {
            }
        }, {scope:'offline_access,email,publish_stream,publish_actions'});
*/    });
    $('.popup.onboarding button.gmail').click(function() {
        var loc = location.protocol+'//'+location.host;
       var param = {'location':loc};
		var popup = window.open(null, '_blank', 'height=550,width=900,left=250,top=100,resizable=yes', true);
        var $btn = $(this);
//        $btn.hide().parents('dt').addClass('none').find('.close').show().end().end().parents('.sns-people').find('dd.follow').show();
 //       $btn.parents('dl.sns-people').find('dd.follow .loader').show();
		$.post(
			baseURL+'site/user/find_friends_gmail',
			param, 
			function(json){
				if (json.status_code==1) {
					popup.location.href = json.url;	
				}
				else if (json.status_code==0) {
					alert(json.message);
				}  
			},
			'json'
			/*function(xml){
				if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
					popup.location.href = $(xml).find("url").text();
					gmailConnected0(popup,$(xml).find("url").text(),
						function(xml){
							if($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1){
                                $.post(
                                    '/onboarding_get_gmail_friends_on_fancy',
                                    null,
                                    function(html) {
                                        var $followPanel = $btn.parents('dl.sns-people').find('dd.follow');
                                        $btn.parents('dl.sns-people').find('dd.follow .container').html(html);
                                        FancyFriendsScroll.infiniteScroll($followPanel, '#more-gmail-on-fancy');

                                        $btn.parents('dl.sns-people').find('dd.follow .loader').hide();
                                    },
                                    'html'
                                );
                            }
							else if($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0 && $(xml).find("message").length>0){
								alert($(xml).find("message").text());                                      
							}
							else{
							}
						},
						function(xml){
							//alert("Please login to Gmail.");  
						})
				}
				else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
					alert($(xml).find("message").text());
				}
			},
			'xml'*/
		);
    });
    $('.popup.onboarding .sns-people dd.follow a.invite').click(function() {
        var $followPanel = $(this).parents('dd.follow');
        var $invitePanel = $(this).parents('dl.sns-people').find('dd.invite');
        
        $followPanel.hide();
        $invitePanel.show();
        if($invitePanel.find('div.container').children().length == 0) {
            var url = null;
            var postfix = null;
            if ($(this).hasClass('twitter')) {
                url = '/onboarding_get_twitter_friends';
                postfix = 'twitter';
            } else if ($(this).hasClass('gmail')) {
                url = '/onboarding_get_gmail_friends';
                postfix = 'gmail';
            } else if ($(this).hasClass('facebook')) {
                url = '/onboarding_get_facebook_friends';
                postfix = 'facebook';
            } else if ($(this).hasClass('gplus')) {
                url = '/onboarding_get_friends_social?backend=google';
                postfix = 'google';
            }

            if (url) {
                $invitePanel.find('div.loader').show();
                $.post(
                    url,
                    null,
                    function(html) {
                        $invitePanel.find('div.container').html(html);
                        $invitePanel.find('div.loader').hide();
                        FancyFriendsScroll.infiniteScroll($invitePanel, '#more-'+postfix);
                    },
                    'html'
                );
            }
        }
    });
    $('.popup.onboarding .sns-people dd.invite a.follow').click(function() {
        $(this).parents('dd.invite').hide();
        $(this).parents('dl.sns-people').find('dd.follow').show();
    });

    var FancyFriendsScroll = {
        infiniteScroll: function ($container, nextSelector) {
            var stream = $container.find('.sns-friends');
            if (!stream.length) {
                return;
            }
            $container.find('a.more').click(function (event) {
                event.preventDefault();
                var page = stream.data('page-number');
                var timestamp = null;
                if(page){
                    $container.find('a.more').attr('ts',page);
                    timestamp = page;
                }
                else{
                    timestamp = $container.find('a.more').attr('ts');			
                }
                
                var instance = stream.infinitescroll({
                        navSelector: "div.pagination",
                        nextSelector: nextSelector,
                        itemSelector: ".sns-friends > li",
                        timestamp:timestamp,
                        timestampSelector: nextSelector,
                        isPaused: true
                    }).data('infinitescroll');
                
                if (page) {
                    instance.options.timestamp = page;
                }
                instance.retrieve();
                
                return instance;
            });
        },
    };

    var twitterConnected0 = function(popup,url,success, failure) {
        var wait  = function() {
            setTimeout(function() {
                if (popup == null) {
                    failure(); // When does this happen?
                    return;
                }
                if (popup.closed) {
                    $.post('/link_or_update_tw_user.xml',function(xml) {
                        if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
                            success(xml);
                        }
                        else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
                            alert($(xml).find("message").text());
                            failure();
                        }
                        else {
                            /*failure();*/
                        }
                    }, "xml");
                }
                else {
                    wait();
                }
            }, 25);
        };
        wait();
    };

    var gmailConnected0 = function(modal,url,success, failure) {
        var wait  = function() {
            setTimeout(function() {
                if (modal == null) {
                    failure(); // When does this happen?
                    return;
                }
                if (modal.closed) {
                    $.post('/find_friends/google/check.xml',function(xml) {
                        if ($(xml).find("status_code").length>0) {
                            success(xml);
                        }
                        else {
                            failure();
                        }
                    }, "xml");
                }
                else {
                    wait();
                }
            }, 25);
        };
        wait();
    };

    var googleConnected = false;
    function onLinkCallback_GetFriends(authResult) {
        if (!gplus_clicked || authResult.error == 'access_denied') return false;

        var url = location.protocol == 'https:' ? '/social/link_google.json' : '/link_google.json';
        authResult['update'] = true;

        if (!googleConnected) {
            var $btn = $('#fancy-gplus-link');
            $btn.hide().parents('dt').addClass('none').find('.close').show().end().end().parents('.sns-people').find('dd.follow').show();
            $btn.parents('dl.sns-people').find('dd.follow .loader').show();
            $.post(url, authResult, function(json){
                var code = json.status_code;
                if (code == 0) {
                    alert(json.message);
                } else {
                    $.post(
                        '/onboarding_get_friends_social_on_fancy?backend=google',
                        null,
                        function(html) {
                            var $followPanel = $btn.parents('dl.sns-people').find('dd.follow');
                            $btn.parents('dl.sns-people').find('dd.follow .container').html(html);
                            FancyFriendsScroll.infiniteScroll($followPanel, '#more-google-on-fancy');

                            $btn.parents('dl.sns-people').find('dd.follow .loader').hide();
                            googleConnected = true;
                        },
                        'html'
                    );
                }
            }, "json");
        }
    }
    $(window).ready(function(){
		if ($(window).height()>720) {
			$('.popup.onboarding').css('margin',($(window).height()-720)/2+'px auto').show();
		}else{
			$('.popup.onboarding .txt').height($(window).height()-165);
			$('.popup.onboarding .index').css('padding',($(window).height()-529)/2+'px 0');
			$('.popup.onboarding').css('margin-top','5px').show();
		}
        
        var param = $.jStorage.get('fancy_add_to_cart', null);
        if (param && param['thing_id']) {
            location.href = '/things/' + param['thing_id']; 
        } else {
            $.dialog('onboarding').open().close = function() {};
        }

        window.fbAsyncInit = function() {
            FB.init({appId: '<?php echo $this->config->item('facebook_app_id');?>', status: true,cookie: true, xfbml: true,oauth : true});
        };
        (function() {
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
        }());

        function initialize_gplus() {
            if (typeof gapi == "undefined") {
                setTimeout(initialize_gplus, 50);
                return;
            }
            
            $("#fancy-gplus-link").live('click', function() {
                gplus_clicked = true;
                return false;
            });
            
            if ($('#fancy-gplus-link').length > 0) {
                link_options.callback = "onLinkCallback_GetFriends";
                
                gapi.signin.render('fancy-gplus-link', link_options);
            }
        }
        initialize_gplus();
	});
	$(window).resize(function(){
		if ($(window).height()>720) {
			$('.popup.onboarding').css('margin',($(window).height()-720)/2+'px auto').show();
		}else{
			$('.popup.onboarding .txt').height($(window).height()-165);
			$('.popup.onboarding .index').css('padding',($(window).height()-529)/2+'px 0');
			$('.popup.onboarding').css('margin-top','5px').show();
		}
	});
	$('#popup_container > .popup.onboarding ol.stream').delegate('a.button.fancy,a.button.fancyd', 'mouseover', function(event){
	return false;
	});
</script>
<?php $this->load->view('site/templates/footer.php');?>