expresionEmail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
var humanoRegistro = false;

$(document).ready(function () {
    // ISLAS Y MUNICIPIOS
    // Cargar las islas en select de islas de la ventana de registro
    $.post('./php/obtenerRecursos/obtenerIslas.php',
        function(respuesta)
        {
            cadena = '';
            $.each(respuesta, function(i, tupla){
                cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
            });
            $("#registroIslas").html($("#registroIslas").html() + cadena);
        }
       , "json"
    );
    
    // Evento onchange cuando se selccione una isla
    $('#registroIslas').on('change', function (ev) {
        if($('#registroIslas').val() == 0){
            $("#registroMunicipios").attr('disabled', true);
            $("#registroMunicipios").html('<option value="0">Seleccione municipio</option>');
        }else{
            $.post('./php/obtenerRecursos/obtenerMunicipios.php', { islaSeleccionada: $('#registroIslas').val() },
                function(respuesta)
                {
                    cadena = '';
                    $.each(respuesta, function(i, tupla){
                        cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
                    });
                    $("#registroMunicipios").html( $("#registroMunicipios").html() + cadena );
                    // Habilitar el input de isla
                    $("#registroMunicipios").attr('disabled', false);
                }
                , "json"
            );
        }
    });
    
    /* Controlar los botones de slider de los "sliders" */
    $('.btn-vertical-slider').on('click', function (ev) {
        if ($(this).attr('data-slide') == 'next') {
            if($(this).parents("#myCarouselValoradas").length > 0){
                $(this).parents("#myCarouselValoradas").carousel('next');
            }
            else{
                $(this).parents("#myCarouselRecientes").carousel('next');
            }
        }
        if ($(this).attr('data-slide') == 'prev') {
            if($(this).parents("#myCarouselValoradas").length > 0){
                $(this).parents("#myCarouselValoradas").carousel('prev');
            }
            else{
                $(this).parents("#myCarouselRecientes").carousel('prev');
            }
        }
    });
    
    /* Manejar eventos ON click */
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
            $.post('./php/contacto.php', $('#formularioContacto').serialize(), 
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
    
    $('#btnEntrar').on('click', function (ev) {
        $("#menu-close").click();
        $("#modalEntrar").modal("show"); 
    });
    
    $('#btnLateralRegistrarse').on('click', function (ev) {
        $("#menu-close").click();
        $("#modalRegistrarse").modal("show");
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
    
    $('#entrarRegistrarse').on('click', function (ev) {
        ev.preventDefault();
        $("#entrarCancelar").click();
        $("#modalRegistrarse").modal("show"); 
    });
    
    // Gestion del boton de login
    $('#entrarBoton').on('click', function (ev) {
        ev.preventDefault();
        var correcto = true;
        emailEncontrado = $("#entrarEmail").val().match(expresionEmail);
        if(emailEncontrado == null){
            cambiarEstadoCaja("cajaEmailEntrar", true, "Introduzca un email correcto");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaEmailEntrar", false, "");
        }
        if($('#entrarPass').val() == ""){
            cambiarEstadoCaja("cajaPassEntrar", true, "Introduzca una contraseña");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaPassEntrar", false, "");
        }
        if(correcto){
            $.post('./php/sesion/login.php', $('#formularioEntrar').serialize(), 
                function(respuesta)
                {
                    switch(respuesta){
                        case "OK":
                            // Redireccionar a la pagina principal del usuario, las sesiones ya se habrán creado desde php
                            alert("alles klar");
                            break;
                        case "BADPASS":
                            cambiarEstadoCaja("cajaPassEntrar", true, "Contraseña incorrecta.");
                            break;
                        case "BADEMAIL":
                            cambiarEstadoCaja("cajaEmailEntrar", true, "Email no registrado.");
                            break;
                    }
                }
            );
        }
    });
    
    // Gestion del submit del formulario de registro
    $('#formularioRegistrarse').on('submit', function (ev) {
        ev.preventDefault();
        var correcto = true;
        // Email
        emailEncontrado = $("#registroEmail").val().match(expresionEmail);
        if(emailEncontrado == null){
            cambiarEstadoCaja("cajaEmailEntrar", true, "Introduzca un email correcto");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaEmailEntrar", false, "");
        }
        // Nombre
        if($('#registroNombre').val() == ""){
            cambiarEstadoCaja("cajaRegistroNombre", true, "Introduzca un nombre");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaRegistroNombre", false, "");
        }
        // Apellidos
        if($('#registroApellidos').val() == ""){
            cambiarEstadoCaja("cajaRegistroApellidos", true, "Introduzca unos apellidos");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaRegistroApellidos", false, "");
        }
        // Comprobar contraseña introducida y que la segunda coincide
        if($('#registroPassword').val() == ""){
            cambiarEstadoCaja("cajaRegistroPass", true, "Introduzca una contraseña");
            correcto = false;
        }else{
            // Comprobar si el segundo campo está vacio
            if($('#registroPass_con').val() == ""){
                cambiarEstadoCaja("cajaRegistroCon", true, "Debe volver a introducir la contraseña");
                correcto = false;
            }else{
                // Comprobar que las contraseñas coinciden
                if($('#registroPassword').val() == $('#registroPass_con').val()){
                    cambiarEstadoCaja("cajaRegistroCon", false, "");
                }else{
                    cambiarEstadoCaja("cajaRegistroCon", true, "Las contraseñas no coinciden");
                    correcto = false;
                }
            }
            cambiarEstadoCaja("cajaRegistroPass", false, "");
        }
        // Isla
        if($('#registroIslas').val() == 0){
            cambiarEstadoCaja("cajaRegistroIsla", true, "Seleccione una isla");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaRegistroIsla", false, "");
        }
        // Municipio
        if($('#registroMunicipios').val() == 0){
            cambiarEstadoCaja("cajaRegistroMunicipio", true, "Seleccione un municipio");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaRegistroMunicipio", false, "");
        }
        // Captcha
        var respuestaC = $('[name=g-recaptcha-response]').val();
        $.post('php/obtenerRecursos/comprobarCaptcha.php', {respuesta: respuestaC}, 
            function(respuesta)
            {
                if(humanoRegistro == false){
                    alert(respuesta.success);
                    if(respuesta.success == true){
                        humanoRegistro = true;
                    }else{
                        correcto = false;
                        cambiarEstadoCaja("registrarseBoton", true, "Rellene el captcha");
                    }
                }
            }, "json"
        );
        
        
        // Comenzar a enviar el registro si todo es correcto
        if(correcto == true && humanoRegistro == true){
            $.post('./php/sesion/registro.php', $('#formularioRegistrarse').serialize(), 
                function(respuesta)
                {
                    switch(respuesta){
                        case "OK":
                            // Redireccionar a la pagina principal del usuario, las sesiones 
                            // ya se habrán creado desde php se inicia sesión automaticamente
                            alert("alles klar");
                            break;
                        case "REGISTEREDUSER":
                            cambiarEstadoCaja("cajaRegistroEmail", true, "Email ya registrado.");
                            break;
                    }
                }
            );
        }
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