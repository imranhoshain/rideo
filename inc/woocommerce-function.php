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
				<?php echo do_shortcode( '[ti_wishlists_addtowishlist]' ); ?></i>
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

