<?php
get_header();

// get featured image
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<main>
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('<?php echo esc_url($featured_image); ?>');">
        <div class="scroll-icon">
            <a href="#categories">
                <img src="path-to-scroll-icon.png" alt="Scroll Down">
            </a>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories">
        <div class="container">
            <h2>Product Categories</h2>
            <div class="categories-wrapper">
                <?php
                // Obtener las categorías específicas por slug
                $categories = get_terms( array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'slug' => array( 'exclusivesamplers', 'cigars', 'recentlyadded' ),
                ) );

                foreach ( $categories as $category ) {
                    $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                    $image_url = wp_get_attachment_url( $thumbnail_id );
                    ?>
                    <div class="category-item">
                        <h3><?php echo esc_html( $category->name ); ?></h3>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="shop-button-container">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="shop-button">
                    Shop Cigars
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>
