jQuery(function($){
	$('#subscribe').click(function(){
		var require_login = $(this).attr('require_login');
		if (typeof(login_require) != undefined && login_require != null && login_require=='true'){
			require_login();
			return false;
		}

		var theform = $('#subscription_form');
		theform.submit();
	});
	
	$('#content,#sidebar,#popup_container').delegate('#add_to_cart,.add_to_cart','click',function(event){

		event.preventDefault();
	        if ($(this).hasClass('soldout')) {
		    return;
	        }
 	        if ($(this).attr('id') == 'fancy-g-link') {
		    return true;
		}

		var $this = $(this), login_require = $this.attr('require_login'); 
		

		var param = {}, i, c, q, prefix;
		var is_fancybox = ($this.attr('stype') == 'fancybox');

		param['seller_id'] = $this.attr('sisi');
		param['quantity']  = 1;
        param['thing_id'] = $this.attr('tid');

		prefix = $this.attr('prefix') || '';
		if(prefix) prefix += '-';

		if (is_fancybox) {
		        var has_categories = $this.attr('has_categories') == 'true';
			var allow_multiple = $(this).attr('allow_multiple') == 'true';
			var categories = [];
			var note = $('textarea[id=note]').val();
		        if (has_categories) {
			    $('.fancybox-category input[name=categories]:checked').each(function(){categories.push($(this).val())});
			    if (categories.length < 3) {
				alert(gettext('Please choose at least three categories.'));
				return false;
			    }
			}
			param['sale_item_id'] = $('select[name=sale_item_id]').val();
			param['categories'] = categories.join(',');
			param['is_fancybox'] = is_fancybox;
			param['allow_multiple'] = allow_multiple;
			if (note) {
				param['note'] = note.trim();
			}
		} else {
			// quantity
			q = parseInt($('#'+prefix+'quantity').val());
			if(isNaN(q) || q <= 0) return alert(gettext('Please select a valid quantity.'));
			param['quantity'] = q;

			// option
			if($('#'+prefix+'option_id').length) {
				param['option_id'] = $('#'+prefix+'option_id').val();
			}

			param['sale_item_id'] = $this.attr('sii');
		}
        
        if (typeof(login_require) != undefined && login_require != null && login_require=='true'){ 
            $.jStorage.set('fancy_add_to_cart', param);  
            $.dialog('signin-overlay').open();
			return;
		}

		if($this.hasClass('loading')) return;
		$this.addClass('loading');

		try{ clicky.log('/add_item_to_cart.json') }catch(e){};

		$.ajax({
			type : 'POST',
			url  : '/add_item_to_cart.json',
			data : param,
			success : function(json){
				if(!json || json.status_code == undefined) return;
				if(json.status_code == 1){
					var args = {
						'THING_ID':$this.attr('tid'),
						'ITEMCODE':json.itemcode,
						'THUMBNAIL_IMAGE_URL':json.image_url,
						'ITEMNAME':json.itemname,
						'QUANTITY':json.quantity,
						'PRICE':json.price,
						'OPTIONS':json.option
					};
                    if (is_fancybox) {
						Fancy.Cart.addItem(args);
						$('textarea#note').val('');
						$('.fancybox-category input[name=categories]:checked').prop('checked',false);
					} else {
						Fancy.Cart.addItem(args);
					}
					Fancy.Cart.openPopup();

				} else if(json.status_code == 0){
					if(json.message) alert(json.message);
				}
			},
			complete : function(){
				$this.removeClass('loading');
			}
		});
	});

	var $btnAddToCart = $('.add_to_cart');
    var login_require = $btnAddToCart.attr('require_login'); 

    if (typeof(login_require) == "undefined"){ 
        var param = $.jStorage.get('fancy_add_to_cart', null);
        if (param) {
            $.ajax({
                type : 'POST',
                url  : '/add_item_to_cart.json',
                data : param,
                success : function(json){
                    if(!json || json.status_code == undefined) return;
                    if(json.status_code == 1){
                        var args = {
                            'THING_ID':param['thing_id'],
                            'ITEMCODE':json.itemcode,
                            'THUMBNAIL_IMAGE_URL':json.image_url,
                            'ITEMNAME':json.itemname,
                            'QUANTITY':json.quantity,
                            'PRICE':json.price,
                            'OPTIONS':json.option
                        };
                        Fancy.Cart.addItem(args);
                        Fancy.Cart.openPopup();
                    } else if(json.status_code == 0){
                        if(json.message) alert(json.message);
                    }
                },
                complete : function(){
                    $.jStorage.deleteKey('fancy_add_to_cart');
                }
            });
        }
    }


	$('.same-delivery .same-day-shipping-pop').click(function(){
		var require_login = $(this).attr('require_login');
		if (typeof(login_require) != undefined && login_require != null && login_require=='true'){
			require_login();
			return false;
		}
        $.dialog('delivery-popup').open();

	});
	$('.delivery-popup .check-same-day-shipping').click(function(){
        var zip = $(this).parents('.delivery-popup').find('input.zipcode').val().trim();
        $('.delivery-popup p.comment').remove();
        $('.delivery-popup p.notify-delivery').remove();
		var param = {};
        if (zip.length>0){
            /*
		    $.post("/",param, 
		    function(response){
			    if (response.status_code != undefined && response.status_code == 1) {
			    }
			    else if (response.status_code != undefined && response.status_code == 0) {
				    if(response.message != undefined)
					    alert(response.message);
		    	}
		    }, "json");
            */
            $('.delivery-popup fieldset').append('<p class="notify-delivery"><i class="check"></i> Yes, your address is eligible for Same-day Delivery.</p>')
        }
        else{
            $('.delivery-popup fieldset').append('<p class="notify-delivery"><i class="not"></i> Sorry, your address for Same-day Delivery is not eligible yet.</p>')
        }
        return false;
	});
});
