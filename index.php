<?php
    session_start();

    define("BASE_PATH", "/" );

    $url_parts = explode("/", $_SERVER["REQUEST_URI"]);

    $controllers = [
        "access",
        "groups",
        "users",
        "stores",
        "choosestore",
        "groupinteract",
        "joinedusers",
        "profileinteract",
        "searchgroups",
        "editgroup",
        "admin"
    ];

    $controller = "groups";

    if( !empty($url_parts[1]) ) {

        if( !in_array($url_parts[1], $controllers) ) {
            header("HTTP/1.1 404 Not Found");
            die("404 Not Found");
        }
        
        $controller = $url_parts[1];
    }

    if( isset($url_parts[2]) ) {
        $action = $url_parts[2];
    }

    if( isset($url_parts[3]) ) {
        $secondAction = $url_parts[3];
    }

    require("controller/" .$controller. ".php")

?>