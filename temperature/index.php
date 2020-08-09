<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    //get request URI
    $requestUri = $_SERVER['REQUEST_URI'];
    //split uri parts
    $uriParts = explode('/', $requestUri);
    //get uri info
    $controller = $uriParts[sizeof($uriParts) - 2];
    $parameters = $uriParts[sizeof($uriParts) - 1];

    //send controllers
    switch($controller) {
        case strtolower('station'): 
            require_once('stationcontroller.php'); 
            seguridad 
            break;
        default:
            echo json_encode(array(
                'status' => 999,
                'errorMessage' => 'Invalid Controller'
            ));
    }
?>