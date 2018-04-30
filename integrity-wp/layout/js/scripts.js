(function($) {
	
	"use strict";
	
/* ==========================================================================
   ewfRowBehaviour - improves visual composer row resize
   ========================================================================== */

if ( typeof window[ 'ewf_rowBehaviour' ] !== 'function' ) {
	
	// console.log('- INIT - Ewf Row Behaviour -');
	window.ewf_rowBehaviour = function () {
			 
		var $ = window.jQuery;
		var local_function = function () {
			
			var $elements = $( '[data-ewf-full-width="true"]' );
			var $el_wrap = $('#wrap');
			
			$.each( $elements, function ( key, item ) {
				var $el = $( this );
				var $el_full = $el.next( '.vc_row-full-width' );
				var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
				var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
				var offset = 0 - ($el_full.offset().left - $el_wrap.offset().left) - el_margin_left;
				var width = $el_wrap.width();			 
				
				if ( ! $el.data( 'ewfStretchContent' ) ) {
					var padding = (- 1 * offset);
					if ( padding < 0 ) {
						padding = 0;
					}
					
					var paddingRight = $el_wrap.width() - padding - $el_full.width() + el_margin_left + el_margin_right;
					if ( paddingRight < 0 ) {
						paddingRight = 0;
					}
					
					$el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
				}
				
				$el.css( {
					'position': 'relative',
					'left': offset,
					'box-sizing': 'border-box',
					'width': width
				} );
				
				$el.attr( "data-ewf-full-width-init", "true" );
			} );
		};
		
		
		$( window ).bind( 'resize.ewf_rowBehaviour', local_function );
		local_function();
	}

}



/* ==========================================================================
   ieViewportFix - fixes viewport problem in IE 10 SnapMode and IE Mobile 10
   ========================================================================== */
   
	function ieViewportFix() {
	
		var msViewportStyle = document.createElement("style");
		
		msViewportStyle.appendChild(
			document.createTextNode(
				"@-ms-viewport { width: device-width; }"
			)
		);

		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			
			msViewportStyle.appendChild(
				document.createTextNode(
					"@-ms-viewport { width: auto !important; }"
				)
			);
		}
		
		document.getElementsByTagName("head")[0].
				appendChild(msViewportStyle);

	}

/* ==========================================================================
   Update cart items
   ========================================================================== */		
	
	var ewf_wooShop_buttons = [
		".edd-add-to-cart",
		".wpsc_buy_button",
		".eshopbutton",
		"div.cartopt p label.update input#update",
		".add_to_cart_button",
		".woocommerce-cart input.minus",
		".cart_item a.remove",
		"#order_review .opc_cart_item a.remove",
		".woocommerce-cart input.plus"
	];

	jQuery(document.body).on('click', ewf_wooShop_buttons.join(','), function(){
		ewf_wooShop_timeout();
	});
    
	function ewf_wooShop_timeout() {
		setTimeout(function () { ewf_wooShop_update(); }, 1000);
	}
	
	function ewf_wooShop_update() {

		$.post( siteURL+'/wp-admin/admin-ajax.php', { action:"ewf_wooshop_update"}, function(received){
			if (received.success){
				$('.ewf-shop-cart span').html(received.data.quantity);
			}

		}, "json"); 
	
		return;
	}
	
	

				
	
/* ==========================================================================
   exists - Check if an element exists
   ========================================================================== */		
	
	function exists(e) {
		return $(e).length > 0;
	}

/* ==========================================================================
   isTouchDevice - return true if it is a touch device
   ========================================================================== */

	function isTouchDevice() {
		return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
	}

/* ==========================================================================
   setDimensionsPieCharts
   ========================================================================== */
	
	function setDimensionsPieCharts() {

		$('.pie-chart').each(function() {

			var $t = $(this),
				n = $t.parent().width(),
				r = $t.attr("data-barSize");
			
			if (n < r) {
				r = n;
			}
			
			$t.css("height", r);
			$t.css("width", r);
			$t.css("line-height", r + "px");
			
			$t.find("i").css({
				"line-height": r + "px",
				"font-size": r / 3
			});
			
		});

	}

/* ==========================================================================
   animatePieCharts
   ========================================================================== */

	function animatePieCharts() {

		if(typeof $.fn.easyPieChart !== 'undefined'){

			$('.pie-chart:in-viewport').each(function() {
	
				var $t = $(this),
					n = $t.parent().width(),
					r = $t.attr("data-barSize"),
					l = "square";
				
				if ($t.attr("data-lineCap") !== undefined) {
					l = $t.attr("data-lineCap");
				} 
				
				if (n < r) {
					r = n;
				}
				
				$t.easyPieChart({
					animate: 1300,
					lineCap: l,
					lineWidth: $t.attr("data-lineWidth"),
					size: r,
					barColor: $t.attr("data-barColor"),
					trackColor: $t.attr("data-trackColor"),
					scaleColor: "transparent",
					onStep: function(from, to, percent) {
						$(this.el).find('.pie-chart-percent span').text(Math.round(percent));
					}
	
				});
				
			});
			
		}

	}

/* ==========================================================================
   animateMilestones
   ========================================================================== */

	function animateMilestones() {

		$('.milestone:in-viewport').each(function() {
			
			var $t = $(this),
				n = $t.find(".milestone-value").attr("data-stop"),
				r = parseInt($t.find(".milestone-value").attr("data-speed"), 10);
				
			if (!$t.hasClass("already-animated")) {
				$t.addClass("already-animated");
				$({
					countNum: $t.find(".milestone-value").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".milestone-value").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".milestone-value").text(this.countNum);
					}
				});
			}
			
		});

	}

