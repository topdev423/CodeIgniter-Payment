<?php
$this->load->view('admin/templates/header.php');
?>
<script language="javascript">
function coupon_proudct(val){
	if(val=='category'){
		document.getElementById('shipping').style.display = 'block';
		document.getElementById('category').style.display = 'block';
		document.getElementById('product').style.display = 'none';
	}else if(val=='product'){
		document.getElementById('shipping').style.display = 'block';
		document.getElementById('category').style.display = 'none';
		document.getElementById('product').style.display = 'block';
	}else if(val=='shipping'){
		document.getElementById('shipping').style.display = 'none';
		document.getElementById('category').style.display = 'none';
		document.getElementById('product').style.display = 'none';
	}else{
		document.getElementById('shipping').style.display = 'block';
		document.getElementById('category').style.display = 'none';
		document.getElementById('product').style.display = 'none';
	}	
}

</script>
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
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form');
						echo form_open('admin/couponcards/insertEditCouponcard',$attributes) 
					?>
	 				<ul>
                      	<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Coupon code <span class="req">*</span></label>
									<div class="form_input">
										<input name="code" id="code" type="text" tabindex="2" class="required small tipTop" title="Please Enter the Coupon Code" value="<?php echo $couponcard_details->row()->code;?>"/>
									</div>
								</div>
								</li>
                      	<li>
								<div class="form_grid_12">
									<label class="field_title" for="group">Max No. of Coupons <span class="req">*</span></label>
									<div class="form_input">
										<input name="quantity" id="quantity" type="text" tabindex="3" class="required small tipTop" title="Please enter the quantity" value="<?php echo $couponcard_details->row()->quantity;?>"/>
									</div>
								</div>
								</li>
						<li>
								<div class="form_grid_12">
									<label class="field_title" for="datefrom">Coupon Valid From<span class="req">*</span></label>
									<div class="form_input">
										<input name="datefrom" id="datefrom" type="text" tabindex="5" class="required small tipTop datepicker" title="Please select the date" value="<?php echo $couponcard_details->row()->datefrom;?>" />
									</div>
								</div>
								</li>
						<li>
								<div class="form_grid_12">
									<label class="field_title" for="dateto">Coupon Valid Till<span class="req">*</span></label>
									<div class="form_input">
										<input name="dateto" id="dateto" type="text" tabindex="6" class="required small tipTop datepicker" title="Please select the date" value="<?php echo $couponcard_details->row()->dateto;?>" />
									</div>
								</div>
								</li>        
                            	<li>
								<div class="form_grid_12">
                                    <label class="field_title">Select a Coupon Type <span class="label_intro">Select this field, coupon applied for category or product or shipping.  Otherwise Coupon Apply for Cart</span></label>
									<div class="form_input">
					<select data-placeholder="Select a Coupon Type" name="coupon_type" style=" width:300px" class="chzn-select-deselect" tabindex="13" onchange="coupon_proudct(this.value);">
						<option value="">None</option>
						<option value="category" <?php if($couponcard_details->row()->coupon_type == 'category'){ echo 'selected="selected"';}?>>Coupon used for Category</option>
						<option value="product" <?php if($couponcard_details->row()->coupon_type == 'product'){ echo 'selected="selected"';}?>>Coupon user for Product</option>
						<option value="shipping" <?php if($couponcard_details->row()->coupon_type == 'shipping'){ echo 'selected="selected"';}?>>Free Shipping</option>
                   	</select>
									</div>
								</div>
								</li>
                        	</ul>
                            
					<ul id="shipping" style="display:block;">
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Discount Type <span class="req">*</span></label>
									<div class="form_input">
										<div class="flat_percentage">
											<input type="checkbox" tabindex="1" name="price_type" class="Flat_Percentage" <?php if ($couponcard_details->row()->price_type == '1'){echo 'checked="checked"';}?>/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Price Value <span class="req">*</span></label>
									<div class="form_input">
										<input name="price_value" id="price_value" type="text" tabindex="2" class="required small tipTop" title="Please enter the price value" value="<?php echo $couponcard_details->row()->price_value;?>"/>
									</div>
								</div>
								</li>
                                </ul>
                                
                    <ul id="category" style="display:none;">
	 							
									
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Select Category<span class="req">*</span><span class="label_intro">Select Multiple Category</span></label>
									<div class="form_input">
	                                    <div class="dashboard_box_large1 dashboard_focus">
		                                   <?php echo $CateogyView; ?>
										</div>									
									</div>
								</div>
								</li>
                                </ul>
                                
                    <ul id="product" style="display:none;">
	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Select Product<span class="req">*</span><span class="label_intro">Select Multiple Product</span></label>
									  <div class="dashboard_box_large1 dashboard_focus">
		                                   <?php echo $ProductView; ?>
										</div>
								</div>
								</li>
                                </ul>
                                
                    <ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Description <span class="req">*</span></label>
									<div class="form_input">
										<textarea name="description" id="description" rows="5" cols="5" class="required small tipTop" tabindex="4"  title="Please enter the description"><?php echo $couponcard_details->row()->description;?></textarea>
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
							<input type="hidden" name="coupon_id" value="<?php echo $couponcard_details->row()->id?>"/>
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