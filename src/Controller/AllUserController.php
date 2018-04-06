<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserController{
        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index(){
            $url = "https://www.cert.ssi.gouv.fr/feed/"; /* insérer ici l'adresse du flux RSS de votre choix */
            $rss = simplexml_load_file($url);
            
            require('src/view/frontend/indexView.php');
        }
    }
