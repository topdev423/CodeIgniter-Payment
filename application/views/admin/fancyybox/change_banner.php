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
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'change_banner_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/fancyybox/change_banner',$attributes) ;
					?>
                    
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="fancyybox_banner">Image</label>
							<div class="form_input">
								<input name="fancyybox_banner" id="fancyybox_banner" type="file" tabindex="1" class="large tipTop" title="Please select the banner image"/>
								<p style="padding: 0;margin: 0;" class="notification green">Image Size 890 x 420 pixel</p>
							<br/>
							<?php 
							if ($this->config->item('fancyybox_banner') != ''){
							?>
							<img src="images/giftcards/<?php echo $this->config->item('fancyybox_banner');?>" style="max-width: 400px;max-height: 200px;"/>
							<?php 
							}
							?>
							</div>
							</div>
							</li>
						
			          <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Change</span></button>
				</div>
			</div></li></ul>
                      
            
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