<?php
$this->load->view('admin/templates/header.php');
 if (is_file('./fc_mail_chimp_settings.php'))
{
	include('fc_mail_chimp_settings.php');
}
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'regitstraion_form');
						echo form_open('admin/adminlogin/save_mail_chimp_settings',$attributes) 
					?>
	 						<ul>
								<li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="mailchimp_api_key">Api Key</label>
                                        <div class="form_input">
                                          <input name="mailchimp_api_key" value="<?php echo $config['mailchimp_api_key'];?>" id="mailchimp_api_key" type="text" tabindex="1" class="large tipTop" title="Please enter the mailchimp api key"/>
                                        </div>
                                      </div>
                                    </li>
                                    
                                    <li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="mailchimp_list_id">List Id</label>
                                        <div class="form_input">
                                          <input name="mailchimp_list_id" value="<?php echo $config['mailchimp_list_id'];?>" id="mailchimp_list_id" type="text" tabindex="1" class="large tipTop" title="Please enter the mailchimp list id"/>
                                        </div>
                                      </div>
                                    </li>
                                   <li>
								<div class="form_grid_12">
									<label class="field_title" for="mailchimp_status">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="radio" name="mailchimp_status" <?php if ($config['mailchimp_status'] == 'Yes'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="Yes"/>Yes &nbsp; <input type="radio" name="mailchimp_status" <?php if ($config['mailchimp_status'] == 'No'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive" value="No"/> No
										</div>
									</div>
								</div> 
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
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
