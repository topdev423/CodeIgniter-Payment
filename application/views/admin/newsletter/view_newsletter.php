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
									<label class="field_title">Template Name</label>
									<div class="form_input">
										<?php echo $user_details->row()->news_title;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Subject </label>
									<div class="form_input">
										<?php echo $user_details->row()->news_subject;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Description</label>
									<div class="form_input">
										<?php echo $user_details->row()->news_descrip;?>
									</div>
								</div>
								</li>
	 							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/newsletter/display_newsletter" class="tipLeft" title="Go to templates list"><span class="badge_style b_done">Back</span></a>
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