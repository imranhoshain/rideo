<?php

//Remove Action Function

remove_action( 'woocommerce_template_loop_product_link_open', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);



add_action( 'woocommerce_shop_loop_item_title', 'rideo_template_loop_product_title', 10);

add_action( 'woocommerce_before_shop_loop_item_title', 'rideo_woocommerce_template_loop_product_thumbnail', 10);

add_action( 'woocommerce_after_shop_loop_item', 'rideo_woocommerce_template_loop_rating', 10);



//Remove shop title
apply_filters( 'woocommerce_show_page_title', 'rideo_woocommerce_show_page_title' );