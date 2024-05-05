<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/main.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.css" rel="stylesheet" />
</head>
<head>
        <title>Home</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <style>
            body {
                font-family: 'Times New Roman', Times, serif;
                margin: 20px;
            }




            .center {
                text-align: center;
            }

            .opcion {
                padding: 5px 0;
            }

            .barra {
                background-color: rgb(152, 196, 236);
                border-radius: 4px;
                padding: 10px;
            }

            .seleccionado {
                background-color: rgb(33, 90, 143);
                border-radius: 4px;
                color: rgb(170, 14, 14);
                padding: 10px;
            }

            #menu {
                background-color: #eee;
                padding: 10px;
            }

            #menu ul {
                margin: 0;
                padding: 0;
                list-style: none;
                display: flex; /* Cambiado a flexbox para mejor manejo en dispositivos pequeños */
                justify-content: space-around; /* Alineación de elementos */
                align-items: center;
            }

            #menu ul li {
                display: inline;
            }

            #menu ul li a {
                color: #1E69E3;
                text-decoration: none;
            }

            #menu ul li a:hover {
                color: rgb(227, 109, 30);
                text-decoration: none;
            }

            .cerrar-sesion {
                float: right;
            }

            h1,
            h3 {
                text-align: center;
            }

            /* Media query para ajustar el menú en dispositivos más pequeños */
            @media screen and (max-width: 600px) {
                #menu ul {
                    flex-direction: column; /* Cambia la dirección de la fila a columna */
                    text-align: center;
                }
        </style>
        </head>
        <div id="menu">
            <ul>
                <li class="Home">
                    <a href="/NOFICIAL/LoginAdmin/index.php">Home</a>
                </li>
                <li>Calendario</li>
                <li class="cerrar-sesion">
                    <a href="/NOFICIAL/LoginAdmin/includes/logout.php">Cerrar sesión</a>
                </li>
        
            </ul>
        </div>



<body>
    <div class="container">
        <div id="calendar"></div>
    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="titulo">Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formulario" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="hidden" id="id" name="id">
                                    <input id="title" type="text" class="form-control" name="title">
                                    <label for="title">Evento</label>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="start" type="date" name="start">
                                    <label for="" class="form-label">Fecha</label>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="color" type="color" name="color">
                                    <label for="color" class="form-label">Color</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                        <button type="submit" class="btn btn-primary" id="btnAccion">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/main.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/es.js"></script>
    <script>
    const base_url = '<?php echo base_url; ?>';

    // Función para obtener los eventos desde la base de datos y mostrarlos en el calendario
    function obtenerEventos() {
        // Realizar petición POST para obtener los eventos
        fetch('http://localhost/obtener_eventos.php', { // Actualiza la URL según tu configuración
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                // Puedes enviar parámetros adicionales si es necesario
            })
        })
        .then(response => response.json())
        .then(data => {
            // Mostrar los eventos en el calendario
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: data // Suponiendo que data es un array de eventos en el formato requerido por FullCalendar
            });
            calendar.render();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Llamar a la función para obtener los eventos al cargar la página
    window.onload = function() {
        obtenerEventos();
    };
</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url; ?>Assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.9.0/main.min.js"></script>
</body>

</html>
