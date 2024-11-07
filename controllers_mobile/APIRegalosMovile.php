<?php

namespace Controllers_Mobile;

use Model\Regalo;
use Model\Registro;

class APIRegalosMovile {

    public static function index() {

        /*if(!is_admin()) {
            echo json_encode([]);
            return;
        }*/

        AuthMiddleware::handle(function() use ($router) {
            $regalos = Regalo::all();
            foreach($regalos as $regalo) {
                $regalo->total = Registro::totalArray(['regalo_id' => $regalo->id, 'paquete_id' => "1"]);
            }
            echo json_encode($regalos);
            return;
        });        
    }    
}