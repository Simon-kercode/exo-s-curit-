<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Admin"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Gestion des Signalements</h1>
    <hr>
    <p class="mb-0">Gérez les signalements envoyé par vos utilisateurs !</p>
</div>

<!-- Warnin Card ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <h2 class="card-header">Signalements :</h2>
    <div class="card-body scroll">
        <?php
            while($db1 = $request->fetch()) {
                echo '    
                    <div class="card cardWarning">
                        <div class="card-header">
                            <a class="navbar-brand">
                                <img width="30" height="30" alt="Avatar" src="src/Public/images/'.htmlspecialchars($db1['avatarAccount']).'" />
                                <p>'.htmlspecialchars($db1['pseudoAccount']).'</p>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">'.htmlspecialchars($db1['emailAccount']).'</h5>
                            <h6 class="card-text">'.htmlspecialchars($db1['statusAccount']).'</h6>
                            <hr>
                            <p>A été signalé: <span class="warning">'.htmlspecialchars($db1['warningAccount']).'</span> fois !</p>
                            <a href="index.php?action=resetCountWarning&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-primary">RàZ du compteur</a>
                            <a href="index.php?action=targetCommentSupress&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-warning">Suprimer tous ses commentaires et chats</a>
                            <a href="index.php?action=bann&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-danger">Bannir le compte</a>
                        </div>
                    </div>
                ';
            }
        ?>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>