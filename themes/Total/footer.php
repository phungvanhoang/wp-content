<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
 */
?>

    </div><!-- #main-content --><?php // main-content opens in header.php ?>
	
	<?php
	// Display footer callout - see functions/footer-callout
	wpex_footer_callout();
	
	// Get footer unless disabled
	// See functions/footer-display.php
	if ( wpex_display_footer() == true ) {
		// Get footer style based on theme option - see "footers" folder
		get_template_part( 'footers/footer', wpex_option( 'footer_style', 'one' ) );
	} ?>

</div><!-- #wrap -->

<!-- MOBILE MENU -->
<form method="get" class="mobile-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="search" id="mobile-search-input" name="s" value="<?php _e( 'search', 'wpex' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
</form>

<?php
// Display back to top button if enabled in the admin
if ( wpex_option( 'scroll_top', '1' ) == '1' ) { ?>
	<a href="#" id="site-scroll-top"><span class="fa fa-chevron-up"></span></a>
<?php } ?>

<?php
// Outputs the code for the overlay search
wpex_search_overlay(); ?>

<?php
// Cart widget displays current items in the cart
wpex_cart_widget(); ?>

<?php
// Important WordPress Hook - DO NOT DELETE!
wp_footer(); ?>

<!-- Google Analytics Begins-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53639489-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Google Analytics Ends-->
<!-- Live Agent Code -->
<script type='text/javascript' src='https://c.la1w1.salesforceliveagent.com/content/g/js/31.0/deployment.js'></script>
<script type='text/javascript'>
liveagent.init('https://d.la1w1.salesforceliveagent.com/chat', '572G0000000TXFE', '00DG0000000CLl1');
</script>
<!-- Live Agent Code -->
<!-- Form Validation -->
<script type='text/javascript' src='http://americanaddictioncenters.org/js/jquery.validate.js?ver=3.9.2async onload=Õmyinit()'></script>
<script>
jQuery.validator.addMethod("phoneSA", function (phone, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
        phone_number.match(/^(0-?)?(\([0-9]\d{2}\)|[0-9]\d{2})-?[0-9]\d{2}-?\d{4}$/); //(0-?) = 0, ([0-9]\d{2}\) = 3 digits from 0-9 , d{4} 4 didgets, $ end of number
}, "Please specify a valid phone number");

		jQuery("#calloutForm").validate({
			rules: {
				first_name: {required: true, maxlength: 10},
				phone: {required: true}	
			},
			submitHandler: function(form){
				if(jQuery('input#website3').val() == 'http://' && jQuery('input#website2').val().length == 0){
					console.log('form');
					jQuery('#calloutForm').attr('action','https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
					form.submit();
				}
			}
		});
		jQuery("#sidebarForm").validate({
			rules: {
				first_name: {required: true, maxlength: 10},
				last_name: {required: true, maxlength: 10},
				email: {required: true,email: true},
				description: {required:true, maxlength:200}
			},
			submitHandler: function(form){
				if(jQuery('input#website3').val() == 'http://' && jQuery('input#website2').val().length == 0){
					console.log('form');
					jQuery('#sidebarForm').attr('action','https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
					form.submit();
				}
			}
		});
		jQuery("#homeForm").validate({
			rules: {
				first_name: {required: true, maxlength: 10},
				email: {required: true,email: true}
			},
			submitHandler: function(form){
				if(jQuery('input#website3').val() == 'http://' && jQuery('input#website2').val().length == 0){
					console.log('form');
					jQuery('#homeForm').attr('action','https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
					form.submit();
				}
			}
		});
	</script>

</body>
</html>