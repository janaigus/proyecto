$(document).ready(function () {
    $('#grupoComentarios button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#textoComentario_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarComentario_"+id);
            $(this).html("Cancelar");
            $('#confirmarEditarComentario_'+id).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditarComentario") >= 0){
                location.reload();
            }
        }
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show"); 
            $('#warningConfirmar').on('click', function (ev){
                $.post('../acciones/comentario.php', { idcomentario: id, comando: "borrar" }, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );
            });
        }
        if($(this).attr("id").indexOf("confirmarEditarComentario") >= 0){
            $.post('../acciones/comentario.php', { idcomentario: id, texto: $('#textoComentario_'+id).val(), comando: "editar"}, 
                function(respuesta)
                {
                    if(respuesta == "OK"){
                        location.reload();
                    }
                }
            );
        }
    });
    
    $('#grupoVotos button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#selectVoto_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarVoto_"+id);
            $(this).html("Cancelar");
            $('#confirmarEditarVoto_'+id).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditarVoto") >= 0){
                location.reload();
            }
        }
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show"); 
            $('#warningConfirmar').on('click', function (ev){
                $.post('../acciones/votos.php', { idvoto: id, comando: "borrar" }, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );
            });
        }
        if($(this).attr("id").indexOf("confirmarEditarVoto") >= 0){
            $.post('../acciones/votos.php', { idvoto: id, voto: $('#selectVoto_'+id).val(), comando: "editar"}, 
                function(respuesta)
                {
                    if(respuesta == "OK"){
                        location.reload();
                    }
                }
            );
        }
    });
    
    $('#grupoActividades button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton editar se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            
            $('#selectVoto_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarActividad_"+id);
            
            // Cambiar iconos
            $('#confirmarEditarActividad_'+id).html('<span class="glyphicon glyphicon-save"></span>');
            $(this).html('<span class="glyphicon glyphicon-remove"></span>');
            // Mostrar confirmar y ocultar borrar
            $('#confirmarEditarActividad_'+id).css("display", "inline");
            $('#borrarActividad_'+id).css("display", "none");
        }else{
            if($(this).children().hasClass('glyphicon glyphicon-remove')){
                location.reload();
            }
        }
        // Comprobar que boton borrar se ha presionado
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show");
            $('#warningConfirmar').on('click', function (ev){
                $.post('../acciones/actividad.php', { idactividad: id, comando: "borrar" }, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );
            });
        }
        
        // Comprobar que boton confirmar editar se ha presionado
        if($(this).attr("id").indexOf("confirmarEditarActividad") >= 0){
            
            $.post('../acciones/actividad.php', { idactividad: id, voto: $('#selectVoto_'+id).val(), comando: "editar"}, 
                function(respuesta)
                {
                    if(respuesta == "OK"){
                        location.reload();
                    }
                }
            );
            
        }
    });
    
});

