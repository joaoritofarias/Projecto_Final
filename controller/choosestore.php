<?php
    require("model/stores.php");

    $model = new Stores;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }
        
        if( isset($_SESSION["user_id"]) ){

            $stores = $model->getStoresFromCity($action);

            if( empty($stores) ) {
                header("HTTP/1.1 404 Not Found");
                die("Não encontrado");
            }
            
            $_SESSION["groupStore_id"] = array();

            foreach($stores as $store){
                array_push($_SESSION["groupStore_id"], $store["store_id"]);                
            }


        }
        elseif( isset($_SESSION["store_id"]) ){
            header("Location: " .BASE_PATH. "groupinteract/creategroup/" .$_SESSION["store_id"] );
            exit;
        }

        require("view/choosestore.php");
    }
    else {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        if( isset($_SESSION["user_id"]) ){
            $cities = $model->getStoreCities();

        }
        elseif( isset($_SESSION["store_id"]) ){
            header("Location: " .BASE_PATH. "groupinteract/creategroup/".$_SESSION["store_id"] );
            exit;
        }

        require("view/choosecity.php");
    }
?>