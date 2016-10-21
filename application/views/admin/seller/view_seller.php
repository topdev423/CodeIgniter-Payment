<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Seller</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Brand Details</a></li>
			                <li><a href="#tab2">Bank Details</a></li>
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
									<label class="field_title" for="admin_name">Seller Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->full_name == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->full_name;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Brand Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->brand_name == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->brand_name;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Description</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->brand_description == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->brand_description;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Website</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->web_url == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->web_url;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Commision</label>
									<div class="form_input">
										<?php echo $seller_details->row()->commision.' %';?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status</label>
									<div class="form_input">
										<?php echo $seller_details->row()->request_status;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/seller/display_seller_<?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>" class="tipLeft" title="Go to seller <?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab2">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="">Full Name</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->bank_name == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->bank_name;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Account Number</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->bank_no == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->bank_no;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Bank Code</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->bank_code == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->bank_code;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="paypal_email">Paypal Email</label>
									<div class="form_input">
										<?php 
										if ($seller_details->row()->paypal_email == ''){
											echo 'Not available';
										}else {
											echo $seller_details->row()->paypal_email;
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/seller/display_seller_<?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>" class="tipLeft" title="Go to seller <?php if ($seller_details->row()->request_status=='Pending'){echo 'requests';}else {echo 'list';}?>"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
						</div>
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