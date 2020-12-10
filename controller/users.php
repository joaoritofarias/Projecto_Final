<?php
    require("model/users.php");

    $model = new Users;

    if( !empty($action) ) {

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
