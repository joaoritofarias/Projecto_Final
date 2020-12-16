<?php
    require("model/groups.php");

    $model = new Groups;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $group = $model->getGroup( $action );
    
        if( empty($group) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }
    
        require("view/group.php");
    }
    else {
        $groups = $model->getGroups();

        require("view/home.php");
    }
?>