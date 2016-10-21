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
									<label class="field_title">Category Name</label>
									<div class="form_input">
										<?php echo $category_details->row()->cat_name;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Category Image</label>
									<div class="form_input">
										<?php if($category_details->row()->image !=''){?>
                                        <img src="<?php echo CATEGORY_PATH.$category_details->row()->image;?>" alt="<?php echo $category_details->row()->cat_name;?>" width="100" />
                                        <?php } ?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Meta Title</label>
									<div class="form_input">
										<?php echo $category_details->row()->seo_title;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Meta Keyword</label>
									<div class="form_input">
										<?php echo $category_details->row()->seo_keyword;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Meta Description</label>
									<div class="form_input">
										<?php echo $category_details->row()->seo_description;?>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Status</label>
									<div class="form_input">
										<?php echo $category_details->row()->status;?>
									</div>
								</div>
								</li>
                                
								<li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/category/display_category_list" class="tipLeft" title="Go to Category list"><span class="badge_style b_done">Back</span></a>
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