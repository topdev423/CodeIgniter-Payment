<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/fancyybox/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="subcribelist_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                            </th>
                            <th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Image
							</th>
							<th>
								Price
							</th>
							<th class="tip_top" title="Click to sort">
								Shipping Cost
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
							<!--<th>
								 Action
							</th>-->
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($FancyyList->num_rows() > 0){
							foreach ($FancyyList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
                            <td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->name;?>
							</td>
							<td class="center">
						 		<div class="widget_thumb" style="margin-left: 25%;">
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/fancyybox/<?php echo $row->image;?>" />
								</div>
							</td>
							<td class="center">
								<?php echo $row->price;?>
							</td>
							<td class="center">
								<?php echo $row->shipping_cost;?>
							</td>
							
							<td class="center">
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
							<!--<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $product)){?>
								<span><a class="action-icons c-edit" href="admin/fancyybox/edit_fancyybox_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/fancyybox/view_fancyybox/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $product)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/fancyybox/delete_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>-->
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
								 Name
							</th>
							<th>
								 Image
							</th>
							<th>
								Price
							</th>
							<th>
								Shipping Cost
							</th>
							
							<th>
								Status
							</th>
							<th>
								Created On
							</th>
							<!--<th>
								Action
							</th>-->
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>