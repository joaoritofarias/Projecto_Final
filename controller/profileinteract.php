<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }  

    $actions = ["updateprivacy", "updateprofile", "delete"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    $action = $action;

    require("model/users.php");
    require("model/stores.php");

    $modelUsers = new Users;
    $modelStores = new Stores;

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
    }
    
    if($action === "updateprofile"){
        require("view/updateprofile.php");
    }

?>