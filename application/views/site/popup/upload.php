<div class="popup drop-to-upload no-slide" style="display:none;">
	<h1>
		<span class="top"></span><span class="left"></span><span class="right"></span><span class="bottom"></span>
		<strong><?php if($this->lang->line('header_drop_up') != '') { echo stripslashes($this->lang->line('header_drop_up')); } else echo "Drop to Upload"; ?></strong>
	</h1>
</div>
<div class="popup add-fancy box-rnd-shadow-2 ly-title step1 animated" style="margin-top: 43px; margin-left: 415px; opacity: 1; display: none;">
	<div class="step step0-error">
		<p class="ltit"><?php if($this->lang->line('header_error') != '') { echo stripslashes($this->lang->line('header_error')); } else echo "Error"; ?></p>
		<p class="message">
			<i class="ic-error-black"></i>
			<?php if($this->lang->line('header_up_try') != '') { echo stripslashes($this->lang->line('header_up_try')); } else echo "Please try uploading again. Filetype is not supported."; ?><br>
			<?php if($this->lang->line('header_img_format') != '') { echo stripslashes($this->lang->line('header_img_format')); } else echo "The image must be in one of the following formats: .jpeg, .jpg, .gif or .png."; ?>
		</p>
		<p class="btns-area"><button class="btn-blue-embo"><?php if($this->lang->line('header_okay') != '') { echo stripslashes($this->lang->line('header_okay')); } else echo "Okay"; ?></button></p>
	</div>
	<div class="step step1">
		<p class="ltit"><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle;?></p>
		
		<ul class="case">
 			<li><a href="#step2"><span class="ico-web"></span><?php if($this->lang->line('from_web') != '') { echo stripslashes($this->lang->line('from_web')); } else echo "From Web"; ?></a></li> 
			<li><a href="#step2-upload"><span class="ico-up"></span><?php if($this->lang->line('header_upload') != '') { echo stripslashes($this->lang->line('header_upload')); } else echo "Upload"; ?></a></li>
 			<li class="last"><a href="#step4"> <span class="ico-mail"></span><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></a></li> 
		</ul>
 		<p class="comment">
		</p>
		</p>
 	</div>
	<div class="step step2">
		<p class="ltit"><?php if($this->lang->line('header_add_frmweb') != '') { echo stripslashes($this->lang->line('header_add_frmweb')); } else echo "Add from Web"; ?></p>
		<div class="link">
			<p>
				<label><?php if($this->lang->line('header_enter_imglink') != '') { echo stripslashes($this->lang->line('header_enter_imglink')); } else echo "Enter an image link or a website address"; ?></label>
				<input type="text" placeholder="http://" class="input-text url_">
			</p>
		</div>
		<div class="btns-area">
			<button class="btn-blue-embo-fetch"><?php if($this->lang->line('header_fetch_imgs') != '') { echo stripslashes($this->lang->line('header_fetch_imgs')); } else echo "Fetch Images"; ?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
		<div class="progress"><span class="progress-bar"><em></em></span></div>
	</div>
	<div class="step step2-upload">
		<p class="ltit"><?php if($this->lang->line('header_upload_to') != '') { echo stripslashes($this->lang->line('header_upload_to')); } else echo "Upload to"; ?> <?php echo $siteTitle;?></p>
		<label><?php if($this->lang->line('header_seletct_drag') != '') { echo stripslashes($this->lang->line('header_seletct_drag')); } else echo "Select an image here to upload"; ?></label>
		<form enctype="multipart/form-data" method="post" target="iframe_img_upload" action="/upload_image?callback=_upload_image_callback"><input type="hidden" value="" name="">
		<div class="file"><input type="file" accept="image/*" value="" name="file"></div>
		<div class="btns-area">
			<button class="btn-blue-embo-upload" type="submit"><span><?php if($this->lang->line('header_upload') != '') { echo stripslashes($this->lang->line('header_upload')); } else echo "Upload"; ?></span></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
		<div class="progress" style="display: none;"><span class="progress-bar"><em style="width: 0px;"></em></span></div>
		</form>
	</div>
	<div class="step step3">
		<p class="ltit"></p>
		<dl>
			<dt><?php if($this->lang->line('header_prod_details') != '') { echo stripslashes($this->lang->line('header_prod_details')); } else echo "Product Details"; ?> <small><?php if($this->lang->line('header_change_later') != '') { echo stripslashes($this->lang->line('header_change_later')); } else echo "(Can be changed later)"; ?></small></dt>
			<dd>
				<div class="img">
					<div class="photo-wrap"><img class="photo"></div>
					<span class="controls">
						<button class="prev"><i></i><span class="hidden"><?php if($this->lang->line('header_prev') != '') { echo stripslashes($this->lang->line('header_prev')); } else echo "Prev"; ?></span></button>
						<button class="next"><i></i><span class="hidden"><?php if($this->lang->line('onboarding_next') != '') { echo stripslashes($this->lang->line('onboarding_next')); } else echo "Next"; ?></span></button>
						<span class="cur_"><?php if($this->lang->line('header_one_ten') != '') { echo stripslashes($this->lang->line('header_one_ten')); } else echo "1 of 10"; ?></span>
					</span>
					<span class="size"></span>
				</div>
				<div class="frm">
					<input type="hidden" value="sarvan16" id="fancy_add-user_key">
					<input type="hidden" value="" id="fancy_add-photo_url">
					<label><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></label>
					<input type="text" class="input-text" id="fancy_add-name">
					<label><?php if($this->lang->line('header_weblink') != '') { echo stripslashes($this->lang->line('header_weblink')); } else echo "Web Link"; ?></label>
					<input type="text" placeholder="http://" class="input-text" id="fancy_add-link">
					<label><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></label>
						<select class="select-round selectBox categories_" id="fancy_add-category">
						<option value=""><?php if($this->lang->line('header_choose_categry') != '') { echo stripslashes($this->lang->line('header_choose_categry')); } else echo "Choose a category"; ?></option>
						<?php 
						if ($mainCategories->num_rows()>0){
							foreach ($mainCategories->result() as $mainCat){
						?>
						<option value="<?php echo $mainCat->id;?>"><?php echo $mainCat->cat_name;?></option>
						<?php 
							}
						}
						?>
						</select>
				</div>
				<textarea placeholder="<?php if($this->lang->line('header_sam_somethng') != '') { echo stripslashes($this->lang->line('header_sam_somethng')); } else echo "Say something about this"; ?>" maxlength="200" id="fancy_add-note"></textarea>
			</dd>
		</dl>
		<div class="btns-area">
			<button class="btn-blue-embo-add"><span></span><?php if($this->lang->line('header_add_to') != '') { echo stripslashes($this->lang->line('header_add_to')); } else echo "Add to"; ?> <?php echo $siteTitle;?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
	</div>
	<div class="step step4">
		<p class="ltit"><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></p>
		<dl>
			<dt><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></dt>
			<dd><input type="text" class="input-text" placeholder="<?php if($this->lang->line('header_title_image') != '') { echo stripslashes($this->lang->line('header_title_image')); } else echo "Enter a title for your image here"; ?>"></dd>
		</dl>
		<dl>
			<dt><?php if($this->lang->line('header_comment') != '') { echo stripslashes($this->lang->line('header_comment')); } else echo "Comment"; ?></dt>
			<dd><textarea placeholder="<?php if($this->lang->line('header_comnt_here') != '') { echo stripslashes($this->lang->line('header_comnt_here')); } else echo "Add a comment here"; ?>"></textarea></dd>
		</dl>
		<div class="btns-area">
			<button class="btn-blue-embo-add emailSend"><span></span><?php if($this->lang->line('header_send') != '') { echo stripslashes($this->lang->line('header_send')); } else echo "Send"; ?></button>
			<a class="cancel" href="#"><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></a>
		</div>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
<iframe frameborder="0" name="iframe_img_upload"></iframe></div>