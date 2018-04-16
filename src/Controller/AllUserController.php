<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserController {
        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index() {
            $url = "https://www.cert.ssi.gouv.fr/feed/"; /* URL Flux RSS */
            $rss = simplexml_load_file($url);
        
            require('src/view/frontend/indexView.php');
        }

        //Inscription View +++++++++++++++++++++++++++++++++++++++++++++++++
        function inscription() {
            require('src/view/frontend/inscriptionView.php');
        }

        //Inscription Data Base ++++++++++++++++++++++++++++++++++++++++++++
        function inscriptionDb() {
            echo 'coucou';
        }
    }
