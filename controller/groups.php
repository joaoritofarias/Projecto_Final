<?php
    require("model/groups.php");

    $model = new Groups;


    $groups = $model->get();

    require("view/home.php");
?>