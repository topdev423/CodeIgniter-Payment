<?php
$this->load->view('admin/templates/header.php');
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#tab2 input[type="checkbox"]').click(function(){
		var cat = $(this).parent().attr('class');
		var curCat = cat;
		var catPos = '';
		var added = '';
		var curPos = curCat.substring(3);
		var newspan = $(this).parent().prev();
		if($(this).is(':checked')){
			while(cat != 'cat1'){
				cat = newspan.attr('class');
				catPos = cat.substring(3);
				if(cat != curCat && catPos<curPos){
					if (jQuery.inArray(catPos, added.replace(/,\s+/g, ',').split(',')) >= 0) {
					    //Found it!
					}else{
						newspan.find('input[type="checkbox"]').attr('checked','checked');
						added += catPos+',';
					}
				}
				newspan = newspan.prev(); 
			}
		}else{
			var newspan = $(this).parent().next();
			if(newspan.get(0)){
				var cat = newspan.attr('class');
				var catPos = cat.substring(3);
			}
			while(newspan.get(0) && cat != curCat && catPos>curPos){
				newspan.find('input[type="checkbox"]').attr('checked',this.checked);	
				newspan = newspan.next(); 	
				cat = newspan.attr('class');
				catPos = cat.substring(3);
			}
		}
	});
	var j = 1;
	$('#addAttr').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span>Attribute Type:</span>&nbsp;'+
					'<select name="product_attribute_type[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
						'<option value="<?php echo $prdattrRow->id; ?>"><?php echo $prdattrRow->attr_name; ?></option>'+
						<?php } ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>Attribute Name :</span>&nbsp;'+
					 '<input type="text" name="product_attribute_name[]" style="width:110px;color:gray;" class="chzn-select" />'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>Attribute Price :</span>&nbsp;'+
					 '<input type="text" name="product_attribute_val[]" style="width:100px;color:gray;" class="chzn-select" />'+
				'</div>'+
				'<div class="btn_30_blue">'+
				'<a href="javascript:void(0)" onclick="removeAttr(this)" id="removeAttr" class="tipTop" title="Remove this attribute">'+
					'<span class="icon cross_co"></span>'+
					'<span class="btn_link">Remove</span>'+
				'</a>'+
			'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputss');
		j++;
	});
	
});
function removeAttr(evt){
	$(evt).parent().parent().remove();
}
function removeAttrDb(pid,evt){
	if(pid != ''){
		$.post(baseURL+'admin/product/remove_attr',{pid:pid});
	}
	$(evt).parent().parent().remove();
}
</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Product</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab link_tab1">Content</a></li>
               					 <li><a href="#tab2" class="link_tab2">Category</a></li>
               					 <li><a href="#tab3" class="link_tab3">Images</a></li>
               					 <li><a href="#tab4" class="link_tab4">Lists</a></li>
               					 <li><a href="#tab5">Attribute</a></li>
               					 <li><a href="#tab6">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/product/insertEditProduct',$attributes) ;
/*						$optionsArr = unserialize($product_details->row()->option);
						if (is_array($optionsArr) && count($optionsArr)>0){
							$options = 'available';
							$attNameArr = $optionsArr['attribute_name'];
							$attValArr = $optionsArr['attribute_val'];
							$attWeightArr = $optionsArr['attribute_weight'];
							$attPriceArr = $optionsArr['attribute_price'];
						}else {
*/							$options = '';
//						}
						$list_names = $product_details->row()->list_name;
						$list_names_arr = explode(',', $list_names);
						$list_values = $product_details->row()->list_value;
						$list_values_arr = explode(',', $list_values);
//						$listsArr = array_combine($list_names_arr,$list_values_arr);
//						echo "<pre>";print_r($list_names_arr);print_r($list_values_arr);print_r($listsArr);die;
						$imgArr = explode(',', $product_details->row()->image);
					?>
                    
                     <div id="tab1" class="tab_con" data-tab="link_tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Product Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="product_name" id="product_name" value="<?php echo $product_details->row()->product_name;?>" type="text" tabindex="1" class="required large tipTop" title="Please enter the product name"/>
							</div>
							</div>
							</li>
						
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="description" id="description" tabindex="2" style="width:370px;" class="required large tipTop mceEditor" title="Please enter the product description"><?php echo $product_details->row()->description;?></textarea>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Excerpt</label>
								<div class="form_input">
								<textarea name="excerpt" id="excerpt" tabindex="3" style="width:370px;" class="large tipTop" title="Please enter the product Excerpt"><?php echo $product_details->row()->excerpt;?></textarea>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_policies">Shipping &amp; Policies<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="shipping_policies" id="shipping_policies" tabindex="2" style="width:370px;" class="large tipTop mceEditor" title="Please enter the product shipping &amp; policies"><?php echo $product_details->row()->shipping_policies;?></textarea>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Quantity<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="quantity" id="quantity" value="<?php echo $product_details->row()->quantity;?>" tabindex="4" class="required number large tipTop" title="Please enter the product quantity" />
								</div>
								</div>
							</li>
							
							<li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Immediate Shipping</label>
								<div class="form_input">
								<input type="radio" name="ship_immediate" value="true" <?php if ($product_details->row()->ship_immediate == 'true'){?> checked="checked"<?php }?> />Yes&nbsp;&nbsp;&nbsp;
								<input type="radio" name="ship_immediate" value="false" <?php if ($product_details->row()->ship_immediate == 'false'){?> checked="checked"<?php }?> />No
								</div>
								</div>
							</li>
