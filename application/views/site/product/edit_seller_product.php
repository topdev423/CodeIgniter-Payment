<?php
$this->load->view('site/templates/header');
?>
<style type="text/css" media="screen">


#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;

}
form label.error{
	color:red;
}
.button{
	width: 95px;
	overflow: visible;
	margin: 0;
	padding: 8px 8px 10px 7px;
	border: 0;
	border-radius: 4px;
	font-weight: bold;
	font-size: 15px;
	line-height: 22px;
	text-align: center;
	color: #fff;
	background: #588cc7;
}
.button:hover{
	background: #3e73b7;
}
</style>
<div class="lang-en wider no-subnav thing signed-out winOS">


 <!-- Section_start -->
  <div id="container-wrapper">
	<div class="container ">
	<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
		<div class="wrapper-content">					
            <div class="profile-list">            
                
                <div class="page-header padding_all15 margin_all0">
                            <h2> <?php if($this->lang->line('product_edit') != '') { echo stripslashes($this->lang->line('product_edit')); } else echo "Edit Product"; ?></h2>
             	
 <h2 style="text-align:left;" class="border_bottom padding_bottom15">	</h2>		 
            </div>
                <div class="box-content">
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/1" onsubmit="return validate_desc();" id="sellerProdEdit1">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li class="active"><a data-toggle="tab" <?php if ($editmode != '0'){?>href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"<?php }?>><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li class=""><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('categories')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"<?php }?>><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('list')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"<?php }?>><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('images')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"<?php }?>><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('attribute')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"<?php }?>><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li><a data-toggle="tab" <?php if ($editmode == '0'){?>onclick="return saveDetails('seo')"<?php }else {?> href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"<?php }?>><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <script>
                                function saveDetails(mode){
                                    $('#nextMode').val(mode);
									$('#editDetailsSub').trigger('click');
                                }
                                </script>
                                <input type="hidden" name="nextMode" id="nextMode" value=""/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required" placeholder="<?php if($this->lang->line('header_name') != '') { echo stripslashes($this->lang->line('header_name')); } else echo "Name"; ?>" value="<?php echo $productDetails->row()->product_name;?>" name="product_name">                                        </div>
                                    </div>
                                    <div class="form_fields">
                                            <label><?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?><span style="color:red;"> *</span></label>
                                            <div style="height:128px;position: relative;" class="form_fieldsgroup validation-input desc_con">
                                            <textarea class="global-input required mceEditor" placeholder="<?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?>" id="description" rows="10" cols="40" name="description"><?php if ($productDetails->row()->description == ''){echo $productDetails->row()->excerpt;}else {echo $productDetails->row()->description;}?></textarea>                                            
                                            <label for="description" generated="true" style="display: none;" class="desc_error">This field is required</label>
                                        	</div>
                                        </div>
                                        
                                        <div class="form_fields">
                                            <label><?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('shipping_policies')); } else echo "Shipping & policies"; ?><span style="color:red;"> </span></label>
                                            <div style="height:128px;" class="form_fieldsgroup validation-input">
                                            <textarea class="global-input mceEditor" placeholder="<?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Shipping & policies"; ?>" id="shipping_policies" rows="10" cols="40" name="shipping_policies"><?php if ($productDetails->row()->shipping_policies == ''){echo $productDetails->row()->shipping_policies;}else {echo $productDetails->row()->shipping_policies;}?></textarea>                                            </div>
                                        </div>
                                        
										
                                    <div class="form_fields">
                                            <label><?php if($this->lang->line('product_excerpt') != '') { echo stripslashes($this->lang->line('product_excerpt')); } else echo "Excerpt"; ?></label>
                                            <div class="form_fieldsgroup">
                                            <textarea class="global-input" placeholder="<?php if($this->lang->line('product_excerpt') != '') { echo stripslashes($this->lang->line('product_excerpt')); } else echo "Excerpt"; ?>" rows="5" cols="40" name="excerpt"><?php echo $productDetails->row()->excerpt;?></textarea>                                            </div>
                                        </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_quantity') != '') { echo stripslashes($this->lang->line('product_quantity')); } else echo "Quantity"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number" placeholder="<?php if($this->lang->line('product_quantity') != '') { echo stripslashes($this->lang->line('product_quantity')); } else echo "Quantity"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->quantity;}?>" name="quantity">                                        </div>
                                    </div>
                                     
                                     <div class="form_fields">
                                        <label><?php if($this->lang->line('product_ship_imd') != '') { echo stripslashes($this->lang->line('product_ship_imd')); } else echo "Shipping Immediately"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                        	<input type="radio" name="ship_immediate" <?php if ($editmode == '1'){if($productDetails->row()->ship_immediate == 'true'){echo 'checked="checked"';}}?> value="true"/><?php if($this->lang->line('prference_yes') != '') { echo stripslashes($this->lang->line('prference_yes')); } else echo "Yes"; ?>&nbsp;&nbsp;&nbsp;
                                        	<input type="radio" name="ship_immediate" <?php if ($editmode == '1'){if($productDetails->row()->ship_immediate == 'false'){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> value="false"/><?php if($this->lang->line('prference_no') != '') { echo stripslashes($this->lang->line('prference_no')); } else echo "No"; ?>&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                     
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_sku') != '') { echo stripslashes($this->lang->line('product_sku')); } else echo "SKU"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input " placeholder="<?php if($this->lang->line('product_sku') != '') { echo stripslashes($this->lang->line('product_sku')); } else echo "SKU"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->sku;}?>" name="sku">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_weight') != '') { echo stripslashes($this->lang->line('product_weight')); } else echo "Weight"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input " placeholder="<?php if($this->lang->line('product_weight') != '') { echo stripslashes($this->lang->line('product_weight')); } else echo "Weight"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->weight;}?>" name="weight">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number minStrict" placeholder="<?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->price;}?>" name="price" id="price">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_sale_price') != '') { echo stripslashes($this->lang->line('product_sale_price')); } else echo "Sale Price"; ?><span style="color:red;"> *</span></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input required number minStrict smallerThan" data-min="price" placeholder="<?php if($this->lang->line('product_sale_price') != '') { echo stripslashes($this->lang->line('product_sale_price')); } else echo "Sale Price"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->sale_price;}?>" name="sale_price" id="sale_price">                                        </div>
                                    </div>
                                    <input type="hidden" name="PID" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
                                    <div class="form_fields">
                                            <label></label>
                                            <div class="form_fieldsgroup">
                                            <input type="submit" id="editDetailsSub" value="<?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?>" class="button"/>
                                                                                  </div>
                                        </div>
                                    
                                                                        
                                </div>
                                
                                
                            </div>
                        </div>
                    </section>
                        
                    </form>
                </div>
            </div>
        		
    
</div>
		
		<!-- / wrapper-content -->

		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a id="scroll-to-top" href="#header" style="display: none;"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<!-- / container -->
</div>
</div>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>
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
$.validator.addMethod('minStrict', function (value, el, param) {
    return value > param;
},"Price must be greater than zero");
$.validator.addClassRules({
	minStrict: {
		minStrict: true,
		minStrict: 0
    }
});
$("#sellerProdEdit1").validate();
function validate_desc(){
	if(tinyMCE.get('description').getContent() == ''){
		$('.desc_con .desc_error').show().focus();
		return false;
	}else{
		$('.desc_con .desc_error').hide();
		return true;
	}
}	
</script>
<style>
.desc_con .desc_error{
	position: absolute;
	right: 0px;
	text-align: right;
	color:red;
	top:0px;
}
</style>
<?php
$this->load->view('site/templates/footer');
?>