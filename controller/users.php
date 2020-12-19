<?php
    require("model/users.php");
    require("model/groups.php");

    $modelUsers = new Users;
    $modelGroups = new Groups;

    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $user = $modelUsers->getUser( $action );
        
        if( empty($user) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        if( isset($_SESSION["user_id"]) ){
            if( $_SESSION["user_id"] === $action ){
                $userGroups = $modelGroups->getUserGroups( $action );
                $userCreatedGroups = $modelGroups->getUserCreated( $action );
            }
            else{
                $userCreatedGroups = $modelGroups->getUserCreated( $action );
            }
        }
        elseif( isset($_SESSION["store_id"]) ){
            $userGroups = $modelGroups->getUserGroups( $action );
            $userCreatedGroups = $modelGroups->getUserCreatedStoreGroups( $action,$_SESSION["store_id"] );

        }

        require("view/user.php");
    }
    else {
        header("HTTP/1.1 400 Bad Request");
        die("Bad request");
    }
?>
