<?php $this->load->view('site/templates/header');?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">

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
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>

        <div id="content">
		<form onsubmit="return change_user_password();" method="post" action="<?php echo base_url().'site/user_settings/change_user_password'?>">
		<h2 class="ptit"><?php if($this->lang->line('change_password') != '') { echo stripslashes($this->lang->line('change_password')); } else echo "Change Password"; ?></h2>
		<div style="display:none" class="notification-bar"></div>
		<div class="section password">
			<fieldset class="frm">
				<label><?php if($this->lang->line('change_new_pwd') != '') { echo stripslashes($this->lang->line('change_new_pwd')); } else echo "New Password"; ?></label>
				<input type="password" name="pass" id="pass">
				<small class="comment"><?php if($this->lang->line('change_pwd_limt') != '') { echo stripslashes($this->lang->line('change_pwd_limt')); } else echo "New password, at least 6 characters."; ?></small>
				<label><?php if($this->lang->line('change_conf_pwd') != '') { echo stripslashes($this->lang->line('change_conf_pwd')); } else echo "Confirm Password"; ?></label>
				<input type="password" name="confirmpass" id="confirmpass">
				<small class="comment"><?php if($this->lang->line('change_ur_pwd') != '') { echo stripslashes($this->lang->line('change_ur_pwd')); } else echo "Confirm your new password."; ?></small>
			</fieldset>
		</div>
		<div class="btn-area">
			<button id="save_password" class="btn-save"><?php if($this->lang->line('change_password') != '') { echo stripslashes($this->lang->line('change_password')); } else echo "Change Password"; ?></button>
			<span style="display:none" class="checking"><i class="ic-loading"></i></span>
		</div>
		</form>
	</div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
		$this->load->view('site/templates/side_footer_menu');?>

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
