<?php
    session_start();
    require('php/bd/conexionBDlocal.php');
    $db = conectaDb();
    $userId = (isset($_POST['userID'])) ? $_POST['userID'] : "";
    // Comprobar si el usuario existe en la base de datos, 
    // en este caso se hará por la password que es donde almacenaremos el userID de facebook
    $consulta = "SELECT * FROM usuarios WHERE password = :userid";
    $result = $db->prepare($consulta);
    $result->execute(array(":userid" => $_POST['userid']));
    if($result->rowCount() > 0){
        // El usuario ya existe, iniciar sesion
        
    }else{
        // Registrar al usuario
        // Pedir al usuario que introduzca su isla y municipio
        // Comprobar que se ha introducido una isla y un municipio
        
    }
?>