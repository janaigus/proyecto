$(document).ready(function () {
    
    $('#formularioBusqueda').on('submit', function (ev){
        var correcto = true;
        var mensajeBusqueda = "Compruebe los datos de la busqueda: </br>";
        // Comprobar email
        // Isla
        if($('#busquedaIslas').val() == 0){
            mensajeBusqueda += "Seleccione una isla</br>";
            correcto = false;
        }
        // Municipio
        if($('#busquedaMunicipios').val() == 0){
            mensajeBusqueda += "Seleccione un municipio</br>";
            correcto = false;
        }
        //Categoria
        if($('#busquedaCategorias').val() == 0){
            mensajeBusqueda += "Seleccione una categoria</br>";
            correcto = false;
        }
                                    
        // Peticion ajax, mostrar el mensaje si el correo se ha enviado correctamente
        if(!correcto){
            ev.preventDefault();
            $("#mensajeInfo").html(mensajeBusqueda);
            $("#modalInfo").modal("show"); 
        }
    });
    
    // ISLAS Y MUNICIPIOS
    // Cargar las islas en select de islas de la ventana de registro
    $.getJSON('php/obtenerRecursos/obtenerIslas.php',
        function(respuesta)
        {
            cadena = '<option value="0">Seleccione isla</option>';
            $.each(respuesta, function(i, tupla){
                cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
            });
            $("#registroIslas").html(cadena);
            $("#busquedaIslas").html(cadena);
        }
    );
    
    // Campos de busqueda
    $('#busquedaIslas').on('change', function (ev) {
        if($('#busquedaIslas').val() == 0){
            $("#busquedaMunicipios").attr('disabled', true);
            $("#busquedaMunicipios").html('<option value="0">Seleccione municipio</option>');
        }else{
            $.post('php/obtenerRecursos/obtenerMunicipios.php', { islaSeleccionada: $('#busquedaIslas').val() },
                function(respuesta)
                {
                    cadena = '<option value="0">Seleccione municipio</option>';
                    $.each(respuesta, function(i, tupla){
                        cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
                    });
                    $("#busquedaMunicipios").html(cadena );
                    // Habilitar el input de isla
                    $("#busquedaMunicipios").attr('disabled', false);
                }
                , "json"
            );
        }
    });
    
    $.getJSON('php/obtenerRecursos/obtenerCategorias.php',
        function(respuesta)
        {
            cadena = '<option value="0">Seleccione categoria</option>';
            $.each(respuesta, function(i, tupla){
                cadena += '<option value="'+tupla.id+'">'+tupla.nombre+'</option>';
            });
            $("#busquedaCategorias").html(cadena);
        }
    );
    
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
});