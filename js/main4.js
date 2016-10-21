String.prototype.escape_html = function() {
	var map={'&':'amp','<':'lt','>':'gt','"':'quot'};
	return this.replace(/&|<|>|\"/g, function(c){ return map[c]?'&'+map[c]+';':c });
};

if(typeof String.prototype.trim == 'undefined'){
	String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,'')};
}

String.prototype.startsWith = function(str){
	return (this.indexOf(str) === 0);
}

String.prototype.is_int =function (){
	return (parseFloat(this) == parseInt(this)) && !isNaN(this);
}

Number.prototype.toCurrency = function(n) {
	if (parseFloat(this) == parseInt(this)) {
		return this.toString();
	}
	return this.toFixed(n);
}

// jquery cookie
jQuery.cookie = {
	'get' : function(name){
		var regex = new RegExp('(^|[ ;])'+name+'\\s*=\\s*([^\\s;]+)');
		return regex.test(document.cookie)?unescape(RegExp.$2):null;
	},
	'set' : function(name, value, days){
		var expire = new Date();
		expire.setDate(expire.getDate() + (days||0));
		cookie_str = name+'='+escape(value)+(days?'':';expires='+expire);
		if (name =='lang') cookie_str +='; path=/';
		document.cookie = cookie_str;
	}
};

/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 *  * Build: http://modernizr.com/download/#-csstransitions-testprop-testallprops-domprefixes
 *   */
;window.Modernizr=function(a,b,c){function w(a){i.cssText=a}function x(a,b){return w(prefixes.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b){for(var d in a){var e=a[d];if(!z(e,"-")&&i[e]!==c)return b=="pfx"?e:!0}return!1}function B(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}function C(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+m.join(d+" ")+d).split(" ");return y(b,"string")||y(b,"undefined")?A(e,b):(e=(a+" "+n.join(d+" ")+d).split(" "),B(e,b,c))}var d="2.6.2",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l="Webkit Moz O ms",m=l.split(" "),n=l.toLowerCase().split(" "),o={},p={},q={},r=[],s=r.slice,t,u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=s.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(s.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(s.call(arguments)))};return e}),o.csstransitions=function(){return C("transition")};for(var D in o)v(o,D)&&(t=D.toLowerCase(),e[t]=o[D](),r.push((e[t]?"":"no-")+t));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},w(""),h=j=null,e._version=d,e._domPrefixes=n,e._cssomPrefixes=m,e.testProp=function(a){return A([a])},e.testAllProps=C,e}(this,this.document);

// $.jStorage by Andris Reinman, andris.reinman@gmail.com
(function(g){function m(){if(e.jStorage)try{d=n(""+e.jStorage)}catch(a){e.jStorage="{}"}else e.jStorage="{}";j=e.jStorage?(""+e.jStorage).length:0}function h(){try{e.jStorage=o(d),c&&(c.setAttribute("jStorage",e.jStorage),c.save("jStorage")),j=e.jStorage?(""+e.jStorage).length:0}catch(a){}}function i(a){if(!a||"string"!=typeof a&&"number"!=typeof a)throw new TypeError("Key name must be string or numeric");if("__jstorage_meta"==a)throw new TypeError("Reserved key name");return!0}function k(){var a,
b,c,e=Infinity,f=!1;clearTimeout(p);if(d.__jstorage_meta&&"object"==typeof d.__jstorage_meta.TTL){a=+new Date;c=d.__jstorage_meta.TTL;for(b in c)c.hasOwnProperty(b)&&(c[b]<=a?(delete c[b],delete d[b],f=!0):c[b]<e&&(e=c[b]));Infinity!=e&&(p=setTimeout(k,e-a));f&&h()}}if(!g||!g.toJSON&&!Object.toJSON&&!window.JSON)throw Error("jQuery, MooTools or Prototype needs to be loaded before jStorage!");var d={},e={jStorage:"{}"},c=null,j=0,o=g.toJSON||Object.toJSON||window.JSON&&(JSON.encode||JSON.stringify),
n=g.evalJSON||window.JSON&&(JSON.decode||JSON.parse)||function(a){return(""+a).evalJSON()},f=!1,p,l={isXML:function(a){return(a=(a?a.ownerDocument||a:0).documentElement)?"HTML"!==a.nodeName:!1},encode:function(a){if(!this.isXML(a))return!1;try{return(new XMLSerializer).serializeToString(a)}catch(b){try{return a.xml}catch(d){}}return!1},decode:function(a){var b="DOMParser"in window&&(new DOMParser).parseFromString||window.ActiveXObject&&function(a){var b=new ActiveXObject("Microsoft.XMLDOM");b.async=
"false";b.loadXML(a);return b};if(!b)return!1;a=b.call("DOMParser"in window&&new DOMParser||window,a,"text/xml");return this.isXML(a)?a:!1}};g.jStorage={version:"0.1.7.0",set:function(a,b,c){i(a);c=c||{};l.isXML(b)?b={_is_xml:!0,xml:l.encode(b)}:"function"==typeof b?b=null:b&&"object"==typeof b&&(b=n(o(b)));d[a]=b;isNaN(c.TTL)?h():this.setTTL(a,c.TTL);return b},get:function(a,b){i(a);return a in d?d[a]&&"object"==typeof d[a]&&d[a]._is_xml&&d[a]._is_xml?l.decode(d[a].xml):d[a]:"undefined"==typeof b?
null:b},deleteKey:function(a){i(a);return a in d?(delete d[a],d.__jstorage_meta&&("object"==typeof d.__jstorage_meta.TTL&&a in d.__jstorage_meta.TTL)&&delete d.__jstorage_meta.TTL[a],h(),!0):!1},setTTL:function(a,b){var c=+new Date;i(a);b=Number(b)||0;return a in d?(d.__jstorage_meta||(d.__jstorage_meta={}),d.__jstorage_meta.TTL||(d.__jstorage_meta.TTL={}),0<b?d.__jstorage_meta.TTL[a]=c+b:delete d.__jstorage_meta.TTL[a],h(),k(),!0):!1},flush:function(){d={};h();return!0},storageObj:function(){function a(){}
a.prototype=d;return new a},index:function(){var a=[],b;for(b in d)d.hasOwnProperty(b)&&"__jstorage_meta"!=b&&a.push(b);return a},storageSize:function(){return j},currentBackend:function(){return f},storageAvailable:function(){return!!f},reInit:function(){var a;if(c&&c.addBehavior){a=document.createElement("link");c.parentNode.replaceChild(a,c);c=a;c.style.behavior="url(#default#userData)";document.getElementsByTagName("head")[0].appendChild(c);c.load("jStorage");a="{}";try{a=c.getAttribute("jStorage")}catch(b){}e.jStorage=
a;f="userDataBehavior"}m()}};(function(){var a=!1;if("localStorage"in window)try{window.localStorage.setItem("_tmptest","tmpval"),a=!0,window.localStorage.removeItem("_tmptest")}catch(b){}if(a)try{window.localStorage&&(e=window.localStorage,f="localStorage")}catch(d){}else if("globalStorage"in window)try{window.globalStorage&&(e=window.globalStorage[window.location.hostname],f="globalStorage")}catch(g){}else if(c=document.createElement("link"),c.addBehavior){c.style.behavior="url(#default#userData)";
document.getElementsByTagName("head")[0].appendChild(c);c.load("jStorage");a="{}";try{a=c.getAttribute("jStorage")}catch(h){}e.jStorage=a;f="userDataBehavior"}else{c=null;return}m();k()})()})(window.$||window.jQuery);

// tipsy, facebook style tooltips for jquery, version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// released under the MIT license
(function(e){function t(e,t){return typeof e=="function"?e.call(t):e}function n(e){while(e=e.parentNode)if(e==document)return!0;return!1}function r(t,n){this.$element=e(t),this.options=n,this.enabled=!0,this.fixTitle()}r.prototype={show:function(){var n=this.getTitle();if(n&&this.enabled){var r=this.tip();r.find(".tipsy-inner")[this.options.html?"html":"text"](n),r[0].className="tipsy",r.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).prependTo(document.body);var i=e.extend({},this.$element.offset(),{width:this.$element[0].offsetWidth,height:this.$element[0].offsetHeight}),s=r[0].offsetWidth,o=r[0].offsetHeight,u=t(this.options.gravity,this.$element[0]),a;switch(u.charAt(0)){case"n":a={top:i.top+i.height+this.options.offset,left:i.left+i.width/2-s/2};break;case"s":a={top:i.top-o-this.options.offset,left:i.left+i.width/2-s/2};break;case"e":a={top:i.top+i.height/2-o/2,left:i.left-s-this.options.offset};break;case"w":a={top:i.top+i.height/2-o/2,left:i.left+i.width+this.options.offset}}u.length==2&&(u.charAt(1)=="w"?a.left=i.left+i.width/2-15:a.left=i.left+i.width/2-s+15),r.css(a).addClass("tipsy-"+u),r.find(".tipsy-arrow")[0].className="tipsy-arrow tipsy-arrow-"+u.charAt(0),this.options.className&&r.addClass(t(this.options.className,this.$element[0])),this.options.fade?r.stop().css({opacity:0,display:"block",visibility:"visible"}).animate({opacity:this.options.opacity}):r.css({visibility:"visible",opacity:this.options.opacity})}},hide:function(){this.options.fade?this.tip().stop().fadeOut(function(){e(this).remove()}):this.tip().remove()},fixTitle:function(){var e=this.$element;(e.attr("title")||typeof e.attr("original-title")!="string")&&e.attr("original-title",e.attr("title")||"").removeAttr("title")},getTitle:function(){var e,t=this.$element,n=this.options;this.fixTitle();var e,n=this.options;return typeof n.title=="string"?e=t.attr(n.title=="title"?"original-title":n.title):typeof n.title=="function"&&(e=n.title.call(t[0])),e=(""+e).replace(/(^\s*|\s*$)/,""),e||n.fallback},tip:function(){return this.$tip||(this.$tip=e('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>'),this.$tip.data("tipsy-pointee",this.$element[0])),this.$tip},validate:function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},enable:function(){this.enabled=!0},disable:function(){this.enabled=!1},toggleEnabled:function(){this.enabled=!this.enabled}},e.fn.tipsy=function(t){function i(n){var i=e.data(n,"tipsy");return i||(i=new r(n,e.fn.tipsy.elementOptions(n,t)),e.data(n,"tipsy",i)),i}function s(){var e=i(this);e.hoverState="in",t.delayIn==0?e.show():(e.fixTitle(),setTimeout(function(){e.hoverState=="in"&&e.show()},t.delayIn))}function o(){var e=i(this);e.hoverState="out",t.delayOut==0?e.hide():setTimeout(function(){e.hoverState=="out"&&e.hide()},t.delayOut)}if(t===!0)return this.data("tipsy");if(typeof t=="string"){var n=this.data("tipsy");return n&&n[t](),this}t=e.extend({},e.fn.tipsy.defaults,t),t.live||this.each(function(){i(this)});if(t.trigger!="manual"){var u=t.live?"live":"bind",a=t.trigger=="hover"?"mouseenter":"focus",f=t.trigger=="hover"?"mouseleave":"blur";this[u](a,s)[u](f,o)}return this},e.fn.tipsy.defaults={className:null,delayIn:0,delayOut:0,fade:!1,fallback:"",gravity:"n",html:!1,live:!1,offset:0,opacity:.8,title:"title",trigger:"hover"},e.fn.tipsy.revalidate=function(){e(".tipsy").each(function(){var t=e.data(this,"tipsy-pointee");(!t||!n(t))&&e(this).remove()})},e.fn.tipsy.elementOptions=function(t,n){return e.metadata?e.extend({},n,e(t).metadata()):n},e.fn.tipsy.autoNS=function(){return e(this).offset().top>e(document).scrollTop()+e(window).height()/2?"s":"n"},e.fn.tipsy.autoWE=function(){return e(this).offset().left>e(document).scrollLeft()+e(window).width()/2?"e":"w"},e.fn.tipsy.autoBounds=function(t,n){return function(){var r={ns:n[0],ew:n.length>1?n[1]:!1},i=e(document).scrollTop()+t,s=e(document).scrollLeft()+t,o=e(this);return o.offset().top<i&&(r.ns="n"),o.offset().left<s&&(r.ew="w"),e(window).width()+e(document).scrollLeft()-o.offset().left<t&&(r.ew="e"),e(window).height()+e(document).scrollTop()-o.offset().top<t&&(r.ns="s"),r.ns+(r.ew?r.ew:"")}}})(jQuery);

// make button disabled and add disabled class - by taegon
(function($){$.fn.disable=function(b){if(b==undefined)b=true;this.prop('disabled',b);b?this.addClass('disabled'):this.removeClass('disabled');return this}})(jQuery);

// parse query string - equivalent to parse_string php function
jQuery.parseString = function(str){
	var args = {};
	str = str.split(/&/g);
	for(var i=0;i<str.length;i++){
		if(/^([^=]+)(?:=(.*))?$/.test(str[i])) args[RegExp.$1] = decodeURIComponent(RegExp.$2);
	}
	return args;
};
location.args = jQuery.parseString(location.search.substr(1));

