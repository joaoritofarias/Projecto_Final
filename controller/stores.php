<?php
    require("model/stores.php");

    $model = new Stores;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $store = $model->getStore( $action );
        
        if( empty($store) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        $storeGroups = $model->getStoreGroups( $action );

        $storeCreatedGroups = $model->getStoreCreated( $action );

        require("view/store.php");

    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
