<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
		
			<div class="grid_12">
				<div class="widget_wrap">
					
					<div class="widget_content">
                    <form name="controlchange" id="controlchange" method="post" action="admin/layout/changecontrol">
						<table class="display display_tbl" id="control_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								Sno
							</th>
							
                            <th class="tip_top" title="Click to sort">
							 Name
							</th>
							<th>
							 Option
							</th>
                            <th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							
							
							<td class="center">
							1
							</td>
							
							<td class="center">
							Home Layout
							</td>
                            <td class="center">
                            <input name="home_control" type="radio" value="classic" <?php if($controlList->row()->home_control == 'classic'){ ?> checked="checked"<?php  } ?> id="classic"/><label for="classic">Classic</label>
                            &nbsp;<input name="home_control" type="radio" value="grid" <?php if($controlList->row()->home_control == 'grid'){ ?> checked="checked"<?php  } ?> id="grid"/><label for="grid">Grid</label>
                            &nbsp;<input name="home_control" type="radio" value="compact" <?php if($controlList->row()->home_control == 'compact'){ ?> checked="checked"<?php  } ?> id="compact"/><label for="compact">Compact</label>
						
                            
                            
							</td>
                   
							<td class="center">
							
								<span><input type="submit" class="btn_small btn_blue" style="height: auto !important;border: 1px solid blue;" name="control" value="change"  /></span>
 	
						</tr>
						<tr>
							
							
							<td class="center">
							2
							</td>
							<td class="center">
							Force Login
							</td>
                            <td class="center">
                             <input name="popup_control" type="radio" value="on" <?php if($controlList->row()->popup_control == 'on'){ ?> checked="checked" <?php } ?> id="popup_on"/><label for="popup_on">ON</label>
                             &nbsp;<input name="popup_control" type="radio" value="off" <?php if($controlList->row()->popup_control == 'off'){ ?> checked="checked" <?php } ?> id="popup_off"/><label for="popup_off">OFF</label>
                            
							</td>
                   
							<td class="center">
							
								<span><input type="submit" class="btn_small btn_blue" style="height: auto !important;border: 1px solid blue;" name="control" value="change"  /></span>
 	
						</tr>
						<tr>
							
							
							<td class="center">
							3
							</td>
							<td class="center">
							Home Page Products
							</td>
                            <td class="center">
                             <input name="product_control" type="radio" value="selling" <?php if($controlList->row()->product_control == 'selling'){ ?> checked="checked" <?php } ?> id="selling"/><label for="selling">Selling</label>
                             &nbsp;<input name="product_control" type="radio" value="affiliates" <?php if($controlList->row()->product_control == 'affiliates'){ ?> checked="checked" <?php } ?> id="affiliate"/><label for="affiliate">Affiliates</label>
                             &nbsp;<input name="product_control" type="radio" value="both" <?php if($controlList->row()->product_control == 'both'){ ?> checked="checked" <?php } ?> id="both"/><label for="both">Both</label>
                            
							</td>
                   
							<td class="center">
							
								<span><input type="submit" class="btn_small btn_blue" style="height: auto !important;border: 1px solid blue;" name="control" value="change"  /></span>
 	
						</tr>
						</tbody>
						<tfoot>
							<tr>
						
                             <th>
							 Sno
							</th>
                             <th>
							 Name
							</th>
							<th>
							 Option
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
		</form>	
					</div>
				</div>
			</div>
		
			
		</div>
		<span class="clear"></span>
	</div>
	
<style>
#control_tbl tr td{
	border-right:#ccc 1px solid;
}
</style>	
<script>
$('#control_tbl').dataTable({   
	"aoColumnDefs": [
	                 { "bSortable": false, "aTargets": [ 2,3 ] }
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