<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $FancyyList->num_rows();?> Subscription box subscribed from this site</h4>
							<table>
							<tbody>
							<tr>
								<td><b>Subscription Box Name</b></td>
								<td><b>Subscription Count</b></td>
							</tr>
           					<?php foreach ($FancyyCount->result() as $row){ ?>
                            <tr>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->totCount; ?></td>
							</tr>
                            <?php } ?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon image_1"></span>
						<h6>Recent Subscription Box Subscription</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 User Name
							</th>
							<th>
								 Subscription Name
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Status
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($FancyyList->num_rows() > 0){
							foreach($FancyyList->result() as $fancyrow){

						?>
						<tr class="tr_even">
							<td>
								 <?php echo $fancyrow->full_name;?>
							</td>
							<td>
								 <?php echo $fancyrow->name;?>
							</td>
							<td>
								 <?php echo $fancyrow->indtotal;?>
							</td>
							<td>
							<?php 
							
							if ($fancyrow->status == 'Paid'){?>
								<span class="badge_style b_done">Paid</span>
							<?php }else {?>
								<span class="badge_style b_pending">Pending</span>
							<?php }?>
							</td>
						</tr>
						<?php 
								}
						
						}else {
						?>
						<tr>
							<td colspan="5" align="center">No Subscription Available</td>
						</tr>
						<?php }?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>