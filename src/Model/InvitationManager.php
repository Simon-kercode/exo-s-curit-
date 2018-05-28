<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class InvitationManager extends Manager {
        //Supress Invitation ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressInvitation($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Invitation supress 
            $request = $db->prepare('DELETE FROM invitation WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }
    }