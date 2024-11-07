<?php
namespace Controllers_Mobile;

use Model\Usuario;

class AuthApiController {
    public static function login() {
        $alertas = [];
        $data = json_decode(file_get_contents("php://input"), true);

        $usuario = new Usuario($data);

        // Validar credenciales
        $alertas = $usuario->validarLogin();

        if(empty($alertas)) {
            $usuario = Usuario::where('email', $usuario->email);
            if ($usuario && password_verify($data['password'], $usuario->password)) {
                // Generar un token de sesión
                $token = bin2hex(random_bytes(16));
                $usuario->token = $token;
                $usuario->guardar();

                // Responder con el token
                echo json_encode([
                    "success" => true,
                    "token" => $token,
                    "user" => [
                        "id" => $usuario->id,
                        "nombre" => $usuario->nombre,
                        "apellido" => $usuario->apellido,
                        "email" => $usuario->email,
                        "admin" => $usuario->admin
                    ]
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Credenciales incorrectas."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Datos no válidos."]);
        }
    }
}
