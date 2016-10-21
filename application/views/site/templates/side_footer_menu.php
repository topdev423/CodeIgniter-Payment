<footer id="footer">
			<ul class="footer-nav">
				<li><?php echo $siteTitle;
				?> &copy; 2013</li>
				<?php 
		         if (count($cmsPages)>0){
		        ?>
		        <?php 
		        foreach ($cmsPages as $cmsRow){
		            if ($cmsRow['category'] == 'Main'){
		        ?>
		          <li><a href="pages/<?php echo $cmsRow['seourl'];?>"><?php echo $cmsRow['page_name'];?></a></li>
		        <?php 
		            }
		        }
		        ?>  
		        <?php 
		         }
		        ?>
			</ul>
			<!-- / footer-nav -->
		</footer>
		<!-- / footer -->
		<a style="display: inline;" href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>