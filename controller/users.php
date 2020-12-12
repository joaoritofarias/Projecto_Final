<?php
    require("model/users.php");

    $model = new Users;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $userGroups = $model->getUserAndGroups( $action );
        
        if( empty($userGroups) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        require("view/user.php");

    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
