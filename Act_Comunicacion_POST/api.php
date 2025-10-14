<?php
// Permitir solicitudes desde cualquier origen (para pruebas o localhost)
header('Access-Control-Allow-Origin: *');
// Permitir métodos específicos (seguridad)
header('Access-Control-Allow-Methods: POST, OPTIONS');
// Permitir tipos de encabezados enviados por el cliente
header('Access-Control-Allow-Headers: Content-Type');
// En producción, no se recomienda usar *, sino limitar a tu dominio, por ejemplo:
// header('Access-Control-Allow-Origin: https://tu-dominio.com');

$input = json_decode(file_get_contents("php://input"), true);

// Verificar si faltan campos obligatorios
if (!$input['nombre'] || !$input['correo'] || !$input['clave']) {
    echo json_encode([
        "estado" => "error", 
        "mensaje" => "Faltan campos obligatorios."
    ]);
    exit;
}

// Validar el correo electrónico
if (!filter_var($input['correo'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "estado" => "error", 
        "mensaje" => "Correo inválido."
    ]);
    exit;
}

// Respuesta exitosa
echo json_encode([
    "estado" => "ok",
    "mensaje" => "Usuario registrado correctamente.",
    "usuario" => $input
]);
?>
