<?php
    //Namespace +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    namespace Project\Controller;
    
    //Object ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AdminController {
        //Admin View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function adminView() {
            $accountManager = new \Project\Model\AccountManager();
            $request = $accountManager->accountCount();

            $result = $request->fetch();

            $accountManager = new \Project\Model\AccountManager();
            $requestSeconde = $accountManager->accountWarningCount();

            $resultSeconde = $requestSeconde->fetch();

            $rssManager = new \Project\Model\RssManager();
            $requestFirst = $rssManager->rssLight();

            $resultFirst = $requestFirst->fetch();

            require('src/view/backend/adminView.php');
        }
    }