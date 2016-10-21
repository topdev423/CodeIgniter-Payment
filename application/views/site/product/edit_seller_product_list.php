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
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/list" id="sellerProdEdit1">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li class="active"><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <script>
                                function saveDetails(mode){
                                    $('#nextMode').val(mode);
									$('#editDetailsSub').trigger('click');
                                }
                                </script>
                                <input type="hidden" name="nextMode" id="nextMode" value="list"/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                            <p class="notetouser"><?php if($this->lang->line('product_add_rem') != '') { echo stripslashes($this->lang->line('product_add_rem')); } else echo "You can add and remove list values here. This product will comes under the added lists"; ?></p>
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <div class="inputs" style="float: left;width:100%; border:1px dashed #1DB3F0;">
							            <div style="margin:12px;">
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="add" class="tipTop" title="Add new attribute">
													<span class="btn_link"><?php if($this->lang->line('header_add') != '') { echo stripslashes($this->lang->line('header_add')); } else echo "Add"; ?></span>
												</a>
											</div>
								            <div class="btn_30_blue">
												<a href="javascript:void(0)" id="remove" class="tipTop" title="Remove last attribute">
													<span class="btn_link"><?php if($this->lang->line('product_remove') != '') { echo stripslashes($this->lang->line('product_remove')); } else echo "Remove"; ?></span>
												</a>
											</div>
							            </div>
							            <?php 
										$list_names = $productDetails->row()->list_name;
										$list_names_arr = explode(',', $list_names);
										$list_values = $productDetails->row()->list_value;
										$list_values_arr = explode(',', $list_values);
										if (count($list_names_arr)>0){
											foreach ($list_names_arr as $list_names_key=>$list_names_val){
							            ?>
							            <div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">
							            	<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">
							            		<span><?php if($this->lang->line('product_list_name') != '') { echo stripslashes($this->lang->line('product_list_name')); } else echo "List Name"; ?>:</span>
							            		<select name="attribute_name[]" onchange="javascript:changeListValuesUser(this,'<?php echo $list_values_arr[$list_names_key];?>')" style="width:200px;color:gray;width:206px;" class="">
													<option value="">--<?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?>--</option>
							            			<?php 
							            			if ($mainColorLists->num_rows()>0){
							            			?>
								            		<option <?php if ($list_names_val == 1){echo 'selected="selected"';}?> value="<?php echo 1; ?>"><?php if($this->lang->line('color') != '') { echo stripslashes($this->lang->line('color')); } else echo "Color"; ?></option>
								            		<?php } ?>
							            		</select>
							            	</div>
							            	<div class="attribute_box attrInput" style="float: left;margin: 5px;" >
												 <span><?php if($this->lang->line('product_list_value') != '') { echo stripslashes($this->lang->line('product_list_value')); } else echo "List Value"; ?> :</span>&nbsp;
												 <select name="attribute_val[]" style="width:200px;color:gray;width:206px;">
												 <?php 
							            			if ($list_values_arr[$list_names_key] == ''){
							            			?>
													<option value="">--<?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?>--</option>
													<?php }?>
												 </select>
											</div>
											<script type="text/javascript">
							            	$('.image_text').find('select').trigger('change');
							            	</script>
							            </div>
							            <?php 
							            	}
							            }
							            ?>
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


	var i = 1;
	
	
	$('#add').click(function() { 
		$('<div style="float: left; margin: 12px 10px 10px; width:85%;" class="field">'+
				'<div class="image_text" style="float: left;margin: 5px;margin-right:50px;">'+
					'<span><?php if($this->lang->line('product_list_name') != '') { echo stripslashes($this->lang->line('product_list_name')); } else echo "List Name"; ?>:</span>&nbsp;'+
					'<select name="attribute_name[]" onchange="javascript:loadListValuesUser(this)" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
						'<option value="">--<?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?>--</option>'+
						<?php foreach ($atrributeValue->result() as $attrRow){ 
							if (strtolower($attrRow->attribute_name) != 'price'){
						?>
						'<option value="<?php echo $attrRow->id; ?>"><?php echo $attrRow->attribute_name; ?></option>'+
						<?php }} ?>
					 '</select>'+
				'</div>'+
				'<div class="attribute_box attrInput" style="float: left;margin: 5px;" >'+
					 '<span><?php if($this->lang->line('product_list_value') != '') { echo stripslashes($this->lang->line('product_list_value')); } else echo "List Value"; ?> :</span>&nbsp;'+
					 '<select name="attribute_val[]" style="width:200px;color:gray;width:206px;" class="chzn-select">'+
					 '<option value="">--<?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?>--</option>'+
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
</script>
<?php
$this->load->view('site/templates/footer');
?>