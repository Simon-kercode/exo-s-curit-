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
        <!-- Stylesheet +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link href="src/Public/css/style.css" rel="stylesheet" /> 

    </head>

        
    <!-- Template Content ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <body class="bodyFront container-fluid raw">
        
        <header class="sticky-top">
            <!-- Navbar ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Flux RSS Manager</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
            
            </nav>
        </header>

        <!-- Content View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <?= $content ?>

        <!-- Footer ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <footer>
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </footer>

        <!-- Script Bootstrap V4 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Script RSS ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="src/Public/js/rss.js"></script>

    </body>