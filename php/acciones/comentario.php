<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    if($_POST['comando'] == "editar"){
        $consulta = 'UPDATE usuarios SET ';
        $consulta .= 'email = :email , ';
        $consulta .= 'nick = :nick , ';
        $consulta .= 'nombre = :nombre , ';
        $consulta .= 'apellidos = :apell , ';
        $consulta .= 'password = :pass ';
        $consulta .= 'WHERE usuarios.id = '.$usuario;

        $result = $db->prepare($consulta);
        $resultado = $result->execute(array(':email' => $_POST['email']));
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