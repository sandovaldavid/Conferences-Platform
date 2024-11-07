<?php

namespace Controllers_Mobile;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardApiController {

    public static function index(Router $router) {
        AuthMiddleware::handle(function() use ($router) {
            // Obtener últimos registros
            $registros = Registro::get(5);
            // Crear una lista de usuarios
            $usuarios = [];
            foreach($registros as $registro) {
                $usuarios[] = Usuario::find($registro->usuario_id);            
            }

            // Calcular los ingresos
            $virtuales = Registro::total('paquete_id', 2);
            $presenciales = Registro::total('paquete_id', 1);

            $ingVirtuales = $virtuales * 46.41;
            $ingPresenciales = $presenciales * 189.54;

            $ingresos = $ingVirtuales + $ingPresenciales;

            // Obtener eventos con más y menos lugares disponibles
            $menos_disponibles = Evento::ordenarLimite('disponibles', 'ASC', 5);
            $mas_disponibles = Evento::ordenarLimite('disponibles', 'DESC', 5);

            // Crear el array de respuesta
            $response = [
                'titulo' => 'Panel de Administración',
                'registros' => $usuarios,
                'ingVirtuales' => $ingVirtuales,
                'ingPresenciales' => $ingPresenciales,
                'ingresos' => $ingresos,
                'menos_disponibles' => $menos_disponibles,
                'mas_disponibles' => $mas_disponibles
            ];

            // Retornar respuesta en formato JSON
            echo json_encode($response);
        });
    }
    
}


