<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT act.id, act.titulo, act.descripcion, DATE_FORMAT(act.created, '%d-%m-%Y') AS creada, r.ruta, ";
    $consulta .= "cat.nombre AS categoria, COUNT( v.id ) AS veces, ROUND( AVG( v.valoracion ) ) AS media ";
    $consulta .= "FROM actividades act ";
    $consulta .= "INNER JOIN votos v ON act.id = v.idactividad ";
    $consulta .= "INNER JOIN recursos r ON act.id = r.idactividad ";
    $consulta .= "INNER JOIN auxcategorias cat ON act.idcategoria = cat.id ";
    $consulta .= "GROUP BY act.id ";
    $consulta .= "ORDER BY AVG( v.valoracion ) DESC ";
    $consulta .= "LIMIT 3";
    $result = $db->prepare($consulta);
    $result->execute();
    $arrayResult = $result->fetchAll();
    echo json_encode($arrayResult);
?>