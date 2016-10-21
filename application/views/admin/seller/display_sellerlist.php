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
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="seller_list_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Full Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Email
							</th>
							<th>
								Thumbnail
							</th>
							<th class="tip_top" title="Click to sort">
								Commision
							</th>
							<th class="tip_top" title="Click to sort">
								Brand Name
							</th>
							<th class="tip_top" title="Click to sort">
								Website
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
						if ($sellersList->num_rows() > 0){
							foreach ($sellersList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->full_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
							<div class="widget_thumb">
							<?php if ($row->thumbnail != ''){?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $row->thumbnail;?>" />
							<?php }else {?>
								 <img width="40px" height="40px" src="<?php echo base_url();?>images/users/user-thumb1.png" />
							<?php }?>
							</div>
							</td>
							<td class="center">
								 <?php echo $row->commision.' %';?>
							</td>
							<td class="center">
								<?php echo $row->brand_name;?>
							</td>
							<td class="center">
								<?php echo $row->web_url;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $user)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/seller/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/seller/change_user_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
<!-- 							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $seller)){
								$mode = ($row->request_status == 'Approved')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to reject" class="tip_top" href="javascript:confirm_status('admin/seller/change_seller_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->request_status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to approve" class="tip_top" href="javascript:confirm_status('admin/seller/change_seller_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->request_status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
 -->							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $seller)){?>
								<span><a class="action-icons c-edit" href="admin/seller/edit_seller_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
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
								 Full Name
							</th>
							<th>
								 Email
							</th>
							<th>
								Thumbnail
							</th>
							<th>
								Commision
							</th>
							<th>
								Brand Name
							</th>
							<th>
								Website
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
<script type="text/javascript">
$('#seller_list_tbl').dataTable({   
	 "aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0 , 3 , 8 ] }
					],
					"aaSorting": [[1, 'asc']],
	"sPaginationType": "full_numbers",
	"iDisplayLength": 100,
	"oLanguage": {
       "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
   },
	 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
	 
	});
</script>
<style>
#seller_list_tbl tr td,#seller_list_tbl tr th{
	border-right: 1px solid #ccc;
}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>