function require_login(next){
	var path = location.pathname.toString();
	if(typeof(next) != 'string' || /^#/.test(next)) next = '';
	if(!next && path !='/' && !/^\/login/.test(path)) next = location.pathname+location.search;

	location.href = '/signup'+(next?'?next='+encodeURIComponent(next):'');

	return false;
}

function scrollToElement(elem, top) {
	var pos = elem.offset().top;
	if (top != undefined) pos -= top;
    $('html, body').animate({scrollTop: pos + 'px'}, 'fast');
}

// support 'placeholder' attribute for older browsers
if(document.forms.length && !('placeholder' in document.createElement('input'))){
	$('input[placeholder], textarea[placeholder]').each(function() {
		var fld=this, $fld=$(this), text=this.getAttribute('placeholder');

		function setPlaceholder() {
			var v = $.trim(fld.value);
			if(v==text||v=='') $fld.val(text).addClass('jqPlaceholder');
		}

		function removePlaceholder() {
			var v = $.trim(fld.value);
			if(v==text||v=='') $fld.val('').removeClass('jqPlaceholder');
		}

		setPlaceholder();
		$fld.focus(removePlaceholder).blur(setPlaceholder).closest("form").submit(removePlaceholder);
	});
}

// auto complete username
(function($){
	var keys = {13 : 'ENTER', 27 : 'ESC', 38 : 'UP', 40 : 'DOWN'};
	var defaults = {
		itemSelector  : 'li',
		selectedClass : 'selected',
		onShowList    : $.noop,
		onHideList    : $.noop,
		onSelect      : $.noop,
		onChange      : $.noop,
		onRequestDone : $.noop
	};

	$.fn.usercomplete = function(options){
		options = $.extend({}, defaults, options);

		var $this = this, $list = $(options.listSelector), $tpl = $list.find('script[type="fancy/template"]'), $par = $tpl.parent(), timer, prev_v='';

		this.data({
			'usercomplete-list'    : $list,
			'usercomplete-tpl'     : $tpl,
			'usercomplete-options' : options
		});

		this
			.on('keydown.usercomplete', function(event){
				var k = keys[event.which];
				if(!k || !$list.length || $list.is(':hidden')) return;

				event.preventDefault();

				if(k == 'ESC') return $list.hide();

				var $children = $par.children(options.itemSelector), $selected = $children.filter('.'+options.selectedClass),  $another;

				if(k == 'ENTER') {
					if($selected.length) options.onSelect($selected);
					hideList();
					return;
				}

				if(!$selected.length) {
					$selected = $children.eq(0).addClass(options.selectedClass);
					options.onChange($selected);
				} else if(k == 'UP'){
					$another = $selected.prev(options.itemSelector);
				} else if (k == 'DOWN'){
					$another = $selected.next(options.itemSelector);
				}

				if(!$another || !$another.length) return;

				$selected.removeClass(options.selectedClass);
				$another.addClass(options.selectedClass);
				options.onChange($another);
			})
			.on('keyup.usercomplete', function(event){
				var v = $.trim(this.value);

				if(v == prev_v) return;
				prev_v = v;

				if(v.length == 0) return hideList();
				showList();

				clearTimeout(timer);
				timer = setTimeout(request, 500);
			});

		$list.on(
			{
				mouseover : function(){
					$par.children().removeClass(options.selectedClass);
					options.onChange($(this).addClass(options.selectedClass));
				},
				click : function(event){
					event.preventDefault();
					options.onSelect($(this));
					hideList();
				}
			},
			options.itemSelector
		);

		function hideList(){
			options.onHideList();
			$list.hide();
		};

		function showList(){
			options.onShowList();
			$list.show();
		};

		function request(){
			var v = $.trim($this.val());

			$.ajax({
				type : 'GET',
				url  : '/search-users.json',
				data : {term : v},
				dataType : 'json',
				success  : function(json){
					if($list.length && $tpl.length) {
						$par.empty();
						for(var i=0,c=json.length; i < c; i++){
							$tpl.template(json[i]).data('usercomplete-data', json[i]).appendTo($par);
						}
					}

					options.onRequestDone(json);
				}
			});
		};

		return this;
	};
})(jQuery);

/**
 * Fancy UI
 */
var Fancy = {
    // Init function
    init: function() {
		Fancy.scrollToTop();
        Fancy.buttons();
		Fancy.followListButtons();
        Fancy.formTips();
		Fancy.verifiedTips();
        Fancy.privateTips();
		Fancy.popupTips();
        Fancy.usersAutoComplete();
        Fancy.validation();
        Fancy.notification();
        Fancy.usernameSyn();
        Fancy.changePass();
        Fancy.filter();
        Fancy.rankPopup();
		Fancy.reportPopup();
        Fancy.fieldFocus();
        Fancy.datePicker();
        Fancy.customize();
		Fancy.selectAllFriends();

	$('.live-chat .chat-set .text-rnd').each(function(){
		var orginTxt = $(this).attr('placeholder');
		if($(this).val()=='') $(this).addClass('placeholder').val(orginTxt).removeAttr('placeholder');
		$(this).focus(function(){
			if($(this).val()==orginTxt) $(this).val('').removeClass('placeholder');
		});
		$(this).blur(function(){
			if($(this).val()=='') $(this).val(orginTxt).addClass('placeholder');
		});
	});
	if ($.browser.msie && parseInt($.browser.version, 10) < 8) {
		Fancy.fixStreamLinking();
	}

    },

    //  Scroll to top
    scrollToTop: function() {
	    var scrollBtn = $("#scroll-to-top");
	    scrollBtn.hide();

	    $(function () {
	    	var lastCheckTime = +(new Date());
		    $(window).scroll(function () {
		    	if( lastCheckTime+1000> +(new Date()) ) return;
		    	lastCheckTime = +(new Date());
			    if ( $(this).scrollTop() > 300) {
				    scrollBtn.fadeIn();
					$('#header-new .live-chat').css('right',$('#scroll-to-top').width()+52+'px');
			    } else {
				    scrollBtn.fadeOut();
					$('#header-new .live-chat').css('right','11px');
			    }
		    });

		    scrollBtn.click(function () {
			    $('body,html').animate({
				    scrollTop: 0
			    }, 800);
			    return false;
		    });
	    });
    },

	// Buttons
	buttons: function() {
		// Follow links
		$('#content,#sidebar')
			.on({
				click : function(event) {
					var $this = $(this), login_require = $this.attr('require_login'), url, following, params;

					event.preventDefault();

					if (typeof(login_require) != undefined && login_require === 'true')  return require_login();
					if ($this.hasClass('loading') || $this.hasClass('list_')) return;

					$this.addClass('loading');

					if (following=$this.hasClass('following')) {
						url = '/delete_follow.xml';
					} else {
						url = '/add_follow.xml';
					}

					params = {user_id : $this.attr('uid')};
					if($this.attr('eid')) params.directory_entry_id = $this.attr('eid');

					$.ajax({
						type : 'post',
						url  : url,
						data : params,
						dataType : 'xml',
						success : function(xml){
							var $xml = $(xml), $st = $xml.find('status_code');
							if ($st.length && $st.text() == 1) {
								if (following) {
									$this[0].lastChild.nodeValue = ($this.attr('linktype')=='private')?'':gettext('Follow');
									$this.removeClass('following');
								} else {
									$this[0].lastChild.nodeValue = gettext('Following');
									$this.addClass('following');

									if($this.attr('linktype') == 'recommended'){
										// remove this recommended user from the list and add new recommendation
										// At first, get id list of shown items
										var shown_ids = '';
										$this.closest('ul,ol').find('.follow-link').each(function(){
											shown_ids += this.getAttribute('uid') + ',';
										});

										$.get('/_single_vcard.html?uids='+shown_ids, function(html){
											var $li = $this.parent('li');
											$li.delay(1000).fadeTo(500, 0.01, function(){ $li.html(html); }).fadeTo(250, 1);
										});
									}
								}
							}
						},
						complete : function(){
							$this.removeClass('loading');
						}
					});

					return false;
				},
				mouseover : function(){
					var $this = $(this);
					if($this.hasClass('following') && this.lastChild && this.lastChild.nodeType == 3) {
						$this.data('following-string', this.lastChild.nodeValue);
						 $this.addClass('dimmed');this.lastChild.nodeValue = gettext('Unfollow');
					}
				},
				mouseout : function(){
					var $this = $(this);
					if($this.hasClass('following') && this.lastChild && this.lastChild.nodeType == 3) {
                                            this.lastChild.nodeValue = $this.data('following-string');
                                            if ($this.hasClass('following'))
                                                $this.removeClass('dimmed');this.lastChild.nodeValue = gettext('Following');
                                        }
				}
			}, '.follow-user-link, .follow-link, .button.follow');
    },

	/**
	 * Follow lists buttons
	 */
	followListButtons: function() {

		// Follow lists button
		var followlistsBtn = $('.button.lists.follow');
		var followinglistsBtn = $('.button.lists.following');
		var txtList;

		/**
		 * Check if there are some lists followed
		 */
		function areFollowed() {
			var numLists = $(".catalog-lists #content .listings li .following").length * 1;
			if (numLists === 0) {
				txtList = ' lists';
				return false;
			} else if (numLists === 1) {
				txtList = ' list';
				return true;
			} else {
				txtList = ' lists';
				return true;
			}
		}

		/**
		 * Count number of followed lists
		 */
		function countFollowedLists() {
			var numLists = $(".catalog-lists #content .listings li .following").length * 1;
			if (numLists === 0) {
				txtList = ' list';
			} else if (numLists === 1) {
				txtList = ' list';
			} else {
				txtList = ' lists';
			}
			return numLists;
		}

		/**
		 * Count total number of lists
		 */
		function countTotalLists() {
			var numLists = $(".catalog-lists #content .listings li").length * 1;
			return numLists;
		}

		/**
		 * Update follow button
		 */
		function updateFollowButton(btn,count) {
			btn.removeClass("follow").addClass("following");
			if (typeof(count) != undefined && count != null){
				btn.attr('cnt',count);
				if (count == 1)
					txtList = ' list';
				else
					txtList = ' lists';
			}
		  }

		function updateProfileFollowButton(btn,count) {
			var profile_button = $('.button.lists.following');
			if (!profile_button.length)
			  profile_button = $('.button.lists.follow')

			if (typeof(count) != undefined && count != null){
				if (count == 0){
				  profile_button.removeClass("following").addClass("follow");
				  return false;
				}
				profile_button.attr('cnt',count);

				if (count == 1)
					txtList = ' list';
				else
					txtList = ' lists';
			}
			if(count>0 && $('.button.lists.follow').length){
			  $('.button.lists.follow').removeClass("follow").addClass("following");
			}

		}

		/**
		 * Update following button
		 */
		function updateFollowingButton(btn,count) {
			btn.removeClass("following").addClass("follow");
			if (typeof(count) != undefined && count != null && count > 0){
				btn.attr('cnt',count);
				if (count == 1)
					txtList = ' list';
				else
					txtList = ' lists';
			}
		}

		// Follow lists button, means no lists are followed yet so basically by clicking follow all lists
		followlistsBtn.live('click', function() {
			var login_require = $(this).attr('require_login');
			if (typeof(login_require) != undefined && login_require != null && login_require=='true'){
				return require_login();
			}

			var selectedRow = $(this);
			var uid = $(this).attr('uid');
			var param = {};
			param['user_id']=uid;
			var btn = $(this).addClass('loading');
			$.post("/add_follow.xml",param,
				function(xml){
					btn.removeClass('loading');
					if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
						selectedRow.attr('cnt','All');
						$(".catalog-lists #content .listings .follow-list-link").removeClass('follow').addClass('following');
						updateFollowButton(selectedRow);
					} else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
					}
				},
				"xml"
				);

			return false;
		});

		// Following some lists already, by clicking it unfollow all lists
		followinglistsBtn.live('click', function() {
			var login_require = $(this).attr('require_login');
			if (typeof(login_require) != undefined && login_require != null && login_require=='true'){
				return require_login();
			}

			var selectedRow = $(this);
			var uid = $(this).attr('uid');
			var param = {};
			param['user_id']=uid;
			var btn = $(this).addClass('loading');
			$.post("/delete_follow.xml",param,
				function(xml){
					btn.removeClass('loading');
					if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
						selectedRow.removeAttr('cnt');
						$(".catalog-lists #content .listings .follow-list-link").removeClass('following').addClass('follow');//.html("Follow");
						updateFollowingButton(selectedRow);
					} else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
					}
				},
				"xml"
			);
			return false;
		});

		// Hover states
		followinglistsBtn.live('mouseenter mouseleave', function(event) {
			var num = $(this).attr('cnt');//countFollowedLists();

			var btn = $(this);
			if (event.type == 'mouseenter') {
				if (typeof(num) != undefined && num != null && num != 'All'){
					if (num == 1)
						txtList = ' list';
					else
						txtList = ' lists';
				}
			}
			else {
				if (typeof(num) != undefined && num != null && num != 'All'){
					if (num == 1)
						txtList = ' list';
					else
						txtList = ' lists';
				}
				btn.removeAttr('style');
			}
		});

		// Follow lists links
		var followuserLinks = $('.follow-list-link');
		var followuserLinksFollowed = $('.follow-list-link.following');

		function updateButtons(count) {
			if (typeof(count)!= undefined && count != null){
				updateProfileFollowButton(followinglistsBtn,count);
			}
			else{
				var num = countFollowedLists();
				if (num == 0) {
					updateFollowingButton(followlistsBtn);
				} else {
					updateFollowButton(followinglistsBtn);
				}

			}
		}

		followuserLinks.live('click', function() {
			var login_require = $(this).attr('require_login');
			if (typeof(login_require) != undefined && login_require != null && login_require=='true') return require_login();

			var selectedRow = $(this);
			if (selectedRow.hasClass('following')) return false;
				var luid = $(this).attr('luid');
				var lid = $(this).attr('lid');
				var param = {};
				param['lid']=lid;
				param['loid']=luid;
				var btn = $(this);
				$.post("/follow_list.xml",param,
				function(xml){
					if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
						var total_count = $(xml).find("count").text();
						selectedRow.addClass("following");
						updateButtons(total_count);
					}
					else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
					}
			}, "xml");
			return false;

		});

		followuserLinksFollowed.live('click', function() {
			var login_require = $(this).attr('require_login');
			if (typeof(login_require) != undefined && login_require != null && login_require=='true') return require_login();

			var selectedRow = $(this);
			var luid = $(this).attr('luid');
			var lid = $(this).attr('lid');
			var param = {};
			param['lid']=lid;
			param['loid']=luid;
			var btn = $(this);
			$.post("/unfollow_list.xml",param,
				function(xml){
					if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
						var total_count = $(xml).find("count").text();
						selectedRow.removeClass("following");
						updateButtons(total_count);
					}
				},
				"xml"
			);

			return false;

		});
	},

    /**
     * Form Tips
     */
    formTips: function() {
        if($('.page-deal-create').length) {
			$('.page-deal-create #content input[title]').tipsy({
				trigger: 'focus',
				gravity: 'n',
				html: true
			});
        }
    },

	verifiedTips: function() {
		$('.nickname span.ico-link[title]').tipsy({
			trigger: 'hover',
			gravity: 's',
			html: true
		});
	},
    privateTips: function() {
		$('.vcard span.ico-private[title]').tipsy({
			trigger: 'hover',
			gravity: 's',
			html: true
		});
	},

	/**
 	* Popup Tips
 	*/
	popupTips: function() {
		$('#new-category[title]').tipsy({
			trigger: 'focus',
			gravity: 's',
			html: true
		});
	},

    /**
     * Users auto complete
     */
     usersAutoComplete: function() {

        if (!$("#users").length) {
            return;
        }

        $.widget("ui.customautocomplete", $.extend({}, $.ui.autocomplete.prototype, {
            _response: function(contents){
                $.ui.autocomplete.prototype._response.apply(this, arguments);
                $(this.element).trigger("autocompletesearchcomplete", [contents]);
            }
        }));


        $("#users").customautocomplete({
            minLength: 0,
            source: "/search-users.json",
            focus: function( event, ui ) {
                $("#users").val( ui.item.username );
                return false;
            },
            select: function( event, ui ) {
                $("#users").val( ui.item.username ).attr('uid', ui.item.id );
                return false;
            }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append('<a><img style="max-width:30px;max-height:30px;" src="' + item.image_url + '" />'  + item.username + "<span>" + item.name + "</span>" + "</a>" )
                .appendTo( ul );
        };

        $("#users").bind("autocompletesearchcomplete", function(event, contents) {
            var users = $('#users');
            if (contents.length === 0) {
                users.removeClass("found");
            }
            else {
                users.addClass("found");
            }
            $('#showpopup form').validate().element("#users");
        });

    },

    /**
    * Validation
    */
    validation: function() {
		var $form = $('.sign #content form');
        if (!$form.length || !$form.validate) return;

        $form.validate({
            rules: {
                password: "required",
                username: "required",
                name: "required"
            },
            messages: {
                email: "Hmm, that doesn't look like a valid email address."
            }
        });
    },

    /**
     * Notification
     */
    notification: function() {
        $('.hide-notification').click(function(){
            $('.notification').slideToggle('slow');
        })
    },

    /* Username */
    usernameSyn : function(){
        var obj = $('input#username');
        if (obj.length){
            obj.keyup(function(){
                obj.next('.username').children('strong').html($('input#username').val().replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;"));
            })
        }
    },

    /**
     * Setting - change password
     */
    changePass: function() {
        $('#change-password').find('.pass-trigger').click( function() {
            $(this).hide();
            $(this).next('ul').animate({
                height: 100
            }, 400 );
            $(this).parent('#change-password').addClass('snp-expanded');
            return false;
        })
    },

    /**
     * Fancy filter
     */
     filter: function() {
        var filter = $('#filter');
        var em = filter.find('h3 em');

        filter.click(function() {
            $(this).toggleClass("expanded");
        });

        filter.find('a').click(function(e) {
            em.html($(this).text());
            e.preventDefault();
        });
     },
	rankPopup: function () {
        if($('#rankpopup').length){
            var showPopup = $('#rankpopup').dialog(Fancy.Popup.options);
            Fancy.Popup.setup(showPopup);

            $('#frank').click(function() {
                showPopup.dialog('open');
            });

            $('#rankpopup .button.ok').click(function() {
                showPopup.dialog('close');
                return false;
            });
        }

	},

	reportPopup: function () {
		var showPopup = $('#reportpopup').dialog(Fancy.Popup.options);
		Fancy.Popup.setup(showPopup);

		$('.report-link').click(function() {
		      var login_require = $(this).attr('require_login');

		      if (typeof(login_require) != undefined && login_require != null && login_require=='true'){
			    require_login();
			    return false;
		      }
			showPopup.dialog('open');
		});

		$('#reportpopup .popup-btns-wrap .button.ok').click(function() {
			$('.report-confirm').show();
			$('.popup-btns-wrap').hide();
			//showPopup.dialog('close');
			return false;
		});

		$('#reportpopup .report-confirm .button.ok').click(function() {
			showPopup.dialog('close');
			$('.report-confirm').hide();
			$('.popup-btns-wrap').show();
			return false;
		});

	},

	fieldFocus: function () {
			var sfEls = document.getElementsByTagName("INPUT");
			for (var i=0; i<sfEls.length; i++) {
				if(sfEls[i].type != 'text') continue;
				sfEls[i].onfocus=function() {
					$(this).addClass('sffocus').parent().addClass("hastext");
				}
				sfEls[i].onblur=function() {
					this.className=this.className.replace(new RegExp(" sffocus\\b"), "");
				}

			}
	},

	datePicker: function () {
		$("#deal-end, #deal-start, #store_deal_expiration").datepicker();
	},


    fixStreamLinking: function () {
	    $("#content .fig-image").click(function() {
		    window.location = $(this).parents("a").attr("href");
	    });
    },
    customize: function () {
    $("#content div.customize .toggle").click(function() {
        $(this).parents(".customize").addClass("opened");
        return false;
    });

    $("#content div.customize .send").click(function() {
        var show_featured_items = $('#content div.customize #show_featured_items').is(':checked');
        var show_followed_adds = $('#content div.customize #show_followed_adds').is(':checked');
        var show_shown_to_you = $('#content div.customize #show_shown_to_you').is(':checked');
        var show_followed_fancyd = $('#content div.customize #show_followed_fancyd').is(':checked');

        var selectedRow = $(this);
        var param = {};
        param['show_featured_items']=show_featured_items;
        param['show_followed_adds']=show_followed_adds;
        param['show_shown_to_you']=show_shown_to_you;
        param['show_followed_fancyd']=show_followed_fancyd;

        $.post("/update_timeline.xml",param,
            function(xml){
                if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==1) {
                    selectedRow.parents(".customize").removeClass("opened");
                    location.reload(false);

                }
                else if ($(xml).find("status_code").length>0 && $(xml).find("status_code").text()==0) {
                    alert($(xml).find("message").text());
                }
        }, "xml");
        return false;
    });
},


	/**
	 * Select all friends checkboxes
	 */
	selectAllFriends: function () {
		if (!$("#content .friends-list").length) {
			return;
		}

		var all = $("#all");
		var checkboxes = $("#content .friends-list ul input[type=checkbox]");
		var all_link = $("#content .friends-list .selected a");

		function toggleAll() {
			if (all.is(':checked')) {
				checkboxes.attr("checked", "checked");
			} else {
				checkboxes.removeAttr("checked", "");
			}
		}

		all_link.bind("click", function() {
			all.attr('checked', !all.is(':checked'));
			toggleAll();
			return false;
		});

		all.bind("click", function() {
			toggleAll();
		});

		checkboxes.bind("click", function() {

			var checked = $("#content .friends-list ul input[type=checkbox]:checked");

			if (checked.length === checkboxes.length) {
				all.attr("checked", "checked");
			} else {
				all.removeAttr("checked", "");
			}
		});
	}



}

