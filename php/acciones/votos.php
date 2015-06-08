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
            $consulta = "DELETE FROM votos WHERE id = :voto";
            $result = $db->prepare($consulta);
            $result->bindParam(":voto", $_POST['idvoto'], PDO::PARAM_STR);
            $result->execute();
            echo "OK";
        }
    }
?>