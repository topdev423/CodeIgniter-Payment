<?php
$this->load->view('admin/templates/header.php');
$layoutListVal= $this->data['layoutList']->result();
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
					</div>
					<div class="widget_content">
						<table class="display" id="text_layout_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Sno
							</th>
							
                            <th class="tip_top" title="Click to sort">
							 Place
							</th>
							<th class="tip_top" title="Click to sort">
							 Text
							</th>
					
                            
                            <th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						$sno = 1;
						if (count($layoutListVal) > 0){
							foreach ($layoutListVal as $row){
							 if($row->id!=''){
						?>
						<tr>
							<td class="center tr_select ">
								<?php echo $sno;$sno++;?>
							</td>
							
							<td class="center">
							<?php echo $row->place;?>
							</td>
                            <td class="center">
							<?php echo $row->text;?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $user)){?>
								<span><a class="action-icons c-edit" href="admin/layout/EditviewLayout/<?php echo $row->id;?>" title="Edit">Edit</a></span>
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
								Sno
							</th>
						
                             <th>
							 Place
							</th>
							<th>
							 Text
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