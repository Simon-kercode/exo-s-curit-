<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class RssManager extends Manager {
        //Rss Request Category ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function rssRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $requestFirst = $db->prepare('SELECT * FROM rss INNER JOIN deffine ON rss.idRss=deffine.idRss INNER JOIN rsscategories ON deffine.idRssCategory=rsscategories.idRssCategory WHERE rsscategories.idAccount = ?');
            $requestFirst-> execute(array($idAccount));

            return $requestFirst;
        }
    }