/**
 * Fancy popups default setting
 */
Fancy.Popup = {

    /**
     * Default options
     */
    options: {
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
                $(".ui-dialog-content.ui-widget-content").css({
                    width: '356px'
                });
            },
            autoOpen: false,
            closeOnEscape: true,
            draggable: false,
            closeText: 'Cancel'
    },

    /**
     * Other setting
     */
    setup: function(popup,fixed) {
        // Close by clicking on Cancel
        popup.find('.button.cancel').click(function(){
            $(".tipsy").hide();
            popup.dialog('close');
            return false;
        });

		// Make it draggable
		if (fixed) {
		} else {
			popup.draggable({ "handle": 'h3' });
		}
    }
}

// template
jQuery.fn.template = function(args) {
	if(!args) args = {};
	var html = jQuery.trim(this.html()).replace(/##([a-zA-Z0-9_]+)##/g, function(whole,name){
		return args[name] || '';
	});

	return jQuery(html);
};

// hotkey
(function($){
	var $body;

	$.fn.hotkey = function(hotkey, handler){
		if($.isPlainObject(hotkey)) {
			var _this = this;
			$.each(hotkey, function(_hotkey, _handler){
				_this.hotkey(_hotkey, _handler);
			});
			return;
		}

		hotkey = parse(hotkey);
		if(!hotkey) return this;

		var $el = this;
		if($el.get(0) === window || $el.get(0) === document) $el = $body;

		var handlers = $el.data('hotkey-handlers'), strHotkey = serialize(hotkey);
		if(!handlers){
			$el.data('hotkey-handlers', handlers={});
			$el.on('keydown', keyHandler);
		}

		handlers[strHotkey] = handler;

		return this;
	};

	$.hotkey = function(){
		if(!$body) $body = $('body');
		$body.hotkey.apply($body, arguments);
	};

	$.hotkey.specialKeys = {
		BACKSPACE:8, TAB:9, ENTER:13, RETURN:13, PAUSE:19, CAPSLOCK:20,
		'ESC':27, SPACE:32, PAGEUP:33, PGUP:33, PAGEDOWN:34, PGDN:34, END:35, HOME:36,
		LEFT:37, UP:38, RIGHT:39, DOWN:40, INSERT:45, INS:45, DELETE:46, DEL:46,
		';':186, '=':187, ',':188, '-':189, '.':190, '/':191, '`':192,
		"'":222
	};

	function parse(strHotkey){
		var ret = {altKey:false, ctrlKey:false, shiftKey:false, metaKey:false, keyCode:null}, keys = strHotkey.replace(/\s+/g,'').toUpperCase().split('+'), i, c;

		for(i=0,c=keys.length; i < c; i++){
			if(keys[i] == 'CTRL'){
				ret.ctrlKey = true;
			} else if(keys[i] == 'ALT'){
				ret.altKey = true;
			} else if(keys[i] == 'SHIFT'){
				ret.shiftKey = true;
			} else if(/^[A-Z0-9]$/.test(keys[i])){
				ret.keyCode = keys[i].charCodeAt(0);
			} else {
				ret.keyCode = $.hotkey.specialKeys[keys[i]] || null;
			}
		};

		return (ret.keyCode === null)?false:ret;
	};

	function serialize(objHotkey){
		var arr = [];

		if(objHotkey.ctrlKey)  arr.push('CTRL');
		if(objHotkey.altKey)   arr.push('ALT');
		if(objHotkey.shiftKey) arr.push('SHIFT');
		if(objHotkey.keyCode)  arr.push(getSpecialKey(objHotkey.keyCode) || String.fromCharCode(objHotkey.keyCode));

		return arr.join('+');
	};

	function getSpecialKey(code){
		for(var k in $.hotkey.specialKeys){
			if(code == $.hotkey.specialKeys[k]) return k;
		}
		return false;
	};

	function keyHandler(event){
		var $this = $(this), handlers = $this.data('hotkey-handlers'), strHotkey = serialize(event);

		if(!handlers || !(strHotkey in handlers)) return;

		handlers[strHotkey].call(this, event);
	};
})(jQuery);

Fancy.Cart = {
	addItem : function(args) {
		var $popup = $('#cart_popup, #cart-new .feed-cart'), $ul = $popup.find('>table>tbody');
		var $item  = $('#cartitem-'+args['ITEMCODE']), price, quantity;

		quantity = parseInt(args['QUANTITY']) || 0;
		price    = parseFloat(args['PRICE']) || 0;

		if($item.length) {
			quantity += parseInt($item.data('quantity'));
			price += parseFloat($item.data('price'));
			$item
				.find('span.info span, td.qty').text(quantity).end()
				.find('span.price, td.price').text('$'+price.toFixed(2).replace(/\.?0+$/, ''));
		} else {
			$item = $popup.find('>script[type="fancy/template"]').template(args).appendTo($ul);
		}

		$item.data('options', args['OPTIONS']||'').data('price', price).data('quantity', quantity);

		this.update();

		// Send to MyThings
		window.MyThingsProductID = args['THING_ID'];
		if(typeof MyThings == 'undefined'){
			window._mt_ready = _mt_ready_cart;
			$('<script src="'+mtHost+'/c.aspx?atok='+mtAdvertiserToken+'" async="true"></script>').appendTo('body');
		} else {
			_mt_ready_cart();
		}

        var $nani = $("#nanigans_event");
        if ($nani.length) {
            var ut1 = $nani.attr("ut1"), userid = $nani.attr("userid");
            var tag = $("<img/>")
                .css("display", "none")
                .attr("src", "//api.nanigans.com/event.php?app_id=21214&type=user&name=add_to_cart&user_id=" + userid + "&qty=" + args["QUANTITY"] + "&value=" + parseInt(parseFloat(args['PRICE']) * 100) + "&sku=" + args['THING_ID'] + "&ut1=" + ut1);
            $('body').append(tag);
        }
	},

	updateItem : function(args) {
		var $popup = $('#cart_popup, #cart-new .feed-cart'), $ul = $popup.find('>table>tbody');
		var $item  = $('#cartitem-'+args['ITEMCODE']), price, quantity;

		quantity = parseInt(args['QUANTITY']) || 0;
		price    = parseFloat(args['PRICE']) || 0;

		if($item.length) {
			quantity = parseInt($item.data('quantity'));
			price = parseFloat($item.data('price'));
			$item.find('span.info span,td.qty').text(quantity).end().find('span.price,td.price').text('$'+price.toFixed(2).replace(/\.?0+$/, ''));
		} else {
			$item = $popup.find('>script[type="fancy/template"]').template(args).appendTo($ul);
		}

		$item.data('options', args['OPTIONS']||'').data('price', price).data('quantity', quantity);
		this.update();
	},

	update : function() {
		var count = 0, price = 0, txt;

		$('#cart_popup > ul > li, #cart-new #cart_popup tbody > tr').each(function(){
			var $this = $(this);
			var q = parseInt($this.data('quantity')) || 0;
			var p = parseFloat($this.data('price')) || 0;

			if(q == 0) {
				$item.remove();
				return;
			}

			count += q;
			price += p;
		});

		if(count) {
			txt = count+' '+(count>1?gettext('items'):gettext('item'));

			$('#cart em').show().text(count);
			$('#cart_popup > .summary')
				.find('>strong').text(count+' item'+(count>1?'s':'')).end()
				.find('>span').text('Total: $'+price.toFixed(2).replace(/\.?0+$/,''));
			$('#cart-new').addClass('hover');

			var $s = $('#cart-new').removeClass('hide').find('a.mn-cart > span:last')
			$s.fadeOut(function(){ $s.text(txt) }).fadeIn();
		} else {
			$('#cart em').hide();
			$('#cart_popup > .summary')
				.find('>strong').text('No item').end()
				.find('>span').text('Total: $0');

			$('#cart-new').addClass('hide');
		}
	},

	openPopup : function() {
		if(!$('#cart').is(':visible')) {
			$('#cart').show();
			$('#cart-new').show();
		}
		if(!$('#cart_popup').is(':visible')) {
			$('#cart').mouseenter();
			$('#cart-new').mouseenter();
		}
	},

	hidePopup : function() {
		if($('#cart_popup').is(':visible')) {
			$('#cart').mouseleave();
			$('#cart-new').mouseleave();
		}
	}
};

// Cart popup layer
jQuery(function(){
	var $link = $('#cart'), $layer = $('#cart_popup'), timer = null;

	function hideCartPopup(){
		$layer.hide();
		$link.removeClass('active');
	};

	$link
		.mouseenter(function(){
			clearTimeout(timer);
			$link.addClass('active');
			$layer.show().css('top', $link[0].offsetTop + $link[0].offsetHeight + 'px');
		})
		.mouseleave(function(){
			timer = setTimeout(hideCartPopup, 100);
		});

	$layer
		.mouseenter(function(){
			clearTimeout(timer);
		})
		.mouseleave(function(){
			timer = setTimeout(hideCartPopup, 100);
		});

	// new cart
	var $mn = $('#cart-new'), $lnk = $mn.find('a.mn-cart'), $ly = $mn.find('div.feed-cart');

	$mn
		.mouseenter(function(){
			$layer.show();
		})
		.mouseleave(function(){
			$layer.hide();
		});

    Fancy.init();
});

// filter
$('#filter').each(function() {
	var filter = $(this);
	filter.find('h3')
	.parent().find('a').click(function() {
		filter.toggleClass("expanded").find('em').text($(this).text());
		location.href = $(this).attr('href');
	    return false;
	});
});

function show_overlay_on_timeline() {
	$('#content')
		.delegate(
			'.figure-product',
			{
				mouseover : function(){
					var $this = $(this), $timeline = $this.find('.timeline');
					if (!$timeline.length) return;

					var $img = $this.find('img'), pos = $img.position(), w = $img.width(), h = $img.height();
                    if (w>640) w=640;
					$timeline
						.filter(':hidden').css('opacity',0).end()
						.show()
						.stop()
						.css({width:(w-54)+'px',height:(h-12)+'px',top:pos.top+'px',left:pos.left+'px'})
						.fadeTo(200,1);

					if (h < 110) $timeline.find('.btn-share').hide();
				},
				mouseleave : function(event){
					var $timeline = $(this).find('.timeline').stop().fadeTo(100,0,function(){$timeline.hide()});
				}
			}
		);
}

show_overlay_on_timeline();

// CSRF
(function($){
	function getCookie(name) {
		var cookies = document.cookie.split(';');
		for (var i=0,c=cookies.length; i < c; i++) {
			var cookie = $.trim(cookies[i]);
			// Does this cookie string begin with the name we want?
			if (cookie.substring(0, name.length + 1) == (name + '=')) {
				return decodeURIComponent(cookie.substring(name.length + 1));
			}
		}
		return null;
	}
	function sameOrigin(url) {
		// url could be relative or scheme relative or absolute
		var host = location.host; // host + port
		var protocol = location.protocol;
		var sr_origin = '//' + host;
		var origin = protocol + sr_origin;
		// Allow absolute or scheme relative URLs to same origin
		return (url == origin || url.slice(0, origin.length + 1) == origin + '/') ||
			(url == sr_origin || url.slice(0, sr_origin.length + 1) == sr_origin + '/') ||
			// or any other URL that isn't scheme relative or absolute i.e relative.
			!(/^(\/\/|https?:).*/.test(url));
	}
	$.ajaxPrefilter(function(options, originalOptions, jqXHR){
		if(options.type.toUpperCase() == 'POST' && sameOrigin(options.url)){
			var v = getCookie('csrftoken');
			if(v && v.length){
				if(!options.headers) options.headers = {};
				options.headers['X-CSRFToken'] = v;
			}
			// prevent cache to avoid iOS6 POST bug
			options.url += ((options.url.indexOf('?') > 0)?'&':'?')+'_='+(new Date).getTime();
		}
	});
})(jQuery);

// group gift images
jQuery(function($){
	$('.giftgroup .figure-product img')
		.css('opacity', 0)
		.load(function(){
			var $this=$(this), $div = $this.closest('.figure-product');

			if(this.width > this.height) {
				$this.height('100%').css('margin-left', parseInt(($div.width() - $this.width())/2)+'px');
			} else {
				$this.width('100%').css('margin-top', parseInt(($div.height()- $this.height())/2)+'px');
			}

			$this.fadeTo(500, 1);
		})
		.each(function(){
			if(this.width && this.height) $(this).trigger('load');
		});
});

