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
                        <div class="grid_6">
                        <div class="widget_wrap">
                            <div class="widget_top">
                                <span></span>
                                <h6>Sitemap creation successful</h6>
                            </div>
                            <div class="widget_content">
                                <div class="user_list">
                                                        <div class="user_block">
                                    <p>Successful: Sitemap successfuly created and saved to <a href="sitemap.xml" target="_blank">sitemap.xml!</a></p>
                                </div>
                                                        </div>
                            </div>
                        </div>
                    </div>
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