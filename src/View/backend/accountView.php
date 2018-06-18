<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Admin"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Gestion de Compte</h1>
    <hr>
    <p class="mb-0">Gérez les Comptes enregistrées sur le site RSS Manager !</p>
</div>

<!-- Account Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <h2 class="card-header">Comptes :</h2>
    <div class="card-body scroll">
        <?php
            while($db1 = $request->fetch()) {
                echo '    
                    <div class="card cardWarning cardAccount">';
                    if($db1['statusAccount'] === 'Admin') {
                        echo '<div class="card-header admin">';
                    }
                    elseif($db1['statusAccount'] === 'User') {
                        echo '<div class="card-header user">';
                    }
                    else {
                        echo '<div class="card-header bann">';
                    }    
                echo '        
                            <a class="navbar-brand">
                                <img width="30" height="30" alt="Avatar" src="src/Public/images/'.htmlspecialchars($db1['avatarAccount']).'" />
                                <p>'.htmlspecialchars($db1['pseudoAccount']).'</p>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">'.htmlspecialchars($db1['emailAccount']).'</h5>
                            <h6 class="card-text">'.htmlspecialchars($db1['statusAccount']).'</h6>
                            <hr>
                            <p>A été signalé: <span class="warning">'.htmlspecialchars($db1['warningAccount']).'</span> fois !</p>';
                            if($db1['statusAccount'] === 'Admin') {
                                echo '
                                    <a href="index.php?action=adminToUser&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-warning">Rétrograder le niveau d\'administration</a>
                                ';
                            }
                            elseif($db1['statusAccount'] === 'User') {
                                echo '
                                    <a href="index.php?action=userToAdmin&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-info">Promouvoir en Administrateur</a>
                                    <a href="index.php?action=bann&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-danger">Bannir le compte</a>
                                ';
                            }
                            else {
                                echo '
                                    <a href="index.php?action=bannToUser&idAccount='.htmlspecialchars($db1['idAccount']).'" class="btn btn-success">Promouvoir en Utilisateur</a>
                                ';
                            }                            
                echo '
                        </div>
                    </div>
                ';
            }
        ?>
    </div>
</div>

<!-- Pagination ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<nav aria-label="Page navigation example col-12">
    <ul class="pagination">
        <?php       
            if($_GET['page']!=1) {
                echo '<li class="page-item"><a class="page-link" href="index.php?action=accountBack&page='.htmlspecialchars($_GET['page']-1).'">Précédant</a></li>';
            }
            
            for ($i = 1 ; $i <= $numberPage ; $i++) {
                echo '<li class="page-item"><a class="page-link" href="index.php?action=accountBack&page='.htmlspecialchars($i).'">' . htmlspecialchars($i) . '</a></li>';
            }

            if($_GET['page']!=$numberPage) {
                echo '<li class="page-item"><a class="page-link" href="index.php?action=accountBack&page='.htmlspecialchars($_GET['page']+1).'">Suivant</a></li>';
            }
            
        ?>        
    </ul>
</nav>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>