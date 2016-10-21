$(document).ready(function(){

    var note_place_holder = gettext('You can leave a personalized note here');

        $('.popup-shipping .select-country').change(function(){
            var val = $(this).val();
            if (val=='US'){
                $('.popup-shipping .text.state').hide();
                $('.popup-shipping .select-state').show();
                $('.popup-shipping input.phone').val('No dashes, 10 digits');
                $('.popup-shipping .text.state').parent('li').find('b').text('*');
                $('.popup-shipping input.phone').css('color','#afb1b6');    
            }
            else{
                $('.popup-shipping .select-state').hide();
                $('.popup-shipping .text.state').show(); 
                $('.popup-shipping input.phone').val('');
                $('.popup-shipping .text.state').parent('li').find('b').text('');
                $('.popup-shipping input.phone').removeAttr('style');
            }
            return false;		
	});

	$('.update_quantity').live('click',function(event){
		var quantity = $(this).parent('.quantity').find('input').val();
		var cid = $(this).attr('cid');
		var sicid = $(this).attr('sicid');
		var param = {};
		if (!/^ *[0-9]+ *$/.test(quantity) || quantity == 0){
			alert("Please select a valid quantity.");
			return false;
		}
		param['quantity']=quantity;
		param['cart_id']=cid;
		param['sale_item_cart_id']=sicid;
		$.post("/update_cart_item.json",param, 
		  function(response){
			if (response.status_code != undefined && response.status_code == 1) {
                                storeNote_isGift();
				location.reload(true);
			}
			else if (response.status_code != undefined && response.status_code == 0) {
				if(response.message != undefined)
					alert(response.message);
			}
		}, "json");
		

		return false;
	});


	$('.remove_item').live('click',function(event){
		var cid = $(this).attr('cid');
	        var is_fancybox = ($(this).attr('type') == 'fancybox');
		var sicid = $(this).attr('sicid');
		var param = {};
		param['cart_id']=cid;
		param['sale_item_cart_id']=sicid;
                param['is_fancybox'] = is_fancybox;
		$.post("/remove_cart_item.json",param, 
		  function(response){
			if (response.status_code != undefined && response.status_code == 1) {
                                storeNote_isGift();
				location.reload(true);
			}
			else if (response.status_code != undefined && response.status_code == 0) {
				if(response.message != undefined)
					alert(response.message);
			}
		}, "json");
		

		return false;
	});
  
	$('.popup-shipping input.phone').focus(function(event){
                var c_code = $('.popup-shipping .select-country').val();
                if (c_code == 'US'){    
		    if( $(this).val()=='' || $(this).val()=='No dashes, 10 digits') {
			$(this).val('');$(this).removeAttr('style');
		    }
		}
		return false;
	});
	$('.popup-shipping input.phone').blur(function(event){
            var c_code = $('.popup-shipping .select-country').val();
            if (c_code == 'US'){
		if($(this).val()=='') {
			$(this).val('No dashes, 10 digits');$(this).css('color','#afb1b6');
		}
	    }
	    return false;
	});

	/*$('textarea.note-to-seller').focus(function(event){
		//if( $(this).val()=='' || $(this).val()==note_place_holder) {
		if( $(this).val()=='' || $(this).attr('data-placeholder')==$(this).val()) {
			$(this).val('');$(this).removeAttr('style');
		}
		return false;
	});
	$('textarea.note-to-seller').blur(function(event){
		if($(this).val()=='') {
			//$(this).val(note_place_holder);$(this).css('color','#afb1b6');
			$(this).val($(this).attr('data-placeholder'));$(this).css('color','#afb1b6');
		}
		return false;
	});*/
    $('input[name=shipping_speed]:radio').live('change', function() {
        var cid = $(this).attr('cid'); 
        var speed = $(this).val();
        var param = {} 
        param['cid'] = cid; 
        param['speed'] = speed; 
        $.post("/admin/update_shipping_speed.json", param, function(response) { 
            if (response.status_code != undefined && response.status_code == 1) {
				location.reload(true);
            }
			else if (response.status_code != undefined && response.status_code == 0) {
				if(response.message != undefined)
					alert(response.message);
			}  
        }, 'json');
        return false;   
    });

	
	$('.select-shipping-addr').change(function(){
	    var val = $(this).val();
		if (val == "use_gw_address") {
            $('p.default_addr').hide(); 
            $('a.delete_addr').hide();
            return false;
        }
        else {
             $('p.default_addr').show();
             $('a.delete_addr').show(); 
        }
        var cid = $(this).attr('cid');
        var is_fancybox = ($(this).attr('ctype') == 'fancybox');
		var param = {};
		param['ship_to']=val;
		param['cart_id']=cid;
        param['is_fancybox'] = is_fancybox;
		var selectedRow = $(this);
		$.post("/update_ship_to.json",param, 
			function(response){
				if (response.status_code != undefined && response.status_code == 1) {
                    storeNote_isGift();
					location.reload(true);
				}
				else if (response.status_code != undefined && response.status_code == 0) {
					if(response.message != undefined)
						alert(response.message);
				}  
		}, "json");
		return false;
		
		/*
		var l1 = $(this).find('option[value="'+val+'"]').attr('l1');
		var l2 = $(this).find('option[value="'+val+'"]').attr('l2');
		var l3 = $(this).find('option[value="'+val+'"]').attr('l3');
		var l4 = $(this).find('option[value="'+val+'"]').attr('l4');
		var l5 = $(this).find('option[value="'+val+'"]').attr('l5');
		var n1 =  $("<br/>");
		var n2 =  $("<br/>");
		var n3 =  $("<br/>");
		var n4 =  $("<br/>");
		if(!$(this).parents('.cart-payment-ship').find('p.default_addr').length){
			$(this).after('<p class="default_addr"></p>');
		}
		var default_addr = $(this).parents('.cart-payment-ship').find('p.default_addr')
		default_addr.empty();
		default_addr.append(l1);
		default_addr.append(n1);
		default_addr.append(l2);
		default_addr.append(n2);
		default_addr.append(l3);
		default_addr.append(n3);
		default_addr.append(l4);
		default_addr.append(n4);
		default_addr.append(l5);
		if(!$(this).parents('.cart-payment-ship').find('.delete_addr').length){
			default_addr.after('<a href="#" class="delete_addr" said="'+val+'">Delete this address</a><br />');
		}

		$(this).parents('.cart-payment-ship').find('.delete_addr').attr('said',val)
		*/
		
	});

	$('form.continue_payment_fancybox').submit(function(){
		var addr = $(this).find('.select-shipping-addr').val();

		if (typeof(addr) == undefined || addr == null){
            alert("Please add a shipping address.");
			return false;
		}
	});
    
    $('form.continue_payment').submit(function(){
		var addr = $(this).find('.select-shipping-addr').val();
        var selectedShipping = $('#address-cart')
        var canUseWalletAddress = false
        
        var noteToSeller = $(this).find('.note-to-seller'); 
     
        if(noteToSeller.val() == noteToSeller.prop('placeholder')) 
        {
            noteToSeller.val('');
        }
        
		if (typeof(addr) == undefined || addr == null || isNaN(addr)){
            alert("Please add a shipping address.");
		    return false;
        }

	});

	$('.delete_addr').live('click',function(){
		var param = {};
		param['id']=$(this).attr('said');

		var selectedRow = $(this);
		$.post("/remove_shipping_addr.json",param, 
			function(response){
				if (response.status_code != undefined && response.status_code == 1) {
                                        storeNote_isGift();
					location.reload(true);
				}
				else if (response.status_code != undefined && response.status_code == 0) {
					if(response.message != undefined)
						alert(response.message);
				}  
		}, "json");
		return false;
	});

	$('.add_addr').live('click',function(){
	    var id = $(this).parents('dd').find('.select-shipping-addr').attr('id');
	    $('.layer-popup-cart.popup-shipping .btn-save-add').attr('select-id', id);
	    $('.layer-popup-cart-back,.layer-popup-cart').show();
	    $('.layer-popup-cart li input.add1,.layer-popup-cart li input.add2').val('');
	    return false;
	});

	$('.popup-shipping .btn-save-add').click(function(){
	    
        var select_id = $(this).attr('select-id');
		var fullname= $('.popup-shipping .fullname').val().trim();
		var nickname= $('.popup-shipping .nickname').val().trim();
		var addr1 = $('.popup-shipping .add1').val().trim();
		var addr2 = $('.popup-shipping .add2').val().trim();
		var city = $('.popup-shipping .city').val().trim();
		var zip = $('.popup-shipping .zip').val().trim();
		var phone = $('.popup-shipping .phone').val().trim();
		var set_default = $('#agree-shipping-add').is(':checked');
		var country = $('.popup-shipping .select-country').val().trim();
                var state = '';
                if (country == 'US'){                
                    state = $('.popup-shipping .select-state').val().trim();
                }
                else{
                    state = $('.popup-shipping .state').val().trim();                    
                }
		
		if (fullname.length <=0){
			alert("Please enter the full name.");
			return false;
		}
		if (nickname.length <=0){
			alert("Please enter the shipping nickname.");
			return false;
		}
		if (addr1.length <=0){
			alert("Please enter a valid address.");
			return false;
		}
		if (city.length <=0){
			alert("Please enter the city.");
			return false;
		}
		if (zip.length <=0){
			alert("Please enter the zip code.");
			return false;
		}
                //if (country != 'US'){
                //    if (state.length <=0){
                //        alert("Please enter the state.");
                //        return false;
                //    }                    
                //}
                
        if (country == 'US'){
            var phone_number = phone.replace(/\s+/g, ""); 
            if (!phone_number.length > 9 || !phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/)){
                alert("Please specify a valid phone number.");
                return false;			
            }
        }

		var param = {};
		param['fullname']=fullname;
		param['nickname']=nickname;
		param['address1']=addr1;
		param['city']=city;
		param['state']=state;
		param['country']=country;
		param['zip']=zip;
		param['address2']=addr2;
		param['phone']=phone;
		param['set_default']=set_default;

		var selectedRow = $(this);
        $(this).addClass('waiting');
		$.post("/add_new_shipping_addr.json",param, 
			function(response){
                                selectedRow.removeClass('waiting');
				if (response.status_code != undefined && response.status_code == 1) {
					//location.reload(true);
					if (response.id){
						var sid = response.id;
						
						var a1,a2,ci,st,z,ph,co,fn = '';
						if(response.fullname != undefined)
						    fn = response.fullname;
						if(response.city != undefined)
						    ci = response.city;
						if (response.address1 != undefined)
						    a1 = response.address1;
						if (response.address2 != undefined){
						    a2 = response.address2;
						}
						if (response.state != undefined)
						    st = response.state;
						if (response.country != undefined)
						    co = response.country;
						if (response.zip != undefined)
						    z = response.zip;
						if (response.phone != undefined)
						    ph = response.phone;
						
					    var new_op = $('<option value="'+sid+'" l1="'+fn+'" l2="'+a1+' '+a2+'" l3="'+ci+' '+st+' '+z +'" l4="'+co+'" l5="'+ph+'">'+nickname+'</option>');
					    var $select = $('#' + select_id);
				        $select.append(new_op);
				        $select.val(sid);
				        $select.change();
						$('.layer-popup-cart-back,.layer-popup-cart').hide();
					}
				}
				else if (response.status_code != undefined && response.status_code == 0) {
					if(response.city != undefined){
						$('.popup-shipping .city').val(response.city);
					}
					if(response.address1 != undefined){
						$('.popup-shipping .add1').val(response.address1);
					}
					if(response.address2 != undefined){
						$('.popup-shipping .add2').val(response.address2);
					}
					if(response.zip != undefined){
						$('.popup-shipping .zip').val(response.zip);
					}
					if(response.state != undefined){
                                            if (country == 'US'){                
                                                $('.popup-shipping .select-state').val(response.state)
                                            }
                                            else{
                                                $('.popup-shipping .state').val(response.state)
                                            }
					}
					if(response.message != undefined)
						alert(response.message);
				}  
				else if (response.status_code != undefined && response.status_code == 2) {
					if(response.message != undefined){
	                    var answer = confirm(response.message);
	                    if (answer){
                            param['override']=true
	                        $.post("/add_new_shipping_addr.json",param,
		                        function(resp2){
			                        if(resp2.status_code != undefined && resp2.status_code == 1){
					                    if (resp2.id){
						                    var sid = resp2.id;
						
						                    var a1,a2,ci,st,z,ph,co,fn = '';
						                    if(resp2.fullname != undefined)
							                    fn = resp2.fullname;
						                    if(resp2.city != undefined)
							                    ci = resp2.city;
						                    if (resp2.address1 != undefined)
							                    a1 = resp2.address1;
						                    if (resp2.address2 != undefined){
							                    a2 = resp2.address2;
						                    }
						                    if (resp2.state != undefined)
							                    st = resp2.state;
						                    if (resp2.country != undefined)
							                    co = resp2.country;
						                    if (resp2.zip != undefined)
							                    z = resp2.zip
						                    if (resp2.phone != undefined)
						    	                ph = resp2.phone
						
						                    $('.cart-payment-ship').each(function(){
							                    var new_op = $('<option value="'+sid+'" l1="'+fn+'" l2="'+a1+' '+a2+'" l3="'+ci+' '+st+' '+z +'" l4="'+co+'" l5="'+ph+'">'+nickname+'</option>');
							                    $(this).find('select.select-shipping-addr').append(new_op);
							                    $(this).find('select.select-shipping-addr').val(sid);
							                    $(this).find('select.select-shipping-addr').change();
						                    });
						                    $('.layer-popup-cart-back,.layer-popup-cart').hide();
					                    }
			                        }
			                        if(resp2.status_code != undefined && resp2.status_code == 0){
				                        if(resp2.message != undefined)
					                        alert(resp2.message);
			                        }
	                        }, "json");
                        }
                    }
				}  
		}, "json");
		
	});
	
  /*
  $('#seller-signup button.button').live('click',function(event){
    var contact_name = $('#contact_name').val().trim();
    var contact_email = $('#contact_email').val().trim();
    var contact_phone = $('#contact_phone').val().trim();
    
    var is_company = $('#is_company').is(':checked');
    var tax_shipping = $('#tax_shipping').is(':checked');
    var company_name = $('#company_name').val().trim();
    var company_url = $('#company_url').val().trim();
    var company_twitter = $('#company_twitter').val().trim();
    var company_facebook = $('#company_facebook').val().trim();

    var address1 = $('#address1').val().trim();
    var address2 = $('#address2').val().trim();
    var city = $('#city').val().trim();
    var state = $('#state').val().trim();
    var zip = $('#zip').val().trim();

	var country_v = $('#id_countrycode').val();
	var country = $('#id_countrycode option[value="'+country_v+'"]').text();
    
    var paypal_email = $('#paypal_email').val().trim();
    
    if (contact_name.length == 0 || contact_email.length == 0 || contact_phone.length == 0 || is_company.length == 0 || address1.length ==0 ||
		  city.length == 0 || state.length == 0 || country.length == 0 || zip.length == 0)
    {
      alert("enter all fields");
      return false;
    }

    var param = {};
	
    param['contact_name']=contact_name;
    param['contact_email']=contact_email;
    param['contact_phone']=contact_phone;
    param['is_company']=is_company;
    param['tax_shipping']=tax_shipping;
    param['address1']=address1;
    param['address2']=address2;
    param['city']=city;
    param['state']=state;
    param['country']=country;
    param['zip']=zip;
    
    if (is_company == true)
    {
      if (company_name.length == 0 || company_url.length == 0)
      {
	alert("enter company_name and company_url");
	return false;
      }
      param['company_name']=company_name;
      param['company_url']=company_url;
      if (company_twitter.length > 0)
      {
	param['company_twitter']=company_twitter;
      }
      if (company_facebook.length > 0)
      {
	param['company_facebook']=company_facebook;
      }
    }
    
    if (paypal_email.length > 0)
    {
      param['paypal_email']=paypal_email;
    }

	if ($(this).hasClass('update')){
	  $.post("/update_seller.xml",param, 
		function(xml){
		  if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
			var msg = $(xml).find("message").text();
			alert(msg);
		  }
		  else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
			var msg = $(xml).find("message").text();
			alert(msg);
		  }
	  }, "xml");
	  
	}
	else{
	  $.post("/signup_seller.xml",param, 
		function(xml){
		  if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
			var msg = $(xml).find("message").text();
			alert(msg);
		  }
		  else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
			var msg = $(xml).find("message").text();
			alert(msg);
		  }
	  }, "xml");
	  
	}
    
    
    return false;
  });
  */
  
	$('a.remove-coupon').live('click',function(event){
		var sid = $(this).attr('data-sid');
        var code = $(this).attr('data-ccode');
		var fancybox = $(this).attr('data-fancybox');
		var param = {};
		param['seller_id']=sid;
		param['coupon_code']=code;
        if(fancybox != undefined && fancybox != null)
		    param['fancybox']=fancybox;
		$.post("/remove-coupon.json",param, 
		  function(response){
			if (response.status_code != undefined && response.status_code == 1) {
				location.reload(true);
			}
			else if (response.status_code != undefined && response.status_code == 0) {
				if(response.message != undefined)
					alert(response.message);
			}
		}, "json");
		return false;
	});
	$('button.apply-coupon').live('click',function(event){
        var $box = $(this).parents('.cart-coupon').find('input.coupon-code');
		var fancybox = $box.attr('data-fancybox');
		var sid = $box.attr('data-sid');
        var code = $box.val();
		var param = {};
		param['seller_id']=sid;
		param['coupon_code']=code;
        if(fancybox != undefined && fancybox != null)
		    param['fancybox']=fancybox;

		$.post("/apply-coupon.json",param, 
		  function(response){
			if (response.status_code != undefined && response.status_code == 1) {
				location.reload(true);
			}
			else if (response.status_code != undefined && response.status_code == 0) {
				if(response.message != undefined)
					alert(response.message);
			}
		}, "json");
		return false;
	});
  $('#seller-update button.button').live('click',function(event){
    var contact_name = $('#contact_name').val().trim();
    var contact_email = $('#contact_email').val().trim();
    var contact_phone = $('#contact_phone').val().trim();
    var company_name = $('#company_name').val().trim();
    var company_url = $('#company_url').val().trim();
    var company_twitter = $('#company_twitter').val().trim();
    var company_facebook = $('#company_facebook').val().trim();
    var paypal_email = $('#paypal_email').val().trim();
    
    if (contact_name.length == 0 || contact_email.length == 0 || contact_phone.length == 0 || company_name.length == 0 ||
	company_url.length == 0 || company_twitter.length == 0 || company_facebook.length == 0 || paypal_email.length == 0)
    {
      alert("All fields are required.");
      return false;
    }

    var param = {};
	
    param['contact_name']=contact_name;
    param['contact_email']=contact_email;
    param['contact_phone']=contact_phone;
    param['company_name']=company_name;
    param['company_url']=company_url;
    param['company_twitter']=company_twitter;
    param['company_facebook']=company_facebook;
    param['paypal_email']=paypal_email;

    $.post("/update_seller.xml",param, 
      function(xml){
	    if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
	      var msg = $(xml).find("message").text();
	      alert(msg);
	    }
	    else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
	      var msg = $(xml).find("message").text();
	      alert(msg);
	    }
    }, "xml");
    
    
    return false;
  });

    function storeNote_isGift(){
        $('.note-to-seller').each(function(){
            var n = $(this).val();
            //if (n != note_place_holder){
            //if (n != $(this).attr('data-placeholder')){
                var did = $(this).attr('data-id');
                jQuery.jStorage.set('fancy.cart.note:'+did, n);
           // }
        });
        
        $('#is_gift').each(function(){
            var g = $(this).is(':checked');
            var did = $(this).attr('data-id');
            jQuery.jStorage.set('fancy.cart.isgift:'+did, g);
        });

    }

    function loadNote_isGift(){
        $('.note-to-seller').each(function(){
            var did = $(this).attr('data-id');

            var note = jQuery.jStorage.get('fancy.cart.note:'+did);
            if(note != undefined && note != null){
                $(this).val(note);
                $(this).removeAttr('style');
                jQuery.jStorage.set('fancy.cart.note:'+did, null)
            }
        });
        $('#is_gift').each(function(){
            var did = $(this).attr('data-id');

            var is_gift = jQuery.jStorage.get('fancy.cart.isgift:'+did);
            if(is_gift != undefined && is_gift != null){
                $(this).prop("checked", is_gift);
                jQuery.jStorage.set('fancy.cart.isgift:'+did, null)
            }
        });

    }
    
    loadNote_isGift();
});
