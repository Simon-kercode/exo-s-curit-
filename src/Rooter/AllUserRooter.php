<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Rooter;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserRooter {
        
        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index() {
            $allUserController = new \Project\Controller\AllUserController();
            $allUserController->index();
        }

        //Inscription Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inscriptionDb() {
            if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                if(isset($_POST['checkHuman'])) {   
                    if($_POST['pseudo'] !== '' && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['passwordComp'] && $_POST['checkHuman'] == 'ok') {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                            if($_POST['password'] === $_POST['passwordComp']) {
                                //Strongest Paswword Control 
                                $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                                $lowercase = preg_match('@[a-z]@', $_POST['password']);
                                $number    = preg_match('@[0-9]@', $_POST['password']);
                                if($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
                                    $allUserController = new \Project\Controller\AllUserController();
                                    $allUserController->inscriptionDb();
                                }
                                //Exception       
                                else{
                                    echo '<h3 class="error">Erreur : Mot de passe Non conforme !</h3>';
                                    $allUserController= new \Project\Controller\AllUserController();
                                    $allUserController->inscription();
                                }                           
                            }
                            //Exception     
                            else {
                                echo '<h3 class="error">Erreur : Mot de passe non concordant</h3>';
                                $allUserController= new \Project\Controller\AllUserController();
                                $allUserController->inscription();   
                            }
                        }
                        //Exception
                        else {
                            echo '<h3 class="error">Erreur : Mail non valide</h3>';
                            $allUserController= new \Project\Controller\AllUserController();
                            $allUserController->inscription();
                        }
                    }
                    //Exception
                    else {
                        echo '<h3 class="error">Erreur : Champs manquants</h3>';
                        $allUserController= new \Project\Controller\AllUserController();
                        $allUserController->inscription();
                    }
                }
                //Exception 
                else {
                    echo '<h3 class="error">Erreur : Check Box non coché</h3>';
                    $allUserController= new \Project\Controller\AllUserController();
                    $allUserController->inscription();
                }                
            }
            //Exception 
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->inscription();
            }
        }

        //Connection Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function connectionDb() {
            if(isset($_POST['pseudo']) && isset($_POST['password'])) {
                if($_POST['pseudo'] !== '' && $_POST['password'] !== '') {
                    $allUserController = new \Project\Controller\AllUserController();
                    $allUserController->connectionDb();
                }
                //Exception 
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $allUserController = new \Project\Controller\AllUserController();
                    $allUserController->connection();
                }
            }
            //Exception 
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $allUserController = new \Project\Controller\AllUserController();
                $allUserController->connection();
            }
        }

        //Inscription View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inscription() {
            $allUserController = new \Project\Controller\AllUserController();
            $allUserController->inscription();
        }

        //Connection View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function connection() {
            $allUserController = new \Project\Controller\AllUserController();
            $allUserController->connection();
        }

        //Legit View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function legitview() {
            $allUserController = new \Project\Controller\AllUserController();
            $allUserController->legitview();
        }
    }