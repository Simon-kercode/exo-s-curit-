<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AccountManager extends Manager {
        
        //Account Control ++++++++++++++++++++++++++++++++++++++++++++++
        function controlInscription($pseudo,$email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Pseudo Email recuperation 
            $request = $db->prepare('SELECT pseudoAccount, emailAccount FROM accounts WHERE pseudoAccount=? OR emailAccount=?');
            $request -> execute(array($pseudo, $email));
            
            return $request;
        }

        //Account Inscription ++++++++++++++++++++++++++++++++++++++++++
        function postInscriptionDb($pseudo,$email,$password) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Insert 
            $request = $db->prepare('INSERT INTO accounts (pseudoAccount, emailAccount, avatarAccount, statusAccount, passAccount) VALUES (?, ?, ?, ?, ?)');
            $request -> execute(array($pseudo, $email, "defautUser.jpg", "User", $password));
            
            return $request;           
        }
    }