<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class CercleLinkManager extends Manager {
        //Cercle Link Request ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleLinkRequest($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $requestSecond = $db->prepare('SELECT * FROM cerclelink INNER JOIN connect ON cerclelink.idCercleLink=connect.idCercleLink WHERE connect.idAccount = ?');
            $requestSecond-> execute(array($idAccount));

            return $requestSecond;
        }

        //Cercle Request ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleRequest($idCircleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comment supress 
            $request = $db->prepare('SELECT * FROM cerclelink INNER JOIN connect ON cerclelink.idCercleLink=connect.idCercleLink INNER JOIN accounts ON connect.idAccount=accounts.idAccount INNER JOIN rsscategories ON accounts.idAccount=rsscategories.idAccount INNER JOIN deffine ON rsscategories.idRssCategory=deffine.idRssCategory INNER JOIN rss ON deffine.idRss=rss.idRss WHERE cerclelink.idCercleLink = ? ORDER BY RAND()');
            $request-> execute(array($idCircleLink));

            return $request;
        }

        //Cercle Link Insert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleInsert($nameCercleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Cercle Link Insert 
            $request = $db->prepare('INSERT INTO cerclelink (nameCircle) VALUES (?)');
            $request -> execute(array($nameCercleLink));
        }

        //Cercle Link Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleControl($nameCercleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Request 
            $request = $db->prepare('SELECT * FROM cerclelink WHERE nameCircle=? ORDER BY idCercleLink DESC LIMIT 1');
            $request -> execute(array($nameCercleLink));

            return $request;
        }

        //Cercle Link Control ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function cercleNameRequest($idCircleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Request 
            $requestSecond = $db->prepare('SELECT * FROM cerclelink WHERE idCercleLink=?');
            $requestSecond -> execute(array($idCircleLink));

            return $requestSecond;
        }
    }