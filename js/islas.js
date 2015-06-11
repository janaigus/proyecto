$(document).ready(function () {
    $('#formularioBusqueda').on('submit', function (ev){
        var correcto = true;
        var mensajeBusqueda = "Compruebe los datos de la busqueda: </br>";
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
});
