<?php

//Custom Slider Taxonomy OR Catagory
function rideo_custom_post_taxonomy() {
    register_taxonomy(
        'main_slide_cat',  
        'rideo-main-slide', //Your Post type here                 
        array(
            'hierarchical'          => true,
            'label'                 => 'Slider Category',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'slide_category', 
                'with_front'    => true 
                )
            )
    );
}
add_action( 'init', 'rideo_custom_post_taxonomy');


//Custom Taxonomy OR Catagory Function
function rideo_theme_slider_category(){
    $slide_categories = get_terms('main_slide_cat'); //Enter category Name
    $slide_category_options = array('' => esc_html__('All Catagory', 'upbuild-toolkit'));
    if($slide_categories){
        foreach ($slide_categories as $slide_category) {
            $slide_category_options[$slide_category->term_id] = $slide_category->name;
        }
    }
    return $slide_category_options;
}


//Slider ShortCode Function
function rideo_slider_shortcode($atts)
{
    extract(shortcode_atts(array(
        'count' => '',
        'height' => '',
        'category' => '',
        'slider_icon' => '',
        'pagination' => 'false',
        'thumbnails' => 'false',
        'navigation' => 'false',       
    ), $atts));
    
    if (!empty($category)) {
        $arg = array(
            'post_type' => 'rideo-main-slide',
            'posts_per_page' => $count,
            'tax_query' => array(
                array(
                    'taxonomy' => 'main_slide_cat', //Enter Register Taxonomy
                    'field' => 'term_id', //Enter your term name
                    'terms' => $category
                )
            )
        );
    } else {
        $arg = array(
            'post_type' => 'rideo-main-slide',
            'posts_per_page' => $count,
        );
    }
    
    
    $get_post = new WP_Query($arg);    
    
    $slide_rendom_number = rand(630437, 630438);
    
    $rideo_slider_markup = '
    <script>
        jQuery(window).load(function ($) {      
        jQuery("#mainslider' . $slide_rendom_number . '").camera({
		height: "'.$height.'",
		loader: "none",
		pagination: '.$pagination.',        
		playPause: false,
		thumbnails: '.$thumbnails.',
		autoAdvance: true,
		navigation: '.$navigation.',
		hover: false,
		opacityOnGrid: false,
		overlayer: true,
		fx: "random"
	});

    });
    </script>
    <div class="slider-area slider-one clearfix">        
    <div class="slider" id="mainslider'. $slide_rendom_number.'">';
    while ($get_post->have_posts()):
        $get_post->the_post();
        $post_id = get_the_ID();
        
        //Slider warnning condition solve From theme meta option
        if (get_post_meta($post_id, 'rideo_slide_meta', true)) {
            $slide_meta = get_post_meta($post_id, 'rideo_slide_meta', true);
        } else {
            $slide_meta = array();
        }
    
        //Custom color change            
        if (array_key_exists('text_color', $slide_meta)) {
            $text_color = $slide_meta['text_color'];
        } else {
            $text_color = '#fff';
        }    
       
        //Custom SLider text align           
        if (array_key_exists('slider_button_link', $slide_meta)) {
            $slider_button_link = $slide_meta['slider_button_link'];
        } else {
            $slider_button_link = '#';
        }
 
        $rideo_slider_markup .= '
            <div data-src="'. get_the_post_thumbnail_url($post_id, 'large') . ')">';
        $rideo_slider_markup .= '
                    <div class="d-table">
						<div class="d-tablecell">
							<div class="container">
								<div class="row">
									<div class="col-xs-12">
										<div class="slide-text" style="color:' . $text_color . '">
											<h1 class="animated fadeInDown">' . get_the_title($post_id) . '</h1>
											<div class="shape animated flipInX">
												<i class="'.$slider_icon.'"></i>
											</div>
											' . wpautop(get_the_content($post_id)) . '
											<a class="shop-btn animated fadeInUp" href="'.$slider_button_link.'">Shop Now</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
            
            </div>';
    endwhile;
    $rideo_slider_markup .= '</div></div>';
    
    wp_reset_query();
    
    return $rideo_slider_markup;
    
}
add_shortcode('rideo_slider', 'rideo_slider_shortcode');


