<?php


//Shop title remove
function rideo_woocommerce_show_page_title(){
	return;
}

//Product title add
function rideo_template_loop_product_title(){
	echo '<div class="product-title text-center">  
	<a href="'.get_the_permalink().'"><h5> '.get_the_title().'</h5></a>';

}

//
function rideo_woocommerce_template_loop_product_thumbnail(){?>
<div class="pro-img">
	<a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
	
	<div class="actions-btn">
		<ul class="clearfix">
			<li>
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</li>
			<?php if (shortcode_exists( 'ti_wishlists_addtowishlist' )): ?>
			<li>
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
			</li>
		<?php endif; ?>
			<li>
				<a href="#" data-toggle="modal" data-target="#quick-view"><i class="fa fa-eye"></i></a>
			</li>
		</ul>
	</div>
</div>

<?php }

function rideo_woocommerce_template_loop_rating(){?>

	<div class="shop-item-ratting">		
		<?php woocommerce_template_loop_rating() ?>		
	</div>
		
	
	<?php woocommerce_template_loop_price() ?></div>



<?php }

//Pagination
function rideo_product_pagination() {
global $wp_query;
$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
        'prev_next'          => true,
		'prev_text'          => __('« '),
		'next_text'          => __(' »'),
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<div class="pagnation-ul">
<ul class="clearfix">';
        foreach ( $pages as $page ) {
                echo "<li>$page</li>";
        }
       echo '</ul></div>';
        }
}


//Show per page
function rideo_woocommerce_catalog_page_ordering() {
?>
<?php echo '<span>Showing</span>' ?>
    <form action="" method="POST" name="results" class="woocommerce-ordering">
    <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
<?php
 
//Get products on page reload
if  (isset($_POST['woocommerce-sort-by-columns']) && (($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns']))) {
        $numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
          } else {
        $numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
          }
 
//  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
			$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
			//Add as many of these as you like, -1 shows all products per page
			  //  ''       => __('Results per page', 'woocommerce'),
				'6' 		=> __('6', 'rideo'),
				'12' 		=> __('12', 'rideo'),
				'18' 		=> __('18', 'rideo'),
				'-1' 		=> __('All', 'rideo'),
			));

		foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
			echo '<option value="' . $sort_id . '" ' . selected( $numberOfProductsPerPage, $sort_id, true ) . ' >' . $sort_name . '</option>';
?>
</select>
</form>

<?php
}
 
// now we set our cookie if we need to
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'www.your-domain-goes-here.com', false); //this will fail if any part of page has been output- hope this works!
    $count = $_POST['woocommerce-sort-by-columns'];
  }
  // else normal page load and no cookie
  return $count;
}
 
add_filter('loop_shop_per_page','dl_sort_by_page');


/**
 * Add custom sorting options (asc/desc)
 */

add_filter( 'woocommerce_catalog_orderby', 'rideo_woocommerce_catalog_orderby' );
function rideo_woocommerce_catalog_orderby( $sortby ) {
	$sortby['rating'] = 'Best Rated Item';
	$sortby['date'] = 'Date';
	$sortby['menu_order'] = 'Menu';
	$sortby['price'] = 'Price (low to High)';
	$sortby['price-desc'] = 'Price (High to Low)';
	unset($sortby['popularity']);
	return $sortby;
}

function rideo_template_single_sharing() {?>

	<div class="single-actions-btn">
		<ul class="clearfix text-center">
			
			<?php if (shortcode_exists( 'ti_wishlists_addtowishlist' )): ?>
			
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?>
			
		<?php endif; ?>
			<li>
				<a href="#"><i class="fa fa-compress"></i></a>
			</li>
			<li>
				<a href="#"><i class="fa fa-share-alt"></i></a>
			</li>
		</ul>
	</div>
	
<?php 
}
?>

<?php
/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}
