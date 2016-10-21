<?php   $this->load->view('site/templates/header');?>

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
    
      <?php echo trim_slashes($breadCumps); ?>
      <div class="sns-right"> </div>
      
      <div id="content">
      
        <div class="search-frm">
          <div class="search">
          
            <?php echo $listSubCatSelBox;  ?>
            
            <select style="display: none;" class="shop-select price-range selectBox">
             <option value=""><?php if($this->lang->line('product_any_price') != '') { echo stripslashes($this->lang->line('product_any_price')); } else echo "Any Price"; ?></option>	
              <?php foreach ($pricefulllist->result() as $priceRangeRow){ ?>
                 
               <option <?php if($_GET['p']==url_title($priceRangeRow->price_range)){ echo 'selected="selected"'; } ?> value="<?php echo url_title($priceRangeRow->price_range); ?>"><?php echo $currencySymbol;?> <?php echo $priceRangeRow->price_range; ?></option>
           <?php } ?>
            </select>
            <select style="display: none;" class="shop-select color-filter selectBox">
              <option value="" selected="selected"><?php if($this->lang->line('product_any_color') != '') { echo stripslashes($this->lang->line('product_any_color')); } else echo "Any Color"; ?></option>
              <?php 
                      foreach ($mainColorLists->result() as $colorRow){
                      	if ($colorRow->list_value != ''){
                      ?>
              <option <?php if($_GET['c']==url_title($colorRow->list_value)){ echo 'selected="selected"'; } ?> value="<?php echo strtolower($colorRow->list_value);?>"><?php echo ucfirst($colorRow->list_value);?></option>
              <?php 
                      	}
                      }
              ?>
            </select>
            <select style="display: none;" class="shop-select sort-by-price selectBox">
              <option selected="selected" value=""><?php if($this->lang->line('product_rating') != '') { echo stripslashes($this->lang->line('product_rating')); } else echo "Rating"; ?></option>
              <option <?php if(isset($_GET['sort_by_price']) && $_GET['sort_by_price']=="new"){ echo 'selected="selected"'; } ?> value="new"><?php if($this->lang->line('product_newest') != '') { echo stripslashes($this->lang->line('product_newest')); } else echo "Newest"; ?></option>
              <option <?php if(isset($_GET['sort_by_price']) && $_GET['sort_by_price']=="asc"){ echo 'selected="selected"'; } ?> value="asc"><?php if($this->lang->line('product_low_high') != '') { echo stripslashes($this->lang->line('product_low_high')); } else echo "Price: Low to High"; ?></option>
              <option <?php if(isset($_GET['sort_by_price']) && $_GET['sort_by_price']=="desc"){ echo 'selected="selected"'; } ?> value="desc"><?php if($this->lang->line('product_high_low') != '') { echo stripslashes($this->lang->line('product_high_low')); } else echo "Price: High to Low"; ?></option>
            </select>
            <label for="immediateShipping" class="shipping-filter button-wrapper tooltip "> <span class="quick-shipping"> <span class="icon truck"></span> </span>
            <input type="checkbox" value="true" name="is" id="immediateShipping"  />
            <i></i><b><?php if($this->lang->line('product_ship_immed') != '') { echo stripslashes($this->lang->line('product_ship_immed')); } else echo "Items that ship immediately"; ?></b> </label>
            <span class="label"><i class="ic-search"></i><em class="hidden"><?php if($this->lang->line('header_search') != '') { echo stripslashes($this->lang->line('header_search')); } else echo "Search"; ?></em></span> <a href="#" class="del-val"><i class="ic-del"></i><em class="hidden"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></em></a>
            <input style="width:110px;" class="search-string" type="text"  placeholder="<?php if($this->lang->line('product_filter_key') != '') { echo stripslashes($this->lang->line('product_filter_key')); } else echo "Filter by keyword"; ?>" />
          </div>
          <div class="sorting"> </div>
        </div>
        <?php if ($productList->num_rows()>0){?>
        <ol class="stream">
         <?php foreach ($productList->result() as $productListVal) { 
        	$img = 'dummyProductImage.jpg';
			$imgArr = explode(',', $productListVal->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
						$img = $pimg = $imgRow;
						break;
					}
				}
			}
            
            // checking if the product has already been rated by the user.
            $fancyClass = 'fancyr';
            $fancyText = LIKE_BUTTON;
            if($ratedProducts && count($ratedProducts)>0){
                if(array_key_exists($productListVal->seller_product_id, $ratedProducts)){
                    $fancyClass = 'fancyrd';
                    $fancyText = LIKED_BUTTON;
                }
            }
		 ?>
          <li>
            <div class="figure-product-new mini"> <a href="things/<?php echo $productListVal->id;?>/<?php echo url_title($productListVal->product_name,'-');?>">
              <figure><img src="images/product/<?php echo $img; ?>"> </figure>
              <figcaption><?php echo $productListVal->product_name;?></figcaption>
              </a> <span class="username"><b class="price"><?php echo $currencySymbol;?><?php echo $productListVal->sale_price;?></b></span>
              
              <a id="prod_popup_<?php echo $productListVal->seller_product_id; ?>" href="#" class="button <?php echo $fancyClass;?>" tid="<?php echo $productListVal->seller_product_id;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> item_img_url="images/product/<?php echo $img;?>" rating="true"><span><i></i></span><?php echo $fancyText;?></a> </div>
          </li>
         <?php } ?>
        </ol>
        
        <div class="pagination" style="display:none">
        <?php echo $paginationDisplay; ?>
        </div>
        <?php }else {?>
        <ol class="stream">
        <li style="width: 100%;"><p class="noproducts"><?php if($this->lang->line('product_no_more') != '') { echo stripslashes($this->lang->line('product_no_more')); } else echo "No more products available"; ?></p></li>
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
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>shoplist.js" type="text/javascript"></script>
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
<script>
    //emulate behavior of html5 textarea maxlength attribute.
    jQuery(function($) {
        $(document).ready(function() {
            var check_maxlength = function(e) {
                var max = parseInt($(this).attr('maxlength'));
                var len = $(this).val().length;
                if (len > max) {
                    $(this).val($(this).val().substr(0, max));
                }
                if (len >= max) {
                    return false;
                }
            }
            $('textarea[maxlength]').keypress(check_maxlength).change(check_maxlength);
            
            
        });
    });
</script>
<?php
$this->load->view('site/templates/footer');
?>
