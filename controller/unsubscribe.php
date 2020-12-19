<?php

    if( isset($_POST["unsubscribe"]) ) {

        require("model/joinedusers.php");
    
        $model = new Joinedusers;
    
        $deletedJoinedUser = $model->deleteJoinedUser( $_SESSION["user_id"] );

        header("Location: " .BASE_PATH. "groups/" .$_POST["group"]);
    
    }
    
    require("view/group.php");
?>