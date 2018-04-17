<?php
    
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();

    //Require autoload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once __DIR__.'/vendor/autoload.php';

    //Rooter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try {

        $controller= new \Project\Controller\AllUserController();
        
        //Action GET and DB GET +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if(isset($_GET['action']) && isset($_GET['db'])) {
#AllUser    //Inscription Data Base +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                if(isset($_POST['checkHuman'])) {   
                    if($_POST['pseudo'] !== '' && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['passwordComp'] && $_POST['checkHuman'] == 'ok') {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            //Strongest Paswword Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                            $uppercase = preg_match('@[A-Z]@', $_POST['password']);
                            $lowercase = preg_match('@[a-z]@', $_POST['password']);
                            $number    = preg_match('@[0-9]@', $_POST['password']);
                            if($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
                                $controller->inscriptionDb();
                            }
#Error                      //Exception +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++      
                            else{
                                throw new Exception('Mot de passe non conforme');
                            }                           
                        }
#Error                  //Exception      
                        else {
                            throw new Exception('Mot de passe non concordant');    
                        }
                    }
#Error              //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    else {
                        throw new Exception('Champs manquants');
                    }
                }
#Error          //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                else {
                    throw new Exception('Check Box non coché');
                }                
            }
#Error      //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            else {
                throw new Exception('Variable inattendu');
            }            
        }
        
        //Action GET ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        elseif(isset($_GET['action'])) {
#AllUser    //Inscription View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
            if($_GET['action'] === 'inscription') {
                $controller->inscription();
            }
#Error      //Exception ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
            else {
                throw new Exception('Variable inattendu');
            }
        }

        else{
#AllUser    //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $controller->index();
        }
    }

    //If error, echo message and index return
    catch(Exception $e) {
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        $controller->index();
    }