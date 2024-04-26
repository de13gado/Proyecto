function validarFormulario() {
    var checkboxes = document.getElementsByName('seleccionar[]');
    var seleccionados = Array.prototype.slice.call(checkboxes).some(chk => chk.checked);

    if (!seleccionados) {
        alert('Por favor, seleccione al menos una casilla.');
        return false;
    }

    return true;
}