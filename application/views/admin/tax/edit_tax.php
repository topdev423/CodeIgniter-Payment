<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit State Tax</h6>
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
						echo form_open('admin/tax/insertEditTax',$attributes) 
					?> 		
                    	<div id="tab1">
	 						<ul>
                            	<li>
                                  <div class="form_grid_12">
                                    <label class="field_title" for="country_id">Country Name <span class="req">*</span></label>
                                    <div class="form_input">
                                      <select class="chzn-select required" name="country_id" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Please select the country name">
                                            
                                            <?php foreach ($countryDisplay as $countryrow){
											
											
											?>
                                            <option value="<?php echo $countryrow['id'];?>" <?php if($tax_details->row()->country_id==$countryrow['id']){echo 'selected=""';} ?> ><?php echo $countryrow['location_name'];?></option>
                                            <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                </li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_name">State Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_name" style=" width:295px" id="state_name" value="<?php echo $tax_details->row()->state_name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the state name"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="state_code">State Code<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_code" style=" width:295px" id="state_code" value="<?php echo $tax_details->row()->state_code;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the state code"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="state_tax">State Tax (%)<span class="req">*</span></label>
									<div class="form_input">
                                    <input name="state_tax" style=" width:295px" id="state_tax" value="<?php echo $tax_details->row()->state_tax;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the state tax"/>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="7" name="status" id="active_inactive_active" class="active_inactive" <?php if ($tax_details->row()->status == 'Active'){echo 'checked="checked"';}?>  />
										</div>
									</div>
								</div>
								</li>
								<input type="hidden" name="tax_id" value="<?php echo $tax_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
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
                      <input name="meta_title" id="meta_title" value="<?php echo $tax_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword" tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $tax_details->row()->meta_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $tax_details->row()->meta_description;?></textarea>
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