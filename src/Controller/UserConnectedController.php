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

        //Rss Management +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssManagement() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);

            $rssManager = new \Project\Model\RssManager();
            $requestFirst = $rssManager->rssRequest($idAccount);

            $rssCategoryManager = new \Project\Model\RssCategoryManager();
            $request = $rssCategoryManager->controlRssCategory($idAccount);

            $cercleLinkManager = new \Project\Model\CercleLinkManager();
            $requestSecond = $cercleLinkManager->cercleLinkRequest($idAccount);

            $rssManager = new \Project\Model\RssManager();
            $requestThird = $rssManager->cardRssRequest($idAccount);

            $rssCategoryManager = new \Project\Model\RssCategoryManager();
            $requestFourth = $rssCategoryManager->rssCategoryNameRequest($idAccount);

            require('src/view/frontend/rssManagementView.php');
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

                $chatManager = new \Project\Model\ChatManager();
                $chatManager->supressChat($idAccount);

                $connectManager = new \Project\Model\ConnectManager();
                $connectManager->supressConnect($idAccount);

                $commentManager = new \Project\Model\CommentManager();
                $commentManager->supressComment($idAccount);

                $rssCategoryManager = new \Project\Model\RssCategoryManager();
                $request = $rssCategoryManager->controlRssCategory($idAccount);

                while ($db1 = $request->fetch()) {
                    $idRssCategory = htmlspecialchars($db1['idRssCategory']);
                    $deffineManager = new \Project\Model\DeffineManager();
                    $deffineManager->supressDeffine($idRssCategory);
                }
                
                $rssCategoryManager = new \Project\Model\RssCategoryManager();
                $rssCategoryManager->supressRssCategory($idAccount);

                $accountManager = new \Project\Model\AccountManager();
                $accountManager->supressAccount($idAccount);
                
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

        //Category RSS View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryRssView() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $idCategory = htmlspecialchars($_GET['idCategoryRss']);

            $rssManager = new \Project\Model\RssManager();
            $request = $rssManager->rssByCategoryRequest($idAccount,$idCategory);

            require('src/view/frontend/rssCategoryView.php');
        }

        //Cercle Link View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLinkView() {
            $idCircleLink = htmlspecialchars($_GET['idCircleLink']);

            $cercleLinkManager = new \Project\Model\CercleLinkManager();
            $requestSecond = $cercleLinkManager->cercleNameRequest($idCircleLink);

            $result = $requestSecond->fetch();

            $cercleLinkManager = new \Project\Model\CercleLinkManager();
            $request = $cercleLinkManager->cercleRequest($idCircleLink);

            $commentManager = new \Project\Model\CommentManager();
            $requestFirst = $commentManager->commentRequest($idCircleLink);

            require('src/view/frontend/cercleLinkView.php');
        }

        //Invitation View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationView() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->inviteRequest($idAccount);

            require('src/view/frontend/invitationView.php');
        }

        //Avatar Upload +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function avatarUpload() {
 
            /************************************************************
             * Setup
             *************************************************************/
            
            define('TARGET', 'src/Public/images/');    // Target Folder
            define('MAX_SIZE', 1000000);    // Max Weight Files (octet)
            define('WIDTH_MAX', 800);    // Max Width Image (pix)
            define('HEIGHT_MAX', 800);    // Max Height Image (pix)
            
            // Data Table
            $tabExt = array('jpg','gif','png','jpeg');    // Authorized extension
            $infosImg = array();
            
            // Variables
            $extension = '';
            $message = '';
            $nameImage = '';
            $id = htmlspecialchars($_SESSION['rssManagerId']);

            /************************************************************
             * New Folder if doesn't exist
             *************************************************************/
            if( !is_dir(TARGET) ) {
                if( !mkdir(TARGET, 0755) ) {
                    echo '<h3 class="error">Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !</h3>';
                }
            }
            
            /************************************************************
             * Upload Script
             *************************************************************/
            // Verify Field
            if(!empty($_POST)){
                if( !empty($_FILES['file']['name'])){                
                    $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);        
                    
                    if(in_array(strtolower($extension),$tabExt)){
                        $infosImg = getimagesize($_FILES['file']['tmp_name']);        
                        
                        if($infosImg[2] >= 1 && $infosImg[2] <= 14){
                            if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE)){
                                if(isset($_FILES['file']['error']) && UPLOAD_ERR_OK === $_FILES['file']['error']){
                                    $nameImage = md5(uniqid()) .'.'. $extension;        
                                    
                                    if(move_uploaded_file($_FILES['file']['tmp_name'], TARGET.$nameImage)){
                                        $message = 'Upload réussi !';
                                        $accountManager = new \Project\Model\AccountManager();
                                        $request = $accountManager->postAvatar($nameImage,$id);
                                    }
                                    else{
                                        echo '<h3 class="error">Problème lors de l\'upload !</h3>';
                                        $userConnectedController = new \Project\Controller\UserConnectedController();
                                        $userConnectedController->accountManagement();
                                    }
                                }
                                else{
                                    echo '<h3 class="error">Une erreur interne a empêché l\'uplaod de l\'image</h3>';
                                    $userConnectedController = new \Project\Controller\UserConnectedController();
                                    $userConnectedController->accountManagement();
                                }
                            }
                            else{
                                echo '<h3 class="error">Erreur dans les dimensions de l\'image !</h3>';
                                $userConnectedController = new \Project\Controller\UserConnectedController();
                                $userConnectedController->accountManagement();
                            }
                        }
                        else{
                            echo '<h3 class="error">Le fichier à uploader n\'est pas une image !</h3>';
                            $userConnectedController = new \Project\Controller\UserConnectedController();
                            $userConnectedController->accountManagement();
                        }
                    }
                    else{
                        echo '<h3 class="error">L\'extension du fichier est incorrecte !</h3>';
                        $userConnectedController = new \Project\Controller\UserConnectedController();
                        $userConnectedController->accountManagement();
                    }
                }
                else{
                    echo '<h3 class="error">Veuillez remplir le formulaire svp !</h3>';
                    $userConnectedController = new \Project\Controller\UserConnectedController();
                    $userConnectedController->accountManagement();
                }
            }     
            
            header("Refresh:0; index.php");            
        }

        //RSS Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssInsert() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $urlRss = htmlspecialchars($_POST['urlRss']);
            $nameRss = htmlspecialchars($_POST['nameRss']);
            $categorySelect = htmlspecialchars($_POST['categorySelect']);

            $rssManager = new \Project\Model\RssManager();
            $rssManager->rssInsertDb($urlRss,$nameRss);

            $rssManager = new \Project\Model\RssManager();
            $request = $rssManager->rssControl($urlRss,$nameRss);

            $rssCategoryManager = new \Project\Model\RssCategoryManager();
            $requestFirst = $rssCategoryManager->rssCategoryRequest($idAccount,$categorySelect);

            $result = $request->fetch();
            $result2 = $requestFirst->fetch();

            if(isset($result['idRss']) && isset($result2['idRssCategory'])) {
                $idRss = htmlspecialchars($result['idRss']);
                $idRssCategory = htmlspecialchars($result2['idRssCategory']);

                $deffineManager = new \Project\Model\DeffineManager();
                $deffineManager->deffineInsert($idRssCategory,$idRss);
            }
            else {
                echo '<h3 class="error">Un probléme est survenu lors de l\'inscription du Flux RSS... Veuillez réessayer plus tard!</h3>';
            }
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->rssManagement();
        }

        //Category Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryInsert() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $nameRssCategory = htmlspecialchars($_POST['nameRssCategory']);

            $rssCategoryManager = new \Project\Model\RssCategoryManager();
            $rssCategoryManager->rssCategoryInsert($nameRssCategory,$idAccount);

            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->rssManagement();
        }

        //Cercle Link Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLinkInsert() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $nameCercleLink = htmlspecialchars($_POST['nameCercleLink']);

            $cercleLinkManager = new \Project\Model\CercleLinkManager();
            $cercleLinkManager->cercleInsert($nameCercleLink);
            $request = $cercleLinkManager->cercleControl($nameCercleLink);

            $result = $request->fetch();
            if(isset($result['idCercleLink'])) {
                $idCircleLink = htmlspecialchars($result['idCercleLink']);

                $connectManager = new \Project\Model\ConnectManager();
                $connectManager->connectInsert($idAccount,$idCircleLink);

                $userConnectedController = new \Project\Controller\UserConnectedController();
                $userConnectedController->rssManagement();                
            }
            else {
                echo '<h3 class="error">Un probléme est survenu lors de l\'inscription du Cercle... Veuillez réessayer plus tard!</h3>';
            }
            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->rssManagement();
        }

        //Comment Cercle Link Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function commentCercle() {
            $idAccount = htmlspecialchars($_SESSION['rssManagerId']);
            $idCercleLink = htmlspecialchars($_GET['idCircleLink']);
            $contentComment = htmlspecialchars($_POST['commentContent']);

            $commentManager = new \Project\Model\CommentManager();
            $commentManager->commentInsert($contentComment,$idAccount,$idCercleLink);

            $userConnectedController = new \Project\Controller\UserConnectedController();
            $userConnectedController->cercleLinkView();
        }
    } 