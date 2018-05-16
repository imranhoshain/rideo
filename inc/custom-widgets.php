<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rideo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Default Blog Sidebar', 'rideo' ),
		'id'            => 'blog_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'rideo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    //footer Widget
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget One', 'rideo' ),
		'id'            => 'footer_one',
		'description'   => esc_html__( 'Add information, logo, your address.', 'rideo' ),
		'before_widget' => '<div class="s-footer-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-title"><h4>',
		'after_title'   => '</h4></div>',
	) );

	 //footer Widget 2
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Two', 'rideo' ),
		'id'            => 'footer_two',
		'description'   => esc_html__( 'Add footer widget Style2 here.', 'rideo' ),
		'before_widget' => '<div class="s-footer-text contact-link">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-title"><h4>',
		'after_title'   => '</h4></div>',
	) );
    
     //footer Widget 3
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Three', 'rideo' ),
		'id'            => 'footer_three',
		'description'   => esc_html__( 'Add Footer Three.', 'rideo' ),
		'before_widget' => '<div class="s-footer-text footer-menu">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-title"><h4>',
		'after_title'   => '</h4></div>',
	) );

	     //footer Widget Four
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Four', 'rideo' ),
		'id'            => 'footer_four',
		'description'   => esc_html__( 'Add Footer Four.', 'rideo' ),
		'before_widget' => '<div class="s-footer-text footer-menu">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-title"><h4>',
		'after_title'   => '</h4></div>',
	) );
}
add_action( 'widgets_init', 'rideo_widgets_init' );