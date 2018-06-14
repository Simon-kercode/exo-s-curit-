<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AdminController {
        //Admin View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminView() {
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->accountCount();

            $result = $request->fetch();

            $accountManager = new \Project\Model\AccountManager();
            $requestSeconde = $accountManager->accountWarningCount();

            $resultSeconde = $requestSeconde->fetch();

            $rssManager = new \Project\Model\RssManager();
            $requestFirst = $rssManager->rssLight();

            $resultFirst = $requestFirst->fetch();

            require('src/view/backend/adminView.php');
        }

        //Warning Backend View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function warningBackView() {
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->accountWarningRequest();

            require('src/view/backend/warningView.php');
        }

        //Reset Count Warning +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function resetCountWarning() {
            $idAccount = htmlspecialchars($_GET['idAccount']);

            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->resetWarning($idAccount);

            $adminController = new \Project\Controller\AdminController();
            $adminController->warningBackView();
        }

        //Supress Target Account Comments ++++++++++++++++++++++++++++++++++++++++++++++
        function supressTargetComment() {
            $idAccount = htmlspecialchars($_GET['idAccount']);

            $commentManager = new \Project\Model\CommentManager();
            $commentManager->supressComment($idAccount);

            $chatManager = new \Project\Model\ChatManager();
            $chatManager->supressChat($idAccount);

            $adminController = new \Project\Controller\AdminController();
            $adminController->resetCountWarning();
        }

        //Bann Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function bannAccount() {
            $idAccount = htmlspecialchars($_GET['idAccount']);

            $accountManager = new \Project\Model\AccountManager();
            $accountManager->accountBann($idAccount);

            $adminController = new \Project\Controller\AdminController();
            $adminController->supressTargetComment();
        }

        //Account View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountBackView() {
            $numberArticlePage = 5;

            $accountManager = new \Project\Model\AccountManager();
            $requestFirst = $accountManager->allAccountCount();

            $result = $requestFirst->fetch();
            $numberArticle = htmlspecialchars($result[0]);
            $numberPage = ceil($numberArticle / $numberArticlePage); 
            
            if (isset($_GET['page'])) {
                $page = htmlspecialchars($_GET['page']);
            }
            else {
                $page = 1;
            }

            $firstMessage = ($page - 1) * $numberArticlePage;
            $first = (int)$firstMessage;
            $second = (int)$numberArticlePage;
            
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->allAccount($first,$second);

            require('src/view/backend/accountView.php');
        }

        //User to Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function userToAdmin() {
            $idAccount = htmlspecialchars($_GET['idAccount']);

            $accountManager = new \Project\Model\AccountManager();
            $accountManager->userAdmin($idAccount);

            echo '<h3 class="validate">Promotion réalisé avec succès... !</h3>';
            $adminController = new \Project\Controller\AdminController();
            $adminController->adminView();
        }

        //Admin to User ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminToUser() {
            $idAccount = htmlspecialchars($_GET['idAccount']);

            $accountManager = new \Project\Model\AccountManager();
            $accountManager->adminUser($idAccount);

            echo '<h3 class="validate">Rétrogradation réalisé avec succès... !</h3>';
            $adminController = new \Project\Controller\AdminController();
            $adminController->adminView();
        }

    }