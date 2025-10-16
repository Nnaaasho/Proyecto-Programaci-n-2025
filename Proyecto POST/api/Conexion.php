<?php
// Definición de la clase Conexion para manejar la conexión a la base de datos
class Conexion {
    // Atributo privado para el host de la base de datos
    private $host = "localhost";
    // Atributo privado para el nombre de la base de datos
    private $db   = "sistema_usuarios";
    // Atributo privado para el usuario de la base de datos
    private $user = "root";
    // Atributo privado para la contraseña de la base de datos
    private $pass = "";
    // Atributo privado para el charset de la conexión
    private $charset = "utf8mb4";
    // Atributo privado para almacenar la instancia PDO
    private $pdo;

    // Método público para conectar a la base de datos y devolver la instancia PDO
    public function conectar() {
        try {
            // Crear una nueva instancia PDO con los parámetros de conexión
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}",
                $this->user,
                $this->pass
            );
            // Configurar el modo de error de PDO para lanzar excepciones
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Retornar la instancia PDO creada
            return $this->pdo;
        } catch (PDOException $e) {
            // Si ocurre un error, devolver un mensaje de error en formato JSON y terminar la ejecución
            die(json_encode([
                "estado" => "error",
                "mensaje" => "Error de conexión: " . $e->getMessage()
            ]));
        }
    }
}
?>
