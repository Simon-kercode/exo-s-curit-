<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Inscription"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Inscription</h1>
    <hr>
    <p class="mb-0">Créez votre compte ici !</p>
</div>

<!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<form action="index.php?action=inscription&db=ok" id="inscriptionForm" method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo*</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre Pseudo">
    </div>    
    <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Votre Email">
        <small id="emailHelp" class="form-text text-muted">Votre email restera confidentiel</small>
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe*</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Votre Mot de Passe">
        <small id="password" class="form-text text-muted">Votre mot de passe doit comporter au minimum: 8 charactères, 1 chiffre, 1 minuscule, 1 majuscule</small>
    </div>
    <div class="form-group">
        <label for="passwordComp">Retapez votre Mot de Passe*</label>
        <input type="password" class="form-control" name="passwordComp" id="passwordComp" placeholder="Retapez Votre Mot de Passe">
    </div>
    <div class="form-check" id="checkBot" >
        <input type="checkbox" class="form-check-input" name="checkHuman" id="checkHuman" value="ok">
        <label class="form-check-label" for="checkHuman">Je ne suis pas un robot</label>
    </div>
    <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
</form>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>