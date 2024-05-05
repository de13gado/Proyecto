<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $servicio = $_POST['servicio'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];
    $mensaje = $_POST['mensaje'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=Proyecto", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar datos en la tabla de reservas
        $sql_reservas = "INSERT INTO reservas (nombre, apellido1, apellido2, correo_electronico, telefono, servicio_deseado, dia, hora, mensaje)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$correo', '$telefono', '$servicio', '$dia', '$hora', '$mensaje')";

        $conn->exec($sql_reservas);

        // Insertar datos en la tabla de cliente
        $sql_cliente = "INSERT INTO clientes (nombre, apellido1, apellido2, correo_electronico, telefono)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$correo', '$telefono')";

        $conn->exec($sql_cliente);

        // Insertar datos en la tabla de evento
        $title = $nombre . " " . $apellido1 . " " . $apellido2;
        $color = '#' . dechex(rand(0x000000, 0xFFFFFF));

        $sql_evento = "INSERT INTO evento (title, start, color)
        VALUES ('$title', '$dia', '$color')";

        $conn->exec($sql_evento);

        // Luego, puedes incluir confirmacion.php para mostrar la confirmación al usuario
        include("confirmacion.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
