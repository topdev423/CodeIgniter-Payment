/**
 * Timeline slideshow for fancy
 * @author taggon
 **/

jQuery(function($){
	var
	    $win  = $(window),
		$html = $('html:first'),
	    $body = $('body:first'),
		$box  = $('#slideshow-box'),
		$img_list   = $('#img-list'),
		$slideshow  = $('#slideshow'),
		$current    = $img_list.find('span.current'),
		$figure     = $slideshow.find('>figure'),
		$figure_img = $figure.find('>img:first'),
		$slide_btns = $('#slideshow-buttons'),
		$footer = $box.find('footer:first'),
  	    curPage = 1, // current page
	    itemCount = 11, // number of thumbnails per page
		rowCount = 4, // row count
		totalCount = +$img_list.find('.total').text(),
		req_url = window.slideshow_request_url || '/user_fancyd_slideshow.json',
		dummy_img = '/_ui/images/common/blank.gif',
		SLIDE_INTERVAL = 7000, // interval
		show_timer = null,
		stop    = false,
		isGrid  = false,
		useLoop = false;
	
	if(!Fancy) window.Fancy = {};
	if(!Fancy.slideshow) Fancy.slideshow = {};

	$img_list
		.addClass('first')
		.on('click', 'li > a', function(){
			var $this = $(this),
			    thing = $this.data('thing'),
			    $holder = $slideshow.find('img.holder'),
			    offset  = $this.data('offset');

			if (!thing) return;

			var img_src = thing.image_url,
				img_h   = thing.image_url_height,
				img_w   = thing.image_url_width,
				slideH  = $slideshow.height(),
				speed   = 400,
				animInfo  = {},
				maxWidth  = 880, maxHeight = 0,
				maxHeight = slideH-90,
				marginTop = 0;

			if ((!isGrid&&$this.hasClass('selected')) || typeof(offset)=='undefined') return false;
			if (isGrid && $this.hasClass('selected')) $slideshow.find('img.holder').attr('src', dummy_img);

			$this
				.closest('ul')
 					.find('>li>a').removeClass('selected').end()
				.end()
				.addClass('selected');

			$current.text(offset+1);
			$slideshow.removeClass('first last');
			if (offset == 0) {
				$slideshow.addClass('first');
			} else if (offset == totalCount - 1) {
				$slideshow.addClass('last');
			}

			if (img_w > maxWidth) {
				img_h = maxWidth/img_w * img_h;
				img_w = maxWidth;
			}
			if (img_h > maxHeight) {
				img_w = maxHeight/img_h * img_w;
				img_h = maxHeight;
			}

			var animateObj = {
				width  : img_w+'px',
				height : img_h+'px'
			};

			if (isGrid) {
				slideH = $slideshow.show().height();
                $box.addClass('slide');
				if (img_h) marginTop = (slideH - img_h - 20)/2;
				if (offset < totalCount-1 && offset == things.length-1) drawGrid(Math.floor(offset/5));
			} else  {
				if (img_h) marginTop = (slideH - $img_list.find('figcaption').height() - img_h - 30)/2 - 15;
			}

			animInfo = $slideshow.data('animation-info');
			if (animInfo && animInfo.$obj && animInfo.$obj[0] === this) speed -= animInfo.startTime||0;

			// cache next 2 images
			if (things[offset+2]) (new Image).src = things[offset+2].image_url_1280 || things[offset+2].image_url;
			if (things[offset+1]) (new Image).src = things[offset+1].image_url_1280 || things[offset+1].image_url;

			$slide_btns.css('top', (img_h/2+10)+'px');

			$slideshow
				.addClass('loading')
				.data('animation-info', {$obj:$this, startTime:(new Date).getTime(), width:img_w, height:img_h})
				.find('img.holder')
					.prop('loaded', false)
					.data('offset', offset)
					.filter('[src="'+img_src+'"]').attr('src',dummy_img).end()
					.attr('src', img_src)
					.stop()
					.animate(animateObj, speed, function(){ var t=this; setTimeout(function(){ $(t).trigger('ready') }, 0) })
				.end()
				.find('figure').stop().animate({marginTop : Math.max(marginTop,0)+'px'}, speed).end()
				.find('figcaption')
					.find('>a.title').attr('href', thing.url).width(img_w||$slideshow.find('figcaption>a.title').width()).text(thing.name||'').end()
					.find('>span').html('<a href="http://www.thefancy.com/'+thing.user.username+'">'+thing.user.username+'</a>'+(thing.fancys>1?' + '+(thing.fancys-1):'')).end()
				.end()
				.find('a.button.fancy, a.button.fancyd')
					.removeClass('fancy fancyd')
					.addClass(thing["fancy'd"]?'fancyd':'fancy')
					.html(thing["fancy'd"]?"<span><i></i></span>"+gettext("Fancy'd"):'<span><i></i></span>'+gettext('Fancy it'))
					.data('thing-offset', offset)
					.data('image-src', img_src)
					.attr('tid', thing.thing_id||thing.id)
					.attr('rtid', thing.rtid||null)
				.end();

			if (thing["fancy'd"]) {
				$box.find('footer a[href=#F] > span').text(txtFancyUnFancy[1]);
			} else {
				$box.find('footer a[href=#F] > span').text(txtFancyUnFancy[0]);
			}

			return false;
		})
		.on('focus', 'li > a', function(){
			if (isGrid) return;

			var $this = $(this),
			    offset = $this.data('offset'),
			    start  = $holder.eq(itemCount).data('offset'),
				end    = $holder.eq(itemCount*2-1).data('offset');

			if (offset < start) $holder.eq(itemCount).focus();
			else if (offset > end) $holder.eq(itemCount*2-1).focus();
		})
		.mouseenter(function(){
			if (!isGrid) $(this).children('a.prev,a.next').stop().show().css('opacity',0).fadeTo('normal', 0.6);
		})
		.mouseleave(function(){
			if (!isGrid) $(this).children('a.prev,a.next').stop().fadeOut();
		})
		.children('a.prev,a.next')
			.mouseover(function(){ $(this).stop().fadeTo('normal', 1) })
			.mouseout(function(){ $(this).stop().fadeTo('normal', 0.6) })
			.click(function(){
				var $this = $(this), $ul = $img_list.find('>ul'), prev, next, lastPage = Math.ceil(totalCount/itemCount);

				if ($ul.is(':animated') || isGrid) return false;
				if ((prev=$this.hasClass('prev')) && curPage == 1) return false;
				if ((next=$this.hasClass('next')) && curPage == lastPage) return false;

				if (prev) {
					setPage(curPage-1);
				} else if (next) {
					setPage(curPage+1);
				}

				return false;
			})
		.end();

	// slideshow
	var entered_on_slideshow = false, timer_to_hide_buttons = null;
	$slideshow
		.find('img.holder')
			.load(function(){ $(this).prop('loaded', true).trigger('ready') })
			.on('ready', function(){
				var $this = $(this);
				if ($this.prop('loaded') && !$this.is(':animated')) {
					$slideshow.removeClass('loading');
					$this.hide().css('opacity','').stop().fadeIn();

					if (!stop) play(true);
				}
			})
		.end()
		.on({
			mouseenter : function(){
				entered_on_slideshow = true;
				clearTimeout(timer_to_hide_buttons);
				$(this).find('a.prev,a.next').stop().show().css('opacity',0).fadeTo('normal', 0.6);
				timer_to_hide_buttons = setTimeout(function(){ $slideshow.mouseleave(); }, 5000);
			},
			mouseleave : function(){
				entered_on_slideshow = false;
				clearTimeout(timer_to_hide_buttons);
				$(this).find('a.prev,a.next').stop().fadeOut();
			},
			mousemove : function(){
				if (entered_on_slideshow) return;
				$(this).mouseenter();
			},
			click : function(event){
				if (!isGrid) return;

				var n = event.target.nodeName.toLowerCase();
				if (n != 'img' && n != 'a') $(this).trigger('do:close');
			}
		})
		.on('do:close', function(){
			if (isGrid) $(this).filter(':visible').fadeOut('fast');
            $box.removeClass('slide');
		})
		.find('a.prev,a.next')
			.mouseover(function(){ $(this).stop().fadeTo('normal', 1) })
			.mouseout(function(){ $(this).stop().fadeTo('normal', 0.6) })
			.click(function(){
				var $this = $(this), $selected, $li, $a, idx, prev = $this.hasClass('prev'), next = $this.hasClass('next');

				if (isGrid && $slideshow.is(':hidden')) return false;
				if (prev && $slideshow.hasClass('first')) return false;
				if (next && $slideshow.hasClass('last')) {
					if (!useLoop) return false;
					if (curPage > 1) {
						$img_list.one('paged', function(){ $img_list.find('li > a').eq(11).click() });
						setPage(1);
					} else {
						$img_list.find('li > a').eq(11).click();
					}
					return false;
				}

				$li = $img_list.find('li');
				$selected = $li.find('>a.selected');
				if (!$selected.length) $selected = $li.find('>a').eq(itemCount).addClass('selected');
				idx = $li.index($selected.parent());

				function a_click(){ $a.click() };

				if (prev) {
					$a = $li.eq(idx-1).children('a');
					if((idx == itemCount) && !isGrid) {
						$img_list.one('paged', a_click);
						setPage(curPage-1);
					} else {
						a_click();
					}
				} else {
					$a = $li.eq(idx+1).children('a');
					if((idx == itemCount*2-1) && !isGrid) {
						$img_list.one('paged', a_click);
						setPage(curPage+1);
					} else {
						a_click();
					}
				}

				return false;
			})
		.end()

	// create new thumbnail holders
	var itemHTML = '<li><a class="blank"><img /></a></li>';
	function createHolders(num) {
		if (num <= 0) return $(null);

		var html = '', i;
		for (i=0; i < num; i++) html += itemHTML;

		return $(html).find('img').load(holderOnload).end();
	};
	function holderOnload(){
		var w = this.width, h = this.height, p = this.parentNode, pw = p.offsetWidth, ph = p.offsetHeight;
		if (!w  || !h) return;
		if (w > h) {
			this.width  = ph/h * w;
			this.height = ph;
		} else {
			this.height = pw/w * h;
			this.width  = pw;
		}

		this.style.marginLeft = parseInt((pw-this.width)/2)+'px';
		this.style.marginTop  = parseInt((ph-this.height)/2)+'px';

		p.className = '';
	};

	// create thumbnail holders
	$img_list.find('>ul').empty().append(createHolders(itemCount*3));

	// set page
	var $holder = $img_list.find('li > a'), things=[];
	function setPage(page) {
		function action() {
			var lastPage = Math.ceil(totalCount/itemCount), reqCount = 0, cursor, speed = 'normal', margin = -946;

			drawPage(page);

			(page == 1)?$img_list.addClass('first'):$img_list.removeClass('first');
			(page == lastPage)?$img_list.addClass('last'):$img_list.removeClass('last');

			function trigger_paged(){ setTimeout(function(){ $img_list.trigger('paged') }, 10) };

			if (page < curPage) {
				$img_list.find('>ul')
					.animate({'margin-left':0}, speed, function(){
  						$holder.slice(itemCount*2).parent().remove();
  						$holder = $(this).prepend(createHolders(itemCount)).css('margin-left', margin+'px').find('li>a');
						trigger_paged();
					});
			} else if (page > curPage) {
				$img_list.find('>ul')
					.animate({'margin-left':(margin*2)+'px'}, speed, function(){
  						$holder.slice(0, itemCount).parent().remove();
  						$holder = $(this).append(createHolders(itemCount)).css('margin-left', margin+'px').find('li>a');
						trigger_paged();
					});
			} else {
				trigger_paged();
			}

			if (curPage === page) setTimeout(function(){ $holder.eq(itemCount).click() }, 100);

			curPage = page;
		};

		var start = (page-1)*itemCount, end = start + itemCount - 1, offset = Math.max(start, things.length), cursor;

		if ((things.length == (totalCount||1)) || (things.length >= page*itemCount)) return action();
		if (offset && !things[offset-1].next_cursor) return;

		cursor = (page == 1) ? '' : things[offset-1].next_cursor;

		requestData(cursor, offset, function(){ setPage(page) });
	};

	function drawPage(page) {
		var start = itemCount;

		$figure.removeClass('initializing');

		if (page < curPage) {
			start = 0;
		} else if (page > curPage) {
			start = itemCount * 2;
		}
		for(var i=0,offset; i < itemCount; i++) {
			offset = i + itemCount*(page-1);
			if(!things[offset]) continue;
			$holder.eq(start+i)
				.attr('href', things[offset].url)
				.data('offset', offset)
				.data('thing', things[offset])
				.find('img')
					.removeAttr('width')
					.removeAttr('height')
					.attr('src', dummy_img)
					.attr('src', things[offset].thumb_image_url_200||things[offset].image_url);
		}
	};

	function reset(){
		req_url = window.slideshow_request_url || '/user_fancyd_slideshow.json';
		$img_list.off('paged').find('>ul').empty().append(createHolders(itemCount*3));

		// set page
		$holder = $img_list.find('li > a');
		things=[];

		$win.resize();
		setPage(curPage = 1);
	};
	Fancy.slideshow.reset = reset;

	var listTop = 0, _timer = null;
	function drawGrid(startR){
		var startRow = startR || Math.floor(Math.max($win.scrollTop()-listTop,1)/190),
		    endRow = startRow + rowCount + (startRow?rowCount:0),
		    maxCount = Math.min((endRow+rowCount)*5, totalCount),
			$items = $img_list.find('li'),
			offset, cursor;

		$figure.removeClass('initializing');

		if (totalCount < $items.length) $items.slice(totalCount).remove();

		if (maxCount - $items.length > 0) {
			$items = $img_list.find('ul:first').append(createHolders(maxCount-$items.length)).find('>li');
		}

		function action(){
			var start = startRow * 5, end = maxCount, $anchors = $items.slice(start, end).find('>a'), $link, offset;

			for(var i=0,c=$anchors.length; i < c; i++) {
				$link = $anchors.eq(i);
				offset = start + i;

				if ($link.is('[href]') || !things[offset]) continue;

				$link
					.attr('href', things[offset].url)
					.data('offset', offset)
					.data('thing', things[offset])
					.find('img')
						.removeAttr('width')
						.removeAttr('height')
						.attr('src', dummy_img)
						.attr('src', things[offset].thumb_image_url_200||things[offset].image_url);
			}
		};

		if ((things.length == totalCount) || things.length >= maxCount) return action();
		if ((offset=things.length) && !things[offset-1].next_cursor) return;

		cursor = things[offset-1].next_cursor;

		requestData(cursor, offset, function(){ drawGrid(startRow) });
	};

	function requestData(cursor,offset,callback) {
		param = 'thumbs=200'+(cursor?'&cursor='+cursor:'')+'&offset='+offset+(window.owner_id?'&user_id='+window.owner_id:'');

		$.ajax({
			url : req_url + (req_url.indexOf('?')<0?'?':'&') + param,
			dataType : 'json',
			success : function(data) {
				var coll = data.response.collection||data.response.posts, offset = +data.response.offset;
				for(var i=0,j=0,c=coll.length; i < c; i++) {
					if (coll[i].type != 'thing') continue;
					if (!coll[i].image_url_1280_width && !coll[i].image_url_width) continue;
					things[offset+j] = coll[i];
					j++;
				}
				if (!data.response.next_cursor) {
					totalCount = things.length;
					$img_list.find('.total').text(totalCount);
				} else {
					things[offset+j-1].next_cursor = data.response.next_cursor;
				}

				if (typeof data.response.top_cursor != "undefined" && data.response.top_cursor==null) return;
                if (totalCount == 0) return;
				
                setTimeout(callback, 10);
			}
		});
	};

	// change view mode
	function changeMode(mode) {
		if ((isGrid && mode == 'grid') || (!isGrid && mode != 'grid')) return false;

		$img_list.find('li > a')
			.removeAttr('href')
			.addClass('blank')
			.children('img')
				.attr('src', dummy_img)
				.removeAttr('width')
				.removeAttr('height')
			.end();

		clearTimeout(show_timer);

		if (mode == 'grid') {
			$body.addClass('grid');

			rowCount = Math.ceil($win.innerHeight()/190);
			listTop = $img_list.find('>ul:first').css('margin-left',0).offset().top;
			$slideshow.css('height','').find('figure').css('margin-top','');
			drawGrid();
		} else {
			$body.removeClass('grid');

			$holder = $img_list.find('>ul').css('margin-left','').empty().append(createHolders(itemCount*3)).find('li > a');
			$slideshow.css('display','').find('img').css('opacity','');

			setPage(curPage=1);
			setTimeout(function(){ $holder.eq(itemCount).click() }, 100);
		}

		isGrid = (mode === 'grid');

		if (!isGrid) $win.resize();
	};

	// Fancy/Unfancy button
	$box.find('a.button.fancy')
		.on({
			click : function(){ clearTimeout(show_timer); },
			fancy : function(){
				var $this = $(this), offset = $this.data('thing-offset'), rtid = $this.attr('rtid');

				if (!things[offset]) return;
				things[offset]["fancy'd"] = true;
				if (rtid) things[offset].rtid = rtid;
				$this.html("<span><i></i></span>"+gettext("Fancy'd"));
			},
			unfancy : function(){
				var $this = $(this), offset = $this.data('thing-offset');

				if (!things[offset]) return;
				things[offset]["fancy'd"] = false;
				delete things[offset].rtid;
				$this.html("<span><i></i></span>"+gettext("Fancy it"));
			}
		});

	// Show fancy button
	$slideshow.find('img.holder')
		.mouseover(function(event){
			if (event.target != this || $slideshow.hasClass('loading')) return;
			$slideshow.find('a.button').show();
		})
		.mouseout(function(event){
			var $rel = $(event.relatedTarget);
			if ($rel.is('a.fancy,a.fancyd') || $rel.closest('a').is('.fancy,.fancyd')) return;
			$slideshow.find('a.button').hide();
		});

	// extract Play/Pause text
	var txtPlayPause = $box.find('footer a[href="#P"] > span').text().split('/');
	$box.find('footer a[href="#P"] > span').text(txtPlayPause[1]);

	// extract Fancy/Unfancy text
	var txtFancyUnFancy = $box.find('footer a[href="#F"] > span').text().split('/');
	$box.find('footer a[href="#F"] > span').text(txtFancyUnFancy[0]);

	// Fullscreen
	if($.support.fullscreen) {
		$('#btn-fullscreen').click(function(){
			$box.fullScreen({'callback':function(){ $win.resize() }});
			return false;
		});
	}

	// Switch
	$('a.switch').click(function(){
		var mode = $(this).attr('href').substr(1);
		changeMode(mode);
		return false;
	});

	// Tooltip
	var $a_tooltip = $('a.switch,#btn-browse,#btn-fullscreen');
	$a_tooltip.each(function(){
		var $this = $(this);
		$this.attr('title', $this.text()).html('');
	});
	if ($a_tooltip.tipsy) $a_tooltip.tipsy({fade:false});

	var _resize_timer = null;
	$win.resize(function(){
	    if (isGrid && $slideshow.is(':hidden')) return false;

		if ($win.innerHeight() < 700) {
			$box.addClass('tiny');
		} else {
			$box.removeClass('tiny');
		}

		clearTimeout(_resize_timer);
		_resize_timer = setTimeout(function(){
			try{
				$slideshow.data('animation-info').$obj.removeClass('selected').click();
			}catch(e){}
		}, 300);

		if(isGrid) return;

		var listTop  = $img_list[0].offsetTop, slideTop = $slideshow.offset().top;

		if ($box.hasClass('tiny')) {
			$slideshow.height(listTop);
		} else {
			$slideshow.height(listTop - slideTop - parseInt($slideshow.css('padding-top')) - 10);
		}


	});

	// bottom controls
	function pause(slient){
		stop = true;
		clearTimeout(show_timer);
		$box.find('footer a[href=#P] > span').text(txtPlayPause[0]);

		if (slient) return;

		var anim_info = $slideshow.data('animation-info');
		if (!anim_info) return;

		$slide_btns.removeClass('play hidden animation').addClass('pause');
		if ($slide_btns.hasClass('compat')) {
			$slide_btns.stop().hide().css({opacity:'',top:anim_info.height/2}).fadeIn(200).delay(300).fadeOut(300);
		} else {
			setTimeout(function(){ $slide_btns.addClass('animation') }, 10);
			setTimeout(function(){ $slide_btns.addClass('hidden') }, 500);
		}
	};
	function play(slient){
		stop = false;
		clearTimeout(show_timer);
		$box.find('footer a[href=#P] > span').text(txtPlayPause[1]);
		show_timer = setTimeout(function(){ $slideshow.find('a.next').click() }, SLIDE_INTERVAL);

		if (slient) return;

		var anim_info = $slideshow.data('animation-info');
		if (!anim_info) return;

		$slide_btns.removeClass('pause hidden animation').addClass('play');
		if ($slide_btns.hasClass('compat')) {
			$slide_btns.stop().hide().css({opacity:'',top:anim_info.height/2}).fadeIn(200).delay(300).fadeOut(300);
		} else {
			setTimeout(function(){ $slide_btns.addClass('animation') }, 10);
			setTimeout(function(){ $slide_btns.addClass('hidden') }, 500);
		}
	};

	var txtLoopUnloop = $box.find('footer a[href=#L] > span').text().split('/');

	$box.find('footer').find('a')
		.filter('[href=#L]').find('>span').text(txtLoopUnloop[0]).end().end()
		.click(function(){
			var $this = $(this);

			if (!/#([A-Z])/.test($this.attr('href'))) return false;

			switch(RegExp.$1) {
				case 'P': stop?play():pause(); break;
				case 'F':
					var $a_fancy = $slideshow.find('a.fancy,a.fancyd');
					$a_fancy.fadeIn('fast').delay(1000).fadeOut('fast');
					break;
				case 'L':
					$box.find('footer a[href=#L] > span').text(txtLoopUnloop[(useLoop=!useLoop)?1:0]);
					break;
			}

			return false;
		});

	function activate() {
		try{ $.infiniteshow.option('disabled', true) }catch(e){};

		$win.on({
			'scroll.slideshow' : function(){
				clearTimeout(_timer);
				_timer = setTimeout(drawGrid, 100);
			},
			'resize.slideshow' : function(){
				rowCount = Math.ceil($win.innerHeight()/190);
				clearTimeout(_timer);
				if (isGrid) _timer = setTimeout(drawGrid, 100);
			}
		});

		// Keyboard navigation
		$(document).on('keydown.slideshow', function(event){
			switch(event.keyCode){
				case 27: // ESC
					if (isGrid) {
						if ($slideshow.is(':visible')) $slideshow.trigger('do:close');
						else deactivate();
					} else {
						deactivate();
					}
					break;
				case 37: // left
				case 74: // 'J'
					$slideshow.find('a.prev').click();
					break;
				case 39: // right
				case 75: // 'K'
					$slideshow.find('a.next').click();
					break;
				case 70: // 'F'
					$box.find('a[href=#F]').click();
					break;
				case 72: // 'H'
					$box.find('a[href=#H]').click();
					break;
				case 76: // 'L'
					$box.find('a[href=#L]').click();
					break;
				case 80: // 'P'
					$box.find('a[href=#P]').click();
					break;
			}
		});

		isGrid = false;

		$html.addClass('slideshow');
		$body.addClass('slideshow').removeClass('grid');
		$slideshow.show();

		$win.resize();
		setPage(curPage=1);
	};

	function deactivate() {
		try{ $.infiniteshow.option('disabled', false) }catch(e){};

		$win.off('scroll.slideshow resize.slideshow');
		$(document).off('keydown.slideshow');

		$html.removeClass('slideshow');
		$body.removeClass('slideshow');

		clearTimeout(show_timer);
	};

	// Activation/Deactivation button
	$(document.body).on('click', '.slideshow-button a, a.btn-slideshow', function(){
		if ($(this).is('a.btn-slideshow')) {
			totalCount = 1000;
			$img_list.find('em').hide();
		}
		activate();
		return false;
	});

	$('#btn-browse').click(function(){
		deactivate();
		return false;
	});

	// detect svg support
	(function(){
		var img = new Image();
		img.onload = function(){ $slide_btns.removeClass('compat'); };
		img.setAttribute('src', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNzUiIGhlaWdodD0iMjc1Ij48L3N2Zz4%3D');
	})();
});

/**
 * @name		jQuery FullScreen Plugin
 * @author		Martin Angelov
 * @version 	1.0
 * @url			http://tutorialzine.com/2012/02/enhance-your-website-fullscreen-api/
 * @license		MIT License
 */
(function(e){function t(){var e=document.documentElement;return"requestFullscreen"in e||"mozRequestFullScreen"in e&&document.mozFullScreenEnabled||"webkitRequestFullScreen"in e}function n(e){e.requestFullscreen?e.requestFullscreen():e.mozRequestFullScreen?e.mozRequestFullScreen():e.webkitRequestFullScreen&&e.webkitRequestFullScreen()}function r(){return document.fullscreen||document.mozFullScreen||document.webkitIsFullScreen}function i(){document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen()}function s(t){e(document).on("fullscreenchange mozfullscreenchange webkitfullscreenchange",function(){t(r())})}e.support.fullscreen=t(),e.fn.fullScreen=function(t){if(!e.support.fullscreen||this.length!=1)return this;if(r())return i(),this;var o=e.extend({background:"#111",callback:function(){}},t),u=e("<div>",{css:{"overflow-y":"auto",background:o.background,width:"100%",height:"100%"}}),a=this;return a.addClass("fullScreen"),u.insertBefore(a),u.append(a),n(u.get(0)),u.click(function(e){e.target==this&&i()}),a.cancel=function(){return i(),a},s(function(e){e||(a.removeClass("fullScreen").insertBefore(u),u.remove()),o.callback(e)}),a}})(jQuery);
