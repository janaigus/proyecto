$(document).ready(function () {
    /*var dato = 1;
    $('#modalWarning').modal("show"); 
    $('#warningConfirmar').on('click', function (ev){
        alert(dato);
    
    });*/
    $('#grupoComentarios button').on('click', function(ev){
        var idComentario = $(this).attr("id").split("_")[1];
        // Comprobar que boton se ha presionado
        if($(this).attr("id").indexOf("editar") >= 0){
            $('#textoComentario_'+idComentario).attr("disabled", false);
            $(this).attr("id", "cancelarEditarComentario_"+idComentario);
            $(this).html("Cancelar");
            $('#confirmarEditar_'+idComentario).css("display", "inline");
        }else{
            if($(this).attr("id").indexOf("cancelarEditar") >= 0){
                location.reload();
            }
        }
        if($(this).attr("id").indexOf("borrar") >= 0){
            $('#modalWarning').modal("show"); 
            $('#warningConfirmar').on('click', function (ev){
                alert(idComentario);

            });
        }
        if($(this).attr("id").indexOf("confirmar") >= 0){
            alert("Guardar cambios");
            
        }
    });
});

