<?php
    $actions = ["login", "logout", "register"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }
    
    $action = $action;
    
    
    require("model/users.php");
    $modelUsers = new Users;
    
    if( isset($_POST["send"]) ) {
    
        if($action === "register") {
    
            $result = $modelUsers->create( $_POST );
    
            if($result) {
                header("Location: access/register");
            }
            else {
                $message = "Preencha correctamente todos campos";
            }
        }
    }
    
    
    require("view/" .$action. ".php");
?>