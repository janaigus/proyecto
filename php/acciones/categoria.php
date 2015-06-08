<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $idcategoria = (isset($_POST['idcategoria'])) ? $_POST['idcategoria'] : "";
    if($_POST['comando'] == "editar"){
        $consulta = 'UPDATE auxcategorias SET ';
        $consulta .= 'nombre = :nombre ';
        $consulta .= 'WHERE id = '.$idcategoria;
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':nombre' => $_POST['nombre'] ) );
        if($resultado == 1){
            echo "OK";
        }else{
            echo "BAD";
        }
    }else{
        if($_POST['comando'] == "borrar"){
            // Array para guardar las actividades que son del usuario y que serán borradas
            $indicesActividades = array();
            // Obtener las actividades del usuario
            $consulta = "SELECT id FROM actividades WHERE idcategoria = :categoria";
            $result = $db->prepare($consulta);
            $result->execute(array(":categoria" => $idcategoria));
            $arrayResult = $result->fetchAll();
            $arrayActividades = $arrayResult;
            
            for($i=0;$i < count($arrayActividades);$i++){
                // Comenzar borrando los votos
                $consulta = "DELETE FROM votos WHERE idactividad = :actividad";
                $result = $db->prepare($consulta);
                $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
                $result->execute();           
            }
            
            for($i=0;$i < count($arrayActividades);$i++){
                // Luego borrar los comentarios
                $consulta = "DELETE FROM comentarios WHERE idactividad = :actividad";
                $result = $db->prepare($consulta);
                $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
                $result->execute();           
            }
            
            for($i=0;$i < count($arrayActividades);$i++){
                // Borrar los recursos de esas actividades y luego las propias actividades
                $consulta = "DELETE FROM recursos WHERE idactividad = :actividad";
                $result = $db->prepare($consulta);
                $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
                $result->execute();            
            }

            for($i=0;$i < count($arrayActividades);$i++){
                // Borrar las actividades 
                $consulta = "DELETE FROM actividades WHERE id = :actividad";
                $result = $db->prepare($consulta);
                $result->bindParam(":actividad", $arrayActividades[$i]['id'], PDO::PARAM_STR);
                $result->execute(); 
            }
            
            // Borrar las categorias 
            $consulta = "DELETE FROM auxcategorias WHERE id = :categoria";
            $result = $db->prepare($consulta);
            $result->bindParam(":categoria", $idcategoria, PDO::PARAM_STR);
            $resultado = $result->execute();
            if($resultado == 1){
                echo "OK";
            }else{
                echo "BAD";
            }
        }else{
            if($_POST['comando'] == "agregar"){
                // Comenzar borrando los votos
                $consulta = "INSERT INTO auxcategorias (nombre) ";
                $consulta .= "VALUES (:nombre)";
                $result = $db->prepare($consulta);
                $result->bindParam(":nombre", $_POST['nombre'], PDO::PARAM_STR);
                $resultado = $result->execute();
                if($resultado == 1){
                    header ('Location: ../paginas/administrador.php#categorias');
                }
            }
        }
    }
?>