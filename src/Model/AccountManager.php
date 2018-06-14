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
        
        //Invite Request +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inviteRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite Request
            $request = $db->prepare('SELECT * FROM accounts INNER JOIN invite ON accounts.idAccount = invite.idAccount INNER JOIN invitation ON invite.idInvitation = invitation.idInvitation INNER JOIN cerclelink on invitation.idCercleLink = cerclelink.idCercleLink WHERE accounts.idAccount = ? ORDER BY invitation.idInvitation DESC');
            $request -> execute(array($idAccount));

            return $request;
        }

        //Invite Request second ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inviteRequestSecond($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite Request
            $requestSecond = $db->prepare('SELECT * FROM accounts INNER JOIN connect ON accounts.idAccount = connect.idAccount INNER JOIN cerclelink ON connect.idCercleLink = cerclelink.idCercleLink WHERE accounts.idAccount = ?');
            $requestSecond -> execute(array($idAccount));

            return $requestSecond;
        }

        //Warning Comment Increment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function warningAccount($pseudoAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comments Update
            $request = $db->prepare('UPDATE accounts SET warningAccount=warningAccount + 1 WHERE pseudoAccount = ?');
            $request -> execute(array($pseudoAccount));
        }

        //Account Count ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountCount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account count 
            $request = $db->query('SELECT COUNT(*) FROM accounts');

            return $request;
        }

        //Account Warning Count ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountWarningCount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account count 
            $requestSeconde = $db->query('SELECT COUNT(*) FROM accounts WHERE warningAccount != 0');

            return $requestSeconde;
        }

        //Account Warning request +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountWarningRequest() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account request 
            $request = $db->query('SELECT * FROM accounts WHERE warningAccount > 0 ORDER BY warningAccount DESC');

            return $request;
        }

        //Reset Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function resetWarning($idAccount) {            
            // Data Base Connection
            $db=$this->dbConnect();
            // Account update 
            $request = $db->prepare('UPDATE accounts SET warningAccount=? WHERE idAccount=?');
            $request -> execute(array(0,$idAccount));            
        }

        //Bann Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function accountBann($idAccount) {            
            // Data Base Connection
            $db=$this->dbConnect();
            // Account update 
            $request = $db->prepare('UPDATE accounts SET statusAccount=? WHERE idAccount=?');
            $request -> execute(array("Bann",$idAccount));            
        }

        //User to Admin Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function userAdmin($idAccount) {            
            // Data Base Connection
            $db=$this->dbConnect();
            // Account update 
            $request = $db->prepare('UPDATE accounts SET statusAccount=? WHERE idAccount=?');
            $request -> execute(array("Admin",$idAccount));            
        }

        //Admin to User Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminUser($idAccount) {            
            // Data Base Connection
            $db=$this->dbConnect();
            // Account update 
            $request = $db->prepare('UPDATE accounts SET statusAccount=? WHERE idAccount=?');
            $request -> execute(array("User",$idAccount));            
        }

        //All Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function allAccount($first,$second) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account request 
            $request = $db->prepare('SELECT * FROM accounts WHERE statusAccount != ? ORDER BY pseudoAccount LIMIT '.$first.','.$second);
            $request -> execute(array("SU"));

            return $request;
        }

        function allAccountCount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account request 
            $requestFirst = $db->prepare('SELECT COUNT(*) FROM accounts WHERE statusAccount != ?');
            $requestFirst -> execute(array("SU"));

            return $requestFirst;
        }
    }