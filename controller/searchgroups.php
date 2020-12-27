<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }

    require("model/groups.php");

    $model = new Groups;

    $groups = $model->getAllGroups();

    if( isset($_POST["send"]) ){

        $searchedGroups = $model->searchGroups($_POST["searchField"]);
        
    }

    require("view/searchgroups.php");
?>