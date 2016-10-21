<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New User</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/users/insertEditUser',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Full Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="full_name" id="full_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the user fullname"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">User Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="user_name" id="user_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the username"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Group <span class="req">*</span></label>
									<div class="form_input">
										<div class="user_seller">
											<input type="checkbox" tabindex="3" name="group" checked="checked" id="User_Seller_User" class="User_Seller"/>
										</div>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address <span class="req">*</span></label>
									<div class="form_input">
										<input name="email" id="email" type="text" tabindex="4" class="required large tipTop" title="Please enter the user email address"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="new_password">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="new_password" id="new_password" type="password" tabindex="5" class="required large tipTop" title="Please enter the new password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="confirm_password">Re-type Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="confirm_password" id="confirm_password" type="password" tabindex="6" class="required large tipTop" title="Please re-type the above password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="thumbnail">User Image<span class="req">*</span></label>
									<div class="form_input">
										<input name="thumbnail" id="thumbnail" type="file" tabindex="7" class="large tipTop" title="Please select user image"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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