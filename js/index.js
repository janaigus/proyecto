$(document).ready(function () {
    $('#formularioBusqueda').on('submit', function (ev){
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
        if(!correcto){
            ev.preventDefault();
            $("#mensajeInfo").html(mensajeBusqueda);
            $("#modalInfo").modal("show"); 
        }
    });
    
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
        // Comprobar nombre                         
        if($('#nombreContacto').val() == ""){
            cambiarEstadoCaja("cajaNombreContacto", true, "Introduzca un nombre");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaNombreContacto", false, "");
        }
        // Comprobar asunto
        if($('#asuntoContacto').val() == ""){
            cambiarEstadoCaja("cajaAsuntoContacto", true, "Introduzca un asunto");
            correcto = false;
        }else{
            cambiarEstadoCaja("cajaAsuntoContacto", false, "");
        }
        // Comprobar mensaje
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
                    }
                }
            );
        }
    });
    
    $('#btnEntrar').on('click', function (ev) {
        $("#menu-close").click();
        $("#modalEntrar").modal("show"); 
    });
    
    $('#btnContacto').on('click', function (ev) {
        $("#modalContacto").modal("show");        
    });
    
    // Destruir los popover cuando el formulario de contacto se haya cerrado
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
        // Enviar el formulario cuando todo sea correcto via post
        if(correcto){
            $.post('./php/sesion/login.php', $('#formularioEntrar').serialize(), 
                function(respuesta)
                {
                    switch(respuesta){
                        case "OK":
                            //  Recargar la pagina
                            location.reload();
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
});

// Closes the sidebar menu
$("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Opens the sidebar menu
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Scrolls to the selected menu item on the page
$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});

// Cambia el mensaje de la caja por el mensaje pasado, y la muestra.
// Para que desaparezca solo se ha de pasar el parametro false en mal
// Indicando que todo esta funcionando de manera correcta
function cambiarEstadoCaja(nombreCaja, mal, mensaje){
    if(mal){
        $('#'+nombreCaja).popover({ trigger: 'focus', placement: 'bottom', content: mensaje });
        $('#'+nombreCaja).popover('show');
        correcto = false;
    }else{
        $('#'+nombreCaja).popover('destroy');
    }
}