<?php
    session_start();

    $url_parts = explode("/", $_SERVER["REQUEST_URI"]);

    $controllers = [
        "access",
        "groups"
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

    require("controller/" .$controller. ".php")

?>