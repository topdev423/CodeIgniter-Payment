<?php 
session_start();

 $site_join_msg = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_join_msg')); 
?>
  
  
  <div class="popup sign signup signin-overlay" style="display:none;">
    <div class="popup_wrap update2">
     <h2>    <?php foreach($layoutfulllist->result() as $layoutListRow){ 
      
       if($layoutListRow->place == 'signup title'  ){
	  echo  $layoutListRow->text; ?></h2>
	<?php 
			
	  } } ?>
      
      
        <h3 class="stit">    <?php foreach($layoutfulllist->result() as $layoutListRow){ 
      
       if($layoutListRow->place == 'signup description'){
	  echo  $layoutListRow->text; ?></h3>
	<?php 
			
	  } } ?>
      <div class="sns-login">
        <ul class="sns-major">
<?php 
if ($this->config->item('facebook_app_id') != '' && $this->config->item('facebook_app_secret') != ''){
?>       
          <li>
            <button class="btn-f facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'"><span class="icon ic-fb"><i></i></span> <b><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></b></button>
          </li>
<?php 
}
?>


<?php 
if ($this->config->item('google_client_secret') != '' && $this->config->item('google_client_id') != '' && $this->config->item('google_redirect_url') != '' && $this->config->item('google_developer_key') != '' && is_file('google-login-mats/index.php')){
?> 	
          <li>
            <button data-gapiattached="true" class="btn-g google" onclick="window.location.href='<?php echo $authUrl; ?>'" id="fancy-g-signin" next="/"><span class="icon ic-gg"><i></i></span> <b><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?></b></button>
          </li>
          
          
     <?php 
}
?>      
          
          
<?php 
if ($this->config->item('consumer_key') != '' && $this->config->item('consumer_secret') != ''){
?> 
          <li>
            <button class="btn-t twitter"  onclick="window.location.href='<?php echo base_url();?>twtest/redirect'"><span class="icon ic-tw"><i></i></span> <b><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></b></button>
          </li>
<?php 
}
$by_creating_accnt = str_replace("{SITENAME}",$siteTitle,$this->lang->line('header_create_acc'));
?>          
        </ul>
      </div>
      <fieldset class="frm default">
      <h3 class="stit" style="cursor: text;"><?php if($this->lang->line('signup_with_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_with_emailaddrs')); } else echo "Sign up with your email address"; ?> </h3>
      <p>
        <input placeholder="<?php if($this->lang->line('header_enter_email') != '') { echo stripslashes($this->lang->line('header_enter_email')); } else echo "Enter your email address"; ?>" id="signin-email" type="text">
        <button class="btns-blue-embo btn-signup" onclick="javascript:quickSignup();"><?php if($this->lang->line('login_signup') != '') { echo stripslashes($this->lang->line('login_signup')); } else echo "Sign up"; ?></button>
      </p>
      <input class="next_url" value="/" type="hidden">
      <p class="anyway"><?php if($this->lang->line('signup_have_Accnt') != '') { echo stripslashes($this->lang->line('signup_have_Accnt')); } else echo "Have an account?"; ?> <a href="login"><?php if($this->lang->line('header_login') != '') { echo stripslashes($this->lang->line('header_login')); } else echo "Login"; ?></a></p>
      </fieldset>
    </div>
    <a href="#" class="btn-close">X</a> 
    
    </div>
    
    <div class="popup sign register signup quickSignup2" style="display:none;">
	<div class="popup_wrap">
		<h2><?php if($this->lang->line('header_almost_done') != '') { echo stripslashes($this->lang->line('header_almost_done')); } else echo "Almost Done!"; ?></h2>
		<h3 class="stit"><?php if($this->lang->line('header_more_details') != '') { echo stripslashes($this->lang->line('header_more_details')); } else echo "We need a few more things to set up your account."; ?></h3>
            <fieldset class="frm">
                <p class="error" style="margin:-10px 0 20px;display:none;"></p>
                <p><label class="label"><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full name"; ?></label>
                <input type="text" name="fullname" class="fullname" id="fullname" placeholder="" /></p>
                <p style="display:none;"><label class="label"><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?></label>
                <input type="text" name="email" id="email" class="email" value="" /></p>
                <p><label class="label"><?php if($this->lang->line('header_choose_name') != '') { echo stripslashes($this->lang->line('header_choose_name')); } else echo "Choose your username"; ?></label>
                <input type="text" name="username" class="username" id="username" placeholder="" />
                <small class="url"><?php if($this->lang->line('header_your') != '') { echo stripslashes($this->lang->line('header_your')); } else echo "Your"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_page') != '') { echo stripslashes($this->lang->line('header_page')); } else echo "page"; ?>: <?php echo base_url();?><?php if($this->lang->line('header_user') != '') { echo stripslashes($this->lang->line('header_user')); } else echo "user"; ?>/<b><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "username"; ?></b></small></p>
                <p><label class="label"><?php if($this->lang->line('header_create_pwd') != '') { echo stripslashes($this->lang->line('header_create_pwd')); } else echo "Create a password"; ?></label>
                <input type="password" name="user_password" class="user_password" id="user_password" placeholder="" />
                <span class="loader"><b></b> <em></em></span></p>
                <p class="account-txt"><?php if($this->lang->line('header_create_acc') != '') { echo $by_creating_accnt; } else echo "By creating an account, I accept ".$siteTitle."'s"; ?>  <?php if($this->lang->line('header_terms_service') != '') { echo stripslashes($this->lang->line('header_terms_service')); } else echo "Terms of Service"; ?><br /> <?php if($this->lang->line('header_and') != '') { echo stripslashes($this->lang->line('header_and')); } else echo "and"; ?> <?php if($this->lang->line('header_privacy_policy') != '') { echo stripslashes($this->lang->line('header_privacy_policy')); } else echo "Privacy Policy"; ?>.</p>
                <button class="btns-blue-embo btn-create sign" style="width: 150px;" onclick="javascript:quickSignup2();" from_popup="true" ><?php if($this->lang->line('signup_creat_myacc') != '') { echo stripslashes($this->lang->line('signup_creat_myacc')); } else echo "Create my account"; ?></button>
            </fieldset>
	</div>
    
</div>