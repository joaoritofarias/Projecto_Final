<?php
    require("model/groups.php");
    require("model/joinedusers.php");

    $modelGroups = new Groups;
    $modelJoinedUsers = new Joinedusers;
 
    if( !empty($action) ) {

        if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
            header("Location: " .BASE_PATH. "access/login");
            exit;
        }

        $group = $modelGroups->getGroup( $action );        

        if( empty($group) ) {
            header("HTTP/1.1 404 Not Found");
            die("Não encontrado");
        }

        $joinedUsers = $modelJoinedUsers->getJoinedUsers($action);
    
        require("view/group.php");

        $joinedUsers = array();
    }
    else {
        $groups = $modelGroups->getGroups();

        $groups = array_slice($groups, 0, 5, true);

        require("view/home.php");
    }
?>