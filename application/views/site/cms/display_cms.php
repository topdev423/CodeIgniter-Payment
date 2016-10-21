<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" type="text/css" media="all" href="css/site/cms.css">

<div class="lang-en wider no-subnav thing signed-out winOS" data-twttr-rendered="true" >
 <div id="container-wrapper">
	<div class="container ">
		
		<div class="wrapper-content right-sidebar">			
			<div class="content_text" style="width:890px;">
            	<?php 
            	if ($pageDetails->num_rows()>0){
            		echo $pageDetails->row()->description;
            	}
            	?>
            </div>
		</div>
		<!-- / wrapper-content -->

		

		

		


		
		<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a id="scroll-to-top" href="#header" style="display: none;"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<!-- / container -->
</div>

</div>
<?php
$this->load->view('site/templates/footer');
?>