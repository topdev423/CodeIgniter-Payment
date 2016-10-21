(function () {

var baseUrl = $("body").attr("bookmarklet-baseUrl"),
	uid		= $("body").attr("bookmarklet-uid"),
	host 	= baseUrl, prefix = 'bookmarklet-tagger-',
    iframe  = {obj:null, id:prefix+'iframe', win: null, url:host+'bookmarklet?u='+uid},
	marker  = {obj:null, id:prefix+'marker'}, // image marker
	factory = document.createElement('div'),
	body    = document.body,
	latest  = {img:null, images:[]};

extend(iframe, {
	show : function(){
		var im = document.images, i, c, imgs=[], idx=-1, data;
		for(i=0,c=im.length; i < c; i++){
			if(im[i].src && im[i].offsetWidth > 150 && im[i].offsetHeight > 150) {
				if(latest.img && latest.img === im[i]) idx = imgs.length;
				imgs[imgs.length] = im[i];
			}
		}
		latest.images = imgs;

		if(!latest.img || idx < 0) idx = 0;

		data = imageData(idx);
 		this.obj.style.width = '281px';
		this.obj.style.height = '469px';
		this.obj.style.display = 'block';
		send(data);
	},
	hide : function(){
		this.obj.style.display = 'none';
		this.obj.setAttribute('src', 'about:blank');
	}
});

extend(marker, {
	show : function(){
		if(this.obj) this.obj.style.display = 'block';
	},
	hide : function(){
		if(this.obj) this.obj.style.display = 'none';
	}
});

var handlers = {
	doc : {
		keyup : function(event){
			event = window.event || event;
			if(event.keyCode != 27) return; // exit if pressed key isn't ESC

			iframe.hide();
		},
		mouseover : function(event){
			event = window.event || event;
			var el = event.target || event.srcElement, pos;

			if(el.nodeName != 'IMG' || el.offsetWidth < 150 || el.offsetHeight < 150) return;

			latest.img = el;

			pos = offset(el);
			css(marker.obj, {top:pos.top+'px', left:pos.left+'px', width:el.offsetWidth+'px', height:el.offsetHeight+'px'});
			marker.show();
		}
	},
	marker : {
		click : function(event){
			event = window.event || event;

			try{
				event.preventDefault();
				event.stopPropagation();
			}catch(e){
				event.returnValue = false;
				event.cancelBubble = true;
			};

			iframe.show();
			marker.hide();
		},
		mouseout : function(event){
			event = window.event || event;
			var el = event.target || event.srcElement;
			if(el === marker.obj) marker.hide();
		}
	}
};

if('postMessage' in window){
	on(window, 'message', function(event){
		event = window.event || event;
		var args = unparam(event.data);
		onMessage(args);
	});
} else {
	var hash = '', hashTimer = null;
	(function(){
		if(location.hash == hash || !/^#tagger:/.test(hash=location.hash)) return hashTimer=setTimeout(arguments.callee, 100);
		var args = unparam(hash.replace(/^#tagger:/, ''));
		onMessage(args);
	})();
}

function onMessage(args){
	switch(args.cmd){
		case 'close':
			iframe.hide();
			tagger.clean_listeners();
			break;
		case 'resize':
			var height = parseInt(args.h)+parseInt(6);
			iframe.obj.style.height = height+'px';
			break;
		case 'index':
			args.idx = parseInt(args.idx);
 			data = imageData(args.idx);
			send(data);
			break;
	}
};

(function(){
	if(document.readyState !== 'complete') return setTimeout(arguments.callee, 100);

	// always create new iframe
	iframe.obj = elem(iframe.id);
	if(!iframe.obj) {
		factory.innerHTML = '<iframe id="'+iframe.id+'" allowtransparency="true" style="display:none;position:fixed;top:10px;right:10px;border:1px solid #4c515c;z-index:100001;margin:0;background:#eff1f7;width:279px;height:372px"></iframe>';
		iframe.obj = factory.lastChild;
		body.insertBefore(iframe.obj, body.firstChild);
		iframe.win = iframe.obj.contentWindow || iframe.obj;
	}
	iframe.show();

	// create a marker if it doesn't exist
	marker.obj = elem(marker.id);
	if(!marker.obj){
		factory.innerHTML = '<div id="'+marker.id+'" style="visibility:hidden;position:absolute;border:10px solid rgb(0, 194, 255);z-index:100000;background:transparent url('+baseUrl+'images/image-add.png) no-repeat 5px 5px;background-size: 20%;"></div>';
		marker.obj = factory.lastChild;
		body.insertBefore(marker.obj, body.firstChild);

		css(marker.obj, {top:0, left:0});
		if(offset(marker.obj).top == 0) {
			css(marker.obj, {marginTop:'-10px',marginLeft:'-10px'});
		}
		css(marker.obj, {display:'none', visibility:'visible'});
	}

	each(handlers.doc, function(type,handler){ on(document, type, handler) });
	each(handlers.marker, function(type,handler){ on(marker.obj, type, handler) });
})();

var tagger = {
	clean_listeners : function(){
		each(handlers.doc, function(type,handler){ off(document, type, handler) });
		each(handlers.marker, function(type,handler){ off(marker.obj, type, handler) });
		clearTimeout(hashTimer);
	}
};
if(!window.thefancy_bookmarklet) window.thefancy_bookmarklet = {};
window.thefancy_bookmarklet.tagger = tagger;

// add event listsener to the specific element
function on(el,type,handler){ el.attachEvent?el.attachEvent('on'+type,handler):el.addEventListener(type,handler,false) };
// remove an event listener
function off(el,type,handler){ el.detachEvent?el.detachEvent('on'+type,handler):el.removeEventListener(type,handler) };
// get element by id
function elem(id){ return document.getElementById(id) };
// set css
function css(el,prop){ for(var p in prop)if(prop.hasOwnProperty(p))try{el.style[p.replace(/-([a-z])/g,function(m0,m1){return m1.toUpperCase()})]=prop[p];}catch(e){} };
// get offset
function offset(el){ var t=0,l=0; while(el && el.offsetParent){ t+=el.offsetTop;l+=el.offsetLeft;el=el.offsetParent }; return {top:t,left:l} };
// each
function each(obj,fn){ for(var x in obj){if(obj.hasOwnProperty(x))fn.call(obj[x],x,obj[x],obj)} };
// extend object like jquery's extend() function
function extend(){ var a=arguments,i=1,c=a.length,o=a[0],x;for(;i<c;i++){if(typeof(a[i])!='object')continue;for(x in a[i])if(a[i].hasOwnProperty(x))o[x]=a[i][x]};return o };
// unparam
function unparam(s){ var a={},i,c;s=s.split('&');for(i=0,c=s.length;i<c;i++)if(/^([^=]+?)(=(.*))?$/.test(s[i]))a[RegExp.$1]=decodeURIComponent(RegExp.$3||'');return a };
// send message to iframe window
function send(data){ iframe.obj.setAttribute('src', iframe.url+'#tagger:'+data);try{iframe.win.postMessage(data,host)}catch(e){} };
// image data
function imageData(i){
	var imgs = latest.images;
	data = [
		'total='+imgs.length,
		'idx='+i,
		'loc='+encodeURIComponent(location.protocol+'//'+location.host+location.pathname+location.search)
	];
	if(imgs[i]){
		data.push('src='+encodeURIComponent(imgs[i].src));
		data.push('title='+encodeURIComponent(imgs[i].getAttribute('alt') || imgs[i].getAttribute('title') || document.title));
	}
	return data.join('&');
}

})();