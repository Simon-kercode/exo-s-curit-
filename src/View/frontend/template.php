<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>		
		<meta name="description" content="Flux RSS Manager, Faites votre veille en réseau!" />
		<meta name="keywords" content="flux, rss, manager, veille, reseau, social, francois, hugues, lamodiere" />
		<!-- Meta Facebook +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->        
        <meta property="og:title" content="Flux RSS Manager, Faites votre veille en réseau!" />
        <meta property="og:url" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <meta property="og:site_name" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <meta property="og:description" content="Le premier réseau de veille partagé!" />
        <meta property="og:image" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
		<!-- Meta Twitter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->             
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="Flux RSS Manager, Faites votre veille en réseau!" />
        <meta name="twitter:url" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <meta name="twitter:descritpion" content="Le premier réseau de veille partagé!" />
        <meta name="twitter:image" content="" /> <!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <!-- Stylesheet Bootstrap v4 ++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
        <!-- Stylesheet Google Font +++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link href="https://fonts.googleapis.com/css?family=Skranji" rel="stylesheet"> 
        <!-- Stylesheet +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link href="src/Public/css/style.css" rel="stylesheet" /> 
        <!-- Fav Icon +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link rel="icon" type="image/png" href="src/Public/images/logo.png" />

    </head>

        
    <!-- Template Content ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <body class="bodyFront container-fluid">
                
        <header class="sticky-top">
            <!-- Navbar ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">Flux RSS Manager</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <?php
                            if(isset($_SESSION['rssManagerId']) && $_SESSION['rssManagerInvite']>0) {
                                echo '
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php?action=rssManagement">Gestion RSS <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php?action=inviteManagement"><span class="badge badge-secondary">New</span>Vos Invitations <span class="sr-only">(current)</span></a>
                                    </li>
                                '; 
                            }
                            elseif(isset($_SESSION['rssManagerId'])) {
                                echo '
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php?action=rssManagement">Gestion RSS <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="index.php?action=inviteManagement">Vos Invitations <span class="sr-only">(current)</span></a>
                                    </li>
                                ';
                            }
                        ?>                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                    if(isset($_SESSION['rssManagerId'])) {
                                        echo 'Déconnexion';
                                    }
                                    else {
                                        echo 'Connexion/Inscription';
                                    }
                                ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php    
                                    if(isset($_SESSION['rssManagerId'])) {
                                        echo '<a class="dropdown-item" href="index.php?action=deconnection&session=ok">Déconnexion</a>';
                                    }
                                    else {
                                        echo '
                                            <a class="dropdown-item" href="index.php?action=connection">Connexion</a>
                                            <a class="dropdown-item" href="index.php?action=inscription">Inscription</a>
                                        ';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <?php
                        if(isset($_SESSION['rssManagerId'])) {
                            echo 
                                '<a class="navbar-brand" href="index.php?action=accountManagement">
                                    <img width="30" height="30" alt="" src="src/Public/images/'. $_SESSION['rssManagerAvatar'] . '" alt="Avatar" />
                                    Bienvenue '.htmlspecialchars($_SESSION['rssManagerPseudo'])
                                .'</a>';
                        }
                    ?>
                </div>            
            </nav>
        </header>
        
        <section>
            <!-- Content View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <?= $content ?>
        </section>
        
        <!-- Footer ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <footer>
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=legit">Mentions légales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#up">&uarr; Up</a>
                        </li>
                        <?php
                            if(isset($_SESSION['rssManagerId'])) {
                                echo '
                                    <li>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#warning">
                                            Signaler un Compte
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Signaler un compte</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="index.php?action=warning&db=ok" id="chatForm" method="post">
                                                            <div class="form-group">
                                                                <label for="pseudoWarning">Pseudo à Signaler</label>
                                                                <input type="text" class="form-control" name="pseudoWarning" id="pseudoWarning" placeholder="Pseudo">
                                                                <small id="pseudoWarning" class="form-text text-muted">Attention, tout abus de cette fonction peut être sanctionné</small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-danger">Enoyer le signalement</button>
                                                            </div>  
                                                        </form>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">François-Hugues LAMODIERE</h5>
                    <p class="card-text">&copy; 2018</p>
                    <a href="https://fh-lamodiere.tech/" class="btn btn-info">Plus d'infos</a>
                </div>
            </div>
        </footer>

        <!-- Script Bootstrap V4 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Script Ajax +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="src/Public/js/ajax.js"></script>
        <!-- Script Chat +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="src/Public/js/chat.js"></script>
    </body>