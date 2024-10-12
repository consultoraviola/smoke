<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php get_template_part('partials/age-verification'); ?>

	<?php wp_body_open(); ?>

	<?php do_action('storefront_before_site'); ?>

	<div id="page" class="hfeed site">
		<?php do_action('storefront_before_header'); ?>

		<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
			<div class="logo-header">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo get_stylesheet_directory_uri() .  '/images/logo-header.png' ?>" alt="">
				</a>
			</div>

			<div class="hamburger-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<nav class="primary-navigation">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary_menu',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu',
				));
				?>
			</nav>

			<div class="is-flex">
				<div class="contact-info">
					<a href="mailto:Orders@Shouldismokethis.com">Orders@Shouldismokethis.com</a>
					<div class="phone">
						<a href="tel:+19734774160">+1 (973) 477-4160</a>
						<span>TEXT OR CALL</span>
					</div>
				</div>

				<div class="is-flex margin-20">
					<div class="cart-logo">
						<a href="<?php echo wc_get_cart_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/cart.png'; ?>" alt="">
							<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
						</a>
					</div>

					<div class="account-logo">
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<img src="<?php echo get_stylesheet_directory_uri() . '/images/account.png'; ?>" alt="">
						</a>
					</div>
				</div>

				<div class="button-social-media">
					<a href="#footer-rrss">SOCIAL MEDIA</a>
				</div>
			</div>
		</header><!-- #masthead -->
