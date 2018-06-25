<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Rooter;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class UserConnectedRooter {

        //Invitation Accept ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationAccept() {
            $userConnectedController = new \Project\Controller\UserconnectedController;
            $userConnectedController->invitationAccept();
        }

        //Chat Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function chatComment() {
            if(isset($_POST['chatContent'])) {
                if($_POST['chatContent'] !== '') {
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->chatComment();
                }
                //Exception 
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $allUserController = new \Project\Controller\AllUserController();
                    $allUserController->index();
                }
            }
            //Exception 
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $allUserController = new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Mail Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function mailManagement() {
            if(isset($_POST['email'])) {
                if($_POST['email'] != '') {
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $userConnectedController = new \Project\Controller\UserconnectedController;
                        $userConnectedController->mailManagement();
                    }
                    //Exception 
                    else {
                        echo '<h3 class="error">Erreur : Mail non valide</h3>';
                        $userConnectedController = new \Project\Controller\UserconnectedController;
                        $userConnectedController->accountManagement();
                    }
                }
                //Exception 
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->accountManagement();
                }
            }
            //Exception
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserconnectedController;
                $userConnectedController->accountManagement();
            }     
        }

        //Password Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function passwordManagement() {
            if(isset($_POST['oldPassword']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                if($_POST['oldPassword'] != '' && $_POST['password'] != '' && $_POST['passwordComp'] != '') {
                    if($_POST['password'] === $_POST['passwordComp']) {
                        //Strongest Paswword Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                        $lowercase = preg_match('@[a-z]@', $_POST['password']);
                        $number    = preg_match('@[0-9]@', $_POST['password']);
                        if($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
                            $userConnectedController = new \Project\Controller\UserconnectedController;
                            $userConnectedController->passwordManagement();
                        }
                        //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++      
                        else{
                            echo '<h3 class="error">Erreur : Mot de passe non conforme/h3>';
                            $userConnectedController = new \Project\Controller\UserconnectedController;
                            $userConnectedController->accountManagement();
                        }                           
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->accountManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserconnectedController;
                $userConnectedController->accountManagement();
            }
        }

        //Account Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function deletAccount() {
            if(isset($_POST['passwordDel'])) {
                if($_POST['passwordDel'] != '') {
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->deletAccount();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->accountManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserconnectedController;
                $userConnectedController->accountManagement();
            }
        }

        //RSS Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssInsert() {
            if(isset($_POST['urlRss']) && isset($_POST['nameRss']) && isset($_POST['categorySelect'])) {
                if($_POST['urlRss'] != '' && $_POST['nameRss'] != '' && $_POST['categorySelect'] != 'Choisir la catégorie') {
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->rssInsert();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();
            }
        }

        //Category Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryInsert() {
            if(isset($_POST['nameRssCategory'])) {
                if($_POST['nameRssCategory'] != '') {
                    $userConnectedController = new \Project\Controller\UserconnectedController;
                    $userConnectedController->categoryInsert();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();
            }
        }

        //Cercle Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLinkInsert() {
            if(isset($_POST['nameCercleLink'])) {
                if($_POST['nameCercleLink'] != '') {
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->cercleLinkInsert();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();
            }
        }

        //Invitation Send ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationCercleLink() {
            if(isset($_POST['pseudo']) && isset($_POST['cercleLinked']) && isset($_POST['invitContent'])) {
                if($_POST['pseudo'] != '' && $_POST['cercleLinked'] != '' && $_POST['invitContent']) {
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->invitationCercleLink();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();
            }
        }

        //Warning Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function pseudoWarning() {
            if(isset($_POST['pseudoWarning'])) {
                if($_POST['pseudoWarning'] != '') {
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->pseudoWarning();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Champs manquants</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();

            }
        }

        //Deconnection Session +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function deconnectionSession() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->deconnectionSession();
        }

        //Category View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryRssView() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->categoryRssView();
        }

        //Cercle View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLinkView() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->cercleLinkView();
        }

        //Cercle Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function commentCercle() {
            if(isset($_POST['commentContent'])) {
                if($_POST['commentContent'] != '') {
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->commentCercle();
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Champs manquants</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->rssManagement();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu</h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();
            }
        }

        //Cercle Leave +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLeave() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->cercleLeave();
        }

        //Invitation Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
        function inviteSupress() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->inviteSupress();
        }

        //Rss Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssSupress() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->rssSupress();
        }

        //RSS Category Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryRssSupress() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->categoryRssSupress();
        }

        //Profil Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountManagement() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->accountManagement();
        }

        //Avatar Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function avatarUpload() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->avatarUpload();
        }

        //Rss Management View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssManagement() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->rssManagement();
        }

        //Invitation Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationView() {
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->invitationView();
        }
    }