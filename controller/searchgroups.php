<?php
    require("model/groups.php");

    $model = new Groups;

    $groups = $model->getAllGroups();

    if( isset($_POST["send"]) ){

        $searchedGroups = $model->searchGroups($_POST["searchField"]);
        
    }

    require("view/searchgroups.php");
?>