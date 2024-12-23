<?php
/**
 * Boutique engine room
 *
 * @package boutique
 */

/**
 * Set the theme version number as a global variable
 */
$theme				= wp_get_theme( 'boutique' );
$boutique_version	= $theme['Version'];

$theme				= wp_get_theme( 'storefront' );
$storefront_version	= $theme['Version'];

/**
 * Load the individual classes required by this theme
 */
require_once( 'inc/class-boutique.php' );
require_once( 'inc/class-boutique-customizer.php' );
require_once( 'inc/class-boutique-template.php' );
require_once( 'inc/class-boutique-integrations.php' );

/**
 * Do not add custom code / snippets here.
 * While Child Themes are generally recommended for customisations, in this case it is not
 * wise. Modifying this file means that your changes will be lost when an automatic update
 * of this theme is performed. Instead, add your customisations to a plugin such as
 * https://github.com/woothemes/theme-customisations
 */

/** Custom Note on Checkout - By WooAssist  **/

add_action('woocommerce_review_order_before_payment','wooassist_custom_note');

function wooassist_custom_note() {

echo 'NOTE: A 3% credit card processing fee may be charged by the payment processor for your order. (Credit cards only - no fee for debit cards)'; //You put your own note here between the  

}

function my_acf_add_options_to_theme_page( $value ) {
    // Verifica si estamos en la página de opciones personalizada
    if (isset($_GET['page']) && $_GET['page'] === 'theme-options') {
        acf_form_head(); // Esto habilita el soporte de ACF para esta página
    }
}
add_action('admin_head', 'my_acf_add_options_to_theme_page');


function register_primary_menu() {
    register_nav_menus( array(
        'primary_menu' => __( 'Primary Menu', 'boutique' ),
    ));
}
add_action( 'after_setup_theme', 'register_primary_menu' );

function add_age_verification_script() {
    wp_enqueue_script('age-verification', get_stylesheet_directory_uri() . '/js/age-verification.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'add_age_verification_script');


if (function_exists('acf_add_options_page')) {
    $opciones_charquican =  acf_add_options_page(
        array(
            'page_title' => 'Opciones del sitio',
            'menu_title' => 'Opciones del sitio',
            'menu_slug' => 'options_site',
            'capability' => 'edit_posts',
            'position' => false,
            'parent_slug' => '',
            'icon_url' => false,
            'redirect' => true,
            'post_id' => 'options',
            'autoload' => false,
            'icon_url' => 'dashicons-hammer',
        )
    );

    acf_add_options_sub_page(array(
        'menu_title'     => 'Opciones Generales',
        'page_title'     => 'Opciones Generales',
        'parent_slug'     => $opciones_charquican['menu_slug'],
    ));

}


function filter_products_by_price($query) {
    // Asegurarse de que estamos en la tienda o en la página de productos y no en la administración de WordPress
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        // Verifica si se ha enviado un rango de precios
        if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
            $min_price = sanitize_text_field($_GET['min_price']);
            $max_price = sanitize_text_field($_GET['max_price']);

            // Asegúrate de que los valores sean numéricos
            if (is_numeric($min_price) && is_numeric($max_price)) {
                // Ajustar la meta query para el filtro de precios
                $meta_query = array(
                    array(
                        'key' => '_price',
                        'value' => array($min_price, $max_price),
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    )
                );
                $query->set('meta_query', $meta_query);
            }
        }
    }
}
add_action('pre_get_posts', 'filter_products_by_price');
