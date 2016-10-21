<?php
$this->load->view('admin/templates/header.php');
extract($privileges);

$productFeedbackListsVal= $this->data['productFeedbackLists']->result();
$productFeedbackListsValImage= $this->data['productFeedbackLists']->result_array();

//echo '<pre>'; print_r($productFeedbackListsVal); die;
//echo $productFeedbackListsVal[0]->product_name;die;
//echo '<pre>'; print_r(count($productFeedbackListsVal)); die;
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/admin_feedback/change_review_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $user)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onClick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $user)){
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
									 User Name
							</th>
							<th class="tip_top" title="Click to sort">
							 Product Name
							</th>
                            <th class="tip_top" title="Click to sort">
							 Title
							</th>
						<!--	<th class="tip_top" title="Click to sort">
								 Product Image
							</th>-->
							<th>
								Rating
							</th>
<!-- 							<th class="tip_top" title="Click to sort">
								User Type
							</th>
 -->							
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
						if (count($productFeedbackListsVal) > 0){
							foreach ($productFeedbackListsVal as $row){
							 if($row->voter_id!=''){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<a href="admin/users/view_user/<?php echo $row->userId ?>"><?php echo $row->userName;?></a>
							</td>
							<td class="center">
								<a href="admin/product/view_product/<?php echo $row->productId;?>"><?php echo $row->product_name;?></a>
							</td>
                            	<td class="center">
								<?php echo $row->title;?>
							</td>
							<!--<td class="center">
							<div class="widget_thumb">
							<?php if ($row->image != ''){   
							 $img_arr = explode(",",$row->image); ?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/product/thumb/<?php echo $img_arr[0]; ?>" />
							<?php }else {?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/noimage.jpg" />
							<?php }?>
							</div>	
							</td>-->
							<td class="center">
							<?php echo $row->rating;?>
							</td>
<!-- 							<td class="center">
								<?php //if ($row->group == 'User'){?>
								<span class="badge_style b_high"><?php //echo $row->group;?></span>
								<?php //}else {?>
								<span class="badge_style b_away"><?php //echo 'User / '.$row->group;?></span>
								<?php //}?>
							</td>
 -->							
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $user)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/admin_feedback/change_product_feedback_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/admin_feedback/change_product_feedback_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $user)){?>
							<!--	<span><a class="action-icons c-edit" href="admin/admin_feedback/edit_product_feedback/<?php echo $row->id;?>" title="Edit">Edit</a></span>-->
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/admin_feedback/view_product_feedback/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $user)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/admin_feedback/delete_product_feedback/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
							</td>
						</tr>
						<?php 
							}
						} }
						?>
						</tbody>
						<tfoot>
							<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
									 User Name	
							</th>
							<th class="tip_top" title="Click to sort">
									 Product Name
							</th>
                             <th class="tip_top" title="Click to sort">
							 Title
							</th>
							<!--<th class="tip_top" title="Click to sort">
								 Product Image
							</th>-->
							<th>
								Rating
							</th>
<!-- 							<th class="tip_top" title="Click to sort">
								User Type
							</th>
 -->						
							<th class="tip_top" title="Click to sort">
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