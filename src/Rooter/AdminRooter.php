<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Rooter;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AdminRooter {

        //RSS Light Update +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssLightUpdate() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                if(isset($_POST['rssLight']) && isset($_POST['rssUrlLight'])) {
                    if($_POST['rssLight'] != '' && $_POST['rssUrlLight']) {
                        $adminController = new \Project\Controller\AdminController();
                        $adminController->rssLightUpdate();
                    }
                    //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        echo '<h3 class="error">Erreur : Champs manquants </h3>';
                        $adminController = new \Project\Controller\AdminController();
                        $adminController->rssLightView();
                    }
                }
                //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                    $adminController = new \Project\Controller\AdminController();
                    $adminController->rssLightView();
                }
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Reset Count Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function resetCountWarning() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->resetCountWarning();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Supress Target Account Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressTargetComment() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->supressTargetComment();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Bann Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function bannAccount() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->bannAccount();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //User to Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function userToAdmin() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->userToAdmin();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Admin to User ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminToUser() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->adminToUser();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Bann to User +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function bannToUser() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->bannToUser();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Account Management Admin +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountBackView() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->accountBackView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminView() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->adminView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //Warning Panel Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function warningBackView() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->warningBackView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            }
        }

        //RSS Light ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssLightView() {
            if($_SESSION['rssManagerStatus'] === 'Admin' || $_SESSION['rssManagerStatus'] === 'SU') {
                $adminController = new \Project\Controller\AdminController();
                $adminController->rssLightView();
            }
            //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                echo '<h3 class="error">Erreur : Variable inattendu </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->index();
            } 
        }
    }