<?php
/**
 * The template for displaying product content within loops.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit();

global $product;

// Asegurarse de que el producto es visible
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
    <div class="product-card">
        <!-- Imagen del producto -->
        <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
            <?php woocommerce_template_loop_product_thumbnail(); ?>
        </a>

        <!-- Título del producto -->
        <h2 class="woocommerce-loop-product__title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

		
        <!-- Precio del producto -->
        <?php woocommerce_template_loop_price(); ?>

        <!-- Calificación del producto -->
        <div class="product-rating">
            <?php if ( $rating_count = $product->get_rating_count() ) : ?>
                <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
            <?php endif; ?>
        </div>

        <!-- Botón para agregar al carrito -->
        <div class="add-to-cart">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>

        <!-- Campo personalizado o información adicional -->
        <div class="custom-product-info">
            <?php
            // Ejemplo de campo personalizado
            $custom_field_value = get_post_meta( get_the_ID(), '_custom_field_key', true );
            if ( $custom_field_value ) {
                echo '<p>' . esc_html( $custom_field_value ) . '</p>';
            }
            ?>
        </div>
    </div>
</li>
