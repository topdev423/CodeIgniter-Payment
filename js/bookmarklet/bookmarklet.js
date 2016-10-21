jQuery(function($){
	var args = {}, hash, saving = false;

	if(/^#tagger:/.test(hash=location.hash)) args = unparam(location.hash.substr(8));
	onMessage(args);

	$('a.close_box,a.cancel_add_thing,a.cancel_tag').click(function(){ send({cmd:'close'}); return false });
	$('a.img-pick').click(function(){
		var $this = $(this), did = parseInt($this.attr('did')), idx=parseInt($('#add_picked-image').attr('idx'))||0;
		if($this.hasClass('disabled')) return false;

		idx += did?1:-1;
		send({cmd:'index',idx:idx});

		return false;
	});
	$('.add_new_thing').click(function(event){
		var $this = $(this), params = {name:'',link:'',category:'',photo_url:'',uid:''};
//		if($this.attr('require_login') == 'true') return send({cmd:'close'});
		if($this.hasClass('adding'))return;
		event.preventDefault();

		saving = true;

		// show saving message
		$this.addClass('adding').text('Adding...');

		for(var x in params) {
			if(params.hasOwnProperty(x)) params[x] = $.trim($('#add_'+x).val());
		}
		params.via = 'bookmarklet';
		params.photo_url = $('#add_picked-image').attr('src');

		if(!params.name){alert('Please enter name'); $this.removeClass('adding').text('Add'); return; }
//		if(!params.price){alert('Please enter price'); $this.removeClass('adding').text('Add'); return; }
//		if((params.price-params.price)!=0){alert('Price must be an integer'); $this.removeClass('adding').text('Add'); return; }
//		if(!params.category){alert('Please choose category'); $this.removeClass('adding').text('Add'); return; }
		var baseurl = $('#baseurl').val();
		
		$.ajax({
			type:'post',
			url:baseurl+'site/bookmarklet/add_bookmarklet_product',
			data:params,
			dataType:'json',
			success:function(json){
				if(json.status_code == 1){
					$('form.add_thing')
						.find('fieldset,.footer').hide().end()
						.find('#if-success')
							.show()
							.find('a').attr('href', json.thing_url).end()
						.end();
					resize();
				} else {
					var msg = json.message || 'An error occurred while requesting the server.\nPlease try again later.';
					alert(msg);
					if(json.status && json.status=='login'){
						window.open(baseurl+'login?next=close');
					}
					send({cmd:'close'});
				}
			},
			complete:function(){
				$this.removeClass('adding').text('Add');
				saving = false;
			}
		});
	});
	$('#if-success a').click(function(){
		setTimeout(function(){ send({cmd:'close'}) }, 100);
	});

	if('postMessage' in window){
		$(window).on('message', function(event){
			var args = unparam(event.originalEvent.data);
			onMessage(args);
		});
	} else {
		(function(){
			if(location.hash == hash || !/^#tagger:/.test(hash=location.hash)) return setTimeout(arguments.callee, 100);
			var args = unparam(hash.replace(/^#tagger:/, ''));
			onMessage(args);
		})();
	}

	function onMessage(args){
		if(saving) return;

		args.total = parseInt(args.total) || 0;
		args.idx = parseInt(args.idx) || 0;

		// no image...
		if(args.total === 0) return $('.no_image').show().siblings('form').hide() && resize();

		// title
		var cur = (args.idx)+1;
		$('#add_name').val(args.title);
		$('#add_link').val(args.loc);
		$('#add_photo_url').val(args.src);
		$('.cur_').html(cur+' of '+args.total);
		$('a.img-pick').addClass('disabled');
		if(args.idx > 0) $('a.img-pick[did="0"]').removeClass('disabled');
		if(args.idx < args.total-1) $('a.img-pick[did="1"]').removeClass('disabled');

		$('form.add_thing').show().siblings('form').hide();
		$('#add_picked-image').load(resize).attr('src', args.src).attr('idx',args.idx);
	};

	function resize(){
		var $main = $('body'), $win = $(window);

		function ask(){
			send({ cmd:'resize',h:$main.height() });
			setTimeout(function(){
				if($win.height() < $main.height()) resize();
			}, 100);
		};

		setTimeout(ask, 1);
	};

	// send data to parent window
	function send(data){
		var p=window.parent,d=$.param(data),u=args.loc+'#tagger:'+d,l=args.loc.match(/^https?:\/\/[^\/]+/)[0];
		try{ p.postMessage(d,l) } catch(e1){ try{p.location.replace(u)}catch(e){p.location.href=u} };
	};
	// unparam
	function unparam(s){ var a={},i,c;s=s.split('&');for(i=0,c=s.length;i<c;i++)if(/^([^=]+?)(=(.*))?$/.test(s[i]))a[RegExp.$1]=decodeURIComponent(RegExp.$3||'');return a };
});