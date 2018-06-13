<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class RssManager extends Manager {
        //Rss Request Category +++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $requestFirst = $db->prepare('SELECT * FROM rss INNER JOIN deffine ON rss.idRss=deffine.idRss INNER JOIN rsscategories ON deffine.idRssCategory=rsscategories.idRssCategory WHERE rsscategories.idAccount = ?');
            $requestFirst-> execute(array($idAccount));

            return $requestFirst;
        }
        
        //Rss  Request +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cardRssRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $requestThird = $db->prepare('SELECT * FROM rss INNER JOIN deffine ON rss.idRss=deffine.idRss INNER JOIN rsscategories ON deffine.idRssCategory=rsscategories.idRssCategory WHERE rsscategories.idAccount = ? ORDER BY RAND()');
            $requestThird-> execute(array($idAccount));

            return $requestThird;
        }

        //Rss Isert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssInsertDb($urlRss,$nameRss) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Insert 
            $request = $db->prepare('INSERT INTO rss (urlRss, nameRss) VALUES (?, ?)');
            $request -> execute(array($urlRss,$nameRss));          
        }

        //Rss Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssControl($urlRss,$nameRss) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Request 
            $request = $db->prepare('SELECT * FROM rss WHERE urlRss=? AND nameRss=? ORDER BY idRss DESC LIMIT 1');
            $request -> execute(array($urlRss,$nameRss));

            return $request;
        }

        //Rss By Category ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssByCategoryRequest($idAccount,$idCategory) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $request = $db->prepare('SELECT * FROM rss INNER JOIN deffine ON rss.idRss=deffine.idRss INNER JOIN rsscategories ON deffine.idRssCategory=rsscategories.idRssCategory WHERE rsscategories.idAccount = ? AND rsscategories.idRssCategory=? ORDER BY RAND()');
            $request-> execute(array($idAccount,$idCategory));

            return $request;
        }

        //Rss Supress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++        
        function supressRss($idRss) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss supress 
            $request = $db->prepare('DELETE FROM rss WHERE idRss = ?');
            $request -> execute(array($idRss));
        }

        //RSS Light +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssLight() {
            // Data Base Connection
            $db=$this->dbConnect();
            // RSS Light 
            $requestFirst = $db->prepare('SELECT * FROM rss WHERE momentRss = ?');
            $requestFirst-> execute(array("Light"));

            return $requestFirst;
        }
    }