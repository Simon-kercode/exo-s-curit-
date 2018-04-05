<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AllUserController{
        //Index View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function index(){
            require('src/view/frontend/indexView.php');
        }
    }
