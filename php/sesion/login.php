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
    //Cuando haya un resultado segun el correo electronico
    if($result->rowCount() > 0){
        $arrayResult = $result->fetchAll();
        $userContra = $arrayResult[0]['password'];
        echo $userContra;
        //Si la contraseña del usuario coincide, crear sesiones y redirigir a su página
        if(crypt($passwordI, $userContra) == $userContra){
            $_SESSION['nombre'] = $arrayResult[0]['nombre'];
            $_SESSION['rol'] = $arrayResult[0]['idrol'];
            $_SESSION['municipio'] = $arrayResult[0]['idmunicipio'];
            $_SESSION['email'] = $arrayResult[0]['email'];
            $_SESSION['fecha'] = date("Y-n-j H:i:s");
            REDIRIGIR
            header('Location: index.php');
            echo "OK";
        }else
            echo "BADPASS";
    }else
        echo "BADEMAIL";
?>