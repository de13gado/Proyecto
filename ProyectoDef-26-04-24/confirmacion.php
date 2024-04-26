<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #659db4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #f3eee7; /* Cambiado a beige */
            border: 1px solid #007BFF; /* Cambiado a azul */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación de Reserva</h1>
        <p>Gracias por reservar con nosotros. Aquí están los detalles de su reserva:</p>

        <ul>
            <li><strong>Nombre:</strong> <?php echo $nombre; ?></li>
            <li><strong>Apellidos:</strong> <?php echo $apellido1; ?> <?php echo $apellido2; ?></li>
            <li><strong>Correo Electrónico:</strong> <?php echo $correo; ?></li>
            <li><strong>Teléfono:</strong> <?php echo $telefono; ?></li>
            <li><strong>Servicio Deseado:</strong> <?php echo $servicio; ?></li>
            <li><strong>Día:</strong> <?php echo $dia; ?></li>
            <li><strong>Hora:</strong> <?php echo $hora; ?></li>
            <li><strong>Mensaje:</strong> <?php echo $mensaje; ?></li>
        </ul>

        <p><a href="Estetica.html">Volver al formulario</a></p>
    </div>
</body>
</html>
