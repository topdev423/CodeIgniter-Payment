<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/multilanguage/change_multi_language_details',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading;?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('1', $multilang)){?>
							<div class="btn_30_light" style="height: 29px; text-align:left;">
								<a href="admin/multilanguage/add_new_lg" class="tipTop" title="Click here to add new language"><span class="icon add_co"></span><span class="btn_link">Add New</span></a>
							</div>
						<?php } ?>
						<?php if ($allPrev == '1' || in_array('2', $multilang)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $multilang)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
						
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="language_tbl">
						<thead>
						<tr>
							<th class="center">                          
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">                               
							</th>
							<th class="tip_top" title="Click to sort">
								 Language Name
							</th>
                            <th class="tip_top" title="Click to sort">
								language Code<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
                            <th>
								Default
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
						if ($language_list->num_rows() > 0){
							foreach ($language_list->result() as $row){
						?>
						<tr>
                        	<td class="center tr_select ">
                             <?php if($row->lang_code != 'en') {?>
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
                                <?php } ?>
							</td>							
							<td class="center  tr_select">
								<?php echo $row->name;?>
							</td>
                            <td class="center  tr_select">
								<?php echo $row->lang_code;?>
							</td>
                            <td class="center  tr_select">
								<?php 
							if ($allPrev == '1' || in_array('2', $multilang)){
								if ($row->default == 'yes'){
							?>
								<a title="Default" class="tip_top" href="javascript:void(0);"><span class="badge_style b_done"><?php echo ucfirst($row->default);?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to set as default" class="tip_top" href="javascript:confirm_status('admin/multilanguage/change_language_default/<?php echo $row->id;?>/<?php echo $row->lang_code;?>')"><span class="badge_style"><?php echo ucfirst($row->default);?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo ucfirst($row->default);?></span>
							<?php }?>
							</td>
                            
                            <td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $multilang)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to unpublish" class="tip_top" href="javascript:confirm_status('admin/multilanguage/change_language_status/<?php echo $row->status;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to publish" class="tip_top" href="javascript:confirm_status('admin/multilanguage/change_language_status/<?php echo $row->status;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							
							<!--<td class="center">
							<?php 
							
							if ($allPrev == '1' || in_array('2', $multilang)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>-->
							<td class="center">
                            <?php if($row->lang_code != 'en') {?>
							<?php if ($allPrev == '1' || in_array('2', $multilang)){?>
								<span><a class="action-icons c-edit" href="admin/multilanguage/edit_language/<?php echo $row->lang_code;?>" title="Edit">Edit</a></span>
							<?php }?>								 
							<?php if ($allPrev == '1' || in_array('3', $multilang)){
							$EmailtempId=array('1','2','3','4','5');
							
							
							?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/multilanguage/delete_language/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
                            <?php } ?>
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
								 Language Name
							</th>
							<th>
								language Code<!--<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">-->
							</th>
                             <th>
								Default
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
<style>
#language_tbl tr td{
	border-right:#ccc 1px solid;
}
</style>	
<script>
$('#language_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [ 0 ,3,4,5 ] }
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
<?php 
$this->load->view('admin/templates/footer.php');
?>