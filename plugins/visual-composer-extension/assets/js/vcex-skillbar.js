jQuery(function($){
	$(document).ready(function(){
		$('.vcex-skillbar').each(function(){
			$(this).find('.vcex-skillbar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
		});
	});
});