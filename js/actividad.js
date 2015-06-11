$(document).ready(function () {
    $('#enviarcom').on('click', function (ev) {
        var correcto = true;
        var mensajesError = '<a class="panel-close close" data-dismiss="alert">×</a>';
        var iconoError = '<span class="glyphicon glyphicon-remove"></span>';
        // Titulo
        if($('#comentarios').val() == ""){
            mensajesError += iconoError + "El comentario debe estar relleno.</br>";
            correcto = false;
        }
        // Comprobar que es correcto para enviarlo
        if(correcto == false){
            ev.preventDefault();
            $('#panelAlertas').html(mensajesError);
            $('#panelAlertas').css("display", "block");
        }
    });
    
    $('#comentarios').on('keypress', function (ev) {
        var value   = $(this).val();
        var current = value.length;
        $('#lrestantes').html((250 - current) + " letras restantes");
    });
    
    // Cuando el usuario hace click en una estrella
    $('.ec-stars-wrapper span').on('click', function(ev){
        // Cambiar el valor del input hidden con la valoracion
        $('#valoracion').val($(this).attr('id'));
        // Hacer desaparecer las estrellas
        $('.ec-stars-wrapper').css('display', 'none');
        // Mostrar el texto como ya se ha realizado la valoración
        $('#mensajeValoracion').html("Has valorado esta actividad con "+$(this).attr('id')+" estrellas. </br>Por favor rellena y envia tu comentario para continuar.");
        
    }); 
});