/* ==========================================================================
   animateProgressBars
   ========================================================================== */

	function animateProgressBars() {

		$('.progress-bar .progress-bar-outer:in-viewport').each(function() {
			
			var $t = $(this);
			
			if (!$t.hasClass("already-animated")) {
				$t.addClass("already-animated");
				$t.animate({
					width: $t.attr("data-width") + "%"
				}, 2000);
			}
			
		});

	}

/* ==========================================================================
   handleMobileMenu 
   ========================================================================== */		

	var MOBILEBREAKPOINT = 991;

	function handleMobileMenu() {

		if ($(window).width() > MOBILEBREAKPOINT) {
			
			$("#mobile-menu").hide();
			$("#mobile-menu-trigger").removeClass("mobile-menu-opened").addClass("mobile-menu-closed");
		
		} else {
			
			if (!exists("#mobile-menu")) {
				
				$("#menu").clone().attr({
					id: "mobile-menu",
					"class": "fixed"
				}).insertAfter("#header-wrap");
				
				$("#mobile-menu > li > a, #mobile-menu > li > ul > li > a").each(function() {
					var $t = $(this);
					if ($t.next().hasClass('sub-menu') || $t.next().is('ul') || $t.next().is('.sf-mega')) {
						$t.append('<span class="fa fa-angle-down mobile-menu-submenu-arrow mobile-menu-submenu-closed"></span>');
					}
				});
			
				$(".mobile-menu-submenu-arrow").click(function(event) {
					var $t = $(this);
					if ($t.hasClass("mobile-menu-submenu-closed")) {
						$t.parent().siblings("ul").slideDown(300);
						$t.parent().siblings(".sf-mega").slideDown(300);
						$t.removeClass("mobile-menu-submenu-closed fa-angle-down").addClass("mobile-menu-submenu-opened fa-angle-up");
					} else {
						$t.parent().siblings("ul").slideUp(300);
						$t.parent().siblings(".sf-mega").slideUp(300);
						$t.removeClass("mobile-menu-submenu-opened fa-angle-up").addClass("mobile-menu-submenu-closed fa-angle-down");
					}
					event.preventDefault();
				});
				
				$("#mobile-menu li, #mobile-menu li a, #mobile-menu ul").attr("style", "");
				
			}
			
		}

	}

/* ==========================================================================
   showHideMobileMenu
   ========================================================================== */

	function showHideMobileMenu() {
		
		$("#mobile-menu-trigger").click(function(event) {
			
			var $t = $(this),
				$n = $("#mobile-menu");
			
			if ($t.hasClass("mobile-menu-opened")) {
				$t.removeClass("mobile-menu-opened").addClass("mobile-menu-closed");
				$n.slideUp(300);
			} else {
				$t.removeClass("mobile-menu-closed").addClass("mobile-menu-opened");
				$n.slideDown(300);
			}
			event.preventDefault();
			
		});
		
	}
	   
/* ==========================================================================
   handleBackToTop
   ========================================================================== */
   
   function handleBackToTop() {
	   
		$('#back-to-top').click(function(){
			$('html, body').animate({scrollTop:0}, 'slow');
			return false;
		});
   
   }
   	
/* ==========================================================================
   showHidebackToTop
   ========================================================================== */	
	
	function showHidebackToTop() {
	
		if ($(window).scrollTop() > $(window).height() / 2 ) {
			$("#back-to-top").removeClass('gone');
			$("#back-to-top").addClass('visible');
		} else {
			$("#back-to-top").removeClass('visible');
			$("#back-to-top").addClass('gone');
		}
	
	}

