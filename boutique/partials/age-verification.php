<?php
$logo = get_field('logo', 2032);

if (!$logo) {
    $print = '<img src="' . get_stylesheet_directory_uri() . '/images/logo.png" alt="Logo">';
} else {
    $print = '<img src="' . $logo['url'] . '" alt="' . $logo['alt'] . '">';
}
?>
<div id="age-verification">
    <div class="logo">
        <?php echo $print; ?>
    </div>
    <div class="age-form">
        <p class="warning">MUST BE 21 YEARS OR OLDER TO VIEW THIS PAGE.</p>
        <form id="age-verification-form">
            <div class="campos">
                <!-- Mes -->
                <input type="number" placeholder="MM" id="month" min="1" max="12" maxlength="2" required><br><br>
                
                <!-- Día -->
                <input type="number" placeholder="DD" id="day" min="1" max="31" maxlength="2" required><br><br>
                
                <!-- Año -->
                <input type="number" placeholder="YYYY" id="year" min="1900" max="<?php echo date('Y'); ?>" maxlength="4" required><br><br>
            </div>

            <button type="submit" id="submit-age" disabled>ENTER</button>
        </form>
    </div>
</div>
