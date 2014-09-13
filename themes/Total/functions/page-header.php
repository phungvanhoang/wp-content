<?php
/**
 * Function used to display the page subheading
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/



// Page Titles
if ( ! function_exists('wpex_page_title') ) {
	
	function wpex_page_title( $title='' ) {
		
		global $post;
		
		// Homepage - display blog description if not a static page
		if ( is_front_page() && !is_singular('page') ) {
			
			$title = get_bloginfo( 'description' );
			
		// Archives
		} elseif ( is_archive() ) {
			
			// Daily archive title
			if ( is_day() ) {
				$title = sprintf( __( 'Daily Archives: %s', 'wpex' ), get_the_date() );
			
			// Monthly archive title
			} elseif ( is_month() ) {
				$title = sprintf( __( 'Monthly Archives: %s', 'wpex' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpex' ) ) );
				
			// Yearly archive title
			} elseif ( is_year() ) {
				$title = sprintf( __( 'Yearly Archives: %s', 'wpex' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpex' ) ) );
			
			// Standard term title
			} else {
				$title = single_term_title( '', false );
			}
			
		// Search
		} elseif( is_search() ) {
			
			global $wp_query;
			
			$title = '<span id="search-results-count">'. $wp_query->found_posts .'</span> '. __( 'Search Results Found', 'wpex' );
			
		// 404 Page
		} elseif ( is_404() ) { 
			
			$title = __("404: Page Not Found","wpex");
		
		// All else
		} else {
			$post_id = $post->ID;
			$title = get_the_title($post_id);
		}
		
		return $title;
		
		
	} // End function

} // End if


// Page Subheading
if ( ! function_exists('wpex_post_subheading') ) {
	
	function wpex_post_subheading() {
		
		// Vars
		global $post;
		$output='';
		
		// Posts & Pages
		if ( is_singular () ) {
			$post_id = $post->ID;
			$subheading = get_post_meta( $post_id, 'wpex_post_subheading', true );
			$output = '';
			if ( $subheading ) {
				$output .= '<div class="clr page-subheading">';
					$output .= do_shortcode( $subheading );
				$output .= '</div>';
			}
		}
		
		// Archives
		if ( is_tax() ) {
			$obj = get_queried_object();
			$taxonomy = $obj->taxonomy;
			$term_id = $obj->term_id;
			$description = term_description($term_id,$taxonomy);
			if ( ! empty( $description ) ){
				$output .= '<div class="clr page-subheading term-description">';
					$output .= $description;
				$output .= '</div>';
			}
		}		
		
		// Return content
		return $output;
		
	} // End function
	
} // End if


// Page Header
if ( ! function_exists('wpex_page_header') ) {
	
	function wpex_page_header( $before='', $after='', $breadcrumbs = true ) {
		
		// Vars
		global $post;
		$output=$title_style=$classes=$height=$style=$title_background=$disable_title='';
		$heading = apply_filters( 'wpex_page_header_heading','h1');
		if ( $post ) {
			$post_id = $post->ID;
			$disable_title = get_post_meta( get_the_ID(), 'wpex_disable_title', true );
			$title = get_the_title();
		}
				
		// If page header is disabled do nothing
		if ( $disable_title == 'on' ) return false;	
		
		// Page meta options
		if ( is_singular ( 'page' ) || is_singular ( 'portfolio' ) || is_singular ( 'staff' ) ) {
			
			$title_style = get_post_meta( $post_id, 'wpex_post_title_style', true );
			
			if ( $title_style == 'background-image' ) {
				$title_background = get_post_meta( $post_id, 'wpex_post_title_background', true );
				$title_height = get_post_meta( $post_id, 'wpex_post_title_height', true );
				$title_height = $title_height ? $title_height : '400';
				$title_height = intval($title_height) .'px'; // set height in pixels
			}
			
			// Custom Classes
			if ( $title_style !== 'default' ) { 
				$classes .= $title_style .'-page-header';
			}
			
			// Header Background Image
			if ( $title_background ) {
				$style .= ' background: url('. $title_background .') 50% 0;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;height: '.$title_height.';';
			}
			
			// Disable breadcrumbs if background image set
			if ( $title_background || $title_style == 'centered' || $title_style == 'centered-minimal' ) {
				$breadcrumbs = false;	
			}
		
		}
		
		ob_start(); ?>
		
			<?php echo $before; ?>
				
				<header class="page-header <?php echo $classes; ?>" style="<?php echo $style; ?>">
					
					<div class="container clr page-header-inner">
						<?php
						//  Main header
						echo '<'. $heading .' class="page-header-title">'. wpex_page_title() .'</'. $heading .'>'; 
						
						// Function used to display the subheading defined in the meta options
						// See previous function
						echo wpex_post_subheading();
						
						// Display built-in breadcrumbs - see functions/breadcrumbs.php
						if ( ! is_front_page() && $breadcrumbs ) wpex_display_breadcrumbs(); ?>
						
					</div><!-- .page-header-inner -->
					
					<?php
					// Header backgroun overlay
					if ( $title_background ) { ?>
						<span class="background-image-page-header-overlay "></span>
					<?php } ?>
						
				</header><!-- .page-header -->
			
			<?php echo $after; ?>
		
		<?php
		echo ob_get_clean();
		
	} // End functions
	
} // End if function exists