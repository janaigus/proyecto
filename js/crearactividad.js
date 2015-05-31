$(document).ready(function () {
    
    $('#formularioActividad').on('submit', function (ev) {
        var correcto = true;
        var mensajesError = '<a class="panel-close close" data-dismiss="alert">×</a>';
        var iconoError = '<span class="glyphicon glyphicon-remove"></span>';
        // Titulo
        if($('#titulo').val() == ""){
            mensajesError += iconoError + "Introduzca un nombre</br>";
            correcto = false;
        }
        // Descripcion
        if($('#descripcion').val() == ""){
            mensajesError += iconoError + "Introduzca unos apellidos</br>";
            correcto = false;
        }
        // Municipio
        if($('#municipios').val() == 0){
            mensajesError += iconoError + "Seleccione un municipio</br>";
            correcto = false;
        }
        // Categoria
        if($('#categorias').val() == 0){
            mensajesError += iconoError + "Seleccione un categorias</br>";
            correcto = false;
        }
        // Comprobar que es correcto para enviarlo
        if(correcto == false){
            ev.preventDefault();
            $('#panelAlertas').html(mensajesError);
            $('#panelAlertas').css("display", "block");
        }
    });
    
    // Añadir el on change para mostrar la miniatura de la imagen al subirla
    $('#imagenActividad').on("change", function(ev){ 
        // Prevenir el comportamiento por defecto en el drop que es abrir el archivo en el propio navegador
        ev.preventDefault();
        // Recoger el fichero que se ha recibido en nuestra variable global
        var fich = document.getElementById("imagenActividad").files[0];
        // Recoger el img donde estará la vista previa de la imagen y colocarle el archivo
        $('#imagenColocada').attr("src", URL.createObjectURL(fich));
    });
    
    $('#descripcion').on('keypress', function (ev) {
        var value   = $(this).val();
        var current = value.length;
        $('#lrestantes').html((250 - current) + " letras restantes");
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
            $.post('../sesion/login.php', $('#formularioEntrar').serialize(), 
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
    
    $('#btnEntrar').on('click', function (ev) {
        $("#menu-close").click();
        $("#modalEntrar").modal("show"); 
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