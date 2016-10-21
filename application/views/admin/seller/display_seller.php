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
						<?php 
						if ($allPrev == '1' || in_array('3', $seller)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
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
								<?php echo $row->description;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $seller)){
							?>
								<select name="seller_status" style="float: left;margin:10px 0 0 30%;width:100px;" id="seller_status_<?php echo $row->id;?>" >
									<option <?php if ($row->status == 'Pending'){echo 'selected="selected"';}?> value="Pending">Pending</option>
									<option <?php if ($row->status == 'Approved'){echo 'selected="selected"';}?> value="Approved">Approved</option>
									<option <?php if ($row->status == 'Rejected'){echo 'selected="selected"';}?> value="Rejected">Rejected</option>
								</select>
								<div class="btn_30_light" style="float:left;margin-left:10px;">
									<a href="javascript:changeSellerStatus('<?php echo $row->id;?>','<?php echo $row->user_id;?>')" class="tipTop" title="Update Status"><span class="icon disk_co"></span></a>
								</div>
							<?php 
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
								<span><a class="action-icons c-suspend" href="admin/seller/view_seller/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $seller)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/seller/delete_seller/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
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