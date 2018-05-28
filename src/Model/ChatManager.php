<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class ChatManager extends Manager {

        //Account recuperation ++++++++++++++++++++++++++++++++++++++++++++++
        function chatRequest() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chat and Account recuperation 
            $request = $db->query('SELECT chats.idChat, chats.contentChat, chats.dateChat, accounts.idAccount, accounts.pseudoAccount, accounts.avatarAccount FROM chats INNER JOIN accounts ON chats.idAccount=accounts.idAccount ORDER BY chats.dateChat DESC ');
            
            return $request;
        }

        //Chat Post ++++++++++++++++++++++++++++++++++++++++++
        function chatPost($chatContent,$idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chat Insert 
            $request = $db->prepare('INSERT INTO chats (contentChat, dateChat, idAccount) VALUES (?, NOW(), ?)');
            $request -> execute(array($chatContent,$idAccount));
            
            return $request;           
        }

        //Supress Chat ++++++++++++++++++++++++++++++++++++++++
        function supressChat($idAccount) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chat supress 
            $request = $db->prepare('DELETE FROM chats WHERE idAccount = ?');
            $request -> execute(array($idAccount));
        }
    }