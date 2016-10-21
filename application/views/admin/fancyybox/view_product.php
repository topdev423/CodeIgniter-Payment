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
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form');
						echo form_open('admin',$attributes) ;
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    
                     <div id="tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Name </label>
							<div class="form_input">
								<?php 
								if ($product_details->row()->name != ''){
									echo $product_details->row()->name;
								}else {
									echo 'Not available';
								}
								?>
							</div>
							</div>
							</li>
						
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->description != ''){
									echo $product_details->row()->description;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Excerpt</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->excerpt != ''){
									echo $product_details->row()->excerpt;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Shipping Cost</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->shipping_cost != ''){
									echo $currencySymbol.$product_details->row()->shipping_cost;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price</label>
								<div class="form_input">
								<?php 
								if ($product_details->row()->price != ''){
									echo $product_details->row()->price;
								}else {
									echo 'Not available';
								}
								?>
								</div>
								</div>
							</li>
                            
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Total Subscribed</label>
								<div class="form_input">
								<?php 
									echo $product_details->row()->purchased;
								?>
								</div>
								</div>
							</li>
                            
                            
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
									<div class="form_input">
										<?php 
										if ($product_details->row()->status != ''){
											echo $product_details->row()->status;
										}else {
											echo 'Not available';
										}
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/fancyybox/display_fancyybox" class="tipLeft" title="Go to subscription box list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      <div id="tab2">
	                      <ul id="AttributeView">
                      
                     <li>
							            <div style="margin:12px;">
								<?php 
								if ($catList->num_rows()>0){
									foreach ($catList->result() as $catRow){
										echo '- '.$catRow->cat_name.'<p></p>';
									}
								}else {
									echo 'Not available';
								}
								?>
						</div>
						</li>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/fancyybox/display_fancyybox" class="tipLeft" title="Go to subscription box list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                      <div id="tab3">
									<ul>
										<?php 
										if (count($imgArr)>0){
											foreach ($imgArr as $img){
												if ($img != ''){
										?>
										<li style="float: left;">
										<div class="widget_thumb" style="margin-left: 2%;width:100px;height:100px;">
										 	<img width="100px" height="100px" src="<?php echo base_url();?>images/fancyybox/<?php echo $img;?>" />
										</div>
										</li>
										<?php 
												}
											}
										}else {
										?>
										<li>
										<div class="widget_thumb" style="margin-left: 25%;">
										 	<img width="40px" height="40px" src="<?php echo base_url();?>images/product/dummyProductImage.jpg" />
										</div>
										</li>
										<?php }?>
										</ul>
								<ul>
                           <li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/fancyybox/display_fancyybox" class="tipLeft" title="Go to subscription box list"><span class="badge_style b_done">Back</span></a>
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
                      <?php 
								if ($product_details->row()->meta_title != ''){
									echo $product_details->row()->meta_title;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_keyword != ''){
									echo $product_details->row()->meta_keyword;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <?php 
								if ($product_details->row()->meta_description != ''){
									echo $product_details->row()->meta_description;
								}else {
									echo 'Not available';
								}
								?>
                    </div>
                  </div>
                </li>
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<a href="admin/fancyybox/display_fancyybox" class="tipLeft" title="Go to subscription box list"><span class="badge_style b_done">Back</span></a>
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