<?php

include_once 'version1.php';
include_once 'conexion.php';
include_once 'menu.php';
include_once 'hero.php';
include_once 'contacto.php';
include_once 'rrss.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer 3312') {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once 'conexion.php';
            include_once 'conexion2.php';
            include_once 'servicios.php';
            include_once 'aboutus.php';
            include_once 'menu.php';
            include_once 'hero.php';
            include_once 'contacto.php';
            include_once 'rrss.php';
            
            //se realiza la instancia
            $modelo = new servicios();
            $lista = $modelo->getAll();

            http_response_code(200);
            echo json_encode(['data' => $lista]);

            
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'No implementado']);
        break;
}
