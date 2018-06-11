<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class InviteManager extends Manager {
        //Supress Invite ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressInvite($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite supress 
            $request = $db->prepare('DELETE FROM invite WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }

        //Invite Count ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inviteCount($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite count 
            $request = $db->prepare('SELECT COUNT(*) FROM invite WHERE idAccount = ?');
            $request -> execute(array($idAccount));

            return $request;
        }

        //Invite Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inviteInsert($idAccount,$idInvitation) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite Insert 
            $request = $db->prepare('INSERT INTO invite (idAccount,idInvitation) VALUES (?,?)');
            $request -> execute(array($idAccount,$idInvitation));
        }

        //Invite Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function inviteSupress($idAccount,$idInvitation) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invite supress 
            $request = $db->prepare('DELETE FROM invite WHERE idAccount = ? AND idInvitation= ?');
            $request -> execute(array($idAccount,$idInvitation));
        }
    }