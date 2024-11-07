<?php

namespace Controllers_Mobile;

use MVC\Router;
use Model\Registro;
use Classes\Paginacion;
use Model\Paquete;
use Model\Usuario;

class RegistradosApiController {

    public static function index(Router $router) {
        AuthMiddleware::handle(function() use ($router) {
            /*if(!is_admin()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Unauthorized']);
                return;
            }*/

            $registros = Registro::all(); 
            foreach($registros as $registro) { 
                $registro->usuario = Usuario::find($registro->usuario_id); 
                $registro->paquete = Paquete::find($registro->paquete_id); 
            } 
            echo json_encode($registros);
        
        });
    }
    
}
