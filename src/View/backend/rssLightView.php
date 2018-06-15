<!DOCTYPE html>
<?php $title = "Flux RSS Manager, RSS du moment"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Gestion RSS du moment</h1>
    <hr>
    <p class="mb-0">Gérez le flux RSS du moment !</p>
</div>

<div class="card border-primary|secondary|success|danger|warning|info|light|dark|link">
    <img class="card-img-top" src="holder.js/100px180/" alt="">
    <div class="card-body">
        <h4 class="card-title warning"><?=htmlspecialchars($result['nameRss'])?></h4>
        <p class="card-text"><?=htmlspecialchars($result['urlRss'])?></p>
    </div>
</div>

<!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<form action="index.php?action=rssLight&db=ok" id="rssForm" method="post">
    <div class="form-group">
        <label for="rssLight">Nom du nouveau RSS du moment*</label>
        <input type="text" class="form-control" name="rssLight" id="rssLight" placeholder="Nom RSS">
    </div> 
    <div class="form-group">
        <label for="rssUrlLight">URL du nouveau RSS du moment*</label>
        <input type="text" class="form-control" name="rssUrlLight" id="rssUrlLight" placeholder="URL RSS">
    </div>   
    <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
</form>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>