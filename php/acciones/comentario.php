<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if($_POST['comando'] == "editar"){
        $consulta = 'UPDATE comentarios SET ';
        $consulta .= 'texto = :texto ';
        $consulta .= 'WHERE comentarios.id = '.$_POST['idcomentario'];
        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':texto' => $_POST['texto']));
        echo "OK";
    }else{
        if($_POST['comando'] == "borrar"){
            // Comenzar borrando los votos
            $consulta = "DELETE FROM comentarios WHERE id = :comentario";
            $result = $db->prepare($consulta);
            $result->bindParam(":comentario", $_POST['idcomentario'], PDO::PARAM_STR);
            $result->execute();
            echo "OK";
        }
    }
?>