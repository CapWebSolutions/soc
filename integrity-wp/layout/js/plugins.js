(function($){

	"use strict";

/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
	$(document).ready(function(){

	
		// twitterFetcher
		// http://jasonmayes.com/projects/twitterApi/
		
		if(typeof twitterFetcher !== 'undefined' && ($('.ewf_widget_latest_tweets').length > 0)) {
			
			$('.ewf_widget_latest_tweets').each(function(index){
			
				var account_id = $('.ewf-tweet-list', this).attr('data-account-id'),
					items = $('.ewf-tweet-list', this).attr('data-items'),
					newID = 'ewf-tweet-list-' + index;
				
				$('.ewf-tweet-list', this).attr('id', newID);
				
				var config = {
				  "id": account_id,
				  "domId": newID,
				  "maxTweets": items
				};
				
				twitterFetcher.fetch(config);
			});
			
		}
			
		// simplePlaceholder - polyfill for mimicking the HTML5 placeholder attribute using jQuery
		// https://github.com/marcgg/Simple-Placeholder/blob/master/README.md
		
		if(typeof $.fn.simplePlaceholder !== 'undefined'){
			
			$('input[placeholder], textarea[placeholder]').simplePlaceholder();
		
		}
		
		// Countdown - date countdown for coming soon pages
		// https://github.com/kalebheitzman/jquery-countdown
		
		if(typeof $.fn.countdown !== 'undefined'){
			
			$('.ewf-countdown').each(function(){
				
				var regionalVar = {
					days: $(this).attr('data-st-days'),
					day: $(this).attr('data-st-day'),
					hours: $(this).attr('data-st-hours'),
					hour: $(this).attr('data-st-hour'),
					minutes: $(this).attr('data-st-minutes'),
					minute: $(this).attr('data-st-minute'),
					seconds: $(this).attr('data-st-seconds'),
					second: $(this).attr('data-st-second'),
				};
				
				$('.ewf-countdown').countdown({ regional: regionalVar });
				
			});
		
		}
				
		// Fitvids - fluid width video embeds
		// https://github.com/davatron5000/FitVids.js/blob/master/README.md
		
		if(typeof $.fn.fitVids !== 'undefined'){
			
			$('.fitvids').fitVids();
		
		}
		
		// Superfish - enhance pure CSS drop-down menus
		// http://users.tpg.com.au/j_birch/plugins/superfish/options/
		
		if(typeof $.fn.superfish !== 'undefined'){
			
			$('#menu').superfish({
				delay: 500,
				animation: {opacity:'show',height:'show'},
				speed: 100,
				cssArrows: true
			});
			
		}
		
		// bxSlider - responsive slider
		// http://bxslider.com/options
		
		if(typeof $.fn.bxSlider !== 'undefined'){
			
			$('.testimonial-slider .slides').bxSlider({
				 mode: 'fade',							// Type of transition between slides: 'horizontal', 'vertical', 'fade'		
				 speed: 800,							// Slide transition duration (in ms)
				 infiniteLoop: true,					// If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa.
				 hideControlOnEnd: false,				// If true, "Next" control will be hidden on last slide and vice-versa. Only used when infiniteLoop: false
				 pager: true,							// If true, a pager will be added
				 pagerType: 'full',						// If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1/5)
				 controls: true,						// If true, "Next" / "Prev" controls will be added
				 auto: true,							// If true, slides will automatically transition
				 pause: 4000,							// The amount of time (in ms) between each auto transition
				 autoHover: true,						// Auto show will pause when mouse hovers over slider
				 useCSS: false 							// If true, CSS transitions will be used for animations. False, jQuery animations. Setting to false fixes problem with jQuery 2.1.0 and mode:horizontal
			});
			
			$('.icon-box-slider .slides').bxSlider({
				 mode: 'horizontal',					// Type of transition between slides: 'horizontal', 'vertical', 'fade'		
				 speed: 800,							// Slide transition duration (in ms)
				 infiniteLoop: true,					// If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa.
				 hideControlOnEnd: false,				// If true, "Next" control will be hidden on last slide and vice-versa. Only used when infiniteLoop: false
				 pager: true,							// If true, a pager will be added
				 pagerType: 'full',						// If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1/5)
				 controls: true,						// If true, "Next" / "Prev" controls will be added
				 auto: false,							// If true, slides will automatically transition
				 pause: 4000,							// The amount of time (in ms) between each auto transition
				 autoHover: true,						// Auto show will pause when mouse hovers over slider
				 useCSS: false, 						// If true, CSS transitions will be used for animations. False, jQuery animations. Setting to false fixes problem with jQuery 2.1.0 and mode:horizontal
				 slideWidth: "370",
				 minSlides: 1,
				 maxSlides: 5,
				 moveSlides: 1,
				 slideMargin: 30
			});
			
			$('.clients-slider .slides').bxSlider({
				 mode: 'horizontal',					// Type of transition between slides: 'horizontal', 'vertical', 'fade'		
				 speed: 800,							// Slide transition duration (in ms)
				 infiniteLoop: true,					// If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa.
				 hideControlOnEnd: false,				// If true, "Next" control will be hidden on last slide and vice-versa. Only used when infiniteLoop: false
				 pager: true,							// If true, a pager will be added
				 pagerType: 'full',						// If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1/5)
				 controls: true,						// If true, "Next" / "Prev" controls will be added
				 auto: false,							// If true, slides will automatically transition
				 pause: 4000,							// The amount of time (in ms) between each auto transition
				 autoHover: true,						// Auto show will pause when mouse hovers over slider
				 useCSS: false, 						// If true, CSS transitions will be used for animations. False, jQuery animations. Setting to false fixes problem with jQuery 2.1.0 and mode:horizontal
				 slideWidth: "195",
				 minSlides: 2,
				 maxSlides: 6,
				 moveSlides: 1,
				 slideMargin: 0
			});
			
			$('.blog-post-slider .slides').bxSlider({
				 mode: 'fade',							// Type of transition between slides: 'horizontal', 'vertical', 'fade'		
				 speed: 800,							// Slide transition duration (in ms)
				 infiniteLoop: true,					// If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa.
				 hideControlOnEnd: false,				// If true, "Next" control will be hidden on last slide and vice-versa. Only used when infiniteLoop: false
				 pager: true,							// If true, a pager will be added
				 pagerType: 'full',						// If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1/5)
				 controls: true,						// If true, "Next" / "Prev" controls will be added
				 auto: false,							// If true, slides will automatically transition
				 pause: 4000,							// The amount of time (in ms) between each auto transition
				 autoHover: true,						// Auto show will pause when mouse hovers over slider
				 useCSS: false 							// If true, CSS transitions will be used for animations. False, jQuery animations. Setting to false fixes problem with jQuery 2.1.0 and mode:horizontal
			});
			
			$('.images-slider .slides').bxSlider({
				 mode: 'fade',							// Type of transition between slides: 'horizontal', 'vertical', 'fade'		
				 speed: 800,							// Slide transition duration (in ms)
				 infiniteLoop: true,					// If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa.
				 hideControlOnEnd: false,				// If true, "Next" control will be hidden on last slide and vice-versa. Only used when infiniteLoop: false
				 pager: false,							// If true, a pager will be added
				 pagerType: 'full',						// If 'full', a pager link will be generated for each slide. If 'short', a x / y pager will be used (ex. 1/5)
				 controls: true,						// If true, "Next" / "Prev" controls will be added
				 auto: true,							// If true, slides will automatically transition
				 pause: 4000,							// The amount of time (in ms) between each auto transition
				 autoHover: true,						// Auto show will pause when mouse hovers over slider
				 useCSS: false 							// If true, CSS transitions will be used for animations. False, jQuery animations. Setting to false fixes problem with jQuery 2.1.0 and mode:horizontal
			});
			
		}
				
		// Magnific PopUp - responsive lightbox
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html
		
		if(typeof $.fn.magnificPopup !== 'undefined'){
		
			$('.magnificPopup').magnificPopup({
				disableOn: 400,
				closeOnContentClick: true,
				type: 'image'
			});
			
			$('.magnificPopup-gallery').magnificPopup({
				disableOn: 400,
				type: 'image',
				gallery: {
					enabled: true
				}
			});
		
		}
	
		// gMap -  embed Google Maps into your website; uses Google Maps v3
		// http://labs.mario.ec/jquery-gmap/
		
		if(typeof $.fn.gMap !== 'undefined'){
		
			$('.google-map').each(function() {
				
				var $t = $(this),
					mapZoom = parseInt($t.attr("data-zoom"),10),
					mapAddress = $t.attr("data-address"),
					mapCaption = $t.attr("data-caption"),
					mapType = "ROADMAP",
					popUp = false;
				
				if ($t.attr("data-maptype") !== undefined) {
					mapType = $t.attr("data-maptype");
				} 
				
				if ($t.attr("data-popup") !== undefined) {
					popUp = $t.attr("data-popup");
				} 
				
				$t.gMap({
					maptype: mapType,
					scrollwheel: false,
					zoom: mapZoom,
					markers: [{
						address: mapAddress,
						html: mapCaption,
						popup: popUp
					}],
					controls: {
						panControl: true,
						zoomControl: true,
						mapTypeControl: true,
						scaleControl: false,
						streetViewControl: false,
						overviewMapControl: false
					}
				});
		
			});
			
		}
		
		//

	});
	
/* ==========================================================================
   When the window is scrolled, do
   ========================================================================== */
   	
	$(window).scroll(function () {
	
		
		
	});

})(window.jQuery);

// non jQuery plugins below

