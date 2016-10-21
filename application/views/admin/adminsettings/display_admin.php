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
					</div>
					<div class="widget_content">
						<table class="display data_editable">
						<thead>
						<tr>
							<th class="tip_top" title="Click to sort">
								 Admin Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Email
							</th>
							<th class="tip_top" title="Click to sort">
								Admin Type
							</th>
							<th class="tip_top" title="Click to sort">
								Last Login Date
							</th>
							<th class="tip_top" title="Click to sort">
								Last Logout Date
							</th>
							<th class="tip_top" title="Click to sort">
								Last Login IP
							</th>
							<th class="tip_top" title="Click to sort">
								Status
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($admin_users->num_rows() > 0){
							foreach ($admin_users->result() as $row){
						?>
						<tr>
							<td class="center">
								<?php echo $row->admin_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
							<td class="center">
								<?php echo ucfirst($row->admin_type).' Admin';?>
							</td>
							<td class="center">
								 <?php echo $row->last_login_date;?>
							</td>
							<td class="center">
								 <?php echo $row->last_logout_date;?>
							</td>
							<td class="center">
								<?php echo $row->last_login_ip;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $admin)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
									if ($row->id == '1'){
							?>
								<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }else {?>
								<a href="javascript:confirm_status('admin/adminlogin/change_admin_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
							}
								}else {	
							?>
								<a href="javascript:confirm_status('admin/adminlogin/change_admin_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
								<span class="badge_style b_done"><?php echo $row->status;?></span>
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
							<th>
								 Admin Name
							</th>
							<th>
								 Email
							</th>
							<th>
								Admin Type
							</th>
							<th>
								Last Login Date
							</th>
							<th>
								Last Logout Date
							</th>
							<th>
								Last Login IP
							</th>
							<th>
								 Status
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
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>