<?php
    if( !isset($_SESSION["is_admin"]) ) {
        header("Location: " .BASE_PATH. "groups");
        exit;
    }

    require("model/users.php");
    require("model/stores.php");
    require("model/groups.php");

    $modelUsers = new Users;
    $modelStores = new Stores;
    $modelGroups = new Groups;

    $users = $modelUsers->getUsers();
    $stores = $modelStores->getStores();
    $groups = $modelGroups->getGroups();


    require("view/admin.php");
?>