<?php $currentUrl = $this->uri->segment(2,0); $currentPage = $this->uri->segment(3,0);
if($currentUrl==''){$currentUrl = 'dashboard';} if($currentPage==''){$currentPage = 'dashboard';}

?>
 
<div id="left_bar" >

	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">

				<li><a href="<?php echo base_url();?>admin/dashboard/admin_dashboard" <?php if($currentUrl=='dashboard'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
				<li><h6 style="margin: 10px 0;padding-left:40px;font-weight:normal;color:#0D68AF;">Managements</h6></li>
                
				<?php extract($privileges); if ($allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='adminlogin'){ echo 'class="active"';} ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='adminlogin' || $currentUrl=='sitemapcreate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/adminlogin/display_admin_list" <?php if($currentPage=='display_admin_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
					<li><a href="admin/adminlogin/change_admin_password_form" <?php if($currentPage=='change_admin_password_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
					<li><a href="admin/adminlogin/admin_global_settings_form" <?php if($currentPage=='admin_global_settings_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
                    <li><a href="admin/adminlogin/admin_smtp_settings" <?php if($currentPage=='admin_smtp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
                    <li><a href="admin/adminlogin/admin_mail_chimp_settings" <?php if($currentPage=='admin_mail_chimp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Mailchimp Settings</a></li>
                    <li><a href="admin/sitemapcreate" <?php if($currentUrl=='sitemapcreate'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li>
				</ul>
				</li>
                
				<li><a href="#" <?php if($currentUrl=='subadmin'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> Subadmin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='subadmin'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/subadmin/display_sub_admin" <?php if($currentPage=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subadmin List</a></li>
					<li><a href="admin/subadmin/add_sub_admin_form" <?php if($currentPage=='add_sub_admin_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Subadmin</a></li>
				</ul>
				</li>
                
				<?php } if ((isset($user) && is_array($user)) && in_array('0', $user) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='users'){ echo 'class="active"';} ?>><span class="nav_icon users"></span> Users<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='users'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/users/display_user_dashboard" <?php if($currentPage=='display_user_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<li><a href="admin/users/display_user_list" <?php if($currentPage=='display_user_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Users List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $user)){?>
					<li><a href="admin/users/add_user_form" <?php if($currentPage=='add_user_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New User</a></li>
					<?php }?>
				</ul>
				</li>
                
				<?php } if ((isset($seller) && is_array($seller)) && in_array('0', $seller) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='seller' || $currentUrl=='commission'){ echo 'class="active"';} ?>><span class="nav_icon users_2"></span> Sellers<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='seller' || $currentUrl=='commission'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/seller/display_seller_dashboard" <?php if($currentPage=='display_seller_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<li><a href="admin/seller/display_seller_list" <?php if($currentPage=='display_seller_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Seller List</a></li>
					<li><a href="admin/seller/display_seller_requests" <?php if($currentPage=='display_seller_requests'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Seller Requests</a></li>
					<li><a href="admin/commission/display_commission_lists" <?php if($currentPage=='display_commission_lists'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Commission Tracking</a></li>
				</ul>
				</li>
                
				<?php } if ((isset($category) && is_array($category)) && in_array('0', $category) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='caetgory' || $currentPage=='display_category_list' || $currentPage=='display_banner_list' || $currentPage=='add_banner_form' || $currentPage=='edit_banner_form'){ echo 'class="active"';} ?>><span class="nav_icon category_sl"></span> Category<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='caetgory' || $currentPage=='display_category_list' || $currentPage=='display_banner_list' || $currentPage=='add_banner_form' || $currentPage=='edit_banner_form'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/category/display_category_list" <?php if($currentPage=='display_category_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Category List</a></li>
					<li><a href="admin/category/display_banner_list" <?php if($currentPage=='display_banner_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Banner List</a></li>
				</ul>
				</li>
                
                
                <?php } if ((isset($product) && is_array($product)) && in_array('0', $product) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Product<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='product' || $currentUrl=='comments'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/product/display_product_list" <?php if($currentPage=='display_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Selling Product List</a></li>
					<li><a href="admin/product/display_user_product_list" <?php if($currentPage=='display_user_product_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Affiliate Product List</a></li>
                    <li><a href="admin/comments/view_product_comments" <?php if($currentPage=='view_product_comments'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Product Comments List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $product)){?>
					<li><a href="admin/product/add_product_form" <?php if($currentPage=='add_product_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Product</a></li>
					<?php }?>
				</ul>
				</li>
                
                  
                <?php } if ((isset($layout) && is_array($layout)) && in_array('0', $layout) || $allPrev == '1'){ 	?>
		<li><a href="#" <?php if($currentUrl=='layout'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Layout<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='layout'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/layout/display_layout_list" <?php if($currentPage=='display_layout_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Text Layouts</a></li>
                    <li><a href="admin/layout/display_control_list" <?php if($currentPage=='display_control_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Control List</a></li>
                    <li><a href="admin/layout/display_theme_layout" <?php if($currentPage=='display_theme_layout'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Theme Layout</a></li> 
				</ul>
				</li>
                
                
                         <?php } if ((isset($footer) && is_array($footer)) && in_array('0', $footer) || $allPrev == '1'){ 	?>
		<li><a href="#" <?php if($currentUrl=='footer'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span>Footer Management<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='footer'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/footer/display_footer_list" <?php if($currentPage=='display_footer_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Display Widget</a></li>
					<li><a href="admin/footer/add_footer_list" <?php if($currentPage=='add_footer_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Widget</a></li>
				</ul>
				</li>
                <?php } if ((isset($fancyybox) && is_array($fancyybox)) && in_array('0', $fancyybox) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='fancyybox'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Subscription Box<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='fancyybox'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
	                <li><a href="admin/fancyybox/display_fancybox_dashboard" <?php if($currentPage=='display_fancybox_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
                    <li><a href="admin/fancyybox/fancybox_list" <?php if($currentPage=='fancybox_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscribed box list</a></li>
					<li><a href="admin/fancyybox/display_fancyybox" <?php if($currentPage=='display_fancyybox'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription Box List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $fancyybox)){?>
					<li><a href="admin/fancyybox/add_fancyybox_form" <?php if($currentPage=='add_fancyybox_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Subscription Box</a></li>
					<?php }?>
				</ul>
				</li>
                
                <?php 
				}if ((isset($paygateway) && is_array($paygateway)) && in_array('0', $paygateway) || $allPrev == '1'){ ?>
                <li><a href="#" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Orders<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='order' || $this->uri->segment(1,0)=='order-review'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/order/display_order_paid" <?php if($currentPage=='display_order_paid'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Paid Payment</a></li>
					<li><a href="admin/order/display_order_pending" <?php if($currentPage=='display_order_pending'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Failed Payment</a></li>

				</ul>
				</li>
                
                
                <?php } if ((isset($attribute) && is_array($attribute)) && in_array('0', $attribute) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='attribute'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Color<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='attribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<!--<li><a href="admin/attribute/display_attribute_list" <?php if($currentPage=='display_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Lists</a></li>-->
					<li><a href="admin/attribute/display_list_values" <?php if($currentPage=='display_list_values'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Color List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $attribute)){?>
                    <!--<li><a href="admin/attribute/add_attribute_form" <?php if($currentPage=='add_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New List</a></li>-->
                    <li><a href="admin/attribute/add_list_value_form" <?php if($currentPage=='add_list_value_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Color</a></li>
					<?php }?>
				</ul>
				</li>
				
				<?php } if ((isset($productattribute) && is_array($productattribute)) && in_array('0', $productattribute) || $allPrev == '1'){ 	?>
				<li><a href="#" <?php if($currentUrl=='productattribute'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Attribute<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='productattribute'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/productattribute/display_product_attribute_list" <?php if($currentPage=='display_product_attribute_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Attribute List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $productattribute)){?>
                    <li><a href="admin/productattribute/add_product_attribute_form" <?php if($currentPage=='add_product_attribute_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Attribute</a></li>
					<?php }?>
				</ul>
				</li>
                
				<?php  } if ((isset($couponcards) && is_array($couponcards)) && in_array('0', $couponcards) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='couponcards'){ echo 'class="active"';} ?>><span class="nav_icon record"></span> Coupon Codes<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='couponcards'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/couponcards/display_couponcards" <?php if($currentPage=='display_couponcards'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Coupon code List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $couponcards)){?>
					<li><a href="admin/couponcards/add_couponcard_form" <?php if($currentPage=='add_couponcard_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Coupon code</a></li>
					<?php }?>
				</ul>
				</li>
                
                
				<?php } if ((isset($giftcards) && is_array($giftcards)) && in_array('0', $giftcards) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='giftcards'){ echo 'class="active"';} ?>><span class="nav_icon image_1"></span> Gift Cards<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='giftcards'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/giftcards/display_giftcards_dashboard" <?php if($currentPage=='display_giftcards_dashboard'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
					<?php if ($allPrev == '1' || in_array('1', $giftcards)){?>
					<li><a href="admin/giftcards/edit_giftcards_settings" <?php if($currentPage=='edit_giftcards_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
					<li><a href="admin/giftcards/display_giftcards" <?php if($currentPage=='display_giftcards'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Gift Cards List</a></li>
					<?php }?>
				</ul>
				</li>
                
                <?php } if ((isset($pricerange) && is_array($pricerange)) && in_array('0', $pricerange) || $allPrev == '1'){ ?>
                				<li><a href="#" <?php if($currentUrl=='pricing'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Price Range<span class="up_down_arrow">&nbsp;</span></a>

<ul class="acitem" <?php if($currentUrl=='pricing'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
<?php if ($allPrev == '1' || in_array('1', $pricerange)){
?>
<li><a href="admin/pricing/display_pricing" <?php if($currentPage=='display_pricing'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Price Range List</a></li>
<li><a href="admin/pricing/add_pricing" <?php if($currentPage=='add_pricing'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Price Range</a></li>
					<?php }?>
				</ul>
				</li>
                
             
                
                <?php } if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrev == '1'){  ?>
				<li><a href="#" <?php if($currentUrl=='newsletter'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='newsletter'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/newsletter/display_subscribers_list" <?php if($currentPage=='display_subscribers_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>
					<?php if ($allPrev == '1' || in_array('1', $newsletter)){?>
					<li><a href="admin/newsletter/display_newsletter" <?php if($currentPage=='display_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
                    <li><a href="admin/newsletter/add_newsletter" <?php if($currentPage=='add_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Email Template</a></li>
					<?php }?>
				</ul>
				</li>

				<?php } if ((isset($location) && is_array($location)) && in_array('0', $location) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='location'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Location & Tax<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='location'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/location/display_location_list" <?php if($currentPage=='display_location_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Location List</a></li>
                    <?php if ($allPrev == '1' || in_array('1', $location)){?>
                    <li><a href="admin/location/add_location_form" <?php if($currentPage=='add_location_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Location</a></li>
                    <?php }?>
                    
              <!--       <li><a href="admin/location/display_country_list" <?php if($currentPage=='display_country_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Country List</a></li>-->
                    
                    <li><a href="admin/location/add_tax_form" <?php if($currentPage=='add_tax_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add State Tax</a></li>
                   
				</ul>
				</li>
                
				<?php } if ((isset($cms) && is_array($cms)) && in_array('0', $cms) || $allPrev == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='cms'){ echo 'class="active"';} ?>><span class="nav_icon documents"></span> Pages<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='cms'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
				 <li><a href="admin/cms/display_cms" <?php if($currentPage=='display_cms'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>List of pages</a></li>
					<?php if ($allPrev == '1' || in_array('1', $cms)){?>
				 <li><a href="admin/cms/add_cms_form" <?php if($currentPage=='add_cms_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Main Page</a></li>
				<li><a href="admin/cms/add_subpage_form" <?php if($currentPage=='add_subpage_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Sub Page</a></li>
					<?php }?>
				</ul>
				</li>
 
  <?php } if ((isset($admin_feedback) && is_array($admin_feedback)) && in_array('0', $admin_feedback) || $allPrev == '1'){ ?>
                				<li><a href="#" <?php if($currentUrl=='admin_feedback'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span>Feedback<span class="up_down_arrow">&nbsp;</span></a>

<ul class="acitem" <?php if($currentUrl=='admin_feedback'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
<?php if ($allPrev == '1' || in_array('1', $admin_feedback)){
?>
<li><a href="admin/admin_feedback/display_product_feedback" <?php if($currentPage=='admin_feedback'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Product Feedback</a></li>
					<?php }?>
				</ul>
				</li>
                
				<?php 
				}if ((isset($paygateway) && is_array($paygateway)) && in_array('0', $paygateway) || $allPrev == '1'){ ?>
				<li><a href="admin/paygateway/display_gateway" <?php if($currentUrl=='paygateway'){ echo 'class="active"';} ?>><span class="nav_icon shopping_cart_2"></span> Payment Gateway</a></li>
				<?php 
				}if ((isset($multilang) && is_array($multilang)) && in_array('0', $multilang) || $allPrev == '1'){ ?>
				 
                <li><a href="admin/multilanguage" <?php if($currentUrl=='multilanguage'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Language Management</a></li><?php }?>
				<li><a href="admin/contactseller/display_contact_seller" <?php if($currentUrl=='contactseller'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Contact Seller</a></li>
				<li><a href="admin/product/display_upload_req" <?php if($currentPage=='display_upload_req'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Upload Requests</a></li>
			</ul>
            
		</div>
	</div>
</div>


