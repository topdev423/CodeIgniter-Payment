<?php
$this->load->view('site/templates/header',$this->data);
?>
<div id="container-wrapper">
	<div class="container notify" style="width:940px;">
		


	<div id="content">
		
		<div class="notifications altered">
			<h2><?php if($this->lang->line('referrals_notification') != '') { echo stripslashes($this->lang->line('referrals_notification')); } else echo "Notifications"; ?></h2>
			<?php 
			echo $notyList;
			?>
            
		</div>
		
		<hr>
	</div>
   		
		<?php 
		$this->load->view('site/templates/footer_menu',$this->data);
		?>
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>

	</div>
	<!-- / container -->
</div>
<?php
$this->load->view('site/templates/footer',$this->data);
?>
