<?php

$_method = $_SERVER['REQUEST_METHOD'];
$_host = $_SERVER['HTTP_HOST'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);

//configuración de headers
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-ALlow-Methods: GET, POST"); 
header("Content-Type: application/json; charset=UTF-8");

//Configuración de Authorization
$_authorization = null;
try {
    if (isset(getallheaders()['Authorization'])) {
        $_authorization = getallheaders()['Authorization'];
        // echo 'tenemos una autorizacion';
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'No tiene autorizacion']);
    }
} catch (Exception $e) {
    echo 'error';
}

$_token_get = 'Bearer 3312';
$_token_post = 'Bearer 3312';