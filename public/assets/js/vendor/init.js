/*!

 * jQuery Cookie Plugin v1.3

 * https://github.com/carhartl/jquery-cookie

 *

 * Copyright 2011, Klaus Hartl

 * Dual licensed under the MIT or GPL Version 2 licenses.

 * http://www.opensource.org/licenses/mit-license.php

 * http://www.opensource.org/licenses/GPL-2.0

 */

(function ($, document, undefined) {



	var pluses = / '+/g;



	function raw(s) {

		return s;

	}



	function decoded(s) {

		return decodeURIComponent(s.replace(pluses, ' '));

	}



	var config = $.cookie = function (key, value, options) {



		// write

		if (value !== undefined) {

			options = $.extend({}, config.defaults, options);



			if (value === null) {

				options.expires = -1;

			}



			if (typeof options.expires === 'number') {

				var days = options.expires, t = options.expires = new Date();

				t.setDate(t.getDate() + days);

			}



			value = config.json ? JSON.stringify(value) : String(value);



			return (document.cookie = [

				encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),

				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE

				options.path    ? '; path=' + options.path : '',

				options.domain  ? '; domain=' + options.domain : '',

				options.secure  ? '; secure' : ''

			].join(''));

		}



		// read

		var decode = config.raw ? raw : decoded;

		var cookies = document.cookie.split('; ');

		for (var i = 0, l = cookies.length; i < l; i++) {

			var parts = cookies[i].split('=');

			if (decode(parts.shift()) === key) {

				var cookie = decode(parts.join('='));

				return config.json ? JSON.parse(cookie) : cookie;

			}

		}



		return null;

	};



	config.defaults = {};



	$.removeCookie = function (key, options) {

		if ($.cookie(key) !== null) {

			$.cookie(key, null, options);

			return true;

		}

		return false;

	};



})(jQuery, document);







 /* -------------------------------------------------------------- 

 -------------------------------------------------------------- */

 /* -------------------------------------------------------------- 

 -------------------------------------------------------------- */







