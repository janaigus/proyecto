expresionEmail = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
var humanoRegistro = false;

$(document).ready(function () {
    
    
    // ISLAS Y MUNICIPIOS
    // Cargar las islas en select de islas de la ventana de registro
    $.getJSON('./php/obtenerRecursos/obtenerIslas.php',
        function(respuesta)
        {
            cadena = '<option value="0">Seleccione isla</option>';
            $.each(respuesta, function(i, tupla){
                cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
            });
            $("#registroIslas").html(cadena);
            $("#busquedaIslas").html(cadena);
        }
    );
    
    // Campos de busqueda
    $('#busquedaIslas').on('change', function (ev) {
        if($('#busquedaIslas').val() == 0){
            $("#busquedaMunicipios").attr('disabled', true);
            $("#busquedaMunicipios").html('<option value="0">Seleccione municipio</option>');
        }else{
            $.post('./php/obtenerRecursos/obtenerMunicipios.php', { islaSeleccionada: $('#busquedaIslas').val() },
                function(respuesta)
                {
                    cadena = '<option value="0">Seleccione municipio</option>';
                    $.each(respuesta, function(i, tupla){
                        cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
                    });
                    $("#busquedaMunicipios").html(cadena );
                    // Habilitar el input de isla
                    $("#busquedaMunicipios").attr('disabled', false);
                }
                , "json"
            );
        }
    });
    
    $.getJSON('./php/obtenerRecursos/obtenerCategorias.php',
        function(respuesta)
        {
            cadena = '<option value="0">Seleccione categoria</option>';
            $.each(respuesta, function(i, tupla){
                cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
            });
            $("#busquedaCategorias").html(cadena);
        }
    );
    
    
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
    $('#enviarFormularioBusqueda').on('click', function (ev) {
        ev.preventDefault();
        var correcto = true;
        var mensajeBusqueda = "Compruebe los datos de la busqueda: </br>";
        // Comprobar email
        // Isla
        if($('#busquedaIslas').val() == 0){
            mensajeBusqueda += "Seleccione una isla</br>";
            correcto = false;
        }
        // Municipio
        if($('#busquedaMunicipios').val() == 0){
            mensajeBusqueda += "Seleccione un municipio</br>";
            correcto = false;
        }
        //Categoria
        if($('#busquedaCategorias').val() == 0){
            mensajeBusqueda += "Seleccione una categoria</br>";
            correcto = false;
        }
                                    
        // Peticion ajax, mostrar el mensaje si el correo se ha enviado correctamente
        if(correcto){
            // hacer un submit del formulario
            $('#formularioBusqueda').submit
        }else{
            $("#mensajeInfo").html(mensajeBusqueda);
            $("#modalInfo").modal("show"); 
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