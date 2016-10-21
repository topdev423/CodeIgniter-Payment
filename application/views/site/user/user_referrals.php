<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<!-- Section_start -->
<div id="container-wrapper">
	<div class="container set_area">
		<div id="content">
		<h2 class="ptit"><?php if($this->lang->line('referrals_common') != '') { echo stripslashes($this->lang->line('referrals_common')); } else echo "Referrals"; ?></h2>
        
        
        
        <?php 
                if(!empty($getReferalList)){
                ?>	
                <div class=" section gifts">
            <h3><?php if($this->lang->line('referrals_history') != '') { echo stripslashes($this->lang->line('referrals_history')); } else echo "Your referrals history."; ?></h3>
                	<div class="chart-wrap">
            <table class="chart">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('referrals_thumbnail') != '') { echo stripslashes($this->lang->line('referrals_thumbnail')); } else echo "Thumbnail"; ?></th>
                        <th><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Full Name"; ?></th>
                        <th><?php if($this->lang->line('signup_user_name') != '') { echo stripslashes($this->lang->line('signup_user_name')); } else echo "Username"; ?></th>
                        <th><?php if($this->lang->line('referrals_email') != '') { echo stripslashes($this->lang->line('referrals_email')); } else echo "Email"; ?></th>                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getReferalList as $referalList){
                    	$img = 'user-thumb1.png';
                    	if ($referalList['thumbnail'] != ''){
                    		$img = $referalList['thumbnail'];
                    	}
                    ?>
                    <tr>
                        <td><img src="images/users/<?php echo $img;?>" width="50px"/></td>
                        <td><?php echo $referalList['full_name'];?></td>
                        <td><?php echo $referalList['user_name'];?></td>                        
                        <td><?php echo $referalList['email'];?></td>
                        
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
            
			</div>
             <?php echo $paginationLink; ?>
			</div>
           
                <?php	
                }else {
                ?>
               <div class="section referral no-data">
            <span class="icon"><i class="ic-referral"></i></span>
            <p><?php if($this->lang->line('referrals_not_invite') != '') { echo stripslashes($this->lang->line('referrals_not_invite')); } else echo "You havn't invited anyone yet."; ?></p>
        </div>
                <?php 
                }
                ?>

        

	</div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
     $this->load->view('site/templates/side_footer_menu');
     ?>
	</div>
	<!-- / container -->
</div>
</div>

<!-- Section_start -->
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>
<script>
	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<?php 
$this->load->view('site/templates/footer');
?>
