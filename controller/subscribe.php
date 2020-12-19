<?php

    if( isset($_POST["subscribe"]) ) {

        require("model/joinedusers.php");

        $model = new Joinedusers;

        $joinedUsers = $model->joinUser( $_POST, $_SESSION["user_id"] );

        header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);

    }

    require("view/group.php");

?>