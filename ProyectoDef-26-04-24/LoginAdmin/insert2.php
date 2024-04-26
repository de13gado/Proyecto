<?php
// Datos de conexión a la base de datos
$host = 'localhost:3307';
$user = 'root';
$password = '';  // Reemplaza con tu contraseña de MySQL

// Conexión a MySQL
try {
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Nombre del nuevo usuario y contraseña
    $newUsername = 'saider';
    $newPassword = 'UlqRolcdAZvVuQpJ';  // Reemplaza con la contraseña que desees

    // Crear nuevo usuario con privilegios administrativos y configuración del método de autenticación
    $pdo->exec("CREATE USER '$newUsername'@'localhost' IDENTIFIED BY '$newPassword'");
    $pdo->exec("GRANT ALL PRIVILEGES ON *.* TO '$newUsername'@'localhost' WITH GRANT OPTION");
    
    // Aplicar cambios
    $pdo->exec('FLUSH PRIVILEGES');

    echo "Usuario creado y privilegios otorgados correctamente.";
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
