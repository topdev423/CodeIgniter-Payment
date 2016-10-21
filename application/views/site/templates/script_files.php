<script type="text/javascript">
		var baseURL = '<?php echo base_url();?>';
		var BaseURL = '<?php echo base_url();?>';
		var likeTXT = '<?php echo addslashes(LIKE_BUTTON);?>';
		var likedTXT = '<?php echo addslashes(LIKED_BUTTON);?>';
		var unlikeTXT = '<?php echo addslashes(UNLIKE_BUTTON);?>';
		var currencySymbol = '<?php echo $currencySymbol;?>';
		var siteTitle = '<?php echo $siteTitle;?>';
		var LOGIN_SUCC_MSG = '<?php echo $login_succ_msg;?>';
		var can_show_signin_overlay = false;
		if (navigator.platform.indexOf('Win') != -1) {document.write("<style>::-webkit-scrollbar, ::-webkit-scrollbar-thumb {width:7px;height:7px;border-radius:4px;}::-webkit-scrollbar, ::-webkit-scrollbar-track-piece {background:transparent;}::-webkit-scrollbar-thumb {background:rgba(255,255,255,0.3);}:not(body)::-webkit-scrollbar-thumb {background:rgba(0,0,0,0.3);}::-webkit-scrollbar-button {display: none;}</style>");}
	</script>
<!--[if lt IE 9]>
<script src="js/site/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filescatalog.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/jquery-1.9.0.min.js"></script>
<script src="js/site/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery-ui-1.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_002.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery.js" type="text/javascript"></script>
<script src="js/site/main4.js" type="text/javascript"></script>
<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filestimeline_slideshow.js" type="text/javascript"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/site/editor-config.js"></script>
<script src="js/validation.js" type="text/javascript"></script>
<script src="js/site/jquery.barrating.js" type="text/javascript"></script>
<script type="text/javascript"> var global_ajax_loader = '<img class="ajax-loader-dy" src="<?php echo site_url('images/ajax-loader-dy.gif'); ?>" />'</script>
<script>
$(document).ready(function(){
    if($('.jquery_notify').length>0){
    
    function noty_count(){
         $.ajax({
            type: "POST",
            url: 'http://www.codebases.com/fancy-v2/site/notify/get_notifycount',
            success: function (result) {
                console.log(result);
                if(result>0){
				$(document).find('.jquery_notify').show();
                $(document).find('.jquery_notify').text(result);
            }else{
                $(document).find('.jquery_notify').hide();
            }
            },
            error: function () {
                $(document).find('.jquery_notify').hide();
            }
        });
    }
    noty_count();
    setInterval(noty_count, 5000);
    }
});
</script>
<script type="text/javascript">
function open_win(){
	window.open("<?php echo base_url();?>twtest/redirect");
	location.reload();
}

/*
 * Language Settings
 */
<?php if ($this->lang->line('shipping_add_ship')!=''){?> 
var lg_add_ship_addr = '<?php echo $this->lang->line('shipping_add_ship');?>';
<?php }else {?>
var lg_add_ship_addr = 'Add Shipping Address';
<?php }?>
<?php if ($this->lang->line('header_new_ship')!=''){?> 
var lg_new_ship_addr = '<?php echo $this->lang->line('header_new_ship');?>';
<?php }else {?>
var lg_new_ship_addr = 'New Shipping Address';
<?php }?>
<?php if ($this->lang->line('header_ships_wide')!=''){?> 
var lg_ships_wide = '<?php echo $this->lang->line('header_ships_wide');?>';
<?php }else {?>
var lg_ships_wide = 'We ships worldwide with global delivery services.';
<?php }?>
/*
 * ******************
 */
</script>
<script type="text/javascript">
    // rating function
$(function() {
    function ratingEnable() {
        
        var currentRating = $('#example-fontawesome-o').data('current-rating');

        $('.stars-example-fontawesome-o .current-rating')
            .find('span')
            .html("<span class='active-rating br-current-rating'>"+currentRating+"</span>/10");

        $('.clear-rating').on('click', function(event) {
            event.preventDefault();

            $('#example-fontawesome-o').barrating('clear');
            var popup_product_id = $(".popup_product_id").val();
            
            
            // sending an ajax call to reset the user rating for the selected product
            $.ajax({
                type:'POST',
                url:baseURL+'site/user/delete_prduct_rating',
                data:{tid:popup_product_id, uid:$("#logged_in_user_id").val()},
                dataType:'json',
                success:function(response){
                    if(response.status_code == 1){
                        // setting the button text to unrated
                        $(".rating-success-message").hide();
                        $("#prod_popup_"+popup_product_id).removeClass("fancyrd");
                        $("#prod_popup_"+popup_product_id).addClass("fancyr");
                        $("#prod_popup_"+popup_product_id).html("<span><i></i></span>Rate it");
                        
                    }
                }
            });     
            
        });
        

        $('#example-fontawesome-o').barrating({
            theme: 'fontawesome-stars-o',
            showSelectedRating: true,
            showValues: false,
            initialRating: currentRating,
            onSelect: function(value, text, event) {
                if(event){
                    if (!value) {
                        $('#example-fontawesome-o').barrating('clear');
                    } 
                    else 
                    {
                        $('.stars-example-fontawesome-o .current-rating').addClass('hidden');
                        $('.stars-example-fontawesome-o .your-rating').removeClass('hidden').find('span').html(value);
                        
                        var tid = $(".popup_product_id").val();
                    
                        // ajax call to add product rating
                        $.ajax({
                            type:'POST',
                            url:baseURL+'site/user/add_prduct_rating',
                            data:{tid:tid, uid:$("#logged_in_user_id").val(), rating:value},
                            dataType:'json',
                            success:function(response){
                                
                                if(response.status_code == 1){
                                    $(".rating-success-message").show();
                                    $("#prod_popup_"+tid).removeClass("fancyr");
                                    $("#prod_popup_"+tid).addClass("fancyrd");
                                    $("#prod_popup_"+tid).html("<span><i></i></span>Rated");
                                    
                                    // hiding the success message after few seconds
                                    setTimeout(function() {
                                        $('.rating-success-message').fadeOut('slow');
                                    }, 1000); // <-- time in milliseconds
                                }
                            }
                        });     
                    }
                }
            },
            onClear: function(value, text) {
                $('.stars-example-fontawesome-o')
                    .find('.current-rating')
                    .removeClass('hidden')
                    .end()
                    .find('.your-rating')
                    .addClass('hidden');
            }
        });
    }

    function ratingDisable() {
        $('select').barrating('destroy');
    }

    $('.rating-enable').click(function(event) {
        event.preventDefault();

        ratingEnable();

        $(this).addClass('deactivated');
        $('.rating-disable').removeClass('deactivated');
    });
    ratingEnable();
});
</script>