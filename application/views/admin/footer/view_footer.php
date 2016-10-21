<?php
$this->load->view('admin/templates/header.php');
$DataFooterVals = $this->data['DataFooterVal']->result_array();

	$widget_name_array = array();
	$widget_link_array = array();
	$widget_icon_array = array();
	$widget_title_array = array();
			foreach($DataFooterVals as $DataFooterValss){	
					$widget_name_array[] = explode("footsep",$DataFooterValss['widget_name']);
					$widget_link_array[] = explode("footsep",$DataFooterValss['widget_link']);
					$widget_icon_array[] = explode(",",$DataFooterValss['widget_icon']);
				} 
				
				
				?>
<div id="content">
		<div class="grid_container">
        <div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $DataFooterVals[0]['widget_title']; ?>
</h6>
					</div>
					
						<table class="display" id="subscriber_tbl">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								 Name
							</th>
							<th>
								Link
							</th>
                            	<th>
								Icon
							</th>
						</tr>
						</thead>
						<tbody>

		<?php $loop_start_val =0;
			foreach($widget_name_array as $widget_name_arrayVal){ 
				$loop_start_val_second =0 ;
					foreach($widget_name_arrayVal as $widget_array_single){ ?>
						<tr>
							
                            <td class="center">
								<?php  echo $widget_name_array[$loop_start_val][$loop_start_val_second];?>
							</td>
                            <td class="center">
									<a href="<?php echo $widget_link_array[$loop_start_val][$loop_start_val_second] ?>"><?php echo $widget_link_array[$loop_start_val][$loop_start_val_second]; ?></a>
							</td>
                            <td class="center">
									<img src="<?php echo FOOTERPATH.$widget_icon_array[$loop_start_val][$loop_start_val_second]; ?>" width ="30" height="30" ></a>
							</td>
				<?php $loop_start_val_second = $loop_start_val_second+1;}
 			$loop_start_val = $loop_start_val+1; } ?>
						</tr>
						</tbody>
						<tfoot>
							<tr>
						 
							<th class="tip_top" title="Click to sort">
								 Name
							</th>
                            <th>
								 Link
							</th>
                            	<th>
								Icon
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
                <li>
                	<div class="form_grid_12">
						<div class="form_input">
							<a href="admin/footer/display_footer_list" class="tipLeft" title="Go to widget list"><span class="badge_style b_done">Back</span></a>
							</div>
						</div>
             	   </li>
				</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>