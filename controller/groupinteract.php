<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }    

    $actions = ["creategroup"];

    if( empty($action) || !in_array($action, $actions) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    require("model/groups.php");
    $modelGroups = new Groups;
   
    $action = $action;

    if( isset($_POST["sendGroup"]) ) {
    
        if($action === "creategroup") {

            if( isset($_SESSION["user_id"]) ) {

                if( empty($secondAction) || !in_array($secondAction, $_SESSION["groupStore_id"]) ) {
                    header("HTTP/1.1 400 Bad Request");
                    die("Bad Request");
                }

                $secondAction = $secondAction;

                $result = $modelGroups->createGroup( $_POST, $secondAction, $_SESSION["user_id"] );
    
                if($result) {
                    header( "Location:" .BASE_PATH. "users/" . $_SESSION["user_id"] );
                }
                else {
                    $message = "Preencha correctamente todos campos";
                }
            }
            elseif ( isset($_SESSION["store_id"])  ) {

                $result = $modelGroups->createGroup( $_POST, $_SESSION["store_id"], 0 );
    
                if($result) {
                    header( "Location:" .BASE_PATH. "stores/". $_SESSION["store_id"] );
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
    }
    
    require("view/" .$action. ".php");
?>