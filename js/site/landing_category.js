jQuery(function($) {
	var code = null;
	var $btns = $('.viewer li'), $stream = $('ol.stream'), $container=$('.container'), $wrapper = $('.wrapper-content'), first_id = 'stream-first-item_', latest_id = 'stream-latest-item_';
	
	$('.sorting .category a').click(function(){
		var $this = $(this), url = $this.data('category'), text = $this.text();
		if(url) loadPage(url,true);
		$('.top-menu-btn').text(text);
		$('.top-menu .sorting a').removeClass('active');
		$this.addClass('active');
		$('.sorting .category').hide();
	});
	

	$.infiniteshow({itemSelector:'#content .stream > li'});

	function loadPage(url, skipSaveHistory){
		var $win     = $(window),
			$stream  = $('#content ol.stream'),
			$lis     = $stream.find('>li'),
			scTop    = $win.scrollTop(),
			stTop    = $stream.offset().top,
			winH     = $win.innerHeight(),
			headerH  = $('#header-new').height(),
			useCSS3  = Modernizr.csstransitions,
			firstTop = -1,
			maxDelay = 0,
			begin    = Date.now();
		$('#infscr-loading').show();
		
		
		
		function arrange(force_refresh){
			var i, c, x, w, h, nh, min, $target, $marker, $first, $img, COL_COUNT, ITEM_WIDTH;

			var ts = new Date().getTime();
			
			$marker = $stream.find('li.page_marker_');

			if(force_refresh || !$marker.length) {
				force_refresh = true;
				bottoms = [0,0,0,0];
				$target = $stream.children('li');
			} else {
				$target = $marker.nextAll('li');
			}

			if(!$target.length) return;

			$first = $target.eq(0);
			$target.eq(-1).addClass('page_marker_');
			$marker.removeClass('page_marker_');
				
			//ITEM_WIDTH  = parseInt($first.width());
			//COL_COUNT   = Math.floor($stream.width()/ITEM_WIDTH);
			ITEM_WIDTH = 230;
			COL_COUNT = 4;
			
			for(i=0,c=$target.length; i < c; i++){
				min = Math.min.apply(Math, bottoms);			

				for(x=0; x < COL_COUNT; x++) if(bottoms[x] == min) break;

				//$li = $target.eq(i);
				$li = $($target[i]);
				$img = $li.find('.figure.vertical > img');
				if(!(nh = $img.attr('data-calcHeight'))){
					w = +$img.attr('data-width');
					h = +$img.attr('data-height');

					if(w && h) {
						//nh = $img.width()/w * h;
						nh = 210/w * h;
						nh = Math.max(nh,150);
						$img.attr('height', nh).data('calcHeight', nh);
					}else{
						nh = $img.height();
					}
				}

				$li.css({top:bottoms[x], left:x*ITEM_WIDTH})
				bottoms[x] = bottoms[x] + nh + 20;
			}
			
			$stream.height(Math.max.apply(Math, bottoms));	
			
		};
		function setView(mode, force){
			if(!force && $container.hasClass(mode)) return;
			var $items = $stream.find('>li');

			if($items.length>100){
				$items.filter(":eq(100)").nextAll().detach();			
			}

			if(!window.Modernizr || !Modernizr.csstransitions ){
				$stream.addClass('loading');
				$wrapper.trigger('before-fadeout');
				$stream.removeClass('loading');
				$wrapper.trigger('before-fadein');
				switchTo(mode);	

				if(mode=='normal'){
					$items.each(function(i,v,a){
						var $li = $(this);
						var $grid_img = $li.find(".figure.grid");
						
						if($li.height()>400){
							$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
						}else{
							$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
						}
					});
				}
				
				$stream.find('>li').css('opacity',1);
				$wrapper.trigger('after-fadein');
				return;
			} 

			$wrapper.trigger('before-fadeout').addClass('anim');
			$stream.addClass('loading');
			var item,
			    $visibles, visibles = [], prevVisibles, thefirst, 
			    offsetTop = $stream.offset().top,
			    hh = $('#header-new').height(),
			    sc = $(window).scrollTop(),
			    wh = $(window).innerHeight(),
				f_right, f_bottom, v_right, v_bottom,
				i, c, v, d, animated = 0;

			// get visible elements
			for(i=0,c=$items.length; i < c; i++){
				item = $items[i];
				if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
					//item.style.visibility = 'hidden';
				} else if (offsetTop + item.offsetTop > sc + wh) {
					//item.style.visibility = 'hidden';
					break;
				} else {
					visibles[visibles.length] = item;
				}
			}
			prevVisibles = visibles;

			// get the first animated element
			for(i=0,c=Math.min(visibles.length,10),thefirst=null; i < c; i++){
				v = visibles[i];
				
				if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
					thefirst = v;
				}
			}

			if(visibles.length==0) fadeIn();
			// fade out elements using delay based on the distance between each element and the first element.
			for(i=0,c=visibles.length; i < c; i++){
				v = visibles[i];

				d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
				delayOpacity(v, 0, d/5);

				if(i == c -1){
					setTimeout(fadeIn,300+d/5);
				}
			}

			function fadeIn(){
				$wrapper.trigger('before-fadein');

				if($wrapper.hasClass("wait")){
					setTimeout(fadeIn, 50);
					return;
				}

				var i, c, v, thefirst, COL_COUNT, visibles = [], item;
				
				if($items.length !== $stream.get(0).childNodes.length || $items.get(0).parentNode !== $stream.get(0)) $items = $stream.find('>li');
				$stream.height($stream.parent().height());
				
				switchTo(mode);

				if(mode=='normal'){
					$items.each(function(i,v,a){
						var $li = $(this);
						var $grid_img = $li.find(".figure.grid");
						
						if($li.height()>400){
							$grid_img.css("background-image", "url("+$grid_img.attr("data-ori-url")+")");					
						}else{
							$grid_img.css("background-image", "url("+$grid_img.attr("data-310-url")+")");
						}
					});
				}

				$stream.removeClass('loading');
				$wrapper.removeClass('anim');

				// get visible elements
				for(i=0,c=$items.length; i < c; i++){
					item = $items[i];
					if (offsetTop + item.offsetTop + item.offsetHeight < sc + hh) {
						//item.style.visibility = 'hidden';
					} else if (offsetTop + item.offsetTop > sc + wh) {
						//item.style.visibility = 'hidden';
						break;
					} else {
						visibles[visibles.length] = item;
						item.style.opacity = 0;
					}
				}
				
				$wrapper.addClass('anim');

				$(visibles).css({opacity:0,visibility:''});
				COL_COUNT = Math.floor($stream.width()/$(visibles[0]).width());

				// get the first animated element
				for(i=0,c=Math.min(visibles.length,COL_COUNT),thefirst=null; i < c; i++){
					v = visibles[i];
					
					if( !thefirst || (thefirst.offsetLeft > v.offsetLeft) || (thefirst.offsetLeft == v.offsetLeft && thefirst.offsetTop > v.offsetTop) ) {
						thefirst = v;
					}
				}

				// fade in elements using delay based on the distance between each element and the first element.
				if(visibles.length==0) done();
				for(i=0,c=visibles.length; i < c; i++){
					v = visibles[i];

					d = Math.sqrt(Math.pow((v.offsetLeft - thefirst.offsetLeft),2) + Math.pow(Math.max(v.offsetTop-thefirst.offsetTop,0),2));
					delayOpacity(v, 1, d/5);

					if(i == c -1) setTimeout(done, 300+d/5);
				}
			};

			function done(){
				$wrapper.removeClass('anim');
				/*if(prevVisibles && prevVisibles.length) {
					for(var i=0,c=visibles.length; i < c; i++){
						if(visibles[i].style.opacity == '0') visibles[i].style.opacity = 1;
					}
				}*/
			$stream.find('>li').css('opacity',1);
				$wrapper.trigger('after-fadein');
			};
			
			function delayOpacity(element, opacity, interval){
				setTimeout(function(){ element.style.opacity = opacity }, Math.floor(interval));
			};

			
			function switchTo(mode){
				var currentMode = $container.hasClass('vertical')?'vertical':($container.hasClass('classic')?'classic':'normal')
				$container.removeClass('vertical normal classic').addClass(mode);
				if(mode == 'vertical') {
					arrange(true);
					$.infiniteshow.option('prepare',2000);
				} else {
					$stream.css('height','');
					$.infiniteshow.option('prepare',4000);
				}
				if($.browser.msie) $.infiniteshow.option('prepare',1000);
				$.cookie.set('timeline-view',mode,9999);
			};

		};
		
		
/*		if(useCSS3){
			$stream.addClass('use-css3').removeClass('fadein');

			$lis.each(function(i,v){
				if(!inViewport(v)) return;
				if(firstTop < 0) firstTop = v.offsetTop;

				var delay = Math.round(Math.sqrt(Math.pow(v.offsetTop - firstTop, 2)+Math.pow(v.offsetLeft, 2)));

				v.className += ' anim';
				setTimeout(function(){ v.className += ' fadeout'; }, delay+10);

				if(delay > maxDelay) maxDelay = delay;
			});
		}

		if(!skipSaveHistory && window.history && history.pushState){
			history.pushState({url:url}, document.title, url);
		}
		location.args = $.parseString(location.search.substr(1));
*/		$.ajax({
			type : 'GET',
			url  : url,
			dataType : 'html',
			success  : function(html){
				
				var $html = $($.trim(html)),
				    $more = $('.pagination > a'),
				    $new_more = $html.find('.pagination > a');

				if($html.find('#content > ol.stream').text() == ''){
					$stream.html('<ol class="stream"><li style="width: 100%;"><p class="noproducts">No more products available</p></li></ol>');
				}else {
			//		$stream.html( $html.find('#content > ol.stream').html());
				}
				if($new_more.length) $('.pagination').append($new_more);
				$more.remove();

				(function(){
					if(useCSS3 && (Date.now() - begin < maxDelay+300)){
						return setTimeout(arguments.callee, 50);
					}

					$stream.addClass('fadein').html( $html.find('#content > ol.stream').html() );
/*					
					if(useCSS3){
						$win.scrollTop(scTop);
						scTop = $win.scrollTop();
						stTop = $stream.offset().top;
						
						firstTop = -1;
						$stream.find('>li').each(function(i,v){
							if(!inViewport(v)) return;
							if(firstTop < 0) firstTop = v.offsetTop;
							
							var delay = Math.round(Math.sqrt(Math.pow(v.offsetTop - firstTop, 2)+Math.pow(v.offsetLeft, 2)));
							
							v.className += ' anim';
							setTimeout(function(){ v.className += ' fadein'; }, delay+10);
							
							if(delay > maxDelay) maxDelay = delay;
						});

						setTimeout(function(){ $stream.removeClass('use-css3 fadein').find('li.anim').removeClass('anim fadein'); }, maxDelay+300);
					}*/

					// reset infiniteshow
					$.infiniteshow({itemSelector:'#content .stream > li'});
				//	$win.trigger('scroll');
					viewMode = $container.hasClass('vertical') ? 'vertical' : ($container.hasClass('normal') ? 'grid':($container.hasClass('grid') ? 'grid':'classic'));
					if(viewMode == 'vertical'){
						setView(viewMode,true);
					}
					$('#infscr-loading').hide();
				})();
			}

		});

		function inViewport(el){
			return (stTop + el.offsetTop + el.offsetHeight > scTop + headerH) && (stTop + el.offsetTop < scTop + winH);
		};
	};
    var tooltip = function(target) {
        var $target = $(target);
        if (!$('#tooltip').length) {
            $('<span>').attr('id','tooltip').appendTo(document.body);
        }
        var $tooltip = $('#tooltip').show();

        $tooltip.text($target.text());
        var o = $target.offset();
        o.left = Math.round(o.left - ($tooltip.width() + 16 - $target.width()) / 2); //16:#tooltip's padding
        o.top = Math.round(o.top - ($tooltip.height() + 9));
        $('#tooltip').offset(o);
    };

    $('.tooltip').hover(function() {
        tooltip(this);
    }, function() {
        $('#tooltip').hide();
    })
	function attachHotkey(){
		$(document).on('keydown.shop', function(event){
			var key = event.which, tid, $li;
			if(!dlg_detail.showing() || (key != 37 /* LEFT */ && key != 39 /* RIGHT */)) return;

			event.preventDefault();

			dlg_detail.$obj.find(key==37?'>.btn-prev':'>.btn-next').click();
		});
	};

	function detachHotkey(){
		$(document).off('keydown.shop');
	};

	(function(){
		var $cate_sel = $('.shop-select.sub-category')
		if($cate_sel.attr('edge')){
			$('ul.sub-category-selectBox-dropdown-menu > li').removeClass('subcategory');
		} else {
			$('ul.sub-category-selectBox-dropdown-menu > li:not(:first-child)').addClass('subcategory');
		}
	})();

	$(window).on('popstate', function(event){
		var e = event.originalEvent;
		if(!e || !e.state) return;

		loadPage(event.originalEvent.state.url, true);
	});

	if(window.history && history.pushState){
		history.pushState({url:location.href}, document.title, location.href);
	}
	
});
