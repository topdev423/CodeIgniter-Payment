<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $sellerList->num_rows();?> sellers registered in this site</h4>
							<table>
							<tbody>
							<tr>
								<td>
									Top Seller
								</td>
								<td>
									<?php 
									if ($topSellDetails->row()->sell_id == ''){
										echo 'Not found';
									}else {
										if ($topSellDetails->row()->sell_id == 0){
											echo 'Administrator';
										}else {
											if ($topSellDetails->row()->full_name != ''){
												echo $topSellDetails->row()->full_name;
											}else if ($topSellDetails->row()->user_name != ''){
												echo $topSellDetails->row()->user_name;
											}else {
												echo 'Seller details not available';
											}
										}
									}
									?>
								</td>
							</tr>
							<tr>
								<td>
									Top Amount
								</td>
								<td>
									<?php 
									if ($topSellDetails->row()->topAmt == ''){
										echo 'Not found';
									}else {
										echo $currencySymbol.' '.$topSellDetails->row()->topAmt.' '.$currencyType;
									}
									?>
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
						<span class="h_icon users"></span>
						<h6>Pending Requests</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
						<?php 
						if ($pendingList->num_rows()>0){
							foreach ($pendingList->result() as $pendingRow){
						?>
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
									<?php if ($pendingRow->thumbnail == ''){?>
										<img src="<?php base_url();?>images/users/user-thumb1.png" width="40" height="40" alt="<?php echo $pendingRow->full_name;?>">
									<?php }else {?>
										<img src="<?php base_url();?>images/users/<?php echo $pendingRow->thumbnail;?>" width="40" height="40" alt="<?php echo $pendingRow->full_name;?>">
									<?php }?>
									</div>
									<ul class="list_info">
										<li><span>User Name: <i><?php echo $pendingRow->full_name;?></i></span></li>
										<li><span>Brand Name: <?php echo $pendingRow->brand_name;?> </span></li>
										<li><span>Description: <?php echo $pendingRow->brand_description;?></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_reject tipTop" title="View details" href="admin/seller/view_seller/<?php echo $pendingRow->id;?>">View</a></li>
									<li><a class="p_del tipTop" title="Reject this request" href="admin/seller/change_seller_request/0/<?php echo $pendingRow->id;?>">Reject</a></li>
									<li class="right"><a class="p_approve tipTop" title="Approve this request" href="admin/seller/change_seller_request/1/<?php echo $pendingRow->id;?>">Approve</a></li>
								</ul>
							</div>
						<?php 
							}
						}else {
						?>
						<div class="user_block">
							<p>No requests found</p>
						</div>
						<?php }?>
						</div>
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