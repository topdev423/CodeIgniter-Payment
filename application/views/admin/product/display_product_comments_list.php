<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/comments/change_product_comment_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $attribute)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to approved records"><span class="icon accept_co"></span><span class="btn_link">Approved</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to pending records"><span class="icon delete_co"></span><span class="btn_link">Pending</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $attribute)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view"> 
						<thead>
						<tr>
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							
							<th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Product Name
							</th>
							<th class="tip_top" title="Click to sort">
								Comments
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
						if ($commentsList->num_rows() > 0){
							foreach ($commentsList->result() as $row){
							
						?>
						<tr>
							<!--<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>-->
							<td class="center">
								<?php echo $row->user_name;?>
							</td>
                            <td class="center">
								<?php echo $row->product_name;?>
							</td>
							<td class="center">
								<?php echo $row->comments;?>
							</td>
							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $attribute)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
 								<a title="Click to pending" class="tip_top" href="javascript:confirm_status('admin/comments/change_product_comment_status/<?php echo $mode;?>/<?php echo $row->id;?>/<?php echo $row->product_id;?>/<?php echo $row->CUID;?>');"><span class="badge_style b_done">Approved</span></a>
 							<?php
								}else {	
							?>
 								<a title="Click to approved" class="tip_top" href="javascript:confirm_status('admin/comments/change_product_comment_status/<?php echo $mode;?>/<?php echo $row->id;?>/<?php echo $row->product_id;?>/<?php echo $row->CUID;?>')"><span class="badge_style">Pending</span></a>
 							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<!--<?php if ($allPrev == '1' || in_array('2', $attribute)){?>
								<span><a class="action-icons c-edit" href="admin/comments/edit_product_comment_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>-->
								<span><a class="action-icons c-suspend" href="admin/comments/view_product_comment/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $attribute)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/comments/delete_product_comment/<?php echo $row->id;?>/<?php echo $row->product_id;?>/<?php echo $row->status;?>')" title="Delete">Delete</a></span>
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
							<!--<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>-->
							
							<th>
								 User Name
							</th>
							
							
							<th>
								Product Name
							</th><th>
								Comments
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
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>