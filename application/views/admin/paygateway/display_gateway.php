<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/paygateway/change_paygateway_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('2', $paygateway)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Enable','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to enable records"><span class="icon active"></span><span class="btn_link">Enable</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Disable','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to disable records"><span class="icon delete_co"></span><span class="btn_link">Disable</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="gateway_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Gateway Name
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
							<?php if ($allPrev == '1' || in_array('2', $paygateway)){?>
							<th>
								 Action
							</th>
							<?php }?>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($gatewayLists->num_rows() > 0){
							foreach ($gatewayLists->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->gateway_name;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $paygateway)){
								$mode = ($row->status == 'Enable')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to disable" class="tip_top" href="javascript:confirm_status('admin/paygateway/change_gateway_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to enable" class="tip_top" href="javascript:confirm_status('admin/paygateway/change_gateway_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<?php if ($allPrev == '1' || in_array('2', $paygateway)){?>
							<td class="center">
								<ul class="action_list"><li style="width:100%;"><a class="p_edit tipTop" href="admin/paygateway/edit_gateway_form/<?php echo $row->id;?>" title="Edit Details">Edit Details</a></li></ul>
							</td>
							<?php }?>
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
								 Gateway Name
							</th>
							<th>
								Status
							</th>
							<?php if ($allPrev == '1' || in_array('2', $paygateway)){?>
							<th>
								 Action
							</th>
							<?php }?>
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