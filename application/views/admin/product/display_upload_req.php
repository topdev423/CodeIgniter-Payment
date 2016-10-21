<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_upreq_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="upreq_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 User Name
							</th>
							<th class="tip_top" title="Click to sort">
								Subject
							</th>
							<th class="tip_top" title="Click to sort">
								Message
							</th>
							<th class="tip_top" title="Click to sort">
								Requested on
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($req_details->num_rows() > 0){
							foreach ($req_details->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<a href="admin/users/view_user/<?php echo $row->user_id;?>"><?php echo $row->user_name;?></a>
							</td>
							<td class="center">
								<?php echo $row->title;?>
							</td>
							<td class="center">
								 <?php echo $row->comment;?>
							</td>
							<td class="center">
								<?php echo $row->dateAdded;?>
							</td>
							<td class="center">
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_upreq/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
								 User Name
							</th>
							<th>
								 Subject
							</th>
							<th>
								Message
							</th>
							<th>
								Requested on
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
$('#upreq_tbl').dataTable({   
	 "aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0,5] }
					],
					"aaSorting": [[4, 'desc']],
	"sPaginationType": "full_numbers",
	"iDisplayLength": 100,
	"oLanguage": {
       "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
   },
	 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
	 
	});
</script>
<style>
#upreq_tbl tr td{border-right:1px solid #ccc;}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>