jQuery(document).ready(function() {

	/**

	 * Style Switcher

	 */

	



	// Changes DOM Elements

	var colorObj = {

		'span.custom , span.custom a' : 'color' ,

		'section.top-section ' : 'background' ,

		'section.top-section a.toggle' : 'background-color' ,

		'section.top-section a.toggleDown ' : 'background-color',

		'.section .header > span ' : 'background' ,

		'.posts .single-post .image .post-format ' : 'background-color',

		'.widget .tabs .links a.active' : 'border-top-color',

		'.widget .header span ' : 'background',

		'.widget-content .carousel .carousel-control.hover ' : 'background-color' ,

		'td#today' : 'color' ,

		' #wp-calendar tfoot td#next a' : 'background-color' ,

		'footer.footer ' : 'border-color' ,

		'footer .container .subscribe-form ' : 'background' ,

		'.flickr-widget .photo:hover' : 'border-color' ,

		'.slider ol.flex-control-nav li a.flex-active' : 'background' ,

		'.slider .desc h3' : 'background' ,

		'.sliderthumbs ul.slides li.flex-active-slide div' : 'border-color' ,

		'.sliderthumbs ul.slides li.flex-active-slide:after' : 'border-color' ,

		'.sliderthumbs .flex-direction-nav a:hover' : 'background-color',

		'.box200 .grids .meta .date span.tag' : 'color' ,

		'.classic-blog .meta .date span.tag ' : 'color' ,

		'.classic-blog .meta .content a.readmore' : 'color' ,

		'.left-side .pagination ul li a.active' : 'background',

		'.left-side .pagination ul li a:hover' : 'background' ,

		'.pagination .pagination-direction .next' : 'background-color' ,

		'.pagination .pagination-direction a:hover' : 'background-color' ,

		'.page-single .post-meta a.tag' : 'color',

		'.comments .comment .meta .date .custom' : 'color' ,

		'.comments-form input.submit ' : 'background' ,

		'.tinyscroll .thumb' : 'background' ,

		'.tinyscroll .thumb .arrow' : 'border-bottom-color',

		'section.navigation-section .container' : 'border-color' ,

		'.view-more' : 'color' ,

		'.calendar-caption .next' : 'background-color',

		'.dropcap.two:first-letter' : 'background-color',

		'.switcher-wrapper span.toggle' : 'background-color'

	};



	// Append Switcher Code

	/* var code = [ '<div class="switcher-wrapper"> <span class="toggle"></span>',

			' <!-- skins  --> ',

			' <h4>Select Color</h4> ',

			' <!-- skins wrapper --> ',

			' <div class="skins-wrapper colors"> ',

				' <a href="#" class="blue"></a> ',

				' <a href="#" class="green"></a> ',

				' <a href="#" class="red"></a> ',

				' <a href="#" class="orange"></a> ',

				' <a href="#" class="dark-grey"></a> ',

				' <a href="#" class="brown"></a> ',

				' <a href="#" class="pink"></a> ',

				' <a href="#" class="dark-red"></a> ',

				' <a href="#" class="dark-blue"></a> ',

			' </div> ',

			' <!-- end skins wrapper --> <br />',

			'<h4>Select Version</h4>',

			'<select class="select-version">',

			'<option>Full Width</option>' ,

			'<option>Boxed</option>' ,

			'</select>',

			'<span class="dark">Dark</span>',

			'<span class="light">Light</span>',

			'<br />',

			'<h4>Select Pattern</h4>' ,

			' <div class="skins-wrapper pats"> ',

				' <a href="#" class="pat pat1"></a> ',

				'<a href="#" class="pat pat2"></a>',

				'<a href="#" class="pat pat3"></a>',

				'<a href="#" class="pat pat4"></a>',

				'<a href="#" class="bg bg1"></a>',

				'<a href="#" class="bg bg2"></a>',

				'<a href="#" class="bg bg3"></a>',

				'<a href="#" class="bg bg4"></a>',

			' </div> ',

		' </div> ',

		' <!-- end switcher --> '].join("\n") ;

	jQuery('body').append(code); */





	/**

	 * Toggle the switcher

	 */

	jQuery('.switcher-wrapper').css({

		left: '-140px'

	});



	jQuery('.switcher-wrapper span.toggle').live('click' , function() {

		if(jQuery(this).hasClass('toggle-active'))

		{

			jQuery(this).removeClass('toggle-active');

			jQuery(this).parent().stop().animate({left: '-140px'} , {duration: 500});

		}

		else{

			jQuery(this).addClass('toggle-active');

			jQuery(this).parent().stop().animate({left: '0px'} , {duration: 500});

		}

	});





	// load hex color from cookie if found

	if(jQuery.cookie('b_theme_color_hex') != 'rgb(5, 172, 214)' && jQuery.cookie('b_theme_color_hex') != 'null')

	{



		var getColor = jQuery.cookie('b_theme_color_hex');

		// loop 

		for(var a in colorObj) {

				jQuery(a).css(colorObj[a] , getColor);			

		}

	}











	// click

	jQuery('.switcher-wrapper .colors a').live('click' ,function() {

		var anc = jQuery(this);

		var color = anc.css('background-color');

		

		// save hex color in cookie 

		jQuery.removeCookie('b_theme_color_hex');

		jQuery.cookie('b_theme_color_hex' , color  , { expires: 1, path: '/' });



		// Loop

		for(var a in colorObj) {

				jQuery(a).css(colorObj[a] , color);			

		}





		// fix slider color 

		jQuery('.slider ol.flex-control-nav li a').css({background: "#7f7f7f"});

		jQuery('.slider ol.flex-control-nav li a.flex-active').css({background: jQuery.cookie('b_theme_color_hex')});





		// fix search icon

		jQuery('.right-side .searchform .submit').css({

			background : 'url(img/more-search/zoom-' + anc.attr('class') + '.png) no-repeat'

		});

		



		// fix logo

		jQuery('.logo-wrapper a img').attr('src' , 'img/more-logos/' + anc.attr('class') + '.png');



		if(!jQuery(this).hasClass('version'))

		{

			return false;

		}



	});





	// click on pats

	jQuery('.switcher-wrapper .pats a').live('click' , function() {

		if(jQuery('body > .boxed-wrapper').length > 0){



			var img = '';

			if(jQuery(this).hasClass('pat'))

			{

				var imgName = jQuery(this).attr('class').replace('pat ' , '');

				jQuery('body').css({backgroundImage : 'url(switcher/patterns/' + imgName + '.gif)' , backgroundRepeat: 'repeat'});

			}

			else if(jQuery(this).hasClass('bg')){

				var imgName = jQuery(this).attr('class').replace('bg ' , '');

				jQuery('body').css({background : 'url(switcher/patterns/' + imgName + '.jpg) top left no-repeat fixed'});

			}

			return false;



		}

		else{

			alert('Please Select Boxed Version ');

			return false;

		}

	});











	jQuery('.switcher-wrapper span').live('click' , function() {

		if(jQuery(this).hasClass('dark'))

		{

			window.location.href = '../html_dark/index.html';

		}

		else if(jQuery(this).hasClass('light'))

		{

			window.location.href = '../html/index.html';

		}

	});









	// edit menu hover color , this will get the value from the cookie 

	jQuery('section.navigation-section ul li a').hover(

	function() {



		jQuery(this).css({

			backgroundImage : 'none' ,

			backgroundColor: jQuery.cookie('b_theme_color_hex')

		});



	},

	function() {



		jQuery(this).css({

			backgroundImage : 'none' ,

			backgroundColor: 'transparent'

		});

	});







	// link color

	jQuery('a').each(function(){

		var h = jQuery(this).css('color');

		if(!jQuery(this).parent().parent().parent().hasClass('navigation')

			 &&

			 !jQuery(this).parent().parent().parent().is('.top-menu')

			 &&

			 !jQuery(this).parent().parent().parent().parent().is('.slides')

			 &&

			 !jQuery(this).parent().is('.subscribe-form')

			 )

		{

			jQuery(this).hover(function(){

				jQuery(this).css({color: jQuery.cookie('b_theme_color_hex')});

			}, function() 

			{	

				jQuery(this).css({color: h});

			});

		}

	});







	// fix slider button color

	jQuery('.slider ol.flex-control-nav li a').css({background: "#7f7f7f"});

	jQuery('.slider ol.flex-control-nav li a.flex-active').css({background: jQuery.cookie('b_theme_color_hex')});

	jQuery('.slider ol.flex-control-nav li a').live('click' , function() {

		jQuery('.slider ol.flex-control-nav li a').css({background: "#7f7f7f"});

		jQuery('.slider ol.flex-control-nav li a.flex-active').css({background: jQuery.cookie('b_theme_color_hex')});

	});







	/**

	 * Change html version 

	 */

	

	jQuery('.switcher-wrapper select.select-version').live('change' , function() {

		var v = jQuery(this).val();

		switch(v)

		{

			case 'Full Width' :

				

				if(jQuery('body > .boxed-wrapper').length > 0)

				{

						location.reload();

				}

			break;



			case 'Boxed' :

window.location.href = '../html_boxed/index.html';
			break;

		}

	});



});

