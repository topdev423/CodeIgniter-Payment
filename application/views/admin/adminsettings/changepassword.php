<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Change Password</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'regitstraion_form');
						echo form_open('admin/adminlogin/change_admin_password',$attributes) 
					?>
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="password">Current Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="password" id="password" type="password" tabindex="1" class="required large tipTop" title="Please enter the current password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="newpassword">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="new_password" id="new_password" type="password" tabindex="2" class="required large tipTop" title="Please enter a new password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="confirm_password">Retype Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="confirm_password" id="confirm_password" type="password" tabindex="2" class="required large tipTop" title="Please re-enter your new password again"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue"><span>Change</span></button>
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