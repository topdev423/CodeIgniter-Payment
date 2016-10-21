<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Subadmin</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addsubadmin_form');
						echo form_open('admin/subadmin/insertEditSubadmin',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address</label>
									<div class="form_input">
										<?php echo $admin_details->row()->email;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Sub Admin Name</label>
									<div class="form_input">
										<?php echo $admin_details->row()->admin_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="site_contact_mail"></label>
									<div id="uniform-undefined" class="form_input checker focus">
										<span class="" style="float:left;"><input type="checkbox" class="checkbox" id="selectallseeker" /></span><label style="float:left;margin:5px;">Select all</label>
									</div>
								</div>
								<div style="margin-top: 20px;"></div>
								<div class="form_grid_12">
									<label class="field_title">Mangement Name</label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								            <td align="center" width="15%">View</td>
								             <td align="center" width="15%">Add</td>
								              <td align="center" width="15%">Edit</td>
								               <td align="center" width="15%">Delete</td>
								        </tr>
								    </table>
								</div>
								<input type="hidden" value="<?php echo $admin_details->row()->id;?>" name="subadminid"/>
								<?php  
								for($i=0;$i<sizeof($adminPrevArr); $i++) {
							  	 $subAdmin = $adminPrevArr[$i]; 
							  	 $priv = array();
							  	 if (isset($privArr[$subAdmin])){
								  	 $priv = $privArr[$subAdmin];
							  	 }
							  	 if (!is_array($priv)){
							  	 	$priv = array();
							  	 }
							  	 ?>
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<4; $j++) { ?>
								        	<td align="center" width="15%">
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" <?php if (in_array($j,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $subAdmin.'[]';?>" id="<?php echo $subAdmin.'[]';?>"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
checkboxInit();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>