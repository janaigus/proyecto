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
    
    // Cuando se presione el boton procesar baja enviar el formulario que tramitará la baja
    $('#procesarBaja').on('click', function (ev) {
        ev.preventDefault();
        $('#borrarPerfil').submit();
    });
});