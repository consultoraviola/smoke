<?php

/**
 * The template for displaying all pages with only entry-header and entry-content.
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		while (have_posts()) :
			the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Mostrar solo el encabezado de la entrada -->
				<header class="entry-header">
					<?php
					// Mostrar el título de la página
					the_title('<h1 class="entry-title">', '</h1>');
					?>
				</header><!-- .entry-header -->

				<!-- abecedario -->
				<div class="alphabet">
					<div class="container">
						<?php
						// Generar el abecedario con enlaces
						$alphabet = range('A', 'Z');
						foreach ($alphabet as $letter) {
							echo '<a href="#letter-' . $letter . '">' . $letter . '</a> ';
						}
						?>
					</div>
				</div>

				<!-- Mostrar solo el contenido de la entrada -->
				<div class="entry-content alphabet">
					<?php
					// Obtener el contenido de la página
					$content = get_the_content();

					// Buscar y añadir ID a cada marca <mark> correspondiente a la letra
					$content_with_ids = preg_replace_callback(
						'/<mark[^>]*>([A-Z])<\/mark>/i',
						function ($matches) {
							$letter = strtoupper($matches[1]);
							return '<mark id="letter-' . $letter . '" style="background-color:#fcb900" class="has-inline-color has-vivid-red-color">' . $letter . '</mark>';
						},
						$content
					);

					// Mostrar el contenido con los IDs añadidos
					echo $content_with_ids;
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
		<?php
		endwhile; // Fin del loop.
		?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
do_action('storefront_sidebar');
get_footer();
?>
