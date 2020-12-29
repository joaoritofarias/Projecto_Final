<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }  

    $actions = ["updateprivacy", "updateprofile", "changepassword", "delete"];

    if( empty($action) || 
        !in_array($action, $actions) || 
        ( $action === "updateprivacy" && !isset($_POST["send"]) ) 
        ){
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    if( ( !isset($_SESSION["is_admin"]) && isset($secondAction) ) || 
        ( !isset($_SESSION["is_admin"]) && isset($thirdAction) ) || 
        ( !isset($_SESSION["is_admin"]) && isset($_POST["user"]) ) ||
        ( !isset($_SESSION["is_admin"]) && isset($_POST["store"]) )
    ){
        header("HTTP/1.1 401 Unauthorized");
        die("Unauthorized");
    }

    $action = $action;

    if(isset($secondAction)){
        $secondAction = $secondAction;
    }

    if(isset($thirdAction)){
        $thirdAction = $thirdAction;
    }

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

            if( isset($_SESSION["is_admin"]) && isset($secondAction) && isset($thirdAction) ) {

                if( $secondAction === "user") {

                    $oldProfile = $modelUsers->getUser( $thirdAction );

                    if( empty($_POST["name"]) ) {
                        $_POST["name"] = $oldProfile["name"];
                    }

                    if( empty($_POST["email"]) ) {
                        $_POST["email"] = $oldProfile["email"];
                    }

                    if( empty($_POST["bio"]) ) {
                        $_POST["bio"] = $oldProfile["bio"];
                    }
    
                    $newProfile = $modelUsers->updateProfile( $_POST, $thirdAction );
                
                    if($newProfile) {
                        header("Location: " .BASE_PATH. "admin/");
                    }
                    else {
                        $message = "Preencha correctamente todos campos";
                    }

                }
                elseif( $secondAction === "store" ) {

                    $oldProfile = $modelStores->getStore( $thirdAction );

                    if( empty($_POST["name"]) ) {
                        $_POST["name"] = $oldProfile["name"];
                    }

                    if( empty($_POST["email"]) ) {
                        $_POST["email"] = $oldProfile["email"];
                    }

                    if( empty($_POST["address"]) ) {
                        $_POST["address"] = $oldProfile["address"];
                    }

                    if( empty($_POST["city"]) ) {
                        $_POST["city"] = $oldProfile["city"];
                    }
            
                    $newProfile = $modelStores->updateProfile( $_POST, $thirdAction );
        
                    if($newProfile) {
                        header( "Location:" .BASE_PATH. "admin" );
                    }
                    else {
                        $message = "Preencha correctamente todos campos";
                    }
                }
            }
            if( isset($_SESSION["user_id"]) && !isset($secondAction) && !isset($thirdAction) ) {

                $oldProfile = $modelUsers->getUser( $_SESSION["user_id"] );

                if( empty($_POST["name"]) ) {
                    $_POST["name"] = $oldProfile["name"];
                }

                if( empty($_POST["email"]) ) {
                    $_POST["email"] = $oldProfile["email"];
                }

                if( empty($_POST["bio"]) ) {
                    $_POST["bio"] = $oldProfile["bio"];
                }

                $newProfile = $modelUsers->updateProfile( $_POST, $_SESSION["user_id"] );
            
                if($newProfile) {
                    header("Location: " .BASE_PATH. "users/" .$_SESSION["user_id"]);
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
        
            }
            elseif ( isset($_SESSION["store_id"]) && !isset($secondAction) && !isset($thirdAction) ) {

                $oldProfile = $modelStores->getStore( $_SESSION["store_id"] );

                if( empty($_POST["name"]) ) {
                    $_POST["name"] = $oldProfile["name"];
                }

                if( empty($_POST["email"]) ) {
                    $_POST["email"] = $oldProfile["email"];
                }

                if( empty($_POST["address"]) ) {
                    $_POST["address"] = $oldProfile["address"];
                }

                if( empty($_POST["city"]) ) {
                    $_POST["city"] = $oldProfile["city"];
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
        if( $action === "delete") {

            if( isset($_SESSION["is_admin"]) && isset($_POST["user"]) ) {
                $result = $modelUsers->delete(  $_POST["user"] );

                if($result){
                    header("Location: " . BASE_PATH . "admin");
                }
            }
            elseif( isset($_SESSION["is_admin"]) && isset($_POST["store"]) ) {
                $result = $modelStores->delete(  $_POST["store"] );

                if($result){
                    header("Location: " . BASE_PATH . "admin");
                }     
            }
            elseif( isset($_SESSION["user_id"]) ) {
                $result = $modelUsers->delete(  $_SESSION["user_id"] );
    
                if($result){
                    session_destroy();
                    header("Location: " . BASE_PATH);
                    exit;
                }
            }
            elseif ( isset($_SESSION["store_id"])  ) {
                $result = $modelStores->delete(  $_SESSION["store_id"] );
    
                if($result){
                    session_destroy();
                    header("Location: " . BASE_PATH);
                    exit;
                }
            }

        }
    }
    
    require("view/" .$action. ".php");

?>