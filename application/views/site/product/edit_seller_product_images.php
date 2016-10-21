<?php
$this->load->view('site/templates/header');
?>
 <link rel="stylesheet" type="text/css" media="all" href="css/data-table.css"/> 
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
                    <form accept-charset="utf-8" method="post" action="site/product/sell_it/images" id="sellerProdEdit1" enctype="multipart/form-data">
                    <section class="left-section min_height" style="height: 924px;">	
                        <div class="person-lists bs-docs-example">
                            <ul class="tabs1" id="myTab">
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_details') != '') { echo stripslashes($this->lang->line('product_details')); } else echo "Details"; ?></a></li>
                                    <li class=""><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/categories"><?php if($this->lang->line('product_categories') != '') { echo stripslashes($this->lang->line('product_categories')); } else echo "Categories"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/list"><?php if($this->lang->line('display_lists') != '') { echo stripslashes($this->lang->line('display_lists')); } else echo "List"; ?></a></li>
                                    <li class="active"><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/images"><?php if($this->lang->line('product_images') != '') { echo stripslashes($this->lang->line('product_images')); } else echo "Images"; ?></a></li>
                                    <li><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/attribute"><?php if($this->lang->line('header_attr') != '') { echo stripslashes($this->lang->line('header_attr')); } else echo "Attribute"; ?></a></li>
                                    <li ><a data-toggle="tab" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit/seo"><?php if($this->lang->line('product_seo') != '') { echo stripslashes($this->lang->line('product_seo')); } else echo "SEO"; ?></a></li>
                                </ul>
                                <input type="hidden" name="nextMode" id="nextMode" value="images"/>
                            <div class="tab-content border_right width_100 pull-left" id="myTabContent"> 
                                <div id="product_info" class="tab-pane active">
                                    <div class="form_fields">
                                        <label><?php if($this->lang->line('product_prod_image') != '') { echo stripslashes($this->lang->line('product_prod_image')); } else echo "Product Image"; ?></label>
                                        <div class="form_fieldsgroup validation-input">
                                            <input type="file" class="global-input multi" name="product_image[]">   
                                            <p style="color:#407A2A;"><?php if($this->lang->line('product_mult_imgs') != '') { echo stripslashes($this->lang->line('product_mult_imgs')); } else echo "You can upload multiple images"; ?></p>                                     </div>
                                    </div>
                                    <div class="widget_content">
							<table class="display display_tbl" id="image_tbl">
							<thead>
							<tr>
								<th class="center">
									<?php if($this->lang->line('product_sno') != '') { echo stripslashes($this->lang->line('product_sno')); } else echo "Sno"; ?>
								</th>
								<th>
									<?php if($this->lang->line('product_img') != '') { echo stripslashes($this->lang->line('product_img')); } else echo "Image"; ?>
								</th>
								<th title="Change the order in which your images need to be displayed Eg : 0 is the main image">
									<?php if($this->lang->line('product_position') != '') { echo stripslashes($this->lang->line('product_position')); } else echo "Position"; ?> 
								</th>
								<th>
									  <?php if($this->lang->line('product_actioin') != '') { echo stripslashes($this->lang->line('product_actioin')); } else echo "Action"; ?>
								</th>
							</tr>
							</thead>
							<tbody>
							<?php 
							$imgArr = explode(',', $productDetails->row()->image);
							if (count($imgArr)>0){
								$i=0;$j=1;
								$this->session->set_userdata(array('product_image_'.$productDetails->row()->id => $productDetails->row()->image));
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
									<ul class="action_list" style="background:none;border-top:none;"><li style="width:100%;"><a class="p_del tipTop" href="javascript:void(0)" onclick="editPictureProductsUser(<?php echo $i; ?>,<?php echo $productDetails->row()->id;?>);" title="Delete this image"><?php if($this->lang->line('product_remove') != '') { echo stripslashes($this->lang->line('product_remove')); } else echo "Remove"; ?></a></li></ul>
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
									<?php if($this->lang->line('product_sno') != '') { echo stripslashes($this->lang->line('product_sno')); } else echo "Sno"; ?>
								</th>
								<th>
									<?php if($this->lang->line('product_img') != '') { echo stripslashes($this->lang->line('product_img')); } else echo "Image"; ?>
								</th>
								<th title="Change the order in which your images need to be displayed Eg : 0 is the main image">
									<?php if($this->lang->line('product_position') != '') { echo stripslashes($this->lang->line('product_position')); } else echo "Position"; ?>
								</th>
								<th>
									 <?php if($this->lang->line('product_actioin') != '') { echo stripslashes($this->lang->line('product_actioin')); } else echo "Action"; ?>
								</th>
							</tr>
							</tfoot>
							</table>
						</div>
                                    <input type="hidden" name="PID" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
                                    <br/>
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
<script type="text/javascript" src="js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>

<script>
	$("#sellerProdEdit1").validate();
</script>
<?php
$this->load->view('site/templates/footer');
?>