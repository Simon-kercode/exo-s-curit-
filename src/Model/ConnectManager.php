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

        //Connect Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function connectInsert($idAccount,$idCircleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Cercle Link Insert 
            $request = $db->prepare('INSERT INTO connect (idAccount,idCercleLink) VALUES (?,?)');
            $request -> execute(array($idAccount,$idCircleLink));
        }
    }