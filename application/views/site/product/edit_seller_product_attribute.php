<?php
$this->load->view('site/templates/header');
?>
 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css"/> 
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
.image_text select, .attribute_box  select{
	border: 1px solid gray;
}
.notetouser{
	float: left;
	width: 98%;
	padding: 1%;
	line-height: 2;
	font-family: verdana;
	font-size: 16px;
	color: #1DB3F0;
	text-align: center;
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
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/attribute" id="sellerProdEdit1">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li class="active"><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <input type="hidden" name="nextMode" id="nextMode" value="attribute"/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                            <p class="notetouser"><?php if($this->lang->line('product_add_Attr_rem') != '') { echo stripslashes($this->lang->line('product_add_Attr_rem')); } else echo "You can add product attributes here."; ?></p>
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <div class="inputs" style="float: left;width:100%; border:1px dashed #1DB3F0;">
							            <div style="margin:12px;">
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="addAttr" class="tipTop" title="<?php if($this->lang->line('add_attr') != '') { echo stripslashes($this->lang->line('add_attr')); } else echo "Add attribute"; ?>">
													<span class="btn_link"><?php if($this->lang->line('header_add') != '') { echo stripslashes($this->lang->line('header_add')); } else echo "Add"; ?></span>
												</a>
											</div>
							            </div>
                                        
                                        
                                        
                                        
 <?php  //onchange="javascript:changeListValues123(this,'<?php echo $SubPrdValS['attr_price'];');"
	if (count($SubPrdVal)>0){
			foreach ($SubPrdVal->result_array() as $SubPrdValS){ ?>
		<div style="float: left; margin: 12px 10px 10px; width:97%;" class="field">
			<div class="image_text" style="float: left;margin: 5px;margin-right:30px;">
				<span><?php if($this->lang->line('attribute_type') != '') { echo stripslashes($this->lang->line('attribute_type')); } else echo "Attribute Type"; ?>:</span>
				<select name="attr_type1[]" style="width:120px;color:gray;" onchange="javascript:ajaxChangeproductAttribute(this.value,'<?php echo $SubPrdValS['attr_name']; ?>','<?php echo $SubPrdValS['attr_price']; ?>','<?php echo $SubPrdValS['pid']; ?>');" >
				<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
				<option value="<?php echo $prdattrRow->id; ?>" <?php if( $prdattrRow->id == $SubPrdValS['attr_id'] ){ echo 'selected="selected"';}?> ><?php echo $prdattrRow->attr_name; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="attribute_box attrInput" style="float: left;margin: 5px;margin-right:30px;" >
				<span><?php if($this->lang->line('attribute_name') != '') { echo stripslashes($this->lang->line('attribute_name')); } else echo "Attribute Name"; ?>:</span>&nbsp;<input type="text" name="attr_name1[]" style="width:150px;color:gray;" value="<?php echo $SubPrdValS['attr_name']; ?>" onchange="javascript:ajaxChangeproductAttribute('<?php echo $SubPrdValS['attr_id']; ?>',this.value,'<?php echo $SubPrdValS['attr_price']; ?>','<?php echo $SubPrdValS['pid']; ?>');" />
			</div>
			<div class="attribute_box attrInput" style="float: left;margin: 5px;" >
				<span><?php if($this->lang->line('attribute_price') != '') { echo stripslashes($this->lang->line('attribute_price')); } else echo "Attribute Price"; ?>:</span>&nbsp;
				<input type="text" name="attr_val1[]" style="width:75px;color:gray;" value="<?php echo $SubPrdValS['attr_price']; ?>" onchange="javascript:ajaxChangeproductAttribute('<?php echo $SubPrdValS['attr_id']; ?>','<?php echo $SubPrdValS['attr_name']; ?>',this.value,'<?php echo $SubPrdValS['pid']; ?>');" />
			</div>
            <div id="loadingImg_<?php echo $SubPrdValS['pid']; ?>"></div>
            <div class="btn_30_blue">
				<a href="javascript:void(0)" onclick="removeAttrDb('<?php echo $SubPrdValS['pid']; ?>',this);" class="removeAttr" class="tipTop" title="<?php if($this->lang->line('remove_this_attr') != '') { echo stripslashes($this->lang->line('remove_this_attr')); } else echo "Remove this attribute"; ?>">
					<span class="btn_link"><?php if($this->lang->line('product_remove') != '') { echo stripslashes($this->lang->line('product_remove')); } else echo "Remove"; ?></span>
				</a>
			</div>
		</div>
	<?php } } ?>
                         
                         
                                        
                                        
							        </div>
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
$(document).ready(function(){

	var j = 1;
	$('#addAttr').click(function() {
		$('<div style="float: left; margin: 12px 10px 10px; width:97%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:30px;">'+
					'<span>Attribute Type:</span>&nbsp;'+
					'<select name="product_attribute_type[]" style="width:120px;color:gray;" class="chzn-select">'+
						'<option value="">--Select--</option>'+
						<?php foreach ($PrdattrVal->result() as $prdattrRow){ ?>
						'<option value="<?php echo $prdattrRow->id; ?>"><?php echo $prdattrRow->attr_name; ?></option>'+
						<?php } ?>
					 '</select>'+
				'</div>'+
				'<div class="image_text attrInput" style="float: left;margin: 5px;margin-right:30px;">'+
					'<span>Attribute Name:</span>&nbsp;'+
					'<input type="text" name="product_attribute_name[]" style="width:150px;color:gray;" class="chzn-select"/>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span>Attribute Price :</span>&nbsp;'+
					 '<input type="text" name="product_attribute_val[]" style="width:75px;color:gray;" class="chzn-select" />'+
				'</div>'+
				'<div class="btn_30_blue">'+
					'<a href="javascript:void(0)" onclick="removeAttr(this);" class="removeAttr" class="tipTop" title="Remove this attribute">'+
						'<span class="btn_link"><?php if($this->lang->line("product_remove") != "") { echo stripslashes($this->lang->line("product_remove")); } else echo "Remove"; ?></span>'+
					'</a>'+
				'</div>'+
		'</div>').fadeIn('slow').appendTo('.inputs');
		j++;
	});
	
});
function removeAttr(evt){
	$(evt).parent().parent().remove();
}
function removeAttrDb(pid,evt){
	if(pid != ''){
		$.post(baseURL+'site/product/remove_attr',{pid:pid});
	}
	$(evt).parent().parent().remove();
}
</script>
<?php
$this->load->view('site/templates/footer');
?>