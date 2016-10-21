<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View User</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Details</a></li>
			                <li><a href="#tab2">Billing Address</a></li>
			                <li><a href="#tab3">Shipping Address</a></li>
			              </ul>
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">User Image</label>
									<div class="form_input">
									<?php if ( $user_details->row()->thumbnail == ''){?>
										<img src="<?php echo base_url();?>images/users/user-thumb1.png" width="100px"/>
									<?php }else {?>
										<img src="<?php echo base_url();?>images/users/<?php echo $user_details->row()->thumbnail;?>" width="100px"/>
									<?php }?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Full Name</label>
									<div class="form_input">
										<?php echo $user_details->row()->full_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<?php echo $user_details->row()->user_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Type</label>
									<div class="form_input">
										<?php echo $user_details->row()->group;?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Email Address</label>
									<div class="form_input">
										<?php echo $user_details->row()->email;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Created On</label>
									<div class="form_input">
										<?php echo $user_details->row()->created;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Modified On</label>
									<div class="form_input">
										<?php echo $user_details->row()->modified;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/users/display_user_list" class="tipLeft" title="Go to users list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
							</div>
							<div id="tab2">
								<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address Line 1</label>
									<div class="form_input">
										<?php echo $user_details->row()->address;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<?php echo $user_details->row()->city;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">District</label>
									<div class="form_input">
										<?php echo $user_details->row()->district;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Country</label>
									<div class="form_input">
										<?php echo $user_details->row()->country;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">State</label>
									<div class="form_input">
										<?php echo $user_details->row()->state;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Postal Code</label>
									<div class="form_input">
										<?php echo $user_details->row()->postal_code;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Phone Number</label>
									<div class="form_input">
										<?php echo $user_details->row()->phone_no;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/users/display_user_list" class="tipLeft" title="Go to users list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
							</div>
							<div id="tab3">
								<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address Line 1</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_address;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_city;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">District</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_district;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Country</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_country;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">State</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_state;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Postal Code</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_postal_code;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Phone Number</label>
									<div class="form_input">
										<?php echo $user_details->row()->s_phone_no;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/users/display_user_list" class="tipLeft" title="Go to users list"><span class="badge_style b_done">Back</span></a>
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