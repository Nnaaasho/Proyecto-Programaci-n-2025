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
    public function registrar($nombre, $email, $numero, $razon, $tipo) {
        // Verificar si el nombre ya existe
        $sql = "SELECT id FROM usuarios WHERE nombre = :nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return [
                "estado" => "error",
                "mensaje" => "El nombre de usuario ya está registrado."
            ];
        }

        $sql1 = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $this->conexion->prepare($sql1);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return [
                "estado" => "error",
                "mensaje" => "El correo electronico ya está registrado."
            ];
        }


        // Prepara la consulta para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, numero, razon, tipo) VALUES (:nombre, :email, :numero, :razon, :tipo)";
        $stmt = $this->conexion->prepare($sql);
        // Asocia los parámetros con las variables correspondientes
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":razon", $razon);
        $stmt->bindParam(":tipo", $tipo);

        // Si la inserción es exitosa, retorna un mensaje de éxito y los datos del usuario
        if ($stmt->execute()) {
            return [
                "estado" => "ok",
                "mensaje" => "Usuario registrado correctamente.",
                "usuario" => [
                    "nombre" => $nombre,
                    "email" => $email,
                    "numero" => $numero,
                    "razon" => $razon,
                    "tipo" => $tipo
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
