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
        // Comprobar contraseña introducida y que la segunda coincide
        if($('#registroPassword').val() == ""){
            mensajesError += iconoError + "Introduzca una contraseña</br>";
            correcto = false;
        }else{
            // Comprobar si el segundo campo está vacio
            if($('#registroPass_con').val() == ""){
                mensajesError += iconoError + "Debe repetir la contraseña</br>";
                correcto = false;
            }else{
                // Comprobar que las contraseñas coinciden
                if($('#registroPassword').val() != $('#registroPass_con').val()){
                    mensajesError += iconoError + "Las contraseñas no coinciden</br>";
                    correcto = false;
                }
            }
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
});
