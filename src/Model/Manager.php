<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Model;

    class Manager {
        protected function dbConnect(){
            // Connexion à la base de données
            $db = new \PDO('mysql:host=localhost;dbname=base_rssmanager;charset=utf8', 'root', '');
            return $db;
        }
    }