<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
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
						<table class="display display_tbl" id="contact_seller_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								 Contact Name
							</th>
                            <th class="tip_top" title="Click to sort">
								 Contact Email
							</th>
                            <th class="tip_top" title="Click to sort">
								 Date
							</th>
                            <th class="tip_top" title="Click to sort">
								 Seller Email
							</th>
							
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($ContactList->num_rows() > 0){
							foreach ($ContactList->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $row->name;?>
							</td>
                            <td class="center">
								<?php echo $row->email;?>
							</td>
                            <td class="center">
								<?php echo $row->dateAdded;?>
							</td>
                            <td class="center">
								<?php echo $row->selleremail;?>
							</td>
							
							<?php if ($allPrev == '1' || in_array('0', $contactseller)){?>
							<td class="center">
								<ul class="action_list"><li style="width:100%;"><a class="p_edit tipTop" href="admin/contactseller/view_contactseller_form/<?php echo $row->id;?>" title="View Details">View Details</a></li></ul>
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
							<th >
								 Contact Name
							</th>
                            <th >
								 Contact Email
							</th>
                            <th>
								 Date
							</th>
                            <th>
								 Seller Email
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
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
$('#contact_seller_tbl').dataTable({   
	 "aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 4 ] }
					],
					"aaSorting": [[2, 'desc']],
	"sPaginationType": "full_numbers",
	"iDisplayLength": 100,
	"oLanguage": {
       "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
   },
	 "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
	 
	});
</script>
<style>
#contact_seller_tbl tr td{border-right:1px solid #ccc;}
</style>
<?php 
$this->load->view('admin/templates/footer.php');
?>