<!--                             
							 <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Shipping cost</label>
								<div class="form_input">
                                <input type="text" name="shipping_cost" id="shipping_cost" value="<?php echo $product_details->row()->shipping_cost;?>" tabindex="4" class="large tipTop" title="Please enter the product shipping cost" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="tax_cost">Tax</label>
								<div class="form_input">
                                <input type="text" name="tax_cost" id="tax_cost"  value="<?php echo $product_details->row()->tax_cost;?>" tabindex="4" class="large tipTop" title="Please enter the product tax" />
								</div>
								</div>
							</li>
 -->								
							  <li>
								<div class="form_grid_12">
								<label class="field_title" for="sku">SKU</label>
								<div class="form_input">
								<input type="text" name="sku" id="sku" tabindex="7" value="<?php echo $product_details->row()->sku;?>" class="large tipTop" title="Please enter the product sku" />
								</div>
								</div>
							</li>
                            
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="weight">Weight</label>
								<div class="form_input">
								<input type="text" name="weight" id="weight" tabindex="8" value="<?php echo $product_details->row()->weight;?>" class="large tipTop" title="Please enter the product weight" />
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price" id="price" tabindex="9" value="<?php echo $product_details->row()->price;?>" class="required number large tipTop" title="Please enter the product price" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Sale Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="sale_price" id="sale_price" tabindex="10" value="<?php echo $product_details->row()->sale_price;?>" class="required number smallerThan large tipTop" data-min="price" title="Please enter the product sale price" />
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
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
                     </div>
                      <div id="tab2" class="tab_con" data-tab="link_tab2">
	                      <div class="cateogryView">
						<?php  echo $categoryView; ?>
						</div>
                        <button type="submit" style="margin: 20px 5px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                      </div>
                      <div id="tab3" class="tab_con" data-tab="link_tab3">
                      <ul>
	                      <li>
								<div class="form_grid_12">
									<label class="field_title" for="product_image">Product Image</label>
									<div class="form_input">
										<input name="product_image[]" id="product_image" type="file" tabindex="7" class="large multi tipTop" title="Please select product image"/><span class="input_instruction green">You Can Upload Multiple Images</span>
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
									<img src="<?php echo base_url();?>images/product/<?php echo $img; ?>"  height="80px" width="80px" />
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
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
									</div>
								</div>
								</li>     
                      </ul>          
                      </div>
                      <div id="tab4" class="tab_con" data-tab="link_tab4">
                      
                      <ul id="AttributeView">
                      
                     <li>
									<div class="inputs" style="float: left;width:100%; border:1px dashed #1DB3F0;">
							            <div style="margin:12px;">
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="add" class="tipTop" title="Add new attribute">
													<span class="icon add_co"></span>
													<span class="btn_link">Add</span>
												</a>
											</div>
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="remove" class="tipTop" title="Remove last attribute">
													<span class="icon cross_co"></span>
													<span class="btn_link">Remove</span>
												</a>
											</div>
							            </div>
							            <?php 
