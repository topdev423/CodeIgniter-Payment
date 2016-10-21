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
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/seo" id="sellerProdEdit1">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li class=""><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li class="active"><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <script>
                                function saveDetails(mode){
                                    $('#nextMode').val(mode);
									$('#editDetailsSub').trigger('click');
                                }
                                </script>
                                <input type="hidden" name="nextMode" id="nextMode" value="seo"/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_meta_ttle') != '') { echo stripslashes($this->lang->line('product_meta_ttle')); } else echo "Meta Title"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input" placeholder="<?php if($this->lang->line('product_meta_ttle') != '') { echo stripslashes($this->lang->line('product_meta_ttle')); } else echo "Meta Title"; ?>" value="<?php echo $productDetails->row()->meta_title;?>" name="meta_title">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_meta_key') != '') { echo stripslashes($this->lang->line('product_meta_key')); } else echo "Meta Keyword"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="text" class="global-input" placeholder="<?php if($this->lang->line('product_meta_key') != '') { echo stripslashes($this->lang->line('product_meta_key')); } else echo "Meta Keyword"; ?>" value="<?php if ($editmode == '1'){echo $productDetails->row()->meta_keyword;}?>" name="meta_keyword">                                        </div>
                                    </div>
                                    
                                    <div class="form_fields">
                                            <label><?php if($this->lang->line('product_meta_desc') != '') { echo stripslashes($this->lang->line('product_meta_desc')); } else echo "Meta Description"; ?></label>
                                            <div class="form_fieldsgroup">
                                            <textarea class="global-input" placeholder="<?php if($this->lang->line('product_meta_desc') != '') { echo stripslashes($this->lang->line('product_meta_desc')); } else echo "Meta Description"; ?>" rows="5" cols="40" name="meta_description"><?php echo $productDetails->row()->meta_description;?></textarea>                                            </div>
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
	$("#sellerProdEdit1").validate();
</script>
<?php
$this->load->view('site/templates/footer');
?>