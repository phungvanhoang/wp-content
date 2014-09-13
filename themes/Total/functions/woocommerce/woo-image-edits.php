<?php
/**
 * Change default Woo Image sizes & other edits
 *
 * @package WordPress
 * @subpackage Total
 * @since 1.0
 */



// Change the default WooCommerce image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'wpex_woocommerce_image_dimensions', 1 );
function wpex_woocommerce_image_dimensions() {
	
  	$catalog = array(
		'width' 	=> '9999',
		'height'	=> '9999',
		'crop'		=> 0
	);
 
	$single = array(
		'width' 	=> '9999',
		'height'	=> '9999',
		'crop'		=> 0
	);
 
	$thumbnail = array(
		'width' 	=> '100',
		'height'	=> '100',
		'crop'		=> 1
	);
	
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
	
}



// Override category thumbnail output
function woocommerce_subcategory_thumbnail( $category ) {
	
	// Vars
	$title = get_the_title();
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
	$attachment_url = wp_get_attachment_url( $thumbnail_id );
	$width = wpex_option( 'woo_cat_entry_width', '9999' );
	$height = wpex_option( 'woo_cat_entry_height', '9999' );
	$crop =  ( $height == '9999' ) ? false : true;
	
	// Echo Image
	echo '<img src="'. aq_resize( $attachment_url,  $width, $height, $crop ) .'" alt="'. $title .'" />';
	
} // End function



// Override default thumbail output
function woocommerce_get_product_thumbnail() {
	
	//Globals
	global $product;
	
	// Main vars
	$output = '';
	$enable_woo_entry_sliders = wpex_option( 'enable_woo_entry_sliders', '1' );
	
	// Get first image
	$attachment_id = get_post_thumbnail_id();
	$attachment_url = wp_get_attachment_url( $attachment_id );
	$alt = strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );
	$width = wpex_option( 'woo_entry_width', '9999' );
	$height = wpex_option( 'woo_entry_height', '9999' );
	$crop =  ( $height == '9999' ) ? false : true;
	
	// Get gallery images
	$attachment_ids = $product->get_gallery_attachment_ids();
	
	if ( $attachment_ids && $enable_woo_entry_sliders == '1' ) {	
		
		$output .= '<div class="woo-product-entry-slider">';
			$output .= '<div class="flexslider">';
				$output .= '<ul class="slides">';
					$output .= '<li><img src="'. aq_resize( $attachment_url,  $width, $height, $crop ) .'" alt="'. $alt .'" /></li>';
					$count=0;
					foreach ( $attachment_ids as $attachment_id ) {
						$count++;
						if ( $count < 5 ) {
							$alt = strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );
							$attachment_url = wp_get_attachment_url( $attachment_id );
							$output .= '<li><img src="'. aq_resize( $attachment_url,  $width, $height, $crop ) .'" alt="'. $alt .'" /></li>';
						}
					}
				$output .= '</ul>';
			$output .= '</div>';
		$output .= '</div>';
		
	} else {
	
		// Return thumbnail
		$output .= '<img src="'. aq_resize( $attachment_url,  $width, $height, $crop ) .'" alt="'. $alt .'" class="woo-entry-image-main" />';
	
	}
	
	return $output;
	
} // End function



// Override default Woo Featured Image
function woocommerce_show_product_images() {
	global $post, $woocommerce, $product; ?>
	<div class="images">
		<?php
		// Featured Image
		if ( has_post_thumbnail() ) {	
			$attachment_id = get_post_thumbnail_id();
			$attachment_url = wp_get_attachment_url( $attachment_id );
			$width = wpex_option( 'woo_post_image_width', '9999' );
			$height = wpex_option( 'woo_post_image_height', '9999' );
			$crop = ( $height == '9999' ) ? false : true;
			$image = '<img src="'. aq_resize( $attachment_url, $width,  $height,  $crop) .'" alt="'. get_the_title() .'" />';
			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link = wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count = count( $product->get_gallery_attachment_ids() );
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s">%s</a>', $image_link, $image_title, $image ), $post->ID );	
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );	
		} ?>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
<?php } // End function



// Change output of single product gallery imgs
function woocommerce_show_product_thumbnails() {
	
	global $post, $product, $woocommerce;	
	$attachment_ids = $product->get_gallery_attachment_ids();
	if ( $attachment_ids ) { ?>
		<div class="thumbnails"><?php
			$loop = 0;
			$columns = '5';
			
			// Loop through attachments
			foreach ( $attachment_ids as $attachment_id ) {
				
				// Column Classes
				$classes = array( 'zoom' );
				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';
				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';
					
				// Image id
				$attachment_url = wp_get_attachment_url( $attachment_id );	
					
				// Create link that goes to cropped post image		
				$width = wpex_option( 'woo_post_image_width', '9999' );
				$height = wpex_option( 'woo_post_image_height', '9999' );
				$crop = ( $height == '9999' ) ? false : true;
				$image_link = aq_resize( $attachment_url, $width,  $height,  $crop);
				if ( ! $image_link ) continue;
				
				// Display small thumb
				$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
				$resized_image	= aq_resize( $attachment_url, 100, 100, true);
				$image = '<img src="'. $resized_image .'" alt="'. $alt .'">';
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				if ( $resized_image ) {
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
				}
				$loop++;
			} ?></div>
		<?php
	} // End if
	
} // End function