// Infiniteshow
(function($){
	var options;
	var defaults = {
		dataKey : '',
		loaderSelector : '#infscr-loading', // an element to be displayed while calling data via ajax.
		itemSelector : '#content .inside-content .figure-row',
		nextSelector   : 'a.btn-more', // elements which head for next data.
		streamSelector : '.stream',
		prepare   : 4000, // indicates how many it should prepare (in pixel)
		prefetch  : false, // whether or not prefetch next page
		newtimeline : false, // is new timeline
		dataType  : 'html', // the type of ajax data.
		success   : function(data){}, // a function to be called when the request succeeds.
		error     : function(){ }, // a function to be called if the request fails.
		comeplete : function(xhr, st){} // a function to be called when the request finishes (after success and error callbacks are executed).
	};

	$.infiniteshow = function(opt) {
		options = $.extend({}, defaults, opt);

		var $win = $(window),
		    $doc = $(document),
		    ih   = $win.innerHeight(),
			$url = $(options.nextSelector).hide(),
			$str = $(options.streamSelector),
			loc  = $str.attr('loc'),
			url  = $url.attr('href'),
			bar  = $('div.pagination'),
			ttl  = 5 * 60 * 1000,
			calling = false;
			prefetching = false;
			ignorePrefecth = false;
			lastFetchedUrl = null;			

		var keys = {
			timestamp : 'fancy.'+options.dataKey+'.timestamp.'+loc,
			stream  : 'fancy.'+options.dataKey+'.stream.'+loc,
			latest  : 'fancy.'+options.dataKey+'.latest.'+loc,
			nextURL : 'fancy.'+options.dataKey+'.nexturl.'+loc,
			prefetch : 'fancy.prefetch.stream'
		};

		(function(){
			var data      = $.jStorage.get(keys.stream, ''),
				latest    = $.jStorage.get(keys.latest, ''),
				nextURL   = $.jStorage.get(keys.nextURL, ''),
				timestamp = $.jStorage.get(keys.timestamp, 0);

			$.jStorage.deleteKey(keys.prefetch);
			if(!data || !latest || !nextURL || (+new Date - timestamp > ttl)){
				for(var name in keys) $.jStorage.deleteKey(keys[name]);
				return;
			}			

			$url.attr('href', url=nextURL);
			$str.html(data).attr('ts',latest);

			if(options.prefetch) prefetch(nextURL);

			// get fancyd state only for latest 100 items
			var tids = [], items = {};
			$(options.itemSelector).slice(-100).each(function(){
				var $btn = $(this).find('.button.fancy,.button.fancyd'), tid = $btn.attr('tid');
				tids.push( tid );
				items[tid] = $btn;
			});

			$.ajax({
				type : 'POST',
					url  : '/user_fancyd_things.json',
				data : {object_ids : tids.join(',')},
				dataType : 'json',
				success  : function(json){
					var fancyd = {}, $btn;
					for(var i=0,c=json.length; i < c; i++){
						fancyd[ json[i].object_id ] = json[i].id;
					}

					for(var k in items){
						if(fancyd[k]){
							$btn = items[k].find('.button.fancy');
							if($btn.length) $btn.toggleClass('fancy fancyd').attr('rtid', fancyd[k]).contents().get(-1).nodeValue = gettext("Fancy'd");
						} else {
							$btn = items[k].find('.button.fancyd');
							if($btn.length) $btn.toggleClass('fancy fancyd').removeAttr('rtid').contents().get(-1).nodeValue = gettext('Fancy it');
						}
					}
				}
			});
		})();

		function docHeight() {
			var d = document;
			return Math.max(d.body.scrollHeight, d.documentElement.scrollHeight);
		};

		function prefetch(url){
			prefetching = true;
			if(!url || typeof url == 'object') url = $url.attr('href');
			if(url==lastFetchedUrl){
				$.jStorage.deleteKey(keys.prefetch);
				prefetching = false;
				return;
			}
			lastFetchedUrl = url;
            /*if(typeof url != 'string'){
                lastFetchedUrl = '';
                return; 
            }*/
			$.ajax({
				url : url,
				dataType : options.dataType,
				success : function(data, st, xhr) {
					if(!ignorePrefecth)
						$.jStorage.set(keys.prefetch,data,{TTL:ttl});
					ignorePrefecth = false;
					prefetching = false;
				},
				error : function(xhr, st, err) {
					$.jStorage.deleteKey(keys.prefetch);
					ignorePrefecth = false;
					prefetching = false;
				}
			});
		}

		function onScroll() {

			url = $url.attr('href');
			if (calling || !url || options.disabled) return;

			calling = true;

			var rest = docHeight() - $doc.scrollTop();
			if (rest > options.prepare){
				calling = false;
				return;
			}

			var $loader = $(options.loaderSelector).show();

			function appendThings(data){
                if (options.disabled) {
                    $.jStorage.deleteKey(keys.prefetch);
                    return;
                }
				var $sandbox = $('<div>'),
				    $contentBox = $(options.itemSelector).parent(),
					$next, $rows;

				$sandbox[0].innerHTML = data.replace(/^[\s\S]+<body.+?>|<((?:no)?script|header|nav)[\s\S]+?<\/\1>|<\/body>[\s\S]+$/ig, '');
				$next = $sandbox.find(options.nextSelector);
				//$rows = $sandbox.find(options.itemSelector);
				$rows = $sandbox.find(options.itemSelector).parent().html();

				$contentBox.append($rows);
				if ($next.length) {
					url = $next.attr('href');
					$url.attr({
						'href' : $next.attr('href'),
						'ts'   : $next.attr('ts')
					});
					if(options.prefetch) prefetch($next.attr('href'));
				} else {
					url = '';
					$url.attr({
						'href' : '',
						'ts'   : ''
					});
				}

				if(!options.newtimeline)
					$win.trigger('savestream.infiniteshow');

				// Triggers scroll event again to get more data if the page doesn't have enough data still.
				onScroll();

                if (options.post_callback != null) {
                    options.post_callback($rows);
                }
				$('<style></style>').appendTo($(document.body)).remove();
			}

			if( options.prefetch && !prefetching && (data=$.jStorage.get(keys.prefetch)) ){		
				$.jStorage.deleteKey(keys.prefetch);		
				appendThings(data);
				calling = false;
				$loader.hide();
			}else{
				//if(prefetching) ignorePrefecth = true;
				if(prefetching) {
					calling = false;
					setTimeout(onScroll,300);
					//$loader.hide();					
					return;
				}
				$.jStorage.deleteKey(keys.prefetch);
				$.ajax({
					url : url,
					dataType : options.dataType,
					success : function(data, st, xhr) {
						appendThings(data);
					},
					error : function(xhr, st, err) {
						url = '';
					},
					complete : function(){
						calling = false;
						$loader.hide();
					}
				});
			}
		};

		$win.off('resize.infiniteshow').on('resize.infiniteshow', function(){ ih = $win.innerHeight(); onScroll(); });
		$win.off('scroll.infiniteshow').on('scroll.infiniteshow', onScroll);
		$win.off('savestream.infiniteshow').on('savestream.infiniteshow', function(){
			loc = $str.attr('loc');
			if(!$str.length || !options.dataKey) return;

			var keys = {
				timestamp : 'fancy.'+options.dataKey+'.timestamp.'+loc,
				stream  : 'fancy.'+options.dataKey+'.stream.'+loc,
				latest  : 'fancy.'+options.dataKey+'.latest.'+loc,
				nextURL : 'fancy.'+options.dataKey+'.nexturl.'+loc
			};

			var data = $str.html().replace(/>\s+</g,'><');
			$.jStorage.set(keys.timestamp, +new Date, {TTL:ttl});
			$.jStorage.set(keys.stream, data, {TTL:ttl});
			$.jStorage.set(keys.latest, $str.attr('ts'), {TTL:ttl});
			$.jStorage.set(keys.nextURL, url, {TTL:ttl});
		});
		$win.off('prefetch.infiniteshow').on('prefetch.infiniteshow', prefetch);

		onScroll();
	};

	$.infiniteshow.option = function(name, value) {
		if (typeof(value) == 'undefined') return options[name];
		options[name] = value;

		if (name == 'disabled' && !value) onScroll();
	};
})(jQuery);

// top menu bar
jQuery(function($){
	var $nav = $('#navigation-test'), $cur = null, cur_len = 0;

	$nav
		.on(
			{
				mouseover : function(){ $(this).addClass('hover'); },
				mouseout  : function(){ $(this).removeClass('hover'); }
			},
			'li.gnb, .menu-contain-gift li'
		)
		.find('li > a').each(function(){
			var $this = $(this), path = $this.attr('href');

			if(path == '/' || path == '#') return;
			if(location.pathname.indexOf(path) == 0 && path.length > cur_len){
				$cur = $this;
				cur_len =  path.length;
			}
		});
		if($cur) $cur.addClass('current');

	// browse menu
	(function(item_w){
		$('.menu-contain-things')
			.show()
			.find('>ul>li')
				.each(function(){ item_w = Math.max(item_w, this.offsetWidth) })
				.width(item_w)
				.parent().width(item_w * 2).end()
			.end()
			.css('display','');
	})(0);

	// live support layer open when live support opened at previous page
	try {
		if( $.jStorage.get('live_support') == 'on' ){
			open_chat( $.jStorage.get('live_support_minimum') );
		}
	} catch(e){};

	// search form
	(function(){
		var $search_form = $nav.find('form.search'),
		    $textbox = $search_form.find('#search-query'),
			$suggest = $search_form.find('.feed-search'),
		    $loading = $search_form.find('.loading'),
		    $things  = $search_form.find('ul.thing'),
			$users   = $search_form.find('ul.user'),
		    $tpl_thing   = $('#tpl-search-suggestions-things').remove(),
		    $tpl_user    = $('#tpl-search-suggestions-users').remove(),
			prev_keyword = $.trim($textbox.val()), timer = null,
			keys = {
				13 : 'ENTER',
				27 : 'ESC',
				38 : 'UP',
				40 : 'DOWN'
			};

		$search_form.on('submit', function(){
			var v = $.trim($textbox.val());
			if(!v) return false;
		});

		$textbox
			// highlight submit button when the textbox is focused.
			.on({
				focus : function(){ $nav.find('.search .btn-submit').addClass('focus') },
				blur  : function(){ $nav.find('.search .btn-submit').removeClass('focus') }
			})
			// search things and users as user types
			.on({
				keyup : function(event){
					var kw = $.trim($textbox.val());

					if(keys[event.which]) return;
					if(!kw.length) return $suggest.hide();
					if(kw.length && kw != prev_keyword) {
						prev_keyword = kw;

						$things.hide();
						$users.hide();
						$loading.show();
						$suggest.show();

						clearTimeout(timer);
						timer = setTimeout(function(){ find(kw) }, 500);
					}
				},
				keydown : function(event){
					var k = keys[event.which];

					if($suggest.is(':hidden') || !k) return;

					event.preventDefault();

					var $items = $suggest.find('a'), $selected = $items.filter('.hover'), idx;

					if(k == 'ESC') return $suggest.hide();
					if(k == 'ENTER') {
						if($selected.length) {
							window.location.href = $suggest.find('a.hover').attr('href');
						} else {
							$search_form.submit();
						}
						return;
					}

					if(!$selected.length) {
						$selected = $items.eq(0).mouseover();
						return;
					}

					idx = $items.index($selected);

					if(k == 'UP' && idx > 0) return $items.eq(idx-1).mouseover();
					if(k == 'DOWN' && idx < $items.length-1) return $items.eq(idx+1).mouseover();
				}
			});

		$suggest.delegate('a', 'mouseover', function(){ $suggest.find('a.hover').removeClass('hover'); $(this).addClass('hover'); });

		function find(word){
			$search_form.find('a.more').attr('href', '/search?q='+encodeURIComponent(word));
			$.ajax({
				type : 'GET',
				url  : '/search-suggestions.json',
				data : {q:word},
				dataType : 'json',
				success  : function(json){
					try {
						if(json.things.length) $things.empty().show();
						$.each(json.things, function(i,v,a){
							$tpl_thing.template({URL:v.html_url, NAME:highlight(v.name, word)}).appendTo($things);
						});

						if(json.users.length) $users.empty().show();
						$.each(json.users, function(i,v,a){
							$tpl_user.template({URL:v.html_url, IMG_URL:v.image_url, USERNAME:highlight(v.username, word), FULLNAME:v.name}).appendTo($users);
						});

						$loading.hide();
					} catch(e) {
// 						console.log(e);
					}
				}
			});
		};

		function highlight(str, substr){
			var regex = new RegExp('('+encodeURIComponent(substr.replace(/ /g,'-')).replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&')+')', 'i');
			return str.replace(regex, '<strong>'+substr+'</strong>');
		};

		$(document).click(function(){ if($suggest.is(':visible')) $suggest.hide() });
	})();
});

// support tap interface
(function($){
	var $links = $('a.mn-browse,a.mn-you,a.mn-help,a.mn-gifts');
	$links
		.on('focus', function(){
			this.parentNode.className = 'gnb hover';
		})
		.on('blur', function(){
			this.parentNode.className = 'gnb';
		})
		.on('touchstart', function(){
			if(this.parentNode.className == 'gnb hover'){
				return true;
			}else{
				this.focus();
				return false;
			}
		});
})(jQuery);

jQuery(function($){
	//user icon
	$('.user-section .social-accounts a,.user-section .vcard .fn a').each(function(){
		var tool = $(this).find(".tooltip");
		$(this).mouseover(function(){
			$(tool).css("margin-left",(-($(tool).width()/2)-7)+"px");
		});
	});

	// banner close button
	$('.container > .banner_  .close_').click(function(event){
		event.preventDefault();

		var $this = $(this), cookie_name = $this.attr('rel'), expires = new Date();
		$this.closest('.banner_').hide();
		expires.setDate(expires.getDate() + 14); // two weeks
		document.cookie = cookie_name + '=true; path=/; expires='+expires.toUTCString();
	});

	// show gift reommendation
	$('.gift-banner.recommend_ .btn-rnd-blue').click(function(event){
		event.preventDefault();
		$('.gift-recommend').show();
	});

	// gift guide
	$('.gift-banner.guide_ .btn-rnd-blue').click(function(event){
		event.preventDefault();
		location.href = '/gifts/index';
	});

	// gift recommendation popup
	(function(){
		var $popup = $('.gift-recommend');

		// show gift recommendation popup
		$('.menuitem-gift-recommend').click(function(event){
			event.preventDefault();
			$.dialog('gift-recommend').open();
			return false;
		});
		$popup.find('.btn-share').click(function(event){
			event.preventDefault();

			var gender = $(this).parents('.gift-recommend').find('#gift-for').val();
			var category = $(this).parents('.gift-recommend').find('#gift-cat').val();
			var price = $(this).parents('.gift-recommend').find('#gift-price').val();
            //alert(gender);alert(category);alert(price);
            var txt_area = $(this).parents('.gift-recommend').find('textarea');
			var default_txt = txt_area.attr('placeholder');
			var txt = txt_area.val();
			if (txt == default_txt || txt.length < 20) {
				alert(gettext("Please give us some more details so we can help you find an amazing gift!"));
				return false;
			}

            $.ajax({
				url: '/ask_gift_expert.json',
				type: 'post',
				data: {text: txt, gender: gender, category: category, price: price},
				dataType: 'json',
				success: function(json) {
					if (json.status_code == 1) {
						alert(json.message);
						$.dialog('gift-recommend').close();
						$('.gift-banner .close_').click();
					}
					else {
						alert(json.message);
					}
				}
			});
		}).end()
	})();

	// notification bar
	(function(){
		var $nb = $('#notification-bar'), $fg = $nb.find('>div.for-general'), uid = $fg.attr('uid'), $ir = $('#invitation-reminder');

		if (!$fg.length) return;
		if ($ir.length && $ir.is(':visible')) return;
		if (document.cookie.match(new RegExp('\\b'+uid+'=1'))) return;

		var $container = $('#header~.container:first').animate({'padding-top':'+=55px'},'fast');

		$nb
			.find('>div').hide().end()
			.find('>div.for-general').show().end()
			.slideDown('fast')
			.find('button.close')
				.click(function(){
					$nb.slideUp('fast').filter(':not(.top)').parent({'padding-top':'-=20px'}, 'fast');
					$container.animate({'padding-top':'-=55px'}, 'fast');

					// set cookie to avoid to bother users
					var expire = new Date();
					expire.setDate(expire.getDate() + 7);
					document.cookie = uid+'=1; path=/; expires='+expire.toUTCString();
				})
			.end()
			.filter(':not(.top)')
			.parent().animate({'padding-top':'+=20px'}, 'fast');
	})();

	// email confirmation
	(function(){
		var sending = false;
		$('#notibar-email-confirm a:not([href])').click(function(event){
			var $this = $(this).attr('href', '#');

			event.preventDefault();

			if(sending) return;
			sending = true;

			$.ajax({
				type : 'post',
				url  : baseURL+'site/user/send_email_confirmation',
				data : {resend : true},
				dataType: 'json',
				success : function(response){
					if (typeof response.status_code == 'undefined') return;
					if (response.status_code == 1) {
						$this.parent().css('opacity','0').css('opacity','1').html(gettext('Success! You should receive a new confirmation email soon.'));
					} else if (response.status_code == 0) {
						if(response.message) alert(response.message);
					}
				},
				complete : function(){
					sending = false;
				}
			});
		});
	})();

	// languages (when signed out)
	(function(){
		$('#lang_popup').delegate('a[href]','click',function(event){
			if ($(this).hasClass('btn-add')==false) {
				event.preventDefault();

				var $this = $(this), lang = $this.attr('href').substring(1);
				$.cookie.set('lang',lang,14);

				location.reload();
			}
		});
	})();
});

