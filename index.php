<?php
    
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();

    //Require autoload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once __DIR__.'/vendor/autoload.php';

    //Rooter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try {

        $allUserController = new \Project\Controller\AllUserController();
        $userConnectedController = new \Project\Controller\UserConnectedController();

        //Action GET and DB GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if(isset($_GET['action']) && isset($_GET['db'])) {
#AllUser    //Inscription Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'inscription' && $_GET['db'] === 'ok') {    
                if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                    if(isset($_POST['checkHuman'])) {   
                        if($_POST['pseudo'] !== '' && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['passwordComp'] && $_POST['checkHuman'] == 'ok') {
                            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                                if($_POST['password'] === $_POST['passwordComp']) {
                                    //Strongest Paswword Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                                    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                                    $lowercase = preg_match('@[a-z]@', $_POST['password']);
                                    $number    = preg_match('@[0-9]@', $_POST['password']);
                                    if($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
                                        $allUserController->inscriptionDb();
                                    }
                                    //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++      
                                    else{
                                        throw new Exception('Mot de passe non conforme');
                                    }                           
                                }
                                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     
                                else {
                                    throw new Exception('Mot de passe non concordant');    
                                }
                            }
                            //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                            else {
                                throw new Exception('Mail non valide');
                            }
                        }
                        //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        else {
                            throw new Exception('Champs manquants');
                        }
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Check Box non coché');
                    }                
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#AllUser    //Connection Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection' && $_GET['db'] === 'ok' ) {
                if(isset($_POST['pseudo']) && isset($_POST['password'])) {
                    if($_POST['pseudo'] !== '' && $_POST['password'] !== '') {
                        $allUserController->connectionDb();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#UserCo     //Chat Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'chat' && $_GET['db'] === 'ok') {
                if(isset($_POST['chatContent'])) {
                    if($_POST['chatContent'] !== '') {
                        $userConnectedController->chatComment();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#UserCo     //Mail Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'mailManagement' && $_GET['db'] === 'ok') {
                if(isset($_POST['email'])) {
                    if($_POST['email'] != '') {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            $userConnectedController->mailManagement();
                        }
                        //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        else {
                            throw new Exception('Mail non valide');
                        }
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }                
            }
#UserCo     //Password Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'passwordManagement' && $_GET['db'] === 'ok') {
                if(isset($_POST['oldPassword']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                    if($_POST['oldPassword'] != '' && $_POST['password'] != '' && $_POST['passwordComp'] != '') {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            //Strongest Paswword Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                            $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                            $lowercase = preg_match('@[a-z]@', $_POST['password']);
                            $number    = preg_match('@[0-9]@', $_POST['password']);
                            if($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
                                $userConnectedController->passwordManagement();
                            }
                            //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++      
                            else{
                                throw new Exception('Mot de passe non conforme');
                            }                           
                        }
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }

                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#UserCo     //Account Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'deletAccount' && $_GET['db'] === 'ok') {
                if(isset($_POST['passwordDel'])) {
                    if($_POST['passwordDel'] != '') {
                        $userConnectedController->deletAccount();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#UserCo     //RSS Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssInsert' && $_GET['db'] === 'ok') {
                if(isset($_POST['urlRss']) && isset($_POST['nameRss']) && isset($_POST['categorySelect'])) {
                    if($_POST['urlRss'] != '' && $_POST['nameRss'] != '' && $_POST['categorySelect'] != 'Choisir la catégorie') {
                        $userConnectedController->rssInsert();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#UserCo     //Category Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'categoryRss' && $_GET['db'] === 'ok') {
                if(isset($_POST['nameRssCategory'])) {
                    if($_POST['nameRssCategory'] != '') {
                        $userConnectedController->categoryInsert();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }            
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['session'])) {
#UserCo     //Deconnection Session       
            if($_GET['action'] === 'deconnection' && $_GET['session'] === 'ok') {
                $userConnectedController->deconnectionSession();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCategoryRss'])) {
#UserCo     //Category View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'categoryRssView' && $_GET['idCategoryRss'] != '') {
                $userConnectedController->categoryRssView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action'])) {
#AllUser    //Inscription View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
            if($_GET['action'] === 'inscription') {
                $allUserController->inscription();
            }
#AllUser    //Connection View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection') {
                $allUserController->connection();
            }
#UserCo     //Profil Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountManagement') {
                $userConnectedController->accountManagement();
            }
#UserCo     //Avatar Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadAvatar') {
                $userConnectedController->avatarUpload();
            }
#UserCo     //Rss Management View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssManagement') {
                $userConnectedController->rssManagement();
            }                                
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
            else {
                throw new Exception('Variable inattendu');
            }
        }

        else{
#AllUser    //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $allUserController->index();
        }
    }

    //If error, echo message and index return
    catch(Exception $e) {
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        $allUserController->index();
    }