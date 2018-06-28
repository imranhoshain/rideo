<?php

//Feature product ShortCode

function rideo_theme_product_category(){
    
$rideo_product_categories = get_terms( 'product_cat', $args );
   $rideo_product_category_options = array('' => esc_html__('All Catagory', 'upbuild-toolkit'));
    if($rideo_product_categories){
        foreach ($rideo_product_categories as $rideo_product_category) {
            $rideo_product_category_options[$rideo_product_category->term_id] = $rideo_product_category->name;
        }
    }
   
    return $rideo_product_category_options;

   
}


//Slider ShortCode Function
function rideo_product_slider_shortcode($atts)
{
    extract(shortcode_atts(array(
        'count' => '',
        'height' => '',
        'products' => '',
        'rideo_product_category' => '',
        'slider_icon' => '',
        'pagination' => 'false',
        'thumbnails' => 'false',
        'navigation' => 'false',       
    ), $atts));
    
   /* if (!empty($category)) {
        $arg = array(
            'post_type' => 'product',
            'posts_per_page' => $count,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat', //Enter Register Taxonomy
                    'field' => 'term_id', //Enter your term name
                    'terms' => $category
                )
            )
        );
    } else {
        $arg = array(
            'post_type' => 'product',
            'posts_per_page' => $count,
        );
    }*/
    
  

		
	    
    

    
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
    <div class="slider" id="mainslider'. $slide_rendom_number.'">';?>
    
        
        

    <?php 
    
    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
	        $query_args = array(
		        'posts_per_page' => $per_page,
		        'post_status'    => 'publish',
		        'post_type'      => 'product',
		        'no_found_rows'  => 1,
		        'meta_query'     => array(),
		        'tax_query'      => array(
			        'relation' => 'AND',
		        ),
	        );

	        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
		        $query_args['tax_query'] = array(
			        array(
				        'taxonomy' => 'product_visibility',
				        'field'    => 'term_taxonomy_id',
				        'terms'    => $product_visibility_term_ids['outofstock'],
				        'operator' => 'NOT IN',
			        ),
		        );
	        }

	        if (!empty($category)) {
		        $query_args['tax_query'][] = array(
				        'taxonomy' 		=> 'product_cat',
				        'terms' 		=>  explode(',',$category),
				        'field' 		=> 'slug',
				        'operator' 		=> 'IN'
		        );
	        }

	        switch($feature) {
		        case 'sale':
			        $product_ids_on_sale    = wc_get_product_ids_on_sale();
			        $product_ids_on_sale[]  = 0;
			        $query_args['post__in'] = $product_ids_on_sale;
			        break;
		        case 'new-in':
			        $query_args['orderby'] = 'DESC';
			        $query_args['order'] = 'date';
			        break;
		        case 'featured':
			        $query_args['tax_query'][] = array(
				        'taxonomy' => 'product_visibility',
				        'field'    => 'term_taxonomy_id',
				        'terms'    => $product_visibility_term_ids['featured'],
			        );
                    break;
		        case 'top-rated':
			        $query_args['meta_key'] = '_wc_average_rating';
			        $query_args['orderby'] = 'meta_value_num';
			        $query_args['order'] = 'DESC';
			        $query_args['meta_query'] = WC()->query->get_meta_query();
			        $query_args['tax_query'] = WC()->query->get_tax_query();
			        break;
		        case 'recent-review':
			        add_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' ) );
			        break;
		        case 'best-selling' :
			        $query_args['meta_key'] = 'total_sales';
			        $query_args['orderby'] = 'meta_value_num';
			        break;
	        }

            if (in_array($feature,array('all','sale','featured'))) {
                $query_args['order'] = $order;

                switch ( $orderby ) {
                    case 'price' :
                        $query_args['meta_key'] = '_price';
                        $query_args['orderby']  = 'meta_value_num';
                        break;
                    case 'rand' :
                        $query_args['orderby']  = 'rand';
                        break;
                    case 'sales' :
                        $query_args['meta_key'] = 'total_sales';
                        $query_args['orderby']  = 'meta_value_num';
                        break;
                    default :
                        $query_args['orderby']  = 'date';
                }
            }
    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );
    
    if ($products->have_posts()) : ?>
                <div class="" >
                    <?php if (!empty($title)) : ?>
                        <h3 class="sc-title"><span><?php echo esc_html($title); ?></span></h3>
                    <?php endif; ?>
                    <?php woocommerce_product_loop_start(); ?>
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php woocommerce_product_loop_end(); ?>
                </div>
            <?php else: ?>
                <div class="item-not-found"><?php echo esc_html__('No item found','g5plus-handmade') ?></div>
            <?php endif; ?>

            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            return $content;
    
}

add_shortcode('rideo_product_slider', 'rideo_product_slider_shortcode');

?>






