/**
 * requestAnimationFrame polyfill
 *
 * http://paulirish.com/2011/requestanimationframe-for-smart-animating/
 * http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
 * requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
 * requestAnimationFrame polyfill under MIT license
 */
(function() {
	var lastTime = 0;
	var vendors = ['ms', 'moz', 'webkit', 'o'];
	for( var x = 0; x < vendors.length && ! window.requestAnimationFrame; ++x ) {
		window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
	}

	if (!window.requestAnimationFrame) {
		window.requestAnimationFrame = function( callback, element ) {
			return window.setTimeout( function() { callback(); }, 16 );
		};
	}
}());


/*
Plugin: Eazyee Parallax
Version 1.0.0
Author: Nicolae Gabriel
Author URL: 
Plugin URL: 

Plugin Structure: http://www.smashingmagazine.com/2011/10/11/essential-jquery-plugin-patterns/

*/


if ( typeof _ewfVCParallax === 'undefined' ) {
	var _ewfVCParallax = [];
	var _ewfVCParallax_scrollTop, _ewfVCParallax_scrollLeft, _ewfVCParallax_windowHeight;
}



;(function ( $, window, document, undefined ) {

    var pluginName = 'eazParallax',
		defaults = {
				align: 'center',	// center | cover | repeat-x | repeat-y | repeat
			direction: 'up',		// up | down
				speed: .3,			//
				image: ''
		};


	function Plugin( element, options ) {
		this.element = $(element);

		this.options = $.extend( {}, defaults, options) ;
		
		this._defaults = defaults;
		this._name = pluginName;
		
		this.init();
	}
	
	
	$.extend(Plugin.prototype, {
		
		init: function (){
			var $element = this.element;
			
			_ewfVCParallax.push( this );
			
			$element.css('background-image', 'url("' + this.options.image + '")');

			// console.log('init');
			this.update();
		},
		
		update: function (){
			var $element = this.element;
			var top = $element.offset().top;
			var height = $element.height();

			if (top + height < _ewfVCParallax_scrollTop || top > _ewfVCParallax_scrollTop + _ewfVCParallax_windowHeight) {
				return;
			}
			
			// console.log('update');

			$element.css('background-position', this.options.align + " " + ( Math.round((top - _ewfVCParallax_scrollTop) * this.options.speed)) + 'px');
		},
		
		/*
		
		$this.each(function(){
			var $element = $(this);
			var top = $element.offset().top;
			var height = getHeight($element);

			// Check if totally above or totally below viewport
			if (top + height < pos || top > pos + windowHeight) {
				return;
			}

			$this.css('background-position', xpos + " " + ( Math.round((firstTop - pos) * speedFactor)) + 'px');
			
		});
		
		*/
		
		height: function(){
			
		},
		
		parallax: function (){
			
			this.update();
		}
	
	});
	
	
    $.fn[pluginName] = function ( options ) {
        this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, 
                new Plugin( this, options ));
            }
        });
		
		return this;
    }
	
	
})( jQuery, window, document );



jQuery(document).ready(function($) {
	"use strict";
	
	
	
	$( window ).on('scroll touchmove touchstart touchend gesturechange mousemove', function( e ){
		requestAnimationFrame( function(){
				
			_ewfVCParallax_scrollTop = window.pageYOffset;
			_ewfVCParallax_scrollLeft = window.pageXOffset;
			_ewfVCParallax_windowHeight = $(window).height();
			
			
			for ( var i = 0; i < _ewfVCParallax.length; i++) {
				_ewfVCParallax[ i ].parallax();
			}
				
		});
	});

	
	$('.eazParallax').each(function() {
		
		$(this).eazParallax({
			image: $(this).attr('data-image'),
			direction: $(this).attr('data-direction'),
			align: $(this).attr('data-align'),
			speed: $(this).attr('data-speed'),
		});
		
	});

	
});


/*

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.ewfParallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		// var config = $.extend({}, {
			//opt1: null
		// }, opts);
		
		
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
		
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "center";
		if (arguments.length < 2 || speedFactor === null) speedFactor = .4;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		

		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();	

			// console.log('speedFactor: '+speedFactor);
			// console.log('xpos: '+xpos);
			// console.log('outerHeight: '+outerHeight);
			// console.log('pos: '+pos);
			
			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('background-position', xpos + " " + ( Math.round((firstTop - pos) * speedFactor)) + 'px');
				
			});
		}		

		$window.bind('scroll', update).resize(update);
		update();
	};

	

	$(document).ready(function() {

		if(typeof $.fn.ewfParallax != 'undefined'){
			$('.parallax').each(function() {

				var $t = $(this);
				var parallax_image = $t.attr('data-image');
				
				$t.addClass("parallax-enabled").css('background-image','url("'+parallax_image+'")');
				$t.ewfParallax();

			});
		}
		
	});


})(jQuery);

*/
