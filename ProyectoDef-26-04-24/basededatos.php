<?php
// Establecer la conexión con el servidor de bases de datos (reemplaza estos valores con los tuyos)
$servername = "localhost:3307"; // Cambia esto si tu servidor MySQL no se encuentra en localhost
$username = "root";
$password = "";

try {
    // Conectarse al servidor MySQL
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // Configurar el modo de error a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos "Proyecto" si no existe
    $sql = "CREATE DATABASE IF NOT EXISTS Proyecto";
    $conn->exec($sql);
    echo "Base de datos 'Proyecto' creada con éxito.";

    // Conectarse a la base de datos "Proyecto"
    $conn = new PDO("mysql:host=$servername;dbname=Proyecto", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla de reservas si no existe
    $sql_reservas = "CREATE TABLE IF NOT EXISTS reservas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido1 VARCHAR(255) NOT NULL,
        apellido2 VARCHAR(255) NOT NULL,
        correo_electronico VARCHAR(255) NOT NULL,
        telefono VARCHAR(15) NOT NULL,
        servicio_deseado VARCHAR(255) NOT NULL,
        dia DATE NOT NULL,
        hora TIME NOT NULL,
        mensaje TEXT
    )";

    // Crear la tabla de administradores
    $sql_admin = "CREATE TABLE IF NOT EXISTS administradores (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellidos VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    // Crear la tabla de clientes
    $sql_cliente = "CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido1 VARCHAR(255) NOT NULL,
        apellido2 VARCHAR(255) NOT NULL,
        correo_electronico VARCHAR(255) NOT NULL,
        telefono VARCHAR(15) NOT NULL
    )";

    // Crear la tabla de servicios
    $sql_servicio = "CREATE TABLE IF NOT EXISTS servicios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido1 VARCHAR(255) NOT NULL,
        apellido2 VARCHAR(255) NOT NULL,
        servicio_deseado VARCHAR(255) NOT NULL,
        descripcion TEXT
    )";

    // Crear la tabla de eventos
    $sql_evento = "CREATE TABLE IF NOT EXISTS evento (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        start DATE NOT NULL,
        color VARCHAR(100) NOT NULL
    )";

    // Ejecutar las consultas
    $conn->exec($sql_reservas);
    $conn->exec($sql_admin);
    $conn->exec($sql_cliente);
    $conn->exec($sql_servicio);
    $conn->exec($sql_evento);

    echo "Tablas creadas con éxito en la base de datos 'Proyecto'.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
?>
