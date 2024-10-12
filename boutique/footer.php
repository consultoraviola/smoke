<?php
$logo = get_field('logo', post_id: 'option');
$rrss = get_field('social_media', 'option');
$facebook = $rrss['facebook'];
$instagram = $rrss['instagram'];
$twitter = $rrss['x'];
$rumble = $rrss['rumble'];
$number = get_field('number', 'option');
$number_text = get_field('number_visual_text', 'option');
$mail = get_field('mail', 'option');
?>
<footer id="site-footer">
    <div class="footer-container">

        <!-- Sección Logo e Información de Contacto -->
        <div class="footer-info">
            <div class="footer-logo">
                <img src="<?php echo $logo['url']; ?>" alt="Logo"> <!-- Reemplaza con la ruta correcta del logo -->
            </div>

            <!-- Sección Redes Sociales -->
            <div class="footer-social" id="footer-rrss">
                <h4>Social Links</h4>
                <div class="social-icons">
                    <a href="<?php echo $rumble; ?>" class="icon-rumble"></a>
                    <a href="<?php echo $facebook; ?>" class="icon-facebook"></a>
                    <a href="<?php echo $instagram; ?>" class="icon-instagram"></a>
                    <a href="<?php echo $twitter; ?>" class="icon-twitter"></a>
                </div>
            </div>
        </div>

        <!-- Sección del Menú -->
        <nav class="footer-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'footer-menu', // Clase CSS para estilos personalizados
            ));
            ?>
        </nav>


        <div class="footer-contact">
            <h4 class="title-icon">Contact Us</h4>

            <div class="phone">
                <span>TEXT OR CALL</span>
                <a href="tel:<?php echo $number; ?>"><?php echo $number_text; ?></a>
            </div>
            <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a>
        </div>



        <!-- Sección de Copyright -->
        <div class="footer-copyright">
            <p>Copyright &copy; <?php echo date('Y'); ?> Smokio. All rights reserved.</p>
        </div>

    </div>
</footer>
<?php wp_footer(); ?>