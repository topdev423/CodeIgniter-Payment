<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/couponcards/change_couponcards_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $couponcards)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $couponcards)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="gift_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Code
							</th>
							<th class="tip_top" title="Click to sort">
								 Type
							</th>
							<th class="tip_top" title="Click to sort">
								 Value
							</th>
							<th class="tip_top" title="Click to sort">
								Remain
							</th>
							<th class="tip_top" title="Click to sort">
								Purchased
							</th>
							<th class="tip_top" title="Click to sort">
								Date From
							</th>
							<th class="tip_top" title="Click to sort">
								Date To
							</th>
							<th class="tip_top" title="Click to sort">
								Card Status
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
						if ($couponCardsList->num_rows() > 0){
							foreach ($couponCardsList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->code;?>
							</td>
							<td class="center">
								<?php if ($row->price_type == '1'){?>
								<span class="badge_style b_high"><?php echo 'Flat';?></span>
								<?php }elseif ($row->price_type == '2'){?>
								<span class="badge_style b_away"><?php echo 'Percentage';?></span>
								<?php }else {?>
								<span class="badge_style b_away"><?php echo 'Free';?></span>
								<?php }?>
							</td>
							<td class="center">
								<?php 
								if ($row->price_type == '1'){
									echo $row->price_value;
								}else {
									echo (int)round($row->price_value).' %';
								}
								?>
							</td>
							<td class="center">
								<?php echo ($row->quantity - $row->purchase_count);?>
							</td>
							<td class="center">
								 <?php echo $row->purchase_count;?>
							</td>
							<td class="center">
								 <?php echo $row->datefrom;?>
							</td>
							<td class="center">
								<?php echo $row->dateto;?>
							</td>
							<td class="center">
								<?php 
								$var1 = strtotime($row->dateto); 
								$var2 = strtotime(date('Y-m-d')); 
								
								if($var1 < $var2){
									echo 'expired';
								}else {
									echo $row->card_status;
								}
								?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $couponcards)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/couponcards/change_couponcard_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/couponcards/change_couponcard_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $couponcards)){?>
								<span><a class="action-icons c-edit" href="admin/couponcards/edit_couponcard_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
							<?php if ($allPrev == '1' || in_array('3', $couponcards)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/couponcards/delete_couponcard/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
								 Code
							</th>
							<th>
								 Type
							</th>
							<th>
								 Value
							</th>
							<th>
								Remain
							</th>
							<th>
								Purchased
							</th>
							<th>
								Date From
							</th>
							<th>
								Date To
							</th>
							<th>
								Card Status
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