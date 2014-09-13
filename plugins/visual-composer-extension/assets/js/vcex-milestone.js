jQuery(function($){
	$(document).ready(function(){
		$('.vcex-animated-milestone').each(function() {
			$(this).appear(function() {
				$(this).find('.vcex-milestone-time').countTo();
			},{accX: 0, accY: 0});
		});
		
	});
});