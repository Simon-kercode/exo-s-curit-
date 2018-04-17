<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserController {

        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index() {
            $url = "https://www.cert.ssi.gouv.fr/feed/"; /* URL Flux RSS */
            $rss = simplexml_load_file($url);
        
            require('src/view/frontend/indexView.php');
        }

        //Inscription View +++++++++++++++++++++++++++++++++++++++++++++++++
        function inscription() {
            require('src/view/frontend/inscriptionView.php');
        }

        //Inscription Data Base ++++++++++++++++++++++++++++++++++++++++++++
        function inscriptionDb() {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            
            //Already Pseudo and Email existing Control ++++++++++++++++++++
            $accountManager = new \Project\Model\AccountManager();
            $request= $accountManager->controlInscription($pseudo,$email);

            $result = $request->fetch();
            //If pseudo or email already exist do exception
            if($result['pseudoAccount'] === $pseudo || $result['emailAccount'] === $email){
                echo '<h3 class="error">Erreur : Pseudo ou Email déja existant </h3>';
                $controller= new \Project\Controller\AllUserController();
                $controller->inscription();
            }        
            // Insert Data Base
            else{
                $accountManager = new \Project\Model\AccountManager();
                $request = $accountManager->postInscriptionDb($pseudo,$email,$password);
            }
        }
    }
