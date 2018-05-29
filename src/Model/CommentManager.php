<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class CommentManager extends Manager {
        //Supress Cercle Link ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressComment($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $request = $db->prepare('DELETE FROM comments WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }
    }