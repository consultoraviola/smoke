<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>

<div class="entry-header">
	<div class="container">
		<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>
	</div>
</div>

<div class="container">
	<?php
	// breadcrumb links
	woocommerce_breadcrumb();
	?>
	<?php while (have_posts()) : ?>
		<?php the_post(); ?>

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

			<!-- Nueva sección que envuelve la galería de imágenes y el resumen del producto -->
			<div class="product-main-info">
				<?php
				// Galería de imágenes del producto
				do_action('woocommerce_before_single_product_summary'); // Contiene la galería de imágenes
				?>

				<div class="summary entry-summary">
					<!-- stars average of the reviws and the number of reviews if the product have reviews -->
					<div class="product-reviews-summary">
						<?php
						// Obtén el número de reseñas y la calificación promedio
						$average = $product->get_average_rating(); // Calificación promedio
						$review_count = $product->get_review_count(); // Número de reseñas

						if ($review_count > 0) : // Solo mostrar si hay reseñas
							// Mostrar estrellas promedio
							echo wc_get_rating_html($average, $review_count); // Mostrar las estrellas basadas en el promedio
							// Mostrar el número de reseñas
							echo '<a href="#tab-title-reviews" class="review-count">' . sprintf(__('%s reviews', 'woocommerce'), $review_count) . '</a>';
						endif;
						?>
					</div>

					<?php
					// Resumen del producto
					do_action('woocommerce_single_product_summary');
					?>
				</div>
			</div>

			<!-- Sección de tabs (descripción, reseñas, etc.) -->
			<?php
			// Descripción, reseñas, etc.
			do_action('woocommerce_after_single_product_summary');
			?>

			<!-- Sección de productos relacionados -->
			<div class="related-products">
				<?php
				// Productos relacionados
				do_action('woocommerce_output_related_products');
				?>
			</div>

		</div>

	<?php endwhile; // end of the loop. 
	?>
</div>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<?php
get_footer('shop');
?>