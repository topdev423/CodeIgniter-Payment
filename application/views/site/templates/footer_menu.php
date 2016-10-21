
<footer id="footer"> 
	
	<?php 
	$widget_name_array = array();
	$widget_link_array = array();
	$widget_icon_array = array();
	$widget_title_array = array();
	foreach($footerWidget as $footerWidgetvaL)
	{
		$widget_title_array[] = $footerWidgetvaL['widget_title'];
		$widget_name_array[] = explode("footsep",$footerWidgetvaL['widget_name']);
		$widget_link_array[] = explode("footsep",$footerWidgetvaL['widget_link']);
		$widget_icon_array[] = explode(",",$footerWidgetvaL['widget_icon']);
	}
		
	?>





<div class="footer_new">


<?php
$loop_start_val =0;
foreach($widget_name_array as $widget_name_arrayVal){  ?>
	<ul class="footer_links">
		<strong> <?php echo $widget_title_array[$loop_start_val]; ?> </strong>
			<?php  
			$loop_start_val_second =0 ;
			foreach($widget_name_arrayVal as $widget_array_single){ 
			?>
			<li>
				<?php 
				if($widget_icon_array[$loop_start_val][$loop_start_val_second]!=''){ 
				?>
				<img src="<?php echo  FOOTERPATH.$widget_icon_array[$loop_start_val][$loop_start_val_second]; ?>" width="20" height="20" /> 
				<?php 
				} 
				if($widget_link_array[$loop_start_val][$loop_start_val_second]==''){ 
					echo $widget_name_array[$loop_start_val][$loop_start_val_second];
				}else { 
				?> 
				<a href="<?php echo prep_url($widget_link_array[$loop_start_val][$loop_start_val_second]); ?>" style = "color:#b8b0b0;">
					<?php echo $widget_name_array[$loop_start_val][$loop_start_val_second]; ?>
				</a>
				<?php 
				}
				?>
			</li>

		<?php 
				$loop_start_val_second = $loop_start_val_second+1; 
			}
			$loop_start_val = $loop_start_val+1;
		?>
	</ul>
	<?php } ?>
</div> 
<div class="footer_new">   
<?php
	if (count($cmsPages)>0){
		?>
      <ul class="bottom_links" style = "color:#b8b0b0 !important;">|
      <?php
		foreach ($cmsPages as $cmsRow){
			if ($cmsRow['category'] == 'Main'){ 
		?>
        	<li><a href="pages/<?php echo $cmsRow['seourl'];?>" style = "color:#b8b0b0 !important;"><?php echo $cmsRow['page_name'];?></a>|</li>
        <?php 
			}
		}
        ?>	
        </ul>
        <?php }?>
	<p class="copy_rights"><?php echo $footer;?></p>
</div>

 </footer>

<?php 
if ($loginCheck==''){
	$force_login = '';
	$controlview = $layoutList->result_array();
	if($controlview[0]['popup_control'] == 'on' && $loginCheck==''){
		$force_login = 'force';
	}
?>
<script type="text/javascript">

var popup = '<?php  echo $force_login; ?>';
$(function(){
	if(popup == 'force'){
		$('.btn-close').hide();
		$('a').not('.popup-signup-ajax,.mn-signin,.pp-login,h1.logo a,#scroll-to-top,.forgot-pwd,.anyway a').click(function(e){
			e.preventDefault();
			$('.popup-signup-ajax').trigger('click');
		});
	}
	if(popup == 'soft'){
		<?php 
		//$this->session->unset_userdata('user_ses');
		$user_ses = $this->session->userdata('user_ses');
		if (!$user_ses){
		?>
		$('a').not('.popup-signup-ajax,.mn-signin,.pp-login,h1.logo a,#scroll-to-top,.forgot-pwd').click(function(e){
			<?php
			$user_ses = $this->session->userdata('user_ses');
			if (!$user_ses){
			?>
			e.preventDefault();
			$('.popup-signup-ajax').trigger('click');
			$('.btn-close').show();
			<?php
			}
			?>
		});
		$('.btn-close').click(function(){window.location.reload();});
		<?php 	
			$this->session->set_userdata('user_ses','1');
		}
		?>
	}
});
</script>
<?php 
}
?>
<!-- / footer -->
