expresionEmail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;

$(document).ready(function () {
    
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