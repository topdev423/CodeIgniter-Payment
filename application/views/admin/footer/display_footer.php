<?php
$this->load->view('admin/templates/header.php');
$footerListVal = $this->data['footerList']->result_array();
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/footer/change_footer_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $footer)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $footer)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="subscriber_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							
                            <th class="tip_top" title="Click to sort">
							 Title
							</th>
                             <th>
								 Status
							</th>
                            <th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
			<?php 
					$widget_name_array = array();
					$widget_link_array = array();
					$widget_icon_array = array();
					$widget_title_array = array();
					foreach($footerListVal as $footer_val)
					{	
						$widget_title_array[] = $footer_val['widget_title'];
						$widget_name_array[] = explode("footsep",$footer_val['widget_name']);
						$widget_link_array[] = explode("footsep",$footer_val['widget_link']);
						$widget_icon_array[] = explode(",",$footer_val['widget_icon']);
					}
					foreach($footerListVal as $footer_vals)
					
					{
							 ?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $footer_vals['id'];?>">
							</td>
							<td class="center">
                            
                            
                                                        	 <?php echo $footer_vals['widget_title']; ?>

                            	 <?php //echo $widget_title_array[$loop_start_val]; ?>
                             </td>
	
                          <td>
							<?php 
							if ($allPrev == '1' || in_array('2', $footer)){
								$mode = ($footer_vals['status'] == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/footer/change_footer_status/<?php echo $mode;?>/<?php echo $footer_vals['id'];?>');"><span class="badge_style b_done"><?php echo $footer_vals['status'];?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/footer/change_footer_status/<?php echo $mode;?>/<?php echo $footer_vals['id']; ?>')"><span class="badge_style"><?php echo  $footer_vals['status']; ?></span></a>
							<?php 
								}
							}else {
							?>
					<span class="badge_style b_done"><?php echo $footer_vals['status'];?></span>
					<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $footer)){?>
								<span><a class="action-icons c-edit" href="admin/footer/EditviewLayout/<?php echo $footer_vals['id'];?>" title="Edit">Edit</a></span>
							<?php }?>
							<span><a class="action-icons c-suspend" href="admin/footer/view_footer/<?php echo $footer_vals['id'];?>" title="View">View</a></span>
						<?php if ($allPrev == '1' || in_array('3', $footer)){?>	
							<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/footer/delete_footer_list/<?php echo $footer_vals['id']; ?>')" title="Delete">Delete</a></span>
</td><?php } ?>	
				<?php /*$loop_start_val_second = $loop_start_val_second+1;
 										
 			$loop_start_val = $loop_start_val+1;*/ }
 
 ?>
								
						</tr>
						<?php 
						?>
						</tbody>
						<tfoot>
							<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
						  <th class="tip_top" title="Click to sort">
							 Title
							</th>
							<!--<th class="tip_top" title="Click to sort">
							 Name
							</th>
					
                             <th>
								 Link
							</th>
                            
                            -->
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