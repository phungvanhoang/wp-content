<?php
// Add Staff Grid Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_staff_grid_shortcode' ) ) {

	function vcex_staff_grid_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'term_slug'		=> 'all',
				'posts_per_page'	=> '12',
				'grid_style'		=> 'fit_columns',
				'columns'			=> '',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'filter'			=> 'true',
				'thumbnail_link'	=> 'post',
				'img_crop'			=> 'true',
				'img_width'		=> '9999',
				'img_height'		=> '9999',
				'thumb_link'		=> 'post',
				'img_filter'		=> '',
				'title'				=> 'true',
				'excerpt'			=> 'true',
				'excerpt_length'	=> '15',
				'read_more'		=> 'false',
				'read_more_text'	=> __( 'read more', 'vcex' ),
				'pagination'		=> 'false',
				'filter_content'	=> 'false',
				'social_links'		=> 'true',
				'offset'			=> 0,
				'taxonomy'			=> '',
				'terms'				=> '',
				'img_hover_style'	=> '',
				'img_overlay_disable' => '',
			), $atts));
			
		// Get global $post var
		global $post;
			
		// Start Tax Query
		$tax_query = '';
		if( $term_slug !== '' && $term_slug !== 'all' ) {
			$tax_query = array(
				array(
					'taxonomy'	=> 'staff_category',
					'field'		=> 'slug',
					'terms'		=> $term_slug,
				),
			);
		}
		
		// Pagination var
		if( $pagination == 'true' ) {
			global $paged;
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		} else {
			$paged = NULL;
		}
		
		// The Query
		$vcex_query = new WP_Query(
			array(
				'post_type'		=> 'staff',
				'posts_per_page'	=> $posts_per_page,
				'offset'			=> $offset,
				'order'				=> $order,
				'orderby'			=> $orderby,
				'tax_query'		=> $tax_query,
				'filter_content'	=> $filter_content,
				'paged'				=> $paged
			)
		);

		//Output posts
		if( $vcex_query->posts ) :
		
			$rand_num = rand(1, 100);
			$unique_port_id = 'staff-'. $rand_num; 
			$unique_id = $unique_id ? ' id="'. $unique_id .'"' : 'id="'. $unique_port_id .'"';
			$img_crop = $img_crop == 'true' ? true : false;
			$read_more = $read_more == 'true' ? true : false;
			
			// Set correct grid class
			$col_class = 'span_8';
			if ( $columns == '1' ) $col_class = 'span_1_of_1';
			if ( $columns == '2' ) $col_class = 'span_1_of_2';
			if ( $columns == '3' ) $col_class = 'span_1_of_3';
			if ( $columns == '4' ) $col_class = 'span_1_of_4';
			if ( $columns == '5' ) $col_class = 'span_1_of_5';
			if ( $columns == '6' ) $col_class = 'span_1_of_6';
			if ( $columns == '7' ) $col_class = 'span_1_of_7';
			if ( $columns == '8' ) $col_class = 'span_1_of_8';
			if ( $columns == '9' ) $col_class = 'span_1_of_9';
			if ( $columns == '10' ) $col_class = 'span_1_of_10';
			if ( $columns == '11' ) $col_class = 'span_1_of_11';
			if ( $columns == '12' ) $col_class = 'span_1_of_12';
			
			// Looad lightbox scripts
			if ( $thumb_link == 'lightbox' ) {
				wp_enqueue_script( 'vcex-magnific-popup' );
				wp_enqueue_script( 'vcex-lightbox' );
			}
			
			// Load Masonry scripts
			if ( $filter == 'true' || $grid_style == 'masonry' ) {
				wp_enqueue_script( 'vcex-isotope' ); // Load Isotope Script
			}
			
			ob_start(); ?>
			
				<?php
				// Display filter links
				if ( $filter == 'true' ) { ?>
					<?php $filter_parent = ( $term_slug !== '' && $term_slug !== 'all' ) ? $term_slug : NULL; ?>
					<?php $terms = get_terms( 'staff_category', array( 'child_of' => $filter_parent ) ); ?>
					<?php if( $terms ) { ?>
						<ul class="vcex-staff-filter filter-<?php echo $unique_port_id; ?> vcex-filter-links clr">
							<li class="active"><a href="#" data-filter="*"><span><?php _e('All', 'vcex'); ?></span></a></li>
							<?php foreach ($terms as $term ) : ?>
								<li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul><!-- .vcex-staff-filter -->
					<?php } ?>
				<?php } ?>
				
				<?php
				if ( $filter == 'true' || $grid_style == 'masonry' ) { ?>
				<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
							function wpexStaffIsotope() {
								var $container = $('#<?php echo $unique_port_id; ?>');
								$container.isotope({
									itemSelector: '.staff-entry',
									animationEngine: 'css',
									layoutMode: 'masonry'
								});
							} wpexStaffIsotope();
							var $filterLinks = $('.filter-<?php echo $unique_port_id; ?> a');
							$filterLinks.each( function() {
								var $filterableDiv = $(this).data('filter');
								if ( $filterableDiv == '*' ) {
									// ignore this one
								} else {
									if ( $($filterableDiv).width() ) {
										// keep these
									} else {
										// remove these
										$(this).parent().hide();
									}
								}
							});
							$filterLinks.css({ opacity: 1 } );
							$filterLinks.click(function(){
							  var selector = $(this).attr('data-filter');
								$('#<?php echo $unique_port_id; ?>').isotope({ filter: selector });
								$(this).parents('ul').find('li').removeClass('active');
								$(this).parent('li').addClass('active');
							  return false;
							});
							var isIE8 = $.browser.msie && +$.browser.version === 8;
							if (isIE8) {
								document.body.onresize = function () {
									wpexStaffIsotope();
								};
							} else {
								$(window).resize(function () {
									wpexStaffIsotope();
								});
							}
							window.addEventListener("orientationchange", function() {
								wpexStaffIsotope();
							});
					});
				});
				</script>
				<?php } ?>
		
				<div class="vcex-staff-grid vcex-clearfix <?php if ( $filter == 'true' || $grid_style == 'masonry' ) { echo 'vcex-masonry-grid'; } ?>" <?php echo $unique_id; ?>>
					<?php
					$count='';
					foreach ( $vcex_query->posts as $post ) : setup_postdata( $post );
					$count++;
					$post_id = get_the_ID(); ?>
					<?php $post_terms = get_the_terms( $post, 'staff_category' ); ?>
					<article id="#post-<?php the_ID(); ?>" class="staff-entry col <?php foreach ( $post_terms as $post_term ) { echo $post_term->slug .' '; } ?> <?php echo $col_class; ?> <?php echo 'col-'. $count .''; ?>">
						<?php if( has_post_thumbnail() ) { ?>
							<?php
							// Image Filter class
							$img_filter_class = $img_filter ? 'vcex-'. $img_filter : ''; ?>
							<?php
							// Image hover styles
							$img_hover_style_class = $img_hover_style ? 'vcex-img-hover-parent vcex-img-hover-'. $img_hover_style : ''; ?>
							<div class="staff-entry-media <?php echo $img_filter_class; ?> <?php echo $img_hover_style_class; ?>">
								<?php if ( $thumb_link == 'post' ||  $thumb_link == 'lightbox' ) { ?>
									<?php if ( $thumb_link == 'post' ) { ?>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
									<?php } ?>
									<?php if ( $thumb_link == 'lightbox' ) { ?>
										<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="vcex-lightbox">
									<?php } ?>
								<?php } ?>
									<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), intval($img_width),  intval($img_height), $img_crop ); ?>" alt="<?php the_title(); ?>" class="staff-entry-img" />
								<?php if ( $thumb_link == 'post' ||  $thumb_link == 'lightbox' ) { ?>
									<?php if ( $img_filter !== 'grayscale' ) {
										if ( $img_overlay_disable !== 'yes' ) {
											// Display Staff Position
											if ( get_post_meta( get_the_ID(), 'wpex_staff_position', true ) !== '' && function_exists('wpex_get_staff_overlay') ) echo wpex_get_staff_overlay();
										}
									} ?>
									</a>
								<?php } ?>
								<?php
								// Display Staff Position
								if ( $img_filter !== 'grayscale' && $thumb_link == 'nowhere' && function_exists('wpex_get_staff_overlay') ) echo wpex_get_staff_overlay(); ?>
							</div><!-- .staff-dia -->
						<?php } ?>
					   <?php if ( $title == 'true' || $excerpt == 'true' ) { ?>
							<div class="staff-entry-details clr">
								<?php if ( $title == 'true' ) { ?>
									<h2 class="staff-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
								<?php if ( $excerpt == 'true' ) { ?>
									<div class="clr"></div>
									<div class="staff-entry-excerpt clr">
									<?php if ( $excerpt_length == "9999" ) { ?>
										<?php the_content(); ?>
									<?php } else { ?>
										<?php vcex_excerpt( $excerpt_length, $read_more, $read_more_text ); ?>
									<?php } ?>
									</div>
								<?php } ?>
								<?php
								// Display social links
								if ( function_exists('wpex_get_staff_social') && $social_links == 'true' ) echo wpex_get_staff_social( $post_id ); ?>
							</div><!-- .staff-entry-details -->
						<?php } ?>
					</article><!-- .staff-entry -->
					<?php
					// Reset counter
					if ( $count == $columns ) {
						$count = '';			
					} ?>
					<?php endforeach; ?>
				</div><!-- .vcex-staff-grid -->
				
				<?php
				// Paginate Posts
				if( $pagination == 'true' ) {
					$total = $vcex_query->max_num_pages;
					$big = 999999999; // need an unlikely integer
					if( $total > 1 )  {
						 if( !$current_page = get_query_var('paged') )
							 $current_page = 1;
						 if( get_option('permalink_structure') ) {
							 $format = 'page/%#%/';
						 } else {
							 $format = '&paged=%#%';
						 }
						 echo paginate_links(array(
							'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'		=> $format,
							'current'		=> max( 1, get_query_var('paged') ),
							'total'			=> $total,
							'mid_size'		=> 2,
							'type'			=> 'list',
							'prev_text'	=> '<i class="fa fa-angle-left"></i>',
							'next_text'	=> '<i class="fa fa-angle-right"></i>',
						 ));
					}
				}
			
			endif; // End has posts check
					
			// Set things back to normal
			wp_reset_postdata();
		
		return ob_get_clean();
		
	}
	add_shortcode("vcex_staff_grid", "vcex_staff_grid_shortcode");
}




// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Staff Grid", 'vcex' ),
	"base"					=> "vcex_staff_grid",
	"class"					=> "vcex_staff_grid",
	"category"				=> __( "Staff", "wpex" ),
	"icon" 					=> "icon-wpb-vcex-staff_grid",
	"params"				=> array(
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Unique Id", 'vcex' ),
			"param_name"	=> "unique_id",
			"value"			=> "",
			"description"	=> __( "You can enter a unique ID here for styling purposes.", 'vcex' ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Category", 'vcex' ),
			"param_name"	=> "term_slug",
			"admin_label"	=> true,
			"value"			=> "all",
			"description"	=> __( "Enter a category slug to limit your posts.", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Category Filter", 'vcex' ),
			"param_name"	=> "filter",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
			"description"	=> __( "Do you wish to display an animated category filter?", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Grid Style", 'vcex' ),
			"param_name"	=> "grid_style",
			"value"			=> array(
				 __( "Fit Columns", "wpex")	=> "fit-columns",
				 __( "Masonry", "wpex" )		=> "masonry",
			),
			"description"	=> __( "Important: If the category filter is enabled above the grid will always be masonry style.", 'vcex' ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Columns", 'vcex' ),
			"param_name"	=> "columns",
			"value" 		=> array('4' =>'4', '3' => '3', '2' => '2', '1' => '1'),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Posts Per Page", 'vcex' ),
			"param_name"	=> "posts_per_page",
			"value"			=> "-1",
			"description"	=> __( "How many items do you wish to show?", 'vcex' ),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Width", 'vcex' ),
			"param_name"	=> "img_width",
			"value"			=> "9999",
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Image Height", 'vcex' ),
			"param_name"	=> "img_height",
			"value"			=> "9999",
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Image Hard Crop", 'vcex' ),
			"param_name"	=> "img_crop",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Image Filter", 'vcex' ),
			"param_name"	=> "img_filter",
			"value"			=> vcex_image_filters()
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "CSS3 Image Hover", 'vcex' ),
			"param_name"	=> "img_hover_style",
			"value"			=> vcex_image_hovers(),
			"description"	=> __("Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.", "wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Image Links To", 'vcex' ),
			"param_name"	=> "thumb_link",
			"value"			=> array(
				 __( "Post", "wpex")		=> "post",
				 __( "Lightbox", "wpex" )	=> "lightbox",
				 __( "Nowhere", "wpex" )	=> "nowhere",

			),
		),
		array(
			"type"			=> "checkbox",
			"class"			=> "",
			"heading"		=> __( "Disable Image Overlay?", 'vcex' ),
			"param_name"	=> "img_overlay_disable",
			"value"			=> Array(__("Yes please.", "wpex") => 'yes'),
			"description"	=> __("Check this box to hide the default overlay when a user hovers over the featured image.", "wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Order", 'vcex' ),
			"param_name"	=> "order",
			"description"	=> sprintf( __( 'Designates the ascending or descending order. More at %s.', 'vcex' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
			"value"			=> array(
				 __( "DESC", "wpex")	=> "DESC",
				 __( "ASC", "wpex" )	=> "ASC",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Order By", 'vcex' ),
			"param_name"	=> "orderby",
			"description"	=> sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'vcex' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
			"value"			=> array(
				 __( "Date", "wpex")				=> "date",
				 __( "Name", "wpex" )				=> "name",
				 __( "Modified", "wpex")			=> "modified",
				 __( "Author", "wpex" )			=> "author",
				 __( "Random", "wpex")				=> "rand",
				 __( "Comment Count", "wpex" )	=> "comment_count",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Pagination", 'vcex' ),
			"param_name"	=> "pagination",
			"value"			=> array(
				__( "False", "wpex")	=> "false",
				__( "True", "wpex" )	=> "true",
			),
			"description"	=> __("Important: Pagination will not work on your homepage because of how WordPress works","wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Title", 'vcex' ),
			"param_name"	=> "title",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Excerpt", 'vcex' ),
			"param_name"	=> "excerpt",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Excerpt Length", 'vcex' ),
			"param_name"	=> "excerpt_length",
			"value"			=> "30",
			"description"	=> __("Enter 9999 to display the full post content","wpex"),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Read More", 'vcex' ),
			"param_name"	=> "read_more",
			"value"			=> array(
				 __( "False", "wpex" )	=> "false",
				 __( "True", "wpex")	=> "true",	
			),
		),
		array(
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Read More Text", 'vcex' ),
			"param_name"	=> "read_more_text",
			"value"			=> "",
			"description"	=> __("Enter your custom text for the readmore button.","wpex"),
			"dependency" => Array('element'	=> "read_more", 'value' => "true" ),
		),
		array(
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __( "Social Links", 'vcex' ),
			"param_name"	=> "social_links",
			"value"			=> array(
				 __( "True", "wpex")	=> "true",
				 __( "False", "wpex" )	=> "false",
			),
		),
	)
) );
?>