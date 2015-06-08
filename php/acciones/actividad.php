<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if($_POST['comando'] == "editar"){
        $consulta .= 'UPDATE actividades SET ';
        $consulta .= 'idcategoria = :categoria, ';
        $consulta .= 'titulo = :titulo, ';
        $consulta .= 'descripcion = :descripcion, ';
        $consulta .= 'idmunicipio = :municipio, ';
        $consulta .= 'idisla = :isla ';
        $consulta .= 'WHERE actividades.id = '.$_POST['idactividad'];
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':categoria' => $_POST['categoria'],
                                            ':titulo' => $_POST['titulo'],
                                            ':descripcion' => $_POST['descripcion'],
                                            ':municipio' => $_POST['municipio'],
                                            ':isla' => $_POST['isla']
                                           ));
        if($resultado == 1){
            echo "OK";
        }else{
            echo "BAD";
        }
    }else{
        if($_POST['comando'] == "borrar"){
            // Comenzar borrando los votos
            $consulta = "DELETE FROM votos WHERE idactividad = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $_POST['idactividad'], PDO::PARAM_STR);
            $result->execute();
            
            // Luego borrar los comentarios
            $consulta = "DELETE FROM comentarios WHERE idactividad = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $_POST['idactividad'], PDO::PARAM_STR);
            $result->execute();
            
            // Borrar los recursos de esas actividades y luego las propias actividades
            $consulta = "DELETE FROM recursos WHERE idactividad = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $_POST['idactividad'], PDO::PARAM_STR);
            $result->execute();

            // Borrar las actividades 
            $consulta = "DELETE FROM actividades WHERE id = :actividad";
            $result = $db->prepare($consulta);
            $result->bindParam(":actividad", $_POST['idactividad'], PDO::PARAM_STR);
            $resultado = $result->execute(); 
            if($resultado == 1){
                echo "OK";
            }else{
                echo "BAD";
            }
        }
    }
?>