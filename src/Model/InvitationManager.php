<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class InvitationManager extends Manager {
        //Invitation Link Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationInsert($invitContent,$idCercleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invitation Insert 
            $request = $db->prepare('INSERT INTO invitation (contentInvitation,dateInvitation,idCercleLink) VALUES (?,NOW(),?)');
            $request -> execute(array($invitContent,$idCercleLink));
        }

        //Cercle Link Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationControl($idCercleLink,$invitContent) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invitation Request 
            $request = $db->prepare('SELECT * FROM invitation WHERE idCercleLink=? AND contentInvitation=? ORDER BY idInvitation DESC LIMIT 1');
            $request -> execute(array($idCercleLink,$invitContent));

            return $request;
        }

        //Supress Invitation  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function invitationSupress($idInvitation) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invitation supress 
            $request = $db->prepare('DELETE FROM invitation WHERE idInvitation = ?');
            $request -> execute(array($idInvitation));
        }
    }