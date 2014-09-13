<?php
// Add Portfolio Grid Shortcode -------------------------------------------------------------------------- >
if( !function_exists( 'vcex_portfolio_grid_shortcode' ) ) {

	function vcex_portfolio_grid_shortcode($atts) {
		
		// Define shortcode params
		extract( shortcode_atts( array(
				'unique_id'		=> '',
				'term_slug'		=> 'all',
				'posts_per_page'	=> '12',
				'grid_style'		=> 'fit_columns',
				'columns'			=> '4',
				'order'				=> 'DESC',
				'orderby'			=> 'date',
				'filter'			=> '',
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
					'taxonomy'	=> 'portfolio_category',
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
				'post_type'		=> 'portfolio',
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
			$unique_port_id = 'portfolio-'. $rand_num; 
			$unique_port_id = $unique_id ? $unique_id : $unique_port_id;
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
			
			// Remove all filter/isotope for no margin grids
			if ( $grid_style == 'no_margins' ) {
				$filter = false;
			}
			
			// Load Masonry scripts
			if ( $filter == 'true' || $grid_style == 'masonry' || $grid_style == 'no_margins' ) {
				wp_enqueue_script( 'vcex-isotope' ); // Load Isotope Script
			}
			
			ob_start(); ?>
				<?php
				// Display filter links
				if ( $filter == 'true' ) { ?>
					<?php $filter_parent = ( $term_slug !== '' && $term_slug !== 'all' ) ? $term_slug : NULL; ?>
					<?php $terms = get_terms( 'portfolio_category', array( 'child_of' => $filter_parent ) ); ?>
					<?php if( $terms ) { ?>
						<ul class="vcex-portfolio-filter filter-<?php echo $unique_port_id; ?> vcex-filter-links clr">
							<li class="active"><a href="#" data-filter="*"><span><?php _e('All', 'vcex'); ?></span></a></li>
							<?php foreach ($terms as $term ) : ?>
								<li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul><!-- .vcex-portfolio-filter -->
					<?php } ?>
				<?php } ?>
				
				<?php
				if ( $filter == 'true' || $grid_style == 'masonry' ) { ?>
				<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
							function wpexPortfolioIsotope() {
								var $container = $('#<?php echo $unique_port_id; ?>');
								$container.isotope({
									itemSelector: '.portfolio-entry'
								});
							} wpexPortfolioIsotope();
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
									wpexPortfolioIsotope();
								};
							} else {
								$(window).resize(function () {
									wpexPortfolioIsotope();
								});
							}
							window.addEventListener("orientationchange", function() {
								wpexPortfolioIsotope();
							});
					});
				});
				</script>
				<?php } ?>
				
				<?php
				// No margins grid scripts and JS
				if ( $grid_style == 'no_margins' ) {
					// Enqueue Scripts
					wp_enqueue_script('vcex-masonry'); ?>
					<script type="text/javascript">
					jQuery(function($){
						$(window).load(function() {
							$('#<?php echo $unique_port_id; ?>').masonry({
							  itemSelector: '.portfolio-entry'
							});
						});
					});
					</script>
				<?php } ?>
		
				<div class="vcex-portfolio-grid vcex-clearfix <?php if ( $filter == 'true' || $grid_style == 'masonry' || $grid_style == 'no_margins' ) { echo 'vcex-masonry-grid'; } ?> <?php if ( $grid_style == 'no_margins' ) { echo 'vcex-no-margin-grid'; } ?>" <?php echo $unique_id; ?>>
					<?php
					$count='';
					foreach ( $vcex_query->posts as $post ) : setup_postdata( $post );
					$count++; ?>
					<?php $post_terms = get_the_terms( $post, 'portfolio_category' ); ?>
					<article id="#post-<?php the_ID(); ?>" class="portfolio-entry col <?php foreach ( $post_terms as $post_term ) { echo $post_term->slug .' '; } ?> <?php echo $col_class; ?> <?php echo 'col-'. $count .''; ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php $img_filter_class = $img_filter ? 'vcex-'. $img_filter : ''; ?>
						<?php
						// Image hover styles
						$img_hover_style_class = $img_hover_style ? 'vcex-img-hover-parent vcex-img-hover-'. $img_hover_style : ''; ?>
						<div class="portfolio-entry-media <?php echo $img_filter_class; ?> <?php echo $img_hover_style_class; ?>">
							<?php if ( $thumb_link == 'post' ||  $thumb_link == 'lightbox' ) { ?>
								<?php if ( $thumb_link == 'post' ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
								<?php } ?>
								<?php if ( $thumb_link == 'lightbox' ) { ?>
									<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" class="vcex-lightbox">
								<?php } ?>
							<?php } ?>
								<img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ), intval($img_width),  intval($img_height), $img_crop ); ?>" alt="<?php the_title(); ?>" class="portfolio-entry-img" />
							<?php if ( $thumb_link == 'post' ||  $thumb_link == 'lightbox' ) { ?>
								<?php if ( $img_overlay_disable !== 'yes' ) { ?>
									<span class="portfolio-entry-overlay"></span>
								<?php } ?>
								</a>
							<?php } ?>
						</div><!-- .portfolio-entry-media -->
						<?php } ?>
					   <?php if ( $title == 'true' || $excerpt == 'true' ) { ?>
							<div class="portfolio-entry-details clr">
								<?php if ( $title == 'true' ) { ?>
									<h2 class="portfolio-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
								<?php if ( $excerpt == 'true' ) { ?>
									<div class="portfolio-entry-excerpt clr"><?php vcex_excerpt( $excerpt_length, $read_more, $read_more_text ); ?></div>
								<?php } ?>
							</div><!-- .portfolio-entry-details -->
						<?php } ?>
					</article><!-- .portfolio-entry -->
					<?php
					// Reset counter
					if ( $count == $columns ) {
						$count = '';			
					} ?>
					<?php endforeach; ?>
				</div><!-- .vcex-portfolio-grid -->
				
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
	add_shortcode("vcex_portfolio_grid", "vcex_portfolio_grid_shortcode");
}




// Add to Visual Composer -------------------------------------------------------------------------- >
vc_map( array(
	"name"					=> __( "Portfolio Posts Grid", 'vcex' ),
	"base"					=> "vcex_portfolio_grid",
	"class"					=> "vcex_portfolio_grid",
	"category"				=> __( "Portfolio", "wpex" ),
	"icon" 					=> "icon-wpb-vcex-portfolio_grid",
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
			"heading"		=> __( "Grid Style", 'vcex' ),
			"param_name"	=> "grid_style",
			"value"			=> array(
				 __( "Fit Columns", "wpex")						=> "fit-columns",
				 __( "Masonry (Filter allowed)", "wpex" )		=> "masonry",
				 __( "No Margins", "wpex" )						=> "no_margins",
			),
			"description"	=> __( "Important: If you choose the \"No Margins\" style please make sure that all your images are the same dimensions because the isotope script will be removed.", 'vcex' ),
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
			"type"			=> "textfield",
			"class"			=> "",
			"heading"		=> __( "Excerpt Length", 'vcex' ),
			"param_name"	=> "excerpt_length",
			"value"			=> "15",
			"description"	=> __("This setting is only used when a custom excerpt is NOT defined within the post\'s excerpt field.","wpex"),
		),
	)
) );
?>