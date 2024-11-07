<?php

namespace Controllers;

use Model\EventoHorario;

class APIEventos {

    public static function index() {

        // Configurar CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $dia_id = $_GET['dia_id'] ?? '';
        $categoria_id = $_GET['categoria_id'] ?? '';

        // Imprimir para verificar los valores
        var_dump($dia_id, $categoria_id); // Esto debería mostrar los valores que llegan en la URL

        $dia_id = filter_var($dia_id, FILTER_VALIDATE_INT);
        $categoria_id = filter_var($categoria_id, FILTER_VALIDATE_INT);

        if(!$dia_id || !$categoria_id) {
           echo json_encode([]);
           return;
        }

        // Consultar la base de datos
        $eventos = EventoHorario::whereArray(['dia_id' => $dia_id, 'categoria_id' => $categoria_id]) ?? [];
        echo json_encode($eventos);
    }
}