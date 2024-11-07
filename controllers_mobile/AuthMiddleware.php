<?php

namespace Controllers_Mobile;

use Model\Usuario;

class AuthMiddleware {
    public static function handle($next) {
        // Obtener encabezados de la solicitud
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? '';

        // Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if (!$usuario) {
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "No autorizado"]);
            exit;
        }

        if ($usuario->admin != 1) {
            http_response_code(403);
            echo json_encode(["success" => false, "message" => "Acceso denegado"]);
            exit;
        }

        return $next();
    }
}