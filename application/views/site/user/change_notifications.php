<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<!-- Section_start -->
<div id="container-wrapper">
	<div class="container set_area">
		<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>		


        <div id="content">
        <h2 class="ptit"><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></h2>
        <div style="display:none" class="notification-bar"></div>
        <form method="post" action="site/user_settings/update_notifications">                
        <div class="section notification">
            <h3 class="stit"><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></h3>
            <fieldset class="frm">
                <label><?php if($this->lang->line('notify_email_sett') != '') { echo stripslashes($this->lang->line('notify_email_sett')); } else echo "Email settings"; ?></label>
                <?php 
                $emailNoty = explode(',', $userDetails->row()->email_notifications);
                if (is_array($emailNoty)){
                	$emailNotifications = $emailNoty;
                }
                ?>
                <ul>
                    <li><input type="checkbox" <?php if (in_array('following', $emailNotifications)){echo 'checked="checked"';}?> name="following"><label class="label" for="following"><?php if($this->lang->line('notify_some_follu') != '') { echo stripslashes($this->lang->line('notify_some_follu')); } else echo "When someone follows you"; ?></label></li>
                    <li><input type="checkbox" <?php if (in_array('comments_on_fancyd', $emailNotifications)){echo 'checked="checked"';}?> name="comments_on_fancyd"><label class="label" for="comments_on_fancyd"><?php if($this->lang->line('notify_comm_things') != '') { echo stripslashes($this->lang->line('notify_comm_things')); } else echo "When someone comments on a thing you"; ?> <?php echo LIKED_BUTTON;?></label></li>
                    <li><input type="checkbox" <?php if (in_array('featured', $emailNotifications)){echo 'checked="checked"';}?> name="featured" ><label class="label" for="featured"><?php if($this->lang->line('notify_thing_feature') != '') { echo stripslashes($this->lang->line('notify_thing_feature')); } else echo "When one of your things is featured"; ?></label></li>
	            	<li><input type="checkbox" name="comments" <?php if (in_array('comments', $emailNotifications)){echo 'checked="checked"';}?>><label class="label" for="comments"><?php if($this->lang->line('cmt_on_ur_thing') != '') { echo stripslashes($this->lang->line('cmt_on_ur_thing')); } else echo "When someone comments on your thing"; ?></label></li>    
 				</ul>
            </fieldset>
        </div>
        <div class="section notification">
            <h3 class="stit"><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></h3>
            <fieldset class="frm">
                <label><?php if($this->lang->line('notify_web_sett') != '') { echo stripslashes($this->lang->line('notify_web_sett')); } else echo "Web settings"; ?> </label>
                <small class="comment"><?php if($this->lang->line('notify_notify_showup') != '') { echo stripslashes($this->lang->line('notify_notify_showup')); } else echo "The web notifications show up in the topbar of the"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('settings_website') != '') { echo stripslashes($this->lang->line('settings_website')); } else echo "website"; ?>. </small>
                <label><?php if($this->lang->line('notify_active_involves') != '') { echo stripslashes($this->lang->line('notify_active_involves')); } else echo "Activity that involves you"; ?></label>
                <?php 
                $noty = explode(',', $userDetails->row()->notifications);
                if (is_array($noty)){
                	$notifications = $noty;
                }
                ?>
                <ul>
                    <li><input type="checkbox" name="wmn-follow" <?php if (in_array('wmn-follow', $notifications)){echo 'checked="checked"';}?> ><label class="label" for="wmn-follow"><?php if($this->lang->line('notify_some_follu') != '') { echo stripslashes($this->lang->line('notify_some_follu')); } else echo "When someone follows you"; ?></label></li>
                    <li><input type="checkbox" name="wmn-comments_on_fancyd" <?php if (in_array('wmn-comments_on_fancyd', $notifications)){echo 'checked="checked"';}?>><label class="label" for="wmn-comments_on_fancyd"><?php if($this->lang->line('notify_comm_things') != '') { echo stripslashes($this->lang->line('notify_comm_things')); } else echo "When someone comments on a thing you"; ?> <?php echo LIKED_BUTTON;?></label></li>
                    <li><input type="checkbox" name="wmn-fancyd" <?php if (in_array('wmn-fancyd', $notifications)){echo 'checked="checked"';}?>><label class="label" for="wmn-fancyd"><?php if($this->lang->line('notify_when_some') != '') { echo stripslashes($this->lang->line('notify_when_some')); } else echo "When someone"; ?> <?php echo LIKE_BUTTON;?> <?php if($this->lang->line('notify_ur_thing') != '') { echo stripslashes($this->lang->line('notify_ur_thing')); } else echo "one of your things"; ?></label></li>
                </ul>
                <ul class="last">
                    <li><input type="checkbox" name="wmn-featured" <?php if (in_array('wmn-featured', $notifications)){echo 'checked="checked"';}?>><label class="label" for="wmn-featured"><?php if($this->lang->line('notify_thing_feature') != '') { echo stripslashes($this->lang->line('notify_thing_feature')); } else echo "When one of your things is featured"; ?></label></li>
                	<li><input type="checkbox" name="wmn-comments" <?php if (in_array('wmn-comments', $notifications)){echo 'checked="checked"';}?>><label class="label" for="wmn-comments"><?php if($this->lang->line('cmt_on_ur_thing') != '') { echo stripslashes($this->lang->line('cmt_on_ur_thing')); } else echo "When someone comments on your thing"; ?></label></li>
 					</ul>
            </fieldset>
        </div>
        <div class="section notification">
            <h3 class="stit"><?php if($this->lang->line('notify_update') != '') { echo stripslashes($this->lang->line('notify_update')); } else echo "Updates"; ?></h3>
            <fieldset class="frm">
                <label><?php if($this->lang->line('notify_update_from') != '') { echo stripslashes($this->lang->line('notify_update_from')); } else echo "Updates from"; ?> <?php echo $siteTitle;?></label>
                <ul>
                    <li><input type="checkbox" <?php if ($userDetails->row()->updates == '1'){echo 'checked="checked"';}?> id="updates" name="updates"><label class="label" for="updates"><?php if($this->lang->line('notify_send_news') != '') { echo stripslashes($this->lang->line('notify_send_news')); } else echo "Send news about"; ?> <?php echo $siteTitle;?></label></li>
                </ul>
            </fieldset>
        </div>
        <div class="btn-area">
            <button id="save_notifications" class="btn-save"><?php if($this->lang->line('notify_save_change') != '') { echo stripslashes($this->lang->line('notify_save_change')); } else echo "Save Changes"; ?></button>
			<span style="display:none" class="checking"><i class="ic-loading"></i></span>
        </div>
        </form>
    </div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
     $this->load->view('site/templates/side_footer_menu');
     ?>
		

	</div>
	<!-- / container -->
</div>
</div>

<!-- Section_start -->

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
<?php 
$this->load->view('site/templates/footer');
?>