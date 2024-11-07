<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }

        $por_pagina = 8;
        $total = Evento::total();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);

        $eventos = Evento::paginar($por_pagina, $paginacion->offset());

        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }

        // Comprobar si hay un mensaje en la sesión
        $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;

        // Limpiar la sesión después de obtener el mensaje
        unset($_SESSION['mensaje']);

        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Workshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion(),
            'mensaje' => $mensaje
        ]);
    }
    
    public static function crear(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
            return;
        }

        $alertas = [];
        
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        
        $evento = new Evento;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
                return;
            }
            
            $evento->sincronizar($_POST);

            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();
                /*if($resultado) {
                    header('Location: /admin/eventos');
                    return;
                }*/
                if($resultado) {
                    $mensaje = "Agregado!";
                    $_SESSION['mensaje'] = $mensaje; // Almacenar el mensaje en la sesión
                    header('Location: /admin/eventos');
                    return;
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
    
    public static function editar(Router $router) {

        if(!is_admin()) {
            header('Location: /login');
            return;
        }

        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header('Location: /admin/eventos');
            return;
        }

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $evento = Evento::find($id);
        if(!$evento) {
            header('Location: /admin/eventos');
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
                return;
            }
            
            $evento->sincronizar($_POST);

            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();
                /*if($resultado) {
                    header('Location: /admin/eventos');
                    return;
                }*/
                if($resultado) {
                    $mensaje = "Modificado!";
                    $_SESSION['mensaje'] = $mensaje; // Almacenar el mensaje en la sesión
                    header('Location: /admin/eventos');
                    return;
                }
            }
        }

        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }


    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
                return;
            }

            $id = $_POST['id'];
            $evento = Evento::find($id);
            if(!isset($evento) ) {
                header('Location: /admin/eventos');
                return;
            }
            $resultado = $evento->eliminar();
            /*if($resultado) {
                header('Location: /admin/eventos');
                return;
            }*/
            if($resultado) {
                $mensaje = "Eliminado!";
                $_SESSION['mensaje'] = $mensaje; // Almacenar el mensaje en la sesión
                header('Location: /admin/eventos');
                return;
            }
        }

    }
}