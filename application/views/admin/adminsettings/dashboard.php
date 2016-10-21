<?php
$this->load->view('admin/templates/header.php');

extract($privileges);
?>
  
    <div class="switch_bar">
		<ul>
			<!--<li>
			<a href="#"><span class="stats_icon current_work_sl"></span><span class="label">Analytics</span></a>
			</li>-->
			<li><a href="admin/users/display_user_list" ><span class="stats_icon user_sl"><span class="alert_notify orange"><?php echo $totalUserCounts;?></span></span><span class="label"> Users</span></a>
			<!--<div class="notification_list dropdown-menu blue_d">
				<div class="white_lin nlist_block">
					<ul>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
						</div>
						</li>
					</ul>
					<span class="btn_24_blue"><a href="#">View All</a></span>
				</div>
			</div>-->
			</li>
						
			<li><a href="admin/adminlogin/admin_global_settings_form"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
	
            
            <li><a href="admin/seller/display_seller_list"><span class="stats_icon user_seller"><span class="alert_notify orange"><?php echo $getTotalSellerCount;?></span></span><span class="label"> Sellers</span></a></li>
            
            
            
            
            
            
			<li><a href="admin/category/display_category_list"><span class="stats_icon cate_dash"></span><span class="label">Category</span></a></li>
			
            
            
            <li><a href="admin/product/display_product_list"><span class="stats_icon folder_sl"><span class="alert_notify orange"><?php echo $getTotalProductCount;?></span></span><span class="label">Product</span></a></li>
            
            
			<li><a href="admin/fancyybox/display_fancyybox"><span class="stats_icon category_sl"></span><span class="label">Fancy Box</span></a></li>
			<li><a href="admin/attribute/display_attribute_list"><span class="stats_icon list_dash"></span><span class="label">List</span></a></li>
			<li><a href="admin/couponcards/display_couponcards"><span class="stats_icon coupon_dash"></span><span class="label">Coupons</span></a></li>
			<li><a href="admin/giftcards/display_giftcards"><span class="stats_icon bank_sl"><span class="alert_notify blue"><?php echo $getTotalGiftCardCount;?></span></span><span class="label">Gift Cards</span></a></li>
            
            <li><a href="admin/newsletter/display_subscribers_list"><span class="stats_icon newsletter_dash"></span><span class="label">Newsletter</span></a></li>
			<li><a href="admin/location/display_location_list"><span class="stats_icon location_dash"><span class="alert_notify orange">30</span></span><span class="label">Location</span></a></li>
            <li><a href="admin/cms/display_cms"><span class="stats_icon administrative_docs_sl"></span><span class="label">Pages</span></a></li>
			<li><a href="admin/paygateway/display_gateway"><span class="stats_icon payment_dash"></span><span class="label">Payment</span></a></li>
			
            
		</ul>
	</div>
	<div id="content">
		<div class="grid_container">
			
			<span class="clear"></span>
			<div class="social_activities">
				<div class="activities_s">
					<div class="block_label">
						Total Products<span><?php echo $getTotalProductCount;?></span>
					</div>
					<!--<div class="activities_chart">
						<span class="activities_chart">100,150,130,100,250,280,350,250,400,450,280,350,250,400,</span>
					</div>-->
				</div>
				<div class="activities_s">
					<div class="block_label">
						Total Users<span><?php echo $totalUserCounts;?></span>
					</div>
					<!--<div class="visit_chart">
						<span class="activities_chart">500,450,100,500,550, 400,300,550,480,500,320,400,450</span>
					</div>-->
				</div>
				<div class="activities_s">
					<div class="block_label">
						Total Sellers<span><?php echo $getTotalSellerCount;?></span>
					</div>
					<!--<span class="badge_icon comment_sl"></span>-->
				</div>
				<div class="activities_s">
					<div class="block_label">
						Total Giftcards<span><?php echo $getTotalGiftCardCount;?></span>
					</div>
					<!--<span class="badge_icon bank_sl"></span>-->
				</div>
				<div class="activities_s">
					<div class="block_label">
						Total Subscribers<span><?php echo $getTotalSubscriberCount;?></span>
					</div>
					<!--<span class="badge_icon customers_sl"></span>-->
				</div>
			</div>
			<!--<div class="grid_12">
				<div class="widget_wrap collapsible_widget">
					<div class="widget_top active">
						<span class="h_icon"></span>
						<h6>Active Collapsible Widget</h6>
					</div>
					
				</div>
			</div>-->
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Users</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4>Users Count <?php echo $totalUserCounts;?></h4>
							<table>
							<tbody>
							<tr>
								<td>
									Today
								</td>
								<td>
									<?php echo $todayUserCounts;?>
								</td>
								<!-- <td class="min_chart">
									<span class="bar">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Month
								</td>
								<td>
									<?php echo $getThisMonthCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Year
								</td>
								<td>
									<?php echo $getLastYearCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							</tbody>
							</table>
							<!--<div class="stat_chart">
								<div class="pie_chart">
									<span class="inner_circle">1/1.5</span>
									<span class="pie">1/1.5</span>
								</div>
								<div class="chart_label">
									<ul>
										<li><span class="new_visits"></span>New Visitors: 7000</li>
										<li><span class="unique_visits"></span>Unique Visitors: 3000</li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon users"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
							
                            <?php foreach($getRecentUsersList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['user_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/users/change_user_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
								</ul>
							</div>
                            <?php } ?>
                            
                            
						</div>
					</div>
				</div>
			</div>
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Giftcard Statistics</h6>
					</div>
					<?php 
						$redeemed = $notused = $expired = 0;
						foreach ($giftCardsList->result() as $row){
							$status = strtolower($row->card_status);
							$var1 = strtotime(date('Y-m-d'));
							$var2 = strtotime($row->expiry_date);
							if($var1>$var2){
								if ($status != 'redeemed'){
									$status = 'expired';
								}
							}
							if ($status == 'redeemed'){
								$redeemed++;
							}else if ($status == 'expired'){
								$expired++;
							}else {
								$notused++;
							}
						}
					?>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $giftCardsList->num_rows();?> giftcards purchased from this site</h4>
							<table>
							<tbody>
							<tr>
								<td>
									Redeemed Cards
								</td>
								<td>
									<?php echo $redeemed;?>
								</td>
							</tr>
							<tr>
								<td>
									Not Used Cards
								</td>
								<td>
									<?php echo $notused;?>
								</td>
							</tr>
							<tr>
								<td>
									Expired Cards
								</td>
								<td>
									<?php echo $expired;?>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
            
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon image_1"></span>
						<h6>Recent Gift Cards</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 Code
							</th>
							<th>
								 Recipient Name
							</th>
							<th>
								 Sender Name
							</th>
							<th>
								 Status
							</th>
							<th>
								 Amount
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($giftCardsList->num_rows() > 0){
							$result = $giftCardsList->result_array();
							for ($i=0;$i<5;$i++){
								if (isset($result[$i]) && is_array($result[$i])){
						?>
						<tr class="tr_even">
							<td>
								 <?php echo $result[$i]['code'];?>
							</td>
							<td>
								 <?php echo stripslashes($result[$i]['recipient_name']);?>
							</td>
							<td>
								 <?php echo stripslashes($result[$i]['sender_name']);?>
							</td>
							<td>
							<?php 
							$cardStatus = $result[$i]['card_status'];
							$var1 = strtotime(date('Y-m-d'));
							$var2 = strtotime($result[$i]['expiry_date']);
							if($var1>$var2){
								if (strtolower($cardStatus) != 'redeemed'){
									$cardStatus = 'Expired';
								}
							}
							if (strtolower($cardStatus) == 'not used'){?>
								<span class="badge_style b_done"><?php echo $cardStatus;?></span>
							<?php 
							}else if (strtolower($cardStatus) == 'redeemed'){
							?>
								<span class="badge_style b_active"><?php echo $cardStatus;?></span>
							<?php }else {?>
								<span class="badge_style b_pending"><?php echo $cardStatus;?></span>
							<?php }?>
							</td>
							<td>
								 <?php echo $result[$i]['price_value'];?>
							</td>
						</tr>
						<?php 
								}
							}
						}else {
						?>
						<tr>
							<td colspan="5" align="center">No Giftcards Available</td>
						</tr>
						<?php }?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--<span class="clear"></span>-->
			<!--<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_images"></span>
						<h6>Task List</h6>
					</div>
					<div class="widget_content">
						<h3>Task list with label badge</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>
						<table class="display" id="action_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#" class="t-complete">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#" class="t-complete">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#" class="t-complete">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>-->
			<!--<span class="clear"></span>-->
			<!--<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Content</h6>
					</div>
					<div class="widget_content">
						<h3>Content Table</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>
								 Id
							</th>
							<th>
								 Details
							</th>
							<th>
								 Submit Date
							</th>
							<th>
								 Submited By
							</th>
							<th>
								 Status
							</th>
							<th>
								 Publish Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Jaman
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Jhon
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Mike
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Sam
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<th>
								 Id
							</th>
							<th>
								 Details
							</th>
							<th>
								 Submit Date
							</th>
							<th>
								 Submited By
							</th>
							<th>
								 Status
							</th>
							<th>
								 Publish Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>-->
			<span class="clear"></span>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon shopping_cart_3"></span>
						<h6>Recent Order</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 Order ID
							</th>
							<th>
								 Order Date
							</th>
							<th>
								 Status
							</th>
							<th>
								 Amount
							</th>
						</tr>
						</thead>
						<tbody>
                        
                         <?php 
						 $orderIndex = 0;
						 foreach($getOrderDetails as $orderdetails) { ?>
						<tr class="<?php if($orderIndex == 0 || $orderIndex==2) echo 'tr_even';else echo 'tr_odd'; ?>">
							<td class="noborder_b round_l">
								 #<?php echo $orderdetails['id']; ?>
							</td>
							<td class="noborder_b">
								<span><?php echo $orderdetails['created']; ?></span>
							</td>
							<td class="noborder_b">
								<span class="badge_style <?php if($orderdetails['status'] =='Pending')echo 'b_pending'; else echo 'b_confirmed'; ?>"><?php echo $orderdetails['status']; ?></span>
							</td>
							<td class="noborder_b round_r">
								 <?php echo $orderdetails['total']; ?>
							</td>
						</tr>
                        
                        <?php $orderIndex++;
						} ?>
                        
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon h_icon users"></span>
						<h6>Recent Seller List</h6>
						<div id="widget_tab">
							<ul>
								
								<li><a href="#tab1">Sellers<span class="alert_notify blue"><?php echo $getTotalSellerCount;?></span></a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
						
						<div id="tab1">
                        
                        <div class="user_list">
								
								 <?php foreach($getRecentSellerList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['user_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/seller/change_seller_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
								</ul>
							</div>
                            <?php } ?>
								
							</div>
							<!--<div class="post_list">
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus ac odio euismod consequat. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus ac odio euismod consequat. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>