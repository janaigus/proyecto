<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if($_POST['comando'] == "editar"){
        $consulta .= 'UPDATE actividades SET ';
        $consulta .= 'idcategoria = :categoria, ';
        $consulta .= 'WHERE actividades.id = '.$_POST['idactividad'];
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':categoria' => $_POST['categoria']));
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
            $consulta = "SELECT id FROM actividades WHERE idusuario = :usuario";
            $result = $db->prepare($consulta);
            $result->execute(array(":usuario" => $sesionId));
            $arrayResult = $result->fetchAll();
            $arrayActividades = $arrayResult;

            // Comenzar borrando los votos
            $consulta = "DELETE FROM votos WHERE idusuario = :usuario";
            $result = $db->prepare($consulta);
            $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
            $result->execute();


            // Luego borrar los comentarios
            $consulta = "DELETE FROM comentarios WHERE idusuario = :usuario";
            $result = $db->prepare($consulta);
            $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
            $result->execute();

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
            // Borrar el usuario del sistema
            $consulta = "DELETE FROM usuarios WHERE id = :usuario";
            $result = $db->prepare($consulta);
            $result->bindParam(":usuario", $sesionId, PDO::PARAM_STR);
            $result->execute();
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
    }
?>