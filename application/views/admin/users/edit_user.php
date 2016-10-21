<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit User</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/users/insertEditUser',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">User Name </label>
									<div class="form_input">
										<?php echo $user_details->row()->user_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address </label>
									<div class="form_input">
										<?php echo $user_details->row()->email;?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Full Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="full_name" style=" width:295px" id="full_name" value="<?php echo $user_details->row()->full_name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the user fullname"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="thumbnail">User Image<span class="req">*</span></label>
									<div class="form_input">
										<input name="thumbnail" id="thumbnail" type="file" tabindex="7" class="large tipTop" title="Please select user image"/>
									</div>
									<div class="form_input"><img src="<?php echo base_url();?>images/users/<?php echo $user_details->row()->thumbnail;?>" width="100px"/></div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Group <span class="req">*</span></label>
									<div class="form_input">
										<div class="user_seller">
											<input type="checkbox" name="group" <?php if ($user_details->row()->group == 'User'){echo 'checked="checked"';}?> id="User_Seller_User" class="User_Seller"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($user_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $user_details->row()->id;?>"/>
								</li>
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