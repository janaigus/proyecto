expresionEmail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;

$(document).ready(function () {
    // Gestion del submit del formulario de registro
    $('#formularioPerfil').on('submit', function (ev) {
        var correcto = true;
        var mensajesError = '<a class="panel-close close" data-dismiss="alert">×</a>';
        var iconoError = '<span class="glyphicon glyphicon-remove"></span>';
        // Email
        emailEncontrado = $("#email").val().match(expresionEmail);
        if(emailEncontrado == null){
            mensajesError += iconoError + "Introduzca un email correcto</br>";
            correcto = false;
        }
        // Nombre
        if($('#nombre').val() == ""){
            mensajesError += iconoError + "Introduzca un nombre</br>";
            correcto = false;
        }
        // Apellidos
        if($('#apellidos').val() == ""){
            mensajesError += iconoError + "Introduzca unos apellidos</br>";
            correcto = false;
        }
        // Nick
        if($('#nick').val() == ""){
            mensajesError += iconoError + "Introduzca un nick</br>";
            correcto = false;
        }
        // Comprobar contraseña introducida y que la segunda coincide
        if($('#password').val() != ""){
            // Comprobar si el segundo campo está vacio
            if($('#confirmPass').val() == ""){
                mensajesError += iconoError + "Debe repetir la contraseña</br>";
                correcto = false;
            }else{
                // Comprobar que las contraseñas coinciden
                if($('#password').val() != $('#confirmPass').val()){
                    mensajesError += iconoError + "Las contraseñas no coinciden</br>";
                    correcto = false;
                }
            }
        }
        // Comprobar que es correcto para enviarlo
        if(correcto == false){
            ev.preventDefault();
            $('#panelAlertas').html(mensajesError);
            $('#panelAlertas').css("display", "block");
        }
    });
    
    $('#cambiarInfo').on('click', function (ev) {
        ev.preventDefault();
        if($(this).html() == "Cancelar"){
            location.reload();
        }else{
            $(this).html("Cancelar");
            $('#guardarCambios').css("visibility", "visible");
            $('#formularioPerfil input[disabled=disabled]').attr("disabled", false);
        }
    });    
    
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
    
    // Cuando se presione el boton procesar baja enviar el formulario que tramitará la baja
    $('#procesarBaja').on('click', function (ev) {
        ev.preventDefault();
        $('#borrarPerfil').submit();
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