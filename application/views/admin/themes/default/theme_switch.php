<?php if(isset($env)) { show_filename($env, __FILE__); } ?>
<?php
/*
 * Pasek do zmiany motywu kolorów panelu administracyjnego
 */
?>
<div id="theme-switch" class="themes">
    <div class="colors">
        <h3>Motyw jasny / ciemny</h3>
        <ul class="theme-colors">
            <li class="light" data-theme-colors="light"></li>
            <li class="dark" data-theme-colors="dark"></li>
        </ul>

        <h3>Kolorystyka</h3>
        <ul class="accent-colors">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>

    </div>
    <p class="themes-btn"><i class="fas fa-cog fa-2x fa-spin"></i></p>
</div>