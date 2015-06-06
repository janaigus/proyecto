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
    
    $('#grupoCentros button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#nombreCentro_'+id).attr("disabled", false);
            $('#informacionCentro_'+id).attr("disabled", false);
            $('#islaCentro_'+id).attr("disabled", false);
            $('#longitudCentro_'+id).attr("disabled", false);
            $('#latitudCentro_'+id).attr("disabled", false);
            
            $(this).attr("id", "cancelarEditarCentro_"+id);
            $(this).html('<span class="glyphicon glyphicon-remove"></span> Cancelar');
            $('#confirmarEditarCentro_'+id).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditarCentro") >= 0){
                location.reload();
            }
        }
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show"); 
            /*
            $('#warningConfirmar').on('click', function (ev){
                $.post('../acciones/categoria.php', { idcategoria: id, comando: "borrar" }, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );
            });*/
        }
        if($(this).attr("id").indexOf("confirmarEditarCentro") >= 0){
            var expresionDoble = /^-?[0-9]+([,\.][0-9]*)?$/;
            var mensaje = "";
            var correcto = true;
            if($('#nombreCentro_'+id).val() == ""){
                mensaje += "El nombre del centro no puede estar vacio <br/>";
                correcto = false;
            }
            if($('#informacionCentro_'+id).val() == ""){
                mensaje += "El infromacion del centro no puede estar vacioa <br/>";
                correcto = false;
            }
            comprobarLongitud = $('#longitudCentro_'+id).val().match(expresionDoble);
            if(comprobarLongitud == null){
                mensaje += "La longitud no es un número correcto <br/>";
                correcto = false;
            }
            comprobarLatitud = $('#latitudCentro_'+id).val().match(expresionDoble);
            if(comprobarLatitud == null){
                mensaje += "La latitud no es un número correcto <br/>";
                correcto = false;
            }
            if(correcto){
                /*$.post('../acciones/categoria.php', { idcategoria: id, nombre: $('#nombreCentro_'+id).val(), comando: "editar"}, 
                    function(respuesta)
                    {
                        if(respuesta == "OK"){
                            location.reload();
                        }
                    }
                );*/
            }else{
                $('#panelAlertas').html(mensaje);
                $('#panelAlertas').css("display", "block");
            }
        }
    });
    
    $('#formularioNuevaCategoria').on('submit', function(ev){
        if($('#nombreNuevaCategoria').val() == ""){
            $('#panelAlertasCategorias').css("display", "inline-block");
            $('#mensajeAlertasCategorias').html("Por favor introduzca un titulo para la categoria");
            ev.preventDefault();
        }
    });
    
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