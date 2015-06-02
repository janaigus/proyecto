<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "INSERT INTO votos (idactividad, idusuario, valoracion) VALUES (:actividad, :usuario, :voto)";
    $result = $db->prepare($consulta);
    $result->execute(array(":actividad" => $_POST['actividad'], ":usuario" => $_POST['usuario'], ":voto" => $_POST['voto']));
    echo "OK";
?>