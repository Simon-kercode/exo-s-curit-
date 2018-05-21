<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class UserConnectedController {
        //Deconnection Session ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function deconnectionSession() {
            session_destroy();
            header("Refresh:0; index.php");
        }

        //Chat comment Data Base ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function chatComment() {
            $chatContent = htmlspecialchars($_POST['chatContent']);
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);

            $chatManager = new \Project\Model\ChatManager();
            $request = $chatManager->chatPost($chatContent,$idAccount);
            header("Refresh:0; index.php");
        }

        //Profil Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountManagement() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);

            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->accountManagementRequest($idAccount);

            $result = $request->fetch();
            require('src/view/frontend/accountManagementView.php');
        }
    }