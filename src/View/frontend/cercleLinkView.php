<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Cercle de Veilles"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading"><?=htmlspecialchars($result['nameCircle'])?></h1>
    <hr>
    <p class="mb-0">Partagez votre Veille</p>
</div>

<!-- Card Columns +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <div class="card-body scroll">    
        <div class="card-columns">
            <?php
                while ($db1 = $request->fetch()) {    
                    $rss = simplexml_load_file($db1['urlRss']);
                    foreach ($rss->channel->item as $item) {
                        $datetime = date_create($item->pubDate);
                        $date = date_format($datetime, 'd M Y, H\hi');
                        echo '    
                            <div class="card">
                                <div class="card-header">'
                                    .htmlspecialchars($db1['nameRssCategory']).' : '.htmlspecialchars($db1['nameRss']).
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
    <a href="index.php?action=leaveCercle&idCircleLink=<?=htmlspecialchars($_GET['idCircleLink'])?>" type="button" class="btn btn-danger">Quitter le cercle</a>
</div>

<!-- Card CommentBox +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <h2 class="card-header">CommentBox :</h2>
    <div class="card-body scroll">
        <h5 class="card-title">Venez discuter de vos veilles!</h5>
        <hr class="my-4" >
        <!-- card +++++++++++++++++++++++++++++++++++++++++++ -->
        <?php    
            while($db2 = $requestFirst->fetch()) {
                echo '    
                    <div class="card cardComment">
                        <div class="card-header">
                            <a class="navbar-brand">
                                <img width="30" height="30" alt="" src="src/Public/images/'. $db2['avatarAccount'] . '" alt="Avatar" />
                                <p>'.htmlspecialchars($db2['pseudoAccount']).'</p>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">'.htmlspecialchars($db2['contentComment']).'</h5>
                        </div>
                        <div class="card-footer text-muted">'
                            .htmlspecialchars($db2['dateComment']).
                        '</div>
                    </div>
                ';
            }
        ?>
    </div>
    <!-- Collapse Chat Form ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <?php    
        if (isset($_SESSION['rssManagerId'])) {  
            echo '   
                <a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Ecrire dans le Chat</a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="index.php?action=comment&idCircleLink='.htmlspecialchars($result['idCercleLink']).'" id="chatForm" method="post">
                            <div class="form-group">
                                <label for="commentContent">Votre message</label>
                                <textarea class="form-control" id="commentContent" name="commentContent" rows="3"></textarea>
                                <button type="submit" class="btn btn-info">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            ';
        }
    ?>   
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>