jQuery(function($){
	// common popup script
	var $container = $('#popup_container'), prev_dialog=null, duration=300, distance=100, container_h;
	var $win = $(window), $body = $('body');

	$container
		.on('click', function(event){
			if(event.target === this && prev_dialog) {
				if ($container.hasClass('create_po')==true) {
					var ans=confirm("You haven't finished PO yet. Do you want to leave without finishing? Are you sure you want to close this popup?") 
					if(ans ==true) {event.preventDefault();prev_dialog.close();}
				}
				else {
					event.preventDefault();
					prev_dialog.close();
				}
			}
		})
		.delegate('.ly-close,.btn-close,.btn-cancel', 'click', function(event){
			if ($container.hasClass('create_po')==true) {
				var ans=confirm("You haven't finished PO yet. Do you want to leave without finishing? Are you sure you want to close this popup?") 
				if(ans ==true) {
					event.preventDefault();
					if(prev_dialog) prev_dialog.close();
				}
			}else{
				event.preventDefault();
				if(prev_dialog) prev_dialog.close();
			}
		});

	// ESC to close a popup
	$body.on('keyup.popup', function(event){
		if(event.keyCode == 27 && prev_dialog) prev_dialog.close();
	});

	$.dialog = function(popup_name){
		var $popup = $container.find('>.'+popup_name);
		return {
			name : popup_name,
			$obj : $popup,
			loading : function() {
				var $c = $container.addClass(popup_name).show();
				setTimeout(function(){ $c.css('opacity',1); },1);
				this.$obj.hide();
				prev_dialog = this;
				$container.data('lastest_popup_name', popup_name);
				$container.find('.loader').show();
				return this;
			},   
			open : function(){
				var $c,h,mt,sc=$win.scrollTop();
				$('body').addClass('fixed');
				if(!container_h) container_h = $container.height();
				if(prev_dialog) prev_dialog.close(true);
				if($win.innerHeight() < $body[0].scrollHeight) {
					$body.css('overflow-y','scroll');
				}
				$container.find('.loader').hide();
				$c = $container.addClass(popup_name).show().data('scroll-top',sc);

				this.center().$obj.trigger('open').show();

				if($c.length) {
					if(Modernizr.csstransitions && !$popup.hasClass('no-slide')){
						mt = this.center(true);
						ml = $(window).width()-$popup.width();
						$popup.removeClass('animated').css({marginTop:(mt+distance)*2+'px',marginLeft:ml/2+'px',opacity:0});
						setTimeout(function(){ $popup.addClass('animated') }, 1);
						setTimeout(function(){ $popup.css({marginTop:mt+'px',opacity:1}) }, 10);
					}
					setTimeout(function(){ $c.css('opacity',1); },1);

					$('#container-wrapper > .container').css('top',-sc+'px');
					$win.scrollTop(0); // workaround for mac chrome
				}

				prev_dialog = this;
				$container.data('lastest_popup_name', popup_name);

				return this;
			},
			close : function(keep_container){
				if(!this.showing() || !this.can_close()) return;
                                $container.find('.loader').hide();
				$c = $container.eq(keep_container?1:0).end();
				$('body').removeClass('fixed');
				$body.css('overflow-y','');

				if(keep_container) {
					$container.removeClass(popup_name);
				} else {
					// restore scroll position
					$('#container-wrapper > .container').css('top',0);
					$win.scrollTop($c.data('scroll-top'));

					if(Modernizr.csstransitions) {
						$container.css('opacity', 0);
						setTimeout(function(){ $container.removeClass(popup_name).hide() },duration+100);
					} else {
						$container.removeClass(popup_name).hide();
					}
				}

				$popup.trigger('close').hide();
				prev_dialog = null;
				return this;
			},
			center : function(return_value){
				var mt = Math.max(Math.floor((container_h-this.$obj.outerHeight())/2)-20,5);
				if(return_value) return mt;

				this.$obj.css('margin-top', mt+'px');
				return this;
			},
			showing : function(){
				return $container.is(':visible') && $container.hasClass(popup_name);
			},
			can_close : function(){ return true }
		};
	};

	// window
	var resize_timer = null;
	$win.on(
		'resize',
		function(){
			clearTimeout(resize_timer);
			resize_timer = setTimeout(function(){
				container_h = $win.innerHeight();
				if(prev_dialog) prev_dialog.center();
			}, 100);
		}
	);

	// {{{ dialog for uploading files to add to Fancy
	(function(){
		var dlg_drop=$.dialog('drop-to-upload'), dlg_add=$.dialog('add-fancy'), $_drag_objs=$();

		if(!dlg_add.$obj.length || !dlg_drop.$obj.length) return;

		// 'Add' navigation menu
		$('.mn-add').click(function(event){
			event.preventDefault();
			dlg_add.open();
		});

		// add fancy dialog
		dlg_add.$obj
			.append('<iframe name="iframe_img_upload" frameborder="0" />') // we should use script to add iframe to workaround firefox
			.on({
				open : function(){
					var $this = $(this).trigger('tab','step1');

					// load lists and categories
					if(!$this.data('lists_loaded')){
						$.ajax({
							type : 'get',
							url  : '/categories_lists.json?mbox=true',
							success : function(json){
								if(!json || !json.response) return;

								var i,c,r=json.response,cate,list,html='';

								// categories
								for(i=0,c=r.categories.length; i<c; i++){
									cate  = r.categories[i];
									html += '<option value="'+cate.key+'">'+cate.name.escape_html()+'</option>';
								}
								dlg_add.$obj.find('select.categories_').append(html);

								// lists
								html='';
								for(i=0,c=r.lists.length; i<c; i++){
									list  = r.lists[i];
									html += '<option value="'+list.id+'">'+list.title.escape_html()+'</option>';
								}
								dlg_add.$obj.find('select.lists_').append(html);

								// mbox
								if(r.mbox) dlg_add.$obj.find('.step1 ul.case li a.mbox_').attr('target','_blank').attr('href','mailto:'+r.mbox);

								$this.data('lists_loaded',true);
							}
						});
					}
				},
				tab  : function(event,tab_name){
					var $this = $(this);
					$this
						.attr('class', $this.attr('class').replace(/\bstep\d+(-\w+)?/g,tab_name))
						.find('input:text').val('').end()
						.find('select').each(function(){ this.selectedIndex = 0; }).end()
						.find('form').trigger('reset').end()
						.find('button:submit').disable(false).end();

					dlg_add.center();
				}
			})
			.find('>.step .btns-area a.cancel')
				.click(function(event){
					event.preventDefault();
					if($(this).hasClass('disabled')) return;
					dlg_add.$obj.trigger('tab','step1');
				})
			.end()
			.find('button.btn-add-note')
				.click(function(event){
					event.preventDefault();
					$(this).hide().next('input:text').show();
				})
			.end()
			.find('>.step.step0-error .btn-blue-embo').click(function(){ dlg_add.close() }).end()
			.find('>.step.step1')
				.find('ul.case li a')
					.filter('.mbox_').tipsy({gravity:'se',fade:true,offset:-10}).end()
					.click(function(event){
						var href = $(this).attr('href');

						if(href.substr(0,1) != '#') return;

						event.preventDefault();
						if(href.length > 1) dlg_add.$obj.trigger('tab',href.substr(1));
					})
				.end()
			.end()
			// Fetch images from web
			.find('>.step.step2')
				.find('input.url_').keydown(function(event){ if(event.which==13){event.preventDefault();$(this).closest('.step').find('.btn-blue-embo-fetch').click()} }).end()
				.find('.btn-blue-embo-fetch')
					.click(function(){
						var $btn=$(this),$step=$btn.closest('.step'),$pg,$ind,url;

						url = $step.find('input.url_').val().trim().replace(/^https?:\/\//i,'');
						if(!url.length) return alert(gettext('Please enter a website address.'));

						// hide buttons and show progress bar
						$step.find('.btns-area').hide().end().find('.progress').show().end();
						$pg  = $step.find('.progress-bar');
						$ind = $pg.find('em').width(0).animate({'width':'70%'},1500);

						function check(images, callback){
							var fn=[], list=[], cur=80, step=30/images.length;

							function load(src){
								var def = $.Deferred(), img = new Image();
								img.onload = function(){
									cur += step;
									if(cur > 100) cur = 100;
									$ind.stop().animate({'width':cur+'%'},100);

									if(this.width > 200 || this.height > 200) list.push(this);
									def.resolve(this);
								};
								img.onerror = function(){ def.reject(this) };
								img.src = src;
								return def;
							};

							for(var i=0,c=images.length; i < c; i++) fn[i] = load(images[i]);

							$.when.apply($,fn).then(function(){
								if(list.length){
									dlg_add.$obj.trigger('tab','step3');
									$step.siblings('.step3').trigger('set.images',[list]);
									$('#fancy_add-link').val('http://'+url);
								}else{
									alert(gettext("Oops! Couldn't find any good images for the page."));
									dlg_add.$obj.trigger('tab','step2');
								}
							});
						};

						if(/\.(jpe?g|png|gif)$/i.test(url)) return check(['http://'+url]);

						// fetching images
						$.ajax({
							type : 'get',
							url  : '/extract_image_urls.json?url='+url,
							dataType : 'json',
							success  : function(json){
								if(!json) return;
								if(json.response){
									check(json.response);
								} else if(json.error && json.error.message){
									alert(json.error.message);
								}
							},
							complete : function(){
								$step.find('.btns-area').show().end().find('.progress').hide().end();
							}
						});
					})
				.end()
			.end()
			// Upload local images
			.find('>.step.step2-upload')
				.find('form')
					.on({
						upload_begin : function(event){
							$(this)
								.find('>.btns-area').hide().end()
								.find('>.progress').show().end();
						},
						upload_complete : function(event,json){
							var $this = $(this), $step3_upload;

							$this.trigger('reset');

							if(!json || typeof(json.status_code) == 'undefined') return;
							if(json.status_code == 1){
								$step3 = $this.closest('.popup').find('>.step3');
								if(json.image && json.image.url){
									$step3.trigger('set.uploaded_image', [json.image]);
									dlg_add.$obj.trigger('tab','step3');
								} else {
									alert(gettext('Something went wrong. Please upload again.'));
								}
							}else if(json.status_code == 0){
								if(json.message) alert(json.message);
							}
						},
						reset : function(){
							$(this)
								.find('>.btns-area').show().end()
								.find('>.progress').hide().find('em').width(0);
						},
						submit : function(event,filelist){
							var $this=$(this),$step=$this.closest('.step'),$indicator,file_form=this.elements['file'],file,progress_id,filename,extension;

							if(!filelist) filelist = file_form.files || (file_form.value ? [{name:file_form.value}] : []);
							if(filelist && filelist.length) file = filelist[0];

							if(!file){
								alert(gettext('Please select a file to upload'));
								return false;
							}

							if(!/([^\\\/]+\.(jpe?g|png|gif))$/i.test(file.name||file.filename)){
								alert(gettext('The image must be in one of the following formats: .jpeg, .jpg, .gif or .png.'));
								return false;
							}

							filename  = RegExp.$1;
							extension = RegExp.$2;

							$indicator = $this.find('.progress-bar em').css('width','0.5%');

							$this.trigger('upload_begin');

							function onprogress(cur,len){
								var prog = Math.max(Math.min(cur/len*100,100),0).toFixed(1);
								$indicator.stop().animate({'width':prog+'%'},500);
							};

 							if(!window.FileReader || !window.XMLHttpRequest) {
								var null_counter = 0, completed = false;

								progress_id = parseInt(Math.random()*10000);
								document.cookie = 'X-Progress-ID='+progress_id+'; path=/';
								window._upload_image_callback = function(json){ completed = true; $this.trigger('upload_complete',json); };

								function get_progress(){
									$.ajax({
										type : 'get',
										url  : '/get_upload_progress.json',
										data : {'X-Progress-ID':progress_id},
										dataType : 'json',
										success  : function(json){
											if(!json) return;
											if(json.uploaded + 1000 >= json.length) json.uploaded = json.length;
											onprogress(json.uploaded, json.length);
										},
										complete : function(xhr){
											if(completed || null_counter > 10) return;
											if(xhr.responseText == 'null') null_counter++;
											setTimeout(get_progress, 500);
										}
									});
								};
								setTimeout(get_progress, 300);
								return true;
 							}

							// Here is ajax file upload
							var reader = new FileReader(), xhr = new XMLHttpRequest();
							xhr.upload.addEventListener('progress', function(e){ onprogress(e.loaded, e.total)}, false);
							xhr.onreadystatechange = function(e){
								if(xhr.readyState !== 4) return;
								if(xhr.status === 200){
									// success
									var data = xhr.responseText, json;
									try {
										if(window.JSON) json = window.JSON.parse(data);
									} catch(e){
										try { json = new Function('return '+data)(); } catch(ee){ json = null };
									}

									$this.trigger('upload_complete', json);
								}
							};
							xhr.open('POST', '/upload_image.json?filename='+filename, true);
							xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
							xhr.setRequestHeader('X-Filename', filename);
							xhr.send(file);

							return false;
						}
					})
				.end()
			.end()
			.find('>.step.step3')
				.on({
					'set.uploaded_image' : function(event,image_info){
						var $this=$(this), title;

						title = $this.closest('.popup').find('.step.step2-upload p.ltit').text();

						$this
							.data('req_url', '/add_new_thing.xml')
							.data('fields', 'name link category list_ids note')
							.find('.ltit').text(title).end()
							.find('.controls').hide().end()
							.find('img.photo').attr('src', image_info.url).end()
							.find('.size').width('100%').html(image_info.width+' &times; '+image_info.height).end();
					},
					'set.images' : function(event,images){
						var $this=$(this), title;
						if(!$.isArray(images)) images = [images];

						title = $this.closest('.popup').find('.step.step2 p.ltit').text();

						$this
							.data('req_url', '/add_new_sys_thing.json')
							.data('fields', 'name link category list_ids note user_key photo_url')
							.data('index', 0)
							.data('images', images)
							.find('.ltit').text(title).end()
							.find('.controls .size').text('').end()
							.trigger('set.index',0);

							if(images.length > 2) {
								$this.find('.controls').show();
							} else {
								$this.find('.controls').hide();
							}
					},
					'set.index' : function(event,idx){
						var $this=$(this),images=$this.data('images'),img;
						if(!images || idx > images.length-1 || idx < 0) return;

						$this.data('index',idx)
							.find('#fancy_add-photo_url').val(images[idx].src).end()
							.find('.photo').attr('src', images[idx].src).end()
							.find('.size').html(images[idx].width+' &times; '+images[idx].height).end()
							.find('.cur_').text((idx+1)+' of '+images.length).end()
							.find('.prev').disable(idx < 1).end()
							.find('.next').disable(idx > images.length-2).end();
					},
					next : function(event){
						var $this=$(this),idx=$this.data('index')||0;
						if(typeof idx != 'number') idx = parseInt(idx);
						$this.trigger('set.index', idx+1);
					},
					prev : function(event){
						var $this=$(this),idx=$this.data('index')||0;
						if(typeof idx != 'number') idx = parseInt(idx);
						$this.trigger('set.index', idx-1);
					}
				})
				.find('.prev').click(function(){ $(this).closest('.step').trigger('prev') }).end()
				.find('.next').click(function(){ $(this).closest('.step').trigger('next') }).end()
				.find('.btn-blue-embo-add')
					.click(function(){
						var $btn=$(this), $step=$btn.closest('.step'), fields, req_url, key, datatype, val, params={via:'web'};

						req_url  = $step.data('req_url');
						fields   = $step.data('fields').split(' ');
						datatype = req_url.match(/\.(json|xml)$/)[1];

						for(var i=0,c=fields.length; i < c; i++){
							key = fields[i];
							val = $step.find('#fancy_add-'+key).val();
							params[key] = val;
						}

						if(!params['name']) return alert(gettext('Please enter title'));
						if(params['photo_url'] && params['link']) params['tag_url'] = params['link'];

						$btn.disable().addClass('loading');

						function json_handler(json){
							if(!json) return;
							if(json.status_code == 1){
								location.href = json.thing_url;
							} else if (json.status_code == 0 && json.message){
								alert(json.message);
							}
						};

						function xml_handler(xml){
							var $xml = $(xml), $st = $xml.find('status_code');
							if(!$st.length) return;
							if($st.text() == '1'){
								location.href = $xml.find('thing_url').text();
							} else if ($st.text() == '0' && $xml.find('message').length){
								alert($xml.find('message').text());
							}
						};

						$.ajax({
							type : 'post',
							url  : req_url,
							data : params,
							dataType : datatype,
							success  : datatype=='xml'?xml_handler:json_handler,
							complete : function(){
								$btn.disable(false).removeClass('loading');
							}
						});
					})
				.end()
			.end();

		// when drag files over document, show "drop to upload" message
		$(window).on({
			dragenter : function(event){
				var ev, dt;

				event.preventDefault();

				if(($_drag_objs=$_drag_objs.add(event.target)).length > 1 || !(ev=event.originalEvent) || !(dt=ev.dataTransfer)) return;
				if(dt.types.indexOf ? dt.types.indexOf('Files') == -1 : !dt.types.contains('application/x-moz-file')) return;
				if($container.is(':visible') && !dlg_add.showing()) return;

				dlg_drop.open();
			},
			dragleave : function(event){
				var ev, dt;

				event.preventDefault();

				if(($_drag_objs=$_drag_objs.not(event.target)).length || !(ev=event.originalEvent) || !(dt=ev.dataTransfer)) return;
				if(!dlg_drop.showing()) return;

				dlg_drop.close();
			}
		});
		$container.bind({
			dragover : function(event){ event.preventDefault() },
			drop : function(event){
				var ev, dt, images=[];

				event.preventDefault();
				if(!(ev=event.originalEvent) || !(dt=ev.dataTransfer) || !dt.files || !dt.files.length) return;

				$_drag_objs = $();

				for(var i=0,c=dt.files.length; i < c; i++) {
					if(/\.(jpe?g|gif|png)$/i.test(dt.files[i].name)) images.push(dt.files[i]);
				}

				if(!images.length) {
					dlg_add.open().$obj.trigger('tab','step0-error');
					return;
				}

				dlg_add.open().$obj.trigger('tab','step2-upload').find('form').trigger('submit',[images]);
			}
		});
	})();
	// }}}
	if ($.browser.msie && parseInt($.browser.version, 10) < 9) {
		$('body').addClass('ie');
	}
});

// Share dialogs and buttons
jQuery(function($){
	var $fancy_share = $('#fancy-share'), dlg_share = $.dialog('share-new');

	$('#content,#sidebar,#summary')
		.delegate('.timeline .btn-share,.figure-item .btn-share, #show-someone', 'click', function(event){
			event.preventDefault();
			$fancy_share.trigger('open_thing', this);
		})
		.delegate('.btn-comment-share', 'click', function(event){
			event.preventDefault();
			$fancy_share.trigger('open_comment', this);
		})
		.delegate('.btn-list-share', 'click', function(event){
			event.preventDefault();
			$fancy_share.trigger('open_list', this);
		})
		.delegate('.btn-gift-share', 'click', function(event){
			event.preventDefault();
			$fancy_share.trigger('open_gift', this);
		})
		.delegate('.btn-user-share', 'click', function(event){
			event.preventDefault();
			$fancy_share.trigger('open_user', this);
		});

	var $frm  = $fancy_share.find('dd.email-frm'),
		$name = $frm.find('b.name').remove(),
		$list = $fancy_share.find('ul.user-list'),
		$item = $list.find('>li').remove(),
		$add  = $frm.find('.add'),
		$inp  = $frm.find('input:text'),
		txt_add = $add.text().split('|'),
		timer, xhr, prev_val = '';

	$add.text(txt_add[0]);
	$frm.click(function(event){
		if ($(event.target).is('span.add,dd.email-frm')) {
			$add.hide();
			$inp.show().val('').focus();
			prev_val = '';
			return false;
		}
	});

	function request_username(val, cursor, oncomplete){
		// remove timer and stop previous request
		try {
			if(xhr && xhr.abort) xhr.abort();
		} catch(e){};

		cursor = cursor || 1;

		xhr = $.ajax({
			type : 'get',
			url  : '/search-users.json',
			data : {'term':val,'cursor':cursor},
			dataType : 'json',
			success  : function(json){
				if(val != $.trim($inp.val())) return;

				var list=[], exists={}, i, c;

				$frm.find('>b.name[uid]').each(function(){ exists[this.getAttribute('uid')] = true });

				if(json && json.list && json.list.length){
					for(i=0,c=json.list.length; i < c; i++){
						if(!exists[json.list[i].id]) list.push(json.list[i]);
					}
				}

				if (list.length) {
					if(json.next) list.next = json.next;
					add_items(list);
					$list.show().find('>li:first').addClass('on');
				} else if(cursor == 1) {
					$list.hide();
				}
			},
			complete : oncomplete || $.noop
		});
	};

	function add_items(list){
		var $more = $list.find('>li.load-more');

		for(var i=0,c=list.length; i < c; i++) {
			$item.clone()
				.attr('uid', list[i].id)
				.attr('username', list[i].username)
				.find('img').attr('src', list[i].image_url).end()
				.find('b').text(list[i].name||list[i].username).end()
				.find('small').text('@'+list[i].username).end()
				.appendTo($list);
		}

		if(list.next) {
			if(!$more.length) $more = $('<li class="load-more"><span>'+gettext('Load more...')+'</span></li>');
			$more.data('cursor', list.next).appendTo($list);
		} else {
			$more.remove();
		}
	};


	$inp
		.on('changed', function(){
			var v = $.trim($inp.val());
			if(!v.length || v.indexOf('@') >= 0) return $list.hide();
			$list.hide().html('');
			request_username(v);
		})
		.blur(function(){
			var v = $.trim($inp.val());

			if(v.indexOf('@') >= 0) {
				$name.clone()
					.prepend(document.createTextNode(v))
					.attr('email', v)
					.insertBefore($add);
				$add.text(txt_add[1]);
			}

			$add.show();
			$list.hide();
			$inp.hide().val('');
		})
		.keydown(function(event){
			setTimeout(function(){var val=$.trim($inp.val());if(val==prev_val)return;prev_val=val;$inp.trigger('changed')}, 10);

			switch(event.keyCode) {
				case 8: // backspace
					if ($inp.val().length != 0) return true;
					var $names = $frm.find('b.name');
					if ($names.length > 0) $names.eq(-1).remove();
					return false;
				case 9: // tab
				case 13: // enter
				case 186: // ';'
				case 188: // ','
					if ($inp.val().indexOf('@') > 0) {
						setTimeout(function(){
							var email = $.trim($inp.val());
							$inp.val('');
							$name.clone()
								.prepend(document.createTextNode(email))
								.attr('email', email)
								.insertBefore($add);

							$add.text(txt_add[1]).click();
						}, 10);
					} else {
						if (event.keyCode == 9 && $list.is(':hidden')) return true;
						$list.trigger('key.enter');
					}
					return false;
				case 38: $list.trigger('key.up'); return false;
				case 40: $list.trigger('key.down'); return false;
			}
		});

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
			$list.filter(':visible').children('li.on').mousedown();
		})
		.delegate('li:not(.load-more)', 'mousedown', function(){
			var $item = $(this);
			$name.clone()
				.prepend(document.createTextNode($item.find('b').text()))
				.attr('uid', $item.attr('uid'))
				.attr('username', $item.attr('username'))
				.insertBefore($add);

			$add.text(txt_add[1]);
			setTimeout(function(){ $inp.val('');$frm.click(); }, 10);

			$list.hide();
		})
		.delegate('li.load-more', 'mousedown', function(){
			var $this = $(this);
			$this.addClass('loading');
			request_username($.trim($inp.val()), $this.data('cursor'), function(){ $this.removeClass('loading') });
			return false;
		});

	$fancy_share
		.on('reset', function(){
			var $this = $(this);
			$this
				.data({url:'',txt:'',img:''})
				.removeClass('list-share thing-share gift-share comment-share')
				.children('.link,.embed,.anywhere,.email,.btn-area').css('display', '').end();
		})
		.on('open_comment', function(event, btn){
			var $this = $(this).trigger('reset').addClass('comment-share'), $btn=$(btn), $li = $btn.closest('li.comment'), el_cmt= $li.children('p.c-text'), txt_cmt=el_cmt.text(), url, txt;

			uimage = $li.attr("uimage");
			username = $li.attr("cuname");
			fullname = $li.attr("fullname");

			$this
				.find('#share-link-input').val(url).end()
				.find('.bio').html(txt_cmt).end()
				.find('.fig-info')
					.find('h4').text(fullname).end()
					.find('.from').text(username).end()
				.end()
				.data({
					url : url='http://'+location.host+$btn.closest('a').attr('href'),
					txt : txt=txt_cmt+' - '+username,
					img : $btn.data('timage')
				});

			if($this.data('prev') != 'comment-'+username) $this.find('.thum>img').attr('src', '/_ui/images/common/blank.gif').attr('src', uimage);
			$this.data('prev', 'comment-'+username);
			// get short url via ajax
			$.ajax({
				type : 'post',
				url  : '/get_comment_short_url.json',
				data : {thing_id:$li.closest('section.comments').attr('data-tid'), comment_id:$li.attr('cid')},
				dataType : 'json',
				success  : function(json){
					if(!json.short_url) return;
					var enc_short_url = encodeURIComponent(json.short_url);
					$this
						.find('#share-link-input').val(json.short_url).end()
						.find('.share-via a[href]').each(function(){ this.setAttribute('href', this.getAttribute('href').replace(/([\?&]u(?:rl))=[^&]+/, '$1='+enc_short_url)); }).end();
				}
			});

			dlg_share.open();
		})
		.on('open_thing', function(event, btn){
			var $this = $(this).trigger('reset').addClass('thing-share'), $btn=$(btn), tid=$btn.attr('tid'), tuser, uname=$this.attr('uname'), ref='', url, tname, img, iframe_h, thing_path, price, reacts;
                        var login_require = $btn.attr('require_login');
                        if (login_require && login_require=='true') {
			    $.dialog('signin-overlay').open();
			    return false;
		        }

			function setInfo(){
				var str = '';
				if(tname) $this.find('span.figcaption').text(tname);
				if(price) str += '<b>$'+price+'</b>';
				if(tuser) str += (str ? ' · ':'')+'<a href="/'+tuser+'">'+tuser+'</a>';
				if(reacts) str += ' + '+reacts+' '+ (reacts>1?'others':'other');
				if(str) $this.find('.fig-info > .username').html(str);
			};

			function setAnywhere(img){
				$('#share-anywhere').val('<a href="'+$this.data('url')+'"><img src="'+img.src+'" width="'+img.width+'" height="'+img.height+'" class="fancy-id-'+tid+'" alt="'+tname+'"></a>');
			};

			function setEmbed(img){
				if(!img.width || !img.height) return;

				$this.find('.embed')
					.data('ratio', img.height/img.width)
					.find('.width_').val(img.width+32).attr('max', img.width+32).end()
					.trigger('update');
			};

			img = $btn.parent().prev('img').get(0);
			if(!img) img = $btn.closest('.figure-item').find('.figure > img').get(0);
			if(!img) img = $('.fig-image > img').get(0);
            if(!img) img = $btn.closest('.figure-item').find('.figure').get(0);

			tuser = $btn.attr('tuser');
			if(!tuser) tuser = $btn.closest('.figure-item').find('.username a').text();

			price = $btn.attr('price');
			if(!price) price = $btn.closest('.figure-item').find('.price').text().replace(/[^\d\., ]+/g,'');
			price = $.trim(price);

			reacts = $btn.attr('reacts');
			if(!reacts){
				reacts = $btn.closest('.figure-item').find('.figure-detail em').text().match(/\+ (\d+)/);
				if(reacts) reacts = reacts[1];
			}
			
			$this.find('>ul.tab').nextUntil('button.ly-close').hide().end().find('li > a:first').click();

			thing_path = $btn.closest('a').attr('href');
			if(!thing_path) thing_path = $btn.closest('div.figure-item').find('a.figure-img').attr('href');

			if(uname) ref = '?ref='+uname;

			$this
				.data({
					url : url='http://'+location.host+thing_path+ref,
					txt : tname=$btn.attr('tname'),
					img : $btn.data('timage')
				})
				.attr({
					otype : 'nt',
					tid   : tid,
					turl  : url,
					tname : tname,
					ooid  : $btn.attr('uid')
				})
				.find('#share-link-input').val(url).end()
				.find('.embed').trigger('update').end();

			if($this.data('prev') != 'thing-'+tid) $this.find('.thum>img').attr('src', '/_ui/images/common/blank.gif').attr('src', $btn.attr('timage'));
			$this.data('prev', 'thing-'+tid);

			setInfo();

			// embed
			$this.find('.embed').find('input:checkbox').prop('checked',true).end()
			setEmbed(img);

			// fancy anywhere
			setAnywhere(img);

			$('<img style="position:absolute;left:-9999px;top:-9999px">')
				.load(function(){ setEmbed(img); setAnywhere(this); $(this).remove() })
				.attr('src', img.src)
				.appendTo('body');

			// load short url for thing page
			$.ajax({
				type : 'post',
				url  : '/get_short_url.json',
				data : {thing_id:tid},
				dataType : 'json',
				success  : function(json){
					if(!json.short_url) return;
					var enc_short_url = encodeURIComponent(json.short_url);
					$this
						.find('#share-link-input').val(json.short_url).end()
						.find('.share-via a[href]').each(function(){ this.setAttribute('href', this.getAttribute('href').replace(/([\?&]u(?:rl))=[^&]+/, '$1='+enc_short_url)); }).end()
						.data('url', json.short_url+ref);

					setAnywhere(img);

					$this.trigger('get_short_url', [$btn, json.short_url]);
				}
			});

			// load short url for embed page
			$.ajax({
				type : 'get',
				url  : '/get_short_url.json',
				data : {url:location.host+'/embed/v2/'+tid},
				dataType : 'json',
				success  : function(json){
					if(!json.short_url) return;

					$this.find('.embed').attr('short_url', json.short_url);
					setEmbed(img);
				}
			});

			dlg_share.open();
		})
		.on('open_list', function(event, btn){
			var $this=$(this).trigger('reset').addClass('list-share'), $btn=$(btn), id=$btn.attr('lid'), oid=$btn.attr('loid'), url, $imgs, images=[];

			url = $btn.attr('href');
			if(url.indexOf('http://') < 0) url = 'http://'+location.host+url;

			$this
				.data({
					url : url,
					txt : list_name=$btn.attr('list_name')
				})
				.find('.fig-info')
					.find('h4').text(list_name).end()
					.find('.from').html($('#list-author-'+id).html()).end()
				.end()
				.find('#share-link-input').val(url).end();

			$imgs = $('#list-thumbnails-'+id+' .fig-image > img');
			if($imgs.length){
				$thumb = $('<div class="thumbnails" />').appendTo($this.find('.fig-info'));
				for(var i=0,c=Math.min($imgs.length,3); i < c; i++){
					$thumb.append('<span style="background-image:url(\''+$imgs.get(i).src+'\')">');
				}
			} else {
				$this.find('.fig-info .thumbnails').remove();
			}

			if(!/^http:\/\/fancy\.to/.test(url)) {
				// call ajax to get shortcut url
				$.ajax({
					type : 'POST',
					url  : '/get_list_short_url.json',
					data : {list_id:id, owner_id:oid},
					dataType : 'json',
					success  : function(json){
						if(!json.short_url) return;
						var enc_short_url = encodeURIComponent(json.short_url);
						$this
							.find('#share-link-input').val(json.short_url).end()
							.find('.share-via a[href]').each(function(){ this.setAttribute('href', this.getAttribute('href').replace(/([\?&]u(?:rl))=[^&]+/, '$1='+enc_short_url)); }).end();
					}
				});
			}

			dlg_share.open();
		})
		.on('open_gift', function(event, btn){
			var $this = $(this).trigger('reset').addClass('gift-share'), $btn=$(btn), url;

			$this
				.data({
					url : url=$btn.attr('href'),
					txt : $btn.attr('gift_name')
				})
				.find('#share-link-input').val(url);

			dlg_share.open();
		})
		.on('open_user', function(event, btn){
			var $this = $(this).trigger('reset').addClass('comment-share user-share'), $btn=$(btn), url;

			$this
				.data({
					url : url=$btn.attr('href'),
					txt : $btn.attr('txt')
				})
				.find('#share-link-input').val(url).end()
				.find('.share-user').text($this.find('.share-user').text().replace(/\{\{name\}\}/g, $btn.attr('username')));

			dlg_share.open();
		})
		.on('open', function(){
			var $this=$(this), url=$this.data('url'), txt=$this.data('txt'), img=$this.data('img'), amex=$this.data('amex'), enc_url, enc_txt, enc_img;

			enc_url = encodeURIComponent(url);
			enc_txt = encodeURIComponent(txt);
			enc_img = encodeURIComponent(img);

			if(amex) $this.data('amex', '');

			$this
				.find('.section').css({marginTop:'',marginLeft:''}).end()
				.find('>.popup-bg').one('click',function(){ $this.trigger('hide') }).end()
				.find('.share-via')
					.find('a.me').attr('href', 'http://me2day.net/plugins/post/new?new_post[body]=%22'+enc_txt+'%22:'+enc_url+'&new_post[tags]=Fancy').end()
					.find('a.tw').attr('href', 'http://twitter.com/share?text='+(amex?encodeURIComponent(amex):enc_txt)+'&url='+enc_url+'&via=fancy').end()
					.find('a.fb').attr('href', 'http://www.facebook.com/sharer.php?u='+enc_url).end()
					.find('a.gg').attr('href', 'https://plus.google.com/share?url='+enc_url).end()
					.find('a.su').attr('href', 'http://www.stumbleupon.com/submit?url='+enc_url+'&title='+enc_txt).end()
					.find('a.tb').attr('href', 'http://www.tumblr.com/share/link?url='+enc_url+'&name='+enc_txt+'&description='+enc_txt).end()
					.find('a.li').attr('href', 'http://www.linkedin.com/shareArticle?mini=true&url='+enc_url+'&title='+enc_txt+'&source=thefancy.com').end()
					.find('a.vk').attr('href', 'http://vkontakte.ru/share.php?url='+enc_url).end()
					.find('a.wb').attr('href', 'http://service.weibo.com/share/share.php?url='+enc_url+'&appkey=&title='+enc_txt+(img?'&pic='+enc_img:'')).end()
					.find('a.mx')
						.off('click')
						.click(function(){
							try { window.open('http://mixi.jp/share.pl?u='+enc_url+'&k=91966ce7669c34754b21555e4ae88eedce498bf0','share','width=632,height=456').focus(); } catch(e){};
							return false;
						})
					.end()
					.find('a.qz').attr('href', 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+enc_url).end()
					.find('a.rr').attr('href', 'http://share.renren.com/share/buttonshare.do?link='+enc_url+'&title='+enc_txt).end()
					.find('a.od').attr('href', 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=2&st.noresize=on&st._surl='+enc_url).end()
				.end();
		})
		.on('close', function(){
			$frm.find('b.name').remove();
			$list.hide();
		})
		.on('mousedown', '.ltit', function(event){
			var $h3 = $(this), $dlg = $fancy_share.find('.section'), mt = parseInt($dlg.css('margin-top')), ml = parseInt($dlg.css('margin-left')), sx = event.clientX, sy = event.clientY;
			$(document)
				.on('mousemove.share', function(event){
					var dx =  event.clientX - sx, dy = event.clientY - sy;
					$dlg.css({marginTop:(mt+dy)+'px',marginLeft:(ml+dx)+'px'});
					return false;
				})
				.on('mouseup.share', function(){
					$(document).unbind('mousemove.share moveup.share');
					return false;
				});
			return false;
		})
		.on('click', 'ul.tab a', function(event){
			event.preventDefault();
			var $this = $(this), cls = $this.attr('href').substr(1);
			$this
				.addClass('current')
				.parent()
					.siblings('li')
						.find('>a').removeClass('current').end()
					.end()
					.closest('.tab').nextUntil('button.ly-close').css('display','').filter(cls).show();
		})
		.on('focus', '.fig-info input:text', function(){ var inp=this;setTimeout(function(){ inp.select() }, 100); })
		.find('ul.user-list')
			.delegate('li', 'mouseenter', function(){ $(this).addClass('on') })
			.delegate('li', 'mouseleave', function(){ $(this).removeClass('on') })
		.end()
		.delegate('button.btn-del', 'click', function(){
			$(this).parent().remove();
			if ($frm.find('>b.name').length == 0) $add.text(txt_add[0]);
		})
		.on('click', '.share-via > a.show', function(event){
			event.preventDefault();
			$(this).toggleClass('less').prev('ul').toggleClass('less');
		})
		.find('.embed')
			.on('update', function(){
				var $this=$(this), type='', types={}, tid=$fancy_share.attr('tid'), uname=$fancy_share.attr('uname'), html='', url, width, height, ratio=$this.data('ratio'), padding=32;

				// update sample
				$this.find('input:checkbox').each(function(){
					var id = this.id.replace(/^embed-/,''), $el = $this.find('.'+id), key = this.getAttribute('key');
					$el.css('display', this.checked ? 'block':'');
					if(this.checked) {
						type += (type?',':'')+key;
						types[key] = true;
					}
				});

				ratio  = parseFloat(ratio);
				width  = parseInt($this.find('.width_').val());
				if(isNaN(width) || !ratio) {
					$this.find('.height_').val('');
				} else {
					height = Math.round(ratio*(width-padding))+padding+15+6;

					if(types.tt) height += 20;
					if(types.pr || types.by) height += 18;

					$this.find('.height_').val(height);
				}

				url = $this.attr('short_url');
				if(!url) url = 'http://'+location.hostname+'/embed/v2/'+tid;
				if(uname) url += '?ref='+uname;
				url += (url.indexOf('?')<0?'?':'&')+'type='+type;

				if(width && height){
					html = '<iframe src="'+url+'" width="'+width+'" height="'+height+'" allowtransparency="true" frameborder="0" style="width:'+width+'px;height:'+height+'px;margin:0 auto;border:0"></iframe>';
				}

				$('#share-embed-input').val(html);
			})
			.on('keyup blur', '.width_', function(event){
				var v = $.trim(this.value), min=200, max=this.getAttribute('max');

				if(!isNaN(v=parseInt(v)) && (event.type == 'focusout' || event.type == 'blur')){
					v = Math.max(Math.min(v, parseInt(max)), min);
					this.value = v;
				}

				$(this).closest('.embed').trigger('update');
			})
			.on('click', 'input:checkbox', function(){
				$(this).closest('.embed').trigger('update');
			})
		.end()
		.on('click', '#share-link-input,#share-embed-input,#share-anywhere', function(){
			this.select();
		})
		.on('click', '.btn-send,.btn-share', function(){
			var $this = $(this), params, emails=[], users=[], endpoint, otype = $fancy_share.attr('otype');

			$this.disable();

			if (otype == "gc") {
				params = {
					type : 'gc',
					url  : $fancy_share.attr('gcurl'),
					name : $fancy_share.attr('gcname'),
					oid  : $fancy_share.attr('gcid'),
					message :$.trim( $fancy_share.find('textarea').val())
				};
				endpoint = "/share-with-someone-gift.json"
			} else {
				params = {
					type : 'nt',
					url  : $fancy_share.attr('turl'),
					name : $fancy_share.attr('tname'),
					oid  : $fancy_share.attr('tid'),
					ooid : $fancy_share.attr('ooid'),
					message :$.trim( $fancy_share.find('.email textarea').val())
				};
				endpoint = "/share-with-someone.json";
			}

			$frm.find('>b.name').each(function(){
				var $b = $(this);
				if ($b.attr('email')) {
					emails.push($b.attr('email'));
				} else {
					users.push($b.attr('uid'));
				}
			});

			if(!emails.length && !users.length){
				$this.disable(false);
				return false;
			}

			params.emails = emails.join(',');
			params.users  = users.join(',');

			$.ajax({
				type : 'post',
				url  : endpoint,
				data : params,
				dataType : 'json',
				success  : function(json){
					if(!json) return;
					if(json.status_code) {
						alert('Sent!');
						$fancy_share.trigger('hide');
					} else {
						alert(json.message);
					}
				},
				complete : function(){
					$this.disable(false);
				}
			});
		});
});

