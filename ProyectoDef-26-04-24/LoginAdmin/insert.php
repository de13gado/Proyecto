<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "Proyecto";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar un administrador
    $nombreAdmin = "Marcela";
    $apellidosAdmin = "Madrid";
    $usernameAdmin = "marcela_admin";
    $passwordAdmin = "marcela123";


    // Encriptar la contraseña
    $hashedPassword = password_hash($passwordAdmin, PASSWORD_DEFAULT);

    // Insertar un administrador con la contraseña cifrada
    $sql_insert_admin = "INSERT INTO administradores (nombre, apellidos, username, password) VALUES (:nombre, :apellidos, :username, :password)";
    $stmt = $conn->prepare($sql_insert_admin);
    $stmt->bindParam(':nombre', $nombreAdmin);
    $stmt->bindParam(':apellidos', $apellidosAdmin);
    $stmt->bindParam(':username', $usernameAdmin);
    $stmt->bindParam(':password', $hashedPassword); // Guardar la contraseña cifrada

    $stmt->execute();

    echo "Datos del administrador insertados con éxito.";
} catch (PDOException $e) {
    echo "Error connection: " . $e->getMessage();
}

$conn = null;
?>
