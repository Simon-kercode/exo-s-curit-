<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserController {

        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index() {
            $url = "https://www.cert.ssi.gouv.fr/feed/"; /* URL Flux RSS */
            $rss = simplexml_load_file($url);
            $i = 0;
            
            $chatManager = new \Project\Model\ChatManager();
            $request = $chatManager->chatRequest();
            $result = $request->fetch();
            if($result!='') {
                $chatManager = new \Project\Model\ChatManager();
                $request = $chatManager->chatRequest();    
                //Data Base to Jason +++++++++++++++++++++++++++
                while($db= $request->fetch()) {
                    $jsonArray[$i]= ['Pseudo'=>htmlspecialchars($db['pseudoAccount']),'Avatar'=>htmlspecialchars($db['avatarAccount']),'ContentChat'=>htmlspecialchars($db['contentChat']),'Date'=>htmlspecialchars($db['dateChat'])];
                    $i++;
                }
                $contentJason = json_encode($jsonArray);
                $chat = 'src/Public/js/chat.json';
                $chatFiles = fopen($chat, 'w+');
                fwrite($chatFiles, $contentJason);
                fclose($chatFiles);
            }
            require('src/view/frontend/indexView.php');
        }

        //Inscription View +++++++++++++++++++++++++++++++++++++++++++++++++
        function inscription() {
            require('src/view/frontend/inscriptionView.php');
        }

        //Connection View ++++++++++++++++++++++++++++++++++++++++++++++++++
        function connection() {
            require('src/view/frontend/connectionView.php');
        }

        //Inscription Data Base ++++++++++++++++++++++++++++++++++++++++++++
        function inscriptionDb() {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            
            // Already Pseudo and Email existing Control +++++++++++++++++++
            $accountManager = new \Project\Model\AccountManager();
            $request= $accountManager->controlInscription($pseudo,$email);

            $result = $request->fetch();
            // If pseudo or email already exist do exception +++++++++++++++
            if($result['pseudoAccount'] === $pseudo || $result['emailAccount'] === $email){
                echo '<h3 class="error">Erreur : Pseudo ou Email déja existant </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->inscription();
            }        
            // Insert Data Base ++++++++++++++++++++++++++++++++++++++++++++
            else{
                $accountManager = new \Project\Model\AccountManager();
                $request = $accountManager->postInscriptionDb($pseudo,$email,$password);

                // Control injection +++++++++++++++++++++++++++++++++++++++
                $accountManager = new \Project\Model\AccountManager();
                $request= $accountManager->controlInscription($pseudo,$email);

                $result = $request->fetch();
                if($result['pseudoAccount'] === $pseudo) {
                    echo '<h3 class="validate">Validation : Inscription réussi </h3>';
                    $allUserController= new \Project\Controller\AllUserController();
                    $allUserController->index();
                }
                // If not pass Control do Exception +++++++++++++++++++++++
                else{
                    echo '<h3 class="error">Erreur : Problème lors de l\'inscription du compte... Veuillez réessayer ultérieurement </h3>';
                    $allUserController= new \Project\Controller\AllUserController();
                    $allUserController->inscription();
                }
            }
        }

        //Connection Data Base +++++++++++++++++++++++++++++++++++++++++++++
        function connectionDb() {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = htmlspecialchars($_POST['password']);

            $accountManager = new \Project\Model\AccountManager();
            $request= $accountManager->controlConnection($pseudo);

            $result = $request->fetch();

            // Control status +++++++++++++++++++++++++++++++++++++++++++++
            if(!$result['statusAccount'] || $result['statusAccount'] === "Bann") {
                echo '<h3 class="error">Erreur : Le compte que vous cherchez à connecter n\'existe pas ou est banni </h3>';
                $allUserController= new \Project\Controller\AllUserController();
                $allUserController->connection();
            }
            else {
                // Password Verify ++++++++++++++++++++++++++++++++++++
                $resultVerify = password_verify($password,$result['passAccount']);

                // Connection and Session ++++++++++++++++++++++++++++++++
                if($resultVerify) {
                    $accountManager = new \Project\Model\AccountManager();
                    $request = $accountManager->connectionDbSession($pseudo);

                    $result = $request->fetch();

                    $_SESSION['rssManagerId'] = htmlspecialchars($result['idAccount']);
                    $_SESSION['rssManagerPseudo'] = htmlspecialchars($result['pseudoAccount']);
                    $_SESSION['rssManagerStatus'] = htmlspecialchars($result['statusAccount']);
                    $_SESSION['rssManagerAvatar'] = htmlspecialchars($result['avatarAccount']);

                    header("Refresh:0; index.php");
                }
                else {
                    echo '<h3 class="error">Erreur : Mauvais mot de passe </h3>';
                    $allUserController= new \Project\Controller\AllUserController();
                    $allUserController->connection();
                }
            }
        }
    }
