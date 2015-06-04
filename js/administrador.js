$(document).ready(function () {
    /*var dato = 1;
    $('#modalWarning').modal("show"); 
    $('#warningConfirmar').on('click', function (ev){
        alert(dato);
    
    });*/
    $('#grupoComentarios button').on('click', function(ev){
        var id = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#textoComentario_'+id).attr("disabled", false);
            $(this).attr("id", "cancelarEditarComentario_"+id);
            $(this).html("Cancelar");
            $('#confirmarEditar_'+id).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditar") >= 0){
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
        if($(this).attr("id").indexOf("confirmar") >= 0){
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
});

