<div class="shop-container">

    <!-- Productos (75%) -->
    <div class="products-area home">
        <?php
        // Establecer los parámetros de la consulta para obtener productos en stock
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 12, // Obtener 12 productos por página
            'post_status'    => 'publish',
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Página actual
            'meta_query'     => array(
                array(
                    'key'     => '_stock_status',
                    'value'   => 'instock', // Solo productos en stock
                ),
            ),
        );

        // Crear una nueva instancia de WP_Query
        $query = new WP_Query($args);

        // Verificar si hay productos
        if ($query->have_posts()) {
            $total_products = $query->found_posts; // Total de productos encontrados

            // Calcular el rango de productos que se están mostrando
            $start = ($query->query_vars['paged'] - 1) * $query->query_vars['posts_per_page'] + 1;
            $end = min($start + $query->query_vars['posts_per_page'] - 1, $total_products);

            // Muestra el número de resultados y el selector de ordenación
            echo '<div class="results-and-sorting" style="display: flex; justify-content: space-between; margin-bottom: 30px;">';
            echo '<div class="result-count">Showing ' . $start . '-' . $end . ' of ' . $total_products . ' results</div>';
            echo '<div class="contenedor">';
            echo '<div class="sorting-selector">' . woocommerce_catalog_ordering() . '</div>';
            echo '</div>';
            echo '</div>';

            woocommerce_product_loop_start();

            // Mostrar los productos
            while ($query->have_posts()) {
                $query->the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');

                // Muestra el producto
                wc_get_template_part('content', 'product');
            }

            woocommerce_product_loop_end();

            // Paginación
            $big = 999999999; // Número único para la paginación
            echo '<div class="woocommerce-pagination">';
            echo paginate_links(array(
                'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'  => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total'   => $query->max_num_pages,
            ));
            echo '</div>';

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

        // Restablecer la consulta
        wp_reset_postdata();
        ?>
    </div>

    <!-- Sidebar (25%) -->
    <div class="sidebar-area">
        <!-- Sidebar with Filters -->
        <div class="filter-price">
            <?php the_widget('WC_Widget_Price_Filter'); ?>
        </div>

        <!-- Cart Items -->
        <div class="cart-summary box-card-filter">
            <?php the_widget('WC_Widget_Cart'); ?>
        </div>

        <!-- Product Search -->
        <div class="product-search box-card-filter">
            <span>Search by products</span>
            <?php get_product_search_form(); ?>
        </div>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>
