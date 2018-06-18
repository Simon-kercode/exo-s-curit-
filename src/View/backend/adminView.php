<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Admin"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Admin Panel</h1>
    <hr>
    <p class="mb-0">Gérez le site RSS Manager !</p>
</div>

<!-- Jumbotron +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="jumbotron">
    <h2 class="display-4">Comptes signalés</h2>
    <p class="lead">Nombre de comptes signalés: <span class="warning"><?=htmlspecialchars($resultSeconde[0])?></span> !</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="index.php?action=warningBack" role="button">Gérer les Signalements!</a>
</div>
<div class="jumbotron">
    <h2 class="display-4">Comptes exitants</h2>
    <p class="lead">Nombre de comptes existants: <span class="warning"><?=htmlspecialchars($result[0])?></span> !</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="index.php?action=accountBack&page=1" role="button">Gérer les Comptes</a>
</div>
<div class="jumbotron">
    <h2 class="display-4">RSS du Moment</h2>
    <p class="lead"><span class="warning"><?=htmlspecialchars($resultFirst['nameRss'])."</span> ".htmlspecialchars($resultFirst['urlRss'])?></p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="index.php?action=rssLightView" role="button">Changer le RSS</a>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>