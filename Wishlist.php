<?php
/**
* The template for displaying all pages
*
*Template Name: Wishlist
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package rideo
*/
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<section class="product-content section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<?php
					while ( have_posts() ) :
						the_post();
							
							if(shortcode_exists( 'ti_wishlistsview' )):

								echo do_shortcode( '[ti_wishlistsview]' );

							endif;
						
					endwhile; // End of the loop.
					?>
					</div>
				</div>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();