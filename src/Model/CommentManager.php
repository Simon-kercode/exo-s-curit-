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

        //Request Cercle Link ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function commentRequest($idCircleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Rss Category Request 
            $requestFirst = $db->prepare('SELECT * FROM comments INNER JOIN accounts ON comments.idAccount=accounts.idAccount WHERE comments.idCercleLink = ? ORDER BY comments.dateComment DESC');
            $requestFirst -> execute(array($idCircleLink));

            return $requestFirst;
        }

        //Comment Insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function commentInsert($contentComment,$idAccount,$idCercleLink) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Cercle Link Insert 
            $request = $db->prepare('INSERT INTO comments (contentComment,dateComment,idAccount,idCercleLink) VALUES (?,NOW(),?,?)');
            $request -> execute(array($contentComment,$idAccount,$idCercleLink));
        }
    }