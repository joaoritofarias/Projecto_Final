<?php
    $actions = ["updateprivacy"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    $action = $action;

    require("model/users.php");

    $model = new Users;

    if( $action === "updateprivacy" ) {

        $privacy = $model->updatePrivacy( $_POST["privacy"], $_SESSION["user_id"] );

        print_r($privacy);

        header("Location: " .BASE_PATH. "users/" .$_SESSION["user_id"]);

    }
?>