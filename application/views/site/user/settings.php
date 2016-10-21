<?php $this->load->view('site/templates/header');?>
<link rel="stylesheet" href="<?php echo base_url();?>css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url();?>css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<style type="text/css">
ol.stream {position: relative;}
ol.stream.use-css3 li.anim {transition:all .25s;-webkit-transition:all .25s;-moz-transition:all .25s;-ms-transition:all .25s;visibility:visible;opacity:1;}
ol.stream.use-css3 li {visibility:hidden;}
ol.stream.use-css3 li.anim.fadeout {opacity:0;}
ol.stream.use-css3.fadein li {opacity:0;}
ol.stream.use-css3.fadein li.anim.fadein {opacity:1;}
</style>
<!-- Section_start -->

<div class="lang-en no-subnav wider winOS">

<div id="container-wrapper">
	<div class="container set_area">
		

		<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 4000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
        <div id="content">
		<h2 class="ptit"><?php if($this->lang->line('settings_edit_prof') != '') { echo stripslashes($this->lang->line('settings_edit_prof')); } else echo "Edit Profile Settings"; ?></h2>
		<div class="notification-bar" style="display:none"></div>
		<?php 
		if ($userDetails->row()->is_verified == 'No'){
		?>
        <div class="confirm-email">
            
            <p><?php if($this->lang->line('settings_check_mail') != '') { echo stripslashes($this->lang->line('settings_check_mail')); } else echo "Check your email"; ?> <b>(<?php echo $userDetails->row()->email;?>)</b> <?php if($this->lang->line('settings_toconfirm') != '') { echo stripslashes($this->lang->line('settings_toconfirm')); } else echo "to confirm."; ?></p>
            <a id="resend_confirmation" href="javascript:void(0)" onclick="javascript:resendConfirmation('<?php echo $userDetails->row()->email;?>')"><?php if($this->lang->line('settings_resendconfm') != '') { echo stripslashes($this->lang->line('settings_resendconfm')); } else echo "Resend confirmation"; ?></a>
            
		</div>
		<?php 
		}
		?>
  		<form class="myform" id="profile_settings_form" method="post" action="site/user_settings/changePhoto" enctype="multipart/form-data" onSubmit="return profileUpdate();">
		<div class="section profile">
			<h3 class="stit"><?php if($this->lang->line('referrals_profile') != '') { echo stripslashes($this->lang->line('referrals_profile')); } else echo "Profile"; ?></h3>
			<fieldset class="frm">
				<label><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?></label>
				<input id="name" class="setting_fullname" name="setting-fullname" value="<?php echo $userDetails->row()->full_name;?>" type="text">
				<small class="comment"><?php if($this->lang->line('settings_realname') != '') { echo stripslashes($this->lang->line('settings_realname')); } else echo "Your real name, so your friends can find you."; ?></small>
				<label><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?></label>
				<input value="<?php echo $userDetails->row()->user_name;?>" disabled="disabled" type="text">
				<small class="comment"><?php echo base_url();?>user/<?php echo $userDetails->row()->user_name;?></small>
				<label><?php if($this->lang->line('settings_website') != '') { echo stripslashes($this->lang->line('settings_website')); } else echo "Website"; ?></label>
				<input id="site" class="setting_website" name="setting-website" value="<?php echo $userDetails->row()->web_url;?>" type="text">
				<label><?php if($this->lang->line('settings_location') != '') { echo stripslashes($this->lang->line('settings_location')); } else echo "Location"; ?></label>
				<input id="loc" class="setting_location" name="setting-location" value="<?php echo $userDetails->row()->location;?>"" class="text" placeholder="<?php if($this->lang->line('settings_eg_new') != '') { echo stripslashes($this->lang->line('settings_eg_new')); } else echo "e.g. New York, NY"; ?>" type="text">

				<label><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></label>
				<input id="twitter" class="setting_twitter" name="setting-twitter" value="<?php echo $userDetails->row()->twitter;?>"" type="text">

				<label><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></label>
				<input id="facebook" class="setting_facebook" name="setting-facebook" value="<?php echo $userDetails->row()->facebook;?>"" type="text">

				<label><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?>+</label>
				<input id="google" class="setting_google" name="setting-google" value="<?php echo $userDetails->row()->google;?>"" type="text">

				<label><?php if($this->lang->line('signup_youtube') != '') { echo stripslashes($this->lang->line('signup_youtube')); } else echo "Youtube"; ?></label>
				<input id="youtube" class="settings_youtube" name="settings_youtube" value="<?php echo $userDetails->row()->youtube;?>"" type="text">

				<label><?php if($this->lang->line('signup_instagram') != '') { echo stripslashes($this->lang->line('signup_instagram')); } else echo "Instagram"; ?></label>
				<input id="instagram" class="setting_instagram" name="setting-instagram" value="<?php echo $userDetails->row()->instagram;?>"" type="text">

				<label><?php if($this->lang->line('signup_rss') != '') { echo stripslashes($this->lang->line('signup_rss')); } else echo "Rss"; ?></label>
				<input id="rss" class="setting_rss" name="setting-rss" value="<?php echo $userDetails->row()->rss;?>"" type="text">

				<label><?php if($this->lang->line('settings_birthday') != '') { echo stripslashes($this->lang->line('settings_birthday')); } else echo "Birthday"; ?></label>				
				
				<?php 
				$birthday = explode('-', $userDetails->row()->birthday);
				?>
				<select id="birthday_year" class="birthday_year" name="setting-birthday-year">
                    <option value="0"><?php if($this->lang->line('settings_year') != '') { echo stripslashes($this->lang->line('settings_year')); } else echo "Year"; ?></option>
                    <?php 
                    $datestring = "%Y";
                    $curYear = mdate($datestring,time());
                    $diff = 100;
                    $lYear = $curYear-100;
                    for ($yr=$curYear;$yr>$lYear;$yr--){
                    ?>
                    <option <?php if ($birthday[0] == $yr){echo 'selected="selected"';}?> value="<?php echo $yr;?>"><?php echo $yr;?></option>
                    <?php 
                    }
                    ?>
                </select>
				<select id="birthday_month" class="birthday_month" name="setting-birthday-month">
                    <option selected="selected" value="0"><?php if($this->lang->line('settings_month') != '') { echo stripslashes($this->lang->line('settings_month')); } else echo "Month"; ?></option>
                    
                    <option <?php if ('01' == $birthday[1]){echo 'selected="selected"';}?> value="01"><?php if($this->lang->line('settings_january') != '') { echo stripslashes($this->lang->line('settings_january')); } else echo "January"; ?></option>
                    
                    <option <?php if ('02' == $birthday[1]){echo 'selected="selected"';}?> value="02"><?php if($this->lang->line('settings_february') != '') { echo stripslashes($this->lang->line('settings_february')); } else echo "February"; ?></option>
                    
                    <option <?php if ('03' == $birthday[1]){echo 'selected="selected"';}?> value="03"><?php if($this->lang->line('settings_march') != '') { echo stripslashes($this->lang->line('settings_march')); } else echo "March"; ?></option>
                    
                    <option <?php if ('04' == $birthday[1]){echo 'selected="selected"';}?> value="04"><?php if($this->lang->line('settings_april') != '') { echo stripslashes($this->lang->line('settings_april')); } else echo "April"; ?></option>
                    
                    <option <?php if ('05' == $birthday[1]){echo 'selected="selected"';}?> value="05"><?php if($this->lang->line('settings_may') != '') { echo stripslashes($this->lang->line('settings_may')); } else echo "May"; ?></option>
                    
                    <option <?php if ('06' == $birthday[1]){echo 'selected="selected"';}?> value="06"><?php if($this->lang->line('settings_june') != '') { echo stripslashes($this->lang->line('settings_june')); } else echo "June"; ?></option>
                    
                    <option <?php if ('07' == $birthday[1]){echo 'selected="selected"';}?> value="07"><?php if($this->lang->line('settings_july') != '') { echo stripslashes($this->lang->line('settings_july')); } else echo "July"; ?></option>
                    
                    <option <?php if ('08' == $birthday[1]){echo 'selected="selected"';}?> value="08"><?php if($this->lang->line('settings_august') != '') { echo stripslashes($this->lang->line('settings_august')); } else echo "August"; ?></option>
                    
                    <option <?php if ('09' == $birthday[1]){echo 'selected="selected"';}?> value="09"><?php if($this->lang->line('settings_september') != '') { echo stripslashes($this->lang->line('settings_september')); } else echo "September"; ?></option>
                    
                    <option <?php if ('10' == $birthday[1]){echo 'selected="selected"';}?> value="10"><?php if($this->lang->line('settings_october') != '') { echo stripslashes($this->lang->line('settings_october')); } else echo "October"; ?></option>
                    
                    <option <?php if ('11' == $birthday[1]){echo 'selected="selected"';}?> value="11"><?php if($this->lang->line('settings_november') != '') { echo stripslashes($this->lang->line('settings_november')); } else echo "November"; ?></option>
                    
                    <option <?php if ('12' == $birthday[1]){echo 'selected="selected"';}?> value="12"><?php if($this->lang->line('settings_december') != '') { echo stripslashes($this->lang->line('settings_december')); } else echo "December"; ?></option>
                    
                </select>
				<select id="birthday_day" class="birthday_day" name="setting-birthday-day">
                    <option selected="selected" value="0"><?php if($this->lang->line('settings_day') != '') { echo stripslashes($this->lang->line('settings_day')); } else echo "Day"; ?></option>
                    <?php 
                    for ($day=1;$day<32;$day++){
                    	if ($day<10){$day = '0'.$day;}
                    ?>
                    <option <?php if ($day==$birthday[2]){echo 'selected="selected"';}?> value="<?php echo $day?>"><?php echo $day?></option>
                    <?php 
                    }
                    ?>
                    
                </select>
				<small class="comment"><?php if($this->lang->line('settings_surprise_bday') != '') { echo stripslashes($this->lang->line('settings_surprise_bday')); } else echo "We'll send you a surprise on your birthday!"; ?></small>
				<label><?php if($this->lang->line('settings_about') != '') { echo stripslashes($this->lang->line('settings_about')); } else echo "About"; ?></label>
				<textarea id="bio" class="setting_bio" name="setting-bio" max-length="180"><?php echo $userDetails->row()->about;?></textarea>
				<small class="comment"><b class="byte"></b> <?php if($this->lang->line('settings_write_yours') != '') { echo stripslashes($this->lang->line('settings_write_yours')); } else echo "Write something about yourself."; ?></small>

			</fieldset>
		</div>
		<div class="section account">
			<h3 class="stit"><?php if($this->lang->line('referrals_account') != '') { echo stripslashes($this->lang->line('referrals_account')); } else echo "Account"; ?></h3>
			<fieldset class="frm">
				<label><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></label>
				<input id="email" class="setting_email" name="setting-email" data-email="<?php echo $userDetails->row()->email;?>" value="<?php echo $userDetails->row()->email;?>" type="text">
				<input id="user_email" value="<?php echo $userDetails->row()->email;?>" type="hidden">				
				<small class="comment"><?php if($this->lang->line('settings_email_not') != '') { echo stripslashes($this->lang->line('settings_email_not')); } else echo "Email will not be publicly displayed."; ?></small>
				<label><?php if($this->lang->line('settings_age') != '') { echo stripslashes($this->lang->line('settings_age')); } else echo "Age"; ?></label>
				<select name="setting-age" class="setting_age" id="age">
					<option selected="selected" value=""><?php if($this->lang->line('settings_rather') != '') { echo stripslashes($this->lang->line('settings_rather')); } else echo "I'd rather not say"; ?></option>
					<option <?php if ($userDetails->row()->age == '13 to 17'){echo 'selected="selected"';}?> value="13 to 17">13 to 17</option>
					<option <?php if ($userDetails->row()->age == '18 to 24'){echo 'selected="selected"';}?> value="18 to 24">18 to 24</option>
					<option <?php if ($userDetails->row()->age == '25 to 34'){echo 'selected="selected"';}?> value="25 to 34">25 to 34</option>
					<option <?php if ($userDetails->row()->age == '35 to 44'){echo 'selected="selected"';}?> value="35 to 44">35 to 44</option>
					<option <?php if ($userDetails->row()->age == '45 to 54'){echo 'selected="selected"';}?> value="45 to 54">45 to 54</option>
					<option <?php if ($userDetails->row()->age == '55+'){echo 'selected="selected"';}?> value="55+">55+</option>
				</select>
				<label><?php if($this->lang->line('settings_gender') != '') { echo stripslashes($this->lang->line('settings_gender')); } else echo "Gender"; ?></label>
				<input name="gender" class="setting_gender" <?php if ($userDetails->row()->gender=='Male'){echo 'checked="checked"';}?> value="Male" id="gender1" type="radio">
				<label for="gender1" class="label"><?php if($this->lang->line('settings_male') != '') { echo stripslashes($this->lang->line('settings_male')); } else echo "Male"; ?></label>
				<input name="gender" class="setting_gender" <?php if ($userDetails->row()->gender=='Female'){echo 'checked="checked"';}?> value="Female" id="gender2" type="radio">
				<label for="gender2" class="label"><?php if($this->lang->line('settings_female') != '') { echo stripslashes($this->lang->line('settings_female')); } else echo "Female"; ?></label>
				<input name="gender" class="setting_gender" <?php if ($userDetails->row()->gender=='Unspecified'){echo 'checked="checked"';}?> value="Unspecified" id="gender3" type="radio">
				<label for="gender3" class="label"><?php if($this->lang->line('settings_unspecified') != '') { echo stripslashes($this->lang->line('settings_unspecified')); } else echo "Unspecified"; ?></label>
			</fieldset>
		</div>
		<div class="section photo">
			<h3 class="stit"><?php if($this->lang->line('settings_photo') != '') { echo stripslashes($this->lang->line('settings_photo')); } else echo "Photo"; ?></h3>
			<?php 
			$userImg = 'user-thumb1.png';
			if ($userDetails->row()->thumbnail != ''){
				$userImg = $userDetails->row()->thumbnail;
			}
			?>
			<fieldset class="frm">
				<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $userImg;?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>
				<div class="photo-func">		
					<?php if ($userDetails->row()->thumbnail == ''){?>		
					<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func').hide();$('.upload-file').show();return false;" value="<?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?>"/>
					<?php }else {?>
					<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.photo-func').hide();$('.upload-file').show();return false;" value="<?php if($this->lang->line('change_photo') != '') { echo stripslashes($this->lang->line('change_photo')); } else echo "Change Photo"; ?>"/>
					<input type="button" style="cursor: pointer;" class="btn-delete" id="delete_profile_image" onClick="return deleteUserPhoto();" value="<?php if($this->lang->line('header_delete_photo') != '') { echo stripslashes($this->lang->line('header_delete_photo')); } else echo "Delete Photo"; ?>"/>
					<?php }?>
					<small class="comment">Max size 500 x 500px</small>
				</div>
				<div class="upload-file">
					<input id="uploadavatar" class="uploadavatar" name="upload-file" type="file">
					<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
					<span class="description"><?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG.<br>Maximum width and height is 600px"; ?></span>
					<input type="button" style="cursor: pointer;" class="btn-upload" id="save_profile_image" onclick="return updateUserPhoto();" value="<?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?>"/>
					<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.photo-func').show();$('.upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
				</div>
				<!-- <small class="comment"><?php if($this->lang->line('settings_profile_identy') != '') { echo stripslashes($this->lang->line('settings_profile_identy')); } else echo "Your profile photo is your identity on"; ?> <?php echo $siteTitle;?>, <?php if($this->lang->line('settings_pickone') != '') { echo stripslashes($this->lang->line('settings_pickone')); } else echo "so pick a good one that expresses who you are."; ?></small> -->
			</fieldset>
		</div>
		<div class="section banner-image">
			<h3 class="stit">Banner</h3>
			<?php 
			$bannerImg = '';
			if ($userDetails->row()->banner_image != ''){
				$bannerImg = $userDetails->row()->banner_image;
			}
			?>
			<fieldset class="frm">
				<div class="photo-preview"><img src="images/site/blank.gif" style="width:100%;height:100%;background-image:url(<?php echo base_url();?>images/users/<?php echo $bannerImg;?>);background-size:cover" alt="<?php echo $userDetails->row()->full_name;?>"></div>
				<div class="banner-func">		
					<?php if ($userDetails->row()->banner_image == ''){?>		
					<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.banner-func').hide();$('.banner-upload-file').show();return false;" value="<?php if($this->lang->line('header_up_banner_image') != '') { echo stripslashes($this->lang->line('header_up_banner_image')); } else echo "Upload Banner Image"; ?>"/>
					<?php }else {?>
					<input type="button" style="cursor: pointer;" class="btn-change" onClick="$('.banner-func').hide();$('.banner-upload-file').show();return false;" value="<?php if($this->lang->line('change_banner_image') != '') { echo stripslashes($this->lang->line('change_banner_image')); } else echo "Change Banner Image"; ?>"/>
					<input type="button" style="cursor: pointer;" class="btn-delete" id="delete_banner_image" onClick="return deleteUserBanner();" value="<?php if($this->lang->line('header_delete_image') != '') { echo stripslashes($this->lang->line('header_delete_image')); } else echo "Delete Banner Image"; ?>"/>
					<?php }?>
					<small class="comment">Max size 2560 x 1440px</small>
				</div>
				<div class="banner-upload-file">
					<input id="uploadbanner" class="uploadbanner" name="banner-upload-file" type="file">
					<span class="uploading" style="display:none"><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
					<span class="description" style="margin-top: 20px;"><!-- <?php if($this->lang->line('settings_allowedimag') != '') { echo stripslashes($this->lang->line('settings_allowedimag')); } else echo "Allowed file types JPG, GIF or PNG."; ?> --></span>
					<input type="button" style="cursor: pointer;" class="btn-upload" id="save_banner_image" onclick="return updateUserBanner();" value="<?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Banner Image"; ?>"/>
					<input type="button" style="cursor: pointer;" class="btn-cancel" onClick="$('.banner-func').show();$('.banner-upload-file').hide();return false;" value="<?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?>"/>
				</div>
				<!-- <small class="comment"><?php if($this->lang->line('settings_banner_identy') != '') { echo stripslashes($this->lang->line('settings_banner_identy')); } else echo "Your banner image is your identity on"; ?> <?php echo $siteTitle;?>, <?php if($this->lang->line('settings_pickone') != '') { echo stripslashes($this->lang->line('settings_pickone')); } else echo "so pick a good one that expresses who you are."; ?></small> -->
			</fieldset>
		</div>
		<div class="btn-area">
			<input type="submit" name="profile" style="cursor:pointer;" class="btn-save" id="save_account" value="<?php if($this->lang->line('settings_save_profile') != '') { echo stripslashes($this->lang->line('settings_save_profile')); } else echo "Save Profile"; ?>"/>
			<span class="checking" style="display:none"><i class="ic-loading"></i></span>
			<input type="button" style="cursor:pointer;" onClick="return deactivateUser();" class="btn-deactivate" id="close_account" value="<?php if($this->lang->line('settings_deact_acc') != '') { echo stripslashes($this->lang->line('settings_deact_acc')); } else echo "Deactivate my account"; ?>"/>
			
                        
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




<script src="<?php echo base_url();?>js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js" type="text/javascript"></script>

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
<?php $this->load->view('site/templates/footer');?>