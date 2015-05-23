<?php
    // Requerir el fichero para la conexion con la base de datos 
    // IMPORTANTE CAMBIAR el fichero de la BD local por el de la BD del hosting
    session_destroy();
    session_start();
    require('../bd/conexionBDlocal.php');
    $db = conectaDb();
    $consulta = "SELECT * FROM usuarios where email=:email";
    $result = $db->prepare($consulta);
    $result->execute(array(":email" => $_POST['entrarEmail']));
    //Cuando haya un resultado segun el correo electronico el usuario ya estará registrado
    if($result->rowCount() > 0){
        $arrayResult = $result->fetchAll();
        $userContra = $arrayResult[0]['password'];
        echo $userContra;
    
        // Crear sesiones y redirigir al usuario a su página
        $_SESSION['nombre'] = $arrayResult[0]['nombre'];
        $_SESSION['rol'] = $arrayResult[0]['idrol'];
        $_SESSION['municipio'] = $arrayResult[0]['idmunicipio'];
        $_SESSION['email'] = $arrayResult[0]['email'];
        $_SESSION['fecha'] = date("Y-n-j H:i:s");
        REDIRIGIR
        header('Location: index.php');
        echo "OK";
    }else{
        // El usuario no está registrado y puede ser insertado, en el cliente se comprueba que esté bien formado
        echo "BADEMAIL";
        
    }
?>