// Clone-list dialog and buttons
jQuery(function($){
	var $clone = $('#clone-list'), dlg_clone = $.dialog('clone-list'), btn;

	$('#content,#sidebar,#summary').delegate('.btn-clone-list', 'click', function(event){
		if(event) event.preventDefault();
		btn = this;
		dlg_clone.open();
	});

	$clone
		.on('open', function(event){
			var $btn = $(btn);

			$clone.data({loid:$btn.attr('loid'), lid:$btn.attr('lid')});
			$('#name-clone-list').val('').focus();
		})
		.on('click', 'button.btn-clone', function(event){
			var params, list_name, $btn=$(this);

			event.preventDefault();

			list_name = $.trim($('#name-clone-list').val());
			if(!list_name) return alert(gettext('Please input name of list'));

			if($btn.hasClass('loading')) return;
			$btn.addClass('loading').text(gettext('Cloning...'));

			params = {
				loid  : $clone.data('loid'),
				lid   : $clone.data('lid'),
				lname : list_name
			};

			function request(){
				$.ajax({
					type : 'post',
					url  : '/clone_list.xml',
					data : params,
					dataType : 'xml',
					success  : function(xml){
						var $xml=$(xml), $st=$xml.find('status_code'), error, msg;
						if(!$st.length) return;
						if($st.text() == 1){
							alert(gettext('You have successfully cloned this list.'));
							dlg_clone.close();
						} else if($st.text() == 0){
							error = $xml.find('error').text();
							msg   = $xml.find('message').text();
							if(error != 'list_exist'){
								alert(msg);
							} else if(confirm(msg)) {
								params['merge'] = 'true';
								request();
							}
						}
					},
					complete : function(){
						$btn.removeClass('loading').text(gettext('Clone List'));
					},
					error : function(){
						alert(gettext('Oops! Something went wrong.'));
					}
				});
			};
			request();
		})
		.on('keypress', '#name-clone-list', function(event){
			if(event.keyCode == 13) {
				$('button.btn-clone').click();
				return false;
			}
		});
});

