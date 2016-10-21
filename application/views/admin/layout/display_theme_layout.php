<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<div class="btn_30_light" style="height: 29px;">
						<a href="javascript:confirm_set_theme('admin/layout/set_default_theme');" class="tipTop" title="Click here to set default theme"><span class="icon accept_co"></span><span class="btn_link">Restore default</span></a>
						</div>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="text_layout_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Sno
							</th>
							
                            <th class="tip_top" title="Click to sort">
							 Name
							</th>
							<th class="tip_top" title="Click to sort">
							 Value
							</th>
					
                            
                            <th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$sno = 1;
						if ($theme_layout->num_rows() > 0){
							foreach ($theme_layout->result() as $row){
							 if($row->id!=''){
						?>
						<tr>
							<td class="center tr_select ">
								<?php echo $sno;$sno++;?>
							</td>
							
							<td class="center">
							<?php echo ucwords(str_replace(array('_','bg'), array(' ','background'), $row->name));?>
							</td>
                            <td class="center">
							<?php echo $row->value;?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $user)){?>
								<span><a class="action-icons c-edit" href="admin/layout/editThemeLayout/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
<!--								<span><a class="action-icons c-suspend" href="admin/admin_feedback/view_product_feedback/<?php echo $row->id;?>" title="View">View</a></span>
-->							<?php if ($allPrev == '1' || in_array('3', $user)){?>	
<!--								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/layout/delete_layout_list/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
					<?php }?>
							</td> -->		
						</tr>
						<?php 
							}
						} }
						?>
						</tbody>
						<tfoot>
							<tr>
							<th class="center">
								Sno
							</th>
						
                             <th>
							 Name
							</th>
							<th>
							 Value
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
		</div>
		<span class="clear"></span>
	</div>
<style>
#text_layout_tbl tr td{
	border-right:#ccc 1px solid;
}
</style>	
<script>
$('#text_layout_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [ 3 ] }
	                 ],
	                 "aaSorting": [[0, 'asc']],
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