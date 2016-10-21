<?php
$this->load->view('admin/templates/header.php');
?>
<style>
#sitemap_frame{
	width: 100%;
	overflow: hidden;
	border: none;
}
</style>
<div id="content">
		<div class="grid_container">
			
            
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>						
					</div>
					<div class="widget_content">
                        <iframe name="sitemap_frame" id="sitemap_frame" src="<?php echo base_url().'sitemap';?>" onload="resizeIframe(this)"></iframe>
					</div>
				</div>
			</div>
			
		
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
  function resizeIframe(iframe) {
    iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
</script>  
<?php 
$this->load->view('admin/templates/footer.php');
?>