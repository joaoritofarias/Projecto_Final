<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }  

    $actions = ["updateprivacy", "updateprofile", "changepassword", "delete"];

    if( empty($action) || !in_array($action, $actions) || ( $action === "updateprivacy" && !isset($_POST["send"]) ) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    $action = $action;

    require("model/users.php");
    require("model/stores.php");

    $modelUsers = new Users;
    $modelStores = new Stores;

    if( $action === "delete") {
        
        if( isset($_SESSION["user_id"]) ) {
            $modelUsers->delete(  $_SESSION["user_id"] );

            if($modelUsers){
                session_destroy();
            }
        }
        elseif ( isset($_SESSION["store_id"])  ) {
            $modelStores->delete(  $_SESSION["store_id"] );

            if($modelStores){
                session_destroy();
            }
        }

        header("Location: " . BASE_PATH);
        exit;
    }

    if( isset($_POST["send"]) ) {

        if( $action === "updateprivacy" ) {

            $privacy = $modelUsers->updatePrivacy( $_POST["privacy"], $_SESSION["user_id"] );

            header("Location: " .BASE_PATH. "users/" .$_SESSION["user_id"]);

        }
        elseif( $action === "updateprofile" ) {

            if( isset($_SESSION["user_id"]) ) {

                $oldProfile = $modelUsers->getUser( $_SESSION["user_id"] );

                if( empty($_POST["name"]) ) {
                    $_POST["name"] = $oldProfile[0]["name"];
                }
                if( empty($_POST["email"]) ) {
                    $_POST["email"] = $oldProfile[0]["email"];
                }
                if( empty($_POST["bio"]) ) {
                    $_POST["bio"] = $oldProfile[0]["bio"];
                }

                $newProfile = $modelUsers->updateProfile( $_POST, $_SESSION["user_id"] );
            
                if($newProfile) {
                    header("Location: " .BASE_PATH. "users/" .$_SESSION["user_id"]);
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
        
            }
            elseif ( isset($_SESSION["store_id"])  ) {

                $oldProfile = $modelStores->getStore( $_SESSION["store_id"] );

                if( empty($_POST["name"]) ) {
                    $_POST["name"] = $oldProfile[0]["name"];
                }
                if( empty($_POST["email"]) ) {
                    $_POST["email"] = $oldProfile[0]["email"];
                }
                if( empty($_POST["address"]) ) {
                    $_POST["address"] = $oldProfile[0]["address"];
                }
                if( empty($_POST["city"]) ) {
                    $_POST["city"] = $oldProfile[0]["city"];
                }
        
                $newProfile = $modelStores->updateProfile( $_POST, $_SESSION["store_id"] );
      
                if($newProfile) {
                    header( "Location:" .BASE_PATH. "stores/". $_SESSION["store_id"] );
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
            }  
        }
        elseif( $action === "changepassword" ) {

            if( isset($_SESSION["user_id"]) ) {
                
                $result = $modelUsers->changePassword( $_SESSION["user_id"], $_POST );

                if($result) {
                    header( "Location:" .BASE_PATH. "users/". $_SESSION["user_id"] );
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
        
            }
            elseif ( isset($_SESSION["store_id"])  ) {

                $result = $modelStores->changePassword( $_SESSION["store_id"], $_POST );
      
                if($result) {
                    header( "Location:" .BASE_PATH. "stores/". $_SESSION["store_id"] );
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
            }
        }
    }
    
    require("view/" .$action. ".php");

?>