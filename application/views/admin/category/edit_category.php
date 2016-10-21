<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Category</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editcategory_form',  'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/category/EditCategory',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="category_name" id="category_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the categoryname" value="<?php echo $category_details->row()->cat_name;?>"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">Category Image </label>
									<div class="form_input">
										<input name="category_image" id="category_image" type="file" tabindex="2" class="large tipTop" title="Please upload category image"/>
									</div>
								</div>
								</li>
                                
                                	<?php if($category_details->row()->image !=''){?>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="category_name">&nbsp; </label>
									<div class="form_input">
                                    	<img src="<?php echo CATEGORY_PATH.$category_details->row()->image;?>" alt="<?php echo $category_details->row()->cat_name;?>" width="100" />

									</div>
								</div>
								</li>
                                
                                <?php }?>
								
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($category_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
	                                    <input type="hidden" name="category_id" value="<?php echo $category_details->row()->id;?>"/>
    									<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
                       </div>
                    <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title" value="<?php echo $category_details->row()->seo_title;?>"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $category_details->row()->seo_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $category_details->row()->seo_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
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