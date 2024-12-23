<?php
get_header();

// get featured image
$featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<main>
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('<?php echo esc_url($featured_image); ?>');">
        <!-- <span>SHOP CIGARS</span> -->
        <div class="scroll-icon">
            <a href="#categories"></a>
        </div>
    </section>

    <?php
    $module_information = get_field('module_information');
    $categorie_title = $module_information['title'];
    $categorie_uppertitle = $module_information['uppertitle'];
    $categorie_contenido = $module_information['description'];
    $categorie_link = $module_information['link'];

    if (have_rows('module_information')):
    ?>
        <!-- Categories Section -->
        <section id="categories" class="categories">
            <div class="container">

                <div class="row">
                    <div class="container-title">
                        <?php if (!empty($categorie_uppertitle)): ?>
                            <span class="upper-title"><?php echo $categorie_uppertitle; ?></span>
                        <?php endif; ?>
                        <h2 class="title"><?php echo $categorie_title; ?></h2>
                    </div>

                    <div class="container-content">
                        <p><?php echo $categorie_contenido; ?></p>
                        <?php if (!empty($categorie_link)): ?>
                            <a href="<?php echo $categorie_link['url']; ?>" target="<?php echo $categorie_link['target']; ?>"><?php echo $categorie_link['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories-cards" class="categories-cards">
            <div class="container">

                <div class="categories-wrapper">
                    <?php
                    // Obtener las categorías específicas por slug
                    $desired_order = array('cigars', 'exclusivesamplers', 'recentlyadded');

                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'slug' => $desired_order,
                    ));

                    // Reorganizar las categorías en el orden de $desired_order
                    usort($categories, function ($a, $b) use ($desired_order) {
                        $pos_a = array_search($a->slug, $desired_order);
                        $pos_b = array_search($b->slug, $desired_order);
                        return $pos_a - $pos_b;
                    });

                    // Mostrar las categorías en el orden correcto
                    foreach ($categories as $category) {
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = wp_get_attachment_url($thumbnail_id);
                        $category_link = get_term_link($category->term_id, 'product_cat'); // Link a la página de la categoría
                    ?>
                        <div class="category-item">
                            <!-- Enlazar título e imagen a la página de archivo de la categoría -->
                            <a href="<?php echo esc_url($category_link); ?>">
                                <h3><?php echo esc_html($category->name); ?></h3>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>


                <div class="shop-button-container">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="shop-button">
                        Shop All Cigars
                    </a>
                </div>
            </div>

        </section>
    <?php endif; ?>

    <?php

    // get_template_part('partials/best-sellers',  ['horizonte' => $best_seller] ); 
    get_template_part('partials/best-sellers');
    ?>
</main>

<?php
get_footer();
?>