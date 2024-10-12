<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>

<div class="woocommerce-products-header">
	<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action('woocommerce_archive_description');
	?>
</div>

<div class="shop-container" style="display: flex; margin-top: 3rem">

	<!-- Productos (75%) -->
	<div class="products-area" style="flex: 75%; padding: 0 3rem;">
		<?php
		if (woocommerce_product_loop()) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 */
			// do_action( 'woocommerce_before_shop_loop' );

			// Cantidad total de productos
			$total_products = wc_get_loop_prop('total');

			// Obtener la paginación
			$current_page = max(1, get_query_var('paged')); // Página actual
			$per_page = 12; // Productos por página
			$offset = ($current_page - 1) * $per_page; // Calcular el offset

			// Calcular el rango de productos que se están mostrando
			$start = $offset + 1;
			$end = min($offset + $per_page, $total_products);

			// Muestra el número de resultados y el selector de ordenación
			echo '<div class="results-and-sorting" style="display: flex; justify-content: space-between; margin-bottom: 30px;">';
			// Mostrar la cantidad de resultados
			echo '<div class="result-count">Showing ' . $start . '-' . $end . ' of ' . $total_products . ' results</div>';

			echo '<div class="contenedor">';
			// Mostrar el selector de ordenación
			echo '<div class="sorting-selector">' . woocommerce_catalog_ordering() . '</div>';
			echo '</div>';
			echo '</div>';

			woocommerce_product_loop_start();

			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}
			}

			woocommerce_product_loop_end();

			//acá el paginador


			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}
		?>
	</div>

	<!-- Sidebar (25%) -->
	<div class="sidebar-area" style="flex: 25%; padding-left: 20px;">
		<?php if (is_active_sidebar('shop-sidebar')) : ?>
			<div class="widget-area">
				<?php dynamic_sidebar('shop-sidebar'); ?>
			</div>
		<?php else : ?>
			<aside class="widget">
				<h2 class="widget-title">Buscar Productos</h2>
				<?php get_product_search_form(); ?>
			</aside>
		<?php endif; ?>
	</div>

</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
