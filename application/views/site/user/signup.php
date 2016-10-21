<?php 
@session_start();
unset($_SESSION['token']);
$social_login_session_array = $this->session->all_userdata(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }
if ($heading == ''){?>
<title><?php echo $title;?></title>
<?php }else {?>
<title><?php echo $heading;?></title>
<?php }?>
<meta name="Title" content="<?php echo $meta_title;?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<base href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/logo/<?php echo $fevicon;?>"/>
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>clone-style.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>main.css" />
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>filessign.css">
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>filespopup.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>filestimeline-slideshow.css">
<link rel="stylesheet" type="text/css" media="all" href="css/site/<?php echo SITE_COMMON_DEFINE ?>filesphoto.css">
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>profile.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/developer.css"/>
<script src="js/site/jquery-1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		var can_show_signin_overlay = false;
		if (navigator.platform.indexOf('Win') != -1) {document.write("<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>");}
	</script>
<!--[if lt IE 9]>
<script src="js/site/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
<?php 
$this->load->view('site/templates/theme_settings');
?>
</head>
<body class="lang-en wider no-subnav" >
<?php if (is_file('google-login-mats/index.php'))
{
	require_once 'google-login-mats/index.php';
}?>
<nav id="accessibility-nav">
  <ol>
    <li><a href="#navigation"><?php if($this->lang->line('signup_skip_navi') != '') { echo stripslashes($this->lang->line('signup_skip_navi')); } else echo "Skip to navigation"; ?></a></li>
    <li><a href="#content"><?php if($this->lang->line('signup_skip_cont') != '') { echo stripslashes($this->lang->line('signup_skip_cont')); } else echo "Skip to content"; ?></a></li>
    <li><a href="#sidebar"><?php if($this->lang->line('signup_skip_sidebar') != '') { echo stripslashes($this->lang->line('signup_skip_sidebar')); } else echo "Skip to sidebar"; ?></a></li>
  </ol>
</nav>
<!-- / accessibility-nav -->
<header id="header-new" class="login_header">
  <div class="inner">
    <div id="navigation-test" class="default">
      <div class="left">
        <h1 class="logo"><a href="<?php echo base_url();?>" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>" style="padding-top: 10px;"><img src="images/logo/<?php echo $logo;?>" width="48" height="48" /></a></h1>
      </div>
      <div class="right">
        <p class="sign-cmt"><?php if($this->lang->line('signup_have_Accnt') != '') { echo stripslashes($this->lang->line('signup_have_Accnt')); } else echo "Have an account?"; ?> <a href="login"><?php if($this->lang->line('signup_sign_in') != '') { echo stripslashes($this->lang->line('signup_sign_in')); } else echo "Sign in"; ?></a></p>
      </div>
    </div>
  </div>
  <!-- / inner -->
  <a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a> </header>
<!-- / header -->
<!-- Section_start -->
<div id="container-wrapper" class="sign">
  <div class="container signup update2">
    <div class="wrapper-content">
     <!-- <h2>Join <?php echo $siteTitle;?> today</h2>-->        
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
      <h2> <?php if($this->lang->line('signup_join_msg') != '') { echo $site_join_msg; } else echo "Join".$siteTitle."today"; ?></h2>
      <div class="sns-login" <?php if($social_login_session_array['social_login_name'] != ''){?>style="display:none;"<?php }?>>
        <h3 class="stit"><?php if($this->lang->line('signup_connect_network') != '') { echo stripslashes($this->lang->line('signup_connect_network')); } else echo "Connect with a social network"; ?></h3>
        <ul class="sns-major">
 <?php 
