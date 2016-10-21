<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<form method="post" name="insert_sitemap_values" action="admin/sitemapcreate/insert_sitemap_values" id="insert_sitemap_values">
            
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
									<div class="form_grid_12">
									<div class="form_input">
										<button class="btn_small btn_blue" type="submit"><span>Create Site Map</span></button>
									</div>
								</div>
						</div>
					</div>
					<div class="widget_content">
						<table class="display" id="userListTbl">
						<thead>
						<tr>
							<th class="center">
								Number
							</th>
							<th class="tip_top" title="Click to sort">
								Filename
							</th>
							<th class="tip_top" title="Click to sort">
								 Last modification
							</th>
							<th class="tip_top" title="Click to sort">
								 Change frequency
							</th>
							<th>
								Priority
							</th>												
						</tr>
						</thead>
						<tbody>
					<?php 
					$startNumber = 0;
					foreach($siteMapvalues as $sitemapkey=>$sitemapval)
					{					 
						foreach($sitemapval['links'] as $key=>$val)
						{	
					?>
						<tr>
							<td class="center tr_select ">
								<input name="unique_row_id[]" type="checkbox" id="unique_row_id<?php echo $startNumber;?>" value="<?php echo $startNumber;?>" checked="checked">
							</td>
							<td class="center">
								<?php echo $val['link_url'];?><input type="hidden" name="site_map_link_det[]" value="<?php echo $val['link_url'];?>" id="site_map_link_det<?php echo $startNumber;?>" />
							</td>
							<td class="center">
								<input type="text" name="site_map_modification_det[]" value="<?php echo date('Y/m/d H:i:s');?>" id="site_map_modification_det<?php echo $startNumber;?>" />
							</td>
							<td class="center">
								<select name="change_frequency[]" id="change_frequency<?php echo $startNumber;?>">
                                    <option value="weekly">weekly</option>
                                    <option value="always">always</option>
                                    <option value="hourly">hourly</option>
                                    <option value="daily">daily</option>
                                    <option value="monthly">monthly</option>
                                    <option value="yearly">yearly</option>
                                    <option value="never">never</option>
                                </select>
							</td>
							<td class="center">
							<select name="change_priority[]" id="change_priority<?php echo $startNumber;?>"> 
                                <option value="1.0">1.0</option>
                                <option value="0.9">0.9</option>
                                <option value="0.8">0.8</option>
                                <option value="0.7">0.7</option>
                                <option value="0.6">0.6</option>
                                <option value="0.5">0.5</option>
                                <option value="0.4">0.4</option>
                                 <option value="0.3">0.3</option>
                                <option value="0.2">0.2</option>
                                <option value="0.1">0.1</option>
                                 <option value="0.0">0.0</option>
                            </select>
							</td>						
						</tr>
						<?php
								$startNumber = $startNumber +1;
							}							
						} 	
						?>

						</tbody>
						<tfoot>
                            <tr>
							<th class="center">
								Number
							</th>
							<th class="tip_top" title="Click to sort">
								Filename
							</th>
							<th class="tip_top" title="Click to sort">
								 Last modification
							</th>
							<th class="tip_top" title="Click to sort">
								 Change frequency
							</th>
							<th>
								Priority
							</th>
<!-- 							
 -->												
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>