<?php
$enable_search = cs_get_option('enable_search');

?>



	<!-- header section start -->
		<header>
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="left floatleft">
								<ul>
							<?php 
								$header_top_left = cs_get_option('header_top_array');						
								if(!empty($header_top_left)) :
							?>
							<?php foreach ($header_top_left as $header_top_left_style ) :
							 ?>
							 <li><i style="color:<?php echo $header_top_left_style['icon_color']; ?>" class="<?php echo $header_top_left_style['header_icon']; ?>"></i> 
										<?php echo $header_top_left_style['header_sub_title'] ?> </li>
							<?php endforeach; ?>
						
							<?php endif; ?>									
								</ul>
							</div>
							<div class="right floatright">
								<ul>
									<li>										
										<?php if($enable_search != false) :	
										 get_search_form();
										endif;
										  ?>				
									</li>
									<li>
										<i class="fa fa-user"></i> 
										<a href="<?php echo cs_get_option('header_right_link');?>">Account</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div> 								
			 <div id="sticky-menu" class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 header-bottom-bg">
							<div class="logo floatleft">
								<?php
									get_template_part( 'template-parts/headers/logo');
								?>
							</div>
							<div class="mainmenu text-center floatleft">
								<nav>
										
										<?php
								           wp_nav_menu( array(
								                'menu'              => 'primary',
								                'theme_location'    => 'header_menu',
								                'depth'             => 3,
								                'container'         => 'ul',
								                'container_class'   => '',
								                'menu_class'        => '',
								                'menu_id'        	=> '',
								                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								                'walker'            => new wp_bootstrap_navwalker())
								            );
								        ?>								
								</nav>
							</div>
							<!-- mobile menu start -->
							<div class="mobile-menu-area">
								<div class="mobile-menu">
									<nav id="dropdown">
										<?php
								           wp_nav_menu( array(
								                'menu'              => 'primary',
								                'theme_location'    => 'header_menu',
								                'depth'             => 3,
								                'container'         => 'ul',
								                'container_class'   => '',
								                'menu_class'        => 'mainmenu',
								                'menu_id'        	=> '',
								                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								                'walker'            => new wp_bootstrap_navwalker())
								            );
								        ?>
									</nav>
								</div>
							</div>
							<!-- mobile menu end -->
							<div class="cart-menu-area floatright">
								<ul>
									<li>
										<a href="<?php echo wc_get_cart_url(); ?>"><i class="pe-7s-shopbag"></i> <span><?php echo sprintf ( WC()->cart->get_cart_contents_count() ); ?></span></a>
										<ul class="cart-menu">
											<li>												
												<div class="cart-menu-title">
													<a href="<?php echo wc_get_cart_url(); ?>"><h5><?php _e( 'View your shopping cart' ); ?> </h5></a>
													<span><?php echo WC()->cart->get_cart_total(); ?></span>
												</div>												
											</li>				
											
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>									
	</header>
    <!-- header section end -->