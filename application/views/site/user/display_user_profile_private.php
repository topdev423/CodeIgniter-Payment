<?php
$this->load->view('site/templates/header',$this->data);
?>
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>profile.css" />


<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>profile.js"></script>

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
      <?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
        <div class="wrapper timeline normal">
          <ul class="user-tab">
          </ul>
          <div class="no-result">
          	<b><?php if($this->lang->line('private_profile') != '') { echo stripslashes($this->lang->line('private_profile')); } else echo "This profile is private"; ?></b>
          </div>
        </div>
<?php
$this->load->view('site/templates/footer_menu');
$this->load->view('site/templates/footer');
?>