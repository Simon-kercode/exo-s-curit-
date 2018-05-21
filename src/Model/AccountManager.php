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

        //Connection Control ++++++++++++++++++++++++++++++++++++++++++++
        function controlConnection($pseudo) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Pseudo Email recuperation 
            $request = $db->prepare('SELECT statusAccount, passAccount FROM accounts WHERE pseudoAccount=?');
            $request -> execute(array($pseudo));
            
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

        //Connection Control ++++++++++++++++++++++++++++++++++++++++++++
        function connectionDbSession($pseudo) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Pseudo Email recuperation 
            $request = $db->prepare('SELECT idAccount, pseudoAccount, avatarAccount, statusAccount FROM accounts WHERE pseudoAccount=?');
            $request -> execute(array($pseudo));
            
            return $request;
        }

        //Account Management Request ++++++++++++++++++++++++++++++++++++
        function accountManagementRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account recuperation 
            $request = $db->prepare('SELECT * FROM accounts WHERE idAccount=?');
            $request -> execute(array($idAccount));
            
            return $request;
        }

        
    }