if ($this->config->item('facebook_app_id') != '' && $this->config->item('facebook_app_secret') != ''){
?>         
          <li>
            <button class="btn-f fb facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'"><span class="icon ic-fb"><i></i></span> <b><?php if($this->lang->line('signup_facebook') != '') { echo stripslashes($this->lang->line('signup_facebook')); } else echo "Facebook"; ?></b></button>
          </li>
<?php 
}
?>     
<?php 
if ($this->config->item('google_client_secret') != '' && $this->config->item('google_client_id') != '' && $this->config->item('google_redirect_url') != '' && $this->config->item('google_developer_key') != '' && is_file('google-login-mats/index.php')){
?> 	     
          <li>
            <button class="btn-g google" onClick="window.location.href='<?php echo $authUrl; ?>'" id="fancy-g-signin" next="/settings/shipping"><span class="icon ic-gg"><i></i></span> <b><?php if($this->lang->line('signup_google') != '') { echo stripslashes($this->lang->line('signup_google')); } else echo "Google"; ?></b></button>
          </li>
 <?php 
}
?>  
<?php 
if ($this->config->item('consumer_key') != '' && $this->config->item('consumer_secret') != ''){
?>          
          <li>
            <button class="btn-t tw twitter" onClick="window.location.href='<?php echo base_url();?>twtest/redirect'"><span class="icon ic-tw"><i></i></span> <b><?php if($this->lang->line('signup_twitter') != '') { echo stripslashes($this->lang->line('signup_twitter')); } else echo "Twitter"; ?></b></button>
          </li>
<?php 
}
?>
        </ul>
      </div>
      <div class="default">
        <fb:facepile id="facepile" size="large" max_rows="1" width="450" data-colorscheme="light" style="overflow:hidden;height:1px"></fb:facepile>
        <p class="otherway"  <?php if($social_login_session_array['social_login_name'] != ''){?>style="display:none;"<?php }?>><?php if($this->lang->line('signup_signupwith') != '') { echo stripslashes($this->lang->line('signup_signupwith')); } else echo "Sign up with"; ?> <a href="#" onClick="$('.sign .default').hide();$('.sign .email-frm').show();return false;"><?php if($this->lang->line('signup_email_addrs') != '') { echo stripslashes($this->lang->line('signup_email_addrs')); } else echo "your email address"; ?></a> </p>
      </div>
      		<?php if (validation_errors() != ''){?>
			<div id="validationErr">
				<script>setTimeout("hideErrDiv('validationErr')", 3000);</script>
				<p><?php echo validation_errors();?></p>
			</div>
			<?php }?>
			<?php if($flash_data != '') { ?>
			<div class="errorContainer" id="<?php echo $flash_data_type;?>">
				<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
				<p><span><?php echo $flash_data;?></span></p>
			</div>
			<?php } ?>
             <?php 
	   		$yoursitepage = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_sitepage'));
			$siteaccswrld = str_replace("{SITENAME}",$siteTitle,$this->lang->line('signup_access_wrld'));
	  		 ?>
			<form onSubmit="return register_user();" method="post">
                <fieldset class="frm email-frm" style="display:<?php if($social_login_session_array['social_login_name'] == '') echo 'none'; else 'block'; ?>">
                    <?php if($social_login_session_array['social_email_name'] == '') { ?>
                    <h3 class="stit"><?php if($this->lang->line('signup_with_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_with_emailaddrs')); } else echo "Sign up with your email address"; ?></h3><?php } ?>
                    
                   <?php if($social_login_session_array['social_email_name'] != '') { ?> <h3 class="stit">Your email address : <?php echo $social_login_session_array['social_email_name'];?> </h3><?php } ?>
                    
                    
                    
                    <p><label class="label"><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?><span class="error-label" id="error-fullname"></span></label>
                    <input type="text" autofocus="autofocus" id="fullname" class="fullname" name="full_name" placeholder="" value="<?php echo $social_login_session_array['social_login_name'];?>"/></p>
                    <p><label class="label"><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?><span class="error-label" id="error-username"></span></label>
                    <input type="text" id="username" class="username" name="user_name" placeholder="" onKeyUp="$(this).parents('.email-frm ').find('.url b').text($(this).val())" value=""/>
                    <small class="url"><?php if($this->lang->line('signup_sitepage') != '') { echo $yoursitepage; } else echo "Your ".$siteTitle." page:"; ?> <?php echo base_url();?>user/<b>USERNAME</b></small></p>
                   	<?php if($social_login_session_array['loginUserType'] != 'google') { ?>
                    <p><label class="label"><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?><span class="error-label" id="error-email"></span></label><?php } ?>
                    <input type="<?php if($social_login_session_array['loginUserType'] != 'google') echo 'text'; else echo 'hidden'; ?>" id="email" class="email" name="email" value="<?php echo $social_login_session_array['social_email_name'];?>" /><?php if($social_login_session_array['loginUserType'] != 'google') { ?></p><?php } ?>
                    
                   <?php if($social_login_session_array['social_login_name'] == '') {?> <p><label class="label"><?php if($this->lang->line('signup_password') != '') { echo stripslashes($this->lang->line('signup_password')); } else echo "Password"; ?><span class="error-label" id="error-user_password"></span></label><?php } ?>
                    <?php $pwdLength = 10;

			$userNewPwd = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $pwdLength);?>
                    <input type="<?php if($social_login_session_array['social_login_name'] == '') echo 'password'; else echo 'hidden'; ?>" id="user_password" class="password" name="password" placeholder="<?php if($this->lang->line('signup_min_chars') != '') { echo stripslashes($this->lang->line('signup_min_chars')); } else echo "Minimum 6 characters"; ?>" value="<?php if($social_login_session_array['social_login_name'] != '') echo $userNewPwd; ?>" /> <?php if($social_login_session_array['social_login_name'] == '') {?></p><?php } ?>
                    
                    <input name="referrer" type="hidden" class="referrer" value="" />
                    <input name="invitation_key" type="hidden" class="invitation_key" value="" />
                    <input type='hidden' name='csrfmiddlewaretoken' value='UFLfIU881eyZJbm7Bq0kUFZ9sVaWGh54' />
                    <input type='hidden' name='api_id' id="api_id"  value='<?php echo $social_login_session_array['social_login_unique_id'];?>' />
                    <input type='hidden' name='thumbnail' id='thumbnail' value='<?php echo $social_login_session_array['social_image_name'];?>' />
                    <input type='hidden' name='loginUserType' id='loginUserType' value='<?php if($social_login_session_array['loginUserType'] != '') echo $social_login_session_array['loginUserType']; else echo "normal";?>' />
                    
                    <p><input type="checkbox" name="brandSt" class="brandSt" id="brandSt" />
                    <label for="brand_store" onClick="$(this).parents('p').find('input').toggleClass('checked');" class="brand"><?php if($this->lang->line('signup_im_brndstre') != '') { echo stripslashes($this->lang->line('signup_im_brndstre')); } else echo "I'm a brand or store"; ?></label>
                    <span class="tooltip"><i class="ic-q"></i><small><strong><?php if($this->lang->line('signup_for_brandstre') != '') { echo stripslashes($this->lang->line('signup_for_brandstre')); } else echo "For brands or stores"; ?></strong><br />
                   <?php if($this->lang->line('signup_access_wrld') != '') { echo $siteaccswrld; } else echo "Brands and stores may sign up to ".$siteTitle." and make their products available to millions of users across the world."; ?> <b></b></small></span></p>
                    <p class="btn-area"><button class="btns-blue-embo sign" ><?php if($this->lang->line('signup_creat_myacc') != '') { echo stripslashes($this->lang->line('signup_creat_myacc')); } else echo "Create my account"; ?></button></p>
                    <p class="otherway"><a href="#" onClick="$('.sign .default').show();$('.sign .email-frm').hide();return false;"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go back"; ?></a></p>
                </fieldset>
		</form>
    </div>
  </div>
</div>
<!-- Section_start -->
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filescatalog.js" type="text/javascript"></script>
<script src="js/site/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery-ui-1.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_002.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery.js" type="text/javascript"></script>
<script src="js/site/main4.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filestimeline_slideshow.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/profile_things.js"></script>
<script>
jQuery(function($){
	$('a.more').mouseover(function(){$('.sns-minor').show();return false;});
	$('a.more').click(function(){
		$('.sns-minor').toggleClass('toggle');
	});
	$('.sns-minor .trick').click(function(){
		$('.sns-minor').removeClass('toggle');
		return false;
	});
	$('.sns-major').mouseover(function(){$('.sns-minor').hide();return false;});
	$('.sns-minor').mouseover(function(){if ($(this).hasClass('toggle')==false) $(this).hide();});
});
</script>
<script>
        $.infiniteshow({
            itemSelector:'#content ol.stream > li',
            streamSelector:'#content ol.stream',
            dataKey:'home-new',
            post_callback: function($items){ $('ol.stream').trigger('itemloaded') },
            prefetch:true,
            
            newtimeline:true
        })
        if($.browser.msie) $.infiniteshow.option('prepare',1000);
    </script>
    <?php 
if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}
?>
</body>
</html>
