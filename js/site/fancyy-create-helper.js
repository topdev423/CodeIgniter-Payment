$(document).ready(function(){

	var $dialog = $('.gift-campaign');
	$('#content,#sidebar,#popup_container').delegate('.btn-campaign','click',function(){
        var login_require = $(this).attr('require_login');
        if (login_require && login_require=='true') { 
			require_login();
			return false;
		}
		window.scrollTo(0, 0);

		$dialog
			.height($(document).height()).show()
			.find('.fig-caption').width($dialog.find('form dd').width()-114).show();

		return false;
	});

	$dialog
		.find('form')
			.on({
			    submit : function(){
				var $form=$(this),elems=this.elements,el,n,params;
                                
				var item_id = $('.btn-campaign').attr('item_id');
				var $opt = $('#option_id'), option_id = $opt.length?$opt.val()||null:null;
                                
				params = {
				    'sale_item_id' : item_id,
				};
                                
				if (option_id != null) params.sale_item_option_id = option_id;

				for(var i=0,c=elems.length;i<c;i++){
				    el = elems[i];
				    n  = el.id.replace(/^gift-/,'');
                                    
				    if(n) params[n] = $.trim(el.value);
				}

				params.quantity = parseInt($('#quantity').val()) || 0;

				$form
				    .find('.error:not(div)').removeClass('error').end()
				    .find('div.error').hide();
                                
				function displayError(fieldSelector, msg) {
				    $form
					.find('div.error')
					.show()
					.find('span.message').text(msg);
                                    
				    return false;
				};
                                
				function highlight(field, msg){
				    alert(msg);
				    $form.find('#gift-'+field).focus().select();
				    return false;
				};

                                function show_loading() {
				    var $submit = $form.find(':submit');
                                    $submit.prop('disabled',true).css('opacity', .5).css('cursor', 'progress');
                                    $('body').css('cursor', 'progress');
                                }

                                function hide_loading() {
				    var $submit = $form.find(':submit');
                                    $submit.prop('disabled', false).css('opacity', '').css('cursor', 'pointer');
                                    $('body').css('cursor', 'pointer');
                                }
                                
				if(!params.title) return highlight('title', gettext('Please enter a title.'));
				if(!params.recipient) return highlight('recipient', gettext("Please enter either the username/email of the recipient."));
				if(!params.name)  return highlight('name', gettext('Please enter the name of the recipient.'));
				if(!params.address1) return highlight('address1', gettext('Please enter address line 1.'));
				if(!params.city) return highlight('city', gettext('Please enter the city.'));
				if(!params.zipcode) return highlight('zipcode', gettext('Please enter the zip code.'));
                                
				if (params.country == 'US' && params.telephone){
				    var phone_number = params.telephone.replace(/\s+/g, "");
				    if (!phone_number.length > 9 || !phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/)){
                                        highlight('telephone', gettext("Please specify a valid phone number."));
                                        return false;
				    }
				}
                                
				var recipient_id = $('#gift-recipient').data('uid');
				if(recipient_id > 0) params.recipient = recipient_id;
                                
                                show_loading();

				$.ajax({
				    type : 'post',
				    url  : '/create_campaign.json',
				    data : params,
				    dataType : 'json',
				    success  : function(json){
					if(json.status_code == undefined) return;
					if(json.status_code == 0) {
                                            hide_loading();
					    if(json.address1){
						elems['gift-address1'].value = json.address1;
						elems['gift-address2'].value = json.address2;
						elems['gift-city'].value = json.city;
						elems['gift-state'].value = json.state;
						elems['gift-zipcode'].value = json.zipcode;
					    }
					    if(json.message) alert(json.message);
					}
					if(json.status_code == 1) location.href = json.url;
					if(json.status_code == 2) {

                                            hide_loading();

                                            var answer = confirm(json.message);
                                            if (answer){

                                                show_loading();

                                                params['override'] = true;
                                                $.ajax({
                                                    type : 'post',
                                                    url  : '/create_campaign.json',
                                                    data : params,
                                                    dataType : 'json',
                                                    success  : function(json){
                                                        if(json.status_code == undefined) return;
                                                        if(json.status_code == 0) {
                                                            hide_loading();
                                                            if(json.address1){
                                                                elems['gift-address1'].value = json.address1;
                                                                elems['gift-address2'].value = json.address2;
                                                                elems['gift-city'].value = json.city;
                                                                elems['gift-state'].value = json.state;
                                                                elems['gift-zipcode'].value = json.zipcode;
                                                            }
                                                            if(json.message) alert(json.message);
                                                        }
                                                        if(json.status_code == 1) location.href = json.url;
                                                    }
                                                });
                                            }
                                        }
				    }
				});
                                
				return false;
			    },
			    reset : function(){
				$dialog.hide();
			    }
			})
	.end()
	.find('.country select')
	.change(function(){
	    var $state = $dialog.find('.state'), $sel, id;
            
	    id = $state.data('id');
	    if(!id) $state.data('id', id = $state.find('select').attr('id'));
            
		if(this.value == 'US'){
			$state
				.find('a.select-white').show().end()
				.find('select').attr('id',id).end()
				.find('input:text').removeAttr('id').hide();
			$('.text-rnd.telephone').removeClass('wide');
			$('.fill-add .phone').show();
		} else {
			$state
				.find('a.select-white').hide().end()
				.find('select').removeAttr('id').end()
				.find('input:text').attr('id',id).show();
			$('.text-rnd.telephone').addClass('wide');
			$('.fill-add .phone').hide();
		}
	})
	.end()
	.find('.create-gift-frm .address a')
	.click(function(){
	    if (!$(this).hasClass('later')) {
		$(this).addClass('later').text(gettext('Fill out complete address later'));
		$dialog
		    .find('.fill-add').show().end()
		    .find('.state')
		    .children('label,input:text').removeClass('mid').end()
		    .children('.selectBox').width(336).end()
		    .end();
	    } else {
		$(this).removeClass('later').text(gettext('Fill in complete address'));
		$dialog
		    .find('.fill-add').hide().end()
		    .find('.state')
		    .children('label,input:text').addClass('mid').end()

		    .children('.selectBox').width(154).end()
		    .end();
	    }
	    return false;
	})
	.end()
    
    // auto complete
    var $inp  = $('#gift-recipient'),
    $list = $dialog.find('ul.user-list'),
    $item = $list.find('>li').remove(),
    $inp_name = $('#gift-name'),
    timer, prev_val;
    
    $inp
	.keydown(function(event){
	    var $inp = $(this).data('uid',0);
            
	    switch(event.keyCode) {
	    case 9: // tab
	    case 13: // enter
	    case 32: // space
	    case 186: // ';'
	    case 188: // ','
		if ($inp.val().indexOf('@') == -1) {
		    if (event.keyCode == 9 && $list.is(':hidden')) return true;
		    $list.trigger('key.enter');
		}
		return false;
	    case 38: $list.trigger('key.up'); return false;
	    case 40: $list.trigger('key.down'); return false;
	    }
            
	    clearTimeout(timer);
            
	    setTimeout(function(){
		var val = $.trim($inp.val());
                
		if (!val || val == prev_val) return;
                
		prev_val = val;
                
		if (val.indexOf('@') >= 0) return $list.hide();
                
		$list.hide().empty();
                
		function request() {
		    $.ajax({
			type : 'get',
			url  : '/search-users.json',
			data : {'term':val},
			dataType : 'json',
			success  : function(json) {
			    if (val != $.trim($inp.val())) return $list.hide();
			    if (json && json.length) {
				for(var i=0,c=json.length; i < c; i++) {
				    $item.clone()
					.attr('uid', json[i].id)
					.attr('username', json[i].username)
					.attr('name', json[i].name)
					.find('img').attr('src', json[i].image_url).end()
					.find('b').text(json[i].name).end()
					.find('small').text('@'+json[i].username).end()
					.appendTo($list);
				}
				$list.show().find('>li:first').addClass('on');
			    } else {
				$list.hide();
			    }
			}
		    });
		}
                
		timer = setTimeout(request, 100);
                
	    }, 0);
	})
	.end();
    
    $list
	.on('key.up key.down', function(event){
	    if ($list.is(':hidden')) return false;
            
	    var $items = $list.children('li'), up = (event.namespace=='up'), idx = Math.min(Math.max($items.filter('.on').index()+(up?-1:1),0), $items.length-1);
	    var $on = $items.removeClass('on').eq(idx).addClass('on'), bottom;
            
	    if (up) {
		if (this.scrollTop > $on[0].offsetTop) this.scrollTop = $on[0].offsetTop;
	    } else {
		bottom = $on[0].offsetTop - this.offsetHeight + $on[0].offsetHeight;
		if (this.scrollTop < bottom) this.scrollTop = bottom;
	    }
	})
	.on('key.enter', function(){
	    $list.children('li.on').mousedown();
	})
	.delegate('li', 'mousedown', function(){
	    var $li = $(this);
	    var uid = $li.attr('uid');
	    if (uid != 0 && uid != '' && uid != undefined) {
		$inp.val( $li.attr('username') ).data('uid', $li.attr('uid'));
		var name = $li.attr('name');
		if (name != null && name.length > 0) {
		    $inp_name.val(name);
		}
	    }
	    $list.hide();
	});
    
    if (window.location.hash) {
	if (window.location.hash == "#group-gift-dialog") {
	    var login_require = $('.btn-campaign').attr('require_login');
	    if (!login_require || login_require !='true') {
		$dialog.css('height',$(document).height()+'px').show();
	    }
	}
    }


});
