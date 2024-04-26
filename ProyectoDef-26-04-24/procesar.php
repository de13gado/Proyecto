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

    // Define las variables para el correo de confirmación
    $nombre_cliente = $nombre;
    $apellido1_cliente = $apellido1;
    $apellido2_cliente = $apellido2;
    $correo_cliente = $correo;
    $telefono_cliente = $telefono;
    $servicio_cliente = $servicio;
    $dia_cliente = $dia;
    $hora_cliente = $hora;
    $mensaje_cliente = $mensaje;

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

        // Insertar datos en la tabla de servicios
        $sql_servicio = "INSERT INTO servicios (nombre, apellido1, apellido2, servicio_deseado, descripcion)
        VALUES ('$nombre', '$apellido1', '$apellido2', '$servicio', '$mensaje')";

        $conn->exec($sql_servicio);

        // Aquí debes obtener el ID del servicio seleccionado (puedes hacerlo a través de una consulta SQL) y luego insertarlo en la tabla de servicio.

        // Luego, puedes incluir confirmacion.php para mostrar la confirmación al usuario
        include("confirmacion.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
