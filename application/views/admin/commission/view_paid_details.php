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
						<table class="display display_tbl" id="paid_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Transaction Id
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction Date
							</th>
							<th class="tip_top" title="Click to sort">
								 Transaction Method
							</th>
							<th class="tip_top" title="Click to sort">
								Amount
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($paidDetails->num_rows() > 0){
							foreach ($paidDetails->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo '#'.$row->transaction_id;?>
							</td>
							<td class="center">
								<?php echo $row->date;?>
							</td>
							<td class="center">
								<?php echo $row->payment_type;?>
							</td>
							<td class="center">
								<?php echo $row->amount;?>
							</td>
							<td class="center">
								<?php echo $row->status;?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>
								Transaction Id
							</th>
							<th>
								 Transaction Date
							</th>
							<th>
								 Transaction Method
							</th>
							<th>
								Amount
							</th>
							<th>
								Status
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