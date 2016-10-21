jQuery(function($){
	var dlg_address = $.dialog('newadds-frm'), dlg_address1 = $.dialog('editadds-frm'), $tpl = $('#address_tmpl').remove();

/*	dlg_address.$obj
		.on('click', 'button.ly-close', function(){dlg_address.close()})
		.on('reset', function(){
			dlg_address.$obj
				.data('address_id', '')
				.find(':text').val('').end()
				.find('select')
					.prop('selectedIndex',0)
					.filter('[name="country"]')
						.val('US')
						.on('change', function(){
							var $txt_state = dlg_address.$obj.find('input.state');
							if(this.value == 'US') {
								$txt_state.removeAttr('name').hide().prev('select').attr('name','state').show();
							} else {
								$txt_state.attr('name','state').show().prev('select').removeAttr('name').hide();
							}
						})
						.trigger('change')
					.end()
				.end()
				.find('input:checkbox').prop('checked',false).end()
				.find(':submit').disable(false);
		})
		.on('submit', 'form', function(event){
			event.preventDefault();
			var $form = $(this), params = {},i,c,e,x;
			for(i=0,c=this.elements.length; i < c; i++){
				e = this.elements[i];
				if(!e.name) continue;
				if(e.type != 'checkbox' || e.checked) params[e.name] = $.trim(e.value);
			}

			var msg = {
				fullname : 'Please enter the full name.',
				nickname : 'Please enter the shipping nickname.',
				address1 : 'Please enter a valid address.',
				city     : 'Please enter the city.',
				zip      : 'Please enter the zip code.',
				phone    : 'Please specify a valid phone number.'
			};

			if(params.phone) params.phone = params.phone.replace(/\s+/g,'');
			if(params.zip)   params.zip   = params.zip.replace(/\s+/g,'');

			for(x in msg){
				if(!params[x] || params[x].length == 0) return alert(gettext(msg[x]));
			}

			if(params.country == 'US' && !/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/.test(params.phone)) return alert(gettext(msg.phone));

			if(dlg_address.$obj.data('address_id')) {
				params.id = dlg_address.$obj.data('address_id');
			}

			var $submit = $form.find(':submit').disable();
			function save(){
				$.ajax({
					type : 'post',
					url  : '/add_new_shipping_addr.json',
					data : params,
					dataType : 'json',
					success  : function(json){
						var x,e;

						if(typeof json.status_code == 'undefined') return;
						switch(json.status_code){
							case 0:
								for(x in json) if(e=form.elements[x]) e.value = json[x];
								if(json.message) alert(json.message);
								break;
							case 1:
								for(x in json) json[x.toUpperCase()] = json[x];
								if(params.set_default == 'true') json['IS_DEFAULT'] = 'true';
								var $row = $tpl.template(json), $prev = $('#address-'+params.id);
								dlg_address.close();

								if(json['IS_DEFAULT'] == 'true') {
									$('table.chart tr[aisdefault]').removeAttr('aisdefault').find('i.ic-check').remove();
								} else {
									$row.removeAttr('aisdefault').find('td>i.ic-check').remove();
								}

								$prev.length ? $prev.before($row).remove() : $('table.chart').append($row);
								break;
							case 2:
								if(!params.override && confirm(response.messages)) {
									params.override = 'true';
									save();
								}
								break;
						}
					},
					complete : function(){
						$submit.disable(false);
					}
				});
			};

			// remove an addresss then add new one to mimic editing - Need to API for modifying an address
			if(params.id){
				$.ajax({
					type : 'post',
					url  : '/remove_shipping_addr.json',
					data : {id:params.id},
					dataType : 'json',
					success  : function(json){
						if(json.status_code === 1){
							save();
						} else if (json.status_code === 0){
							$submit.disable(false);
						}
					},
					error : function(){
						$submit.disable(false);
					}
				})
			} else {
				save();
			}
		});
*/
	$('#content .section.shipping')
		.delegate('.add_', 'click', function(event){
			event.preventDefault();
	//		dlg_address.$obj.trigger('reset').find('.ltit').text(gettext('Add Shipping Address')).end().find('.ltxt dt').html('<b>'+gettext('New Shipping Address')+'</b><small>'+gettext('We ships worldwide with global delivery services.')+'</small>');
			dlg_address.open();

			setTimeout(function(){dlg_address.$obj.find(':text:first').focus()},10);
		})
		.delegate('.edit_', 'click', function(event){
			var $row = $(this).closest('tr');

			event.preventDefault();
			var shipID = $(this).attr('aid');
			$.ajax({
				type:'POST',
				url:baseURL+'site/user_settings/get_shipping',
				data:{'shipID':shipID},
				dataType:'json',
				success:function(response){
					if(response.primary == 'Yes'){
						$('.make_this_primary_addr').attr('checked','checked');
					}
					$('.full_name').val(response.full_name);
					$('.nick_name').val(response.nick_name);
					$('.address1').val(response.address1);
					$('.address2').val(response.address2);
					$('.city').val(response.city);
					$('.state').val(response.state);
					$('.country').val(response.country);
					$('.postal_code').val(response.postal_code);
					$('.phone').val(response.phone);
					$('.ship_id').val(shipID);
				}
			});
//			dlg_address1.$obj.trigger('reset').data('address_id',$row.attr('aid')).find('.ltit').text(gettext('Edit Shipping Address')).end().find('.ltxt dt').html(gettext('<b>Edit your current shipping address</b><small>We ships worldwide with global delivery services.</small>'));
			dlg_address1.open(shipID);

			setTimeout(function(){dlg_address1.$obj.find(':text:first').focus()},10);

			// set current values
			var $form = dlg_address1.$obj.find('form'), fields = 'nickname,fullname,address1,address2,city,country,state,phone,zip'.split(','),i,c;
			for(i=0,c=fields.length; i < c; i++){
				if($row.attr('a'+fields[i])) {
					$form.find('[name="'+fields[i]+'"]').val($row.attr('a'+fields[i]));
					if(fields[i] == 'country') $form.find('[name="country"]').trigger('change');
				}
			}
			if($row.attr('aisdefault') === 'true') $form.find('input:checkbox[name="set_default"]').prop('checked',true);
		})
		.delegate('.remove_', 'click', function(event){
			var $row = $(this).closest('tr');

			event.preventDefault();

			if($row.attr('isdefault')) return alert(gettext('You cannot remove your default address.'));
			if(!confirm(gettext('Do you really want to remove this shipping address?'))) return;
			$.ajax({
				type : 'post',
				url  : baseURL+'site/user_settings/remove_shipping_addr',
				data : {id:$row.attr('aid')},
				dataType : 'json',
				success  : function(json){
					if(json.status_code === 1){
						$row.fadeOut('fast', function(){$row.remove()});
					} else if (json.status_code === 0){
						if(json.message) alert(json.message);
					}
				}
			})
		});
});
