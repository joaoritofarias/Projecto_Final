<?php
    require("model/stores.php");
    require("model/groups.php");

    $modelStores = new Stores;
    $modelGroups = new Groups;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $store = $modelStores->getStore( $action );
        
        if( empty($store) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        $storeGroups = $modelGroups->getStoreGroups( $action );

        $storeCreatedGroups = $modelGroups->getStoreCreatedGroups( $action );

        $_SESSION["group_id"] = array();

        foreach($storeCreatedGroups as $storeCreatedGroup){
            array_push($_SESSION["group_id"], $storeCreatedGroup["group_id"]);                
        }

        require("view/store.php");

    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
