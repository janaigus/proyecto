<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM auxislas ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute();
    $arrayResult = $result->fetchAll();
    echo json_encode($arrayResult);
?>