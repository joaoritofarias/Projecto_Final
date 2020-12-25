<?php
    $actions = ["subscribe", "unsubscribe"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    $action = $action;

    require("model/joinedusers.php");

    $model = new Joinedusers;

    if( $action === "subscribe" ) {

        $joinedUsers = $model->joinUser( $_POST, $_SESSION["user_id"] );

        header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);

    }
    elseif( $action === "unsubscribe" ) {
    
        $deletedJoinedUser = $model->deleteJoinedUser( $_SESSION["user_id"] );

        header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);
    
    }
?>