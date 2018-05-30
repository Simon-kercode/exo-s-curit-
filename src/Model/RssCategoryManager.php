<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class RssCategoryManager extends Manager {
        //Control Rss Category ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function controlRssCategory($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category Request 
            $request = $db->prepare('SELECT * FROM rsscategories WHERE idAccount = ?');
            $request -> execute(array($idAccount));

            return $request;
        }
        
        //Supress Rss Category ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressRssCategory($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category supress 
            $request = $db->prepare('DELETE FROM rsscategories WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }
    }