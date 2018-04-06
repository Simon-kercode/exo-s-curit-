<!DOCTYPE html>
<?php $title = "Flux RSS Manager, Faites votre veille en réseau!"; ?>
<?php ob_start(); ?>

<!-- Welcome message +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="alert alert-success" role="alert">
    <h1 class="alert-heading">Well done!</h1>
    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
    <hr>
    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>

<!-- Button trigger modal ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<button type="button" class="btn btn-primary col-12" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Jumbotron Chat ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="jumbotron">
    <h1 class="display-4">Hello, world!</h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');    
?>