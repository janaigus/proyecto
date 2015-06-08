expresionEmail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
var humanoRegistro = false;

$(document).ready(function () {
    // Evento onchange cuando se selccione una isla
    $('#registroIslas').on('change', function (ev) {
        if($('#registroIslas').val() == 0){
            $("#registroMunicipios").attr('disabled', true);
            $("#registroMunicipios").html('<option value="0">Seleccione municipio</option>');
        }else{
            $.post('../obtenerRecursos/obtenerMunicipios.php', { islaSeleccionada: $('#registroIslas').val() },
                function(respuesta)
                {
                    cadena = '<option value="0">Seleccione municipio</option>';
                    $.each(respuesta, function(i, tupla){
                        cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
                    });
                    $("#registroMunicipios").html(cadena );
                    // Habilitar el input de isla
                    $("#registroMunicipios").attr('disabled', false);
                }
                , "json"
            );
        }
    });
    
    // Gestion del submit del formulario de registro
    $('#formularioRegistrarse').on('submit', function (ev) {
        var correcto = true;
        var mensajesError = '<a class="panel-close close" data-dismiss="alert">×</a>';
        var iconoError = '<span class="glyphicon glyphicon-remove"></span>';
        // Email
        emailEncontrado = $("#registroEmail").val().match(expresionEmail);
        if(emailEncontrado == null){
            mensajesError += iconoError + "Introduzca un email correcto</br>";
            correcto = false;
        }
        // Nombre
        if($('#registroNombre').val() == ""){
            mensajesError += iconoError + "Introduzca un nombre</br>";
            correcto = false;
        }
        // Apellidos
        if($('#registroApellidos').val() == ""){
            mensajesError += iconoError + "Introduzca unos apellidos</br>";
            correcto = false;
        }
        // Isla
        if($('#registroIslas').val() == 0){
            mensajesError += iconoError + "Seleccione una isla</br>";
            correcto = false;
        }
        // Municipio
        if($('#registroMunicipios').val() == 0){
            mensajesError += iconoError + "Seleccione un municipio</br>";
            correcto = false;
        }
        // Comprobar que es correcto para enviarlo
        if(correcto == false){
            ev.preventDefault();
            $('#panelAlertas').html(mensajesError);
            $('#panelAlertas').css("display", "block");
        }
    });
    
    // ON CLICK
    // Gestión del envio del formulario de contacto
    $('#enviarFormularioContacto').on('click', function (ev) {
        ev.preventDefault();
        correcto = true;
        // Comprobar email
        emailEncontrado = $("#emailContacto").val().match(expresionEmail);
        if(emailEncontrado == null){
            cambiarEstadoCaja("cajaEmailContacto", true, "Introduzca un email correcto");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaEmailContacto", false, "");
        }
                                    
        if($('#nombreContacto').val() == ""){
            cambiarEstadoCaja("cajaNombreContacto", true, "Introduzca un nombre");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaNombreContacto", false, "");
        }
                                    
        if($('#asuntoContacto').val() == ""){
            cambiarEstadoCaja("cajaAsuntoContacto", true, "Introduzca un asunto");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaAsuntoContacto", false, "");
        }
                                    
        if($('#mensajeContacto').val() == ""){
            cambiarEstadoCaja("cajaMensajeContacto", true, "Introduzca un mensaje");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaMensajeContacto", false);
        }
                                    
        // Peticion ajax, mostrar el mensaje si el correo se ha enviado correctamente
        if(correcto){
            $.post('../contacto.php', $('#formularioContacto').serialize(), 
                function(respuesta)
                {
                    switch(respuesta){
                        case "ENVIADO":
                            $("#mensajeInfo").html("Mensaje enviado correctamente.");
                            $("#cancelarContacto").click();
                            $("#modalInfo").modal("show"); 
                            break;
                        case "NO ENVIADO":
                            $("#mensajeInfo").html("Su mensaje no ha sido enviado por favor vuelva a intentarlo más tarde.");
                            $("#cancelarContacto").click();
                            $("#modalInfo").modal("show"); 
                            break;
                        default:
                    }
                }
            );
        }
    });
    
    $('#btnContacto').on('click', function (ev) {
        $("#modalContacto").modal("show");        
    });
    
    $('#cancelarContacto').on('click', function (ev) {
        $("#cajaNombreContacto").popover('destroy');
        $("#cajaAsuntoContacto").popover('destroy');
        $("#cajaEmailContacto").popover('destroy');
        $("#cajaMensajeContacto").popover('destroy');
    });
    
    
   
});

function cambiarEstadoCaja(nombreCaja, mal, mensaje){
    if(mal){
        $('#'+nombreCaja).popover({ trigger: 'focus', placement: 'bottom', content: mensaje });
        $('#'+nombreCaja).popover('show');
        correcto = false;
    }else{
        $('#'+nombreCaja).popover('destroy');
    }
}