<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<?php
$featured_items = get_field('featured_products', $post->ID);
$best_sellers = $featured_items['best_sellers'];
$title = $featured_items['title'];
if ($best_sellers): ?>
    <div class="best-seller">
        <div class="container">
            <h2 class="title-icon"><?php echo $title; ?></h2>
        </div>

        <div class="swiper-container best-sellers-slider">
            <div class="swiper-wrapper">
                <?php foreach ($best_sellers as $post): // Loop through the best sellers 
                ?>
                    <?php setup_postdata($post); ?>

                    <div class="swiper-slide">
                        <div class="product-item">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo wc_get_template_part('content', 'product'); // Mostrar detalles del producto 
                                ?>
                            </a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <div class="controles">
                <!-- Añadir los controles de Swiper -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.best-sellers-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    640: {
                        slidesPerView: 1,
                    },
                }
            });
        });
    </script>

    <?php wp_reset_postdata(); // Reset the post data 
    ?>
<?php endif; ?>