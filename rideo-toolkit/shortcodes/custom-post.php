<?php

//Slider Custom register function
function rideo_theme_custom_post()
{
    
    //rideo Main Slider
    register_post_type('rideo-main-slide', array(
        'label' => 'slides',
        'labels' => array(
            'name' => 'Main Slides',
            'has_archive' => false,
            'singular_name' => 'slide'
        ),
        'public' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'excerpt'
        )
        
        
    ));
    //Testimonials Custom Post Slider
    register_post_type('testi-slider', array(
        'label' => 'testi',
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'testimonial'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-images-alt',
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'excerpt'
        )
    ));
    
}
add_action('init', 'rideo_theme_custom_post');