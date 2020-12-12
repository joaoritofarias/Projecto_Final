<?php
    require("model/stores.php");

    $model = new Stores;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $storeGroups = $model->getStoreAndGroups( $action );
        
        if( empty($storeGroups) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        require("view/store.php");

    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
