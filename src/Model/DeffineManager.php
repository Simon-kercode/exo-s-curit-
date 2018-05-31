<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class DeffineManager extends Manager {
        //Supress Cercle Link ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressDeffine($idRssCategory) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Deffine supress 
            $request = $db->prepare('DELETE FROM deffine WHERE idRssCategory = ?');
            $request -> execute(array($idRssCategory));
        }

        //>Deffine Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function deffineInsert($idRssCategory,$idRss) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Deffine Insert 
            $request = $db->prepare('INSERT INTO deffine (idRssCategory, idRss) VALUES (?, ?)');
            $request -> execute(array($idRssCategory,$idRss));      
        }
    }