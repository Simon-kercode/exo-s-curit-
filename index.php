<?php
    
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();

    //Require autoload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once __DIR__.'/vendor/autoload.php';

    //Rooter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try {

        $allUserController = new \Project\Controller\AllUserController();
        $userConnectedController = new \Project\Controller\UserConnectedController();
        $adminController = new \Project\Controller\AdminController();

        //Action GET and ID GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if(isset($_GET['action']) && isset($_GET['idCircleLink']) && isset($_GET['idInvitation'])) {
#UserCo     //Invitation Accept ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'invitationAccept' && $_GET['idCircleLink'] != '' && $_GET['idInvitation'] != '') {
                $userConnectedController->invitationAccept();
            }
        }
        //Action GET and DB GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['db'])) {
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
#UserCo     //Cercle Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'cercleLink' && $_GET['db'] === 'ok') {
                if(isset($_POST['nameCercleLink'])) {
                    if($_POST['nameCercleLink'] != '') {
                        $userConnectedController->cercleLinkInsert();
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
#UserCo     //Invitation Send ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'invitation' && $_GET['db'] === 'ok') {
                if(isset($_POST['pseudo']) && isset($_POST['cercleLinked']) && isset($_POST['invitContent'])) {
                    if($_POST['pseudo'] != '' && $_POST['cercleLinked'] != '' && $_POST['invitContent']) {
                        $userConnectedController->invitationCercleLink();
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
#UserCo     //Warning Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'warning' && $_GET['db'] === 'ok') {
                if(isset($_POST['pseudoWarning'])) {
                    if($_POST['pseudoWarning'] != '') {
                        $userConnectedController->pseudoWarning();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Champs manquants');
                }
            }
#Admin      //RSS Light Update +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssLight' && $_GET['db'] === 'ok') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    if(isset($_POST['rssLight']) && isset($_POST['rssUrlLight'])) {
                        if($_POST['rssLight'] != '' && $_POST['rssUrlLight']) {
                            $adminController->rssLightUpdate();
                        }
                        //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        else {
                            throw new Exception('Champs manquants');
                        }
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Variable inattendu');
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
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCircleLink'])) {
#UserCo     //Cercle View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'circleLink' && $_GET['idCircleLink'] != '') {
                $userConnectedController->cercleLinkView();
            }
#UserCo     //Cercle Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
            elseif($_GET['action'] === 'comment' && $_GET['idCircleLink'] != '') {
                if(isset($_POST['commentContent'])) {
                    if($_POST['commentContent'] != '') {
                        $userConnectedController->commentCercle();
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
#UserCo     //Cercle Leave +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'leaveCercle' && $_GET['idCircleLink'] != '') {
                $userConnectedController->cercleLeave();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idInvitation'])) {
#UserCo     //Invitation Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
            if($_GET['action'] === 'invitationRefuse' && $_GET['idInvitation'] != '') {
                $userConnectedController->inviteSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idRss'])) {
#UserCo     //Rss Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'supressRss' && $_GET['idRss'] != '') {
                $userConnectedController->rssSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCategory'])) {
#UserCo     //RSS Category Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'supressCategory' && $_GET['idCategory'] != '') {
                $userConnectedController->categoryRssSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }
        }
        //Action GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idAccount'])) {
#Admin      //Reset Count Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'resetCountWarning' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->resetCountWarning();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#Admin      //Supress Target Account Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'targetCommentSupress' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->supressTargetComment();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#Admin      //Bann Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'bann' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->bannAccount();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#Admin      //User to Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userToAdmin' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->userToAdmin();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#Admin      //Admin to User ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'adminToUser' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->adminToUser();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            }
#Admin      //Bann to User +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'bannToUser' && $_GET['idAccount'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->bannToUser();
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
        elseif(isset($_GET['action']) && isset($_GET['page'])) {
#Admin      //Account Management Admin +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'accountBack' && $_GET['page'] != '') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->accountBackView();
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
        elseif(isset($_GET['action'])) {
#AllUser    //Inscription View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
            if($_GET['action'] === 'inscription') {
                $allUserController->inscription();
            }
#AllUser    //Connection View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection') {
                $allUserController->connection();
            }
#UserCo     //Profil Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountManagement') {
                $userConnectedController->accountManagement();
            }
#UserCo     //Avatar Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadAvatar') {
                $userConnectedController->avatarUpload();
            }
#UserCo     //Rss Management View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssManagement') {
                $userConnectedController->rssManagement();
            }
#UserCo     //Invitation Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'inviteManagement') {
                $userConnectedController->invitationView();
            }
#Admin      //Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'admin') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->adminView();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            } 
#Admin      //Warning Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'warningBack') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->warningBackView();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                }
            } 
#Admin      //RSS Light ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssLightView') {
                if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                    $adminController->rssLightView();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Variable inattendu');
                } 
            }
#AllUser    //Legit View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  
            elseif($_GET['action'] === 'legit') {
                $allUserController->legitview();
            }                                           
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
            else {
                throw new Exception('Variable inattendu');
            }
        }
        else{
#AllUser    //Index View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $allUserController->index();
        }
    }

    //If error, echo message and index return
    catch(Exception $e) {
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        $allUserController->index();
    }