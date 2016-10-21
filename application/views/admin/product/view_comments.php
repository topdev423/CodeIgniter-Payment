<?php
$this->load->view('admin/templates/header.php');
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
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="country_id">User Name <span class="req">*</span></label>
                                    <div class="form_input">
                                      <?php echo $tax_details->row()->user_name;?>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">Product Name <span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo $tax_details->row()->product_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">Comments<span class="req">*</span></label>
									<div class="form_input">
                                   <?php echo $tax_details->row()->comments;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/comments/view_product_comments" class="tipLeft" title="Go to location list"><span class="badge_style b_done">Back</span></a>
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