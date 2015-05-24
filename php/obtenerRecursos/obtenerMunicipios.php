<?php
    // Requerir el fichero para la conexion con la base de datos 
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM auxmunicipios where idisla = :isla ORDER BY nombre";
    $result = $db->prepare($consulta);
    $result->execute(array(':isla' => $_POST['islaSeleccionada']));
    $arrayResult = $result->fetchAll();
    echo json_encode($arrayResult);
?>