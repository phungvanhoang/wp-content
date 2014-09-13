<?php
// Add testimonials Grid Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_testimonials_grid_shortcode' ) ) {

	function vcex_testimonials_grid_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'term_slug'		=> 'all',
				'posts_per_page'	=> '12',
				'grid_style'		=> 'fit_columns',
				'columns'			=> '4',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'filter'			=> 'true',
				'title'				=> 'true',
				'excerpt'			=> 'true',
				'excerpt_length'	=> '15',
				'read_more'		=> 'false',
				'read_more_text'	=> __( 'read more', 'vcex' ),
				'pagination'		=> 'false',
				'filter_content'	=> 'false',
				'offset'			=> 0,
				'taxonomy'			=> '',
				'terms'				=> '',
			), $atts));
			
		// Get global $post var
		global $post;
			
		// Start Tax Query
		$tax_query = '';
		if( $term_slug !== '' && $term_slug !== 'all' ) {
			$tax_query = array(
				array(
					'taxonomy'	=> 'testimonials_category',
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
				'post_type'		=> 'testimonials',
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
			$unique_port_id = 'testimonials-'. $rand_num; 
			$unique_id = $unique_id ? ' id="'. $unique_id .' '. $unique_port_id .'"' : 'id="'. $unique_port_id .'"';
			
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
			
			// Load Masonry scripts
			if ( $filter == 'true' || $grid_style == 'masonry' || $grid_style == 'no_margins' ) {
				wp_enqueue_script( 'vcex_isotope' ); // Load Isotope Script
			}
			
			ob_start(); ?>
				<?php
				// Display filter links
				if ( $filter == 'true' ) { ?>
					<?php wp_enqueue_script( 'vcex_isotope' ); // Load Isotope Script ?>
					<?php $filter_parent = ( $term_slug !== '' && $term_slug !== 'all' ) ? $term_slug : NULL; ?>
					<?php $terms = get_terms( 'testimonials_category', array( 'child_of' => $filter_parent ) ); ?>
					<?php if( $terms ) { ?>
						<ul class="vcex-testimonials-filter filter-<?php echo $unique_port_id; ?> vcex-filter-links clr">
							<li class="active"><a href="#" data-filter="*"><span><?php _e('All', 'vcex'); ?></span></a></li>
							<?php foreach ($terms as $term ) : ?>
								<li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul><!-- .vcex-testimonials-filter -->
					<?php } ?>
				<?php } ?>
				
				<?php
				if ( $filter == 'true' || $grid_style == 'masonry' || $grid_style == 'no_margins' ) { ?>
				<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
							function wpextestimonialsIsotope() {
								var $container = $('#<?php echo $unique_port_id; ?>');
								$container.isotope({
									itemSelector: '.testimonial-entry'
								});
							} wpextestimonialsIsotope();
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
									wpextestimonialsIsotope();
								};
							} else {
								$(window).resize(function () {
									wpextestimonialsIsotope();
								});
							}
							window.addEventListener("orientationchange", function() {
								wpextestimonialsIsotope();
							});
					});
				});
				</script>
				<?php } ?>
		
				<div class="vcex-testimonials-grid vcex-clearfix <?php if ( $filter == 'true' || $grid_style == 'masonry' ) { echo 'vcex-masonry-grid'; } ?>" <?php echo $unique_id; ?>>
					<?php
					$count='';
					foreach ( $vcex_query->posts as $post ) : setup_postdata( $post );
					$count++;
					$wpex_testimonial_author = get_post_meta( get_the_ID(), 'wpex_testimonial_author', true );
					$wpex_testimonial_company = get_post_meta( get_the_ID(), 'wpex_testimonial_company', true );
					$wpex_testimonial_url = get_post_meta( get_the_ID(), 'wpex_testimonial_url', true );
					$post_thumb_id = get_post_thumbnail_id();
					$attachment_url = wp_get_attachment_url( $post_thumb_id );
					$width = apply_filters( 'vcex_testimonial_thumb_width', 100 );
					$height = apply_filters( 'vcex_testimonial_thumb_height', 100 );
					$crop = true;
					if ( function_exists('aq_resize') ) {
						$img_url = aq_resize( $attachment_url, $width,  $height, $crop );
					} else {
						$img_url = $attachment_url;
					} ?>
					<?php $post_terms = get_the_terms( $post, 'testimonials_category' ); ?>
					<article id="#post-<?php the_ID(); ?>" class="testimonial-entry col <?php foreach ( $post_terms as $post_term ) { echo $post_term->slug .' '; } ?> <?php echo $col_class; ?> <?php echo 'col-'. $count .''; ?>">
						<div class="testimonial-entry-content clr">
							<span class="testimonial-caret"></span>
							<?php the_content(); ?>
						</div><!-- .home-testimonial-entry-content-->
						<div class="testimonial-entry-bottom">
							<?php if( has_post_thumbnail() ) { ?>
							<div class="testimonial-entry-thumb">
								<img src="<?php echo $img_url; ?>" alt="<?php echo the_title(); ?>" />
							</div><!-- /testimonial-thumb -->
							<?php } ?>
							<div class="testimonial-entry-meta">
								<?php if ( $wpex_testimonial_author ) { ?>
									<span class="testimonial-entry-author"><?php echo $wpex_testimonial_author; ?></span>
								<?php } ?>
								<?php if ( $wpex_testimonial_company ) { ?>
									<?php if ( $wpex_testimonial_url ) { ?>
										<a href="<?php echo $wpex_testimonial_url; ?>" class="testimonial-entry-company" title="<?php echo $wpex_testimonial_company; ?>" target="_blank"><?php echo $wpex_testimonial_company; ?></a>
									<?php } else { ?>
										<span class="testimonial-entry-company"><?php echo $wpex_testimonial_company; ?></span>
									<?php } ?>
								<?php } ?>
							</div><!-- .testimonial-entry-meta -->
						</div><!-- .home-testimonial-entry-bottom -->
					</article><!-- .testimonials-entry -->
					<?php
					// Reset counter
					if ( $count == $columns ) {
						$count = '';			
					} ?>
					<?php endforeach; ?>
				</div><!-- .vcex-testimonials-grid -->
				
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
	add_shortcode("vcex_testimonials_grid", "vcex_testimonials_grid_shortcode");
}




// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Testimonials Grid", 'vcex' ),
	"base"					=> "vcex_testimonials_grid",
	"class"					=> "vcex_testimonials_grid",
	"category"				=> __( "Testimonials", "wpex" ),
	"icon" 					=> "icon-wpb-vcex-testimonials_grid",
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
			"value"			=> array(1,2,3,4),
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
	)
) );
?>