//							            if ($options != '' && is_array($attNameArr) && count($attNameArr)>0){
//							            	for ($i=0;$i<count($attNameArr);$i++){
										if (count($list_names_arr)>0){
											foreach ($list_names_arr as $list_names_key=>$list_names_val){
							            ?>
							            <div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">
							            	<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">
							            		<span>List Name:</span>
							            		<select name="attribute_name[]" onchange="javascript:changeListValues(this,'<?php echo $list_values_arr[$list_names_key];?>')" style="width:200px;color:gray;width:206px;" class="">
							            			<?php foreach ($atrributeValue->result() as $attrRow){ 
							            			if (strtolower($attrRow->attribute_name) != 'price'){
							            			?>
								            		<option <?php if ($list_names_val == $attrRow->id){echo 'selected="selected"';}?> value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>
								            		<?php }} ?>
							            		</select>
							            	</div>
							            	<div class="attribute_box attrInput" style="float: left;margin: 5px;" >
												 <span>List Value :</span>&nbsp;
												 <select name="attribute_val[]" style="width:200px;color:gray;width:206px;">
												 </select>
											</div>
											
							            </div>
							            <?php 
							            	}
							            }
							            ?>
							        </div>
							        
									<button type="submit" style="margin-top: 20px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
                      </li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab5">
                      
                      <ul id="AttributeView">
                      
                     <li>
									<div class="inputss" style="float: left;width:100%; border:1px dashed #1DB3F0;">
							            <div style="margin:12px;">
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="addAttr" class="tipTop" title="Add new attribute">
													<span class="icon add_co"></span>
													<span class="btn_link">Add</span>
												</a>
											</div>
								            
							            </div>
	<?php  //onchange="javascript:changeListValues123(this,'<?php echo $SubPrdValS['attr_price'];');"
	if (count($SubPrdVal)>0){
	
			foreach ($SubPrdVal->result_array() as $SubPrdValS){ ?>
		<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field1">
			<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">
				<span>Attribute Type:</span>
				<select name="attr_type1[]" style="width:200px;color:gray;" onchange="javascript:ajaxEditproductAttribute(this.value,'<?php echo $SubPrdValS['attr_name']; ?>','<?php echo $SubPrdValS['attr_price']; ?>','<?php echo $SubPrdValS['pid']; ?>');" >
				<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
				<option value="<?php echo $prdattrRow->id; ?>" <?php if( $prdattrRow->id == $SubPrdValS['attr_id'] ){ echo 'selected="selected"';}?> ><?php echo $prdattrRow->attr_name; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="attribute_box attrInput" style="float: left;margin: 5px;" >
				<span>Attribute Name :</span>&nbsp;
				<input type="text" name="attr_name1[]" style="width:110px;color:gray;" value="<?php echo $SubPrdValS['attr_name']; ?>" onchange="javascript:ajaxEditproductAttribute('<?php echo $SubPrdValS['attr_id']; ?>',this.value,'<?php echo $SubPrdValS['attr_price']; ?>','<?php echo $SubPrdValS['pid']; ?>');" />
			</div>
			<div class="attribute_box attrInput" style="float: left;margin: 5px;" >
				<span>Attribute Price :</span>&nbsp;
				<input type="text" name="attr_val1[]" style="width:100px;color:gray;" value="<?php echo $SubPrdValS['attr_price']; ?>" onchange="javascript:ajaxEditproductAttribute('<?php echo $SubPrdValS['attr_id']; ?>','<?php echo $SubPrdValS['attr_name']; ?>',this.value,'<?php echo $SubPrdValS['pid']; ?>');" />
			</div>
            <div id="loadingImg_<?php echo $SubPrdValS['pid']; ?>"></div>
            <div class="btn_30_blue">
				<a href="javascript:void(0)" onclick="removeAttrDb('<?php echo $SubPrdValS['pid']; ?>',this)" id="removeAttr" class="tipTop" title="Remove this attribute">
					<span class="icon cross_co"></span>
					<span class="btn_link">Remove</span>
				</a>
			</div>
		</div>
	<?php } } ?>
		</div>
		<button type="submit" style="margin-top: 20px;" class="btn_small btn_blue" tabindex="9"><span>Update</span></button>
	</li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab6" class="tab_con" data-tab="link_tab5">
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
<script>
$(document).ready(function(){


	var i = 1;
	
	
	$('#add').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span>List Name:</span>&nbsp;'+
					'<select name="attribute_name[]" onchange="javascript:loadListValues(this)" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($atrributeValue->result() as $attrRow){ 
							if (strtolower($attrRow->attribute_name) != 'price'){
						?>
						'<option value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>'+
						<?php }} ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>List Value :</span>&nbsp;'+
					 '<select name="attribute_val[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
					 '<option value="">--Select--</option>'+
					 '</select>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputs');
		i++;
	});
	
	$('#remove').click(function() {
		$('.field:last').remove();
	});
	
	$('#reset').click(function() {
		$('.field').remove();
		$('#add').show();
		i=0;
	
	
	});
	
	
});
$.validator.addMethod("smallerThan", function (value, element, param) {
    var $element = $(element)
        , $min;

    if (typeof(param) === "string") {
        $min = $(param);
    } else {
        $min = $("#" + $element.data("min"));
    }

    if (this.settings.onfocusout) {
        $min.off(".validate-smallerThan").on("blur.validate-smallerThan", function () {
            $element.valid();
        });
    }
    return parseFloat(value) <= parseFloat($min.val());
}, "Sale price must be smaller than price");
$.validator.addClassRules({
	smallerThan: {
    	smallerThan: true
    }
});
$('#addproduct_form').validate({
	ignore : '',
	errorPlacement: function(error, element) {
	    error.appendTo( element.parent());
	    $('.tab_con').hide();
	    $('#widget_tab ul li a').removeClass('active_tab');
	    var $link_tab = $('label.error:first').parents('.tab_con').show().data('tab');
	    $('.'+$link_tab).addClass('active_tab');
	}
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>