// fancy/fancyd button and add-to-list popup
jQuery(function($){
	var dlg_list = $.dialog('add-to-list'), $list_popup = dlg_list.$obj, loading_txt, $usertext, $coltext, $tpl_user;

	dlg_list.$obj
		.on({
			open : function(event, fromFancyd){
				dlg_list.$obj
					.removeAttr('tid rtid')
					.find('a.btn-set').removeClass('active').next('.set-dropdown').hide().end().end()
					.find('#i-want-this').removeAttr('want-rtid').removeClass('wanted').find('b').text(gettext('Want')).end().end()
					.find('.default .btn-create').hide().end()
					.find('.user-list > li[data-id]').remove().end();
				
				$coltext.val('');
			},
			close : function(){
				var $gear = $list_popup.find('a.btn-set');

				if($gear.hasClass('active')) $gear.removeClass('active').next('.set-dropdown').hide();

				$list_popup
					.find('>.default').show().end()
					.find('>.create-list').hide().end();
			},
			mousedown : function(event){
				var $target = $(event.target), $menu = dlg_list.$obj.find('.set-dropdown');

				if($menu.is(':visible')){
					if(!$target.closest('.btn-set').length && !$target.closest($menu).length) $menu.prev('a.btn-set').click();
				}
			}
		})
		.on('click', '.btn-set', function(event){
			event.preventDefault();
			$(this).toggleClass('active').next('.set-dropdown').toggle();
		})
		.on('click', '.btn-unfancy', function(event){
			event.preventDefault();

			var $btn = $(this), tid = $list_popup.attr('tid'), rtid = $list_popup.attr('rtid');

			if(!tid || !rtid) return false;
// 			if(!confirm(gettext('Are you sure you want to unfancy this?'))) return dlg_list.close();

			$btn.disable();

			$.ajax({
				type : 'post',
				url  : '/delete_reaction_tag.xml',
				data : {rtid:rtid},
				dataType : 'xml',
				success  : function(xml){
					var $xml = $(xml), $st = $xml.find('status_code');
					if(!$st.length || $st.text() != 1) return;
					$('.button.fancyd[rtid='+rtid+']').removeAttr('rtid').removeClass('fancyd').addClass('fancy').html('<span><i></i></span>'+gettext('Fancy it'));
					dlg_list.close();

					// refresh cache to save fancyd state
					$(window).trigger('savestream.infiniteshow');
				},
				complete : function(){
					$btn.disable(false);
				}
			});
		})
		.on('click', '.btn-create-list', function(event){
			event.preventDefault();

			dlg_list.$obj
				.find('a.btn-set').removeClass('active').next('.set-dropdown').hide().end().end()
				.find('>.default').hide().end()
				.find('>.create-list')
					.show()
					.find('.user-list > li[data-id]').remove().end()
				.end();

			$coltext.val('');

			dlg_list.center();
		})
		.on('click', '.create-list button.cancel', function(){
			dlg_list.$obj
				.find('>.default').show().end()
				.find('>.create-list').hide().end();

			dlg_list.center();
		})
		.on('click', '.btn-done', function(){
			dlg_list.close();
		})
		.find('.list-categories ul')
			.delegate('input[type=checkbox]', 'change', function(){
				var $li = $(this).closest('li'), params, url;

				params = {
					tid : dlg_list.$obj.attr('tid'),
					list_ids : ''+this.getAttribute('id')
				};

				if(this.checked){
					url = '/add_item_to_lists.xml';
					$li.addClass('selected');
				} else {
					url = '/remove_item_from_lists.xml';
					$li.removeClass('selected');
				}

				$.ajax({
					type : 'post',
					url  : url,
					data : params,
					dataType : 'xml',
					success  : function(xml){
						var $xml = $(xml), $st = $xml.find('status_code');
						if(!$st.length || $st.text() != 1) return;
					}
				});
			})
		.end()
		.on('keyup', '#quick-create-list', function(){
			$.trim(this.value).length  ? $(this).next().show() : $(this).next().hide();
		})
		.on('submit', 'form', function(event){
			event.preventDefault();

			var el, i, c, form = this, params = {};

			for(i=0,c=this.elements.length; i < c; i++){
				el = this.elements[i];
				if(!el.name || /^\d+$/.test(el.name)) continue;
				params[el.name] = $.trim(el.value);
			}

			if(form.sending) return;
			form.sending = true;

			if(!params.list_name) return;
			if(typeof params.category_id != 'undefined' && params.category_id == '0') delete params.category_id;

			$.ajax({
				type : 'post',
				url  : '/create_list.xml',
				data : params,
				dataType : 'xml',
				success  : function(xml){
					var $xml = $(xml), $st = $xml.find('status_code');
					if(!$st.length || $st.text() != 1) {
						if($xml.find('message').length) alert($xml.find('message').text());
						return;
					}

					dlg_list.$obj
						.find('input[name="list_name"]').val('').end()
						.find('select').prop('selectedIndex', 0).end();

					if($(form.parentNode).hasClass('create-list')) {
						dlg_list.$obj.find('>.create-list').hide().end().find('>.default').show();
						dlg_list.center();
					}

					var loid, lid = $xml.find('list_id').text(), $chk = dlg_list.$obj.find('input#'+lid), $ul, $li;
					loid = form.getAttribute('loid');
					if(!$chk.length){
						$ul = dlg_list.$obj.find('.list-categories ul');
						$li = $('<li style="#fff6a0"><label for="'+lid+'"><input type="checkbox" name="'+lid+'" id="'+lid+'">'+params.list_name.escape_html()+'</label></li>').prependTo($ul).animate({backgroundColor:'#fff'}, 500);
						$ul.animate({scrollTop:0},200);
						$chk = $li.find(':checkbox');
					}
					$chk.prop('checked',true).trigger('change').closest('li').addClass('selected');

					// add collaborators
					if(params.collaborators) add_collaborators(lid, loid, params.collaborators);
				},
				complete : function(){
					form.sending = false;
				}
			});
		})
		.on('click', '#i-want-this', function(){
			var $this = $(this), url, params = {};
			if($this.hasClass('wanted')) {
				url = '/delete_want_tag.xml';
				params.rtid = $this.attr('want-rtid');
			} else {
				url = '/add_want_tag.xml';
				params.thing_id = dlg_list.$obj.attr('tid');
			}

			$this.disable();

			$.ajax({
				type : 'post',
				url  : url,
				data : params,
				dataType : 'xml',
				success  : function(xml){
					var $xml = $(xml), $st = $xml.find('status_code'), rtid;
					if(!$st.length || $st.text() != 1) return;
					if($this.hasClass('wanted')){
						$this.removeAttr('want-rtid').removeClass('wanted').find('b').text(gettext('Want'));
					} else {
						rtid = $xml.find('id').text() || 0;
						if(rtid) $this.attr('want-rtid', rtid).addClass('wanted').find('b').text(gettext('Wanted'));
					}
				},
				complete : function(){
					$this.disable(false);
				}
			});
		})
		.find('.user-list')
			.delegate('a', 'click', function(event){
				event.preventDefault();
				var id = $(this).closest('li').remove().attr('data-id'), regex;

				regex = new RegExp('\\b(%d,?|,%d)\\b'.replace(/%d/g, id), 'g');

				$coltext.val( $.trim($coltext.val()).replace(regex, '') );
			})
		.end()

	$usertext = $('#create-list-find-user');
	$coltext  = $('#create-list-collaborators');
	$tpl_user = $('#tpl-invite-user-list');

	dlg_list.$obj.find('#create-list-find-user').usercomplete({
		listSelector : dlg_list.$obj.find('.comment-autocomplete'),
		itemSelector : 'li',
		onSelect : function($el){
			var data = $el.data('usercomplete-data'), cols = $.trim($coltext.val());
			$usertext.val('');

			$tpl_user.template(data).insertBefore($tpl_user);
			$coltext.val( cols ? cols+','+data.id : data.id );
		}
	});

	loading_txt = $list_popup.find('.list-box ul').html();

	$('#show-add-to-list').click(function(event){
		event.preventDefault();
		$('.button.fancy, .button.fancyd').eq(0).attr('show_add_to_list','true').click();
	});

	// when click "Fancy it" or "Fancy'd" button
	$('#content,#sidebar,#slideshow-box, .profile')
		.delegate('.button.fancyd, .button.fancy', 'click', function(event){

			var $this = $(this),
				tid  = $this.attr('tid') || null,
				rtid = $this.attr('rtid') || null,
				sl   = $this.attr('show_add_to_list') || null,
				login_require = $this.attr('require_login'),
				checkbox_url  = '/_get_list_checkbox.html?t='+(new Date).getTime(),
				available_dlg = !!dlg_list.$obj.length;

			event.preventDefault();

			if (login_require && login_require=='true') return require_login();

			$this.addClass('loading');

			if(tid != null)  checkbox_url += '&tid='+tid;
			if(rtid != null) checkbox_url += '&rtid='+rtid;
			if(sl != null)   checkbox_url += '&sl='+sl;

			var no_check_point = false;
			var img_src = $this.attr('item_img_url');
			var obj_name = $this.attr('item_name') || $this.parent().find('figcaption').text();

			if (!img_src) {
				img_src = $this.data('image-src') || $this.parent().find('.fig-image img').attr('src').replace('/200/', '/310/');
				no_check_point=true;
			}

			if(dlg_list.$obj.length && (rtid || dlg_list.$obj.attr('show_when_fancy') == 'true' || sl)) {
				$this.removeAttr('show_add_to_list');
				dlg_list.open();
			}

			$list_popup
				.find('.list-categories ul').html(loading_txt).end()
				.find('.fig-caption span').text(obj_name).end()
				.find('.item-image img').attr('src', img_src);

			// get lists and reaction tags
			$.ajax({
				type : 'get',
				url  : checkbox_url,
				success : function(html){
					var $ul = available_dlg ? dlg_list.$obj.find('.list-categories ul') : $('<ul />');

					$this.removeClass('loading');

					$ul.html(html);

					if(sl) $this.removeAttr('sl');
					if(!rtid){
						rtid = $ul.find('input.rtid').val();

						$this
							.attr('rtid', rtid)
							.toggleClass('fancy fancyd')
							.html('<span><i></i></span>'+gettext("Fancy'd"));

						// refresh cache to save fancyd state
						$(window).trigger('savestream.infiniteshow');
					}

					if (tid)  dlg_list.$obj.attr('tid',  tid);
					if (rtid) dlg_list.$obj.attr('rtid', rtid);

					// The checkbox for "I want this"
					var $want = $list_popup.find('.list-categories ul input.want-rtid');
					if($want.length) dlg_list.$obj.find('#i-want-this').attr('want-rtid', $want.val()).addClass('wanted').find('b').text(gettext('Wanted'));

					$this.trigger('fancy');

				}
			});

			if(!categories_loaded) load_category();
		})
		.delegate('.button.fancyd', 'mouseenter mouseleave', function(event){
			var $this = $(this);
			if (event.type == 'mouseenter') {
				$this.contents().filter(function(){ return this.nodeType == 3; }).remove();
				if ($this.hasClass('noedit')) {
					$this.append(gettext('Unfancy'));
				} else {
					$this.append(gettext('Edit'));
				}
			} else {
				$this.html("<span><i></i></span>" + gettext("Fancy'd"));
			}
		});

	// load categories
	var categories_loaded = false;
	function load_category(){
		$.ajax({
			type : 'get',
			url  : '/categories_lists.json',
			success : function(json){
				var $select = $('#categories-for-new-list');

				try {
					$.each(json.response.categories, function(i,v,a){
						$('<option />').text(v.name).attr('value', v.id).appendTo($select);
					});

					categories_loaded = true;
				} catch(e){}
			}
		});
	};

	function add_collaborators(list_id, list_owner_id, user_ids){
		$.ajax({
			type : 'POST',
			url  : '/invite_list_collaborator.xml',
			data : {lid : list_id, loid : list_owner_id, lcid:user_ids},
			dataType : 'xml',
			success  : function(xml){
				// TODO?
			}
		});
	};
});

