<?php
$this->load->view('admin/templates/header.php');
?>
<script>
$(document).ready(function(){
	$('.nxtTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.next().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().next().find('a').addClass('active_tab');
	});
	$('.prvTab').click(function(){
		var cur = $(this).parent().parent().parent().parent().parent();
		cur.hide();
		cur.prev().show();
		var tab = cur.parent().parent().prev();
		tab.find('a.active_tab').removeClass('active_tab').parent().prev().find('a').addClass('active_tab');
	});
});
</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Content</a></li>
               					 <li><a href="#tab2">Category</a></li>
               					 <li><a href="#tab3">Images</a></li>
               					 <li><a href="#tab4">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/fancyybox/insertEditProduct',$attributes) ;
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    
                     <div id="tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="name">Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="name" id="name" value="<?php echo $product_details->row()->name;?>" type="text" tabindex="1" class="required large tipTop" title="Please enter the subscription box name"/>
							</div>
							</div>
							</li>
						
                        	 
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="description" id="description" tabindex="2" style="width:370px;" class="mceEditor required large tipTop" title="Please enter the subscription box description"><?php echo $product_details->row()->description;?></textarea>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="excerpt">Excerpt</label>
								<div class="form_input">
								<textarea name="excerpt" id="excerpt" tabindex="3" style="width:370px;" class="large tipTop" title="Please enter the Excerpt"><?php echo $product_details->row()->excerpt;?></textarea>
								</div>
								</div>
							</li>
                            
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Shipping Cost</label>
								<div class="form_input">
								<input type="text" name="shipping_cost" id="shipping_cost" value="<?php echo $product_details->row()->shipping_cost;?>" tabindex="4" class="large tipTop" title="Please enter the shipping_cost" />
								</div>
								</div>
							</li>
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="tax">Tax</label>
								<div class="form_input">
                                <input type="text" name="tax" id="tax" value="<?php echo $product_details->row()->tax;?>" tabindex="7" class="large tipTop" title="Please enter the tax" />
								</div>
								</div>
							</li>
								
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price" id="price" tabindex="9" value="<?php echo $product_details->row()->price;?>" class="required large tipTop" title="Please enter the product price" />
								</div>
								</div>
							</li>
                            
                            
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="11" name="status" <?php if ($product_details->row()->status == 'Publish'){ echo 'checked="checked"';}?> id="publish_unpublish_publish" class="publish_unpublish"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      <div id="tab2">
	                      <div class="cateogryView">
						<?php  echo $categoryView; ?>
						</div>
                        <ul style="float:left;"><li style="padding-left:0px;width:100%;">
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                        </li></ul>
                      </div>
                      <div id="tab3">
                      <ul>
	                      <li>
								<div class="form_grid_12">
									<label class="field_title" for="product_image">Subscription Box Image</label>
									<div class="form_input">
										<input name="product_image[]" id="product_image" type="file" tabindex="7" class="large multi tipTop" title="Please select subscription box image"/><span class="input_instruction green">You Can Upload Multiple Images</span>
									</div>
								</div>
								</li>
                           <li>
                           <div class="widget_content">
							<table class="display display_tbl" id="image_tbl">
							<thead>
							<tr>
								<th class="center">
									Sno
								</th>
								<th>
									 Image
								</th>
								<th>
									Position
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php 
							if (count($imgArr)>0){
								$i=0;$j=1;
								$this->session->set_userdata(array('product_image_'.$product_details->row()->id => $product_details->row()->image));
								foreach ($imgArr as $img){
									if ($img != ''){
							?>
							<tr id="img_<?php echo $i ?>">
								<td class="center tr_select ">
									<input type="hidden" name="imaged[]" value="<?php echo $img; ?>"/>
									<?php echo $j;?>
								</td>
								<td class="center">
									<img src="<?php echo base_url();?>images/fancyybox/<?php echo $img; ?>"  height="80px" width="80px" />
								</td>
								<td class="center">
								<span>
									<input type="text" style="width: 15%;" name="changeorder[]" value="<?php echo $i; ?>" size="3" />
								</span>
								</td>
								<td class="center">
									<ul class="action_list" style="background:none;border-top:none;"><li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onclick="editPictureProducts(<?php echo $i; ?>,<?php echo $product_details->row()->id;?>);" title="Delete this image">Remove</a></li></ul>
								</td>
							</tr>
							<?php 
							$j++;
									}
									$i++;
								}
							}
							?>
							</tbody>
							<tfoot>
							<tr>
								<th class="center">
									Sno
								</th>
								<th>
									Image
								</th>
								<th>
									Position
								</th>
								<th>
									 Action
								</th>
							</tr>
							</tfoot>
							</table>
						</div>
						</li>
						<li>
								<div class="form_grid_12">
									<div class="form_input">
										<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
										<input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                      
                      <div id="tab4">
                      <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" value="<?php echo $product_details->row()->meta_title;?>" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"><?php echo $product_details->row()->meta_keyword;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $product_details->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
				</div>
			</div></li></ul>
                      </div>
                      
                    <input type="hidden" name="productID" value="<?php echo $product_details->row()->id;?>"/>  
            
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