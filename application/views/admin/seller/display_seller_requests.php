<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/seller/change_seller_status_global',$attributes) 
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
						<table class="display display_tbl" id="seller_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Brand Name
							</th>
							<th class="tip_top" title="Click to sort">
								Description
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($sellerRequests->num_rows() > 0){
							foreach ($sellerRequests->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->brand_name;?>
							</td>
							<td class="center">
								<?php echo $row->brand_description;?>
							</td>
							<td class="center">
							<span class="badge_style b_pending"><?php echo $row->request_status;?></span>
							</td>
							<td class="center">
									<span class="action_link"><a class="p_reject tipTop" href="admin/seller/view_seller/<?php echo $row->id;?>" title="View">View</a></span>
									<span class="action_link"><a class="p_del tipTop" href="admin/seller/change_seller_request/0/<?php echo $row->id;?>" title="Reject">Reject</a></span>
									<span class="action_link"><a class="p_approve tipTop" href="admin/seller/change_seller_request/1/<?php echo $row->id;?>" title="Approve">Approve</a></span>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 User Name
							</th>
							<th>
								 Brand Name
							</th>
							<th>
								Description
							</th>
							<th>
								Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>