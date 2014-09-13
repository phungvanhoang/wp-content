<?php
// Font Icons
if ( !function_exists( 'vcex_font_icons_array' ) ) {
	function vcex_font_icons_array() {
		$vcex_awesome_icons_array = array('','adjust','adn','align-center','align-justify','align-left','align-right','ambulance','anchor','android','angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','apple','archive','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','asterisk','backward','ban','bar-chart-o','barcode','bars','beer','bell','bell-o','bitbucket','bitbucket-square','bitcoin','bold','book','bookmark','bookmark-o','briefcase','bug','building-o','bullhorn','bullseye','calendar','calendar-o','camera','camera-retro','caret-down','caret-left','caret-right','caret-up','certificate','chain','check','check-circle','check-circle-o','check-square','check-square-o','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','circle','circle-o','clock-o','cloud','cloud-download','cloud-upload','cny','code','code-fork','coffee','columns','comment','comment-o','comments','comments-o','compass','compress','copy','credit-card','crop','crosshairs','css3','cut','cutlery','dashboard','dedent','desktop','dollar','dot-circle-o','download','dribbble','dropbox','edit','eject','ellipsis-h','ellipsis-v','envelope','envelope-o','eraser','euro','exchange','exclamation','exclamation-circle','expand','external-link','external-link-square','eye','eye-slash','facebook','facebook-square','fast-backward','fast-forward','female','fighter-jet','file','file-o','file-text','file-text-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flash','flask','flickr','folder','folder-o','folder-open','folder-open-o','font','forward','foursquare','frown-o','gamepad','gbp','gear','gears','gift','github','github-alt','github-square','gittip','glass','globe','google-plus','google-plus-square','group','h-square','hand-o-down','hand-o-left','hand-o-right','hand-o-up','hdd-o','headphones','heart','heart-o','home','hospital-o','html5','inbox','indent','info','info-circle','instagram','italic','key','keyboard-o','laptop','leaf','legal','lemon-o','level-down','level-up','lightbulb-o','linkedin','linkedin-square','linux','list','list-alt','list-ol','list-ul','location-arrow','lock','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up','magic','magnet','mail-forward','mail-reply','mail-reply-all','male','map-marker','maxcdn','medkit','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile-phone','money','moon-o','music','pagelines','paperclip','paste','pause','pencil','pencil-square','phone','phone-square','picture-o','pinterest','pinterest-square','plane','play','play-circle','play-circle-o','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qrcode','question','question-circle','quote-left','quote-right','random','refresh','renren','reply-all','retweet','road','rocket','rotate-left','rotate-right','rss','rss-square','ruble','rupee','save','search','search-minus','search-plus','share-square','share-square-o','shield','shopping-cart','sign-in','sign-out','signal','sitemap','skype','smile-o','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-down','sort-numeric-asc','sort-numeric-desc','sort-up','spinner','square','square-o','stack-exchange','stack-overflow','star','star-half','star-half-empty','star-o','step-backward','step-forward','stethoscope','stop','strikethrough','subscript','suitcase','sun-o','superscript','table','tablet','tag','tags','tasks','terminal','text-height','text-width','th','th-large','th-list','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-down','toggle-left','toggle-right','toggle-up','trash-o','trello','trophy','truck','tumblr','tumblr-square','turkish-lira','twitter','twitter-square','umbrella','underline','unlink','unlock','unlock-alt','unsorted','upload','user','user-md','video-camera','vimeo-square','vk','volume-down','volume-off','volume-up','warning','weibo','wheelchair','windows','won','wrench','xing','xing-square','youtube','youtube-play','youtube-square','cog','cogs');
		$vcex_awesome_icons_array = array_combine($vcex_awesome_icons_array,$vcex_awesome_icons_array);
		return apply_filters( 'vcex_awesome_icons_array', $vcex_awesome_icons_array );
	}
}

// Social Icons
if ( !function_exists( 'vcex_social_icons_array' ) ) {
	function vcex_social_icons_array() {
		$vcex_social_icons_array = array ('dribbble','facebook','flickr','forrst','github','googleplus','instagram','linkedin','pinterest','rss','tumblr','twitter','vimeo','youtube');
		$vcex_social_icons_array = array_combine($vcex_social_icons_array,$vcex_social_icons_array);
		return apply_filters( 'vcex_social_icons_array', $vcex_social_icons_array );
	}
}