//sign-in
jQuery(function($){
	var dlg_signin = $.dialog('signin-overlay'),
        dlg_register = $.dialog('register');
	$('#navigation-test .mn-signup').click(function(event){
		event.preventDefault();
		dlg_signin.open();
	});

	dlg_signin.$obj
		.on('open', function(){
			$('#signin-email').val('');
			dlg_signin.$obj.find('.btn-signup').disable();
		})
		.on('keypress', '#signin-email', function(event){
			var valid = /^[\w\+\-\.]{2,64}@([\w-]+\.)+[a-z]{2,3}$/i.test($.trim(this.value));
			dlg_signin.$obj.find('.btn-signup').disable( !valid );

			if(valid && event.which == 13){
				dlg_signin.$obj.find('.btn-signup').click();
			}
		})
		.on('click', '.btn-signup', function(){
			//location.href = '/signup?email='+encodeURIComponent($('#signin-email').val());
            var that = this;
            $(this).disable(true);
            $.post('/email_signup.json', {'email':$.trim($('#signin-email').val())},
		    function(response){
			if (response.status_code != undefined && response.status_code == 1) {
		        dlg_register.username = response.username;
                dlg_register.email = response.email;
                dlg_register.fullname = response.fullname;
                dlg_register.open(); 
			} else if (response.status_code != undefined && response.status_code == 0) {
			    var msg = response.message;
			    var error = response.error;
                            alert(msg);
			}
            $(that).disable(false);
            },
		    'json'
		);
        })
		.on('click', 'a.more', function(event){
			event.preventDefault();
			dlg_signin.$obj.toggleClass('toggle');
		})
		.on('click', '.sns-minor .trick', function(event){
			event.preventDefault();
			dlg_signin.$obj.removeClass('toggle');
		});

    var update_user_page_url = function (e) {
        $(this).parent().find('.url b').text($(this).val());
    };
    dlg_register.$obj
        .on('open', function(){
            dlg_register.$obj.find('input[name="username"]').val(dlg_register.username).change();
            dlg_register.$obj.find('input[name="email"]').val(dlg_register.email);
            dlg_register.$obj.find('input[name="fullname"]').val(dlg_register.fullname);
        })
        .on('close', function(){
            location.href = '/onboarding';
        })
        .find('input[name="username"]').keyup(update_user_page_url).change(update_user_page_url).end();
});

// shortcuts - only for timeline
jQuery(function($){
	var $win = $(window),
	    $body = $('body'),
	    $stream = $('.stream'),
	    $slidebox = $('#slideshow-box'),
	    hh = $('header').eq(0).height(),
		dlg_cmt = $.dialog('add-cmt'),
	    $focused;

	if(!$stream.length) return;

	$stream.delegate('a[rel]', {
		setFocus : function(){
			var $this = $focused = $(this), ot = $this.offset().top, new_st;

			new_st = ot - hh - 20;

			$body.stop().animate({scrollTop : new_st}, function(){
				$this.get(0).focus();
				$focused = $this;
			});

			$('a[rel].focus').removeClass('focus');
			$this.addClass('focus');
		},
		blur  : function(){
			$(this).removeClass('focus');
			$focused = null;
		}
	});

	$.hotkey({
		'S' : function(e){
			if(state() & SKIP) return;
			location.href = '/things/shuffle';
		},
		'J' : function(e){
			var s = state();
			if(s & SKIP) return;
			if(s & GOT_FOCUS) {
				var $fp = $focused.parent(), $el;

				($el=$fp.prev('.figure-product')).length ||
				($el=$fp.closest('.figure-row').prev('.figure-row')).length ||
				($el=$fp.closest('li').prev('li')).length;

				$el.find('a[rel]:last').trigger('setFocus');
			} else {
				var $rows = $stream.find('.figure-row'), st = $win.scrollTop();
				$rows.each(function(i,v,a){
					var $this = $(this);
					if($this.offset().top - hh - st > 20) {
						if(i > 0) {
							$rows.eq(i-1).find('a[rel]:first').trigger('setFocus');
						} else {
							$this.find('a[rel]:first').trigger('setFocus');
						}
						return false;
					}
				});
			}
		},
		'K' : function(e){
			var s = state();
			if(s & SKIP) return;
			if(s & GOT_FOCUS) {
				var $fp = $focused.parent(), $el;

				($el=$fp.next('.figure-product')).length ||
				($el=$fp.closest('.figure-row').next('.figure-row')).length ||
				($el=$fp.closest('li').next('li')).length;

				$el.find('a[rel]:first').trigger('setFocus');
			} else {
				var st = $win.scrollTop();
				$stream.find('.figure-row').each(function(){
					var $this = $(this);
					if($this.offset().top - hh - st > 20) {
						$this.find('a[rel]:first').trigger('setFocus');
						return false;
					}
				});
			}
		},
		'F' : function(e){
			if(state() & GOT_FOCUS){
				$focused.nextAll('.button.fancy, .button.fancyd').click();
			}
		},
		'A' : function(e){
			if(state() & GOT_FOCUS){
				$focused.nextAll('.button.fancy, .button.fancyd').attr('show_add_to_list', 'true').click();
			}
		},
		'C' : function(e){
			if(state() & GOT_FOCUS){
				dlg_cmt.$obj.find('input[name="tid"]').val($focused.sibling('.button.fancy,.button.fancyd').attr('tid'));
				dlg_cmt.open();
			}
		},
		'H' : function(e){
			if(state() & GOT_FOCUS) $focused.find('button.btn-share').click();
		},
		'ENTER' : function(e){
			if(state() & GOT_FOCUS) $focused.click();
		}
	});

	var SKIP = 1, GOT_FOCUS = 2;
	function state(){
		if($slidebox.is(':visible')) return SKIP;
		if($focused && $focused.is('.figure-product > a[rel].focus')) return GOT_FOCUS;
		
		$focused = $(':focus');
		if($focused.is('textarea,input:text,input:password')) return SKIP;

		return 0;
	}
});

// MyThings
function _mt_ready_cart(){
	if (typeof(MyThings) != "undefined" && window.MyThingsProductID) {
		MyThings.Track({
			EventType: MyThings.Event.Visit,
			Action: "1013",
			ProductID: window.MyThingsProductID
		});
		MyThingsProductID = null;
	}
};
var mtHost = (("https:" == document.location.protocol) ? "https" : "http") + "://rainbow-us.mythings.com";
var mtAdvertiserToken = "2236-100-us";

if (navigator.platform.indexOf('Win') != -1) {
	$('body').addClass('winOS');
}

jQuery(function($){
    var checkClickId = function(hash) {
        var q = hash.indexOf("?");
        var smarttrk_ad = false;
        var click_id = false;
        if (q >= 0) {
            var kv = hash.substr(q+1).split("&");
            var cid = "";
            for (var i = 0; i < kv.length; ++i) {
                var p = kv[i].split("=");
                if (p[0] == "ClickID" && p[1].length > 0) {
                    click_id = true;
                    cid = p[1];
                }
                else if (p[0] == 'ref' && p[1] == 'da') {
                    smarttrk_ad = true;
                }
            }

            if (click_id == true) {
                var expire = new Date();
                var time = expire.getTime();
                time += 1800 * 1000;
                expire.setTime(time);
                if (smarttrk_ad == true) {
                    document.cookie = 'ck_da_clickid' + '='+ cid +'; path=/; expires='+expire.toUTCString();
                } else {
                    document.cookie = 'ck_secco_clickid' + '='+ cid +'; path=/; expires='+expire.toUTCString();
                }
            }
            return;
        }
    }
    checkClickId(location.hash);
    checkClickId(location.search);
});

$(window).ready(function(){
        if (can_show_signin_overlay == true) {
            $.dialog('signin-overlay').open().close = function() {};
        }
	
	// new fancy share
	$('.share-via li').each(function(){
		$(this).mouseover(function(){
			$(this).find('em').css('left',(28*$(this).index())+28+'px').css('margin-left',-($(this).find('em').width()/2)-8+'px');
		});
	});
	$('.share-with-someone .to input').focus(function(){
		$(this).parents('.email-frm').addClass('focus');
	});
	$('.share-with-someone .to input').blur(function(){
		$(this).parents('.email-frm').removeClass('focus');
	});
	$('#fancy-share .link').click(function(){
		$("#fancy-share .link input").stop();
	});
	$('#fancy-share .link .ic-link')
		.hover(function(){
			var $this = $(this), $em = $this.find('em');

			$em.css('margin-left',-($em.width()/2)-9+'px').show();

			if(!$this.data('init-zclip')){
				$this.zclip({
					path:'http://www.steamdev.com/zclip/js/ZeroClipboard.swf',
					copy:function(){return $(this).parents('.link').find('input').val();},
					afterCopy:function(){
						$em.text('Copied').css('margin-left',-($em.width()/2)-9+'px').show();
						setTimeout(function(){
							$em.hide().text('Copy link to clipboard');
						},1000);
					}
				});
				$this.data('init-zclip', true);
			}
		})
		.mouseout(function(){
			$(this).find('em').hide();
		});

});
