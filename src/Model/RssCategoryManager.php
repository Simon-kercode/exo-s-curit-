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

        //RSS Category Request +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssCategoryRequest($idAccount,$categorySelect) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category Request 
            $requestFirst = $db->prepare('SELECT * FROM rsscategories WHERE idAccount = ? AND nameRssCategory = ? ');
            $requestFirst -> execute(array($idAccount,$categorySelect));

            return $requestFirst;
        }

        //RSS Category Name Request ++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssCategoryNameRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category Request 
            $requestFourth = $db->prepare('SELECT * FROM rsscategories WHERE idAccount = ?');
            $requestFourth -> execute(array($idAccount));

            return $requestFourth;
        }

        //RSS Category Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssCategoryInsert($nameRssCategory,$idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Deffine Insert 
            $request = $db->prepare('INSERT INTO rsscategories (nameRssCategory, idAccount) VALUES (?, ?)');
            $request -> execute(array($nameRssCategory,$idAccount));
        }

        //RSS Category Control +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryRssControl($idCategory) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category Request 
            $request = $db->prepare('SELECT * FROM rsscategories INNER JOIN deffine ON rsscategories.idRssCategory=deffine.idRssCategory INNER JOIN rss ON deffine.idRss=rss.idRss WHERE rsscategories.idRssCategory = ?');
            $request-> execute(array($idCategory));

            return $request;
        }

        //RSS Category Supress +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function categoryRssSupress($idCategory) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category supress 
            $request = $db->prepare('DELETE FROM rsscategories WHERE idRssCategory = ?');
            $request -> execute(array($idCategory));
        }
    }