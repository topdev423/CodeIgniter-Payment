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
								 <?php echo $result[$i]['recipient_name'];?>
							</td>
							<td>
								 <?php echo $result[$i]['sender_name'];?>
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
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>