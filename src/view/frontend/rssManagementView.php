<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Gestion RSS"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Gestion RSS</h1>
    <hr>
    <p class="mb-0">Gérez, Visualisez &amp; Partagez vos Flux RSS!</p>
</div>

<!-- Collapse +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<p>
    <a class="btn btn-info" data-toggle="collapse" href="#allRss" role="button" aria-expanded="false" aria-controls="collapseExample">
        Tous les RSS
    </a>
    <a class="btn btn-info" data-toggle="collapse" href="#categoryRss" role="button" aria-expanded="false" aria-controls="collapseExample">
        RSS par Catégories
    </a>
    <a class="btn btn-info" data-toggle="collapse" href="#cercleLink" role="button" aria-expanded="false" aria-controls="collapseExample">
        Cercles de Veille
    </a>
</p>
<!-- Section "Tous les RSS" +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="collapse" id="allRss"> 
    <div class="card card-body">
        <h5>Tout les RSS</h5>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdRss">
            Ajouter un Flux Rss
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="modelIdRss" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Ajouter un Flux RSS</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <form action="index.php?action=rssInsert&db=ok" id="inscriptionForm" method="post">
                            <div class="form-group">
                                <label for="urlRss">URL du Flux RSS*</label>
                                <input type="text" class="form-control" name="urlRss" id="urlRss" placeholder="RSS URL">
                            </div>    
                            <div class="form-group">
                                <label for="nameRss">Nom du Flux RSS*</label>
                                <input type="text" class="form-control" name="nameRss" id="nameRss" placeholder="RSS Nom">
                            </div>
                            <div class="form-group">
                                <label for="categorySelect">Catégories</label>
                                <select class="form-control" name ="categorySelect" id="categorySelect">
                                    <option>Choisir la catégorie</option>
                                    <?php
                                        while ($db5 = $requestFourth->fetch()) {
                                            echo '<option>'.htmlspecialchars($db5['nameRssCategory']).'</option>';
                                        }
                                    ?>
                                </select>
                                <small id="categorySelect" class="form-text text-muted">Attention! Si vou n'avez pas encore créer de Catégorie vous devez le faire avant d'ajouter un Flux RSS</small>
                            </div>
                            <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            while ($db1 = $requestFirst->fetch()) {
                echo '
                    <hr>
                    <button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#'.htmlspecialchars($db1['nameRss']).'">'.htmlspecialchars($db1['nameRss']).'</button>
                    
                    <div class="modal fade" id="'.htmlspecialchars($db1['nameRss']).'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">'.htmlspecialchars($db1['nameRss']).'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    
                                    <ul>';
                                        $rss = simplexml_load_file($db1['urlRss']);
                                        foreach ($rss->channel->item as $item) {
                                            $datetime = date_create($item->pubDate);
                                            $date = date_format($datetime, 'd M Y, H\hi');
                                            echo '<li>';
                                                if($item->category) {
                                                    echo $item->category.' : ';
                                                }
                                                echo '<a href="'.$item->link.'">'.$item->title.'</a> ('.$date.')'
                                                .$item->description;
                                            echo '</li>';
                                        }
                                    echo '</ul>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="index.php?action=supressRss&idRss='.htmlspecialchars($db1['idRss']).'" type="button" class="btn btn-danger">Suprimer le RSS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                ';
            }
        ?>
    </div>
</div>
<!-- Section "RSS par Catégorie" ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="collapse" id="categoryRss">
    <div class="card card-body">
        <h5>RSS par Catégories</h5>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdCategory">
            Ajouter une Nouvelle Catégorie
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="modelIdCategory" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Ajouter une Nouvelle Catégorie</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <form action="index.php?action=categoryRss&db=ok" id="inscriptionForm" method="post">
                            <div class="form-group">
                                <label for="nameRssCategory">Nom de la Catégorie*</label>
                                <input type="text" class="form-control" name="nameRssCategory" id="nameRssCategory" placeholder="Nom Catégorie">
                            </div>    
                            <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            while ($db2 = $request->fetch()) {
                echo '
                    <hr>
                    <a type="button" class="btn btn-info col-12" href="index.php?action=categoryRssView&idCategoryRss='.htmlspecialchars($db2['idRssCategory']).'">'.htmlspecialchars($db2['nameRssCategory']).'</a>                    
                ';
            }
        ?>
    </div>
</div>
<!-- Section "Cercle de Veille" ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="collapse" id="cercleLink">
    <div class="card card-body">
    <h5>Cercle de Veille</h5>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdCercle">
            Ajouter un Nouveau Cercle de Veille
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="modelIdCercle" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Ajouter un Nouveau Cercle de Veille</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <!-- Inscription Forms ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <form action="index.php?action=cercleLink&db=ok" id="inscriptionForm" method="post">
                            <div class="form-group">
                                <label for="nameCercleLink">Nom du Cercle*</label>
                                <input type="text" class="form-control" name="nameCercleLink" id="nameCercleLink" placeholder="Nom du Cercle">
                            </div>    
                            <button type="submit" class="btn btn-info btn-validation col-12">Envoyer</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            while ($db3 = $requestSecond->fetch()) {
                echo '
                    <hr>
                    <a type="button" class="btn btn-info col-12" href="index.php?action=circleLink&idCircleLink='.htmlspecialchars($db3['idCercleLink']).'">'.htmlspecialchars($db3['nameCircle']).'</a>                    
                ';
            }
        ?>
    </div>
</div>

<!-- Card Columns +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <div class="card-body scroll">    
        <div class="card-columns">
            <?php
                while ($db4 = $requestThird->fetch()) {    
                    $rss = simplexml_load_file($db4['urlRss']);
                    foreach ($rss->channel->item as $item) {
                        $datetime = date_create($item->pubDate);
                        $date = date_format($datetime, 'd M Y, H\hi');
                        echo '    
                            <div class="card">
                                <div class="card-header">'
                                    .htmlspecialchars($db4['nameRssCategory']).' : '.htmlspecialchars($db4['nameRss']).
                                '</div>
                                <div class="card-body">
                                    <h4 class="card-title">';
                                        if($item->category) {
                                            echo $item->category.' : ';
                                        }
                                        echo '<a href="'.$item->link.'">'.$item->title.'</a>
                                    </h4>
                                    <p class="card-text">'.$item->description.'</p>
                                </div>
                                <div class="card-footer text-muted">
                                    '.$date.'
                                </div>
                            </div>
                        ';
                    }
                    
                }
            ?>
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>