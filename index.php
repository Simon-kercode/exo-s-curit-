<?php
    
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();

    //Require autoload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once __DIR__.'/vendor/autoload.php';

    //Rooter direction ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try {
        $allUserRooter = new \Project\Rooter\AllUserRooter();
        $userConnectedRooter = new \Project\Rooter\UserConnectedRooter();
        $adminRooter = new \Project\Rooter\AdminRooter();

        //Action GET and ID GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if(isset($_GET['action']) && isset($_GET['idCircleLink']) && isset($_GET['idInvitation'])) {
#UserCo     //Invitation Accept ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'invitationAccept' && $_GET['idCircleLink'] != '' && $_GET['idInvitation'] != '') {
                $userConnectedRooter->invitationAccept();
            }
        }
        //Action GET and DB GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['db'])) {
#AllUser    //Inscription Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'inscription' && $_GET['db'] === 'ok') {    
                $allUserRooter->inscriptionDb();
            }
#AllUser    //Connection Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection' && $_GET['db'] === 'ok' ) {
                $allUserRooter->connectionDb();
            }
#UserCo     //Chat Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'chat' && $_GET['db'] === 'ok') {
                $userConnectedRooter->chatComment();
            }
#UserCo     //Mail Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'mailManagement' && $_GET['db'] === 'ok') {
                $userConnectedRooter->mailManagement();           
            }
#UserCo     //Password Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'passwordManagement' && $_GET['db'] === 'ok') {
                $userConnectedRooter->passwordManagement();
            }
#UserCo     //Account Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'deletAccount' && $_GET['db'] === 'ok') {
                $userConnectedRooter->deletAccount();
            }
#UserCo     //RSS Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssInsert' && $_GET['db'] === 'ok') {
                $userConnectedRooter->rssInsert();
            }
#UserCo     //Category Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'categoryRss' && $_GET['db'] === 'ok') {
                $userConnectedRooter->categoryInsert();
            }
#UserCo     //Cercle Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'cercleLink' && $_GET['db'] === 'ok') {
                $userConnectedRooter->cercleLinkInsert();
            }
#UserCo     //Invitation Send ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'invitation' && $_GET['db'] === 'ok') {
                $userConnectedRooter->invitationCercleLink();
            }  
#UserCo     //Warning Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'warning' && $_GET['db'] === 'ok') {
                $userConnectedRooter->pseudoWarning();
            }
#Admin      //RSS Light Update +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssLight' && $_GET['db'] === 'ok') {
                $adminRooter->rssLightUpdate();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }            
        }
        //Action GET and Session GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['session'])) {
#UserCo     //Deconnection Session +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     
            if($_GET['action'] === 'deconnection' && $_GET['session'] === 'ok') {
                $userConnectedRooter->deconnectionSession();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET and IdCategoryRss GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCategoryRss'])) {
#UserCo     //Category View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'categoryRssView' && $_GET['idCategoryRss'] != '') {
                $userConnectedRooter->categoryRssView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET and IdCircleLink GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCircleLink'])) {
#UserCo     //Cercle View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'circleLink' && $_GET['idCircleLink'] != '') {
                $userConnectedRooter->cercleLinkView();
            }
#UserCo     //Cercle Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
            elseif($_GET['action'] === 'comment' && $_GET['idCircleLink'] != '') {
                $userConnectedRooter->commentCercle();
            }
#UserCo     //Cercle Leave +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'leaveCercle' && $_GET['idCircleLink'] != '') {
                $userConnectedRooter->cercleLeave();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET and IdInvitation GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idInvitation'])) {
#UserCo     //Invitation Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
            if($_GET['action'] === 'invitationRefuse' && $_GET['idInvitation'] != '') {
                $userConnectedRooter->inviteSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            } 
        }
        //Action GET and IdRss GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idRss'])) {
#UserCo     //Rss Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'supressRss' && $_GET['idRss'] != '') {
                $userConnectedRooter->rssSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }
        }
        //Action GET and IdCategory GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idCategory'])) {
#UserCo     //RSS Category Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'supressCategory' && $_GET['idCategory'] != '') {
                $userConnectedRooter->categoryRssSupress();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }
        }
        //Action GET and IdAccount GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['idAccount'])) {
#Admin      //Reset Count Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'resetCountWarning' && $_GET['idAccount'] != '') {
                $adminRooter->resetCountWarning();
            }
#Admin      //Supress Target Account Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'targetCommentSupress' && $_GET['idAccount'] != '') {
                $adminRooter->supressTargetComment();
            }
#Admin      //Bann Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'bann' && $_GET['idAccount'] != '') {
                $adminRooter->bannAccount();
            }
#Admin      //User to Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userToAdmin' && $_GET['idAccount'] != '') {
                $adminRooter->userToAdmin();
            }
#Admin      //Admin to User ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'adminToUser' && $_GET['idAccount'] != '') {
                $adminRooter->adminToUser();
            }
#Admin      //Bann to User +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'bannToUser' && $_GET['idAccount'] != '') {
                $adminRooter->bannToUser();
            }    
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }        
        }
        //Action GET and Page GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action']) && isset($_GET['page'])) {
#Admin      //Account Management Admin +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'accountBack' && $_GET['page'] != '') {
               $adminRooter->accountBackView();
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
                $allUserRooter->inscription();
            }
#AllUser    //Connection View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection') {
                $allUserRooter->connection();
            }
#UserCo     //Profil Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountManagement') {
                $userConnectedRooter->accountManagement();
            }
#UserCo     //Avatar Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadAvatar') {
                $userConnectedRooter->avatarUpload();
            }
#UserCo     //Rss Management View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssManagement') {
                $userConnectedRooter->rssManagement();
            }
#UserCo     //Invitation Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'inviteManagement') {
                $userConnectedRooter->invitationView();
            }
#Admin      //Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'admin') {
                $adminRooter->adminView();
            } 
#Admin      //Warning Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'warningBack') {
                $adminRooter->warningBackView();
            } 
#Admin      //RSS Light ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rssLightView') {
                $adminRooter->rssLightView();
            }
#AllUser    //Legit View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  
            elseif($_GET['action'] === 'legit') {
                $allUserRooter->legitview();
            }                                           
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
            else {
                throw new Exception('Variable inattendu');
            }
        }
        //No Get +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++   
        else{
#AllUser    //Index View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
            $allUserRooter->index();
        }
    }

    //If error, echo message and index return
    catch(Exception $e) {
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        $allUserRooter->index();
    }