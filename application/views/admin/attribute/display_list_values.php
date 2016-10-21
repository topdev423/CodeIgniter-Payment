<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/attribute/change_list_value_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('3', $attribute)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="action_tbl_view"> 
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Color Name
							</th>
							<th class="tip_top" title="Click to sort">
								Products
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($listValues->num_rows() > 0){
							foreach ($listValues->result() as $row){
								if (strtolower($row->attribute_name) != 'price'){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							
							<td class="center">
								<?php echo $row->list_value;?>
							</td>
							<td class="center">
								<?php echo $row->product_count;?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $attribute)){?>
								<span><a class="action-icons c-edit" href="admin/attribute/edit_list_value_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('3', $attribute)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/attribute/delete_list_value/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
						</tr>
						<?php 
								}
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							
							<!--<th>
								 List Name
							</th>-->

							<th>
								 Color Name
							</th>
							<th>
								Products
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