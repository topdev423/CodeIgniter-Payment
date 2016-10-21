<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/location/change_location_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $location)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $location)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="newsletter_tbl">
						<thead>
						<tr>
							
							<th class="tip_top" title="Click to sort">
								 Location Name
							</th>
							<th class="center" title="Click to sort">
                            Symbol
							</th>
                            <th class="center" title="Click to sort">
                            Currency
							</th>
                            <th>
								Default
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($locationList->num_rows() > 0){
							foreach ($locationList->result() as $row){
						?>
						<tr>
							
							<td class="center  tr_select">
								<?php echo $row->location_name;?>
							</td>
							<td class="center tr_select ">
                                <?php echo $row->currency_symbol;?>
							</td>
                            <td class="center tr_select ">
                                <?php echo $row->currency_type;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $location)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<span class="badge_style b_done">Yes</span>
							<?php
								}else {	
							?>
								<span class="badge_style">No</span>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $location)){?>
								<span><a class="action-icons c-edit" href="admin/location/edit_location_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/location/view_location/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $location)){
							
							if($row->status!='Active'){
							
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/location/delete_location/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php } }?>
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
								 Location Name
							</th>
							<th class="center">
								Symbol
							</th>
							<th>
								 Currency
							</th>
                            <th>
								 Default
							</th>
							<th>
								 Action
							</th>
						</tr></tfoot>
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