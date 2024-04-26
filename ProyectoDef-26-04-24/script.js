document.addEventListener("DOMContentLoaded", function () {
const inputFecha = document.getElementById('dia');
const selectHora = document.getElementById('hora');
const adminTiempoInicio = '09:00'; // Hora de inicio por defecto (puede ser modificada por el administrador)
const adminTiempoFin = '17:30';   // Hora de cierre por defecto (puede ser modificada por el administrador)
const intervaloTiempo = 30;        // Intervalo de tiempo entre servicios (minutos)

// Obtén la fecha actual
const fechaActual = new Date();
const horaActual = fechaActual.getHours() * 60 + fechaActual.getMinutes(); // Convertir la hora actual a minutos

// Establece el valor mínimo del campo de fecha a la fecha actual
inputFecha.min = fechaActual.toISOString().split('T')[0];

// Define las horas disponibles dentro del rango establecido por el administrador
let tiempoInicio = new Date('1970-01-01T' + adminTiempoInicio + ':00');
const tiempoFin = new Date('1970-01-01T' + adminTiempoFin + ':00');

// Llena el campo de selección de hora
let fechaSeleccionada = new Date(inputFecha.value);
const hoy = new Date();

// Verifica si la fecha seleccionada es la fecha actual o una fecha futura
const fechaPasada = fechaSeleccionada < hoy;

while (tiempoInicio <= tiempoFin) {
    const hora = format24Hours(tiempoInicio); // Formatear la hora en formato de 24 horas
    const horaEnMinutos = tiempoInicio.getHours() * 60 + tiempoInicio.getMinutes();

    // Verifica si la hora ya ha pasado y si la fecha seleccionada es la fecha actual
    if ((!fechaPasada || horaEnMinutos > horaActual) || fechaSeleccionada > hoy) {
      const option = document.createElement('option');
      option.text = hora;
      selectHora.add(option);
    }

    tiempoInicio = new Date(tiempoInicio.getTime() + intervaloTiempo * 60000); // Se suma el intervalo en milisegundos
}

// Función para formatear la hora en formato de 24 horas
function format24Hours(date) {
  const hours = date.getHours().toString().padStart(2, '0');
  const minutes = date.getMinutes().toString().padStart(2, '0');
  return hours + ':' + minutes;
}

// Array para llevar un registro de las horas seleccionadas
const horasSeleccionadas = [];

// Agrega un evento de cambio al campo de selección de hora
selectHora.addEventListener('change', function() {
  const tiempoSeleccionado = selectHora.value;

  // Verifica si la hora ya ha sido seleccionada
  if (horasSeleccionadas.includes(tiempoSeleccionado)) {
    // Restablece el valor del campo de hora
    selectHora.value = '';
    alert('Esta hora ya ha sido seleccionada. Por favor, elige otra hora.');
  } else {
    // Agrega la hora seleccionada al array de horas seleccionadas
    horasSeleccionadas.push(tiempoSeleccionado);
  }
  });

  // Evento para actualizar las opciones de hora al cambiar la fecha
  inputFecha.addEventListener('input', function() {
    // Borra las opciones existentes
    selectHora.innerHTML = '';

    // Vuelve a llenar el campo de selección de hora
    fechaSeleccionada = new Date(inputFecha.value);
    const fechaPasada = fechaSeleccionada < hoy;

    tiempoInicio = new Date('1970-01-01T' + adminTiempoInicio + ':00');

    while (tiempoInicio <= tiempoFin) {
      const hora = format24Hours(tiempoInicio); // Formatear la hora en formato de 24 horas
      const horaEnMinutos = tiempoInicio.getHours() * 60 + tiempoInicio.getMinutes();

      // Verifica si la hora ya ha pasado y si la fecha seleccionada es la fecha actual
      if ((!fechaPasada || horaEnMinutos > horaActual) || fechaSeleccionada > hoy) {
        const option = document.createElement('option');
        option.text = hora;
        selectHora.add(option);
      }

      tiempoInicio = new Date(tiempoInicio.getTime() + intervaloTiempo * 60000); // Se suma el intervalo en milisegundos
    }
  });
});
  