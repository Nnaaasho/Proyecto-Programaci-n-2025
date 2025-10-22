CREATE DATABASE IF NOT EXISTS sistema_usuarios CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sistema_usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    numero INT NOT NULL,
    razon VARCHAR(200) NOT NULL,
    tipo VARCHAR(250) NOT NULL,
    
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
