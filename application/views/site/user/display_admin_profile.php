<?php
$this->load->view('site/templates/header',$this->data);
?>
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>profile.css" />
<!-- Section_start -->
<div class="lang-en wider no-subnav">
<div id="container-wrapper">
  <div class="banner-img-section">
    <?php 

      $bannerImg = 'default-banner.png';
      /*if ($userDetails->row()->banner_image != ''){
        $bannerImg = $userDetails->row()->banner_image;
      } else {
        $bannerImg = 'default-banner.png';
      }*/

      if($current_banner_image->num_rows()>0) {
        foreach ($current_banner_image->result() as $value) {
          $bannerImg = $value->banner_image;
        }
      }

        echo '<style type="text/css">
                .usersection .right-sidebar #sidebar {
                  position: absolute;
                  right: 14px;
                  top: -225px;
                }
                .banner-img-section {
                  background: url('. base_url() . '/images/users/' . $bannerImg . ') no-repeat center center;
                  -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;

                    height: 500px;
                }
              </style>';

    ?>

  </div>
  <div class="profile-section">
  </div>
  <div class="container usersection">
    <div class="icon-cache"></div>
    <div id="tooltip"></div>
    <div class="wrapper-content right-sidebar">
      <div id="content">
        <div class="wrapper timeline normal">
          <ul class="user-tab">
            <li><a href="user/administrator" class="current"><b><?php echo LIKED_BUTTON;?></b> <small>0</small></a></li>
          </ul>
          <div class="no-result">
          	<b><?php if($this->lang->line('display_administrator') != '') { echo stripslashes($this->lang->line('display_administrator')); } else echo "administrator"; ?></b> <?php if($this->lang->line('display_has_not') != '') { echo stripslashes($this->lang->line('display_has_not')); } else echo "has not"; ?> <?php echo LIKED_BUTTON;?> <?php if($this->lang->line('display_any_yet') != '') { echo stripslashes($this->lang->line('display_any_yet')); } else echo "anything yet"; ?>.
          </div>
        </div>
        <div id="infscr-loading" style="display:none">
          <span class="loading"><?php if($this->lang->line('display_loading') != '') { echo stripslashes($this->lang->line('display_loading')); } else echo "Loading"; ?>...</span> </div>
      </div>
      <aside id="sidebar">
        <div class="wrapper user-cover">
        <?php 
        $userImg = 'user-thumb1.png';
        $followClass = 'follow';
        if ($loginCheck != ''){
	        $followingListArr = explode(',', $userDetails->row()->following);
	        if (in_array(0, $followingListArr)){
	        	$followClass = 'following';
	        }
        } 
        ?>
          <div class="profile"> <span class="avatar"><span id="user-photo-container"><img src="images/users/<?php echo $userImg;?>" /></span></span>
            <p class="username"><?php if($this->lang->line('display_administrator') != '') { echo stripslashes($this->lang->line('display_administrator')); } else echo "administrator"; ?></p>
            <p class="location"></p>
            <p class="bio"></p>
          </div>
          <ul class="sns-list">
          </ul>
 
      </aside>
    </div>
    <?php 
     $this->load->view('site/templates/footer_menu');
     ?>
    <a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a> </div>
  <!-- / container -->
</div>

</div>
<!-- Section_start -->
<script type="text/javascript" src="js/site/profile_things.js"></script>

<?php
$this->load->view('site/templates/footer');
?>