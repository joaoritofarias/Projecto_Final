<?php
    $actions = ["subscribe", "unsubscribe"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    $action = $action;

    require("model/joinedusers.php");
    require("model/groups.php");

    $modelJoinedUsers = new Joinedusers;
    $modelGroups = new Groups;

    if( $action === "subscribe" ) {

        $usersInGroup = $modelJoinedUsers->getJoinedUsers( $_POST["group"] );

        $numberOfPlayers = $modelGroups->getGroup( $_POST["group"] );

        if( (int)$numberOfPlayers["total_players"] !== count($usersInGroup) ) {
            $joinedUsers = $modelJoinedUsers->joinUser( $_POST, $_SESSION["user_id"] );

            header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);

        }
        else {
            header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);
        }


    }
    elseif( $action === "unsubscribe" ) {
    
        $deletedJoinedUser = $modelJoinedUsers->deleteJoinedUser( $_SESSION["user_id"] );

        header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);
    
    }
?>