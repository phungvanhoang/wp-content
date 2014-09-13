jQuery(function($) {
	
	// VARS
	var $window = $(window);
	var siteHeader = $("#site-header.fixed-scroll");
	
	$(document).ready(function (){
		
		// If menu item has classname "nav-no-click" then  return false
		$('li.nav-no-click > a').click( function() {
			return false;
		});
		
		
		/* Main menu superfish with supersubs
		$('ul.sf-menu').supersubs({
			minWidth: 8,	 // minimum width of submenus in em units
			maxWidth: 27,	 // maximum width of submenus in em units
			extraWidth: 1	 // extra width can ensure lines don't sometimes turn over
		}).superfish({
			delay: 200,
    		animation: {opacity:'show', height:'show'},
    		speed: 'fast',
    		cssArrows: false,
			disableHI: true
		}); */
		
		
		// Main superfish menu without supersubs
		$('ul.sf-menu').superfish({
			delay: 200,
    		animation: {opacity:'show', height:'show'},
    		speed: 'fast',
    		cssArrows: false,
			disableHI: true
		});
		
		
		// Header Search Modal
		$("a.site-search-toggle").leanerModal({ 
		  id : '#site-searchform',
		  top : 100,
		  overlay : 0.6
		});

		$("a.site-search-toggle").click(function() {
			$('#site-searchform input').focus();
		});
		
		// Sidebar menu toggle
		function wpexMenuWidget() {
			var submenuParent = $("div#main .widget_nav_menu ul.sub-menu").parent('li');
			submenuParent.addClass('parent');
			submenuParent.click( function() {
				$(this).children('.sub-menu').stop(true,true).slideToggle('fast');
				$(this).toggleClass('active');
				return false;
			});
		} wpexMenuWidget();
		
		
		// Woo Cart Modal
		$("li.wcmenucart-toggle").leanerModal({ 
			id : '#current-shop-items',
			top : 100,
			overlay : 0.6
		});
		
		// Mobile menu
		$('.mobile-searchform, a.mobile-menu-toggle').sidr({
			name: 'sidr-main',
			source: '#sidr-close, #site-navigation',
			side: 'left'
		});
		
		
		// Close sidr on click
		$('a.sidr-class-toggle-sidr-close').click(function() {
			$.sidr('close', 'sidr-main');
			return false;
		});
		
		
		// Close sidr on window resize
		$window.resize(function() {
			$.sidr('close', 'sidr-main');
		});


		// Back to top scroll
		$scrollTopLink = $( 'a#site-scroll-top' );
		$window.scroll(function () {
			if ($(this).scrollTop() > 100) {
				$scrollTopLink.fadeIn();
			} else {
				$scrollTopLink.fadeOut();
			}
		});		
		$scrollTopLink.on('click', function() {
			$( 'html, body' ).animate({scrollTop:0}, 400);
			return false;
		} );

	
		// Comment scroll
		$( 'li.comment-scroll a' ).click( function(event) {		
			event.preventDefault();
			$( 'html,body' ).animate( {
				scrollTop: $( this.hash ).offset().top -180 }, 'normal');
		} );			


		// Lightbox
		$('.wpex-lightbox, .woocommerce-main-image').magnificPopup({ type: 'image' });
		
		$('.wpex-gallery-lightbox').each(function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
				  enabled:true
				}
			});
		});
		
		$('.wpex-lightbox-video').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'vcex-mfp-slide-bottom',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		
		$('.vcex-lightbox').magnificPopup({
			type: 'image',
			mainClass: 'vcex-mfp-slide-bottom',
			gallery: { enabled: false },
		});
		
		$('.vcex-gallery-lightbox').each(function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
				  enabled:true
				}
			});
		});
		
		$('.vcex-lightbox-video').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'vcex-mfp-slide-bottom',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
	
	
		// Responsive Videos
		$(".wpex-fitvids").fitVids( {
			customSelector: "iframe[src^='https://w.soundcloud.com']"}
		);
		
		
		// Tipsy
		$('a.tooltip-left').tipsy({fade: true, gravity: 'e'});
		$('a.tooltip-right').tipsy({fade: true, gravity: 'w'});
		$('a.tooltip-up').tipsy({fade: true, gravity: 's'});
		$('a.tooltip-down').tipsy({fade: true, gravity: 'n'});
		
		
		// Custom Selects
		$('.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, .shipping-calculator-form select, .single-product .variations select').customSelect({
			customClass: "theme-select"
		});
		
		// Toggle boxed/full-width layouts
		$('li.wpex-boxed-layout-link a').click(function(){
			$('body').toggleClass('full-width-main-layout, boxed-main-layout');
			return false;
		});
		
		
	}); // End doc ready


	$window.load(function(){
		
		// Fixed header on scroll
		function wpexFixedHeader() {
			siteHeader.sticky({topSpacing:0});
		} wpexFixedHeader();	

		// Woo Image swap
		$('.single-product .thumbnails a').click( function() {
			$('.active-thumb').removeClass('active-thumb');
			$(this).addClass('active-thumb');
			var fullImg = $(this).attr('href');
			var croppedImg = $(this).data('swampimg');
			var mainImgLink = $('.woocommerce-main-image');
			var mainImg = $('.woocommerce-main-image img');
			if ( croppedImg != mainImg ) {
				mainImgLink.attr('href', fullImg);
				mainImg.attr('src', fullImg);
			}		
			return false;
		});
	
	
		// Gallery slider
		$('.gallery-format-post-slider').flexslider({
			animation: 'fade',
			animationSpeed: 500,
			slideshow: true,
			smoothHeight: false,
			controlNav: false,
			directionNav: true,
			controlNav : "thumbnails",
			prevText : '<span class="fa fa-chevron-left"></span>',
			nextText : '<span class="fa fa-chevron-right"></span>'
		});
		
		// Woo Product slider
		$( ".woo-product-entry-slider" ).each( function() {
			var $this = $(this);
			$(this).flexslider({
				animation: 'fade',
				slideshow : false,
				randomize : false,
				controlNav: true,
				directionNav: false,
				smoothHeight: false,
				prevText : '<span class="fa fa-chevron-left"></span>',
				nextText : '<span class="fa fa-chevron-right"></span>',
				start: function(slider) {
				$this.click(function(event){
					event.preventDefault();
						slider.flexAnimate(slider.getTarget("next"));
					});
				}
			});
		});
		
		
		// Masonry Grids
		function wpexBlogIsotope() {
		var $container = $('.blog-masonry-grid');
			$container.isotope({
				itemSelector: '.blog-entry'
			});
		} wpexBlogIsotope();
		var isIE8 = $.browser.msie && +$.browser.version === 8;
		if (isIE8) {
			document.body.onresize = function () {
				wpexBlogIsotope();
			};
		} else {
			$window.resize(function () {
				wpexBlogIsotope();
			});
		}
		window.addEventListener("orientationchange", function() {
			wpexBlogIsotope();
		});
		
	}); // End on window load
	
}); // End jQuery(function($)