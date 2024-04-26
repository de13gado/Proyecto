<?php
// Datos de conexión a la base de datos
$host = 'localhost:3307';
$user = 'root';
$password = '';  // Reemplaza con tu contraseña de MySQL

// Usuario que deseas eliminar
$usuarioAEliminar = 'saider';

// Conexión a MySQL
try {
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Eliminar usuario
    $pdo->exec("DROP USER '$usuarioAEliminar'@'localhost'");

    // Aplicar cambios
    $pdo->exec('FLUSH PRIVILEGES');

    echo "Usuario eliminado correctamente.";
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
