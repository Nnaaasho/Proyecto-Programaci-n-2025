<?php
// Incluye el archivo de conexión a la base de datos
require_once "Conexion.php";

// Define la clase Usuario
class Usuario {
    // Propiedad privada para la conexión a la base de datos
    private $conexion;

    // Constructor de la clase
    public function __construct() {
        // Inicializa la conexión usando la clase Conexion
        $this->conexion = (new Conexion())->conectar();
    }

    // Método para registrar un nuevo usuario
    public function registrar($nombre, $email, $telefono, $razon, $tipo) {
        // Prepara una consulta para verificar si el email ya existe
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $this->conexion->prepare($sql);
        // Asocia el parámetro :email con la variable $email
        $stmt->bindParam(":email", $email);
        // Ejecuta la consulta
        $stmt->execute();

        // Si el email ya está registrado, retorna un mensaje de error
        if ($stmt->rowCount() > 0) {
            return [
                "estado" => "error",
                "mensaje" => "El correo ya está registrado."
            ];
        }

        // Prepara la consulta para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, telefono, razon, tipo) VALUES (:nombre, :email, :telefono, :razon, :tipo)";
        $stmt = $this->conexion->prepare($sql);
        // Asocia los parámetros con las variables correspondientes
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":razon", $razon);
        $stmt->bindParam(":tipo", $tipo);

        // Si la inserción es exitosa, retorna un mensaje de éxito y los datos del usuario
        if ($stmt->execute()) {
            return [
                "estado" => "ok",
                "mensaje" => "Usuario registrado correctamente.",
                "usuario" => [
                    "nombre" => $nombre,
                    "email" => $email
                ]
            ];
        } else {
            // Si ocurre un error al registrar, retorna un mensaje de error
            return [
                "estado" => "error",
                "mensaje" => "Error al registrar el usuario."
            ];
        }
    }
}
?>
