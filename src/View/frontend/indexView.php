<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Faites votre veille en réseau!"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Flux RSS Manager</h1>
    <p>Le premier réseau social de veille partagé...</p>
    <hr>
    <p class="mb-0">Gérrez &amp; Partagez vos Flux RSS!</p>
</div>

<!-- Button trigger modal ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<button type="button" class="btn btn-info col-12" data-toggle="modal" data-target="#exampleModalLong">Flux RSS du jour: <?= htmlspecialchars($url); ?></button>

<!-- Modal +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= htmlspecialchars($url); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Flux RSS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <div class="modal-body">
                <?php
                    echo '<ul>';
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
                    echo '</ul>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Savegarder Le flux</button>
            </div>
        </div>
    </div>
</div>

<!-- Card ChatBox +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="card chatBox content">
    <h2 class="card-header">ChatBox :</h2>
    <div class="card-body scroll">
        <h5 class="card-title">Venez discutez du Flux RSS du jours!</h5>
        <hr class="my-4" >
        <!-- Card Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->        
        <div id="articles"></div>       
    </div> 
    <!-- Collapse Chat Form ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <?php    
        if (isset($_SESSION['rssManagerId'])) {  
            echo    
                '<a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Ecrire dans le Chat</a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="index.php?action=chat&db=ok" id="chatForm" method="post">
                            <div class="form-group">
                                <label for="chatContent">Votre message</label>
                                <textarea class="form-control" id="chatContent" name="chatContent" rows="3"></textarea>
                                <button type="submit" class="btn btn-info">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>';
        }
    ?>   
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>