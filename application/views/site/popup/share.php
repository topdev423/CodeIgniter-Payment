<!--share-->
<div uname="<?php if ($loginCheck != ''){echo $userDetails->row()->user_name;}?>" class="popup ly-title share-new" id="fancy-share" style="display:none;">
	<p class="ltit">
		<span class="share-thing"><?php if($this->lang->line('header_share_thing') != '') { echo stripslashes($this->lang->line('header_share_thing')); } else echo "Share This Thing"; ?></span>
		<span class="share-comment"><?php if($this->lang->line('header_share_comment') != '') { echo stripslashes($this->lang->line('header_share_comment')); } else echo "Share This Comment"; ?></span>
		<span class="share-list"><?php if($this->lang->line('header_share_list') != '') { echo stripslashes($this->lang->line('header_share_list')); } else echo "Share This List"; ?></span>
		<span class="share-gift"><?php if($this->lang->line('header_share_gift') != '') { echo stripslashes($this->lang->line('header_share_gift')); } else echo "Share This Gift Campaign"; ?></span>
		<span class="share-user"><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?> {{name}}'s <?php if($this->lang->line('header_profile') != '') { echo stripslashes($this->lang->line('header_profile')); } else echo "Profile"; ?></span>
	</p>
	<div class="fig">
		<span class="thum"><em class="shadow"></em><img src="images/site/blank.gif"></span>
		<div class="fig-info">
			<span class="figcaption"></span>
			<span class="username"><b></b>, <a href="#"></a></span>
			<h4></h4><p class="from"></p>
		</div>
		<div class="bio"></div>
		<p class="link"><span onclick="$(this).parents('.link').find('input').select()" class="icon ic-link"><em><?php if($this->lang->line('header_copy_clip') != '') { echo stripslashes($this->lang->line('header_copy_clip')); } else echo "Copy link to clipboard"; ?></em></span><input type="text" readonly="" class="text" id="share-link-input"></p>
	</div>
	 
	<div class="share-via">
		<ul class="less">
			
			<li><a target="_blank" class="fb" href="#"><span class="ic-fb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></em></a></li>
			<li><a target="_blank" class="tw" href="#"><span class="ic-tw"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></em></a></li>
			<li><a target="_blank" class="gg" id="gplus-share" href="#"><span class="ic-gg"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?>+</em></a></li>
			<li><a target="_blank" class="su" href="#"><span class="ic-su"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_stumbleupon') != '') { echo stripslashes($this->lang->line('signup_stumbleupon')); } else echo "StumbleUpon"; ?></em></a></li>
			<li><a target="_blank" class="li" href="#"><span class="ic-link"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_linkedin') != '') { echo stripslashes($this->lang->line('signup_linkedin')); } else echo "LinkedIn"; ?></em></a></li>
			<li><a target="_blank" class="tb" href="#"><span class="ic-tb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_tumblr') != '') { echo stripslashes($this->lang->line('signup_tumblr')); } else echo "Tumblr"; ?></em></a></li>
			<li><a target="_blank" class="vk" href="#"><span class="ic-vk"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_bkohtakte') != '') { echo stripslashes($this->lang->line('signup_bkohtakte')); } else echo "BKohtakte"; ?></em></a></li>
			<li><a target="_blank" class="od" href="#"><span class="ic-od"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_OnHOKnaccHNKN') != '') { echo stripslashes($this->lang->line('signup_OnHOKnaccHNKN')); } else echo "OnHOKnaccHNKN"; ?></em></a></li>
			
			<li><a class="mx" href="#"><span class="ic-mx"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_mixi') != '') { echo stripslashes($this->lang->line('signup_mixi')); } else echo "mixi"; ?></em></a></li>
			<li><a target="_blank" class="qz" href="#"><span class="ic-qz"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_qzone') != '') { echo stripslashes($this->lang->line('signup_qzone')); } else echo "q-zone"; ?></em></a></li>
			<li><a target="_blank" class="wb" href="#"><span class="ic-wb"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_weibo') != '') { echo stripslashes($this->lang->line('signup_weibo')); } else echo "Weibo"; ?></em></a></li>
			<li><a class="mx" href="#"><span class="ic-re"></span> <em><?php if($this->lang->line('header_share_on') != '') { echo stripslashes($this->lang->line('header_share_on')); } else echo "Share on "; ?><?php if($this->lang->line('signup_renren') != '') { echo stripslashes($this->lang->line('signup_renren')); } else echo "Renren"; ?></em></a></li>
		</ul>
		<a class="show" href="#"><i class="arrow"></i></a> 
	</div>
	
	<ul class="tab">
		<li><a class="current" href="#.email"><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?> </a></li>
		<li><a href="#.anywhere"><?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_anywhere') != '') { echo stripslashes($this->lang->line('header_anywhere')); } else echo "Anywhere"; ?></a></li>
	</ul>
	<div class="embed">
		<span class="embed-thum">
			<em class="photo"><i class="btn_fancy"></i></em>
			<em class="info_tit"></em>
			<em class="info_price"></em>
			<em class="info_by"></em>
		</span>
		<dl class="embed-size">
			<dt><?php if($this->lang->line('header_widget_size') != '') { echo stripslashes($this->lang->line('header_widget_size')); } else echo "Widget size"; ?></dt>
			<dd><label><?php if($this->lang->line('header_width') != '') { echo stripslashes($this->lang->line('header_width')); } else echo "Width"; ?>:</label> <input type="text" class="width_ text" value="640"> <?php if($this->lang->line('header_px') != '') { echo stripslashes($this->lang->line('header_px')); } else echo "px"; ?></dd>
			<dd><label><?php if($this->lang->line('header_heigth') != '') { echo stripslashes($this->lang->line('header_heigth')); } else echo "Height"; ?>:</label> <input type="text" readonly="" class="height_ text" value="640"> <?php if($this->lang->line('header_px') != '') { echo stripslashes($this->lang->line('header_px')); } else echo "px"; ?></dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_contents') != '') { echo stripslashes($this->lang->line('header_contents')); } else echo "Contents"; ?></dt>
			<dd>
				<ul>
					<li><input type="checkbox" checked="" key="tt" id="embed-info_tit"> <label for="embed-info_tit"><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></label></li>
					<li><input type="checkbox" checked="" key="pr" id="embed-info_price"> <label for="embed-info_price"><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></label></li>
					<li><input type="checkbox" checked="" key="by" id="embed-info_by"> <label for="embed-info_by"><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?></label></li>
					<li><input type="checkbox" checked="" key="bt" id="embed-btn_fancy"> <label for="embed-btn_fancy"><?php echo ucfirst($siteTitle);?> <?php if($this->lang->line('header_it') != '') { echo stripslashes($this->lang->line('header_it')); } else echo "it"; ?></label></li>
				</ul>
			</dd>
		</dl>
		<textarea readonly="" class="text" id="share-embed-input"></textarea>
	</div>
	<div class="anywhere">
		<dl class="info">
			<dd><textarea style="margin-top: 0;" readonly="" class="text" id="share-anywhere"></textarea></dd>
		</dl>
	</div>
	<div class="email share-with-someone">
		<dl class="to">
			<dt><?php if($this->lang->line('onboarding_to') != '') { echo stripslashes($this->lang->line('onboarding_to')); } else echo "To"; ?></dt>
			<dd class="email-frm">
				
				<span tabindex="0" class="add">+ <?php if($this->lang->line('header_add_email') != '') { echo stripslashes($this->lang->line('header_add_email')); } else echo "Add email address"; ?></span>
				<input type="text" class="text" style="width: 99%;">
				<ul class="user-list"></ul>
			</dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_addition_more') != '') { echo stripslashes($this->lang->line('header_addition_more')); } else echo "Additional note"; ?></dt>
			<dd><textarea class="text" placeholder="<?php if($this->lang->line('header_person_note') != '') { echo stripslashes($this->lang->line('header_person_note')); } else echo "Include a personal note"; ?>"></textarea></dd>
		</dl>
		<div class="btn-area">
			<button class="btns-blue-embo btn-send"><?php if($this->lang->line('header_send') != '') { echo stripslashes($this->lang->line('header_send')); } else echo "Send"; ?></button>
		</div>
	</div>
	<div class="btn-area">
		<button class="btn-share" type="button"><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></button>
	</div>
	<button title="Close" class="ly-close" type="button"><i class="ic-del-black"></i></button>
</div>
<!--share-->