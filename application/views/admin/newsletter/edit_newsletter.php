<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Email Template</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/newsletter/insertEditNewsletter',$attributes) 
					?>
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_title">Template Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="news_title" style=" width:295px" id="news_title" value="<?php echo $user_details->row()->news_title;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the email templete name"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="news_subject">Email Subject <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="news_subject" style=" width:295px" id="news_subject" value="<?php echo $user_details->row()->news_subject;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the email templete subject"/>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="sender_name">Sender Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="sender_name" style=" width:295px" id="sender_name" type="text" tabindex="1" value="<?php echo $user_details->row()->sender_name;?>" class="required tipTop" title="Please enter the sender name"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="sender_email">Sender Email Address <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="sender_email" style=" width:295px" id="sender_email" type="text" tabindex="1" value="<?php echo $user_details->row()->sender_email;?>" class="required tipTop" title="Please enter the sender email address"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_descrip">Email Description </label>
									<div class="form_input">
                                    <textarea name="news_descrip" style=" width:295px;" class="tipTop mceEditor" title="Please enter the email templete description"><?php echo $user_details->row()->news_descrip;?></textarea>
									</div>
								</div>
								</li>
                                
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($user_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $user_details->row()->id;?>"/>
								</li>--><input type="hidden" name="newsletter_id" value="<?php echo $user_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>