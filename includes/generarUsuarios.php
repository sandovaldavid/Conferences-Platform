<?php
// Cargar autoload de Composer (asegúrate de que el archivo autoload.php existe en tu proyecto)
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Conexión a la base de datos
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];   
$dbname = $_ENV['DB_NAME'] ;

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para generar hash de la contraseña
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Insertar el usuario administrador
$nombre_admin = 'Admin';
$apellido_admin = 'User';
$email_admin = 'admin@example.com';
$password_admin = hashPassword('password123');  // Contraseña encriptada
$confirmado_admin = 1;
$token_admin = NULL;
$admin_admin = 1;

$sql_admin = "INSERT INTO usuarios (nombre, apellido, email, password, confirmado, token, admin) 
              VALUES ('$nombre_admin', '$apellido_admin', '$email_admin', '$password_admin', $confirmado_admin, NULL, $admin_admin)";

// Verificar la inserción del administrador
if ($conn->query($sql_admin) === TRUE) {
    echo "Usuario administrador creado exitosamente.";
} else {
    echo "Error al crear el usuario administrador: " . $conn->error . "<br>";
}

// Insertar el usuario regular
$nombre_user = 'Regular';
$apellido_user = 'User';
$email_user = 'user@example.com';
$password_user = hashPassword('password456');  // Contraseña encriptada
$confirmado_user = 1;
$token_user = NULL;
$admin_user = 0;

$sql_user = "INSERT INTO usuarios (nombre, apellido, email, password, confirmado, token, admin) 
             VALUES ('$nombre_user', '$apellido_user', '$email_user', '$password_user', $confirmado_user, NULL, $admin_user)";

// Verificar la inserción del usuario regular
if ($conn->query($sql_user) === TRUE) {
    echo "Usuario regular creado exitosamente.";
} else {
    echo "Error al crear el usuario regular: " . $conn->error . "<br>";
}

// Cerrar la conexión
$conn->close();
?>