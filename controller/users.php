<?php
    require("model/users.php");

    $model = new Users;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $user = $model->getUser( $action );
        
        if( empty($user) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        if( isset($_SESSION["user_id"]) ){
            if( $_SESSION["user_id"] === $action ){
                $userGroups = $model->getUserGroups( $action );
                $userCreatedGroups = $model->getUserCreated( $action );
            }
            else{
                $userCreatedGroups = $model->getUserCreated( $action );
            }
        }
        elseif( isset($_SESSION["store_id"]) ){
            $userGroups = $model->getUserGroups( $action );
            $userCreatedGroups = $model->getUserCreatedStoreGroups( $action,$_SESSION["store_id"] );

        }

        require("view/user.php");
    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