/* ==========================================================================
   handleVideoBackground
   ========================================================================== */
   
	var min_w = 0, 					
		video_width_original = 1920,
		video_height_original = 1080,
		vid_ratio = 1920/1080;
   
	function handleVideoBackground() {
	   
		$('.fullwidth-section .fullwidth-section-video').each(function(i){

			var $sectionWidth = $(this).closest('.fullwidth-section').outerWidth(),
				$sectionHeight = $(this).closest('.fullwidth-section').outerHeight();
			
			$(this).width($sectionWidth);
			$(this).height($sectionHeight);

			// calculate scale ratio
			var scale_h = $sectionWidth / video_width_original,
				scale_v = $sectionHeight / video_height_original, 
				scale = scale_h > scale_v ? scale_h : scale_v;

			// limit minimum width
			min_w = vid_ratio * ($sectionHeight+20);
			
			if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}
					
			$(this).find('video').width(Math.ceil(scale * video_width_original +2));
			$(this).find('video').height(Math.ceil(scale * video_height_original +2));
			
		});

	}
   	
/* ==========================================================================
   handleSearch
   ========================================================================== */
   
	function handleSearch() {	
		
		$('#custom-search-button').click(function(e) { 
		
			e.preventDefault();
			
			if(!$("#custom-search-button").hasClass('open')) {
			
				$("#custom-search-form").fadeIn();
				$("#custom-search-button").addClass('open');
				
			} else {
				
				$("#custom-search-form").fadeOut();
				$("#custom-search-button").removeClass('open');
				
			}
			
		});
		
	 }
	 
/* ==========================================================================
   handleStickyHeader
   ========================================================================== */
	
	var stickypoint = 500;
	if (exists("#header-top") && exists("#header-wrap")) {

		stickypoint = $("#header-top").outerHeight() + $("#header-wrap").outerHeight() + 150;
			
	}		
	
	function handleStickyHeader() {
	
		var b = document.documentElement,
        	e = false;

		function f() {
			
			window.addEventListener("scroll", function (h) {
				
				if (!e) {
					e = true;
					setTimeout(d, 250);
				}
			}, false);
			
			window.addEventListener("load", function (h) {
				
				if (!e) {
					e = true;
					setTimeout(d, 250);
				}
			}, false);
		}
	
		function d() {
			
			var h = c();
			
			if (h >= stickypoint) {
				$('#header').addClass("stuck");
			} else {
				$('#header').removeClass("stuck");
			}
			
			e = false;
		}
	
		function c() {
			
			return window.pageYOffset || b.scrollTop;
			
		}
		
		f();
		
	}
	
/* ==========================================================================
   handleequalCols
   ========================================================================== */
	
	function handleequalCols() {
		
		$.fn.equalCols = function() {
			
			//Array Sorter
			var sortNumber = function(a, b) {
				return b - a;
			};
			
			var heights = [];
			//Push each height into an array
			
			$(this).each(function() {
				heights.push($(this).height());
			});
			
			heights.sort(sortNumber);
			
			var maxHeight = heights[0];
			
			return this.each(function() {
				$(this).css({
					'min-height': maxHeight
				});
			});
		};
		
		// make equal height boxes
		
		if ($(window).width() > 767) {
	
			$('.vertical-timeline li, .separator').equalCols();
			
		}else{
		
			$('.vertical-timeline li, .separator').css({
				'min-height': 0
			});
		}
		
		if ($(window).width() > 767) {
	
			$('.vertical-timeline li, .separator').css({
				'min-height': 0
			});
			
			$('.vertical-timeline li, .separator').equalCols();
			
		}else{
		
			$('.vertical-timeline li, .separator').css({
				'min-height': 0
			});
			
		} 
	}	
	

	
	 
/* ==========================================================================
   When document is ready, do
   ========================================================================== */
   
    var stickyHeader = false;
	
	$(document).ready(function() {			   

		ewf_rowBehaviour();
	
		ieViewportFix();
		
		setDimensionsPieCharts();
		
		animatePieCharts();
		animateMilestones();
		animateProgressBars();

		handleMobileMenu();
		showHideMobileMenu();
		
		handleBackToTop();
		showHidebackToTop();
		
		handleVideoBackground();
		
		handleSearch();
		
		handleequalCols();
		
		if ($('body').hasClass('ewf-sticky-header')){
			stickyHeader = true;
		}
			
		if(stickyHeader && ($(window).width() > 1024)){ 
		
			handleStickyHeader();
		
		}
		
	});
	
/* ==========================================================================
   When the window is scrolled, do
   ========================================================================== */
   
	$(window).scroll(function() {				   
		
		animateMilestones();
		animatePieCharts();
		animateProgressBars();
		
		showHidebackToTop();
		
		if(stickyHeader && ($(window).width() > 1024)){ 
		
			handleStickyHeader();
		
		}
		

	});

/* ==========================================================================
   When the window is resized, do
   ========================================================================== */
   
	$(window).resize(function() {
		
		handleMobileMenu();
		handleVideoBackground();
		handleStickyHeader();
		handleequalCols();
	});
	

})(window.jQuery);

// non jQuery scripts below