<?php
// Footer personalizado con menú
?>
<footer id="site-footer">
    <div class="footer-container">
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
        <!-- Sección de Copyright -->
        <div class="footer-copyright">
            <p>&copy; <?php echo date('Y'); ?> Your Website Name. All Rights Reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
