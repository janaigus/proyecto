$(document).ready(function () {
    // Gestion de los errores en el envio del formulario actividad
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
            mensajesError += iconoError + "Introduzca una descripcion</br>";
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
});