<?php
include_once("config.php");

// Función para eliminar un registro por ID de ambas tablas
function eliminarRegistro($conn, $id) {
    try {
        // Eliminar de la tabla reservas
        $stmtReservas = $conn->prepare("DELETE FROM reservas WHERE id = :id");
        $stmtReservas->bindParam(':id', $id);
        $stmtReservas->execute();

        // Eliminar de la tabla servicios usando la columna 'id'
        $stmtServicios = $conn->prepare("DELETE FROM servicios WHERE id = :id");
        $stmtServicios->bindParam(':id', $id);
        $stmtServicios->execute();

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar la solicitud de eliminación si se envía un ID
    if (isset($_GET['eliminar'])) {
        $idEliminar = $_GET['eliminar'];
        eliminarRegistro($conn, $idEliminar, 'reservas'); // Eliminar de la tabla 'reservas'
        eliminarRegistro($conn, $idEliminar, 'servicios'); // Eliminar de la tabla 'servicios'
    }

    // Procesar la solicitud de eliminación de registros seleccionados
    if (isset($_POST['eliminarSeleccionados'])) {
        $seleccionados = $_POST['seleccionar'];
        foreach ($seleccionados as $id) {
            eliminarRegistro($conn, $id, 'reservas'); // Eliminar de la tabla 'reservas'
            eliminarRegistro($conn, $id, 'servicios'); // Eliminar de la tabla 'servicios'
        }
    }

    // Realiza una consulta para obtener los datos de la tabla de reservas
    $sqlReservas = "SELECT id, nombre, apellido1, apellido2, correo_electronico, telefono, servicio_deseado, dia, hora, mensaje FROM reservas ORDER BY dia ASC, hora ASC";
    $resultReservas = $conn->query($sqlReservas);

    // Realiza una consulta para obtener los datos de la tabla de servicios
    $sqlServicios = "SELECT id, nombre, apellido1, apellido2, servicio_deseado, descripcion FROM servicios ORDER BY nombre ASC"; // Corregido el orden por nombre
    $resultServicios = $conn->query($sqlServicios);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="theavenger.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
    <title>Información de Reservas</title>
</head>
<body>
    <h3>Registro de Reservas</h3>
    <div class="container">
        <form method="post" action="" onsubmit="return validarFormulario();">
            <table>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Servicio Deseado</th>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Mensaje</th>
                </tr>
                <?php
                // Usar $resultReservas en lugar de $result
                while ($row = $resultReservas->fetch()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='seleccionar[]' value='" . $row['id'] . "'></td>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['apellido1'] . " " . $row['apellido2'] . "</td>";
                    echo "<td>" . $row['correo_electronico'] . "</td>";
                    echo "<td>" . $row['telefono'] . "</td>";
                    echo "<td>" . $row['servicio_deseado'] . "</td>";
                    echo "<td>" . $row['dia'] . "</td>";
                    echo "<td>" . $row['hora'] . "</td>";
                    echo "<td>" . $row['mensaje'] . "</td>";
                    echo "</tr>";
                }
                ?>
                
            </table>
            <?php
            // Mostrar el botón de eliminar solo si se han seleccionado registros
            if ($resultReservas->rowCount() > 0) {
                echo "<button class='buttomdelete' type='submit' name='eliminarSeleccionados'>Eliminar </button>";
            }
            ?>
        </form>
    </div>
    <script src="tablaadmin.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn = null;
?>
