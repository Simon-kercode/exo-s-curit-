<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class ConnectManager extends Manager {
        //Supress Connect ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressConnect($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Connect supress 
            $request = $db->prepare('DELETE FROM connect WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }
    }