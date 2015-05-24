<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM auxmunicipios where idisla = ".$_POST['islaSeleccionada']." ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute();
    $arrayResult = $result->fetchAll();
    echo json_encode($arrayResult);
?>