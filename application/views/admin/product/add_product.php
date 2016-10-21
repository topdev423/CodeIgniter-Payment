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
		
});
</script>
<script language="javascript">
function viewAttributes(Val){

	if(Val == 'show'){
		document.getElementById('AttributeView').style.display = 'block';
	}else{
		document.getElementById('AttributeView').style.display = 'none';
	}

}
</script>
<script>
$(document).ready(function(){


	var i = 1;
	
	
	$('#add').click(function() { 
//<!--		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field"><div class="image_text" style="float: left;margin: 5px;margin-right:50px;"><span>Attribute:</span><select name="attribute_name[]" style="width:200px;color:gray;width:206px;" class="chzn-select"><?php //foreach ($atrributeValue->result() as $attrRow){ ?><option value="<?php //echo $attrRow->attribute_name;; ?>"><?php //echo $attrRow->attribute_name; ?></option> <?php //} ?></select></div><div class="attribute_box attrInput" style="float: left;margin: 5px;width: 20%;" ><span>Value :</span><input type="text" style="width:100px;"  name="attribute_val[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Weight :</span><input type="text" style="width:100px;" name="attribute_weight[]" ></div><div class="image_price attrInput" style="float: left;margin: 5px;width: 20%;"><span>Price :</span><input type="text" style="width:100px;" name="attribute_price[]" ></div></div>').fadeIn('slow').appendTo('.inputs');-->
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
						<h6>Add New Product</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab link_tab1">Content</a></li>
               					 <li><a href="#tab2" class="link_tab2">Category</a></li>
               					 <li><a href="#tab3" class="link_tab3">Images</a></li>
               					 <li><a href="#tab4" class="link_tab4">List</a></li>
               					 <li><a href="#tab5" class="link_tab5">Atrribute</a></li>
               					 <li><a href="#tab6" class="link_tab6">SEO</a></li>
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addproduct_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/product/insertEditProduct',$attributes) 
					?>
                    
                     <div id="tab1" class="tab_con" data-tab="link_tab1">
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="product_name">Product Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="product_name" id="product_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the product name"/>
							</div>
							</div>
							</li>
						
                        	
	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="description" id="description" tabindex="2" style="width:370px;" class="required large tipTop mceEditor" title="Please enter the product description"></textarea>
								</div>
								</div>
							</li>

	 						<li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Excerpt</label>
								<div class="form_input">
								<textarea name="excerpt" id="excerpt" tabindex="3" style="width:370px;" class="large tipTop" title="Please enter the product Excerpt"></textarea>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_policies">Shipping &amp; Policies<span class="req">*</span></label>
								<div class="form_input">
								<textarea name="shipping_policies" id="shipping_policies" tabindex="2" style="width:370px;" class="large tipTop mceEditor" title="Please enter the product shipping &amp; policies"></textarea>
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="quantity">Quantity<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="quantity" id="quantity" tabindex="4" class="required number large tipTop" title="Please enter the product quantity" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Immediate Shipping</label>
								<div class="form_input">
								<input type="radio" name="ship_immediate" value="true" />Yes&nbsp;&nbsp;&nbsp;
								<input type="radio" name="ship_immediate" value="false" checked="checked" />No
								</div>
								</div>
							</li>
                            
<!--                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="shipping_cost">Shipping cost</label>
								<div class="form_input">
                                <input type="text" name="shipping_cost" id="shipping_cost" tabindex="4" class="large tipTop" title="Please enter the product shipping cost" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="tax_cost">Tax</label>
								<div class="form_input">
                                <input type="text" name="tax_cost" id="tax_cost" tabindex="4" class="large tipTop" title="Please enter the product tax" />
								</div>
								</div>
							</li>
 -->								
							  <li>
								<div class="form_grid_12">
								<label class="field_title" for="sku">SKU</label>
								<div class="form_input">
								<input type="text" name="sku" id="sku" tabindex="7" class="large tipTop" title="Please enter the product sku" />
								</div>
								</div>
							</li>
                            
                              <li>
								<div class="form_grid_12">
								<label class="field_title" for="weight">Weight</label>
								<div class="form_input">
								<input type="text" name="weight" id="weight" tabindex="8" class="large tipTop" title="Please enter the product weight" />
								</div>
								</div>
							</li>
                            
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price" id="price" tabindex="9" class="required number large tipTop" title="Please enter the product price" />
								</div>
								</div>
							</li>
                            
                             <li>
								<div class="form_grid_12">
								<label class="field_title" for="sale_price">Sale Price<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="sale_price" id="sale_price" tabindex="10" class="required number smallerThan large tipTop" data-min="price" title="Please enter the product sale price" />
								</div>
								</div>
							</li>
                            
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="publish_unpublish">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="publish_unpublish_publish" class="publish_unpublish"/>
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
                      <div id="tab2" class="tab_con" data-tab="link_tab2">
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
                      <div id="tab3" class="tab_con" data-tab="link_tab3">
                      <ul>
	                      <li>
								<div class="form_grid_12">
									<label class="field_title" for="product_image">Product Image</label>
									<div class="form_input">
										<input name="product_image[]" id="product_image" type="file" tabindex="7" class="large required multi tipTop" title="Please select product image"/><span class="input_instruction green">You Can Upload Multiple Images</span>
									</div>
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
							        </div>
									
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                       
                      </li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab5" class="tab_con" data-tab="link_tab5">
                      
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
						    </div>
									
						<div class="form_grid_12">
						<div class="form_input" style="margin:0px;width:100%;">
                        <input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
                        <input type="button" class="btn_small btn_blue nxtTab" tabindex="9" value="Next"/>
                        </div>
                        </div>
                       
                      </li>

                      
                      </ul>
                      
                      </div>
                      <div id="tab6" class="tab_con" data-tab="link_tab6">
                      <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Keyword</label>
                    <div class="form_input">
                      <textarea name="meta_keyword" id="meta_keyword"  tabindex="2" class="large tipTop" title="Please enter the page meta keyword"></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
                    </div>
                  </div>
                </li>
              </ul>
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<input type="button" class="btn_small btn_blue prvTab" tabindex="9" value="Prev"/>
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
                      </div>
                      
                    <input type="hidden" name="userID" value="0"/>  
            
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
<style>
.uploader{
	overflow: visible !important;
}
.uploader .error{
	position: absolute;
	width: 200px;
}
</style>	
<script type="text/javascript">
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