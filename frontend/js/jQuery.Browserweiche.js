(function(factory) {
	if(typeof define === 'function' && define.amd) {
		define(['jquery'], function($) {
			return factory($);
		});
	} else if(typeof module === 'object' && typeof module.exports === 'object') {
		module.exports = factory(require('jquery'));
	} else {
		factory(window.jQuery);
	}
}(function(jQuery) {
	"use strict";
	
	function uaMatch(ua) {
		if(ua === undefined) {
			ua = window.navigator.userAgent;
		}
		ua = ua.toLowerCase();
		
		var match = /(edge)\/([\w.]+)/.exec( ua ) || /(opr)[\/]([\w.]+)/.exec( ua ) || /(chrome)[ \/]([\w.]+)/.exec( ua ) || /(version)(applewebkit)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) || /(webkit)[ \/]([\w.]+).*(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec( ua ) || /(webkit)[ \/]([\w.]+)/.exec( ua ) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) || /(msie) ([\w.]+)/.exec( ua ) || ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec( ua ) || ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) || [];
		
		var platform_match = /(ipad)/.exec( ua ) || /(ipod)/.exec( ua ) || /(iphone)/.exec( ua ) || /(kindle)/.exec( ua ) || /(silk)/.exec( ua ) || /(android)/.exec( ua ) || /(windows phone)/.exec( ua ) || /(win)/.exec( ua ) || /(mac)/.exec( ua ) || /(linux)/.exec( ua ) || /(cros)/.exec( ua ) || /(playbook)/.exec( ua ) || /(bb)/.exec( ua ) || /(blackberry)/.exec( ua ) || [];
		
		var browser = {},
		matched = {
			browser: match[5] || match[3] || match[1] || "",
			version: match[2] || match[4] || "0",
			versionNumber: match[4] || match[2] || "0",
			platform: platform_match[0] || ""
		};
		
		if(matched.browser) {
			browser[matched.browser] = true;
			browser.version = matched.version;
			browser.versionNumber = parseInt(matched.versionNumber, 10);
		}
		
		if(matched.platform) {
			browser[matched.platform] = true;
		}
		
		if ( browser.android || browser.bb || browser.blackberry || browser.ipad || browser.iphone || browser.ipod || browser.kindle || browser.playbook || browser.silk || browser[ "windows phone" ]) {
			browser.mobile = true;
		}
		
		if ( browser.cros || browser.mac || browser.linux || browser.win ) {
			browser.desktop = true;
		}
		
		if ( browser.chrome || browser.opr || browser.safari ) {
			browser.webkit = true;
		}
		
		if ( browser.rv || browser.edge ) {
			var ie = "msie";

			matched.browser = ie;
			browser[ie] = true;
		}
		
		if ( browser.safari && browser.blackberry ) {
			var blackberry = "blackberry";

			matched.browser = blackberry;
			browser[blackberry] = true;
		}
		
		if ( browser.safari && browser.playbook ) {
			var playbook = "playbook";

			matched.browser = playbook;
			browser[playbook] = true;
		}
		
		if ( browser.bb ) {
			var bb = "blackberry";

			matched.browser = bb;
			browser[bb] = true;
		}
		
		if ( browser.opr ) {
			var opera = "opera";

			matched.browser = opera;
			browser[opera] = true;
		}
		
		if ( browser.safari && browser.android ) {
			var android = "android";

			matched.browser = android;
			browser[android] = true;
		}
		
		if ( browser.safari && browser.kindle ) {
			var kindle = "kindle";

			matched.browser = kindle;
			browser[kindle] = true;
		}
		
		if ( browser.safari && browser.silk ) {
			var silk = "silk";

			matched.browser = silk;
			browser[silk] = true;
		}
		
		browser.name = matched.browser;
		browser.platform = matched.platform;
		return browser;
	}
	
	window.jQBrowser = uaMatch(window.navigator.userAgent);
	window.jQBrowser.uaMatch = uaMatch;
	
	if(jQuery) {
		jQuery.browser = window.jQBrowser;
	}
	
	return window.jQBrowser;
	
}));