<?php    
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class ChatManager extends Manager {

        //Account Control ++++++++++++++++++++++++++++++++++++++++++++++
        function chatRequest() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Pseudo Email recuperation 
            $request = $db->query('SELECT chats.idChat, chats.contentChat, chats.dateChat, accounts.idAccount, accounts.pseudoAccount, accounts.avatarAccount FROM chats INNER JOIN accounts ON chats.idAccount=accounts.idAccount ORDER BY chats.dateChat DESC ');
            
            return $request;
        }
    }