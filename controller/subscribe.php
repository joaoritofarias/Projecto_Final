<?php

    if( isset($_POST["subscribe"]) ) {

        require("model/joinedusers.php");

        $model = new Joinedusers;

        $joinedUser = $model->joinUser( $_POST, $_SESSION["user_id"] );
    
        if( empty($joinedUser) ) {
            $message = "Não foi possivel juntar-se a este grupo.";
        }

        header("Location: " .BASE_PATH. "users/" .$_SESSION["user_id"]);

    }

    require("view/group.php");

?>