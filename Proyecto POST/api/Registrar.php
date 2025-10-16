<?php
// Establece el tipo de contenido de la respuesta como JSON y la codificación de caracteres como UTF-8
header('Content-Type: application/json; charset=utf-8');
// Permite solicitudes desde cualquier origen (CORS)
header('Access-Control-Allow-Origin: *');
// Permite los métodos POST y OPTIONS para esta API
header('Access-Control-Allow-Methods: POST, OPTIONS');
// Permite el encabezado Content-Type en las solicitudes
header('Access-Control-Allow-Headers: Content-Type');

// Incluye el archivo que contiene la clase Usuario
require_once "Usuario.php";

// Verifica que el método de la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no es POST, responde con código 405 (Método no permitido)
    http_response_code(405);
    // Devuelve un mensaje de error en formato JSON
    echo json_encode(["estado" => "error", "mensaje" => "Método no permitido."]);
    // Termina la ejecución del script
    exit;
}

// Lee el cuerpo de la solicitud (request) en formato JSON
$body = file_get_contents("php://input");
// Decodifica el JSON recibido a un array asociativo de PHP
$data = json_decode($body, true);

// Verifica que los campos 'nombre', 'email' y 'password' no estén vacíos
if (
    empty($data['nombre']) ||
    empty($data['email']) ||
    empty($data['telefono'])||
    empty($data['tipo'])||
    empty($data['razon'])
) {
    // Si algún campo está vacío, responde con código 400 (Bad Request)
    http_response_code(400);
    // Devuelve un mensaje de error en formato JSON
    echo json_encode(["estado" => "error", "mensaje" => "Todos los campos son obligatorios."]);
    // Termina la ejecución del script
    exit;
}

// Valida que el campo 'email' tenga un formato de correo electrónico válido
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    // Si el formato no es válido, responde con código 400
    http_response_code(400);
    // Devuelve un mensaje de error en formato JSON
    echo json_encode(["estado" => "error", "mensaje" => "El formato del correo no es válido."]);
    // Termina la ejecución del script
    exit;
}

// Crea una nueva instancia de la clase Usuario
$usuario = new Usuario();
// Llama al método registrar de la clase Usuario, pasando los datos validados y limpiados
$respuesta = $usuario->registrar(
    trim($data['nombre']),
    trim($data['email']),
    trim($data['telefono']),
    trim($data['razon']),
    trim($data['tipo'])
);

// Devuelve la respuesta del método registrar en formato JSON
echo json_encode($respuesta);
?>
