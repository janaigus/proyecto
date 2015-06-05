<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if($_POST['comando'] == "editar"){
        $consulta = 'UPDATE votos SET ';
        $consulta .= 'valoracion = :voto ';
        $consulta .= 'WHERE votos.id = '.$_POST['idvoto'];
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':voto' => $_POST['voto']));
        echo "OK";
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
            $result->execute(); 
            
            echo "OK";
        }
    }
?>