<?php
    if( !isset($_SESSION["user_id"]) && !isset($_SESSION["store_id"]) ) {
        header("Location: " .BASE_PATH. "access/login");
        exit;
    }    

    $actions = ["creategroup", "editgroup", "deletegroup"];

    if( empty($action) || !in_array($action, $actions) || ( $action === "deletegroup" && !isset($_POST["send"]) ) ) {
        header("HTTP/1.1 400 Bad Request");
        die("Bad Request");
    }

    require("model/groups.php");
    $modelGroups = new Groups;
   
    $action = $action;

    if( isset($_POST["send"]) ) {
    
        if($action === "creategroup") {

            if( isset($_SESSION["user_id"]) ) {

                if( empty($secondAction) || !in_array($secondAction, $_SESSION["groupStore_id"]) || !isset($_SESSION["groupStore_id"]) ) {
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
        }
        elseif($action === "editgroup") {

            if( isset($_SESSION["user_id"]) ) {

                if( empty($secondAction) || !in_array($secondAction, $_SESSION["group_id"]) || !isset($_SESSION["group_id"]) ) {
                    header("HTTP/1.1 400 Bad Request");
                    die("Bad Request");
                }

                $secondAction = $secondAction;

                $oldGroup = $modelGroups->getGroup($secondAction);

                if( empty($_POST["group_name"]) ) {
                    $_POST["group_name"] = $oldGroup["group_name"];
                }
                if( empty($_POST["description"]) ) {
                    $_POST["description"] = $oldGroup["description"];
                }
                if( empty($_POST["game_name"]) ) {
                    $_POST["game_name"] = $oldGroup["game_name"];
                }
                if( empty($_POST["group_date"]) ) {
                    $_POST["group_date"] = $oldGroup["group_date"];
                }
                if( empty($_POST["total_players"]) ) {
                    $_POST["total_players"] = $oldGroup["total_players"];
                }
                if( empty($_POST["group_duration"]) ) {
                    $_POST["group_duration"] = $oldGroup["group_duration"];
                }

                $newGroup = $modelGroups->editGroup($_POST, $secondAction);
    
                if($newGroup) {
                    header( "Location:" .BASE_PATH. "groups/" . $secondAction );
                }
                else {
                    if($_POST["group_date"] < date("Y-m-d hh:mm:ss")){
                        $message = "Este Playgroup já aconteceu, logo não pode ser editado";
                    }
                    else{
                        $message = "Preencha correctamente todos campos";
                    }
                }
            }
            elseif ( isset($_SESSION["store_id"])  ) {

                if( empty($secondAction) || !in_array($secondAction, $_SESSION["group_id"]) || !isset($_SESSION["group_id"]) ) {
                    header("HTTP/1.1 400 Bad Request");
                    die("Bad Request");
                }

                $secondAction = $secondAction;

                $oldGroup = $modelGroups->getGroup($secondAction);

                if( empty($_POST["group_name"]) ) {
                    $_POST["group_name"] = $oldGroup["group_name"];
                }
                if( empty($_POST["description"]) ) {
                    $_POST["description"] = $oldGroup["description"];
                }
                if( empty($_POST["game_name"]) ) {
                    $_POST["game_name"] = $oldGroup["game_name"];
                }
                if( empty($_POST["group_date"]) ) {
                    $_POST["group_date"] = $oldGroup["group_date"];
                }
                if( empty($_POST["total_players"]) ) {
                    $_POST["total_players"] = $oldGroup["total_players"];
                }
                if( empty($_POST["group_duration"]) ) {
                    $_POST["group_duration"] = $oldGroup["group_duration"];
                }

                $newGroup = $modelGroups->editGroup($_POST, $secondAction);
    
                if($newGroup) {
                    header( "Location:" .BASE_PATH. "groups/" . $secondAction );
                }
                else {
                    if($_POST["group_date"] < date("Y-m-d hh:mm:ss")){
                        $message = "Este Playgroup já aconteceu, logo não pode ser editado";
                    }
                    else{
                        $message = "Preencha correctamente todos campos";
                    }
                }
            }
        }
        elseif($action === "deletegroup") {

            if( empty($_POST["group"]) || !in_array($_POST["group"], $_SESSION["group_id"]) || !isset($_SESSION["group_id"]) ) {
                header("HTTP/1.1 400 Bad Request");
                die("Bad Request");
            }

            $deletedGroup = $modelGroups->delete( $_POST["group"] );

            if( $deletedGroup && isset($_SESSION["user_id"]) ) {
                header( "Location:" .BASE_PATH. "users/" . $_SESSION["user_id"] );
            }
            elseif( $deletedGroup && isset($_SESSION["store_id"]) ) {
                header( "Location:" .BASE_PATH. "stores/". $_SESSION["store_id"] );
            }
        }
    }


    require("view/" .$action. ".php");
   
?>