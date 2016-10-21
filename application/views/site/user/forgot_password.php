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
		<nav id="accessibility-nav">
		<ol>
			<li><a href="#navigation"><?php if($this->lang->line('signup_skip_navi') != '') { echo stripslashes($this->lang->line('signup_skip_navi')); } else echo "Skip to navigation"; ?></a></li>
			<li><a href="#content"><?php if($this->lang->line('signup_skip_cont') != '') { echo stripslashes($this->lang->line('signup_skip_cont')); } else echo "Skip to content"; ?></a></li>
			<li><a href="#sidebar"><?php if($this->lang->line('signup_skip_sidebar') != '') { echo stripslashes($this->lang->line('signup_skip_sidebar')); } else echo "Skip to sidebar"; ?></a></li>
		</ol>
	</nav>
	<!-- / accessibility-nav -->
	<header id="header-new">
		<div class="inner">
			<div id="navigation-test" class="default">
				<div class="left">
					<h1 class="logo"><a href="<?php echo base_url();?>" alt="<?php echo $siteTitle;?>" title="<?php echo $siteTitle;?>"><img src="images/logo/<?php echo $logo;?>"/></a></h1>
				</div>
                
			</div>
		</div>
		<!-- / inner -->
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
	</header>
	<!-- / header -->
<!-- Section_start -->
<div id="container-wrapper" class="sign">
    <div class="container signin update2">
	<div class="wrapper-content">
	    <h2><?php if($this->lang->line('forgot_passsword') != '') { echo stripslashes($this->lang->line('forgot_passsword')); } else echo "Forgot Password"; ?></h2>
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
            <form method="post" action="site/user/forgot_password_user" class="frm clearfix"><input type='hidden' />
		<fieldset class="frm">
		    <h3 class="stit"><?php if($this->lang->line('forgot_enter_email') != '') { echo stripslashes($this->lang->line('forgot_enter_email')); } else echo "Forgot your password? Enter your email address to reset it."; ?></h3>
			<p><label class="label"><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?></label>
			<input type="text" id="username" name="email" placeholder="" autofocus="autofocus"/></p>
			<input class="next_url" type="hidden" name="next" value="/"/>
                    
		    
		    <p class="btn-area"><button type="submit" class="btns-blue-embo btn-signin"><?php if($this->lang->line('forgot_reset_pwd') != '') { echo stripslashes($this->lang->line('forgot_reset_pwd')); } else echo "Reset Password"; ?></button>
		</fieldset>
            </form>
	</div>
	<div class="footer">
	    <?php if($this->lang->line('forgot_never_mind') != '') { echo stripslashes($this->lang->line('forgot_never_mind')); } else echo "Never mind?"; ?> 
	    <a href="login"><?php if($this->lang->line('signup_sign_in') != '') { echo stripslashes($this->lang->line('signup_sign_in')); } else echo "Sign In"; ?></a>
	</div>
    </div>
</div>
<?php 
if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}
?>
</body>
</html>
