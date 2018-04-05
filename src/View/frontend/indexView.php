<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Faites votre veille en réseau!"; ?>
<?php ob_start(); ?>

<!-- Title Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Hello World!</h1>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>