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

    require("model/users.php");
    require("model/stores.php");

    $modelUsers = new Users;
    $modelStores = new Stores;
    
    
    if( isset($_POST["send"]) ) {
    
        if($action === "register") {

            if( $_POST["user_type"] === "user" && count($_POST) === 6 ) {

                $userExists = $modelUsers->checkUserExists( $_POST["name"], $_POST["email"] );

                if( $userExists ) {
                    $message = "Os campos de email e/ou nome já se encontram em uso, por favor selecione outro(s)";
                }
                else {
                    $result = $modelUsers->create( $_POST );
    
                    if($result) {
                        header("Location:" .BASE_PATH. "access/login");
                    }
                    else {
                        $message = "Preencha correctamente todos campos";
                    }
                }

            }
            elseif ( $_POST["user_type"] === "store" && count($_POST) === 8 ) {

                $storeExists = $modelStores->checkStoreExists( $_POST["name"], $_POST["email"], $_POST["address"] );

                if( $storeExists ) {
                    $message = "Os campos de email, morada e/ou nome já se encontram em uso, por favor selecione outro(s)";
                }
                else {
                    $result = $modelStores->create( $_POST );
    
                    if($result) {
                        header("Location:" .BASE_PATH. "access/login");
                    }
                    else {
                        $message = "Preencha correctamente todos campos";
                    }
                }
    
            }
            else {
                header("HTTP/1.1 400 Bad Request");
                die("Bad Request");
            }
        }
        elseif($action === "login") {

            if( $_POST["userType"] === "user" ) {

                $user = $modelUsers->login( $_POST );
            
                if( !empty($user) ) {
                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["is_admin"] = $user["is_admin"];
                    header("Location: " .BASE_PATH. "groups");
                }
                else {
                    $message = "Email ou password incorrectos.  Tente de novo.";
                }
            }
            elseif ( $_POST["userType"] === "store" ) {

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