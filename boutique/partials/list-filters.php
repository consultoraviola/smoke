<section id="products-section" class="products-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="product-list row">
                    <!-- Show 12 products per page with pagination -->
                    <?php
                    // Define the query arguments
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12, // 12 products per page
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // current page number
                    );

                    // Run the query
                    $loop = new WP_Query($args);

                    // Check if there are products to display
                    if ($loop->have_posts()) :
                        while ($loop->have_posts()) : $loop->the_post();
                    ?>
                            <!-- Bootstrap column classes for 3 products per row -->
                            <div class="col-md-4 col-sm-6">
                                <?php wc_get_template_part('content', 'product'); ?>
                            </div>
                    <?php
                        endwhile;

                        // Reset post data after loop
                        wp_reset_postdata();
                    else :
                        echo __('No products found');
                    endif;
                    ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    // Display pagination
                    woocommerce_pagination();
                    ?>
                </div>
            </div>


            <!-- Sidebar with Filters -->
            <div class="col-md-4">
                <!-- Price Filter -->
                <div class="filter-price">
                    <?php the_widget('WC_Widget_Price_Filter'); ?>
                </div>

                <!-- Cart Items -->
                <div class="cart-summary box-card-filter">
                    <?php the_widget('WC_Widget_Cart'); ?>
                </div>

                <!-- Average Rating Filter -->
                <div class="average-rating box-card-filter">
                    <?php the_widget('WC_Widget_Rating_Filter'); ?>
                </div>

                <!-- Product Search -->
                <div class="product-search box-card-filter">
                    <span>Search by products</span>
                    <?php get_product_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</section>