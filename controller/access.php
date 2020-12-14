<?php
    $actions = ["login", "logout", "register"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }
    
    $action = $action;

    if( $action === "logout") {
        session_destroy();

        header("Location: " . BASE_PATH);
        exit;
    }
    
    
    if( isset($_POST["send"]) ) {
    
        if($action === "register") {

            if( $_POST["user_type"] === "user" ) {

                require("model/users.php");
                $modelUsers = new Users;

                $result = $modelUsers->create( $_POST );
    
                if($result) {
                    header("Location:" .BASE_PATH. "access/login");
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
            }
            elseif ( $_POST["user_type"] === "store" ) {

                require("model/stores.php");
                $modelStores = new Stores;

                $result = $modelStores->create( $_POST );
    
                if($result) {
                    header("Location:" .BASE_PATH. "access/login");
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
            }
            else {
                header("HTTP/1.1 400 Bad Request");
                die("Bad Request");
            }
        }
        elseif($action === "login") {

            if( $_POST["userType"] === "user" ) {

                require("model/users.php");
                $modelUsers = new Users;

                $user = $modelUsers->login( $_POST );
            
                if( !empty($user) ) {
                    $_SESSION["user_id"] = $user["user_id"];
                    header("Location: " .BASE_PATH. "groups");
                }
                else {
                    $message = "Email ou password incorrectos.  Tente de novo.";
                }
            }
            elseif ( $_POST["userType"] === "store" ) {

                require("model/stores.php");
                $modelStores = new Stores;

                $store = $modelStores->login( $_POST );
            
                if( !empty($store) ) {
                    $_SESSION["store_id"] = $store["store_id"];
                    header("Location: " .BASE_PATH. "groups");
                }
                else {
                    $message = "Email ou password incorrectos.  Tente de novo.";
                }
            }
            else {
                header("HTTP/1.1 400 Bad Request");
                die("Bad Request");
            }
        }
    }
    
    require("view/" .$action. ".php");
?>