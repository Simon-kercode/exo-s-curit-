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
                <label for="cercleLinked">Example select</label>
                <select class="form-control" name="pseudo" id="cercleLinked">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>   
            <div class="form-group">
                <label for="inviteContent">Example textarea</label>
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
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title"><span class="invitCard">'.htmlspecialchars($db1['pseudoAccount']).'</span> vous invite à rejoindre le Cercle : <span class="invitCard">'.htmlspecialchars($db1['nameCircle']).'</span> </h4>
                            <p class="card-text">'.htmlspecialchars($db1['contentInvitation']).'
                                <hr>
                                '.htmlspecialchars($db1['dateInvitation']).'
                                <a href="#" class="btn btn-danger float-right invit">Refuser</a>
                                <a href="#" class="btn btn-success float-right invit">Accepter</a>
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