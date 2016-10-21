<?php
$this->load->view('admin/templates/header.php');
?>




<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
                        <div id="widget_tab">
              				<ul>
               			
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
                    <form action="admin/layout/EditThemeLayoutProcess" method="post" id="themeEditForm" class = "form_container left_label" >
                     <div id="tab1">
						<ul>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="value"><?php echo str_replace(array('_','bg'), array(' ','background'), $themeDetail->row()->name); ?><span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="value" id="value" tabindex="9"  value = "<?php echo $themeDetail->row()->value; ?>" class="large tipTop" title="Please enter the value" /> 
								</div>
								</div>
							</li>
                            
								
								
							</ul>
                     </div>
                      
                      
                      <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
				</div>
			</div></li></ul>
                    <input type="hidden" id ="theme_id" name="theme_id" value="<?php echo $themeDetail->row()->id; ?>"/>  
            
						</form>
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
<script type="text/javascript">
$('#themeEditForm').validate();
$('#value').colorpicker()	
</script>