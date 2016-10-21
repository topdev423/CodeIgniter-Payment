(function($){

$(window).load(function(){
	var isChrome  = /Chrome\/\d+/i.test(navigator.userAgent);
	var isFirefox = /Firefox\/\d+/i.test(navigator.userAgent);
	var $body = $('body'), ls = window.localStorage;

	if(!ls || (ls['hide_extension_box'] && ls['hide_extension_box'] == 'Y')) return;
	if(isFirefox && $body.hasClass('fancyFirefox')) return;
	if(isChrome && $body.hasClass('fancyChrome')) return;
	if(!isFirefox && !isChrome) return;

	var $nb = $('#notification-bar'), $ir = $('#invitation-reminder');

	// if there is a general notice, don't show plugin bar.
	if ($nb.find('>div.for-general').length) return;
	if ($ir.length && $ir.is(':visible')) return;
	if (!$nb.find('>div.for-'+(isFirefox?'chrome':'firefox')).length) return;

	var $container = $('#container-wrapper').animate({'padding-top':'+=55px'},'fast');

	$nb
		.find('>div.for-'+(isFirefox?'chrome':'firefox')).hide().end()
		.slideDown('fast')
		.find('button.close')
			.click(function(){
				$nb.slideUp('fast').filter(':not(.top)').parent({'padding-top':'-=20px'}, 'fast');
				$container.animate({'padding-top':'-=55px'}, 'fast');
				ls['hide_extension_box'] = 'Y';
			})
		.end()
		.filter(':not(.top)')
		.parent().animate({'padding-top':'+=20px'}, 'fast');
});

})(jQuery);