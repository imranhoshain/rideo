<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rideo
 */

if ( ! is_active_sidebar( 'blog_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="col-md-3">
		<?php dynamic_sidebar( 'blog_sidebar' ); ?>
	</div>
</aside><!-- #secondary -->