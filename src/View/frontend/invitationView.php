<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Invitation"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Invitation</h1>
    <hr>
    <p class="mb-0">Gérez vos invitation aux Cercles de Veilles ici !</p>
</div>

<!-- Collapse ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<p>
    <a class="btn btn-info col-12" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Inviter un Nouveau Membre
    </a>
</p>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <form action="index.php?action=invitation&db=ok" id="inscriptionForm" method="post">
            <div class="form-group">
                <label for="nameCercleLink">Pseudo à Inviter</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
            <div class="form-group">
                <label for="cercleLinked">Cercle à Sélectionner</label>
                <select class="form-control" name="cercleLinked" id="cercleLinked">
                    <?php
                        while ($db2 = $requestSecond->fetch()) {
                            echo'
                                <option>'.htmlspecialchars($db2['nameCircle']).'</option>
                            ';
                        }
                    ?>
                </select>
            </div>   
            <div class="form-group">
                <label for="inviteContent">Message d'Invitation</label>
                <textarea class="form-control" name="invitContent" id="invitContent" rows="3"></textarea>
            </div> 
            <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
        </form>
    </div>
</div>

<!-- Invitation Scroll +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <div class="card-body scroll">
        <?php
            while ($db1 = $request->fetch()) {
                echo '
                    <div class="card border-primary invitCard">
                        <div class="card-body">
                            <h4 class="card-title"><span class="invitCardText">'.htmlspecialchars($db1['pseudoAccount']).'</span> vous invite à rejoindre le Cercle : <span class="invitCardText">'.htmlspecialchars($db1['nameCircle']).'</span> </h4>
                            <p class="card-text">'.htmlspecialchars($db1['contentInvitation']).'
                                <hr>
                                '.htmlspecialchars($db1['dateInvitation']).'
                                <a href="index.php?action=invitationRefuse&idInvitation='.htmlspecialchars($db1['idInvitation']).'" class="btn btn-danger float-right invit">Refuser</a>
                                <a href="index.php?action=invitationAccept&idCircleLink='.htmlspecialchars($db1['idCercleLink']).'&idInvitation='.htmlspecialchars($db1['idInvitation']).'" class="btn btn-success float-right invit">Accepter</a>
                            </p>                
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