<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="commission_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Sno
							</th>
							<th class="tip_top" title="Click to sort">
								 Vendor name
							</th>
							<th class="tip_top" title="Click to sort">
								 Vendor email
							</th>
							<th class="tip_top" title="Click to sort">
								Total orders
							</th>
							<th class="tip_top" title="Click to sort">
								Total amount
							</th>
							<th class="tip_top" title="Click to sort">
								Refunded
							</th>
							<th class="tip_top" title="Click to sort">
								 Commission to you 
							</th>
							<th class="tip_top" title="Click to sort">
								 Amount to vendor
							</th>
							<th class="tip_top" title="Click to sort">
								 Paid
							</th>
							<th class="tip_top" title="Click to sort">
								 Balance
							</th>
							<th>
								 Options
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($sellerDetails->num_rows() > 0){
							$i=1;
							foreach ($sellerDetails->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
								<?php echo $total_orders[$row->id];?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($total_amount[$row->id],2,'.',',');?>
							</td>
							<td class="center">
								<?php echo $currencySymbol;?><input style="width: 50px;margin:5px;" type="text" value="<?php echo $row->refund_amount;?>"/>
								<a href="javascript:void(0);" onclick="update_refund(this,'<?php echo $row->id;?>');">Update</a>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($commission_to_admin[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($amount_to_vendor[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($paid_to[$row->id],2);?>
							</td>
							<td class="center">
								<?php echo $currencySymbol.number_format($paid_to_balance[$row->id],2);?>
							</td>
							<td class="center">
									<span class="action_link"><a class="p_reject tipTop" href="admin/commission/view_paid_details/<?php echo $row->id;?>" title="View paid details">View</a></span>
									<?php if ($paid_to_balance[$row->id]>0){?>
									<span class="action_link"><a class="p_approve tipTop" href="admin/commission/add_pay_form/<?php echo $row->id;?>" title="Pay balance due">Pay now</a></span>
									<?php }?>
							</td>
						</tr>
						<?php 
						$i++;
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>
								Sno
							</th>
							<th>
								 Vendor name
							</th>
							<th>
								 Vendor email
							</th>
							<th>
								Total orders
							</th>
							<th>
								Total amount
							</th>
							<th>
								Refunded
							</th>
							<th>
								 Commission to you 
							</th>
							<th>
								 Amount to vendor
							</th>
							<th>
								 Paid
							</th>
							<th>
								 Balance
							</th>
							<th>
								 Options
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>