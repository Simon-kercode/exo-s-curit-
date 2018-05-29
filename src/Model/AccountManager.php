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

        //Email Management Control ++++++++++++++++++++++++++++++++++++++
        function emailManagementControl($email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account recuperation 
            $request = $db->prepare('SELECT emailAccount FROM accounts WHERE emailAccount=?');
            $request -> execute(array($email));
            
            return $request;
        }

        //Email Management Update ++++++++++++++++++++++++++++++++++++++++
        function emailManagementUpdate($idAccount,$email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account recuperation 
            $request = $db->prepare('UPDATE accounts SET emailAccount=? WHERE idAccount=?');
            $request -> execute(array($email,$idAccount));
        }

        //Pasword Management Control +++++++++++++++++++++++++++++++++++++
        function passwordManagementControl($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account recuperation 
            $request = $db->prepare('SELECT passAccount FROM accounts WHERE idAccount=?');
            $request -> execute(array($idAccount));
            
            return $request;
        }

        //Password Management Update ++++++++++++++++++++++++++++++++++++++++
        function passwordManagementUpdate($idAccount,$password) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account recuperation 
            $request = $db->prepare('UPDATE accounts SET passAccount=? WHERE idAccount=?');
            $request -> execute(array($password,$idAccount));
        }

        //Supress Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressAccount($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account supress 
            $request = $db->prepare('DELETE FROM accounts WHERE idAccount = ? AND statusAccount != ? AND statusAccount != ?');
            $request -> execute(array($idAccount,"Admin","SAdmin"));
        }

        //Avatar Update ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function postAvatar($nameImage,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account update 
            $request = $db->prepare('UPDATE accounts SET avatarAccount=? WHERE idAccount=?');
            $request -> execute(array($nameImage,$id));
        }        
    }