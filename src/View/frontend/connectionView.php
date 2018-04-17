<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Inscription"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Connexion</h1>
    <hr>
    <p class="mb-0">Connectez vous !</p>
</div>

<!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<form action="index.php?action=connection&db=ok" id="inscriptionForm" method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo*</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre Pseudo">
    </div>    
    <div class="form-group">
        <label for="password">Mot de Passe*</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Votre Mot de Passe">
    </div>
    <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
</form>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>