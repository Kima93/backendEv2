<?php
include_once 'version1.php';
include_once 'conexion.php';
include_once 'menu.php';
include_once 'hero.php';
include_once 'contacto.php';
include_once 'rrss.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === $_token_get) {
            $lista_servicios = [];
            $lista_aboutus = [];
            $lista_menu = [];
            $lista_hero = [];
            $lista_contacto = [];
            $lista_rrss = [];

            // Llamamos al archivo que contiene la clase de conexión
            include_once 'conexion.php';
            include_once 'conexion2.php';
            include_once 'servicios.php';
            include_once 'aboutus.php';
            include_once 'menu.php';
            include_once 'hero.php';
            include_once 'contacto.php';
            include_once 'rrss.php';
           

            // Instanciamos el modelo servicios
            $modelo_servicios = new servicios();
            $lista_servicios = $modelo_servicios->getAll();

            // Instanciamos el modelo aboutus
            $modelo_aboutus = new aboutus();  
            $lista_aboutus = $modelo_aboutus->getAll();

            $modelo_menu = new menu();  
            $lista_menu = $modelo_menu->getAll();

            $modelo_hero = new hero();  
            $lista_hero = $modelo_hero->getAll();

            $modelo_contacto = new contacto();  
            $lista_contacto = $modelo_contacto->getAll();

            $modelo_rrss = new rrss();  
            $lista_rrss = $modelo_rrss->getAll();

            // Combinamos los resultados
            $respuesta = [
                'servicios' => $lista_servicios,
                'aboutus' => $lista_aboutus,
                'menu' => $lista_menu,
                'hero' => $lista_hero,
                'contacto' => $lista_contacto,
                'rrss' => $lista_rrss,
            ];

            // Respondemos con código 200 y los datos combinados
            http_response_code(200);
            echo json_encode(['data' => $respuesta]);

        } else {
            // Si no hay autorización adecuada
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;


    case 'POST':
        if ($_authorization === $_token_post) {
            include_once 'conexion.php';
            include_once 'servicios.php';
            include_once 'aboutus.php';
            include_once 'menu.php';
            include_once 'hero.php';
            include_once 'contacto.php';
            include_once 'rrss.php';

            
            //se realiza la instancia al modelo Indicador
            $modelo = new servicios();
            
            $body = json_decode(file_get_contents("php://input", true)); 
            
            $modelo->setCodigo($body->codigo);
            $modelo->setNombre($body->nombre);
            $modelo->setUnidadMedidaId($body->unidad_medida_id);
            $modelo->setValor($body->valor);
            
            $respuesta = $modelo->add($modelo);
            if ($respuesta) {
                http_response_code(201);
                echo json_encode(['Creado' => 'Sin errores']);
            }
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
