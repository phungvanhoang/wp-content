jQuery(function($){
	$(document).ready(function(){
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
	});
});