// Excerpts
if ( !function_exists( 'vcex_excerpt' ) ) {
	function vcex_excerpt($length=30, $readmore=false, $read_more_text='', $post_id='' ) {
		global $post;
		$id = $post_id ? $post_id : $post->ID;
		$custom_excerpt = apply_filters( 'the_content', $post->post_excerpt );
		if ( $custom_excerpt ) {
			$output = $custom_excerpt;
		} else {
			$meta_excerpt = get_post_meta( $id, 'vcex_excerpt_length', true );
			$length = $meta_excerpt ? $meta_excerpt : $length;	
			$read_more_text = $read_more_text ? $read_more_text : __('view post', 'vcex' );
			$excerpt = get_the_content('');
			$excerpt = do_shortcode( $excerpt );
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = str_replace(']]>', ']]>', $excerpt);
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = wp_trim_words( $excerpt, $length );
			$excerpt = wp_kses($excerpt, array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ) );
			$output = '<p>'. html_entity_decode($excerpt) .'</p>';
		}		
		if ( $readmore == true ) {
			$readmore_link = '<a href="'. get_permalink( $id ) .'" title="'. __('View Post', 'vcex' ) .'" rel="bookmark" class="vcex-readmore theme-button">'. $read_more_text .' <span class="vcex-readmore-rarr">&rarr;</span></a>';
			$output .= apply_filters( 'vcex_readmore_link', $readmore_link );
		}
		
		echo $output;
	}
}

// Excerpts
if ( !function_exists( 'vcex_get_excerpt' ) ) {
	function vcex_get_excerpt($length=30, $readmore=false, $read_more_text='', $post_id='' ) {
		global $post;
		$id = $post_id ? $post_id : $post->ID;
		$custom_excerpt = apply_filters( 'the_content', $post->post_excerpt );
		if ( $custom_excerpt ) {
			$output = $custom_excerpt;
		} else {
			$meta_excerpt = get_post_meta( $id, 'vcex_excerpt_length', true );
			$length = $meta_excerpt ? $meta_excerpt : $length;	
			$read_more_text = $read_more_text ? $read_more_text : __('view post', 'vcex' );
			$excerpt = get_the_content('');
			$excerpt = do_shortcode( $excerpt );
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = str_replace(']]>', ']]>', $excerpt);
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = wp_trim_words( $excerpt, $length );
			$excerpt = wp_kses($excerpt, array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array(), 'em' => array(), 'strong' => array() ) );
			$output = '<p>'. html_entity_decode($excerpt) .'</p>';
		}
		
		if ( $readmore == true ) {
			$readmore_link = '<a href="'. get_permalink( $id ) .'" title="'. __('View Post', 'vcex' ) .'" rel="bookmark" class="vcex-readmore theme-button">'. $read_more_text .' <span class="vcex-readmore-rarr">&rarr;</span></a>';
			$output .= apply_filters( 'vcex_readmore_link', $readmore_link );
		}
		
		return $output;	
	}
}

// Image Filter Styles
if ( !function_exists( 'vcex_image_filters' ) ) {
	function vcex_image_filters() {
		$filters = array (
			__('None','vcex') => 'none',
			__('Grayscale','vcex') => 'grayscale',
		);
		return apply_filters( 'vcex_image_filters', $filters );
	}
}


// Image Hover Styles
if ( !function_exists( 'vcex_image_hovers' ) ) {
	function vcex_image_hovers() {
		$hovers = array (
			__('None','vcex') => '',
			__('Grow','vcex') => 'grow',
			__('Shrink','vcex') => 'shrink',
			__('Side Pan','vcex') => 'side-pan',
			__('Vertical Pan','vcex') => 'vertical-pan',
			__('Tilt','vcex') => 'tilt',
			__('Normal - Blurr','vcex') => 'blurr',
			__('Blurr - Normal','vcex') => 'blurr-invert',
			__('Sepia','vcex') => 'sepia',
			__('Fade Out','vcex') => 'fade-out',
			__('Fade In','vcex') => 'fade-in',
		);
		return apply_filters( 'vcex_image_hovers', $hovers );
	}
}
?>
