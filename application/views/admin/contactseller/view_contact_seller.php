<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading; ?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/contactseller/display_contact_seller',$attributes); 
						
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Name <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->name;?> 
										</div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Email Address <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->email;?> 
										</div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Phone Number <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->phone;?> 
										</div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Contact Question <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->question;?> 
										</div>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Seller Email Adderss <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $contact_seller_status->row()->selleremail;?> 
										</div>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Product Name<span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php echo $prodDetails->row()->product_name;?> 
										</div>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="mode">Product Image <span class="req">*</span></label>
									<div class="form_input">
										<div class="live_sandbox">
											<?php $Imgname = @explode(',',$prodDetails->row()->image); ?>
                                            <img src="<?php echo 'images/product/'.$Imgname[0];?> " alt="<?php echo $prodDetails->row()->product_name;?> " width="100" /> 
										</div>
									</div>
								</div>
								</li>

								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/contactseller/display_contact_seller" class="tipLeft" title="Go to message list"><span class="badge_style b_done">Back</span></a>
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