<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Catégories RSS"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert welcome" id="up" role="alert">
    <h1 class="alert-heading">Catégories RSS</h1>
    <hr>
    <p class="mb-0">Visualisez vos Flux RSS par Catégories!</p>
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
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>