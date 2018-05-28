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

        //Mail Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function mailManagement() {
            $email = htmlspecialchars($_POST['email']);
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            
            //control mail
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->emailManagementControl($email);

            $result = $request->fetch();
            
            //Error
            if(isset($result['emailAccount'])) {
                echo '<h3 class="error">Erreur : Email déja existant </h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->accountManagement();
            }
            else{
                $accountManager = new \Project\Model\AccountManager();
                $accountManager->emailManagementUpdate($idAccount,$email);

                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->deconnectionSession();
            }            
        }

        //Password Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function passwordManagement() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $oldPassword = htmlspecialchars($_POST['oldPassword']);
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

            //control pass
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->passwordManagementControl($idAccount);

            $result = $request->fetch();

            $resultVerify = password_verify($oldPassword,$result['passAccount']);

            if($resultVerify) {
                $accountManager = new \Project\Model\AccountManager();
                $accountManager->passwordManagementUpdate($idAccount,$password);

                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->deconnectionSession();
            }
            //Error
            else {
                echo '<h3 class="error">Erreur : Mots de passe non valide </h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->accountManagement();
            }
        }

        //Delet Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function deletAccount() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $password = htmlspecialchars($_POST['passwordDel']);

            //control pass
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->passwordManagementControl($idAccount);

            $result = $request->fetch();

            $resultVerify = password_verify($password,$result['passAccount']);

            if($resultVerify) {
                $inviteManager = new \Project\Model\InviteManager();
                $inviteManager->supressInvite($idAccount);

                $invitation = new \project\Model\InvitationManager();
                $invitation->supressInvitation($idAccount);

                $chatManager = new \Project\Model\ChatManager();
                $chatManager->supressChat($idAccount);
            }
            //Error
            else {
                echo '<h3 class="error">Erreur : Mots de passe non valide </h3>';
                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->accountManagement();
            }
        }
    }