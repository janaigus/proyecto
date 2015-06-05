$(document).ready(function () {
    $('#grupoComentarios button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#textoComentario_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarComentario_"+id);
            $(this).html('<span class="glyphicon glyphicon-remove"></span> Cancelar');
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
            $(this).html('<span class="glyphicon glyphicon-remove"></span> Cancelar');
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
            // Desbloquear los campos para poder editarlos
            $('#categoriaActividad_'+id).attr("disabled", false);
            $('#islaActividad_'+id).attr("disabled", false);
            $('#municipioActividad_'+id).attr("disabled", false);
            $('#tituloActividad_'+id).attr("disabled", false);
            $('#descripcionActividad_'+id).attr("disabled", false);
            
            $(this).attr("id", "cancelarEditarActividad_"+id);
            // Cambiar icono
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
            $.post('../acciones/actividad.php', 
                   { idactividad: id, 
                     comando: "editar", 
                     categoria: $('#categoriaActividad_'+id).val(),
                     isla: $('#islaActividad_'+id).val(),
                     municipio: $('#municipioActividad_'+id).val(),
                     titulo: $('#tituloActividad_'+id).val(),
                     descripcion: $('#descripcionActividad_'+id).val()
                   }, 
                   function(respuesta)
                   {
                       if(respuesta == "OK"){
                           location.reload();
                       }
                   }
            );
            
        }
    });
    
    $('#grupoCategorias button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#nombreCategoria_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarCategoria_"+id);
            $(this).html('<span class="glyphicon glyphicon-remove"></span> Cancelar');
            $('#confirmarEditarCategoria_'+id).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditarCategoria") >= 0){
                location.reload();
            }
        }
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show"); 
            
            $('#warningConfirmar').on('click', function (ev){
                $.post('../acciones/categoria.php', { idcategoria: id, comando: "borrar" }, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );
            });
        }
        if($(this).attr("id").indexOf("confirmarEditarCategoria") >= 0){
            
            $.post('../acciones/categoria.php', { idcategoria: id, nombre: $('#nombreCategoria_'+id).val(), comando: "editar"}, 
                function(respuesta)
                {
                    if(respuesta == "OK"){
                        location.reload();
                    }
                }
            );
            
        }
    });
    
    /*
    $.post('../acciones/categoria.php', { idcategoria: id, nombre: $('#nombreCategoria_'+id).val(), comando: "editar"}, 
        function(respuesta)
        {
            if(respuesta == "OK"){
                location.reload();
            }
        }
    );*/
    
    
    // Cambio en el select de isla 
    $("#grupoActividades select[id*='islaActividad_']").on('change', function (ev) {
        var id = $(this).attr("id").split("_")[1];
        $.post('../obtenerRecursos/obtenerMunicipios.php', { islaSeleccionada: $('#islaActividad_'+id).val() },
            function(respuesta)
            {
                cadena = '';
                $.each(respuesta, function(i, tupla){
                    cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
                });
                $("#municipioActividad_"+id).html(cadena );
            }
            , "json"
        );
        
    });
});