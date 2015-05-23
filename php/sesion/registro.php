<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM usuarios where email=:email";
    $result = $db->prepare($consulta);
    $result->execute(array(":email" => $_POST['entrarEmail']));
    //Cuando haya un resultado segun el correo electronico el usuario ya estará registrado
    if(!$result->rowCount() > 0){
        
        echo "REGISTRANDO USUARIO";
    }else{
        // El email ya está registrado y puede ser insertado, en el cliente se comprueba que esté bien formado
        echo "REGISTEREDUSER";
        
    }
?>