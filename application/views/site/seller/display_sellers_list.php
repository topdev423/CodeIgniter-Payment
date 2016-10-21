<?php
$this->load->view('site/templates/header');
?>

<style type="text/css">
ol.stream {
	position: relative;
}
ol.stream.use-css3 li.anim {
transition:all .25s;
-webkit-transition:all .25s;
-moz-transition:all .25s;
-ms-transition:all .25s;
	visibility:visible;
	opacity:1;
}
ol.stream.use-css3 li {
	visibility:hidden;
}
ol.stream.use-css3 li.anim.fadeout {
	opacity:0;
}
ol.stream.use-css3.fadein li {
	opacity:0;
}
ol.stream.use-css3.fadein li.anim.fadein {
	opacity:1;
}
.noproducts {
	float: left;
	width: 90%;
	padding: 5%;
	text-align: center;
	font-size: 25px;
	font-family: cursive;
}
</style>

<script type="text/javascript">
		var can_show_signin_overlay = false;
		if (navigator.platform.indexOf('Win') != -1) {document.write("<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>");}
	</script>
<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
</head><body class="lang-en no-subnav wider winOS">
<!-- header_start -->
<!-- header_end -->
<!-- Section_start -->
<div id="container-wrapper">
  <div class="container shop">
    <div class="outside"> </div>
    <div class="wrapper-content list">
      <h2 style="padding: 20px 0 0 0;font-size: 25px;"><?php if($this->lang->line('shops_brands') != '') { echo stripslashes($this->lang->line('shops_brands')); } else echo "Shops and Brands"; ?></h2>
      <hr style="height: 1px;background: rgb(233, 226, 226);margin-top: 20px;display:block;">
      <div class="sns-right"> </div>
      <div id="content">
        <div class="search-frm">
        </div>
        <?php if ($sellers_list->num_rows()>0){?>
        <ol class="stream">
         <?php foreach ($sellers_list->result() as $productListVal) { 
        	$img = 'default_user.jpg';
			if ($productListVal->thumbnail != ''){
				$img = $productListVal->thumbnail;
			}
			$store_name = $productListVal->brand_name;
			if ($store_name == ''){
				$store_name = $productListVal->full_name;
			}
			if ($store_name == ''){
				$store_name = $productListVal->user_name;
			}
		?>
          <li>
            <div class="figure-product-new mini"> <a href="user/<?php echo $productListVal->user_name;?>/added">
              <figure><img src="images/users/<?php echo $img; ?>"> </figure>
              <figcaption><?php echo $store_name;?></figcaption>
              </a> <span class="username"><b class="price"><?php echo $productListVal->products;?> <?php if($this->lang->line('products') != '') { echo stripslashes($this->lang->line('products')); } else echo "products"; ?></b></span>
          </li>
         <?php } ?>
        </ol>
        
        <?php }else {?>
        <ol class="stream">
        <li style="width: 100%;"><p class="noproducts"><?php if($this->lang->line('no_shops_avail') != '') { echo stripslashes($this->lang->line('no_shops_avail')); } else echo "No shops available"; ?></p></li>
        </ol>
        <?php }?>
      </div>
     <?php 
     $this->load->view('site/templates/footer_menu');
     ?>
      <a style="display: none;" href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a> </div>
    <!-- / container -->
  </div>
  <!-- / container -->
</div>
<!-- Section_start -->
<script src="js/site/<?php echo SITE_COMMON_DEFINE;?>shoplist.js" type="text/javascript"></script>

<?php
$this->load->view('site/templates/footer');
?>
