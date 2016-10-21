<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Location</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/location/insertEditLocation',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="location_name">Location Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="location_name" style=" width:295px" id="location_name" value="<?php echo $location_details->row()->location_name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the location name"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="iso_code2">ISO Code 2 </label>
									<div class="form_input">
                                    <input name="iso_code2" style=" width:295px" id="iso_code2" value="<?php echo $location_details->row()->iso_code2;?>" type="text" tabindex="1" class="tipTop" title="Please enter the iso_code2"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="iso_code3">ISO Code 3 </label>
									<div class="form_input">
                                    <input name="iso_code3" style=" width:295px" id="iso_code3" value="<?php echo $location_details->row()->iso_code3;?>" type="text" tabindex="1" class=" tipTop" title="Please enter the iso_code3"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_symbol">Currency Symbol<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_symbol" style=" width:295px" id="currency_symbol" type="text" tabindex="1" value="<?php echo $location_details->row()->currency_symbol;?>" class="required tipTop" title="Please enter the currency symbol"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Currency<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="currency_type" style=" width:295px" id="currency_type" type="text" tabindex="1" class="required tipTop" value="<?php echo $location_details->row()->currency_type;?>" title="Please enter the currency symbol"/>
									</div>
								</div>
								</li>
                               <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Default <span class="req">*</span></label>
									<div class="form_input">
									<?php if($location_details->row()->status != 'Active'){?>
										<div class="active_inactive">
                                        
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($location_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
                                            
										</div>
										<?php }else{ ?>
                                        <button type="button" style="background-position: 0 -434px; cursor:default;"  class="btn_small btn_blue" tabindex="4"><span>Active</span></button>
                                         <div class="active_inactive" style="display:none;">
                                        
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($location_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
                                            
										</div>
										<?php } ?>
									</div>
								</div>
								</li>
                               
								<input type="hidden" name="location_id" value="<?php echo $location_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
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
                      <input name="meta_title" id="meta_title" value="<?php echo $location_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword" tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $location_details->row()->meta_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $location_details->row()->meta_description;?></textarea>
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