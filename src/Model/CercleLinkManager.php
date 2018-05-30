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
    }